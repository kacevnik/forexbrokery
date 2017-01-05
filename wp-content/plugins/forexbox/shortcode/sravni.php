<?php
if( !defined( 'ABSPATH')){ exit(); }
global $user_ID, $themplate;
	
	$themplate .= '<div class="fbpo_title">Таблица сравнения</div>
	<div id="fbp_sravni_table">'. get_fbp_sravni_table() .'</div>';

?>