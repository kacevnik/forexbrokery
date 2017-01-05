<?php
if( !defined( 'ABSPATH')){ exit(); }

function get_fbp_sravni_widget(){
$tu = fbp_cleared_post(fbp_your_id());
$table ='';
global $wpdb;
$post = $wpdb->get_row("SELECT * FROM ".$wpdb->prefix."fbp_sravni WHERE ryour='$tu'");
$postid = $post->id;
if($postid){
$tvoi = unserialize($post->rfbp);
if(!is_array($tvoi)){ $tvoi=array(); }
    $cc = count($tvoi);
    if($cc > 0){
	$pages = get_option('fbp_pages');
	$link = get_permalink($pages['fbpsravni']);
	
	$table .='<div class="fbp_widget">
    <div class="fbp_srtitle">Список сравнения</div>';
	
	$df = join(',',$tvoi);
	
	$brokers = $wpdb->get_results("SELECT * FROM ". $wpdb->prefix ."forex_broker WHERE id IN($df) AND disablertrue='1' AND fvkl='1'");
	if(is_array($brokers)){
	$s=0;
	foreach($brokers as $fb){ $s++;
    if($fb->flogo){ $im = $fb->flogo; } else { $im = FBP_PLUGIN_URL.'images/standart.png';}
    
	$table .='<div class="fbp_srone">
	    <div class="fbp_sr_img"><a href="'. fbp_one_link($fb->fslug) .'" target="_blank"><img src="'. $im .'" alt="" /></a></div>
		<div class="fbp_sr_title"><a href="'. fbp_one_link($fb->fslug) .'" target="_blank">'. $fb->fname .'</a></div>
		<div class="fbp_sr_noed delsravn" name="'. $fb->id .'"></div>
	</div>
    ';
	
	}}
	
    $table .='<a href="'. $link .'" class="fbp_all_otzivlink">Сравнить</a>	
		<div class="fbp_clear"></div>
</div>	
	';

    }
}

return $table;
}


