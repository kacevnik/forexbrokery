<?php
class sravni_Widget extends WP_Widget {
	
	public function __construct($id_base = false, $widget_options = array(), $control_options = array()){
		parent::__construct('sravni_info', 'Список сравнения FB', $widget_options = array(), $control_options = array());
	}
	
	public function widget($args, $instance){
		extract($args);


	$title = ($instance['title'] !== null && $instance['title'] != '')? $instance['title'] : 'Список сравнения'; 
	
?>
<div id="fbp_the_sravni">
    <?php echo get_fbp_sravni_widget();?>
</div>

<?php

	}
	
}

register_widget('sravni_Widget');

?>