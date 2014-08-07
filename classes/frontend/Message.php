<?php

class Message {

	public static function make($message, $class = false, $errors = false)
	{
		$html = '<div class="ftp-return-message '.$class.'">';
		$html .= $message;

		if( !empty($errors) )
			$html .= self::formatErrors($errors);

		$html .= '</div>';
		return $html;
	}

	private static function formatErrors($errors)
	{
		$html = '<div id="ftp-errors-list">';
		foreach ($errors as $e) {
			$html .= '<div class="ftp-error">'.$e.'</div>';
		}
		$html .= '</div>';
		return $html;
	}

}