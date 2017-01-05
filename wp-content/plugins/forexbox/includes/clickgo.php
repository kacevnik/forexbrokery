<?php
if( !defined( 'ABSPATH')){ exit(); }

if(FBP_PARTNERS_PROGRAMM == 'true'){

	$ip = preg_replace( '/[^0-9a-fA-F:., ]/', '',$_SERVER['REMOTE_ADDR'] );
		
	$url = str_replace('http://','',get_option('siteurl'));
			
	$page = get_option('fbp_pages');
	$partners = get_option('fbp_parners');			
	if(preg_match("/$url/i", $_SERVER['HTTP_REFERER'])) { 
        if(intval(fbp_mysession('fbpgo_link')) > 0 and $_GET['goed']){ 
        $referer = strip_tags(fbp_mysession('fbp_preferer')); 
		global $user_ID;
			
			if(!preg_match("/$url/i", $referer) and $referer and !$user_ID) {
			
			    $time_sutka = current_time('timestamp') - 24 * 60 * 60; 
			
                global $wpdb;			
                $sql = "SELECT * FROM ".$wpdb->prefix."fbp_link WHERE tip='$ip' and ttype = '2' and trefer='$referer' and tdate > $time_sutka";
                $cols = $wpdb->query($sql); 
                if(!$cols){
			
			        $id = intval(fbp_mysession('fbpgo_link'));
			        $ref = intval(fbp_mysession('fbp_ref'));
					
			        global $wpdb;
                    $wpdb->query("UPDATE ".$wpdb->prefix."fbp_link SET ttype = '2', tbroker = '".intval($_GET['goed'])."' WHERE id = '$id'");
			
			        $op_posetitel = get_usermeta($ref, 'op_posetitel');
                    $op_posetitel = $op_posetitel+1;
                    update_user_meta( $ref, 'op_posetitel', $op_posetitel) or add_user_meta($ref, 'op_posetitel', $op_posetitel, true);
			
			        $money = get_usermeta($ref, 'money');
			        $money = $partners[1] + $money;
			        update_user_meta( $ref, 'money', $money) or add_user_meta($ref, 'money', $money, true);

			    }
			}
		}	
    }
	
	
}
?>