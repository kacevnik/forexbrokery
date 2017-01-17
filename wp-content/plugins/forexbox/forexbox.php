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

add_action( 'wp_enqueue_scripts', 'kdv_my_scripts_main' );
function kdv_my_scripts_main(){
	wp_enqueue_script( 'kdv_main', plugins_url('js/main.js', __FILE__));
}

add_action( 'wp_enqueue_scripts', 'kdv_my_scripts_ui_query' );
function kdv_my_scripts_ui_query(){
	wp_enqueue_script( 'kdv_ui_query', plugins_url('js/jquery-ui-1.8.21.custom.js', __FILE__));
	wp_enqueue_style( 'kdv_ui_query_style', plugins_url('jquery-ui-1.8.21.custom.css', __FILE__));
}

add_action('wp_head', 'kdv_hook_css');
function kdv_hook_css(){
	echo '<style>
	.ui-slider .ui-slider-handle {
		cursor: pointer;
		border: none;
		width:24px;
		height:24px;
		position:absolute;
		top:-7px;
		margin-left:-12px;
		z-index:200;
		background:url('.plugins_url("images/slider-button.png", __FILE__).');
	}
	.ui-widget-header {
		background-color: #c5c5c5;
	    background: -webkit-linear-gradient(#c5c5c5, #a2a2a2);
	    background: -o-linear-gradient(#c5c5c5, #a2a2a2);
	    background: linear-gradient(#c5c5c5, #a2a2a2);
		height:12px;
		left:1px;
		top:1px;
		position:absolute;
	}
	</style>';
}

add_action('wp_footer', 'kdv_hook_js');
function kdv_hook_js(){
	echo '<script type="text/javascript">	
     $( ".pleco" ).slider({
        animate: true, // Анимация ползунка
        range: "min", // Фон пути ползунка, если это свойство убрать, то синей линии не будет.
        value: 100, // Значение по умолчанию.
        min: 0, // Минимальная сумма.
        max: 500, // Максимальная сумма.
    	step: 25, // Шаг диапазона.
 
    // Вывод диапазона в поле input
    	      create: function() {
        $(".pleco .ui-slider-handle").attr("data", 100);
      },
            change: function(event, ui) {
            	$("#pleco").attr("value", ui.value);
            },
            slide: function( event, ui ) {
        		$(".pleco .ui-slider-handle").attr("data", ui.value);
        	}
      
 		
     });

$( ".dipozit" ).slider({
        animate: true, // Анимация ползунка
        range: "min", // Фон пути ползунка, если это свойство убрать, то синей линии не будет.
        value: 300, // Значение по умолчанию.
        min: 0, // Минимальная сумма.
        max: 1000, // Максимальная сумма.
    	step: 25, // Шаг диапазона.
 
    // Вывод диапазона в поле input
    	      create: function() {
        $(".dipozit .ui-slider-handle").attr("data", 300);
      },
            change: function(event, ui) {
            	$("#dipozit").attr("value", ui.value);
            },
            slide: function( event, ui ) {
        		$(".dipozit .ui-slider-handle").attr("data", ui.value);
        	}
      
 		
     });


     $( ".spred" ).slider({
        animate: true, // Анимация ползунка
        range: "min", // Фон пути ползунка, если это свойство убрать, то синей линии не будет.
        value: 3, // Значение по умолчанию.
        min: 0, // Минимальная сумма.
        max: 5, // Максимальная сумма.
    	step: 1, // Шаг диапазона.
 
    // Вывод диапазона в поле input
    	      create: function() {
        $(".spred .ui-slider-handle").attr("data", 3);
      },
            change: function(event, ui) {
            	$("#spred").attr("value", ui.value);
            },
            slide: function( event, ui ) {
        		$(".spred .ui-slider-handle").attr("data", ui.value);
        	}
      
 		
     });

     </script>';
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

if( !function_exists('_add_my_quicktags') ){
function _add_my_quicktags()
{ ?>
<script type="text/javascript">
	QTags.addButton( 'otziv_p', 'Положительные отзывы', '[fbp_otziv_p]', '' );
	QTags.addButton( 'otziv_n', 'Нетральные отзывы', '[fbp_otziv_n]', '' );
	QTags.addButton( 'otziv_o', 'Отрецательные отзывы', '[fbp_otziv_o]', '' );
</script>
<?php }
add_action('admin_print_footer_scripts', '_add_my_quicktags');
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