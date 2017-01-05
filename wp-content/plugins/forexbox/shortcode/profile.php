<?php
if( !defined( 'ABSPATH')){ exit(); }
global $user_ID, $themplate;
		
	if($user_ID){
        $user_infos = get_userdata($user_ID);
        $user_Login = $user_infos->user_login;
		$f_email = $user_infos->user_email;
		$f_name = $user_infos->first_name;
		$wmz = get_usermeta($user_ID, 'wmz');

		$err = $_GET['err'];
		$err2 = $_GET['err2'];
		$comlete = $_GET['ok'];		
		
		if(!$err and !$err2 and $comlete == 1){
		
		$go = '<div class="fbp_reg_otvet_yes">Данные успешно изменены.</div>'; 
		
		} elseif($comlete == 1) {
		$go = '<div class="fbp_reg_otvet_no">';
		if($err==1){
		$f_email = $_GET['email'];
		$go .= 'Ошибка: Этот e-mail уже занят<br />';
		} elseif($err==2){
		$f_email = $_GET['email'];
		$go .= 'Ошибка: Не верный формат E-mail<br />';
		}
		
		if($err2==1){
		$pass = $_GET['pass'];
		$pass2 = $_GET['pass2'];
		$go .= 'Ошибка: Пароль не совпадает с проверочным<br />';
		} elseif($err2==2){
		$pass = $_GET['pass'];
		$pass2 = $_GET['pass2'];		
		$go .= 'Ошибка: Пароль должен содержать от 3 до 16 англ. символов, цифр<br />';
		}		
		
		$go .= '</div>';
		}		
		
		$themplate = '<div style="padding: 10px 0 20px; width: 350px;">';
		
		
		$themplate .= $go;
		
		
		$themplate .= '
		<div class="fbp_content_content">
	<form action="'. FBP_PLUGIN_URL .'ajax/exitprofile.php" method="post">
		<table cellspacing="0" cellpadding="0" width="100%" class="fbp_widget_table">
		    <tr>
				<th class="fth">
					Логин:
				</th>	
                <td class="ftd">
                    '.$user_Login.'
                </td>
            </tr>		
		    <tr>
				<th class="fth">
					Ваше имя:
				</th>	
                <td class="ftd">
                    <input type="text" name="user_name_s" value="'.$f_name.'" autocomplete="off" class="fbp_input" />
                </td>
            </tr>			
		    <tr>
				<th class="fth">
					WMZ кошелек:
				</th>	
                <td class="ftd">
                    '.$wmz.'
                </td>
            </tr>
			<tr>
				<th class="fth">
					E-mail:
				</th>	
                <td class="ftd">
                    <input type="text" name="user_mail_s" value="'.$f_email.'" autocomplete="off" class="fbp_input" />
                </td>
            </tr>
		    <tr>
				<th class="fth">
					Новый пароль:
				</th>	
                <td class="ftd">
                    <input type="password" name="pass" value="'.$pass.'" autocomplete="off" class="fbp_input" />
                </td>
            </tr>
		    <tr>
				<th class="fth">
					Новый пароль повторно:
				</th>	
                <td class="ftd">
                    <input type="password" name="pass2" value="'.$pass2.'" autocomplete="off" class="fbp_input" />
                </td>
            </tr>			
			<tr>
			    <th>&nbsp;</th>
				<td class="ftd">
				<input type="submit" class="fbp_submit" value="Сохранить" />
                <input type="hidden" name="save_ld" value="1" />			
				</td>
			</tr>			
		</table>
	</form>	
        </div>	
        ';
		$themplate .= '</div>';
		
	} else {
		
	$themplate = '<div class="fbp_reg_otvet_no"><strong>Ошибка:</strong> данная страница доступна только зарегистрированным пользователям.</div>';
		
	}


?>