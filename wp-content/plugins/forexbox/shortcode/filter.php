<?php
if( !defined( 'ABSPATH')){ exit(); }
global $user_ID, $themplate;
	
	$config = get_option('fbp_config');
	
	$themplate = '
	<div class="br_filter fbp_pagenavi">
		<div class="br_filter_text">
		'.$config["fb_text_filter"].'
		</div>
		<div class="br_filter_body">
			<div class="br_filter_item">
				<h5>Максимальное кредитное плечо</h5>
				<div class="pleco-before">'.$config["fb_max_cr_plecho_min"].'</div>
				<div class="slider pleco"></div>
				<div class="pleco-after">'.$config["fb_max_cr_plecho_max"].'</div>
				<input type="hidden" value="" name="pleco" id="pleco"/>	
			</div>
			<div class="br_filter_item">
				<h5>Минимальный депозит</h5>
				<div class="pleco-before">'.$config["fb_min_depozit_min"].'</div>
				<div class="slider dipozit"></div>
				<div class="pleco-after">'.$config["fb_min_depozit_max"].'</div>
				<input type="hidden" value="" name="dipozit" id="dipozit"/>	
			</div>
			<div class="br_filter_item">
				<h5>Минимальный спред</h5>
				<div class="pleco-before">'.$config["fb_min_spred_min"].'</div>
				<div class="slider spred"></div>
				<div class="pleco-after">'.$config["fb_min_spred_max"].'</div>
				<input type="hidden" value="" name="spred" id="spred"/>	
			</div>
			<div class="br_filter_item">
				<div class="br_filter_item_1">
					<h5>Наличие лицензии</h5>
					<input type="checkbox" name="lec_sysec" id="lec_sysec" class="filter_checkbox"/>
					<label for="lec_sysec"> CySec</label>
					<input type="checkbox" name="lec_fca" id="lec_fca" class="filter_checkbox"/>
					<label for="lec_fca"> FCA</label>
					<input type="checkbox" name="lec_nfa" id="lec_nfa" class="filter_checkbox"/>
					<label for="lec_nfa"> NFA</label>
				</div>
				<div class="br_filter_item_1">
					<h5>Наличие опыта</h5>
					<input type="checkbox" name="lec_opit" id="lec_opit" class="filter_checkbox">
					<label for="lec_opit"> Нет опыта</label>
				</div>
			</div>
			<input type="submit" name="lec_submit" value="Подобрать" class="filter_submit">
		</div>
	</div>
	<a href="#" class="fbp_all_otzivlink show_filtr">Скрыть фильтр</a>

	<div class="fbp_otziv_page">
	<div class="fbpotdotable">'. $config['do'] .'</div>
	<div class="fbp_pagenavi">
	    <div class="fbp_pagenavileft pgntable">
		
		'. get_fbp_pagenavi_home(1,10,'desc','frating') .'	
		
		</div>
	    <div class="fbp_pagenaviright pgntablelim">
		'. get_fbp_pagina_home(10) .'

		</div>	
	
	    <div class="fbp_clear"></div>
	</div>	
	';
	
	$themplate .='<div id="forex_home_table">'. get_forex_home_table(1,10,'desc','frating') .'</div>';
	
	$themplate .= '
	<div class="fbp_pagenavi">
	    <div class="fbp_pagenavileft pgntable">
		
		'. get_fbp_pagenavi_home(1,10,'desc','frating') .'	
		
		</div>
	    <div class="fbp_pagenaviright pgntablelim">
		'. get_fbp_pagina_home(10) .'

		</div>	
	
	    <div class="fbp_clear"></div>
	</div>	
	
	<!--<div class="fbp_helpinfo">
	
	<div class="fbphelper">
	* - Рейтинг не несет никакой ответственности за ошибки в предоставленной информации. Чтобы получить самую последнюю информацию о торговых условиях, пожалуйста, посетите сайт соответствующего участника.
	</div>
	
	    <div class="fbpstatgolos">- Статистика голосования</div>
		<div class="fbprekbrok">- Рекомендованный участник</div>
		<div class="fbpnewfpb">- Новый участник</div>
		
	    <div class="fbp_clear"></div>
	
	</div>-->
	
	<div class="fbpotdotable">'. $config['ot'] .'</div>
	</div>	
	
	';

?>