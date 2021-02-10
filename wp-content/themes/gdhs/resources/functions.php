<?php

/**
 * Do not edit anything in this file unless you know what you're doing
 */

/**
 * Helper function for prettying up errors
 * @param string $message
 * @param string $subtitle
 * @param string $title
 */
$sage_error = function ($message, $subtitle = '', $title = '') {
    $title = $title ?: __('Sage &rsaquo; Error', 'sage');
    $footer = '<a href="https://roots.io/sage/docs/">roots.io/sage/docs/</a>';
    $message = "<h1>{$title}<br><small>{$subtitle}</small></h1><p>{$message}</p><p>{$footer}</p>";
    wp_die($message, $title);
};

/**
 * Ensure compatible version of PHP is used
 */
if (version_compare('5.6.4', phpversion(), '>=')) {
    $sage_error(__('You must be using PHP 5.6.4 or greater.', 'sage'), __('Invalid PHP version', 'sage'));
}

/**
 * Ensure compatible version of WordPress is used
 */
if (version_compare('4.7.0', get_bloginfo('version'), '>=')) {
    $sage_error(__('You must be using WordPress 4.7.0 or greater.', 'sage'), __('Invalid WordPress version', 'sage'));
}

/**
 * Ensure dependencies are loaded
 */
if (!class_exists('Roots\\Sage\\Container')) {
    if (!file_exists($composer = __DIR__.'/../vendor/autoload.php')) {
        $sage_error(
            __('You must run <code>composer install</code> from the Sage directory.', 'sage'),
            __('Autoloader not found.', 'sage')
        );
    }
    require_once $composer;
}

/**
 * Sage required files
 *
 * The mapped array determines the code library included in your theme.
 * Add or remove files to the array as needed. Supports child theme overrides.
 */
array_map(function ($file) use ($sage_error) {
    $file = "../app/{$file}.php";
    if (!locate_template($file, true, true)) {
        $sage_error(sprintf(__('Error locating <code>%s</code> for inclusion.', 'sage'), $file), 'File not found');
    }
}, ['helpers', 'setup', 'filters', 'admin']);

/**
 * Here's what's happening with these hooks:
 * 1. WordPress initially detects theme in themes/sage/resources
 * 2. Upon activation, we tell WordPress that the theme is actually in themes/sage/resources/views
 * 3. When we call get_template_directory() or get_template_directory_uri(), we point it back to themes/sage/resources
 *
 * We do this so that the Template Hierarchy will look in themes/sage/resources/views for core WordPress themes
 * But functions.php, style.css, and index.php are all still located in themes/sage/resources
 *
 * This is not compatible with the WordPress Customizer theme preview prior to theme activation
 *
 * get_template_directory()   -> /srv/www/example.com/current/web/app/themes/sage/resources
 * get_stylesheet_directory() -> /srv/www/example.com/current/web/app/themes/sage/resources
 * locate_template()
 * ├── STYLESHEETPATH         -> /srv/www/example.com/current/web/app/themes/sage/resources/views
 * └── TEMPLATEPATH           -> /srv/www/example.com/current/web/app/themes/sage/resources
 */
if (is_customize_preview() && isset($_GET['theme'])) {
    $sage_error(__('Theme must be activated prior to using the customizer.', 'sage'));
}
$sage_views = basename(dirname(__DIR__)).'/'.basename(__DIR__).'/views';
add_filter('stylesheet', function () use ($sage_views) {
    return dirname($sage_views);
});
add_filter('stylesheet_directory_uri', function ($uri) {
    return dirname($uri);
});
if ($sage_views !== get_option('stylesheet')) {
    update_option('stylesheet', $sage_views);
    if (php_sapi_name() === 'cli') {
        return;
    }
    wp_redirect($_SERVER['REQUEST_URI']);
    exit();
}

/*
 * Add columns to events post list
 */
function add_acf_columns($columns) {
  return array_merge($columns, array (
    'event_start_date' => 'Event Start Date'
  ));
 }
 add_filter('manage_events_posts_columns', 'add_acf_columns');

/*
 * Add columns to events post list
 */
function events_custom_column($column, $post_id) {
  switch ($column) {
    case 'event_start_date':
    $date = get_post_meta($post_id, 'event_start_date', true);
    echo date("F j, Y g:ia", strtotime($date));
    break;
  }
}
add_action('manage_events_posts_custom_column', 'events_custom_column', 10, 2);

/*
 * Sort event start date column
 */
function my_sortable_events_column($column) {
    $column['event_start_date'] = 'event_start_date';
    return $column;
}
add_filter( 'manage_edit-events_sortable_columns', 'my_sortable_events_column' );

/**
 * Change post status to `Draft` for events that are old
 */

// Add a new interval of 1 seconds
function gdhs_add_seconds($schedules) {
 $schedules['everysecond'] = array(
   'interval' => 60,
   'display' => __('Every Second')
 );
 return $schedules;
}
add_filter('cron_schedules', 'gdhs_add_seconds');

// Schedule an action if it's not already scheduled
if (!wp_next_scheduled('expire_posts') ) {
  wp_schedule_event(time(), 'everysecond', 'expire_posts');
}

// Hook into that action that'll fire every three minutes
add_action('expire_posts', 'expire_posts_function');
function expire_posts_function() {
  date_default_timezone_set('US/Eastern');
  $today = new DateTime(date('Y-m-d'));
  $today = $today->modify('-1 day');
  $today = $today->format('Y-m-d');
  $timezone = date('T');
  $today = $today . ' 11:59:00 PM ' . $timezone;
  $args = array(
    'post_type' => 'events',
    'posts_per_page' => -1
  );
  $events = get_posts($args);
  foreach ($events as $event) {
    $id = $event->ID;
    $start_date = get_post_meta($id, 'event_start_date', true);
    $end_date = get_post_meta($id, 'event_end_date', true);
    $start_time = get_post_meta($id, 'event_start_date', true);
    $end_time = get_post_meta($id, 'event_end_date', true);
    if ($end_date) {
      $event_date = date("Y-m-d", strtotime($end_date));
    } else {
      $event_date = date("Y-m-d", strtotime($start_date));
    }
    if ($end_time) {
      $event_time = date("h:i:s A T", strtotime($end_time));
    } elseif ($start_time) {
      $event_time = date("h:i:s A T", strtotime($start_time));
    } else {
      $event_time = date("h:i:s A T", strtotime('12:00 AM'));
    }
    $date = $event_date . ' ' . $event_time;
    if ($date < $today) {
      $postdata = array(
        'ID' => $id,
        'post_status' => 'draft'
      );
      wp_update_post($postdata);
    }
  }
}

