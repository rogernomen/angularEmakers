<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	
	<link rel="icon" href="<?=base_url();?>img/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="<?=base_url();?>img/favicon.ico" type="image/x-icon" />
	
	<meta name="description" content="<?=lang('ew_description');?>">
    <meta name="keywords" content="<?=lang('ew_keywords');?>">
	
	<meta property="og:image" content="<?=base_url();?>img/logo_200.png"/>

    <meta property="og:title" content="Emakers"/>
    <meta property="og:description" content="<?=lang('ew_description');?>"/>
	
	<title><?=lang('ew_title_page');?></title>
	
	<!-- Bootstrap core CSS -->
	<link href="<?=base_url();?>css/bootstrap.tracking.min.css" rel="stylesheet">
	
	<link href='http://fonts.googleapis.com/css?family=Lato:100,300,400,700,900,100italic,300italic,400italic,700italic,900italic' rel='stylesheet' type='text/css'>
	<link href="<?=base_url();?>css/main_tracking.css" rel="stylesheet">
	<link href="<?=base_url();?>css/fontello.min.css" rel="stylesheet">
	<link rel="stylesheet" href="<?=base_url();?>css/bootstrap-datetimepicker.min.css" />

		
	<script type="text/javascript" src="<?=base_url();?>js/bootstrap-select.js"></script>
    <link rel="stylesheet" type="text/css" href="<?=base_url();?>css/bootstrap-select.css">
	
	<script>
		var base_url = '<?= $this->config->item('base_url'); ?>';
		var lang_site = '<?= $this->lang->lang(); ?>';
		var requestInfo;
	</script>
	
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body>

<!-- Modal loading busqueda -->
<div class="modal fade" id="Error_loading" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
      	<div class="alert centertext no_mb">
      		<p><?=lang('ew_tr_consultando');?></p>
      		<p class="spinnerloading"><img src="<?=base_url();?>img/spinner.gif" /></p>
      	</div>
      </div>
      <div class="modal-footer centertext loadingcancelshape">
        <button type="button" class="btn btn-default" data-dismiss="modal" onclick="javascript:abortRequest();"><?=lang('ew_tr_cancelar');?></button>
      </div>
    </div>
  </div>
</div>

<!-- Modal loading solicitud de cambios -->
<div class="modal fade" id="Error_loading_cambios" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
      	<div class="alert centertext no_mb">
      		<p><?=lang('ew_tr_solicitud_en_marxa');?></p>
      		<p class="spinnerloading"><img src="<?=base_url();?>img/spinner.gif" /></p>
      	</div>
      </div>
    </div>
  </div>
</div>

<!-- Modal Error -->
<div class="modal fade" id="Error" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel"><?=lang('ew_tr_datos_invalidos_title');?></h4>
      </div>
      <div class="modal-body">
      	<div class="alert alert-danger">
      		<p><?=lang('ew_tr_datos_invalidos_description');?></p>
      	</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><?=lang('ew_tr_cerrar');?></button>
      </div>
    </div>
  </div>
</div>


<!-- Modal no se encuentra el pedido -->
<div class="modal fade" id="Error_busqueda" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel"><?=lang('ew_tr_error_busqueda_title');?></h4>
      </div>
      <div class="modal-body">
      	<div class="alert alert-danger">
      		<p><?=lang('ew_tr_error_busqueda_description');?></p>
      	</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><?=lang('ew_tr_cerrar');?></button>
      </div>
    </div>
  </div>
</div>

<!-- Modal KO en la solicitud de cambios -->
<div class="modal fade" id="Error_solicitud" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel"><?=lang('ew_tr_error_inesperado_title');?></h4>
      </div>
      <div class="modal-body">
      	<div class="alert alert-danger">
      		<p><?=lang('ew_tr_error_inesperado_description');?></p>
      	</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><?=lang('ew_tr_cerrar');?></button>
      </div>
    </div>
  </div>
</div>

