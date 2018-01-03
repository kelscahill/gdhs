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
 * Custom fields
 */
function cptui_register_my_cpts() {

	/**
	 * Post Type: Winners.
	 */
	$winner_labels = array(
		"name" => __( 'Winners', 'sage' ),
		"singular_name" => __( 'Winner', 'sage' ),
		"menu_name" => __( 'Winners', 'sage' ),
		"all_items" => __( 'All Winners', 'sage' ),
		"add_new" => __( 'Add New Winner', 'sage' ),
		"edit_item" => __( 'Edit Winner', 'sage' ),
		"new_item" => __( 'New Winner', 'sage' ),
		"view_item" => __( 'View Winner', 'sage' ),
		"view_items" => __( 'View Winners', 'sage' ),
		"search_items" => __( 'Search Winners', 'sage' ),
		"not_found" => __( 'No Winners Found', 'sage' ),
		"not_found_in_trash" => __( 'No Winners found in Trash', 'sage' ),
	);

	$winner_args = array(
		"label" => __( 'Winners', 'sage' ),
		"labels" => $winner_labels,
		"description" => "WHCA Winners",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"show_in_menu" => true,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"hierarchical" => true,
		"rewrite" => array( "slug" => "winner", "with_front" => true ),
    'has_archive' => false,
		"query_var" => true,
		"menu_position" => 4,
		"menu_icon" => "dashicons-awards",
		"supports" => array( "title", "editor", "thumbnail" ),
	);

	register_post_type( "winners", $winner_args );

  /**
	 * Post Type: Officers.
	 */
  $officer_labels = array(
		"name" => __( 'Officers', 'sage' ),
		"singular_name" => __( 'Officer', 'sage' ),
		"menu_name" => __( 'Officers', 'sage' ),
		"all_items" => __( 'All Officers', 'sage' ),
		"add_new" => __( 'Add New Officer', 'sage' ),
		"edit_item" => __( 'Edit Officer', 'sage' ),
		"new_item" => __( 'New Officer', 'sage' ),
		"view_item" => __( 'View Officer', 'sage' ),
		"view_items" => __( 'View Officers', 'sage' ),
		"search_items" => __( 'Search Officers', 'sage' ),
		"not_found" => __( 'No Winners Found', 'sage' ),
		"not_found_in_trash" => __( 'No Officers found in Trash', 'sage' ),
	);

	$officer_args = array(
		"label" => __( 'Officers', 'sage' ),
		"labels" => $officer_labels,
		"description" => "WHCA Officers",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"show_in_menu" => true,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"hierarchical" => true,
		"rewrite" => array( "slug" => "officer", "with_front" => true ),
    'has_archive' => false,
		"query_var" => true,
		"menu_position" => 5,
		"menu_icon" => "dashicons-groups",
		"supports" => array( "title", "editor", "thumbnail" ),
	);

	register_post_type( "Officers", $officer_args );
}
add_action( 'init', 'cptui_register_my_cpts' );

/**
 * Custom taxonomy
 */
function cptui_register_my_taxes() {

  /**
   * Taxonomy: Locations.
   */

  $labels = array(
    "name" => __( 'Winner Category', 'sage' ),
    "singular_name" => __( 'Winner Category', 'sage' ),
    "menu_name" => __( 'Winner Categories', 'sage' ),
    "all_items" => __( 'All Winner Categories', 'sage' ),
    "edit_item" => __( 'Edit Winner Categories', 'sage' ),
    "view_item" => __( 'View Winner Categories', 'sage' ),
    "update_item" => __( 'Update Winner Categories', 'sage' ),
    "add_new_item" => __( 'Add New Winner Category', 'sage' ),
    "new_item_name" => __( 'New Winner Category', 'sage' ),
    "search_items" => __( 'Search Winner Categories', 'sage' ),
    "popular_items" => __( 'Popular Winner Categories', 'sage' ),
    "add_or_remove_items" => __( 'Add or Remove Winner Categories', 'sage' ),
    "choose_from_most_used" => __( 'Choose from the most used Winner Categories', 'sage' ),
    "not_found" => __( 'No Winner Categories Found', 'sage' ),
    "items_list" => __( 'Winner Categories List', 'sage' ),
  );

  $args = array(
    "label" => __( 'Category', 'sage' ),
    "labels" => $labels,
    "public" => true,
    "hierarchical" => true,
    "label" => "Winner Categories",
    "show_ui" => true,
    "show_in_menu" => true,
    "show_in_nav_menus" => true,
    "query_var" => true,
    "rewrite" => array( "slug" => "winner_category", "with_front" => false ),
    "has_archive" => false,
    "show_admin_column" => true,
    "show_in_rest" => false,
    "rest_base" => "",
    "show_in_quick_edit" => true,
  );
  register_taxonomy( "winner_category", array( "winners" ), $args );

}
add_action( 'init', 'cptui_register_my_taxes' );