/**
 * Load ajax script on news template
 */
function enqueue_ajax_load_more() {
   wp_enqueue_script('ajax-load-more'); // Already registered, just needs to be enqueued
}
add_action('wp_enqueue_scripts', 'enqueue_ajax_load_more');

/**
 * Allow SVG's through WP media uploader
 */
function cc_mime_types($mimes) {
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');

/**
 * Excerpt for pages
 */
add_post_type_support( 'page', 'excerpt' );

/**
 * ALPS Gutenberg Blocks
 */

// Remove colors and text styles from Gutenberg
add_theme_support('disable-custom-colors');
add_theme_support('editor-color-palette');
add_theme_support('editor-text-styles');
add_theme_support('wp-block-styles');

// Only allow the following blocks in Gutenberg
add_filter('allowed_block_types', function () {
  return [
    'core/heading',
    'core/image',
    'core/block',
    'core/embed',
    'core/spacer',
    'core/buttons',
    'core/list',
    'core/shortcode',
    'core/video',
    'core/html',
    'core/embed',
    'core/paragraph',
    'core/separator',
    'core/quote',
    'core/table',
    'acf/gallery',
  ];
});

/**
 * ACF Options Page
 */
if( function_exists('acf_add_options_page') ) {
  acf_add_options_page();
}

/**
 * Custom fields
 */
function cptui_register_my_cpts() {

  /**
   * Post Type: Events.
   */
  $event_labels = array(
    "name" => __( 'Events', 'sage' ),
    "singular_name" => __( 'Event', 'sage' ),
    "menu_name" => __( 'Events', 'sage' ),
    "all_items" => __( 'All Events', 'sage' ),
    "add_new" => __( 'Add New Event', 'sage' ),
    "edit_item" => __( 'Edit Event', 'sage' ),
    "new_item" => __( 'New Event', 'sage' ),
    "view_item" => __( 'View Event', 'sage' ),
    "view_items" => __( 'View Events', 'sage' ),
    "search_items" => __( 'Search Events', 'sage' ),
    "not_found" => __( 'No Events Found', 'sage' ),
    "not_found_in_trash" => __( 'No Events found in Trash', 'sage' ),
  );

  $event_args = array(
    "label" => __( 'Events', 'sage' ),
    "labels" => $event_labels,
    "description" => "GDHS Events",
    "public" => true,
    "publicly_queryable" => true,
    "show_ui" => true,
    "show_in_rest" => false,
    "rest_base" => "",
    "show_in_menu" => true,
    "exclude_from_search" => false,
    "capability_type" => "post",
    "hierarchical" => true,
    "rewrite" => array( "slug" => "event", "with_front" => true ),
    'has_archive' => false,
    "query_var" => true,
    "menu_position" => 4,
    "menu_icon" => "dashicons-calendar-alt",
    "supports" => array( "title", "editor", "thumbnail", "excerpt", "author")
  );

  register_post_type( "events", $event_args );

  /**
   * Post Type: Exhibitions.
   */
  $exhibit_labels = array(
    "name" => __( 'Exhibitions', 'sage' ),
    "singular_name" => __( 'Exhibition', 'sage' ),
    "menu_name" => __( 'Exhibitions', 'sage' ),
    "all_items" => __( 'All Exhibitions', 'sage' ),
    "add_new" => __( 'Add New Exhibition', 'sage' ),
    "edit_item" => __( 'Edit Exhibition', 'sage' ),
    "new_item" => __( 'New Exhibition', 'sage' ),
    "view_item" => __( 'View Exhibition', 'sage' ),
    "view_items" => __( 'View Exhibitions', 'sage' ),
    "search_items" => __( 'Search Exhibitions', 'sage' ),
    "not_found" => __( 'No Exhibitions Found', 'sage' ),
    "not_found_in_trash" => __( 'No Exhibitions found in Trash', 'sage' ),
  );

  $exhibit_args = array(
    "label" => __( 'Exhibitions', 'sage' ),
    "labels" => $exhibit_labels,
    "description" => "GDHS Exhibitions",
    "public" => true,
    "publicly_queryable" => true,
    "show_ui" => true,
    "show_in_rest" => false,
    "rest_base" => "",
    "show_in_menu" => true,
    "exclude_from_search" => false,
    "capability_type" => "post",
    "hierarchical" => true,
    "rewrite" => array( "slug" => "exhibition", "with_front" => true ),
    'has_archive' => false,
    "query_var" => true,
    "menu_position" => 5,
    "menu_icon" => "dashicons-format-gallery",
    "supports" => array( "title", "editor", "thumbnail", "excerpt", "author")
  );

  register_post_type( "exhibit", $exhibit_args );

  /**
   * Post Type: Research Library.
   */
  $research_labels = array(
    "name" => __( 'Research Library', 'sage' ),
    "singular_name" => __( 'Research Library', 'sage' ),
    "menu_name" => __( 'Research Library', 'sage' ),
    "all_items" => __( 'All Items', 'sage' ),
    "add_new" => __( 'Add New Item', 'sage' ),
    "edit_item" => __( 'Edit Item', 'sage' ),
    "new_item" => __( 'New Item', 'sage' ),
    "view_item" => __( 'View Item', 'sage' ),
    "view_items" => __( 'View Items', 'sage' ),
    "search_items" => __( 'Search Items', 'sage' ),
    "not_found" => __( 'No Items Found', 'sage' ),
    "not_found_in_trash" => __( 'No Items found in Trash', 'sage' ),
  );

  $research_args = array(
    "label" => __( 'Research Library', 'sage' ),
    "labels" => $research_labels,
    "description" => "GDHS Research Library",
    "public" => true,
    "publicly_queryable" => true,
    "show_ui" => true,
    "show_in_rest" => false,
    "rest_base" => "",
    "show_in_menu" => true,
    "exclude_from_search" => false,
    "capability_type" => "post",
    "hierarchical" => true,
    "rewrite" => array( "slug" => "library", "with_front" => true ),
    'has_archive' => false,
    "query_var" => true,
    "menu_position" => 5,
    "menu_icon" => "dashicons-book-alt",
    "supports" => array( "title", "editor", "thumbnail", "excerpt", "author")
  );

  register_post_type( "library", $research_args );

  /**
   * Post Type: Products.
   */
  $product_labels = array(
    "name" => __( 'Product', 'sage' ),
    "singular_name" => __( 'Product', 'sage' ),
    "menu_name" => __( 'Products', 'sage' ),
    "all_items" => __( 'All Products', 'sage' ),
    "add_new" => __( 'Add New Product', 'sage' ),
    "edit_item" => __( 'Edit Product', 'sage' ),
    "new_item" => __( 'New Product', 'sage' ),
    "view_item" => __( 'View Product', 'sage' ),
    "view_items" => __( 'View Products', 'sage' ),
    "search_items" => __( 'Search Products', 'sage' ),
    "not_found" => __( 'No Products Found', 'sage' ),
    "not_found_in_trash" => __( 'No Products found in Trash', 'sage' ),
  );

  $product_args = array(
    "label" => __( 'Products', 'sage' ),
    "labels" => $product_labels,
    "description" => "GDHS Products",
    "public" => true,
    "publicly_queryable" => true,
    "show_ui" => true,
    "show_in_rest" => false,
    "rest_base" => "",
    "show_in_menu" => true,
    "exclude_from_search" => false,
    "capability_type" => "post",
    "hierarchical" => true,
    "rewrite" => array( "slug" => "product", "with_front" => true ),
    'has_archive' => false,
    "query_var" => true,
    "menu_position" => 5,
    "menu_icon" => "dashicons-cart",
    "supports" => array( "title", "editor", "thumbnail", "excerpt", "author")
  );

  register_post_type( "product", $product_args );
}
add_action( 'init', 'cptui_register_my_cpts' );

/**
 * Custom taxonomy
 */
function cptui_register_my_taxes() {

  /**
   * Taxonomy: Event Category.
   */

  $event_cat_labels = array(
    "name" => __( 'Event Category', 'sage' ),
    "singular_name" => __( 'Event Category', 'sage' ),
    "menu_name" => __( 'Event Categories', 'sage' ),
    "all_items" => __( 'All Event Categories', 'sage' ),
    "edit_item" => __( 'Edit Event Categories', 'sage' ),
    "view_item" => __( 'View Event Categories', 'sage' ),
    "update_item" => __( 'Update Event Categories', 'sage' ),
    "add_new_item" => __( 'Add New Event Category', 'sage' ),
    "new_item_name" => __( 'New Event Category', 'sage' ),
    "search_items" => __( 'Search Event Categories', 'sage' ),
    "popular_items" => __( 'Popular Event Categories', 'sage' ),
    "add_or_remove_items" => __( 'Add or Remove Event Categories', 'sage' ),
    "choose_from_most_used" => __( 'Choose from the most used Event Categories', 'sage' ),
    "not_found" => __( 'No Event Categories Found', 'sage' ),
    "items_list" => __( 'Event Categories List', 'sage' ),
  );

  $event_cat_args = array(
    "label" => __( 'Category', 'sage' ),
    "labels" => $event_cat_labels,
    "public" => true,
    "hierarchical" => true,
    "label" => "Event Categories",
    "show_ui" => true,
    "show_in_menu" => true,
    "show_in_nav_menus" => true,
    "query_var" => true,
    "rewrite" => array( "slug" => "event_category", "with_front" => false ),
    "has_archive" => false,
    "show_admin_column" => true,
    "show_in_rest" => false,
    "rest_base" => "",
    "show_in_quick_edit" => true,
  );
  register_taxonomy( "event_category", array( "events" ), $event_cat_args );

  /**
   * Taxonomy: Exhibition Category.
   */

  $exhibit_cat_labels = array(
    "name" => __( 'Exhibition Category', 'sage' ),
    "singular_name" => __( 'Exhibition Category', 'sage' ),
    "menu_name" => __( 'Exhibition Categories', 'sage' ),
    "all_items" => __( 'All Exhibition Categories', 'sage' ),
    "edit_item" => __( 'Edit Exhibition Categories', 'sage' ),
    "view_item" => __( 'View Exhibition Categories', 'sage' ),
    "update_item" => __( 'Update Exhibition Categories', 'sage' ),
    "add_new_item" => __( 'Add New Exhibition Category', 'sage' ),
    "new_item_name" => __( 'New Exhibition Category', 'sage' ),
    "search_items" => __( 'Search Exhibition Categories', 'sage' ),
    "popular_items" => __( 'Popular Exhibition Categories', 'sage' ),
    "add_or_remove_items" => __( 'Add or Remove Exhibition Categories', 'sage' ),
    "choose_from_most_used" => __( 'Choose from the most used Exhibition Categories', 'sage' ),
    "not_found" => __( 'No Exhibition Categories Found', 'sage' ),
    "items_list" => __( 'Exhibition Categories List', 'sage' ),
  );

  $exhibit_cat_args = array(
    "label" => __( 'Category', 'sage' ),
    "labels" => $exhibit_cat_labels,
    "public" => true,
    "hierarchical" => true,
    "label" => "Exhibition Categories",
    "show_ui" => true,
    "show_in_menu" => true,
    "show_in_nav_menus" => true,
    "query_var" => true,
    "rewrite" => array( "slug" => "exhibit_category", "with_front" => false ),
    "has_archive" => false,
    "show_admin_column" => true,
    "show_in_rest" => false,
    "rest_base" => "",
    "show_in_quick_edit" => true,
  );
  register_taxonomy( "exhibit_category", array( "exhibit" ), $exhibit_cat_args );

  /**
   * Taxonomy: Research Library Category.
   */

  $research_cat_labels = array(
    "name" => __( 'Library Category', 'sage' ),
    "singular_name" => __( 'Library Category', 'sage' ),
    "menu_name" => __( 'Library Categories', 'sage' ),
    "all_items" => __( 'All Library Categories', 'sage' ),
    "edit_item" => __( 'Edit Library Categories', 'sage' ),
    "view_item" => __( 'View Library Categories', 'sage' ),
    "update_item" => __( 'Update Library Categories', 'sage' ),
    "add_new_item" => __( 'Add New Library Category', 'sage' ),
    "new_item_name" => __( 'New Library Category', 'sage' ),
    "search_items" => __( 'Search Library Categories', 'sage' ),
    "popular_items" => __( 'Popular Library Categories', 'sage' ),
    "add_or_remove_items" => __( 'Add or Remove Library Categories', 'sage' ),
    "choose_from_most_used" => __( 'Choose from the most used Library Categories', 'sage' ),
    "not_found" => __( 'No Library Categories Found', 'sage' ),
    "items_list" => __( 'Library Categories List', 'sage' ),
  );

  $research_cat_args = array(
    "label" => __( 'Category', 'sage' ),
    "labels" => $research_cat_labels,
    "public" => true,
    "hierarchical" => true,
    "label" => "Library Categories",
    "show_ui" => true,
    "show_in_menu" => true,
    "show_in_nav_menus" => true,
    "query_var" => true,
    "rewrite" => array( "slug" => "library_category", "with_front" => false ),
    "has_archive" => false,
    "show_admin_column" => true,
    "show_in_rest" => false,
    "rest_base" => "",
    "show_in_quick_edit" => true,
  );
  register_taxonomy( "library_category", array( "library" ), $research_cat_args );

  /**
   * Taxonomy: Product Category.
   */

  $product_cat_labels = array(
    "name" => __( 'Product Category', 'sage' ),
    "singular_name" => __( 'Product Category', 'sage' ),
    "menu_name" => __( 'Product Categories', 'sage' ),
    "all_items" => __( 'All Product Categories', 'sage' ),
    "edit_item" => __( 'Edit Product Categories', 'sage' ),
    "view_item" => __( 'View Product Categories', 'sage' ),
    "update_item" => __( 'Update Product Categories', 'sage' ),
    "add_new_item" => __( 'Add New Product Category', 'sage' ),
    "new_item_name" => __( 'New Product Category', 'sage' ),
    "search_items" => __( 'Search Product Categories', 'sage' ),
    "popular_items" => __( 'Popular Product Categories', 'sage' ),
    "add_or_remove_items" => __( 'Add or Remove Product Categories', 'sage' ),
    "choose_from_most_used" => __( 'Choose from the most used Product Categories', 'sage' ),
    "not_found" => __( 'No Product Categories Found', 'sage' ),
    "items_list" => __( 'Exhibition Categories List', 'sage' ),
  );

  $product_cat_args = array(
    "label" => __( 'Category', 'sage' ),
    "labels" => $product_cat_labels,
    "public" => true,
    "hierarchical" => true,
    "label" => "Product Categories",
    "show_ui" => true,
    "show_in_menu" => true,
    "show_in_nav_menus" => true,
    "query_var" => true,
    "rewrite" => array( "slug" => "product_category", "with_front" => false ),
    "has_archive" => false,
    "show_admin_column" => true,
    "show_in_rest" => false,
    "rest_base" => "",
    "show_in_quick_edit" => true,
  );
  register_taxonomy( "product_category", array( "product" ), $product_cat_args );
}
add_action( 'init', 'cptui_register_my_taxes' );
if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array (
  'key' => 'group_5a8eb7d3bf43f',
  'title' => 'Blocks',
  'fields' => array (
    array (
      'key' => 'field_5a8eb7d7d3970',
      'label' => 'Block',
      'name' => 'block',
      'type' => 'repeater',
      'instructions' => '',
      'required' => 0,
      'conditional_logic' => 0,
      'wrapper' => array (
        'width' => '',
        'class' => '',
        'id' => '',
      ),
      'collapsed' => 'field_5a8eb7e1d3971',
      'min' => '',
      'max' => '',
      'layout' => 'block',
      'button_label' => 'Add Block',
      'sub_fields' => array (
        array (
          'key' => 'field_5a8eb7e1d3971',
          'label' => 'Block Title',
          'name' => 'block_title',
          'type' => 'text',
          'instructions' => '',
          'required' => 0,
          'conditional_logic' => 0,
          'wrapper' => array (
            'width' => '',
            'class' => '',
            'id' => '',
          ),
          'default_value' => '',
          'placeholder' => '',
          'prepend' => '',
          'append' => '',
          'maxlength' => '',
          'readonly' => 0,
          'disabled' => 0,
        ),
        array (
          'key' => 'field_5a8eb7e7d3972',
          'label' => 'Block Description',
          'name' => 'block_description',
          'type' => 'textarea',
          'instructions' => '',
          'required' => 0,
          'conditional_logic' => 0,
          'wrapper' => array (
            'width' => '',
            'class' => '',
            'id' => '',
          ),
          'default_value' => '',
          'placeholder' => '',
          'maxlength' => '',
          'rows' => '',
          'new_lines' => 'wpautop',
          'readonly' => 0,
          'disabled' => 0,
        ),
        array (
          'key' => 'field_5a8eb7f1d3973',
          'label' => 'Block Url',
          'name' => 'block_url',
          'type' => 'url',
          'instructions' => '',
          'required' => 0,
          'conditional_logic' => 0,
          'wrapper' => array (
            'width' => '',
            'class' => '',
            'id' => '',
          ),
          'default_value' => '',
          'placeholder' => '',
        ),
        array (
          'key' => 'field_5a8eb832d3974',
          'label' => 'Block Image',
          'name' => 'block_image',
          'type' => 'image',
          'instructions' => '',
          'required' => 0,
          'conditional_logic' => 0,
          'wrapper' => array (
            'width' => '',
            'class' => '',
            'id' => '',
          ),
          'return_format' => 'array',
          'preview_size' => 'thumbnail',
          'library' => 'all',
          'min_width' => '',
          'min_height' => '',
          'min_size' => '',
          'max_width' => '',
          'max_height' => '',
          'max_size' => '',
          'mime_types' => '',
        ),
      ),
    ),
  ),
  'location' => array (
    array (
      array (
        'param' => 'page_template',
        'operator' => '==',
        'value' => 'views/template-blocks.blade.php',
      ),
    ),
    array (
      array (
        'param' => 'post_type',
        'operator' => '==',
        'value' => 'post',
      ),
    ),
  ),
  'menu_order' => 0,
  'position' => 'normal',
  'style' => 'default',
  'label_placement' => 'top',
  'instruction_placement' => 'label',
  'hide_on_screen' => '',
  'active' => 1,
  'description' => '',
));

