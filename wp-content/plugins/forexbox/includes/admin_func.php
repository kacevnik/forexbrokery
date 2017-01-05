<?php
if( !defined( 'ABSPATH')){ exit(); }

/* таблица в админке */
function get_fb_admin_table(){

$table ='
<table cellpadding="0" cellspacing="0" class="widefat" style="width: 740px;">
    <thead>
		<tr>
			<th style="padding: 5px 0 0 2px">
				<input type="checkbox" id="selectAllCheckbox"/>
			</th>
			<th id="title">
				Название
			</th>
			<th>
				Партнёрка
			</th>				
			<th>
				Рейтинг
			</th>
			<th>
				&nbsp;
			</th>
		</tr>
	</thead>
	<tbody>	
';

global $wpdb;
$automats = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."forex_broker ORDER BY fname asc");
if(is_array($automats)){
    if(count($automats)>0){
	    foreach($automats as $automat){
	if($automat->fvkl==0){
	   $link = '<a href="#" name="'.$automat->id.'" title="Включить" class="actionlink mark_action"></a>';
	} else {
	   $link = '<a href="#" name="'.$automat->id.'" title="Отключить" class="actionlink unmark_action"></a>';
	}	
	$table .='
	    <tr>
			<td class="checkbox_column">
				<input type="checkbox" name="id[]" value="'.$automat->id.'">
			</td>
			<td style="padding-top: 7px;">
				<a href="'.$automat->fplink.'" rel="nofollow" '. $mark .' target="_blank">'.$automat->fname.'</a>
			</td>
			<td align="left">
				<input type="text" class="regular-text" name="partlink['.$automat->id.']" value="'.$automat->fplink.'" />
			</td>			
			<td style="padding-top: 7px;" align="left">
				'. $automat->frating .'				
			</td>				
			<td style="text-align: right;">
				<a href="#" name="'.$automat->id.'" title="Удалить" class="actionlink delete_action"></a>											
				'. $link .'
				<a href="#" name="'.$automat->id.'" title="Обнулить рейтинг" class="actionlink delrating"></a>
				<a href="admin.php?page=forexbox/index.php&edit='. $automat->id .'" title="Редактировать" class="actionlink edit_action"></a>				
			</td>
	    </tr>
    ';
        }	
	} else {
	$table .= '	    
	    <tr>
			<td colspan="5" style="text-align: center; padding: 10px 0; font-weight: bold;">
				Участников нет.
			</td>
	    </tr>';
	}
}
	
$table .='
    </tbody>
</table>';
return $table;
}