<!-- Modal no hay dia / franja correctos en la solicitud -->
<div class="modal fade" id="Error_fecha_franja" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel"><?=lang('ew_tr_error_datos_solicitados_title');?></h4>
      </div>
      <div class="modal-body">
      	<div class="alert alert-danger">
      		<p><?=lang('ew_tr_error_datos_solicitados_description');?></p>
      	</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><?=lang('ew_tr_cerrar');?></button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Confirmación de cambios pendientes -->
<div class="modal fade" id="confirmacion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel"><?=lang('ew_tr_cambios_pendintes_title');?></h4>
      </div>
      <div class="modal-body">
      	<h2><font id="cp_num_pedido"></font></h2>
		<h3><?=lang('ew_tr_cambios_datos_pedido');?></h3>
		<p><?=lang('ew_tr_cambios_abonado');?><font id="cp_nombre_abonado"></font></p>
		<p><?=lang('ew_tr_cambios_fecha_alta');?><font id="cp_fecha_alta"></font></p>
		<p id="cont_cp_fecha"><?=lang('ew_tr_fecha_entrega');?><font id="cp_fecha_entrega_cliente"></font></p>
		<p id="cont_cp_franja"><?=lang('ew_tr_franja_entrega');?><font id="cp_franja"></font></p>
		<h3><?=lang('ew_tr_datos_destinatario');?></h3>
		<p id="cp_nombre_destinatario"></p>
		<address id="cp_direccion_entrega"></address>
		<p><?=lang('ew_tr_telf');?><font id="cp_telefono1"></font></p>
		<p><?=lang('ew_tr_telf2');?><font id="cp_telefono2"></font></p>
		<p><?=lang('ew_tr_email');?><font id="cp_email"></font></p>
		<p><?=lang('ew_tr_comentarios');?><font id="cp_comentarios_cliente"></font></p>
      </div>
      <div class="modal-footer">
      	<div class="btn-group btn-group-justified">
      		<div class="btn-group">
	       	 	<button type="button" class="btn btn-warning" onclick="javascript:solicitarNuevosCambios();"><?=lang('ew_tr_solicitar_nuevos_cambios');?></button>
	       	</div>
	    </div>
	    <br/>
	    <div class="btn-group btn-group-justified">
	       	<div class="btn-group">
	       	 	<button type="button" class="btn btn-success" onclick="javascript:cambiosCorrectos();"><?=lang('ew_tr_cambios_correctos');?></button>
	       	</div>
       	</div>
      </div>
    </div>
  </div>
</div>

<!-- Modal Confirmación de cambios realizados -->
<div class="modal fade" id="confirmacion_realizada" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel"><?=lang('ew_tr_solicitud_correcta');?></h4>
      </div>
      <div class="modal-body">
      	<h2><font id="cn_num_pedido"></font></h2>
		<h3><?=lang('ew_tr_cambios_datos_pedido');?></h3>
		<p><?=lang('ew_tr_cambios_abonado');?><font id="cn_nombre_abonado"></font></p>
		<p><?=lang('ew_tr_cambios_fecha_alta');?><font id="cn_fecha_alta"></font></p>
		<p id="cont_cn_fecha"><?=lang('ew_tr_fecha_entrega');?><font id="cn_fecha_entrega_cliente"></font></p>
		<p id="cont_cn_franja"><?=lang('ew_tr_franja_entrega');?><font id="cn_franja"></font></p>
		<h3><?=lang('ew_tr_datos_destinatario');?></h3>
		<p id="cn_nombre_destinatario"></p>
		<address id="cn_direccion_entrega"></address>
		<p><?=lang('ew_tr_telf');?><font id="cn_telefono1"></font></p>
		<p><?=lang('ew_tr_telf2');?><font id="cn_telefono2"></font></p>
		<p><?=lang('ew_tr_email');?><font id="cn_email"></font></p>
		<p><?=lang('ew_tr_comentarios');?><font id="cn_comentarios_cliente"></font></p>
      </div>
      <div class="modal-footer">
      	<button type="button" class="btn btn-default" data-dismiss="modal"><?=lang('ew_tr_cerrar');?></button>
      </div>
    </div>
  </div>
