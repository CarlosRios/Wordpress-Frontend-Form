<?php

class Row {

	/**
	* Creates a row with all of the fields and displays errors
	* @param array $fields
	* @param array $options
	* @param array $errors
	*/
	public static function create($fields, $options, $errors = false)
	{
		$html .= '<div class="row">';
			$count = count($fields);
			$column = 12 / $count;
			$column = numberToWord($column);

				foreach($fields as $field)
				{
					$errs = $errors[ $field['id'] ];
					
					$html .= '<div class="'.$column.' columns">';
					$html .= !empty($errs) ? '<div class="field ftp-field-error">' : '<div class="field">';
						if( ! ftpisEmptyField($field) ) // Only continue if field isn't empty
						{
							// Display label
							if($options['labels'])
								$html .= Field::getLabel($field);

							// Get field
							$html .= Field::getField($field);

							// Display errors
							if( !empty($errs) )
							{
								$html .= '<div class="ftp-field-errors-container">';
								foreach($errs as $e){
									$html .= '<p class="danger label">'.$e.'</p>';
								}
								$html .= '</div>';
							}
						}else
						{
							$html .= '<div style="height:1px;"></div>';
						}
					$html .= '</div>';
					$html .= '</div>';
				}

		$html .= '</div>';
		return $html;
	}

}