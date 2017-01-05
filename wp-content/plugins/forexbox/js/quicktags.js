/* настройка кнопок 
--------------------------------------------*/

edButtons[edButtons.length] =
new edButton('fbp_user_only','Для пользователей','[fbp_user_only]','[/fbp_user_only]');
edButtons[edButtons.length] =
new edButton('fbp_nouser_only','Для гостей','[fbp_nouser_only]','[/fbp_nouser_only]');
edButtons[edButtons.length] = 
new edButton('fbp_listing','Листинг брокеров','[fbp_listing count=5]');
edButtons[edButtons.length] = 
new edButton('fbp_once','Брокер','[fbp_once]');
edButtons[edButtons.length] = 
new edButton('fbp_otziv','Отзывы одного ФБ','[fbp_otziv]');
edButtons[edButtons.length] = 
new edButton('fbp_manyotziv','Отзывы брокеров','[fbp_otzivs count=5]');
edButtons[edButtons.length] = 
new edButton('fbp_sravni','Сравнение','[fbp_sravni]');
edButtons[edButtons.length] = 
new edButton('fbp_search','Поиск','[fbp_search]');
edButtons[edButtons.length] = 
new edButton('fbp_forex_broker','Таблица брокеров','[forex_broker]');


/* Ниже редактировать ничего не нужно */
function edShowButton(button, i) {
	if (button.id == 'ed_img') { //не трогать
	document.write('<input type="button" id="' + button.id + '" accesskey="' + button.access + '" class="ed_button" onclick="edInsertImage(edCanvas);" value="' + button.display + '" />');
	}
	else if (button.id == 'ed_link') { //не трогать
	document.write('<input type="button" id="' + button.id + '" accesskey="' + button.access + '" class="ed_button" onclick="edInsertLink(edCanvas, ' + i + ');" value="' + button.display + '" />');
	}
	else if (button.id == 'ed_code_to_html') { //кнопка Код в ХТМЛ
	document.write('<input type="button" id="' + button.id + '" accesskey="' + button.access + '" class="ed_button" onclick="edInserthtmlcode(edCanvas, ' + i + ');" value="' + button.display + '" />');
	}
	else {
	document.write('<input type="button" id="' + button.id + '" accesskey="' + button.access + '" class="ed_button" onclick="edInsertTag(edCanvas, ' + i + ');" value="' + button.display + '"  />');
	}
}


/* Функции */

function $(id){ return document.getElementById(id) }


function edInserthtmlcode(txtarea){
	var sl = (txtarea.value).substring(txtarea.selectionStart,
	txtarea.selectionEnd);  
	if(sl){a=encode_entities(sl); edInsertContent(txtarea,a)}
	else {alert ('Выделите текст, который надо преобразовать для HTML'); return false;}
}

function encode_entities(s){
  var result = '';
  for (var i = 0; i < s.length; i++){
    var c = s.charAt(i);
    result += {'<':'&lt;', '>':'&gt;', '&':'&amp;'}[c] || c;
  }
  return result;
}