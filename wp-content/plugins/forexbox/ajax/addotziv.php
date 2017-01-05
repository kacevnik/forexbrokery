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

$fb_id = intval($_POST['fb_id']);
$cparent = intval($_POST['cparent']);
$cname = fbp_cleared_post($_POST['cname']);
$cemail = is_email($_POST['cemail']);
$crating = intval($_POST['crating']);
if($crating > 2 or $crating < 0){ $crating=0; }
$ctext = fbp_cleared_post($_POST['ctext']);
global $user_ID;
$fbp_config = get_option('fbp_config');
$lcomment = $fbp_config['logincomment'];

if($lcomment == 'true' and $user_ID or $lcomment != 'true'){
if($fb_id){
    global $wpdb;
	$cc = $wpdb->query("SELECT id FROM ".$wpdb->prefix."forex_broker WHERE disablertrue='1' AND fvkl='1' AND id='$fb_id'");
    if($cc > 0){
	if($cname){
        if($cemail){
		    if(strlen($ctext) > 5){
		
		$hash = wp_generate_password(12, false, false);
	    $otv = $wpdb->insert($wpdb->prefix .'fbp_comments', array('fb_id'=>$fb_id, 'cdate'=> current_time('mysql'), 'cname'=>$cname, 'cemail'=> $cemail, 'cparent'=>$cparent, 'crating'=> $crating, 'ctext'=> $ctext, 'hash_string'=> $hash));				
	        $site_email = get_option('admin_email');
	        $site_name = get_option('blogname');		       
		    $headers = 'From: '.$site_name.' <'.$site_email.'>' . "\r\n";
		    $subject = "Подтверждение отзыва";
 
     $message = ' 
<html> 
    <head> 
        <title>'.$subject.'</title> 
    </head> 
    <body>
        <p>Здравствуйте, '.$cname.'!</p>

        <p>Для подтверждения своего отзыва, перейдите по ссылке: <a href="'. FBP_PLUGIN_URL .'ajax/modcomment.php?act='. $hash .'">подтвердить комментарий</a></p>
        <hr />
        <p>С уважением<br />
        Aдминистрация '.$site_url.'<br />
        mailto:'. $site_email .'</p>
 
    </body> 
</html>';
			   
			   
			wp_mail($cemail, $subject, $message, $headers);
$log['otv']=2;
$log['err']='на ваш e-mail отправлено письмо для подтверждения отзыва';
		
		    } else {
$log['otv']=1;
$log['err']='неинформативный отзыв';			
			}
        } else {
$log['otv']=1;
$log['err']='неккоректный e-mail';			
		}
	} else {
$log['otv']=1;
$log['err']='вы не ввели имя';	
	}
	} else {
$log['otv']=1;
$log['err']='такого сайта не существует';	
	}	
} else {
$log['otv']=1;
$log['err']='случайная ошибка';
}
} else {
$log['otv']=1;
$log['err']='комментирование разрешено только зарегистрированным пользователям';
}
$log['forexbox']=1;
echo json_encode($log);
?>