var $logo = $('.navbar-inverse');
var $altura = $('.cover-wrapper');
var $elementOffset = $('.column-detail').offset().top;
var $element = $('.column-detail');
var $scrollOffset;
var $windowHeight = $(window).height();
var images = ['foto1.jpg', 'foto2.jpg', 'foto3.jpg', 'foto4.jpg', 'foto5.jpg'];

//------------------------------------- Waiting for the entire site to load ------------------------------------------------//



jQuery(window).load(function() { 
		jQuery("#loaderInner").fadeOut(); 
		jQuery("#loader").delay(400).fadeOut("slow"); 
//		$('.teaserTitle ').stop().animate({marginTop :'330px', opacity:"1"}, 1000, 'easeOutQuint');
		$('.down a ').stop().animate({marginTop :'30px', opacity:"1"}, 1000, 'easeOutQuint');

});

$(document).ready(function() {
	
	$(".navbar-scrollspy ul a, .down a").click(function(event){
	
			event.preventDefault();
			
			var full_url = this.href;
			var parts = full_url.split("#");
			var trgt = parts[1];
			var target_offset = $("#"+trgt).offset();
			var target_top = target_offset.top;
	
			$('html,body').animate({scrollTop:target_top}, 800);
	});
	
	$().UItoTop({ easingType: 'easeOutQuart' });
	var $texto = images[Math.floor(Math.random() * images.length)];
//	$altura.css({background: "url(img/cover/" + $texto + ") 50% no-repeat scroll"});
	var $direccion = base_url+"img/cover/" + $texto;
	$altura.backstretch($direccion);
});


//--------- Scroll navigation ---------------//
$(window).scroll(function() {
	var $scrollOffset = $(this).scrollTop();	
    $logo.css({background: $scrollOffset > $altura.height()-$logo.height()? "rgba(0, 0, 0, 0.79)":"transparent"});    
});

$('.carousel').carousel({
  interval: 4000
});

$('.collapse').on('show.bs.collapse', function () {
  $logo.css({background: "rgba(0, 0, 0, 0.79)"});
})

$('.collapse').on('hidden.bs.collapse', function () {
  $logo.css({background: "transparent"});
})

