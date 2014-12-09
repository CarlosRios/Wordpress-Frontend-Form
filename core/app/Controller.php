<?php
namespace WPFF;

class Controller {

	/**
	 * Gets the correct controller method and passes in data
	 * @param  string $path
	 * @param  array  $variables
	 */
	public static function get( $path, $variables = array() )
	{
		// Explode the path string
		$path = explode('@', $path);
		$controller = $path[0];
		$method = $path[1];

		// Instantiate the class
		$class = new $controller;

		// Make sure method exists in class
		if( method_exists( $class, $method ) )
		{
			// Call method and pass in variables
			call_user_func_array( array($class, $method), $variables );
		}
		else{
			throw new Exception("Controller or method does not exist", 500);
		}
	}

}