<?php

/**
* Shortcodes
* @param array $atts
*/
function get_ftp_form($atts){
	$form = new Form($atts['id']);
	return $form->show();
}
add_shortcode('ftp_form', 'get_ftp_form');

/**
* Converts integer into word
* @param integer $number
*/
function numberToWord($number)
{
	$numbers = [
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
	];
	return $numbers[$number];
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
function ftpIsEmptyField($field)
{
	if( count($field) === 1 )
		return true;

	return false;
}