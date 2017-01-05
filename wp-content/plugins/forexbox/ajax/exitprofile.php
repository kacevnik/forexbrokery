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

if($_POST['save_ld'] and $user_ID){
		
$user_name_s = strip_tags($_POST['user_name_s']);
$user_mail_s = strip_tags($_POST['user_mail_s']);
$pass = strip_tags($_POST['pass']);
$pass2 = strip_tags($_POST['pass2']);

$user_infos = get_userdata($user_ID);
$user_Login = $user_infos->user_login;
$email = $user_infos->user_email;		
	
update_user_meta( $user_ID, 'first_name', $user_name_s) or add_user_meta($user_ID, 'first_name', $user_name_s, true);
	
if($user_mail_s){	
if($email != $user_mail_s){
if (!email_exists($user_mail_s) ){
if (is_email($user_mail_s )) {
global $wpdb;
$wpdb->query("UPDATE ".$wpdb->prefix."users SET user_email = '$user_mail_s' WHERE ID = '$user_ID'");
} else {
$err1 = 2;
}
} else {
$err1 = 1;
}
}
}		
	
$pass = fbp_is_password($_POST['pass']);
$pass2 = fbp_is_password($_POST['pass2']);	
	
	
if($pass){

if($pass == $pass2){

$passwrd = wp_hash_password($pass);
global $wpdb;
$wpdb->query("UPDATE ".$wpdb->prefix."users SET user_pass = '$passwrd' WHERE ID = '$user_ID'");

wp_clear_auth_cookie();
do_action('wp_logout');

$url = FBP_PLUGIN_URL. '/ajax/editprofile.php?err='.$err1.'&ok=1&email='.$user_mail_s.'&pass='.$pass.'&login='.$user_Login;
header( "Location: $url" );
exit;

} else {

$pages = get_option('fbp_pages');
$url = get_permalink($pages['fbpprofile']).'?err='.$err1.'&err2=1&ok=1&email='.$user_mail_s.'&pass='.$pass.'&pass2='.$pass2;
header( "Location: $url" );
exit;

}
} else {

$pages = get_option('fbp_pages');
$url = get_permalink($pages['fbpprofile']).'?err='.$err1.'&ok=1&email='.$user_mail_s.'&pass='.$pass.'&pass2='.$pass2;
header( "Location: $url" );
exit;

}


}

?>



