<?php
add_action('init', function(){
	register_post_type('formtopost', [
		'labels'				=> [
			'name'					=> __('Forms', 'formtopost'),
			'singular_name' 		=> __('Form', 'formtopost'),
			'add_new'				=> __('Create A Form', 'formtopost'),
			'add_new_item'			=> __('Create A Form', 'formtopost'),
			'edit_item'				=> __('Edit Form', 'formtopost'),
			'new_item'				=> __('New Form', 'formtopost'),
			'view_item'				=> __('View Form', 'formtopost'),
			'search_items'			=> __('Search Forms', 'formtopost'),
			'not_found'				=> __('No Forms Found', 'formtopost'),
			'not_found_in_trash'	=> __('No Forms Found In Trash', 'formtopost'),
			'parent_item_colon'		=> __('Parent Form:', 'formtopost')
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