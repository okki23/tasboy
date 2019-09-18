<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class M_get_peoples extends Parent_Model { 
 
   
	  
	public function __construct(){
        parent::__construct();
        $this->load->database();
	}
 
	public function autentikasi($username,$password){
        $sql = $this->db->get_where($this->nama_tabel,array('username'=>$username,'password'=>$password));
		return $sql;
	}
 
 
}
