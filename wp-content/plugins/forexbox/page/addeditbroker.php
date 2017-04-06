<?php
if( !defined( 'ABSPATH')){ exit(); }

global $wpdb;

$id=intval($_GET['edit']);
if($id){
$fbp = $wpdb->get_row("SELECT * FROM ".$wpdb->prefix."forex_broker WHERE id='$id'");
$fbpid = $fbp->id;
}	

if(get_option('user_reiting_'.$id)){
	$reiting = get_option('user_reiting_'.$id);
}else{
	$reiting = 0;
}
?>

<form action="<?php echo FBP_PLUGIN_URL;?>ajax/addeditfb.php" method="POST">
<div class="addeditform">
    <input type="hidden" id="fbp_idfb" name="fbpid"  value="<?php echo $fbpid;?>" />
    <table cellpadding="0" cellspacing="0" width="100%">
	    <?php
		    $distable = get_option('fbp_distable');
		    forexbox_uploader('flogo','Логотип',$fbp->flogo);
		    forexbox_inputbig('fname',fbp_orili('Название',$distable['table1']['ftab20']),$fbp->fname);
			forexbox_inputbig('fsite',fbp_orili('Официальный сайт',$distable['table1']['ftab13']),$fbp->fsite);
			forexbox_inputbig('fnews','Ссылка на новости',$fbp->fnews);	
			forexbox_inputbig('fuserreiting','Рейтинг',$reiting, '  Реальный рейтинг: '.real_reiting($fbpid));
			forexbox_select('fstatus',fbp_orili('Статус',$distable['table1']['ftab1']),array('0'=>'нет','1'=>'новый','2'=>'рекомендуемый'),$fbp->fstatus);
			forexbox_select_god('fgod',fbp_orili('Год основания',$distable['table1']['ftab6']),$fbp->fgod);
			//forexbox_inputbig('flicense',fbp_orili('Лицензия',$distable['table1']['ftab4']),$fbp->flicense);
			forexbox_select('flicense_sysec',fbp_orili('Лицензия CySec','Лицензия CySec'),array('0'=>'нет','1'=>'да'),$fbp->flicense_sysec);
			forexbox_select('flicense_fca',fbp_orili('Лицензия FCA','Лицензия FCA'),array('0'=>'нет','1'=>'да'),$fbp->flicense_fca);
			forexbox_select('flicense_nfa',fbp_orili('Лицензия NFA','Лицензия NFA'),array('0'=>'нет','1'=>'да'),$fbp->flicense_nfa);
			forexbox_select('fopit',fbp_orili('Есть опыт, для фильтра?','Есть опыт, для фильтра?'),array('0'=>'нет','1'=>'да'),$fbp->fopit);
			forexbox_inputbig('fplatform',fbp_orili('Торговая платформа',$distable['table1']['ftab2']),$fbp->fplatform);
			forexbox_inputbig('fsposobopl',fbp_orili('Способы оплаты',$distable['table1']['ftab7']),$fbp->fsposobopl);
			forexbox_text('fdescription',fbp_orili('Описание',$distable['table1']['ftab14']),$fbp->fdescription);
			forexbox_inputbig('fadress',fbp_orili('Адрес',$distable['table1']['ftab5']),$fbp->fadress);
			forexbox_inputbig('fplink','Партнёрская ссылка',$fbp->fplink);
			forexbox_input('fminschet',fbp_orili('Минимальный размер счёта',$distable['table1']['ftab8']),$fbp->fminschet);
			forexbox_doubleinput('fkrplot', 'fkrpldo', fbp_orili('Кредитное плечо',$distable['table1']['ftab9']), array('От 1:','до 1:'), $fbp->fkrplot,$fbp->fkrpldo);
			forexbox_input('fminsdelka',fbp_orili('Минимальная сделка',$distable['table1']['ftab10']),$fbp->fminsdelka);
			forexbox_input('fspred',fbp_orili('Спред от','Спред от'),$fbp->fspred);
			forexbox_input('fcomiss',fbp_orili('Коммиссия',$distable['table1']['ftab12']),$fbp->fcomiss);
			forexbox_select('fdemo',fbp_orili('Демо-счёт',$distable['table1']['ftab15']),array('0'=>'нет','1'=>'да'),$fbp->fdemo);
			forexbox_select('fmobile',fbp_orili('Мобильная версия',$distable['table1']['ftab16']),array('0'=>'нет','1'=>'да'),$fbp->fmobile);
			forexbox_select('fpartner',fbp_orili('Партнёрская программа',$distable['table1']['ftab17']),array('0'=>'нет','1'=>'да'),$fbp->fpartner);
			forexbox_select('fdovupr',fbp_orili('Доверительное управление',$distable['table1']['ftab18']),array('0'=>'нет','1'=>'да'),$fbp->fdovupr);
			forexbox_inputbig('fbonus',fbp_orili('Бонус',$distable['table1']['ftab19']),$fbp->fbonus);
			forexbox_select('fvkl','Отключен',array('1'=>'нет','0'=>'да'),$fbp->fvkl);
			forexbox_text('fdhtml',fbp_orili('Произвольный код','Произвольный код'),$fbp->fdhtml);
		?>	
        <tr>
		    <th>
			    <div class="fbp_relative"><div id="fbp_addedit_ajax" class="fbp_ajax"></div></div>
			</th>
	        <td><input type="submit" class="button" value="Сохранить" id="add_fbp" name="add" /></td>
	    </tr>		
	</table>
</div>
</form>

<script type="text/javascript">
$(function(){

    $('#add_fbp').click(function(){
        if($('#fbp_fname').val().length < 1){
		
		    alert('Ошибка! Вы не ввели название.');
		
		    return false;
		}
    });	

	/* медиаформа */	
	var txtBox_id = '';
	jQuery('.upload_image_button').click(function() {
		txtBox_id = '#'+jQuery(this).attr('id').replace('_button', '');
		formfield = jQuery(txtBox_id);
		tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
		return false;
	});
	window.send_to_editor = function(html) {
		imgurl = html.replace(/"+/g,"'");
		imgurl = imgurl.split("<a href='");
		imgurl = imgurl[1].split("'");
		imgurl = imgurl[0];
		jQuery(txtBox_id).val(imgurl);
		tb_remove();
	}	
	
});
</script>