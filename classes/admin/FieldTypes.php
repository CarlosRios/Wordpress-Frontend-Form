<?php

class FieldTypes extends Field{

	public static $types = [
		'text'			=> 'Text',
		'email'			=> 'Email',
		'phone'			=> 'Phone',
		'textarea'		=> 'Textarea',
		'select'		=> 'Select'
	];

	public static function getTypeItems()
	{
		foreach( self::$types as $type => $label ){
			$html .= '<li id="'.$type.'" class="ftp-list-item ftp-field">';
				$html .= '<div class="ftp-header">';
					$html .= '<h4 class="ftp-field-label">';
						$html .= '<span class="ftp-header-label">'.$label.' Field</span> ';
						$html .= '<span class="ftp-header-field-type">('.$type.')</span>';
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

}