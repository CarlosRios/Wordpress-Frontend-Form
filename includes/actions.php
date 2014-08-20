<?php

if(is_admin())
{
	/**
	* Admin Scripts & Styles
	*/
	add_action( 'admin_enqueue_scripts', function(){
		wp_enqueue_script('jquery-ui-droppable');
		wp_enqueue_script('jquery-ui-draggable');
		wp_enqueue_script('jquery-ui-sortable');
		wp_enqueue_script('jquery-ui-resizable');
		wp_register_script( 'wpfrontendform', WPFF_URL . '/assets/js/main.js', 'jquery' );
		wp_enqueue_script( 'wpfrontendform' );
		wp_localize_script( 'wpfrontendform', 'wpfrontendform', ['ajaxurl' => admin_url( 'admin-ajax.php' )] );
		wp_enqueue_style( 'wpff-style-admin', WPFF_URL . '/assets/css/style.css' );
		wp_enqueue_style('wpff-grid', WPFF_URL . '/assets/css/grid.css');
	});

	/**
	* Generate metaboxes for settings and form builder
	*/
	add_action( 'add_meta_boxes', function(){
		add_meta_box( 'formsettings', 'Form Settings', function(){
			$settings = new Settings;
		}, 'wpfrontendform', 'advanced', 'high');
		add_meta_box( 'formbuilder', 'Form Builder', function(){
			$form_builder = new FormBuilder;
		}, 'wpfrontendform', 'advanced', 'high' );
	});

	/**
	* Save Form
	*/
	add_action( 'save_post', function($postid){
		update_post_meta($postid, 'wpff_options', $_POST['wpff_options']);
		update_post_meta($postid, 'wpff_fields', $_POST['wpff_fields']);
		return;
	});

	/**
	* Ajax functions
	*/
	add_action( 'wp_ajax_wpff_add_field', ['FtpAjax', 'createNewField'] );
	add_action( 'wp_ajax_nopriv_wpff_add_field', ['FtpAjax', 'createNewField'] );

	add_action( 'wp_ajax_wpff_add_row', ['FtpAjax', 'createNewRow'] );
	add_action( 'wp_ajax_nopriv_wpff_add_row', ['FtpAjax', 'createNewRow'] );

	add_action( 'wp_ajax_wpff_load_field_types_page', ['FtpAjax', 'loadFieldTypesPage'] );
	add_action( 'wp_ajax_nopriv_wpff_load_field_types_page', ['FtpAjax', 'loadFieldTypesPage'] );

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
					$count = get_transient('wpff_posts_count_post');
				}
				else
				{
					$pt = str_replace('post_type=', '', $url[1]);
					$count = get_transient('wpff_posts_count_' . $pt);
				}

				if( $count ){
					$menu[$item][0] .= ' <span class="wpff-post-count update-plugins count-'.$count.'"><span class="plugin-count">'. number_format_i18n($count).'</span></span>';
				}
			}
		}
	});
}

/**
* Frontend Scripts & Styles
*/
add_action( 'wp_enqueue_scripts', function(){
	wp_enqueue_script( 'modernizr', WPFF_URL . '/assets/js/modernizr-2.6.2.min.js', ['jquery'] );
	wp_enqueue_script( 'gumby', WPFF_URL . '/assets/js/gumby.js', ['jquery']);
	wp_enqueue_script( 'gumby-init', WPFF_URL . '/assets/js/gumby.init.js', ['jquery']);
	wp_enqueue_script( 'gumby-checkbox', WPFF_URL . '/assets/js/ui/gumby.checkbox.js');
	wp_enqueue_script( 'gumby-radiobtn', WPFF_URL . '/assets/js/ui/gumby.radiobtn.js');

	wp_enqueue_style( 'wpff-frontend', WPFF_URL . '/assets/css/frontend.css' );
	wp_enqueue_style( 'wpff-grid', WPFF_URL . '/assets/css/grid.css' );
	wp_register_style( 'wpff-gumby', WPFF_URL . '/assets/css/gumby.css' );
});