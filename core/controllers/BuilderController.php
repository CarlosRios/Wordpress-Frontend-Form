<?php

use WPFF\View;
use Colony\Form;

class BuilderController{

	// Set the post's id
	private $postId;

	// Set the rows
	private $rows;

	/**
	 * Set the id & rows
	 */
	public function __construct()
	{
		$this->postId = get_the_ID();
		$this->rows = get_post_meta($this->postId, 'form_fields', true);
	}

	/**
	 * Makes the html for rows
	 * @return string
	 */
	public function makeRows( $rows )
	{
		return View::make('admin.builder.addRow')->with( 'rows', $rows );
	}

	/**
	 * Load default view with rows
	 */
	public function index()
	{
		$defaultRows = array( // Default rows for new items.
			'row_' . uniqid() => array(
				array(
					'id'	=> uniqid()
				)
			)
		);

		$rows = !empty($this->rows) ? $this->rows : $defaultRows;
		
		echo View::make('admin.builder.index')->with(array(
			'menu' => View::make('admin.builder.sidebarMenu'),
			'rows' => $this->makeRows( $rows )
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