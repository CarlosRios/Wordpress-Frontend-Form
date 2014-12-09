<div class="wpff-input-group">
	<?php echo $form->label('wpff_add_row', __('Number Of Columns'), array('class' => 'wpff-block') ); ?>
	<?php echo $form->select( 'wpff_add_row', array(1 => 1, 2 => 2, 3 => 3, 4 => 4), 3, array('id' => 'form-add-row-columns', 'class' => 'wpff-form-control') ); ?>
	<button id="form-btn-add-row" class="btn btn-primary" type="submit"><?php _e('Add Row'); ?></button>
</div>