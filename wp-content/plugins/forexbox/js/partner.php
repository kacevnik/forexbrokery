<?php
include_once('../../../../wp-config.php');
include_once('../../../../wp-load.php');
include_once('../../../../wp-includes/wp-db.php');
header('Content-Type: application/x-javascript; charset=utf-8');

$template_directory = get_bloginfo('template_directory');
?>
$(function(){ 

    $("#promomenu li:not(.act) a").live('click',function () {
        $(".ftabcontainer, #promomenu li").removeClass('act');
		$(".ftabcontainer").filter(this.hash).addClass('act');
		$(this).parents('li').addClass('act');
         
        return false;
    });
	
    $("a.fbp_act_link").click(function() {
    var text = $(this).text();
    if(text == "Показать код баннера"){
        $(this).html("Скрыть код баннер");
    } else {
        $(this).html("Показать код баннера");
    }
    $(this).parents(".fbp_etot").find(".fbp_textarea").toggle();
	$(this).toggleClass('act');

        return false;
    });

    $("a.fbp_del_pay").click(function() {
        var id = $(this).attr("name");
        var par = $(this);
        var dataString = "id=" + id;
        $.ajax({
        type: "POST",
        url: "<?php echo FBP_PLUGIN_URL.'ajax/delpay.php';?>",
        data: dataString,
        cache: false,
        success: function(html){
		
        $("#fbp_ajax_zapros").html(html);
        par.hide();
        par.parents("tr").children("td.comment_del").html("Выплата отменена пользователем");
        $("input.dengi_del").attr("value","Заказать");
		
        } 
        });
        return false;
    });	

});