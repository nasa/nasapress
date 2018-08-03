<?php

namespace App;

/**
 * Add <body> classes
 */
add_filter('body_class', function (array $classes) {
    /** Add page slug if it doesn't exist */
    if (is_single() || is_page() && !is_front_page()) {
        if (!in_array(basename(get_permalink()), $classes)) {
            $classes[] = 'slug-' . basename(get_permalink());
        }
    }

    /** Add class if sidebar is active */
    if (display_sidebar()) {
        $classes[] = 'sidebar-primary';
    }

    /** Clean up class names for custom templates */
    $classes = array_map(function ($class) {
        return preg_replace(['/-blade(-php)?$/', '/^page-template-views/'], '', $class);
    }, $classes);

    return array_filter($classes);
});

/**
 * Add "… Continued" to the excerpt
 */
add_filter('excerpt_more', function () {
    return ' &hellip; <a href="' . get_permalink() . '">' . __('Read the rest &#8674;', 'sage') . '</a>';
});

// Don't autoformat the home page.
function remove_wpautop( $post ) {
   if (is_front_page( $post )){
      remove_filter('the_content', 'wpautop');
   }
}
add_action('the_post', 'App\\remove_wpautop');

/**
 * Remove empty paragraphs created by wpautop()
 * @author Ryan Hamilton
 * @link https://gist.github.com/Fantikerz/5557617
 */
function remove_empty_p( $content ) {
  $content = force_balance_tags( $content );
  $content = preg_replace( '#<p>\s*+(<br\s*/*>)?\s*</p>#i', '', $content );
  $content = preg_replace( '~\s?<p>(\s|&nbsp;)+</p>\s?~', '', $content );
  return $content;
}
add_filter('the_content', 'App\\remove_empty_p', 14, 1);

/****************************************************************************
* @Author: Boutros AbiChedid
* @Date:   April 18, 2012
* @Websites: bacsoftwareconsulting.com/ ; blueoliveonline.com/
* @Description: Remove header tags and their content From the automatically
* generated Excerpt.
* Code modifies default excerpt_length and excerpt_more filters.
* Code Does NOT preserve any other HTML formatting in the excerpt.
* @Tested on: WordPress version 3.3.1
****************************************************************************/

function build_the_excerpt( $text ) {
    global $post;
  $raw_excerpt = $text;
  if ( '' == $text ) {
    // Use leading paragraph acf field if set and page is using the landing page template, otherwise use the_content
    $text = get_page_template_slug($post->ID) == 'views/template-landing.blade.php' && get_field('lpt_leading_paragraph', $post->ID) ? get_field('lpt_leading_paragraph', $post->ID) : get_the_content('');

    //remove shortcode tags from the given content.
    $text = strip_shortcodes( $text );
    $text = apply_filters('the_content', $text . '<!--noyarpp-->'); // Don't add YARPP section to excerpt
    $text = str_replace('<!--noyarpp-->', '', $text);
    $text = str_replace(']]>', ']]&gt;', $text);

    //Regular expression that strips the header tags and their content.
    $regex = '#(<h([1-6])[^>]*>)\s?(.*)?\s?(<\/h\2>)#';
    $text = preg_replace($regex,'', $text);

    /***Change the excerpt word count.***/
    $excerpt_word_count = 55; //This is WP default.
    $excerpt_length = apply_filters('excerpt_length', $excerpt_word_count);

    /*** Change the excerpt ending.***/
    $excerpt_end = '[...]'; //This is the WP default.
    $excerpt_more = apply_filters('excerpt_more', ' ' . $excerpt_end);

    $excerpt = wp_trim_words( $text, $excerpt_length, $excerpt_more );
  }
  return apply_filters('wp_trim_excerpt', $excerpt, $raw_excerpt);
}
add_filter( 'get_the_excerpt', 'App\\build_the_excerpt', 5);

/**
 * Template Hierarchy should search for .blade.php files
 */
collect([
    'index', '404', 'archive', 'author', 'category', 'tag', 'taxonomy', 'date', 'home',
    'frontpage', 'page', 'paged', 'search', 'single', 'singular', 'attachment'
])->map(function ($type) {
    add_filter("{$type}_template_hierarchy", function ($templates) {
        return collect($templates)->flatMap(function ($template) {
            $transforms = [
                '%^/?(resources[\\/]views)?[\\/]?%' => '',
                '%(\.blade)?(\.php)?$%' => ''
            ];
            $normalizedTemplate = preg_replace(array_keys($transforms), array_values($transforms), $template);
            return ["{$normalizedTemplate}.blade.php", "{$normalizedTemplate}.php"];
        })->toArray();
    });
});

/**
 * Render page using Blade
 */
add_filter('template_include', function ($template) {
    $data = collect(get_body_class())->reduce(function ($data, $class) use ($template) {
        return apply_filters("sage/template/{$class}/data", $data, $template);
    }, []);
    echo template($template, $data);
    // Return a blank file to make WordPress happy
    return get_theme_file_path('index.php');
}, PHP_INT_MAX);

/**
 * Tell WordPress how to find the compiled path of comments.blade.php
 */
add_filter('comments_template', 'App\\template_path');

/**
 * Remove current page from breadcrumbs.
 */
function adjust_single_breadcrumb( $link_output) {
	if(strpos( $link_output, 'breadcrumb_last' ) !== false ) {
		$link_output = '';
	}
  return $link_output;
}
add_filter('wpseo_breadcrumb_single_link', 'App\\adjust_single_breadcrumb' );

function add_closing_spans( $output) {
  global $post;
  $ancestors=get_post_ancestors($post->ID);
  $root=count($ancestors);
  $closingSpans = '';
  for($i = 0; $i <= $root; $i++) {
    $closingSpans .= '</span>';
  }
  return $output . $closingSpans;
}
add_filter('wpseo_breadcrumb_output', 'App\\add_closing_spans' );