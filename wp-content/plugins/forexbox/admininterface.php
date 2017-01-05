<?php
if( !defined( 'ABSPATH')){ exit(); }

add_action('admin_menu', 'fbp_add_admin');
function fbp_add_admin() {

    add_menu_page("ForexBox - Абсолютный рейтинг брокерских компаний Форекс", "Рейтинг ФБ", 10, 'forexbox/index.php', 'fbp_index', FBP_PLUGIN_URL .'/images/forex.png');  
    add_submenu_page("forexbox/index.php", "Участники", "Участники", 10, "forexbox/index.php", "fbp_index");
	add_submenu_page("forexbox/index.php", "Внешний вид", "Внешний вид", 10, "forexbox/vnv.php", "fbp_vnv");
	add_submenu_page("forexbox/index.php", "Статистика", "Статистика", 10, "forexbox/stats.php", "fbp_stats");
	add_submenu_page("forexbox/index.php", "Отзывы", "Отзывы", 10, "forexbox/otziv.php", "fbp_otziv");
	
	if(FBP_PARTNERS_PROGRAMM=='true'){
	    add_submenu_page('forexbox/index.php', 'Партнёрка', 'Партнёрка', 10, 'forexbox/partner.php', 'fbp_partners');
	}
	
	add_submenu_page("forexbox/index.php", "Настройки", "Настройки", 10, "forexbox/config.php", "fbp_config");
}

function fbp_index(){
    fbp_admin_template('index');
}
function fbp_partners(){
    fbp_admin_template('partners');
}
function fbp_vnv(){
    fbp_admin_template('vnv');
}
function fbp_stats(){
    fbp_admin_template('stats');
}
function fbp_otziv(){
    fbp_admin_template('otziv');
}
function fbp_config(){
    fbp_admin_template('config');
}

add_action('admin_init', 'fbp_admin_init');
function fbp_admin_init() {
$file_dir = FBP_PLUGIN_URL;

    if (preg_match('/^forexbox/i',$_GET['page'])){	
	    wp_enqueue_style('forexbox admin all style', $file_dir."adminstyle.css", false, "1.0");
        wp_enqueue_style('forexbox style', $file_dir."style.css", false, "1.0");
        wp_enqueue_style('forexbox jquery-ui style', $file_dir.'jquery-ui-1.8.21.custom.css', false, "1.8.21");
		wp_deregister_script('jquery');
        wp_register_script('jquery', $file_dir.'js/jquery-1.7.2.min.js', false, '1.7.2');
        wp_enqueue_script('jquery');
        wp_enqueue_script("forexbox jquery ui", $file_dir.'js/jquery-ui-1.8.21.custom.js', false, "1.0");
		wp_enqueue_script("forexbox jquery form", $file_dir.'js/jquery.form.js', false, "1.0");
		//wp_enqueue_script("forexbox jquery ui-date-ru", $file_dir.'js/jquery.ui.datepicker-ru.js', false, "1.0");
		wp_enqueue_script('forexbox colorpicker',$file_dir.'js/colorpicker.js', false, "1.0");
		wp_enqueue_script("forexbox dragtable", $file_dir.'js/jquery.dragtable.js', false, "1.0");
	    wp_enqueue_script('media-upload');
        wp_enqueue_script('thickbox');
        wp_enqueue_style('thickbox');		
	}
	
$filename = basename($_SERVER['SCRIPT_FILENAME']);
    if($filename=='user-edit.php' or $filename=='profile.php'){
    wp_enqueue_style('forexbox admin all style', $file_dir."adminstyle.css", false, "1.0");
    wp_enqueue_script("forexbox user script", $file_dir."js/user.js", false, "1.0");
    }	
	
    if($filename=='post.php' and $_GET['action']=='edit' or $filename=='post-new.php' and $_GET['post_type']=='page'){
	wp_enqueue_script('fbp quicktags', $file_dir.'js/quicktags.js', array('quicktags') );
	    if(FBP_PARTNERS_PROGRAMM == 'true'){
		wp_enqueue_script('fbp quicktags2', $file_dir.'js/quicktags2.js', array('quicktags') );
		}
    } 	
	
}

