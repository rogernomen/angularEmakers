/* CONTROL BUG ANDROID SELECT BOOTSTRAP RADIUS CONTROL */
var nua = navigator.userAgent
var isAndroid = (nua.indexOf('Mozilla/5.0') > -1 && nua.indexOf('Android ') > -1 && nua.indexOf('AppleWebKit') > -1 && nua.indexOf('Chrome') === -1)
if (isAndroid) {
	$('select.form-control').removeClass('form-control').css('width', '100%')
}
/* OVERRIDE */
Object.size = function(obj) {
    var size = 0, key;
    for (key in obj) {
        if (obj.hasOwnProperty(key)) size++;
    }
    return size;
};
// dd/mm/aaaa
function parseDate(input) {
	var parts = input.match(/(\d+)/g);
	return new Date(parts[2], parts[1]-1, parts[0]);
}

/*CONSTANTES*/
var ESTADO_ENTREGA_SIN_ASIGNAR = 0;
var ESTADO_ENTREGA_EN_ALMACEN = 1;
var ESTADO_ENTREGA_CON_INCIDENCIAS = 2;
var ESTADO_ENTREGA_ENTREGADA = 3;
var ESTADO_ENTREGA_AUSENTE_O_CERRADO = 4;
var ESTADO_ENTREGA_DIRECCION_INCORRECTA_POR_REPARTIDOR = 5;
var ESTADO_ENTREGA_DIRECCION_INCOMPLETA_POR_REPARTIDOR = 6;
var ESTADO_ENTREGA_POR_RECOGER = 7;
var ESTADO_ENTREGA_RECOGIDO = 8;
var ESTADO_ENTREGA_RECOGER_EN_AGENCIA = 9;
var ESTADO_ENTREGA_EN_RUTA = 10;
var ESTADO_ENTREGA_NO_ACEPTA_REEMBOLSO = 11;
var ESTADO_ENTREGA_DEVOLVER_A_REMITENTE = 13;
var ESTADO_ENTREGA_DESTINATARIO_APLAZA_ENTREGA = 14;
var ESTADO_ENTREGA_DEVUELTO_A_REMITENTE = 15;
var ESTADO_ENTREGA_ORIGEN_NO_PREPARADO = 16;
var ESTADO_ENTREGA_EN_ALMACEN_ORIGEN = 17;

var ESTADO_PRECARGA_POR_RECOGER = 0;
var ESTADO_PRECARGA_RECOGIDO = 1;
var ESTADO_PRECARGA_EN_ALMACEN = 2;
var ESTADO_PRECARGA_ORIGEN_NO_PREPARADO = 3;
var ESTADO_PRECARGA_ALMACEN_ORIGEN = 4;

$(function () {	
	if(/Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent)) {
		$('#input_franja_entrega').selectpicker('mobile');
		$('#ip_cf_tipo_via').selectpicker({});
    }else{
	    $('#input_franja_entrega').selectpicker({});
	    $('#ip_cf_tipo_via').selectpicker({});
    }
	
    $('#diadeentrega').datetimepicker({
        pick12HourFormat: false,
        daysOfWeekDisabled:[0,6],
        language:'es',
        pickTime: false
    }).on('dp.change', function(e){
    	// Reformateamos la fecha
    	var now = new Date(e.date);
    	var day_now = now.getDate();
		if(day_now < 10){ day_now = '0'+day_now; }
		var month_now = (parseInt(now.getMonth())+1);
		if(month_now < 10){ month_now = '0'+month_now }
		var date_now = day_now+'/'+month_now+'/'+now.getFullYear();
		
		var day_week = now.getDay();
		var cf_agencia = $('#cf_agencia').val();
		var cf_abonado = $('#cf_abonado').val();
		
		// Calculamos las franjas disponibles
		calculaFranjasDisponibles($('#conf_franja').val(), date_now);
    });
    var today = new Date();
    var today2 = new Date(today.getTime());
    var yesterday = new Date(today.getTime() - (24 * 60 * 60 * 1000));
    
    $('#diadeentrega').data("DateTimePicker").setMinDate(today2);
});

function sendConsulta(){
	var error = false;
	
	// Escondemos la capa general de contenido y reiniciamos las laterales
	$('#generalShapeContent').addClass('hideshape');
	// Escondemos todos los formularios
	$('#cambiosForm1').removeClass('showshape');
	$('#cambiosForm1').addClass('hideshape');
	$('#cambiosForm2').removeClass('showshape');
	$('#cambiosForm2').addClass('hideshape');
	$('#cambiosForm3').removeClass('showshape');
	$('#cambiosForm3').addClass('hideshape');
	
	// Mostramos todas las opciones menos la activada
	$('#ctrop1').removeClass('hideshape');
	$('#ctrop1 button').removeClass('active');
	$('#ctrop1').addClass('showshape');
	$('#ctrop2').removeClass('hideshape');
	$('#ctrop2 button').removeClass('active');
	$('#ctrop2').addClass('showshape');
	$('#ctrop3').removeClass('hideshape');
	$('#ctrop3 button').removeClass('active');
	$('#ctrop3').addClass('showshape');
	
	// Comprovamos la correcta existencia de los campos
	if($("#num_pedido").val() == '' ){ error = true; $("#num_pedido_div").addClass('has-error'); }else{ $("#num_pedido_div").removeClass('has-error'); }
	if($("#mail_or_telf").val() == ''){ error = true; $("#mail_or_telf_div").addClass('has-error'); }else{ $("#mail_or_telf_div").removeClass('has-error'); }
	
	// Comprovamos la aceptacion de las condiciones del servicio
	var error_condiciones = !$("#checkCondiciones").is(':checked');
	if(error_condiciones){ error = true; $('#lbl_condiciones').addClass('has-error'); }else{ $('#lbl_condiciones').removeClass('has-error'); }

	// Comprovamos ahora el tipo de datos en #mail_or_telf para aplicar la regla de expresion adecuada
	if(error == false) error = compruevaMail_or_Telf($("#mail_or_telf").val());
	
	// Si se ha detectado algun tipo de error...
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
			if(json.status == 'OK'){
				loadShapesContent(json);
				$('#generalShapeContent').removeClass('hideshape');
			}else{
				$('#triggerError_busquedaShape').trigger('click');
			}
		}
	});
}

