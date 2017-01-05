<?php
include_once('../../../wp-config.php');
include_once('../../../wp-load.php');
include_once('../../../wp-includes/wp-db.php');
header('Content-Type: text/html; charset=utf-8');

global $wpdb;
$lastrating = get_option('fbp_last_rating');
if(!is_array($lastrating)){ $lastrating = array(); }

$nrating = array();

$aur = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."forex_broker ORDER BY id DESC");
foreach($aur as $au){
    $id = $au->id;
    $frating = $au->frating;
	$nrating[$id]['v'] = fbp_is_my_money($lastrating[$id]['s']);	
    $nrating[$id]['s'] = fbp_is_my_money($frating);
}

update_option('fbp_last_rating',$nrating);

?>