<?php
use WPFF\Admin\FormBuilder;
use WPFF\Admin\Settings;
use WPFF\Admin\Ajax;

/**
 * Scripts & Styles
 */
add_action( 'admin_enqueue_scripts', function(){

	/**
	 * Load Scripts
	 */
	wp_enqueue_script('jquery-ui-droppable');
	wp_enqueue_script('jquery-ui-draggable');
	wp_enqueue_script('jquery-ui-sortable');
	wp_enqueue_script('jquery-ui-resizable');
	wp_register_script( 'wpfrontendform', WPFF_URL . '/assets/js/main.js', 'jquery' );
	wp_enqueue_script( 'wpfrontendform' );
	wp_localize_script( 'wpfrontendform', 'wpfrontendform', array('ajaxurl' => admin_url( 'admin-ajax.php' )) );
	
	/**
	 * Load Styles
	 */
	wp_enqueue_style( 'wpff-style-admin', WPFF_URL . '/assets/css/style.css' );
	wp_enqueue_style('wpff-admin', WPFF_URL . '/assets/css/admin.css');

});

/**
 * Add metaboxes to display form and settings
 */
add_action( 'add_meta_boxes', function(){

	/**
	 * Form Settings
	 */
	add_meta_box( 'formsettings', 'Form Settings', function(){
		$builder = new Settings;
	}, 'wpfrontendform', 'advanced', 'high');

	/**
	 * Form Builder
	 */
	add_meta_box( 'formbuilder', 'Form Builder', function(){
		$builder = new FormBuilder;
	}, 'wpfrontendform', 'advanced', 'high' );

});

/**
 * Save the data upon save post action
 */
add_action( 'save_post', function( $postid ){
	update_post_meta($postid, 'wpff_options', $_POST['wpff_options']);
	update_post_meta($postid, 'wpff_fields', $_POST['wpff_fields']);
	return;
});

/**
 * Ajax functions
 */
add_action( 'wp_ajax_wpff_add_field', function(){
	return Ajax::createNewField();
});
add_action( 'wp_ajax_nopriv_wpff_add_field', function(){
	return Ajax::createNewField();
});

add_action( 'wp_ajax_wpff_add_row', function(){
	return Ajax::createNewRow();
});
add_action( 'wp_ajax_nopriv_wpff_add_row', function(){
	return Ajax::createNewRow();
});

add_action( 'wp_ajax_wpff_load_field_types_page', function(){
	return Ajax::loadFieldTypesPage();
});
add_action( 'wp_ajax_nopriv_wpff_load_field_types_page', function(){
	return Ajax::loadFieldTypesPage();
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