<?php

class Form {

	/**
	* Echos the admin form
	*/
	public static function adminForm()
	{	
		$postid = get_the_ID();
		$html = '<table class="widefat"><tbody><tr>';
		$html .= '<td class="ftp-sidebar ftp-padding-20">';
		$html .= self::sidebarForm($postid);
		$html .= '</td><td class="ftp-label ftp-padding-20">';
		$html .= self::formBuilder($postid);
		$html .= '</td>';
		$html .= '</tr></tbody></table><div class="ftp-loading"></div>';
		echo $html;
	}

	/**
	* Returns the sidebar form for admin form
	* @param integer $postid
	*/
	public static function sidebarForm($postid)
	{
		// Gather post types in array
		$post_types = get_post_types('', 'objects');
		$types = [];
		foreach($post_types as $type){
			if( $type->name != 'formtopost'){ // Don't want to be creating new forms.
				$types[$type->name] = $type->labels->name;
			}
		}

		// Gather status' in array
		$stati = get_post_stati();

		// Set default options to prevent errors
		if( ! $options = get_post_meta($postid, 'ftp_options', true) )
			$options = ['button' => ['class' => '', 'text' => 'Submit'], 'post_type' => 'posts'];

		$html = '<div id="ftp-form">';
			/**
			* Form settings
			*/
			$html .= '<h2><div class="dashicons dashicons-admin-generic"></div> Form Settings</h2>';
			$html .= '<div class="ftp-form-settings">';
				$html .= Input::select('ftp-form-options-post-type', 'ftp_options[post_type]', 'Post type to save to', $options['post_type'], $types );
				$html .= Input::text('ftp-form-options-button-class', 'ftp_options[button][class]', 'Button Class', $options['button']['class']);
				$html .= Input::text('ftp-form-options-button-text', 'ftp_options[button][text]', 'Button Text', self::valueOrDefault($options['button']['text'], 'Submit') );
				$html .= Input::checkbox('ftp-form-options-labels', 'ftp_options[labels]', 'Show Labels?', 1, $options['labels']);
				$html .= Input::select('ftp-form-options-post-status', 'ftp_options[post_status]', 'New Post Status', $options['post_status'], $stati, 'The status the new post will receive.' );
			$html .= '</div>';

			/**
			* Add a row
			*/
			$html .= '<h2><div class="dashicons dashicons-plus-alt"></div> Add A New Row</h2>';
			$html .= '<div class="ftp-form-settings">';
				$html .= Input::select('ftp-new-row-columns', '', 'Number Of Columns', 3, [1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5]);
				$html .= '<button id="ftp-add-row-button" class="button button-primary button-large">Add Row</button>';
			$html .= '</div>';
		$html .= '</div>';
		return $html;
	}

	/**
	* Checks if value is set and returns value or default it isn't set
	* @param string $value
	* @param string $default
	*/
	public static function valueOrDefault( $value = null, $default )
	{
		if(!is_null($value) && $value != ''){
			return $value;
		}
		return $default;
	}

	/**
	* Returns html for the form builder
	* @param integer $postid
	*/
	public static function formBuilder( $postid )
	{
		$rows = get_post_meta($postid, 'ftp_fields', true);

		$html .= '<h2>Available Fields</h2>';
		$html .= '<ul id="ftp-field-list" class="ftp-list four_up tiles">';
		$html .= FieldTypes::getTypeItems();
		$html .= '</ul>';

		$html .= '<h2>Form Layout</h2>';
		$html .= '<ul id="ftp-row-list" class="ftp-list">';
		if( !empty($rows) ){
			foreach($rows as $row => $fields){
				$count = count($fields);
				$html .= Row::create( $count, $row, $fields );
			}
		}
		$html .= '</ul>';
		return $html;
	}

	/**
	* Saves the form data as well as the list order
	* @param integer $postid
	*/
	public static function saveForm($postid)
	{
		update_post_meta($postid, 'ftp_options', $_POST['ftp_options']);
		update_post_meta($postid, 'ftp_fields', $_POST['ftp_fields']);
		return;
	}

}