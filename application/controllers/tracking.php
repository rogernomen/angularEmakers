<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tracking extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/tracking
	 *	- or -  
	 * 		http://example.com/index.php/tracking/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/tracking/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	
	// ************************************************************************** //
	// CONSTRUCTOR - Controla si el site esta obert al public o no
	// ************************************************************************** //
	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
		$this->load->library("Nusoaplib");
		$this->load->library('user_agent');
		$this->load->library('Browser');
	}
	
	// ************************************************************************** //
	// index - Funcion por defecto
	// ************************************************************************** //
	public function index($num_pedido = '')
	{
		if($this->_checkCompatibility()){
			$data['num_pedido'] = $num_pedido;
			$this->load->view('tracking', $data);
		}else{
			redirect('tracking/no_soportado');
		}
	}
	
	// ************************************************************************** //
	// pedido/order - Sistema de seguimiento 'soft'
	// ************************************************************************** //
	public function pedido($expedicion = false){
		if($this->_checkCompatibility()){
			$data = array();
			
			if(!$expedicion){
				$data = array(
					'status' 	=> 'KO',
					'msg'		=> 'Numero de pedido no encontrado'
				);
			}else{
				// $data = la funcion de ws que toque
				// Mount params array
				$params = array(
						'username' 		=> $this->config->item('ws_login'),
						'password' 		=> $this->config->item('ws_passw'),
						'expedicion' 	=> $expedicion
						
				);
										
				// Connect to the nusoap server
				$this->nusoap_client = new nusoap_client($this->config->item('ws_base_url'));
				
				$response = array();
				
				if($this->nusoap_client->fault){
					$text = 'Error: '.$this->nusoap_client->fault;
						$data =  json_encode(array(
								'status'=> 'KO',
								'msg' 	=> $text
						));
					
				}else{
					if ($this->nusoap_client->getError()){
						$text = 'Error: '.$this->nusoap_client->getError();
						
						$data =  json_encode(array(
								'status'=> 'KO',
								'msg' 	=> $text
						));
						
					}else{
						$text = 'Connection OK';
							
						// Call the function to get data
						$row = $this->nusoap_client->call('getDataFromTrackingSoft', $params);
						
						//hay que parsear las fechas con que se pasan por el json
						$json_final = json_decode($row,true);					
						
						//si devuelve ko devolvemos solo el mensaje
						if(is_null($json_final) || $json_final["status"] == "KO" || $row == false){
							$data =  array(
									'status'=> 'KO',
									'msg' 	=> 'Error inesperado en la búsqueda de datos.'
							);
						}else{
							// Por defecto mostramos el boton para solicitar nuevos intentos de entrega
							$json_final['data']['show_opciones'] = 1;
							$json_final = $this->_parseMsgOutput($json_final);
							$data['info'] = $json_final ;
							$data['status'] = "OK";
						}					
					}
				}
			}
			$this->load->view('tracking_soft', $data);
		}else{
			redirect('tracking/no_soportado');
		}
	}
	
	
	// ************************************************************************** //
	// checkDataTracking - Busqueda de los datos de un pedido
	// ************************************************************************** //
	public function checkDataTracking(){
		if($this->_checkCompatibility()){
			// Init result var
			$row = false;
			
			// Recieve POST data
			$mail_or_telf 	= $this->input->post('mail_or_telf', TRUE);
			$num_pedido 	= $this->input->post('num_pedido', TRUE);
			
			// Mount params array
			$params = array(
				'username' 		=> $this->config->item('ws_login'),
				'password' 		=> $this->config->item('ws_passw'),
				'num_pedido' 	=> $num_pedido,
				'telf_or_mail' 	=> $mail_or_telf
			);
			
			// Connect to the nusoap server
			$this->nusoap_client = new nusoap_client($this->config->item('ws_base_url'));
			
			if($this->nusoap_client->fault){
				$text = 'Error: '.$this->nusoap_client->fault;
				echo json_encode(array(
					'status'=> 'KO',
					'msg' 	=> $text
				));
				exit();
			}else{
				if ($this->nusoap_client->getError()){
					$text = 'Error: '.$this->nusoap_client->getError();
					echo json_encode(array(
						'status'=> 'KO',
						'msg' 	=> $text
					));
					exit();
				}else{
					$text = 'Connection OK';
												
					// Call the function to get data				
					$row = $this->nusoap_client->call('getDataFromTracking', $params);
					//hay que parsear las fechas con que se pasan por el json
					$json_final = json_decode($row,true);
					//si devuelve ko devolvemos solo el mensaje
					if(is_null($json_final) || $json_final["status"] == "KO" || $row == false){
						echo json_encode(array(
							'status'=> 'KO',
							'msg' 	=> 'Error inesperado en la b&uacute;squeda de datos.'
						));
						exit();
					}				
					
					// Por defecto mostramos el boton para solicitar nuevos intentos de entrega
					$json_final['data']['show_opciones'] = 1;
					
					$json_final = $this->_parseMsgOutput($json_final);		
					
					echo json_encode($json_final);
				}
			}
		}else{
			redirect('tracking/no_soportado');
		}
	}
	private function _parseMsgOutput($json_final){
		$json_final['data']['fecha_alta'] = $this->utils->codeDate($this->utils->getDateFromDatetime($json_final['data']['fecha_alta']));
		$json_final['data']['fecha_entrega_cliente'] = $this->utils->codeDate($json_final['data']['fecha_entrega_cliente']);
		
		// Decidimos si permitimos realizar cambios en el formulario
		switch($json_final['data']['cf_estado']){
			case ESTADO_ENTREGA_ENTREGADA:
				$json_final['data']['show_opciones'] = 0; 
			break;
			case ESTADO_ENTREGA_DEVOLVER_A_REMITENTE:
				$json_final['data']['show_opciones'] = 0; 
			break;
			case ESTADO_ENTREGA_DEVUELTO_A_REMITENTE:
				$json_final['data']['show_opciones'] = 0; 
			break;
		}
		
		// Si es un pedido tipo TIPSA tampoco dejaremos que se vean las opciones
		if($json_final['data']['otros_operadores'] == 1){ $json_final['data']['show_opciones'] = 0;  }
		
		
		// Si el pedido esta EN RUTA, montamos el texto de la ventana horaria
		if($json_final['data']['cf_estado'] == ESTADO_ENTREGA_EN_RUTA){
			$json_final['data']['fecha_entrega_estimada_inf'] = $this->utils->getTimeFromDatetime($json_final['data']['fecha_entrega_estimada_inf']);
			$json_final['data']['fecha_entrega_estimada_inf'] = $this->utils->codeTime($json_final['data']['fecha_entrega_estimada_inf']);
			$json_final['data']['fecha_entrega_estimada_sup'] = $this->utils->getTimeFromDatetime($json_final['data']['fecha_entrega_estimada_sup']);
			$json_final['data']['fecha_entrega_estimada_sup'] = $this->utils->codeTime($json_final['data']['fecha_entrega_estimada_sup']);
			
			$json_final['data']['ventanaEntrega'] = 'de '.$json_final['data']['fecha_entrega_estimada_inf'].' a '.$json_final['data']['fecha_entrega_estimada_sup'];
		}else{
			$json_final['data']['ventanaEntrega'] = '';
		}
		
		return $json_final;
	}
	public function setFranjaChange(){
		if($this->_checkCompatibility()){
			// Mount params array
			$params = array(
					'username' 				=> $this->config->item('ws_login'),
					'password' 				=> $this->config->item('ws_passw'),
					"id2"					=> $this->input->post("id2"),
					"cf_agencia"			=> $this->input->post("cf_agencia"),
					"num_pedido"			=> $this->input->post("num_pedido"),
					"fecha_entrega"			=> $this->input->post("fecha_entrega"),
					"id_franja_entrega"		=> $this->input->post("id_franja_entrega"),
					"comentarios_cliente"	=> $this->input->post("comentarios_cliente"),
					"telefono"				=> $this->input->post("telefono"),
					"telefono2"				=> $this->input->post("telefono2"),
					"mail"					=> $this->input->post("email"),
					"tabla_origen"			=> $this->input->post("tabla_origen")
			);
	
			// Connect to the nusoap server
			$this->nusoap_client = new nusoap_client($this->config->item('ws_base_url'));
	
			if($this->nusoap_client->fault){
				$text = 'Error: '.$this->nusoap_client->fault;
				echo json_encode(array(
						'status'=> 'KO',
						'msg' 	=> $text
				));
			}else{
				if($this->nusoap_client->getError()){
					$text = 'Error: '.$this->nusoap_client->getError();
					echo json_encode(array(
							'status'=> 'KO',
							'msg' 	=> $text
					));
				}else{
					$text = 'Connection OK';
					// Call the function 
					$row = $this->nusoap_client->call('changeFranja', $params);
					
					echo json_encode(array(
							'status'	=> 'OK',
							'msg' 		=> 'Cambios solicitados correctamente'
					));
				}
			}
		}else{
			redirect('tracking/no_soportado');
		}
	}
	
	// ************************************************************************** //
	// _checkCompatibility - Comprovacion de la compatibilidad
	// ************************************************************************** //
	private function _checkCompatibility()
	{
		// Compatibility
		$browser = new Browser();
		// Android Chrome
		if($browser->getPlatform() == Browser::PLATFORM_ANDROID && $browser->getBrowser() == Browser::BROWSER_FIREFOX){ return true; }
		// iPhone 
		if($browser->getPlatform() == Browser::PLATFORM_IPHONE && $browser->getBrowser() == Browser::BROWSER_IPHONE){ return true; }
		// iPad 
		if($browser->getPlatform() == Browser::PLATFORM_IPAD && $browser->getBrowser() == Browser::BROWSER_IPAD){ return true; }
		// iPod 
		if($browser->getPlatform() == Browser::PLATFORM_IPOD && $browser->getBrowser() == Browser::BROWSER_IPOD){ return true; }
		// iPhone Chrome
		if($browser->getPlatform() == Browser::PLATFORM_IPHONE && $browser->getBrowser() == Browser::BROWSER_CHROME){ return true; }
		// iPad Chrome
		if($browser->getPlatform() == Browser::PLATFORM_IPAD && $browser->getBrowser() == Browser::BROWSER_CHROME){ return true; }
		// iPod Chrome
		if($browser->getPlatform() == Browser::PLATFORM_IPOD && $browser->getBrowser() == Browser::BROWSER_CHROME){ return true; }
		// iPhone Safari
		if($browser->getPlatform() == Browser::PLATFORM_IPHONE && $browser->getBrowser() == Browser::BROWSER_SAFARI){ return true; }
		// iPad Safari
		if($browser->getPlatform() == Browser::PLATFORM_IPAD && $browser->getBrowser() == Browser::BROWSER_SAFARI){ return true; }
		// iPod Safari
		if($browser->getPlatform() == Browser::PLATFORM_IPOD && $browser->getBrowser() == Browser::BROWSER_SAFARI){ return true; }
		// MacOSX Chrome
		if($browser->getPlatform() == Browser::PLATFORM_APPLE && $browser->getBrowser() == Browser::BROWSER_CHROME){ return true; }
		// MacOSX Firefox
		if($browser->getPlatform() == Browser::PLATFORM_APPLE && $browser->getBrowser() == Browser::BROWSER_FIREFOX){ return true; }
		// MacOSX Opera
		if($browser->getPlatform() == Browser::PLATFORM_APPLE && $browser->getBrowser() == Browser::BROWSER_OPERA){ return true; }
		// MacOSX Safari
		if($browser->getPlatform() == Browser::PLATFORM_APPLE && $browser->getBrowser() == Browser::BROWSER_SAFARI){ return true; }
		// Windows Chrome
		if($browser->getPlatform() == Browser::PLATFORM_WINDOWS && $browser->getBrowser() == Browser::BROWSER_CHROME){ return true; }
		// Windows Firefox
		if($browser->getPlatform() == Browser::PLATFORM_WINDOWS && $browser->getBrowser() == Browser::BROWSER_FIREFOX){ return true; }
		// Windows IE
		if($browser->getPlatform() == Browser::PLATFORM_WINDOWS && $browser->getBrowser() == Browser::BROWSER_IE){ return true; }
		// Windows Opera
		if($browser->getPlatform() == Browser::PLATFORM_WINDOWS && $browser->getBrowser() == Browser::BROWSER_OPERA){ return true; }
		
		return false;
	}
	
	// ************************************************************************** //
	// no_soportado/not_supported - Funcion cuando el dispositivo no esta soportado
	// ************************************************************************** //
	public function no_soportado()
	{
		$this->load->view('tracking_not_supported');
	}
	public function not_supported($num_pedido = '')
	{
		$this->load->view('tracking_not_supported');
	}
}
/* End of file tracking.php */
/* Location: ./application/controllers/tracking.php */