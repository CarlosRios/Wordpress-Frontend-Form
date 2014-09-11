<?php
add_action('init', function(){
	register_post_type('wpfrontendform', [
		'labels'				=> [
			'name'					=> __('Forms', 'wpfrontendform'),
			'singular_name' 		=> __('Form', 'wpfrontendform'),
			'add_new'				=> __('Create A Form', 'wpfrontendform'),
			'add_new_item'			=> __('Create A Form', 'wpfrontendform'),
			'edit_item'				=> __('Edit Form', 'wpfrontendform'),
			'new_item'				=> __('New Form', 'wpfrontendform'),
			'view_item'				=> __('View Form', 'wpfrontendform'),
			'search_items'			=> __('Search Forms', 'wpfrontendform'),
			'not_found'				=> __('No Forms Found', 'wpfrontendform'),
			'not_found_in_trash'	=> __('No Forms Found In Trash', 'wpfrontendform'),
			'parent_item_colon'		=> __('Parent Form:', 'wpfrontendform')
		],
		'public'				=> false,
		'publicly_queryable'	=> false,
		'show_ui'				=> true,
		'menu_position'			=> 5,
		'menu_icon'				=> 'dashicons-format-aside',
		'capability_type'		=> 'post',
		'hierachical'			=> false,
		'has_archive'			=> false,
		'supports'				=> [
			'title',
		]
	]);
});