function loadShapesContent(json){
	// Cargamos los datos basicos
	$('#tk_num_pedido').html(json.data.num_pedido);
	$('#tk_nombre_abonado').html(json.data.abonado);
	$('#tk_fecha_alta').html(json.data.fecha_alta);
	$('#ifMailPre').val(json.data.ifMailPre);
	$('#valor_reembolso').val(json.data.valor_reembolso);
	$('#valor_reembolso_txt').html(json.data.valor_reembolso);
	
	// Controlamos el contenido segun tabla de origen & estado del pedido
	// EXPEDICIONES
	if(json.data.tabla == 'argos_entregas'){
		switch(parseInt(json.data.cf_estado)){
			// Casos en los que mostramos la fecha y franja prevista de entrega
			case ESTADO_ENTREGA_POR_RECOGER:
				$('#cont_franja').removeClass('hideshape');
				$('#cont_franja').addClass('showshape');
				$('#cont_fecha').removeClass('hideshape');
				$('#cont_fecha').addClass('showshape');
				$('#tk_estado').html(json.data.estado_entrega);
				$('#tk_franja').html(json.data.franja_entregaDesc);
				// Si no hemos enviado mail, no mostramos la franja aún
				if(json.data.ifMailPre == 1){
					$('#cont_franja').removeClass('hideshape');
					$('#cont_franja').addClass('showshape');
				}else{
					$('#cont_franja').removeClass('showshape');
					$('#cont_franja').addClass('hideshape');
				}
			break;
			case ESTADO_ENTREGA_RECOGIDO:
				$('#cont_franja').removeClass('hideshape');
				$('#cont_franja').addClass('showshape');
				$('#cont_fecha').removeClass('hideshape');
				$('#cont_fecha').addClass('showshape');
				$('#tk_estado').html(json.data.estado_entrega);
				$('#tk_franja').html(json.data.franja_entregaDesc);
				// Si no hemos enviado mail, no mostramos la franja aún
				if(json.data.ifMailPre == 1){
					$('#cont_franja').removeClass('hideshape');
					$('#cont_franja').addClass('showshape');
				}else{
					$('#cont_franja').removeClass('showshape');
					$('#cont_franja').addClass('hideshape');
				}
			break;
			case ESTADO_ENTREGA_EN_ALMACEN_ORIGEN:
				$('#cont_franja').removeClass('hideshape');
				$('#cont_franja').addClass('showshape');
				$('#cont_fecha').removeClass('hideshape');
				$('#cont_fecha').addClass('showshape');
				$('#tk_estado').html(json.data.estado_entrega);
				$('#tk_franja').html(json.data.franja_entregaDesc);
				// Si no hemos enviado mail, no mostramos la franja aún
				if(json.data.ifMailPre == 1){
					$('#cont_franja').removeClass('hideshape');
					$('#cont_franja').addClass('showshape');
				}else{
					$('#cont_franja').removeClass('showshape');
					$('#cont_franja').addClass('hideshape');
				}
			break;
			case ESTADO_ENTREGA_EN_ALMACEN:
				$('#cont_franja').removeClass('hideshape');
				$('#cont_franja').addClass('showshape');
				$('#cont_fecha').removeClass('hideshape');
				$('#cont_fecha').addClass('showshape');
				$('#tk_estado').html(json.data.estado_entrega);
				$('#tk_franja').html(json.data.franja_entregaDesc);
				// Si no hemos enviado mail, no mostramos la franja aún
				if(json.data.ifMailPre == 1){
					$('#cont_franja').removeClass('hideshape');
					$('#cont_franja').addClass('showshape');
				}else{
					$('#cont_franja').removeClass('showshape');
					$('#cont_franja').addClass('hideshape');
				}
			break;
			case ESTADO_ENTREGA_DESTINATARIO_APLAZA_ENTREGA:
				$('#cont_franja').removeClass('hideshape');
				$('#cont_franja').addClass('showshape');
				$('#cont_fecha').removeClass('hideshape');
				$('#cont_fecha').addClass('showshape');
				$('#tk_estado').html(json.data.estado_entrega);
				$('#tk_franja').html(json.data.franja_entregaDesc);
			break;
			
			// Casos en los que mostramos la fecha del cambio de estado
			case ESTADO_ENTREGA_ENTREGADA:
				$('#cont_franja').removeClass('showshape');
				$('#cont_franja').addClass('hideshape');
				$('#cont_fecha').removeClass('showshape');
				$('#cont_fecha').addClass('hideshape');
				$('#tk_estado').html(json.data.estado_entrega+' en fecha '+json.data.fecha_entrega_final);
			break;
			case ESTADO_ENTREGA_AUSENTE_O_CERRADO:
				$('#cont_franja').removeClass('showshape');
				$('#cont_franja').addClass('hideshape');
				$('#cont_fecha').removeClass('showshape');
				$('#cont_fecha').addClass('hideshape');
				$('#tk_estado').html(json.data.estado_entrega+' en fecha '+json.data.fecha_intento);
			break;
			case ESTADO_ENTREGA_DIRECCION_INCORRECTA_POR_REPARTIDOR:
				$('#cont_franja').removeClass('showshape');
				$('#cont_franja').addClass('hideshape');
				$('#cont_fecha').removeClass('showshape');
				$('#cont_fecha').addClass('hideshape');
				$('#tk_estado').html(json.data.estado_entrega+' en fecha '+json.data.fecha_intento);
			break;
			case ESTADO_ENTREGA_DIRECCION_INCOMPLETA_POR_REPARTIDOR:
				$('#cont_franja').removeClass('showshape');
				$('#cont_franja').addClass('hideshape');
				$('#cont_fecha').removeClass('showshape');
				$('#cont_fecha').addClass('hideshape');
				$('#tk_estado').html(json.data.estado_entrega+' en fecha '+json.data.fecha_intento);
			break;
			case ESTADO_ENTREGA_NO_ACEPTA_REEMBOLSO:
				$('#cont_franja').removeClass('showshape');
				$('#cont_franja').addClass('hideshape');
				$('#cont_fecha').removeClass('showshape');
				$('#cont_fecha').addClass('hideshape');
				$('#tk_estado').html(json.data.estado_entrega+' en fecha '+json.data.fecha_intento);
			break;
			case ESTADO_ENTREGA_CON_INCIDENCIAS:
				$('#cont_franja').removeClass('showshape');
				$('#cont_franja').addClass('hideshape');
				$('#cont_fecha').removeClass('showshape');
				$('#cont_fecha').addClass('hideshape');
				$('#tk_estado').html(json.data.estado_entrega+' <br/><font style="font-size:12px;">+ info en <a href="mailto:infoenvios@emakers.es" class="alert-link">infoenvios@emakers.es</a></font>');
				$('#tk_estado').parent().parent();
			break;
			case ESTADO_ENTREGA_RECOGER_EN_AGENCIA:
				$('#cont_franja').removeClass('showshape');
				$('#cont_franja').addClass('hideshape');
				$('#cont_fecha').removeClass('showshape');
				$('#cont_fecha').addClass('hideshape');
				$('#tk_estado').html(json.data.estado_entrega+' en fecha '+json.data.fecha_intento);
			break;
			case ESTADO_ENTREGA_DEVOLVER_A_REMITENTE:
				$('#cont_franja').removeClass('showshape');
				$('#cont_franja').addClass('hideshape');
				$('#cont_fecha').removeClass('showshape');
				$('#cont_fecha').addClass('hideshape');
				$('#tk_estado').html(json.data.estado_entrega);
			break;
			case ESTADO_ENTREGA_DEVUELTO_A_REMITENTE:
				$('#cont_franja').removeClass('showshape');
				$('#cont_franja').addClass('hideshape');
				$('#cont_fecha').removeClass('showshape');
				$('#cont_fecha').addClass('hideshape');
				$('#tk_estado').html(json.data.estado_entrega);
			break;
			case ESTADO_ENTREGA_ORIGEN_NO_PREPARADO:
				$('#cont_franja').removeClass('showshape');
				$('#cont_franja').addClass('hideshape');
				$('#cont_fecha').removeClass('showshape');
				$('#cont_fecha').addClass('hideshape');
				$('#tk_estado').html(json.data.estado_entrega+' en fecha '+json.data.fecha_intento);
			break;
			
			// Caso en el que mostramos la ventana horaria de entrega
			case ESTADO_ENTREGA_EN_RUTA: 
				$('#cont_franja').removeClass('hideshape');
				$('#cont_franja').addClass('showshape');
				$('#cont_fecha').removeClass('hideshape');
				$('#cont_fecha').addClass('showshape');
				$('#tk_estado').html(json.data.estado_entrega);
				$('#tk_franja').html(json.data.ventanaEntrega);
			break;
			
			// Caso no controlado
			default:
				// Si no hemos enviado mail, no mostramos la franja aún
				if(json.data.ifMailPre == 1){
					$('#cont_franja').removeClass('hideshape');
					$('#cont_franja').addClass('showshape');
				}else{
					$('#cont_franja').removeClass('showshape');
					$('#cont_franja').addClass('hideshape');
				}
				$('#cont_fecha').removeClass('hideshape');
				$('#cont_fecha').addClass('showshape');
				$('#tk_estado').html(json.data.estado_entrega);
				$('#tk_franja').html(json.data.franja_entregaDesc);
			break;
		}
	// PRECARGAS
	}else{
		// Si no hemos enviado mail, no mostramos la franja aún
		if(json.data.ifMailPre == 1){
			$('#cont_franja').removeClass('hideshape');
			$('#cont_franja').addClass('showshape');
		}else{
			$('#cont_franja').removeClass('showshape');
			$('#cont_franja').addClass('hideshape');
		}
		$('#cont_fecha').removeClass('hideshape');
		$('#cont_fecha').addClass('showshape');
		$('#tk_estado').html(json.data.estado_entrega);
		$('#tk_franja').html(json.data.franja_entregaDesc);
	}
	
	// Fecha de entrega
	$('#tk_fecha_entrega_cliente').html(json.data.fecha_entrega_cliente);
	
	// Datos del destinatario
	$('#tk_nombre_destinatario').html(json.data.nombre_destinatario);
	if(json.data.otros_direccion == null || json.data.otros_direccion == ''){
		$('#tk_direccion_entrega').html(json.data.direccion+' '+json.data.numero+', '+json.data.cp+' '+json.data.localidad);
	}else{
		$('#tk_direccion_entrega').html(json.data.direccion+' '+json.data.numero+' ('+json.data.otros_direccion+'), '+json.data.cp+' '+json.data.localidad);	
	}
	
	// Datos de control
	$('#id2_pedido').val(json.data.id2);	
	$('#tabla_origen').val(json.data.tabla_origen);	
	$('#cf_agencia').val(json.data.cf_agencia_destino);
	$('#num_pedido').val(json.data.num_pedido);
	
	// Decidimos si hay que mostrar el formulario o no
	reiniciaInputsFormulario();
	if(json.data.show_opciones == 0){
		// Escondemos los controles
		$('#controlsShapeContent').removeClass('showshape');
		$('#controlsShapeContent').addClass('hideshape');
		
		// Si no las mostramos porque el pedido es TIPSA...
		if(parseInt(json.data.otros_operadores) == 1){
			// No hay franja posible ni fecha del cambio de estado
			$('#tk_estado').html(json.data.estado_entrega);
			$('#cont_franja').removeClass('showshape');
			$('#cont_franja').addClass('hideshape');
			$('#notasTipsa').removeClass('hideshape');
			$('#notasTipsa').addClass('showshape');
			$('#notasNOTipsa').removeClass('showshape');
			$('#notasNOTipsa').addClass('hideshape');
			
		}else{
			$('#notasTipsa').removeClass('showshape');
			$('#notasTipsa').addClass('hideshape');
			$('#notasNOTipsa').removeClass('hideshape');
			$('#notasNOTipsa').addClass('showshape');
		}
	}else{
		// Rellenamos el select de franjas segun horario y conf_franja
		calculaFranjasDisponibles(json.data.conf_franja, json.data.fecha_entrega_cliente);
		$('#diadeentrega').data("DateTimePicker").setDate(json.cambios.fecha_entrega_cliente);
		
		// Rellenamos el formulario
		$('#input_dia_entrega').val(json.data.fecha_entrega_cliente);	
		$('#input_telefono1').val(json.data.telf_destinatario);	
		$('#input_telefono2').val(json.data.telf_destinatario_2);	
		$('#input_email').val(json.data.email);	
		$('#conf_franja').val(json.data.conf_franja);	
		$('#conf_franja').selectpicker('refresh');
		$('#input_comentarios_cliente').html(json.data.comentarios_cliente);
		
		// Mostramos los controles
		$('#controlsShapeContent').removeClass('hideshape');
		$('#controlsShapeContent').addClass('showshape');
		
		// Escondemos la capa de pedido tipo TIPSA
		$('#notasTipsa').removeClass('showshape');
		$('#notasTipsa').addClass('hideshape');
		
		// Ponemos los datos de horarios en formulario
		$('#hora1_inicio').val(json.data.horario1_inicio);	
		$('#hora1_final').val(json.data.horario1_final);	
		$('#hora2_inicio').val(json.data.horario2_inicio);	
		$('#hora2_final').val(json.data.horario2_final);
		
		// Ponemos los datos de horarios en datos originales
		$('#horario1_inicio_original').val(json.data.horario1_inicio);	
		$('#horario1_fin_original').val(json.data.horario1_final);	
		$('#horario2_inicio_original').val(json.data.horario2_inicio);	
		$('#horario2_fin_original').val(json.data.horario2_final);
		
		// Ponemos los datos de configuracion de notificaciones
		if(json.data.ifCOM10 == 1){
			$('#ifCOM10').attr('checked', true);
		}else{
			$('#ifCOM10').attr('checked', false);
		}
		if(json.data.ifCOMPre == 1){
			$('#ifCOMPre').attr('checked', true);
		}else{
			$('#ifCOMPre').attr('checked', false);
		}
		if(json.data.ifCOMPost == 1){
			$('#ifCOMPost').attr('checked', true);
		}else{
			$('#ifCOMPost').attr('checked', false);
		}
		if(json.data.ifCOMAus == 1){
			$('#ifCOMAus').attr('checked', true);
		}else{
			$('#ifCOMAus').attr('checked', false);
		}
		if(json.data.ifCOMDir == 1){
			$('#ifCOMDir').attr('checked', true);
		}else{
			$('#ifCOMDir').attr('checked', false);
		}
		
		// Controles de portería y vecino
		if(json.data.ifPorteria == 1){
			$('#ifPorteria').attr('checked', true);
		}else{
			$('#ifPorteria').attr('checked', false);
		}
		if(json.data.ifVecino == 1){
			$('#ifVecino').attr('checked', true);
		}else{
			$('#ifVecino').attr('checked', false);
		}
		$('#vecino_desc').val(json.data.vecino_desc);
		
		// Ponemos los datos del formulario de dirección
		$('#ip_cf_tipo_via').val(json.data.cf_tipo_via);
		$('#ip_cf_tipo_via').selectpicker('refresh');
		$('#ip_direccion').val(json.data.direccion);
		$('#ip_numero').val(json.data.numero);
		$('#ip_cp').val(json.data.cp);
		$('#ip_otros_direccion').val(json.data.otros_direccion);
		$('#input_comentarios_cliente').val(json.data.comentarios_cliente);
		
		// Si la direccion tiene algun tipo de error, mostramos la alerta de direccion mal
		if(json.data.error_en_direccion == 1){
			$('#alert_dir_mal').removeClass('hideshape');
			$('#alert_dir_mal').addClass('showshape');
			controlOp(3);
		}else{
			$('#alert_dir_mal').removeClass('showshape');
			$('#alert_dir_mal').addClass('hideshape');
		}
	
		// Si el pedido esta en ruta, mostramos la alerta en cambio de direccion
		if(json.data.cf_estado == 10){
			$('#alert_en_ruta').removeClass('hideshape');
			$('#alert_en_ruta').addClass('showshape');
		}else{
			$('#alert_en_ruta').removeClass('showshape');
			$('#alert_en_ruta').addClass('hideshape');
		}
		
		// Si el pedido lleva reembolso, mostramos la alerta en cambio de direccion
		if(parseFloat(json.data.valor_reembolso) > 0){
			$('#alert_contrareembolso').removeClass('hideshape');
			$('#alert_contrareembolso').addClass('showshape');
		}else{
			$('#alert_contrareembolso').removeClass('showshape');
			$('#alert_contrareembolso').addClass('hideshape');
		}
		
		// Colocamos los datos originales en los campos hidden
		$('#cf_tipo_via_original').val(json.data.cf_tipo_via);
		$('#direccion_original').val(json.data.direccion);
		$('#numero_original').val(json.data.numero);
		$('#cp_original').val(json.data.cp);
		$('#fecha_original').val(json.data.fecha_entrega_cliente);
		$('#franja_original').val(json.data.conf_franja);
		$('#localidad_original').val(json.data.localidad);
		
		// Si el pedido tiene cambios pendientes, los mostramos
		if(json.cambios.cambios_direccion == 1 || json.cambios.cambios_prevision == 1){
			$('#alert_cambios_pendientes').removeClass('hideshape');
			$('#alert_cambios_pendientes').addClass('showshape');
			
			// Si tiene cambios de dirección
			if(json.cambios.cambios_direccion == 1){
				// Ficha
				if(json.cambios.otros_direccion == null || json.cambios.otros_direccion == ''){
					if(json.cambios.cf_tipo_via != 0){
						$('#tk_direccion_entrega').html(json.cambios.tipo_viaDesc+' '+json.cambios.direccion+' '+json.cambios.numero+', '+json.cambios.cp+' '+json.cambios.localidad+' <span class="glyphicon glyphicon-exclamation-sign alert-danger" aria-hidden="true"></span>');
					}else{
						$('#tk_direccion_entrega').html(json.cambios.direccion+' '+json.cambios.numero+', '+json.cambios.cp+' '+json.cambios.localidad+' <span class="glyphicon glyphicon-exclamation-sign alert-danger" aria-hidden="true"></span>');
					}
					
				}else{
					if(json.cambios.cf_tipo_via != 0){
						$('#tk_direccion_entrega').html(json.cambios.tipo_viaDesc+' '+json.cambios.direccion+' '+json.cambios.numero+' ('+json.cambios.otros_direccion+'), '+json.cambios.cp+' '+json.cambios.localidad+' <span class="glyphicon glyphicon-exclamation-sign alert-danger" aria-hidden="true"></span>');	
					}else{
						$('#tk_direccion_entrega').html(json.cambios.direccion+' '+json.cambios.numero+' ('+json.cambios.otros_direccion+'), '+json.cambios.cp+' '+json.cambios.localidad+' <span class="glyphicon glyphicon-exclamation-sign alert-danger" aria-hidden="true"></span>');	
					}
				}

				// Formulario
				$('#ip_cf_tipo_via').val(json.cambios.cf_tipo_via);
				$('#ip_cf_tipo_via').selectpicker('refresh');
				$('#ip_direccion').val(json.cambios.direccion);
				$('#ip_numero').val(json.cambios.numero);
				$('#ip_cp').val(json.cambios.cp);
				$('#ip_otros_direccion').val(json.cambios.otros_direccion);
				
				// Si hay cambios de direccion, actualizamos los campos hidden
				$('#cf_tipo_via_original').val(json.cambios.cf_tipo_via);
				$('#direccion_original').val(json.cambios.direccion);
				$('#numero_original').val(json.cambios.numero);
				$('#cp_original').val(json.cambios.cp);
			}
			
			// Si tiene cambios de prevision de entrega
			if(json.cambios.cambios_prevision == 1){
				// Ficha
				$('#tk_fecha_entrega_cliente').html(json.cambios.fecha_entrega_cliente+' <span class="glyphicon glyphicon-exclamation-sign alert-danger" aria-hidden="true"></span>');
				$('#tk_franja').html(json.cambios.franja+' <span class="glyphicon glyphicon-exclamation-sign alert-danger" aria-hidden="true"></span>');
				
				// Formulario
				$('#diadeentrega').data("DateTimePicker").setDate(json.cambios.fecha_entrega_clienteForm);
				$('#input_franja_entrega').val(json.cambios.cf_franja);
				$('#input_franja_entrega').selectpicker('refresh');
				
				// Si hay cambios de prevision de entrega, actualizamos los campos hidden
				$('#fecha_original').val(json.cambios.fecha_entrega_cliente);
				$('#franja_original').val(json.cambios.cf_franja);
			}
		}else{
			$('#alert_cambios_pendientes').removeClass('showshape');
			$('#alert_cambios_pendientes').addClass('hideshape');
		}
	}
}

