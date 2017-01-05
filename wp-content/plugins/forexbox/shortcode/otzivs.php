<?php
if( !defined( 'ABSPATH')){ exit(); }
global $otc, $themplate;

    global $wpdb;

	$themplate = '';
	
	$themplate .= '
	<div class="fbpo_title" style="margin: 0 0 20px 0;">Последние отзывы о участниках</div>
	
	<div class="fbp_body_otziv">';
	
	$themplate .= get_fbp_comments_table($otc,0,0);
	
	$themplate .= '
	</div>	
	<div style="height: 30px;"></div>

	';

?>