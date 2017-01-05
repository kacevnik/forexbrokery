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
	
if(current_user_can('administrator') and FBP_PARTNERS_PROGRAMM == 'true'){

    $min = fbp_is_my_money($_POST['min_r']);
	$cena = fbp_is_my_money($_POST['cena_r']);
	$param = array($min,$cena);
	update_option('fbp_parners', $param);
	
	$refer = admin_url('admin.php?page=forexbox/partner.php&mypage=change&otvet=2');
    header( 'Location: '.$refer, true, 301 );
	exit;
	
} else {
    wp_die('Ошибка: действие разрешено только администратору');
}	

?>