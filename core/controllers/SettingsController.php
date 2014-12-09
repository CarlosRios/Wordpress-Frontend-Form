<?php

use WPFF\View;
use Colony\Form;

class SettingsController {

	private $menu = array(
		'Post Type'	=> array(
			'controller'	=> 'SettingsController@postType',
			'icon'			=> 'dashicons-admin-post'
		),
		'Button'	=> array(
			'controller'	=> 'SettingsController@button',
			'icon'			=> 'dashicons-admin-appearance'
		),
		'Display'	=> array(
			'controller'	=> 'SettingsController@display',
			'icon'			=> 'dashicons-format-aside'
		),
		'Author'	=> array(
			'controller'	=> 'SettingsController@author',
			'icon'			=> 'dashicons-admin-users'
		),		
	);

	function index()
	{
		echo View::make('admin.settings.index')->with( 'menu', $this->menu );
	}

	function addRowForm()
	{
		$form = new Form;
		echo View::make('admin.settings.addRowForm')->with( 'form', $form );
	}

	function addFieldsForm()
	{
		// Data to pass into the view.
		$data = array(
			'fieldtypes'	=> array(
				'Post Fields'	=> 'FieldsController@postFields',
				'General'		=> 'FieldsController@generalFields',
				'Advanced'		=> 'FieldsController@advancedFields'
			)
		);

		echo View::make('admin.settings.addFieldsForm')->with( $data );	
	}

	function postType()
	{
		echo 'Post Type Settings';
	}

	function button()
	{
		echo 'Button Settings';
	}

	function display()
	{
		echo 'Display Settings';
	}

	function author()
	{
		echo 'Author Settings';
	}

}