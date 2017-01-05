<?php
if ( 'POST' != $_SERVER['REQUEST_METHOD'] ) {
	header('Allow: POST');
	header('HTTP/1.1 405 Method Not Allowed');
	header('Content-Type: text/plain');
	exit;
}

include_once('../../../../wp-config.php');
include_once('../../../../wp-load.php');
include_once('../../../../wp-includes/wp-db.php');
header('Content-Type: text/html; charset=utf-8');

if(current_user_can('administrator')){
		
$url = is_fbp_url($_POST['url']);	
if($url){
	$curl = fbp_curl_parser($url);
	    if(!$curl['err']){
		    $string = iconv("CP1251", "UTF-8",$curl['output']);
			$lines = preg_split('/\n/', $string);
			$nauto=0;
			$r=0;
			foreach($lines as $line){ $r++;
			    if($r != 1){
			        $line = str_replace('"','',$line);
			        $row=explode(';',$line);
                    $narr=array();
                    $narr['flogo']= fbp_cleared_post($row[1]);
                    $narr['fname']= fbp_cleared_post($row[0]);
					$narr['fslug'] = fbp_podbor_slug($narr['fname']);
                    $narr['fsite']= fbp_cleared_post($row[2]);
                    $narr['fnews']= fbp_cleared_post($row[3]);
                    $narr['fstatus']= intval($row[4]);
                    $narr['fgod']= intval($row[5]);
                    $narr['flicense']= fbp_cleared_post($row[6]);
                    $narr['fplatform']= fbp_cleared_post($row[7]);
                    $narr['fsposobopl']= fbp_cleared_post($row[8]);
                    $narr['fdescription']= stripslashes($row[9]);
                    $narr['fadress']= fbp_cleared_post($row[10]);
                    $narr['fplink']= fbp_cleared_post($row[11]);
                    $narr['fminschet']= fbp_cleared_post($row[12]);
                    $narr['fkrplot']= fbp_cleared_post($row[13]);
                    $narr['fkrpldo']= fbp_cleared_post($row[14]);
                    $narr['fminsdelka']= fbp_cleared_post($row[15]);
                    $narr['fspred']= fbp_cleared_post($row[16]);   
                    $narr['fcomiss']= fbp_cleared_post($row[17]); 
                    $narr['fdemo']= intval($row[18]);
                    $narr['fmobile']= intval($row[19]);
                    $narr['fpartner']= intval($row[20]);
                    $narr['fdovupr']= intval($row[21]);
                    $narr['fbonus']= fbp_cleared_post($row[22]); 
                    $narr['fvkl']= intval($row[23]);

				if($narr['fname']){
				    global $wpdb;
				    $wpdb->insert($wpdb->prefix .'forex_broker', $narr);
                    $fb_id = $wpdb->insert_id;
                    if($fb_id){
                        $nauto++;
                    }	
                }				
				
				} 
			}
			$log['otvet']=10;
			$log['kol']=$nauto;
			$log['table']=get_fb_admin_table();
	    } else {
$log['otvet']=1; 
$log['err'] = 'Ошибка парсера.'; 
	    }
} else {
$log['otvet']=1; 
$log['err'] = 'Не верный URL.';
}

} else {
$log['otvet']=1; 
$log['err'] = 'Вы не администратор.';
}
$log['forexbox']=1;
echo json_encode($log);