<?php
class toplider_Widget extends WP_Widget {
	
	public function __construct($id_base = false, $widget_options = array(), $control_options = array()){
		parent::__construct('toplider_info', 'ТОП участников FB', $widget_options = array(), $control_options = array());
	}
	
	public function widget($args, $instance){
		extract($args);


	$title = ($instance['title'] !== null && $instance['title'] != '')? $instance['title'] : 'ТОП участников'; 
    $count = intval($instance['count']);
	if(!$count){ $count=5; }
	$chto = intval($instance['chto']);
	if(!$chto){ $chto=1; }
	if($chto==1){ $cl='topedd'; $cl2='act'; $asc='desc'; } else { $cl2='act2'; $asc='asc'; }
	
	global $wpdb;
	$fbs = $wpdb->get_results("SELECT * FROM ". $wpdb->prefix ."forex_broker WHERE disablertrue='1' AND fvkl='1' ORDER BY (frating -0.0) $asc LIMIT $count");
?>

<div class="fbp_widget">
    <div class="fbpt_title"><?php echo $title;?></div>
    <div class="fbpt_toptable <?php echo $cl;?>">
	    <div class="fbptone">
		№
		</div>
	    <div class="fbpttwo">
		Название
		</div>
	    <div class="fbptree">
		Рейтинг
		</div>		
		<div class="fbp_clear"></div>
	</div>
	
	<?php $r=0; foreach($fbs as $fb){ $r++; 
	if($fb->flogo){ $im = $fb->flogo; } else { $im = FBP_PLUGIN_URL.'images/standart.png';}
	$cc = get_fbp_your_rating($fb->id);
	if($r==$count){ $cl3=$cl2; } else { $cl3=''; }
	?>
        <div class="fbpt_centable <?php echo $cl3;?>">
	        <div class="fbptone2">
		       <strong><?php echo $r;?></strong>
		    </div>
	        <div class="fbpttwo2">
		       <a href="<?php echo fbp_one_link($fb->fslug);?>" ><img src="<?php echo $im;?>" alt="" /></a>
			   <div class="fbptstitle"><a href="<?php echo fbp_one_link($fb->fslug);?>" ><?php echo $fb->fname;?></a></div>
		    </div>
	        <div class="fbptree2">
			    <div class="fbprating" name="<?php echo $fb->id;?>">
				<?php if($cc > 0){ ?>
				<div class="fbpsmall">голос учтён</div>
				<?php } else { ?>
		        <div class="fbp_rating"><div class="fbp_rating_act"></div>
			        <ul>
					    <li title="1"></li><li title="2"></li><li title="3"></li><li title="4"></li><li title="5"></li>
						<div class="fbp_clear"></div>
					</ul>
			    </div>
				<?php } ?>
				<div class="fbp_rat_result"><?php echo $fb->frating;?></div>
				</div>
		    </div>		
		    <div class="fbp_clear"></div>
	    </div>	
    <?php } ?>
		
</div>

<?php

	}

public function form($instance){
?>
<p>
<label for="<?php echo $this->get_field_id('title'); ?>">Заголовок: </label><br />
<input type="text" name="<?php echo $this->get_field_name('title'); ?>" class="widefat" id="<?php $this->get_field_id('title'); ?>" value="<?php echo $instance['title']; ?>">
</p>
<p>
<label for="<?php echo $this->get_field_id('chto'); ?>">Выводить: </label><br />
<select name="<?php echo $this->get_field_name('chto'); ?>" id="<?php $this->get_field_id('chto'); ?>">
<option value="1" >Лидеров</option>
<option value="2" <?php if($instance['chto']==2){?>selected="selected"<?php }?>>Аутсайдеров</option>
</select>
</p>
<p>
<label for="<?php echo $this->get_field_id('count'); ?>">Количество: </label><br />
<input type="text" name="<?php echo $this->get_field_name('count'); ?>" class="widefat" id="<?php $this->get_field_id('count'); ?>" value="<?php echo $instance['count']; ?>">
</p>

<?php
}
	
}

register_widget('toplider_Widget');

?>