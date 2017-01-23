<?php
if( !defined( 'ABSPATH')){ exit(); }
$fc = get_option('fbp_config');
?>

<form action="<?php echo FBP_PLUGIN_URL;?>ajax/config.php" method="POST">
<div class="addeditform">
    <table cellpadding="0" cellspacing="0" width="100%">
	    <?php
		    forexbox_text('ftextdo','Текст до таблицы',$fc['do']);
			forexbox_text('ftextot','Текст после таблицы',$fc['ot']);
			forexbox_input('fcountvn','Количество отзывов на внутренней ',$fc['countvn']);
			forexbox_select('loginrating','Выставлять рейтинг',array('false'=>'Разрешено всем','true'=>'Только для зарегистрированных'),$fc['loginrating']);
			forexbox_select('logincomment','Оставлять отзывы и комментарии',array('false'=>'Разрешено всем','true'=>'Только для зарегистрированных'),$fc['logincomment']);
		    //forexbox_uploader('flogo','Логотип',$fbp->flogo);
		    //forexbox_inputbig('fname','Название',$fbp->fname);
			//forexbox_select('fstatus','Статус',array('0'=>'нет','1'=>'новый','2'=>'рекомендуемый'),$fbp->fstatus);
			//forexbox_select_god('fgod','Год основания',$fbp->fgod);
			//forexbox_input('fminschet','Минимальны размер счета ',$fbp->fminschet);
		?>
		<tr colspan="2">
			<th></th>
			<td style="font-size: 16px; font-weight: bold;">Настройки фильтрации:</td>
		</tr>
		<?php
			forexbox_input('fb_max_cr_plecho_min','Максимальное кредитное плечо (min) ',$fc['fb_max_cr_plecho_min']);
			forexbox_input('fb_max_cr_plecho_max','Максимальное кредитное плечо (max) ',$fc['fb_max_cr_plecho_max']);
			forexbox_input('fb_max_cr_plecho_step','Максимальное кредитное плечо (шаг) ',$fc['fb_max_cr_plecho_step']);
			forexbox_input('fb_max_cr_plecho_first','Максимальное кредитное плечо (начальное значение) ',$fc['fb_max_cr_plecho_first']);
		?>
		<tr>
			<th><br></th>
			<td></td>
		</tr>
		<?php
			forexbox_input('fb_min_depozit_min','Минимальный депозит (min) ',$fc['fb_min_depozit_min']);
			forexbox_input('fb_min_depozit_max','Минимальный депозит (max) ',$fc['fb_min_depozit_max']);
			forexbox_input('fb_min_depozit_step','Минимальный депозит (шаг) ',$fc['fb_min_depozit_step']);
			forexbox_input('fb_min_depozit_first','Минимальный депозит (начальное значение) ',$fc['fb_min_depozit_first']);
		?>

		<tr>
			<th><br></th>
			<td></td>
		</tr>
		<?php
			forexbox_input('fb_min_spred_min','Минимальный спред (min) ',$fc['fb_min_spred_min']);
			forexbox_input('fb_min_spred_max','Минимальный спред (max) ',$fc['fb_min_spred_max']);
			forexbox_input('fb_min_spred_step','Минимальный спред (шаг) ',$fc['fb_min_spred_step']);
			forexbox_input('fb_min_spred_first','Минимальный спред (начальное значение) ',$fc['fb_min_spred_first']);
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