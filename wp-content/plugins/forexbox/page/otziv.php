<?php
if( !defined( 'ABSPATH')){ exit(); }
?>

<?php
    if($_GET['add'] or $_GET['edit']){
	   fbp_template('page/addeditcomment');
    } else {
       /* главная страница */
	   fbp_template('page/indexcomment');
    }
?>	