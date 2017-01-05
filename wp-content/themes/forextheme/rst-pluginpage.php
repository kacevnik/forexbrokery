<?php 
if( !defined( 'ABSPATH')){ exit(); }

/*

Template Name: Шаблон для плагина без названия

*/

get_header();
?>

<?php the_bread_cr(); ?>

<?php 

while (have_posts()) : the_post();  

	the_content();
	
endwhile; 

?>
	
<?php get_footer();?>