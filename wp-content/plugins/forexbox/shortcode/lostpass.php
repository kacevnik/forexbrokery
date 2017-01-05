<?php
if( !defined( 'ABSPATH')){ exit(); }
global $user_ID, $themplate;
if(!$user_ID){
    $pages = get_option('fbp_pages');
	
if($_GET['fbpaction']=='rp' and $_GET['fbpkey'] and fbp_is_user($_GET['fbplogin'])) {	
	
    $themplate = '
	
	<div style="width: 350px; margin: 0 0 20px;">
	
	<div class="fbp_content_minitext">Введите новый пароль.</div>
	
	<div id="fbp_lost_otvet"></div>
	
	<div class="fbp_content_content">
	    <form action="'. FBP_PLUGIN_URL .'ajax/lostpass2.php" id="fbp_lostpass" method="post">
		    <table cellspacing="0" cellpadding="0" width="100%" class="fbp_widget_table" >
			<tr>
				<th class="fth">
					Новый пароль:
				</th>	
                <td class="ftd">
                    <input type="text" name="pass1" value="" autocomplete="off" class="fbp_input" />
                </td>					
			</tr>
			<tr>
				<th class="fth">
					Пароль повторно:
				</th>	
                <td class="ftd">
                    <input type="text" name="pass2" value="" autocomplete="off" class="fbp_input" />
                </td>					
			</tr>			
			<tr>
			    <th class="fth">
				<div class="fbp_relative">
				    <div id="fbp_lostpass_ajax" class="fbp_ajax"></div>
				</div>
				</th>
				<td style="text-align: left;">
<input type="submit" id="fbp_lostpass_button" class="fbp_submit" value="Сменить пароль" />
<input type="hidden" name="action" value="'. $_GET['fbpaction'] .'" />
<input type="hidden" name="key" value="'. $_GET['fbpkey'] .'" />
<input type="hidden" name="login" value="'. $_GET['fbplogin'] .'" />			
				</td>
			</tr>			
		    </table>
	    </form>
	</div>

    </div>';

} else {

    $themplate = '
	<div style="width: 350px; margin: 0 0 20px;">
	
	<div class="fbp_content_minitext">Введите e-mail, указанный при регистрации.</div>
	
	<div id="fbp_lost_otvet"></div>
	
	<div class="fbp_content_content">
	    <form action="'. FBP_PLUGIN_URL .'ajax/lostpass1.php" id="fbp_lostpass" method="post">
		    <table cellspacing="0" cellpadding="0" width="100%" class="fbp_widget_table" >
			<tr>
				<th class="fth">
					E-mail:
				</th>	
                <td class="ftd">
                    <input type="text" name="lostlog" value="" autocomplete="off" class="fbp_input" />
                </td>					
			</tr>						
			<tr>
			    <th class="fth">
				<div class="fbp_relative">
				    <div id="fbp_lostpass_ajax" class="fbp_ajax"></div>
				</div>
				</th>
				<td style="text-align: left;">
				<input type="submit" id="fbp_lostpass_button" class="fbp_submit" value="Сбросить пароль" />				
				</td>
			</tr>			
		    </table>
	    </form>
	</div>

    </div>';

}	
	
}

?>