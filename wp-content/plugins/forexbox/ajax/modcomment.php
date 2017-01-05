<?php

include_once($_SERVER['DOCUMENT_ROOT'].'/wp-config.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/wp-load.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/wp-includes/wp-db.php');
header('Content-Type: text/html; charset=utf-8');

$hash = trim(strip_tags($_GET['act']));
if(strlen($hash)==12){
global $wpdb;
$au = $wpdb->get_row("SELECT * FROM ".$wpdb->prefix."fbp_comments WHERE hash_string='$hash'");
$fb_id = $au->fb_id;
$id=$au->id;
    if($fb_id){
	
	$fb = $wpdb->get_row("SELECT * FROM ".$wpdb->prefix."forex_broker WHERE id='$fb_id'");
	
	$wpdb->query("UPDATE ".$wpdb->prefix."fbp_comments SET cactive='1', hash_string='' WHERE id = '$id'");
	if($au->crating==0){ $a=1; $b=0; $c=0;} elseif($au->crating==1) { $a=0; $b=1; $c=0;} else { $a=0; $b=0; $c=1; }
	$wpdb->query("UPDATE ".$wpdb->prefix."forex_broker SET `fnotz`=`fnotz`+$a, `fpotz`=`fpotz`+$b, `footz`=`footz`+$c WHERE id = '$fb_id'");
    
	$url = fbp_one_link_otz($fb->fslug);
    
	header( "Location: $url" );
	exit;
	} else {
	wp_die('Ошибка!');
	}
} else {
wp_die('Ошибка!');
}
?>