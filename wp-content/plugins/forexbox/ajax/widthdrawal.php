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
	
if($user_ID and FBP_PARTNERS_PROGRAMM == 'true'){

    $pages = get_option('fbp_pages');
	$minimum = get_option('fbp_parners');
    $wmz = get_usermeta($user_ID, 'wmz');
	$money = fbp_is_my_money(get_usermeta($user_ID, 'money'));
		
    if($money >= $minimum[0]){
		
		global $wpdb;
		$go = $wpdb->insert( $wpdb->prefix.'fbpwithdraw' , array( 'userid' => $user_ID, 'amount' => $money, 'xtime' => current_time('timestamp'), 'xstatus' => '1'));
		if($go > 0){
		update_user_meta( $user_ID, 'money', '0') or add_user_meta($user_ID, 'money', '0', true);
		$money = 0;
		}
		
	$refer = get_permalink($pages['fbpwithdrawal']).'?otvet=2';
    header( 'Location: '.$refer, true, 301 );
	exit;		
		
	} else {

	$refer = get_permalink($pages['fbpwithdrawal']).'?otvet=1';
    header( 'Location: '.$refer, true, 301 );
	exit;	
	
    }	
	
} else {
    wp_die('Ошибка: действие разрешено только пользователям');
}	

?>