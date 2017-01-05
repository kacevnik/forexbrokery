<?php
if( !defined( 'ABSPATH')){ exit(); }
global $user_ID, $themplate;
	
	$search = fbp_cleared_post($_GET['fbs']);
	
	$themplate = '
	<div class="fbp_otziv_page">
	<div class="fbpo_title">Поиск "'. $search .'"</div>
	<div class="fbp_pagenavi">
	    <div class="fbp_pagenavileft pgntable">
		
		'. get_fbp_pagenavi_home(1,10,'desc','frating',$search) .'	
		
		</div>
	    <div class="fbp_pagenaviright pgntablelim">
		'. get_fbp_pagina_home(10,$search) .'

		</div>	
	
	    <div class="fbp_clear"></div>
	</div>	
	';
	
	$themplate .='<div id="forex_home_table">'. get_forex_home_table(1,10,'desc','frating',$search) .'</div>';	
	
	$themplate .= '
	<div class="fbp_pagenavi">
	    <div class="fbp_pagenavileft pgntable">
		
		'. get_fbp_pagenavi_home(1,10,'desc','frating',$search) .'	
		
		</div>
	    <div class="fbp_pagenaviright pgntablelim">
		'. get_fbp_pagina_home(10,$search) .'

		</div>	
	
	    <div class="fbp_clear"></div>
	</div>
    </div>	
    ';	

?>