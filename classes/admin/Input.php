<?php

/**
* Is used to generate all of the input types in the admin form
*/
class Input{

	private static function wrapperStart()
	{
		return '<div class="ftp-input-wrapper">';
	}

	private static function wrapperEnd()
	{
		return '</div>';
	}

	/**
	* Creates a settings block.
	* @param string $title
	* @param string $icon
	* @param array $fields;
	*/
	public static function createSettingsBlock($title, $desc = false, $icon, $fields, $settings_container = false)
	{
		$html .= '<h2><div class="dashicons '.$icon.'"></div> '.$title.'</h2>';
		if($desc)
			$html .= '<p class="description">'.$desc.'</p>';

		$html .= '<div id="'.$settings_container.'" class="ftp-form-settings">';
			foreach($fields as $field){
				$html .= $field;
			}
		$html .= '</div>';
		return $html;
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
			$input .= '<input id="'.$id.'" type="text" name="'.$name.'" value="'.$value.'" placeholder="'.$placeholder.'">';
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

	public static function selectAndButton($id, $name, $label, $value = false, $options = [], $desc = false, $button_id, $button_text)
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
			$select .= '<button id="'.$button_id.'" class="button button-primary button-large ftp-select-and-button">'.$button_text.'</button>';
		$select .= self::wrapperEnd();
		return $select;
	}

}