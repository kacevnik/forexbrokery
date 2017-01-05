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

if($_POST['go']){

    $text1 = array();
	if(is_array($_POST['text1'])){
	    foreach($_POST['text1'] as $tex){
	        $text1[] = stripslashes($tex);
	    }
	}

    $text2 = array();
	if(is_array($_POST['text2'])){
	    foreach($_POST['text2'] as $tex){
	        $text2[] = stripslashes($tex);
	    }
	}	
	
    $text3 = array();
	if(is_array($_POST['text3'])){
	    foreach($_POST['text3'] as $tex){
	        $text3[] = stripslashes($tex);
	    }
	}	
	
    $text4 = array();
	if(is_array($_POST['text4'])){
	    foreach($_POST['text4'] as $tex){
	        $text4[] = stripslashes($tex);
	    }
	}	
	
    $text5 = array();
	if(is_array($_POST['text5'])){
	    foreach($_POST['text5'] as $tex){
	        $text5[] = stripslashes($tex);
	    }
	}	

    $text6 = array();
	if(is_array($_POST['text6'])){
	    foreach($_POST['text6'] as $tex){
	        $text6[] = stripslashes($tex);
	    }
	}	
	
	update_option('fbp_texts_material', $text1);			
	update_option('fbp_banner_468', $text2);
    update_option('fbp_banner_200', $text3);
	update_option('fbp_banner_120', $text4);
	update_option('fbp_banner_100', $text5);			
	update_option('fbp_banner_88', $text6);			
		
}
	
	$refer = admin_url('admin.php?page=forexbox/partner.php&mypage=banner&otvet=2');
    header( 'Location: '.$refer, true, 301 );
	exit;
	
} else {
    wp_die('Ошибка: действие разрешено только администратору');
}	

?>