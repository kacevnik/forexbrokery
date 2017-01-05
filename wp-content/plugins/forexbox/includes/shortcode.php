<?php

function shortcode_fbp_user_only($atts,$content=""){ 
global $user_ID;
    if($user_ID){
        return $content;
    } 
}
add_shortcode('fbp_user_only', 'shortcode_fbp_user_only');

function shortcode_fbp_nouser_only($atts,$content=""){ 
global $user_ID;
    if(!$user_ID){
        return $content;
    } 
}
add_shortcode('fbp_nouser_only', 'shortcode_fbp_nouser_only');

function shortcode_fbp_listing($atts){ 

    $c = intval($atts['count']); if(!$c){$c=6;}
	$table = '<table border="0" cellspacing="5" cellpadding="5" id="fbp_list_table">';
	global $wpdb;
	$automat = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."forex_broker WHERE fname != '' AND fplink !='' AND fvkl = '1' AND disablertrue = '1' ORDER BY fname asc");
	$r=0;
	foreach($automat as $au){ $r++;
	    if($au->flogo){ $im = $au->flogo; } else { $im = FBP_PLUGIN_URL.'images/standart.png';}
	    if($r==1){ $table .= '<tr>'; }
	    $table .= '<td><a href="'. fbp_one_link($au->fslug) .'" target="_blank" ><img src="'.$im.'" width="100" alt="" /></a><div class="fbp_list_name"><a href="'. fbp_one_link($au->fslug) .'" target="_blank">'.$au->fname.'</a></div></td>';
	    if($r==$c){ $table .= '</tr>'; $r=0; }
	}
	$s = $c-$r; $y=0;
	while($y++<$s){
	$table .= '<td>&nbsp;</td>';
	}
	if($r!=0){ $table .= '</tr>';}
	$table .= '</table>';
	return $table;
}
add_shortcode('fbp_listing', 'shortcode_fbp_listing');

function shortcode_fbp_once($atts){ 
   fbp_template('shortcode/once');

   global $themplate;
   return $themplate;
}
add_shortcode('fbp_once', 'shortcode_fbp_once');

function shortcode_fbp_search($atts){ 
   fbp_template('shortcode/search');

   global $themplate;
   return $themplate;
}
add_shortcode('fbp_search', 'shortcode_fbp_search');

function shortcode_forex_broker($atts){ 
   fbp_template('shortcode/forex_broker');

   global $themplate;
   return $themplate;
}
add_shortcode('forex_broker', 'shortcode_forex_broker');

function shortcode_fbp_sravni($atts){ 
   fbp_template('shortcode/sravni');

   global $themplate;
   return $themplate;
}
add_shortcode('fbp_sravni', 'shortcode_fbp_sravni');

function shortcode_fbp_otziv($atts){ 
   fbp_template('shortcode/otziv');

   global $themplate;
   return $themplate;
}
add_shortcode('fbp_otziv', 'shortcode_fbp_otziv');

if(FBP_PARTNERS_PROGRAMM == 'true'){

function shortcode_fbp_register($atts){ 
   fbp_template('shortcode/register');

   global $themplate;
   return $themplate;
}
add_shortcode('fbp_register', 'shortcode_fbp_register');

function shortcode_fbp_login($atts){ 
   fbp_template('shortcode/login');

   global $themplate;
   return $themplate;
}
add_shortcode('fbp_login', 'shortcode_fbp_login');

function shortcode_fbp_lostpass($atts){ 
   fbp_template('shortcode/lostpass');

   global $themplate;
   return $themplate;
}
add_shortcode('fbp_lostpass', 'shortcode_fbp_lostpass');

function shortcode_fbp_promotional($atts){ 
   fbp_template('shortcode/promotional');

   global $themplate;
   return $themplate;
}
add_shortcode('fbp_promotional', 'shortcode_fbp_promotional');

function shortcode_fbp_profile($atts){ 
   fbp_template('shortcode/profile');

   global $themplate;
   return $themplate;
}
add_shortcode('fbp_profile', 'shortcode_fbp_profile');

function shortcode_fbp_partners_account($atts){ 
   fbp_template('shortcode/partner_account');

   global $themplate;
   return $themplate;
}
add_shortcode('fbp_partners_account', 'shortcode_fbp_partners_account');

function shortcode_fbp_withdrawal($atts){ 
   fbp_template('shortcode/withdrawal');

   global $themplate;
   return $themplate;
}
add_shortcode('fbp_withdrawal', 'shortcode_fbp_withdrawal');

}

function shortcode_fbp_otzivs($atts){ 
    global $otc;
	$otc = intval($atts['count']); if(!$otc){$otc=6;}
    fbp_template('shortcode/otzivs');
	
	global $themplate;
	return $themplate;
}
add_shortcode('fbp_otzivs', 'shortcode_fbp_otzivs');





?>