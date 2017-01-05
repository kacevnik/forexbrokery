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


if(current_user_can('administrator')){

if($_POST['go'] or $_POST['go2']){
if($_POST['go']){
$action = $_POST['action'];
} elseif($_POST['go2']){
$action = $_POST['action2'];
}
if(count($_POST['id']) > 0){
  if($action=='delete'){ /* удаление */
  
    $delid = join(',',$_POST['id']);
	global $wpdb;
	$wpdb->query("DELETE FROM ".$wpdb->prefix."forex_broker WHERE id IN($delid)");
	$wpdb->query("DELETE FROM ".$wpdb->prefix."fbp_rating WHERE fb_id IN($delid)");
	$wpdb->query("DELETE FROM ".$wpdb->prefix."fbp_comments WHERE fb_id IN($delid)");

	$log['otvet']=10; /* всё хорошо */ 
    $log['table']=get_fb_admin_table();
	
  } elseif($action=='disable'){ /* отключение */
  
    $delid = join(',',$_POST['id']);
	global $wpdb;
	$wpdb->query("UPDATE ".$wpdb->prefix."forex_broker SET fvkl = '0' WHERE id IN($delid)");	
	$log['otvet']=10; /* всё хорошо */ 
    $log['table']=get_fb_admin_table(); 
	
  } elseif($action=='enable'){ /* включение */
  
    $delid = join(',',$_POST['id']);
	global $wpdb;
	$wpdb->query("UPDATE ".$wpdb->prefix."forex_broker SET fvkl = '1' WHERE id IN($delid)");	
	$log['otvet']=10; /* всё хорошо */ 
    $log['table']=get_fb_admin_table(); 
	
  } elseif($action=='nullrating'){ /* обнулить рейтинг */
  
   global $wpdb;
   for($r=-1; $r++<count($_POST['id'])-1;){
	$id=$_POST['id'][$r];
    $wpdb->query("UPDATE ".$wpdb->prefix."forex_broker SET frating = '0' WHERE id='$id'");
	$wpdb->query("DELETE FROM ".$wpdb->prefix."fbp_rating WHERE fb_id='$id'");
   }  
	$log['otvet']=10; /* всё хорошо */ 
    $log['table']=get_fb_admin_table();	

   } elseif($action=='saves'){ /* сохранить */
   
   global $wpdb;
   for($r=-1; $r++<count($_POST['id'])-1;){
	$id=$_POST['id'][$r];
	$url=$_POST['partlink'][$id];
    $wpdb->query("UPDATE ".$wpdb->prefix."forex_broker SET fplink = '$url' WHERE id='$id'");	
   }  
	$log['otvet']=10; /* всё хорошо */ 
    $log['table']=get_fb_admin_table();		
  } else {
  $log['otvet']=3; /* не верный запрос */
  }
} else {
$log['otvet']=4; /* не выбраны участники */
}
} else {
$log['otvet']=2; /* не верный запрос */
}

} else {
$log['otvet']=1; /* не друг ты мне! */
}
echo json_encode($log);