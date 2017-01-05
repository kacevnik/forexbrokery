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


$slovo = fbp_cleared_post($_POST['slovo']);
if(strlen($slovo) > 0){
global $wpdb;
$cc = $wpdb->query("SELECT id FROM ".$wpdb->prefix."forex_broker WHERE fname LIKE '%$slovo%' AND disablertrue='1' AND fvkl='1' ORDER BY fname asc LIMIT 5");
    if($cc > 0){
    ?>
	<div id="fbpvsform">
		<ul>
		<?php
		$posts = $wpdb->get_results("SELECT fname FROM ".$wpdb->prefix."forex_broker WHERE fname LIKE '%$slovo%' AND disablertrue='1' AND fvkl='1' ORDER BY fname asc LIMIT 5");
		foreach($posts as $post){
		?>
			<li><a href="#"><?php echo $post->fname;?></a></li>
        <?php
		}
		?>
		</ul>
	</div>
    <?php
	}
}
