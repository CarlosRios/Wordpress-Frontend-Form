<?php

class Field{

	/**
	* Gets the field by type
	* @param string $field
	*/
	public static function getField($field)
	{
		return call_user_func([ 'FieldTypes', $field['type'] ], $field);
	}

	public static function getLabel($field)
	{
		$label = '<label for="'.$field['id'].'">'.$field['label'].'</label>';
		return $label;
	}

	/**
	* Returns data that has been posted
	* @param string $field_id
	*/
	protected static function postedData($field_id)
	{
		return isset($_POST[$field_id]) ? $_POST[$field_id] : '';
	}

}