<?php

class Form {

	private $id,
		    $rows,
		    $options,
		    $fields,
		    $posted,
		    $post_title,
		    $post_content;

	public function __construct($id)
	{
		$this->id = $id;
		$this->rows = get_post_meta($this->id, 'ftp_fields', true);
		$this->options = get_post_meta($this->id, 'ftp_options', true);
		$this->setFields();
	}

	/**
	* Gets a form by id
	* @param integer $id
	*/
	public function show()
	{
		if(isset($_POST['ftp-submit'])){
			return $this->processForm();
		}else{
			return $this->formHtml();
		}
	}

	private function formHtml($message = false, $message_class = false, $errors = false)
	{
		
		if($message)
			$html = Message::make($message, $message_class, $errors['messages']);

		$html .= '<form action="'.get_the_permalink().'" method="post">';
		if( !empty($this->rows) ){
			foreach($this->rows as $row){
				$html .= Row::create($row, $this->options, $errors['fields']);
			}
		}
		$html .= $this->submitButton();
		$html .= '</form>';
		return $html;
	}

	/**
	* Gets the submit button details
	* @param array $button
	*/
	private function submitButton()
	{
		return '<input type="submit" name="ftp-submit" class="'.$this->options['button']['class'].'" value="'.$this->options['button']['text'].'"/>';
	}

	private function setFields()
	{
		foreach($this->rows as $row => $fields){
			foreach($fields as $field){
				switch($field['type']){
					case 'post_title':
						$this->post_title = $field['id'];
					break;
					case 'post_content':
						$this->post_content = $field['id'];
					break;
				}
				$this->fields[$field['id']] = $field;
			}
		}
		return;
	}

	private function setPostedValues()
	{
		foreach($this->fields as $field){
			$this->posted[$field['id']] = $_POST[$field['id']];
		}
		return $this;
	}

	private function processForm()
	{
		$this->setPostedValues();
		$validator = new Validator($this->posted, $this->fields);
		$errors = $validator->isValid();

		if( is_null($errors) ){
			$this->createPost();
			return $this->formHtml('Thank you for your submission.', 'ftp-success');
		}else{
			return $this->formHtml('Ooops, Looks like there were some errors.', 'ftp-errors', $errors);
		}
	}

	private function getFieldMetaKey($field_id)
	{
		return $this->fields[$field_id]['meta_key'];
	}

	private function createPost()
	{
		$post_id = wp_insert_post([
			'post_type'		=> $this->options['post_type'],
			'post_status' 	=> $this->options['post_status'],
			'post_title'	=> wp_strip_all_tags($this->posted[$this->post_title]),
			'post_content'	=> $this->posted[$this->post_content],
		]);
		
		/*foreach ($this->posted as $field_id => $value){
			if( $field_id != $this->post_title && $field_id != $this->post_content){
				add_post_meta($post_id, $this->getFieldMetaKey($field_id), $value);
			}
		}*/

		/*foreach ($this->gather_terms() as $tax => $term){
			wp_set_post_terms($new_id, $term, $tax);
		}*/
		return;
	}

}