<?php

// List of files that are always needed.
$files = array(
	'lib/Colony/Colony.php',
	'app/View.php',
	'app/Controller.php',
	'controllers/BuilderController.php',
	'controllers/FieldsController.php',
	'includes/functions.php',
	'includes/post-types.php'
);

if( is_admin() ) // Admin files.
{
	$paths = array(
		'includes/admin/actions.php',
		'includes/admin/filters.php',
		'controllers/admin/Settings.php',
		'controllers/admin/FormBuilder.php',
		'controllers/admin/Field.php',
		'controllers/admin/FieldTypes.php',
		'controllers/admin/Input.php',
		'controllers/admin/Row.php',
		'controllers/admin/Ajax.php'
	);
}
else // Frontend files.
{
	$paths = array(
		'includes/frontend/actions.php',
		'includes/frontend/filters.php',
		'controllers/frontend/Form.php',
		'controllers/frontend/Field.php',
		'controllers/frontend/Message.php',
		'controllers/frontend/Row.php',
		'controllers/frontend/Validator.php',
		'controllers/frontend/Notifications.php'
	);
}

// Merge paths with files array.
$files = array_merge( $files, $paths );

// Loop through files and require them.
foreach( $files as $path ){
	require_once WPFF_DIR . 'core/' . $path;
}