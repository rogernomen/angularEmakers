<!DOCTYPE html> 
<html>
<head>
	<title><?=lang('headerTracking.title');?></title>
	
	<meta charset="utf-8">
    <link rel="icon" href="<?=base_url();?>img/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="<?=base_url();?>img/favicon.ico" type="image/x-icon" />
	
	<meta name="description" content="<?=lang('headerTracking.description');?>">
    <meta name="keywords" content="<?=lang('headerTracking.keywords');?>">
    <meta name="author" content="<?=lang('headerTracking.author');?>">
	
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.3.1/jquery.mobile-1.3.1.min.css" />
	<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.3.1/jquery.mobile-1.3.1.min.js"></script>
	
	<link rel="stylesheet" href="<?=base_url();?>css/tracking_smartphone.css" type="text/css" media="screen">
	
	<script>
		var base_url = '<?= $this->config->item('base_url'); ?>';
		var lang_site = '<?= $this->lang->lang(); ?>';
	</script>
</head>

<body>
	<!-- page -->
	<div data-role="page">
		
		<!-- content -->
		<div data-role="content">
			<!-- logo -->
			<div class="logo_ctn">
				<img src="<?=base_url()?>img/logo_header.png" /><br/>
				<span><?=lang('menu.slogan');?></span>
			</div>
			<?php if(isset($cambios) && sizeof($cambios) > 0){?> 
				<div data-overlay-theme="a" id="popupBasic">
					<div data-role="content" >
				        <h3><?=lang('tracking.cambio.title');?></h3>
						<p><?=lang('tracking.cambio.slogan');?></p>			
						<span id="alert_fecha_entrega"><?=lang('tracking.cambio.data1');?><b><?= $cambios["fecha_entrega_cliente"] ?></b></span><br>
						<span id="alert_franja"><?=lang('tracking.cambio.data2');?><b><?= $cambios["franja"] ?></b></span><br>
						<span id="alert_telf1"> <?=lang('tracking.cambio.data3');?><b><?= $cambios["telf1"] ?></b></span><br>
						<span id="alert_telf2"><?=lang('tracking.cambio.data4');?><b><?= $cambios["telf2"] ?></b></span><br>
						<span id="alert_email"><?=lang('tracking.cambio.data5');?><b><?= $cambios["email"] ?></b></span><br>
						<span id="alert_comentarios"><?=lang('tracking.cambio.data6');?><i><?= $cambios["comentarios"] ?></i></span><br><br>			 			 
						<p><?=lang('tracking.cambio.que_hacer');?></p>
				        
						
						<a href="<?= base_url() ?>es/tracking/" data-ajax="false" data-role="button" ><?=lang('tracking.cambio.hacer_ok');?></a>
						<button onclick="javascript:closePopup();"><?=lang('tracking.cambio.hacer_ko');?></button>
						
				    </div>
				</div>
			<?php }?>
			<div id="rest_content">
				<!-- content -->
				<h3><?=lang('tracking.phone.title');?></h3>
				<a id="datosPedido" class="lead"><?=lang('tracking.datalead2');?><?php echo $data['num_pedido'];?>:</a>
				<p style="width:100%; float:left;">
					<span id="tk_abonado" class="tk_data-line "><?=lang('tracking.data1');?><b><?php echo $data['abonado'];?></b></span><br/>
					<span id="tk_recibido" class="tk_data-line "><?=lang('tracking.data2.1');?><b><?php echo $data['fecha_alta'];?></b></span><br/><br/>
					<span id="tk_ruta_estado" class="tk_data-line"><?=lang('tracking.data3');?><br/><font class="statusPedido" style="color:<?php echo $data['estadoColor'];?>"><?php echo $data['estadoDesc'];?></font><br/><?php echo $data['estadoSlogan'];?></span><br/>
				</p><br/>
				<a id="datosPedido2" class="lead"><?=lang('tracking.data5');?></a>
				<p style="width:100%; float:left;">
					<span id="tk_abonado" class="tk_data-line "><?php echo $data['nombre_destinatario'];?></span><br/>
					<span id="tk_recibido" class="tk_data-line ">
						<?php 
							if($data['idioma'] == 1){
								echo $data['direccion'].', '.$data['numero'].' '.$data['cp'].' '.strtoupper($data['localidad']);
							}else{
								echo $data['numero'].' '.$data['direccion'].' '.$data['cp'].' '.strtoupper($data['localidad']);
							}
							if($data['otros_direccion'] != ''){
								echo '<br/>('.$data['otros_direccion'].')';
							}
						?>
					</span><br/><br/>
				</p>
				<form method="POST" action="<?= base_url().$this->lang->lang(); ?>/tracking/setFranjaChange/1" data-ajax="false">
				
					<!-- Hiddens -->
					<input type="hidden" name="id2" id="id2" value="<?php echo $data['id2'];?>" />
					<input type="hidden" name="num_pedido" id="num_pedido" value="<?php echo $data['num_pedido'];?>" <?php if(isset($data['cf_estado']) && ($data['cf_estado'] == ESTADO_ENTREGA_ENTREGADA || $data['cf_estado'] == ESTADO_ENTREGA_DEVUELTO_A_REMITENTE)){echo 'disabled="disabled"';}?>/>
					<input type="hidden" name="ciudad" id="ciudad" value="<?php echo $ciudad;?>" />
					<input type="hidden" id="tabla_origen" name="tabla_origen" value="<?php echo $data['tabla_origen'];?>" />
					
					<!-- Fecha de entrega -->
					<label class="lead" for="fecha_entrega"><?=lang('tracking.data6');?></label>
	    	 		<input name="fecha_entrega" id="fecha_entrega" value="<?php echo $data['fecha_entrega_cliente_ios'];?>" <?php if(isset($data['cf_estado']) && ($data['cf_estado'] == ESTADO_ENTREGA_ENTREGADA || $data['cf_estado'] == ESTADO_ENTREGA_DEVUELTO_A_REMITENTE)){echo 'disabled="disabled"';}?> type="date">
	    	 		
	    	 		<!-- Franja de entrega -->
				    <label class="lead"  for="id_franja_entrega"><?=lang('tracking.data7');?></label>
	     			<select name="id_franja_entrega" id="id_franja_entrega" <?php if(isset($data['cf_estado']) && ($data['cf_estado'] == ESTADO_ENTREGA_ENTREGADA || $data['cf_estado'] == ESTADO_ENTREGA_DEVUELTO_A_REMITENTE)){echo 'disabled="disabled"';}?>>
				        <option <?php echo($data['cf_franja'] == 1) ? 'selected="selected"' : ''; ?> value="1"><?=lang('tracking.franja1');?></option>
				        <option <?php echo($data['cf_franja'] == 2) ? 'selected="selected"' : ''; ?> value="2"><?=lang('tracking.franja2');?></option>
				        <option <?php echo($data['cf_franja'] == 3) ? 'selected="selected"' : ''; ?> value="3"><?=lang('tracking.franja3');?></option>
				    </select>
				    
				    <!-- Telefonos -->
	     			<label class="lead"  for="telefono"><?=lang('tracking.data10');?></label>
	     			<input name="telefono" id="telefono" value="<?php echo $data['telf_destinatario'];?>" <?php if(isset($data['cf_estado']) && ($data['cf_estado'] == ESTADO_ENTREGA_ENTREGADA || $data['cf_estado'] == ESTADO_ENTREGA_DEVUELTO_A_REMITENTE)){echo 'disabled="disabled"';}?> type="tel">
	     			<label class="lead"  for="telefono2"><?=lang('tracking.data11');?></label>
	     			<input name="telefono2" id="telefono2" value="<?php echo $data['telf_destinatario_2'];?>" <?php if(isset($data['cf_estado']) && ($data['cf_estado'] == ESTADO_ENTREGA_ENTREGADA || $data['cf_estado'] == ESTADO_ENTREGA_DEVUELTO_A_REMITENTE)){echo 'disabled="disabled"';}?> type="tel">
	     			
	     			<!-- Email -->
	     			<label class="lead"  for="email"><?=lang('tracking.data13');?></label>
	     			<input name="email" id="email" value="<?php echo $data['email'];?>" <?php if(isset($data['cf_estado']) && ($data['cf_estado'] == ESTADO_ENTREGA_ENTREGADA || $data['cf_estado'] == ESTADO_ENTREGA_DEVUELTO_A_REMITENTE)){echo 'disabled="disabled"';}?> type="email">
	     			
	     			<!-- Comentarios cliente -->
	     			<label class="lead"  for="comentarios_cliente"><?=lang('tracking.data15');?></label>
	     			<input name="comentarios_cliente" id="comentarios_cliente" <?php if(isset($data['cf_estado']) && ($data['cf_estado'] == ESTADO_ENTREGA_ENTREGADA || $data['cf_estado'] == ESTADO_ENTREGA_DEVUELTO_A_REMITENTE)){echo 'disabled="disabled"';}?> value="<?php echo $data['comentarios_cliente'];?>" type="text">
	     			
	     			<!-- Botonera -->
	     			<input id="rlt_sndButton" value="<?=lang('tracking.data17');?>" <?php if(isset($data['cf_estado']) && ($data['cf_estado'] == ESTADO_ENTREGA_ENTREGADA || $data['cf_estado'] == ESTADO_ENTREGA_DEVUELTO_A_REMITENTE)){echo 'disabled="disabled"';}?> data-theme="b" type="submit">
	     			<input id="rlt_xButton" onclick="javascript:history.go(-1);" value="<?=lang('tracking.phone.cancelar');?>" data-theme="a" type="button">
	     			<br/>
	     			<a id="errorMsgTrigger" class="displaynone" href="#dialogPage" data-rel="dialog">dialog</a> 
	     			<br/>
				</form>
				<a id="datosPedido2" class="lead" style="float:left;width:100%;"><?=lang('tracking.dudas.title');?></a>
				<p style="width:100%;">
					<?=lang('tracking.dudas.description');?>
				</p>
			</div>	
		</div><!-- /content -->
	
		<!-- footer -->
		<div data-role="footer" data-theme="c">
			<div class="footer_logo_ctn">
				<img src="<?=base_url()?>img/logo_header_bn.png" />
			</div>
		</div><!-- /footer -->
	</div><!-- /page -->
	
	<div data-role="page" id="dialogPage" data-close-btn="right">
		<div data-role="header" data-theme="c">
			<h2><?=lang('tracking.errorForm.title');?></h2>
		</div>
		<div data-role="content">
			<p><?=lang('tracking.errorForm.description');?></p>
			<a href="#" data-rel="back" data-theme="d" type="button"><?=lang('tracking.phone.cerrar');?></a>
		</div>
	</div>
	
	<script type="text/javascript">
	$( document ).ready(function() {
		<?php if(isset($cambios) && sizeof($cambios) > 0){?>
			//$( "#popupBasic" ).popup("open");
			$('#rest_content').css('display', 'none');
		<?php }?>
		$('#fecha_entrega').change(function(){
			var Sunday = 0, Monday = 1, Tuesday = 2, Wednesday = 3, Thursday = 4, Friday = 5, Saturday = 6;
			var fecha = new Date($('#fecha_entrega').val());
			var now = new Date();
			
			// Cogemos los dias
			var date1 = fecha.getDate()+'-'+(fecha.getMonth() + 1)+'-'+fecha.getFullYear();
			var date2 = now.getDate()+'-'+(now.getMonth() + 1)+'-'+now.getFullYear();

			// Cogemos las horas
			var h2 = now.getHours();
			
			// Si las fechas son diferentes, cargamos todas las opciones
			if(date1 < date2){
				vaciarComboFranja();
				cargarComboFranjaNoHay();
				
			}else if(date1 != date2){
				cargarComboFranja();
			
			// Si las fechas son iguales, debemos fijar las franjas según la hora actual
			}else if(date1 == date2){
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
					vaciarComboFranja();
					cargarComboFranjaNoHay();
					
				// Caso no controlado
				}else{
					vaciarComboFranja();
					cargarComboFranjaNoHay();
				}
			}	
		});
	});
	function cargarComboFranja(){
		vaciarComboFranja();
		$('#id_franja_entrega').append("<option value=\"1\" selected><?=lang('tracking.franja1');?></option>");		
		$('#id_franja_entrega').append("<option value=\"2\"><?=lang('tracking.franja2');?></option>");
		$('#id_franja_entrega').append("<option value=\"3\"><?=lang('tracking.franja3');?></option>");
		$('#id_franja_entrega').removeAttr('disabled');
		$('#id_franja_entrega').selectmenu('refresh', true);
	}
	function cargarComboFranja1(){
		vaciarComboFranja();	
		$('#id_franja_entrega').append("<option value=\"2\"><?=lang('tracking.franja2');?></option>");
		$('#id_franja_entrega').append("<option value=\"3\"><?=lang('tracking.franja3');?></option>");
		$('#id_franja_entrega').removeAttr('disabled');
		$('#id_franja_entrega').selectmenu('refresh', true);
	}
	function cargarComboFranja2(){
		vaciarComboFranja();
		$('#id_franja_entrega').append("<option value=\"3\"><?=lang('tracking.franja3');?></option>");
		$('#id_franja_entrega').removeAttr('disabled');
		$('#id_franja_entrega').selectmenu('refresh', true);
	}
	function cargarComboFranjaNoHay(){
		vaciarComboFranja();
		$('#id_franja_entrega').append("<option value=\"0\"><?=lang('tracking.franja.nofranja');?></option>");
		$('#id_franja_entrega').attr('disabled','disabled');
		$('#id_franja_entrega').selectmenu('refresh', true);
	}

	function vaciarComboFranja(){
		$('#id_franja_entrega').find('option').remove();
	}
	
	function closePopup(){
		//$('#popupBasic').popup("close");
		$('#popupBasic').css("display", 'none');
		$('#rest_content').css('display', 'block');
	}	
	</script>
	<script type="text/javascript">

	  var _gaq = _gaq || [];
	  _gaq.push(['_setAccount', 'UA-37509776-3']);
	  _gaq.push(['_setDomainName', 'emakers.es']);
	  _gaq.push(['_trackPageview']);
	
	  (function() {
	    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
	    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
	    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	  })();
	
	</script>
</body>
</html>