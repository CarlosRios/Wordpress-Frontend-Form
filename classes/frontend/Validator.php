<?php

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
			// Check if its required
			if( $field['required'] == true && empty($this->data[$field['id']]) )
				$errors[ $field['id'] ][] = $field['label'] . ' is required';

			// Add validation per type
			switch( $field['type'] ) {
				case 'email':
					if( filter_var( $this->data[ $field['id'] ] , FILTER_VALIDATE_EMAIL) == false ){
						$errors[ $field['id'] ][] = 'Please use a valid email address.';
					}
				break;
			}
		}
		return !empty($errors) ? $errors : null;
	}

}