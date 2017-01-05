<?php
if( !defined( 'ABSPATH')){ exit(); }

function fbp_is_user($username){
   if (preg_match("/^[a-zA-z0-9]{3,25}$/", $username, $matches )) {
   $r = strtolower($username);
   } else {
   $r = false;
   }
   return $r;
}			
	
function fbp_is_password($password){
   $password =strip_tags(stripslashes($password));
   if (strlen($password) > 3 and strlen($password) < 35) {
   $r = $password;
   } else {
   $r = false;
   }
   return $r;
}	

function fbp_vse_o_usere($user_ID){
   if(intval($user_ID)){
   $dannie = array();
   global $wpdb;
   $user_info = $wpdb->get_row("SELECT * FROM ".$wpdb->prefix."users WHERE ID='$user_ID'");  
   $dannie['login'] = $user_info->user_login;  
   $dannie['email'] = $user_info->user_email;
   $dannie['user_pass'] = $user_info->user_pass;
   
   return $dannie;
   } else {
   return false;
   }
}		

function fbp_is_webmoney($arg){
   if (preg_match("/^Z[0-9]{12}$/", $arg)) {
   $r = $arg;
   } else {
   $r = false;
   }
   return $r;
}	

function fbp_is_my_site($arg){
   if (preg_match("/^http:\/\//i", $arg)) {
   $r = $arg;
   } else {
   $r = 'http://'.strip_tags($arg);
   }
   return $r;
}		

function fbp_register_user($usario_id) {
global $wpdb;
$prefix = $wpdb->prefix;
$prava = get_usermeta($usario_id, $prefix.'user_level');
   if($prava!=10){
   update_user_meta($usario_id, 'show_admin_bar_front', 'false');
   }
   add_user_meta( $usario_id, 'posetitel', '0', true );
   add_user_meta( $usario_id, 'op_posetitel', '0', true );
   add_user_meta( $usario_id, 'money', '0', true );   
}
add_action( 'user_register', 'fbp_register_user');

function fbp_delete_user($usario_id){
		
global $wpdb;
$wpdb->query("DELETE FROM ". $wpdb->prefix ."withdraw WHERE userid = '$usario_id'");
$wpdb->query("DELETE FROM ". $wpdb->prefix ."fbp_link WHERE userid = '$usario_id'");

}
add_action( 'delete_user', 'fbp_delete_user');

function fbp_update_user($usario_id){
	if(current_user_can('administrator')){

    global $wpdb;
    $pr = $wpdb->prefix;
    $level = get_usermeta($usario_id, $pr.'user_level');
	    if($level==10){
	        update_user_meta($usario_id, 'show_admin_bar_front', 'true');
	    } else {
	        update_user_meta($usario_id, 'show_admin_bar_front', 'false');
	    }	
	
	    $wmz = fbp_is_webmoney($_POST["user_wmz"]);
        update_user_meta( $usario_id, 'wmz', $wmz) or add_user_meta($usario_id, 'wmz', $wmz, true);
		
        $user_money = fbp_is_my_money($_POST["user_money"]);
		update_user_meta( $usario_id, 'money', $user_money) or add_user_meta($usario_id, 'money', $user_money, true);
        
		$op_posetitel = intval($_POST["op_posetitel"]);
		update_user_meta( $usario_id, 'op_posetitel', $op_posetitel) or add_user_meta($usario_id, 'op_posetitel', $op_posetitel, true);
        
		$posetitel = intval($_POST["posetitel"]); 
		update_user_meta( $usario_id, 'posetitel', $posetitel) or add_user_meta($usario_id, 'posetitel', $posetitel, true);
        
		$ip_br = array();
        $ip_br['browser']=$_POST["browser_user"];
        $ip_br['ip']=$_POST["ip_user"];
		update_user_meta( $usario_id, 'ip_br', $ip_br) or add_user_meta($usario_id, 'ip_br', $ip_br, true);
		
		$bann=intval($_POST['block_bl']);
        update_user_meta( $usario_id, 'banned', $bann) or add_user_meta($usario_id, 'banned', $bann, true);
		
	}	
}
add_action( 'profile_update', 'fbp_update_user');

