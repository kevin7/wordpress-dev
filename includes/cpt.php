<?php

function add_cpt($name, $single, $plural, $args = array()) 
{

	$settings = array( 
			
		'labels' => array(
			'name' => $plural,
			'singular_name' => $single,
			'all_items' => 'All ' . $plural,
			'add_new' => 'Add New',
			'add_new_item' => 'Add New ' . $single,
			'edit' => 'Edit',
			'edit_item' => 'Edit' . $single,
			'new_item' => 'New' . $single,
			'view_item' => 'View ' . $single,
			'search_items' => 'Search' . $single,
			'not_found' =>  'Nothing found in the Database.',
			'not_found_in_trash' => 'Nothing found in Trash',
			'parent_item_colon' => ''
		), 
		'description' => $plural,
		'public' => false,
		'publicly_queryable' => true,
		'exclude_from_search' => false,
		'show_ui' => true,
		'query_var' => true,
		'menu_position' => 8,
		'menu_icon' => 'dashicons-screenoptions',
		'rewrite'	=> array( 'slug' => $name, 'with_front' => false ), 
		'has_archive' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'supports' => array('title', 'page-attributes', 'editor', 'thumbnail'),
		'show_in_rest'       => false
	);

	if (count($args) > 0) $settings = array_merge($settings, $args);

	register_post_type( $name, $settings); 

}

function add_cpt_tax($name, $cpt_name, $single, $plural, $args = array())
{
	
	$settings = array(
		'hierarchical' => false, 
		'labels' => array(
			'name' => $plural,
			'singular_name' => $single,
			'search_items' =>  'Search ' . $plural,
			'all_items' => 'All ' . $plural,
			'parent_item' => 'Parent ' . $single,
			'parent_item_colon' => 'Parent ' . $single . ':',
			'edit_item' => 'Edit ' . $single,
			'update_item' => 'Update ' . $single,
			'add_new_item' => 'Add New ' . $single,
			'new_item_name' => 'New ' . $single . ' Name'
		),
		'show_admin_column' => true, 
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => array( 'slug' => $name ),
		'show_in_rest'       => false
	);

	if (count($args) > 0) $settings = array_merge($settings, $args);

	register_taxonomy( $name, 
		$cpt_name, 
		$settings
	);
}

add_action( 'init', 'base_cpt');