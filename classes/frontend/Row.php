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
		$html .= '<div class"row">';
			$count = count($fields);
			$count = numberToWord($count);
			$html .= '<ul class="'.$count.'_up tiles">';
				foreach($fields as $field)
				{
					$errs = $errors[ $field['id'] ];
					
					$html .= !empty($errs) ? '<li class="ftp-field-error">' : '<li>';
					if($options['labels'])
						$html .= Field::getLabel($field);

						$html .= Field::getField($field);

						// Display errors
						if( !empty($errs) ){
							$html .= '<div class="ftp-field-errors-container">';
							foreach($errs as $e){
								$html .= '<p>'.$e.'</p>';
							}
							$html .= '</div>';
						}
					$html .= '</li>';
				}
			$html .= '</ul>';
		$html .= '</div>';
		return $html;
	}

}