</div>

<!-- NAVBAR - HEADER -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
	<div class="container">
		<div class="navbar-header">
	  		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
	    	<span class="sr-only">Toggle navigation</span>
	    	<span class="icon-bar"></span>
	    	<span class="icon-bar"></span>
	    	<span class="icon-bar"></span>
	  		</button>
	  		<!--<a class="navbar-brand" href="#">Project name</a>-->
		</div>
    	<div class="navbar-collapse collapse ">
    		<div class="navbar-scrollspy">
	    		<ul class="nav navbar-nav">
	              <li><a href="<?=base_url().$this->lang->lang();?>/#emakers"><?=lang('ew_navbar_item1');?></a></li>
	              <li><a href="<?=base_url().$this->lang->lang();?>/#servicios"><?=lang('ew_navbar_item2');?></a></li>
	              <li><a href="<?=base_url().$this->lang->lang();?>/#interaccion"><?=lang('ew_navbar_item3');?></a></li>
	            </ul>
            </div>
    		<ul class="nav navbar-nav navbar-right">
	      		<a href="<?=base_url().$this->lang->lang();?>/tracking" target="_blank"><button type="button" class="btn btn-default btn-sm navbar-btn btn-active"><?=lang('ew_navbar_item4');?> <i class="icon-squares"></i></button></a>
	      		<a href="<?=base_url().$this->lang->lang();?>/contacta" target="_blank"><button type="button" class="btn btn-default btn-sm navbar-btn"><?=lang('ew_navbar_item5');?> <i class="icon-squares"></i></button></a>
	      		<a href="http://www.linkedin.com/company/emakers" target="_blank"><button type="button" class="btn btn-default btn-sm navbar-btn btn-linkedin"><i class="icon-linkedin-1"></i></button></a>
	      		<a href="https://twitter.com/emakers_es" target="_blank"><button type="button" class="btn btn-default btn-sm navbar-btn btn-twitter"><i class="icon-twitter-2"></i></button></a>
	      		<a href="https://www.facebook.com/Emakers" target="_blank"><button type="button" class="btn btn-default btn-sm navbar-btn btn-facebook"><i class="icon-facebook"></i></button></a>
	      	</ul>
    	</div>
	</div>
</nav>
  	
