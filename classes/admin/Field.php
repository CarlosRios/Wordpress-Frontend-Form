<?php

class Field {

	/**
	* Creates a new field item
	* @param array $row
	* @param string $type
	* @param array $field
	*/
	public static function createFieldItem($row, $type, $field)
	{
		if( !$field )
			$field = self::createNewField($type);

		$html = '<div class="ftp-field-container">';
			$html .= '<div class="ftp-header">';
				$html .= '<h4 class="ftp-field-label">';
					$html .= '<span class="ftp-header-label">'.$field['label'].'</span>';
					$html .= ' <span class="ftp-header-field-type">('.$field['type'].')</span>';
					$html .= '<div class="ftp-field-buttons-container">';
						$html .= '<a href="#TB_inline?width=300&inlineId='.$field['id'].'_modal" class="thickbox button button-large ftp-edit-field-button ftp-button" title="Edit Field"><div class="dashicons dashicons-edit"></div></a>';
						$html .= '<button class="ftp-remove-field-button button button-primary button-large ftp-button"><div class="dashicons dashicons-no-alt"></div></button>';
					$html .= '</div>';
					$html .= '<div class="ftp-clearfix"></div>';
				$html .= '</h4>';
			$html .= '</div>';
			$html .= self::fieldModal($field, $row);
		$html .= '</div>';
		return $html;
	}

	/**
	* Creates a new field with random id and type
	* @param string $type
	*/
	private static function createNewField($type){
		return ['id' => 'field_'.uniqid(), 'label' => ucfirst($type) . ' Field' , 'type' => $type ];
	}

	/**
	* Returns the field's modal
	* @param array $field
	* @param array $row
	*/
	public static function fieldModal($field, $row)
	{
		$modal = '<div id="'.$field['id'].'_modal" style="display:none;">';
			$modal .= '<div class="ftp-field-modal">'.call_user_func([ 'FieldTypes', $field['type'] ], $field, $row).'</div>';
		$modal .= '</div>';
		return $modal;
	}

	/**
	* Standard settings that can be used in every field
	* @param array $field
	* @param array $row
	*/
	protected static function standardSettings($field, $row)
	{
		$html = add_thickbox();
		$html .= Input::hidden('ftp_fields['.$row.']['.$field['id'].'][type]', $field['type']);
		$html .= Input::hidden('ftp_fields['.$row.']['.$field['id'].'][id]', $field['id']);

		$html .= '<h3>Field Settings</h3>';
		$html .= Input::checkbox($field['id'] . '_required', 'ftp_fields['.$row.']['.$field['id'].'][required]', 'Required Field', true, $field['required'], 'Is this field requried?');
		$html .= Input::text($field['id'] . '_label', 'ftp_fields['.$row.']['.$field['id'].'][label]', 'Field Label', $field['label']);
		$html .= Input::text($field['id'] . '_meta_key', 'ftp_fields['.$row.']['.$field['id'].'][meta_key]', 'Meta Key', $field['meta_key'], '', 'The id for the meta key that you would like to save to');

		return $html;
	}

	/**
	* Like standard settings but used for basic post things like title, slug, content, etc
	* @param array $field
	* @param array $row
	*/
	protected static function postContentSettings($field, $row)
	{
		$html = add_thickbox();
		$html .= Input::hidden('ftp_fields['.$row.']['.$field['id'].'][type]', $field['type']);
		$html .= Input::hidden('ftp_fields['.$row.']['.$field['id'].'][id]', $field['id']);

		$html .= '<h3>Field Settings</h3>';
		$html .= Input::checkbox($field['id'] . '_required', 'ftp_fields['.$row.']['.$field['id'].'][required]', 'Required Field', true, $field['required'], 'Is this field requried?');
		$html .= Input::text($field['id'] . '_label', 'ftp_fields['.$row.']['.$field['id'].'][label]', 'Field Label', $field['label']);

		return $html;
	}

	/**
	* Separated from settings because not all fields have a placeholder
	* @param array $field
	* @param array $row
	*/
	protected static function placeholder($field, $row)
	{	
		return Input::text('ftp-field-'.$field['id'].'-placeholder', 'ftp_fields['.$row.']['.$field['id'].'][placeholder]', 'Placeholder', $field['placeholder']);
	}

}