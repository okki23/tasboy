<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class M_dashboard extends Parent_Model { 
   
	  
  public function __construct(){
        parent::__construct();
        $this->load->database();
  }
 
 
}
