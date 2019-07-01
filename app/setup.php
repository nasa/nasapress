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

    if (is_single() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
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

require_once 'lib/App/NASAWDSBasicNavwalker.php';
require_once 'lib/App/acf-nasapress.php';
require_once 'lib/App/nasa-official.php';
require_once 'lib/App/child-navigation.php';
require_once 'lib/App/environment.php';

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

add_action('after_setup_theme', function () {
    if( environment() == 'development' && null == username_exists( 'admin' ) ) {

        require 'lib/App/conf/dev-admin-pw.php';

        // Generate the password and create the user
        $user_id = wp_create_user( 'admin', $dev_admin_pw, 'admin@grcpublic.local' );

        // Set the nickname
        wp_update_user(
          array(
            'ID'          =>    'admin',
            'nickname'    =>    'admin'
          )
        );

        // Set the role
        $user = new \WP_User( 'admin' );
        $user->set_role( 'administrator' );

    } // end if
});
