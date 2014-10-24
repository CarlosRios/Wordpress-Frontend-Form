<?php

/**
 * Scripts & Styles
 */
add_action( 'wp_enqueue_scripts', function(){

	/**
	 * Load Scripts
	 */
	wp_enqueue_script( 'modernizr', WPFF_URL . '/assets/js/modernizr-2.6.2.min.js', array('jquery') );
	wp_enqueue_script( 'gumby', WPFF_URL . '/assets/js/gumby.js', array('jquery') );
	wp_enqueue_script( 'gumby-init', WPFF_URL . '/assets/js/gumby.init.js', array('jquery') );
	wp_enqueue_script( 'gumby-checkbox', WPFF_URL . '/assets/js/ui/gumby.checkbox.js');
	wp_enqueue_script( 'gumby-radiobtn', WPFF_URL . '/assets/js/ui/gumby.radiobtn.js');

	/**
	 * Load Styles
	 */
	wp_enqueue_style( 'wpff-frontend', WPFF_URL . '/assets/css/frontend.css' );
	wp_enqueue_style( 'wpff-grid', WPFF_URL . '/assets/css/grid.css' );
	wp_register_style( 'wpff-gumby', WPFF_URL . '/assets/css/gumby.css' );

});