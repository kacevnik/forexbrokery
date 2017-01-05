<?php 
if( !defined( 'ABSPATH')){ exit(); }

/*

Template Name: Шаблон для плагина с названием

*/

get_header();
?>

<?php the_bread_cr(); ?>

<div class="titlepage"><?php the_title();?></div>

<?php 

while (have_posts()) : the_post();  

	the_content();
	
endwhile; 

?>
	
<?php get_footer();?>