<?php
use \TijsVerkoyen\CssToInlineStyles\CssToInlineStyles;

class EmailTemplateMaker {

	public function __construct()
	{
		require_once WPFF_DIR . 'core/helpers/CssToInlineStyles.php';
	}

	/**
	* Makes the email template
	* @param string $file_path
	* @param string $css_path
	* @param mixed $content
	*/
	public function make( $file_path, $css_path, $content = null )
	{
		$cssToInlineStyles = new CssToInlineStyles();

		// Gather PHP & CSS files.
		$php = $file_path;
		$css = file_get_contents($css_path);

		// Set the PHP & CSS.
		$cssToInlineStyles->setPHP($php, $content);
		$cssToInlineStyles->setCSS($css);

		return $cssToInlineStyles->convert();
	}

}