acf_add_local_field_group(array (
  'key' => 'group_5a67d4f2a0366',
  'title' => 'Event Details',
  'fields' => array (
    array (
      'key' => 'field_5a67d4fab9476',
      'label' => 'Event Start Date',
      'name' => 'event_start_date',
      'type' => 'date_time_picker',
      'instructions' => 'Enter the start date and time for the event.',
      'required' => 1,
      'conditional_logic' => 0,
      'wrapper' => array (
        'width' => 50,
        'class' => '',
        'id' => '',
      ),
      'display_format' => 'F j, Y g:i a',
      'return_format' => 'Y-m-d H:i:s',
      'first_day' => 0,
    ),
    array (
      'key' => 'field_5a67d53ab9477',
      'label' => 'Event End Date',
      'name' => 'event_end_date',
      'type' => 'date_time_picker',
      'instructions' => 'Enter the end date and time for the event.',
      'required' => 0,
      'conditional_logic' => 0,
      'wrapper' => array (
        'width' => 50,
        'class' => '',
        'id' => '',
      ),
      'display_format' => 'F j, Y g:i a',
      'return_format' => 'Y-m-d H:i:s',
      'first_day' => 0,
    ),
    array (
      'key' => 'field_5a67d5c2ab1d3',
      'label' => 'Event Location',
      'name' => 'event_location',
      'type' => 'text',
      'instructions' => 'Enter the location for the event.',
      'required' => 0,
      'conditional_logic' => 0,
      'wrapper' => array (
        'width' => '',
        'class' => '',
        'id' => '',
      ),
      'default_value' => '',
      'placeholder' => '',
      'prepend' => '',
      'append' => '',
      'maxlength' => '',
      'readonly' => 0,
      'disabled' => 0,
    ),
    array (
      'key' => 'field_5a691f05ec4a2',
      'label' => 'Disable Link',
      'name' => 'disable_link',
      'type' => 'true_false',
      'instructions' => 'Check to prevent the event block from linking to the detail page.',
      'required' => 0,
      'conditional_logic' => 0,
      'wrapper' => array (
        'width' => '',
        'class' => '',
        'id' => '',
      ),
      'message' => '',
      'default_value' => 0,
    ),
  ),
  'location' => array (
    array (
      array (
        'param' => 'post_type',
        'operator' => '==',
        'value' => 'events',
      ),
    ),
  ),
  'menu_order' => 0,
  'position' => 'normal',
  'style' => 'default',
  'label_placement' => 'top',
  'instruction_placement' => 'label',
  'hide_on_screen' => '',
  'active' => 1,
  'description' => '',
));

