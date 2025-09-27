<?php
/**
 *
 * @file
 * Register custom gutenberg blocks.
 *
 * @package WordPress
 */

/**
 * Register custom block types.
 */
function register_custom_block_types() {
  if (function_exists('acf_register_block_type')) {
    // Register a gallery block.
    acf_register_block_type(
      array(
        'name'            => 'gallery',
        'title'           => 'Gallery',
        'description'     => 'A custom gallery block.',
        'category'        => 'media',
        'icon'            => 'format-gallery',
        'keywords'        => array('gallery', 'images'),
        'render_template' => 'views/partials/block-gallery.blade.php',
        'mode'            => 'edit',
        'supports'        => array(
          'mode' => false,
        ),
      )
    );
  }
}
add_action('init', 'register_custom_block_types');
