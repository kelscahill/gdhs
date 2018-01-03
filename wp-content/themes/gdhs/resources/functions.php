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
		"supports" => array( "title", "editor", "thumbnail" ),
	);

	register_post_type( "events", $event_args );

  /**
	 * Post Type: Exhibits.
	 */
  $exhibit_labels = array(
		"name" => __( 'Exhibits', 'sage' ),
		"singular_name" => __( 'Exhibit', 'sage' ),
		"menu_name" => __( 'Exhibits', 'sage' ),
		"all_items" => __( 'All Exhibits', 'sage' ),
		"add_new" => __( 'Add New Exhibit', 'sage' ),
		"edit_item" => __( 'Edit Exhibit', 'sage' ),
		"new_item" => __( 'New Exhibit', 'sage' ),
		"view_item" => __( 'View Exhibit', 'sage' ),
		"view_items" => __( 'View Exhibits', 'sage' ),
		"search_items" => __( 'Search Exhibits', 'sage' ),
		"not_found" => __( 'No Events Found', 'sage' ),
		"not_found_in_trash" => __( 'No Exhibits found in Trash', 'sage' ),
	);

	$exhibit_args = array(
		"label" => __( 'Exhibits', 'sage' ),
		"labels" => $exhibit_labels,
		"description" => "GDHS Exhibits",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"show_in_menu" => true,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"hierarchical" => true,
		"rewrite" => array( "slug" => "exhibit", "with_front" => true ),
    'has_archive' => false,
		"query_var" => true,
		"menu_position" => 5,
		"menu_icon" => "dashicons-format-gallery",
		"supports" => array( "title", "editor", "thumbnail" ),
	);

	register_post_type( "exhibits", $exhibit_args );

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
		"rewrite" => array( "slug" => "research-library", "with_front" => true ),
    'has_archive' => false,
		"query_var" => true,
		"menu_position" => 5,
		"menu_icon" => "dashicons-book-alt",
		"supports" => array( "title", "editor", "thumbnail" ),
	);

	register_post_type( "library", $research_args );
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
   * Taxonomy: Exhibit Category.
   */

  $exhibit_cat_labels = array(
    "name" => __( 'Exhibit Category', 'sage' ),
    "singular_name" => __( 'Exhibit Category', 'sage' ),
    "menu_name" => __( 'Exhibit Categories', 'sage' ),
    "all_items" => __( 'All Exhibit Categories', 'sage' ),
    "edit_item" => __( 'Edit Exhibit Categories', 'sage' ),
    "view_item" => __( 'View Exhibit Categories', 'sage' ),
    "update_item" => __( 'Update Exhibit Categories', 'sage' ),
    "add_new_item" => __( 'Add New Exhibit Category', 'sage' ),
    "new_item_name" => __( 'New Exhibit Category', 'sage' ),
    "search_items" => __( 'Search Exhibit Categories', 'sage' ),
    "popular_items" => __( 'Popular Exhibit Categories', 'sage' ),
    "add_or_remove_items" => __( 'Add or Remove Exhibit Categories', 'sage' ),
    "choose_from_most_used" => __( 'Choose from the most used Exhibit Categories', 'sage' ),
    "not_found" => __( 'No Exhibit Categories Found', 'sage' ),
    "items_list" => __( 'Exhibit Categories List', 'sage' ),
  );

  $exhibit_cat_args = array(
    "label" => __( 'Category', 'sage' ),
    "labels" => $exhibit_cat_labels,
    "public" => true,
    "hierarchical" => true,
    "label" => "Exhibit Categories",
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
  register_taxonomy( "exhibit_category", array( "exhibits" ), $exhibit_cat_args );

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

}
add_action( 'init', 'cptui_register_my_taxes' );
