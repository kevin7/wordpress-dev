<?php
/*
Gravity Form specific functions & Hook
*/

// --------------------------------------------
// Remove GF top validation message
// --------------------------------------------
add_filter( 'gform_validation_message', 'prefix_gf_empty_validation_message', 10, 2 );
function prefix_gf_empty_validation_message( $message, $form ) {
  return "";
}

// --------------------------------------------
// Use HTML5 markup
// --------------------------------------------
add_filter( 'gform_submit_button', 'form_submit_button', 10, 2 );
function form_submit_button( $button, $form ) {

    $label = $form['button']['text'];

    return "<button class='btn btn-primary button gform_button' id='gform_submit_button_{$form['id']}'><span>{$label}</span></button>";
}

