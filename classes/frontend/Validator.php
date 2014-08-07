<?php

class Validator {

	private $data,
			$fields;

	public function __construct($data, $fields)
	{
		
		$this->data = $data;
		$this->fields = $fields;	
	}

	public function isValid()
	{
		$errors = [
			'messages' 	=> [],
			'fields'	=> []
		];

		foreach($this->fields as $field)
		{
			// Check if its required
			if( $field['required'] == true && empty($this->data[$field['id']]) )
				$errors['messages'][] = $field['label'] . ' is required';

			// Add validation per type
			switch( $field['type'] ) {
				case 'email':
					if( filter_var( $this->data[ $field['id'] ] , FILTER_VALIDATE_EMAIL) == false ){
						$errors['messages'][] = 'Please use a valid email address.';
					}
				break;
			}

			// Add the field id to the fields array
			if( !empty($errors['messages']) )
				$errors['fields'][] = $field['id'];
		}

		return !empty($errors['fields']) ? $errors : null;
	}

}