<?php
/*
This file handles the admin area and functions. You can use this file to make changes to the dashboard.
*/

// --------------------------------------------
// Disable default dashboard widgets
// --------------------------------------------
add_action( 'wp_dashboard_setup', 'base_disable_default_dashboard_widgets' );
function base_disable_default_dashboard_widgets() {
	global $wp_meta_boxes;

	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);    // Right Now Widget
  unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_quick_press']);    // Right Now Widget
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_activity']);        // Activity Widget
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']); // Comments Widget
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);  // Incoming Links Widget
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);         // Plugins Widget

	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_recent_drafts']);     // Recent Drafts Widget
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);           //
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);         //
}


// --------------------------------------------
// Custom Login Page
// --------------------------------------------
function base_login_css() {
	wp_enqueue_style( 'base_login_css', get_template_directory_uri() . '/dist/css/login.css', false );
}

// changing the logo link from wordpress.org to your site
function base_login_url() {  return home_url(); }

// calling it only on the login page
add_action( 'login_enqueue_scripts', 'base_login_css', 10 );
add_filter( 'login_headerurl', 'base_login_url' );


// --------------------------------------------
// Custom Backend Footer
// --------------------------------------------
add_filter( 'admin_footer_text', 'bones_custom_admin_footer' );
function bones_custom_admin_footer() {
	echo '';
}


// --------------------------------------------
// Allow editor syle
// --------------------------------------------
add_editor_style( get_stylesheet_directory_uri() . '/dist/css/editor.css' );


// --------------------------------------------
// Add custom format to Classoc editor
// --------------------------------------------
add_filter( 'tiny_mce_before_init', function ( array $settings = [] ) {

	$formats = [];
	if ( ! empty( $settings['style_formats'] ) && is_string( $settings['style_formats'] ) ) {
			$formats = json_decode( $settings['style_formats'] );
			if ( ! is_array( $formats ) ) {
					$formats = [];
			}
	}
	
	$formats[] = [
		'title'  => 'Paragraph',
		'block' => 'p',
	];

	$formats[] = [
		'title'  => 'Large Paragraph',
		'block' => 'p',
		'classes' => 'lead'
	];

	$formats[] = [
		'title'  => 'Medium Paragraph',
		'block' => 'p',
		'classes' => 'medium'
	];

	$formats[] = [
		'title'  => 'Note',
		'block' => 'p',
		'classes' => 'note'
	];

	$formats[] = [
		'title'  => 'Text link - underlined',
		'inline' => 'a',
		'classes' => 'text-link'
	];

	$formats[] = [
			'title'  => 'Caption',
			'block' => 'p',
			'classes' => 'caption'
	];

	$formats[] = [
		'title'  => 'Heading 1',
		'block' => 'h1',
	];

	$formats[] = [
		'title'  => 'Heading 2',
		'block' => 'h2',
	];

	$formats[] = [
		'title'  => 'Heading 3',
		'block' => 'h3',
	];

	$formats[] = [
		'title'  => 'Heading 4',
		'block' => 'h4',
	];

	$formats[] = [
		'title'  => 'Heading 5',
		'block' => 'h5',
	];

	$formats[] = [
		'title'  => 'Heading 6',
		'block' => 'h6',
	];

	$settings['style_formats'] = json_encode( $formats );

	return $settings;
} );


// --------------------------------------------
// Enables the Excerpt meta box in Page edit screen
// --------------------------------------------
add_action( 'init', 'base_add_excerpt_support_for_pages' );
function base_add_excerpt_support_for_pages() {
	add_post_type_support( 'page', 'excerpt' );
}



// --------------------------------------------
// Make block editor full width
// --------------------------------------------
add_action('admin_head', 'base_admin_custom_css');
function base_admin_custom_css() {
  echo '<style>
    .wp-block {
      max-width:80%;
	}
  </style>';
}


?>
