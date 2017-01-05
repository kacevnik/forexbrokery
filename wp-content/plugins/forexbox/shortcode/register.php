<?php
if( !defined( 'ABSPATH')){ exit(); }
global $user_ID, $themplate;
if(!$user_ID){
    $pages = get_option('fbp_pages');
	
    $themplate = '
	<div style="width: 350px; margin: 0 0 20px;">
	
	<div id="fbp_reg_otvet"></div>
	
	<div class="fbp_content_content">
	    <form action="'. FBP_PLUGIN_URL .'ajax/register.php" id="fbp_register" method="post">
	        <table cellpadding="0" cellspacing="0" width="100%" class="fbp_widget_table">
			<tr>
				<th class="fth">
					Логин:
				</th>	
                <td class="ftd">
                    <input type="text" name="rlog" value="" autocomplete="off" class="fbp_input" />
                </td>						
			</tr>
			<tr>
				<th class="fth">
					Пароль:
				</th>	
                <td class="ftd">
                    <input type="text" name="rpwd" autocomplete="off" value="" class="fbp_input" />
                </td>							
			</tr>
			<tr>
				<th class="fth">
					Пароль повторно:
				</th>	
                <td class="ftd">
                    <input type="text" name="rpwd2" autocomplete="off" value="" class="fbp_input" />
                </td>						
			</tr>
			<tr>
				<th class="fth">
					E-mail:
				</th>	
                <td class="ftd">
                    <input type="text" name="rmail" autocomplete="off" value="" class="fbp_input" />
                </td>						
			</tr>
			 
			<tr>
			    <th class="fth">
				&nbsp;
				</th>			
				<td style="text-align: left; font-size: 10px;">
					<label><input type="checkbox" name="rcheck" autocomplete="off" value="1" class="fbp_checkbox" /> Я принимаю <a href="'. get_permalink($pages['fbpterms']) .'" target="_blank">условия</a></label>
				</td>						
			</tr>		
			<tr>
			    <th>
				<div class="fbp_relative">
				    <div id="fbp_register_ajax" class="fbp_ajax"></div>
				</div>
				</th>
				<td style="text-align: left;">
				    <input type="submit" id="fbp_register_button" class="fbp_submit" value="Регистрация" />				
				</td>
			</tr>			
			
	        </table>
	    </form>
	</div>

    </div>';

}

?>