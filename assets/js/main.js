jQuery(document).ready(function($){

	// Add functions
	function makeItemDroppable(item)
	{
		item.find('.wpff-column-item').each(function(){
			var self = $(this),
				row = item.attr('id'),
				id = self.parent().find('.wpff-item-id').val();

			self.droppable({
				hoverClass: 'wpff-drop-hover',
				accept: '.wpff-field',
				drop: function(event, ui){
					var type = ui.draggable.attr('id');
					// Init loader
					loadingToggle('loading');
					$.ajax({
						type : 'post',
						url : wpfrontendform.ajaxurl,
						data : { action: 'wpff_add_field', row: row, id: id, type: type },
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
		var loader = $('.wpff-loading');
		if(status == 'loading'){
			loader.addClass('wpff-loading-active');
		}else{
			loader.removeClass('wpff-loading-active');
		}
	}

	function loadFieldTypesPage(page)
	{
		//loadingToggle('loading');
		$.ajax({
			type : 'post',
			url : wpfrontendform.ajaxurl,
			data : { action: 'wpff_load_field_types_page', page: page },
			success : function(data){
				//loadingToggle('stopped'); // Remove loader
				var types = $('#wpff-field-types').html(data);
				types.find('.wpff-field').draggable({ helper: "clone" });
			}
		});
	}

	// Make rows sortable
	$('#wpff-row-list').sortable({
		placeholder: 'wpff-field-placeholder',
		forcePlaceholderSize: true
	});

	// Make field types draggable
	$('.wpff-field').draggable({ helper: "clone" });

	// Make initial rows droppable
	$('#wpff-row-list > li').each(function(){
		makeItemDroppable($(this));
	});

	// Make create new row and make droppable
	$(document).on('click', '#wpff-add-row-button', function(){
		var list = $('#wpff-row-list'),
			columns = $('#wpff-new-row-columns');

		// Init loader
		loadingToggle('loading');

		$.ajax({
			type : 'post',
			url : wpfrontendform.ajaxurl,
			data : { action: 'wpff_add_row', columns: columns.val() },
			success : function(data){
				list.append(data);
				loadingToggle('stopped'); // Remove loader
				var	newRow = $('#wpff-row-list > li').last();
				makeItemDroppable(newRow);
			}
		});

		event.preventDefault();
	});

	// Open thickbox on click
	$(document).on('click', '.wpff-edit-field-button', function(event){
		event.preventDefault();
	});

	// Remove item on click
	$(document).on('click', '.wpff-remove-field-button', function(){
		var wrapper = $(this).parentsUntil('div.wpff-column-item');
		wrapper.fadeOut().remove();
	});

	// Remove row on click
	$(document).on('click', '.wpff-remove-row-button', function(event){
		var item = $(this).parentsUntil('#wpff-row-list');
		item.fadeOut().remove();
		event.preventDefault();
	});

	// Change li header value when typing
	$(document).on('keyup', '.wpff-field-label', function(){
		var self = $(this),
			parent = self.parentsUntil('ul.wpff-list'),
			label = parent.find('.wpff-header-label');
		label.text(self.val());
	});

	// Add event to next and previous buttons
	$(document).on('click', '.wpff-pagination-tab', function(event){
		$('.wpff-active-tab').removeClass('wpff-active-tab');
		var page = $(this).attr('id');
		loadFieldTypesPage(page);
		$(this).addClass('wpff-active-tab');
		event.preventDefault();
	});

});