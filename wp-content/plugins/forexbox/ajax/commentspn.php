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

$page = intval($_POST['page']);
$lim = intval($_POST['limit']);
$id = intval($_POST['id']);
$type = intval($_POST['type']);
if($id){

echo get_fbp_pagenavi($page,$lim,$id,$type);

}

?>