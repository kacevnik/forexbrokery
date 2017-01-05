<?php
if( !defined( 'ABSPATH')){ exit(); }

function get_fbp_comments_table($limit,$inicio,$fbid=0){

$table = '';

if($fbid){ $where=" AND fb_id='$fbid' "; }

global $wpdb;
$ncomments=array();
$comments = $wpdb->get_results("SELECT * FROM ". $wpdb->prefix ."fbp_comments WHERE cactive='1' AND cparent != '0' $where ORDER BY id desc");
foreach($comments as $comm){
    $ncomments[$comm->cparent][]=$comm;
}
$s=0;
$commentsn = $wpdb->get_results("SELECT * FROM ". $wpdb->prefix ."fbp_comments WHERE cactive='1' AND cparent = '0' $where ORDER BY id desc LIMIT $inicio, $limit");
if(is_array($commentsn)){
foreach($commentsn as $ncom){ $s++;
if($ncom->crating==1){
$cotz = '<span class="fbp_green">положительный</span>';
} elseif($ncom->crating==2){
$cotz = '<span class="fbp_red">отрицательный</span>';
} else {
$cotz = '<span class="fbp_yelow">нейтральный</span>';
}
$table .='
	    <div class="fbp_one_otz">
		
		    <div class="fbp_onotdate">'.get_fbp_time($ncom->cdate,'d.m.Y в H:i').' <span class="fbp_onotdatec">'. $ncom->cname .'</span> ( '. $cotz .' )</div>
            <div class="fbp_content">
			   '. apply_filters('the_content', $ncom->ctext) .'
			</div>
		
		</div>';
		if(is_array($ncomments[$ncom->id])){
		foreach($ncomments[$ncom->id] as $nc){
            if($nc->crating==1){
                $cotz = '<span class="fbp_green">положительный</span>';
            } elseif($nc->crating==2){
                $cotz = '<span class="fbp_red">отрицательный</span>';
            } else {
                $cotz = '<span class="fbp_yelow">нейтральный</span>';
            }
		    
	        $table .='<div class="fbp_one_otz second">
		
		        <div class="fbp_onotdate">'.get_fbp_time($nc->cdate,'d.m.Y в H:i').' <span class="fbp_onotdatec">'. $nc->cname .'</span> ( '. $cotz .' )</div>
                <div class="fbp_content">
			      '. apply_filters('the_content', $nc->ctext) .'
			    </div>
		
		    </div>';	
        }
		}
        $table .='<a href="#" class="fbp_onegocomment addotziv" name="'. $fbid .'" rel="'. $ncom->id .'">Комментировать</a>
		    <div class="fbp_clear"></div>
';

}
}

if($s==0){

$table .='<div style="text-align: center; font-weight: bold; padding: 10px 0;">комментариев нет</div>';

}

return $table;

}

function get_fbp_pagina($id){
if($id==5){
   $cl1 = 'act';
} elseif($id==10){
   $cl2 = 'act';
} elseif($id==20){
   $cl3 = 'act';
} else {
   $cl4 = 'act';
}
$table = 'Показать на странице: <a href="#" name="5" class="'. $cl1 .'">5</a> | <a href="#" name="10" class="'. $cl2 .'">10</a> | <a href="#" name="20" class="'. $cl3 .'">20</a> | <a href="#" name="30" class="'. $cl4 .'">30</a>';
return $table;
}

function get_fbp_pagenavi($page,$limit,$fbid){
$table = '';
global $wpdb;
$pagina = intval($page); 
if (!$pagina) { $inicio=0; $pagina=1;
} else {
    $inicio = ($pagina - 1) * $limit;
} 

$count = $wpdb->query("SELECT id FROM ". $wpdb->prefix ."fbp_comments WHERE fb_id='$fbid' AND cactive='1' AND cparent = '0'");
if($count > 0){
$kol_str = ceil($count/$limit);
} else {
$kol_str = 1;
}

if($kol_str > 0){
    if($pagina > 1 and $kol_str > 1){
	    $table .='<a href="#'. ($pagina-1) .'" name="'. $limit .'">пред.</a>';
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
                   $table .='<a href="#'. $e .'" name="'. $limit .'">'.$e.'</a>';
                } else {
                   $table .='<a href="#'. $e .'" name="'. $limit .'">'.$e.'</a>';
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
           $table .='<a href="#'. $e .'" name="'. $limit .'">'.$e.'</a>';
        } elseif($e==1){
           $table .='<a href="#'. $e .'" name="'. $limit .'">'.$e.'</a>';
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
            $table .='<a href="#'. $e .'" name="'. $limit .'">'.$e.'</a>';
        }
       }

    }		
	
	
    if($kol_str > 1 and $pagina != $kol_str){
	    $table .='<a href="#'. ($pagina+1) .'" name="'. $limit .'">след.</a>';
	} elseif($pagina == $kol_str){
	    $table .='<span class="current">след.</span>';
	}	
}
$table .= '<div class="fbp_clear"></div>';

return $table;
}
		
?>