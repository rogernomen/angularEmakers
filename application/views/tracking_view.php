<div id="content">
	<div class="container">
	
		<!-- Titulo y slogan -->
		<div class="row">
			<div class="span12">  
				<h3><?=lang('tracking.slogan');?></h3>
				<div class="caption">
					<a  class="lead"><?=lang('tracking.lead');?></a><br>
					<p class="alignJustify"><?=lang('tracking.align');?></p>
				</div>
			</div>
		</div>
		
		<!-- Formulario -->
		<div class="clear"></div>
		<div class="row">
			<div class="span8">
				<form id="contact-form" class="contact-form" action="<?=base_url().$this->lang->lang();?>/tracking/send" method="POST">
	            	<fieldset>
	    				<label>
							<input type="text" id="num_pedido" name="num_pedido" placeholder="<?=lang('tracking.input1');?>">
						</label><br/>
						<label>	
							<input type="text" id="mail_or_telf" name="mail_or_telf" placeholder="<?=lang('tracking.input2');?>">	
							<a  onclick="javascript:sendConsulta();" class="btn btn-small" style="margin-top:5px;" data-type="submit"><?=lang('tracking.submit');?></a>		
	      				</label>
	                </fieldset>
	                <div class="error2"><?=lang('tracking.errorForm');?></div>
            	</form>
			</div>
		</div>
		
		<!-- Capa de Ajax loading -->
		<div class="clear"></div>
		<div class="row">
			<div id="ajax_loader" class="span12 alignCenter">
				<img src="<?= base_url() ?>img/_old_web/ajax-loader.gif" alt="<?=lang('tracking.loading');?>" />
			</div>
		</div>
		
		<!-- Resultados -->
		<div class="clear"></div>
		<div class="row">
			<div class="span12 tk_content">
				<h4 class="tk_num_pedido"></h4>
				<!-- Left Panel -->
				<div class="span5">
					<div class="caption w100x100">
						<a  class="lead"><?=lang('tracking.datalead');?></a><br>
						<span class="tk_data-line " id="tk_abonado"><?=lang('tracking.data1');?><b></b></span><br>
						<span class="tk_data-line " id="tk_recibido"><?=lang('tracking.data2');?><b></b></span><br/><br/>
						
						<!-- en ruta -->
						<div style="display:block" id="div_tk_ruta">
						<span class="tk_data-line" id="tk_ruta_estado"><?=lang('tracking.data3');?><font class="dataBold" id="estadoList"></font><br/><font id="sloganList"></font></span>
						<span id="tk_button_line" class="tk_data-line "><a onclick="javascript:changeDateTimeDeliver(this);" class="btn btn-small" id="btn_show_franja_ruta" style="margin-top:5px;" data-type="submit"><?=lang('tracking.data4');?></a></span>
						</div>
					</div>
					<div class="caption w100x100" id="div_tk_destino">
						<a  class="lead"><?=lang('tracking.data5');?></a><br>
						<span class="tk_data-line " id="tk_nombre_destinatario"></span><br>
						<span class="tk_data-line " id="tk_direccion"></span>
					</div>
				</div>
				
				<!-- Center Panel -->
				<div class="span3" id="tk_center_panel">
					<div class="caption w100x100">
						<a  class="lead w100x100"><?=lang('tracking.data6');?></a>
						<div id="fecha_entrega"></div>
						<a  class="lead w100x100"><?=lang('tracking.data7');?></a>
						<label>
							<select id="sel_franja" style="width:218px;">
							</select>
						</label>
						<input type="hidden" id="conf_franja" name="conf_franja" />
					</div>
				</div>
				
				<!-- Right Panel -->
				<div class="span3" id="tk_right_panel">
					<div class="caption w100x100">
						
						<a  class="lead w100x100"><?=lang('tracking.data8');?></a>
						<a  class="lead trackingFieldLabel"><?=lang('tracking.data9');?></a>
						<label>
							<input type="text" id="num_telf_info" name="num_telf_info" placeholder="<?=lang('tracking.data10');?>">
						</label>
						<a  class="lead trackingFieldLabel"><?=lang('tracking.data11');?></a>
						<label>
							<input type="text" id="num_telf_info2" name="num_telf_info2" placeholder="<?=lang('tracking.data12');?>">
						</label>
						<a  class="lead trackingFieldLabel"><?=lang('tracking.data13');?></a>
						<label>
							<input type="text" id="email" name="email" placeholder="<?=lang('tracking.data14');?>">
						</label>
						<a  class="lead trackingFieldLabel"><?=lang('tracking.data15');?></a>
						<label>
							<input type="text" id="comments_info" name="comments_info" placeholder="<?=lang('tracking.data16');?>">
						</label>
						<span class="tk_data-line "><a  onclick="javascript:sendFranjaChange();" id="btn_change_franja" class="btn btn-small" style="margin-top:1px;" data-type="submit"><?=lang('tracking.data17');?></a>&nbsp;&nbsp;<a id="loading_franja_change"><img src="<?= base_url() ?>img/_old_web/ajax-loader.gif" alt="<?=lang('tracking.data18');?>" /><font class="fontS12">&nbsp;<?=lang('tracking.data19');?></font></a></span>
						<div class="result_franja" id="result_franja_change"></div>			
						<input type="hidden" id="actualDateHidden" name="actualDateHidden" value="" />
						<input type="hidden" id="id2_pedido" name="id2_pedido" value="" />
						<input type="hidden" id="ciudad" name="ciudad" value="" />
						<input type="hidden" id="tabla_origen" name="tabla_origen" value="" />
					</div>
				</div>
				
				<!-- Center Panel (TIPSA) -->
				<div class="span6" id="tk_tipsa_panel">
					<div class="caption w100x100">
						<p>Dada la localizaci&oacute;n de entrega de su pedido, el servicio de entrega lo realizar&aacute; la agencia de Tipsa m&aacute;s cercana a su domicilio.<br/><br/>Si usted tiene cualquier duda o necesita realizar cualquier gesti&oacute;n sobre su pedido, puede ponerse en contacto con nosotros en <a href="mailto:incidencias@emakers.es">incidencias@emakers.es</a> o llamando a:<br/><br/>Emakers Barcelona: +34 93 624 24 26<br/>Emakers Madrid: +34 91 72 50 588</p>
					</div>
				</div>
			</div>
		</div>
		<div id="div_alert_cambio" style="width: 600px; display: none;">
			<h3 style="font-size: 24px; margin-top: 10px; text-align:center;"><?=lang('tracking.cambio.title');?></h3>
			<p><?=lang('tracking.cambio.slogan');?></p>
			<span id="alert_fecha_entrega"><?=lang('tracking.cambio.data1');?><b></b></span><br>
			<span id="alert_franja"><?=lang('tracking.cambio.data2');?><b></b></span><br>
			<span id="alert_telf1"><?=lang('tracking.cambio.data3');?><b></b></span><br>
			<span id="alert_telf2"><?=lang('tracking.cambio.data4');?><b></b></span><br>
			<span id="alert_email"><?=lang('tracking.cambio.data5');?><b></b></span><br>
			<span id="alert_comentarios"><?=lang('tracking.cambio.data6');?><i></i></span><br><br>			 			 
			<p><?=lang('tracking.cambio.que_hacer');?></p>
			<div style="text-align: center; margin-bottom: 20px;">
				<a  class="btn btn-small" style="width: 250px;margin-top:5px;" data-type="submit" onclick="javascript:ocultarInfo()"><?=lang('tracking.cambio.hacer_ok');?></a>
				<a  class="btn btn-small" style="width: 250px;margin-top:5px;" data-type="submit" onclick="javascript:ocultarInline();"><?=lang('tracking.cambio.hacer_ko');?></a>
			</div>			 
		</div>

		<!-- Dudas -->
		<div class="clear"></div>
		<div class="row">
			<div class="span12">
				<div class="caption">
					<a  class="lead"><?=lang('tracking.dudas.title');?></a><br>
					<p class="alignJustify"><?=lang('tracking.dudas.description');?></p>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	$(function() {
		$( "#fecha_entrega" ).datepicker({
			inline: true,
			altField: "#actualDateHidden",
			altFormat: "yy-mm-dd",
			dateFormat: "yy-mm-dd",
			minDate: new Date(),
			firstDay: 1,
			showAnim: "slide",
			nextText: "<?=lang('tracking.cal.next');?>",
			prevText: "<?=lang('tracking.cal.prev');?>",
			monthNames: [ "<?=lang('tracking.cal.month1');?>", "<?=lang('tracking.cal.month2');?>", "<?=lang('tracking.cal.month3');?>", "<?=lang('tracking.cal.month4');?>", "<?=lang('tracking.cal.month5');?>", "<?=lang('tracking.cal.month6');?>", "<?=lang('tracking.cal.month7');?>", "<?=lang('tracking.cal.month8');?>", "<?=lang('tracking.cal.month9');?>", "<?=lang('tracking.cal.month10');?>", "<?=lang('tracking.cal.month11');?>", "<?=lang('tracking.cal.month12');?>" ],
			monthNamesShort: [ "<?=lang('tracking.cal.monthmin1');?>", "<?=lang('tracking.cal.monthmin2');?>", "<?=lang('tracking.cal.monthmin3');?>", "<?=lang('tracking.cal.monthmin4');?>", "<?=lang('tracking.cal.monthmin5');?>", "<?=lang('tracking.cal.monthmin6');?>", "<?=lang('tracking.cal.monthmin7');?>", "<?=lang('tracking.cal.monthmin8');?>", "<?=lang('tracking.cal.monthmin9');?>", "<?=lang('tracking.cal.monthmin10');?>", "<?=lang('tracking.cal.monthmin11');?>", "<?=lang('tracking.cal.monthmin12');?>" ],
			dayNames: [ "<?=lang('tracking.cal.day1');?>", "<?=lang('tracking.cal.day2');?>", "<?=lang('tracking.cal.day3');?>", "<?=lang('tracking.cal.day4');?>", "<?=lang('tracking.cal.day5');?>", "<?=lang('tracking.cal.day6');?>", "<?=lang('tracking.cal.day7');?>" ],
			dayNamesShort: [ "<?=lang('tracking.cal.daymin1');?>", "<?=lang('tracking.cal.daymin2');?>", "<?=lang('tracking.cal.daymin3');?>", "<?=lang('tracking.cal.daymin4');?>", "<?=lang('tracking.cal.daymin5');?>", "<?=lang('tracking.cal.daymin6');?>", "<?=lang('tracking.cal.daymin7');?>" ],
			dayNamesMin: [ "<?=lang('tracking.cal.daymin1');?>", "<?=lang('tracking.cal.daymin2');?>", "<?=lang('tracking.cal.daymin3');?>", "<?=lang('tracking.cal.daymin4');?>", "<?=lang('tracking.cal.daymin5');?>", "<?=lang('tracking.cal.daymin6');?>", "<?=lang('tracking.cal.daymin7');?>" ],
			beforeShowDay: function nonWorkingDates(date) {
				var Sunday = 0, Monday = 1, Tuesday = 2, Wednesday = 3, Thursday = 4, Friday = 5, Saturday = 6;

			    if (date.getDay() == Sunday || date.getDay() == Saturday) return [false, '']; 
			    else if (!nationalDays(date))return [false, ''];
			    else return [true, ''];
			      
			},
			onSelect: function selectorFranja(date) {
				var Sunday = 0, Monday = 1, Tuesday = 2, Wednesday = 3, Thursday = 4, Friday = 5, Saturday = 6;
				
				var fecha = $.datepicker.parseDate("yy-mm-dd",  date);
				var now = new Date();
				
				// Cogemos los dias
				var date1 = fecha.getDate()+'-'+(fecha.getMonth() + 1)+'-'+fecha.getFullYear();
				var date2 = now.getDate()+'-'+(now.getMonth() + 1)+'-'+now.getFullYear();
				
				// Cogemos las horas
				var h2 = now.getHours();
				
				var conf_franja = $('#conf_franja').val();
				
				// Si las fechas son diferentes, cargamos todas las opciones
				if(date1 != date2){
					if(conf_franja == 1){
						cargarComboFranja();
					}else{
						cargarComboFranja_ER();
					}
				
				// Si las fechas son iguales, debemos fijar las franjas según la hora actual
				}else if(date1 == date2){
					if(conf_franja == 1){
						// Si son antes de las 9am --> damos todas las franjas
						if(h2 < 9){
							cargarComboFranja();
							
						// Si son antes de las 15 --> damos franja de tarde y afterwork
						}else if(h2 >= 9 && h2 < 15){
							cargarComboFranja1();
							
						// Si son antes de las 19 --> damos franja aftwerwork
						}else if(h2 >= 15 && h2 < 19){
							cargarComboFranja2();
							
						// Si son mas tarde de las 19.. no hay franja posible
						}else if(h2 >= 19){
							cargarComboFranjaNoHay();
							cargarComboFranjaNoHay();
							
						// Caso no controlado
						}else{
							vaciarComboFranja();
							cargarComboFranjaNoHay();
						}
					}else{
						// Si son antes de las 9am --> damos todas las franjas
						if(h2 < 9){
							cargarComboFranja_ER();
							
						// Si son antes de las 15 --> damos franja de tarde y afterwork
						}else if(h2 >= 9 && h2 < 19){
							cargarComboFranja1_ER();
							
						// Si son mas tarde de las 19.. no hay franja posible
						}else if(h2 >= 19){
							cargarComboFranjaNoHay();
							cargarComboFranjaNoHay();
							
						// Caso no controlado
						}else{
							vaciarComboFranja();
							cargarComboFranjaNoHay();
						}
					}
				}
				
				
				
		     }
		});
	});

	
	function nationalDays(date) {
		//dias de bcn
	   	var disabledDays = ["12-25-2013","12-26-2013","1-1-2014","1-6-2014"];
	    
		var m = date.getMonth(), d = date.getDate(), y = date.getFullYear();

		//console.log('Checking (raw): ' + m + '-' + d + '-' + y);
		for (i = 0; i < disabledDays.length; i++) {
		
			if($.inArray((m+1) + '-' + d + '-' + y,disabledDays) != -1 || new Date() > date) {
				console.log('bad:  ' + (m+1) + '-' + d + '-' + y + ' / ' + disabledDays[i]);				
				return false;
				
			}
		}
		//console.log('good:  ' + (m+1) + '-' + d + '-' + y);
		return true;
	}
	
    jQuery(function() {
    	jQuery.support.placeholder = false;
    	test = document.createElement('input');
    	if('placeholder' in test) jQuery.support.placeholder = true;
    });

    $(function() {
    	if(!$.support.placeholder) { 
    		var active = document.activeElement;
    		$(':text').focus(function () {
    			if ($(this).attr('placeholder') != '' && $(this).val() == $(this).attr('placeholder')) {
    				$(this).val('').removeClass('hasPlaceholder');
    			}
    		}).blur(function () {
    			if ($(this).attr('placeholder') != '' && ($(this).val() == '' || $(this).val() == $(this).attr('placeholder'))) {
    				$(this).val($(this).attr('placeholder')).addClass('hasPlaceholder');
    			}
    		});
    		$(':text').blur();
    		$(active).focus();
    		$('form').submit(function () {
    			$(this).find('.hasPlaceholder').each(function() { $(this).val(''); });
    		});
    	}
    });

    function sendConsulta(){
    	var error = false;

    	// Comprovamos la correcta existencia de los campos
		if($("#num_pedido").val() == ''  || $("#num_pedido").val() == '<?=lang('tracking.input1');?>'){ error = true; }
		if($("#mail_or_telf").val() == '' || $("#mail_or_telf").val() == '<?=lang('tracking.input2');?>'){ error = true; }

		// Comprovamos ahora el tipo de datos en #mail_or_telf para aplicar la regla de expresion adecuada
		if(error == false) error = compruevaMail_or_Telf($("#mail_or_telf").val());
		
		if(error){
			$('.error2').css('visibility', 'visible');
		}else{
			$('.error2').css('visibility', 'hidden');
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
        // random para la peticion AJAX
		
		$.ajax({
			type: "POST",
			url: base_url+lang_site+"/tracking/checkDataTracking",
			data: "num_pedido="+var1+"&mail_or_telf="+var2,
			beforeSend: function(x) {
				$('.tk_content').hide();
				$('#ajax_loader').css('visibility', 'visible');
				
			},
			success: function(msg){
				var json = jQuery.parseJSON(msg);
				$('#ajax_loader').css('visibility', 'hidden');
				
				resetTrackingInfoFields();
				if(json.status == "OK"){
					$('.tk_content').show();
					cargarInfoJSON(json);
				}else{
					$('.error2').css('visibility', 'visible');
				}
					
			}
		});
    }


	function cargarInfoJSON(json){		
		$('.tk_num_pedido').html(json.data.num_pedido);
		$('#tk_abonado b').html(json.data.abonado);
		$('#tk_nombre_destinatario').html(json.data.nombre_destinatario);
		
		if(json.data.idioma == 1){
			$('#tk_direccion').html(json.data.direccion + " " + json.data.numero +" , "+ json.data.cp + " " + json.data.localidad.toUpperCase());
		}else{
			$('#tk_direccion').html(json.data.numero+" "+json.data.direccion + " "+ json.data.cp + " " + json.data.localidad.toUpperCase());
		}
		
		if(json.data.otros_direccion != ''){
			$('#tk_direccion').html($('#tk_direccion').html()+"<br/>("+json.data.otros_direccion+")");
		}
		
		$('#tk_recibido b').html(json.data.fecha_alta);
		$('#num_telf_info').val(json.data.telf_destinatario);
		$('#num_telf_info2').val(json.data.telf_destinatario_2);
		$('#comments_info').val(json.data.comentarios_cliente);
		$('#id2_pedido').val(json.data.id2);
		$('#ciudad').val(json.ciudad); 
		$('#tabla_origen').val(json.data.tabla_origen); 
		$('#email').val(json.data.email);
		$('#conf_franja').val(json.data.conf_franja);
		

		$('#tk_ruta_estado font#estadoList').html(json.data.estadoDesc);
		$('#tk_ruta_estado font#estadoList').css('color', json.data.estadoColor);
		$('#tk_ruta_estado font#sloganList').html(json.data.estadoSlogan);
		$('#div_tk_ruta').css('display','block');

		if(json.data.show_opciones == 1){
			$('#tk_button_line').css('display', 'block');
		}else{
			$('#tk_button_line').css('display', 'none');
		}

		// Si es un pedido de tipo TIPSA, mostraos info diferentes
		if(json.data.otros_operadores == 1){
			$('#tk_button_line').css('display', 'none');
			$('#tk_tipsa_panel').css('visibility','visible');
			$('#tk_tipsa_panel').css('display','block');
			$('#tk_center_panel').css('display','none');
			$('#tk_right_panel').css('display','none');	
		}else{
			$('#tk_center_panel').css('display','block');
			$('#tk_right_panel').css('display','block');
			$('#tk_tipsa_panel').css('visibility','hidden');
			$('#tk_tipsa_panel').css('display','none');
		}

		if(json.cambios.length != 0){
			resetInnerFields();
			loadInnerFields(json);
			$.fancybox.open({
				href: '#div_alert_cambio',
				type: 'inline',
				modal: true,
				closeBtn: false,
				closeClick: false
			});
		}
	}

	function resetTrackingInfoFields(){
		$('.tk_num_pedido').html('');
		$('#tk_nombre_destinatario').html('');
		$('#tk_direccion').html('');
		$('#tk_recibido b').html('');
		$('#num_telf_info').val('');
		$('#num_telf_info2').val('');
		$('#email').val('');
		$('#comments_info').val('');
		$('#id2_pedido').val('');
		$('#tabla_origen').val('');
		
		$('#tk_entregado_estado font').html('');		
		$('#tk_entregado_estado b').html('');

		$('#tk_ruta_estado font').html('');
		$('#tk_ruta_estado b').html('');

		$('#tk_ausente_estado font').html('');
		$('#tk_ausente_estado b').html('');	

		$("#result_franja_change").html('');
		
		$('#conf_franja').val('');
		
		$('#loading_franja_change').css('visibility','hidden');
		showChangeDataDeliveryForm(false);		
		cargarComboFranja();
		
	}
    
	function changeDateTimeDeliver(button){
		if($(button).hasClass('btn_active')){
			$(button).removeClass('btn_active');
			$('#tk_center_panel').css('visibility','hidden');
			$('#tk_right_panel').css('visibility','hidden');			
		}else{
			$(button).addClass('btn_active');
			$('#tk_center_panel').css('visibility','visible');
			$('#tk_right_panel').css('visibility','visible');
			
			var conf_franja = $('#conf_franja').val();
			
			// Cogemos los dias
			var now = new Date();
			var date2 = now.getDate()+'-'+(now.getMonth() + 1)+'-'+now.getFullYear();
			
			// Cogemos las horas
			var h2 = now.getHours();
			
			if(conf_franja == 1){
				// Si son antes de las 9am --> damos todas las franjas
				if(h2 < 9){
					cargarComboFranja();
					
				// Si son antes de las 15 --> damos franja de tarde y afterwork
				}else if(h2 >= 9 && h2 < 15){
					cargarComboFranja1();
					
				// Si son antes de las 19 --> damos franja aftwerwork
				}else if(h2 >= 15 && h2 < 19){
					cargarComboFranja2();
					
				// Si son mas tarde de las 19.. no hay franja posible
				}else if(h2 >= 19){
					cargarComboFranjaNoHay();
					cargarComboFranjaNoHay();
					
				// Caso no controlado
				}else{
					vaciarComboFranja();
					cargarComboFranjaNoHay();
				}
			}else{
				// Si son antes de las 9am --> damos todas las franjas
				if(h2 < 9){
					cargarComboFranja_ER();
					
				// Si son antes de las 15 --> damos franja de tarde y afterwork
				}else if(h2 >= 9 && h2 < 19){
					cargarComboFranja1_ER();
					
				// Si son mas tarde de las 19.. no hay franja posible
				}else if(h2 >= 19){
					cargarComboFranjaNoHay();
					cargarComboFranjaNoHay();
					
				// Caso no controlado
				}else{
					vaciarComboFranja();
					cargarComboFranjaNoHay();
				}
			}
		}		
	}

	function showChangeDataDeliveryForm(show){
		if(!show){
	
			//reseteamos el estado de cada boton de cambio de franja		
			if($("#btn_show_franja_ausente").hasClass('btn_active'))
				$("#btn_show_franja_ausente").removeClass('btn_active');
			if($("#btn_show_franja_ruta").hasClass('btn_active'))
				$("#btn_show_franja_ruta").removeClass('btn_active');
			
						
			$('#tk_center_panel').css('visibility','hidden');
			$('#tk_right_panel').css('visibility','hidden');			
		}else{			
			if(!$("#btn_show_franja_ausente").hasClass('btn_active'))
				$("#btn_show_franja_ausente").addClass('btn_active');
			if(!$("#btn_show_franja_ruta").hasClass('btn_active'))
				$("#btn_show_franja_ruta").addClass('btn_active');
			
			
			$('#tk_center_panel').css('visibility','visible');
			$('#tk_right_panel').css('visibility','visible');
		}		
	}

	function sendFranjaChange(){
		//numero del pedido
		var num_pedido = $('.tk_num_pedido').html();
		//get dia entrega
		var fecha_entrega = $("#fecha_entrega").val();
		//get franja entrega
		var id_franja = $("#sel_franja").val();
		//get numero de telefono
		var telefono = $("#num_telf_info").val();
		var telefono2 = $("#num_telf_info2").val();
		//get comentarios
		var comentarios = $("#comments_info").val();
		//get comentarios
		var mail = $("#email").val();
		//get id2
		var id2 = $("#id2_pedido").val();
		//get cuidad
		var ciudad = $("#ciudad").val();
		// get tabla origen
		var tabla_origen = $('#tabla_origen').val();
		
		if(id_franja == 0){
			$("#result_franja_change").css("color","#9d261d");
			$("#result_franja_change").html("<?=lang('tracking.error2');?>");	
		}else{
			//send ajax
			$.ajax({
				type: "POST",
				url: base_url+lang_site+"/tracking/setFranjaChange",
				data: "num_pedido="+num_pedido+
					  "&fecha_entrega="+fecha_entrega+
					  "&id_franja_entrega="+id_franja+
					  "&comentarios_cliente="+comentarios+
					  "&telefono="+telefono+
					  "&telefono2="+telefono2+
					  "&email="+mail+
					  "&id2="+id2+
					  "&ciudad="+ciudad+
					  "&tabla_origen="+tabla_origen,
				beforeSend: function(x) {
					$('#loading_franja_change').css('visibility', 'visible');				
				},
				success: function(msg){
					var json = jQuery.parseJSON(msg);
					$('#loading_franja_change').css('visibility', 'hidden');
					
					if(json!=null && json.status == "OK"){
						$("#result_franja_change").css("color","#088A08");
						$("#result_franja_change").html("<?=lang('tracking.cambiosOK');?>");					
									
					}else if(json!=null && json.status == "KO"){
						$("#result_franja_change").css("color","#9d261d");
						$("#result_franja_change").html("<?=lang('tracking.cambiosKO');?>");
						
					}else{
						$("#result_franja_change").css("color","#9d261d");
						$("#result_franja_change").html("<?=lang('tracking.cambiosKO');?>");	
					}
				}
			});
		}
	}

	function cargarComboFranjaSabado(){
		vaciarComboFranja();
		$('#sel_franja').append("<option value=\"1\"><?=lang('tracking.franja1');?></option>");	
		$('#sel_franja').removeAttr('disabled');
	}

	function cargarComboFranja(){
		vaciarComboFranja();
		$('#sel_franja').append("<option value=\"1\" selected><?=lang('tracking.franja1');?></option>");		
		$('#sel_franja').append("<option value=\"2\"><?=lang('tracking.franja2');?></option>");
		$('#sel_franja').append("<option value=\"3\"><?=lang('tracking.franja3');?></option>");
		$('#sel_franja').removeAttr('disabled');
	}
	
	function cargarComboFranja_ER(){
		vaciarComboFranja();
		$('#sel_franja').append("<option value=\"4\" selected><?=lang('tracking.franja4');?></option>");
		$('#sel_franja').append("<option value=\"3\"><?=lang('tracking.franja3');?></option>");
		$('#sel_franja').removeAttr('disabled');
	}
	function cargarComboFranja1(){
		vaciarComboFranja();	
		$('#sel_franja').append("<option value=\"2\"><?=lang('tracking.franja2');?></option>");
		$('#sel_franja').append("<option value=\"3\"><?=lang('tracking.franja3');?></option>");
		$('#sel_franja').removeAttr('disabled');
	}
	function cargarComboFranja1_ER(){
		vaciarComboFranja();
		$('#sel_franja').append("<option value=\"3\"><?=lang('tracking.franja3');?></option>");
		$('#sel_franja').removeAttr('disabled');
	}
	function cargarComboFranja2(){
		vaciarComboFranja();
		$('#sel_franja').append("<option value=\"3\"><?=lang('tracking.franja3');?></option>");
		$('#sel_franja').removeAttr('disabled');
	}
	function cargarComboFranjaNoHay(){
		vaciarComboFranja();
		$('#sel_franja').append("<option value=\"0\"><?=lang('tracking.franja.nofranja');?></option>");
		$('#sel_franja').attr('disabled','disabled');
	}

	function vaciarComboFranja(){
		$('#sel_franja').find('option').remove();
	}

	function ocultarInline(){
		$.fancybox.close();
	}

	function ocultarInfo(){		
		$.fancybox.close();		
		$('.tk_content').hide();
	} 

	function resetInnerFields(){
		$('#alert_fecha_entrega b').html('');
		$('#alert_franja b').html('');
		$('#alert_telf1 b').html('');
		$('#alert_telf2 b').html('');
		$('#alert_email b').html('');
		$('#alert_comentarios i').html('');
	}		

	function loadInnerFields(json){
		$('#alert_fecha_entrega b').html(json.cambios.fecha_entrega_cliente);
		$('#alert_franja b').html(json.cambios.franja);
		$('#alert_telf1 b').html(json.cambios.telf1);
		$('#alert_telf2 b').html(json.cambios.telf2);
		$('#alert_email b').html(json.cambios.email);
		$('#alert_comentarios i').html(json.cambios.comentarios);
	}

		
</script>