<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rating extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/rating
	 *	- or -  
	 * 		http://example.com/index.php/rating/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
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
	}
	
	public function index($hash_rating = '', $starcount = 0)
	{
		// Control de datos recibidos
		if($starcount < 1 || $starcount > 5) $starcount = 0;	
		if(trim($hash_rating) == '' || trim($hash_rating) == '%20' || $starcount == 0){
			redirect('inicio', 'refresh');
		}
		$data = array();
		
		// Mount params array
		$params = array(
			'hash_rating' 	=> $hash_rating,
			'rating'		=> ''.$starcount,
			'username' 		=> $this->config->item('ws_login'),
			'password' 		=> $this->config->item('ws_passw')
		);
		// Connect to the nusoap server
		$this->nusoap_client = new nusoap_client($this->config->item('ws_base_url'));
		
		if($this->nusoap_client->fault){
			redirect('inicio', 'refresh');
		
		}else{
			if($this->nusoap_client->getError()){
				redirect('inicio', 'refresh');
			}else{
				// Call the function to get data
				$row = $this->nusoap_client->call('saveRating', $params);
				
				// Get response
				$json_final = json_decode($row,true);
				
				if(is_null($json_final) || $json_final["status"] == "KO" || $row == false){
					redirect('inicio', 'refresh');
					
				}else{
					$data['starcount'] = $starcount;
					$data['hash_rating'] = $hash_rating;
					$data['id_rating'] = $json_final["id_rating"];
					$this->load->view('rating',$data);
				}
			}
		}
	}
	
	public function saveRatingcomments(){
		// Recieve POST data
		$hash_rating 					= $this->input->post('hash_rating', TRUE);
		$id_rating 						= $this->input->post('id_rating', TRUE);
		$rating_value 					= $this->input->post('rating_value', TRUE);
		$input_comentarios_sugerencias	= $this->input->post('input_comentarios_sugerencias', TRUE);
		
		// Mount params array
		$params = array(
			'hash_rating' 					=> $hash_rating,
			'rating'						=> ''.$rating_value,
			'id_rating' 					=> $id_rating,
			'input_comentarios_sugerencias'	=> $input_comentarios_sugerencias,
			'username' 						=> $this->config->item('ws_login'),
			'password' 						=> $this->config->item('ws_passw')
		);
		
		// Connect to the nusoap server
		$this->nusoap_client = new nusoap_client($this->config->item('ws_base_url'));
		
		if($this->nusoap_client->fault){
			echo '{success:false}';
		
		}else{
			if($this->nusoap_client->getError()){
				echo '{success:false}';
			}else{
				// Call the function to get data
				$row = $this->nusoap_client->call('saveRatingComments', $params);
				
				// Get response
				$json_final = json_decode($row,true);
				
				if(is_null($json_final) || $json_final["status"] == "KO" || $row == false){
					echo '{success:false}';
					
				}else{
					echo '{success:true}';
				}
			}
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/rating.php */