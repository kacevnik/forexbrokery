$(function(){
    $('.topmenu ul > li:first').addClass('first');
	$('.topmenu ul ul').prepend('<div class="relat"><div class="tarr"></div></div>');
	$('.topmenu ul ul li:has(ul)').addClass('soul');
	$('.topmenu ul ul ul').each(function(){
	    $(this).find('li:last').addClass('last');
	});
});