function calculaFranjasDisponibles(conf_franja, fecha_entrega_cliente){
	// Calculamos el horario actual
	var now = new Date();
	var now_hora = now.getHours();
	var day_now = now.getDate();
	if(day_now < 10){ day_now = '0'+day_now; }
	var month_now = (parseInt(now.getMonth())+1);
	if(month_now < 10){ month_now = '0'+month_now }
	var date_now = day_now+'/'+month_now+'/'+now.getFullYear();
	
	// Parseamos la fecha de entrega del cliente
	var fecha_cliente_parseada = parseDate(fecha_entrega_cliente);
	
	// Calculamos la diferencia entre fechas
	var date_diff = (fecha_cliente_parseada.getTime() - parseDate(date_now).getTime());
	
	// Si la fecha de entrega introducida en el formulario es hoy
	if(date_diff == 0){
		// Configuraciones INTRARADIO
		if(conf_franja == 1){
			// Segun el horario actual, mostraremos unas franjas u otras
			if(now_hora < 8){
				// Rellenamos con todas las franjas
				rellenaFranjas_todas();
			}else if(now_hora >= 8 && now_hora < 13){
				// Rellenamos con las franjas a partir de la tarde
				rellenaFranjas_tarde();
			}else if(now_hora >= 13 && now_hora < 17){
				// Rellenamos con las franjas a partir de la noche
				rellenaFranjas_noche();
			}else{
				// No hay frnjas disponibles
				sinFranjasDisponibles();
			}
		
		// Configuraciones EXTRARADIO
		}else{
			if(now_hora < 11){
				// Rellenamos con las franjas de diurna
				rellenaFranjas_diurna_todas();
			}else if(now_hora >= 11 && now_hora < 17){
				// Rellenamos con las franjas a partir de la noche
				rellenaFranjas_diurna_noche();
			}else{
				// No hay frnjas disponibles
				sinFranjasDisponibles();
			}
		}
	
	// Si la fecha introducida en el formulario es anterior a hoy
	}else if(date_diff < 0){
		// No hay frnjas disponibles
		sinFranjasDisponibles();
	
	// Si la fecha introducida es para mañana... aplicamos condiciones de uso
	}else if(date_diff == 86400000){
		if(now_hora < 18){
			if(conf_franja == 1){
				// Rellenamos con todas las franjas
				rellenaFranjas_todas();
			}else{
				// Rellenamos con las franjas de diurna
				rellenaFranjas_diurna_todas();
			}
		}else if(now_hora >= 18 && now_hora < 20){
			if(conf_franja == 1){
				// Rellenamos con las franjas a partir de la tarde
				rellenaFranjas_tarde();
			}else{
				// Rellenamos con las franjas a partir de la noche
				rellenaFranjas_diurna_noche();
			}
		}else if(now_hora >= 20 && now_hora < 22){
			if(conf_franja == 1){
				// Rellenamos con las franjas a partir de la noche
				rellenaFranjas_noche();
			}else{
				// Rellenamos con las franjas a partir de la noche
				rellenaFranjas_noche();
			}
		}else{
			// No hay frnjas disponibles
			sinFranjasDisponibles();
		}
	// Si la fecha introducida en el formulario es posterior a hoy
	}else if(date_diff > 0){
		if(conf_franja == 1){
			// Rellenamos con todas las franjas
			rellenaFranjas_todas();
		}else{
			// Rellenamos con las franjas de diurna
			rellenaFranjas_diurna_todas();
		}
	}
}

