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

$page = intval($_POST['page'])-1;
$lim = intval($_POST['limit']);
$id = intval($_POST['id']);
if($id){
$inicio = $page*$lim;
echo get_fbp_comments_table($lim,$inicio,$id);

}

?>