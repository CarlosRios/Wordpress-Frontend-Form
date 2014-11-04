<?php
namespace WPFF\Admin;

use WPFF\View;

class Ajax {

	/**
	 * Returns new field item to the DOM
	 */
	public static function createNewField()
	{
		echo Field::createFieldItem($_POST['row'], $_POST['type'], false, $_POST['id']);
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

	/**
	 * Loads a page
	 */
	public static function loadPage()
	{
		$page = htmlentities( $_POST['page'] );
		$view = new View;
		$view->get($page)->make();
		die;
	}
}