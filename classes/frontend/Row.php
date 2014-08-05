<?php

class Row {

	public static function create($fields, $options)
	{
		$html .= '<div class"row">';
			$count = count($fields);
			$count = numberToWord($count);
			$html .= '<ul class="'.$count.'_up tiles">';
				foreach($fields as $field){
					$html .= '<li>';
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