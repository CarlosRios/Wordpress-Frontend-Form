<?php

class Input{

	private static function wrapperStart()
	{
		return '<div class="ftp-input-wrapper">';
	}

	private static function wrapperEnd()
	{
		return '</div>';
	}

	private static function label($for, $text, $desc = false)
	{
		$label = '<label for="'.$for.'">'.$text.'</label>';
		if($desc)
			$label .= '<p class="description">'.$desc.'</p>';;

		return $label;
	}

	public static function hidden($name, $value)
	{
		$input = '<input type="hidden" name="'.$name.'" value="'.$value.'">';
		return $input;
	}

	public static function text($id, $name, $label, $value = false, $placeholder = false, $desc = false)
	{
		$input = self::wrapperStart();
			$input .= self::label($id, $label, $desc);
			$input .= '<input id="'.$id.'" type="" name="'.$name.'" value="'.$value.'" placeholder="'.$placeholder.'">';
		$input .= self::wrapperEnd();
		return $input;
	}

	public static function select($id, $name, $label, $value = false, $options = [], $desc = false)
	{
		$select = self::wrapperStart();
			$select .= self::label($id, $label, $desc);
			$select .= '<select id="'.$id.'" name="'.$name.'">';
				foreach($options as $option => $label){
					if($option == $value){
						$select .= '<option selected value="'.$option.'">'.$label.'</option>';
					}else{
						$select .= '<option value="'.$option.'">'.$label.'</option>';
					}
				}
			$select .= '</select>';
		$select .= self::wrapperEnd();
		return $select;
	}

	public static function checkbox($id, $name, $label, $value, $checked, $desc = false)
	{
		$check = self::wrapperStart();
		$check .= self::label($id, $label, $desc);
		
		if($checked == $value)
			$checked = 'checked="checked"';

			$check .= '<input id="'.$id.'" type="checkbox" '.$checked.' name="'.$name.'" value="'.$value.'">';
		$check .= self::wrapperEnd();
		return $check;
	}

}