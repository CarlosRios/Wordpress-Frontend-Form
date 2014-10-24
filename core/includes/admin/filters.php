<?php

/**
 * Post type column management
 */
add_filter( 'manage_edit-wpfrontendform_columns', function($columns){
	$columns = array(
		"cb" => "<input type=\"checkbox\" />",
		"form_title" => __('<span class="dashicons dashicons-format-aside wpff-column-dashicon"></span>Form', 'wpff'),
	); 
	return $columns;
});