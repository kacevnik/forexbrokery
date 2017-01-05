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
global $user_ID;
	
if(current_user_can('administrator') and FBP_PARTNERS_PROGRAMM == 'true'){

if($_POST['go']){
$action = $_POST['action'];

if($action=='pod1'){

for($i=0; $i<count($_POST['post']); $i++){
    global $wpdb;
	$sql = "SELECT * FROM ".$wpdb->prefix."fbpwithdraw WHERE payid = '".$_POST['post'][$i]."'";
    $pro = $wpdb->get_row($sql);
    $us_id = $pro->userid;
	$xstatus = $pro->xstatus;
	if($xstatus==1){
	$comment = $_POST['text'.$_POST['post'][$i]];
    $the_z = $wpdb->query("UPDATE ".$wpdb->prefix."fbpwithdraw SET xstatus = '2', xcomment = '$comment' WHERE payid = '".$_POST['post'][$i]."'");
    }
}

	$refer = admin_url('admin.php?page=forexbox/partner.php&mypage=payout&otvet=2');
    header( 'Location: '.$refer, true, 301 );
	exit;

}

if($action=='pod2'){

for($i=0; $i<count($_POST['post']); $i++){
    global $wpdb;
	$sql = "SELECT * FROM ".$wpdb->prefix."fbpwithdraw WHERE payid = '".$_POST['post'][$i]."'";
    $pro = $wpdb->get_row($sql);
    $us_id = $pro->userid;
	$amount = $pro->amount;
	$xstatus = $pro->xstatus;
	if($xstatus==1){
	$money = get_usermeta($us_id, 'money');	
	$comment = $_POST['text'.$_POST['post'][$i]];
    $the_z = $wpdb->query("UPDATE ".$wpdb->prefix."fbpwithdraw SET xstatus = '3', xcomment = '$comment' WHERE payid = '".$_POST['post'][$i]."'");
	$pos = $money + $amount;
	update_user_meta( $us_id, 'money', $pos) or add_user_meta($us_id, 'money', $pos, true);
    }
}

	$refer = admin_url('admin.php?page=forexbox/partner.php&mypage=payout&otvet=2');
    header( 'Location: '.$refer, true, 301 );
	exit;

}
if($action=='pod3'){
   $targetPath = FBP_PLUGIN_DIR .'xml/';
   @mkdir($targetPath , 0777);
   $site = str_replace('http://','',get_bloginfo('url'));
   $date = date('d-m-Y(H-i)',current_time('timestamp'));
   $files = $targetPath.$date.'.xml';
   $content = '<payments xmlns="http://tempuri.org/ds.xsd">'."\n";
   
for($i=0; $i<count($_POST['post']); $i++) {
    global $wpdb;
	$sql = "SELECT * FROM ".$wpdb->prefix."fbpwithdraw WHERE payid = '".$_POST['post'][$i]."'";
    $pro = $wpdb->get_row($sql);
    $us_id = $pro->userid;
	$amount = $pro->amount;
	$wmz = get_usermeta($us_id, 'wmz');
	$sql = "SELECT * FROM ".$wpdb->prefix."users WHERE ID = '".$us_id."'";
    $pros = $wpdb->get_row($sql);	
    $login = $pros->user_login;
    
    $content .= "<payment>
         <Destination>$wmz</Destination>
         <Amount>$amount</Amount>
         <Description>Vyvod sredstv dlja pol'zovatelja ".$login.".</Description>
         <Id>".$_POST['post'][$i]."</Id>
    </payment>\n"; 
}
   $fs=@fopen($files, 'a');
   $content .= '</payments>';
   if(!fwrite($fs, "".$content)) die("Ошибка записи.");
   fclose($fs);

	$refer = admin_url('admin.php?page=forexbox/partner.php&mypage=payout&otvet=2&filexmls='.$date);
    header( 'Location: '.$refer, true, 301 );
	exit;
   
}
}	
	
} else {
    wp_die('Ошибка: действие разрешено только администратору');
}	

?>