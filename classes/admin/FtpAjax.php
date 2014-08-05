<?php

class FtpAjax {

	/**
	* Returns new field item to the DOM
	*/
	public static function createNewField()
	{
		echo Field::createFieldItem($_POST['row'], $_POST['type'], false);
		die;
	}

	/**
	* Returns new row to the DOM
	*/
	public static function createNewRow()
	{
		echo Row::create($_POST['columns']);
		die;
	}

}