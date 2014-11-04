jQuery(document).ready(function($){
	var menu = $('#wpff-menu'),
		menuicon = menu.find('#menu-icon'),
		pagetitle = menu.find('#wpff-page-title'),
		url = menu.data('url');

	// Click menu to go home
	menuicon.on('click', function(){
		loadPage( $('#wpff-menu ul'), 'admin.sidebar.default' );
		pagetitle.text( 'Page Title' );
	});

	// Load a new page
	$(document).on('click', '.wpff-page-trigger', function(){
		loadPage( $('#wpff-menu ul'), $(this).data('page'));
		// Change page title
		pagetitle.text( $(this).text() );
	});

	/**
	 * Function to load a new page
	 * @param  object handler
	 * @param  string page
	 */
	function loadPage( handler, page )
	{
		$.ajax({
			url : wpff.ajaxurl,
			type: 'POST',
			data : { action: 'wpffLoadPage', page: page },
			success: function( response )
			{
				console.log(page);
				handler.fadeIn().html(response);
			}
		});
	}

});