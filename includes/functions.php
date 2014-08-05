<?php
/**
* Functions
*/
function get_ftp_form($atts){
	return Form::getForm($atts['id']);
}
add_shortcode('ftp_form', 'get_ftp_form');

function numberToWord($number)
{
	$numbers = [
		1	=> 'one',
		2	=> 'two',
		3 	=> 'three',
		4	=> 'four',
		5	=> 'five',
	];
	return $numbers[$number];
}