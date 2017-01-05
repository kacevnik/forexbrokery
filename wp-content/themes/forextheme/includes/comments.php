<?php
if( !defined( 'ABSPATH')){ exit(); }

function rstudia_comment_posts_end(){
    echo '</li><!-- end comments -->';
}

function rstudia_comment_posts( $comment, $args, $depth ) {
	global $user_ID, $post;
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
		if($comment->comment_parent){ $cl='second'; } else { $cl=''; }
    ?>
	<li id="li-comment-<?php comment_ID(); ?>" class="">
	    <div class="comment" id="comment-<?php comment_ID(); ?>">
		
	    <div class="oneotz <?php echo $cl;?>">
		
		    <div class="onotdate"><?php echo get_comment_time('d.m.Y в H:i'); ?> <span class="onotdatec"><?php echo $comment->comment_author;?></span></div>
            <div class="comcontent">
			   <?php echo apply_filters('the_content', $comment->comment_content);?>
			</div>
		
		</div>
		
		    <?php if(!$comment->comment_parent){ ?>
			<div class="commentlink">
		    <?php comment_reply_link( array_merge( $args, array( 'reply_text' => 'Комментировать', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
            </div>
		    <?php } ?>
		    


			<div class="clear"></div>
		</div>		
	<?php	
			break;
	endswitch;		
}

?>