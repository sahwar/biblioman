$.featherlight.defaults.autostart = false;
$('img').each(function() {
	var bigImage = $(this).attr('src').replace(/\.jpg/, '.800.jpg');
	$(this).attr('data-featherlight', bigImage);
}).featherlight(null, {
	
});

$('#book_title').on('change', function() {
	var $input = $(this);
	var $form = $input.closest('form');
	var params = {
		title: $input.val(),
		author: $form.find('#book_author').val(),
		id: $form.data('entity-id')
	};
	$.get('/books/search-duplicates', params, function(foundBooks) {
		$input.next('.duplicates').remove();
		if ($.trim(foundBooks) !== '') {
			$('<div class="help-block duplicates">'+foundBooks+'</div>').insertAfter($input);
		}
	});
});
