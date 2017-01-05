<?php
if( !defined( 'ABSPATH')){ exit(); }

global $wpdb;

$id=intval($_GET['edit']);
if($id){
$fbp = $wpdb->get_row("SELECT * FROM ".$wpdb->prefix."fbp_comments WHERE id='$id'");
$fbpid = $fbp->id;
}	

$idfirst = $fbp->fb_id;

$brokers = array();
$aus = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."forex_broker WHERE fname != '' ORDER BY fname ASC");
$r=0;
foreach($aus as $au){ $r++;
    $brokers[$au->id] = $au->fname;
	if($r==1 and !$idfirst){ $idfirst = $au->id; }
}

?>

<form action="<?php echo FBP_PLUGIN_URL;?>ajax/addeditcomment.php" method="POST">
<div class="addeditform">
    <input type="hidden" name="id"  value="<?php echo $fbpid;?>" />
    <table cellpadding="0" cellspacing="0" width="100%">
	    <?php
			forexbox_select('fb_id','К участнику: ',$brokers,$fbp->fb_id);
        ?>
		<tr>
	    <th>К комментарию:</th>
		<td><div id="fb_many_comm">
		<?php echo get_fbp_to_comment($idfirst,$fbpid,$fbp->cparent); ?>
        </div></td>
	    </tr>		
		<?php
		    forexbox_date('c1','Дата',$fbp->cdata);
			forexbox_inputbig('cname','Имя',$fbp->cname);
		    forexbox_inputbig('cemail','e-mail',$fbp->cemail);
			forexbox_select('crating','Вид',array('0'=>'нейтральный','1'=>'положительный','2'=>'отрицательный'),$fbp->crating);
			forexbox_select('cactive','Статус',array('0'=>'не активирован','1'=>'активирован'),$fbp->cactive);
			forexbox_text('ctext','Текст',$fbp->ctext);
		?>	
        <tr>
		    <th>
			    &nbsp;
			</th>
	        <td><input type="submit" class="button" value="Сохранить" name="add" /></td>
	    </tr>		
	</table>
</div>
</form>

<script type="text/javascript">
$(function(){

	$('#fbp_fb_id').live('change',function(){
	var id = $(this).attr('value');
	$('#forexboxajax').show();
	var dataString='id='+id + 'tid=<?php echo $fbpid;?>';
    $.ajax({
    type: "POST",
    url: "<?php echo FBP_PLUGIN_URL;?>ajax/changecomment2.php",
    data: dataString,
	cache: false,
    success: function(ht)
    {
		$('#fb_many_comm').html(ht);	
	    $('#forexboxajax').hide();
    }
    });		

	return false;
	});
});
</script>