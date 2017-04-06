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

    $id = intval($_POST['fbpid']);
    $user_reiting = fbp_cleared_post($_POST['fuserreiting']);

    $narr=array();
    $narr['flogo']= fbp_cleared_post($_POST['flogo']);
    $narr['fname']= fbp_cleared_post($_POST['fname']);
    $narr['fsite']= fbp_cleared_post($_POST['fsite']);
    $narr['fnews']= fbp_cleared_post($_POST['fnews']);
    $narr['fstatus']= intval($_POST['fstatus']);
    $narr['fgod']= intval($_POST['fgod']);
    $narr['flicense_sysec']= intval($_POST['flicense_sysec']);
    $narr['flicense_fca']= intval($_POST['flicense_fca']);
    $narr['flicense_nfa']= intval($_POST['flicense_nfa']);
    $narr['fopit']= intval($_POST['fopit']);
    $narr['fplatform']= fbp_cleared_post($_POST['fplatform']);
    $narr['fsposobopl']= fbp_cleared_post($_POST['fsposobopl']);
    $narr['fdescription']= stripslashes($_POST['fdescription']);
    $narr['fadress']= fbp_cleared_post($_POST['fadress']);
    $narr['fplink']= fbp_cleared_post($_POST['fplink']);
    $narr['fminschet']= fbp_cleared_post($_POST['fminschet']);
    $narr['fkrplot']= fbp_cleared_post($_POST['fkrplot']);
    $narr['fkrpldo']= fbp_cleared_post($_POST['fkrpldo']);
    $narr['fminsdelka']= fbp_cleared_post($_POST['fminsdelka']);
    $narr['fspred']= fbp_cleared_post($_POST['fspred']);   
    $narr['fcomiss']= fbp_cleared_post($_POST['fcomiss']); 
    $narr['fdemo']= intval($_POST['fdemo']);
    $narr['fmobile']= intval($_POST['fmobile']);
    $narr['fpartner']= intval($_POST['fpartner']);
    $narr['fdovupr']= intval($_POST['fdovupr']);
    $narr['fbonus']= fbp_cleared_post($_POST['fbonus']);
    $narr['fdhtml']= $_POST['fdhtml'];  
    $narr['fvkl']= intval($_POST['fvkl']);
   
    if($narr['fname']){
    
    if(isset($user_reiting) && $user_reiting!=0){
        update_option('user_reiting_'.$id, $user_reiting);
    }else if($user_reiting == 0){
        delete_option('user_reiting_'.$id);
    }

    if($id){ 
    $cup = '';
    foreach($narr as $ckey=>$cvalue){
	    $cup .= "`$ckey`='$cvalue',";
	}
	$cup = mb_substr($cup, 0, mb_strlen($cup)-1);
    global $wpdb;
    $wpdb->query("UPDATE ".$wpdb->prefix."forex_broker SET $cup WHERE id = '$id'");

	$refer = admin_url('admin.php?page=forexbox/index.php&edit='.$id.'&otvet=2');
    header( 'Location: '.$refer, true, 301 );
	exit;	
   
    } else { 
	$narr['fslug'] = fbp_podbor_slug($narr['fname']);
    global $wpdb;
    $wpdb->insert($wpdb->prefix .'forex_broker', $narr);
    $fb_id = $wpdb->insert_id;
	    if($fb_id){

	$refer = admin_url('admin.php?page=forexbox/index.php&edit='.$fb_id.'&otvet=2');
    header( 'Location: '.$refer, true, 301 );
	exit;
	
        } else {	
wp_die('Ошибка БД.');
	    }
    }
  
    } else { 
wp_die('Вы не ввели название.');	
	}
} else { 
wp_die('Действие доступно только администраторам.');
}
?>