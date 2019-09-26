<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Get_peoples extends Parent_Controller {
  
 	public function __construct(){
 		parent::__construct();
 		$this->load->model('m_get_peoples');
 	}
	
	public function fetch_people(){
			$arr = array('anhar'=>'anak_soleh');
			$params = json_encode($arr,TRUE);
					 
			$curl = curl_init(); 
			curl_setopt_array($curl, array(
			CURLOPT_URL => "https://us-central1-colloqium-2c66a.cloudfunctions.net/api/v1/get_peoples",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => false,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POSTFIELDS =>$params,
			CURLOPT_HTTPHEADER => array(
			"Content-Type: application/json",
			"Authorization: Bearer ".$this->session->userdata('api_token')
			),
			));

		$response = curl_exec($curl);
		$err = curl_error($curl); 
		curl_close($curl); 
		if ($err) {
		  echo "cURL Error #:" . $err;
		} else {
			$parse = json_decode($response,TRUE); 
		  	$data = array();   
           	foreach($parse['response'] as $key=>$val)
           	{  
                $sub_array = array();   
                $sub_array[] = $val['account_id'];
				$sub_array[] = $val['email'];
				$sub_array[] = $val['name']; 
                $sub_array[] = '
				   <div class="dropdown">
                    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Opsi
                    <span class="caret"></span></button>
                    <ul class="dropdown-menu">
                  
                      <li><a href="javascript:void(0)" onclick="GetUserRooms(\''.$val['account_id'].' \');"> <i class="material-icons">dns</i> Get User Rooms </a></li>
					  <li><a href="javascript:void(0)" onclick="GetCreatedRooms(\' '.$val['account_id'].' \');"> <i class="material-icons">dns</i>  Get Created Rooms</a></li>
                       
                    </ul>
                    </div> ';  
                $data[] = $sub_array;  
          	}   
      		echo json_encode(array("data"=>$data));
        
		} 
	}
	
	public function index(){    
		$data['judul'] = $this->data['judul']; 
  		$data['konten'] = 'get_peoples/get_peoples_view';
  		$this->load->view('template_view',$data);		
      
		
	}
	
	function clean($string) {
	   $string = str_replace(' ', '', $string); // Replaces all spaces with hyphens. 
	   return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
	}

	public function listing(){
		$arr = array('anhar'=>'anak_soleh');
		$params = json_encode($arr,TRUE);
				 
		$curl = curl_init(); 
		curl_setopt_array($curl, array(
		CURLOPT_URL => "https://us-central1-colloqium-2c66a.cloudfunctions.net/api/v1/get_peoples",
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => false,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "POST",
		CURLOPT_POSTFIELDS =>$params,
		CURLOPT_HTTPHEADER => array(
		"Content-Type: application/json",
		"Authorization: Bearer ".$this->session->userdata('api_token')
		),
		));

	$response = curl_exec($curl);
	$err = curl_error($curl); 
	curl_close($curl); 
	if ($err) {
	  echo "cURL Error #:" . $err;
	} else {
		$parse = json_decode($response,TRUE); 
		  $data = array();   
		   foreach($parse['response'] as $key=>$val)
		   {  
			$sub_array = array();   
			$sub_array[] = $val['account_id'];
			$sub_array[] = $val['email'];
			$sub_array[] = $val['name']; 
			$sub_array[] = '
			   <div class="dropdown">
				<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Opsi
				<span class="caret"></span></button>
				<ul class="dropdown-menu">
			  
				  <li><a href="javascript:void(0)" onclick="GetUserRooms(\''.$val['account_id'].' \');"> <i class="material-icons">dns</i> Get User Rooms </a></li>
				  <li><a href="javascript:void(0)" onclick="GetCreatedRooms(\' '.$val['account_id'].' \');"> <i class="material-icons">dns</i>  Get Created Rooms</a></li>
				   
				</ul>
				</div> ';  
			$data[] = $sub_array;  
		  }   
		  echo json_encode(array($data));
	
	} 
	}
	 
	public function fetch_user_room(){  
		$arr = array('account_id'=>$this->input->post('rep')); 
		$params = json_encode($this->clean($arr)); 

		$curl = curl_init(); 
			curl_setopt_array($curl, array(
			CURLOPT_URL => "https://us-central1-colloqium-2c66a.cloudfunctions.net/api/v1/get_user_rooms",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => false,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POSTFIELDS =>$params,
			CURLOPT_HTTPHEADER => array(
			"Content-Type: application/json",
			"Authorization: Bearer ".$this->session->userdata('api_token')
			),
			));

		$response = curl_exec($curl);
		$err = curl_error($curl); 
		curl_close($curl); 
		if ($err) {
			echo "cURL Error #:" . $err;
		} else {
			 $parse = json_decode($response,TRUE); 
			 $return_arr = array();
			foreach($parse['response'] as $k => $v){
				if(isset($v['agenda_list'])){
					//echo $v['name'] ." - ". $v['id']."<br>"; 
					// foreach($v['agenda_list'] as $y=>$u){
						$row_array['name'] =  $v['name'];
						$row_array['id'] =  $v['id']; 
						$row_array['opsi'] = '
						<div class="dropdown">
						 <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Opsi
						 <span class="caret"></span></button>
						 <ul class="dropdown-menu">
					   
						   <li><a href="javascript:void(0)" onclick="GetAgenda(\''.$v['id'].' \');"> <i class="material-icons">dns</i> Get Agenda </a></li>
						     	
						 </ul>
						 </div> ';  
					 	array_push($return_arr,$row_array);
					// } 
				} 
			}
			echo json_encode($return_arr);
		} 
	  
   
	 }  

	 public function fetch_agenda(){  
		$arr = array('room_id'=>$this->input->post('rep')); 
		$params = json_encode($this->clean($arr)); 

		$curl = curl_init(); 
			curl_setopt_array($curl, array(
			CURLOPT_URL => "https://us-central1-colloqium-2c66a.cloudfunctions.net/api/v1/get_room_detail",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => false,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POSTFIELDS =>$params,
			CURLOPT_HTTPHEADER => array(
			"Content-Type: application/json",
			"Authorization: Bearer ".$this->session->userdata('api_token')
			),
			));

		$response = curl_exec($curl);
		$err = curl_error($curl); 
		curl_close($curl); 
		if ($err) {
			echo "cURL Error #:" . $err;
		} else {
			$parse = json_decode($response,TRUE); 
			$return_arr = array();
			//  var_dump($parse['response']['agenda_list']);
			foreach($parse['response']['agenda_list'] as $k => $v){
				$row_array['name'] =  $v['name'];
				array_push($return_arr,$row_array);	 
			}
			echo json_encode($return_arr);
		} 
	  
   
	 }  

}
