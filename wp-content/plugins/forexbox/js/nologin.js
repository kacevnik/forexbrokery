$(function(){			

    $('#fbp_register').ajaxForm({
        beforeSubmit: function(a,f,o) {
            o.dataType = 'json';
			$('#fbp_register_ajax').show();
			$('#fbp_register_button').attr('disabled',true);
        },
        success: function(ht) {
        if(ht['otvet']==1){
		   $('#fbp_reg_otvet').html('<div class="fbp_reg_otvet_no">Ошибка: '+ht['ers']+'</div>');
		} else if(ht['otvet']==2){
		   window.location.href = ht['lc'];
		} 	
		$('#fbp_register_button').attr('disabled',false);
		$('#fbp_register_ajax').hide();
        }
    });	

    $('#fbp_login').ajaxForm({
        beforeSubmit: function(a,f,o) {
            o.dataType = 'json';
			$('#fbp_login_ajax').show();
			$('#fbp_login_button').attr('disabled',true);
        },
        success: function(ht) {
        if(ht['otvet']==1){
		   $('#fbp_log_otvet').html('<div class="fbp_reg_otvet_no">Ошибка: '+ht['ers']+'</div>');
		} else if(ht['otvet']==2){
		   window.location.href = ht['lc'];
		} 	
		$('#fbp_login_button').attr('disabled',false);
		$('#fbp_login_ajax').hide();
        }
    });	

    $('#fbp_lostpass').ajaxForm({
        beforeSubmit: function(a,f,o) {
            o.dataType = 'json';
			$('#fbp_lostpass_ajax').show();
			$('#fbp_lostpass_button').attr('disabled',true);
        },
        success: function(ht) {
        if(ht['otvet']==1){
		   $('#fbp_lost_otvet').html('<div class="fbp_reg_otvet_no">Ошибка: '+ht['ers']+'</div>');
		} else if(ht['otvet']==2){
		   $('#fbp_lost_otvet').html('<div class="fbp_reg_otvet_yes">'+ht['ers']+'</div>');
		} 	
		$('#fbp_lostpass_button').attr('disabled',false);
		$('#fbp_lostpass_ajax').hide();
        }
    });		

});