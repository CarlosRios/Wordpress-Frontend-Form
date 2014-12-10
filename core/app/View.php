<?php
namespace WPFF;

use Colony\Form;

class ViewInterface {

	protected $view;

	protected $data;

	public function __construct( $path )
	{
		// Make the view
		$this->make( $path );
	}

	/**
	 * Sets the url for the view
	 * @param  string $view
	 * @return $this
	 */
	private function make( $view )
	{
		$path = explode( '.', $view );
		$file = WPFF_DIR . 'core/views/';
		foreach($path as $part)
		{
			if( $part == end($path) )
			{
				$file .= $part . '.php';
			}
			else
			{
				$file .= $part . DIRECTORY_SEPARATOR;
			}
		}

		// Set the view path
		$this->view = $file;
		
		// Return object
		return $this;
	}

	/**
	 * Set some variables for the view
	 * @param  mixed $variables
	 * @param  mixed $data
	 */
	public function with( $variable, $data = null )
	{
		if( is_array($variable) )
		{
			foreach($variable as $var => $value)
			{
				$this->data[$var] = $value;
			}
		}
		else
		{
			$this->data[$variable] = $data;
		}
		return $this;
	}

	/**
	 * Return the view and extract variables
	 */
	public function __toString()
	{
		if( file_exists($this->view) )
		{
			ob_start(); // Start buffering
			if( isset($this->data) ) extract($this->data);
			$form = new Form; // Instantiate form
			include_once $this->view;
			$contents = ob_get_clean(); // End buffering & store file path
		}
		else{
			$contents = 'Sorry, that view does not exist';
		}
		return $contents;
	}
}

// Factory for ViewInterface
class View {

	public static function make( $path )
	{
		// Instantitates the ViewInterface object
		return new ViewInterface( $path );
	}

}