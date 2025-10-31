
<?php

/*
 * ACF JSON Sync
 * Save and load ACF field group JSON files from resources/assets/acf-json
 */
add_filter('acf/settings/save_json', function ($path) {
  // For Sage themes, we need to go up one level from the resources directory
  $path = dirname(get_stylesheet_directory()) . '/resources/assets/acf-json';
  return $path;
});

add_filter('acf/settings/load_json', function ($paths) {
  unset($paths[0]);
  // For Sage themes, we need to go up one level from the resources directory
  $paths[] = dirname(get_stylesheet_directory()) . '/resources/assets/acf-json';
  return $paths;
});

/*
 * Allow SVG's through WP media uploader
 */
function cc_mime_types($mimes) {
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');

/*
 * Event date columns - Add custom column to events post type
 */
function add_acf_columns($columns) {
  return array_merge($columns, array(
    'event_start_date' => 'Event Start Date',
    'event_end_date' => 'Event End Date'
  ));
}
add_filter('manage_events_posts_columns', 'add_acf_columns');

/*
 * Event start date column - Display data in custom column
 */
function display_acf_column($column, $post_id) {
  if ($column === 'event_start_date') {
    $event_start_date = get_field('event_start_date', $post_id);
    if ($event_start_date) {
      echo date("F j, Y g:i a", strtotime($event_start_date));
    } else {
      echo '—';
    }
  }
  if ($column === 'event_end_date') {
    $event_end_date = get_field('event_end_date', $post_id);
    if ($event_end_date) {
      echo date("F j, Y g:i a", strtotime($event_end_date));
    } else {
      echo '—';
    }
  }
}
add_action('manage_events_posts_custom_column', 'display_acf_column', 10, 2);

/*
 * Event start date column - Make the custom column sortable
 */
function make_acf_column_sortable($columns) {
  $columns['event_start_date'] = 'event_start_date';
  $columns['event_end_date'] = 'event_end_date';
  return $columns;
}
add_filter('manage_edit-events_sortable_columns', 'make_acf_column_sortable');

/*
 * Event start date column - Handle custom column sorting
 */
function handle_acf_column_sorting($query) {
  if ($query->is_main_query() && ($orderby = $query->get('orderby'))) {
    if ($orderby === 'event_start_date') {
      $query->set('meta_key', 'event_start_date');
      $query->set('orderby', 'meta_value');
    }
    if ($orderby === 'event_end_date') {
      $query->set('meta_key', 'event_end_date');
      $query->set('orderby', 'meta_value');
    }
  }
}
add_action('pre_get_posts', 'handle_acf_column_sorting');

/*
 * Change post status to `Draft` for events that are old
 */

// // Add a new interval of 1 seconds
// function gdhs_add_seconds($schedules) {
//   $schedules['everysecond'] = array(
//     'interval' => 60,
//     'display' => __('Every Second')
//   );
//   return $schedules;
// }
// add_filter('cron_schedules', 'gdhs_add_seconds');

// // Schedule an action if it's not already scheduled
// if (!wp_next_scheduled('expire_posts') ) {
//   wp_schedule_event(time(), 'everysecond', 'expire_posts');
// }

// // Hook into that action that'll fire every three minutes
// add_action('expire_posts', 'expire_posts_function');
// function expire_posts_function() {
//   date_default_timezone_set('US/Eastern');
//   $today = new DateTime(date('Y-m-d'));
//   $today = $today->modify('-1 day');
//   $today = $today->format('Y-m-d');
//   $timezone = date('T');
//   $today = $today . ' 11:59:00 PM ' . $timezone;
//   $args = array(
//     'post_type' => 'events',
//     'posts_per_page' => -1
//   );
//   $events = get_posts($args);
//   foreach ($events as $event) {
//     $id = $event->ID;
//     $start_date = get_post_meta($id, 'event_start_date', true);
//     $end_date = get_post_meta($id, 'event_end_date', true);
//     $start_time = get_post_meta($id, 'event_start_date', true);
//     $end_time = get_post_meta($id, 'event_end_date', true);
//     if ($end_date) {
//       $event_date = date("Y-m-d", strtotime($end_date));
//     } else {
//       $event_date = date("Y-m-d", strtotime($start_date));
//     }
//     if ($end_time) {
//       $event_time = date("h:i:s A T", strtotime($end_time));
//     } elseif ($start_time) {
//       $event_time = date("h:i:s A T", strtotime($start_time));
//     } else {
//       $event_time = date("h:i:s A T", strtotime('12:00 AM'));
//     }
//     $date = $event_date . ' ' . $event_time;
//     if ($date < $today) {
//       $postdata = array(
//         'ID' => $id,
//         'post_status' => 'draft'
//       );
//       wp_update_post($postdata);
//     }
//   }
// }

/*
 * Load ajax script on news template
 */
function enqueue_ajax_load_more() {
  wp_enqueue_script('ajax-load-more'); // Already registered, just needs to be enqueued
}
add_action('wp_enqueue_scripts', 'enqueue_ajax_load_more');

/*
 * Excerpt for pages
 */
add_post_type_support('page', 'excerpt');

/*
 * ACF Options Page
 */
if (function_exists('acf_add_options_page')) {
  acf_add_options_page();
}

/**
 * Populate Payment Select from CPT "product"
 * Values = product IDs (for URL preselect)
 * Amounts = product_price meta
 * Supports form-specific tax queries (4229 exclude digital, 4305 only digital)
 * Preselects choice with ?product_id=### in the URL
 */

/**
 * Helper: Build product choices for payment-select fields
 *
 * @param int $form_id The form ID
 * @param int $preselect_id Optional product ID to preselect
 * @return array Array with 'choices' and 'default_value' keys
 */
function gdhs_build_product_choices($form_id, $preselect_id = 0) {
  // Build tax query per form
  $tax_query = [];
  if ($form_id === 4229) {
    // Exclude digital-download
    $tax_query[] = [
      'taxonomy' => 'product_category',
      'field'    => 'slug',
      'terms'    => ['digital-download'],
      'operator' => 'NOT IN',
    ];
  } elseif ($form_id === 4305) {
    // Only digital-download
    $tax_query[] = [
      'taxonomy' => 'product_category',
      'field'    => 'slug',
      'terms'    => ['digital-download'],
      'operator' => 'IN',
    ];
  }

  // Fetch products
  $query_args = [
    'post_type'      => 'product',
    'posts_per_page' => -1,
    'post_status'    => 'publish',
    'orderby'        => 'title',
    'order'          => 'ASC',
  ];
  if (!empty($tax_query)) {
    $query_args['tax_query'] = $tax_query;
  }
  $products = get_posts($query_args);

  // Build choices - WPForms uses 1-indexed arrays for payment-select
  $choices = [];
  $choice_index = 1;
  $preselected_price = '';

  // Add placeholder option
  $choices[$choice_index] = [
    'label'      => '--- Select a product ---',
    'value'      => '0.00',
    'image'      => '',
    'icon'       => '',
    'icon_style' => ''
  ];
  $choice_index++;

  // Add products
  foreach ($products as $product) {
    $pid   = $product->ID;
    $title = get_the_title($product->ID);
    $price = get_post_meta($product->ID, 'product_price', true);

    // Skip products with no price
    if (empty($price) || $price === '') {
      continue;
    }

    $is_preselected = ($preselect_id && $preselect_id == $pid);

    $choices[$choice_index] = [
      'label'      => $title,
      'value'      => $price,
      'image'      => '',
      'icon'       => '',
      'icon_style' => '',
      'default'    => $is_preselected ? '1' : '',
    ];

    if ($is_preselected) {
      $preselected_price = $price;
    }

    $choice_index++;
  }

  return [
    'choices'       => $choices,
    'default_value' => $preselected_price
  ];
}

/**
 * Populate payment-select fields with product choices (frontend display)
 */
add_filter('wpforms_frontend_form_data', function ($form_data) {
  if (empty($form_data['fields'])) {
    return $form_data;
  }

  $form_id = isset($form_data['id']) ? (int) $form_data['id'] : 0;
  $target_field_ids = ['21', '24', '28'];
  $preselect = isset($_GET['product_id']) ? (int) sanitize_text_field($_GET['product_id']) : 0;

  foreach ($form_data['fields'] as $field_id => $field) {
    $is_target = in_array((string) $field_id, $target_field_ids, true);
    if (!$is_target || empty($field['type']) || $field['type'] !== 'payment-select') {
      continue;
    }

    $result = gdhs_build_product_choices($form_id, $preselect);
    $form_data['fields'][$field_id]['choices'] = $result['choices'];

    if ($result['default_value']) {
      $form_data['fields'][$field_id]['default_value'] = (string) $result['default_value'];
    }
  }

  return $form_data;
}, 5);

/**
 * Populate payment-select fields with product choices (form submission/validation)
 */
add_action('wpforms_process_before', function ($entry, $form_data) {
  $form_id = isset($form_data['id']) ? (int) $form_data['id'] : 0;
  $target_field_ids = ['21', '24', '28'];

  foreach ($form_data['fields'] as $field_id => $field) {
    $is_target = in_array((string) $field_id, $target_field_ids, true);
    if (!$is_target || empty($field['type']) || $field['type'] !== 'payment-select') {
      continue;
    }

    $result = gdhs_build_product_choices($form_id);
    wpforms()->process->form_data['fields'][$field_id]['choices'] = $result['choices'];
  }
}, 5, 2);