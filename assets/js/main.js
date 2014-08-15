jQuery(document).ready(function($){

	// Add functions
	function makeItemDroppable(item)
	{
		item.find('.ftp-column-item').each(function(){
			var self = $(this),
				row = item.attr('id'),
				id = self.parent().find('.ftp-item-id').val();

			self.droppable({
				hoverClass: 'ftp-drop-hover',
				accept: '.ftp-field',
				drop: function(event, ui){
					var type = ui.draggable.attr('id');
					// Init loader
					loadingToggle('loading');
					$.ajax({
						type : 'post',
						url : formtopost.ajaxurl,
						data : { action: 'ftp_add_field', row: row, id: id, type: type },
						success : function(data){
							loadingToggle('stopped'); // Remove loader
							self.append(data);
						}
					});
				}
			});
		});
	}

	function loadingToggle(status)
	{
		var loader = $('.ftp-loading');
		if(status == 'loading'){
			loader.addClass('ftp-loading-active');
		}else{
			loader.removeClass('ftp-loading-active');
		}
	}

	function loadFieldTypesPage(page)
	{
		//loadingToggle('loading');
		$.ajax({
			type : 'post',
			url : formtopost.ajaxurl,
			data : { action: 'ftp_load_field_types_page', page: page },
			success : function(data){
				//loadingToggle('stopped'); // Remove loader
				var types = $('#ftp-field-types').html(data);
				types.find('.ftp-field').draggable({ helper: "clone" });
			}
		});
	}

	// Make rows sortable
	$('#ftp-row-list').sortable({
		placeholder: 'ftp-field-placeholder',
		forcePlaceholderSize: true
	});

	// Make field types draggable
	$('.ftp-field').draggable({ helper: "clone" });

	// Make initial rows droppable
	$('#ftp-row-list > li').each(function(){
		makeItemDroppable($(this));
	});

	// Make create new row and make droppable
	$(document).on('click', '#ftp-add-row-button', function(){
		var list = $('#ftp-row-list'),
			columns = $('#ftp-new-row-columns');

		// Init loader
		loadingToggle('loading');

		$.ajax({
			type : 'post',
			url : formtopost.ajaxurl,
			data : { action: 'ftp_add_row', columns: columns.val() },
			success : function(data){
				list.append(data);
				loadingToggle('stopped'); // Remove loader
				var	newRow = $('#ftp-row-list > li').last();
				makeItemDroppable(newRow);
			}
		});

		event.preventDefault();
	});

	// Open thickbox on click
	$(document).on('click', '.ftp-edit-field-button', function(event){
		event.preventDefault();
	});

	// Remove item on click
	$(document).on('click', '.ftp-remove-field-button', function(){
		var wrapper = $(this).parentsUntil('div.ftp-column-item');
		wrapper.fadeOut().remove();
	});

	// Remove row on click
	$(document).on('click', '.ftp-remove-row-button', function(event){
		var item = $(this).parentsUntil('#ftp-row-list');
		item.fadeOut().remove();
		event.preventDefault();
	});

	// Change li header value when typing
	$(document).on('keyup', '.ftp-field-label', function(){
		var self = $(this),
			parent = self.parentsUntil('ul.ftp-list'),
			label = parent.find('.ftp-header-label');
		label.text(self.val());
	});

	// Add event to next and previous buttons
	$(document).on('click', '.ftp-pagination-tab', function(event){
		$('.ftp-active-tab').removeClass('ftp-active-tab');
		var page = $(this).attr('id');
		loadFieldTypesPage(page);
		$(this).addClass('ftp-active-tab');
		event.preventDefault();
	});

});