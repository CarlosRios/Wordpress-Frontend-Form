<?php
namespace WPFF;

class View {

	protected $view;

	protected $data;

	/**
	 * Gets the url for the view and sets it
	 * @param  string $view
	 * @return $this
	 */
	public function get( $view )
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
		$this->view = $file;
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
	 * Make the view and extract variables
	 */
	public function make()
	{
		if( file_exists($this->view) )
		{
			// Start output buffering
			ob_start();
			
			if( isset($this->data) ) extract($this->data);
			
			include_once $this->view;

			// Gather contents
			$contents = ob_get_contents();

			// End buffering
			ob_end_clean();
			echo $contents;
		}
		else
		{
			return 'Sorry, that view does not exist';
		}
	}
}