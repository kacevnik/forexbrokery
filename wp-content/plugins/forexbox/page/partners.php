<?php
if( !defined( 'ABSPATH')){ exit(); }
$mypage = $_GET['mypage'];
	if($_GET['mypage']=='payout'){
		fbp_partner_payout();			
	} elseif($_GET['mypage']=='clicks'){
	    fbp_partner_clicks();
	} elseif($_GET['mypage']=='users'){
	    fbp_partner_users();
	} elseif($_GET['mypage']=='banner'){	
        fbp_partner_banner();
	} elseif($_GET['mypage']=='stats'){	
        fbp_partner_stats();
	} else {		
	    fpb_partner_change();
	}

function fbp_partner_stats(){
		    $time_sutka = current_time('timestamp') - 24 * 60 * 60;
            global $wpdb;			
            $sql = "SELECT id FROM ".$wpdb->prefix."fbp_link WHERE tdate > $time_sutka";
            $za_sutki = $wpdb->query($sql);
            $sql = "SELECT id FROM ".$wpdb->prefix."fbp_link";
            $go_link = $wpdb->query($sql);
            $sql = "SELECT id FROM ".$wpdb->prefix."fbp_link WHERE ttype='2' and tdate > $time_sutka";
            $za_sutki_click = $wpdb->query($sql);
            $sql = "SELECT id FROM ".$wpdb->prefix."fbp_link WHERE ttype='2'";
            $go_click = $wpdb->query($sql);			
            
?>
<center>
	<b>Общая статистика:</b>
	<br><br> 
	Переходов за сутки: <?php echo $za_sutki; ?>
	<br> 
	Переходов всего: <?php echo $go_link; ?>
	<br><br> 
	Кликов за сегодня: <?php echo $za_sutki_click; ?>
	<br> 
	Кликов всего : <?php echo $go_click; ?>
	<br>
</center>
<?php 

}	
	
