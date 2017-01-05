<?php
if( !defined( 'ABSPATH')){ exit(); }
 
$dd = explode(' ',current_time('mysql')); $dd = $dd[0];
if($_POST['in1']){
global $wpdb;
$wpdb->query("UPDATE ".$wpdb->prefix."forex_broker SET `timer` = '$dd',`sutka` = '0'");

$salut=1;
}
if($_POST['in2']){
global $wpdb;
$wpdb->query("UPDATE ".$wpdb->prefix."forex_broker SET `timer` = '$dd',`mon` = '0'");

$salut=1;
}
if($_POST['in3']){
global $wpdb;
$wpdb->query("UPDATE ".$wpdb->prefix."forex_broker SET `timer` = '$dd',`alltime` = '0'");

$salut=1;
}

?>


<center>
	<div style="margin: 0 0 20px;">
		<form action="" method="post">
		    <input type="submit" name="in1" class="button" value="Удалить данные за день" /> 
		    <input type="submit" name="in2" class="button" value="Удалить данные за месяц" />
		    <input type="submit" name="in3" class="button" value="Удалить данные за всё время" />
		</form>
	</div>
</center>


<?php
$status = intval($_GET['status']);
if($status==3){
$ord ="mon DESC";
} elseif($status==4){
$ord ="alltime DESC";
} elseif($status==2){
$ord ="sutka DESC";
} else {
$ord ="fname ASC";
}
global $wpdb;
$sql = "SELECT * FROM ".$wpdb->prefix."forex_broker ORDER BY $ord ";
$poster = $wpdb->get_results($sql);
?>

<table class="wp-list-table widefat fixed posts" cellspacing="0">
	<thead>
	<tr>
		<th scope='col' class='manage-column column-title <?php if($status==1){?>sorted desc<?php }?>' ><a href="admin.php?page=forexbox/stats.php&status=1"><span>Название</span></a></th>
		<th scope='col' class='manage-column column-email <?php if($status==2){?>sorted desc<?php }?>' ><a href="admin.php?page=forexbox/stats.php&status=2"><span>За день</span></a></th>
		<th scope='col' class='manage-column column-email <?php if($status==3){?>sorted desc<?php }?>' ><a href="admin.php?page=forexbox/stats.php&status=3"><span>За месяц</span></a></th>
		<th scope='col' class='manage-column column-email <?php if($status==4){?>sorted desc<?php }?>' ><a href="admin.php?page=forexbox/stats.php&status=4"><span>За всё время</span></a></th>
	</tr>
	</thead>
	<tfoot>
	<tr>
		<th scope='col' class='manage-column column-title <?php if($status==1){?>sorted desc<?php }?>' ><a href="admin.php?page=forexbox/stats.php&status=1"><span>Название</span></a></th>
		<th scope='col' class='manage-column column-email <?php if($status==2){?>sorted desc<?php }?>' ><a href="admin.php?page=forexbox/stats.php&status=2"><span>За день</span></a></th>
		<th scope='col' class='manage-column column-email <?php if($status==3){?>sorted desc<?php }?>' ><a href="admin.php?page=forexbox/stats.php&status=3"><span>За месяц</span></a></th>
		<th scope='col' class='manage-column column-email <?php if($status==4){?>sorted desc<?php }?>' ><a href="admin.php?page=forexbox/stats.php&status=4"><span>За всё время</span></a></th>
	</tr>
	</tfoot>

	<tbody id="the-list">

<?php
foreach ($poster as $ca) {
?>
	
<tr valign="top" class="friend">
	
	<td class="post-title page-title column-title">
	<strong><a href="<?php echo $ca->fsite;?>" target="_blank"><?php echo $ca->fname;?></a></strong>
	</td>
    <td><?php echo $ca->sutka;?></td>
	<td><?php echo $ca->mon;?></td>
	<td><?php echo $ca->alltime;?></td>
</tr>
<?php }?>
	</tbody>
</table>

<br class="clear" />