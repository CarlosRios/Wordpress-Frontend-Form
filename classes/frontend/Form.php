<?php

class Form {

	/**
	* Gets a form by id
	* @param integer $id
	*/
	public static function getForm($id)
	{
		$html;;
		if(isset($_POST['ftp-submit'])){
			$html .= self::returnMessage('ftp-success', 'Home is created');
		}

		$rows = get_post_meta($id, 'ftp_fields', true);
		$options = get_post_meta($id, 'ftp_options', true);

		$html .= '<form action="'.get_the_permalink().'" method="post">';
		if( !empty($rows) ){
			foreach($rows as $row){
				$html .= Row::create($row, $options);
			}
		}
		$html .= self::submitButton($options['button']);
		$html .= '</form>';

		return $html;
	}

	/**
	* Gets the submit button details
	* @param array $button
	*/
	private static function submitButton($button)
	{
		return '<input type="submit" name="ftp-submit" class="'.$button['class'].'" value="'.$button['text'].'"/>';
	}

	private static function returnMessage($class, $message)
	{
		return '<div class="ftp-return-message '.$class.'">'.$message.'</div>';
	}

}