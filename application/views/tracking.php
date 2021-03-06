<!DOCTYPE html>
<?php
	$today = date('N');
	$dia_proximo = 1;
	switch($today){
		case 5:
			$dia_proximo = 3;
		break;
		case 6:
			$dia_proximo = 2;
		break;
	}
	$dia_proximo = date('d/m/Y', strtotime("now +".$dia_proximo." day"));
?>
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

<!-- Modal SaveOK -->
<div class="modal fade" id="SaveOK" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel"><?=lang('ew_tr_datos_guardados_title');?></h4>
      </div>
      <div class="modal-body">
      	<div class="alert alert-success">
      		<p><?=lang('ew_tr_datos_guardados_description');?></p>
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

<!-- Modal no hay dia / franja correctos en la solicitud -->
<div class="modal fade" id="Error_horarios" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel"><?=lang('ew_tr_error_datos_solicitados_title');?></h4>
      </div>
      <div class="modal-body">
      	<div class="alert alert-danger">
      		<p><?=lang('ew_tr_error_datos_solicitados_description2');?></p>
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
        	<button data-toggle="modal" data-target="#SaveOK" class="btn hideshape" id="triggerSaveShape">&nbsp;</button>
        	<button data-toggle="modal" data-target="#Error_busqueda" class="btn hideshape" id="triggerError_busquedaShape">&nbsp;</button>
        	<button data-toggle="modal" data-target="#Error_solicitud" class="btn hideshape" id="triggerError_solicitudShape">&nbsp;</button>
        	<button data-toggle="modal" data-target="#Error_fecha_franja" class="btn hideshape" id="triggerError_fecha_franjaShape">&nbsp;</button>
        	<button data-toggle="modal" data-target="#Error_horarios" class="btn hideshape" id="triggerError_horarios_franjaShape">&nbsp;</button>
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
	    		<div class="alert alert-danger tjustify hideshape" id="alert_dir_mal">
					<b>¡Atención! DIRECCIÓN INCOMPLETA / INCORRECTA</b><br/>Su pedido se encuentra actualmente con DIRECCIÓN INCOMPLETA o INCORRECTA. Para revisar y corregir los datos y la dirección de entrega de su pedido, utilice los controles de la derecha.<br/><br/>Para más información puede contactar con <a href="mailto:infoenvios@emakers.es" class="alert-link">infoenvios@emakers.es</a>
				</div>
				<div class="alert alert-warning tjustify hideshape" id="alert_cambios_pendientes">
					<span class="glyphicon glyphicon-exclamation-sign alert-danger" aria-hidden="true"></span> <b>¡Atención!</b><br/>Se han solicitado cambios en su pedido que serán revisados por el equipo de Emakers y se le confirmará la aprobación de su solicitud.
				</div>

	    	</div>
	    	<div class="alert alert-warning tjustify" id="notasTipsa">
	    		<h3><?=lang('ew_tr_notas_tipsa_itile');?></h3>
	    		<p><?=lang('ew_tr_notas_tipsa_description');?></p>
	    	</div>
	    	<div class="alert alert-warning tjustify" id="notasNOTipsa">
	    		<h3><?=lang('ew_tr_notas_notipsa_itile');?></h3>
	    		<p><?=lang('ew_tr_notas_notipsa_description');?></p>
	    	</div>
    	</div>
    	<!-- FIN DATOS COL IZQ -->
    	
    	<!-- CONTROLES -->
    	<div class="col-sm-6" id="controlsShapeContent">
    		<h3>¿Qué desea hacer con su pedido?</h3>
    		<p class="controlText2">Las siguientes opciones le ofrecen la posibilidad de controlar en todo momento el estado y la previsión de entrega de su pedido. Si lo desea, también puede definir una nueva dirección de entrega y escoger las notificaciones que desea recibir y dónde desea recibirlas.</p>
    		<div id="ctrop1" class="ctrop">
				<button type="button" class="btn btn-primary btn-block" onclick="javascript:controlOp(1);"><span class="glyphicon glyphicon-calendar gly_emks"></span> FECHA Y FRANJA</button>
				<p class="controlText">Puede cambiar la fecha de entrega de <b>su pedido y escoger el día y la franja que más le convenga.</b> Vea las <a href="#" data-toggle="modal" data-target="#condiciones"><?=lang('ew_footer_condiciones');?></a> si quiere ampliar la información.</p>
    		</div>
	    	
	    	<div id="ctrop2" class="ctrop">
	    		<button type="button" class="btn btn-info btn-block" onclick="javascript:controlOp(2);"><span class="glyphicon glyphicon-comment gly_emks"></span> DATOS DE CONTACTO</button>
				<p class="controlText">Decida <b>qué notificaciones recibir y en qué correo o número de teléfono</b> recibirlas. Recuerde que las notificaciones de tipo SMS sólo están disponibles para los avisos de pre-entrega del día anterior y del mismo día de la entrega.</p>
	    	</div>
	    	
	    	<div id="ctrop3" class="ctrop">
	    		<button type="button" class="btn btn-warning btn-block" onclick="javascript:controlOp(3);"><span class="glyphicon glyphicon-map-marker gly_emks"></span> DIRECCIÓN / INDICACIONES</button>
				<p class="controlText">Puede <b>editar la dirección de entrega</b> y proponer un nuevo destino para recibir su pedido. Si lo desea, puede <b>autorizar para que se lo entreguemos al portero o al vecino</b> en caso de ausencia en el momento de entrega.</p>
			</div>
    	</div>
    	<!-- FIN CONTROLES -->
    	
    	<!-- FORMULARIO FECHA Y FRAJA -->
    	<div class="col-sm-6 hideshape" id="cambiosForm1">
    		<form role="form">
    			<div class="form-group">
    				<label for="input_dia_entrega"><?=lang('ew_tr_form_diaentrega');?></label>
    				<p class="tjustify">Por favor, escoja primero el día deseado de entrega. Tenga en cuenta que la disponibilidad de las franjas dependen del día escogido.</p>
    				<div class='input-group date' id='diadeentrega'>
    					<input type='text' class="form-control" id="input_dia_entrega" name="input_dia_entrega" readonly=""/>
    					<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
    				</div>
    			</div>
    			
    			
    			<div id="capa_franjas_premium">
    				<div class="form-group">
	    				<label for="input_franja_entrega_premium"><?=lang('ew_tr_form_franjaentrega');?></label>
	    				<p class="tjustify">Por favor, escoja la franja de entrega deseada. Tenga en cuenta que el servicio Emakers Premium puede implicar un sobrecoste.</p>
	    				<div class="alert alert-warning">
							El servicio Emakers Premium deberá abonarse en el momento de la entrega en efectivo y con el importe exacto al repartidor. Estamos trabajando en ofrecer otros métodos de pago. 
						</div>
						
						<div class="alert alert-danger hideshape" id="txt_so_franja">
							No hay franjas disponibles para la fecha seleccionada.<br/>Por favor, escoja otro <b>día de entrega</b>.
						</div>
		    				
						<div class="row">
						 	<div class="col-sm-6" id="input_franja_entrega_premium_col">
						 		<label class="lbl_franjas">Franjas Emakers PREMIUM<!-- <a class="makehover" data-toggle="popover" title="Popover Header" data-content="Some content inside the popover"><span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span></a>--></label>
						 		<div class="btn-group-vertical btn-block" id="input_franja_entrega_premium">
									<button id="fr_pr_1" type="button" class="btn btn-default">09:00 a 10:00 <font style="color:red;">(2.99€)</font></button>
									<button id="fr_pr_2" type="button" class="btn btn-default">10:00 - 11:00 <font style="color:red;">(2.99€)</font></button>
									<button id="fr_pr_3" type="button" class="btn btn-default">11:00 - 12:00 <font style="color:red;">(2.99€)</font></button>
									<button id="fr_pr_4" type="button" class="btn btn-default">12:00 - 13:00 <font style="color:red;">(2.99€)</font></button>
									<button id="fr_pr_5" type="button" class="btn btn-default">13:00 - 14:00 <font style="color:red;">(2.99€)</font></button>
									
									<button id="fr_pr_6" type="button" class="btn btn-default active">15:00 - 16:00 <font style="color:red;">(2.99€)</font></button>
									<button id="fr_pr_7" type="button" class="btn btn-default">16:00 - 17:00 <font style="color:red;">(2.99€)</font></button>
									<button id="fr_pr_8" type="button" class="btn btn-default">17:00 - 18:00 <font style="color:red;">(2.99€)</font></button>
									
									<button id="fr_pr_9" type="button" class="btn btn-default">19:00 - 20:00 <font style="color:red;">(2.99€)</font></button>
									<button id="fr_pr_10" type="button" class="btn btn-default">20:00 - 21:00 <font style="color:red;">(2.99€)</font></button>
									<button id="fr_pr_11" type="button" class="btn btn-default">21:00 - 22:00 <font style="color:red;">(2.99€)</font></button>
									
									<input type="hidden" id="input_franja_entrega_premium" value="" />
								</div>
							</div>
						 	<div class="col-sm-6" id="input_franja_entrega_premium_normales_col">
						 		<label class="lbl_franjas">Franjas Emakers GRATUITAS</label>
							 	
						 		<div id="content_conf_franjas_1">
						 			<div class="btn-group-vertical btn-block" id="input_franja_entrega_premium_normales">
							 			<button id="fr_gr_1" type="button" class="btn btn-default h_franja_manana">MAÑANA (09:00 - 14:00)<br/>(sin coste adicional)</button>
							 			<button id="fr_gr_2" type="button" class="btn btn-default h_franja_tarde">TARDE (15:00 - 18:00)<br/>(sin coste adicional)</button>
							 			<button id="fr_gr_3" type="button" class="btn btn-default h_franja_aw">AFTER-WORK (19:00 - 22:00)<br/>(sin coste adicional)</button>
							 		</div>
						 		</div>
						 		
							 	<div id="content_conf_franjas_2">
							 		<div class="btn-group-vertical btn-block" id="input_franja_entrega_premium_normales">
							 			<button id="fr_gr_4" type="button" class="btn btn-default h_franja_diurna"><font id="btn_diurna_text">DIURNA (09:00 - 18:00)<br/>(sin coste adicional)</font></button>
							 			<button id="fr_gr_33" type="button" class="btn btn-default h_franja_diurna_aw">AFTER-WORK (19:00 - 22:00)<br/>(sin coste adicional)</button>
						 			</div>
							 	</div>
							 	<input type="hidden" id="input_franja_entrega_normal" value="" />
								
						 	</div>
						</div>
						
						<div id="content_horarios">
							<p class="tjustify">Si la dirección de entrega es una oficina/tienda/empresa, por favor indique el horario de apertura. Por favor, tenga en cuenta que las franjas deben ser de 4 horas o más.</p>
    			
			    			<div class="form-group col-sm-6 nopaddingleft">
				    			<label for="hora1_inicio">Disponibilidad por las mañanas</label>
				    			<input class="form-control" id="hora1_inicio_form4" name="hora1_inicio_form4" placeholder="Hora inicial (hh:mm)">
				    		</div>
				    		<div class="form-group col-sm-6 nopaddingright">
				    			<label for="hora1_final">&nbsp;</label>
				    			<input class="form-control" id="hora1_final_form4" name="hora1_final_form4" placeholder="Hora final (hh:mm)">
				    		</div>
				    		
				    		<div class="form-group col-sm-6 nopaddingleft">
				    			<label for="hora2_inicio">Disponibilidad por las tardes</label>
				    			<input class="form-control" id="hora2_inicio_form4" name="hora2_inicio_form4" placeholder="Hora inicial (hh:mm)">
				    		</div>
				    		<div class="form-group col-sm-6 nopaddingright">
				    			<label for="hora2_final">&nbsp;</label>
				    			<input class="form-control" id="hora2_final_form4" name="hora2_final_form4" placeholder="Hora final (hh:mm)">
				    		</div>
				    		<p>* La franja propuesta debe cubrir, como mínimo, 4 horas de margen.<br/><font class="fs10">(recibirá un SMS con una franja de 60 minutos dentro de esta franja)</font></p>
						</div>
						
	    			</div>
	    			
	    			<div class="form-group col-sm-12 nopadding">
	    				<p class="svcnclbtns">
							<button type="button" class="btn btn-success btn-block" onclick="javascript:guardaFormOp(4);"><span class="glyphicon glyphicon-ok gly_emks"></span> Guardar cambios</button>
							<button type="button" class="btn btn-default btn-block" onclick="javascript:controlOpShowdown();"><span class="glyphicon glyphicon-remove gly_emks"></span> Cancelar / Volver</button>
						</p>
	    			</div>
    			</div>
    			<div id="capa_franjas_gratuitas">
	    			<div class="form-group">
	    				<label for="input_franja_entrega"><?=lang('ew_tr_form_franjaentrega');?></label>
	    				<select id="input_franja_entrega" name="input_franja_entrega" class="selectpicker show-tick form-control"></select>
	    			</div>
    			
	    			<p class="tjustify">Si la dirección de entrega es una oficina/tienda/empresa, por favor indique el horario de apertura. Por favor, tenga en cuenta que las franjas deben ser de 4 horas o más.</p>
    			
	    			<div class="form-group col-sm-6 nopaddingleft">
		    			<label for="hora1_inicio">Disponibilidad por las mañanas</label>
		    			<input class="form-control" id="hora1_inicio" name="hora1_inicio" placeholder="Hora inicial (hh:mm)">
		    		</div>
		    		<div class="form-group col-sm-6 nopaddingright">
		    			<label for="hora1_final">&nbsp;</label>
		    			<input class="form-control" id="hora1_final" name="hora1_final" placeholder="Hora final (hh:mm)">
		    		</div>
		    		
		    		<div class="form-group col-sm-6 nopaddingleft">
		    			<label for="hora2_inicio">Disponibilidad por las tardes</label>
		    			<input class="form-control" id="hora2_inicio" name="hora2_inicio" placeholder="Hora inicial (hh:mm)">
		    		</div>
		    		<div class="form-group col-sm-6 nopaddingright">
		    			<label for="hora2_final">&nbsp;</label>
		    			<input class="form-control" id="hora2_final" name="hora2_final" placeholder="Hora final (hh:mm)">
		    		</div>
		    		<p>* La franja propuesta debe cubrir, como mínimo, 4 horas de margen.<br/><font class="fs10">(recibirá un SMS con una franja de 60 minutos dentro de esta franja)</font></p>
	    			<div class="form-group col-sm-12 nopadding">
	    				<p class="svcnclbtns">
							<button type="button" class="btn btn-success btn-block" onclick="javascript:guardaFormOp(1);"><span class="glyphicon glyphicon-ok gly_emks"></span> Guardar cambios</button>
							<button type="button" class="btn btn-default btn-block" onclick="javascript:controlOpShowdown();"><span class="glyphicon glyphicon-remove gly_emks"></span> Cancelar / Volver</button>
						</p>
	    			</div>
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
					    	<input type="checkbox" checked="checked" id="ifCOM10" name="ifCOM10"> Recibir SMS el mismo día de entrega <br/><font class="fs10">(se le informará de una ventana de 60 minutos en la que se prevé entregar su pedido)</font>
					    </label>
					</div>
		    		
		    		<div class="checkbox">
					    <label>
					    	<input type="checkbox" checked="checked" id="ifCOMPre" name="ifCOMPre"> Recibir correo o SMS el día antes de la entrega
					    </label>
					</div>
					
					<div class="checkbox">
					    <label>
					    	<input type="checkbox" id="ifCOMPost" name="ifCOMPost"> Recibir correo de confirmación de entrega
					    </label>
					</div>
					
					<div class="checkbox">
					    <label>
					    	<input type="checkbox" checked="checked" id="ifCOMAus" name="ifCOMAus"> Recibir correo de aviso de ausencia durante la entrega
					    </label>
					</div>
					
					<div class="checkbox">
					    <label>
					    	<input type="checkbox" checked="checked" id="ifCOMDir" name="ifCOMDir"> Recibir correo de aviso de errores en la dirección
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
						    	<input type="checkbox" name="ifPorteria" id="ifPorteria"> Se puede entregar en portería o recepción
						    </label>
						</div>
						<div class="checkbox">
						    <label>
						    	<input type="checkbox" name="ifVecino" id="ifVecino"> Se puede entregar al vecino o local próximo
						    </label>
						</div>
						<input class="form-control" id="vecino_desc" name="vecino_desc" placeholder="Indícanos algún dato sobre el vecino o local">
					</div>
		    		
		    		<div class="col-sm-12">
		    			<div class="alert alert-danger tjustify">
							<b>¡Atención!</b><br/>No se permiten cambios que impliquen la entrega en otra localidad. <br/>Para realizar un cambio de dirección a otra localidad, puede contactar con <a href="mailto:infoenvios@emakers.es" class="alert-link">infoenvios@emakers.es</a>
						</div>
		    			<div class="alert alert-warning tjustify hideshape" id="alert_en_ruta">
							<b>¡Atención! Pedido EN RUTA</b><br/>Su pedido se encuentra actualmente <b>EN RUTA</b> hacia su dirección actual. Cualquier modificación de la dirección implica entregar el pedido a partir del día <b><?=$dia_proximo?></b>.<br/>Para más información puede contactar con <a href="mailto:infoenvios@emakers.es" class="alert-link">infoenvios@emakers.es</a>
						</div>
						
						<div class="alert alert-warning tjustify hideshape" id="alert_contrareembolso">
							<b>¡Atención! Pedido con contrarrembolso</b><br/>Su pedido lleva asociado un reembolso de <b><font id="valor_reembolso_txt"></font>€</b>. Esto significa que en el momento de entrega, nuestro repartidor deberá cobrar la cantidad correspondiente. Recuerde avisar a la persona que va a recibir su pedido que debe abonar el importe del reembolso si quiere recibir el pedido. En caso contrario, el repartidor no efectuará la entrega.<br/><br/>Para más información contacte con <a href="mailto:infoenvios@emakers.es" class="alert-link">infoenvios@emakers.es</a>
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
		<input type="hidden" name="cf_estado" id="cf_estado" value="" />
		<input type="hidden" name="cf_abonado" id="cf_abonado" value="" />
		<input type="hidden" name="ifMailPre" id="ifMailPre" value="" />
		<input type="hidden" name="valor_reembolso" id="valor_reembolso" value="" />
		
		<!-- datos originales -->
		<input type="hidden" name="fecha_original" id="fecha_original" value="" />
		<input type="hidden" name="franja_original" id="franja_original" value="" />
		<input type="hidden" name="franja_pr_original" id="franja_pr_original" value="" />
		<input type="hidden" name="cf_tipo_via_original" id="cf_tipo_via_original" value="" />
		<input type="hidden" name="direccion_original" id="direccion_original" value="" />
		<input type="hidden" name="numero_original" id="numero_original" value="" />
		<input type="hidden" name="cp_original" id="cp_original" value="" />
		<input type="hidden" name="otros_direccion_original" id="otros_direccion_original" value="" />
		<input type="hidden" name="localidad_original" id="localidad_original" value="" />
		<input type="hidden" name="horario1_inicio_original" id="horario1_inicio_original" value="" />
		<input type="hidden" name="horario1_fin_original" id="horario1_fin_original" value="" />
		<input type="hidden" name="horario2_inicio_original" id="horario2_inicio_original" value="" />
		<input type="hidden" name="horario2_fin_original" id="horario2_fin_original" value="" />
		
		<!-- constantes -->
		<input type="hidden" name="franja_desc1" id="franja_desc1" value="MAÑANA (09:00 - 14:00)" />
		<input type="hidden" name="franja_desc2" id="franja_desc2" value="TARDE (15:00 - 18:30)" />
		<input type="hidden" name="franja_desc3" id="franja_desc3" value="NOCHE (19:00 - 22:00)" />
		<input type="hidden" name="franja_desc4" id="franja_desc4" value="DIURNA (09:00 - 17:00)" />
		
		<input type="hidden" name="tipovia_desc1" id="tipovia_desc1" value="CALLE" />
		<input type="hidden" name="tipovia_desc2" id="tipovia_desc2" value="AVENIDA" />
		<input type="hidden" name="tipovia_desc3" id="tipovia_desc3" value="PASEO" />
		<input type="hidden" name="tipovia_desc4" id="tipovia_desc4" value="PLAZA" />
		<input type="hidden" name="tipovia_desc5" id="tipovia_desc5" value="PASAJE" />
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
				  (+34) 93 365 78 85
				  <br/>
				  <font style="font-size:10px;">Teléfonos de tarificación normal.</font>
				</address>
			</div>
			<div class="col-md-5 col-sm-5 col-xs-12">
				<address>
				  <strong>Madrid</strong><br>
				  <a href="mailto:contacta@emakers.es">contacta@emakers.es</a><br>
				  Calle Marqués de Monteagudo, 22<br>
				  28028 Madrid<br>
				  <br />
				  (+34) 81 051 45 63
				  <br/>
				  <font style="font-size:10px;">Teléfonos de tarificación normal.</font>
				</address>
			</div>
			<!--<div class="clearfix visible-xs"></div>-->
			<!-- 
			<div class="col-md-5 col-sm-5 col-xs-12">
				<address>
					<strong><?=lang('ew_footer_resumen_title');?></strong><br />
					<a href="#emakers"><?=lang('ew_footer_resumen_emakers');?></a><br />
					<a href="#servicios"><?=lang('ew_footer_resumen_servicios');?></a><br />
					<a href="#interaccion"><?=lang('ew_footer_resumen_interaccion');?></a><br />
					<a href="#entregas"><?=lang('ew_footer_resumen_entregas');?></a><br />
					<a href="#ademas"><?=lang('ew_footer_resumen_ademas');?></a><br />
				</address>
			</div>
			-->
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
		        	<p><?=lang('ew_footer_copy');?> 
		        		<!-- <a href="#" data-toggle="modal" data-target="#politica"><?=lang('ew_footer_politica');?></a> y -->
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
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel"><?=lang('ew_section_conditions_title_premium');?></h4>
      </div>
      <div class="modal-body">
        <p><?=lang('ew_section_conditions_text1_premium');?></p>
        <p><?=lang('ew_section_conditions_text2_premium');?></p>
        <p><?=lang('ew_section_conditions_text3_premium');?></p>
        <p><?=lang('ew_section_conditions_text4_premium');?></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><?=lang('ew_section_conditions_close');?></button>
      </div>
    </div>
  </div>
</div>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="<?=base_url();?>js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?=base_url();?>js/moment.min.js"></script>
<script type="text/javascript" src="<?=base_url();?>js/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript" src="<?=base_url();?>js/bootstrap-datetimepicker.es.js"></script>
<script src="http://w3resource.com/twitter-bootstrap/twitter-bootstrap-v2/js/bootstrap-tooltip.js"></script>
<script src="http://w3resource.com/twitter-bootstrap/twitter-bootstrap-v2/js/bootstrap-popover.js"></script>
<script type="text/javascript" src="<?=base_url();?>js/script_tracking.js"></script>
</body>
</html>