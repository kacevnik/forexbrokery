<?php
if( !defined( 'ABSPATH')){ exit(); }
$distable = get_option('fbp_distable');
$por = explode(',',$distable['por']);
?>
<div class="addeditformtitle">Настройка главной таблицы:</div>
<div id="fbp_table_ajax">
    <table cellpadding="0" cellspacing="0" width="100%">
	    <thead>
	    <tr>
		    <?php foreach($por as $pr){ 
			    if($pr){
				    if($distable['enable']['fdc'.$pr] == 0){ $cl = 'act'; } else { $cl=''; }
			?>
		    <th class="enfdc<?php echo $pr;?> etc <?php echo $cl;?>" id="col_<?php echo $pr;?>"><?php echo $distable['name']['fdoc'.$pr];?></th>
		    <?php 
			    }
			} ?>
		</tr>
		</thead>
		<tbody>
	    <tr>
		    <?php foreach($por as $pr){ 
			    if($pr){
				    if($distable['enable']['fdc'.$pr] == 0){ $cl = 'act'; } else { $cl=''; }
			?>
		    <td class="enfdc<?php echo $pr;?> <?php echo $cl;?>"><?php echo $distable['name']['fdoc'.$pr];?></td>
		    <?php 
			    }
			} ?>		
		</tr>
	    <tr>
		    <?php foreach($por as $pr){ 
			    if($pr){
				    if($distable['enable']['fdc'.$pr] == 0){ $cl = 'act'; } else { $cl=''; }
			?>
		    <td class="enfdc<?php echo $pr;?> <?php echo $cl;?>"><?php echo $distable['name']['fdoc'.$pr];?></td>
		    <?php 
			    }
			} ?>
		</tr>
        </tbody>		
    </table>
</div>
<form action="<?php echo FBP_PLUGIN_URL;?>ajax/addconfig.php" method="POST">
<input type="hidden" id="fbp_ex_poryadok" name="por" value="<?php echo $distable['por'];?>" />
<div class="addeditform conf">
    <table cellpadding="0" cellspacing="0" width="100%">
	    <?php
			forexbox_inputcheck('fdoc1','№',$distable['name']['fdoc1'],'fdc1','Показывать',$distable['enable']['fdc1']);
			forexbox_inputcheck('fdoc2','Название',$distable['name']['fdoc2'],'fdc2','Показывать',$distable['enable']['fdc2']);
			forexbox_inputcheck('fdoc3','Рейтинг',$distable['name']['fdoc3'],'fdc3','Показывать',$distable['enable']['fdc3']);
			forexbox_inputcheck('fdoc4','Отзывы',$distable['name']['fdoc4'],'fdc4','Показывать',$distable['enable']['fdc4']);
			forexbox_inputcheck('fdoc5','Статистика',$distable['name']['fdoc5'],'fdc5','Показывать',$distable['enable']['fdc5']);
			forexbox_inputcheck('fdoc6','Статус',$distable['name']['fdoc6'],'fdc6','Показывать',$distable['enable']['fdc6']);
			forexbox_inputcheck('fdoc7','Сравнить',$distable['name']['fdoc7'],'fdc7','Показывать',$distable['enable']['fdc7']);
		?>	
        <tr>
		    <th></th>
	        <td><input type="submit" class="button" value="Сохранить" name="add" /></td>
	    </tr>		
	</table>
</div>

<div class="addeditformtitle">Настройка текста:</div>

<div class="addeditform conf">
    <table cellpadding="0" cellspacing="0" width="100%">
	    <?php
			forexbox_inputbig('ftab20','Название',fbp_orili('Название',$distable['table1']['ftab20']));
			forexbox_inputbig('ftab13','Официальный сайт',fbp_orili('Официальный сайт',$distable['table1']['ftab13']));
			forexbox_inputbig('ftab1','Статус',fbp_orili('Статус',$distable['table1']['ftab1']));
			forexbox_inputbig('ftab6','Год основания',fbp_orili('Год основания',$distable['table1']['ftab6']));
			forexbox_inputbig('ftab4','Лицензия',fbp_orili('Лицензия',$distable['table1']['ftab4']));
			forexbox_inputbig('ftab2','Торговая платформа',fbp_orili('Торговая платформа',$distable['table1']['ftab2']));
			forexbox_inputbig('ftab7','Способы оплаты',fbp_orili('Способы оплаты',$distable['table1']['ftab7']));
		    forexbox_inputbig('ftab14','Описание',fbp_orili('Описание',$distable['table1']['ftab14']));
			forexbox_inputbig('ftab5','Адрес',fbp_orili('Адрес',$distable['table1']['ftab5']));
			forexbox_inputbig('ftab8','Минимальный размер счёта',fbp_orili('Минимальный размер счёта',$distable['table1']['ftab8']));
		    forexbox_inputbig('ftab9','Кредитное плечо',fbp_orili('Кредитное плечо',$distable['table1']['ftab9']));
		    forexbox_inputbig('ftab10','Минимальная сделка',fbp_orili('Минимальная сделка',$distable['table1']['ftab10']));
			forexbox_inputbig('ftab11','Спред',fbp_orili('Спред',$distable['table1']['ftab11']));
			forexbox_inputbig('ftab12','Коммиссия',fbp_orili('Коммиссия',$distable['table1']['ftab12']));
		    forexbox_inputbig('ftab15','Демо-счёт',fbp_orili('Демо-счёт',$distable['table1']['ftab15']));
			forexbox_inputbig('ftab16','Мобильная версия',fbp_orili('Мобильная версия',$distable['table1']['ftab16']));
			forexbox_inputbig('ftab17','Партнёрская программа',fbp_orili('Партнёрская программа',$distable['table1']['ftab17']));
			forexbox_inputbig('ftab18','Доверительное управление',fbp_orili('Доверительное управление',$distable['table1']['ftab18']));
			forexbox_inputbig('ftab19','Бонус',fbp_orili('Бонус',$distable['table1']['ftab19']));
			forexbox_inputbig('ftab3','Торговые условия (сводка)',fbp_orili('Торговые условия',$distable['table1']['ftab3']));
			
		?>	
        <tr>
		    <th></th>
	        <td><input type="submit" class="button" value="Сохранить" name="add" /></td>
	    </tr>		
	</table>
</div>

</form>
<script type="text/javascript">
$(function(){


	$('#fbp_table_ajax table').dragtable({
		persistState: function(table){
			var accum = '';
			$('#fbp_table_ajax table .etc').each(function(){
			    var number = $(this).attr('id').replace('col_','') + ',';
				accum = accum + number;
			});
			$('#fbp_ex_poryadok').attr('value', accum);
		}
	});

    $('.fbp_check_name').live('keyup',function(){
	    var id = $(this).attr('id').replace('fbp_fdoc','');
	    var valed = $(this).val();
	    $('.enfdc'+id).html(valed);
	
	    return false;
	});
	
	$('.fbp_check').live('change', function(){
	    var id = $(this).attr('name').replace('fdc','');
	    if($(this).attr('checked') == 'checked'){
		    $('.enfdc'+id).show();
		} else {
		    $('.enfdc'+id).hide();
	    }
	});

});
</script>