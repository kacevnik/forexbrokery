<?php
/*
Plugin Name: Рейтинг форекс брокеров ForexBox
Plugin URI: http://best-curs.info
Description: Независимый рейтинг брокерских компаний Форекс
Version: 2.0
Author: Dmitrii Kovalev (Remix)
Author URI: https://www.fl.ru/users/kacevnik/
*/

global $fbp_version;
$fbp_version = '2.0';

global $fbp_has_new;
$fbp_has_new = get_option('fbp_version');

if( !defined( 'ABSPATH')){ exit(); }

if(!defined('FBP_PLUGIN_NAME')){
	define('FBP_PLUGIN_NAME', plugin_basename(__FILE__));
}
if(!defined('FBP_PLUGIN_DIR')){
	define('FBP_PLUGIN_DIR', dirname(__FILE__).'/');
}
if(!defined('FBP_PLUGIN_URL')){
	define('FBP_PLUGIN_URL', plugins_url(str_replace('.php','',basename(FBP_PLUGIN_NAME))).'/');
}

if(!defined('FBP_PARTNERS_PROGRAMM')){
	define('FBP_PARTNERS_PROGRAMM', 'true'); /* если нужно отключить партнёрку, ставим false */
}

add_filter('plugin_row_meta', 'fbp_text_info', 10, 2);
function fbp_text_info($links, $file){
	if ( $file == plugin_basename(__FILE__) ){
		$links[] = '<a href="http://best-curs.info">Помощь</a>';
	}
	return $links;
}

function fbp_template($page){
$pager = FBP_PLUGIN_DIR . "/".$page.".php";
    if(file_exists($pager)){
        include($pager);
    }
}

fbp_template('functions');
fbp_template('includes/admin_func');
fbp_template('admininterface');
fbp_template('cron');
fbp_template('includes/shortcode');
fbp_template('includes/comment_func');
fbp_template('includes/sravni_func');
fbp_template('includes/table_func');

if(FBP_PARTNERS_PROGRAMM == 'true'){
    fbp_template('includes/users_func');
    fbp_template('includes/mails_func');
}


register_activation_hook(__FILE__, 'fbp_activation_cron');
add_action('fbp_hourly_event', 'fbp_this_hourly');

function fbp_activation_cron() {
	wp_schedule_event(time(), 'hourly', 'fbp_hourly_event'); 
}

function fbp_this_hourly() {
    fbp_chkv();
	fbp_curs_cbrf();
	fbp_del_sravni();
}

register_deactivation_hook(__FILE__, 'fbp_deactivation_cron');
function fbp_deactivation_cron() {
	wp_clear_scheduled_hook('fbp_hourly_event');
}



add_action('activate_'. FBP_PLUGIN_NAME,'fbp_plugins_activate');
function fbp_plugins_activate(){
	fbp_template('activate');
}
register_uninstall_hook( __FILE__, 'fbp_plugins_uninstall');
function fbp_plugins_uninstall(){

delete_option('fbp_version');
delete_option('fbp_curs');
delete_option('fbp_pages');
delete_option('fbp_parners');
delete_option('fbp_texts_material');
delete_option('fbp_banner_468');
delete_option('fbp_banner_200');
delete_option('fbp_banner_120');
delete_option('fbp_banner_100');
delete_option('fbp_banner_88');
delete_option('fbp_last_rating');	
delete_option('fbp_distable');
delete_option('fbp_config');

global $wpdb;
$wpdb->query("DROP TABLE " . $wpdb->prefix . "fbpwithdraw");
$wpdb->query("DROP TABLE " . $wpdb->prefix . "fbp_link");
$wpdb->query("DROP TABLE " . $wpdb->prefix . "fbp_rating");
$wpdb->query("DROP TABLE " . $wpdb->prefix . "fbp_comments");
$wpdb->query("DROP TABLE " . $wpdb->prefix . "forex_broker");
$wpdb->query("DROP TABLE " . $wpdb->prefix . "fbp_sravni");

}
?>