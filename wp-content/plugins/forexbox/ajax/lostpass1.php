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
global $user_ID, $wpdb;

if(!$user_ID and FBP_PARTNERS_PROGRAMM == 'true'){

	$mail = $_POST['lostlog'];
	    if(is_email($mail)){
		    $id_user = email_exists($mail);
		    if ($id_user){
		        $prefix = $wpdb->prefix;
		        $level = get_usermeta($id_user, $prefix.'user_level');
		        if($level!=10){
		            $admin_password = wp_generate_password( 12 , false, false);
		            $otvet = $wpdb->query("UPDATE ".$wpdb->prefix."users SET user_activation_key = '$admin_password' WHERE user_email = '$mail'");
	                $user_info = fbp_vse_o_usere($id_user);
		            $gomail = fbp_lostpass_email($user_info['login'],$mail,$admin_password);

	                if($gomail and $otvet){			  
    $log['otvet'] = 2;
	$log['ers'] = 'на ваш e-mail выслано письмо с подтверждением';
			        } else {
    $log['otvet'] = 1;
	$log['ers'] = 'попробуйте повторить позже';
			        }
		      } else {
    $log['otvet'] = 1;
	$log['ers'] = 'запрещено восстанавливать e-mail';
		      }	   
		   } else {
    $log['otvet'] = 1;
	$log['ers'] = 'пользователя нет';
		   }	   
		   
		}  else {
    $log['otvet'] = 1;
	$log['ers'] = 'некорректный e-mail';
		}
} else {
    $log['otvet'] = 1;
	$log['ers'] = 'запрещено';
}

$log['forexbox'] = 'yes';
echo json_encode($log);

?>