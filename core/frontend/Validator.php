<?php
namespace WPFF\Frontend;

class Validator {

	private $data,
			$fields;

	/**
	 * Sets the posted data and the field data globally for the instance
	 * @param array $data
	 * @param array $fields
	 */
	public function __construct($data, $fields)
	{
		
		$this->data = $data;
		$this->fields = $fields;	
	}

	/**
	 * Checks if the fields in the current instance are valid
	 * @return $errors or true if valid
	 */
	public function isValid()
	{
		$errors = [];
		foreach($this->fields as $field)
		{
			$value = $this->data[$field['id']];

			// Check if its required
			if( $field['required'] == true && empty( $value ) )
				$errors[ $field['id'] ][] = $field['label'] . ' is required';

			if( !empty($value) ){ // Make sure there is data to validate first.
				// Add validation per type
				switch( $field['type'] ) {
					case 'email':

						if( filter_var( $value , FILTER_VALIDATE_EMAIL) == false )
							$errors[ $field['id'] ][] = 'Please use a valid email address.';
					
					break;
					case 'phone':
					
						$regex = '/^(\d[\s-]?)?[\(\[\s-]{0,2}?\d{3}[\)\]\s-]{0,2}?\d{3}[\s-]?\d{4}$/i';
						if( ! preg_match( $regex, $value ) )
							$errors[ $field['id'] ][] = 'Please use a valid phone number.';
					
					break;
				}
			}
		}
		return !empty($errors) ? $errors : null;
	}

}