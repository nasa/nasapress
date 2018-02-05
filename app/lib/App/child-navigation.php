<?php

namespace App;

function wpb_list_child_pages() { 
  global $post; 

  if ( is_page() && $post->post_parent )
    $childpages = wp_list_pages( 'sort_column=menu_order&depth=1&title_li=&child_of=' . $post->post_parent . '&echo=0' );
  else
    $childpages = wp_list_pages( 'sort_column=menu_order&depth=1&title_li=&child_of=' . $post->ID . '&echo=0' );

  if ( $childpages ) {
    $string = '<ul class="usa-sidenav-list">' . $childpages . '</ul>';
  }

  return $string; 
}

//<ul class="usa-sidenav-list"><li data-tag="2"><a href="#expertise">Expertise</a></li><li data-tag="2"><a href="#what-were-working-on">What we’re working on</a><ul class="usa-sidenav-sub_list"><li data-tag="3"><a href="#icing-research">Icing Research</a></li><li data-tag="3"><a href="#boundary-layer-ingestion-propulsion">Boundary Layer Ingestion Propulsion</a></li><li data-tag="3"><a href="#hybrid-electric-propulsion">Hybrid Electric Propulsion</a></li></ul></li></ul>