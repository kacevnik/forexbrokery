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

$id = intval($_POST['id']);
$tu = fbp_cleared_post(fbp_your_id());
if($id){
$date = explode(' ',current_time('mysql'));
$date = $date[0];
global $wpdb;
$post = $wpdb->get_row("SELECT * FROM ".$wpdb->prefix."fbp_sravni WHERE ryour='$tu'");
$postid = $post->id;
if($postid){
$tvoi = unserialize($post->rfbp);
if(!is_array($tvoi)){ $tvoi=array(); }

if(in_array($id,$tvoi)){
    $key = array_search($id, $tvoi);
unset($tvoi[$key]);
$rfbp = serialize($tvoi);
$wpdb->query("UPDATE ".$wpdb->prefix."fbp_sravni SET rdate='$date', rfbp='$rfbp' WHERE ryour='$tu'");

}


}
}

$log['ftable']=get_fbp_sravni_widget();
$log['ltable']=get_fbp_sravni_table();
echo json_encode($log);
?>