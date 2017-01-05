    </div>
    <div id="sidebar">
        <?php get_sidebar(); ?>
    </div>  
    <div class="clear"></div>
    </div>
	
    <div id="footer">
	    <div class="fleft">
		    <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Подвал') ) : ?>
			&copy; <?php echo date('Y');?> <?php bloginfo('name');?>. Все права защищены.
			<?php endif; ?>
		</div>
	    <div class="fright">
	<?php wp_nav_menu(array(
		'sort_column' => 'menu_order',
		'container' => 'div',
		'container_class' => 'nav-holder-footer',
		'menu_class' => 'nav-footer',
		'menu_id' => '',
		'depth' => '1',
		'fallback_cb' => 'no_menu',
		'theme_location' => 'footer_menu'
	)); ?>			
		</div>
            <div class="clear"></div>		
	</div>

</div>
<?php wp_footer();?>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-89381754-1', 'auto');
  ga('send', 'pageview');

</script>
</body>
</html>