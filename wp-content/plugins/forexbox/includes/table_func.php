<?php
if( !defined( 'ABSPATH')){ exit(); }

function get_broker_graph($id){
$table = '';
global $wpdb;

    $i=-1;
    $r = date('m');
	$y = date('Y');
	$mm = array();
	$rat = array();
	while($i++ < 11){
	    $tm = $r-$i; if($tm <= 0){ $tm = 12+$tm; } if($tm < 10){ $tm = '0'.$tm; }
		$mm[$tm] = fbp_trans_let_date($tm);
		$oy = $y;
		$d = $r-$i; if($d <= 0){ $d = 12+$d; $oy = $y-1;} if($d < 10){ $d = '0'.$d; }
		$olddate = $oy.'-'.$d.'-00';
		$ny = $y;
		$nd = $r-$i+1; if($nd <= 0){ $nd = 12+$nd; $ny = $y-1;} if($nd < 10){ $nd = '0'.$nd; }
		$newdate = $ny.'-'.$nd.'-00';		
        $rats = $wpdb->get_var("SELECT SUM(rrating) FROM ".$wpdb->prefix."fbp_rating WHERE fb_id='$id' AND rdate > '$olddate' AND rdate < '$newdate'"); 
	    $rat[$tm] = (int)$rats;
	}

	$mz = max($rat);
	if($mz > 0){
	    $mxt = ceil($mz / 100) * 100;
	} else {
	    $mxt = 100;
		}
	
	$nw=array();
	$onepix = 80 / $mxt;
	$r=0;
	while($r++ < 12){
	    if($r < 10){ $r = '0'.$r; }
	    $nw[$r] =  ceil($onepix * $rat[$r]);
	}

		    $table .='<div class="fbpohgraph">
			    <div class="fbpabs fbpoh_1"></div>
				    <div class="fbpabs fbpoh_7">баллы</div>
				<div class="fbpabs fbpoh_2"></div>
				<div class="fbpabs fbpoh_3"></div>
				<div class="fbpabs fbpoh_4"></div>
				<div class="fbpabs fbpoh_5"></div>
				<div class="fbpabs fbpoh_6"></div>
				    <div class="fbpabs fbpoh_8">'. $mxt .'</div>
					<div class="fbpabs fbpoh_9">'. (($mxt / 4) * 3) .'</div>
					<div class="fbpabs fbpoh_10">'. (($mxt / 4) * 2) .'</div>
					<div class="fbpabs fbpoh_11">'. ($mxt / 4) .'</div>
					<div class="fbpabs fbpoh_12">0</div>';
				
				$r=0;
				$mm = array_reverse($mm, true);
				foreach($mm as $key => $mm2){ $r++;
				    $zd = 12+$r;
				    $table .= '<div class="fbpabs fbpoh_'. $zd .'">'. $mm2 .'</div>';

					$zd2 = 24+$r;

					if($nw[$key]){
					    if($r%2==0){
					        $table .='<div class="fbpabs fbpoh_'.$zd2.' bl" style="height: '. $nw[$key] .'px;"></div>';
					    } else {
					        $table .='<div class="fbpabs fbpoh_'.$zd2.' ye" style="height: '. $nw[$key] .'px;"></div>';
					    }
					}
				}
					
			$table .='</div>';	
	return $table;
}

function get_fbp_hd($num,$first,$link,$order,$asc,$distable,$limit,$search=''){
    if($num==$first){
	    $cl = 'first';
	} 
if($order=='frating' and $num==3){
    $rcl = $asc;
} elseif($order=='fname' and $num==2){
    $rcl = $asc;
} elseif($order=='fotziv' and $num==4){
    $rcl = $asc;
} elseif($order=='fstatus' and $num==6){
    $rcl = $asc;	
}

if($num==3){
    $ll = 'frating';
} elseif($num==2){
    $ll = 'fname';
} elseif($num==4){
    $ll = 'fotziv';
} elseif($num==6){
    $ll = 'fstatus';	
}

if($asc=='desc' and $rcl){
    $lasc = 'asc';
} else {
    $lasc = 'desc';
}   

    if($link=='link'){
	    $table = '<div class="hfbptone '. $cl .' hthe'. $num .'"><a href="#1fbps'. $lasc .'fbps'. $ll .'fbps'. $search .'" name="'. $limit .'" class="hsorter '. $rcl .'">'. $distable['name']['fdoc'.$num] .'</a></div>';
	} else {
	    $table = '<div class="hfbptone '. $cl .' hthe'. $num .'"><div class="hsorter">'. $distable['name']['fdoc'.$num] .'</div></div>';
	}
return $table;
}

