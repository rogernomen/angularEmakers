<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Utils extends CI_Model{
	
	// ************************************************************************** //
	// UTILS - Funcions auxiliars
	// ************************************************************************** //
	
	// Funcion que extrae el ultimo ID2 disponible para una tabla concreta
	function _getLastID($tabla){
		$id = 1;
		$query = $this->db->query('SELECT MAX(id2) AS lastid FROM '.$tabla);
		if($query->num_rows() > 0){
			$fila = $query->row();
			$id = intval($fila->lastid) + 1;
		}
		$query->free_result();
		return $id;
	}
	
	// pasa el formato fecha Y-m-d H:i:s a Y-m-d
	function getDateFromDatetime ($date) {
		if($date == null){
			return '';
		}
		$tab = explode (" ", $date);
		return $tab[0];
	}
	// pasa el formato fecha Y-m-d H:i:s a H:i:s
	function getTimeFromDatetime ($date) {
		if($date == null){
			return '';
		}
		$tab = explode (" ", $date);
		return $tab[1];
	}
	//pasa el formato fecha de Y-m-d a d/m/Y
	function codeDate ($date) {
		if($date == null || $date == ""){
			return '';
		}
		$tab = explode ("-", $date);
		$r = $tab[2]."/".$tab[1]."/".$tab[0];
		return $r;
	}
	//pasa el formato fecha de  d/m/Y a Y-m-d
	function decodeDate ($date) {
		if($date == null || $date == ""){
			return '';
		}
		$tab = explode ("/", $date);
		$r = $tab[2]."-".$tab[1]."-".$tab[0];
		return $r;
	}
	
	//pasa el formato time de H:i:s a H:i
	function codeTime ($time) {
		if($time == null || $time == ""){
			return '';
		}
		$tab = explode (":", $time);
		$r = $tab[0].":".$tab[1];
		return $r;
	}
	//pasa el formato time de h:m a h:m:s
	function decodeTime ($time) {
		if($date == null || $date == "" || $date == "NULL"){
			return '';
		}
		$tab = explode (":", $time);
		$r = $tab[0].":".$tab[1].":00";
		return $r;
	}
	// pasa el formato 0000-00-00 00:00:00 a 00/00/0000 00:00:00
	function codeDatetime($date){
		if($date == null || $date == "" || $date == "NULL"){
			return '';
		}
		$tab = explode (" ", $date);
		$tab2 = explode ("-", $tab[0]);
		$r = $tab2[2]."/".$tab2[1]."/".$tab2[0]." ".$tab[1];
		return $r;
	}
}

/* End of file utils.php */
/* Location: ./application/models/utils.php */