<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
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
	
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body>

<!-- Modal Error -->
<div class="modal fade" id="Error" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Hemos encontrado algún error</h4>
      </div>
      <div class="modal-body">
      	<div class="alert alert-danger">
      		<h3>Datos erróneos</h3>
      	</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
<!--        <button type="button" class="btn btn-primary">Save changes</button>-->
      </div>
    </div>
  </div>
</div>

<!-- Modal Confirmación de cambios a realizar -->
<div class="modal fade" id="confirmacion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Ya ha realizado los cambios en su pedido</h4>
      </div>
      <div class="modal-body">
      	<h1>Número de pedido</h1>
      	<h3>Datos del pedido</h3>
      	<p>Abonado: EMAKERS</p>
      	<p>Datos en sistema desde: 29/01/2014</p>
      	<p>Estado del pedido: EN ALMACÉN DESTINO</p>
      	<p>Entrega prevista: 02/02/2014</p>
      	<p>Franja prevista: MAÑANA (9:00 - 14:00)</p>
      	<h3>Datos del destinatario</h3>
      	<p>David Ninyoles Asin</p>
      	<address>Vilamur 15-19, 08014 Barcelona</address>
      </div>
      <div class="modal-footer">
        <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
        <button type="button" class="btn btn-warning">Solicitar nuevos cambios</button>
        <button type="button" class="btn btn-success">Los cambios són correctos</button>
      </div>
    </div>
  </div>
</div>

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
<!--  		              <li><a href="<?=base_url().$this->lang->lang();?>/#emakers"><?=lang('ew_navbar_item1');?></a></li>
	              <li><a href="<?=base_url().$this->lang->lang();?>/#servicios"><?=lang('ew_navbar_item2');?></a></li>
	              <li><a href="<?=base_url().$this->lang->lang();?>/#interaccion"><?=lang('ew_navbar_item3');?></a></li>-->
	              <li><a href="/#emakers">Emakers</a></li>
	              <li><a href="/#servicios">Servicios</a></li>
	              <li><a href="/#interaccion">Interración</a></li>
	            </ul>
            </div>

			<ul class="nav navbar-nav navbar-right">
<!--  		      		<a href="<?=base_url().$this->lang->lang();?>/tracking" target="_blank"><button type="button" class="btn btn-default btn-sm navbar-btn"><?=lang('ew_navbar_item4');?> <i class="icon-squares"></i></button></a>
	      		<a href="#" target="_blank"><button type="button" class="btn btn-default btn-sm navbar-btn btn-active"><?=lang('ew_navbar_item5');?> <i class="icon-squares"></i></button></a>
	      		<a href="http://www.linkedin.com/company/emakers" target="_blank"><button type="button" class="btn btn-default btn-sm navbar-btn btn-linkedin"><i class="icon-linkedin-1"></i></button></a>
	      		<a href="https://twitter.com/emakers_es" target="_blank"><button type="button" class="btn btn-default btn-sm navbar-btn btn-twitter"><i class="icon-twitter-2"></i></button></a>
	      		<a href="https://www.facebook.com/Emakers" target="_blank"><button type="button" class="btn btn-default btn-sm navbar-btn btn-facebook"><i class="icon-facebook"></i></button></a>-->
	      		<!--  -->
	      		<a href="<?=base_url().$this->lang->lang();?>/tracking" target="_blank"><button type="button" class="btn btn-default btn-sm navbar-btn btn-active">Tracking <i class="icon-squares"></i></button></a>
	      		<a href="#" target="_blank"><button type="button" class="btn btn-default btn-sm navbar-btn">Contacta <i class="icon-squares"></i></button></a>
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
    		<h1>Sistema de seguimientos de envíos</h1>
    		<h3>Quiero conocer el estado actual de mi pedido</h3>
    		<p>Inserte el estado de su pedido para conocer el estado actual de su pedido...</p>
    	</div>
    	<div class="col-sm-6">
        	<form role="form">
        	  <div class="form-group">
        	    <label for="exampleInputEmail1">Número de pedido</label>
        	    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Número de pedido (Campo obligatorio)">
        	  </div>
        	  <div class="form-group">
        	    <label for="exampleInputPassword1">Email o número de teléfono</label>
        	    <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Email o número de teléfono (Campo obligatorio)">
        	  </div>
        	  <div class="checkbox">
        	      <label>
        	        <input type="checkbox"> Acepto las <a href="#" data-toggle="modal" data-target="#condiciones">condiciones de uso</a>
        	      </label>
        	  </div>
        	</form>
        	<div class="pull-right"><button data-toggle="modal" data-target="#Error" class="btn btn-success">Consultar</button></div>
        </div>
        <div class="col-sm-6">
        	<div class="form-group has-success">
        	  <label class="control-label" for="inputSuccess1">Input with success</label>
        	  <input type="text" class="form-control" id="inputSuccess1">
        	</div>
        	<div class="form-group has-warning">
        	  <label class="control-label" for="inputWarning1">Input with warning</label>
        	  <input type="text" class="form-control" id="inputWarning1">
        	</div>
        	<div class="form-group has-error">
        	  <label class="control-label" for="inputError1">Input with error</label>
        	  <input type="text" class="form-control" id="inputError1">
        	</div>
        </div>
    </div>
    <div class="row">
    	<div class="col-sm-6">
    		