function get_fbcomment_admin_table($id=''){
$table ='
<table cellpadding="0" cellspacing="0" class="widefat" style="width: 740px;">
	<thead>
		<tr>
			<th>
				<div style="text-align: center;">Дата</div>
			</th>
			<th>
				Название
			</th>
			<th>
				Имя
			</th>			
			<th>
				E-Mail
			</th>
			<th>
				Отношение
			</th>
			<th>
				&nbsp;
			</th>
			</tr>
	</thead>
	<tbody>
';
if(intval($id)){ $where="WHERE fb_id='$id'";}
global $wpdb;
$comment = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."fbp_comments $where ORDER BY id desc");
if(is_array($comment)){
    if(count($comment)>0){ $po=0;
  
  
    foreach($comment as $comm){
        $rat = $comm->crating;
            if($rat==0){
                $rt='<span class="byelow">Нейтральный</span>';
            } elseif($rat==1){
                $rt='<span class="bgreen">Положительный</span>';
            } elseif($rat==2){
                $rt='<span class="bred">Отрицательный</span>';
            }
	$fb_id = $comm->fb_id;
	$au = $wpdb->get_row("SELECT fname FROM ".$wpdb->prefix."forex_broker WHERE id='$fb_id'");
	
	if($comm->cactive==1){
	   $link = '<a href="#" name="'.$comm->id.'" title="Отклонить" class="actionlink unmark_action"></a>';
	} else {
	   $link = '<a href="#" name="'.$comm->id.'" title="Подтвердить" class="actionlink mark_action"></a>';
	}
	$table .='
	    <tr>
			<td style="padding-top: 7px;">
				<strong>'. get_fbp_time($comm->cdate,'d.m.Y в H:i') .'</strong>
			</td>
			<td align="left" style="padding-top: 7px;">
				<a href="admin.php?page=forexbox/index.php&edit='.$fb_id.'">'.$au->fname.'</a>
			</td>
			<td align="left" style="padding-top: 7px;">
				'.$comm->cname.'
			</td>			
			<td align="left" style="padding-top: 7px;">
				<a href="mailto:'.$comm->cemail.'">'.$comm->cemail.'</a>
			</td>			
			<td style="padding-top: 7px;" align="left">
				'.$rt.'				
			</td>				
			<td style="text-align: right;">
				<a href="#" name="'.$comm->id .'" title="Удалить" class="actionlink delete_action"></a>											
				'. $link .'
				<a href="admin.php?page=forexbox/otziv.php&edit='.$comm->id.'" title="Редактировать" class="actionlink edit_action"></a>				
			</td>
	    </tr>
    ';		
	}
	
	
    } else {
	$table .='
	    <tr>
			<td colspan="6" style="text-align: center; padding: 10px 0; font-weight: bold;">
				Отзывов нет.
			</td>
	    </tr>
    ';  
    }
}	
$table .='
    </tbody>
</table>';
return $table;
}

function fbp_rchecked($one,$two){
   if($one==$two){ echo 'checked="checked"'; }
}
function fbp_rselected($one,$two){
   if($one==$two){ echo 'selected="selected"'; }
}

function forexbox_inputbig($name, $title,$default=''){
?>
    <tr>
		<th><label for="fbp_<?php echo $name;?>"><?php echo $title;?></label></th>
	    <td><input type="text" id="fbp_<?php echo $name;?>" class="regular-text" value="<?php echo $default;?>" name="<?php echo $name;?>" /></td>
	</tr>
<?php
}

function forexbox_inputbigdis($name, $title,$default=''){
?>
    <tr>
		<th><label for="fbp_<?php echo $name;?>"><?php echo $title;?></label></th>
	    <td><input type="text" id="fbp_<?php echo $name;?>" class="regular-text" disabled="disabled" value="<?php echo $default;?>" name="<?php echo $name;?>" /></td>
	</tr>
<?php
}

function forexbox_input($name, $title,$default=''){
?>
    <tr>
		<th><label for="fbp_<?php echo $name;?>"><?php echo $title;?></label></th>
	    <td><input type="text" id="fbp_<?php echo $name;?>" value="<?php echo $default;?>" name="<?php echo $name;?>" /></td>
	</tr>
<?php
}

function forexbox_date($name, $title,$default=''){
if($default == '0000-00-00 00:00:00' or !$default){
$mytime = current_time('mysql');
}
$ds = fbp_rddate($mytime);
?>
    <tr>
		<th><?php echo $title;?></th>
	    <td>
		
<select name="<?php echo $name;?>_day1">
<?php $r=0; while($r++<31){ if($r<10){ $r='0'.$r; } ?>
<option value="<?php echo $r;?>" <?php fbp_rselected($ds['d'],$r);?>><?php echo $r;?></option>
<?php } ?>
</select>
<select name="<?php echo $name;?>_mon1">
<?php $r=0; while($r++<12){ if($r<10){ $r='0'.$r; } ?>
<option value="<?php echo $r;?>" <?php fbp_rselected($ds['m'],$r);?>><?php echo $r;?></option>
<?php } ?>
</select>
<select name="<?php echo $name;?>_yea1">
<?php $r=-2; while($r++<1){  $rs = date('Y',strtotime("+$r year")); ?>
<option value="<?php echo $rs;?>" <?php fbp_rselected($ds['y'],$rs);?>><?php echo $rs;?></option>
<?php } ?>
</select>
в
<select name="<?php echo $name;?>_ch1">
<?php $r=-1; while($r++<23){ if($r<10){ $r='0'.$r; } ?>
<option value="<?php echo $r;?>" <?php fbp_rselected($ds['h'],$r);?>><?php echo $r;?></option>
<?php } ?>
</select>
:
<select name="<?php echo $name;?>_min1">
<?php $r=-1; while($r++<11){ $s = $r*5; if($s<10){ $s='0'.$s; } ?>
<option value="<?php echo $s;?>" <?php fbp_rselected($ds['i'],$s);?>><?php echo $s;?></option>
<?php } ?>
</select>		
		
		</td>
	</tr>
<?php
}

