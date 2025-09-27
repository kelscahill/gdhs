<?php
/**
 *
 * @file
 * Register custom content types.
 *
 * @package WordPress
 */

function cptui_register_my_cpts() {
  /*
   * Post Type: Events.
   */
  $event_labels = array(
    "name" => __('Events', 'sage'),
    "singular_name" => __('Event', 'sage'),
    "menu_name" => __('Events', 'sage'),
    "all_items" => __('All Events', 'sage'),
    "add_new" => __('Add New Event', 'sage'),
    "edit_item" => __('Edit Event', 'sage'),
    "new_item" => __('New Event', 'sage'),
    "view_item" => __('View Event', 'sage'),
    "view_items" => __('View Events', 'sage'),
    "search_items" => __('Search Events', 'sage'),
    "not_found" => __('No Events Found', 'sage'),
    "not_found_in_trash" => __('No Events found in Trash', 'sage'),
  );

  $event_args = array(
    "label" => __('Events', 'sage'),
    "labels" => $event_labels,
    "description" => "GDHS Events",
    "public" => true,
    "publicly_queryable" => true,
    "show_ui" => true,
    "show_in_rest" => true,
    "rest_base" => "",
    "show_in_menu" => true,
    "exclude_from_search" => false,
    "capability_type" => "post",
    "hierarchical" => true,
    "rewrite" => array("slug" => "event", "with_front" => true),
    'has_archive' => false,
    "query_var" => true,
    "menu_position" => 4,
    "menu_icon" => "dashicons-calendar-alt",
    "supports" => array("title", "editor", "thumbnail", "excerpt", "author")
  );

  register_post_type("events", $event_args);

  /*
   * Post Type: Exhibitions.
   */
  $exhibit_labels = array(
    "name" => __('Exhibitions', 'sage'),
    "singular_name" => __('Exhibition', 'sage'),
    "menu_name" => __('Exhibitions', 'sage'),
    "all_items" => __('All Exhibitions', 'sage'),
    "add_new" => __('Add New Exhibition', 'sage'),
    "edit_item" => __('Edit Exhibition', 'sage'),
    "new_item" => __('New Exhibition', 'sage'),
    "view_item" => __('View Exhibition', 'sage'),
    "view_items" => __('View Exhibitions', 'sage'),
    "search_items" => __('Search Exhibitions', 'sage'),
    "not_found" => __('No Exhibitions Found', 'sage'),
    "not_found_in_trash" => __('No Exhibitions found in Trash', 'sage'),
  );

  $exhibit_args = array(
    "label" => __('Exhibitions', 'sage'),
    "labels" => $exhibit_labels,
    "description" => "GDHS Exhibitions",
    "public" => true,
    "publicly_queryable" => true,
    "show_ui" => true,
    "show_in_rest" => true,
    "rest_base" => "",
    "show_in_menu" => true,
    "exclude_from_search" => false,
    "capability_type" => "post",
    "hierarchical" => true,
    "rewrite" => array("slug" => "exhibition", "with_front" => true),
    'has_archive' => false,
    "query_var" => true,
    "menu_position" => 5,
    "menu_icon" => "dashicons-format-gallery",
    "supports" => array("title", "editor", "thumbnail", "excerpt", "author")
  );

  register_post_type("exhibit", $exhibit_args);

  /*
   * Post Type: Research Library.
   */
  $research_labels = array(
    "name" => __('Research Library', 'sage'),
    "singular_name" => __('Research Library', 'sage'),
    "menu_name" => __('Research Library', 'sage'),
    "all_items" => __('All Items', 'sage'),
    "add_new" => __('Add New Item', 'sage'),
    "edit_item" => __('Edit Item', 'sage'),
    "new_item" => __('New Item', 'sage'),
    "view_item" => __('View Item', 'sage'),
    "view_items" => __('View Items', 'sage'),
    "search_items" => __('Search Items', 'sage'),
    "not_found" => __('No Items Found', 'sage'),
    "not_found_in_trash" => __('No Items found in Trash', 'sage'),
  );

  $research_args = array(
    "label" => __('Research Library', 'sage'),
    "labels" => $research_labels,
    "description" => "GDHS Research Library",
    "public" => true,
    "publicly_queryable" => true,
    "show_ui" => true,
    "show_in_rest" => true,
    "rest_base" => "",
    "show_in_menu" => true,
    "exclude_from_search" => false,
    "capability_type" => "post",
    "hierarchical" => true,
    "rewrite" => array("slug" => "library", "with_front" => true),
    'has_archive' => false,
    "query_var" => true,
    "menu_position" => 5,
    "menu_icon" => "dashicons-book-alt",
    "supports" => array("title", "editor", "thumbnail", "excerpt", "author")
  );

  register_post_type("library", $research_args);

  /*
   * Post Type: Products.
   */
  $product_labels = array(
    "name" => __('Product', 'sage'),
    "singular_name" => __('Product', 'sage'),
    "menu_name" => __('Products', 'sage'),
    "all_items" => __('All Products', 'sage'),
    "add_new" => __('Add New Product', 'sage'),
    "edit_item" => __('Edit Product', 'sage'),
    "new_item" => __('New Product', 'sage'),
    "view_item" => __('View Product', 'sage'),
    "view_items" => __('View Products', 'sage'),
    "search_items" => __('Search Products', 'sage'),
    "not_found" => __('No Products Found', 'sage'),
    "not_found_in_trash" => __('No Products found in Trash', 'sage'),
  );

  $product_args = array(
    "label" => __('Products', 'sage'),
    "labels" => $product_labels,
    "description" => "GDHS Products",
    "public" => true,
    "publicly_queryable" => true,
    "show_ui" => true,
    "show_in_rest" => true,
    "rest_base" => "",
    "show_in_menu" => true,
    "exclude_from_search" => false,
    "capability_type" => "post",
    "hierarchical" => true,
    "rewrite" => array("slug" => "product", "with_front" => true),
    'has_archive' => false,
    "query_var" => true,
    "menu_position" => 5,
    "menu_icon" => "dashicons-cart",
    "supports" => array("title", "editor", "thumbnail", "excerpt", "author")
  );

  register_post_type("product", $product_args);
}
add_action('init', 'cptui_register_my_cpts');

