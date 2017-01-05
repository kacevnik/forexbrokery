<?php
class fbp_info_Widget extends WP_Widget {
	
	public function __construct($id_base = false, $widget_options = array(), $control_options = array()){
		parent::__construct('fbp_info', 'Информация FB', $widget_options = array(), $control_options = array());
	}
	
	public function widget($args, $instance){
		extract($args);


	$title = ($instance['title'] !== null && $instance['title'] != '')? $instance['title'] : 'Информация'; 

	global $wpdb;
    $date = current_time('mysql');
	$seg = date('Y-m-d 00:00:00', strtotime('+4 hours'));
	$countfb = $wpdb->query("SELECT id FROM ". $wpdb->prefix ."forex_broker WHERE disablertrue='1' AND fvkl='1'");
	$countot = $wpdb->query("SELECT id FROM ". $wpdb->prefix ."fbp_comments WHERE cactive='1'");
	$countots = $wpdb->query("SELECT id FROM ". $wpdb->prefix ."fbp_comments WHERE cactive='1' AND cdate > '$seg'");
    	
?>

<div class="fbp_widget">
    <div class="fbp_widget_title">
	    <?php echo $title; ?>
	</div>

	<div class="fbp_widget_content">
	<table cellpadding="0" cellspacing="0" width="100%" class="fbp_widget_table">
		<tr>
			<th>Сегодня: </th>
			<td align="center"><?php echo get_fbp_time($date); ?></td>
		</tr>
		<tr>
			<th>Сайтов: </th>
			<td align="center"><?php echo $countfb; ?></td>
		</tr>
		<tr>
			<th>Отзывов: </th>
			<td align="center"><?php echo $countot; ?></td>
		</tr>
		<tr>
			<th>Отзывов сегодня: </th>
			<td align="center"><?php echo $countots; ?></td>
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

register_widget('fbp_info_Widget');

?>