<?php

/**
* Custom columns for each post type.
*/
add_filter( 'manage_edit-wpfrontendform_columns', function($columns){
	$columns = array(
		"cb" => "<input type=\"checkbox\" />",
		"form_title" => __('<span class="dashicons dashicons-format-aside wpff-column-dashicon"></span>Form', 'wpff'),
	); 
	return $columns;
});

add_action( 'manage_wpfrontendform_posts_custom_column', function($column){
	global $post;
	$custom = get_post_custom();
	switch ($column){
		case "form_title":
			echo '<strong><a class="row-title" href="'.admin_url('post.php?post='.$post->ID).'&action=edit">'.$post->post_title.'</a></strong><br>';
			echo '<div class="row-actions">';
			echo '<span class="wpff-form-id">Form ID: '.$post->ID.' | </span>';
			echo '<span class="edit"><a href="'.admin_url('post.php?post='.$post->ID).'&action=edit">Edit</a> | </span>';
			echo '<span class="view"><a href="'.get_permalink($post->ID).'">View</a></span>';
			echo '</div>';
		break;
	}
});