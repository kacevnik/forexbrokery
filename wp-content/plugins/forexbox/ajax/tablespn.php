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
$spred= $_POST['spred'];
$lec_sysec= intval($_POST['lec_sysec']);
$lec_fca= intval($_POST['lec_fca']);
$lec_nfa= intval($_POST['lec_nfa']);
$lec_opit= intval($_POST['lec_opit']);
$asc = $pager[1];
$order = $pager[2];
$search = $pager[3];

echo get_fbp_pagenavi_home($page,$lim,$asc,$order,$search,$plecho,$dipozit,$spred,$lec_sysec,$lec_fca,$lec_nfa,$lec_opit);


?>