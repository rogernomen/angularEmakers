<!DOCTYPE html>
<html lang="<?=$this->lang->lang();?>">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="author" content="tooManyMelons & Emakers">
	
	<link rel="icon" href="<?=base_url();?>img/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="<?=base_url();?>img/favicon.ico" type="image/x-icon" />
	
	<meta name="description" content="<?=lang('ew_description');?>">
    <meta name="keywords" content="<?=lang('ew_keywords');?>">
	
	<meta property="og:image" content="<?=base_url();?>img/logo_200.png"/>

    <meta property="og:title" content="Emakers"/>
    <meta property="og:description" content="<?=lang('ew_description');?>"/>
	
	<title><?=lang('ew_title_page');?></title>
	
	<!-- Bootstrap core CSS -->
	<link href="<?=base_url();?>css/bootstrap.min.css" rel="stylesheet">
	
	<!-- Custom CSS -->
	<link rel="stylesheet" href="<?=base_url();?>css/font.min.css" type="text/css" charset="utf-8" />
	<link href="<?=base_url();?>css/fontello.min.css" rel="stylesheet">
	<link href='http://fonts.googleapis.com/css?family=Lato:100,300,400,700,900,100italic,300italic,400italic,700italic,900italic' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="<?=base_url();?>css/ui.totop.min.css">
	<link href="<?=base_url();?>css/main.css" rel="stylesheet">
	
	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	  <script src="https://oss.maxcdn.com/libs/respond.<?=base_url();?>js/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>

<body data-spy="scroll" data-target=".navbar-scrollspy">

<!-- Preloader -->
<div id="loader">
	<div id="loaderInner"></div>
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
	              <li class="active"><a href="#emakers"><?=lang('ew_navbar_item1');?></a></li>
	              <li><a href="#servicios"><?=lang('ew_navbar_item2');?></a></li>
	              <li><a href="#interaccion"><?=lang('ew_navbar_item3');?></a></li>
	            </ul>
            </div>
    		<ul class="nav navbar-nav navbar-right">
	      		<a href="<?=base_url().$this->lang->lang();?>/tracking" target="_blank"><button type="button" class="btn btn-default btn-sm navbar-btn"><?=lang('ew_navbar_item4');?> <i class="icon-squares"></i></button></a>
	      		<a href="<?=base_url().$this->lang->lang();?>/contacta" target="_blank"><button type="button" class="btn btn-default btn-sm navbar-btn"><?=lang('ew_navbar_item5');?> <i class="icon-squares"></i></button></a>
	      		<a href="http://www.linkedin.com/company/emakers" target="_blank"><button type="button" class="btn btn-default btn-sm navbar-btn btn-linkedin"><i class="icon-linkedin-1"></i></button></a>
	      		<a href="https://twitter.com/emakers_es" target="_blank"><button type="button" class="btn btn-default btn-sm navbar-btn btn-twitter"><i class="icon-twitter-2"></i></button></a>
	      		<a href="https://www.facebook.com/Emakers" target="_blank"><button type="button" class="btn btn-default btn-sm navbar-btn btn-facebook"><i class="icon-facebook"></i></button></a>
	      	</ul>
    	</div>
	</div>
</nav>

<!-- COVER -->
<div class="cover-wrapper">
  	<div class="cover-wrapper-inner">
    	<div class="cover-container">
    		<img src="<?=base_url();?>img/emakers_logo.png" alt="logo emakers" />
    	</div>
        <div class="elevator-speech">
        	<p class="cover-subtitle"><b><?=lang('ew_cover_subtitle');?></b><br /> <?=lang('ew_cover_subtitle_2');?></p>
        </div>
        <div class="down">
        	<div class="down-center">
        		<a href="#emakers"><i class="icon-angle-down"></i></a>
        	</div>
        </div>
  	</div>
</div>
    