function fbp_partner_clicks(){

$usario = intval($_GET['user']);	
if($usario){ $where = "AND userid='$usario'";}

global $wpdb;
$sql = "SELECT ID FROM ".$wpdb->prefix."fbp_link WHERE ttype=2 $where";
$kolvo = $wpdb->query($sql); 


$LIMIT_POSTS = 50; 
$pagina = intval($_GET["str"]); 
if (!$pagina) { $inicio=0; $pagina=1;
} else {
    $inicio = ($pagina - 1) * $LIMIT_POSTS;
} 
$kolviv= $pagina * $LIMIT_POSTS; 
$kol_str = ceil($kolvo/$LIMIT_POSTS);
if($kol_str==$pagina){
$mos= $pagina;
} else {
$mos= $pagina + 1;
}
$fos= $pagina - 1; 
if(!$kol_str){ $kol_str = 1; }

?>
<br class="clear" />
<select name='vubor_users' onchange="location = this.options[this.selectedIndex].value;">
<option value='admin.php?page=forexbox/partner.php&mypage=clicks'>Все пользователи</option>
<?php
global $wpdb;
$sql = "SELECT * FROM ".$wpdb->prefix."users ORDER BY user_login";
$poster = $wpdb->get_results($sql);
foreach ($poster as $users) {
?>
<option value='admin.php?page=forexbox/partner.php&mypage=clicks&user=<?php echo $users->ID;?>' <?php if($usario==$users->ID){?>selected='selected'<?php }?>><?php echo $users->user_login;?></option>
<?php
}
?>
</select>
<br class="clear" />
<form action="<?php echo FBP_PLUGIN_URL;?>ajax/pclicks.php" method="post">

    <div class="tablenav top">

		<div class="alignleft actions">
            <select name='action'>
                <option value='0'>Действия</option>
                <option value='pod1'>Удалить</option>
                <option value='pod2'>Не оплатить</option>
            </select>
            <input type="submit" name="go" class="button-secondary action" value="Применить"  />
		</div>

        <div class='tablenav-pages'>
            <span class="displaying-num"><?php echo $kolvo;?> элементов</span>
            <a class='first-page <?php if($pagina==1){?>disabled<?php }?>' title='Перейти на первую страницу' href='admin.php?page=forexbox/partner.php&mypage=clicks&user=<?php echo $usario;?>'>&laquo;</a>
            <a class='prev-page <?php if($pagina==1){?>disabled<?php }?>' title='Перейти на предыдущую страницу' href='admin.php?page=forexbox/partner.php&mypage=clicks&user=<?php echo $usario;?>&str=<?php echo $fos;?>'>&lsaquo;</a>
            <span class="paging-input"><input class='current-page' title='Текущая страница' type='text' name='paged' value='<?php echo $pagina;?>' size='2' /> из <span class='total-pages'><?php echo $kol_str;?></span></span>
            <a class='next-page <?php if($pagina==$kol_str){?>disabled<?php }?>' title='Перейти на следующую страницу' href='admin.php?page=forexbox/partner.php&mypage=clicks&user=<?php echo $usario;?>&str=<?php echo $mos;?>'>&rsaquo;</a>
            <a class='last-page <?php if($pagina==$kol_str){?>disabled<?php }?>' title='Перейти на последнюю страницу' href='admin.php?page=forexbox/partner.php&mypage=clicks&user=<?php echo $usario;?>&str=<?php echo $kol_str;?>'>&raquo;</a>
        </div>
	
    <br class="clear" />
	</div>		


<table class="wp-list-table widefat fixed posts" cellspacing="0">
	<thead>
	<tr>
		<th scope='col' class='manage-column column-cb check-column'><input type="checkbox" class="ch" value="1"/></th>
		<th scope='col' class='manage-column column-email'><span>Логин</span></th>
		<th scope='col' class='manage-column column-email'><span>Дата</span></th>
		<th scope='col' class='manage-column column-email'><span>Браузер</span></th>	
		<th scope='col' class='manage-column column-email'><span>IP</span></th>
		<th scope='col' class='manage-column column-email'><span>Referer</span></th>
		<th scope='col' class='manage-column'><span>Автомат</span></th>
	</tr>
	</thead>

	<tfoot>
	<tr>
		<th scope='col' class='manage-column column-cb check-column'><input type="checkbox" class="ch" value="1"/></th>
		<th scope='col' class='manage-column column-email'><span>Логин</span></th>
		<th scope='col' class='manage-column column-email'><span>Дата</span></th>
		<th scope='col' class='manage-column column-email'><span>Браузер</span></th>	
		<th scope='col' class='manage-column column-email'><span>IP</span></th>
		<th scope='col' class='manage-column column-email'><span>Referer</span></th>
		<th scope='col' class='manage-column'><span>Автомат</span></th>
	</tr>
	</tfoot>

	<tbody id="the-list">
	
<?php
global $wpdb;
$sql = "SELECT * FROM ".$wpdb->prefix."fbp_link WHERE ttype=2 $where ORDER BY id DESC limit $inicio,$LIMIT_POSTS";
$poster = $wpdb->get_results($sql);
foreach ($poster as $partner) {

$user_info = get_userdata($partner->userid);
$user_login = $user_info->user_login;
$ip_br = get_usermeta($partner->userid, 'ip_br');

$sql = "SELECT name FROM ".$wpdb->prefix."forex_broker WHERE id='". $partner->tbroker ."'";
$pro = $wpdb->get_row($sql);
$name_obm = $pro->name;
?>	
<tr valign="top">
	<th scope="row" class="check-column"><input type="checkbox" name="click[]" class="check-col" value="<?php echo $partner->id;?>" /></th>
	<td><a href="user-edit.php?user_id=<?php echo $partner->userid;?>" title=""><?php echo $user_login;?></a></td>
	<td><?php echo date('d.m.Y H:i:s',$partner->tdate);?></td>
	<td><?php if($ip_br[0]==$partner->tbrowser){ echo '<span style="color: red;">'.$partner->tbrowser.'</span>'; } else {echo $partner->tbrowser; }?></td>
	<td><?php if($ip_br[1]==$partner->tip){ echo '<span style="color: red;">'.$partner->tip.'</span>'; } else {echo $partner->tip; }?></td>
	<td><?php echo $partner->trefer;?></td>
	<td><?php echo $name_obm;?></td>			
</tr>
<?php } ?>

		</tbody>
</table>


	<div class="tablenav bottom">

		<div class="alignleft actions">
            <select name='action2'>
                <option value='0' selected='selected'>Действия</option>
                <option value='pod1'>Удалить</option>
                <option value='pod2'>Не оплатить</option>
            </select>
            <input type="submit" name="go2" class="button-secondary action" value="Применить"  />
		</div>

        <div class='tablenav-pages'>
            <span class="displaying-num"><?php echo $kolvo;?> элементов</span>
            <a class='first-page <?php if($pagina==1){?>disabled<?php }?>' title='Перейти на первую страницу' href='admin.php?page=forexbox/partner.php&mypage=clicks&user=<?php echo $usario;?>'>&laquo;</a>
            <a class='prev-page <?php if($pagina==1){?>disabled<?php }?>' title='Перейти на предыдущую страницу' href='admin.php?page=forexbox/partner.php&mypage=clicks&user=<?php echo $usario;?>&str=<?php echo $fos;?>'>&lsaquo;</a>
            <span class="paging-input"><input class='current-page' title='Текущая страница' type='text' name='paged' value='<?php echo $pagina;?>' size='2' /> из <span class='total-pages'><?php echo $kol_str;?></span></span>
            <a class='next-page <?php if($pagina==$kol_str){?>disabled<?php }?>' title='Перейти на следующую страницу' href='admin.php?page=forexbox/partner.php&mypage=clicks&user=<?php echo $usario;?>&str=<?php echo $mos;?>'>&rsaquo;</a>
            <a class='last-page <?php if($pagina==$kol_str){?>disabled<?php }?>' title='Перейти на последнюю страницу' href='admin.php?page=forexbox/partner.php&mypage=clicks&user=<?php echo $usario;?>&str=<?php echo $kol_str;?>'>&raquo;</a>
        </div>
	
    <br class="clear" />
	</div>
</form>
<?php
}	
	
