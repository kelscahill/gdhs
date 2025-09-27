<?php
/**
 *
 * @file
 * Register custom taxonomies.
 *
 * @package WordPress
 */
function cptui_register_my_taxes() {
  /*
   * Taxonomy: Event Category.
   */
  $event_cat_labels = array(
    "name" => __('Event Category', 'sage'),
    "singular_name" => __('Event Category', 'sage'),
    "menu_name" => __('Event Categories', 'sage'),
    "all_items" => __('All Event Categories', 'sage'),
    "edit_item" => __('Edit Event Categories', 'sage'),
    "view_item" => __('View Event Categories', 'sage'),
    "update_item" => __('Update Event Categories', 'sage'),
    "add_new_item" => __('Add New Event Category', 'sage'),
    "new_item_name" => __('New Event Category', 'sage'),
    "search_items" => __('Search Event Categories', 'sage'),
    "popular_items" => __('Popular Event Categories', 'sage'),
    "add_or_remove_items" => __('Add or Remove Event Categories', 'sage'),
    "choose_from_most_used" => __('Choose from the most used Event Categories', 'sage'),
    "not_found" => __('No Event Categories Found', 'sage'),
    "items_list" => __('Event Categories List', 'sage'),
  );

  $event_cat_args = array(
    "label" => __('Category', 'sage'),
    "labels" => $event_cat_labels,
    "public" => true,
    "hierarchical" => true,
    "label" => "Event Categories",
    "show_ui" => true,
    "show_in_menu" => true,
    "show_in_nav_menus" => true,
    "query_var" => true,
    "rewrite" => array("slug" => "event_category", "with_front" => false),
    "has_archive" => false,
    "show_admin_column" => true,
    "show_in_rest" => false,
    "rest_base" => "",
    "show_in_quick_edit" => true,
  );
  register_taxonomy("event_category", array("events"), $event_cat_args);

  /*
   * Taxonomy: Exhibition Category.
   */

  $exhibit_cat_labels = array(
    "name" => __('Exhibition Category', 'sage'),
    "singular_name" => __('Exhibition Category', 'sage'),
    "menu_name" => __('Exhibition Categories', 'sage'),
    "all_items" => __('All Exhibition Categories', 'sage'),
    "edit_item" => __('Edit Exhibition Categories', 'sage'),
    "view_item" => __('View Exhibition Categories', 'sage'),
    "update_item" => __('Update Exhibition Categories', 'sage'),
    "add_new_item" => __('Add New Exhibition Category', 'sage'),
    "new_item_name" => __('New Exhibition Category', 'sage'),
    "search_items" => __('Search Exhibition Categories', 'sage'),
    "popular_items" => __('Popular Exhibition Categories', 'sage'),
    "add_or_remove_items" => __('Add or Remove Exhibition Categories', 'sage'),
    "choose_from_most_used" => __('Choose from the most used Exhibition Categories', 'sage'),
    "not_found" => __('No Exhibition Categories Found', 'sage'),
    "items_list" => __('Exhibition Categories List', 'sage'),
  );

  $exhibit_cat_args = array(
    "label" => __('Category', 'sage'),
    "labels" => $exhibit_cat_labels,
    "public" => true,
    "hierarchical" => true,
    "label" => "Exhibition Categories",
    "show_ui" => true,
    "show_in_menu" => true,
    "show_in_nav_menus" => true,
    "query_var" => true,
    "rewrite" => array("slug" => "exhibit_category", "with_front" => false),
    "has_archive" => false,
    "show_admin_column" => true,
    "show_in_rest" => false,
    "rest_base" => "",
    "show_in_quick_edit" => true,
  );
  register_taxonomy("exhibit_category", array("exhibit"), $exhibit_cat_args);

  /*
   * Taxonomy: Research Library Category.
   */

  $research_cat_labels = array(
    "name" => __('Library Category', 'sage'),
    "singular_name" => __('Library Category', 'sage'),
    "menu_name" => __('Library Categories', 'sage'),
    "all_items" => __('All Library Categories', 'sage'),
    "edit_item" => __('Edit Library Categories', 'sage'),
    "view_item" => __('View Library Categories', 'sage'),
    "update_item" => __('Update Library Categories', 'sage'),
    "add_new_item" => __('Add New Library Category', 'sage'),
    "new_item_name" => __('New Library Category', 'sage'),
    "search_items" => __('Search Library Categories', 'sage'),
    "popular_items" => __('Popular Library Categories', 'sage'),
    "add_or_remove_items" => __('Add or Remove Library Categories', 'sage'),
    "choose_from_most_used" => __('Choose from the most used Library Categories', 'sage'),
    "not_found" => __('No Library Categories Found', 'sage'),
    "items_list" => __('Library Categories List', 'sage'),
  );

  $research_cat_args = array(
    "label" => __('Category', 'sage'),
    "labels" => $research_cat_labels,
    "public" => true,
    "hierarchical" => true,
    "label" => "Library Categories",
    "show_ui" => true,
    "show_in_menu" => true,
    "show_in_nav_menus" => true,
    "query_var" => true,
    "rewrite" => array("slug" => "library_category", "with_front" => false),
    "has_archive" => false,
    "show_admin_column" => true,
    "show_in_rest" => false,
    "rest_base" => "",
    "show_in_quick_edit" => true,
  );
  register_taxonomy("library_category", array("library"), $research_cat_args);

  /*
   * Taxonomy: Product Category.
   */

  $product_cat_labels = array(
    "name" => __('Product Category', 'sage'),
    "singular_name" => __('Product Category', 'sage'),
    "menu_name" => __('Product Categories', 'sage'),
    "all_items" => __('All Product Categories', 'sage'),
    "edit_item" => __('Edit Product Categories', 'sage'),
    "view_item" => __('View Product Categories', 'sage'),
    "update_item" => __('Update Product Categories', 'sage'),
    "add_new_item" => __('Add New Product Category', 'sage'),
    "new_item_name" => __('New Product Category', 'sage'),
    "search_items" => __('Search Product Categories', 'sage'),
    "popular_items" => __('Popular Product Categories', 'sage'),
    "add_or_remove_items" => __('Add or Remove Product Categories', 'sage'),
    "choose_from_most_used" => __('Choose from the most used Product Categories', 'sage'),
    "not_found" => __('No Product Categories Found', 'sage'),
    "items_list" => __('Exhibition Categories List', 'sage'),
  );

  $product_cat_args = array(
    "label" => __('Category', 'sage'),
    "labels" => $product_cat_labels,
    "public" => true,
    "hierarchical" => true,
    "label" => "Product Categories",
    "show_ui" => true,
    "show_in_menu" => true,
    "show_in_nav_menus" => true,
    "query_var" => true,
    "rewrite" => array("slug" => "product_category", "with_front" => false),
    "has_archive" => false,
    "show_admin_column" => true,
    "show_in_rest" => false,
    "rest_base" => "",
    "show_in_quick_edit" => true,
  );
  register_taxonomy("product_category", array("product"), $product_cat_args);
}
add_action('init', 'cptui_register_my_taxes');