<!-- SECTIONS
================================================== -->
<!-- ¿QUE ES EMAKERS? -->
<section id="emakers">
	<div class="container2">
		<div class="row">
			<div class="section-title">
				<div class="col-md-12">
    				<h1><?=lang('ew_section_emakers_title');?></h1>
					<p><?=lang('ew_section_emakers_title_text');?><br /><?=lang('ew_section_emakers_title_text_2');?>
					</p>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="centered">
				<div class="col-md-4 col-xs-12">
					<div class="cobertura-inner">
						<p class="cobertura"><?=lang('ew_section_emakers_cobertura');?><br /></p><p class="internacional"><?=lang('ew_section_emakers_internacional');?></p>
					</div>
				</div>
				<div class="col-md-6 col-md-offset-2 col-xs-12">
	    			<h3><?=lang('ew_section_emakers_ciudades_emakers');?></h3>
	    			<div class="element separator2">
	    			</div>
	    			<p><?=lang('ew_section_emakers_ciudades_text');?></p>
				</div>
			</div>
		</div>
	</div>
	<div id="carousel-emakers" class="carousel slide" data-ride="carousel">
	  <!-- Indicators -->
	  <!--<ol class="carousel-indicators">
	    <li data-target="#carousel-emakers" data-slide-to="0" class="active"></li>
	    <li data-target="#carousel-emakers" data-slide-to="1"></li>
	    <li data-target="#carousel-emakers" data-slide-to="2"></li>
	  </ol>-->
	
	  <!-- Wrapper for slides -->
	  <div class="carousel-inner">
	    <div class="item active">
	      <!--<img src="<?=base_url();?>img/cover/foto2.jpg" alt="">-->
	      <div class="barcelona"></div>
	      <div class="carousel-caption">
	      	<h4>Emakers Barcelona</h4>
	      	<address>Calle Comte Urgell, 51 bis 08011 Barcelona</address>
	      </div>
	    </div>
	    <div class="item">
	      <div class="madrid"></div>
	      <div class="carousel-caption">
	      	<h4>Emakers Madrid</h4>
	      	<address>Calle Marqués de Monteagudo, 22 Bajos 28028 Madrid</address>
	      </div>
	    </div>
	    <div class="item">
	      <div class="san-sebastian"></div>
	      <div class="carousel-caption">
	      	<h4>Emakers San Sebastián</h4>
	      	<address>Calle Duque de Mandas, 28 Bajos 20009 San Sebastian</address>
	      </div>
	    </div>
	    <div class="item">
	      <div class="sevilla"></div>
	      <div class="carousel-caption">
	      	<h4>Emakers Sevilla</h4>
	      	<address>Calle Muro de los Navarros, 25 Bajos 41003 Sevilla</address>
	      </div>
	    </div>
	    <div class="item">
	      <div class="malaga"></div>
	      <div class="carousel-caption">
	      	<h4>Emakers Málaga</h4>
	      	<address>Calle Francisco de Cossio, 20 Local 1 29004 Malaga</address>
	      </div>
	    </div>
	    <div class="item">
	      <div class="murcia"></div>
	      <div class="carousel-caption">
	      	<h4>Emakers Murcia</h4>
	      	<address>Calle Maria Matas 2, Beniajan 30570</address>
	      </div>
	    </div>
	    <div class="item">
	      <div class="bilbao"></div>
	      <div class="carousel-caption">
	      	<h4>Emakers Bilbao</h4>
	      	<address>Calle Ribera, 16 48005 Bilbao</address>
	      </div>
	    </div>
	    <div class="item">
	      <div class="zaragoza"></div>
	      <div class="carousel-caption">
	      	<h4>Emakers Zaragoza</h4>
	      	<address>Calle Conde de sobradiel, 6 50011 Zaragoza</address>
	      </div>
	    </div>
	    <!-- 
	    <div class="item">
	      <div class="valencia"></div>
	      <div class="carousel-caption">
	      	<h4>Emakers Valencia</h4>
	      	<address>Calle del mar, 37 46003 Valencia</address>
	      </div>
	    </div> -->
	    <div class="item">
	      <div class="valladolid"></div>
	      <div class="carousel-caption">
	      	<h4>Emakers Valladolid</h4>
	      	<address>Calle Embajadores, 1 47013 Valladolid</address>
	      </div>
	    </div>
	    <div class="item">
	      <div class="cordoba"></div>
	      <div class="carousel-caption">
	      	<h4>Emakers Córdoba</h4>
	      	<address>Plaza de Almagra, 7 14002 Cordoba</address>
	      </div>
	    </div>
	    <div class="item">
	      <div class="coruna"></div>
	      <div class="carousel-caption">
	      	<h4>Emakers La Coruña</h4>
	      	<address>Calle Fernando Macias, 26 15004 La Coruña</address>
	      </div>
	    </div>
	    <div class="item">
	      <div class="london"></div>
	      <div class="carousel-caption">
	      	<h4>Emakers London</h4>
	      	<address>West Central Street, 13 WC1A1AB London</address>
	      </div>
	    </div>
	  </div>
	
	  <!-- Controls -->
	  <!--<div class="test"></div>-->
	  <a class="left carousel-control" href="#carousel-emakers" data-slide="prev">
	    <span class="glyphicon glyphicon-chevron-left"></span>
	  </a>
	  <a class="right carousel-control" href="#carousel-emakers" data-slide="next">
	    <span class="glyphicon glyphicon-chevron-right"></span>
	  </a>
	  <!--</div>-->
	</div>