acf_add_local_field_group(array (
  'key' => 'group_5a692fc072e31',
  'title' => 'Featured Pages',
  'fields' => array (
    array (
      'key' => 'field_5a692fe1be2bc',
      'label' => 'Featured Pages',
      'name' => 'featured_pages',
      'type' => 'relationship',
      'instructions' => '',
      'required' => 0,
      'conditional_logic' => 0,
      'wrapper' => array (
        'width' => '',
        'class' => '',
        'id' => '',
      ),
      'post_type' => array (
        0 => 'page',
      ),
      'taxonomy' => array (
      ),
      'filters' => array (
        0 => 'search',
      ),
      'elements' => array (
        0 => 'featured_image',
      ),
      'min' => 3,
      'max' => 3,
      'return_format' => 'object',
    ),
  ),
  'location' => array (
    array (
      array (
        'param' => 'page_type',
        'operator' => '==',
        'value' => 'front_page',
      ),
    ),
    array (
      array (
        'param' => 'page_template',
        'operator' => '==',
        'value' => 'views/template-landing.blade.php',
      ),
    ),
  ),
  'menu_order' => 0,
  'position' => 'normal',
  'style' => 'default',
  'label_placement' => 'top',
  'instruction_placement' => 'label',
  'hide_on_screen' => '',
  'active' => 1,
  'description' => '',
));

