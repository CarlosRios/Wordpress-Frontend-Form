<?php

class FieldTypes extends Field{

	public static function text($field)
	{
		$html = '<input id="'.$field['id'].'" type="text" placeholder="'.$field['placeholder'].'">';
		return $html;
	}

	public static function select($field)
	{
		$html = 'Select';
		return $html;
	}

	public static function textarea($field)
	{
		$html = 'Textarea';
		return $html;
	}

	public static function email($field)
	{
		$html = '<input id="'.$field['id'].'" type="email" placeholder="'.$field['placeholder'].'">';
		return $html;
	}

	public static function phone($field)
	{
		$html = 'Phone';
		return $html;
	}

}