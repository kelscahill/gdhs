<?php

namespace App;

use Roots\Sage\Container;
use Roots\Sage\Assets\JsonManifest;
use Roots\Sage\Template\Blade;
use Roots\Sage\Template\BladeProvider;

/**
 * Theme assets
 */
add_action('wp_enqueue_scripts', function () {
    wp_enqueue_style('sage/main.css', asset_path('styles/main.css'), false, null);
    wp_enqueue_script('sage/main.js', asset_path('scripts/main.js'), ['jquery'], null, true);
}, 100);

/**
 * Theme setup
 */
add_action('after_setup_theme', function () {
    /**
     * Enable features from Soil when plugin is activated
     * @link https://roots.io/plugins/soil/
     */
    add_theme_support('soil-clean-up');
    add_theme_support('soil-jquery-cdn');
    add_theme_support('soil-nav-walker');
    add_theme_support('soil-nice-search');
    add_theme_support('soil-relative-urls');
    add_theme_support('editor-styles'); // Enable editor styles
    add_editor_style(asset_path('styles/editor.css'));

    /**
     * Enable plugins to manage the document title
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#title-tag
     */
    add_theme_support('title-tag');

    /**
     * Register navigation menus
     * @link https://developer.wordpress.org/reference/functions/register_nav_menus/
     */
    register_nav_menus([
      'primary_navigation' => __('Primary Navigation', 'sage'),
      'footer_navigation' => __('Footer Navigation', 'sage')
    ]);

    /**
     * Enable post thumbnails
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
     */
    add_theme_support('post-thumbnails');

    /**
     * Enable HTML5 markup support
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#html5
     */
    add_theme_support('html5', ['caption', 'comment-form', 'comment-list', 'gallery', 'search-form']);

    /**
     * Enable selective refresh for widgets in customizer
     * @link https://developer.wordpress.org/themes/advanced-topics/customizer-api/#theme-support-in-sidebars
     */
    add_theme_support('customize-selective-refresh-widgets');

    /**
     * Use main stylesheet for visual editor
     * @see resources/assets/styles/layouts/_tinymce.scss
     */
    add_editor_style(asset_path('styles/main.css'));
}, 20);

/**
 * Register sidebars
 */
add_action('widgets_init', function () {
    $config = [
        'before_widget' => '<section class="widget %1$s %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>'
    ];
    register_sidebar([
        'name'          => __('Primary', 'sage'),
        'id'            => 'sidebar-primary'
    ] + $config);
    register_sidebar([
        'name'          => __('Footer', 'sage'),
        'id'            => 'sidebar-footer'
    ] + $config);
});

/**
 * Updates the `$post` variable on each iteration of the loop.
 * Note: updated value is only available for subsequently loaded views, such as partials
 */
add_action('the_post', function ($post) {
    sage('blade')->share('post', $post);
});

/**
 * Setup Sage options
 */
add_action('after_setup_theme', function () {
    /**
     * Add JsonManifest to Sage container
     */
    sage()->singleton('sage.assets', function () {
        return new JsonManifest(config('assets.manifest'), config('assets.uri'));
    });

    /**
     * Add Blade to Sage container
     */
    sage()->singleton('sage.blade', function (Container $app) {
        $cachePath = config('view.compiled');
        if (!file_exists($cachePath)) {
            wp_mkdir_p($cachePath);
        }
        (new BladeProvider($app))->register();
        return new Blade($app['view']);
    });

    /**
     * Create @asset() Blade directive
     */
    sage('blade')->compiler()->directive('asset', function ($asset) {
        return "<?= " . __NAMESPACE__ . "\\asset_path({$asset}); ?>";
    });
});

/**
 * Custom image styles.
 */

// Featured crop.
add_image_size('featured__hero--s', 500, 400, array('center', 'center'));
add_image_size('featured__hero--m', 800, 500, array('center', 'center'));
add_image_size('featured__hero--l', 1100, 600, array('center', 'center'));
add_image_size('featured__hero--xl', 1600, 800, array('center', 'center'));

// 16:9 crop.
add_image_size('horiz__16x9--s', 500, 280, array('center', 'center'));
add_image_size('horiz__16x9--m', 800, 450, array('center', 'center'));
add_image_size('horiz__16x9--l', 1100, 620, array('center', 'center'));
// add_image_size('horiz__16x9--xl', 1600, 900, array('center', 'center'));

// 4:3 crop.
add_image_size('horiz__4x3--s', 500, 375, array('center', 'center'));
add_image_size('horiz__4x3--m', 800, 600, array('center', 'center'));
add_image_size('horiz__4x3--l', 1100, 825, array('center', 'center'));
// add_image_size('horiz__4x3--xl', 1600, 1200, array('center', 'center'));

// 3:4 crop.
add_image_size('vert__3x4--s', 375, 500, array('center', 'center'));
add_image_size('vert__3x4--m', 600, 800, array('center', 'center'));

// Flexible height
add_image_size('flex-height--s', 350, 9999);
add_image_size('flex-height--m', 700, 9999);
add_image_size('flex-height--l', 800, 9999);
// add_image_size('flex-height--xl', 1100, 9999);

add_image_size('horiz-thumb', 260, 190, array('center', 'center'));
add_image_size('vert-thumb', 260, 400, array('center', 'center'));
