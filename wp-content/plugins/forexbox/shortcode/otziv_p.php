<?php
if( !defined( 'ABSPATH')){ exit(); }
global $user_ID, $themplate;
	$fname = get_query_var('fname');
    global $wpdb;
	$fb = $wpdb->get_row("SELECT * FROM ".$wpdb->prefix."forex_broker WHERE fslug='$fname' AND disablertrue='1' AND fvkl='1'");
	$fbid = $fb->id;

	$themplate = '';
	
	if($fbid){
	
	$site_url = get_option('siteurl');
	
	$themplate .= '<div class="fbpo_title">Отзывы о '. $fb->fname .'</div>
	<input type="hidden" name="" value="'. $fbid .'" data="1" id="fbif_id" />
	<div class="fbp_otziv_page">
	
	<div class="fbp_pagenavi">
	    <div class="fbp_pagenavileft pgncom">
		
		'. get_fbp_pagenavi(1,5,$fbid,1) .'	
		
		</div>
	    <div class="fbp_pagenaviright pgncomlim">
		'. get_fbp_pagina(5) .'

		</div>	
	
	    <div class="fbp_clear"></div>
	</div>
	
	<div class="fbp_page_otziv">
	
	    <div class="fbppageot1">
		    <div class="fbp_obvodka">
			    <a href="#" class="fbp_yelowkn addotziv" name="'. $fbid .'">
				    Оставить отзыв
				</a>
			</div>
		</div>
		
	    <div class="fbppageot2">
		    <div class="fbp_obvodka">
			    <a href="'. $site_url .'" class="fbp_bluekn">
				    Лучшие участники
				</a>			
			</div>		
		</div>			
		
	    <div class="fbppageot2">
		    <div class="fbp_obvodka">
			    <a href="'. fbp_one_link($fname) .'" class="fbp_bluekn">
				    Описание участников
				</a>			
			</div>		
		</div>	
	        <div class="fbp_clear"></div>
	</div>
	
	<div class="fbp_body_otziv">';
	
	$themplate .= get_fbp_comments_table(5,0,$fbid,1);
	
	$themplate .= '
	</div>
	
	<div class="fbp_page_otziv">
	
	    <div class="fbppageot1">
		    <div class="fbp_obvodka">
			    <a href="#" class="fbp_yelowkn addotziv" name="'. $fbid .'">
				    Оставить отзыв
				</a>
			</div>
		</div>
		
	    <div class="fbppageot2">
		    <div class="fbp_obvodka">
			    <a href="'. $site_url .'" class="fbp_bluekn">
				    Лучшие участники
				</a>			
			</div>		
		</div>			
		
	    <div class="fbppageot2">
		    <div class="fbp_obvodka">
			    <a href="'. fbp_one_link($fname) .'" class="fbp_bluekn">
				    Описание участников
				</a>			
			</div>		
		</div>
	
	        <div class="fbp_clear"></div>
	</div>	
	
	<div class="fbp_pagenavi">
	    <div class="fbp_pagenavileft pgncom">
		
		'. get_fbp_pagenavi(1,5,$fbid,1) .'
		
		
		</div>
	    <div class="fbp_pagenaviright pgncomlim">
		
		'. get_fbp_pagina(5) .'

		</div>	
	
	    <div class="fbp_clear"></div>
	</div>
	
	</div>';
		
	} else {
		
	$themplate = '<div class="fbp_reg_otvet_no"><strong>Ошибка:</strong> участиника не существует.</div>';
		
	}


?>