function kdv_get_reiting($id){
	global $wpdb;
	$user_reiting = get_option('user_reiting_'.$id);
	if(isset($user_reiting) && $user_reiting!=0){
		$up = $wpdb->query("UPDATE ".$wpdb->prefix."forex_broker SET frating='$user_reiting' WHERE id ='$id'");
		return $user_reiting;
	}else{
		$sum = $wpdb->get_var("SELECT SUM(rrating) FROM ".$wpdb->prefix."fbp_rating WHERE fb_id='$id'");
		$count = $wpdb->get_var("SELECT COUNT(*) FROM ".$wpdb->prefix."fbp_rating WHERE fb_id='$id'");
		if($sum == 0 || $count == 0){
			return 0;
		}else{
			$reiting = $sum/$count;
			$up = $wpdb->query("UPDATE ".$wpdb->prefix."forex_broker SET frating='$reiting' WHERE id ='$id'");
			return $res = number_format($reiting, 1,'.','');
		}
	}
}

function get_forex_home_table($page,$limit,$asc,$order,$search='',$plecho=-1){
global $wpdb;

$inicio = ($page-1) * $limit;

$distable = get_option('fbp_distable');
if($asc!='asc'){ $asc='desc'; }
if($order=='frating'){
    $rorder =' (frating -0.0) ';
} elseif($order=='fname'){
    $rorder =' fname ';
} elseif($order=='fotziv'){
    $rorder =' (fotzivs -0.0) ';
} elseif($order=='fstatus'){
    $rorder =' fstatus ';	
} 

$npor = explode(',',$distable['por']);

$width = 2;
$hd=array();
if($distable['enable']['fdc1']==1){
    $width = $width+40;
	$hd[1] = get_fbp_hd(1,$npor[0],'nolink',$order,$asc,$distable,$limit,$search );
}
if($distable['enable']['fdc2']==1){
    $width = $width+206;
	$hd[2] = get_fbp_hd(2,$npor[0],'link',$order,$asc,$distable,$limit,$search );
}
if($distable['enable']['fdc3']==1){
    $width = $width+156;
	$hd[3] = get_fbp_hd(3,$npor[0],'link',$order,$asc,$distable,$limit,$search );
}
if($distable['enable']['fdc4']==1){
    $width = $width+106;
	$hd[4] = get_fbp_hd(4,$npor[0],'link',$order,$asc,$distable,$limit,$search );
}
if($distable['enable']['fdc5']==1){
    $width = $width+96;
	$hd[5] = get_fbp_hd(5,$npor[0],'nolink',$order,$asc,$distable,$limit,$search );
}
if($distable['enable']['fdc6']==1){
    $width = $width+76;
	$hd[6] = get_fbp_hd(6,$npor[0],'link',$order,$asc,$distable,$limit,$search );
}
if($distable['enable']['fdc7']==1){
    $width = $width+96;
	$hd[7] = get_fbp_hd(7,$npor[0],'nolink',$order,$asc,$distable,$limit,$search );
}

$tu = fbp_cleared_post(fbp_your_id());
$post = $wpdb->get_row("SELECT * FROM ".$wpdb->prefix."fbp_sravni WHERE ryour='$tu'");
$tvoi = unserialize($post->rfbp);
if(!is_array($tvoi)){ $tvoi=array(); }

$lrat = get_option('fbp_last_rating');

$table = '    
    <div class="home_fbptoptable" style="width: '. $width .'px;">';
 	
	foreach($npor as $pr){
	    $table .= $hd[$pr];
	}
	
$table .= '<div class="fbp_clear"></div>
	</div>';
	
	if(strlen($search) > 0){  $where = "AND fname LIKE '%$search%'"; }
	if($plecho != -1){$plecho = "AND fkrpldo<=".$plecho." AND fkrplot<=".$plecho;}else{$plecho = '';}
	
	$count = $wpdb->query("SELECT id FROM ". $wpdb->prefix ."forex_broker WHERE fvkl='1' AND disablertrue='1' $where $plecho");
    
	if($count > 0){
	
	    $ci = $inicio;
	
	    $brokers = $wpdb->get_results("SELECT *, (fpotz+fnotz+footz) AS fotzivs FROM ". $wpdb->prefix ."forex_broker WHERE fvkl='1' AND disablertrue='1' $where $plecho ORDER BY $rorder $asc LIMIT $inicio, $limit");
	    foreach($brokers as $fb){ $ci++;
		$fbid = $fb->id;
		
	$fstatus = $fb->fstatus;
	$stattitle = fbp_orili('Статус',$distable['table1']['ftab1']);
	if($fstatus==1){
	$fbpstatus = '<div class="fbpoline"><span class="fbpobc_title">'. $stattitle .':</span> Новый</div>';
	} elseif($fstatus==2){
	$fbpstatus = '<div class="fbpoline"><span class="fbpobc_title">'. $stattitle .':</span> Рекомендованный</div>';
	}		
		
		$table .= '
		<div class="thisisbroker" style="width: '. $width .'px;">
		    <div class="graphthis"><div class="fbp_ajaxformtitle">График рейтинга "'. $fb->fname .'"</div>'. get_broker_graph($fb->id) .'</div>
		<div class="fbphtone">';
		
	if($lrat[$fbid]['s'] > $lrat[$fbid]['v']){
	   $scl = 'tops';
	} elseif($lrat[$fbid]['s'] < $lrat[$fbid]['v']){
	   $scl = 'bottoms';
	} else {
	   $scl = 'krs';
	}
	
	if($fb->flogo){ $im = $fb->flogo; } else { $im = FBP_PLUGIN_URL.'images/standart.png';}
		
	$ck = get_fbp_your_rating($fb->id);
    	
		if($distable['enable']['fdc1']==1){
	$dg[1] = '<div class="fbp_btvn hthec1"><div class="fbpbth_count">'. $ci .'</div><div class="fbp_mesto '. $scl .'"></div></div>';
	    }
		if($distable['enable']['fdc2']==1){
	$dg[2] = '<div class="fbp_btvn hthec2"><div class="fbpbth_img"><a href="'.site_url()."/forex_broker/".$fb->fslug.'" ><img src="'. $im .'" alt="Форекс брокер '.$fb->fname.'" title="Подробнее о '.$fb->fname.'" /></a></div><div class="fbpbth_name"><a href="'.site_url()."/forex_broker/".$fb->fslug.'" target="_blank"  title="Подробнее о '.$fb->fname.'">'. $fb->fname .'</a></div></div>';
	    }
		if($distable['enable']['fdc3']==1){
	$dg[3] = '<div class="fbp_btvn hthec3"><div class="fbprating" name="'. $fb->id .'">';
	
        if($ck > 0){ 
		$dg[3] .='<div class="fbpsmall">голос учтён</div>';
		
		} else {
		$dg[3] .='<div class="fbp_rating"><div class="fbp_rating_act"></div>
			        <ul>
					    <li title="1"></li><li title="2"></li><li title="3"></li><li title="4"></li><li title="5"></li>
						<div class="fbp_clear"></div>
					</ul>
			    </div>';
				
		} 	
		
		if(in_array($fb->id, $tvoi)){
		$claw = 'checkfbpgo';
		} else {
		$claw = 'checkfbpaut';
		}
	
	$dg[3] .= '<div class="fbp_rat_result" title="Рейтинг форекс брокера '.$fb->fname.'">'. kdv_get_reiting($fb->id).'</div></div></div>';
	    }
		if($distable['enable']['fdc4']==1){
	$dg[4] = '<div class="fbp_btvn hthec4"><div class="fbg_text3"><a class="fbpzol" href="'.site_url()."/otziv-p/".$fb->fslug.'" title="Положительных отзывов о форекс брокере '.$fb->fname.'">'. $fb->fpotz .'</a><a class="fbpgray" href="'.site_url()."/otziv-n/".$fb->fslug.'" title="Нейтральных отзывов о форекс брокере '.$fb->fname.'">'. $fb->fnotz .'</a><a class="fbpblue" href="'.site_url()."/otziv-o/".$fb->fslug.'" title="Отрицательных отзывов о форекс брокере '.$fb->fname.'">'. $fb->footz .'</a></div></div>';
	    }
	    if($distable['enable']['fdc5']==1){
	$dg[5] = '<div class="fbp_btvn hthec5"><div class="fbg_graph" title="Статистика рейтинга форекс брокера '.$fb->fname.'"></div></div>';
	    }
		if($distable['enable']['fdc6']==1){
	$dg[6] = '<div class="fbp_btvn hthec6"><div class="fbg_statusz'. $fb->fstatus .'"></div></div>';
	    }
		if($distable['enable']['fdc7']==1){
	$dg[7] = '<div class="fbp_btvn hthec7"><div class="fbg_theckeck '. $claw .'" id="untfbp_'. $fb->id .'" title="Добавить/убрать форекс брокера '.$fb->fname.' к сравнению"></div></div>';
	    }
		
	foreach($npor as $key => $pr){
	        $table .= $dg[$pr];
	}		
		
		$stattitle2 = fbp_orili('Торговая платформа',$distable['table1']['ftab2']);
		$stattitle3 = fbp_orili('Торговые условия',$distable['table1']['ftab3']);
		$stattitle4 = fbp_orili('Лицензия',$distable['table1']['ftab4']);
		$stattitle5 = fbp_orili('Адрес',$distable['table1']['ftab5']);

		if($fb->fkrplot != ''){$fkrplot = " от 1:".$fb->fkrplot;}else{$fkrplot = $fb->fkrplot;}
		if($fb->fkrpldo != ''){$fkrpldo = " до 1:".$fb->fkrpldo;}else{$fkrpldo = $fb->fkrpldo;}
		
		    $table .='<div class="fbp_clear"></div>	
		</div>
		<div class="fbpsmallinfo">
		    <div class="fbpsmallinfovn">
			    '. $fbpstatus .'
				<div class="fbpoline"><span class="fbpobc_title">'. $stattitle2 .':</span> '. $fb->fplatform .'</div>
				<div class="fbpoline"><span class="fbpobc_title">'. $stattitle3 .':</span> '. $fb->fminschet .'$ |'. $fkrplot . $fkrpldo .' |  '. $fb->fminsdelka .' <!--лота--> | '. $fb->fspred .'</div>
		        <div class="fbpoline"><span class="fbpobc_title">'. $stattitle4 .':</span> '. $fb->flicense .'</div>
				<div class="fbpoline"><span class="fbpobc_title">'. $stattitle5 .':</span> '. $fb->fadress .'</div>';
				
				if($fb->fotzivs > 0){
				
				$table .= '<div class="fbpoline"><span class="fbpobc_title">Последний отзыв:</span></div>';
				$comments = $wpdb->get_results("SELECT * FROM ". $wpdb->prefix ."fbp_comments WHERE fb_id='$fbid' AND cactive='1' AND cparent = '0' ORDER BY id desc LIMIT 1");
			        foreach($comments as $ncom){
					    $table .= '
	                        <div class="fbp_one_otz">
		
		                        <div class="fbp_onotdate">'.get_fbp_time($ncom->cdate,'d.m.Y в H:i').' <span class="fbp_onotdatec">'. $ncom->cname .'</span></div>
                                <div class="fbp_content">
			                        '. apply_filters('the_content', $ncom->ctext) .'
			                    </div>
		
		                    </div>						
						';
			        }
			    }
				$nnbr = '';
				if($fb->fnews){
				    $nnbr = '<div class="fbplinebt"><a href="'. $fb->fnews .'" rel="nofollow" target="_blank">Последние новости</a></div>';
				}
			
		$table .= '	
		        <div class="fbpbtleft">
				    <div class="fbplinebt"><a href="'. fbp_permalink($fb->id) .'" target="_blank">'. $fb->fsite .'</a></div>
				    '. $nnbr .'
					<div class="fbplinebt"><a href="'.site_url()."/fbpotziv/".$fb->fslug.'">Все отзывы пользователей</a></div>
				</div>
		        <div class="fbpbtright">
				      <div class="fbp_obvodka">
					      <a href="'.site_url()."/forex_broker/".$fb->fslug.'" class="fbp_yelowkn">Полная информация</a>
					  </div>
				</div>
                    <div class="fbp_clear"></div>			
			</div>
		</div>
		<div class="fbpajaxshow">Подробнее</div>
		</div>
		';
		
		}
	
	}  else {
	    $table .= '<div class="fbphtno">таблица пуста</div>';
	}
	
return $table;

}


