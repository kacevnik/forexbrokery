<?php
class fbp_search_Widget extends WP_Widget {
	
	public function __construct($id_base = false, $widget_options = array(), $control_options = array()){
		parent::__construct('fbp_search', 'Поиск устаников FB', $widget_options = array(), $control_options = array());
	}
	
	public function widget($args, $instance){
		extract($args);
		$pages = get_option('fbp_pages');
		$link = get_permalink($pages['fbpsearch']);
?>
    <form action="<?php echo $link;?>" method="get">
	    <div class="fbp_searchform">
	        <input type="text" class="fbpsinput" id="fbpsinput" name="fbs" value="<?php echo $_GET['fbs'];?>" /> 
	        <input type="submit" class="fbpssubmit" name="" value=" " />
	
	    <div id="fbpajaxform"></div>
			
        </div>
    </form>
<?php
	}
	
}

register_widget('fbp_search_Widget');

?>