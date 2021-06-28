<?php
/*
This file handles the cleanup and removal of unused scripts and styling
*/

// --------------------------------------------
// Clean up WordPress head
// --------------------------------------------
add_action( 'init', 'base_head_cleanup' );
function base_head_cleanup() {
	remove_action('wp_head', 'wp_generator');
	remove_action('wp_head', 'feed_links', 2);
	remove_action('wp_head', 'feed_links_extra', 3);
	remove_action('wp_head', 'index_rel_link');
	remove_action('wp_head', 'wlwmanifest_link');
	remove_action('wp_head', 'start_post_rel_link', 10);
	remove_action('wp_head', 'parent_post_rel_link', 10);
	remove_action('wp_head', 'adjacent_posts_rel_link', 10);
	remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10);
	remove_action('wp_head', 'wp_shortlink_wp_head', 10);
}


// --------------------------------------------
// A better title
// --------------------------------------------
add_filter( 'wp_title', 'rw_title', 10, 3 );
function rw_title( $title, $sep, $seplocation ) {
  global $page, $paged;

  // Don't affect in feeds.
  if ( is_feed() ) return $title;

  // Add the blog's name
  if ( 'right' == $seplocation ) {
    $title .= get_bloginfo( 'name' );
  } else {
    $title = get_bloginfo( 'name' ) . $title;
  }

  // Add the blog description for the home/front page.
  $site_description = get_bloginfo( 'description', 'display' );

  if ( $site_description && ( is_home() || is_front_page() ) ) {
    $title .= " {$sep} {$site_description}";
  }

  // Add a page number if necessary:
  if ( $paged >= 2 || $page >= 2 ) {
    $title .= " {$sep} " . sprintf( __( 'Page %s', 'dbt' ), max( $paged, $page ) );
  }

  return $title;

}


// --------------------------------------------
// Remove WP version from RSS & Scripts
// --------------------------------------------
add_filter( 'the_generator', 'base_rss_version' );
function base_rss_version() { return ''; }

add_filter( 'style_loader_src', 'base_remove_wp_ver_css_js', 9999 ); // remove WP version from css
add_filter( 'script_loader_src', 'base_remove_wp_ver_css_js', 9999 ); // remove Wp version from scripts
function base_remove_wp_ver_css_js( $src ) {
	if ( strpos( $src, 'ver=' ) )
		$src = remove_query_arg( 'ver', $src );
	return $src;
}

// --------------------------------------------
// Remove injected CSS for recent comments widget
// --------------------------------------------
add_filter( 'wp_head', 'base_remove_wp_widget_recent_comments_style', 1 );
function base_remove_wp_widget_recent_comments_style() {
	if ( has_filter( 'wp_head', 'wp_widget_recent_comments_style' ) ) {
		remove_filter( 'wp_head', 'wp_widget_recent_comments_style' );
	}
}

// --------------------------------------------
// Remove injected CSS for recent comments widget
// --------------------------------------------

add_filter( 'wp_head', 'base_remove_wp_widget_recent_comments_style', 1 );
function base_remove_recent_comments_style() {
	global $wp_widget_factory;
	if (isset($wp_widget_factory->widgets['WP_Widget_Recent_Comments'])) {
		remove_action( 'wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style') );
	}
}

// --------------------------------------------
// Remove injected CSS from gallery
// --------------------------------------------
add_filter( 'gallery_style', 'base_gallery_style' );
function base_gallery_style($css) {
	return preg_replace( "!<style type='text/css'>(.*?)</style>!s", '', $css );
}


// --------------------------------------------
// Scripts * Enqueueing
// --------------------------------------------
add_action( 'wp_enqueue_scripts', 'base_scripts_and_styles', 999 );
function base_scripts_and_styles() {

  if (!is_admin()) {

		// register main stylesheet
		wp_register_style( 'base-css', get_stylesheet_directory_uri() . '/dist/css/main.css?v='.date('YmdHis'), array(), '', 'all' );

		// adding scripts file in the footer
		wp_register_script( 'base-js', get_stylesheet_directory_uri() . '/dist/js/main.js?v='.date('YmdHis'), array( 'jquery' ), '', true );

		// enqueue styles and scripts
		wp_enqueue_style( 'base-css' );
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'base-js' );

	}
}


// --------------------------------------------
// Remove the p from around imgs
// --------------------------------------------
add_filter( 'the_content', 'base_filter_ptags_on_images' );
function base_filter_ptags_on_images($content){
	return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}


// --------------------------------------------
// Disable the emoji's
// --------------------------------------------
add_action( 'init', 'disable_emojis' );
function disable_emojis() {
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' ); 
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' ); 
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
	add_filter( 'wp_resource_hints', 'disable_emojis_remove_dns_prefetch', 10, 2 );
 }

function disable_emojis_tinymce( $plugins ) {
	if ( is_array( $plugins ) ) {
		return array_diff( $plugins, array( 'wpemoji' ) );
	} else {
		return array();
	}
}
	
function disable_emojis_remove_dns_prefetch( $urls, $relation_type ) {
	if ( 'dns-prefetch' == $relation_type ) {
		/** This filter is documented in wp-includes/formatting.php */
		$emoji_svg_url = apply_filters( 'emoji_svg_url', 'https://s.w.org/images/core/emoji/2/svg/' );

		$urls = array_diff( $urls, array( $emoji_svg_url ) );
	}

	return $urls;
}
?>
