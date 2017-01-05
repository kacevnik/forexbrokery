<?php

include_once('../../../../wp-config.php');
include_once('../../../../wp-load.php');
include_once('../../../../wp-includes/wp-db.php');
header('Content-Type: text/html; charset=utf-8');

nocache_headers();
if($_GET['ok']){
$email = strip_tags($_GET['email']);
$pass = strip_tags($_GET['pass']);
$login = strip_tags($_GET['login']);
$err = strip_tags($_GET['err']);

$creds = array();
$creds['user_login'] = $login;
$creds['user_password'] = $pass;
$creds['remember'] = true;		
		
$user = wp_signon($creds, $secure_cookie);

$pages = get_option('fbp_pages');
$url = get_permalink($pages['fbpprofile'])."?err=$err&email=$email&ok=1";
header( "Location: $url" );
exit;

}
?>



