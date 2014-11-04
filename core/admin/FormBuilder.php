<?php
namespace WPFF\Admin;

use WPFF\View;

class FormBuilder {

	/**
	 * Set the post id
	 * @var integer
	 */
	private $postid;

	/**
	 * Set the rows variable
	 * @var array
	 */
	private $rows;

	/**
	 * Set the id & rows
	 */
	public function __construct()
	{
		$this->postid = get_the_ID();
		$this->rows = get_post_meta($this->postid, 'wpff_fields', true);
	}

	public function make()
	{
		$this->makeSidebar();
		$this->makeMainArea();
		return;
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
		$view->get('admin.index')->with('title', 'Drones')->make();
	}
}