</section>
    
<!-- SERVICIOS EMAKERS -->
<section id="servicios">
	<div class="container2">
		<div class="row">
			<div class="section-title">
				<div class="col-md-12">
					<h1><?=lang('ew_section_servicios_title');?></h1>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-3 col-sm-3 col-xs-12">
				<div class="column-detail">
					<div class="icon">
						<img src="<?=base_url();?>img/servicios_emakers/24H.png" alt="" />
					</div>
					<div class="title">
						<h4><?=lang('ew_section_servicios_column1_title');?></h4>
					</div>
					<div class="element separator3">
					</div>
					<div class="description">
						<p><?=lang('ew_section_servicios_column1_description');?></p>
					</div>
				</div>
			</div>
			<div class="col-md-3 col-sm-3 col-xs-12">
				<div class="column-detail">
					<div class="icon">
						<img src="<?=base_url();?>img/servicios_emakers/sameday.png" alt="" />
					</div>
					<div class="title">
						<h4><?=lang('ew_section_servicios_column2_title');?></h4>
					</div>
					<div class="element separator3">
					</div>
					<div class="description">
						<p><?=lang('ew_section_servicios_column2_description');?></p>
					</div>
				</div>
			</div>
			<div class="col-md-3 col-sm-3 col-xs-12">
				<div class="column-detail">
					<div class="icon">
						<img src="<?=base_url();?>img/servicios_emakers/logisticainversa.png" alt="" />
					</div>
					<div class="title">
						<h4><?=lang('ew_section_servicios_column3_title');?></h4>
					</div>
					<div class="element separator3">
					</div>
					<div class="description">
						<p><?=lang('ew_section_servicios_column3_description');?></p>
					</div>
				</div>
			</div>
			<div class="col-md-3 col-sm-3 col-xs-12">
				<div class="column-detail">
					<div class="icon">
						<img src="<?=base_url();?>img/servicios_emakers/almacenaje.png" alt="" />
					</div>
					<div class="title">
						<h4><?=lang('ew_section_servicios_column4_title');?></h4>
					</div>
					<div class="element separator3">
					</div>
					<div class="description">
						<p><?=lang('ew_section_servicios_column4_description');?></p>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- END SERVICIOS EMAKERS -->
    
<!-- SISTEMAS DE INTERACCIÓN -->
<section id="interaccion">
	<div class="background">
		<div class="container2">
			<div class="row">
				<div class="section-title">
					<div class="col-md-12">
						<h1><?=lang('ew_section_interaccion_title');?></h1>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-3 col-sm-3 col-xs-12">
					<div class="column-detail">
						<div class="icon">
							<img src="<?=base_url();?>img/interaccion/mail.png" alt="" />
						</div>
						<div class="title">
							<h4><?=lang('ew_section_interaccion_column1_title');?></h4>
						</div>
						<div class="element separator3">
						</div>
						<div class="description">
							<p><?=lang('ew_section_interaccion_column1_description');?></p>
						</div>
					</div>
				</div>
				<div class="col-md-3 col-sm-3 col-xs-12">
					<div class="column-detail">
						<div class="icon">
							<img src="<?=base_url();?>img/interaccion/sms.png" alt="" />
						</div>
						<div class="title">
							<h4><?=lang('ew_section_interaccion_column2_title');?></h4>
						</div>
						<div class="element separator3">
						</div>
						<div class="description">
							<p><?=lang('ew_section_interaccion_column2_description');?></p>
						</div>
					</div>
				</div>
				<div class="clearfix visible-xs"></div>
				<div class="col-md-3 col-sm-3 col-xs-12">
					<div class="column-detail">
						<div class="icon">
							<img src="<?=base_url();?>img/interaccion/like.png" alt="" />
						</div>
						<div class="title">
							<h4><?=lang('ew_section_interaccion_column3_title');?></h4>
						</div>
						<div class="element separator3">
						</div>
						<div class="description">
							<p><?=lang('ew_section_interaccion_column3_description');?></p>
						</div>
					</div>
				</div>
				<div class="col-md-3 col-sm-3 col-xs-12">
					<div class="column-detail">
						<div class="icon">
							<img src="<?=base_url();?>img/interaccion/entregado.png" alt="" />
						</div>
						<div class="title">
							<h4><?=lang('ew_section_interaccion_column4_title');?></h4>
						</div>
						<div class="element separator3">
						</div>
						<div class="description">
							<p><?=lang('ew_section_interaccion_column4_description');?></p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- END SISTEMAS DE INTERACCION -->
    
