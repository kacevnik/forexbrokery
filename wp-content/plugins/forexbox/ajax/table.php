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

$pager = explode('fbps',strip_tags($_POST['page']));
$lim = intval($_POST['limit']);
$page = intval($pager[0]);
$plecho = intval($_POST['plecho']);
$dipozit= intval($_POST['dipozit']);
$spred= intval($_POST['spred']);
$asc = $pager[1];
$order = $pager[2];
$search = $pager[3];


echo get_forex_home_table($page,$lim,$asc,$order,$search,$plecho,$dipozit,$spred);


?>