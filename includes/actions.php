<?php
/**
* Admin Scripts & Styles
*/
add_action( 'admin_enqueue_scripts', function(){
	wp_enqueue_script('jquery-ui-droppable');
	wp_enqueue_script('jquery-ui-draggable');
	wp_enqueue_script('jquery-ui-sortable');
	wp_enqueue_script('jquery-ui-resizable');
	wp_register_script( 'wpfrontendform', WPFF_URL . '/assets/js/main.js', 'jquery' );
	wp_enqueue_script( 'wpfrontendform' );
	wp_localize_script( 'wpfrontendform', 'wpfrontendform', ['ajaxurl' => admin_url( 'admin-ajax.php' )] );
	wp_enqueue_style( 'wpff-style-admin', WPFF_URL . '/assets/css/style.css' );
	wp_enqueue_style('wpff-grid', WPFF_URL . '/assets/css/grid.css');
});

/**
* Generate metaboxes for settings and form builder
*/
add_action( 'add_meta_boxes', function(){
	add_meta_box( 'formsettings', 'Form Settings', function(){
		$settings = new Settings;
	}, 'wpfrontendform', 'advanced', 'high');
	add_meta_box( 'formbuilder', 'Form Builder', function(){
		$form_builder = new FormBuilder;
	}, 'wpfrontendform', 'advanced', 'high' );
});

/**
* Save Form
*/
add_action( 'save_post', function($postid){
	update_post_meta($postid, 'wpff_options', $_POST['wpff_options']);
	update_post_meta($postid, 'wpff_fields', $_POST['wpff_fields']);
	return;
});

/**
* Ajax functions
*/
add_action( 'wp_ajax_wpff_add_field', ['FtpAjax', 'createNewField'] );
add_action( 'wp_ajax_nopriv_wpff_add_field', ['FtpAjax', 'createNewField'] );

add_action( 'wp_ajax_wpff_add_row', ['FtpAjax', 'createNewRow'] );
add_action( 'wp_ajax_nopriv_wpff_add_row', ['FtpAjax', 'createNewRow'] );

add_action( 'wp_ajax_wpff_load_field_types_page', ['FtpAjax', 'loadFieldTypesPage'] );
add_action( 'wp_ajax_nopriv_wpff_load_field_types_page', ['FtpAjax', 'loadFieldTypesPage'] );

/**
* Menu Interactions
*/
add_action( 'admin_menu', function(){
	global $menu;

	foreach($menu as $item => $value)
	{
		// Check if menu item is a post type edit page.
		$url = $menu[$item][2];
		$url = explode('?', $url);

		if( $url[0] == 'edit.php')
		{
			if( ! $url[1] ) // Specifically for "post" post type
			{
				$count = get_transient('wpff_posts_count_post');
			}
			else
			{
				$pt = str_replace('post_type=', '', $url[1]);
				$count = get_transient('wpff_posts_count_' . $pt);
			}

			if( $count ){
				$menu[$item][0] .= ' <span class="wpff-post-count update-plugins count-'.$count.'"><span class="plugin-count">'. number_format_i18n($count).'</span></span>';
			}
		}
	}
});

/**
* Add Media Buttons
*/
add_action('media_buttons', function(){
	$is_post_edit_page = in_array(WPFF_CURRENT_PAGE, ['post.php', 'page.php', 'page-new.php', 'post-new.php']);
	if(!$is_post_edit_page)
		return;

	echo '<a id="wpff-add-form-button" href="#TB_inline?width=480&inlineId=wpff-select-form" class="button thickbox"><div class="dashicons dashicons-format-aside" style="font-size:17px; margin-top:5px;"></div> Add A Form</a>';
});
add_action('admin_footer', function(){
	?>
    <script>
        function InsertWPFFForm(){
            var form_id = jQuery("#add_form_id").val();
            if(form_id == ""){
                alert("<?php _e("Please select a form", "wpff") ?>");
                return;
            }
            window.send_to_editor("[wpff_form id=\"" + form_id + "\"" + "]");
        }
    </script>

    <div id="wpff-select-form" style="display:none;">
        <div class="wrap">
            <div>
                <div style="padding:15px 15px 0 15px;">
                    <h3 style="color:#5A5A5A!important; font-family:Georgia,Times New Roman,Times,serif!important; font-size:1.8em!important; font-weight:normal!important;"><?php _e("Insert A Form", "wpff"); ?></h3>
                    <span>
                        <?php _e("Select a form below to add it to your post or page.", "wpff"); ?>
                    </span>
                </div>
                <div style="padding:15px 15px 0 15px;">
                <?php //print_r( wpffGetForms() ); ?>
                    <select id="add_form_id">
                        <option value="">  <?php _e("Select a Form", "wpff"); ?>  </option>
                        <?php
                        	$forms = wpffGetForms();
                            foreach($forms as $form){
                                ?>
                                <option value="<?php echo $form['ID']; ?>"><?php echo $form['post_title']; ?></option>
                                <?php
                            }
                        ?>
                    </select> <br/>
                    <div style="padding:8px 0 0 0; font-size:11px; font-style:italic; color:#5A5A5A"><?php _e("Can't find your form? Make sure it is published.", "wpff"); ?></div>
                </div>
                <div style="padding:15px;">
                    <input type="button" class="button-primary" value="Insert Form" onclick="InsertWPFFForm();"/>&nbsp;&nbsp;&nbsp;
                <a class="button" style="color:#bbb;" href="#" onclick="tb_remove(); return false;"><?php _e("Cancel", "wpff"); ?></a>
                </div>
            </div>
        </div>
    </div>
	<?php	
});

/**
* Frontend Scripts & Styles
*/
add_action( 'wp_enqueue_scripts', function(){
	wp_enqueue_script( 'modernizr', WPFF_URL . '/assets/js/modernizr-2.6.2.min.js', ['jquery'] );
	wp_enqueue_script( 'gumby', WPFF_URL . '/assets/js/gumby.js', ['jquery']);
	wp_enqueue_script( 'gumby-init', WPFF_URL . '/assets/js/gumby.init.js', ['jquery']);
	wp_enqueue_script( 'gumby-checkbox', WPFF_URL . '/assets/js/ui/gumby.checkbox.js');
	wp_enqueue_script( 'gumby-radiobtn', WPFF_URL . '/assets/js/ui/gumby.radiobtn.js');

	wp_enqueue_style( 'wpff-frontend', WPFF_URL . '/assets/css/frontend.css' );
	wp_enqueue_style( 'wpff-grid', WPFF_URL . '/assets/css/grid.css' );
	wp_register_style( 'wpff-gumby', WPFF_URL . '/assets/css/gumby.css' );
});