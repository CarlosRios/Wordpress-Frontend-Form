<?php

class Message {

	/**
	* Returns a formatted message with specified class
	* @param string $message
	* @param string $class
	*/
	public static function make($message, $class = false)
	{
		return '<div class="ftp-return-message '.$class.'">'.$message.'</div>';
	}

}