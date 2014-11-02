<?php
namespace WPFF\Admin;

/**
* Is used to generate all of the input types in the admin form
*/
class Input{

	private static function wrapperStart()
	{
		return '<div class="wpff-input-wrapper">';
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
	public static function createSettingsBlock($title, $desc = false, $icon, $fields, $settings_container = false, $extra = false)
	{
		$html .= '<h2><div class="dashicons '.$icon.'"></div> '.$title.'</h2>';
		if( $desc )
			$html .= '<p class="description">'.$desc.'</p>';

		$html .= $extra;

		$html .= '<div id="'.$settings_container.'" class="wpff-form-settings">';
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
			$label .= '<p class="description">'.$desc.'</p>';

		return $label;
	}

	public static function hidden($name, $value, $class = false)
	{
		$input = '<input class="'.$class.'" type="hidden" name="'.$name.'" value="'.$value.'">';
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

	/**
	* Render the multicheck
	* @param integer $id
	* @param string $name
	* @param array $options
	* @param array $checked
	* @param string $desc
	*/
	public static function multicheck($id, $name, $label, $options, $checked, $desc = false)
	{
		$check = self::wrapperStart();
		$check .= self::label($id, $label, $desc);

		if(!is_array($checked))
			$checked = [];

		if( !empty($options) )
		{
			foreach($options as $label => $value)
				{
					if(in_array($value, $checked)){
						$chkd = 'checked="checked"';
					}else{
						$chkd = '';
					}

					$check .= '<label class="checkbox checked" for="'.$id.'_'.$value.'"><input name="'.$name.'[]" id="'.$id.'_'.$value.'" value="'.$value.'" type="checkbox" '.$chkd.'><span></span>'.$label.'</label>';
				}
			}
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
			$select .= '<button id="'.$button_id.'" class="button button-primary button-large wpff-select-and-button">'.$button_text.'</button>';
		$select .= self::wrapperEnd();
		return $select;
	}

}