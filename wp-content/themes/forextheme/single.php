<?php get_header(); ?>
	
    <?php the_bread_cr(); ?>	
		
    <div class="titlesingle"><?php the_title();?></div>
	
	<div class="the_date_posts"><?php the_time('d.m.Y');?></div>
	
	
    <?php 
	if (have_posts()) : 
	while (have_posts()) : the_post();
	$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'new-thumb');
    ?>
	<div class="single">
            <div class="contentpage">
		    <?php if($large_image_url[0]){ ?>
			    <img src="<?php echo $large_image_url[0];?>" class="alignleft" alt="" />
			<?php } ?>			
			
			    <?php the_content();?>
				<div class="titlepage" style="margin: 0 0 10px;">Поделиться в соц. сетях:</div>
				<script src="//yastatic.net/es5-shims/0.0.2/es5-shims.min.js"></script>
<script src="//yastatic.net/share2/share.js"></script>
<div class="ya-share2" data-services="collections,vkontakte,facebook,odnoklassniki,moimir,gplus,twitter,blogger"></div>
			</div>
	</div>
	<?php
	endwhile; 
	endif; ?>
	
	
	<?php comments_template(); ?>

	
<?php get_footer();?>