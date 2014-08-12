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

	/**
	* Loads the page for the field types
	*/
	public static function loadFieldTypesPage()
	{
		echo FieldTypes::getTypeItems($_POST['page']);
		die;	
	}

}