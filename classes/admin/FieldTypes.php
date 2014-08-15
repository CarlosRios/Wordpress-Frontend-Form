<?php

class FieldTypes extends Field{

	/**
	* All field types must be placed here and have a corresponding static function
	*/
	private static $_fields_post = [
		'post_title'	=> 'Title',
		'post_content'	=> 'Content',
	];

	private static $_fields_basic = [
		'text'			=> 'Text',
		'email'			=> 'Email',
		'phone'			=> 'Phone',
		'textarea'		=> 'Textarea',
		'select'		=> 'Select',
		'radio'			=> 'Radio'
	];

	private static $_fields_advanced = [
		'upload'		=> 'File Upload'
	];

	/**
	* Returns formatted html list for all the field types
	*/
	public static function getTypeItems($page = 'post')
	{	
		switch($page){
			case 'post':
				$types = self::$_fields_post;
			break;
			case 'basic':
				$types = self::$_fields_basic;
			break;
			case 'advanced':
				$types = self::$_fields_advanced;
			break;
		}

		foreach( $types as $type => $label ){
			$html .= '<li id="'.$type.'" class="ftp-list-item ftp-field">';
				$html .= '<div class="ftp-header">';
					$html .= '<h4 class="ftp-field-label">';
						$html .= '<span class="ftp-header-label">'.$label.' Field</span> ';
					$html .= '</h4>';
				$html .= '</div>';
			$html .= '</li>';
		}
		return $html;
	}

	public static function text($field, $row)
	{
		$html = self::standardSettings($field, $row);
		//$html .= self::placeholder($field, $row);
		return $html;
	}

	public static function select($field, $row)
	{
		$html = self::standardSettings($field, $row);
		$html .= Input::text($field['id'] . '_options', 'ftp_fields['.$row.']['.$field['id'].'][options]', 'Field Options', $field['options'], '', 'Enter a comma separated list');
		return $html;
	}

	public static function textarea($field, $row)
	{
		$html = self::standardSettings($field, $row);
		return $html;
	}

	public static function email($field, $row)
	{
		$html = self::standardSettings($field, $row);
		return $html;
	}

	public static function phone($field, $row)
	{
		$html = self::standardSettings($field, $row);
		return $html;
	}

	public static function post_title($field, $row)
	{
		$html = self::postContentSettings($field, $row);
		return $html;
	}

	public static function post_content($field, $row)
	{
		$html = self::postContentSettings($field, $row);
		return $html;
	}

}