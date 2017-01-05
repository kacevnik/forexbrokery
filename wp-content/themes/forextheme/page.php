<?php 
if( !defined( 'ABSPATH')){ exit(); }

get_header();
?>

<?php the_bread_cr(); ?>

<div class="titlepage"><?php the_title();?></div>

<?php 
while (have_posts()) : the_post();  
?>
<div class="contentpage">
	<?php the_content(); ?>
	<div class="clear"></div>
</div>	
<?php	
endwhile; 
?>
	
<?php get_footer();?>