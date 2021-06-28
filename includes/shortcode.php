<?php

function button_shortcode( $atts, $content = null ) {

    extract(shortcode_atts(array(
      'url' => '#',
      'style' => 'primary',
      'icon' => '',
      'class' => '',
      'target' => '_self',
    ), $atts));  
    
      return '<a href="' . $url . '" class="btn btn-' . $style . ' ' . $class . '" target="' . $target . '">' . force_balance_tags($content) . ($icon ? '<i class="fal fa-' . $icon : '') . '</i></a>';
  }
  add_shortcode( 'button', 'button_shortcode' );
  
  function link_shortcode( $atts, $content = null ) {
  
    extract(shortcode_atts(array(
      'url' => '#',
      'style' => 'primary',
      'class' => '',
      'target' => '_self',
    ), $atts));  
    
      return '<a href="' . $url . '" class="caplink ' . $class . '" target="' . $target . '">' . force_balance_tags($content) . '</i></a>';
  }
  add_shortcode( 'link', 'link_shortcode' );
  
  
  