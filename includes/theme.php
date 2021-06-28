<?php

// --------------------------------------------
// Theme supports
// --------------------------------------------
add_action( 'after_setup_theme', 'base_theme_support' );
function base_theme_support() {

	// wp thumbnails (sizes handled in functions.php)
	add_theme_support( 'post-thumbnails' );

	// default thumb size
	set_post_thumbnail_size(125, 125, true);

	// wp custom background (thx to @bransonwerner for update)
	add_theme_support( 'custom-background',
	    array(
	    'default-image' => '',    // background image default
	    'default-color' => '',    // background color default (dont add the #)
	    'wp-head-callback' => '_custom_background_cb',
	    'admin-head-callback' => '',
	    'admin-preview-callback' => ''
	    )
	);

	// rss thingy
	add_theme_support('automatic-feed-links');

	// wp menus
	add_theme_support( 'menus' );

	// registering wp3+ menus
	register_nav_menus(
		array(
			'main-nav' => __( 'Main Nav', 'bonestheme' ),   // main nav in header
			'footer-links' => __( 'Footer Nav', 'bonestheme' ) // secondary nav in footer
		)
	);

	// Enable support for HTML5 markup.
	add_theme_support( 'html5', array(
		'comment-list',
		'search-form',
		'comment-form'
	) );

    add_action( 'widgets_init', 'base_register_sidebars' );

}


// Sidebars & Widgetizes Areas
function base_register_sidebars() {
	register_sidebar(array(
		'id' => 'sidebar1',
		'name' => __( 'Sidebar 1', 'bonestheme' ),
		'description' => __( 'The first (primary) sidebar.', 'bonestheme' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));
} 


// --------------------------------------------
// Image sizes
// --------------------------------------------
add_image_size('post', 865, 535, true);
add_image_size('post-thumbnail', 510, 375, true);
add_image_size('square', 600, 600, true);
add_image_size('square-small', 250, 250, true);
add_image_size('hero', 1440, 785, true);

// Add the media select drop down in admin
add_filter( 'image_size_names_choose', 'base_custom_image_sizes' );
function base_custom_image_sizes( $sizes ) {
    return array_merge( $sizes, array(
        'post' => __('865px by 535px'),
        'post-thumbnail' => __('510px by 375px'),
        'square' => __('600px by 600px'),
        'square-small' => __('250px by 250px'),
        'hero' => __('1440px by 785px')
    ) );
}


// --------------------------------------------
// Pagination
// --------------------------------------------

function base_post_navi() {
  global $wp_query;
  $bignum = 999999999;
  if ( $wp_query->max_num_pages <= 1 )
    return;
  echo '<nav class="pagination">';
  echo paginate_links( array(
    'base'         => str_replace( $bignum, '%#%', esc_url( get_pagenum_link($bignum) ) ),
    'format'       => '',
    'current'      => max( 1, get_query_var('paged') ),
    'total'        => $wp_query->max_num_pages,
    'prev_text'    => '<i class="icon-left-open-big"></i>',
    'next_text'    => '<i class="icon-right-open-big"></i>',
    'type'         => 'list',
    'end_size'     => 3,
    'mid_size'     => 3
  ) );
  echo '</nav>';
} /* end page navi */

function base_cpt_navi($max_num_pages) {
  global $wp_query;
  $bignum = 999999999;

  if ( $max_num_pages <= 1 )
    return;
  echo '<nav class="pagination">';
  echo paginate_links( array(
    'base'         => str_replace( $bignum, '%#%', esc_url( get_pagenum_link($bignum) ) ),
    'format'       => '',
    'current'      => max( 1, get_query_var('paged') ),
    'total'        => $max_num_pages,
    'prev_text'    => '<i class="icon-left-open-big"></i>',
    'next_text'    => '<i class="icon-right-open-big"></i>',
    'type'         => 'list',
    'end_size'     => 3,
    'mid_size'     => 3
  ) );
  echo '</nav>';
} /* end page navi */

function base_custom_navi($max_num_pages, $paged, $url) {

	echo '<nav class="pagination">';
	echo '<ul class="page-numbers">';
	for ($i=1; $i<=$max_num_pages; $i++) {
		$current = '';
		if ($paged == $i) $current = 'current';

		if ($paged != 1 && $i==1) {
			$page = $paged-1;
			echo "<li><a data-page='{$page}' href='{$url}/page/{$page}' class='prev'><i class='icon-left-open-big'></i></a></li>";
		}

		echo "<li><a data-page='{$i}'  class='page-numbers {$current}' href='{$url}/page/{$i}'>{$i}</a></li>";

		if ($paged != $max_num_pages && $max_num_pages > 1 && $i == $max_num_pages) {
			$page = $paged+1;
			echo "<li><a data-page='{$page}' href='{$url}/page/{$page}' class='next'><i class='icon-right-open-big'></i></a></li>";
		}
		
	}
	echo '</ul></nav';

}


// --------------------------------------------
// Retrieve WP feature image
// --------------------------------------------
function getPostImage($id=false, $size='single-post-thumbnail') {

    if (!$id) $id = get_the_ID();

    if (@has_post_thumbnail( $id ) ) {
        $image = wp_get_attachment_image_src( get_post_thumbnail_id( $id ), $size );
        return $image[0];
    } else {
        return false;
    }
}


// --------------------------------------------
// This removes the annoying […] to a Read More link
// --------------------------------------------
add_filter('excerpt_more','base_excerpt_more',11);

// Changing excerpt more
function base_excerpt_more($more) {
	global $post;
	remove_filter('excerpt_more', 'base_excerpt_more'); 
	return '...';
}  


// --------------------------------------------
// Control the lenght of excerpt
// --------------------------------------------
function custom_excerpt_length( $length ) {
	global $post;
  
	if ($post->post_type == 'post') {
	  return 20;
	} else if ($post->post_type == 'people') {
	  return 25;
	}
  }
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );  