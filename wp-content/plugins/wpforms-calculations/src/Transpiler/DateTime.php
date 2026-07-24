<?php

namespace WPFormsCalculations\Transpiler;

// phpcs:ignore WPForms.PHP.UseStatement.UnusedUseStatement
use DateTimeImmutable;

/**
 * Date and time helpers.
 *
 * @since 1.0.0
 */
class DateTime {

	/**
	 * Default date and time format.
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 */
	const DEFAULT_FORMAT = 'd-m-Y H:i';

	/**
	 * Default date and time formats.
	 *
	 * @since 1.0.0
	 *
	 * @var array
	 */
	const DEFAULT_FORMATS = [
		'd/m/Y',
		'd/m/Y g:i A',
		'd/m/Y H:i',
		'm/d/Y',
		'm/d/Y g:i A',
		'm/d/Y H:i',
		'd-m-Y',
		'd-m-Y g:i A',
		'd-m-Y H:i',
		'm-d-Y',
		'm-d-Y g:i A',
		'm-d-Y H:i',
		'Y-m-d',
		'Y-m-d g:i A',
		'Y-m-d H:i',
		'd.m.Y',
		'd.m.Y g:i A',
		'd.m.Y H:i',
		'F j, Y',
		'F j, Y g:i A',
		'F j, Y H:i',
		'g:i A',
		'H:i',
	];

	/**
	 * Datetime default format.
	 * Used in the case if the WP format is empty.
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 */
	private $default_format;

	/**
	 * Datetime default formats array.
	 *
	 * @since 1.0.0
	 *
	 * @var array
	 */
	private $default_formats;

	/**
	 * Return default date and time format.
	 *
	 * @since 1.0.0
	 *
	 * @return string Default date and time format.
	 */
	public function get_default_format() {

		if ( empty( $this->default_format ) ) {
			$this->default_format = sprintf( '%s %s', get_option( 'date_format' ), get_option( 'time_format' ) );
			$this->default_format = $this->default_format === ' ' ? self::DEFAULT_FORMAT : $this->default_format;

			/**
			 * Filter date and time default format string.
			 *
			 * @since 1.0.0
			 *
			 * @param array $format Date and time default format.
			 */
			$this->default_format = (string) apply_filters( 'wpforms_calculations_transpiler_date_time_get_default_format', $this->default_format );
		}

		return $this->default_format;
	}

	/**
	 * Get date and time default formats.
	 *
	 * @since 1.0.0
	 *
	 * @return array
	 */
	public function get_default_formats() {

		if ( empty( $this->default_formats ) ) {

			/**
			 * Filter date and time default formats list.
			 *
			 * @since 1.0.0
			 *
			 * @param array $formats Date and time default formats list.
			 */
			$this->default_formats = (array) apply_filters( 'wpforms_calculations_transpiler_date_time_get_default_formats', self::DEFAULT_FORMATS );
		}

		return $this->default_formats;
	}

	/**
	 * Get date and time string format by comparing date time string with the values of the datetime fields of the form.
	 *
	 * @since 1.0.0
	 *
	 * @param string $datetime_str The datetime string.
	 *
	 * @return string Date time string format.
	 */
	private function get_format_from_fields( $datetime_str ): string {

		$process      = wpforms_calculations()->process;
		$fields_entry = $process->get_fields_entry();

		if ( empty( $fields_entry ) ) {
			return '';
		}

		$form_data = $process->get_form_data();

		// Loop through the fields and try to find the right format.
		foreach ( $form_data['fields'] as $field_id => $field_data ) {
			if ( $field_data['type'] !== 'date-time' ) {
				continue;
			}

			$format = $this->match_field_format( $datetime_str, $field_data, $fields_entry[ $field_id ] );

			if ( ! empty( $format ) ) {
				return $format;
			}
		}

		return '';
	}

