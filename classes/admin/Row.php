<?php

class Row {

	/**
	* Creates a row
	* @param integer $columns
	* @param string $row_id
	* @param array $fields
	*/
	public static function create($columns, $row_id = false, $fields = false)
	{
		$columnwidth = 12 / $columns;

		if( !$row_id ) 
			$row_id = self::newID('row_');

		$html = '<li id="'.$row_id.'" class="wpff-list-item">';
			$html .= '<div class="row">';
				$html .= '<ul class="'. numberToWord($columns) .'_up tiles">';
					if( !empty($fields) ){
						foreach($fields as $field){

							$html .= '<li><div class="wpff-row-box wpff-column-item">';

							if( ! wpffIsEmptyField($field) ) // Check if its empty
							{
								$html .= Field::createFieldItem($row_id, $field['type'], $field);
							}

							$html .= '</div>';
							$html .= Input::hidden( 'wpff_fields['.$row_id.']['.$field['id'].'][id]', $field['id'], 'wpff-item-id' );
							$html .= '</li>';
							
						}
					}else{
						for ($i=1; $i <= $columns; $i++) {

							$field_id = self::newID('field_'); // Create a new field id.
							$field_name = 'wpff_fields['.$row_id.']['.$field_id.'][id]'; // Create the field name

							$html .= '<li><div class="wpff-row-box wpff-column-item"></div>'.Input::hidden($field_name, $field_id, 'wpff-item-id'). '</li>';

						}
					}
				$html .= '</ul>';
			$html .= '</div>';
			$html .= '<a href="#" class="wpff-remove-row-button"><div class="dashicons dashicons-no-alt"></div></a>';
		$html .= '</li>';
		return $html;
	}

	/**
	* Generates a random id for a new row
	* @param string $prefix
	*/
	private static function newID($prefix)
	{
		return $prefix . uniqid();
	}
	
}