function get_fbp_pagina_home($id, $search=''){
if($id==10){
   $cl2 = 'act';
} elseif($id==20){
   $cl3 = 'act';
} else {
   $cl4 = 'act';
}

$table = 'Показать на странице: <a href="#1fbpsdescfbpsfratingfbps'. $search .'" name="10" class="'. $cl2 .'">10</a> | <a href="#1fbpsdescfbpsfratingfbps'. $search .'" name="20" class="'. $cl3 .'">20</a> | <a href="#1fbpsdescfbpsfratingfbps'. $search .'" name="30" class="'. $cl4 .'">30</a>';
return $table;
}

function get_fbp_pagenavi_home($page,$limit,$asc,$orerby,$search='',$plecho=-1){
if($limit == 0){$limit = 10;}
if(strlen($search) > 0){  $where = "AND fname LIKE '%$search%'"; }
if($plecho != -1){$plecho = "AND fkrpldo<=".$plecho." AND fkrplot<=".$plecho;}else{$plecho = '';}
$table = '';
global $wpdb;
$pagina = intval($page); 
if (!$pagina) { $inicio=0; $pagina=1;
} else {
    $inicio = ($pagina - 1) * $limit;
} 

$count = $wpdb->query("SELECT id FROM ". $wpdb->prefix ."forex_broker WHERE fvkl='1' AND disablertrue='1' $where $plecho");
if($count > 0){
$kol_str = ceil($count/$limit);
} else {
$kol_str = 1;
}

if($kol_str > 0){
    if($pagina > 1 and $kol_str > 1){
	    $table .='<a href="#'. ($pagina-1) .'fbps'. $asc .'fbps'. $orerby .'fbps'. $search .'" name="'. $limit .'">пред.</a>';
	} elseif($pagina == 1){
	    $table .='<span class="current">пред.</span>';
	}
	
        if($pagina >= 4 ){
        $e=0;
           if($pagina == 4){
             $do = 1;
           } else {
             $do = 2;
           }
               while($e++ < $do){

                if($e==1){
                   $table .='<a href="#'. $e .'fbps'. $asc .'fbps'. $orerby .'fbps'. $search .'" name="'. $limit .'">'.$e.'</a>';
                } else {
                   $table .='<a href="#'. $e .'fbps'. $asc .'fbps'. $orerby .'fbps'. $search .'" name="'. $limit .'">'.$e.'</a>';
                }

               }
            if($pagina != 5 and $pagina != 4){
                $table .='<span>...</span>';
            }
        }	
		
		$e=$pagina-3;
        while($e++<$pagina+2){

        if($e == $pagina){
           $table .='<span class="current">'.$e.'</span>';
        } elseif($e > 0 and $e < $kol_str+1) {
           $table .='<a href="#'. $e .'fbps'. $asc .'fbps'. $orerby .'fbps'. $search .'" name="'. $limit .'">'.$e.'</a>';
        } elseif($e==1){
           $table .='<a href="#'. $e .'fbps'. $asc .'fbps'. $orerby .'fbps'. $search .'" name="'. $limit .'">'.$e.'</a>';
        }

        }

    if($pagina < $kol_str-2 ){

    if($pagina != $kol_str-3 and $pagina != $kol_str-4){
       $table .='<span>...</span>';
    }

    if($pagina == $kol_str-3){
       $e=$kol_str-1;
    } else {
       $e=$kol_str-2;
    }
       while($e++ < $kol_str){
        if($e < $kol_str+1){
            $table .='<a href="#'. $e .'fbps'. $asc .'fbps'. $orerby .'fbps'. $search .'" name="'. $limit .'">'.$e.'</a>';
        }
       }

    }		
	
	
    if($kol_str > 1 and $pagina != $kol_str){
	    $table .='<a href="#'. ($pagina+1) .'fbps'. $asc .'fbps'. $orerby .'fbps'. $search .'" name="'. $limit .'">след.</a>';
	} elseif($pagina == $kol_str){
	    $table .='<span class="current">след.</span>';
	}	
}
$table .= '<div class="fbp_clear"></div>';

return $table;
}
		
?>