<div class="wpff-tabs-container">
	<?php foreach($fieldtypes as $type => $controller) : ?>
		<div class="wpff-tab" data-controller="<?php echo $controller; ?>"><?php echo $type; ?></div>
	<?php endforeach; ?>
</div>

<div class="wpff-field-draggable field-item" data-page="admin.settings.index"><span class="dashicons dashicons-sort"></span>Text</div>
<div class="wpff-field-draggable field-item" data-page="admin.sidebar.addrow"><span class="dashicons dashicons-sort"></span>Email</div>
<div class="wpff-field-draggable field-item" data-page="admin.sidebar.addfields"><span class="dashicons dashicons-sort"></span>Textarea</div>