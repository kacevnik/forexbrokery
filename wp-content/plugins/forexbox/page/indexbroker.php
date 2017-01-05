<?php
if( !defined( 'ABSPATH')){ exit(); }
?>

<div class="fbp_block">
	    <p>Пакетный импорт сайтов с помощью CSV файла - позволяет добавить сразу несколько<br/> сайтов, минуя заполнение каких-либо форм. Подробнее читайте в "<a href="http://best-curs.info/forexbox_help/" target="_blank">Руководстве пользователя</a>".</p>
		<br />
		<p><b>Адрес CSV файла:</b> <input id="csvfile" type="text" name="url" value="" />&nbsp;<input id="csvfile_button" type="button" value="Обзор" class="upload_image_button button" />&nbsp;<input type="submit" name="" id="start_parsing" class="button" value="Получить список"></p>
</div>

<div class="fbp_block">
    <p><a href="<?php echo admin_url('admin.php?page=forexbox/index.php&add=1');?>" class="button">Добавить новый</a> ||

	<select name="" style="position: relative; top: 1px;" id="bulk_actions_mass">
		<option value="none">выберите действие</option>
		<option value="<?php echo FBP_PLUGIN_URL;?>pinger.php">проверить доступность</option>
		<option value="<?php echo FBP_PLUGIN_URL;?>update_links.php">обновить статистику переходов</option>
	</select>
	<input type="submit" name="" id="bulk_actions_m" value="Выполнить" class="button"></p>
</div>

<center>
<form action="<?php echo FBP_PLUGIN_URL;?>ajax/updatetablebroker.php" id="fb_table_ajax_post" method="POST">
<div style="margin-bottom: 4px;">
	<select name="action">
		<option value="-1">действия с выбранными</option>
		<option value="delete">удалить</option>
		<option value="disable">отключить</option>
		<option value="enable">включить</option>
		<option value="saves">сохранить</option>
		<option value="nullrating">обнулить рейтинг</option>
	</select>
	<input type="submit" name="go" value="Выполнить" class="button">
</div>

<div id="fb_table_many">
    <?php echo get_fb_admin_table(); ?>
</div>

<div style="margin-top: 4px;">
	<select name="action2">
		<option value="-1">действия с выбранными</option>
		<option value="delete">удалить</option>
		<option value="disable">отключить</option>
		<option value="enable">включить</option>
		<option value="saves">сохранить</option>
		<option value="nullrating">обнулить рейтинг</option>		
	</select>
	<input type="submit" name="go2" value="выполнить" class="button">
</div>	
</form>
</center>


<script type="text/javascript">
$(function(){

	$('.unmark_action:not(.act), .delete_action:not(.act), .mark_action:not(.act), .delrating:not(.act)').live('click',function(){
	    var id = $(this).attr('name');
		var thet = $(this);
        if(thet.hasClass('delrating')){
		    var vari = 4;
		} else if(thet.hasClass('mark_action')){
		    var vari = 2;
		} else if(thet.hasClass('delete_action')){
            var vari = 1;
        } else {
            var vari = 3;
        }		
		thet.addClass('act');
	    var dataString='id='+id+'&d='+vari;
    $.ajax({
    type: "POST",
    url: "<?php echo FBP_PLUGIN_URL;?>ajax/massdej.php",
    data: dataString,
	dataType: 'json',
    success: function(ht)
    {
	    if(ht['otvet']==1){
		alert('Ошибка: Действие разрешено только администраторам!');
		} else if(ht['otvet']==2){
		alert('Ошибка: не обработан id.');
		} else if(ht['otvet']==10){
		   $('#fb_table_many').html(ht['table']);
		} 	
	    thet.removeClass('act');
    }
    });		
	return false;
	});	

    $('#fb_table_ajax_post').ajaxForm({
        beforeSubmit: function(a,f,o) {
            o.dataType = 'json';
			$('#forexboxajax').show();
			$('.checkbox_column input:checked').parents('tr').find('.edit_action').addClass('act');
        },
        success: function(ht) {
        if(ht['otvet']==1){
		alert('Ошибка: Действие разрешено только администраторам!');
		} else if(ht['otvet']==2){
		alert('Ошибка: Не верный запрос!');
		} else if(ht['otvet']==3){
		alert('Ошибка: Не выбрано действие!');
		} else if(ht['otvet']==4){
		alert('Ошибка: Не выбраны участники!');		
		} else if(ht['otvet']==10){
		$('#fb_table_many').html(ht['table']);
		}
		$('#forexboxajax').hide();
        }
    });	

	$('#bulk_actions_m').live('click',function(){
	var url2 = $('#bulk_actions_mass').attr('value');
	if(url2 !== 'none'){
	$('#forexboxajax').show();
	var dataString='url=1';
    $.ajax({
    type: "POST",
    url: url2,
    data: dataString,
	cache: false,
    success: function(ht)
    {
	    if(ht){
		$('#forexboxajaxres').html(ht);
		} else {
		$('#forexboxajaxres').html('<div class="class_sucess">Выполнено.</div>');
        }		
	    $('#forexboxajax').hide();
    }
    });		
	}
	return false;
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
	
	$('#start_parsing').live('click',function(){
	
	var url = $('#csvfile').val();
	$('#forexboxajax').show();
	$('#start_parsing').attr('disabled',true);
	var dataString='url='+url;
    $.ajax({
    type: "POST",
    url: "<?php echo FBP_PLUGIN_URL;?>ajax/massaddfb.php",
    data: dataString,
	dataType: 'json',
    success: function(ht)
    {
	    if(ht['otvet']==1){
		    alert('Ошибка: '+ ht['err']);		
		} else {
		    $('#forexboxajaxres').html('<div class="class_sucess">Добавлено '+ ht['kol'] +' сайтов.</div>');
		    $('#fb_table_many').html(ht['table']);
		} 	
	    $('#forexboxajax').hide();
		$('#start_parsing').attr('disabled',false);
    }
    });		
	return false;	
	});

	jQuery("#selectAllCheckbox").live('click',
		function(e){
			var checked = false;
			if(jQuery(this).attr('checked') == 'checked' || jQuery(this).attr('checked') == true)
				checked = true;
			jQuery('td.checkbox_column input').attr('checked', checked?true:false);
		}
	);	
	
});
</script>