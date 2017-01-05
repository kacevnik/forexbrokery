<?php
if( !defined( 'ABSPATH')){ exit(); }
global $fbp_version;
$otv = $_GET['otvet'];
?>

<div class="wrap">
<div id="forexbox">
    <div id="forexboxhead">
	    <div class="fbp_logo"><a href="<?php echo admin_url('admin.php?page=forexbox/index.php');?>"><img src="<?php echo FBP_PLUGIN_URL;?>/images/logo.png" alt="" /></a></div>
	    <div class="fbp_name">ForexBox</div>
		<div class="fvp_version <?php if(fbp_has_new()){ ?>act<?php } ?>">v <?php echo $fbp_version;?></div>
		<div id="fbp_has_update" <?php if(fbp_has_new()){ ?>style="display: block"<?php } ?>>
		    Доступно обновление плагина.
		</div>
		
		<div id="forexboxajax"></div>
		
		<div class="fbp_clear"></div>
	</div>
    <?php if($otv==1){ ?>
	<div class="class_err">
	    Ошибка: действие не выполнено.
	</div>
	<?php } elseif($otv==2){ ?>
	<div class="class_sucess">
	    Успешно выполнено.
	</div>	
	<?php } ?>
	<div id="forexboxajaxres"></div>
	
	<div id="forexboxmenu">
	    <ul>
		    <li class="<?php fbp_menu('index');?>"><a href="<?php echo admin_url('admin.php?page=forexbox/index.php');?>">Участники</a></li>
			<li class="<?php fbp_menu('vnv');?>"><a href="<?php echo admin_url('admin.php?page=forexbox/vnv.php');?>">Внешний вид</a></li>
			<li class="<?php fbp_menu('stats');?>"><a href="<?php echo admin_url('admin.php?page=forexbox/stats.php');?>">Статистика</a></li>
			<li class="<?php fbp_menu('otziv');?>"><a href="<?php echo admin_url('admin.php?page=forexbox/otziv.php');?>">Отзывы</a></li>
			
			<?php if(FBP_PARTNERS_PROGRAMM=='true'){ ?>
			<li class="<?php fbp_menu('partner');?>"><a href="<?php echo admin_url('admin.php?page=forexbox/partner.php&mypage=stats');?>">Партнёрка</a></li>
		    <?php } ?>
			
			<li class="<?php fbp_menu('config');?>"><a href="<?php echo admin_url('admin.php?page=forexbox/config.php');?>">Настройки</a></li>
			
		</ul>
		<div class="fbp_clear"></div>
	</div>
	
	<?php if(FBP_PARTNERS_PROGRAMM=='true' and fbp_admin_page('partner')){ 
	global $wpdb;
	$tpay = $wpdb->query('select payid from `' . $wpdb->prefix . 'fbpwithdraw` where xstatus="1"');
	?>
	<div id="forexboxpmenu">
	    <ul>
		    <li class="<?php fbp_mymenu('stats');?>"><a href="<?php echo admin_url('admin.php?page=forexbox/partner.php&mypage=stats');?>">Статистика</a></li>
		    <li class="<?php fbp_mymenu('clicks');?>"><a href="<?php echo admin_url('admin.php?page=forexbox/partner.php&mypage=clicks');?>">Клики</a></li>
		    <li class="<?php fbp_mymenu('users');?>"><a href="<?php echo admin_url('admin.php?page=forexbox/partner.php&mypage=users');?>">Пользователи</a></li>
		    <li class="<?php fbp_mymenu('payout');?>"><a href="<?php echo admin_url('admin.php?page=forexbox/partner.php&mypage=payout');?>">Выплаты (<?php echo $tpay;?>)</a></li>
		    <li class="<?php fbp_mymenu('banner');?>"><a href="<?php echo admin_url('admin.php?page=forexbox/partner.php&mypage=banner');?>">Баннеры</a></li>
			<li class="<?php fbp_mymenu('change');?>"><a href="<?php echo admin_url('admin.php?page=forexbox/partner.php&mypage=change');?>">Настройки</a></li>
		</ul>
	</div>	
	<?php } ?>
	
	<div id="forexboxcontent">