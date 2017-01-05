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
global $user_ID;
	
if(!$user_ID and FBP_PARTNERS_PROGRAMM == 'true'){

nocache_headers();
global $myerrors;
$myerrors = new WP_Error();	
$secure_cookie = '';

$user_login = fbp_is_user($_POST['log']);
$pass = fbp_is_password($_POST['pwd']);
$pages = get_option('fbp_pages');

if($user_login){
if($pass){

	$userw = get_userdatabylogin($user_login);
	$bann = get_usermeta($userw->ID, 'banned');
	
    if($bann != 2){
	$creds = array();
    $creds['user_login'] = $user_login;
    $creds['user_password'] = $pass;
    $creds['remember'] = true;
    $user = wp_signon($creds, $secure_cookie);	
	
	if ( $user && !is_wp_error($user) ) {
    $log['otvet'] = 2;
    $log['lc'] = get_permalink($pages['fbppartners_account']);
	} else {
    $log['otvet'] = 1;
	$log['ers'] = 'не верная пара логин/пароль';
	}

} else {
    $log['otvet'] = 1;
	$log['ers'] = 'ваш аккаунт заблокирован';
}	
} else {
    $log['otvet'] = 1;
	$log['ers'] = 'некорректный пароль';
}
} else {
    $log['otvet'] = 1;
	$log['ers'] = 'некорректный логин';
}	
	
} else {
    $log['otvet'] = 1;
	$log['ers'] = 'запрещено';
}	

$log['forexbox'] = 'yes';
echo json_encode($log);

?>