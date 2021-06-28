<?php 
/*
** Gutenberg block + ACF block
*/

// --------------------------------------------
// Add custom block layouts
// --------------------------------------------
add_action('acf/init', 'base_blocks');

function add_block($name, $label)
{
	// check function exists
	if( function_exists('acf_register_block') ) {

		acf_register_block(array(
			'name'				=> $name,
			'title'				=> $label,
			'description'		=> $label,
			'render_callback'	=> 'block_render_callback',
			'category'			=> 'custom-layouts',
			'icon'				=> 'format-aside',
			'mode'              => 'edit',
			'keywords'			=> explode(' ', $label),
			'example'         => array(
					'attributes' => array(
					'mode' => 'preview',
					'data' => array('data')
				),
			),
		)); 

	}	
}


// --------------------------------------------
// Render custom block template files
// --------------------------------------------
function block_render_callback( $block, $content = '', $is_preview = false  ) {

	// convert name ("acf/testimonial") into path friendly slug ("testimonial")
	$slug = str_replace('acf/', '', $block['name']);

	// back-end previews 
	if ( $is_preview && ! empty( $block['data'])) {
		echo '<img src="' . get_template_directory_uri() . '/template-parts/previews/' . $slug . '.png">';
		return;
	}
	
	// include a template part from within the "template-parts/block" folder
	if( file_exists( get_theme_file_path("/template-parts/blocks/block-{$slug}.php") ) ) {
		include( get_theme_file_path("/template-parts/blocks/block-{$slug}.php") );
	}
}


// --------------------------------------------
// Add custom layouts block category
// --------------------------------------------
add_filter( 'block_categories', 'base_block_categories' );
function base_block_categories( $categories ) {
	$category_slugs = wp_list_pluck( $categories, 'slug' );
	return array_merge(
			$categories,
			array(
					array(
							'slug'  => 'custom-layouts',
							'title' => __( 'Custom Layouts', 'bones' ),
							'icon'  => null,
					),
			)
	);
}


// --------------------------------------------
// Hide some blocks for page post type
// --------------------------------------------
add_filter( 'allowed_block_types', 'base_allowed_block_types', 10, 2 );
function base_allowed_block_types( $allowed_block_types ) {

		global $post;

		if ($post->post_type == 'page') {

			$acf_blocks = acf_get_block_types();
			$blocks = array();
			
			foreach ($acf_blocks as $key => $value) {
				$blocks[] = $key;
			}

			$allowed_blocks = array(     
				'core/html',
				'core/separator'
			);

			if (count($blocks) > 0) $allowed_blocks = array_merge($allowed_blocks, $blocks);
			
			return $allowed_blocks;
			
		}

}