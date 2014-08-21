<?php
/**
* @package WordPress Frontend Form
* @author Carlos Rios
* @version 0.2
*/
/*
Plugin Name: WordPress Frontend Form
Plugin URI: http://www.csrios.com
Description: Creates a form that is used to populate a post type with custom meta keys.
Author: Carlos Rios
Version: 0.2
Author URI: http://www.csrios.com
*/

/**
* Define Constants
*/
define( 'WPFF_DIR', dirname(__FILE__) . '/' );
define( 'WPFF_URL', plugins_url('', __FILE__) );
define( 'WPFF_CURRENT_PAGE', basename($_SERVER['PHP_SELF']) );

/**
* Autoload classes for admin and frontend
*/
spl_autoload_register(function($class){
	if ( class_exists( $class, false ) )
		return;

	if(is_admin()){
		$file = WPFF_DIR . "classes/admin/$class.php";
	}else{
		$file = WPFF_DIR . "classes/frontend/$class.php";
	}

	if ( file_exists( $file ) )
		require_once( $file );
});

/**
* Require necessary files
*/
require_once WPFF_DIR . '/includes/functions.php';
require_once WPFF_DIR . '/includes/post-types.php';
require_once WPFF_DIR . '/includes/post-type-columns.php';
require_once WPFF_DIR . '/includes/actions.php';