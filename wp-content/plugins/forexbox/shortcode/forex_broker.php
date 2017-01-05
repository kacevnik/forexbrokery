<?php
if( !defined( 'ABSPATH')){ exit(); }
global $user_ID, $themplate;
	
	$config = get_option('fbp_config');
	
	$themplate = '
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