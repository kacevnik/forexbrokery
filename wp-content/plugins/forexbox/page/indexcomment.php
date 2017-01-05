<?php
if( !defined( 'ABSPATH')){ exit(); }
?>

<div class="fbp_block">
	<table cellpadding="10" cellspacing="0">
			<tr>
				<td>
					Фильтр по участникам
				</td>
				<td>
					&nbsp;<select name="fbid" id="changebroker">
						    <option value="no">Показать все</option>
							<?php global $wpdb;
							$aus = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."forex_broker WHERE fname != '' ORDER BY fname ASC");
							foreach($aus as $au){
							?>
							<option value="<?php echo $au->id;?>"><?php echo $au->fname;?></option>
                            <?php } ?>
					    </select>
				</td>
				<td>
				|| &nbsp;&nbsp; <a href="<?php echo admin_url('admin.php?page=forexbox/otziv.php&add=1');?>" class="button">Добавить новый отзыв</a>
				</td>
			</tr>
	</table>
</div>

<center>

<div id="fb_table_many">
<?php echo get_fbcomment_admin_table();?>
</div>
	
</center>

<script type="text/javascript">
$(function(){

	$('#changebroker').live('change',function(){
	var id = $(this).attr('value');
	$('#forexboxajax').show();
	var dataString='id='+id;
    $.ajax({
    type: "POST",
    url: "<?php echo FBP_PLUGIN_URL;?>ajax/changecomment.php",
    data: dataString,
	cache: false,
    success: function(ht)
    {
		$('#fb_table_many').html(ht);	
	    $('#forexboxajax').hide();
    }
    });		

	return false;
	});

	$('.delete_action:not(.act), .mark_action:not(.act), .unmark_action:not(.act)').live('click',function(){
		var thet = $(this);
		var id = $(this).attr('name');
        thet.addClass('act');
        if(thet.hasClass('mark_action')){
		    var vari = 2;
		} else if(thet.hasClass('delete_action')){
            var vari = 1;
        } else {
            var vari = 3;
        }				
		
	    var dataString='id='+id+'&d='+vari;
    $.ajax({
    type: "POST",
    url: "<?php echo FBP_PLUGIN_URL;?>ajax/delcomment.php",
    data: dataString,
	dataType: 'json',
    success: function(ht)
    {
	    if(ht['otvet']==1){
		alert('Ошибка: Действие разрешено только администраторам!');
		} else if(ht['otvet']==2){
		alert('Ошибка: не обработан id комментария.');
		} else if(ht['otvet']==10){
		   $('#fb_table_many').html(ht['table']);
		} 	
	    thet.removeClass('act');
    }
    });		
		
	return false;
	}); 
	
});
</script>