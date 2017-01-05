<?php
if( !defined( 'ABSPATH')){ exit(); }
global $user_ID, $themplate;

	if($user_ID){
	
	    $minimum = get_option('fbp_parners');
		$wmz = get_usermeta($user_ID, 'wmz');
		$money = fbp_is_my_money(get_usermeta($user_ID, 'money'));

		$themplate = '';
		
		if($_GET['otvet']==1){
		
		$themplate .= '<div class="fbp_reg_otvet_no">Ошибка: не достаточно средств на счету.</div>';
		
		}
		
		if($_GET['otvet']==2){
		
		$themplate .= '<div class="fbp_reg_otvet_yes">Заказ на выплату принят и будет обработан в ближайшее время.</div>';
		
		}				
		
		if($money < $minimum[0]){
		$disabler = 'disabled="disabled"';
		}
		
        $themplate .= '
		<div class="fbp_content_minitext">
		Минимальная сумма для вывода &ndash; $'.$minimum[0].'. Выплаты осуществляются после проверки Вашего аккаунта администратором. Как правило, на это уходит не более 24 часов с момента подачи заявки на вывод.
		</div>
		
		<div style="width: 650px; margin: 20px 0;">
	        <div class="fbp_content_content">
			    <form method="post" action="'. FBP_PLUGIN_URL .'ajax/widthdrawal.php">
                <table width="100%" class="fbp_widget_table" cellpadding="0" cellspacing="0">		
		
                <tr>
                    <th class="fth">Кошелек:</th>
                    <td class="ftd">
                        <input type="text" disabled="disabled" class="fbp_input" value="'.$wmz.'" />
                    </td>
                    <td class="ftd">
                         Из соображений безопасности партнерские выплаты осуществляются только на кошелек, указанный при регистрации.
                    </td>
                </tr>
                <tr>
                    <th class="fth">&nbsp;</th>
                    <td colspan="2" class="ftd">
                        <input type="submit" '. $disabler .' class="fbp_submit dengi_del" value="Заказать $'.$money.'" />
                    </td>
                </tr>		
		
		        </table>
				</form>
			</div>
		</div>
		
		<div class="fbp_content_title" style="margin: 0 0 10px 0;">Заявки на вывод</div>
		<div id="fbp_ajax_zapros"></div>
		
		<div style="width: 790px; margin: 0 0;">
	        <div class="fbp_content_content">
                <table width="100%" class="fbp_widget_table" cellpadding="0" cellspacing="0">

		            <tr>
			            <th>Дата</th>
			            <th>Сумма</th>
			            <th>Статус</th>						
			            <th style="width: 150px;">
			            </th>
		            </tr>';
					
                    global $wpdb;
                    $sql = "SELECT * FROM ".$wpdb->prefix."fbpwithdraw WHERE userid = '$user_ID' ORDER BY payid desc";
                    $poster = $wpdb->get_results($sql);
                    $e=0;
                        foreach ($poster as $viplata) { $e++;
						    if($e%2==0){ $cl=''; } else { $cl='odd'; }
                            $status = $viplata->xstatus;
                            $link ='';
                            if($status == 1){
                                $link = '<a href="#" name="'.$viplata->payid.'" class="fbp_del_pay" title="Отменить выплату">Отменить выплату</a>';
                            }
                            $sta = $viplata->xcomment;
                            if(!$sta){
                                if($status == 1){
                                   $st = 'В ожидании';
                                } elseif($status == 2){
                                   $st = 'Выплачено';
                                } elseif($status == 3){
                                   $st = 'Отменено';
                                } 
                            } else {
                                $st = $viplata->xcomment;
                            }					
            $themplate .= '
<tr class="'.$cl.'">
  <td align="center">'.date('d.m.Y H:i', $viplata->xtime).'</td>
  <td align="center" class="ammount">$'.$viplata->amount.'</td>
  <td align="center" class="comment_del">'.$st.'</td>  
  <td align="center">'. $link .'</td>  
</tr>';

	
	                    }
                            if($e==0){
                                $themplate .= '
                                <tr>
	                                <td colspan="4" style="padding: 15px 0;" align="center">Пока не было заказано ни одной выплаты.</td>
                                </tr>
                                ';
                            }				
				        
                $themplate .= '</table>
            </div>				
		</div>
		';								
		
	} else {
		
	$themplate = '<div class="fbp_reg_otvet_no"><strong>Ошибка:</strong> данная страница доступна только зарегистрированным пользователям.</div>';
		
	}


?>