<div class="container margins">
    <div class="row">
    	<div class="col-sm-12">
    		<h1><?=lang('ew_tr_title');?></h1>
    		<h3><?=lang('ew_tr_slogan');?></h3>
    		<p><?=lang('ew_tr_description');?></p>
    	</div>
    	<div class="col-sm-6">
        	<form role="form">
        	  <div class="form-group" id="num_pedido_div">
        	    <label for="num_pedido"><?=lang('ew_tr_input1');?></label>
        	    <input type="text" class="form-control" id="num_pedido" placeholder="<?=lang('ew_tr_input1');?>" value="<?php if(isset($num_pedido) && $num_pedido != ''){ echo $num_pedido; } ?>">
        	  </div>
        	  <div class="form-group" id="mail_or_telf_div">
        	    <label for="mail_or_telf"><?=lang('ew_tr_input2');?></label>
        	    <input type="text" class="form-control" id="mail_or_telf" placeholder="<?=lang('ew_tr_input2');?>">
        	  </div>
        	  <div class="checkbox">
        	      <label id="lbl_condiciones">
        	        <input type="checkbox" id="checkCondiciones"> <?=lang('ew_tr_condiciones1');?> <a href="#" data-toggle="modal" data-target="#condiciones"><?=lang('ew_tr_condiciones2');?></a>
        	      </label>
        	  </div>
        	</form>
        	<div class="pull-right"><button data-toggle="modal" class="btn btn-success" onclick="javascript:sendConsulta();"><?=lang('ew_tr_consultar');?></button></div>
        	<button data-toggle="modal" data-target="#Error" class="btn hideshape" id="triggerErrorShape">&nbsp;</button>
        	<button data-toggle="modal" data-target="#Error_busqueda" class="btn hideshape" id="triggerError_busquedaShape">&nbsp;</button>
        	<button data-toggle="modal" data-target="#Error_solicitud" class="btn hideshape" id="triggerError_solicitudShape">&nbsp;</button>
        	<button data-toggle="modal" data-target="#Error_fecha_franja" class="btn hideshape" id="triggerError_fecha_franjaShape">&nbsp;</button>
        	<button data-toggle="modal" data-target="#Error_loading" class="btn hideshape" id="triggerErrorLoading">&nbsp;</button>
        	<button data-toggle="modal" data-target="#Error_loading_cambios" class="btn hideshape" id="triggerError_cambiosLoading">&nbsp;</button>
        	<button data-toggle="modal" data-target="#confirmacion" class="btn hideshape" id="triggerConfirmacionShape">&nbsp;</button>
        	<button data-toggle="modal" data-target="#confirmacion_realizada" class="btn hideshape" id="triggerConfirmacion_realizadaShape">&nbsp;</button>
        </div>
    </div>
    <div class="row hideshape" id="generalShapeContent">
    	<!-- DATOS COL IZQ -->
    	<div class="col-sm-6">
	    	<div class="alert alert-success">
	    		<h2 class="hideshape"><font id="tk_num_pedido"></font></h2>
	    		<h3><?=lang('ew_tr_cambios_datos_pedido');?></h3>
	    		<p id="cont_fecha"><?=lang('ew_tr_fecha_entrega');?> <b><font id="tk_fecha_entrega_cliente"></font></b></p>
	    		<p id="cont_franja"><?=lang('ew_tr_franja_entrega');?> <b><font id="tk_franja"></font></b></p>
	    		<p><?=lang('ew_tr_estadp_pedido');?> <b><font id="tk_estado"></font></b></p>
	    		<br/>
	    		<p><?=lang('ew_tr_cambios_abonado');?><font id="tk_nombre_abonado"></font></p>
	    		<p><?=lang('ew_tr_cambios_fecha_alta');?><font id="tk_fecha_alta"></font></p>
	    		
	    		
	    		<h3><?=lang('ew_tr_datos_destinatario');?></h3>
	    		<p id="tk_nombre_destinatario"></p>
	    		<address id="tk_direccion_entrega"></address>
	    		<div class="alert alert-danger">
					<b>¡Atención! DIRECCIÓN INCOMPLETA</b><br/>Su pedido se encuentra actualmente con DIRECCIÓN INCOMPLETA. Puede usted revisar y corregir los datos del destino del pedido con los controles de la derecha.<br/>Para más información puede contactar con <a href="mailto:infoenvios@emakers.es" class="alert-link">infoenvios@emakers.es</a>
				</div>
				<div class="alert alert-warning">
					<b>¡Atención!</b><br/>Se han solicitado cambios en su pedido que deben ser revisados por Emakers.
				</div>

	    	</div>
	    	<div class="alert alert-warning" id="notasTipsa">
	    		<h3><?=lang('ew_tr_notas_tipsa_itile');?></h3>
	    		<p><?=lang('ew_tr_notas_tipsa_description');?></p>
	    	</div>
	    	<div class="alert alert-warning" id="notasNOTipsa">
	    		<h3><?=lang('ew_tr_notas_notipsa_itile');?></h3>
	    		<p><?=lang('ew_tr_notas_notipsa_description');?></p>
	    	</div>
    	</div>
    	<!-- FIN DATOS COL IZQ -->
    	
    	<!-- CONTROLES -->
    	<div class="col-sm-6" id="controlsShapeContent">
    		<h3>¿Qué desea hacer con su pedido?</h3>
    		<p class="controlText">Las siguientes opciones le ofrecen la posibilidad de controlar en todo momento es estado y previsión de entrega de su pedido. Incluso puede definir una nueva dirección de entrega y escoger qué notificaciones recibir y dónde recibirlas.</p>
    		<div id="ctrop1" class="ctrop">
				<button type="button" class="btn btn-primary btn-block" onclick="javascript:controlOp(1);"><span class="glyphicon glyphicon-calendar gly_emks"></span> CAMBIAR LA FECHA O FRANJA DE ENTREGA</button>
				<p class="controlText">Puede <b>posponer su entrega y proponer el día y franja que más le convenga</b>. Recuerde que los cambios de franja en el mismo día están sujetos al horario que usted lo solicita. <br/>Vea las <a href="#">Condiciones de uso</a> si quiere ampliar la información.</p>
    		</div>
	    	
	    	<div id="ctrop2" class="ctrop">
	    		<button type="button" class="btn btn-info btn-block" onclick="javascript:controlOp(2);"><span class="glyphicon glyphicon-comment gly_emks"></span> CAMBIAR TELÉFONO O EMAIL DE NOTIFICACIONES</button>
				<p class="controlText">Decida <b>qué notificaciones recibir y en qué correo o número de teléfono</b> recibirlas. Recuerde que las notificaciones de tipo SMS sólo están disponibles para los avisos de entrega del día anterior y del mismo día.</p>
	    	</div>
	    	
	    	<div id="ctrop3" class="ctrop">
	    		<button type="button" class="btn btn-warning btn-block" onclick="javascript:controlOp(3);"><span class="glyphicon glyphicon-map-marker gly_emks"></span> CAMBIAR DIRECCIÓN O INDICACIONES DE ENTREGA</button>
				<p class="controlText">Puede <b>editar la dirección de entrega</b> y proponer un nuevo destino para su pedido. Si usted lo desea, puede <b>dar permiso para que se lo entreguemos al portero o al vecino</b> en caso de ausencia en el momento de entrega.</p>
			</div>
    	</div>
    	<!-- FIN CONTROLES -->
    	
    	<!-- FORMULARIO FECHA Y FRAJA -->
    	<div class="col-sm-6 hideshape" id="cambiosForm1">
    		<form role="form">
    			<div class="form-group">
    				<label for="input_dia_entrega"><?=lang('ew_tr_form_diaentrega');?></label>
    				<div class='input-group date' id='diadeentrega'>
    					<input type='text' class="form-control" id="input_dia_entrega" name="input_dia_entrega" />
    					<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
    				</div>
    			</div>
    			<div class="form-group">
    				<label for="input_franja_entrega"><?=lang('ew_tr_form_franjaentrega');?></label>
    				<select id="input_franja_entrega" name="input_franja_entrega" class="selectpicker show-tick form-control"></select>
    				<p class="svcnclbtns">
						<button type="button" class="btn btn-success btn-block" onclick="javascript:guardaFormOp(1);"><span class="glyphicon glyphicon-ok gly_emks"></span> Guardar cambios</button>
						<button type="button" class="btn btn-default btn-block" onclick="javascript:controlOpShowdown();"><span class="glyphicon glyphicon-remove gly_emks"></span> Cancelar / Volver</button>
					</p>
    			</div>
    		</form>
    	</div>
    	
    	<!-- FORMULARIO DATOS Y COMENTARIOS -->
    	<div class="col-sm-6 hideshape" id="cambiosForm2">
    		<form role="form">
    			<div class="form-group">
    				<div class="form-group">
						<label for="input_telefono1"><?=lang('ew_tr_form_telf');?></label>
		    			<input type="tel" class="form-control" id="input_telefono1" name="input_telefono1" placeholder="<?=lang('ew_tr_form_ph_telf');?>">
		    		</div>
		    		<div class="form-group">
		    			<label for="input_telefono2"><?=lang('ew_tr_form_telf2');?></label>
		    			<input type="tel" class="form-control" id="input_telefono2" name="input_telefono2" placeholder="<?=lang('ew_tr_form_ph_telf2');?>">
		    		</div>
		    		<div class="form-group">
		    			<label for="input_email"><?=lang('ew_tr_form_email');?></label>
		    			<input type="email" class="form-control" id="input_email" name="input_email" placeholder="<?=lang('ew_tr_form_ph_correo');?>">
		    		</div>
		    		
		    		<div class="checkbox">
					    <label>
					    	<input type="checkbox" checked="checked"> Recibir SMS el mismo día de entrega <br/><font class="fs10">(se le informará de una ventana de 60 minutos en la que se prevé entregar su pedido)</font>
					    </label>
					</div>
		    		
		    		<div class="checkbox">
					    <label>
					    	<input type="checkbox" checked="checked"> Recibir correo o SMS el día antes de la entrega
					    </label>
					</div>
					
					<div class="checkbox">
					    <label>
					    	<input type="checkbox"> Recibir correo de confirmación de entrega
					    </label>
					</div>
					
					<div class="checkbox">
					    <label>
					    	<input type="checkbox" checked="checked"> Recibir correo de aviso de ausencia durante la entrega
					    </label>
					</div>
					
					<div class="checkbox">
					    <label>
					    	<input type="checkbox" checked="checked"> Recibir correo de aviso de errores en la dirección
					    </label>
					</div>
		    		
    				<p class="svcnclbtns">
						<button type="button" class="btn btn-success btn-block" onclick="javascript:guardaFormOp(2);"><span class="glyphicon glyphicon-ok gly_emks"></span> Guardar cambios</button>
						<button type="button" class="btn btn-default btn-block" onclick="javascript:controlOpShowdown();"><span class="glyphicon glyphicon-remove gly_emks"></span> Cancelar / Volver</button>
					</p>
    			</div>
    		</form>
    	</div>
    	
    	<!-- FORMULARIO CAMBIO DIRECCION -->
    	<div class="col-sm-6 hideshape" id="cambiosForm3">
    		<form role="form">
    			<div class="form-group">
    				<div class="form-group col-sm-12">
						<label for="ip_cf_tipo_via">Selecciona el tipo de via</label>
		    			<select id="ip_cf_tipo_via" name="ip_cf_tipo_via" class="selectpicker show-tick form-control">
			    			<option value="0">NO DEFINIDA</option>
			    			<option value="1">CALLE</option>
			    			<option value="2">AVENIDA</option>
			    			<option value="3">PASEO</option>
			    			<option value="4">PLAZA</option>
			    			<option value="5">PASAJE</option>
		    			</select>
		    		</div>
		    		<div class="form-group col-sm-6">
		    			<label for="ip_direccion">Nombre de la calle / via</label>
		    			<input class="form-control" id="ip_direccion" name="ip_direccion" placeholder="Nombre de la calle / via">
		    		</div>
		    		<div class="form-group col-sm-3">
		    			<label for="ip_numero">Número</label>
		    			<input class="form-control" id="ip_numero" name="ip_numero" placeholder="Número">
		    		</div>
		    		<div class="form-group col-sm-3">
		    			<label for="ip_cp">CP</label>
		    			<input class="form-control" id="ip_cp" name="ip_cp" placeholder="CP">
		    		</div>
		    		<div class="form-group col-sm-12">
		    			<label for="ip_otros_direccion">Escalera, piso, puerta ...</label>
		    			<input class="form-control" id="ip_otros_direccion" name="ip_otros_direccion" placeholder="Escalera, piso, puerta ...">
		    		</div>
		    		<div class="form-group col-sm-12">
		    			<label for="input_comentarios_cliente">Comentarios</label>
		    			<input class="form-control" id="input_comentarios_cliente" name="input_comentarios_cliente" placeholder="Comentarios">
		    		</div>
		    		<div class="form-group col-sm-12">
			    		<div class="checkbox">
						    <label>
						    	<input type="checkbox"> Se puede entregar en portería o recepción
						    </label>
						</div>
						<div class="checkbox">
						    <label>
						    	<input type="checkbox"> Se puede entregar al vecino o local próximo
						    </label>
						</div>
						<input class="form-control" id="" name="" placeholder="Indícanos algún dato sobre el vecino o local">
					</div>
		    		
		    		<div class="col-sm-12">
		    		
		    			<div class="alert alert-warning">
							<b>¡Atención! Pedido EN RUTA</b><br/>Su pedido se encuentra actualmente EN RUTA. Cualquier cambio de dirección implica el cambio automático de franja y posiblemente día de entrega.<br/>Para más información puede contactar con <a href="mailto:infoenvios@emakers.es" class="alert-link">infoenvios@emakers.es</a>
						</div>
						
						<div class="alert alert-warning">
							<b>¡Atención! Pedido con contrarrembolso</b><br/>Su pedido lleva asociado un reembolso. Esto significa que en el momento de entrega, nuestro repartidor deberá cobrar la cantidad correspondiente. Recuerde que si usted da permiso para que su pedido se entregue en portería, recepción, vecino o local próximo estará delegando dicha responsabilidad a la persona que recibirá su pedido.<br/>Para más información puede contactar con <a href="mailto:infoenvios@emakers.es" class="alert-link">infoenvios@emakers.es</a>
						</div>
		    			
	    				<p class="svcnclbtns">
							<button type="button" class="btn btn-success btn-block" onclick="javascript:guardaFormOp(3);"><span class="glyphicon glyphicon-ok gly_emks"></span> Guardar cambios</button>
							<button type="button" class="btn btn-default btn-block" onclick="javascript:controlOpShowdown();"><span class="glyphicon glyphicon-remove gly_emks"></span> Cancelar / Volver</button>
						</p>
					</div>
    			</div>
    		</form>
    	</div>
    	
    	<input type="hidden" name="conf_franja" id="conf_franja" value="" />
    	<input type="hidden" name="id2_pedido" id="id2_pedido" value="" />
    	<input type="hidden" name="tabla_origen" id="tabla_origen" value="" />
    	<input type="hidden" name="num_pedido" id="num_pedido" value="" />
    	<input type="hidden" name="cf_agencia" id="cf_agencia" value="" />
    	
    	<!-- CAPA DE FORMULARIO _OLD_ -->
    	<div class="col-sm-6 hideshape" id="cambiosShapeContent">
    		<p class="mt20"><?=lang('ew_tr_form_title');?></p>
    		<form role="form">
    			<h3><?=lang('ew_tr_form_diaentrega');?></h3>
    			<div class="form-group">
    				<div class='input-group date' id='diadeentrega'>
    					<input type='text' class="form-control" id="input_dia_entrega" />
    					<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
    				</div>
    				<h3><?=lang('ew_tr_form_franjaentrega');?></h3>
    				<select id="input_franja_entrega" class="selectpicker show-tick form-control">
                    </select>
    				<h3><?=lang('ew_tr_form_otros_datos');?></h3>
    			</div>
    			<div class="form-group">
    			  <label for="input_telefono1"><?=lang('ew_tr_form_telf');?></label>
    			  <input type="tel" class="form-control" id="input_telefono1" name="input_telefono1" placeholder="<?=lang('ew_tr_form_ph_telf');?>">
    			</div>
    			<div class="form-group">
    			  <label for="input_telefono2"><?=lang('ew_tr_form_tel2');?></label>
    			  <input type="tel" class="form-control" id="input_telefono2" name="input_telefono2" placeholder="<?=lang('ew_tr_form_ph_telf2');?>">
    			</div>
    			<div class="form-group">
    			  <label for="input_email"><?=lang('ew_tr_form_email');?></label>
    			  <input type="email" class="form-control" id="input_email" name="input_email" placeholder="<?=lang('ew_tr_form_ph_correo');?>">
    			</div>
    			<div class="form-group">
    				<label for="input_comentarios_cliente"><?=lang('ew_tr_form_comentarios');?></label>	
    	    		<textarea id="input_comentarios_cliente" name="input_comentarios_cliente" class="form-control" rows="3" placeholder="<?=lang('ew_tr_form_ph_comentarios');?>"></textarea>
    			</div>
    			<input type="hidden" name="conf_franja" id="conf_franja" value="" />
    			<input type="hidden" name="id2_pedido" id="id2_pedido" value="" />
    			<input type="hidden" name="tabla_origen" id="tabla_origen" value="" />
    			<input type="hidden" name="num_pedido" id="num_pedido" value="" />
    			<input type="hidden" name="cf_agencia" id="cf_agencia" value="" />
    		</form>
    		<button data-toggle="modal" class="btn btn-success" onclick="javascript:sendFranjaChange();"><?=lang('ew_tr_form_solicitar_cambios');?></button>
    	</div>
    	<!-- FIN CAPA DE FORMULARIO _OLD_ -->
    </div>
