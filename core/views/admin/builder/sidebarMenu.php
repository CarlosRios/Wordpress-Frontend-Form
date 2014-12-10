<div id="wpff-menu-wrapper">
	<div id="settingsPageMenuItem" class="menu-page-trigger form-ink" data-page="#settingsPage">
		<span class="dashicons dashicons-admin-generic"></span>Settings
	</div>
	<div id="addRowMenuItem" class="menu-page-trigger form-ink" data-page="#addRow">
		<span class="dashicons dashicons-plus"></span>Add A New Row
	</div>
	<div id="addFieldsMenuItem" class="menu-page-trigger form-ink" data-page="#addFields">
		<span class="dashicons dashicons-plus"></span>Add Fields
	</div>
</div>
<div id="menu-page-container">
	
	<div id="settingsPage" class="menu-page">
		
		<div class="menu-subpage-items">
			<div class="menu-page-trigger menu-subpage-trigger" data-page="#postType"><span class="dashicons dashicons-admin-post"></span>Post Type</div>
			<div class="menu-page-trigger menu-subpage-trigger" data-page="#button"><span class="dashicons dashicons-admin-appearance"></span>Button</div>
			<div class="menu-page-trigger menu-subpage-trigger" data-page="#display"><span class="dashicons dashicons-format-aside"></span>Display</div>
			<div class="menu-page-trigger menu-subpage-trigger" data-page="#author"><span class="dashicons dashicons-admin-users"></span>Author</div>
			<div class="menu-page-trigger menu-subpage-trigger" data-page="#userNotifications"><span class="dashicons dashicons-megaphone"></span>User Notifications</div>
			<div class="menu-page-trigger menu-subpage-trigger" data-page="#email"><span class="dashicons dashicons-email-alt"></span>Email</div>
		</div>

		<div id="postType" class="menu-page">
			<?php
			$types = get_post_types( array('public' => true), 'objects' );
			foreach( $types as $type ){
				$typeArray[$type->name] = $type->labels->name;
			}
			echo $form->label('post_type', __('Post Type'), array('class' => 'form-block'));
			echo $form->select('post_type', $typeArray, 'Post Type');
			?>
		</div>

		<div id="button" class="menu-page">
			Button Settings
		</div>

		<div id="display" class="menu-page">
			Display Settings
		</div>

		<div id="author" class="menu-page">
			Author Settings
		</div>

		<div id="userNotifications" class="menu-page">
			User Notification Settings
		</div>

		<div id="email" class="menu-page">
			Email Settings
		</div>

	</div><!-- end settings page -->

	<div id="addRow" class="menu-page">
		<div class="wpff-input-group">
			<?php echo $form->label('wpff_add_row', __('Number Of Columns'), array('class' => 'form-block') ); ?>
			<?php echo $form->select( 'wpff_add_row', array(1 => 1, 2 => 2, 3 => 3, 4 => 4), 3, array('id' => 'form-add-row-columns', 'class' => 'wpff-form-control') ); ?>
			<button id="form-btn-add-row" class="btn btn-primary" type="submit"><?php _e('Add Row'); ?></button>
		</div>
	</div>

	<div id="addFields" class="menu-page">
		<div class="wpff-tabs-container">
			<div class="wpff-tab" data-page="postFields">Post Fields</div>
			<div class="wpff-tab" data-page="generalFields">General Fields</div>
			<div class="wpff-tab" data-page="advancedFields">Advanced Fields</div>
		</div>

		<div class="wpff-field-draggable field-item" data-type="text"><span class="dashicons dashicons-sort"></span>Text</div>
		<div class="wpff-field-draggable field-item" data-type="email"><span class="dashicons dashicons-sort"></span>Email</div>
		<div class="wpff-field-draggable field-item" data-type="textarea"><span class="dashicons dashicons-sort"></span>Textarea</div>
	</div>

</div>