function rellenaFranjas_todas(){
	// Vaciamos el select primero
	$('#input_franja_entrega').html('');
	$('#input_franja_entrega').prop('disabled',false);
	$('#input_franja_entrega').append("<option selected=\"selected\" value=\"1\">MAÑANA (09:00 - 14:00)</option>");
	$('#input_franja_entrega').append("<option value=\"2\">TARDE (15:00 - 18:30)</option>");
	$('#input_franja_entrega').append("<option value=\"3\">NOCHE (19:00 - 22:00)</option>");
	$('#input_franja_entrega').selectpicker('render');
	$('#input_franja_entrega').selectpicker('refresh');
}

function rellenaFranjas_tarde(){
	// Vaciamos el select primero
	$('#input_franja_entrega').html('');
	$('#input_franja_entrega').prop('disabled',false);
	$('#input_franja_entrega').append("<option selected=\"selected\" value=\"2\">TARDE (15:00 - 18:30)</option>");
	$('#input_franja_entrega').append("<option value=\"3\">NOCHE (19:00 - 22:00)</option>");
	$('#input_franja_entrega').selectpicker('render');
	$('#input_franja_entrega').selectpicker('refresh');
}

function rellenaFranjas_noche(){
	// Vaciamos el select primero
	$('#input_franja_entrega').html('');
	$('#input_franja_entrega').prop('disabled',false);
	$('#input_franja_entrega').append("<option selected=\"selected\" value=\"3\">NOCHE (19:00 - 22:00)</option>");
	$('#input_franja_entrega').selectpicker('render');
	$('#input_franja_entrega').selectpicker('refresh');
}

