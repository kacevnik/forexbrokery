<?php
class fbp_register_Widget extends WP_Widget {
	
	public function __construct($id_base = false, $widget_options = array(), $control_options = array()){
		parent::__construct('fbp_register', 'Регистрация FB', $widget_options = array(), $control_options = array());
	}
	
	public function widget($args, $instance){
		extract($args);

	global $user_ID;	

    $title = ($instance['title'] !== null && $instance['title'] != '')? $instance['title'] : 'Регистрация';

	if(!$user_ID){ 
	$pages = get_option('fbp_pages');
	if(!is_page($pages['fbpterms'])){
?>
<div class="fbp_widget">
    <div class="fbp_widget_title">
	    <?php echo $title; ?>
	</div>
	
	<div id="fbp_reg_otvet"></div>
	
	<div class="fbp_widget_content">
	    <form action="<?php echo FBP_PLUGIN_URL;?>ajax/register.php" id="fbp_register" method="post">
	        <table cellpadding="0" cellspacing="0" width="100%" class="fbp_widget_table">
			<tr>
				<th class="fth">
					Логин:
				</th>	
                <td>
                    <input type="text" name="rlog" value="" autocomplete="off" class="fbp_input" />
                </td>						
			</tr>
			<tr>
				<th class="fth">
					Пароль:
				</th>	
                <td>
                    <input type="text" name="rpwd" autocomplete="off" value="" class="fbp_input" />
                </td>							
			</tr>
			<tr>
				<th class="fth">
					Пароль повторно:
				</th>	
                <td>
                    <input type="text" name="rpwd2" autocomplete="off" value="" class="fbp_input" />
                </td>						
			</tr>
			<tr>
				<th class="fth">
					E-mail:
				</th>	
                <td>
                    <input type="text" name="rmail" autocomplete="off" value="" class="fbp_input" />
                </td>						
			</tr>
			 
			<tr>
			    <th>
				&nbsp;
				</th>			
				<td style="text-align: left; font-size: 10px;">
					<label><input type="checkbox" name="rcheck" autocomplete="off" value="1" class="fbp_checkbox" /> Я принимаю <a href="<?php echo get_permalink($pages['fbpterms']);?>" target="_blank">условия</a></label>
				</td>						
			</tr>		
			<tr>
			    <th>
				<div class="fbp_relative">
				    <div id="fbp_register_ajax" class="fbp_ajax"></div>
				</div>
				</th>
				<td style="text-align: left;">
				    <input type="submit" id="fbp_register_button" class="fbp_submit" value="Регистрация" />				
				</td>
			</tr>			
			
	        </table>
	    </form>
	</div>

</div>
<?php
		}
		}	
		
	}

public function form($instance){
?>
<p>
<label for="<?php echo $this->get_field_id('title'); ?>">Заголовок: </label><br />
<input type="text" name="<?php echo $this->get_field_name('title'); ?>" id="<?php $this->get_field_id('title'); ?>" class="widefat" value="<?php echo $instance['title']; ?>">
</p>
<?php
}
	
}

register_widget('fbp_register_Widget');

?>