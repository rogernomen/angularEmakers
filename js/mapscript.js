$(document).ready(function() {
	$('#left').click(function() {

		currentMarker = (currentMarker + markers.length - 1) % markers.length;
	   	map.setCenter(markers[currentMarker].lat, markers[currentMarker].lng);
//	   	$('#mapa').fadeOut();
	   	$('.center').fadeOut(function () {
	   		$('.center').html(function () {
	   			var direc = "<h4 class='h4mapscript'>" + nombres[currentMarker].nombre + "</hr4> <address>" + nombres[currentMarker].direccion + "</address>";
	   			return direc;
	   		})
	   	});
//	   	$('#mapa').fadeIn();
	   	$('.center').fadeIn();
	});
	$('#left').mouseenter(function() {
	  $('#left').css('cursor' , 'pointer');
	});
	$('#right').click(function() {

	   currentMarker = (currentMarker + 1) % markers.length;
	   map.setCenter(markers[currentMarker].lat, markers[currentMarker].lng);
//		   $('#mapa').fadeOut();
	   $('.center').fadeOut(function () {
	   		$('.center').html(function () {
	   			var direc = "<h4 class='h4mapscript'>" + nombres[currentMarker].nombre + "</hr4> <address>" + nombres[currentMarker].direccion + "</address>";
	   			return direc;
	   		})
	   });
//		   $('#mapa').fadeIn();
	   $('.center').fadeIn();   
	});
	$('#right').mouseenter(function() {
	  $('#right').css('cursor' , 'pointer');
	});
   
});