function forexbox_inputcheck($name, $title,$default='',$name2, $title2, $default2=''){
?>
    <tr>
		<th><label for="fbp_<?php echo $name;?>"><?php echo $title;?></label></th>
	    <td>
		    <input type="text" id="fbp_<?php echo $name;?>" class="fbp_check_name" value="<?php echo $default;?>" name="<?php echo $name;?>" />
		    <label><input type="checkbox" value="1" class="fbp_check" name="<?php echo $name2;?>" <?php fbp_rchecked('1',$default2);?> /> <?php echo $title2;?></label>
		</td>
	</tr>
<?php
}

function forexbox_textarea($name, $title,$default=''){
?>
    <tr>
		<th><label for="fbp_<?php echo $name;?>"><?php echo $title;?></label></th>
	    <td><textarea id="fbp_<?php echo $name;?>" style="width: 300px; height: 100px;" name="<?php echo $name;?>" /><?php echo $default;?></textarea></td>
	</tr>
<?php
}

function forexbox_doubleinput($name, $name2, $title, $title2, $default='',$default2=''){
?>
    <tr>
        <th><label for="fbp_<?php echo $name;?>"><?php echo $title;?></label></th>
        <td><?php echo $title2[0];?> <input type="text" id="fbp_<?php echo $name;?>" name="<?php echo $name;?>" value="<?php echo $default;?>" /> <?php echo $title2[1];?> <input type="text" name="<?php echo $name2;?>" value="<?php echo $default2;?>" /></td>
    </tr>
<?php
}

function forexbox_uploader($name, $title, $default=''){
?>
    <tr>
		<th><label for="fbp_<?php echo $name;?>"><?php echo $title;?></label></th>
	    <td><input type="text" id="fbp_<?php echo $name;?>" name="<?php echo $name;?>" value="<?php echo $default;?>" class="regular-text" /> <input type="button" id="fbp_<?php echo $name;?>_button" value="Обзор" class="upload_image_button button" /></td>
	</tr>
<?php
}

function forexbox_select($name, $title, $vibor, $default=''){
?>  
	<tr>
	    <th><label for="fbp_<?php echo $name;?>"><?php echo $title;?></label></th>
		<td>
		<?php if(is_array($vibor)){?>
	    <select name="<?php echo $name;?>" id="fbp_<?php echo $name;?>">
		    <?php foreach($vibor as $key=>$value){ ?>
			<option value="<?php echo $key;?>" <?php fbp_rselected($default,$key);?> ><?php echo $value;?></option>
			<?php } ?>
		</select>
		<?php } ?>
		</td>
	</tr>
<?php
}

function get_fbp_to_comment($id, $tid, $parent=0){
global $wpdb;
$comments = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."fbp_comments WHERE fb_id = '$id' AND cparent='0' AND id != '$tid' ORDER BY id desc");

$table='';
		if(is_array($comments)){
	    $table .='<select name="cparent">
		        <option value="0">Не выбран</option>
		';
		    foreach($comments as $comment){
			    if($comment->id == $parent){ $dg = 'selected="selected"'; } else { $dg=''; }
			    $table .='<option value="'. $comment->id .'" '. $dg .' >'. $comment->cname .' -> '. mb_substr($comment->ctext,0,15) .'...</option>';
			} 
		$table .='</select>';
		} 
