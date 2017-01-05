jQuery(function() {		
	
	jQuery('.plmin').live('click',function(){
	jQuery(this).toggleClass('act');
	if(jQuery(this).attr('title')=='Скрыть'){
	jQuery(this).attr('title','Показать');
	} else {
	jQuery(this).attr('title','Скрыть');
	}
	jQuery(this).parents('.rstudia_user_title').next('table').toggle();
	});		
	
	jQuery('.description.indicator-hint').html('Подсказка: Пароль должен состоять как минимум из шести символов. Используйте буквы латинского алфавита и символы.');
	
});