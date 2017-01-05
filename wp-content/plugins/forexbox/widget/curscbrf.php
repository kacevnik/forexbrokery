<?php
class fbp_curscbrf_Widget extends WP_Widget {
	
	public function __construct($id_base = false, $widget_options = array(), $control_options = array()){
		parent::__construct('fbp_cursrf', 'Курс ЦБ РФ FB', $widget_options = array(), $control_options = array());
	}
	
	public function widget($args, $instance){
		extract($args);


	$title = ($instance['title'] !== null && $instance['title'] != '')? $instance['title'] : 'Курсы обмена валют ЦБ РФ'; 

	$cources = get_option('fbp_curs');	
	
	$usdr = $cources['tommorow_usd'] - $cources['now_usd'];
	$eurr = $cources['tommorow_eur'] - $cources['now_eur'];
		
	$usd_str = ($usdr > 0)?'up':'dn';
	$eur_str = ($eurr > 0)?'up':'dn';	
?>

<div class="fbp_widget">
    <div class="fbp_widget_title">
	    <?php echo $title; ?>
	</div>

	<div class="fbp_widget_content">
	<table cellpadding="0" cellspacing="0" width="100%" class="fbp_widget_table">
		<tr>
			<th>&nbsp;</th>
			<th align="center">Сегодня</th>
			<th align="center">Завтра</th>
			<th align="center">&nbsp;</th>
		</tr>
		<tr>
			<th>USD</th>
			<td align="center"><?php echo number_format((double)$cources['now_usd'], 2); ?></td>
			<td align="center"><?php echo number_format((double)$cources['tommorow_usd'], 2); ?></td>
			<td align="center"><img alt="<?php echo '' . $usd_str . ' ' . $usdr; ?>" src="<?php echo FBP_PLUGIN_URL; ?>images/icon_<?php echo $usd_str; ?>.gif"></td>
		</tr>
		<tr>
			<th>EUR</th>
			<td align="center"><?php echo number_format((double)$cources['now_eur'], 2); ?></td>
			<td align="center"><?php echo number_format((double)$cources['tommorow_eur'], 2); ?></td>
			<td align="center"><img alt="<?php echo '' . $eur_str . ' ' . $eurr; ?>" src="<?php echo FBP_PLUGIN_URL; ?>images/icon_<?php echo $eur_str; ?>.gif"></td>
		</tr>
	</table>
	</div>
</div>

<?php

	}

public function form($instance){
?>
<p>
<label for="<?php echo $this->get_field_id('title'); ?>">Заголовок: </label><br />
<input type="text" name="<?php echo $this->get_field_name('title'); ?>" class="widefat" id="<?php $this->get_field_id('title'); ?>" value="<?php echo $instance['title']; ?>">
</p>
<?php
}
	
}

register_widget('fbp_curscbrf_Widget');

?>