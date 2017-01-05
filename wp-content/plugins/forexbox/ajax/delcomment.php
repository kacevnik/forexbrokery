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

/* быстрые действия с комментарием */
if(current_user_can('administrator')){
$id = intval($_POST['id']);
$dej = intval($_POST['d']);
    if($id and $dej){
	   global $wpdb;
	if($dej==1){ /* удаление комментария */
       
        global $wpdb;
	    $lc = $wpdb->get_row("SELECT * FROM ". $wpdb->prefix ."fbp_comments WHERE id='$id'");
		$lo = $lc->crating;
		$lcp = $lc->cparent;
		$lfid = $lc->fb_id;
		$lfac = $lc->cactive;
		
		$wpdb->query("UPDATE ".$wpdb->prefix."fbp_comments SET cparent='0' WHERE cparent = '$id'");
		
		if($lfac==1){
		if($lo==2){
		    $wpdb->query("UPDATE ".$wpdb->prefix."forex_broker SET `footz`=`footz`-1 WHERE id = '$lfid'");
		} elseif($lo==1){
		    $wpdb->query("UPDATE ".$wpdb->prefix."forex_broker SET `fpotz`=`fpotz`-1 WHERE id = '$lfid'");
		} else {
		    $wpdb->query("UPDATE ".$wpdb->prefix."forex_broker SET `fnotz`=`fnotz`-1 WHERE id = '$lfid'");
		}	
        }		
		
        $wpdb->query("DELETE FROM ".$wpdb->prefix."fbp_comments WHERE id='$id'");

       $log['otvet']=10; /* всё хорошо */ 
	   $log['table']=get_fbcomment_admin_table();
       
	} elseif($dej==2) { /* подтвердить комментарий */

        global $wpdb;
	    $lc = $wpdb->get_row("SELECT * FROM ". $wpdb->prefix ."fbp_comments WHERE id='$id'");
		$lo = $lc->crating;
		$lfid = $lc->fb_id;
		
		if($lo==2){
		    $wpdb->query("UPDATE ".$wpdb->prefix."forex_broker SET `footz`=`footz`+1 WHERE id = '$lfid'");
		} elseif($lo==1){
		    $wpdb->query("UPDATE ".$wpdb->prefix."forex_broker SET `fpotz`=`fpotz`+1 WHERE id = '$lfid'");
		} else {
		    $wpdb->query("UPDATE ".$wpdb->prefix."forex_broker SET `fnotz`=`fnotz`+1 WHERE id = '$lfid'");
		}					
		
		$wpdb->query("UPDATE ".$wpdb->prefix."fbp_comments SET `cactive`='1' WHERE id = '$id'");
	
       $log['otvet']=10; /* всё хорошо */ 
       $log['table']=get_fbcomment_admin_table();	   
	} elseif($dej==3) { /* отключить */
	   
        global $wpdb;
	    $lc = $wpdb->get_row("SELECT * FROM ". $wpdb->prefix ."fbp_comments WHERE id='$id'");
		$lo = $lc->crating;
		$lfid = $lc->fb_id;
		
		if($lo==2){
		    $wpdb->query("UPDATE ".$wpdb->prefix."forex_broker SET `footz`=`footz`-1 WHERE id = '$lfid'");
		} elseif($lo==1){
		    $wpdb->query("UPDATE ".$wpdb->prefix."forex_broker SET `fpotz`=`fpotz`-1 WHERE id = '$lfid'");
		} else {
		    $wpdb->query("UPDATE ".$wpdb->prefix."forex_broker SET `fnotz`=`fnotz`-1 WHERE id = '$lfid'");
		}					
		
		$wpdb->query("UPDATE ".$wpdb->prefix."fbp_comments SET `cactive`='0' WHERE id = '$id'");
	
       $log['otvet']=10; /* всё хорошо */ 
       $log['table']=get_fbcomment_admin_table();
	   
	}
	
	} else {
	$log['otvet']=2; /* не обработан id КА */
	}
} else {
$log['otvet']=1; /* не друг ты мне! */
}
echo json_encode($log);