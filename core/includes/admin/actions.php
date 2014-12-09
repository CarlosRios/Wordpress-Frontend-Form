<?php

use WPFF\Controller;

/**
 * Scripts & Styles
 */
add_action( 'admin_enqueue_scripts', function()
{
	// Load Scripts
	wp_enqueue_script('jquery-ui-droppable');
	wp_enqueue_script('jquery-ui-draggable');
	wp_enqueue_script('jquery-ui-sortable');
	wp_enqueue_script('jquery-ui-resizable');
	wp_enqueue_script('jquery-livequery', WPFF_URL . '/assets/js/jquery.livequery.min.js', 'jquery');
	wp_enqueue_script('material', WPFF_URL . '/assets/js/menu.js', 'jquery' );
	wp_localize_script('material', 'material', array('ajaxurl' => admin_url('admin-ajax.php')) );
	
	// Load Styles
	wp_enqueue_style( 'roboto-font', 'http://fonts.googleapis.com/css?family=Roboto:400,300,300italic,400italic,700,500' );
	wp_enqueue_style( 'animate', WPFF_URL . '/assets/css/animate.min.css' );
	wp_enqueue_style( 'material-grid', WPFF_URL . '/assets/css/grid.css' );
	wp_enqueue_style('material-admin', WPFF_URL . '/assets/css/admin.css');
});

/**
 * Add metabox to form builder
 */
add_action( 'add_meta_boxes', function()
{
	add_meta_box( 'formbuilder', 'Form Builder', function(){
		Controller::get( 'BuilderController@index' );
	}, 'wpfrontendform', 'advanced', 'default' );
});

/**
 * Save the data upon save post action
 */
add_action( 'save_post', function( $postid )
{
	$data = array(
		'postId'	=> $postid,
		'options'	=> $_POST['form_options'],
		'fields'	=> $_POST['form_fields']
	);
	Controller::get( 'BuilderController@update', $data );
});

/**
 * Ajax for loading a page.
 */
add_action( 'wp_ajax_formLoadController', function(){
	Controller::get( $_POST['controller'], $_POST['variables'] ? $_POST['variables'] : array() );
	die;
});
add_action( 'wp_ajax_nopriv_formLoadController', function(){
	Controller::get( $_POST['controller'], $_POST['variables'] ? $_POST['variables'] : array() );
	die;
});

/**
 * Menu Interactions
 */
add_action( 'admin_menu', function(){
	global $menu;

	foreach($menu as $item => $value)
	{
		// Check if menu item is a post type edit page.
		$url = $menu[$item][2];
		$url = explode('?', $url);

		if( $url[0] == 'edit.php')
		{
			if( ! $url[1] ) // Specifically for "post" post type
			{
				$count = get_transient('wpff_count_post');
			}
			else
			{
				$pt = str_replace('post_type=', '', $url[1]);
				$count = get_transient('wpff_count_' . $pt);
			}

			if( $count ){
				$menu[$item][0] .= ' <span class="wpff-post-count update-plugins count-'.$count.'"><span class="plugin-count">'. number_format_i18n($count).'</span></span>';
			}
		}
	}
});

/**
 * Update notification bubble upon publish of pending item.
 */
add_action( 'pending_to_publish', function( $post ){
	$wpff = get_post_meta($post->ID, 'wpff_created_post', true);
	if( !empty($wpff) ){
		$count = get_transient('wpff_count_' . $wpff);
		if( $count != 0 ){
			set_transient( 'wpff_count_' . $wpff, $count - 1, 0 );
		}
	}
}, 10, 1 );

/**
 * Action to handle what is in the post type columns
 */
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