<div class="wpff-tabs-container">
	<?php foreach($fieldtypes as $type => $controller) : ?>
		<div class="wpff-tab" data-controller="<?php echo $controller; ?>"><?php echo $type; ?></div>
	<?php endforeach; ?>
</div>

<div class="wpff-field-draggable field-item" data-type="text"><span class="dashicons dashicons-sort"></span>Text</div>
<div class="wpff-field-draggable field-item" data-type="email"><span class="dashicons dashicons-sort"></span>Email</div>
<div class="wpff-field-draggable field-item" data-type="textarea"><span class="dashicons dashicons-sort"></span>Textarea</div>