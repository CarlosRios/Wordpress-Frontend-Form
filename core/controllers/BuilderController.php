<?php

use WPFF\View;
use Colony\Form;

class BuilderController{

	// Set the post's id
	private $postId;

	// Set the rows
	private $rows;

	// Set the menu
	private $menu = array(
		'Settings'		=> array(
			'controller'	=> 'SettingsController@index',
			'icon'			=> 'dashicons-admin-generic'
		),
		'Add A New Row'	=> array(
			'controller'	=> 'SettingsController@addRowForm',
			'icon'			=> 'dashicons-plus'
		),
		'Add Fields'	=> array(
			'controller'	=> 'SettingsController@addFieldsForm',
			'icon'			=> 'dashicons-plus'
		)
	);

	/**
	 * Set the id & rows
	 */
	public function __construct()
	{
		$this->postId = get_the_ID();
		$this->rows = get_post_meta($this->postId, 'form_fields', true);
		$this->form = new Form;
	}

	/**
	 * Makes the html for rows
	 * @return string
	 */
	public function makeRows( $rows )
	{
		$data = array(
			'form'		=> new Form,
			'rows'		=> $rows
		);
		return View::make('admin.builder.addRow')->with( $data );
	}

	/**
	 * Load default view with rows
	 */
	public function index()
	{
		// Default rows for new items.
		$defaultRows = array(
			'row_' . uniqid() => array(
				array(
					'id'	=> uniqid()
				)
			)
		);
		$rows = !empty($this->rows) ? $this->rows : $defaultRows;
		echo View::make('admin.builder.index')->with(array(
			'menu' => $this->menu,
			'rows' => $this->makeRows($rows)
		));
	}

	/**
	 * Creates a new row via AJAX
	 * @param integer $columns
	 */
	public function addRow( $columns )
	{
		for ($i=0; $i < $columns; $i++){
			$fields[] = array(
				'id'	=> uniqid()
			);
		}
		$row = array(
			'row_' . uniqid() => $fields
		);
		echo $this->makeRows( $row );
	}

	/**
	 * Save the fields and options
	 * @param  integer $postId
	 * @param  array $options
	 * @param  array $fields
	 */
	public static function update( $postId, $options, $fields )
	{
		update_post_meta( $postId, 'form_fields', $fields );
		update_post_meta( $postId, 'form_options', $options );
		return;
	}

}