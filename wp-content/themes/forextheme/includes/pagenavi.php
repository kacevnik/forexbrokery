<?php
if( !defined( 'ABSPATH')){ exit(); }

		
function pagenavi_rasch($limit,$get,$counts){

$pagina = intval($get); //id страницы
if (!$pagina) { $inicio=0; $pagina=1;
} else {
    $inicio = ($pagina - 1) * $limit;
} 
$kolviv = $pagina * $limit; //количество сообщений до данной страницы
if($counts > 0){
$kol_str = ceil($counts/$limit);
} else {
$kol_str = 1;
}

if($kol_str==$pagina){
$mos= $pagina;
} else {
$mos= $pagina + 1; //следующая страница
}
$fos = $pagina - 1; //предидущая страница
if(!$fos){$fos=1;}
if(!$kol_str){ $kol_str = 1; }

$pagenavi = array();
$pagenavi['limit']=$limit;
$pagenavi['pagina']=$pagina;
$pagenavi['kolviv']=$kolviv;
$pagenavi['kol_str']=$kol_str;
$pagenavi['mos']=$mos;
$pagenavi['fos']=$fos;
$pagenavi['inicio']=$inicio;

return $pagenavi;

}

add_filter('wp_title' , 'rewrite_title');
function rewrite_title($title) {
	$idspage = get_query_var('paged');		
	if($idspage){
		$title .= ' &raquo; страница '.$idspage;
	}
				
		return $title;
}

function rstudia_pagenavi(){
$uri = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
$uri = preg_replace('/\/page\/[0-9]{0,3}/','',$uri);
if(is_search()){
$uris = explode('?s=',$uri);
$uri = $uris[0];
$uris[1]= '?s='.$uris[1];
} 
if(mb_substr($uri, -1, 1) != '/'){
$uri = $uri.'/';
}


global $wp_query;
$kol_str = $wp_query->max_num_pages;

$idspage = get_query_var('paged');
if(!$idspage){$idspage=1;}

if($kol_str > 1){
  echo '<div class="pagenavi">';
    if($idspage > 1){
       echo '<a href="'.$uri.$uris[1].'">первая</a>';
       echo '<a href="'.$uri.'page/'.($idspage-1).'/'.$uris[1].'">&larr;</a>';	   
    } else {
       echo '<span>первая</span>';
       echo '<span>&larr;</span>';	
	}

        if($idspage >= 4 ){
        $e=0;
           if($idspage == 4){
             $do = 1;
           } else {
             $do = 2;
           }
               while($e++ < $do){

                if($e==1){
                   echo '<a href="'.$uri.$uris[1].'">'.$e.'</a>';
                } else {
                   echo '<a href="'.$uri.'page/'.$e.'/'.$uris[1].'">'.$e.'</a>';
                }

               }
            if($idspage != 5 and $idspage != 4){
                echo '<span>...</span>';
            }
        }
		
		
		$e=$idspage-3;
        while($e++<$idspage+2){

        if($e == $idspage){
           echo '<span class="current">'.$e.'</span>';
        } elseif($e > 0 and $e < $kol_str+1) {
           echo '<a href="'.$uri.'page/'.$e.'/'.$uris[1].'">'.$e.'</a>';
        } elseif($e==1){
           echo '<a href="'.$uri.$uris[1].'">'.$e.'</a>';
        }

        }

    if($idspage < $kol_str-2 ){

    if($idspage != $kol_str-3 and $idspage != $kol_str-4){
       echo '<span>...</span>';
    }

    if($idspage == $kol_str-3){
       $e=$kol_str-1;
    } else {
       $e=$kol_str-2;
    }
       while($e++ < $kol_str){
        if($e < $kol_str+1){
            echo '<a href="'.$uri.'page/'.$e.'/'.$uris[1].'">'.$e.'</a>';
        }
       }

    }		
	
	if($idspage != $kol_str){
       echo '<a href="'.$uri.'page/'.($idspage+1).'/'.$uris[1].'">&rarr;</a>';	
       echo '<a href="'.$uri.'page/'.$kol_str.'/'.$uris[1].'">последняя</a>';	
	} else {
       echo '<span>&rarr;</span>';	
       echo '<span>последняя</span>';	
	}
  
  echo '<div class="clear"></div></div>';
}

}
 
?>