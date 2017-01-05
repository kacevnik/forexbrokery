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

$user_login = fbp_is_user($_POST['rlog']);
$email = is_email($_POST['rmail']);
$pass1 = fbp_is_password($_POST['rpwd']);
$pass2 = fbp_is_password($_POST['rpwd2']);
$wmz = '1';
$rcheck = intval($_POST['rcheck']);
$pages = get_option('fbp_pages');

if($rcheck){
if($user_login){
if($email){
if($pass1 and $pass2 and $pass1==$pass2){
if($wmz){
if (!username_exists($user_login)) {
if (!email_exists($email) ){

$user_id = wp_insert_user( array ('user_login' => $user_login, 'user_email' => $email, 'user_pass' => $pass1) ) ;
$ip_br = array();
$ip_br['browser']=$_SERVER['HTTP_USER_AGENT'];
$ip_br['ip']=preg_replace( '/[^0-9a-fA-F:., ]/', '',$_SERVER['REMOTE_ADDR'] );
add_user_meta( $user_id, 'ip_br', $ip_br, true );
add_user_meta( $user_id, 'wmz', $wmz, true );

	
	fbp_registered_email($user_login,$email,$pass1);
	wp_mail("dinara.ismailova@gmail.com","Новый пользователь на сайте","На Вашем сайте новый пользователь ".$user_login);
	wp_mail($email,"Вы успешно зарегистрировались на сайте","Вы успешно зарегистрировались на сайте. <br/>Логин -  ".$user_login);
	
	$creds = array();
    $creds['user_login'] = $user_login;
    $creds['user_password'] = $pass1;
    $creds['remember'] = true;
    $user = wp_signon($creds, $secure_cookie);	
	
	if ( $user && !is_wp_error($user) ) {
    $log['otvet'] = 2;
	$log['lc'] = "http://www.forexbrokery.net/";
	} else {
    $log['otvet'] = 1;
	$log['ers'] = 'случайная ошибка';
	}
	
} else {
    $log['otvet'] = 1;
	$log['ers'] = 'e-mail запрещён';
}	
} else {
    $log['otvet'] = 1;
	$log['ers'] = 'логин запрещён';
}	
} else {
    $log['otvet'] = 1;
	$log['ers'] = 'некорректный Z-кошелёк';
}
} else {
    $log['otvet'] = 1;
	$log['ers'] = 'некорректный пароль';
}
} else {
    $log['otvet'] = 1;
	$log['ers'] = 'некорректный e-mail';
}
} else {
    $log['otvet'] = 1;
	$log['ers'] = 'некорректный логин';
}
} else {
    $log['otvet'] = 1;
	$log['ers'] = 'вы не приняли условия';
}	
	
} else {
    $log['otvet'] = 1;
	$log['ers'] = 'запрещено';
}	

$log['forexbox'] = 'yes';

echo json_encode($log);

?>