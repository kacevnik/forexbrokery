<?php get_header(); ?>
	
    <?php the_bread_cr(); ?>	
	
<?php if (is_category()) { ?>
<div class="titlepageline">
Все статьи из категории "<strong><?php single_cat_title(); ?></strong>"
</div>
<?php } elseif( is_tag() ) { ?>
<div class="titlepageline">
Все статьи по тэгу "<strong><?php single_tag_title(); ?></strong>"
</div>
<?php } elseif( is_search()) { ?>
<div class="titlepageline">
Результаты поиска с упоминанием "<strong><?php echo get_search_query();?></strong>"
</div>
<?php } else { ?>	
<div class="titlepageline">Последние новости</div>
<?php } ?>
	
    <?php 
	if (have_posts()) : 
	while (have_posts()) : the_post();
	$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'new-thumb');
	if($large_image_url[0]){ $cl='act'; } else { $cl=''; }
    ?>
	<div class="posts <?php echo $cl;?>">
		<div class="rposts">
	    <div class="lposts">
		    <?php if($large_image_url[0]){ ?>
			    <a href="<?php the_permalink();?>" rel="bookmark"><img src="<?php echo $large_image_url[0];?>" alt="" /></a>
			<?php } ?>
		</div>		
		
		
		    <div class="the_title_posts"><a href="<?php the_permalink();?>" rel="bookmark" title="<?php the_title_attribute();?>"><?php the_title();?></a></div>
			
		    <div class="the_date_posts"><?php the_time('d.m.Y');?></div>
            <div class="contentpage colorqw">
			    <?php the_excerpt();?>
			</div>
			<div class="the_more"><a href="<?php the_permalink();?>">подробнее</a></div>
		</div>
		<div class="clear"></div>
	</div>
	<?php
	endwhile; 
	else : 
	?>
    К сожалению, новостей нет.
	<?php endif; ?>
	<?php rstudia_pagenavi(); ?>
	
<?php get_footer();?>