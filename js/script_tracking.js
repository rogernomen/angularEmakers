$(function () {
    $('#diadeentrega').datetimepicker({
        pick12HourFormat: false,
        daysOfWeekDisabled:[0,6],
        language:'es',
        pickTime: false,
    });
});

function sendConsulta(){
	var error = false;

	// Comprovamos la correcta existencia de los campos
	if($("#num_pedido").val() == '' ){ error = true; $("#num_pedido_div").addClass('has-error'); }else{ $("#num_pedido_div").removeClass('has-error'); }
	if($("#mail_or_telf").val() == ''){ error = true; $("#mail_or_telf_div").addClass('has-error'); }else{ $("#mail_or_telf_div").removeClass('has-error'); }
	
	var error_condiciones = !$("#checkCondiciones").is(':checked');
	if(error_condiciones){ $('#lbl_condiciones').addClass('has-error'); }else{ $('#lbl_condiciones').removeClass('has-error'); }

	// Comprovamos ahora el tipo de datos en #mail_or_telf para aplicar la regla de expresion adecuada
	if(error == false) error = compruevaMail_or_Telf($("#mail_or_telf").val());
	
	if(error){
		$('#triggerErrorShape').trigger('click');
	}else{
		$('#triggerErrorLoading').trigger('click');
		load_tk_content($("#num_pedido").val(), $("#mail_or_telf").val());
	}
}

function compruevaMail_or_Telf(inputValue){
	var filterMail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	var mailReg = new RegExp(filterMail);
	if (!mailReg.test(inputValue)) {
		return false;
		
		// Puede no haber pasado por ser un telefono
		/*
		var filterTelf = /^[69]\d{8}$/;
		var telReg = new RegExp(filterTelf);
		if(!telReg.test(inputValue)){
			return true;
		}else{
			return false;
		}
		*/
	}else{
		return false;
    }
}

function load_tk_content(var1, var2){
    requestInfo = $.ajax({
		type: "POST",
		url: base_url+lang_site+"/tracking/checkDataTracking",
		data: "num_pedido="+var1+"&mail_or_telf="+var2,
		beforeSend: function(x) {
			
		},
		success: function(msg){
			var json = jQuery.parseJSON(msg);
			$('#Error_loading').modal('toggle');
		}
	});
}

function abortRequest(){
	requestInfo.abort();
}
