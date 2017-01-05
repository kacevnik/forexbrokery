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
for($i=0; $i<count($_POST['click']); $i++) 
 { 
    global $wpdb;
	$wpdb->query("DELETE FROM ".$wpdb->prefix."fbp_link WHERE id='".$_POST['click'][$i]."'"); 

 }
	$refer = admin_url('admin.php?page=forexbox/partner.php&mypage=clicks&otvet=2');
    header( 'Location: '.$refer, true, 301 );
	exit; 
}
if($action=='pod2'){

    $partners = get_option('fbp_parners');
for($i=0; $i<count($_POST['click']); $i++) 
 { 
    
	global $wpdb;
    $sql = "SELECT * FROM ".$wpdb->prefix."fbp_link WHERE id='".$_POST['click'][$i]."'";
    $pro = $wpdb->get_row($sql);
    $userid = $pro->userid;
	
	$op_posetitel = get_usermeta($userid, 'op_posetitel');
    $op_posetitel = $op_posetitel-1;
    update_user_meta( $userid, 'op_posetitel', $op_posetitel) or add_user_meta($userid, 'op_posetitel', $op_posetitel, true);
			
	$money = get_usermeta($userid, 'money');
    $money = $money - $partners[1];
    update_user_meta( $userid, 'money', $money) or add_user_meta($userid, 'money', $money, true);
	
    $wpdb->query("UPDATE ".$wpdb->prefix."fbp_link SET ttype = '1' WHERE id = '".$_POST['click'][$i]."'");
	
 }
 
	$refer = admin_url('admin.php?page=forexbox/partner.php&mypage=clicks&otvet=2');
    header( 'Location: '.$refer, true, 301 );
	exit;  
 
}

}
	
} else {
    wp_die('Ошибка: действие разрешено только администратору');
}	

?>