<?php

class Settings {

	private $_postid;

	/**
	* Sets the id, and returns form
	* @return formHtml()
	*/
	public function __construct(){
		$this->_postid = get_the_ID();
		return $this->formHtml();
	}

	/**
	* echo the form html
	*/
	private function formHtml()
	{
		$html = '<table class="widefat"><tbody><tr>';
			$html .= '<td class="wpff-padding-20">';
				$html .= $this->getSettings();
			$html .= '</td>';
		$html .= '</tr></tbody></table>';
		echo $html;
	}

	/**
	* Returns the sidebar form for admin form
	*/
	private function getSettings()
	{
		// Gather post types in array
		$post_types = get_post_types(['public' => true], 'objects');
		$types = [];
		foreach($post_types as $type){
			$types[$type->name] = $type->labels->name;
		}

		// Gather status' in array
		$stati = get_post_stati();

		// Set default options to prevent errors
		if( ! $options = get_post_meta($this->_postid, 'wpff_options', true) )
			$options = ['button' => ['class' => '', 'text' => 'Submit'], 'post_type' => 'posts'];

		$html = '<ul class="four_up tiles wpff-form">';
			$html .= '<li>';

				$fields = [
					Input::select('wpff-form-options-post-type', 'wpff_options[post_type]', 'Post type to save to', $options['post_type'], $types ),
					Input::select('wpff-form-options-post-status', 'wpff_options[post_status]', 'New Post Status', $options['post_status'], $stati, 'The status the new post will receive.' )
				];
				$html .= Input::createSettingsBlock('Post Type', '', 'dashicons-admin-post', $fields);

			$html .= '</li>';
			$html .= '<li>';

				$fields = [
					Input::text('wpff-form-options-button-class', 'wpff_options[button][class]', 'Submit Button Class', $options['button']['class']),
					Input::text('wpff-form-options-button-text', 'wpff_options[button][text]', 'Submit Button Text', valueOrDefault($options['button']['text'], 'Submit') )
				];
				$html .= Input::createSettingsBlock('Button Settings', '', 'dashicons-admin-appearance', $fields);

			$html .= '</li>';
			$html .= '<li>';

				$fields = [
					Input::checkbox('wpff-form-options-apply-styles', 'wpff_options[apply_styles]', 'Apply WordPress Frontend Form Styles?', 1, $options['apply_styles'], 'If checked, it will apply the wpff styles to your form.'),
					Input::checkbox('wpff-form-options-labels', 'wpff_options[labels]', 'Show Field Labels?', 1, $options['labels'])
				];
				$html .= Input::createSettingsBlock('Display Settings', '', 'dashicons-format-aside', $fields);

			$html .= '</li>';

			$html .= '<li>';

				$fields = [
					Input::text('wpff-form-options-message-success', 'wpff_options[message][success]', 'Success Message', $options['message']['success'], false, 'The message a user sees when their submission is successful.'),
					Input::text('wpff-form-options-message-error', 'wpff_options[message][error]', 'Error Message', $options['message']['error'], false, 'The message a user sees when their submission has errors.')
				];
				$html .= Input::createSettingsBlock('User Notifications', '', 'dashicons-megaphone', $fields);
			
			$html .= '</li>';

		$html .= '</ul>';
		return $html;
	}

}