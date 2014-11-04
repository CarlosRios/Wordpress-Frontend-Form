<?php

/**
 * Include needed libraries
 */
require_once WPFF_DIR . 'core/lib/Colony/Colony.php';

/**
 * Files needed reguardless
 */
require_once WPFF_DIR . 'core/views/View.php';
require_once WPFF_DIR . 'core/includes/functions.php';
require_once WPFF_DIR . 'core/includes/post-types.php';

/**
 * Require admin files
 */
if( is_admin() )
{
	/**
	 * Includes
	 */
	require_once WPFF_DIR . 'core/includes/admin/actions.php';
	require_once WPFF_DIR . 'core/includes/admin/filters.php';

	/**
	 * Classes
	 */
	require_once WPFF_DIR . 'core/admin/Settings.php';
	require_once WPFF_DIR . 'core/admin/FormBuilder.php';
	require_once WPFF_DIR . 'core/admin/Field.php';
	require_once WPFF_DIR . 'core/admin/FieldTypes.php';
	require_once WPFF_DIR . 'core/admin/Input.php';
	require_once WPFF_DIR . 'core/admin/Row.php';
	require_once WPFF_DIR . 'core/admin/Ajax.php';
}

/**
 * Require frontend files
 */
else
{
	/**
	 * Includes
	 */
	require_once WPFF_DIR . 'core/includes/frontend/actions.php';
	require_once WPFF_DIR . 'core/includes/frontend/filters.php';

	/**
	 * Classes
	 */
	require_once WPFF_DIR . 'core/frontend/Form.php';
	require_once WPFF_DIR . 'core/frontend/Field.php';
	require_once WPFF_DIR . 'core/frontend/Message.php';
	require_once WPFF_DIR . 'core/frontend/Row.php';
	require_once WPFF_DIR . 'core/frontend/Validator.php';
	require_once WPFF_DIR . 'core/frontend/Notifications.php';
}