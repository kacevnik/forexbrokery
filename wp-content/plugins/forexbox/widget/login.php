<?php
class fbp_login_Widget extends WP_Widget {
	
	public function __construct($id_base = false, $widget_options = array(), $control_options = array()){
		parent::__construct('fbp_login', 'Авторизация / Меню FB', $widget_options = array(), $control_options = array());
	}
	
	public function widget($args, $instance){
		extract($args);

	global $user_ID;	
    if(!$user_ID){
    $title = ($instance['title'] !== null && $instance['title'] != '')? $instance['title'] : 'Авторизация';
    } else {
	$title = ($instance['title_r'] !== null && $instance['title_r'] != '')? $instance['title_r'] : 'Навигация';
	} 
	$pages = get_option('fbp_pages');
?>
        <?php if($user_ID){ ?>
<div class="fbp_widget">
    <div class="fbp_widget_title">
	    <?php echo $title; ?>
	</div>

	<div id="fbp_log_otvet"></div>
	
	<div class="fbp_widget_content">
		
        <ul>
	        
	        <li><a href="<?php echo wp_logout_url(get_bloginfo('url'));?>" >Выход</a></li>
	    </ul>
		
    </div>	

</div>		

		<?php } elseif(!$user_ID and !is_page($pages['fbppartners'])) { ?>

<div class="fbp_widget">
    <div class="fbp_widget_title">
	    <?php echo $title; ?>
	</div>

	<div id="fbp_log_otvet"></div>
	
	<div class="fbp_widget_content">		
		
	    <form action="<?php echo FBP_PLUGIN_URL;?>ajax/login.php" id="fbp_login" method="post">
		    <table cellspacing="0" cellpadding="0" width="100%" class="fbp_widget_table" >
			<tr>
				<th class="fth">
					Логин:
				</th>	
                <td>
                    <input type="text" name="log" value="" autocomplete="off" class="fbp_input" />
                </td>					
			</tr>
			<tr>
				<th class="fth">
					Пароль:
				</th>	
                <td>
                    <input type="password" name="pwd" autocomplete="off" value="" class="fbp_input" />
                </td>					
			</tr>						
			<tr>
			    <th class="fth">
				<div class="fbp_relative">
				    <div id="fbp_login_ajax" class="fbp_ajax"></div>
				</div>
				</th>
				<td style="text-align: left;">
				<input type="submit" id="fbp_login_button" class="fbp_submit" value="Войти" />				
				</td>
			</tr>
			<tr>
				<td colspan="2">
                <p><a href="<?php echo get_permalink($pages['fbplostpass']);?>" title="Восстановление пароля" >Напомнить пароль</a> | <a href="<?php echo get_permalink($pages['fbpterms']);?>" title="Регистрация">Регистрация</a></p>				
				</td>
			</tr>
			<tr>
				<td colspan="2">
					 <?php echo get_ulogin_panel(); ?>	
				</td>
			</tr>
			
			
		    </table>
	    </form>		
	
    </div>	

</div>
	
		<?php } ?>

<?php
	}

public function form($instance){
?>
<p>
<label for="<?php echo $this->get_field_id('title'); ?>">Заголовок "Авторизации": </label><br />
<input type="text" name="<?php echo $this->get_field_name('title'); ?>" id="<?php $this->get_field_id('title'); ?>" class="widefat" value="<?php echo $instance['title']; ?>">
</p>
<p>
<label for="<?php echo $this->get_field_id('title_r'); ?>">Заголовок "Навигация": </label><br />
<input type="text" name="<?php echo $this->get_field_name('title_r'); ?>" id="<?php $this->get_field_id('title_r'); ?>" class="widefat" value="<?php echo $instance['title_r']; ?>">
</p>
<?php
}
	
}

register_widget('fbp_login_Widget');

?>