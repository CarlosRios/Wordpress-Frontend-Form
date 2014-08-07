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
			$row_id = self::newRowID();

		$html = '<li id="'.$row_id.'" class="ftp-list-item">';
			$html .= '<div class="row">';
				$html .= '<ul class="'. numberToWord($columns) .'_up tiles">';
					if( !empty($fields) ){
						foreach($fields as $field){
							$html .= '<li><div class="ftp-row-box ftp-column-item">';
								$html .= Field::createFieldItem($row_id, $field['type'], $field);
							$html .= '</div></li>';
						}
					}else{
						for ($i=1; $i <= $columns; $i++) {
							$html .= '<li><div class="ftp-row-box ftp-column-item"></div></li>';
						}
					}
				$html .= '</ul>';
			$html .= '</div>';
			$html .= '<a href="#" class="ftp-remove-row-button"><div class="dashicons dashicons-no-alt"></div></a>';
		$html .= '</li>';
		return $html;
	}

	/**
	* Generates a random id for a new row
	*/
	private static function newRowID()
	{
		return 'row_'.uniqid();
	}
	
}