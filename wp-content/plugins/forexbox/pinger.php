<?php
include_once('../../../wp-config.php');
include_once('../../../wp-load.php');
include_once('../../../wp-includes/wp-db.php');
header('Content-Type: text/html; charset=utf-8');

define('PING_TIMEOUT', 10);

global $wpdb;
$nfb = array();
$aur = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."forex_broker ORDER BY id DESC");
foreach($aur as $au){
    $id = $au->id;
    $host = parse_url($au->fsite, PHP_URL_HOST);
    if(trim($host) == ''){
		$res = false;
	}else{
		$res = @fsockopen($host, 80, $a, $a, PING_TIMEOUT);
	}
    if($res === false){
	   $disabled=0;
	   $nfb[] = $au->fname;
	} else {
	   $disabled=1;
	}
		$wpdb->query("UPDATE ".$wpdb->prefix."forex_broker SET disablertrue = '$disabled' WHERE id = '$id'");
 
}

if(count($nfb) > 0){
   echo '<div class="class_sucess">Выполнено. Недоступны следующие: <br />';
       foreach($nfb as $nft){
	     echo '- '.$nft.'<br />';
	   }
   echo '</div>';
} 

?>