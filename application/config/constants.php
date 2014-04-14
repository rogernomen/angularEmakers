<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ',							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',					'ab');
define('FOPEN_READ_WRITE_CREATE',				'a+b');
define('FOPEN_WRITE_CREATE_STRICT',				'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');

/*
|--------------------------------------------------------------------------
| Estados de las entregas
|--------------------------------------------------------------------------
|
*/
define('ESTADO_ENTREGA_SIN_ASIGNAR',0);
define('ESTADO_ENTREGA_EN_ALMACEN',1);
define('ESTADO_ENTREGA_CON_INCIDENCIAS',2);
define('ESTADO_ENTREGA_ENTREGADA',3);
define('ESTADO_ENTREGA_AUSENTE_O_CERRADO',4);
define('ESTADO_ENTREGA_DIRECCION_INCORRECTA_POR_REPARTIDOR',5);
define('ESTADO_ENTREGA_DIRECCION_INCOMPLETA_POR_REPARTIDOR',6);
define('ESTADO_ENTREGA_POR_RECOGER',7);
define('ESTADO_ENTREGA_RECOGIDO',8);
define('ESTADO_ENTREGA_RECOGER_EN_AGENCIA',9);
define('ESTADO_ENTREGA_EN_RUTA',10);
define('ESTADO_ENTREGA_NO_ACEPTA_REEMBOLSO',11);
define('ESTADO_ENTREGA_DEVOLVER_A_REMITENTE',13);
define('ESTADO_ENTREGA_DESTINATARIO_APLAZA_ENTREGA',14);
define('ESTADO_ENTREGA_DEVUELTO_A_REMITENTE',15);
define('ESTADO_ENTREGA_ORIGEN_NO_PREPARADO',16);
define('ESTADO_ENTREGA_EN_ALMACEN_ORIGEN',17);

/*
 |--------------------------------------------------------------------------
| Estados de las precargas
|--------------------------------------------------------------------------
|
*/
define('ESTADO_PRECARGA_POR_RECOGER',0);
define('ESTADO_PRECARGA_RECOGIDO',1);
define('ESTADO_PRECARGA_EN_ALMACEN',2);
define('ESTADO_PRECARGA_ORIGEN_NO_PREPARADO',3);
define('ESTADO_PRECARGA_ALMACEN_ORIGEN',4);


/*
 |--------------------------------------------------------------------------
| Estados de los cambios de los pedidos
|--------------------------------------------------------------------------
|
*/
define('ESTADO_CAMBIO_CLIENTE_PENDIENTE',0);
define('ESTADO_CAMBIO_CLIENTE_DESCARTADO',1);
define('ESTADO_CAMBIO_CLIENTE_APROBADO',2);


/* End of file constants.php */
/* Location: ./application/config/constants.php */