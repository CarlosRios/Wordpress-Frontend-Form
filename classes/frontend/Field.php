<?php

class Field {

	/**
	* Returns data that has been posted
	* @param string $field_id
	*/
	private static function postedData($field_id)
	{
		return isset($_POST[$field_id]) ? $_POST[$field_id] : '';
	}

	/**
	* Basic Fieldset
	* Description: These are all of the basic html5 fields
	*/
	public static function text($field)
	{
		$html = '<input id="'.$field['id'].'" class="input" name="'.$field['id'].'" type="text" placeholder="'.$field['placeholder'].'" value="'.self::postedData($field['id']).'">';
		return $html;
	}

	public static function select($field)
	{
		$html = '<div class="picker"><select id="'.$field['id'].'" name="'.$field['id'].'">';
		$options = $field['options'];
		$options = explode(',', $options);
		foreach($options as $option => $value){
			if( $value == self::postedData($field['id']) ){
				$html .= '<option selected value="'.$value.'">'.$value.'</option>';
			}else{
				$html .= '<option value="'.$value.'">'.$value.'</option>';
			}
		}
		$html .= '</select></div>';
		return $html;
	}

	public static function textarea($field)
	{
		$html = '<textarea id="'.$field['id'].'" class="input textarea" rows="3" name="'.$field['id'].'" columns="6">'.self::postedData($field['id']).'</textarea>';
		return $html;
	}

	public static function email($field)
	{
		$html = '<input id="'.$field['id'].'" class="input" name="'.$field['id'].'" type="email" placeholder="'.$field['placeholder'].'" value="'.self::postedData($field['id']).'">';
		return $html;
	}

	public static function phone($field)
	{
		$html = '<input id="'.$field['id'].'" class="input" name="'.$field['id'].'" type="tel" placeholder="'.$field['placeholder'].'" value="'.self::postedData($field['id']).'">';
		return $html;
	}

	public static function checkbox($field)
	{
		$checked = isset( $_POST[$field['id']] ) ? 'checked' : '';
		$html = '<label class="checkbox '.$checked.'" for="'.$field['id'].'"><input id="'.$field['id'].'" '.$checked.' type="checkbox" name="'.$field['id'].'" value="1"><span></span> '.$field['label'].'</label>';
		return $html;
	}

	public static function radio($field)
	{
		$options = explode(',', $field['options']);
		if( !empty($options) )
		{
			foreach($options as $option)
				{
					if( $option == self::postedData($field['id']) )
					{
						$html .= '<label class="radio checked" for="'.$field['id'].'"><input name="'.$field['id'].'" id="'.$field['id'].'" value="'.$option.'" type="radio" checked="checked"><span></span>'.$option.'</label>';
					}
					else{
						$html .= '<label class="radio" for="'.$field['id'].'"><input name="'.$field['id'].'" id="'.$field['id'].'" value="'.$option.'" type="radio"><span></span>'.$option.'</label>';
					}
				}
			}
		return $html;
	}

	/**
	* Post Items Fieldset
	* Description: These are the fields that are used specifically for post
	* creation. They're all WordPress related fields.
	*/
	public static function post_title($field)
	{
		$html = '<input id="'.$field['id'].'" class="input" name="'.$field['id'].'" type="text" placeholder="'.$field['placeholder'].'" value="'.self::postedData($field['id']).'">';
		return $html;
	}

	public static function post_content($field)
	{
		$html = '<textarea id="'.$field['id'].'" class="input textarea" rows="3" name="'.$field['id'].'" columns="6">'.self::postedData($field['id']).'</textarea>';
		return $html;
	}

	/**
	* Advanced Fieldset
	* Description: These are fields that are more advanced.
	*/
	public static function upload($field)
	{
		return 'Coming Soon!';
	}

	public static function multicheck($field)
	{
		$html = '<label class="checkbox" for="'.$field['id'].'"><input id="'.$field['id'].'" type="checkbox" name="'.$field['id'].'[]" value="1"><span></span> '.$field['options'].'</label>';
		return $html;
	}

}