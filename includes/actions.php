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
		wp_register_script( 'formtopost', FTP_URL . '/assets/js/main.js', 'jquery' );
		wp_enqueue_script( 'formtopost' );
		wp_localize_script( 'formtopost', 'formtopost', ['ajaxurl' => admin_url( 'admin-ajax.php' )] );
		wp_enqueue_style( 'ftp-style-admin', FTP_URL . '/assets/css/style.css' );
		wp_enqueue_style('ftp-grid', FTP_URL . '/assets/css/grid.css');
	});

	/**
	* Generate metaboxes for settings and form builder
	*/
	add_action( 'add_meta_boxes', function(){
		add_meta_box( 'formsettings', 'Form Settings', function(){
			$settings = new Settings;
		}, 'formtopost', 'advanced', 'high');
		add_meta_box( 'formbuilder', 'Form Builder', function(){
			$form_builder = new FormBuilder;
		}, 'formtopost', 'advanced', 'high' );
	});

	/**
	* Save Form
	*/
	add_action( 'save_post', function($postid){
		update_post_meta($postid, 'ftp_options', $_POST['ftp_options']);
		update_post_meta($postid, 'ftp_fields', $_POST['ftp_fields']);
		return;
	});

	/**
	* Ajax functions
	*/
	add_action( 'wp_ajax_ftp_add_field', ['FtpAjax', 'createNewField'] );
	add_action( 'wp_ajax_nopriv_ftp_add_field', ['FtpAjax', 'createNewField'] );

	add_action( 'wp_ajax_ftp_add_row', ['FtpAjax', 'createNewRow'] );
	add_action( 'wp_ajax_nopriv_ftp_add_row', ['FtpAjax', 'createNewRow'] );

	add_action( 'wp_ajax_ftp_load_field_types_page', ['FtpAjax', 'loadFieldTypesPage'] );
	add_action( 'wp_ajax_nopriv_ftp_load_field_types_page', ['FtpAjax', 'loadFieldTypesPage'] );

	/**
	* Menu Interactions
	*/
	add_action( 'admin_menu', function(){
		global $menu;
		$count = ftpNewPostsCount('posts');

		if( $count )
		{
			foreach( $menu as $key => $value )
			{
				if( $menu[$key][2] == 'edit.php' )
				{
					$menu[$key][0] .= " <span class='update-leads update-plugins count-$count'><span class='lead-count plugin-count'>" . number_format_i18n($count) . '</span></span>';
					return;
				}
			}
		}
	});

}

/**
* Frontend Scripts & Styles
*/
add_action( 'wp_enqueue_scripts', function(){
	wp_enqueue_style( 'ftp-frontend', FTP_URL . '/assets/css/frontend.css' );
	wp_enqueue_style( 'ftp-grid', FTP_URL . '/assets/css/grid.css' );
	wp_register_style( 'ftp-gumby', FTP_URL . '/assets/css/gumby.css' );
});