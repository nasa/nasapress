<?php

namespace App;

use Illuminate\Support\Str;

class NASAWDSBasicNavwalker extends \Walker_Nav_Menu {
  function start_lvl( &$output, $depth = 0, $args = array() ) {
    $id = 'side-nav-'.$this->curItem->menu_order;
		$output .= '<ul class="usa-nav-submenu" id="'.$id.'" aria-hidden="true">';
	}
  public function end_lvl( &$output, $depth = 0, $args = array() ) {
    $output .= '</ul>';
  }
	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
    $this->curItem = $item;
    $object = $item->object;
    $type = $item->type;
    $title = $item->title;
    $description = $item->description;
    $permalink = $item->url;
    $is_current = false;
    if($item->classes){
      foreach($item->classes as $key=>$class){
        if(strpos($class, 'current-menu-item') !== false )
        $is_current = true;
      }
    }
		$classes = ($is_current && $depth == 0) ? ' usa-current': '';
    $child_active = $item->current_item_ancestor || in_array('current-page-ancestor', $item->classes) ? 'child-active' : '';
    
    $class_names = '';
    $classes2 = empty( $item->classes ) ? array() : (array) $item->classes;
    $classes2[] = 'menu-item-' . $item->ID;
    $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes2 ), $item, $args ) );
    $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';
    
    $output .= '<li' . $class_names . '>';
    $link_class = ($depth == 0) ? 'usa-nav-link' : '';
    $link_class .= $classes;
    if($depth == 0 && $args->walker->has_children){
      $output  .= '<button class=" usa-accordion-button usa-nav-link '.$child_active.'"
      aria-expanded="false" aria-controls="side-nav-'.$item->menu_order.'">';
        $output .= '<span>'.$title.'</span>';
      $output .= '</button>';
    }elseif( $permalink && $permalink != '#' ) {
      $external = '';
      $target = '';
      if(!Str::startsWith($permalink, home_url())) {
        $target = ' rel="external" target="_blank"';
        $external = '<i class="fa fa-external-link" aria-hidden="true"></i>';
      }
      
      $output .= '<a href="'.$permalink.'" class="'.$link_class.'"'.$target.'>';
        $output .= '<span>'.$title.'</span>'.$external;
      $output .= '</a>';
    }else{
      $output .= '<span class="'.$link_class.'">';
        $output .= '<span>'.$title.'</span>';
      $output .= '</span>';
    }
	}
}