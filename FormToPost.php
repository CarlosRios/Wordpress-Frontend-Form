<?php
/**
* @package WordPress Form To Post
* @author Carlos Rios
* @version 0.1.9
*/
/*
Plugin Name: Form To Post
Plugin URI: http://www.1kingdomcreative.com
Description: Creates a form that is used to populate a post type with custom meta keys.
Author: Carlos Rios
Version: 0.1.9
Author URI: http://www.1kingdomcreative.com
*/

/**
* Autoload classes for admin and frontend
*/
spl_autoload_register(function($class){
	if ( class_exists( $class, false ) )
		return;

	// for PHP versions < 5.3
	$dir = dirname( __FILE__ );

	if(is_admin()){
		$file = "$dir/classes/admin/$class.php";
	}else{
		$file = "$dir/classes/frontend/$class.php";
	}

	if ( file_exists( $file ) )
		require_once( $file );
});

/**
* Definitions
*/
define( 'FTP_DIR', dirname(__FILE__) . '/' );
define( 'FTP_URL', plugins_url('', __FILE__) );

/**
* Require necessary files
*/
require_once FTP_DIR . '/includes/functions.php';
require_once FTP_DIR . '/includes/post-types.php';
require_once FTP_DIR . '/includes/actions.php';