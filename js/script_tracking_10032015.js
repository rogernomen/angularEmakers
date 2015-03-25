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
    }else{
	    $('#input_franja_entrega').selectpicker({});
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
		
		// Configuracion de algunos festivos puntuales
		if(date_now == '29/01/2015' && cf_agencia == 9){
			sinFranjasDisponibles();
		}else{
			// Calculamos las franjas disponibles
			calculaFranjasDisponibles($('#conf_franja').val(), date_now);
		}
    });
    var today = new Date();
    var today2 = new Date(today.getTime());
    var yesterday = new Date(today.getTime() - (24 * 60 * 60 * 1000));
    
    $('#diadeentrega').data("DateTimePicker").setMinDate(today2);
});

function sendConsulta(){
	var error = false;
	
	// Escondemos la capa general de contenido
	$('#generalShapeContent').addClass('hideshape');
	
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
				$('#ifMailPre').val(json.data.ifMailPre);
				if(json.data.ifMailPre == 1){
					$('#cont_franja').removeClass('hideshape');
					$('#cont_franja').addClass('showshape');
					
					$('#cont_fecha').removeClass('hideshape');
					$('#cont_fecha').addClass('showshape');
				}else{
					$('#cont_franja').removeClass('showshape');
					$('#cont_franja').addClass('hideshape');
					
					$('#cont_fecha').removeClass('showshape');
					$('#cont_fecha').addClass('hideshape');
				}
			break;
			case ESTADO_ENTREGA_RECOGIDO:
				$('#cont_franja').removeClass('hideshape');
				$('#cont_franja').addClass('showshape');
				$('#cont_fecha').removeClass('hideshape');
				$('#cont_fecha').addClass('showshape');
				$('#tk_estado').html(json.data.estado_entrega);
				$('#tk_franja').html(json.data.franja_entregaDesc);
				if(json.data.ifMailPre == 1){
					$('#cont_franja').removeClass('hideshape');
					$('#cont_franja').addClass('showshape');
					
					$('#cont_fecha').removeClass('hideshape');
					$('#cont_fecha').addClass('showshape');
				}else{
					$('#cont_franja').removeClass('showshape');
					$('#cont_franja').addClass('hideshape');
					
					$('#cont_fecha').removeClass('showshape');
					$('#cont_fecha').addClass('hideshape');
				}
			break;
			case ESTADO_ENTREGA_EN_ALMACEN_ORIGEN:
				$('#cont_franja').removeClass('hideshape');
				$('#cont_franja').addClass('showshape');
				$('#cont_fecha').removeClass('hideshape');
				$('#cont_fecha').addClass('showshape');
				$('#tk_estado').html(json.data.estado_entrega);
				$('#tk_franja').html(json.data.franja_entregaDesc);
				if(json.data.ifMailPre == 1){
					$('#cont_franja').removeClass('hideshape');
					$('#cont_franja').addClass('showshape');
					
					$('#cont_fecha').removeClass('hideshape');
					$('#cont_fecha').addClass('showshape');
				}else{
					$('#cont_franja').removeClass('showshape');
					$('#cont_franja').addClass('hideshape');
					
					$('#cont_fecha').removeClass('showshape');
					$('#cont_fecha').addClass('hideshape');
				}
			break;
			case ESTADO_ENTREGA_EN_ALMACEN:
				$('#cont_franja').removeClass('hideshape');
				$('#cont_franja').addClass('showshape');
				$('#cont_fecha').removeClass('hideshape');
				$('#cont_fecha').addClass('showshape');
				$('#tk_estado').html(json.data.estado_entrega);
				$('#tk_franja').html(json.data.franja_entregaDesc);
				if(json.data.ifMailPre == 1){
					$('#cont_franja').removeClass('hideshape');
					$('#cont_franja').addClass('showshape');
					
					$('#cont_fecha').removeClass('hideshape');
					$('#cont_fecha').addClass('showshape');
				}else{
					$('#cont_franja').removeClass('showshape');
					$('#cont_franja').addClass('hideshape');
					
					$('#cont_fecha').removeClass('showshape');
					$('#cont_fecha').addClass('hideshape');
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
				$('#tk_estado').html(json.data.estado_entrega+' en fecha '+json.data.fecha_intento);
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
				$('#cont_franja').removeClass('hideshape');
				$('#cont_franja').addClass('showshape');
				$('#cont_fecha').removeClass('hideshape');
				$('#cont_fecha').addClass('showshape');
				$('#tk_estado').html(json.data.estado_entrega);
				$('#tk_franja').html(json.data.franja_entregaDesc);
			break;
		}
	// PRECARGAS
	}else{
		$('#cont_franja').removeClass('hideshape');
		$('#cont_franja').addClass('showshape');
		$('#cont_fecha').removeClass('hideshape');
		$('#cont_fecha').addClass('showshape');
		$('#tk_estado').html(json.data.estado_entrega);
		$('#tk_franja').html(json.data.franja_entregaDesc);
		if(json.data.ifMailPre == 1){
			$('#cont_franja').removeClass('hideshape');
			$('#cont_franja').addClass('showshape');
			
			$('#cont_fecha').removeClass('hideshape');
			$('#cont_fecha').addClass('showshape');
		}else{
			$('#cont_franja').removeClass('showshape');
			$('#cont_franja').addClass('hideshape');
			
			$('#cont_fecha').removeClass('showshape');
			$('#cont_fecha').addClass('hideshape');
		}
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
	$('#cf_estado').val(json.data.cf_estado);
	$('#cf_abonado').val(json.data.cf_abonado);
	$('#num_pedido').val(json.data.num_pedido);
	
	
	// Decidimos si hay que mostrar el formulario o no
	reiniciaInputsFormulario();
	if(json.data.show_opciones == 0){
		// Escondemos el formulario
		$('#cambiosShapeContent').removeClass('showshape');
		$('#cambiosShapeContent').addClass('hideshape');
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
		// Rellenamos el formulario
		$('#input_dia_entrega').val(json.data.fecha_entrega_cliente);	
		$('#input_telefono1').val(json.data.telf_destinatario);	
		$('#input_telefono2').val(json.data.telf_destinatario_2);	
		$('#input_email').val(json.data.email);	
		$('#conf_franja').val(json.data.conf_franja);	
		$('#input_comentarios_cliente').html(json.data.comentarios_cliente);
		// Mostramos el formulario
		$('#cambiosShapeContent').removeClass('hideshape');
		$('#cambiosShapeContent').addClass('showshape');
		// Escondemos la capa de pedido tipo TIPSA
		$('#notasTipsa').removeClass('showshape');
		$('#notasTipsa').addClass('hideshape');
		// Si el pedido tiene cambios pendientes, los mostramos
		if(Object.size(json.cambios) > 0){
			$('#cp_num_pedido').html(json.data.num_pedido);
			$('#cp_nombre_abonado').html(json.data.abonado);
			$('#cp_fecha_alta').html(json.data.fecha_alta);
			$('#cp_fecha_entrega_cliente').html(json.cambios.fecha_entrega_cliente);
			$('#cp_franja').html(json.cambios.franja);
			$('#cp_nombre_destinatario').html(json.data.nombre_destinatario);
			$('#cp_telefono1').html(json.cambios.telf1);
			$('#cp_telefono2').html(json.cambios.telf2);
			$('#cp_email').html(json.cambios.email);
			$('#cp_comentarios_cliente').html(json.cambios.comentarios);
			if(json.data.otros_direccion == null || json.data.otros_direccion == ''){
				$('#cp_direccion_entrega').html(json.data.direccion+' '+json.data.numero+', '+json.data.cp+' '+json.data.localidad);
			}else{
				$('#cp_direccion_entrega').html(json.data.direccion+' '+json.data.numero+' ('+json.data.otros_direccion+'), '+json.data.cp+' '+json.data.localidad);	
			}
			
			if(/Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent)) {
				$('#confirmacion .modal_body').addClass('modal_body_mobile');
		    }
			// Abrimos la capa de cambios pendientes de aprobacion
			$('#triggerConfirmacionShape').trigger('click');
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
	
	// Obtenemos la agencia a la que pertenece el pedido
	var cf_agencia = $('#cf_agencia').val();
	
	// Obtenemos la agencia a la que pertenece el pedido
	var cf_estado = $('#cf_estado').val();
	
	// Obtenemos la tabla de origen
	var tabla_origen = $('#tabla_origen').val();
	
	// Si la fecha de entrega introducida en el formulario es hoy
	if(date_diff == 0){
		// Si la agencia de destino es diferente a ZARAGOZA
		if(cf_agencia != 9 && cf_agencia != 1 && cf_agencia != 2){
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
		}else{
			// No hay frnjas disponibles para cambios en ZARAGOZA el mismo dia
			sinFranjasDisponibles();
		}
	
	// Si la fecha introducida en el formulario es anterior a hoy
	}else if(date_diff < 0){
		// No hay frnjas disponibles
		sinFranjasDisponibles();
	
	// Si la fecha introducida en el formulario es posterior a hoy
	}else if(date_diff > 0){
		// Si la agencia de destino es diferente a ZARAGOZA, BARCELONA o MADRID
		if(cf_agencia != 9 && cf_agencia != 1 && cf_agencia != 2){
			if(conf_franja == 1){
				// Rellenamos con todas las franjas
				rellenaFranjas_todas();
			}else{
				// Rellenamos con las franjas de diurna
				rellenaFranjas_diurna_todas();
			}
		}else{
			// Si es ZARAGOZA, BARCELONA o MADRID + (hoy+1) == fecha de entrega + son mas de las 20h ----> fecha minima pare dentro de dos dias
			if(date_diff == 86400000 && now_hora >= 18){
				sinFranjasDisponibles();
			}
			// Para las demas fechas, comportamiento normal
			else{
				if(conf_franja == 1){
					// Rellenamos con todas las franjas
					rellenaFranjas_todas();
				}else{
					// Rellenamos con las franjas de diurna
					rellenaFranjas_diurna_todas();
				}
			}
		}
	}
}

function rellenaFranjas_todas(){
	// PROVISIONAL
	// Obtenemos la agencia a la que pertenece el pedido
	var cf_agencia = $('#cf_agencia').val();
	// SOLO Barcelona, Madrid, Sevilla, Zaragoza y Valencia
	if(cf_agencia != 1 && cf_agencia != 2 && cf_agencia != 4 && cf_agencia != 9 && cf_agencia != 10){
		// Vaciamos el select primero
		$('#input_franja_entrega').html('');
		$('#input_franja_entrega').prop('disabled',false);
		$('#input_franja_entrega').append("<option selected=\"selected\" value=\"1\">MAÑANA (09:00 - 14:00)</option>");
		$('#input_franja_entrega').append("<option value=\"2\">TARDE (15:00 - 18:30)</option>");
		$('#input_franja_entrega').selectpicker('render');
		$('#input_franja_entrega').selectpicker('refresh');
	}else{
		// Vaciamos el select primero
		$('#input_franja_entrega').html('');
		$('#input_franja_entrega').prop('disabled',false);
		$('#input_franja_entrega').append("<option selected=\"selected\" value=\"1\">MAÑANA (09:00 - 14:00)</option>");
		$('#input_franja_entrega').append("<option value=\"2\">TARDE (15:00 - 18:30)</option>");
		$('#input_franja_entrega').append("<option value=\"3\">NOCHE (19:00 - 22:00)</option>");
		$('#input_franja_entrega').selectpicker('render');
		$('#input_franja_entrega').selectpicker('refresh');
	}
}

function rellenaFranjas_tarde(){
	// PROVISIONAL
	// Obtenemos la agencia a la que pertenece el pedido
	var cf_agencia = $('#cf_agencia').val();
	// SOLO Barcelona, Madrid, Sevilla, Zaragoza y Valencia
	if(cf_agencia != 1 && cf_agencia != 2 && cf_agencia != 4 && cf_agencia != 9 && cf_agencia != 10){
		// Vaciamos el select primero
		$('#input_franja_entrega').html('');
		$('#input_franja_entrega').prop('disabled',false);
		$('#input_franja_entrega').append("<option selected=\"selected\" value=\"2\">TARDE (15:00 - 18:30)</option>");
		$('#input_franja_entrega').selectpicker('render');
		$('#input_franja_entrega').selectpicker('refresh');
	}else{
		// Vaciamos el select primero
		$('#input_franja_entrega').html('');
		$('#input_franja_entrega').prop('disabled',false);
		$('#input_franja_entrega').append("<option selected=\"selected\" value=\"2\">TARDE (15:00 - 18:30)</option>");
		$('#input_franja_entrega').append("<option value=\"3\">NOCHE (19:00 - 22:00)</option>");
		$('#input_franja_entrega').selectpicker('render');
		$('#input_franja_entrega').selectpicker('refresh');
	}
}

function rellenaFranjas_noche(){
	// PROVISIONAL
	// Obtenemos la agencia a la que pertenece el pedido
	var cf_agencia = $('#cf_agencia').val();
	// SOLO Barcelona, Madrid, Sevilla, Zaragoza y Valencia
	if(cf_agencia != 1 && cf_agencia != 2 && cf_agencia != 4 && cf_agencia != 9 && cf_agencia != 10){
		sinFranjasDisponibles();
	}else{
		// Vaciamos el select primero
		$('#input_franja_entrega').html('');
		$('#input_franja_entrega').prop('disabled',false);
		$('#input_franja_entrega').append("<option selected=\"selected\" value=\"3\">NOCHE (19:00 - 22:00)</option>");
		$('#input_franja_entrega').selectpicker('render');
		$('#input_franja_entrega').selectpicker('refresh');
	}
}

function rellenaFranjas_diurna_todas(){
	// PROVISIONAL
	// Obtenemos la agencia a la que pertenece el pedido
	var cf_agencia = $('#cf_agencia').val();
	// SOLO Barcelona, Madrid, Sevilla, Zaragoza y Valencia
	if(cf_agencia != 1 && cf_agencia != 2 && cf_agencia != 4 && cf_agencia != 9 && cf_agencia != 10){
		// Vaciamos el select primero
		$('#input_franja_entrega').html('');
		$('#input_franja_entrega').prop('disabled',false);
		$('#input_franja_entrega').append("<option selected=\"selected\" value=\"4\">DIURNA (12:00 - 17:00)</option>");
		$('#input_franja_entrega').selectpicker('render');
		$('#input_franja_entrega').selectpicker('refresh');
	}else{
		// Vaciamos el select primero
		$('#input_franja_entrega').html('');
		$('#input_franja_entrega').prop('disabled',false);
		$('#input_franja_entrega').append("<option selected=\"selected\" value=\"4\">DIURNA (12:00 - 17:00)</option>");
		$('#input_franja_entrega').append("<option value=\"3\">NOCHE (19:00 - 22:00)</option>");
		$('#input_franja_entrega').selectpicker('render');
		$('#input_franja_entrega').selectpicker('refresh');	
	}
}

function rellenaFranjas_diurna_noche(){
	// PROVISIONAL
	// Obtenemos la agencia a la que pertenece el pedido
	var cf_agencia = $('#cf_agencia').val();
	// SOLO Barcelona, Madrid, Sevilla, Zaragoza y Valencia
	if(cf_agencia != 1 && cf_agencia != 2 && cf_agencia != 4 && cf_agencia != 9 && cf_agencia != 10){
		sinFranjasDisponibles();
	}else{
		// Vaciamos el select primero
		$('#input_franja_entrega').html('');
		$('#input_franja_entrega').prop('disabled',false);
		$('#input_franja_entrega').append("<option selected=\"selected\" value=\"3\">NOCHE (19:00 - 22:00)</option>");
		$('#input_franja_entrega').selectpicker('render');
		$('#input_franja_entrega').selectpicker('refresh');
	}
}

function rellenaFranjas_solo_manana(){
	// Vaciamos el select primero
	$('#input_franja_entrega').html('');
	$('#input_franja_entrega').prop('disabled',false);
	$('#input_franja_entrega').append("<option selected=\"selected\" value=\"1\">MAÑANA (09:00 - 14:00)</option>");
	$('#input_franja_entrega').selectpicker('render');
	$('#input_franja_entrega').selectpicker('refresh');
}

function sinFranjasDisponibles(){
	$('#input_franja_entrega').html('');
	$('#input_franja_entrega').append("<option selected=\"selected\" value=\"-1\">Sin franjas disponibles para la fecha seleccionada</option>");
	$('#input_franja_entrega').prop('disabled',true);
	$('#input_franja_entrega').selectpicker('render');
	$('#input_franja_entrega').selectpicker('refresh');
	
	$('.btn-group ul').html('');
	$('.btn-group ul').append('<li><a href="#">aaaaction uh</a></li>');
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