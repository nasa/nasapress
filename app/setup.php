<?php

namespace App;

use Illuminate\Contracts\Container\Container as ContainerContract;
use Roots\Sage\Assets\JsonManifest;
use Roots\Sage\Config;
use Roots\Sage\Template\Blade;
use Roots\Sage\Template\BladeProvider;

/**
 * Theme assets
 */
add_action('wp_enqueue_scripts', function () {
    wp_enqueue_style('sage/main.css', asset_path('styles/main.css'), false, null);
    wp_enqueue_script('sage/main.js', asset_path('scripts/main.js'), ['jquery'], null, true);
}, 100);

add_action('wp_print_styles', function () {
  // Remove yarrp plugin styles
  wp_dequeue_style('yarppWidgetCss');
  wp_dequeue_style('yarppRelatedCss');
});


// REMOVE EMOJI ICONS
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles'); 

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
        'primary_navigation' => __('Primary Navigation', 'sage')
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
	register_sidebar( array(
		'name'			=> 'NASA Responsible Official Widget Area',
		'id'			=> 'nasa-official',
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '<h3>',
        'after_title'   => '</h3>'
	));
	register_sidebar( array(
		'name'			=> 'Social Media Links Widget Area',
		'id'			=> 'social-media',
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '<h3>',
        'after_title'   => '</h3>'
	));
	register_sidebar( array(
		'name'			=> 'NASA Center Information Widget Area',
		'id'			=> 'nasa-center-info',
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '<h3>',
        'after_title'   => '</h3>'
    ));
    register_sidebar( array(
		'name'			=> 'Posts Navigation Sidebar',
		'id'			=> 'posts-nav-bar',
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '<h3>',
        'after_title'   => '</h3>'
    ));
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
     * Sage config
     */
    $paths = [
        'dir.stylesheet' => get_stylesheet_directory(),
        'dir.template'   => get_template_directory(),
        'dir.upload'     => wp_upload_dir()['basedir'],
        'uri.stylesheet' => get_stylesheet_directory_uri(),
        'uri.template'   => get_template_directory_uri(),
    ];
    $viewPaths = collect(preg_replace('%[\/]?(resources/views)?[\/.]*?$%', '', [STYLESHEETPATH, TEMPLATEPATH]))
        ->flatMap(function ($path) {
            return ["{$path}/resources/views", $path];
        })->unique()->toArray();

        // die(var_dump($viewPaths));
    config([
        'assets.manifest' => "{$paths['dir.stylesheet']}/../dist/assets.json",
        'assets.uri'      => "{$paths['uri.stylesheet']}/dist",
        'view.compiled'   => "{$paths['dir.upload']}/cache/compiled",
        'view.namespaces' => ['App' => WP_CONTENT_DIR],
        'view.paths'      => $viewPaths,
    ] + $paths);

    /**
     * Add JsonManifest to Sage container
     */
    sage()->singleton('sage.assets', function () {
        return new JsonManifest(config('assets.manifest'), config('assets.uri'));
    });

    /**
     * Add Blade to Sage container
     */
    sage()->singleton('sage.blade', function (ContainerContract $app) {
        $cachePath = config('view.compiled');
        if (!file_exists($cachePath)) {
            wp_mkdir_p($cachePath);
        }
        (new BladeProvider($app))->register();
        return new Blade($app['view'], $app);
    });

    /**
     * Create @asset() Blade directive
     */
    sage('blade')->compiler()->directive('asset', function ($asset) {
        return "<?= App\\asset_path({$asset}); ?>";
    });
});

/**
 * Init config
 */
sage()->bindIf('config', Config::class, true);

require_once 'lib/App/header-settings.php';
require_once 'lib/App/center-information-widget.php';
require_once 'lib/App/social-media-links-widget.php';
require_once 'lib/App/nasapress-page-options.php';
require_once 'lib/App/NASAWDSBasicNavwalker.php';
require_once 'lib/App/child-navigation.php';

add_image_size( 'medium_large', '768', '0', false ); 
add_image_size( 'medium_large', '768', '0', false ); 
add_image_size( 'portrait-thumb', '230', '300', array( "center", "top") );

/**
 * don't display pages on archive pages
 */
add_action('pre_get_posts', function ($query) {
  if(is_archive() && $query->is_main_query()) {
    $query->set('post_type','post');
  }
});

/**
 * Fix 404 for post permalinks using category_base
 * https://wordpress.stackexchange.com/questions/98083/how-to-get-permalinks-with-category-base-working-with-sub-categories/98095#98095
 */
add_action('template_redirect', function () {
    
    // Only check on 404's
    if ( is_404() ) {
        $currentURI = !empty($_SERVER['REQUEST_URI']) ? trim($_SERVER['REQUEST_URI'], '/') : '';
        if ($currentURI) {
            $categoryBaseName = trim(get_option('category_base'), '/.'); // Remove / and . from base
            if ($categoryBaseName) {

                $uri_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
                $uri_segments = explode('/', $uri_path);

                if(environment() == 'test') {
                    array_shift($uri_segments);
                }

                // If the requested url starts with /category_base/ look for an author or post instead.
                if (is_array($uri_segments) && $uri_segments[1] && $uri_segments[1] == $categoryBaseName) {

                    // check for post
                    global $wp_query;
                    $args = array(
                        'post_type' => 'post',
                        'name' => $wp_query->query_vars['category_name']
                    );

                    // check for author if url starts with /posts/author/
                    global $wp_rewrite;
                    if($uri_segments[2] && $uri_segments[2] == $wp_rewrite->author_base) {
                        $args = array(
                            'author_name' => $wp_query->query_vars['category_name']
                        );
                    }

                    $posts = $wp_query->query($args);

                    if(is_array($posts) && count($posts) >= 1) {
                        status_header( 200 ); // found post or author
                    }
                    else {
                        $wp_query->set_404(); // didn't find any
                    }
                    unset($args);
                }
                unset($uri_path, $uri_segments);
            }
            unset($categoryBaseName);
        }
        unset($currentURI);
    }
});