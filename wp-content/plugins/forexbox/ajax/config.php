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

    
    $text['do'] = stripslashes($_POST['ftextdo']);
	$text['ot'] = stripslashes($_POST['ftextot']);
	$text['countvn'] = stripslashes($_POST['fcountvn']);

	$text['fb_max_cr_plecho_min'] = stripslashes($_POST['fb_max_cr_plecho_min']);
	$text['fb_max_cr_plecho_max'] = stripslashes($_POST['fb_max_cr_plecho_max']);
	$text['fb_max_cr_plecho_step'] = stripslashes($_POST['fb_max_cr_plecho_step']);
	$text['fb_max_cr_plecho_first'] = stripslashes($_POST['fb_max_cr_plecho_first']);

	$text['fb_min_depozit_min'] = stripslashes($_POST['fb_min_depozit_min']);
	$text['fb_min_depozit_max'] = stripslashes($_POST['fb_min_depozit_max']);
	$text['fb_min_depozit_step'] = stripslashes($_POST['fb_min_depozit_step']);
	$text['fb_min_depozit_first'] = stripslashes($_POST['fb_min_depozit_first']);

	$text['fb_min_spred_min'] = stripslashes($_POST['fb_min_spred_min']);
	$text['fb_min_spred_max'] = stripslashes($_POST['fb_min_spred_max']);
	$text['fb_min_spred_step'] = stripslashes($_POST['fb_min_spred_step']);
	$text['fb_min_spred_first'] = stripslashes($_POST['fb_min_spred_first']);

	$text['fb_text_filter'] = stripslashes($_POST['fb_text_filter']);

	$text['loginrating'] = esc_html($_POST['loginrating']);
	$text['logincomment'] = esc_html($_POST['logincomment']);
    update_option('fbp_config', $text);

	$refer = admin_url('admin.php?page=forexbox/config.php&otvet=2');
    header( 'Location: '.$refer, true, 301 );
	exit;
	
} else { 
wp_die('Действие доступно только администраторам.');
}