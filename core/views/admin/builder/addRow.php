<?php foreach($rows as $row => $fields) : ?>
	<div id="<?php echo $row; ?>" class="form-row">
		<?php
		$colwidth = 12 / count($fields);
		foreach( $fields as $field ) :
		?>
		<div id="<?php echo $field['id']; ?>" class="col-md-<?php echo $colwidth; ?>">
			<div class="dropzone field">
				<?php echo $form->hidden( "form_fields[{$row}][][id]", $field['id']); ?>
			</div>
		</div>
		<?php endforeach; ?>
		<div class="form-clearfix"></div>
	</div>
<?php endforeach; ?>