<!--    		<div class="alert alert-danger">
    			<h3>Datos erróneos</h3>
    		</div>-->
	    	<div class="alert alert-success">
	    	  <!--<a href="#" class="alert-link">...</a>-->
	    	
	    		<h1>Número de pedido</h1>
	    		<h3>Datos del pedido</h3>
	    		<p>Abonado: EMAKERS</p>
	    		<p>Datos en sistema desde: 29/01/2014</p>
	    		<p>Estado del pedido: EN ALMACÉN DESTINO</p>
	    		<p>Entrega prevista: 02/02/2014</p>
	    		<p>Franja prevista: MAÑANA (9:00 - 14:00)</p>
	    		<!--<button type="button" class="btn btn-primary">Cambiar día / Franja de entrega</button>-->
	    		<h3>Datos del destinatario</h3>
	    		<p>David Ninyoles Asin</p>
	    		<address>Vilamur 15-19, 08014 Barcelona</address>
	    	</div>
    	</div>
    	<div class="col-sm-6">
    		<form role="form">
    			<h3>Día de entrega:</h3>
    			<div class="form-group">
    				<div class='input-group date' id='diadeentrega'>
    					<input type='text' class="form-control" />
    					<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
    				</div>
    				<h3>Franja deseada:</h3>
    				<select class="form-control">
    				  <option>Mañana</option>
    				  <option>Tarde</option>
    				  <option>Noche</option>
    				</select>
    				<h3>Otros Datos:</h3>
    			</div>
    			<div class="form-group">
    			  <label for="exampleInputEmail1">Teléfono:</label>
    			  <input type="tel" class="form-control" id="exampleInputEmail1" placeholder="Número de teléfono">
    			</div>
    			<div class="form-group">
    			  <label for="exampleInputEmail1">Teléfono alternativo:</label>
    			  <input type="tel" class="form-control" id="exampleInputEmail1" placeholder="Número de teléfono alternativo">
    			</div>
    			<div class="form-group">
    			  <label for="exampleInputPassword1">Email:</label>
    			  <input type="email" class="form-control" id="exampleInputPassword1" placeholder="Dirección de correo">
    			</div>
    			<div class="form-group">
    				<label for="exampleInputPassword1">Comentarios:</label>	
    	    		<textarea class="form-control" rows="3" placeholder="Añade tu comentario aquí"></textarea>
    			</div>
    		</form>
    		<button class="btn btn-success" data-toggle="modal" data-target="#confirmacion">Solicitar cambio</button>
    	</div>
    </div>
<!--    <div class="row">
    	
    </div>-->
</div>


