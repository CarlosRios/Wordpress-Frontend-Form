<?php
/*
Plugin Name: WordPress Frontend Form
Plugin URI: http://wpfrontendforms.lavabucket.co
Description: Creates a form that is used to populate a post type with custom meta keys.
Author: Carlos Rios
Version: 0.3
Author URI: http://wpfrontendforms.lavabucket.co
*/

/**
* Define Constants
*/
define( 'WPFF_DIR', dirname(__FILE__) . '/' );
define( 'WPFF_URL', plugins_url('', __FILE__) );
define( 'WPFF_CURRENT_PAGE', basename($_SERVER['PHP_SELF']) );
define( 'WP_DEBUG', true ); // Set to false in development

/**
* Load Required Files.
*/
require_once WPFF_DIR . 'core/autoload.php';

/**
* Require necessary files
*/
require_once WPFF_DIR . 'includes/wpff_functions.php';
require_once WPFF_DIR . 'includes/wpff_post_types.php';
require_once WPFF_DIR . 'includes/wpff_post_type_columns.php';
require_once WPFF_DIR . 'includes/wpff_actions.php';