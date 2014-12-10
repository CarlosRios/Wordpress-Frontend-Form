jQuery(document).ready(function($)
{	
	/** ==============================================
	 * Set the global variables
	 ================================================= */
	var menu = $('#wpff-menu'),
		shadow = $('#menu-sidebar-shadow'),
		menuicon = menu.find('#menu-icon'),
		menubutton = menuicon.find('#btn-menu'),
		backbutton = menuicon.find('#btn-back'),
		pageTitle = menu.find('#wpff-page-title'),
		list = $('#form-field-container'),
		removeBtn = $('#btn-remove-row');


	/** ==============================================
	 * Fields
	 ================================================= */
	$(document).on('click', '.field-placeholder', function(){ // Add form to manage field
		alert($(this).data('field-type') + ' has been clicked');
	});

	$('.field-item').livequery(function(){ // Make items draggable, implements Livequery plugin
		$(this).draggable({ helper: 'clone' });
	});

	$('.dropzone').livequery(function(){ // Make dropzones droppable, implements Livequery plugin
		var self = $(this);
		self.droppable({
			hoverClass: 'dropzone-hover',
			accept: '.field-item',
			tolerance: 'pointer',
			drop: function( event, ui ){
				self.removeClass('dropzone-hover');
				self.droppable( 'option', 'disabled', true );
				$.ajax({
					type : 'post',
					url : material.ajaxurl,
					data : {
						action: 'formLoadController',
						controller: 'FieldsController@create',
						variables: { type: $(ui.draggable).data('type') }
					},
					success : function( html ){
						self.append( html );
					}
				});
			}
		});
	});


	/** ==============================================
	 * Rows
	 ================================================= */
	$('#wpff-mainarea #form-field-container').sortable({ // Make rows sortable
		placeholder: 'row-placeholder',
		forcePlaceholderSize: true
	});

	removeBtn.droppable({
		hoverClass: 'row-hover',
		accept: '.form-row',
		tolerance: 'pointer',
		drop: function( event, ui ){
			$(ui.draggable).fadeOut().remove();
		}
	});

	$(document).on('click', '#form-btn-add-row', function(event){ // Make a new row
		addRow( $('#form-add-row-columns').val() );
		event.preventDefault();
	});

	/**
	 * Add row function
	 * @param string columns
	 */
	function addRow( columns )
	{
		$.ajax({
			type : 'post',
			url : material.ajaxurl,
			data : {
				action: 'formLoadController',
				controller: 'BuilderController@addRow',
				variables: { columns: columns }
			},
			success : function( html ){
				list.append( html );
			}
		});
	}


	/** ==============================================
	 * Page Loading
	 ================================================= */
	$(document).on('click', '.menu-page-trigger', function(){ // Load a new page

		// Submenu
		if( isSubmenu( $(this) ) ){
			var parent = $(this).parent().parent(); // traverse up 2 levels
			$(this).parent().hide();
			parent.find('.opened').removeClass('opened');
		}

		$('#wpff-menu-wrapper').hide();
		changeMenuIcon('back');
		pageTitle.addClass('active').html('<span>'+ $(this).text() +'</span>');

		$( $(this).data('page') ).addClass('opened'); // Show page
	});

	/**
	 * Check if this is a submenu item.
	 * @param  Dom Object $item
	 * @return bool
	 */
	function isSubmenu( item )
	{
		if( item.hasClass('menu-subpage-trigger') ){
			return true;
		}else{
			return false;
		}
	}

	/**
	 * Function to load a new controller method
	 * @param  object handler
	 * @param  string controller
	 */
	function formLoadPage( handler, controller )
	{
		$.ajax({
			url : material.ajaxurl,
			type: 'POST',
			data : { action: 'formLoadController', controller: controller },
			success: function( response )
			{
				if( $('#wpff-menu-wrapper').hasClass('show') ){
					$('#wpff-menu-wrapper').removeClass('show');
					console.log('Main Menu showing.');
				}else{
					$('#wpff-menu-wrapper').addClass('show');
					console.log('Main Menu not showing.');
				}
				handler.html(response).fadeIn('fast');
			}
		});
	}


	/** ==============================================
	 * Menu
	 ================================================= */
	menuicon.on('click', function(){ // Handle menu icon
		pageTitle.addClass('active').html( '<span>Main Menu</span>' ); // Change the title	
		if( menubutton.hasClass('icon-show') ){ // Toggle menu is the main menu button is clicked.
			toggleMenu();
		}
		changeMenuIcon('home'); // Change the icon

		$('#wpff-menu-wrapper').show();
		$('.menu-subpage-items').show();
		$('.opened').removeClass('opened');
	});

	/**
	 * Change menu icon state
	 * @param  string state
	 */
	function changeMenuIcon(state)
	{
		if( state == 'home' ){
			menubutton.addClass('icon-show');
			backbutton.removeClass('icon-show');
		}else{
			menubutton.removeClass('icon-show');
			backbutton.addClass('icon-show');
		}
	}

	function toggleMenu()
	{
		if( menu.hasClass( 'closed' ) ){
			menu.removeClass( 'closed' );
			shadow.removeClass( 'closed' );
		}else{
			menu.addClass( 'closed' );
			shadow.addClass( 'closed' );
		}
	}


	/** ==============================================
	 * Animations
	 ================================================= */
	var parent, ink, d, x, y;
	$('.form-ink').click(function(e){
		self = $(this);

		//create .ink element if it doesn't exist
		if(self.find(".ink").length == 0)
			self.prepend("<span class='ink'></span>");
			
		ink = self.find(".ink");
		//incase of quick double clicks stop the previous animation
		ink.removeClass("animate");
		
		//set size of .ink
		if(!ink.height() && !ink.width())
		{
			//use self's width or height whichever is larger for the diameter to make a circle which can cover the entire element.
			d = Math.max(self.outerWidth(), self.outerHeight());
			ink.css({height: d, width: d});
		}
		
		//get click coordinates
		//logic = click coordinates relative to page - self's position relative to page - half of self height/width to make it controllable from the center;
		x = e.pageX - self.offset().left - ink.width()/2;
		y = e.pageY - self.offset().top - ink.height()/2;
		
		//set the position and add class .animate
		ink.css({top: y+'px', left: x+'px'}).addClass("animate");
	});

});