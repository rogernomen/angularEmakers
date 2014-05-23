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
	              <li><a href="#emakers"><?=lang('ew_navbar_item1');?></a></li>
	              <li><a href="#servicios"><?=lang('ew_navbar_item2');?></a></li>
	              <li><a href="#interaccion"><?=lang('ew_navbar_item3');?></a></li>
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
    		<h1>Sistema de seguimiento de envíos</h1>
    		<h3>Quiero conocer el estado actual de mi pedido</h3>
    		<p>A continuación puede comprobar el estado actual de su pedido.</p>
    	</div>
    </div>
    <div class="row" id="generalShapeContent">
    	<div class="col-sm-6">
    		<?php if(isset($status) && $status == 'OK'){ ?>
	    	<div class="alert alert-success">
	    		<h2><?=$info['data']['num_pedido']?></h2>
	    		<h3>Datos del pedido</h3>
	    		<p>Datos en sistema desde: <?=$info['data']['fecha_alta']?></p>
	    		<?php 
	    			//Mostramos estado y fecha segun la tabla de origen, el estado y de si es TIPSA o no
	    			if($info['data']['otros_operadores'] == 1){
		    			echo '<p>Estado del pedido: '.$info['data']['estado_entrega'].'</p>';
				    	echo '<p id="cont_fecha">Fecha de entrega: '.$info['data']['fecha_entrega_cliente'].'</p>';
	    			}else{
		    			if($info['data']['tabla'] == 'argos_entregas'){
			    			switch($info['data']['cf_estado']){
				    			case ESTADO_ENTREGA_POR_RECOGER:
				    				echo '<p>Estado del pedido: '.$info['data']['estado_entrega'].'</p>';
				    				echo '<p id="cont_fecha">Fecha de entrega: '.$info['data']['fecha_entrega_cliente'].'</p>';
				    				echo '<p id="cont_franja">Franja de entrega: '.$info['data']['franja_entregaDesc'].'</p>';
				    			break;
				    			case ESTADO_ENTREGA_RECOGIDO:
				    				echo '<p>Estado del pedido: '.$info['data']['estado_entrega'].'</p>';
				    				echo '<p id="cont_fecha">Fecha de entrega: '.$info['data']['fecha_entrega_cliente'].'</p>';
				    				echo '<p id="cont_franja">Franja de entrega: '.$info['data']['franja_entregaDesc'].'</p>';
				    			break;
				    			case ESTADO_ENTREGA_EN_ALMACEN_ORIGEN:
				    				echo '<p>Estado del pedido: '.$info['data']['estado_entrega'].'</p>';
				    				echo '<p id="cont_fecha">Fecha de entrega: '.$info['data']['fecha_entrega_cliente'].'</p>';
				    				echo '<p id="cont_franja">Franja de entrega: '.$info['data']['franja_entregaDesc'].'</p>';
				    			break;
				    			case ESTADO_ENTREGA_EN_ALMACEN:
				    				echo '<p>Estado del pedido: '.$info['data']['estado_entrega'].'</p>';
				    				echo '<p id="cont_fecha">Fecha de entrega: '.$info['data']['fecha_entrega_cliente'].'</p>';
				    				echo '<p id="cont_franja">Franja de entrega: '.$info['data']['franja_entregaDesc'].'</p>';
				    			break;
				    			case ESTADO_ENTREGA_EN_RUTA:
				    				echo '<p>Estado del pedido: '.$info['data']['estado_entrega'].'</p>';
				    				echo '<p id="cont_fecha">Fecha de entrega: '.$info['data']['fecha_entrega_cliente'].' '.$info['data']['ventanaEntrega'].'</p>';
				    			break;
				    			case ESTADO_ENTREGA_ENTREGADA:
				    				echo '<p>Estado del pedido: '.$info['data']['estado_entrega'].' en fecha '.$info['data']['fecha_entrega_final'].'</p>';
				    			break;
				    			case ESTADO_ENTREGA_AUSENTE_O_CERRADO:
				    				echo '<p>Estado del pedido: '.$info['data']['estado_entrega'].' en fecha '.$info['data']['fecha_intento'].'</p>';
				    			break;
				    			case ESTADO_ENTREGA_DESTINATARIO_APLAZA_ENTREGA:
				    				echo '<p>Estado del pedido: '.$info['data']['estado_entrega'].'</p>';
				    				echo '<p id="cont_fecha">Fecha de entrega: '.$info['data']['fecha_entrega_cliente'].'</p>';
				    				echo '<p id="cont_franja">Franja de entrega: '.$info['data']['franja_entregaDesc'].'</p>';
				    			break;
				    			case ESTADO_ENTREGA_DIRECCION_INCORRECTA_POR_REPARTIDOR:
				    				echo '<p>Estado del pedido: '.$info['data']['estado_entrega'].' en fecha '.$info['data']['fecha_intento'].'</p>';
				    			break;
				    			case ESTADO_ENTREGA_DIRECCION_INCOMPLETA_POR_REPARTIDOR:
				    				echo '<p>Estado del pedido: '.$info['data']['estado_entrega'].' en fecha '.$info['data']['fecha_intento'].'</p>';
				    			break;
				    			case ESTADO_ENTREGA_NO_ACEPTA_REEMBOLSO:
				    				echo '<p>Estado del pedido: '.$info['data']['estado_entrega'].' en fecha '.$info['data']['fecha_intento'].'</p>';
				    			break;
				    			case ESTADO_ENTREGA_DEVOLVER_A_REMITENTE:
				    				echo '<p>Estado del pedido: '.$info['data']['estado_entrega'].'</p>';
				    			break;
				    			case ESTADO_ENTREGA_DEVUELTO_A_REMITENTE:
				    				echo '<p>Estado del pedido: '.$info['data']['estado_entrega'].'</p>';
				    			break;
				    			case ESTADO_ENTREGA_RECOGER_EN_AGENCIA:
				    				echo '<p>Estado del pedido: '.$info['data']['estado_entrega'].'</p>';
				    			break;
				    			case ESTADO_ENTREGA_ORIGEN_NO_PREPARADO:
				    				echo '<p>Estado del pedido: '.$info['data']['estado_entrega'].' en fecha '.$info['data']['fecha_intento'].'</p>';
				    			break;
				    			case ESTADO_ENTREGA_CON_INCIDENCIAS:
				    				echo '<p>Estado del pedido: '.$info['data']['estado_entrega'].'</p>';
				    			break;
			    			}
		    			}else{
		    				echo '<p>Estado del pedido: '.$info['data']['estado_entrega'].'</p>';
			    			echo '<p id="cont_fecha">Fecha de entrega: '.$info['data']['estado_entrega'].'</p>';
				    		echo '<p id="cont_franja">Franja de entrega: '.$info['data']['franja_entregaDesc'].'</p>';
		    			}
		    		}
	    		?>
	    	</div>
	    	<?php 
		    	// Si es un pedido que se pueden solicitar cambios, mostramos los controles
    			if($info['data']['show_opciones'] == 1){ 
	    			echo '<div class="btn-group btn-group-justified"><div class="btn-group"><button type="button" class="btn btn-default btn-warning" onclick="javascript:goToTracking(\''.$info['data']['num_pedido'].'\');">Quiero realizar cambios en la previsión de entrega</button></div></div>';
    			}
    			
    			// Finalmente, si es un pedido TIPSA, mostramos la alerta
    			if($info['data']['otros_operadores'] == 1){
	    			echo '<div class="alert alert-warning"><h3>Notas importantes</h3><p>Dada la localización de entrega de su pedido, el servicio de entrega lo realizará la agencia de Tipsa más cercana a su domicilio.<br/><br/>Si usted tiene cualquier duda o necesita realizar cualquier gestión sobre su pedido, póngase en contacto con nuestro servicio de atención al cliente:<br/><br/>(+34) 93 624 24 26 - Emakers Barcelona<br/>(+34) 93 419 92 09 - Emakers Madrid<br/><a href="mailto:infoenvios@emakers.es">infoenvios@emakers.es</a></p></div>';
	    		}
	    	?>
	    	<?php }else{ ?>
	    	<div class="alert alert-warning">
		    	<h3>Error en la búsqueda de datos</h3>
	    		<p>No localizamos ningún pedido con los datos introducidos.<br/><br/>Si el problema persiste, póngase en contacto con Emakers:<br/><br/>(+34) 93 624 24 26 - Emakers Barcelona<br/>(+34) 93 419 92 09 - Emakers Madrid<br/><a href="mailto:infoenvios@emakers.es">infoenvios@emakers.es</a></p>
	    	</div>
	    	<?php } ?>
    	</div>
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
<script type="text/javascript">
	function goToTracking(num_pedido){
		window.location.href = base_url+lang_site+'/tracking/index/'+num_pedido;
	}
</script>
</body>
</html>