function rellenaFranjas_diurna_todas(){
	// Vaciamos el select primero
	$('#input_franja_entrega').html('');
	$('#input_franja_entrega').prop('disabled',false);
	$('#input_franja_entrega').append("<option selected=\"selected\" value=\"4\">DIURNA (12:00 - 17:00)</option>");
	$('#input_franja_entrega').append("<option value=\"3\">NOCHE (19:00 - 22:00)</option>");
	$('#input_franja_entrega').selectpicker('render');
	$('#input_franja_entrega').selectpicker('refresh');
}

function rellenaFranjas_diurna_noche(){
	// Vaciamos el select primero
	$('#input_franja_entrega').html('');
	$('#input_franja_entrega').prop('disabled',false);
	$('#input_franja_entrega').append("<option selected=\"selected\" value=\"3\">NOCHE (19:00 - 22:00)</option>");
	$('#input_franja_entrega').selectpicker('render');
	$('#input_franja_entrega').selectpicker('refresh');
}

function sinFranjasDisponibles(){
	$('#input_franja_entrega').html('');
	$('#input_franja_entrega').append("<option selected=\"selected\" value=\"-1\">Sin franjas dipsonibles para la fecha seleccionada</option>");
	$('#input_franja_entrega').prop('disabled',true);
	$('#input_franja_entrega').selectpicker('render');
	$('#input_franja_entrega').selectpicker('refresh');
}

function reiniciaInputsFormulario(){
	$('#input_dia_entrega').val('');	
	$('#input_franja_entrega').val(0);	
	$('#input_telefono1').val('');	
	$('#input_telefono2').val('');	
	$('#input_email').val('');	
	$('#input_comentarios_cliente').html('');		
}


function abortRequest(){
	requestInfo.abort();
}

function sendFranjaChange(){
	//num pedido
	var num_pedido = $("#num_pedido").val();
	// agencia destino
	var cf_agencia = $("#cf_agencia").val();
	//get dia entrega
	var fecha_entrega = $("#input_dia_entrega").val();
	//get franja entrega
	var id_franja = $("#input_franja_entrega").val();
	//get numero de telefono
	var telefono = $("#input_telefono1").val();
	var telefono2 = $("#input_telefono2").val();
	//get comentarios
	var comentarios = $("#input_comentarios_cliente").val();
	//get comentarios
	var mail = $("#input_email").val();
	//get id2
	var id2 = $("#id2_pedido").val();
	// get tabla origen
	var tabla_origen = $('#tabla_origen').val();
	
	// Otros datos
	var abonado = $('#tk_nombre_abonado').html();
	var fechaAlta = $('#tk_fecha_alta').html();
	var franjaSolicitada = $("#input_franja_entrega option:selected").text();
	var nombreDestinatario = $('#tk_nombre_destinatario').html();
	var direccionDestinatario = $('#tk_direccion_entrega').html();
	
	// Calculamos la fecha de hoy
	var now = new Date();
	var day_now = now.getDate();
	if(day_now < 10){ day_now = '0'+day_now; }
	var month_now = (parseInt(now.getMonth())+1);
	if(month_now < 10){ month_now = '0'+month_now }
	var date_now = day_now+'/'+month_now+'/'+now.getFullYear();
	
	// Comparamos la fecha seleccionada con la fecha de hoy
	var date_diff = (new Date(fecha_entrega).getTime() - new Date(date_now).getTime());
	
	// Comprovamos que la fecha seleccionada sea como minimo la fecha de hoy
	// Debemos comprovar que la franja seleccionada sea > 1
	if(date_diff < 0|| id_franja <= 0){
		$('#triggerError_fecha_franjaShape').trigger('click');
	}else{
		//send ajax
		$.ajax({
			type: "POST",
			url: base_url+lang_site+"/tracking/setFranjaChange",
			data: "fecha_entrega="+fecha_entrega+
				  "&num_pedido="+num_pedido+
				  "&id_franja_entrega="+id_franja+
				  "&comentarios_cliente="+comentarios+
				  "&telefono="+telefono+
				  "&telefono2="+telefono2+
				  "&email="+mail+
				  "&id2="+id2+
				  "&cf_agencia="+cf_agencia+
				  "&tabla_origen="+tabla_origen,
			beforeSend: function(x) {
				$('#triggerError_cambiosLoading').trigger('click');
			},
			success: function(msg){
				$('#Error_loading_cambios').modal('toggle');
				var json = jQuery.parseJSON(msg);
				
				// Si el resultado del cambio es correcto
				if(json!=null && json.status == "OK"){
					// Colocamos los datos en la pantalla de confirmacion
					$('#cn_num_pedido').html(num_pedido);
					$('#cn_nombre_abonado').html(abonado);
					$('#cn_fecha_alta').html(fechaAlta);
					$('#cn_fecha_entrega_cliente').html(fecha_entrega);
					$('#cn_franja').html(franjaSolicitada);
					$('#cn_nombre_destinatario').html(nombreDestinatario);
					$('#cn_direccion_entrega').html(direccionDestinatario);
					$('#cn_telefono1').html(telefono);
					$('#cn_telefono2').html(telefono2);
					$('#cn_email').html(mail);
					$('#cn_comentarios_cliente').html(comentarios);
					
					// Escondemos el formulario del fondo y cerramos los datos
					$('#generalShapeContent').addClass('hideshape');
					
					// Mostramos la capa de confirmacion
					$('#triggerConfirmacion_realizadaShape').trigger('click');
					
				}else if(json!=null && json.status == "KO"){
					// Mostramos la capa de error
					$('#error_num_pedido').html(num_pedido);
					$('#triggerError_solicitudShape').trigger('click');
				}else{
					// Mostramos la capa de error:::CASO NO CONTROLADO
					$('#error_num_pedido').html(num_pedido);
					$('#triggerError_solicitudShape').trigger('click');
				}
			}
		});
	}
}

