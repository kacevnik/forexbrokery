<?php
if( !defined( 'ABSPATH')){ exit(); }
fbp_template('infoblock');
global $fbp_fmenu;
?>

    </div>
	
	<div id="forexboxfooter">
        <div class="fbp_fleft">
		    &copy; <?php echo fbp_date('2012');?>  <a href="http://best-curs.info">Best-curs.info</a> - Готовые решения для создания собственного интернет бизнеса.
		</div>
        <div class="fbp_fright">
		    <?php if(is_array($fbp_fmenu)){ ?>
		    <ul>
			    <?php foreach($fbp_fmenu as $key => $value){ ?>
			    <li><a href="<?php echo $value;?>"><?php echo $key;?></a></li>
				<?php } ?>
			</ul>
			<?php } ?>
		</div>		
		<div class="fbp_clear"></div>
	</div>
	
</div>
	
</div>

    <div id="fbp_update_info">
	    <div class="fbp_update_info">
		    <div class="fbp_update_close"></div>
		    <div class="fbp_update_head"><div class="fbp_uhv1"><div class="fbp_uhv2">Обновления:</div><div class="fbp_clear"></div></div><div class="fbp_clear"></div></div>
			<div class="fbp_update_text" id="fbp_uptext">
                <?php if(fbp_has_new()){ 
				echo apply_filters('the_content', fbp_update_text());
				} else { ?>
				Обновлений нет :(
				<?php } ?>
			</div>
		</div>
	</div>
<script type="text/javascript">
$(function(){		
    $('.fvp_version, #fbp_has_update').click(function(){
		var hh = $(window).height();
	    var ww = $(window).width();
	    var hh1 = (hh - $('#fbp_update_info').height()) / 2;
		var ww1 = (ww - $('#fbp_update_info').width()) / 2;
	    $('#fbp_update_info').css({'top': hh1,'left': ww1}).show();
	    return false;
	});
    $('.fbp_update_close').click(function(){
	    $('#fbp_update_info').hide();
	    return false;
	});	
});
</script>