acf_add_local_field_group(array (
  'key' => 'group_5a4c2d649d5b9',
  'title' => 'Footer Settings',
  'fields' => array (
    array (
      'key' => 'field_5a4c2d71a9a93',
      'label' => 'Footer Annual Report',
      'name' => 'footer_annual_report',
      'type' => 'url',
      'instructions' => 'Enter the link to the current annual report.',
      'required' => 0,
      'conditional_logic' => 0,
      'wrapper' => array (
        'width' => '',
        'class' => '',
        'id' => '',
      ),
      'default_value' => '',
      'placeholder' => '',
    ),
  ),
  'location' => array (
    array (
      array (
        'param' => 'options_page',
        'operator' => '==',
        'value' => 'acf-options',
      ),
    ),
  ),
  'menu_order' => 0,
  'position' => 'normal',
  'style' => 'default',
  'label_placement' => 'top',
  'instruction_placement' => 'label',
  'hide_on_screen' => '',
  'active' => 1,
  'description' => '',
));

acf_add_local_field_group(array (
  'key' => 'group_5a7260af5bd35',
  'title' => 'Gallery',
  'fields' => array (
    array (
      'key' => 'field_5a7260b27d5a3',
      'label' => 'Gallery',
      'name' => 'gallery',
      'type' => 'gallery',
      'instructions' => 'Upload images for the gallery.',
      'required' => 0,
      'conditional_logic' => 0,
      'wrapper' => array (
        'width' => '',
        'class' => '',
        'id' => '',
      ),
      'min' => '',
      'max' => '',
      'preview_size' => 'thumbnail',
      'insert' => 'append',
      'library' => 'all',
      'min_width' => '',
      'min_height' => '',
      'min_size' => '',
      'max_width' => '',
      'max_height' => '',
      'max_size' => '',
      'mime_types' => '',
    ),
  ),
  'location' => array (
    array (
      array (
        'param' => 'page',
        'operator' => '==',
        'value' => '31',
      ),
    ),
  ),
  'menu_order' => 0,
  'position' => 'normal',
  'style' => 'default',
  'label_placement' => 'top',
  'instruction_placement' => 'label',
  'hide_on_screen' => '',
  'active' => 1,
  'description' => '',
));

