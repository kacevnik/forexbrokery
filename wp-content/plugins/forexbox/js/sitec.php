<?php
include_once('../../../../wp-config.php');
include_once('../../../../wp-load.php');
include_once('../../../../wp-includes/wp-db.php');
header('Content-Type: application/x-javascript; charset=utf-8');

$template_directory = get_bloginfo('template_directory');
global $user_ID;
$fbp_config = get_option('fbp_config');
$lcomment = $fbp_config['logincomment'];
?>
$(function(){ 

    $('#fbpvsform li a').live('click', function(){
	    var text = $(this).html();
	    $('#fbpsinput').attr('value', text);
	    $('#fbpvsform').hide();
	    return false;
	});
	
	$('#fbpsinput').live('keyup', function(){
	
	var slovo = $(this).val();
	if(slovo.length > 0){
	var dataString='slovo='+slovo;
    $.ajax({
    type: "POST",
    url: "<?php echo FBP_PLUGIN_URL;?>ajax/searchform.php",
    data: dataString,
	cache: false,
    success: function(ht)
    {
		$('#fbpajaxform').html(ht).show();	
    }
    });	
    }	
	
	});
	
    $('#ajax_add_otziv_fbp').ajaxForm({
        beforeSubmit: function(a,f,o) {
            o.dataType = 'json';
			$('.fbp_ajaxform_ten input').attr('disabled',true);
        },
        success: function(ht) {
        if(ht['otv']==1){
		   $('#fbp_ajaxform_res').html('<div class="fbp_reg_otvet_no">Ошибка: '+ht['err']+'</div>');
		} else if(ht['otv']==2){
		   $('#fbp_ajaxform_res').html('<div class="fbp_reg_otvet_yes">'+ht['err']+'</div>');
		   $('.fbp_ajaxform input[type=text], .fbp_ajaxform textarea').attr('value','');
		} 	
		$('.fbp_ajaxform_ten input').attr('disabled',false);
        }
    });		
	$('.addotziv').live('click',function(){
	    <?php if($lcomment == 'true' and $user_ID or $lcomment != 'true'){ ?>
	    var w1 = $(window).height();
		var w2 = (w1 - $('.fbp_ajaxform').height()) / 2;
	    $('#fbp_ajaxform').css({'top':w2});
		$('#fbp_ajax, #fbp_ajaxform').show();
		var id = $(this).attr('name');
		var parent = $(this).attr('rel');
		$('#fbp_ajaxform input[name=fb_id]').attr('value',id);
		$('#fbp_ajaxform input[name=cparent]').attr('value',parent);
		$('#fbp_ajaxform_res').html();
	    <?php } else { ?>
		alert('Ошибка! Комментирование разрешено только зарегистрированным пользователям.');
		<?php } ?>
	
	    return false;
	});
	
	$('.fbp_ajaxformclose').live('click',function(){
	    $('#fbp_ajax, #fbp_ajaxform').hide();
	    return false;
	});
	
	
	$('.fbphidetext').live('click', function(){
	    $(this).parents('.fbp_lasto_content').find('.nohidefbpcont').toggle();
	    $(this).parents('.fbp_lasto_content').find('.hidefbpcont').toggle();
		var text = $(this).html();
		if(text == 'подробнее'){
		    $(this).html('скрыть');
		} else {
		    $(this).html('подробнее');
		}
		return false;
	});
	
	$('.fbp_lastoone:last').addClass('last');
	
	$('.fbp_searchform').mouseleave(function(){
        $('#fbpvsform').hide();
	});
	
	$('.fbp_rating:not(.act) ul li').live('click',function(){
	    var th = $(this).attr('title');
		var thet = $(this);
		var fbid = thet.parents('.fbprating').attr('name');
		thet.parents('.fbp_rating').addClass('act');
		var dataString='rat='+th +'&fbid='+fbid;
    $.ajax({
    type: "POST",
    url: "<?php echo FBP_PLUGIN_URL;?>ajax/rating.php",
    data: dataString,
	dataType: 'json',
    success: function(ht)
    {
		if(ht['otv']==1){
            alert('Ошибка: '+ ht['err']);
		    thet.parents('.fbp_rating').removeClass('act');
        } else {
		    thet.parents('.fbprating').find('.fbp_rat_result').html(ht['rating']).before(ht['table']);
            thet.parents('.fbp_rating').remove();
			
        }		
    }
    });	    
	
	    return false;
	});
	
	$('.fbp_rating2:not(.act) ul li').live('click',function(){
	    var th = $(this).attr('title');
		var thet = $(this);
		var fbid = thet.parents('.fbpprstar').attr('name');
		thet.parents('.fbp_rating2').addClass('act');
		var dataString='rat='+th +'&fbid='+fbid;
    $.ajax({
    type: "POST",
    url: "<?php echo FBP_PLUGIN_URL;?>ajax/rating.php",
    data: dataString,
	dataType: 'json',
    success: function(ht)
    {
		if(ht['otv']==1){
            alert('Ошибка: '+ ht['err']);
		    thet.parents('.fbp_rating2').removeClass('act');
        } else {
		    $('.fbpobrkn_rating_res').html(ht['rating'])
			$('.fbpprstar').html(ht['table']);
			
        }		
    }
    });	    
	
	    return false;
	});	
	
	$('.fbp_rating:not(.act) ul li').live('mouseenter',function(){
	    var th = parseInt($(this).attr('title'))*15;
	    $(this).parents('.fbp_rating').find('.fbp_rating_act').stop(true,true).animate({'width':th});
	});

    $('.fbp_rating:not(.act) ul li').live('mouseleave',function(){
	    $(this).parents('.fbp_rating').find('.fbp_rating_act').stop(true,true).animate({'width':0});
	});	
	
	$('.fbp_rating2:not(.act) ul li').live('mouseenter',function(){
	    var th = parseInt($(this).attr('title'))*15;
	    $(this).parents('.fbpprstar').find('.fbp_rating_act').stop(true,true).animate({'width':th});
	});

    $('.fbp_rating2:not(.act) ul li').live('mouseleave',function(){
	    $(this).parents('.fbpprstar').find('.fbp_rating_act').stop(true,true).animate({'width':0});
	});		
	
	$('.pgncom a').live('click', function(){
	    var page = $(this).attr('href').replace('#','');
		var lim = $(this).attr('name');
		var id= $('#fbif_id').val();
		var type= $('#fbif_id').attr('data');
        $(".fbp_body_otziv").load("<?php echo FBP_PLUGIN_URL;?>ajax/comments.php", {page: page, limit: lim, id: id, type: type});
        $(".fbp_pagenavileft").load("<?php echo FBP_PLUGIN_URL;?>ajax/commentspn.php", {page: page, limit: lim, id: id, type: type});	    
	    //$(".fbp_pagenaviright").load("<?php echo FBP_PLUGIN_URL;?>ajax/commentslm.php", {page: page, limit: lim, id: id, type: type});	    
	
	    return false;
	});
	
	$('.pgntable a, a.hsorter, .pgntablelim a').live('click', function(){
	    var page = $(this).attr('href').replace('#','');
		var lim = $(this).attr('name');
        $("#forex_home_table").load("<?php echo FBP_PLUGIN_URL;?>ajax/table.php", {page: page, limit: lim});
        $(".fbp_pagenavileft").load("<?php echo FBP_PLUGIN_URL;?>ajax/tablespn.php", {page: page, limit: lim});	    
	    $(".fbp_pagenaviright").load("<?php echo FBP_PLUGIN_URL;?>ajax/tableslm.php", {page: page, limit: lim});	    
	
	    return false;
	});		
	
	$('.pgncomlim a').live('click', function(){
		var lim = $(this).attr('name');
		var id= $('#fbif_id').val();
        $(".fbp_body_otziv").load("<?php echo FBP_PLUGIN_URL;?>ajax/comments.php", {page: 1, limit: lim, id: id});
        $(".fbp_pagenavileft").load("<?php echo FBP_PLUGIN_URL;?>ajax/commentspn.php", {page: 1, limit: lim, id: id});	    
	    $(".fbp_pagenaviright").load("<?php echo FBP_PLUGIN_URL;?>ajax/commentslm.php", {page: 1, limit: lim, id: id});	    
	
	    return false;
	});	
	
	$('.fbpajaxshow').live('click',function(){
	    $(this).parents('.thisisbroker').find('.fbpsmallinfo').toggleClass('act');
		$(this).parents('.thisisbroker').find('.fbpsmallinfovn').stop(true,true).slideToggle(300);
		var text = $(this).html();
		if(text=='Подробнее'){
		    $(this).html('Скрыть');
		} else {
		    $(this).html('Подробнее');
		}
	
	    return false;
	});
	
	$('.fbg_graph').live('click', function(){
	
	    var table = $(this).parents('.thisisbroker').find('.graphthis').html();
		
	    var w1 = $(window).height();
		var w2 = (w1 - $('.fbp_ajaxform2').height()) / 2;
	    $('#fbp_ajaxform2').css({'top':w2});		
		
		$('#fbp_new_graph').html(table);
		$('#fbp_ajaxform2, #fbp_ajax').show();
	
	    return false;
	});
	
	$('.fbp_ajaxformclose2').live('click',function(){
	    $('#fbp_ajax, #fbp_ajaxform2').hide();
	    return false;
	});	
	
	function lsrav(){
	    $('.fbp_srone:last').addClass('last');
	}
	lsrav();
	$('.addsravn').live('click',function(){
	    var id = $(this).attr('name');
		var dataString='id='+id;
    $.ajax({
    type: "POST",
    url: "<?php echo FBP_PLUGIN_URL;?>ajax/sravni.php",
    data: dataString,
    success: function(ht)
    {
		$('#fbp_the_sravni').html(ht);
        lsrav();		
    }
    });	    
	
	    return false;
	});	
	
	$('.delsravn').live('click',function(){
	    var id = $(this).attr('name');
		var dataString='id='+id;
    $.ajax({
    type: "POST",
    url: "<?php echo FBP_PLUGIN_URL;?>ajax/delsravni.php",
    data: dataString,
	dataType: 'json',
    success: function(ht)
    {
		$('#fbp_the_sravni').html(ht['ftable']);
		if($('#fbp_sravni_table').length > 0){
		$('#fbp_sravni_table').html(ht['ltable']);
		}
		$('#untfbp_'+id).removeClass('checkfbpgo').addClass('checkfbpaut');
        lsrav();		
    }
    });	    
	
	    return false;
	});	

    $('.checkfbpgo').live('click',function(){
        $(this).removeClass('checkfbpgo').addClass('checkfbpaut');
	    var id = $(this).attr('id').replace('untfbp_','');
		var dataString='id='+id;
    $.ajax({
    type: "POST",
    url: "<?php echo FBP_PLUGIN_URL;?>ajax/delsravni.php",
    data: dataString,
	dataType: 'json',
    success: function(ht)
    {
		$('#fbp_the_sravni').html(ht['ftable']);
        lsrav();		
    }
    });	
	
        return false;
    });		
	
    $('.checkfbpaut').live('click',function(){
        $(this).removeClass('checkfbpaut').addClass('checkfbpgo');
	    var id = $(this).attr('id').replace('untfbp_','');
		var dataString='id='+id;
    $.ajax({
    type: "POST",
    url: "<?php echo FBP_PLUGIN_URL;?>ajax/sravni.php",
    data: dataString,
    success: function(ht)
    {
		$('#fbp_the_sravni').html(ht);
        lsrav();		
    }
    });		
	
        return false;
    });	
	
});