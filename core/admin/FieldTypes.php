<?php
namespace WPFF\Core\Admin;

class FieldTypes extends Field {

	/**
	* All field types must be placed here and have a corresponding static function
	*/
	protected static $_fields_post = [
		'post_title'		=> 'Title',
		'post_content'		=> 'Content',
		'categories'		=> 'Categories',
		'tags'				=> 'Tags',
		'featured_image'	=> 'Featured Image'
	];

	private static $_fields_basic = [
		'text'			=> 'Text',
		'email'			=> 'Email',
		'phone'			=> 'Phone',
		'textarea'		=> 'Textarea',
		'select'		=> 'Select',
		'radio'			=> 'Radio',
		'checkbox'		=> 'Checkbox'
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
			$html .= '<li id="'.$type.'" class="wpff-list-item wpff-field">';
				$html .= '<div class="wpff-header">';
					$html .= '<h4 class="wpff-field-label">';
						$html .= '<span class="wpff-header-label">'.$label.' Field</span> ';
					$html .= '</h4>';
				$html .= '</div>';
			$html .= '</li>';
		}
		return $html;
	}

	public static function text($field, $row)
	{
		return;
	}

	public static function select($field, $row)
	{
		$html .= Input::text($field['id'] . '_options', 'wpff_fields['.$row.']['.$field['id'].'][options]', 'Field Options', $field['options'], '', 'Enter a comma separated list');
		return $html;
	}

	public static function textarea($field, $row)
	{
		return;
	}

	public static function email($field, $row)
	{
		return;
	}

	public static function phone($field, $row)
	{
		return;
	}

	public static function checkbox($field, $row)
	{
		return;
	}

	public static function radio($field, $row)
	{
		$html = Input::text($field['id'] . '_options', 'wpff_fields['.$row.']['.$field['id'].'][options]', 'Field Options', $field['options'], '', 'Enter a comma separated list');
		return $html;
	}

	public static function post_title($field, $row)
	{
		return;
	}

	public static function post_content($field, $row)
	{
		return;
	}

	public static function categories($field, $row)
	{
		$options = [
			'One'	=> 1,
			'Two'	=> 2
		];
		$html = Input::multicheck($field['id'] . '_categories', 'wpff_fields['.$row.']['.$field['id'].'][categories]', 'Available Categories', $options, $field['categories'], 'Choose the categories you would like to allow.');
		return $html;
	}

	public static function upload($field, $row)
	{
		return;
	}

}