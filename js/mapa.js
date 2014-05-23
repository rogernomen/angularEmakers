var map;
var markers = [
	{
		lat: 41.38159,
		lng: 2.15926,
		title: 'Emakers Barcelona',
		icon: base_url+'img/marker.png',
		infoWindow: {
			content: '<p>Emakers Barcelona</p>'
		}	
	},
	{
		lat: 40.43751,
		lng: -3.66847,
		title: 'Emakers Madrid',
		icon: base_url+'img/marker.png',
		infoWindow: {
			content: '<p>Emakers Madrid</p>'
		}
	},
	{
		lat: 43.31831,
		lng: -1.97501,
		title: 'Emakers San Sebastián',
		icon: base_url+'img/marker.png',
		infoWindow: {
			content: '<p>Emakers San Sebastián</p>'
		}
	},
	{
		lat: 37.39040,
		lng: -5.98563,
		title: 'Emakers Sevilla',
		icon: base_url+'img/marker.png',
		infoWindow: {
			content: '<p>Emakers Sevilla</p>'
		}
	},
	{
		lat: 36.69098,
		lng: -4.44277,
		title: 'Emakers Malaga',
		icon: base_url+'img/marker.png',
		infoWindow: {
			content: '<p>Emakers Malaga</p>'
		}
	},
	{
		lat: 37.9790701,
		lng: -1.0727247,
		title: 'Emakers Murcia',
		icon: base_url+'img/marker.png',
		infoWindow: {
			content: '<p>Emakers Murcia</p>'
		}
	},
	{
		lat: 43.257526,
		lng: -2.926221,
		title: 'Emakers Bilbao',
		icon: base_url+'img/marker.png',
		infoWindow: {
			content: '<p>Emakers Bilbao</p>'
		}
	},
	{
		lat: 41.64914,
		lng: -0.92281,
		title: 'Emakers Zaragoza',
		icon: base_url+'img/marker.png',
		infoWindow: {
			content: '<p>Emakers Zaragoza</p>'
		}
	},
	{
		lat: 41.64010,
		lng: -4.72162,
		title: 'Emakers Valladolid',
		icon: base_url+'img/marker.png',
		infoWindow: {
			content: '<p>Emakers Valladolid</p>'
		}
	},
	{
		lat: 37.88309,
		lng: -4.77319,
		title: 'Emakers Córdoba',
		icon: base_url+'img/marker.png',
		infoWindow: {
			content: '<p>Emakers Córdoba</p>'
		}
	},
	{
		lat: 43.36640,
		lng: -8.41314,
		title: 'Emakers La Coruña',
		icon: base_url+'img/marker.png',
		infoWindow: {
			content: '<p>Emakers La Coruña</p>'
		}
	},
	{
		lat: 39.478266,
		lng: -0.375204,
		title: 'Emakers Valencia',
		icon: base_url+'img/marker.png',
		infoWindow: {
			content: '<p>Emakers Valencia</p>'
		}
	},
	{
		lat: 37.88309,
		lng: -4.77319,
		title: 'Emakers Granada',
		icon: base_url+'img/marker.png',
		infoWindow: {
			content: '<p>Emakers Granada</p>'
		}
	},
	{
		lat: 51.516708,
		lng: -0.125561,
		title: 'Emakers London',
		icon: base_url+'img/marker.png',
		infoWindow: {
			content: '<p>Emakers London</p>'
		}
	}
];

var nombres = [
	{
		nombre: 'Emakers Barcelona',
		direccion: 'Carrer Comte Urgell, 51 Bis Principal 08011 Barcelona',
	},
	{
		nombre: 'Emakers Madrid',
		direccion: 'Calle Marques de Monteagudo, 22 Bajos 28028 Madrid',
	},
	{
		nombre: 'Emakers San Sebastián',
		direccion: 'Calle Duque de Mandas, 28 Bajos 20009 San Sebastián',
	},
	{
		nombre: 'Emakers Sevilla',
		direccion: 'Calle Muro de los Navarros, 25 Bajos 41003 Sevilla',
	},
	{
		nombre: 'Emakers Malaga',
		direccion: 'Calle Francisco de cossio, 20 Local 1 29004 Malaga',
	},
	{
		nombre: 'Emakers Murcia',
		direccion: 'C/ Maria Matas 2, Beniajan 30570',
	},
	{
		nombre: 'Emakers Bilbao',
		direccion: 'Calle Ribera, 16 48005 Bilbao',
	},
	{
		nombre: 'Emakers Zaragoza',
		direccion: 'Calle Conde de Sobradiel, 6 50011 Zaragoza',
	},
	{
		nombre: 'Emakers Valladolid',
		direccion: 'Calle Embajadores, 1 47013 Valladolid',
	},
	{
		nombre: 'Emakers Córdoba',
		direccion: 'Plaza de Almagra, 7 14002 Córdoba',
	},
	{
		nombre: 'Emakers La Coruña',
		direccion: 'Calle Fernando Macias, 26 15004 La Coruña',
	},
	{
		nombre: 'Emakers Valencia',
		direccion: 'Calle Zapateros, 8 46003 Valencia',
	},
	{
		nombre: 'Emakers Granada',
		direccion: 'Calle Seminario, 12 18002 Granada',
	},
	{
		nombre: 'Emakers London',
		direccion: 'West Central Street, 13 WC1A1AB London',
	}
	
];

var currentMarker = 0;


$(document).ready(function(){

	
	map = new GMaps({
		div: '#mapa',
			lat: 41.38159,
			lng: 2.15926,
			zoom: 13,
			zoomControl : true, 
			zoomControlOpt: { style : 'SMALL', position: 'TOP_RIGHT' },
			panControl : false,
			scrollwheel: false,
			mapTypeControl: false,
			streetViewControl: false,
	});
	
	map.addMarkers(markers);
});

//map.fitZoom();
