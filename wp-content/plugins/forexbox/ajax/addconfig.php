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

$distable = array();
$distable['por'] = $_POST['por'];
$distable['enable']['fdc1']=$_POST['fdc1'];
$distable['enable']['fdc2']=$_POST['fdc2'];
$distable['enable']['fdc3']=$_POST['fdc3'];
$distable['enable']['fdc4']=$_POST['fdc4'];
$distable['enable']['fdc5']=$_POST['fdc5'];
$distable['enable']['fdc6']=$_POST['fdc6'];
$distable['enable']['fdc7']=$_POST['fdc7'];
$distable['name']['fdoc1']=fbp_cleared_post($_POST['fdoc1']);
$distable['name']['fdoc2']=fbp_cleared_post($_POST['fdoc2']);
$distable['name']['fdoc3']=fbp_cleared_post($_POST['fdoc3']);
$distable['name']['fdoc4']=fbp_cleared_post($_POST['fdoc4']);
$distable['name']['fdoc5']=fbp_cleared_post($_POST['fdoc5']);
$distable['name']['fdoc6']=fbp_cleared_post($_POST['fdoc6']);
$distable['name']['fdoc7']=fbp_cleared_post($_POST['fdoc7']);

$distable['table1']['ftab1']=fbp_cleared_post($_POST['ftab1']);
$distable['table1']['ftab2']=fbp_cleared_post($_POST['ftab2']);
$distable['table1']['ftab3']=fbp_cleared_post($_POST['ftab3']);
$distable['table1']['ftab4']=fbp_cleared_post($_POST['ftab4']);
$distable['table1']['ftab5']=fbp_cleared_post($_POST['ftab5']);
$distable['table1']['ftab6']=fbp_cleared_post($_POST['ftab6']);
$distable['table1']['ftab7']=fbp_cleared_post($_POST['ftab7']);
$distable['table1']['ftab8']=fbp_cleared_post($_POST['ftab8']);
$distable['table1']['ftab9']=fbp_cleared_post($_POST['ftab9']);
$distable['table1']['ftab10']=fbp_cleared_post($_POST['ftab10']);
$distable['table1']['ftab11']=fbp_cleared_post($_POST['ftab11']);
$distable['table1']['ftab12']=fbp_cleared_post($_POST['ftab12']);
$distable['table1']['ftab13']=fbp_cleared_post($_POST['ftab13']);
$distable['table1']['ftab14']=fbp_cleared_post($_POST['ftab14']);
$distable['table1']['ftab15']=fbp_cleared_post($_POST['ftab15']);
$distable['table1']['ftab16']=fbp_cleared_post($_POST['ftab16']);
$distable['table1']['ftab17']=fbp_cleared_post($_POST['ftab17']);
$distable['table1']['ftab18']=fbp_cleared_post($_POST['ftab18']);
$distable['table1']['ftab19']=fbp_cleared_post($_POST['ftab19']);
$distable['table1']['ftab20']=fbp_cleared_post($_POST['ftab20']);

    update_option('fbp_distable', $distable);

	$refer = admin_url('admin.php?page=forexbox/vnv.php&otvet=2');
    header( 'Location: '.$refer, true, 301 );
	exit;
	
} else { 
wp_die('Действие доступно только администраторам.');
}
?>