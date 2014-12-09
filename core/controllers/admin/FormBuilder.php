<?php
namespace WPFF\Admin;

use WPFF\View;

class FormBuilder {

	// Set the post's id
	private $postid;

	// Set the rows
	private $rows;

	// Set the menu
	private $menu = array(
		'Settings'		=> array(
			'page'	=> 'admin.settings.index',
			'icon'	=> 'dashicons-admin-generic'
		),
		'Add A New Row'	=> array(
			'page'	=> 'admin.sidebar.addrow',
			'icon'	=> 'dashicons-plus'
		),
		'Add Fields'	=> array(
			'page'	=> 'admin.sidebar.addfields',
			'icon'	=> 'dashicons-plus'
		)
	);

	/**
	 * Set the id & rows
	 */
	public function __construct()
	{
		$this->postid = get_the_ID();
		$this->rows = get_post_meta($this->postid, 'wpff_fields', true);
	}

	public static function show()
	{
		return 'Route reached successfully';
	}

	public function make()
	{
		$view = new View;
		echo $view->make('admin.index')->with(array(
			'title'		=> 'Carlos',
			'menu'		=> $this->menu
		));
	}

	/**
	 * Instantiate a new View and insert the data
	 */
	private function makeSidebar()
	{
		$view = new View;
		$view->get('admin.sidebar.index')->make();
	}

	/**
	 * Instantiate a new View and insert the data
	 */
	private function makeMainArea()
	{
		$view = new View;
		$view->get('admin.index')->with('title', 'View')->make();
	}
}