</div>


<!-- FOOTER -->
<footer>
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-md-12">
				<div class="logo-footer">
					<img src="<?=base_url();?>img/emakers_logo.png" width="193" alt="Logo Emakers"/>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-3 col-sm-3 col-xs-12">
				<address>
				  <strong>Barcelona</strong><br>
				  <a href="mailto:contacta@emakers.es">contacta@emakers.es</a><br>
				  Calle Comte Urgell, 51 bis<br>
				  08011 Barcelona<br>
				  <br />
				  (+34) 93 624 24 26<br />
				  (+34) 93 419 92 09
				</address>
			</div>
			
			<div class="col-md-5 col-sm-5 col-xs-12">
				<address>
					<strong><?=lang('ew_footer_resumen_title');?></strong><br />
					<a href="<?=base_url().$this->lang->lang()?>/#emakers"><?=lang('ew_footer_resumen_emakers');?></a><br />
					<a href="<?=base_url().$this->lang->lang()?>/#servicios"><?=lang('ew_footer_resumen_servicios');?></a><br />
					<a href="<?=base_url().$this->lang->lang()?>/#interaccion"><?=lang('ew_footer_resumen_interaccion');?></a><br />
					<a href="<?=base_url().$this->lang->lang()?>/#entregas"><?=lang('ew_footer_resumen_entregas');?></a><br />
					<a href="<?=base_url().$this->lang->lang()?>/#ademas"><?=lang('ew_footer_resumen_ademas');?></a><br />
				</address>
			</div>
			<div class="col-md-3 col-sm-3 col-xs-12 col-sm-offset-1 col-md-offset-1">
				<address>
					<strong><?=lang('ew_footer_siguenos');?></strong><br />
					<a href="http://www.linkedin.com/company/emakers" target="_blank"><i class="icon-linkedin-1"></i></a>
					<a href="https://twitter.com/emakers_es" target="_blank"><i class="icon-twitter-2"></i></a>
					<a href="https://www.facebook.com/Emakers" target="_blank"><i class="icon-facebook"></i></a>
				</address>
			</div>
		</div>
		<div class="row">
   			<div class="col-md-12 col-sm-12 col-xs-12">
   				<div class="rights-footer">
	   				<p class="pull-right"><?=anchor($this->lang->switch_uri(($this->lang->lang() == 'es') ? 'en' : 'es'),lang('ew_footer_lenguage'));?></p>
		        	<p>
		        		<?=lang('ew_footer_copy');?>
		        		<a href="#" data-toggle="modal" data-target="#condiciones"><?=lang('ew_footer_condiciones');?></a>
		        	</p>
	        	</div>
        	</div>
    	</div>
	</div>
</footer>

<!-- MODAL CONDICIONES DE USO -->
<div class="modal fade" id="condiciones" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel"><?=lang('ew_section_conditions_title');?></h4>
      </div>
      <div class="modal-body">
        <p><?=lang('ew_section_conditions_text1');?></p>
        <p><?=lang('ew_section_conditions_text2');?></p>
        <p><?=lang('ew_section_conditions_text3');?></p>
        <p><?=lang('ew_section_conditions_text4');?></p>
        <p><?=lang('ew_section_conditions_text5');?></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger btn-xs" data-dismiss="modal"><?=lang('ew_section_conditions_close');?></button>
      </div>
    </div>
  </div>
</div>


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="<?=base_url();?>js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?=base_url();?>js/moment.min.js"></script>
<script type="text/javascript" src="<?=base_url();?>js/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript" src="<?=base_url();?>js/bootstrap-datetimepicker.es.js"></script>
<script type="text/javascript" src="<?=base_url();?>js/script_tracking.js"></script>
</body>
</html>