	/**
	 * Match a datetime string against a specific field to determine its format.
	 *
	 * @since 1.9.0
	 *
	 * @param string $datetime_str The datetime string.
	 * @param array  $field_data   Field configuration data.
	 * @param array  $field_entry  Field entry data.
	 *
	 * @return string Date time string format or empty string if no match.
	 */
	private function match_field_format( $datetime_str, $field_data, $field_entry ): string {

		$default_format = 'm/d/Y';
		$date_format    = $field_data['date_format'] ?? $default_format;
		$date_value     = $this->convert_format( $datetime_str, $field_data['date_format'], $date_format );
		$time_value     = $this->convert_format( $datetime_str, $field_data['time_format'], 'g:i A' );

		if ( ! $this->is_potential_match( $datetime_str, $field_entry, $date_value, $time_value ) ) {
			return '';
		}

		/**
		 * We should compare date value with field entry date and value fields.
		 * In the ` date ` field stored value in m/d/Y format (always, regardless of builder settings).
		 * In the ` value ` field stored value in builder format with time.
		 * See more: wpforms/src/Pro/Forms/Fields/DateTime/Field.php method format().
		 */
		// Check if datetime_str directly matches the 'date' subfield.
		if ( $datetime_str === $field_entry['date'] ) {
			return $this->get_date_subfield_format( $field_data['date_format'], $default_format );
		}

		// Check if datetime_str matches the 'value' field when a format is date-only (builder format).
		if ( $datetime_str === $field_entry['value'] && empty( $field_entry['time'] ) ) {
			return $field_data['date_format'];
		}

		// Check if datetime_str matches time field.
		if ( ! empty( $time_value ) && $field_entry['time'] === $time_value ) {
			return $field_data['time_format'];
		}

		// Check if datetime_str matches the 'value' field with time (builder format with time).
		if ( $field_entry['value'] === $datetime_str ) {
			return $field_data['date_format'] . ' ' . $field_data['time_format'];
		}

		return '';
	}

	/**
	 * Check if datetime string is a potential match for field entry.
	 *
	 * @since 1.9.0
	 *
	 * @param string $datetime_str The datetime string.
	 * @param array  $field_entry  Field entry data.
	 * @param string $date_value   Converted date value.
	 * @param string $time_value   Converted time value.
	 *
	 * @return bool True if potential match, false otherwise.
	 */
	private function is_potential_match( $datetime_str, $field_entry, $date_value, $time_value ): bool {

		return $field_entry['value'] === $datetime_str ||
			$field_entry['date'] === $date_value ||
			$field_entry['time'] === $time_value;
	}

	/**
	 * Get format for date subfield match.
	 *
	 * For formats with / or . separator, date is converted to m/d/Y.
	 * For other formats (like 'F j, Y'), date remains in builder format.
	 * See: convert_date_to_mdy() in Field.php:907-939.
	 *
	 * @since 1.9.0
	 *
	 * @param string $date_format    Date format from field data.
	 * @param string $default_format Default date format (m/d/Y).
	 *
	 * @return string Appropriate date format.
	 */
	private function get_date_subfield_format( $date_format, $default_format ): string {

		$has_separator = strpos( $date_format, '/' ) !== false || strpos( $date_format, '.' ) !== false;

		return $has_separator ? $default_format : $date_format;
	}

	/**
	 * Return date and time string format by comparing with now() in default formats.
	 *
	 * @since 1.0.0
	 *
	 * @param string $datetime_str The date and time string.
	 *
	 * @return string Date time string format.
	 */
	private function get_format_from_now( $datetime_str ) {

		foreach ( $this->get_default_formats() as $format ) {
			$now = $this->now( $format );

			if ( $now === $datetime_str ) {
				return $format;
			}
		}

		return '';
	}

	/**
	 * Return date and time string format by testing default formats.
	 *
	 * @since 1.0.0
	 *
	 * @param string $datetime_str The date and time string.
	 *
	 * @return string Date time string format.
	 */
	private function get_format_from_defaults( $datetime_str ) {

		foreach ( $this->get_default_formats() as $format ) {
			$date = date_create_immutable_from_format( $format, $datetime_str );

			if ( $date ) {
				return $format;
			}
		}

		return '';
	}

