<?php
if ( 'POST' != $_SERVER['REQUEST_METHOD'] ) {
	header('Allow: POST');
	header('HTTP/1.1 405 Method Not Allowed');
	header('Content-Type: text/plain');
	exit;
}

include_once('../../../../wp-config.php');
include_once('../../../../wp-load.php');
include_once('../../../../wp-includes/wp-db.php');
header('Content-Type: text/html; charset=utf-8');
global $user_ID, $wpdb;

if(!$user_ID and $_POST['pass1'] and $_POST['pass2'] and $_POST['key'] and $_POST['login'] and $_POST['action']  and FBP_PARTNERS_PROGRAMM == 'true'){


	    $pass = strip_tags(stripslashes($_POST['pass1']));
		$pass2 = strip_tags(stripslashes($_POST['pass2']));
		if($pass and preg_match("/^[a-zA-z0-9]{6,15}$/", $_POST['key'])){
		
		if(fbp_is_password($pass)){
		if($pass == $pass2){
		$password = wp_hash_password($pass);
		if(fbp_is_user($_POST['login'])){
		$id_user = username_exists($_POST['login']);
		global $wpdb;
		$prefix = $wpdb->prefix;
		$level = get_usermeta($id_user, $prefix.'user_level');
		if($level!=10){
		$user_login = fbp_is_user($_POST['login']);
		
        $otvet = $wpdb->query("UPDATE ".$wpdb->prefix."users SET user_pass = '$password', user_activation_key = '' WHERE user_activation_key = '".$_POST['key']."' and user_login = '$user_login'");
		if($otvet){
    $log['otvet'] = 2;
	$log['ers'] = 'пароль успешно изменён';
		} else {
    $log['otvet'] = 1;
	$log['ers'] = 'ошибка';
		}
		} else {
    $log['otvet'] = 1;
	$log['ers'] = 'запрещено менять пароль';
		}		
		} else {
    $log['otvet'] = 1;
	$log['ers'] = 'пользователя нет';
		}
		} else {
    $log['otvet'] = 1;
	$log['ers'] = 'пароль не совпадает с проверочным';
		}
		} else {
    $log['otvet'] = 1;
	$log['ers'] = 'неккоректный пароль';
		}
		} else {
    $log['otvet'] = 1;
	$log['ers'] = 'запрещено';
		}
} else {
    $log['otvet'] = 1;
	$log['ers'] = 'запрещено';
}

$log['forexbox'] = 'yes';
echo json_encode($log);

?>