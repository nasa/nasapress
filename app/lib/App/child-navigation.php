<?php

namespace App;

function wpb_list_child_pages() { 
  global $post;

  $childpages = wp_list_pages( 'sort_column=menu_order&depth=1&title_li=&child_of=' . $post->ID . '&echo=0' );
  
  if (!$childpages && is_page() && $post->post_parent ) {
    $childpages = wp_list_pages( 'sort_column=menu_order&depth=1&title_li=&child_of=' . $post->post_parent . '&echo=0' );
  }
  
  if ( $childpages ) {
    $string = '<ul class="usa-sidenav-list">' . $childpages . '</ul>';
  }

  if(function_exists('bwp_external_links')) {
    $string = bwp_external_links($string);
  }

  return $string;
}