if(FBP_PARTNERS_PROGRAMM == 'true'){
	add_action('init','onfbpRefInit');
}
function onfbpRefInit(){
global $user_ID;
/* Если мы получаем id, записываем его в сессию. */
if(intval($_GET['fbpid'])){
    fbp_addmysession('fbp_ref',$_GET['fbpid']);
}
$ip = preg_replace( '/[^0-9a-fA-F:., ]/', '',$_SERVER['REMOTE_ADDR'] ); //узнали ip
$browser = $_SERVER['HTTP_USER_AGENT']; //броузер

if(!$user_ID){ //если не пользователь 
$url = get_option('siteurl'); //url нашего сайта
    if($_SERVER['HTTP_REFERER']){ //если есть реферер
        if(strpos($_SERVER['HTTP_REFERER'], $url) === false) { //если реферер это не наш сайт
		fbp_addmysession('fbp_preferer',$_SERVER['HTTP_REFERER']);
		$referer = strip_tags($_SERVER['HTTP_REFERER']);
		}
	}
}
$ref = intval(fbp_mysession('fbp_ref')); //id-реферала
 
    if($ip and $browser and $ref and $referer){

    $time = current_time('timestamp');
    global $wpdb;
    $sql = "SELECT * FROM ".$wpdb->prefix."users WHERE ID = $ref"; //количество пользователей
    $col = $wpdb->query($sql);
        if($col > 0){ //если такой пользователь существует

$wpdb->insert( $wpdb->prefix.'fbp_link' , array( 'userid' => $ref, 'tbrowser' => $browser, 'tdate' => $time, 'tip' => $ip, 'trefer'=> $referer));
$link_id = $wpdb->insert_id;

fbp_addmysession('fbpgo_link',$link_id);

$posetitel = intval(get_usermeta($ref, 'posetitel'));
$posetitel = $posetitel+1;
update_user_meta( $ref, 'posetitel', $posetitel) or add_user_meta($ref, 'posetitel', $posetitel, true);
        
		}
    }   
}

function fbp_redirect(){
	if(isset($_GET['goed'])){
	    global $wpdb;
		$ca=$wpdb->get_row("SELECT * FROM ".$wpdb->prefix."forex_broker WHERE id='". intval($_GET['goed']) ."' AND disablertrue ='1' AND fvkl='1'");
		$link = $ca->fplink;
		$id=$ca->id;
		    if($link){
			    
		            fbp_template('includes/clickgo');

			$dd = explode(' ',current_time('mysql')); $dd = $dd[0];
            $wpdb->query("UPDATE ".$wpdb->prefix."forex_broker SET `timer` = '$dd',`sutka` = `sutka`+1 , `mon` = `mon`+1 , `alltime` = `alltime`+1 WHERE id = '$id'");
			header('Location:' . $link);
			exit;
			}			
	}
}

function fbp_tinymce_plugin($plugins){
	$plugins['forex_broker'] = FBP_PLUGIN_URL.'js/fbpEditorButton.js';
	return $plugins;
}

function fbp_button($buttons){
	array_push($buttons, '|', 'forex_broker');
	return $buttons;
}

function fbp_add_editor_button(){
	add_filter('mce_external_plugins', 'fbp_tinymce_plugin');
	add_filter('mce_buttons', 'fbp_button');
}

add_action('init', 'fbp_init');
function fbp_init(){

fbp_add_editor_button();

global $user_ID;
$file_dir = FBP_PLUGIN_URL;
    if(!is_admin()){
	
	    fbp_redirect();
	
        wp_enqueue_style('forexbox style', $file_dir."sitestyle.css", false, "1.0");
        wp_deregister_script('jquery');
        wp_register_script('jquery', $file_dir.'js/jquery-1.7.2.min.js', false, '1.7.2');
        wp_enqueue_script('jquery');
		wp_enqueue_script('jquery fbp form', $file_dir.'js/jquery.form.js', false, '1.7.2');
		if(!$user_ID){
		wp_enqueue_script('jquery fbp nologin', $file_dir.'js/nologin.js', false, '1.0');
		}
		if(FBP_PARTNERS_PROGRAMM == 'true' and $user_ID){
		wp_enqueue_script('jquery fbp partners', $file_dir.'js/partner.php', false, '1.0');
		}
		wp_enqueue_script('jquery fbp sitec', $file_dir.'js/sitec.php', false, '1.0');
    }	
}

