<?php
if( !defined( 'ABSPATH')){ exit(); }

function get_mytime($time, $format='d.m.Y'){
$date = strtotime($time);
return date($format, $date);
}

function lteie($arg=''){ ?>
<!--[if lte IE <?php echo $arg;?>]>
<div class="capz">
	<div class="cap">
	    <div class="captitle">Ошибка!</div>
	    <p>Вы используете Internet Explorer ранней версии!</p>
	    <p>Обновите браузер или зайдите на сайт используя другой.</p>
	</div>	
</div>
<![endif]-->
<?php 
}

function nojavabrowser(){ ?>
<noscript>
<div class="capz">
	<div class="cap">
	    <div class="captitle">Ошибка!</div>
	    <p>У вас отключён Javascript!</p>
	    <p>С отключённым Javascript сайт работает некорректно!</p>  
	</div>	
</div>
</noscript>
<?php 
}

if (function_exists('register_nav_menu')) {
	register_nav_menu('header_menu', 'Меню в шапке');
	register_nav_menu('footer_menu', 'Меню в подвале');	
}

function no_menu(){}

add_image_size( 'new-thumb', 170, 170, true );
add_theme_support('post-thumbnails');

function rstudia_add_init() {
global $template_directory;

if(!is_admin()){
wp_deregister_script('jquery');
wp_register_script('jquery', $template_directory.'/js/jquery-1.7.2.min.js', false, '1.7.2');
wp_enqueue_script('jquery');
wp_enqueue_script("jquery menu", $template_directory."/js/menu.js", false, "1.0");	
}

}

add_action('init', 'rstudia_add_init');

function new_excerpt_length($length) {
	return 60;
}
add_filter('excerpt_length', 'new_excerpt_length');

function new_excerpt_more($more) {
	return '...';
}
add_filter('excerpt_more', 'new_excerpt_more');

function loginNewUrl(){
global $site_url;
return $site_url;
}
add_filter('login_headerurl','loginNewUrl');

function loginNewTitle(){
return get_bloginfo('name').' - '.get_bloginfo('description');
}
add_filter('login_headertitle','loginNewTitle');

function loginNewCss(){
global $template_directory;
    echo '<style type="text/css">
	#login h1 { height: 80px !important;}
    #login h1 a { background-image: url('.$template_directory.'/images/admin-logo.png); background-size: 325px 61px; height: 61px;}
    </style>';
}
add_action('login_head', 'loginNewCss');

register_sidebar(array(
    'name'=>'Шапка',
	'before_title' => ' ',
	'after_title' => ' ',
	'before_widget' => ' ',
	'after_widget' => ' ',
));

register_sidebar(array(
    'name'=>'Сайдбар',
	'before_title' => '<div class="widget_title">',
	'after_title' => '</div>',
	'before_widget' => '<div class="widget">',
	'after_widget' => '</div>',
));

register_sidebar(array(
    'name'=>'Подвал',
	'before_title' => ' ',
	'after_title' => ' ',
	'before_widget' => ' ',
	'after_widget' => ' ',
));

function bread($id,$array=array()){
if($id){
    global $wpdb;
    $postc = $wpdb->get_row("SELECT ID, post_title, post_parent FROM ".$wpdb->prefix."posts WHERE post_type='page' AND post_status='publish' AND ID='$id'");
    $pof = get_option('page_on_front');
	if($postc->ID != $pof){
	$array[]='<li>&raquo; <a href="'.get_permalink($postc->ID).'">'.$postc->post_title.'</a></li>';
	}
    bread($postc->post_parent,$array);
} else {
    $array = array_reverse($array);
    foreach($array as $sarray){
        echo $sarray;
    }
}
}

function the_bread_cr(){
global $post, $site_url;

$dt = get_option('show_on_front');
if($dt == 'page'){
   $news_url = get_permalink(get_option('page_for_posts'));
} else {
   $news_url = $site_url;
}

?>
<div class="breadcrumb">
<ul class="breadcrumbs">
<?php if($dt == 'page'){ ?>
<li><a href="<?php echo $site_url;?>">Главная</a></li>
<?php } else { ?>
<li><a href="<?php echo $news_url;?>">Новости</a></li>
<?php } ?>

<?php if($dt == 'page' and is_home()){ ?>
<li>&raquo; <a href="<?php echo $news_url;?>">Новости</a></li>
<?php } ?>


<?php
if(is_single()){
?>
<?php if($dt == 'page'){ ?>
<li>&raquo; <a href="<?php echo $news_url;?>">Новости</a></li>
<?php } ?>
<li>&raquo; <a href="<?php echo get_permalink($post->ID);?>"><?php echo $post->post_title;?></a></li>
<?php
} elseif(is_tag()){
global $tag_id;
?>
<?php if($dt == 'page'){ ?>
<li>&raquo; <a href="<?php echo $news_url;?>">Новости</a></li>
<?php } ?>
<li>&raquo; <a href="<?php echo get_tag_link($tag_id); ?>" ><?php single_tag_title();?></a></li>
<?php
} elseif(is_category()){
global $cat;
?>
<?php if($dt == 'page'){ ?>
<li>&raquo; <a href="<?php echo $news_url;?>">Новости</a></li>
<?php } ?>
<li>&raquo; <a href="<?php echo get_category_link($cat); ?>" ><?php single_cat_title();?></a></li>
<?php
} elseif(is_page() and !is_front_page()){
bread($post->ID);
}
?>
</ul>
</div>
<?php
}

?>