return $table;
}

function forexbox_select_god($name, $title, $default=''){
?>
	<tr>
	    <th><label for="fbp_<?php echo $name;?>"><?php echo $title;?></label></th>
		<td>
	    <select name="<?php echo $name;?>" id="fbp_<?php echo $name;?>">
		    <?php $r=date('Y')+1; while($r-- > 1980){ ?>
			<option value="<?php echo $r;?>" <?php fbp_rselected($default,$r);?> ><?php echo $r;?></option>
			<?php } ?>
		</select>
		</td>
	</tr>
<?php
}

function forexbox_text($name, $title,$default=''){
?>
        <tr>
		    <th><?php echo $title;?></th>
			<td>
			    <div class="fbp_beforetable">
	    <?php 		
		$settings['wpautop'] = true;
        $settings['media_buttons'] = false;
        $settings['teeny'] = false;
        $settings['tinymce'] = true;
        $settings['textarea_rows'] = 16;
        wp_editor($default,$name,$settings); 
		?>		
			    </div>
			</td>
		</tr>
<?php
}

function fbp_sanitize_title($title) {

	$iso9_table = array(
		'А' => 'A', 'Б' => 'B', 'В' => 'V', 'Г' => 'G', 'Ѓ' => 'G`',
		'Ґ' => 'G`', 'Д' => 'D', 'Е' => 'E', 'Ё' => 'YO', 'Є' => 'YE',
		'Ж' => 'ZH', 'З' => 'Z', 'Ѕ' => 'Z', 'И' => 'I', 'Й' => 'Y',
		'Ј' => 'J', 'І' => 'I', 'Ї' => 'YI', 'К' => 'K', 'Ќ' => 'K',
		'Л' => 'L', 'Љ' => 'L', 'М' => 'M', 'Н' => 'N', 'Њ' => 'N',
		'О' => 'O', 'П' => 'P', 'Р' => 'R', 'С' => 'S', 'Т' => 'T',
		'У' => 'U', 'Ў' => 'U', 'Ф' => 'F', 'Х' => 'H', 'Ц' => 'TS',
		'Ч' => 'CH', 'Џ' => 'DH', 'Ш' => 'SH', 'Щ' => 'SHH', 'Ъ' => '``',
		'Ы' => 'YI', 'Ь' => '`', 'Э' => 'E`', 'Ю' => 'YU', 'Я' => 'YA',
		'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'ѓ' => 'g',
		'ґ' => 'g', 'д' => 'd', 'е' => 'e', 'ё' => 'yo', 'є' => 'ye',
		'ж' => 'zh', 'з' => 'z', 'ѕ' => 'z', 'и' => 'i', 'й' => 'y',
		'ј' => 'j', 'і' => 'i', 'ї' => 'yi', 'к' => 'k', 'ќ' => 'k',
		'л' => 'l', 'љ' => 'l', 'м' => 'm', 'н' => 'n', 'њ' => 'n',
		'о' => 'o', 'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't',
		'у' => 'u', 'ў' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'ts',
		'ч' => 'ch', 'џ' => 'dh', 'ш' => 'sh', 'щ' => 'shh', 'ь' => '',
		'ы' => 'yi', 'ъ' => "'", 'э' => 'e`', 'ю' => 'yu', 'я' => 'ya'
	);	

	$title = strtr($title, $iso9_table);
	$title = preg_replace("/[^A-Za-z0-9]/", '-', $title);
	$title = mb_strtolower($title);

	return $title;
}

function fbp_podbor_slug($name){
	global $wpdb;
	$namec = fbp_sanitize_title($name);
	$cc = $wpdb->query("SELECT id FROM ". $wpdb->prefix ."forex_broker WHERE fslug='$namec'");
	if($cc > 0){
	    return fbp_podbor_slug($name.'2');
	} else {
	    return $namec;
	}
}
		
?>