	/**
	 * Returns DateTime format from given WPForms format.
	 *
	 * @since 1.0.0
	 *
	 * @param string $datetime_str The datetime string.
	 *
	 * @return string Date time string format.
	 */
	public function get_format_by_value( $datetime_str ) {

		$format = $this->get_format_from_fields( $datetime_str );

		// If still no format - attempt to get format comparing to the result of now() in different formats.
		if ( empty( $format ) ) {
			$format = $this->get_format_from_now( $datetime_str );
		}

		// If still no format - loop through the default formats and try to find the right one.
		if ( empty( $format ) ) {
			$format = $this->get_format_from_defaults( $datetime_str );
		}

		return $format;
	}

	/**
	 * Returns DateTime object from given date string.
	 *
	 * @since 1.0.0
	 *
	 * @param string $datetime_str Datetime string.
	 * @param string $format       Date and time format. Empty string means that we will try to determine the right format automatically.
	 *
	 * @return DateTimeImmutable|false Instance of DateTimeImmutable.
	 */
	public function parse( $datetime_str, $format = '' ) {

		$format       = empty( $format ) ? $this->get_format_by_value( $datetime_str ) : $format;
		$datetime_obj = date_create_immutable_from_format( $format, $datetime_str );

		if ( ! $datetime_obj ) {
			return false;
		}

		// Detect time parts in the format.
		$has_hours   = preg_match( '/[gHG]/', $format );
		$has_minutes = strpos( $format, 'i' ) !== false;
		$has_seconds = strpos( $format, 's' ) !== false;

		// Set time to 00:00:00 if not provided to match frontend behavior.
		// Return the DateTimeImmutable object.
		return $datetime_obj->setTime(
			$has_hours ? $datetime_obj->format( 'H' ) : 0,
			$has_minutes ? $datetime_obj->format( 'i' ) : 0,
			$has_seconds ? $datetime_obj->format( 's' ) : 0
		);
	}

	/**
	 * Convert date and time string from one format to another.
	 *
	 * @since 1.0.0
	 *
	 * @param string $datetime_str Datetime string.
	 * @param string $from_format  Initial datetime format.
	 * @param string $to_format    Result format.
	 *
	 * @return string.
	 */
	public function convert_format( $datetime_str, $from_format, $to_format ) {

		if ( $from_format === $to_format || empty( $datetime_str ) ) {
			return $datetime_str;
		}

		$date = $this->parse( $datetime_str, $from_format );

		return $date ? $date->format( $to_format ) : '';
	}

	/**
	 * Get difference between two dates in given units.
	 *
	 * @since 1.0.0
	 *
	 * @param string $start  Start datetime.
	 * @param string $end    End datetime.
	 * @param string $units  Units: years, months, weeks, days, hours, minutes, seconds.
	 * @param string $format Date and time format.
	 *
	 * @return float|string
	 */
	public function diff( $start, $end, $units = 'days', $format = '' ) {

		$date_start = $this->parse( $start, $format );
		$date_end   = $this->parse( $end, $format );

		// Bail if some dates are invalid.
		if ( ! $date_start || ! $date_end ) {
			return '';
		}

		$diff = $date_end->getTimestamp() - $date_start->getTimestamp();

		$units_k = [
			'years'   => YEAR_IN_SECONDS,
			'months'  => MONTH_IN_SECONDS,
			'weeks'   => WEEK_IN_SECONDS,
			'days'    => DAY_IN_SECONDS,
			'hours'   => HOUR_IN_SECONDS,
			'minutes' => MINUTE_IN_SECONDS,
			'seconds' => 1,
		];

		$k     = $units_k[ $units ] ?? $units_k['days'];
		$diff /= $k;

		return $diff > 0 ? floor( $diff ) : ceil( $diff );
	}

	/**
	 * Get current date and time.
	 *
	 * @since 1.0.0
	 *
	 * @param string $format Date and time string format. Empty string means default format: `d-m-Y H:i`.
	 *
	 * @return string.
	 */
	public function now( $format ) {

		// Use WP format if format is not provided.
		$format = empty( $format ) ? $this->get_default_format() : $format;

		return wp_date( $format );
	}
}
