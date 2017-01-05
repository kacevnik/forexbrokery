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
global $wpdb, $user_ID;

$rat = intval($_POST['rat']);
if($rat < 1 or $rat > 5){ $rat=5; }
$fbid = intval($_POST['fbid']);
$fbp_config = get_option('fbp_config');
$lrating = $fbp_config['loginrating'];

if($lrating == 'true' and $user_ID or $lrating != 'true'){
if($fbid){
    $post = $wpdb->get_row("SELECT * FROM ". $wpdb->prefix ."forex_broker WHERE id='$fbid' AND disablertrue='1' AND fvkl='1'");
    if($post->id){
        $cc = get_fbp_your_rating($fbid);
		if($cc==0){
		    $lrat = $post->frating;
			$nrat = $lrat+$rat;
			$date = date('Y-m-d', strtotime('+4 hours'));
			
			$wpdb->insert($wpdb->prefix .'fbp_rating', array('fb_id'=>$fbid, 'rdate'=> $date, 'rrating'=>$rat, 'ryour'=> fbp_your_id()));
		    $wpdb->query("UPDATE ".$wpdb->prefix."forex_broker SET `frating`='$nrat' WHERE id = '$fbid'");
		
            $log['otv']=2;
            $log['table'] = '<div class="fbpsmall">голос учтён</div>';
            $log['rating'] = $nrat;

    } else {
$log['otv']=1;
$log['err']='вы уже выставили оценку';	
	}
    } else {
$log['otv']=1;
$log['err']='нет такого участиника';	
	}
} else {
$log['otv']=1;
$log['err']='случайная ошибка';
}
} else {
$log['otv']=1;
$log['err']='выставлять рейтинг могут только зарегистрированные пользователи';
}
$log['forexbox']=1;
echo json_encode($log);
?>



