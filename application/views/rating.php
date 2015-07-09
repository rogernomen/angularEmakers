
<!DOCTYPE html>
<html lang="en">
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
	
	<title><?=lang('ew_section_contacta_title');?></title>
	
	<!-- Bootstrap core CSS -->
	<link href="<?=base_url();?>css/bootstrap.min.css" rel="stylesheet">
	
	<!-- Custom styles for this template -->
	<link href='http://fonts.googleapis.com/css?family=Lato:100,300,400,700,900,100italic,300italic,400italic,700italic,900italic' rel='stylesheet' type='text/css'>
	<link href="<?=base_url();?>css/main.css" rel="stylesheet">
	<link href="<?=base_url();?>css/fontello.min.css" rel="stylesheet">
	
	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	  <script src="https://oss.maxcdn.com/libs/respond.<?=base_url();?>js/1.4.2/respond.min.js"></script>
	<![endif]-->
	<style>
	.navbar-inverse {
	  background: black;  
	}
	
	.navbar {
		border: 0 solid transparent;
	}
	</style>
	
	<script>
		var base_url = '<?= $this->config->item('base_url'); ?>';
		var lang_site = '<?= $this->lang->lang(); ?>';
		var starcount = <?php echo $starcount; ?>;
	</script>
	
</head>

<body>
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
	      		<a href="<?=base_url().$this->lang->lang();?>/tracking" target="_blank"><button type="button" class="btn btn-default btn-sm navbar-btn"><?=lang('ew_navbar_item4');?> <i class="icon-squares"></i></button></a>
	      		<a href="#" target="_blank"><button type="button" class="btn btn-default btn-sm navbar-btn"><?=lang('ew_navbar_item5');?> <i class="icon-squares"></i></button></a>
	      		<a href="http://www.linkedin.com/company/emakers" target="_blank"><button type="button" class="btn btn-default btn-sm navbar-btn btn-linkedin"><i class="icon-linkedin-1"></i></button></a>
	      		<a href="https://twitter.com/emakers_es" target="_blank"><button type="button" class="btn btn-default btn-sm navbar-btn btn-twitter"><i class="icon-twitter-2"></i></button></a>
	      		<a href="https://www.facebook.com/Emakers" target="_blank"><button type="button" class="btn btn-default btn-sm navbar-btn btn-facebook"><i class="icon-facebook"></i></button></a>
	      	</ul>
		</div>
	</div>
</nav>
  	
<!-- Sections
================================================== -->
<!-- contacta -->
<section id="rating">
    <div class="container">
		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-8 ratingctn">
				<h1><?=lang('rating_title');?></h1>
				<h2><p class="lead"><?=lang('rating_slogan');?></p></h2>
				<p><?=lang('rating_description');?></p>
			</div>
			<div class="col-md-2"></div>
		</div>
    </div>
	<div class="container mtop20">
		<div class="row">
			<div class="row lead">
				<div id="stars" class="starrr"></div>
				<?php
					if($starcount == 1){
						echo '<h2 class="talcenter">'.lang('rating_rate1').'</h2>';
					}else if($starcount == 2){
						echo '<h2 class="talcenter">'.lang('rating_rate2').'</h2>';
					}else if($starcount == 3){
						echo '<h2 class="talcenter">'.lang('rating_rate3').'</h2>';
					}else if($starcount == 4){
						echo '<h2 class="talcenter">'.lang('rating_rate4').'</h2>';
					}else if($starcount == 5){
						echo '<h2 class="talcenter">'.lang('rating_rate5').'</h2>';
					}else if($starcount == 0){
						echo '<h2 class="talcenter">&nbsp;</h2>';
					}
				?>
				
			</div>
		</div>
	</div>
	
	<div class="container">
		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-8 ratingctn">
				<div class="form-group">	
    	    		<textarea id="input_comentarios_sugerencias" name="input_comentarios_sugerencias" class="form-control" rows="3" placeholder="<?=lang('rating_comments');?>"></textarea>
    			</div>
    			<input type="hidden" id="hash_rating" name="hash_rating" value="<?php echo $hash_rating;?>" />
    			<input type="hidden" id="id_rating" name="id_rating" value="<?php echo $id_rating;?>" />
    			<input type="hidden" id="rating_value" name="rating_value" value="<?php echo $starcount;?>" />
    			<p>
					<button type="button" class="btn btn-warning btn-block" id="rating_save" onclick="javascript:guardaRating();"><span class="glyphicon glyphicon-ok gly_emks"></span> <?=lang('rating_save');?></button>
					<button type="button" class="btn btn-success btn-block" id="rating_ok" disabled="disabled"><span class="glyphicon glyphicon-ok gly_emks"></span> <?=lang('rating_saved');?></button>
				</p>
			</div>
			<div class="col-md-2"></div>
		</div>
	</div>

</section>
        
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

    
	<script type="text/javascript">
		var base_url = '<?=base_url();?>';
	</script>
	<!-- Bootstrap core JavaScript
	================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<script src="<?=base_url();?>js/bootstrap.min.js"></script>
	<script src="<?=base_url();?>js/rating_script.js"></script>
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
