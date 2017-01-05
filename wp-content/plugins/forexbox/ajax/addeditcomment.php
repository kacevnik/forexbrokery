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
   
    $narr=array();
    $narr['cdate']= $_POST['c1_yea1'].'-'.$_POST['c1_mon1'].'-'.$_POST['c1_day1'].' '.$_POST['c1_ch1'].':'.$_POST['c1_min1'].':00';;
    $narr['fb_id']= intval($_POST['fb_id']);
    $narr['cparent']= intval($_POST['cparent']);
    $narr['cname']= fbp_cleared_post($_POST['cname']);
    $narr['cemail']= is_email($_POST['cemail']);
    $narr['crating']= intval($_POST['crating']); 
    $narr['cactive']= intval($_POST['cactive']);
    $narr['ctext']= fbp_cleared_post($_POST['ctext']); 
   
    if($narr['ctext'] and $narr['cname']){
   
    global $wpdb;
    if($id){ 
	    $lc = $wpdb->get_row("SELECT * FROM ". $wpdb->prefix ."fbp_comments WHERE id='$id'");
		$lo = $lc->crating;
		$lcp = $lc->cparent;
		$lfid = $lc->fb_id;
		$lfac = $lc->cactive;
		$rat = $narr['crating'];
		$idg = $narr['fb_id'];
		
		if($lcp == 0 and $narr['cparent'] > 0 or $lfid != $idg){
		    $wpdb->query("UPDATE ".$wpdb->prefix."fbp_comments SET cparent='0' WHERE cparent = '$id'");
		}
		if($lfac==1){
		if($lo==2){
		    $wpdb->query("UPDATE ".$wpdb->prefix."forex_broker SET `footz`=`footz`-1 WHERE id = '$lfid'");
		} elseif($lo==1){
		    $wpdb->query("UPDATE ".$wpdb->prefix."forex_broker SET `fpotz`=`fpotz`-1 WHERE id = '$lfid'");
		} else {
		    $wpdb->query("UPDATE ".$wpdb->prefix."forex_broker SET `fnotz`=`fnotz`-1 WHERE id = '$lfid'");
		}	
        }		
		
    $cup = '';
    foreach($narr as $ckey=>$cvalue){
	    $cup .= "`$ckey`='$cvalue',";
	}
	$cup = mb_substr($cup, 0, mb_strlen($cup)-1);
    $wpdb->query("UPDATE ".$wpdb->prefix."fbp_comments SET $cup WHERE id = '$id'");
    if($narr['cactive']==1){
		if($rat==2){
		    $wpdb->query("UPDATE ".$wpdb->prefix."forex_broker SET `footz`=`footz`+1 WHERE id = '$idg'");
		} elseif($rat==1){
		    $wpdb->query("UPDATE ".$wpdb->prefix."forex_broker SET `fpotz`=`fpotz`+1 WHERE id = '$idg'");
		} else {
		    $wpdb->query("UPDATE ".$wpdb->prefix."forex_broker SET `fnotz`=`fnotz`+1 WHERE id = '$idg'");
		}	
	}
	
	$refer = admin_url('admin.php?page=forexbox/otziv.php&edit='.$id.'&otvet=2');
    header( 'Location: '.$refer, true, 301 );
	exit;	
   
    } else { 
    global $wpdb;
    $wpdb->insert($wpdb->prefix .'fbp_comments', $narr);
    $com_id = $wpdb->insert_id;
	    $rat = $narr['crating'];
		$idg = $narr['fb_id'];
		if($narr['cactive']==1){
		if($rat==2){
		    $wpdb->query("UPDATE ".$wpdb->prefix."forex_broker SET `footz`=`footz`+1 WHERE id = '$idg'");
		} elseif($rat==1){
		    $wpdb->query("UPDATE ".$wpdb->prefix."forex_broker SET `fpotz`=`fpotz`+1 WHERE id = '$idg'");
		} else {
		    $wpdb->query("UPDATE ".$wpdb->prefix."forex_broker SET `fnotz`=`fnotz`+1 WHERE id = '$idg'");
		}
		}

	$refer = admin_url('admin.php?page=forexbox/otziv.php&edit='.$com_id.'&otvet=2');
    header( 'Location: '.$refer, true, 301 );
	exit;
    }
  
    } else { 
wp_die('Вы не ввели текст или имя.');	
	}
} else { 
wp_die('Действие доступно только администраторам.');
}
?>