<?php
if( !defined( 'ABSPATH')){ exit(); }
global $user_ID, $themplate;
	$fname = get_query_var('fname');
    global $wpdb;
	$fb = $wpdb->get_row("SELECT * FROM ".$wpdb->prefix."forex_broker WHERE fslug='$fname' AND disablertrue='1' AND fvkl='1'");
	$fbid = $fb->id;

	
	$distable = get_option('fbp_distable');
	$thetitle1 = fbp_orili('Статус',$distable['table1']['ftab1']);
	$thetitle4 = fbp_orili('Торговая платформа',$distable['table1']['ftab2']);
	$thetitle3 = fbp_orili('Лицензия',$distable['table1']['ftab4']);	
	$thetitle17 = fbp_orili('Адрес',$distable['table1']['ftab5']);
	$thetitle2 = fbp_orili('Год основания',$distable['table1']['ftab6']);
	$thetitle5 = fbp_orili('Способы оплаты',$distable['table1']['ftab7']);
	$thetitle6 = fbp_orili('Минимальный размер счёта',$distable['table1']['ftab8']);
	$thetitle7 = fbp_orili('Кредитное плечо',$distable['table1']['ftab9']);
	$thetitle8 = fbp_orili('Минимальная сделка',$distable['table1']['ftab10']);
	$thetitle9 = fbp_orili('Спред',$distable['table1']['ftab11']);
	$thetitle10 = fbp_orili('Коммиссия',$distable['table1']['ftab12']);
	$thetitle11 = fbp_orili('Официальный сайт',$distable['table1']['ftab13']);
	$thetitle12 = fbp_orili('Описание',$distable['table1']['ftab14']);
	$thetitle13 = fbp_orili('Демо-счёт',$distable['table1']['ftab15']);
	$thetitle14 = fbp_orili('Мобильная версия',$distable['table1']['ftab16']);
	$thetitle15 = fbp_orili('Партнёрская программа',$distable['table1']['ftab17']);
	$thetitle16 = fbp_orili('Доверительное управление',$distable['table1']['ftab18']);
	$thetitle18 = fbp_orili('Бонус',$distable['table1']['ftab19']);	

	$lic = '';
	if($fb->flicense_sysec == 1){$lic = 'CySEC';}
	if($fb->flicense_fca == 1){$lic .= ' FCA';}
	if($fb->flicense_nfa == 1){$lic .= ' NFA';}

	if($lic != ''){$showLic = '<div class="fbpoline"><span class="fbpobc_title">'.$thetitle3.':</span> '. $lic .'</div>';}else{
		$showLic = '';
	}

	$fstatus = $fb->fstatus;
	if($fstatus==1){
	$fbpstatus = '<div class="fbpoline"><span class="fbpobc_title">'.$thetitle1.':</span> Новый</div>';
	} elseif($fstatus==2){
	$fbpstatus = '<div class="fbpoline"><span class="fbpobc_title">'.$thetitle1.':</span> Рекомендованный</div>';
	} 
	
	$ratcc = get_fbp_your_rating($fb->id);
	
	$themplate = '';
	
	if($fbid){
	
	if($fb->flogo){ $im = $fb->flogo; } else { $im = FBP_PLUGIN_URL.'images/standart.png';}	

	if($fb->fkrplot != ''){$fkrplot = " от 1:".$fb->fkrplot;}else{$fkrplot = $fb->fkrplot;}
	if($fb->fkrpldo != ''){$fkrpldo = " до 1:".$fb->fkrpldo;}else{$fkrpldo = $fb->fkrpldo;}
	
	$themplate .= '<div class="fbpo_title">'. $fb->fname .'</div>';
	
	$themplate .='
	<div class="fbpo_head">
	    <div class="fbpoh_left">
		    <div class="fbpohimg"><a href="'. fbp_permalink($fb->id) .'" target="_blank"><img src="'. $im .'" alt="" /></a></div>
			<div class="fbpohtitle"><a href="'. fbp_permalink($fb->id) .'" target="_blank">'. $fb->fname .'</a></div>
			<div class="fbpobrkn">
				<div class="fbpobrknvn addsravn" name="'. $fb->id .'">Добавить в сравнение</div>
			</div>
			<div class="fbpobrkn_rating">
			    <div class="fbpobrkn_ratingtit">Рейтинг:</div>
				<div class="fbpobrkn_rating_res">'. $fb->frating .'</div>
				<div class="fbp_clear"></div>
				<div class="fbpobrkn_prog">Проголосуйте:</div>
				<div class="fbpprstar" name="'. $fb->id .'">
				';
			if($ratcc==0){
			    
	$themplate .='
		        <div class="fbp_rating2"><div class="fbp_rating_act"></div>
			        <ul>
					    <li title="1"></li><li title="2"></li><li title="3"></li><li title="4"></li><li title="5"></li>
						<div class="fbp_clear"></div>
					</ul>
			    </div>
				';
				
			} else {
			
	$themplate .='<div class="fbpsmall">голос учтён</div>';			
			
			}
			$themplate .='
			   </div>
			   <div class="fbp_clear"></div>
			</div>
		</div>
	    <div class="fbpohright" style="padding: 15px 10px;">
'. $fbpstatus .'
	        <div class="fbpoline"><span class="fbpobc_title">'.$thetitle2.':</span> '. $fb->fgod .'</div>
	        '.$showLic.'
	        <div class="fbpoline"><span class="fbpobc_title">'.$thetitle4.':</span> '. $fb->fplatform .'</div>
			<div class="fbpoline"><span class="fbpobc_title">'.$thetitle5.':</span> '. $fb->fsposobopl .'</div>
			<div class="fbpoline"><span class="fbpobc_title">'.$thetitle6.':</span> '. $fb->fminschet .'<!--$--> </div>
			<div class="fbpoline"><span class="fbpobc_title">'.$thetitle7.':</span> '. $fkrplot . $fkrpldo .' </div>
	        <div class="fbpoline"><span class="fbpobc_title">'.$thetitle8.':</span> '. $fb->fminsdelka .' <!--лота--> </div>
	        <!--<div class="fbpoline"><span class="fbpobc_title">'.$thetitle9.':</span> от '. get_sclonenie($fb->fspred,'% пунктов', '% пункта','% пунктов') .' </div>-->
			<div class="fbpoline"><span class="fbpobc_title">'.$thetitle9.':</span> от '. $fb->fspred .' </div>
	        <div class="fbpoline"><span class="fbpobc_title">'.$thetitle10.':</span> '. $fb->fcomiss .'<!--%--> </div>
			<div class="fbpoline"><span class="fbpobc_title">'.$thetitle11.':</span> <a href="'. fbp_permalink($fb->id) .'" target="_blank">'. $fb->fsite .'</a></div>
			<div class="fbpoline"><span class="fbpobc_title">'.$thetitle12.':</span>
                <div class="fbpobc_content">
			     '. apply_filters('the_content', $fb->fdescription) .'
				     <div class="fbp_clear"></div>
				</div>
			</div>
			<div class="fbpoline"><span class="fbpobc_title">'.$thetitle13.':</span> '. fbp_ynchange($fb->fdemo) .'</div>
			<div class="fbpoline"><span class="fbpobc_title">'.$thetitle14.':</span> '. fbp_ynchange($fb->fmobile) .'</div>
			<div class="fbpoline"><span class="fbpobc_title">'.$thetitle15.':</span> '. fbp_ynchange($fb->fpartner) .'</div>
			<div class="fbpoline"><span class="fbpobc_title">'.$thetitle16.':</span> '. fbp_ynchange($fb->fdovupr) .'</div>
	        <div class="fbpoline"><span class="fbpobc_title">'.$thetitle17.':</span> '. $fb->fadress .'</div>
			<div class="fbpoline"><span class="fbpobc_title">'.$thetitle18.':</span> '. $fb->fbonus .'</div>
			<div class="fbpoline"><i>* - Рейтинг не несет никакой ответственности за ошибки в предоставленной информации. Чтобы получить самую последнюю информацию о торговых условиях, пожалуйста, посетите сайт соответствующего участника.</i></div>
		</div>
        <div class="fbp_clear"></div>		
	</div>
	'.$fb->fdhtml.'
	<div class="fbpo_body">	
		    <div class="fbp_lastotz">Последние отзывы</div>';
			
			$mnhj = get_option('fbp_config');
			$count = intval($mnhj['countvn']);
			if(!$count){ $count=5; }
			
			$comments = $wpdb->get_results("SELECT * FROM ". $wpdb->prefix ."fbp_comments WHERE cactive='1' AND fb_id='$fbid' ORDER BY id desc LIMIT $count");
			$rn=0;
			foreach($comments as $comment){ $rn++;
				if($rn==1){$lastoone_first = ' lastoone_first';}else{$lastoone_first = '';}
 $themplate .= '<div class="fbp_lastoone'.$lastoone_first.'">
			    <div class="fbp_lastoone_author"><span class="fbplodate">'. get_fbp_time($comment->cdate) .'</span> '. $comment->cname .'</div>
			    <div class="fbp_lasto_content">
				<p>'. get_fbp_onelast_comment($comment->ctext) .'</p>
				</div>
			    </div>';
			}	
			if($rn==0){
 $themplate .= '<div class="fbp_lastoone">
			    отзывов пока нет.
			    </div>';			
			}

            $themplate .='<a href="'.site_url()."/fbpotziv/".$fb->fslug.'" class="fbp_all_otzivlink">Все отзывы</a>

		    <div class="fbpobrkn otz_daun">
			   <div class="fbpobrknvn2 addotziv" name="'. $fb->id .'">Оставить отзыв</div>
			</div>	
	    <div class="fbp_clear"></div>
	</div>
	';
	
	
		
	} else {
		
	$themplate = '<div class="fbp_reg_otvet_no"><strong>Ошибка:</strong> участника не существует.</div>';
		
	}


?>