function solicitarNuevosCambios(){
	$('#confirmacion').modal('toggle');
}
function cambiosCorrectos(){
	$('#generalShapeContent').addClass('hideshape');
	$('#confirmacion').modal('toggle');
}

function controlOp(idControl){
	// Escondemos todos los formularios
	$('#cambiosForm1').removeClass('showshape');
	$('#cambiosForm1').addClass('hideshape');
	$('#cambiosForm2').removeClass('showshape');
	$('#cambiosForm2').addClass('hideshape');
	$('#cambiosForm3').removeClass('showshape');
	$('#cambiosForm3').addClass('hideshape');
	
	// Escondemos todas las opciones menos la activada
	$('#ctrop1').removeClass('showshape');
	$('#ctrop1 button').removeClass('active');
	$('#ctrop1').addClass('hideshape');
	$('#ctrop2').removeClass('showshape');
	$('#ctrop2 button').removeClass('active');
	$('#ctrop2').addClass('hideshape');
	$('#ctrop3').removeClass('showshape');
	$('#ctrop3 button').removeClass('active');
	$('#ctrop3').addClass('hideshape');
	
	// Activamos la opcion activada
	$('#ctrop'+idControl).removeClass('hideshape');
	$('#ctrop'+idControl).addClass('showshape');
	$('#ctrop'+idControl+' button').addClass('active');
	
	// Activamos el formulario pertinente
	$('#cambiosForm'+idControl).removeClass('hideshape');
	$('#cambiosForm'+idControl).addClass('showshape');
}

function controlOpShowdown(){
	// Escondemos formularios, desactivamos botones y mostramos controles
	$('#cambiosForm1').removeClass('showshape');
	$('#cambiosForm1').addClass('hideshape');
	$('#cambiosForm2').removeClass('showshape');
	$('#cambiosForm2').addClass('hideshape');
	$('#cambiosForm3').removeClass('showshape');
	$('#cambiosForm3').addClass('hideshape');
	
	// Activamos todas los controles
	$('#ctrop1').removeClass('hideshape');
	$('#ctrop1').addClass('showshape');
	$('#ctrop1 button').removeClass('active');
	$('#ctrop2').removeClass('hideshape');
	$('#ctrop2').addClass('showshape');
	$('#ctrop2 button').removeClass('active');
	$('#ctrop3').removeClass('hideshape');
	$('#ctrop3').addClass('showshape');
	$('#ctrop3 button').removeClass('active');
}