function fbp_partner_users(){
global $wpdb;
$sql = "SELECT DISTINCT ID FROM ".$wpdb->prefix."users LEFT OUTER JOIN ".$wpdb->prefix."usermeta ON (".$wpdb->prefix."users.ID = ".$wpdb->prefix."usermeta.user_id)";
$kolvo = $wpdb->query($sql); 

$status = intval($_GET['status']);
$asc = intval($_GET['asc']);
if(!$asc){
$by = 'DESC';
} else {
$by = 'ASC';
}

if($status==1){
$ord ="user_login";
} elseif($status==2){
$ord ="ID";
} elseif($status==3){
$ord ='user_email';
} elseif($status==4){
$ord ='(meta_value -0.0)';
$where ="WHERE meta_key='money' ";
} else {
$ord ="ID";
}

$LIMIT_POSTS = 50; 
$pagina = intval($_GET["str"]); 
if (!$pagina) { $inicio=0; $pagina=1;
} else {
    $inicio = ($pagina - 1) * $LIMIT_POSTS;
} 
$kolviv= $pagina * $LIMIT_POSTS; 
$kol_str = ceil($kolvo/$LIMIT_POSTS);
if($kol_str==$pagina){
$mos= $pagina;
} else {
$mos= $pagina + 1;
}
$fos= $pagina - 1; 
if(!$kol_str){ $kol_str = 1; }

?>
    <br class="clear" />
    <ul class='subsubsub'>
	    <li class='all'><a href='admin.php?page=forexbox/partner.php&mypage=users&status=<?php echo $status;?>' <?php if(!$asc){?>class="current"<?php }?>>Убывание</a> |</li>
	    <li class='publish'><a href='admin.php?page=forexbox/partner.php&mypage=users&status=<?php echo $status;?>&asc=1' <?php if($asc==1){?>class="current"<?php }?>>Возрастание</a></li>	
    </ul>

    <form action="<?php echo FBP_PLUGIN_URL;?>ajax/ppartners.php" method="post">

    <div class="tablenav top">

		<div class="alignleft actions">
            <select name='action'>
                <option value='0' selected='selected'>Действия</option>
                <option value='pod1'>Заблокировать</option>
                <option value='pod2'>Разблокировать</option>
            </select>
            <input type="submit" name="go" class="button-secondary action" value="Применить"  />
		</div>

        <div class='tablenav-pages'>
            <span class="displaying-num"><?php echo $kolvo;?> элементов</span>
            <a class='first-page <?php if($pagina==1){?>disabled<?php }?>' title='Перейти на первую страницу' href='admin.php?page=forexbox/partner.php&mypage=users&status=<?php echo $status;?>&asc=<?php echo $asc;?>'>&laquo;</a>
            <a class='prev-page <?php if($pagina==1){?>disabled<?php }?>' title='Перейти на предыдущую страницу' href='admin.php?page=forexbox/partner.php&mypage=users&status=<?php echo $status;?>&asc=<?php echo $asc;?>&str=<?php echo $fos;?>'>&lsaquo;</a>
            <span class="paging-input"><input class='current-page' title='Текущая страница' type='text' name='paged' value='<?php echo $pagina;?>' size='2' /> из <span class='total-pages'><?php echo $kol_str;?></span></span>
            <a class='next-page <?php if($pagina==$kol_str){?>disabled<?php }?>' title='Перейти на следующую страницу' href='admin.php?page=forexbox/partner.php&mypage=users&status=<?php echo $status;?>&asc=<?php echo $asc;?>&str=<?php echo $mos;?>'>&rsaquo;</a>
            <a class='last-page <?php if($pagina==$kol_str){?>disabled<?php }?>' title='Перейти на последнюю страницу' href='admin.php?page=forexbox/partner.php&mypage=users&status=<?php echo $status;?>&asc=<?php echo $asc;?>&str=<?php echo $kol_str;?>'>&raquo;</a>
        </div>
	
    <br class="clear" />
	</div>		


<table class="wp-list-table widefat fixed posts" cellspacing="0">
	<thead>
	<tr>
		<th scope='col' class='manage-column column-cb check-column'><input type="checkbox" class="ch" value="1"/></th>
		<th scope='col' class='manage-column column-email <?php if($status==1){?>sorted desc<?php }?>'><a href="admin.php?page=forexbox/partner.php&mypage=users&status=1&asc=<?php echo $asc;?>"><span>Логин</span><span class="sorting-indicator"></span></a></th>
		<th scope='col' class='manage-column column-email <?php if($status==2){?>sorted desc<?php }?>'><a href="admin.php?page=forexbox/partner.php&mypage=users&status=2&asc=<?php echo $asc;?>"><span>Дата регистрации</span><span class="sorting-indicator"></span></a></th>
		<th scope='col' class='manage-column column-email <?php if($status==3){?>sorted desc<?php }?>'><a href="admin.php?page=forexbox/partner.php&mypage=users&status=3&asc=<?php echo $asc;?>"><span>E-mail</span><span class="sorting-indicator"></span></a></th>	
		<th scope='col' class='manage-column column-email <?php if($status==4){?>sorted desc<?php }?>'><a href="admin.php?page=forexbox/partner.php&mypage=users&status=4&asc=<?php echo $asc;?>"><span>На счету</span><span class="sorting-indicator"></span></a></th>
		<th scope='col' class='manage-column column-email <?php if($status==4){?>sorted desc<?php }?>'><a href="admin.php?page=forexbox/partner.php&mypage=users&status=4&asc=<?php echo $asc;?>"><span>Доступно для снятия</span><span class="sorting-indicator"></span></a></th>
		<th scope='col' class='manage-column column-email sorted desc'><a href="#"><span>Заблокирован?</span></a></th>
	</tr>
	</thead>

	<tfoot>
	<tr>
		<th scope='col' class='manage-column column-cb check-column'><input type="checkbox" class="ch" value="1"/></th>
		<th scope='col' class='manage-column column-email <?php if($status==1){?>sorted desc<?php }?>'><a href="admin.php?page=forexbox/partner.php&mypage=users&status=1&asc=<?php echo $asc;?>"><span>Логин</span><span class="sorting-indicator"></span></a></th>
		<th scope='col' class='manage-column column-email <?php if($status==2){?>sorted desc<?php }?>'><a href="admin.php?page=forexbox/partner.php&mypage=users&status=2&asc=<?php echo $asc;?>"><span>Дата регистрации</span><span class="sorting-indicator"></span></a></th>
		<th scope='col' class='manage-column column-email <?php if($status==3){?>sorted desc<?php }?>'><a href="admin.php?page=forexbox/partner.php&mypage=users&status=3&asc=<?php echo $asc;?>"><span>E-mail</span><span class="sorting-indicator"></span></a></th>	
		<th scope='col' class='manage-column column-email <?php if($status==4){?>sorted desc<?php }?>'><a href="admin.php?page=forexbox/partner.php&mypage=users&status=4&asc=<?php echo $asc;?>"><span>На счету</span><span class="sorting-indicator"></span></a></th>
		<th scope='col' class='manage-column column-email <?php if($status==4){?>sorted desc<?php }?>'><a href="admin.php?page=forexbox/partner.php&mypage=users&status=4&asc=<?php echo $asc;?>"><span>Доступно для снятия</span><span class="sorting-indicator"></span></a></th>
		<th scope='col' class='manage-column column-email sorted desc'><a href="#"><span>Заблокирован?</span></a></th>
	</tr>
	</tfoot>

	<tbody id="the-list">
	
<?php
global $wpdb;
$sql = "SELECT DISTINCT ID FROM ".$wpdb->prefix."users LEFT OUTER JOIN ".$wpdb->prefix."usermeta ON (".$wpdb->prefix."users.ID = ".$wpdb->prefix."usermeta.user_id) $where ORDER BY $ord $by limit $inicio,$LIMIT_POSTS";
$poster = $wpdb->get_results($sql);
$gmt = get_option('gmt_offset');
$min = get_option('fbp_parners');
foreach ($poster as $partner) {

$user_info = get_userdata($partner->ID);
$date_regq = strtotime($user_info->user_registered) + $gmt * 60 * 60;
$date_regq = date('d.m.Y H:i',$date_regq);
$money = get_usermeta($partner->ID, 'money');
$bann = get_usermeta($partner->ID, 'banned');
if($money >= $min[0]){
$dv = $money;
} else {$dv = 0;}
?>	
<tr valign="top">
	<th scope="row" class="check-column"><input type="checkbox" name="user[]" class="check-col" value="<?php echo $partner->ID;?>" /></th>
	<td><strong><a href="user-edit.php?user_id=<?php echo $partner->ID;?>" title=""><?php echo $user_info->user_login;?></a></strong></td>
	<td><?php echo $date_regq;?></td>
	<td><?php echo $user_info->user_email;?></td>
	<td>$<?php echo $money; ?></td>
	<td>$<?php echo $dv; ?></td>
	<td><?php if($bann==2){?>Заблокирован<?php }?></td>					
</tr>
<?php }?>

		</tbody>
</table>




	<div class="tablenav bottom">

		<div class="alignleft actions">
            <select name='action2'>
                <option value='0' selected='selected'>Действия</option>
                <option value='pod1'>Заблокировать</option>
                <option value='pod2'>Разблокировать</option>
            </select>
            <input type="submit" name="go2" class="button-secondary action" value="Применить"  />
		</div>
		

        <div class='tablenav-pages'>
            <span class="displaying-num"><?php echo $kolvo;?> элементов</span>
            <a class='first-page <?php if($pagina==1){?>disabled<?php }?>' title='Перейти на первую страницу' href='admin.php?page=forexbox/partner.php&mypage=users&status=<?php echo $status;?>&asc=<?php echo $asc;?>'>&laquo;</a>
            <a class='prev-page <?php if($pagina==1){?>disabled<?php }?>' title='Перейти на предыдущую страницу' href='admin.php?page=forexbox/partner.php&mypage=users&status=<?php echo $status;?>&asc=<?php echo $asc;?>&str=<?php echo $fos;?>'>&lsaquo;</a>
            <span class="paging-input"><input class='current-page' title='Текущая страница' type='text' name='paged' value='<?php echo $pagina;?>' size='2' /> из <span class='total-pages'><?php echo $kol_str;?></span></span>
            <a class='next-page <?php if($pagina==$kol_str){?>disabled<?php }?>' title='Перейти на следующую страницу' href='admin.php?page=forexbox/partner.php&mypage=users&status=<?php echo $status;?>&asc=<?php echo $asc;?>&str=<?php echo $mos;?>'>&rsaquo;</a>
            <a class='last-page <?php if($pagina==$kol_str){?>disabled<?php }?>' title='Перейти на последнюю страницу' href='admin.php?page=forexbox/partner.php&mypage=users&status=<?php echo $status;?>&asc=<?php echo $asc;?>&str=<?php echo $kol_str;?>'>&raquo;</a>
        </div>
	
	
    <br class="clear" />
	</div>
	
	<br class="clear" />
    </form>

<?php
}	
	
	
function fbp_partner_payout(){
    global $wpdb;
    $sql = "SELECT * FROM ". $wpdb->prefix ."fbpwithdraw WHERE xstatus='1' ORDER BY payid desc";
    $poster = $wpdb->get_results($sql);
	
	if($_GET['filexmls']){ ?>
	<div class="class_sucess">
	    <a href="<?php echo FBP_PLUGIN_URL;?>xml/<?php echo $_GET['filexmls'];?>.xml">Скачать файл</a>
	</div>
	<?php } ?>
    <form method="post" action="<?php echo FBP_PLUGIN_URL;?>ajax/ppayout.php">
	
        <div class="">Партнерские выплаты производятся через сервис массовых платежей WebMoney - <a href="https://masspayment.wmtransfer.com" target="_blank" rel="nofollow">https://masspayment.wmtransfer.com</a>.<br/>
        С помощью меню выше, сгенерируйте XML-файл выплат, перейдите на <a href="https://masspayment.wmtransfer.com" target="_blank" rel="nofollow">https://masspayment.wmtransfer.com</a> и произведите выплату партнерам.
        </div>

        <div class="tablenav top">
	        <div class="alignleft actions">
                <select name='action'>
                    <option value='0' selected='selected'>Действия</option>
                    <option value='pod1'>Подтвердить выбранные</option>
                    <option value='pod2'>Отклонить выбранные</option>
                    <option value='pod3'>Скачать XML-файл с выбранными</option>
                </select>
            <input type="submit" name="go" class="button-secondary action" value="Применить"  />
		    </div>	
        <br class="clear" />
	    </div>

<table class="wp-list-table widefat fixed posts" cellspacing="0">
	<thead>
	<tr>
		<th scope='col' class='manage-column column-cb check-column'><input type="checkbox" class="ch" value="1"/></th>
		<th scope='col' class='manage-column column-title' ><span>№</span></th>
		<th scope='col' class='manage-column' >Дата</th>
		<th scope='col' class='manage-column' >Пользователь</th>
		<th scope='col' class='manage-column' >Сумма</th>
		<th scope='col' class='manage-column' >Баланс</th>
		<th scope='col' class='manage-column' >Кошелёк</th>
		<th scope='col' class='manage-column' >Клики</th>
		<th scope='col' class='manage-column' >Комментарий</th>
	</tr>
	</thead>
	<tfoot>
	<tr>
		<th scope='col' class='manage-column column-cb check-column'><input type="checkbox" class="ch" value="1"/></th>
		<th scope='col' class='manage-column column-title' ><span>№</span></th>
		<th scope='col' class='manage-column' >Дата</th>
		<th scope='col' class='manage-column' >Пользователь</th>
		<th scope='col' class='manage-column' >Сумма</th>
		<th scope='col' class='manage-column' >Баланс</th>
		<th scope='col' class='manage-column' >Кошелёк</th>
		<th scope='col' class='manage-column' >Клики</th>
		<th scope='col' class='manage-column' >Комментарий</th>
	</tr>
	</tfoot>

	<tbody id="the-list">

<?php
foreach ($poster as $viplata) {
	$user_info = get_userdata($viplata->userid);
	$wmz = get_usermeta($viplata->userid, 'wmz');
	$money = get_usermeta($viplata->userid, 'money');
?>
	
<tr valign="top" class="friend">
	
	<th scope="row" class="check-column">
	<input type="checkbox" name="post[]" class="check-col" value="<?php echo $viplata->payid;?>" />
	</th>
	<td class="post-title page-title column-title">
	<strong><?php echo $viplata->payid;?></strong>
	</td>
    <td><?php echo date('d.m.Y H:i', $viplata->xtime);?></td>
	<td><?php echo $user_Login = $user_info->user_login; ?></td>
	<td>$<?php echo $viplata->amount;?></td>
	<td>$<?php echo $money;?></td>
	<td><?php echo $wmz;?></td>
	<td><a href="admin.php?page=forexbox/partner.php&mypage=clicks&user=<?php echo $viplata->userid;?>" target="_blank">Клики</a></td>
	<td><textarea name="text<?php echo $viplata->payid;?>" class="comment z-<?php echo $viplata->payid;?>"><?php echo $viplata->xcomment;?></textarea></td>
	
</tr>
<?php }?>
	</tbody>
</table>
<div class="textarea_show">
<div class="textarea_okno">
<div class="caplagin_close">Закрыть</div>
<p>Комментарий:</p>
<p><textarea style="width:100%; height: 70px;" class="vs_okno"></textarea></p>
<p><input type="submit" name="go_okno" value="Сохранить" /></p>
<input type="hidden" name="hide_id" value="" />
</div>
</div>
<script type="text/javascript">
$(function() {

$("textarea.comment").click(function() {
var ster = $(this).attr('value');
var id = $(this).parents('tr').find('input.check-col').attr('value');
$('.textarea_show').show();
$('textarea.vs_okno').attr('value',ster);
$('input[name=hide_id]').attr('value',id);
return false;
});
$(".caplagin_close").click(function() {
$('.textarea_show').hide();
return false;
});
$("input[name=go_okno]").click(function() {
var val = $('.vs_okno').attr('value');
var id = $('input[name=hide_id]').attr('value');
$('.z-'+ id).attr('value',val);
$('.textarea_show').hide();
return false;
});

});
</script>

</form>
    <?php
}	
	