acf_add_local_field_group(array (
  'key' => 'group_5a5a69c76e814',
  'title' => 'Page Settings',
  'fields' => array (
    array (
      'key' => 'field_5a5a69d16e55b',
      'label' => 'Display Title',
      'name' => 'display_title',
      'type' => 'text',
      'instructions' => 'Title to display in place of the default page title.',
      'required' => 0,
      'conditional_logic' => 0,
      'wrapper' => array (
        'width' => '',
        'class' => '',
        'id' => '',
      ),
      'default_value' => '',
      'placeholder' => '',
      'prepend' => '',
      'append' => '',
      'maxlength' => '',
      'readonly' => 0,
      'disabled' => 0,
    ),
    array (
      'key' => 'field_5a5a69d76e55c',
      'label' => 'Intro',
      'name' => 'intro',
      'type' => 'textarea',
      'instructions' => 'Short introduction blurb for the page.',
      'required' => 0,
      'conditional_logic' => 0,
      'wrapper' => array (
        'width' => '',
        'class' => '',
        'id' => '',
      ),
      'default_value' => '',
      'placeholder' => '',
      'maxlength' => '',
      'rows' => '',
      'new_lines' => '',
      'readonly' => 0,
      'disabled' => 0,
    ),
    array (
      'key' => 'field_5a5a69e96e55d',
      'label' => 'CTA Link',
      'name' => 'cta_link',
      'type' => 'url',
      'instructions' => 'Enter the url for the CTA link. (This link displays below the introduction blurb)',
      'required' => 0,
      'conditional_logic' => 0,
      'wrapper' => array (
        'width' => '',
        'class' => '',
        'id' => '',
      ),
      'default_value' => '',
      'placeholder' => '',
    ),
    array (
      'key' => 'field_5a5a6a646e55e',
      'label' => 'CTA Text',
      'name' => 'cta_text',
      'type' => 'text',
      'instructions' => 'Enter text for the CTA link.',
      'required' => 0,
      'conditional_logic' => 0,
      'wrapper' => array (
        'width' => '',
        'class' => '',
        'id' => '',
      ),
      'default_value' => '',
      'placeholder' => '',
      'prepend' => '',
      'append' => '',
      'maxlength' => '',
      'readonly' => 0,
      'disabled' => 0,
    ),
    array (
      'key' => 'field_5a6fcfcbd9a81',
      'label' => 'Hide Featured Image',
      'name' => 'hide_featured_image',
      'type' => 'true_false',
      'instructions' => 'Check to hide the featured image from displaying on the page.',
      'required' => 0,
      'conditional_logic' => 0,
      'wrapper' => array (
        'width' => '',
        'class' => '',
        'id' => '',
      ),
      'message' => '',
      'default_value' => 0,
    ),
  ),
  'location' => array (
    array (
      array (
        'param' => 'post_type',
        'operator' => '==',
        'value' => 'page',
      ),
    ),
  ),
  'menu_order' => 0,
  'position' => 'normal',
  'style' => 'default',
  'label_placement' => 'top',
  'instruction_placement' => 'label',
  'hide_on_screen' => '',
  'active' => 1,
  'description' => '',
));

