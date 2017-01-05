<?php
if( !defined( 'ABSPATH')){ exit(); }
global $user_ID, $themplate;

	if($user_ID){

		$url = get_option('siteurl').'/';
		
		$user_infos = get_userdata($user_ID);
        $user_Login = $user_infos->user_login;
		$email = $user_infos->user_email;
		$date_regq = strtotime($user_infos->user_registered) + get_option('gmt_offset') * 60 * 60;
        $date_reg3 = date("Y H:i", $date_regq);
		$date_reg1 = date("d", $date_regq);
		$date_reg_m = date("m", $date_regq);
		if($date_reg_m == '01'){
		$date_reg2 = 'Января';
		} elseif($date_reg_m == '02'){
		$date_reg2 = 'Февраля';
		} elseif($date_reg_m == '03'){
		$date_reg2 = 'Марта';		
		} elseif($date_reg_m == '04'){
		$date_reg2 = 'Апреля';
		} elseif($date_reg_m == '05'){
		$date_reg2 = 'Мая';
		} elseif($date_reg_m == '06'){
		$date_reg2 = 'Июня';
		} elseif($date_reg_m == '07'){
		$date_reg2 = 'Июля';
		} elseif($date_reg_m == '08'){
		$date_reg2 = 'Августа';
		} elseif($date_reg_m == '09'){
        $date_reg2 = 'Сентября';
		} elseif($date_reg_m == '10'){
        $date_reg2 = 'Октября';
		} elseif($date_reg_m == '11'){
        $date_reg2 = 'Ноября';
		} elseif($date_reg_m == '12'){		
		$date_reg2 = 'Декабря';
		}

		$wmz = get_usermeta($user_ID, 'wmz');
		$posetitel = intval(get_usermeta($user_ID, 'posetitel'));
		$op_posetitel = intval(get_usermeta($user_ID, 'op_posetitel'));
		if($op_posetitel > 0 and $posetitel > 0){
		$cti = '~'.ceil($op_posetitel / $posetitel * 100);
		} else {
		$cti = 0;
		}
		
		$money = fbp_is_my_money(get_usermeta($user_ID, 'money'));
		$min = get_option('fbp_parners');
		if(!$op_posetitel){
		$z_vse=0;
		} else {
		$z_vse = fbp_is_my_money($min[1] * $op_posetitel);
		}
		
		global $wpdb;
		$viplata = $wpdb->get_var('select sum(amount) from `' . $wpdb->prefix . 'fbpwithdraw` where xstatus="2" and userid="'.$user_ID.'"');
		$ojid_viplata = $wpdb->get_var('select sum(amount) from `' . $wpdb->prefix . 'fbpwithdraw` where xstatus="1" and userid="'.$user_ID.'"');
		if(!$ojid_viplata){$ojid_viplata=0;}
        if(!$viplata){$viplata=0;}		
		
        
		if($money >= $min[0]){
		$dv = $money;
		} else {$dv = 0;}

	$themplate = '<div style="width: 450px; margin: 20px 0;">
	<div class="fbp_content_content">
        <table width="100%" class="fbp_widget_table" cellpadding="0" cellspacing="0">
			
        <tr class="odd">
            <th class="fth2">Идентификационный номер</th><td class="ftd"><b>'.$user_ID.'</b></td>
        </tr>
        <tr>
            <th class="fth2">Дата регистрации</th><td class="ftd"><b>'.$date_reg1.' '.$date_reg2.' '.$date_reg3.'</b></td>
        </tr>
        <tr class="odd">
            <th class="fth2">E-mail для связи</th><td class="ftd"><b>'.$email.'</b></td>
        </tr>
        <tr>
            <th class="fth2">Кошелек для выплат</th><td class="ftd"><b>'.$wmz.'</b></td>
        </tr>
  
       </table>
	</div>
	</div>
	
	<div class="fbp_content_title">Статистика</div>
	
	<div style="width: 350px; margin: 20px 0;">
	<div class="fbp_content_content">
        <table width="100%" class="fbp_widget_table" cellpadding="0" cellspacing="0">
            <tr class="odd" title="Сколько человек перешло по Вашей ссылке">
                <th class="fth2">Посетителей</th><td class="ftd"><b>'.$posetitel.'</b></td>
            </tr>
            <tr title="Клики">
                <th class="fth2">Оплаченных действий</th><td class="ftd"><b>'.$op_posetitel.'</b></td>
            </tr>
            <tr class="odd" title="Click-To-Interest - коэффициент эффективности Ваших посетителей">
                <th class="fth2">CTI</th><td class="ftd"><b>'.$cti.'%</b></td>
            </tr>
            <tr title="Заработано Вами за все время работы">
                <th class="fth2">Заработано за все время</th><td class="ftd"><b>$'.$z_vse.'</b></td>
            </tr>
            <tr class="odd" title="Эта сумма была заказана на выплату">
                <th class="fth2">Ожидает выплаты</th><td class="ftd"><b>$'.$ojid_viplata.'</b></td>
            </tr>
            <tr title="Эта сумма была выплачена на Ваш кошелек '.$wmz.'">
                <th class="fth2">Выплачено</th><td class="ftd"><b>$'.$viplata.'</b></td>
            </tr>
            <tr class="odd" title="Текущий баланс партнерского счета">
                <th class="fth2">Текущий баланс партнерского счета</th><td class="ftd"><b>$'.$money.'</b></td>
            </tr>
            <tr title="Доступно для выплаты">
                <th class="fth2">Доступно для выплаты</th><td class="ftd"><b>$'.$dv.'</b></td>
            </tr>  
        </table>	
	</div>
	</div>
	
	<div class="fbp_content_title">Промо-материалы</div>
	<div class="fbp_content_minitext" style="margin: 10px 0;">
     Рекламный текст с ссылкой, который вы разместите на Вашем сайте, в блогах, форумах, сервисах вопросов и ответов,
     социальных сетях, сервисах закладок будет вести пользователей на сайт, а Вы будете получать гарантированное
     вознаграждение за переходы пользователей.<br />
     Ниже представлены основные варианты рекламных материалов с Вашей партнерской ссылкой. Вы можете использовать
     любые тексты ссылки или воспользоваться нашими. Нужно просто скопировать выбранный код к себе на сайт и начать
     зарабатывать деньги.	
	</div>
	
    <div class="partner_promo">
       Партнерская ссылка:<br />
       <textarea class="fbp_textarea" onclick="this.select()">'.$url.'?fbpid='.$user_ID.'</textarea><br /><br />
       
	   Партнерская ссылка в HTML-коде (для размещения на сайтах и блогах):<br />
       <textarea class="fbp_textarea" onclick="this.select()">&lt;a target="_blank" href="'.$url.'?fbpid='.$user_ID.'"&gt;Рейтинг форекс брокеров&lt;/a&gt;</textarea><br /><br />
    
	   Скрытая партнерская ссылка в HTML-коде (для размещения на сайтах и блогах):<br />
       <textarea class="fbp_textarea" onclick="this.select()">&lt;a target="_blank" href="'.$url.'" onclick="this.href=\''.$url.'?fbpid='.$user_ID.'\'"&gt;Рейтинг форекс брокеров&lt;/a&gt;</textarea><br /><br />
    
	   Партнерская ссылка в BBCode (для размещения на форумах):<br />
       <textarea class="fbp_textarea" onclick="this.select()">[url="'.$url.'?fbpid='.$user_ID.'"]Рейтинг форекс брокеров[/url]</textarea><br /><br />
    </div>		
	
	';  
		
	} else {
		
	$themplate = '<div class="fbp_reg_otvet_no"><strong>Ошибка:</strong> данная страница доступна только зарегистрированным пользователям.</div>';
		
	}
		

?>