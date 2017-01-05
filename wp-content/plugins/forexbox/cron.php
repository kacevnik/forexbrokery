<?php
if( !defined( 'ABSPATH')){ exit(); }

function fbp_chkv(){
    if($ch=curl_init()){
        curl_setopt($ch,CURLOPT_URL,"http://best-curs.info/update/fbnewver.txt");
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        //curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_REFERER , "");
        curl_setopt($ch, CURLOPT_TIMEOUT, 20);
        $output=curl_exec($ch);
        $error=curl_errno($ch);
        curl_close($ch);
            if(!$error){
            $tp=explode('||',$output);
			    $thisis = array();
	            $thisis['text'] = iconv("CP1251", "UTF-8",$tp[1]);
                $thisis['version'] = $tp[0];
				update_option('fbp_version',$thisis);
            } 
    }
}

function fbp_curs_cbrf(){
    $curl = fbp_curl_parser('http://cbr.ru');
    if(!$curl['err']){
        $cources = array();
	if( preg_match_all('/<td class="digit" align="right">(.+?)&nbsp;<\/td>/i',$curl['output'],$out,PREG_PATTERN_ORDER) ){
	    $cources['now_usd'] = str_replace(",", ".", $out[1][0]);
	    $cources['now_eur'] = str_replace(",", ".", $out[1][1]);
	}

	if( preg_match_all('/<td class="digit" align="right" nowrap.*?>(.+?)&nbsp;/i',$curl['output'],$out,PREG_PATTERN_ORDER) ){
	    $cources['tommorow_usd'] = str_replace(",", ".", $out[1][0]);
	    $cources['tommorow_eur'] = str_replace(",", ".", $out[1][1]);
	}
	update_option('fbp_curs', $cources);
    }
}

function fbp_del_sravni(){
$date = date('Y-m-d',strtotime('-2 days'));
global $wpdb;
$wpdb->query("DELETE FROM ". $wpdb->prefix ."fbp_sravni WHERE rdate < '$date'");

}

?>