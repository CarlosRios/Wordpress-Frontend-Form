<?php
/*
Plugin Name: WordPress Frontend Form
Plugin URI: http://wpfrontendforms.lavabucket.co
Description: Creates a form that is used to populate a post type with custom meta keys.
Author: Carlos Rios
Version: 0.4.2
Author URI: http://wpfrontendforms.lavabucket.co
*/

/**
 * Define Constants
 */
define( 'WPFF_DIR', dirname(__FILE__) . '/' );
define( 'WPFF_URL', plugins_url('', __FILE__) );
define( 'WPFF_CURRENT_PAGE', basename($_SERVER['PHP_SELF']) );
define( 'WP_DEBUG', false );

/**
 * Require Autoload File
 */
require_once WPFF_DIR . 'core/autoload.php';