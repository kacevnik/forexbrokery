<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="ru-RU">
<head profile="http://gmpg.org/xfn/11">

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<?php global $template_directory, $site_url; ?>

<link rel="stylesheet" href="<?php echo $template_directory;?>/style.css" type="text/css" />
<link rel="shortcut icon" href="<?php echo $template_directory;?>/images/favicon.png" type="image/x-icon" />

<title><?php echo get_bloginfo('name');?> <?php if(is_front_page()){ echo '&raquo; '.get_bloginfo('description'); } else { wp_title(); } ?></title>

<?php 
if ( is_singular() && get_option( 'thread_comments' ) ){
	wp_enqueue_script( 'comment-reply' );
}

wp_head(); ?>

</head>
<body>
<?php lteie(7);?>
<?php nojavabrowser(); ?>

<div id="container">

    <div id="header">
	    <div class="header">
		
		    <div class="logo"><a href="<?php echo $site_url;?>" title="<?php bloginfo('name');?>"><img src="<?php echo $template_directory; ?>/images/logo.png" alt="" /></a></div>
		    <div class="banner">
			    <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Шапка') ) : ?><?php endif; ?>
			</div>
		    
		    <div class="clear"></div>
		</div>
	</div>
	
	<div class="topmenu">
	<?php wp_nav_menu(array(
		'sort_column' => 'menu_order',
		'container' => 'div',
		'container_class' => 'navholder',
		'menu_class' => 'navheader',
		'menu_id' => '',
		'depth' => '3',
		'fallback_cb' => 'no_menu',
		'theme_location' => 'header_menu'
	)); ?>		
		
		<div class="clear"></div>
	</div>

	<div id="wrap">
    <div id="content">