<?php foreach( $menu as $item => $atts ) : ?>
	<div class="wpff-page-trigger" data-controller="<?php echo $atts['controller']; ?>"><span class="dashicons <?php echo $atts['icon']; ?>"></span><?php echo $item; ?></div>
<?php endforeach; ?>