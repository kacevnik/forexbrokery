jQuery(function() {		
	$('.show_filtr').toggle(function(){
			$(this).text('Показать фильтр');
			$('.br_filter_body').slideUp('slow');
			return false;
		}, function(){
			$(this).text('Скрыть фильтр');
			$('.br_filter_body').slideDown('slow');
			return false;
		});
});