function fbp_partner_banner(){

	$text = get_option('fbp_texts_material');
	$banner468 = get_option('fbp_banner_468');
	$banner100 = get_option('fbp_banner_100');
	$banner88 = get_option('fbp_banner_88');
	$banner120 = get_option('fbp_banner_120');
	$banner200 = get_option('fbp_banner_200');	
?>	
<div class="metabox-holder">

<div class="postbox">
<h3 class='hndle'><span>Шорткоды</span></h3>
<div class="inside">
    <p><input type="text" name="" value="[partner_link]" onclick="this.select()" /> - Партнёрская ссылка</p>
    <p><input type="text" name="" value="[url]" onclick="this.select()" /> - Адрес сайта</p>
</div>
</div>

<br class="clear" />
</div>

<form action="<?php echo FBP_PLUGIN_URL;?>/ajax/pbanner.php" method="post" >

    <div class="metabox-holder">
        <div class="postbox">
            <h3 class='hndle'><span>Тексты</span></h3>
        <div class="inside">
        <?php 
        if(is_array($text)){
            foreach($text as $text1){
            if($text1){ ?>
        <div class="text1">
            <p>Текст: <a href="#" class="plm oapminus">[ - ]</a> <a href="#" class="plm oapplus">[ + ]</a><br />
            <textarea name="text1[]" style="width: 100%; height: 140px;"><?php echo $text1;?></textarea></p>
        </div>
        <?php }}}?>
        <div class="text1">
        <p>Текст: <a href="#" class="plm oapminus">[ - ]</a> <a href="#" class="plm oapplus">[ + ]</a><br />
        <textarea name="text1[]" style="width: 100%; height: 140px;"></textarea></p>
        </div>

        <p><input type="submit" name="go" class="button-secondary action" value="Сохранить"  /></p>

<script type="text/javascript">
$(function(){
    $(".plm").live('click',function() {
        var lon = $('.text1').length;
        if($(this).hasClass('oapplus')){
            $('.text1:last').after('<div class="text1"><p>Текст: <a href="#" class="plm oapminus">[ - ]</a> <a href="#" class="plm oapplus">[ + ]</a><br /><textarea name="text1[]" style="width: 100%; height: 140px;"></textarea></p></div>');
        } else {
        if(lon > 1){
            $(this).parents('.text1').remove();
        }
        }
        return false;
    });
});
</script>

        </div>
        </div>
    <br class="clear" />
    </div>

    <div class="metabox-holder">
        <div class="postbox">
            <h3 class='hndle'><span>Баннер (468 на 60)</span></h3>
        <div class="inside">
        <?php 
        if(is_array($banner468)){
            foreach($banner468 as $text1){
            if($text1){ ?>
        <div class="text2">
            <p>Код баннера: <a href="#" class="plm2 oapminus">[ - ]</a> <a href="#" class="plm2 oapplus">[ + ]</a><br />
            <textarea name="text2[]" style="width: 100%; height: 140px;"><?php echo $text1;?></textarea></p>
        </div>
        <?php }}}?>
        <div class="text2">
        <p>Код баннера: <a href="#" class="plm2 oapminus">[ - ]</a> <a href="#" class="plm2 oapplus">[ + ]</a><br />
        <textarea name="text2[]" style="width: 100%; height: 140px;"></textarea></p>
        </div>

        <p><input type="submit" name="go" class="button-secondary action" value="Сохранить"  /></p>

<script type="text/javascript">
$(function(){
    $(".plm2").live('click',function() {
        var lon = $('.text2').length;
        if($(this).hasClass('oapplus')){
            $('.text2:last').after('<div class="text2"><p>Код баннеры: <a href="#" class="plm2 oapminus">[ - ]</a> <a href="#" class="plm2 oapplus">[ + ]</a><br /><textarea name="text2[]" style="width: 100%; height: 140px;"></textarea></p></div>');
        } else {
        if(lon > 1){
            $(this).parents('.text2').remove();
        }
        }
        return false;
    });
});
</script>

        </div>
        </div>
    <br class="clear" />
    </div>

    <div class="metabox-holder">
        <div class="postbox">
            <h3 class='hndle'><span>Баннер (200 на 200)</span></h3>
        <div class="inside">
        <?php 
        if(is_array($banner200)){
            foreach($banner200 as $text1){
            if($text1){ ?>
        <div class="text3">
            <p>Код баннера: <a href="#" class="plm3 oapminus">[ - ]</a> <a href="#" class="plm3 oapplus">[ + ]</a><br />
            <textarea name="text3[]" style="width: 100%; height: 140px;"><?php echo $text1;?></textarea></p>
        </div>
        <?php }}}?>
        <div class="text3">
        <p>Код баннера: <a href="#" class="plm3 oapminus">[ - ]</a> <a href="#" class="plm3 oapplus">[ + ]</a><br />
        <textarea name="text3[]" style="width: 100%; height: 140px;"></textarea></p>
        </div>

        <p><input type="submit" name="go" class="button-secondary action" value="Сохранить"  /></p>

<script type="text/javascript">
$(function(){
    $(".plm3").live('click',function() {
        var lon = $('.text3').length;
        if($(this).hasClass('oapplus')){
            $('.text3:last').after('<div class="text3"><p>Код баннеры: <a href="#" class="plm3 oapminus">[ - ]</a> <a href="#" class="plm3 oapplus">[ + ]</a><br /><textarea name="text3[]" style="width: 100%; height: 140px;"></textarea></p></div>');
        } else {
        if(lon > 1){
            $(this).parents('.text3').remove();
        }
        }
        return false;
    });
});
</script>

        </div>
        </div>
    <br class="clear" />
    </div>	
	
    <div class="metabox-holder">
        <div class="postbox">
            <h3 class='hndle'><span>Баннер (120 на 600)</span></h3>
        <div class="inside">
        <?php 
        if(is_array($banner120)){
            foreach($banner120 as $text1){
            if($text1){ ?>
        <div class="text4">
            <p>Код баннера: <a href="#" class="plm4 oapminus">[ - ]</a> <a href="#" class="plm4 oapplus">[ + ]</a><br />
            <textarea name="text4[]" style="width: 100%; height: 140px;"><?php echo $text1;?></textarea></p>
        </div>
        <?php }}}?>
        <div class="text4">
        <p>Код баннера: <a href="#" class="plm4 oapminus">[ - ]</a> <a href="#" class="plm4 oapplus">[ + ]</a><br />
        <textarea name="text4[]" style="width: 100%; height: 140px;"></textarea></p>
        </div>

        <p><input type="submit" name="go" class="button-secondary action" value="Сохранить"  /></p>

<script type="text/javascript">
$(function(){
    $(".plm4").live('click',function() {
        var lon = $('.text4').length;
        if($(this).hasClass('oapplus')){
            $('.text4:last').after('<div class="text4"><p>Код баннеры: <a href="#" class="plm4 oapminus">[ - ]</a> <a href="#" class="plm4 oapplus">[ + ]</a><br /><textarea name="text4[]" style="width: 100%; height: 140px;"></textarea></p></div>');
        } else {
        if(lon > 1){
            $(this).parents('.text4').remove();
        }
        }
        return false;
    });
});
</script>

        </div>
        </div>
    <br class="clear" />
    </div>

    <div class="metabox-holder">
        <div class="postbox">
            <h3 class='hndle'><span>Баннер (100 на 100)</span></h3>
        <div class="inside">
        <?php 
        if(is_array($banner100)){
            foreach($banner100 as $text1){
            if($text1){ ?>
        <div class="text5">
            <p>Код баннера: <a href="#" class="plm5 oapminus">[ - ]</a> <a href="#" class="plm5 oapplus">[ + ]</a><br />
            <textarea name="text5[]" style="width: 100%; height: 140px;"><?php echo $text1;?></textarea></p>
        </div>
        <?php }}}?>
        <div class="text5">
        <p>Код баннера: <a href="#" class="plm5 oapminus">[ - ]</a> <a href="#" class="plm5 oapplus">[ + ]</a><br />
        <textarea name="text5[]" style="width: 100%; height: 140px;"></textarea></p>
        </div>

        <p><input type="submit" name="go" class="button-secondary action" value="Сохранить"  /></p>

<script type="text/javascript">
$(function(){
    $(".plm5").live('click',function() {
        var lon = $('.text5').length;
        if($(this).hasClass('oapplus')){
            $('.text5:last').after('<div class="text5"><p>Код баннеры: <a href="#" class="plm5 oapminus">[ - ]</a> <a href="#" class="plm5 oapplus">[ + ]</a><br /><textarea name="text5[]" style="width: 100%; height: 140px;"></textarea></p></div>');
        } else {
        if(lon > 1){
            $(this).parents('.text5').remove();
        }
        }
        return false;
    });
});
</script>

        </div>
        </div>
    <br class="clear" />
    </div>

    <div class="metabox-holder">
        <div class="postbox">
            <h3 class='hndle'><span>Баннер (88 на 31)</span></h3>
        <div class="inside">
        <?php 
        if(is_array($banner88)){
            foreach($banner88 as $text1){
            if($text1){ ?>
        <div class="text6">
            <p>Код баннера: <a href="#" class="plm6 oapminus">[ - ]</a> <a href="#" class="plm6 oapplus">[ + ]</a><br />
            <textarea name="text6[]" style="width: 100%; height: 140px;"><?php echo $text1;?></textarea></p>
        </div>
        <?php }}}?>
        <div class="text6">
        <p>Код баннера: <a href="#" class="plm6 oapminus">[ - ]</a> <a href="#" class="plm6 oapplus">[ + ]</a><br />
        <textarea name="text6[]" style="width: 100%; height: 140px;"></textarea></p>
        </div>

        <p><input type="submit" name="go" class="button-secondary action" value="Сохранить"  /></p>

<script type="text/javascript">
$(function(){
    $(".plm6").live('click',function() {
        var lon = $('.text6').length;
        if($(this).hasClass('oapplus')){
            $('.text6:last').after('<div class="text6"><p>Код баннеры: <a href="#" class="plm6 oapminus">[ - ]</a> <a href="#" class="plm6 oapplus">[ + ]</a><br /><textarea name="text6[]" style="width: 100%; height: 140px;"></textarea></p></div>');
        } else {
        if(lon > 1){
            $(this).parents('.text6').remove();
        }
        }
        return false;
    });
});
</script>

        </div>
        </div>
    <br class="clear" />
    </div>	
	
</form>
<?php
}

function fpb_partner_change(){

$change = get_option('fbp_parners');
?>
<form action="<?php echo FBP_PLUGIN_URL;?>/ajax/pchange.php" method="post" >

<div class="metabox-holder">

<div class="postbox" >
<h3 class='hndle'><span>Настройки</span></h3>
<div class="inside">
<p>Минимальная выплата:<br />
<input type="text" name="min_r" value="<?php echo $change[0];?>" autocomplete="off" /> WMZ</p>

<p>Цена заинтересованного клика:<br />
<input type="text" name="cena_r" value="<?php echo $change[1];?>" autocomplete="off" /> $</p>

<p><input type="submit" name="go" class="button-secondary action" value="Сохранить"  /></p>

</div>
</div>

<br class="clear" />
</div>

</form>
<?php

}	
	
?>