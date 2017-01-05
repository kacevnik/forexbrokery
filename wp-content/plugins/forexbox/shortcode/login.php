<?php
if( !defined( 'ABSPATH')){ exit(); }
global $user_ID, $themplate;
if(!$user_ID){
    $pages = get_option('fbp_pages');
	
    $themplate = '
	<div style="width: 350px; margin: 0 0 20px;">
	
	<div id="fbp_log_otvet"></div>
	
	<div class="fbp_content_content">
	    <form action="'. FBP_PLUGIN_URL .'ajax/login.php" id="fbp_login" method="post">
		    <table cellspacing="0" cellpadding="0" width="100%" class="fbp_widget_table" >
			<tr>
				<th class="fth">
					Логин:
				</th>	
                <td class="ftd">
                    <input type="text" name="log" value="" autocomplete="off" class="fbp_input" />
                </td>					
			</tr>
			<tr>
				<th class="fth">
					Пароль:
				</th>	
                <td class="ftd">
                    <input type="password" name="pwd" autocomplete="off" value="" class="fbp_input" />
                </td>					
			</tr>						
			<tr>
			    <th class="fth">
				<div class="fbp_relative">
				    <div id="fbp_login_ajax" class="fbp_ajax"></div>
				</div>
				</th>
				<td style="text-align: left;">
				<input type="submit" id="fbp_login_button" class="fbp_submit" value="Войти" />				
				</td>
			</tr>
			<tr>
				<td colspan="2">
                <p><a href="'. get_permalink($pages['fbplostpass']) .'" title="Восстановление пароля" >Напомнить пароль</a> | <a href="'. get_permalink($pages['fbpterms']) .'" title="Регистрация" >Регистрация</a></p>				
				</td>
			</tr>			
		    </table>
	    </form>
	</div>

    </div>';

}

?>