<?php
if( !defined( 'ABSPATH')){ exit(); }
$texttable = get_option('fbp_text_table');
?>

<form action="<?php echo FBP_PLUGIN_URL;?>ajax/addmess.php" method="POST">
<div class="addeditform">
    <table cellpadding="0" cellspacing="0" width="100%">
	    <?php
			forexbox_text('ftextdo','Текст до таблицы',$texttable['do']);
			forexbox_text('ftextot','Текст после таблицы',$texttable['ot']);
		?>	
        <tr>
		    <th></th>
	        <td><input type="submit" class="button" value="Сохранить" name="add" /></td>
	    </tr>		
	</table>
</div>
</form>