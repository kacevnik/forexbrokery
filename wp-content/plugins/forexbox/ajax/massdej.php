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
$id = intval($_POST['id']);
$dej = intval($_POST['d']);
    if($id and $dej){
	   global $wpdb;
	   if($dej==1){ /* удаление */
       
	        $wpdb->query("DELETE FROM ".$wpdb->prefix."forex_broker WHERE id = '$id'");
	        $wpdb->query("DELETE FROM ".$wpdb->prefix."fbp_rating WHERE fb_id = '$id'");
	        $wpdb->query("DELETE FROM ".$wpdb->prefix."fbp_comments WHERE fb_id = '$id'");
	        delete_option('user_reiting_'.$id);//удаление пользовательского рейтинга
	        
	   $log['otvet']=10; /* всё хорошо */ 
	   $log['table']=get_fb_admin_table();
       
	   } elseif($dej==2) { /* включить */

	   $wpdb->query("UPDATE ".$wpdb->prefix."forex_broker SET fvkl = '1' WHERE id = '$id'");	
	
       $log['otvet']=10; /* всё хорошо */ 
       $log['table']=get_fb_admin_table();
	   
	   } elseif($dej==3) { /* отключить */
	   
	   $wpdb->query("UPDATE ".$wpdb->prefix."forex_broker SET fvkl = '0' WHERE id = '$id'");	
	   
       $log['otvet']=10; /* всё хорошо */ 
       $log['table']=get_fb_admin_table();
	   
	   } elseif($dej==4) { /* отключить */
	   
	   $wpdb->query("UPDATE ".$wpdb->prefix."forex_broker SET frating = '0' WHERE id = '$id'");	
	   $wpdb->query("DELETE FROM ".$wpdb->prefix."fbp_rating WHERE fb_id='$id'");
	   
       $log['otvet']=10; /* всё хорошо */ 
       $log['table']=get_fb_admin_table();	   
	   
	   }
	
	} else {
	$log['otvet']=2; /* не обработан id КА */
	}
} else {
$log['otvet']=1; /* не друг ты мне! */
}
echo json_encode($log);