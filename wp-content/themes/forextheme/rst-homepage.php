<?php 
if( !defined( 'ABSPATH')){ exit(); }

/*

Template Name: Шаблон главной страницы

*/

get_header();
?>

<div class="titlepage"><?php the_title();?></div>

<?php 

while (have_posts()) : the_post();  

	the_content();
	
endwhile; 

?>

<div class="blocknews">
<div class="titlepageline">Последние новости</div>

    <?php 
    $the_query = new WP_Query('showposts=3');
    while ($the_query->have_posts()) : $the_query->the_post();
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
	?>

</div>
	
<?php get_footer();?>