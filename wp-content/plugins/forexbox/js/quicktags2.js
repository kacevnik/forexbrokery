/* настройка кнопок 
--------------------------------------------*/

edButtons[edButtons.length] =
new edButton('fbp_register_partner','Регистрация','[fbp_register]');
edButtons[edButtons.length] =
new edButton('fbp_login','Авторизация','[fbp_login]');
edButtons[edButtons.length] =
new edButton('fbp_lostpass','Восстановление пароля','[fbp_lostpass]');
edButtons[edButtons.length] =
new edButton('fbp_promotional','Промо-материалы','[fbp_promotional]');
edButtons[edButtons.length] =
new edButton('fbp_profile','Профиль','[fbp_profile]');
edButtons[edButtons.length] =
new edButton('fbp_partners_account','Партнёрский аккаунт','[fbp_partners_account]');
edButtons[edButtons.length] =
new edButton('fbp_withdrawal','Выплаты','[fbp_withdrawal]');


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