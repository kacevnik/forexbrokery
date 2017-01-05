<?php
if( !defined( 'ABSPATH')){ exit(); }
global $user_ID, $themplate;

	if($user_ID){
	    $promo = $_GET['promo'];
		if(!$promo){ $promo='text'; }
		if($promo == 'text'){ $cl='act'; } else { $cl2='act'; }
		$themplate = '
		    <div id="promotopmenu">
			    <ul>
				    <li class="'. $cl .'"><a href="?promo=text">Текстовые материалы</a></li>
					<li class="'. $cl2 .'"><a href="?promo=banner">Баннеры</a></li>
				</ul>
			</div>	
		';
		
		if($promo == 'banner'){
		
		    $themplate .= '
			<div id="promomenu">
			    <ul>
				    <li class="act"><a href="#ftab1">468x60</a></li>
					<li><a href="#ftab2">200x200</a></li>
					<li><a href="#ftab3">120x600</a></li>
					<li><a href="#ftab4">100x100</a></li>
					<li><a href="#ftab5">88x31</a></li>
				</ul>
			</div>';			
		
		}
		
			$urls = get_option('siteurl');
		    $url = str_replace('http://','',$urls);
		    $urls = $urls.'/';		
		
		if($promo == 'text'){
		
		    $text = get_option('fbp_texts_material');
		    
			$themplate .= '<div class="ftabcontainer act">
			
			<div class="fbp_content_minitext">Примечание: здесь приведены примерные варианты описания сервиса '.$url.', которые опубликованы уже на многих десятках сайтов. Настоятельно рекомендуем, при использовании какого-либо из приведенных текстов, переписывать его содержание своими словами.</div>';
			
		    if(is_array($text)){
 		        foreach($text as $text1){

		        $textq = str_replace('[url]',$urls,$text1);
		        $textq = str_replace('[partner_link]',$urls.'?fbpid='.$user_ID,$textq);
		        $textq = stripslashes($textq);
		            if($textq){
                        $themplate .= '
		                <div style="padding: 10px 0 20px;">
		                <i>'.$textq.'</i>
		                </div>
		                <div style="padding: 0 0 30px;">
		                <textarea class="fbp_textarea" onclick="this.select()">'.$textq.'</textarea>
		                </div>		
                        ';
		            }
                }
			}			
			
			$themplate .= '</div>';
		
		} else {
		
		$banner468 = get_option('fbp_banner_468');
		$banner200 = get_option('fbp_banner_200');
		$banner120 = get_option('fbp_banner_120');
		$banner100 = get_option('fbp_banner_100');
		$banner88 = get_option('fbp_banner_88');		
		
		$themplate .= '<div id="ftab1" class="ftabcontainer act">';
		
		if(is_array($banner468)){
 		    foreach($banner468 as $text1){
     
		    $textq = str_replace('[url]',$urls,$text1);
		    $textq = str_replace('[partner_link]',$urls.'?fbpid='.$user_ID,$textq);
		    $textq = stripslashes($textq);
		        if($textq){
                    $themplate .= '<div class="fbp_prevbanner">'.$textq.'</div>
                    <div class="fbp_etot">
		            <a href="#" class="fbp_act_link">Показать код баннера</a>
		            <textarea class="fbp_textarea" style="display: none; margin: 10px 0 0 0; height: 60px;" onclick="this.select()">'.$textq.'</textarea>
		            </div>		
                    ';
		        }
            }
		}		
		
		$themplate .= ' </div>';
		
		$themplate .= '<div id="ftab2" class="ftabcontainer">';
		
		if(is_array($banner200)){
 		    foreach($banner200 as $text1){
     
		    $textq = str_replace('[url]',$urls,$text1);
		    $textq = str_replace('[partner_link]',$urls.'?fbpid='.$user_ID,$textq);
		    $textq = stripslashes($textq);
		        if($textq){
                    $themplate .= '<div class="fbp_prevbanner">'.$textq.'</div>
                    <div class="fbp_etot">
		            <a href="#" class="fbp_act_link">Показать код баннера</a>
		            <textarea class="fbp_textarea" style="display: none; margin: 10px 0 0 0; height: 60px;" onclick="this.select()">'.$textq.'</textarea>
		            </div>		
                    ';
		        }
            }
		}		
		
		$themplate .= ' </div>';
		
		$themplate .= '<div id="ftab3" class="ftabcontainer">';		
		
		if(is_array($banner120)){
 		    foreach($banner120 as $text1){
     
		    $textq = str_replace('[url]',$urls,$text1);
		    $textq = str_replace('[partner_link]',$urls.'?fbpid='.$user_ID,$textq);
		    $textq = stripslashes($textq);
		        if($textq){
                    $themplate .= '<div class="fbp_prevbanner">'.$textq.'</div>
                    <div class="fbp_etot">
		            <a href="#" class="fbp_act_link">Показать код баннера</a>
		            <textarea class="fbp_textarea" style="display: none; margin: 10px 0 0 0; height: 60px;" onclick="this.select()">'.$textq.'</textarea>
		            </div>		
                    ';
		        }
            }
		}		
		
		$themplate .= ' </div>';

		$themplate .= '<div id="ftab4" class="ftabcontainer">';		
		
		if(is_array($banner100)){
 		    foreach($banner100 as $text1){
     
		    $textq = str_replace('[url]',$urls,$text1);
		    $textq = str_replace('[partner_link]',$urls.'?fbpid='.$user_ID,$textq);
		    $textq = stripslashes($textq);
		        if($textq){
                    $themplate .= '<div class="fbp_prevbanner">'.$textq.'</div>
                    <div class="fbp_etot">
		            <a href="#" class="fbp_act_link">Показать код баннера</a>
		            <textarea class="fbp_textarea" style="display: none; margin: 10px 0 0 0; height: 60px;" onclick="this.select()">'.$textq.'</textarea>
		            </div>		
                    ';
		        }
            }
		}		
		
		$themplate .= ' </div>';

		$themplate .= '<div id="ftab5" class="ftabcontainer">';		
		
		if(is_array($banner88)){
 		    foreach($banner88 as $text1){
     
		    $textq = str_replace('[url]',$urls,$text1);
		    $textq = str_replace('[partner_link]',$urls.'?fbpid='.$user_ID,$textq);
		    $textq = stripslashes($textq);
		        if($textq){
                    $themplate .= '<div class="fbp_prevbanner">'.$textq.'</div>
                    <div class="fbp_etot">
		            <a href="#" class="fbp_act_link">Показать код баннера</a>
		            <textarea class="fbp_textarea" style="display: none; margin: 10px 0 0 0; height: 60px;" onclick="this.select()">'.$textq.'</textarea>
		            </div>		
                    ';
		        }
            }
		}		
		
		$themplate .= ' </div>';		
		
		}		

		
	} else {
		
		$themplate = '<div class="fbp_reg_otvet_no"><strong>Ошибка:</strong> данная страница доступна только зарегистрированным пользователям.</div>';
		
	}

?>