acf_add_local_field_group(array (
  'key' => 'group_5a6f9f9fce34f',
  'title' => 'Shop Settings',
  'fields' => array (
    array (
      'key' => 'field_5a6fa078dcf9e',
      'label' => 'Product Subtitle',
      'name' => 'product_subtitle',
      'type' => 'text',
      'instructions' => 'Displays below the title. Enter the publishing information on the product or just supporting text.',
      'required' => 0,
      'conditional_logic' => 0,
      'wrapper' => array (
        'width' => '',
        'class' => '',
        'id' => '',
      ),
      'default_value' => '',
      'placeholder' => '',
      'prepend' => '',
      'append' => '',
      'maxlength' => '',
      'readonly' => 0,
      'disabled' => 0,
    ),
    array (
      'key' => 'field_5a6f9ff3dcf9b',
      'label' => 'Product Details',
      'name' => 'product_details',
      'type' => 'repeater',
      'instructions' => 'Enter the details for the product. Each item will in a bulleted list.',
      'required' => 0,
      'conditional_logic' => 0,
      'wrapper' => array (
        'width' => '',
        'class' => '',
        'id' => '',
      ),
      'collapsed' => '',
      'min' => '',
      'max' => '',
      'layout' => 'table',
      'button_label' => 'Add Row',
      'sub_fields' => array (
        array (
          'key' => 'field_5a6fa01edcf9c',
          'label' => 'Product Detail',
          'name' => 'product_detail',
          'type' => 'text',
          'instructions' => '',
          'required' => 0,
          'conditional_logic' => 0,
          'wrapper' => array (
            'width' => '',
            'class' => '',
            'id' => '',
          ),
          'default_value' => '',
          'placeholder' => '',
          'prepend' => '',
          'append' => '',
          'maxlength' => '',
          'readonly' => 0,
          'disabled' => 0,
        ),
      ),
    ),
    array (
      'key' => 'field_5a6fa038dcf9d',
      'label' => 'Product Gallery',
      'name' => 'product_gallery',
      'type' => 'gallery',
      'instructions' => 'Upload Images to display as a slideshow for the product. If no images are uploaded, the image will default to the `Featured Image`',
      'required' => 0,
      'conditional_logic' => 0,
      'wrapper' => array (
        'width' => '',
        'class' => '',
        'id' => '',
      ),
      'min' => '',
      'max' => '',
      'preview_size' => 'thumbnail',
      'insert' => 'append',
      'library' => 'all',
      'min_width' => '',
      'min_height' => '',
      'min_size' => '',
      'max_width' => '',
      'max_height' => '',
      'max_size' => '',
      'mime_types' => '',
    ),
    array (
      'key' => 'field_5a6f9fcbdcf9a',
      'label' => 'PDF Download',
      'name' => 'pdf_download',
      'type' => 'file',
      'instructions' => 'Upload a PDF file of the product\'s order form.',
      'required' => 0,
      'conditional_logic' => 0,
      'wrapper' => array (
        'width' => '',
        'class' => '',
        'id' => '',
      ),
      'return_format' => 'array',
      'library' => 'all',
      'min_size' => '',
      'max_size' => '',
      'mime_types' => '',
    ),
    array (
      'key' => 'field_5a6f9fabdcf99',
      'label' => 'Paypal Link',
      'name' => 'paypal_link',
      'type' => 'url',
      'instructions' => 'Enter the url for the paypal button.',
      'required' => 0,
      'conditional_logic' => 0,
      'wrapper' => array (
        'width' => '',
        'class' => '',
        'id' => '',
      ),
      'default_value' => '',
      'placeholder' => '',
    ),
  ),
  'location' => array (
    array (
      array (
        'param' => 'post_type',
        'operator' => '==',
        'value' => 'product',
      ),
    ),
  ),
  'menu_order' => 0,
  'position' => 'normal',
  'style' => 'default',
  'label_placement' => 'top',
  'instruction_placement' => 'label',
  'hide_on_screen' => '',
  'active' => 1,
  'description' => '',
));

acf_add_local_field_group(array (
  'key' => 'group_5a5a6aaee3d6e',
  'title' => 'Slideshow Settings',
  'fields' => array (
    array (
      'key' => 'field_5a5a6ab4e7990',
      'label' => 'Slideshow Slides',
      'name' => 'slideshow',
      'type' => 'repeater',
      'instructions' => 'Add slides to appear in the homepage slideshow.',
      'required' => 0,
      'conditional_logic' => 0,
      'wrapper' => array (
        'width' => '',
        'class' => '',
        'id' => '',
      ),
      'collapsed' => 'field_5a5a6ac3e7991',
      'min' => '',
      'max' => '',
      'layout' => 'block',
      'button_label' => 'Add Slide',
      'sub_fields' => array (
        array (
          'key' => 'field_5a5a6ac3e7991',
          'label' => 'Slideshow Image',
          'name' => 'slideshow_image',
          'type' => 'image',
          'instructions' => 'Upload the slide image.',
          'required' => 0,
          'conditional_logic' => 0,
          'wrapper' => array (
            'width' => '',
            'class' => '',
            'id' => '',
          ),
          'return_format' => 'array',
          'preview_size' => 'thumbnail',
          'library' => 'all',
          'min_width' => 1200,
          'min_height' => '',
          'min_size' => '',
          'max_width' => '',
          'max_height' => '',
          'max_size' => '',
          'mime_types' => '',
        ),
        array (
          'key' => 'field_5a5a6ae2e7992',
          'label' => 'Slideshow Title',
          'name' => 'slideshow_title',
          'type' => 'text',
          'instructions' => 'Enter a slide title.',
          'required' => 0,
          'conditional_logic' => 0,
          'wrapper' => array (
            'width' => '',
            'class' => '',
            'id' => '',
          ),
          'default_value' => '',
          'placeholder' => '',
          'prepend' => '',
          'append' => '',
          'maxlength' => '',
          'readonly' => 0,
          'disabled' => 0,
        ),
        array (
          'key' => 'field_5a5a6afce7993',
          'label' => 'Slideshow Description',
          'name' => 'slideshow_description',
          'type' => 'textarea',
          'instructions' => 'Enter a hero description.',
          'required' => 0,
          'conditional_logic' => 0,
          'wrapper' => array (
            'width' => '',
            'class' => '',
            'id' => '',
          ),
          'default_value' => '',
          'placeholder' => '',
          'maxlength' => '',
          'rows' => '',
          'new_lines' => 'wpautop',
          'readonly' => 0,
          'disabled' => 0,
        ),
        array (
          'key' => 'field_5a5a6b15e7994',
          'label' => 'Slideshow CTA Link',
          'name' => 'slideshow_cta_link',
          'type' => 'url',
          'instructions' => 'Enter a url for the slide to link to.',
          'required' => 0,
          'conditional_logic' => 0,
          'wrapper' => array (
            'width' => '',
            'class' => '',
            'id' => '',
          ),
          'default_value' => '',
          'placeholder' => '',
        ),
        array (
          'key' => 'field_5a5a6b2ae7995',
          'label' => 'Slideshow CTA Text',
          'name' => 'slideshow_cta_text',
          'type' => 'text',
          'instructions' => 'Enter text to display for the link. (Defaults to \'Learn More\')',
          'required' => 0,
          'conditional_logic' => 0,
          'wrapper' => array (
            'width' => '',
            'class' => '',
            'id' => '',
          ),
          'default_value' => '',
          'placeholder' => '',
          'prepend' => '',
          'append' => '',
          'maxlength' => '',
          'readonly' => 0,
          'disabled' => 0,
        ),
      ),
    ),
  ),
  'location' => array (
    array (
      array (
        'param' => 'page_type',
        'operator' => '==',
        'value' => 'front_page',
      ),
    ),
  ),
  'menu_order' => 0,
  'position' => 'normal',
  'style' => 'default',
  'label_placement' => 'top',
  'instruction_placement' => 'label',
  'hide_on_screen' => '',
  'active' => 1,
  'description' => '',
));

