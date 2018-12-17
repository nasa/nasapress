<?php

namespace App;

function wpb_list_child_pages() { 
  global $post;

  $args = array(
    'title_li'    => '',
    'child_of'    => $post->ID,
    'sort_column' => 'menu_order, post_title',
    'depth'       => 1,
    'echo'        => false
  );

  $childpages = wp_list_pages($args);
  
  if (!$childpages && is_page() && $post->post_parent ) {
    $args['child_of'] = $post->post_parent;
    $childpages = wp_list_pages($args);
  }
  
  $string = '';

  if ( $childpages ) {
    $string = '<ul class="usa-sidenav-list">' . $childpages . '</ul>';

    if(function_exists('bwp_external_links')) {
      $string = bwp_external_links($string);
    }
  }

  return $string;
}