<!-- SISTEMAS DE ENTREGAS -->
<section id="entregas">
	<div class="container2">
		<div class="row">
			<div class="section-title">
				<div class="col-md-12">
					<h1><?=lang('ew_section_entregas_title');?></h1>
					<p class="without_border"><?=lang('ew_section_entregas_title_text');?></p>
				</div>
			</div>
			<div class="col-md-6 col-sm-6 col-xs-12">
				<p class="number3">3</p>
				<p class="franjas"><?=lang('ew_section_entregas_franjas_horarias');?></p>
				<p class="text"><?=lang('ew_section_entregas_franjas_text');?></p>
			</div>
			<div class="col-md-6 col-sm-6 col-xs-12">
				<div class="inner">
					<div class="text1">
						<p class="nomargin"><?=lang('ew_section_entregas_text1');?></p>
						<p><?=lang('ew_section_entregas_text2');?></p>
						<p><?=lang('ew_section_entregas_text3');?></p>
					</div>
				</div>
			</div>
		</div>
		<!--<div class="row">
			<div class="col-md-12">
				<p class="base">Gracias a la buena experiencia en la entrega contribuimos a que todos sus clientes queden satisfechos de su compra online.</p>
			</div>
		</div>-->
		<div class="row">
			<div class="wrapper">
				<div class="col-md-6 col-sm-6 col-xs-12">
					<p class="_95">95%</p>
					<p class="efectividad"><?=lang('ew_section_entregas_efectividad');?></p>
					<p class="text4"><?=lang('ew_section_entregas_text4');?></p>
				</div>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<p class="_60"><span>&plusmn;</span>30</p>
					<p class="minutos"><?=lang('ew_section_entregas_minutos');?></p>
					<p class="text4"><?=lang('ew_section_entregas_text5');?></p>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- END SISTEMAS DE ENTREGAS -->

<!-- SOMOS SOSTENIBLES -->
<section id="ademas">
	<div class="container2">
		<div class="row">
			<div class="col-md-12">
				<h1><?=lang('ew_section_ademas_title');?></h1>
				<p><a style="text-decoration: underline;" href="mailto:contacta@emakers.es"><?=lang('ew_section_ademas_footer');?></a></p>
			</div>
		</div>
	</div>
</section>
<!-- END SOMOS SOSTENIBLES -->

<!-- WORDS FROM CLIENTS -->
<section id="words">
	<div class="container2">
		<div class="row">
			<div class="section-title2">
				<div class="col-md-12">
					<h1><?=lang('ew_section_words_title');?></h1>
					<div class="element separator3">
					</div>
    					<div id="testimonials" class="carousel slide" data-ride="carousel">
    					  <!-- Wrapper for slides -->
    					  <div class="carousel-inner">
    					    <div class="item active">
    					      <div class="testi">
    					      <p class="cita">"<?=lang('ew_section_words_cita1');?>"</p>
    					      <p class="author"><?=lang('ew_section_words_autor1');?></p>
    					      </div>
    					    </div>
    					    <div class="item">
    					      <div class="testi">
    					      <p class="cita">"<?=lang('ew_section_words_cita2');?>"</p>
    					      <p class="author"><?=lang('ew_section_words_autor2');?></p>
    					      </div>
    					    </div>
    					    <div class="item">
    					      <div class="testi">
    					      <p class="cita">"<?=lang('ew_section_words_cita3');?>"</p>
    					      <p class="author"><?=lang('ew_section_words_autor3');?></p>
    					      </div>
    					    </div>
    					    <div class="item">
    					      <div class="testi">
    					      <p class="cita">"<?=lang('ew_section_words_cita4');?>"</p>
    					      <p class="author"><?=lang('ew_section_words_autor4');?></p>
    					      </div>
    					    </div>
    					    <div class="item">
    					      <div class="testi">
    					      <p class="cita">"<?=lang('ew_section_words_cita5');?>"</p>
    					      <p class="author"><?=lang('ew_section_words_autor5');?></p>
    					      </div>
    					    </div>
    					    <div class="item">
    					      <div class="testi">
    					      <p class="cita">"<?=lang('ew_section_words_cita6');?>"</p>
    					      <p class="author"><?=lang('ew_section_words_autor6');?></p>
    					      </div>
    					    </div>
    					  </div>
    					</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- END WORDS FROM CLIENTS -->

