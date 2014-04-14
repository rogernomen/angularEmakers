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
	
	<link rel="stylesheet" href="<?=base_url();?>css/_old_web/tracking_smartphone.css" type="text/css" media="screen">
	
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
				<img src="<?=base_url()?>img/_old_web/logo_header.png" /><br/>
				<span><?=lang('menu.slogan');?></span>
			</div>
			
			<!-- content -->
			<h3><?=lang('tracking.phone.title');?></h3>
			<p class="alignJustify"><?=lang('tracking.phone.description');?></p>
			<form id="trk_form" method="POST" action="<?= base_url().$this->lang->lang(); ?>/tracking/checkDataTracking/1" data-ajax="false">
				<div class="ui-field-contain">
					<label class="lead" for="num_pedido"><?=lang('tracking.phone.input1');?></label>
    	 			<input name="num_pedido" id="num_pedido" value="" type="text">
			    </div>
			    <div class="ui-field-contain">
			   		<label class="lead"  for="mail_or_telf"><?=lang('tracking.phone.input2');?></label>
			    	<input name="mail_or_telf" id="mail_or_telf" value="" type="text">
     			</div>
     			<div class="ui-field-contain">
     				<input id="sndButton" value="<?=lang('tracking.phone.input3');?>" data-theme="b" type="button">
     			</div>
     			<a id="errorMsgTrigger" class="displaynone" href="#dialogPage" data-rel="dialog">dialog</a> 
			</form>
			<a class="lead"><?=lang('tracking.dudas.title');?></a>
			<p class="alignJustify"><?=lang('tracking.dudas.description');?></p>
		</div><!-- /content -->
	
		<!-- footer -->
		<div data-role="footer" data-theme="c">
			<div class="footer_logo_ctn">
				<img src="<?=base_url()?>img/_old_web/logo_header_bn.png" />
			</div>
		</div><!-- /footer -->
	</div><!-- /page -->
	
	<div data-role="page" id="dialogPage" data-close-btn="right">
		<div data-role="header" data-theme="c">
			<h2><?=lang('tracking.phone.error1');?></h2>
		</div>
		<div data-role="content">
			<p><?=lang('tracking.phone.error2');?></p>
			<a href="#" data-rel="back" data-theme="d" type="button"><?=lang('tracking.phone.cerrar');?></a>
		</div>
	</div>
	
	<script type="text/javascript">
		$( "#sndButton" ).on( "click", function( event ){
			// Prevent the usual navigation behavior
			event.preventDefault();

			// Check data inputs
			var error = false;

	    	// Comprovamos la correcta existencia de los campos
			if($("#num_pedido").val() == ''  || $("#num_pedido").val() == '<?=lang('tracking.input1');?>'){ error = true; }
			if($("#mail_or_telf").val() == '' || $("#mail_or_telf").val() == '<?=lang('tracking.input2');?>'){ error = true; }

			// Comprovamos ahora el tipo de datos en #mail_or_telf para aplicar la regla de expresion adecuada
			if(error == false) error = compruevaMail_or_Telf($("#mail_or_telf").val());
			
			if(error){
				// Show error dialog
				$('#errorMsgTrigger').trigger('click');
			}else{
				// Send data
				$('#trk_form').submit();
			}
		});

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