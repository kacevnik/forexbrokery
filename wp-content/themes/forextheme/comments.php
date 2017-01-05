<?php 
if( !defined( 'ABSPATH')){ exit(); }

global $user_ID, $template_directory, $site_url;
if($post->comment_status == 'open'){
?>
    <div class="titlepage" style="margin: 0 0 10px;">Комментарии:</div>
	<div id="comments">	
<?php
if ( have_comments() ) : ?>

		<ul class="commentlist">
	<?php
		wp_list_comments( array( 'callback' => 'rstudia_comment_posts', 'end-callback' => 'rstudia_comment_posts_end' ) );
	?>	
		</ul>
		<div class="clear"></div>
		
		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
		<div class="navigation">
			<div class="previous"><?php previous_comments_link( '&larr; Предидущие' ); ?></div>
			<div class="next"><?php next_comments_link( 'Следующие &rarr;' ); ?></div>
		        <div class="clear"></div>
		</div>
		<?php endif; ?>		
		
<?php  
else : 
    if ('open' == $post->comment_status){
    ?>	
	<div style="text-align: center; font-weight: bold; padding: 10px 0;">комментариев нет</div>
	<?php
	}
endif;   ?>
	</div>
<?php } ?>	
	
<?php if ('open' != $post->comment_status){ ?>
    
<?php } elseif($post->comment_status == 'open' and !$user_ID and get_option('comment_registration')==1){ ?>
    <strong>Комментирование доступно только зарегистрированным пользователям. <br />
	Войдите в свой аккаунт или зарегистрируйтесь.</strong>
<?php } else { ?> 	
    <div style="margin: 0 0 20px;">
	<div id="respond">
	    <div class="addcomment">Добавить комментарий</div> <a rel="nofollow" id="cancel-comment-reply-link" href="" style="display:none;">Отменить ответ</a>
		    <div class="clear"></div>
	<form action="<?php echo $site_url; ?>/wp-comments-post.php" method="post" id="commentform">
	    <table>
		    <?php if(!$user_ID){ ?>
		    <tr>
			    <td width="90">
				    Имя:
				</td>
				<td>
				    <input type="text" class="cinput" name="author" value="" />
				</td>
			</tr>
		    <tr>
			    <td width="90">
				    E-mail:
				</td>
				<td>
				    <input type="text" class="cinput" name="email" value="" />
				</td>
			</tr>
			<?php } ?>
		    <tr>
			    <td width="90">
				    Комментарий:
				</td>
				<td>
				    <textarea class="ctextarea" name="comment"></textarea>
				</td>
			</tr>
		    <tr>
			    <td width="90">
				&nbsp;
				</td>
				<td>
				    <input type="submit" class="fbp_submit" name="submit" value="Отправить" />
				</td>
			</tr>			
		</table>
		
	    <div class="clear"></div>
        <input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" />
        <input type='hidden' name='comment_parent' id='comment_parent' value='0' />
	</form>
	</div>
	</div>
<?php } ?>