<!-- CLIENTS -->
<section id="clientes">
	<div class="container">
		<div class="row">
			<div class="section-title2">
				<div class="col-md-12">
					<h1><?=lang('ew_section_clients_title');?></h1>
					<div class="element separator3">
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="wrapper">
					<a href="http://www.fnac.es/" target="_blank"><div class="fnac"></div></a>
					<a href="http://www.nespresso.com/" target="_blank"><div class="nespresso"></div></a>
					<a href="http://www.stradivarius.com/" target="_blank"><div class="stradivarius"></div></a>
					<a href="http://www.pullandbear.com/" target="_blank"><div class="pullandbear"></div></a>
					<a href="http://www.sibarit.us/" target="_blank"><div class="sibaritus"></div></a>
					<a href="https://www.quedeflores.com/" target="_blank"><div class="quedeflores"></div></a>
					<a href="http://www.verticoutdoor.com/" target="_blank"><div class="vertic"></div></a>
					<a href="http://www.limobebe.com/xcart/home.php" target="_blank"><div class="limobebe"></div></a>
					<a href="http://www.browniespain.com" target="_blank"><div class="brownie"></div></a>
					<!-- <a href="http://www.zubidesign.com" target="_blank"><div class="zubi"></div></a> -->
					<a href="http://www.walkwithme.es/" target="_blank"><div class="walk"></div></a>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- END CLIENTS -->
    
<!-- END SECTIONS
================================================== -->
    
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
			<!--<div class="clearfix visible-xs"></div>-->
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

<div class="modal fade" id="politica" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel"><?=lang('ew_section_privacy_title');?></h4>
      </div>
      <div class="modal-body">
      	<p><?=lang('ew_section_privacy_text1');?></p>
        <p><?=lang('ew_section_privacy_text2');?></p>
        <p><?=lang('ew_section_privacy_text3');?></p>
        
        <ol class="lista-privacidad">
        	<li><?=lang('ew_section_privacy_list_item1');?></li>
        	<li><?=lang('ew_section_privacy_list_item2');?></li>
        	<li><?=lang('ew_section_privacy_list_item3');?></li>
        	<li><?=lang('ew_section_privacy_list_item4');?></li>
        </ol>
        <p><?=lang('ew_section_privacy_text4');?></p>
        <p><?=lang('ew_section_privacy_text5');?></p>
        <p><?=lang('ew_section_privacy_text6');?></p>
        <ol class="lista-privacidad">
        	<li><?=lang('ew_section_privacy_list_item5');?></li>
        	<li><?=lang('ew_section_privacy_list_item6');?></li>
        </ol>
        <p><?=lang('ew_section_privacy_text7');?></p>
        <p><?=lang('ew_section_privacy_text8');?></p>
        <h4 class="modal-title" id="myModalLabel"><?=lang('ew_section_privacy_title2');?></h4>
        <p><?=lang('ew_section_privacy_text9');?></p>
        <p><?=lang('ew_section_privacy_text10');?></p>
        <p><?=lang('ew_section_privacy_text11');?></p>
        <p><?=lang('ew_section_privacy_text12');?></p>
        <p><?=lang('ew_section_privacy_text13');?></p>
        <p><?=lang('ew_section_privacy_text14');?></p>
        <h4 class="modal-title" id="myModalLabel"><?=lang('ew_section_privacy_title3');?></h4>
        <p><?=lang('ew_section_privacy_text15');?></p>
        <h4 class="modal-title" id="myModalLabel"><?=lang('ew_section_privacy_title4');?></h4>
        <p><?=lang('ew_section_privacy_text16');?></p>
        <p><?=lang('ew_section_privacy_text17');?></p>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger btn-xs" data-dismiss="modal"><?=lang('ew_section_privacy_close');?></button>
      </div>
    </div>
  </div>
</div>

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
<!-- END FOOTER -->
    
<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="<?=base_url();?>js/jquery.backstretch.min.js" type="text/javascript"></script>
<script src="<?=base_url();?>js/bootstrap.min.js"></script>
<script src="<?=base_url();?>js/script.min.js"></script>
<script type="text/javascript">
	var base_url = '<?=base_url();?>';
	var lang = '<?=$this->lang->lang();?>';
	// Correccion del INTERNATIONAL COVERAGE
	if(lang == 'en'){
		$('.cobertura').css("font", "400 47px/0.9em 'akzidenz-grotesk_bq_condensMd'");
		$('.internacional').css("font", "400 70px/0.9em 'akzidenz-grotesk_bq_condensMd'");
	}
</script>

<script src="<?=base_url();?>js/jquery.scrollTo-min.js" type="text/javascript"></script>
<script src="<?=base_url();?>js/jquery.ui.totop.min.js" type="text/javascript"></script>
<script src="<?=base_url();?>js/jquery.easing.1.3.min.js" type="text/javascript"></script>


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
