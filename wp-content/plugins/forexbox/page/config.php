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
        <tr>
		    <th>
			    &nbsp;
			</th>
	        <td><input type="submit" class="button" value="Сохранить" name="add" /></td>
	    </tr>		
	</table>
</div>
</form>