function guardaFormOp(idForm){
	//num pedido
	var num_pedido = $("#num_pedido").val();
	// agencia destino
	var cf_agencia = $("#cf_agencia").val();
	//get id2
	var id2 = $("#id2_pedido").val();
	// get tabla origen
	var tabla_origen = $('#tabla_origen').val();
	// Otros datos
	var abonado = $('#tk_nombre_abonado').html();
	var fechaAlta = $('#tk_fecha_alta').html();
	var franjaSolicitada = $("#input_franja_entrega option:selected").text();
	var nombreDestinatario = $('#tk_nombre_destinatario').html();
	var direccionDestinatario = $('#tk_direccion_entrega').html();
	// segun el formulario activado, comprovamos...
	// Formulario de fecha y franja
	if(idForm == 1){
		//get dia entrega
		var fecha_entrega = $("#input_dia_entrega").val();
		
		//get franja entrega
		var id_franja = $("#input_franja_entrega").val();
		
		// Calculamos la fecha de hoy
		var now = new Date();
		var day_now = now.getDate();
		if(day_now < 10){ day_now = '0'+day_now; }
		var month_now = (parseInt(now.getMonth())+1);
		if(month_now < 10){ month_now = '0'+month_now }
		var date_now = day_now+'/'+month_now+'/'+now.getFullYear();
		
		// Comparamos la fecha seleccionada con la fecha de hoy
		var date_diff = (new Date(fecha_entrega).getTime() - new Date(date_now).getTime());
		
		// Pillamos los datos de horario
		var hora1_inicio = $('#hora1_inicio').val();
		var hora1_final = $('#hora1_final').val();
		var hora2_inicio = $('#hora2_inicio').val();
		var hora2_final = $('#hora2_final').val();
		
		// Recuperamos los datos de horario originales
		var horario1_inicio_original = $('#horario1_inicio_original').val();	
		var horario1_fin_original = $('#horario1_fin_original').val();	
		var horario2_inicio_original = $('#horario2_inicio_original').val();	
		var horario2_fin_original = $('#horario2_fin_original').val();
		
		// Recuperamos tambien los datos originales de fecha y franja
		var fecha_original = $('#fecha_original').val();
		var franja_original = $('#franja_original').val();
		
		// Podemos enviar solo los datos de los horarios o todo el formulario al completo...
		// Si los datos de horario no han cambiado, comprovamos la validez de la fecha & franja
		if(hora1_inicio == horario1_inicio_original && hora1_final == horario1_fin_original && hora2_inicio == horario2_inicio_original && hora2_final == horario2_fin_original){
			if(date_diff < 0|| id_franja <= 0){
				$('#triggerError_fecha_franjaShape').trigger('click');
				return;
			}else{
				// mount data post
				var datapost = "fecha_entrega="+fecha_entrega+
					  "&num_pedido="+num_pedido+
					  "&id_franja_entrega="+id_franja+
					  "&hora1_inicio="+hora1_inicio+
					  "&hora1_final="+hora1_final+
					  "&hora2_inicio="+hora2_inicio+
					  "&hora2_final="+hora2_final+
					  "&id2="+id2+
					  "&cf_agencia="+cf_agencia+
					  "&idForm="+idForm+
					  "&tabla_origen="+tabla_origen;
			}
			
		// Si los datos de los horarios si han cambiado, se debe permitir enviar el formulario (si la fecha & franja no han cambiado)
		}else if(fecha_original == fecha_entrega && (franja_original == id_franja || id_franja == -1)){
			// Comprovamos tambien que si hay definido un horario, su parejo tambien debe estar definido
			if(hora1_inicio == '' && hora1_final != ''){ $('#triggerError_horarios_franjaShape').trigger('click'); return; } // triggerError_horarios_franjaShape
			if(hora1_final == '' && hora1_inicio != ''){ $('#triggerError_horarios_franjaShape').trigger('click'); return; }
			if(hora2_inicio == '' && hora2_final != ''){ $('#triggerError_horarios_franjaShape').trigger('click'); return; }
			if(hora2_final == '' && hora2_inicio != ''){ $('#triggerError_horarios_franjaShape').trigger('click'); return; }
			
			// Deben ener el caracter ':' para asegurar el formato
			if(hora1_inicio != ''){
				if(hora1_inicio.length != 5){
					$('#triggerError_horarios_franjaShape').trigger('click');
					return;
				}
				if(hora1_inicio.indexOf(':') === -1){
					$('#triggerError_horarios_franjaShape').trigger('click');
					return;
				}
			}
			
			if(hora1_final != ''){
				if(hora1_final.length != 5){
					$('#triggerError_horarios_franjaShape').trigger('click');
					return;
				}
				if(hora1_final.indexOf(':') === -1){
					$('#triggerError_horarios_franjaShape').trigger('click');
					return;
				}
			}
			
			if(hora2_inicio != ''){
				if(hora2_inicio.length != 5){
					$('#triggerError_horarios_franjaShape').trigger('click');
					return;
				}
				if(hora2_inicio.indexOf(':') === -1){
					$('#triggerError_horarios_franjaShape').trigger('click');
					return;
				}
			}
			
			if(hora2_final != ''){
				if(hora2_final.length != 5){
					$('#triggerError_horarios_franjaShape').trigger('click');
					return;
				}
				if(hora2_final.indexOf(':') === -1){
					$('#triggerError_horarios_franjaShape').trigger('click');
					return;
				}
			}
			
			// Comprovamos que los horarios son correctos y tienen una franja de 3h minimo si es que no estan vacios y cumplen el formato
			var y = '2015';
			var m = '01';
			var d = '01';
			
			var h1i = hora1_inicio.split(':')[0];
			var m1i = hora1_inicio.split(':')[1];
			var h1f = hora1_final.split(':')[0];
			var m1f = hora1_final.split(':')[1];
			
			var h2i = hora2_inicio.split(':')[0];
			var m2i = hora2_inicio.split(':')[1];
			var h2f = hora2_final.split(':')[0];
			var m2f = hora2_final.split(':')[1];
			
			var t1i = new Date(y, m, d, h1i, m1i);
			var t1f = new Date(y, m, d, h1f, m1f);
			
			var t2i = new Date(y, m, d, h2i, m2i);
			var t2f = new Date(y, m, d, h2f, m2f);
			
			// Si las horas fins son superiores a las horas inicio.... error
			if(h1i > h1f){
				$('#triggerError_horarios_franjaShape').trigger('click');
				return;
			}
			if(h2i > h2f){
				$('#triggerError_horarios_franjaShape').trigger('click');
				return;
			}
			
			var d1 = t1f.getTime() - t1i.getTime();
			var d2 = t2f.getTime() - t2i.getTime();
			
			if( d1 < (3*3600*1000) ){
				$('#triggerError_horarios_franjaShape').trigger('click');
				return;
			}
			
			if( d2 < (3*3600*1000) ){
				$('#triggerError_horarios_franjaShape').trigger('click');
				return;
			}
			
			idForm = 12;
			// mount data post
			var datapost = "num_pedido="+num_pedido+
			  "&hora1_inicio="+hora1_inicio+
			  "&hora1_final="+hora1_final+
			  "&hora2_inicio="+hora2_inicio+
			  "&hora2_final="+hora2_final+
			  "&id2="+id2+
			  "&cf_agencia="+cf_agencia+
			  "&idForm="+idForm+
			  "&tabla_origen="+tabla_origen;

		// En cualquier otro caso, han cambiado tanto horarios como fecha / franja
		}else{
			// Comprovamos tambien que si hay definido un horario, su parejo tambien debe estar definido
			if(hora1_inicio == '' && hora1_final != ''){ $('#triggerError_horarios_franjaShape').trigger('click'); return; } // triggerError_horarios_franjaShape
			if(hora1_final == '' && hora1_inicio != ''){ $('#triggerError_horarios_franjaShape').trigger('click'); return; }
			if(hora2_inicio == '' && hora2_final != ''){ $('#triggerError_horarios_franjaShape').trigger('click'); return; }
			if(hora2_final == '' && hora2_inicio != ''){ $('#triggerError_horarios_franjaShape').trigger('click'); return; }
			
			// Deben ener el caracter ':' para asegurar el formato
			if(hora1_inicio != ''){
				if(hora1_inicio.length != 5){
					$('#triggerError_horarios_franjaShape').trigger('click');
					return;
				}
				if(hora1_inicio.indexOf(':') === -1){
					$('#triggerError_horarios_franjaShape').trigger('click');
					return;
				}
			}
			
			if(hora1_final != ''){
				if(hora1_final.length != 5){
					$('#triggerError_horarios_franjaShape').trigger('click');
					return;
				}
				if(hora1_final.indexOf(':') === -1){
					$('#triggerError_horarios_franjaShape').trigger('click');
					return;
				}
			}
			
			if(hora2_inicio != ''){
				if(hora2_inicio.length != 5){
					$('#triggerError_horarios_franjaShape').trigger('click');
					return;
				}
				if(hora2_inicio.indexOf(':') === -1){
					$('#triggerError_horarios_franjaShape').trigger('click');
					return;
				}
			}
			
			if(hora2_final != ''){
				if(hora2_final.length != 5){
					$('#triggerError_horarios_franjaShape').trigger('click');
					return;
				}
				if(hora2_final.indexOf(':') === -1){
					$('#triggerError_horarios_franjaShape').trigger('click');
					return;
				}
			}
			
			// Comprovamos que los horarios son correctos y tienen una franja de 3h minimo si es que no estan vacios y cumplen el formato
			var y = '2015';
			var m = '01';
			var d = '01';
			
			var h1i = hora1_inicio.split(':')[0];
			var m1i = hora1_inicio.split(':')[1];
			var h1f = hora1_final.split(':')[0];
			var m1f = hora1_final.split(':')[1];
			
			var h2i = hora2_inicio.split(':')[0];
			var m2i = hora2_inicio.split(':')[1];
			var h2f = hora2_final.split(':')[0];
			var m2f = hora2_final.split(':')[1];
			
			var t1i = new Date(y, m, d, h1i, m1i);
			var t1f = new Date(y, m, d, h1f, m1f);
			
			var t2i = new Date(y, m, d, h2i, m2i);
			var t2f = new Date(y, m, d, h2f, m2f);
			
			// Si las horas fins son superiores a las horas inicio.... error
			if(h1i > h1f){
				$('#triggerError_horarios_franjaShape').trigger('click');
				return;
			}
			if(h2i > h2f){
				$('#triggerError_horarios_franjaShape').trigger('click');
				return;
			}
			
			var d1 = t1f.getTime() - t1i.getTime();
			var d2 = t2f.getTime() - t2i.getTime();
			
			if( d1 < (3*3600*1000) ){
				$('#triggerError_horarios_franjaShape').trigger('click');
				return;
			}
			
			if( d2 < (3*3600*1000) ){
				$('#triggerError_horarios_franjaShape').trigger('click');
				return;
			}
			// Comprovamos que la fecha seleccionada sea como minimo la fecha de hoy
			// Debemos comprovar que la franja seleccionada sea > 1
			if(date_diff < 0|| id_franja <= 0){
				$('#triggerError_fecha_franjaShape').trigger('click');
				return;
			}else{
				// mount data post
				var datapost = "fecha_entrega="+fecha_entrega+
					  "&num_pedido="+num_pedido+
					  "&id_franja_entrega="+id_franja+
					  "&hora1_inicio="+hora1_inicio+
					  "&hora1_final="+hora1_final+
					  "&hora2_inicio="+hora2_inicio+
					  "&hora2_final="+hora2_final+
					  "&id2="+id2+
					  "&cf_agencia="+cf_agencia+
					  "&idForm="+idForm+
					  "&tabla_origen="+tabla_origen;
			}
		}
		
	// Formulario de datos y comentarios
	}else if(idForm == 2){
		//get numero de telefono
		var telefono = $("#input_telefono1").val();
		var telefono2 = $("#input_telefono2").val();
		//get comentarios
		var comentarios = $("#input_comentarios_cliente").val();
		//get comentarios
		var mail = $("#input_email").val();
		// Pillamos los datos de conf COMS
		var ifCOM10 = 0;
		if($('#ifCOM10').is(":checked")){
			ifCOM10 = 1;
		}
		var ifCOMPre = 0;
		if($('#ifCOMPre').is(":checked")){
			ifCOMPre = 1;
		}
		var ifCOMPost = 0;
		if($('#ifCOMPost').is(":checked")){
			ifCOMPost = 1;
		}
		var ifCOMAus = 0;
		if($('#ifCOMAus').is(":checked")){
			ifCOMAus = 1;
		}
		var ifCOMDir = 0;
		if($('#ifCOMDir').is(":checked")){
			ifCOMDir = 1;
		}
		
		// mount data post
		var datapost = "telefono="+telefono+
				  "&telefono2="+telefono2+
				  "&email="+mail+
				  "&ifCOM10="+ifCOM10+
				  "&ifCOMPre="+ifCOMPre+
				  "&ifCOMPost="+ifCOMPost+
				  "&ifCOMAus="+ifCOMAus+
				  "&ifCOMDir="+ifCOMDir+
				  "&id2="+id2+
				  "&cf_agencia="+cf_agencia+
				  "&idForm="+idForm+
				  "&tabla_origen="+tabla_origen;
		
	// Formulario de cambio de direccion
	}else if(idForm == 3){
		// get datos direccion
		var cf_tipo_via = $("#ip_cf_tipo_via").val();
		var ip_direccion = $("#ip_direccion").val();
		var ip_numero = $("#ip_numero").val();
		var ip_cp = $("#ip_cp").val();
		var ip_otros_direccion = $("#ip_otros_direccion").val();
		var input_comentarios_cliente = $("#input_comentarios_cliente").val();
		var ifPorteria = $("#ifPorteria").val();
		var ifVecino = $("#ifVecino").val();
		var vecino_desc = $("#vecino_desc").val();
		
		// mount data post
		var datapost = "cf_tipo_via="+cf_tipo_via+
				  "&ip_direccion="+ip_direccion+
				  "&ip_numero="+ip_numero+
				  "&ip_cp="+ip_cp+
				  "&ip_otros_direccion="+ip_otros_direccion+
				  "&id2="+id2+
				  "&cf_agencia="+cf_agencia+
				  "&idForm="+idForm+
				  "&comentarios_cliente="+input_comentarios_cliente+
				  "&ifPorteria="+ifPorteria+
				  "&ifVecino="+ifVecino+
				  "&vecino_desc="+vecino_desc+
				  "&tabla_origen="+tabla_origen;
		
	}else{
		$('#triggerError_fecha_franjaShape').trigger('click');
	}
	
	//send ajax
	$.ajax({
		type: "POST",
		url: base_url+lang_site+"/tracking/setFranjaChange",
		data: datapost,
		beforeSend: function(x) {
			$('#triggerError_cambiosLoading').trigger('click');
		},
		success: function(msg){
			$('#Error_loading_cambios').modal('toggle');
			var json = jQuery.parseJSON(msg);
			
			// Si el resultado del cambio es correcto
			if(json!=null && json.status == "OK"){
				// Mostramos que todo ha ido OK
				$('#triggerSaveShape').trigger('click');
				
				// Reiniciamos todos los formularios
				controlOpShowdown();
				
				// Segun los cambios pedidos, modificamos la ficha
				var fecha_original = $('#fecha_original').val();
				var franja_original = $('#franja_original').val();
				var cf_tipo_via_original = $('#cf_tipo_via_original').val();
				var direccion_original = $('#direccion_original').val();
				var numero_original = $('#numero_original').val();
				var cp_original = $('#cp_original').val();
				var localidad_original = $('#localidad_original').val();
				
				if(idForm == 1){
					// Si hay cambios en la prevision de entrega
					if((fecha_original != fecha_entrega) || (franja_original != id_franja)){
						var franjaDesc = $('#franja_desc'+id_franja).val();
						// Ficha
						$('#tk_fecha_entrega_cliente').html(fecha_entrega+' <span class="glyphicon glyphicon-exclamation-sign alert-danger" aria-hidden="true"></span>');
						$('#tk_franja').html(franjaDesc+' <span class="glyphicon glyphicon-exclamation-sign alert-danger" aria-hidden="true"></span>');
					
						// Mostramos la capa de aviso
						$('#alert_cambios_pendientes').removeClass('hideshape');
						$('#alert_cambios_pendientes').addClass('showshape');
					}
				}
				if(idForm == 3){
					// Si hay cambios en la dirección de entrega
					if( (cf_tipo_via_original != cf_tipo_via) || (direccion_original != ip_direccion) || (numero_original != ip_numero) || (cp_original != ip_cp) ){
						var tipo_viaDesc = $('#tipovia_desc'+cf_tipo_via).val();
						// Ficha
						if(ip_otros_direccion == null || ip_otros_direccion == ''){
							if(cf_tipo_via != 0){
								$('#tk_direccion_entrega').html(tipo_viaDesc+' '+ip_direccion+' '+ip_numero+', '+ip_cp+' '+localidad_original+' <span class="glyphicon glyphicon-exclamation-sign alert-danger" aria-hidden="true"></span>');
							}else{
								$('#tk_direccion_entrega').html(ip_direccion+' '+ip_numero+', '+ip_cp+' '+localidad_original+' <span class="glyphicon glyphicon-exclamation-sign alert-danger" aria-hidden="true"></span>');
							}
							
						}else{
							if(cf_tipo_via != 0){
								$('#tk_direccion_entrega').html(tipo_viaDesc+' '+ip_direccion+' '+ip_numero+' ('+ip_otros_direccion+'), '+ip_cp+' '+localidad_original+' <span class="glyphicon glyphicon-exclamation-sign alert-danger" aria-hidden="true"></span>');	
							}else{
								$('#tk_direccion_entrega').html(ip_direccion+' '+ip_numero+' ('+ip_otros_direccion+'), '+ip_cp+' '+localidad_original+' <span class="glyphicon glyphicon-exclamation-sign alert-danger" aria-hidden="true"></span>');	
							}
						}
						
						// Mostramos la capa de aviso
						$('#alert_cambios_pendientes').removeClass('hideshape');
						$('#alert_cambios_pendientes').addClass('showshape');
					}
				}
				
			}else if(json!=null && json.status == "KO"){
				// Mostramos la capa de error
				$('#error_num_pedido').html(num_pedido);
				$('#triggerError_solicitudShape').trigger('click');
			}else{
				// Mostramos la capa de error:::CASO NO CONTROLADO
				$('#error_num_pedido').html(num_pedido);
				$('#triggerError_solicitudShape').trigger('click');
			}
		}
	});
}