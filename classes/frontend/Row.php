<?php

class Row {

	/**
	* Creates a row with all of the fields
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
					if( !empty($errors) )
						$err = in_array($field['id'], $errors) ? 'class="ftp-field-error"' : '';
					
					$html .= '<li '.$err.'>';
						if($options['labels'])
							$html .= Field::getLabel($field);

						$html .= Field::getField($field);
					$html .= '</li>';
				}
			$html .= '</ul>';
		$html .= '</div>';
		return $html;
	}

}