<?php
include_once('../../../wp-config.php');
include_once('../../../wp-load.php');
include_once('../../../wp-includes/wp-db.php');
header('Content-Type: text/html; charset=utf-8');

global $wpdb;
$aur = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."forex_broker ORDER BY id DESC");
$r=0;
foreach($aur as $au){
    $date = $au->timer;
    $id = $au->id;
    $dd = explode(' ',current_time('mysql')); $dd = $dd[0];
    if($au->timer != $dd){
        $wpdb->query("UPDATE ".$wpdb->prefix."forex_broker SET `timer` = '$dd',`sutka` = '0' WHERE id = '$id'");
    }
	$mm = explode('-',$dd);
	$mm = $mm[1];
	if($mm != date('m')){
	    $wpdb->query("UPDATE ".$wpdb->prefix."forex_broker SET `timer` = '$dd',`mon` = '0' WHERE id = '$id'");
	}
} 

?>