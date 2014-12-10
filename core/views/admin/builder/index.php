<span class="dashicons dashicons-no-alt" id="btn-remove-row"></span>
<nav id="wpff-menu" class="st-effect-1 closed">
	<div id="wpff-menu-header">
		<div id="menu-icon" class="animated">
			<span id="btn-menu" class="dashicons dashicons-menu icon-show"></span>
			<span id="btn-back" class="dashicons dashicons-arrow-left-alt"></span>
		</div>
		<span id="wpff-page-title" class="animated active"><span>Main Menu</span></span>
	</div>
	<div id="wpff-sidebar">
		<div id="wpff-menu-wrapper">
		<?php foreach( $menu as $item => $atts ) : ?>
			<div id="<?php echo $atts['id']; ?>" class="wpff-page-trigger form-ink" data-controller="<?php echo $atts['controller']; ?>"><span class="dashicons <?php echo $atts['icon']; ?>"></span><?php echo $item; ?></div>
		<?php endforeach; ?>
		</div>
		<div id="wpff-menu-page">
			
		</div>
	</div>
</nav>
<div id="wpff-mainarea">
	<h2>Organize your form below</h2>
	<div id="form-field-container">
		<?php echo $rows; ?>
	</div>
	<div class="form-clearfix"></div>
</div>
<div id="menu-sidebar-shadow" class="closed"></div>