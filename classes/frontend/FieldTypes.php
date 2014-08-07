<?php

class FieldTypes extends Field {

	public static function text($field)
	{
		$html = '<input id="'.$field['id'].'" name="'.$field['id'].'" type="text" placeholder="'.$field['placeholder'].'" value="'.self::postedData($field['id']).'">';
		return $html;
	}

	public static function select($field)
	{
		$html = '<select id="'.$field['id'].'" name="'.$field['id'].'">';
		$options = $field['options'];
		$options = explode(',', $options);
		foreach($options as $option => $value){
			if( $option = self::postedData($field['id']) ){
				$html .= '<option selected value="'.$value.'">'.$value.'</option>';
			}else{
				$html .= '<option value="'.$value.'">'.$value.'</option>';
			}
		}
		$html .= '</select>';
		return $html;
	}

	public static function textarea($field)
	{
		$html = '<textarea id="'.$field['id'].'" rows="3" name="'.$field['id'].'" columns="6">'.self::postedData($field['id']).'</textarea>';
		return $html;
	}

	public static function email($field)
	{
		$html = '<input id="'.$field['id'].'" name="'.$field['id'].'" type="email" placeholder="'.$field['placeholder'].'" value="'.self::postedData($field['id']).'">';
		return $html;
	}

	public static function phone($field)
	{
		$html = 'Phone';
		return $html;
	}

	public static function post_title($field)
	{
		$html = '<input id="'.$field['id'].'" name="'.$field['id'].'" type="text" placeholder="'.$field['placeholder'].'" value="'.self::postedData($field['id']).'">';
		return $html;
	}

	public static function post_content($field)
	{
		$html = '<textarea id="'.$field['id'].'" rows="3" name="'.$field['id'].'" columns="6">'.self::postedData($field['id']).'</textarea>';
		return $html;
	}

}