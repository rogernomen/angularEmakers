<!DOCTYPE html>
<html lang="es">
<head>
    <title><?=lang('headerTracking.title');?></title>
    
    <meta charset="utf-8">
    <link rel="icon" href="<?=base_url();?>img/_old_web/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="<?=base_url();?>img/_old_web/favicon.ico" type="image/x-icon" />
    
    <meta name="description" content="<?=lang('headerTracking.title');?>">
    <meta name="keywords" content="<?=lang('headerTracking.description');?>">
    <meta name="author" content="<?=lang('headerTracking.keywords');?>">
    
    <link href='http://fonts.googleapis.com/css?family=Ubuntu:400,700' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Arvo:400,700' rel='stylesheet' type='text/css'>
    
    <link rel="stylesheet" href="<?=base_url();?>css/_old_web/bootstrap.css" type="text/css" media="screen">
    <link rel="stylesheet" href="<?=base_url();?>css/_old_web/responsive.css" type="text/css" media="screen">
    <link rel="stylesheet" href="<?=base_url();?>css/_old_web/style.css" type="text/css" media="screen">
    <link rel="stylesheet" href="<?=base_url();?>css/_old_web/camera.css" type="text/css" media="screen">
    <link rel="stylesheet" href="<?=base_url();?>css/_old_web/video-js.css" type="text/css" media="screen">
    <link rel="stylesheet" href="<?=base_url();?>css/_old_web/redmond/jquery-ui-1.10.2.custom.css" type="text/css" media="screen">
    <link rel="stylesheet" href="<?=base_url();?>css/_old_web/jquery.fancybox.css?v=2.1.4" type="text/css"  media="screen" />
    
    <script>
		var base_url = '<?= $this->config->item('base_url'); ?>';
		var lang_site = '<?= $this->lang->lang(); ?>';
	</script>
    
	<script type="text/javascript" src="<?=base_url();?>js/_old_web/jquery.js"></script>
    <script type="text/javascript" src="<?=base_url();?>js/_old_web/superfish.js"></script>
    <script type="text/javascript" src="<?=base_url();?>js/_old_web/jquery.mobilemenu.js"></script>
    <script type="text/javascript" src="<?=base_url();?>js/_old_web/jquery.easing.1.3.js"></script>
    <script type="text/javascript" src="<?=base_url();?>js/_old_web/camera.js"></script>
    <script type="text/javascript" src="<?=base_url();?>js/_old_web/jquery.ui.totop.js"></script>
    <script type="text/javascript" src="<?=base_url();?>js/_old_web/jquery.equalheights.js"></script>
    <script type="text/javascript" src="<?=base_url();?>js/_old_web/video.js"></script>
    <script type="text/javascript" src="<?=base_url();?>js/_old_web/jquery-ui-1.10.2.custom.min.js"></script>
    <script type="text/javascript" src="<?=base_url();?>js/_old_web/jquery.fancybox.js?v=2.1.4"></script>
    
    <!--[if (gt IE 9)|!(IE)]><!-->
		<script type="text/javascript" src="<?=base_url();?>js/_old_web/jquery.mobile.customized.min.js"></script>
    <!--<![endif]-->
    
	<script>
		$(document).ready(function(){
			jQuery('.camera_wrap').camera();
		});
		$(window).load(function(){
		  $().UItoTop({ easingType: 'easeOutQuart' });
		})
		$(window).load(function(){
			$('.line-wrapper .line-after').each(function() {
				var thiswidth = ($(this).parent().width() - $(this).prev().width()) / 2 - 28;
				$(this).css({width:thiswidth});
			});
			$('.line-wrapper .line-before').each(function() {
				var thiswidth = ($(this).parent().width() - $(this).next().width()) / 2 - 28;
				$(this).css({width:thiswidth});
			});
		});
		$(window).resize(function(){
			$('.line-wrapper .line-after').each(function() {
				var thiswidth = ($(this).parent().width() - $(this).prev().width()) / 2 - 28;
				$(this).css({width:thiswidth});
			});
			$('.line-wrapper .line-before').each(function() {
				var thiswidth = ($(this).parent().width() - $(this).next().width()) / 2 - 28;
				$(this).css({width:thiswidth});
			});
		});
	</script>	
        
	<!--[if lt IE 8]>
  		<div style='text-align:center'><a href="http://www.microsoft.com/windows/internet-explorer/default.aspx?ocid=ie6_countdown_bannercode"><img src="http://www.theie6countdown.com/img/upgrade.jpg"border="0"alt=""/></a></div>  
 	<![endif]-->
  	
  	<!--[if lt IE 9]>
    	<link rel="stylesheet" href="<?=base_url();?>css/_old_web/ie.css" type="text/css" media="screen">
    	<link href='http://fonts.googleapis.com/css?family=Ubuntu:400' rel='stylesheet' type='text/css'>
    	<link href='http://fonts.googleapis.com/css?family=Ubuntu:700' rel='stylesheet' type='text/css'>
    	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
</head>
<body>