function fbp_edit_user($user){
    $usario_id = $user->ID;
	if(current_user_can('administrator')){
        $bann = get_usermeta($usario_id, 'banned');
		$wmz = fbp_is_webmoney(get_usermeta($usario_id, 'wmz'));
		$money = fbp_is_my_money(get_usermeta($usario_id, 'money'));
		global $wpdb;
		$viplata = $wpdb->get_var('select sum(amount) from `' . $wpdb->prefix . 'fbpwithdraw` where xstatus="2" and userid="'.$usario_id.'"');
		$viplata = fbp_is_my_money($viplata);
		$minimum = get_option('fbp_parners');
		$posetitel = intval(get_usermeta($usario_id, 'posetitel'));
		$op_posetitel = intval(get_usermeta($usario_id, 'op_posetitel'));
		if(!$op_posetitel){$z_vse=0;} else {$z_vse = fbp_is_my_money($minimum[1] * $op_posetitel);}
		$ip_br = get_usermeta($usario_id, 'ip_br');
		?>
		<div class="rstudia_user_title"><div class="plmin act" title="Скрыть"></div>Партнёрская программа</div>
	    <table class="form-table">
        <tr>
            <th>
        <label for="ip">IP</label>
            </th>
            <td>
        <input type="text" name="ip_user" id="ip" autocomplete="off" value="<?php echo $ip_br['ip'];?>" />
           </td>
        </tr>
        <tr>
            <th>
        <label for="browser">Браузер</label>
            </th>
            <td>
        <input type="text" name="browser_user" class="regular-text" id="browser" autocomplete="off" value="<?php echo $ip_br['browser'];?>" />
           </td>
        </tr>		
        <tr>
            <th>
        <label for="wmz">WMZ</label>
            </th>
            <td>
        <input type="text" name="user_wmz" id="wmz" autocomplete="off" value="<?php echo $wmz;?>" />
           </td>
        </tr>
        <tr>
            <th>
        <label for="wmz_money">Денег на счету</label>
            </th>
            <td>
        <input type="text" name="user_money" id="wmz_money" autocomplete="off" value="<?php echo $money;?>" />
           </td>
        </tr>
        <tr>
            <th>
        <label for="z_money">Заработано за всё время</label>
            </th>
            <td>
        $<?php echo $z_vse;?>
           </td>
        </tr>	
        <tr>
            <th>
        <label for="viplata">Выплачено</label>
            </th>
            <td>
        $<?php echo $viplata;?>
           </td>
        </tr>
        <tr>
            <th>
        <label for="posetitel">Посетителей</label>
            </th>
            <td>
        <input type="text" name="posetitel" id="posetitel" autocomplete="off" value="<?php echo $posetitel;?>" />
           </td>
        </tr>
        <tr>
            <th>
        <label for="op_posetitel">Оплаченых посетителей</label>
            </th>
            <td>
        <input type="text" name="op_posetitel" id="op_posetitel" autocomplete="off" value="<?php echo $op_posetitel;?>" />
           </td>
        </tr>		
        </table>
        <div class="rstudia_user_title"><div class="plmin act" title="Скрыть"></div>Блокировка</div>		
		<table cellpadding="0" cellspacing="10" border="0" width="100%">
        <tr>
        <td>
            <label for="block_bl">Заблокирован?</label>
        </td>
        <td>
	    <select name="block_bl" id="block_bl">
	        <option value='1'>Не заблокирован</option>
	        <option value='2' <?php if($bann==2){?>selected<?php }?>>Заблокирован</option>
	    </select>
        </td>
        </tr>
        </table>
		
		<?php
	}
}
add_action( 'show_user_profile', 'fbp_edit_user');
add_action( 'edit_user_profile', 'fbp_edit_user');

function fbp_unset_profile_colorcheme() {
   global $_wp_admin_css_colors;
   $_wp_admin_css_colors = 0;
}
add_action('admin_head', 'fbp_unset_profile_colorcheme');

function fbp_remove_profilefields($buffer) {

		$buffer=str_replace('<h3>Персональные настройки</h3>','<div class="rstudia_user_title"><div class="plmin act" title="Скрыть"></div>Персональные настройки</div>',$buffer);
		$buffer=str_replace('<h3>Имя</h3>','<div class="rstudia_user_title"><div class="plmin act" title="Скрыть"></div>Настройки имени</div>',$buffer);
		$buffer=str_replace('<h3>Контакты</h3>','<div class="rstudia_user_title"><div class="plmin act" title="Скрыть"></div>Контактные данные</div>',$buffer);
		$buffer=str_replace('<h3>Обо мне</h3>','<div class="rstudia_user_title"><div class="plmin act" title="Скрыть"></div>Информация</div>',$buffer);
		$buffer=str_replace('<h3>О пользователе</h3>','<div class="rstudia_user_title"><div class="plmin act" title="Скрыть"></div>Информация</div>',$buffer);
		$buffer=str_replace('<p>Создать учётную запись нового пользователя и добавить его к этому сайту.</p>','<div class="rstudia_user_title">Добавить пользователя</div>',$buffer);
		$buffer=str_replace('Подсказка: Пароль должен состоять как минимум из семи символов. Чтобы сделать его надёжнее, используйте буквы верхнего и нижнего регистра, числа и символы наподобие ! " ? $ % ^ & ).','',$buffer);
		
        return $buffer;
}

function fbp_profile_admin_buffer_start() { 
    ob_start("fbp_remove_profilefields"); 
}

function fbp_profile_admin_buffer_end() { 
    ob_end_flush(); 
}
add_action('admin_head', 'fbp_profile_admin_buffer_start');
add_action('admin_footer', 'fbp_profile_admin_buffer_end');

function fbp_unset_profile_details( $contactmethods ) {
	unset($contactmethods['yim']);
	unset($contactmethods['aim']);
	unset($contactmethods['jabber']);
    return $contactmethods;
}
add_filter('user_contactmethods','fbp_unset_profile_details',10,1);
		
?>