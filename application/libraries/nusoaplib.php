<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Nusoaplib{
	function Nusoaplib(){
	    require_once(str_replace("\\","/",APPPATH).'libraries/nusoap/nusoap.php');
	}
}
?>