acf_add_local_field_group(array (
  'key' => 'group_5abae0be304a0',
  'title' => 'Hide Author',
  'fields' => array (
    array (
      'key' => 'field_5abae0c8ddc6d',
      'label' => 'Hide Author',
      'name' => 'hide_author',
      'type' => 'true_false',
      'instructions' => 'Check to hide the author from displaying on the page.',
      'required' => 0,
      'conditional_logic' => 0,
      'wrapper' => array (
        'width' => '',
        'class' => '',
        'id' => '',
      ),
      'message' => '',
      'default_value' => 0,
    ),
  ),
  'location' => array (
    array (
      array (
        'param' => 'post_type',
        'operator' => '==',
        'value' => 'post',
      ),
    ),
    array (
      array (
        'param' => 'post_type',
        'operator' => '==',
        'value' => 'exhibit',
      ),
    ),
    array (
      array (
        'param' => 'post_type',
        'operator' => '==',
        'value' => 'library',
      ),
    ),
  ),
  'menu_order' => 0,
  'position' => 'side',
  'style' => 'default',
  'label_placement' => 'top',
  'instruction_placement' => 'label',
  'hide_on_screen' => '',
  'active' => 1,
  'description' => '',
));

acf_add_local_field_group(array (
  'key' => 'group_5ac0f3ab01971',
  'title' => 'Hide Dropcap',
  'fields' => array (
    array (
      'key' => 'field_5ac0f3b5f5c18',
      'label' => 'Hide Dropcap',
      'name' => 'hide_dropcap',
      'type' => 'true_false',
      'instructions' => 'Check to hide the dropcap from displaying in the text area.',
      'required' => 0,
      'conditional_logic' => 0,
      'wrapper' => array (
        'width' => '',
        'class' => '',
        'id' => '',
      ),
      'message' => '',
      'default_value' => 0,
    ),
  ),
  'location' => array (
    array (
      array (
        'param' => 'post_type',
        'operator' => '==',
        'value' => 'page',
      ),
    ),
    array (
      array (
        'param' => 'post_type',
        'operator' => '==',
        'value' => 'post',
      ),
    ),
    array (
      array (
        'param' => 'post_type',
        'operator' => '==',
        'value' => 'events',
      ),
    ),
    array (
      array (
        'param' => 'post_type',
        'operator' => '==',
        'value' => 'library',
      ),
    ),
    array (
      array (
        'param' => 'post_type',
        'operator' => '==',
        'value' => 'exhibit',
      ),
    ),
  ),
  'menu_order' => 0,
  'position' => 'side',
  'style' => 'default',
  'label_placement' => 'top',
  'instruction_placement' => 'label',
  'hide_on_screen' => '',
  'active' => 1,
  'description' => '',
));

acf_add_local_field_group(array(
  'key' => 'group_602405abbb4ef',
  'title' => 'Block: Gallery',
  'fields' => array(
    array(
      'key' => 'field_602405b10585a',
      'label' => 'Gallery Title',
      'name' => 'gallery_title',
      'type' => 'text',
      'instructions' => '',
      'required' => 0,
      'conditional_logic' => 0,
      'wrapper' => array(
        'width' => '',
        'class' => '',
        'id' => '',
      ),
      'default_value' => '',
      'placeholder' => '',
      'prepend' => '',
      'append' => '',
      'maxlength' => '',
    ),
    array(
      'key' => 'field_602405b90585b',
      'label' => 'Gallery Description',
      'name' => 'gallery_description',
      'type' => 'text',
      'instructions' => '',
      'required' => 0,
      'conditional_logic' => 0,
      'wrapper' => array(
        'width' => '',
        'class' => '',
        'id' => '',
      ),
      'default_value' => '',
      'placeholder' => '',
      'prepend' => '',
      'append' => '',
      'maxlength' => '',
    ),
    array(
      'key' => 'field_602405c10585c',
      'label' => 'Gallery',
      'name' => 'gallery',
      'type' => 'gallery',
      'instructions' => '',
      'required' => 0,
      'conditional_logic' => 0,
      'wrapper' => array(
        'width' => '',
        'class' => '',
        'id' => '',
      ),
      'return_format' => 'array',
      'preview_size' => 'medium',
      'insert' => 'append',
      'library' => 'all',
      'min' => '',
      'max' => '',
      'min_width' => '',
      'min_height' => '',
      'min_size' => '',
      'max_width' => '',
      'max_height' => '',
      'max_size' => '',
      'mime_types' => '',
    ),
  ),
  'location' => array(
    array(
      array(
        'param' => 'block',
        'operator' => '==',
        'value' => 'acf/gallery',
      ),
    ),
  ),
  'menu_order' => 0,
  'position' => 'normal',
  'style' => 'default',
  'label_placement' => 'top',
  'instruction_placement' => 'label',
  'hide_on_screen' => '',
  'active' => true,
  'description' => '',
));
endif;

/**
 * Custom block types.
 *
 * @package WordPress
 */

/**
 * Register custom block types.
 */
function register_custom_block_types() {
  if ( function_exists( 'acf_register_block_type' ) ) {
    // Register a gallery block.
    acf_register_block_type(
      array(
        'name'            => 'gallery',
        'title'           => 'Gallery',
        'description'     => 'A custom gallery block.',
        'category'        => 'media',
        'icon'            => 'format-gallery',
        'keywords'        => array( 'gallery', 'images' ),
        'render_template' => 'views/partials/block-gallery.blade.php',
        'mode'            => 'edit',
        'supports'        => array(
          'mode' => false,
        ),
      )
    );
  }
}
add_action( 'init', 'register_custom_block_types' );
