<?php
use WPFF\Core\Frontend\Form;

/**
* Shortcodes
* @param array $atts
*/
function get_wpff_form($atts){
	$form = new Form($atts['id']);
	echo $form->show();
}
add_shortcode('wpff', 'get_wpff_form');

/**
* Returns a form for use in a plugin or theme
* @param integer $id
*/
function get_wpff($id)
{
	$form = new Form($id);
	echo $form->show();
}

/**
* Checks if value is set and returns value or default it isn't set
* @param string $value
* @param string $default
*/
function valueOrDefault( $value = null, $default )
{
	if(!is_null($value) && $value != ''){
		return $value;
	}
	return $default;
}

/**
* Checks if field is blank
* @param array $field
* @return bool
*/
function wpffIsEmptyField($field)
{
	if( count($field) === 2 )
		return true;

	return false;
}

function wpffGetForms()
{
	global $wpdb;
	$forms = $wpdb->get_results("SELECT ID, post_title FROM $wpdb->posts WHERE post_type='wpfrontendform' AND post_status='publish'", ARRAY_A);
	return $forms;
}

/**
* Returns a random ID
*/
function wpffNewID( $prefix )
{
	return $prefix . uniqid();
}

/**
* Converts integer into word
* @param integer $number
*/
function numberToWord($number)
{
	$numbers = array(
		1	=> 'one',
		2	=> 'two',
		3 	=> 'three',
		4	=> 'four',
		5	=> 'five',
		6	=> 'six',
		7	=> 'seven',
		8 	=> 'eight',
		9	=> 'nine',
		10	=> 'ten',
		11	=> 'eleven',
		12	=> 'twelve'
	);
	return $numbers[ $number ];
}