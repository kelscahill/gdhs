<?php

namespace WPFormsCalculations\Admin;

use stdClass;

/**
 * Calculation for Entries Edit feature.
 *
 * @since 1.0.0
 */
class EntriesEdit {

	/**
	 * Init.
	 *
	 * @since 1.0.0
	 */
	public function init() {

		$this->hooks();
	}

	/**
	 * Hooks.
	 *
	 * @since 1.0.0
	 */
	private function hooks() {

		add_filter( 'wpforms_pro_admin_entries_edit_field_output_editable', [ $this, 'is_output_editable' ], 10, 5 );
		add_action( 'wpforms_pro_admin_entries_edit_submit_completed', [ $this, 'submit_completed' ], 10, 4 );
	}

	/**
	 * Calculated fields shouldn't be editable on Entry Edit page.
	 *
	 * @since 1.0.0
	 *
	 * @param bool     $is_editable Default value.
	 * @param array    $field       Field data.
	 * @param stdClass $entry       Entry object.
	 * @param array    $form_data   Form data and settings.
	 *
	 * @return bool
	 */
	public function is_output_editable( $is_editable, $field, $entry, $form_data ) {

		if ( empty( $form_data['fields'] ) ) {
			return $is_editable;
		}

		// This filter is invoked once per field rendered on the Entry Edit page.
		// Without caching, get_form_data_with_layout_fields() and the two helpers
		// would each run N times — one per field — resulting in O(N²) complexity.
		// The static cache stores the per-form results across all filter invocations
		// for the same request, reducing the total work to O(N).
		static $cache = [];

		$form_id = $form_data['id'] ?? 0;

		if ( ! isset( $cache[ $form_id ] ) ) {
			// Include fields nested inside Layout columns for accurate calculation checks.
			$extended_form_data = $this->get_form_data_with_layout_fields( $form_data );
			$has_calc           = wpforms_calculations()->helpers->has_calculation_enabled_field( $extended_form_data );
			$used_fields        = $has_calc ? wpforms_calculations()->helpers->get_fields_used_in_form_calculations( $extended_form_data ) : [];

			$cache[ $form_id ] = [
				'has_calc'        => $has_calc,
				'disabled_fields' => $used_fields ? array_merge( ...$used_fields ) : [],
			];
		}

		// Whether the form has enabled calculation.
		if ( ! $cache[ $form_id ]['has_calc'] ) {
			return $is_editable;
		}

		// Check if the current field has a calculation enabled.
		if ( ! empty( $field['calculation_is_enabled'] ) && ! empty( $field['calculation_code_php'] ) ) {
			return false;
		}

		// Check if the field is used as a source in any calculation.
		if ( in_array( $field['id'], $cache[ $form_id ]['disabled_fields'], true ) ) {
			return false;
		}

		return $is_editable;
	}

	/**
	 * Calculate fields and update the entry fields values.
	 *
	 * @since 1.0.0
	 *
	 * @param array    $form_data      Form data and settings.
	 * @param array    $response       AJAX response data.
	 * @param array    $updated_fields Updated fields.
	 * @param stdClass $entry          Entry object.
	 */
	public function submit_completed( $form_data, $response, $updated_fields, $entry ) {

		if ( empty( $entry->fields ) ) {
			return;
		}

		$fields_entry         = json_decode( $entry->fields, true );
		$updated_fields_entry = $fields_entry;

		// Replace fields with updated values.
		foreach ( $updated_fields as $field_id => $updated_field ) {
			$updated_fields_entry[ $field_id ] = $updated_field;
		}

		// Calculate fields.
		$updated_fields_entry = wpforms_calculations()->process->process_fields( $updated_fields_entry, [], $form_data, false );

		// Replace payment fields with original value.
		foreach ( $updated_fields_entry as $field_id => $updated_field ) {
			if ( ! empty( $updated_field['type'] ) && strpos( $updated_field['type'], 'payment-' ) === 0 ) {
				$updated_fields_entry[ $field_id ] = $fields_entry[ $field_id ];
			}
		}

		// Update entry.
		$entry_obj        = wpforms()->obj( 'entry' );
		$entry_fields_obj = wpforms()->obj( 'entry_fields' );

		if ( $entry_obj && $entry_fields_obj ) {
			$update_entry_data = [
				'entry_id' => (int) $entry->entry_id,
				'fields'   => wp_json_encode( $updated_fields_entry ),
			];

			$entry_obj->update( $entry->entry_id, $update_entry_data );
			$entry_fields_obj->save( $updated_fields_entry, $form_data, $entry->entry_id, true );
		}
	}

	/**
	 * Get form data with layout-nested child fields merged into the top-level fields list.
	 *
	 * The entry edit form data filter moves child fields out of $form_data['fields'] into
	 * the layout's column data. This method restores a complete fields list so helpers
	 * that only iterate $form_data['fields'] can see calculation fields inside layouts.
	 *
	 * @since 1.11.0
	 *
	 * @param array $form_data Form data.
	 *
	 * @return array
	 */
	private function get_form_data_with_layout_fields( array $form_data ): array { // phpcs:ignore Generic.Metrics.NestingLevel.MaxExceeded

		// Iterate a snapshot of top-level fields; newly merged child fields are not re-visited.
		foreach ( $form_data['fields'] as $field ) {

			// Skip non-layout fields and layout fields with no columns defined.
			if ( empty( $field['type'] ) || $field['type'] !== 'layout' || empty( $field['columns'] ) ) {
				continue;
			}

			foreach ( $field['columns'] as $column ) {

				// Skip columns that carry no child field data.
				if ( empty( $column['fields'] ) || ! is_array( $column['fields'] ) ) {
					continue;
				}

				foreach ( $column['fields'] as $child_field ) {

					// Skip malformed entries that lack a field ID.
					if ( ! is_array( $child_field ) || empty( $child_field['id'] ) ) {
						continue;
					}

					// Register the child field at the top level so it is visible to helpers
					// that only iterate $form_data['fields'].
					$form_data['fields'][ $child_field['id'] ] = $child_field;
				}
			}
		}

		return $form_data;
	}
}
