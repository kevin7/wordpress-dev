<?php
/****************** Base ******************/
// Foundation
require_once( 'includes/tidy.php' );
require_once( 'includes/cms.php' );
require_once( 'includes/blocks.php' );
require_once( 'includes/cpt.php' );

// Plugins
require_once( 'includes/acf.php' );
require_once( 'includes/gf.php' );
require_once( 'includes/theme.php' );

// Custom
require_once( 'includes/walker.php' );
require_once( 'includes/shortcode.php' );
require_once( 'includes/ajax.php' ); 


/****************** Theme specific ******************/

// --------------------------------------------
// Custom Post Types
// --------------------------------------------
function base_cpt() {

  // Program CPT
  $settings = array(
    'supports' => array('title', 'page-attributes'), 
    'menu_icon' => 'dashicons-media-text');
  add_cpt('program', 'Program', 'Programs', $settings);
  add_cpt_tax('mode', array('program'), 'Mode', 'Modes');

  // Person CPT
  add_cpt('person', 'Person', 'Persons');

}

// --------------------------------------------
// BLocks
// --------------------------------------------
function base_blocks() {
  add_block('page-hero', 'Page Hero');
  add_block('hero', 'Hero');
  add_block('faq', 'FAQs');
  add_block('resource-list', 'Resource List');
}