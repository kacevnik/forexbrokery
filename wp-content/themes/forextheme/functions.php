<?php
if( !defined( 'ABSPATH')){ exit(); }

global $template_directory;
$template_directory = get_bloginfo('template_directory');

global $site_url;
$site_url = get_option('siteurl');

function my_template($page){
$pager = TEMPLATEPATH . "/".$page.".php";
    if(file_exists($pager)){
        include($pager);
    }
}

my_template('includes/site_func');
my_template('includes/pagenavi');
my_template('includes/comments');

?>