function fbp_add_queryvars( $query_vars ){
		$query_vars[] = 'fname';

		return $query_vars;
}
add_filter('query_vars', 'fbp_add_queryvars');

function fbp_rewrite_title($title) {
$fname = get_query_var('fname');
    if($fname){
    global $wpdb;
    $au = $wpdb->get_row("SELECT fname FROM ".$wpdb->prefix."forex_broker WHERE fslug='$fname' AND disablertrue='1' AND fvkl='1'");
	$title .= ' &raquo; '.$au->fname;
	}
	
return $title;
}
add_filter('wp_title' , 'fbp_rewrite_title');

function fbprewriteRules($wp_rewrite) {		
	$rewrite_rules = array (
			'([\-_A-Za-z0-9]+)/([\-_A-Za-z0-9]+)?$' => 'index.php?pagename=$matches[1]&fname=$matches[2]',
	);
	$wp_rewrite->rules = array_merge($rewrite_rules, $wp_rewrite->rules);		
}
add_action('generate_rewrite_rules', 'fbprewriteRules');

function fbp_register_widgets(){

    fbp_template('widget/curscbrf');
	fbp_template('widget/info');
	fbp_template('widget/search');
	fbp_template('widget/toplider');
	fbp_template('widget/sravni');
	
	if(FBP_PARTNERS_PROGRAMM == 'true'){
	    fbp_template('widget/login');
		fbp_template('widget/register');
	}

}
add_action('widgets_init', 'fbp_register_widgets');

function rstudia_remove_default_widget() {
    unregister_widget('WP_Widget_Calendar');
	unregister_widget('WP_Widget_Meta');	
	unregister_widget('WP_Widget_RSS');
	unregister_widget('WP_Widget_Tag_Cloud');
}
add_action( 'widgets_init', 'rstudia_remove_default_widget' );

add_action('wp_footer','fbp_footer');
function fbp_footer(){
?>
<div id="fbp_ajax"></div>
<div id="fbp_ajaxform">
    <div class="fbp_ajaxform">
	    <div class="fbp_ajaxformclose" title="Закрыть"></div>
	    <div class="fbp_ajaxformtitle">Оставить отзыв</div>
		<div id="fbp_ajaxform_res"></div>
		<form method="post" id="ajax_add_otziv_fbp" action="<?php echo FBP_PLUGIN_URL;?>ajax/addotziv.php">
		<input type="hidden" name="fb_id" value="0" />
		<input type="hidden" name="cparent" value="0" />
		<table width="100%" cellpadding="0" cellspacing="0">
		    <tr>
			    <th>Имя <span class="fbp_red">*</span></th>
				<td><input type="text" name="cname" value="" /></td>
			</tr>
		    <tr>
			    <th>E-mail <span class="fbp_red">*</span></th>
				<td><input type="text" name="cemail" value="" /></td>
			</tr>
		    <tr>
			    <th>Мнение</th>
				<td>
				<select name="crating">
				    <option value="0">Нейтральное</option>
				    <option value="1">Положительное</option>
					<option value="2">Отрицательное</option>
				</select>
				</td>
			</tr>
		    <tr>
			    <th>Отзыв <span class="fbp_red">*</span></th>
				<td>
				<textarea name="ctext"></textarea>
				</td>
			</tr>
		    <tr>
			    <th>&nbsp;</th>
				<td>
				<div class="fbp_ajaxform_ten">
				    <input type="submit" name="submit" value=" " />
				</div>
				</td>
			</tr>			
	    </table>
		</form>
    </div>
</div>

<div id="fbp_ajaxform2">
    <div class="fbp_ajaxform2">
	    <div class="fbp_ajaxformclose2" title="Закрыть"></div>
        <div id="fbp_new_graph"></div>
    </div>
</div>
<?php
}

?>