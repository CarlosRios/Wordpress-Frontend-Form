<?php
/**
* Unfortunately there is no way to get around this in WordPress.
* Require necessary files below.
*/
if( is_admin() ){
	require_once WPFF_DIR . 'core/admin/Settings.php';
	require_once WPFF_DIR . 'core/admin/FormBuilder.php';
	require_once WPFF_DIR . 'core/admin/Field.php';
	require_once WPFF_DIR . 'core/admin/FieldTypes.php';
	require_once WPFF_DIR . 'core/admin/Input.php';
	require_once WPFF_DIR . 'core/admin/Notifications.php';
	require_once WPFF_DIR . 'core/admin/Row.php';
	require_once WPFF_DIR . 'core/admin/Ajax.php';
}else{
	require_once WPFF_DIR . 'core/frontend/Form.php';
	require_once WPFF_DIR . 'core/frontend/Field.php';
	require_once WPFF_DIR . 'core/frontend/Message.php';
	require_once WPFF_DIR . 'core/frontend/Row.php';
	require_once WPFF_DIR . 'core/frontend/Validator.php';
	require_once WPFF_DIR . 'core/frontend/Notifications.php';
}