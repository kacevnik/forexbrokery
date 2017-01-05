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
if($user_ID and FBP_PARTNERS_PROGRAMM == 'true'){

$id = intval($_POST['id']);

$xcomment = ' Выплата отменена пользователем ['.current_time('mysql').'].';
global $wpdb;
$the_z = $wpdb->query("UPDATE ".$wpdb->prefix."fbpwithdraw SET xstatus = '3', xcomment = '$xcomment' WHERE userid = '$user_ID' and xstatus = '1' and payid = '$id'");
if($the_z > 0){
$money = get_usermeta($user_ID, 'money');
global $wpdb;
$sql = "SELECT * FROM ".$wpdb->prefix."fbpwithdraw WHERE userid = '$user_ID' and payid = '$id'";
$pro = $wpdb->get_row($sql);
$amount = $pro->amount;

$sum = $money + $amount;
update_user_meta( $user_ID, 'money', $sum) or add_user_meta($user_ID, 'money', $sum, true);

echo '<div class="fbp_reg_otvet_yes">Заказ на выплату ($'.$amount.') отменён.</div>';

}

}

?>