function get_fbp_sravni_table(){

global $wpdb;
    $themplate = '';
    $tu = fbp_cleared_post(fbp_your_id());
	$post = $wpdb->get_row("SELECT * FROM ".$wpdb->prefix."fbp_sravni WHERE ryour='$tu'");
    $postid = $post->id;
    $tvoi = unserialize($post->rfbp);
    if(!is_array($tvoi)){ $tvoi=array(); }
    $cc = count($tvoi);
	if($cc > 0){
	$df = join(',',$tvoi);
    $count = $wpdb->query("SELECT id FROM ". $wpdb->prefix ."forex_broker WHERE id IN($df) AND disablertrue='1' AND fvkl='1'");
	}
	
	if($count > 0){
	
	$nc = $count-1;
	$brokers = $wpdb->get_results("SELECT * FROM ". $wpdb->prefix ."forex_broker WHERE id IN($df) AND disablertrue='1' AND fvkl='1'");
	
	$nv = $count*205;
	if($count > 3){ $nck = 'overflow-x: scroll;'; }
	
	$distable = get_option('fbp_distable');
	$thetitle3 = fbp_orili('Статус',$distable['table1']['ftab1']);
	$thetitle5 = fbp_orili('Торговая платформа',$distable['table1']['ftab2']);
	$thetitle4 = fbp_orili('Год основания',$distable['table1']['ftab6']);	
	$thetitle8 = fbp_orili('Кредитное плечо',$distable['table1']['ftab9']);
	$thetitle7 = fbp_orili('Минимальная сделка',$distable['table1']['ftab10']);
	$thetitle6 = fbp_orili('Минимальный размер счёта',$distable['table1']['ftab8']);
	$thetitle9 = fbp_orili('Спред',$distable['table1']['ftab11']);
	$thetitle10 = fbp_orili('Официальный сайт',$distable['table1']['ftab13']);
	$thetitle1 = fbp_orili('Название',$distable['table1']['ftab20']);
	$thetitle2 = 'Рейтинг';
	$thetitle11 = 'Отзывы';
	$thetitle12 = 'Удалить';	
	
	$themplate .= '
	
	    <div class="fbp_sravni_table">
            
		        <div class="fbp_sravnicolumn">
				    <div class="tfname ffirst">'.$thetitle1.'</div>
					<div class="tfname">'.$thetitle2.'</div>
	                <div class="tfname">'.$thetitle3.'</div>
			        <div class="tfname">'.$thetitle4.'</div>
					<div class="tfname">'.$thetitle5.'</div>
					<div class="tfname">'.$thetitle6.'</div>
					<div class="tfname">'.$thetitle7.'</div>
					<div class="tfname">'.$thetitle8.'</div>
					<div class="tfname">'.$thetitle9.'</div>
					<div class="tfname">'.$thetitle10.'</div>
					<div class="tfname">'.$thetitle11.'</div>
					<div class="tfname flast">'.$thetitle12.'</div>					
				</div>
				<div class="fbp_sravni_tablevn" style="'. $nck .'">
				    <div class="" style="width: '. $nv .'px;">
	        ';
			
			$r=0;
			foreach($brokers as $broker){ $r++;
			$cl='';
			if($r==$count){ $cl='ttlast'; }
			if($broker->flogo){ $im = $broker->flogo; } else { $im = FBP_PLUGIN_URL.'images/standart.png';}
$themplate .='  <div class="tfblock ffirst '. $cl .'">
                    <div class="fbg_name">
			        <div><a href="'. fbp_permalink($broker->id) .'" target="_blank"><img src="'. $im .'" alt="" /></a></div>
				    <a href="'. fbp_permalink($broker->id) .'" target="_blank">'. $broker->fname .'</a>
					</div>
			    </div>	';
			
			}
			
$themplate .='<div class="fbp_clear"></div>';

			$r=0;
			foreach($brokers as $broker){ $r++;
			$cl='';
			if($r==$count){ $cl='ttlast'; }
			$cc = get_fbp_your_rating($broker->id);
$themplate .='  <div class="tfblock '. $cl .'">
                    <div class="tfbratp">
			        <div class="fbprating" name="'. $broker->id .'">';
				if($cc > 0){ 
		$themplate .='<div class="fbpsmall">голос учтён</div>';
				} else {
		$themplate .='<div class="fbp_rating"><div class="fbp_rating_act"></div>
			        <ul>
					    <li title="1"></li><li title="2"></li><li title="3"></li><li title="4"></li><li title="5"></li>
						<div class="fbp_clear"></div>
					</ul>
			    </div>';
				} 
		$themplate .=' <div class="fbp_rat_result">'. $broker->frating .'</div>
				    </div>
					</div>
			    </div>	';
			
			}			
			
$themplate .=' <div class="fbp_clear"></div>';


			$r=0;
			foreach($brokers as $broker){ $r++;
			$cl='';
			if($r==$count){ $cl='ttlast'; }
			
$themplate .='  <div class="tfblock '. $cl .'">
                    <div class="fbg_status'. $broker->fstatus .'"></div>
			    </div>	';
			
			}
$themplate .=' <div class="fbp_clear"></div>';

			
			
			$r=0;
			foreach($brokers as $broker){ $r++;
			$cl='';
			if($r==$count){ $cl='ttlast'; }
			
$themplate .='  <div class="tfblock '. $cl .'">
                    <div class="fbg_text">'. $broker->fgod .'</div>
			    </div>	';
			
			}
$themplate .=' <div class="fbp_clear"></div>';			
			
			
			$r=0;
			foreach($brokers as $broker){ $r++;
			$cl='';
			if($r==$count){ $cl='ttlast'; }
			
$themplate .='  <div class="tfblock '. $cl .'">
                    <div class="fbg_text">'. $broker->fplatform .'</div>
			    </div>	';
			
			}
$themplate .=' <div class="fbp_clear"></div>';			


			$r=0;
			foreach($brokers as $broker){ $r++;
			$cl='';
			if($r==$count){ $cl='ttlast'; }
			
$themplate .='  <div class="tfblock '. $cl .'">
                    <div class="fbg_text">'. $broker->fminschet .'<!--$--></div>
			    </div>	';
			
			}
$themplate .=' <div class="fbp_clear"></div>';			
			
			
			$r=0;
			foreach($brokers as $broker){ $r++;
			$cl='';
			if($r==$count){ $cl='ttlast'; }
			
$themplate .='  <div class="tfblock '. $cl .'">
                    <div class="fbg_text">'. $broker->fminsdelka .' <!--лота--></div>
			    </div>	';
			
			}
$themplate .=' <div class="fbp_clear"></div>';			
			
			
			$r=0;
			foreach($brokers as $broker){ $r++;
			$cl='';
			if($r==$count){ $cl='ttlast'; }
			
$themplate .='  <div class="tfblock '. $cl .'">
                    <div class="fbg_text">от '. $broker->fkrplot .' до '. $broker->fkrpldo .'</div>
			    </div>	';
			
			}
$themplate .=' <div class="fbp_clear"></div>';	


			$r=0;
			foreach($brokers as $broker){ $r++;
			$cl='';
			if($r==$count){ $cl='ttlast'; }
			
$themplate .='  <div class="tfblock '. $cl .'">
                    <!--<div class="fbg_text">от '. get_sclonenie($broker->fspred,'% пунктов', '% пункта','% пунктов') .'</div>-->
					<div class="fbg_text">от '. $broker->fspred .'</div>
			    </div>	';
			
			}
$themplate .=' <div class="fbp_clear"></div>';


			$r=0;
			foreach($brokers as $broker){ $r++;
			$cl='';
			if($r==$count){ $cl='ttlast'; }
			
$themplate .='  <div class="tfblock '. $cl .'">
                    <div class="fbg_text"><a target="_blank" href="'. fbp_permalink($broker->id) .'">'. $broker->fsite .'</a></div>
			    </div>	';
			
			}
$themplate .=' <div class="fbp_clear"></div>';
	
	
			$r=0;
			foreach($brokers as $broker){ $r++;
			$cl='';
			if($r==$count){ $cl='ttlast'; }
			
$themplate .='  <div class="tfblock '. $cl .'">
                    <div class="fbg_text2"><span class="fbpzol">'. $broker->fpotz .'</span><span class="fbpblue">'. $broker->footz .'</span><span class="fbpgray">'. $broker->fnotz .'</span></div>
			    </div>	';
			
			}
$themplate .=' <div class="fbp_clear"></div>';	
			
			
			$r=0;
			foreach($brokers as $broker){ $r++;
			$cl='';
			if($r==$count){ $cl='ttlast'; }
			
$themplate .='  <div class="tfblock flast '. $cl .'">
                    <div class="fbg_delisimo delsravn" name="'. $broker->id .'"></div>
			    </div>	';
			
			}
$themplate .=' <div class="fbp_clear"></div>';			
			
			
			
			
		$themplate .=' <div class="fbp_clear"></div>
	                 </div>
				    <div class="fbp_clear"></div>
	            </div>
		</div>
		
	';
		
	} else {
		
	$themplate = '<div class="fbp_reg_otvet_no"><strong>Ошибка:</strong> не выбраны участники для сравнения.</div>';
		
	}	

    return $themplate;
}
		
?>