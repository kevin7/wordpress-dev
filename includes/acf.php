<?php
/*
ACF specific functions & Hook
*/

// --------------------------------------------
// Add Theme settings in admin
// --------------------------------------------
if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page(array(
		'page_title' 	=> 'Theme settings',
		'menu_title'	=> 'Theme settings',
		'menu_slug' 	=> 'theme-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));
}


// --------------------------------------------
// Link Component functions
// --------------------------------------------
function make_link($field_name = 'link', $classes = '', $post_id = null)
{
    if (!get_field($field_name, $post_id)) {
        return null;
    }

    $link = format_link(get_field($field_name, $post_id), $classes);

    return $link;
}

function make_sub_link($field_name = 'link', $classes = '')
{
    if (!get_sub_field($field_name)) {
        return null;
    }

    $link = format_link(get_sub_field($field_name), $classes);

    return $link;
}


function format_link($link, $classes = '')
{
    $formatted_link = new \stdClass();

    $formatted_link->target = $link['link_target'];
    $formatted_link->type = $link['link_type'];
    $formatted_link->text = $link['link_text'];
    $formatted_link->scroll_to = $link['link_scroll'];
    $formatted_link->url = null;
    if(isset($link['link_' . $link['link_type']])) {
        $formatted_link->url = $link['link_' . $link['link_type']];
    }
    $formatted_link->attributes = '';
    $formatted_link->classes = $classes;

    switch($formatted_link->type) {

        case "scroll":
        $formatted_link->attributes = "data-scroll-to=" . str_replace('#', '', $formatted_link->scroll_to);
        break;   

        case "modal":
        $formatted_link->attributes = "data-modal-open";
        break;   

        case "url" :    
        if($formatted_link->target) {
            $formatted_link->attributes = "target='_blank'";
        }
        break;

        case "file" :    
        if($formatted_link->target) {
            $formatted_link->attributes = "target='_blank'";
        }
        break;      
    }

    return $formatted_link;
}

/**
 * Render template part, exposing variables as needed.
 *
 * @param string $slug
 * @param array $params
 * @param bool $output
 *
 * @return mixed
 */
function render($slug, $params = null, $output = true)
{
    if (!$output) {
        ob_start();
    }

    if (!$template_file = locate_template("template-parts/{$slug}.php", false, false)) {
        trigger_error(sprintf("Error locating %s for inclusion", $slug), E_USER_ERROR);
    }

    if ($params) {
        if (is_object($params)) {
            $params = (array) $params;
        }
        extract($params, EXTR_OVERWRITE);
    }

    require($template_file);

    if (!$output) {
        return ob_get_clean();
    }
}

