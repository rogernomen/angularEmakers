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
	}
	
	// ************************************************************************** //
	// index - Funcion por defecto
	// ************************************************************************** //
	public function index()
	{
		$this->load->view('tracking');
	}
	
	
	// ************************************************************************** //
	// checkDataTracking - Busqueda de los datos de un pedido
	// ************************************************************************** //
	public function checkDataTracking(){
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
	}
}
/* End of file tracking.php */
/* Location: ./application/controllers/tracking.php */