<?php
namespace WPFF\Core\Frontend;

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
					$html .= !empty($errs) ? '<div class="field wpff-field-error">' : '<div class="field">';
						if( ! wpffisEmptyField($field) ) // Only continue if field isn't empty
						{
							// Display label
							if( $options['labels'] && $field['type'] != 'checkbox' )
								$html .= '<label class="'.$field['type'].'" for="'.$field['id'].'">'.$field['label'].'</label>';

							if( $field['desc'] )
								$html .= '<p class="wpff-field-desc">'.$field['desc'].'</p>';

							$html .= call_user_func( __NAMESPACE__ .'\Field::'.$field['type'], $field );

							// Errors
							if( !empty($errs) )
							{
								$html .= '<div class="wpff-field-errors-container">';
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