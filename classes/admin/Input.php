<?php

class Input{

	private static function label($for, $text)
	{
		$label = '<label for="'.$for.'">'.$text.'</label>';
		return $label;
	}

	public static function hidden($name, $value)
	{
		$input = '<input type="hidden" name="'.$name.'" value="'.$value.'">';
		return $input;
	}

	public static function text($id, $name, $label = false, $value = false, $placeholder = false)
	{
		if($label)
			$input = self::label($id, $label);
		
		$input .= '<input id="'.$id.'" type="" name="'.$name.'" value="'.$value.'" placeholder="'.$placeholder.'">';
		return $input;
	}

	public static function select($id, $name, $label, $value = false, $options = [] )
	{
		$select = self::label($id, $label);
		$select .= '<select id="'.$id.'" name="'.$name.'">';
			foreach($options as $option => $label){
				if($option == $value){
					$select .= '<option selected value="'.$option.'">'.$label.'</option>';
				}else{
					$select .= '<option value="'.$option.'">'.$label.'</option>';
				}
			}
		$select .= '</select>';
		return $select;
	}

	public static function checkbox($id, $name, $label, $value, $checked)
	{
		$check = self::label($id, $label);
		if($checked == $value)
			$checked = 'checked="checked"';

		$check .= '<input id="'.$id.'" type="checkbox" '.$checked.' name="'.$name.'" value="'.$value.'">';
		return $check;
	}

}