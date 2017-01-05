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

if($_POST['go'] or $_POST['go2']){
if($_POST['go']){ $action = $_POST['action']; } elseif($_POST['go2']){ $action = $_POST['action2'];}

if($action=='pod1'){
for($i=0; $i<count($_POST['user']); $i++) 
 { 
	update_user_meta( $_POST['user'][$i], 'banned', '2') or add_user_meta($_POST['user'][$i], 'banned', '2', true);
 }
	$refer = admin_url('admin.php?page=forexbox/partner.php&mypage=users&otvet=2');
    header( 'Location: '.$refer, true, 301 );
	exit; 
}
if($action=='pod2'){
for($i=0; $i<count($_POST['user']); $i++) 
 { 
	update_user_meta( $_POST['user'][$i], 'banned', '1') or add_user_meta($_POST['user'][$i], 'banned', '1', true);
 }
	$refer = admin_url('admin.php?page=forexbox/partner.php&mypage=users&otvet=2');
    header( 'Location: '.$refer, true, 301 );
	exit; 
}

}
	
} else {
    wp_die('Ошибка: действие разрешено только администратору');
}	

?>