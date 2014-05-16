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
	// INDEX - Funcion por defecto
	// ************************************************************************** //
	public function index()
	{
		$data_menu['itemActive'] = 'tracking';
		//Primero detectamos el agente
		if ($this->agent->is_mobile()){
			//$agent = $this->agent->mobile();
			$this->load->view('mobile/tracking_smartphone_view');

		}else if ($this->agent->is_browser()){
			//$agent = $this->agent->browser().' '.$this->agent->version();
			$this->load->view('header_tracking');
			$this->load->view('menu_view2', $data_menu); //tracking_menu
			$this->load->view('tracking_view');
			$this->load->view('footer_view');
				
		}else if ($this->agent->is_robot()){
			die();
			
		}else{
			//$agent = 'Unidentified User Agent';
			die();
		}
	}
	
	public function mobile_view(){
		$this->load->view('mobile/tracking_smartphone_view');
	}
	
	// ************************************************************************** //
	// INDITEX - Sistema de seguimiento 'soft'
	// ************************************************************************** //
	public function pedido($expedicion = false){
		// Set variables
		$data_menu['itemActive'] = 'tracking';
		
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
						$json_final = $this->_parseMsgOutput($json_final);
						$data['info'] = $json_final ;
						$data['status'] = "OK";
						
					}					
				}
			}
		}
		
		$this->load->view('header_view');
		$this->load->view('menu_view2', $data_menu);
		$this->load->view('tracking_soft_view', $data);
		$this->load->view('footer_view');
	}
	
	public function order($expedicion = false){
		// Set variables
		$data_menu['itemActive'] = 'tracking';
	
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
						$json_final = $this->_parseMsgOutput($json_final);
						$data['info'] = $json_final ;
						$data['status'] = "OK";
	
					}
				}
			}
		}
	
		$this->load->view('header_view');
		$this->load->view('menu_view2', $data_menu);
		$this->load->view('tracking_soft_view', $data);
		$this->load->view('footer_view');
	}
	
	public function checkDataTracking($smartphone = false){
		// Set optional params
		if($smartphone != false) $smartphone = true;
		
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
			if($smartphone){
				$data['status'] = 0;
				$this->load->view('tracking_smartphone3_view', $data);
			}else{
				echo json_encode(array(
					'status'=> 'KO',
					'msg' 	=> $text
				));
			}
		}else{
			if ($this->nusoap_client->getError()){
				$text = 'Error: '.$this->nusoap_client->getError();
				if($smartphone){
					$data['status'] = 0;
					$this->load->view('tracking_smartphone3_view', $data);
				}else{
					echo json_encode(array(
						'status'=> 'KO',
						'msg' 	=> $text
					));
				}
			}else{
				$text = 'Connection OK';
											
				// Call the function to get data				
				$row = $this->nusoap_client->call('getDataFromTracking', $params);
				//hay que parsear las fechas con que se pasan por el json
				$json_final = json_decode($row,true);
				//si devuelve ko devolvemos solo el mensaje
				if(is_null($json_final) || $json_final["status"] == "KO" || $row == false){
					if($smartphone){
						redirect('tracking/no_search_success');
					}else{
						echo json_encode(array(
							'status'=> 'KO',
							'msg' 	=> 'Error inesperado en la b&uacute;squeda de datos.'
						));
						exit();
					}
				}				
				
				// Por defecto mostramos el boton para solicitar nuevos intentos de entrega
				$json_final['data']['show_opciones'] = 1;
				
				$json_final = $this->_parseMsgOutput($json_final);		
				
				if($smartphone){
					$this->load->view('mobile/tracking_smartphone2_view', $json_final);
				}else{
					echo json_encode($json_final);
				}
			}
		}
	}
	
	public function _parseMsgOutput($json_final){
		
		$json_final['data']['fecha_entrega_cliente_ios'] = $json_final['data']['fecha_entrega_cliente'];
		$json_final['data']['fecha_alta'] = $this->utils->codeDate($this->utils->getDateFromDatetime($json_final['data']['fecha_alta']));
		$json_final['data']['fecha_entrega_cliente'] = $this->utils->codeDate($json_final['data']['fecha_entrega_cliente']);
		
		
		if($json_final['data']['tabla'] == 'argos_entregas'){
			$json_final['data']['fecha_entrega_prevista'] = $this->utils->codeDate($json_final['data']['fecha_entrega_prevista']);
			$json_final['data']['fecha_entrega_estimada_inf'] = $this->utils->getTimeFromDatetime($json_final['data']['fecha_entrega_estimada_inf']);
			$json_final['data']['fecha_entrega_estimada_inf'] = $this->utils->codeTime($json_final['data']['fecha_entrega_estimada_inf']);
			$json_final['data']['fecha_entrega_estimada_sup'] = $this->utils->getTimeFromDatetime($json_final['data']['fecha_entrega_estimada_sup']);
			$json_final['data']['fecha_entrega_estimada_sup'] = $this->utils->codeTime($json_final['data']['fecha_entrega_estimada_sup']);
		}else{
			$json_final['data']['fecha_entrega_prevista'] = '';
			$json_final['data']['fecha_entrega_estimada_inf'] = '';
			$json_final['data']['fecha_entrega_estimada_sup'] = '';
		}
		
		if($json_final['data']['tabla'] == 'argos_entregas'){
			// Segun el estado debemos preparar mensages de texto alternativos
			switch($json_final['data']['cf_estado']){
				case ESTADO_ENTREGA_SIN_ASIGNAR:
					$json_final['data']['estadoDesc'] = $json_final['data']['estado_entrega'];
					$json_final['data']['estadoColor'] = $json_final['data']['colorDesc'];
					if($json_final['data']['otros_operadores'] == 1){
						$json_final['data']['estadoSlogan'] = ''.lang('tracking.sft.fl1').'<b>'.$json_final['data']['fecha_entrega_cliente'].'</b>';
					}else{
						$json_final['data']['estadoSlogan'] = ''.lang('tracking.sft.fl1').'<b>'.$json_final['data']['fecha_entrega_cliente'].'</b><br/>'.lang('tracking.sft.fl2').'<b>'.$json_final['data']['franja_entregaDesc'].'</b>';
					}
					
					break;
				case ESTADO_ENTREGA_EN_ALMACEN:
					$json_final['data']['estadoDesc'] = $json_final['data']['estado_entrega'];
					$json_final['data']['estadoColor'] = $json_final['data']['colorDesc'];
					if($json_final['data']['otros_operadores'] == 1){
						$json_final['data']['estadoSlogan'] = ''.lang('tracking.sft.fl1').'<b>'.$json_final['data']['fecha_entrega_cliente'].'</b>';
					}else{
						$json_final['data']['estadoSlogan'] = ''.lang('tracking.sft.fl1').'<b>'.$json_final['data']['fecha_entrega_cliente'].'</b><br/>'.lang('tracking.sft.fl2').'<b>'.$json_final['data']['franja_entregaDesc'].'</b>';
					}
					
					break;
				case ESTADO_ENTREGA_EN_ALMACEN_ORIGEN:
					$json_final['data']['estadoDesc'] = $json_final['data']['estado_entrega'];
					$json_final['data']['estadoColor'] = $json_final['data']['colorDesc'];
					if($json_final['data']['otros_operadores'] == 1){
						$json_final['data']['estadoSlogan'] = ''.lang('tracking.sft.fl1').'<b>'.$json_final['data']['fecha_entrega_cliente'].'</b>';
					}else{
						$json_final['data']['estadoSlogan'] = ''.lang('tracking.sft.fl1').'<b>'.$json_final['data']['fecha_entrega_cliente'].'</b><br/>'.lang('tracking.sft.fl2').'<b>'.$json_final['data']['franja_entregaDesc'].'</b>';
					}
					
					break;
				case ESTADO_ENTREGA_CON_INCIDENCIAS:
					$json_final['data']['estadoDesc'] = $json_final['data']['estado_entrega'];
					$json_final['data']['estadoColor'] = $json_final['data']['colorDesc'];
					$json_final['data']['estadoSlogan'] = '';
					break;
				case ESTADO_ENTREGA_ENTREGADA:
					$json_final['data']['estadoDesc'] = $json_final['data']['estado_entrega'];
					$json_final['data']['estadoColor'] = $json_final['data']['colorDesc'];
					$json_final['data']['estadoSlogan'] = ''.lang('tracking.sft.fl3').'<b>'.$json_final['data']['fecha_entrega_final'].'</b>';
					$json_final['data']['show_opciones'] = 0;
					break;
				case ESTADO_ENTREGA_AUSENTE_O_CERRADO:
					$json_final['data']['estadoDesc'] = $json_final['data']['estado_entrega'];
					$json_final['data']['estadoColor'] = $json_final['data']['colorDesc'];
					$fecha_intento = $json_final['data']['fecha_intento'];
					$json_final['data']['estadoSlogan'] = ''.lang('tracking.sft.fl4').'<b>'.$fecha_intento.'</b>';
					break;
				case ESTADO_ENTREGA_DIRECCION_INCORRECTA_POR_REPARTIDOR:
					$json_final['data']['estadoDesc'] = $json_final['data']['estado_entrega'];
					$json_final['data']['estadoColor'] = $json_final['data']['colorDesc'];
					$fecha_intento = $json_final['data']['fecha_intento'];
					$json_final['data']['estadoSlogan'] = ''.lang('tracking.sft.fl4').'<b>'.$fecha_intento.'</b>';
					break;
				case ESTADO_ENTREGA_DIRECCION_INCOMPLETA_POR_REPARTIDOR:
					$json_final['data']['estadoDesc'] = $json_final['data']['estado_entrega'];
					$json_final['data']['estadoColor'] = $json_final['data']['colorDesc'];
					$fecha_intento = $json_final['data']['fecha_intento'];
					$json_final['data']['estadoSlogan'] = ''.lang('tracking.sft.fl4').'<b>'.$fecha_intento.'</b>';
					break;
				case ESTADO_ENTREGA_POR_RECOGER:
					$json_final['data']['estadoDesc'] = $json_final['data']['estado_entrega'];
					$json_final['data']['estadoColor'] = $json_final['data']['colorDesc'];
					if($json_final['data']['otros_operadores'] == 1){
						$json_final['data']['estadoSlogan'] = ''.lang('tracking.sft.fl1').'<b>'.$json_final['data']['fecha_entrega_cliente'].'</b>';
					}else{
						$json_final['data']['estadoSlogan'] = ''.lang('tracking.sft.fl1').'<b>'.$json_final['data']['fecha_entrega_cliente'].'</b><br/>'.lang('tracking.sft.fl2').'<b>'.$json_final['data']['franja_entregaDesc'].'</b>';
					}
					
					break;
				case ESTADO_ENTREGA_RECOGIDO:
					$json_final['data']['estadoDesc'] = $json_final['data']['estado_entrega'];
					$json_final['data']['estadoColor'] = $json_final['data']['colorDesc'];
					if($json_final['data']['otros_operadores'] == 1){
						$json_final['data']['estadoSlogan'] = ''.lang('tracking.sft.fl1').'<b>'.$json_final['data']['fecha_entrega_cliente'].'</b>';
					}else{
						$json_final['data']['estadoSlogan'] = ''.lang('tracking.sft.fl1').'<b>'.$json_final['data']['fecha_entrega_cliente'].'</b><br/>'.lang('tracking.sft.fl2').'<b>'.$json_final['data']['franja_entregaDesc'].'</b>';
					}
					
					break;
				case ESTADO_ENTREGA_RECOGER_EN_AGENCIA:
					$json_final['data']['estadoDesc'] = $json_final['data']['estado_entrega'];
					$json_final['data']['estadoColor'] = $json_final['data']['colorDesc'];
					if($json_final['data']['fecha_entrega_2intento'] != ''){
						$fecha_intento = $json_final['data']['fecha_entrega_2intento'];
					}else{
						$fecha_intento = $json_final['data']['fecha_entrega_1intento'];
					}
					$json_final['data']['estadoSlogan'] = ''.lang('tracking.sft.fl4').'<b>'.$fecha_intento.'</b>';
					break;
				case ESTADO_ENTREGA_EN_RUTA:
					$json_final['data']['estadoDesc'] = $json_final['data']['estado_entrega'];
					$json_final['data']['estadoColor'] = $json_final['data']['colorDesc'];
					if(!isset($json_final['data']['fecha_entrega_2intento']) || $json_final['data']['fecha_entrega_2intento'] != ''){
						$json_final['data']['estadoSlogan'] = ''.lang('tracking.sft.fl1').'<b>'.$json_final['data']['fecha_entrega_cliente'].'</b>';
					}else{
						$json_final['data']['estadoSlogan'] = ''.lang('tracking.sft.fl1').'<b>'.$json_final['data']['fecha_entrega_cliente'].'</b><br/>'.lang('tracking.sft.fl2').'<b>'.$json_final['data']['fecha_entrega_estimada_inf'].' - '.$json_final['data']['fecha_entrega_estimada_sup'].'</b>';
					}
					
					break;
				case ESTADO_ENTREGA_NO_ACEPTA_REEMBOLSO:
					$json_final['data']['estadoDesc'] = $json_final['data']['estado_entrega'];
					$json_final['data']['estadoColor'] = $json_final['data']['colorDesc'];
					if($json_final['data']['fecha_entrega_2intento'] != ''){
						$fecha_intento = $json_final['data']['fecha_entrega_2intento'];
					}else{
						$fecha_intento = $json_final['data']['fecha_entrega_1intento'];
					}
					$json_final['data']['estadoSlogan'] = ''.lang('tracking.sft.fl4').'<b>'.$fecha_intento.'</b>';
					break;
				case ESTADO_ENTREGA_DEVOLVER_A_REMITENTE:
					$json_final['data']['estadoDesc'] = $json_final['data']['estado_entrega'];
					$json_final['data']['estadoColor'] = $json_final['data']['colorDesc'];
					$json_final['data']['estadoSlogan'] = "";
					$json_final['data']['show_opciones'] = 0;
					break;
				case ESTADO_ENTREGA_DESTINATARIO_APLAZA_ENTREGA:
					$json_final['data']['estadoDesc'] = $json_final['data']['estado_entrega'];
					$json_final['data']['estadoColor'] = $json_final['data']['colorDesc'];
					$json_final['data']['estadoSlogan'] = ''.lang('tracking.sft.fl1').''.$json_final['data']['fecha_entrega_cliente'].'</b><br/>'.lang('tracking.sft.fl2').'<b>'.$json_final['data']['franja_entregaDesc'].'</b>';
					break;
				case ESTADO_ENTREGA_DEVUELTO_A_REMITENTE:
					$json_final['data']['estadoDesc'] = $json_final['data']['estado_entrega'];
					$json_final['data']['estadoColor'] = $json_final['data']['colorDesc'];
					$json_final['data']['estadoSlogan'] = "";
					$json_final['data']['show_opciones'] = 0;
					break;
				case ESTADO_ENTREGA_ORIGEN_NO_PREPARADO:
					$json_final['data']['estadoDesc'] = $json_final['data']['estado_entrega'];
					$json_final['data']['estadoColor'] = $json_final['data']['colorDesc'];
					$json_final['data']['estadoSlogan'] = ''.lang('tracking.sft.fl1').'<b>'.$json_final['data']['fecha_entrega_cliente'].'</b><br/>'.lang('tracking.sft.fl2').'<b>'.$json_final['data']['franja_entregaDesc'].'</b>';
					break;
			}
		}else{
			
			switch($json_final['data']['cf_estado']){
				case ESTADO_PRECARGA_POR_RECOGER:
					$json_final['data']['estadoDesc'] = $json_final['data']['estado_entrega'];
					$json_final['data']['estadoColor'] = $json_final['data']['colorDesc'];
					$json_final['data']['estadoSlogan'] = ''.lang('tracking.sft.fl1').'<b>'.$json_final['data']['fecha_entrega_cliente'].'</b><br/>'.lang('tracking.sft.fl2').'<b>'.$json_final['data']['franja_entregaDesc'].'</b>';
					break;
				case ESTADO_PRECARGA_RECOGIDO:
					$json_final['data']['estadoDesc'] = $json_final['data']['estado_entrega'];
					$json_final['data']['estadoColor'] = $json_final['data']['colorDesc'];
					$json_final['data']['estadoSlogan'] = ''.lang('tracking.sft.fl1').'<b>'.$json_final['data']['fecha_entrega_cliente'].'</b><br/>'.lang('tracking.sft.fl2').'<b>'.$json_final['data']['franja_entregaDesc'].'</b>';
					break;
				case ESTADO_PRECARGA_EN_ALMACEN:
					$json_final['data']['estadoDesc'] = $json_final['data']['estado_entrega'];
					$json_final['data']['estadoColor'] = $json_final['data']['colorDesc'];
					$json_final['data']['estadoSlogan'] = ''.lang('tracking.sft.fl1').' <b>'.$json_final['data']['fecha_entrega_cliente'].'</b><br/>'.lang('tracking.sft.fl2').'<b>'.$json_final['data']['franja_entregaDesc'].'</b>';
					break;
				case ESTADO_PRECARGA_ALMACEN_ORIGEN:
					$json_final['data']['estadoDesc'] = $json_final['data']['estado_entrega'];
					$json_final['data']['estadoColor'] = $json_final['data']['colorDesc'];
					$json_final['data']['estadoSlogan'] = ''.lang('tracking.sft.fl1').'<b>'.$json_final['data']['fecha_entrega_cliente'].'</b><br/>'.lang('tracking.sft.fl2').'<b>'.$json_final['data']['franja_entregaDesc'].'</b>';
					break;
				case ESTADO_PRECARGA_ORIGEN_NO_PREPARADO:
					$json_final['data']['estadoDesc'] = $json_final['data']['estado_entrega'];
					$json_final['data']['estadoColor'] = $json_final['data']['colorDesc'];
					$json_final['data']['estadoSlogan'] = ''.lang('tracking.sft.fl1').'<b>'.$json_final['data']['fecha_entrega_cliente'].'</b><br/>'.lang('tracking.sft.fl2').'<b>'.$json_final['data']['franja_entregaDesc'].'</b>';
					break;
			}
		}
		if(($json_final['data']['cf_estado'] == ESTADO_PRECARGA_POR_RECOGER || $json_final['data']['cf_estado'] == ESTADO_ENTREGA_POR_RECOGER) && $json_final['data']['idioma'] == 2) {
			$json_final['data']['show_opciones'] = 0;
		}
		return $json_final;
	}

	public function setFranjaChange($smartphone = false){
		// Set optional params
		if($smartphone != false) $smartphone = true;
		
		// Mount params array
		$params = array(
				'username' 				=> $this->config->item('ws_login'),
				'password' 				=> $this->config->item('ws_passw'),
				"num_pedido"			=> $this->input->post("num_pedido"),
				"fecha_entrega"			=> $this->input->post("fecha_entrega"),
				"id_franja_entrega"		=> $this->input->post("id_franja_entrega"),
				"comentarios_cliente"	=> $this->input->post("comentarios_cliente"),
				"telefono"				=> $this->input->post("telefono"),
				"telefono2"				=> $this->input->post("telefono2"),
				"mail"					=> $this->input->post("email"),
				"ciudad"				=> $this->input->post("ciudad"),
				"tabla_origen"			=> $this->input->post("tabla_origen")
		);

		// Connect to the nusoap server
		$this->nusoap_client = new nusoap_client($this->config->item('ws_base_url'));

		if($this->nusoap_client->fault){
			$text = 'Error: '.$this->nusoap_client->fault;
			if($smartphone == false){
				echo json_encode(array(
						'status'=> 'KO',
						'msg' 	=> $text
				));
			}else{
				redirect('tracking/no_search_success');
				//echo $text;
			}
		}else{
			if ($this->nusoap_client->getError()){
				$text = 'Error: '.$this->nusoap_client->getError();
				if($smartphone == false){
					echo json_encode(array(
							'status'=> 'KO',
							'msg' 	=> $text
					));
				}else{
					redirect('tracking/no_search_success');
					//echo $text;
				}
			}else{
				$text = 'Connection OK';
				// Call the function to get data
				$row = $this->nusoap_client->call('changeFranja', $params);
				if($smartphone == false){
					// Mount params array
					$params2 = array(
							'username' 		=> $this->config->item('ws_login'),
							'password' 		=> $this->config->item('ws_passw'),
							'num_pedido' 	=> $this->input->post("num_pedido_original"),
							'telf_or_mail' 	=> $this->input->post("mail_or_telf")
					);
					// Call the function to get data
					$row2 = $this->nusoap_client->call('getDataFromTracking', $params2);
					//hay que parsear las fechas con que se pasan por el json
					$json_final = json_decode($row2, true);
					
					echo json_encode(array(
							'status'	=> 'OK',
							'msg' 		=> 'Cambios solicitados correctamente',
							'json_ch'	=> $json_final
					));
				}else{
					redirect('tracking/change_success/'.$params["fecha_entrega"].'/'.$params["id_franja_entrega"]);
				}
			}
		}
	}
	function change_success($fecha_entrega, $id_franja_entrega){
		$data['status'] = 1;
		$data['fecha_entrega_cliente'] = $fecha_entrega;
		$franja = "";
		switch($id_franja_entrega){
			case 1:
				$franja = lang('tracking.franja1');
			break;
			case 2:
				$franja = lang('tracking.franja2');
			break;
			case 3:
				$franja = lang('tracking.franja3');
			break;			
		}
		$data['franja'] = $franja;
					
		$this->load->view('tracking_smartphone3_view', $data);
	}
	function no_search_success(){
		$data['status'] = 0;
		$this->load->view('mobile/tracking_smartphone3_view', $data);
	}
}
/* End of file tracking.php */
/* Location: ./application/controllers/tracking.php */