<!-- FOOTER -->
<footer>
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-md-12">
				<div class="logo-footer">
					<!--<img src="<?=base_url();?>img/emakers_logo.png" width="193" alt="Logo Emakers"/>-->
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
			<!--<div class="clearfix visible-xs"></div>-->
			<div class="col-md-5 col-sm-5 col-xs-12">
				<address>
<!--					<strong><?=lang('ew_footer_resumen_title');?></strong><br />
					<a href="<?=base_url().$this->lang->lang()?>/#emakers"><?=lang('ew_footer_resumen_emakers');?></a><br />
					<a href="<?=base_url().$this->lang->lang()?>/#servicios"><?=lang('ew_footer_resumen_servicios');?></a><br />
					<a href="<?=base_url().$this->lang->lang()?>/#interaccion"><?=lang('ew_footer_resumen_interaccion');?></a><br />
					<a href="<?=base_url().$this->lang->lang()?>/#entregas"><?=lang('ew_footer_resumen_entregas');?></a><br />
					<a href="<?=base_url().$this->lang->lang()?>/#ademas"><?=lang('ew_footer_resumen_ademas');?></a><br />-->
					<strong>Resumen</strong><br />
					<a href="<?=base_url().$this->lang->lang()?>/#emakers">- Sus clientes son nuestros clientes.</a><br />
					<a href="<?=base_url().$this->lang->lang()?>/#servicios">- Entregamos hasta las diez de la noche.</a><br />
					<a href="<?=base_url().$this->lang->lang()?>/#interaccion">- Interactuamos con su cliente ¡DE VERDAD!</a><br />
					<a href="<?=base_url().$this->lang->lang()?>/#entregas">- Informamos de la hora de entrega, en un margen de &plusmn;30 minutos</a><br />
					<a href="<?=base_url().$this->lang->lang()?>/#ademas">- Y además, ¡somos sostenibles!</a><br />
				</address>
			</div>
			<div class="col-md-3 col-sm-3 col-xs-12 col-sm-offset-1 col-md-offset-1">
				<address>
<!--					<strong><?=lang('ew_footer_siguenos');?></strong><br />
					<a href="http://www.linkedin.com/company/emakers" target="_blank"><i class="icon-linkedin-1"></i></a>
					<a href="https://twitter.com/emakers_es" target="_blank"><i class="icon-twitter-2"></i></a>
					<a href="https://www.facebook.com/Emakers" target="_blank"><i class="icon-facebook"></i></a>-->
					<strong>Síguenos en</strong><br />
					<a href="http://www.linkedin.com/company/emakers" target="_blank"><i class="icon-linkedin-1"></i></a>
					<a href="https://twitter.com/emakers_es" target="_blank"><i class="icon-twitter-2"></i></a>
					<a href="https://www.facebook.com/Emakers" target="_blank"><i class="icon-facebook"></i></a>
				</address>
			</div>
		</div>
		<div class="row">
   			<div class="col-md-12 col-sm-12 col-xs-12">
   				<div class="rights-footer">
<!--	   				<p class="pull-right"><?=anchor($this->lang->switch_uri(($this->lang->lang() == 'es') ? 'en' : 'es'),lang('ew_footer_lenguage'));?></p>
		        	<p><?=lang('ew_footer_copy');?> <a href="#" data-toggle="modal" data-target="#politica"><?=lang('ew_footer_politica');?></a> y <a href="#" data-toggle="modal" data-target="#condiciones"><?=lang('ew_footer_condiciones');?></a></p>-->
		        	<p>&copy; 2014 EMAKERS. Todos los derechos reservados. <!--<a href="#" data-toggle="modal" data-target="#politica">Politica de privacidad</a> y--> <a href="#" data-toggle="modal" data-target="#condiciones">Condiciones de uso</a></p>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="<?=base_url();?>js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?=base_url();?>js/moment.min.js"></script>
<script type="text/javascript" src="<?=base_url();?>js/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript" src="<?=base_url();?>js/bootstrap-datetimepicker.es.js"></script>
<script type="text/javascript" src="<?=base_url();?>js/script_tracking.js"></script>
</body>
</html>