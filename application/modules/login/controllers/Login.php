<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Login extends Parent_Controller {
  
 	public function __construct(){
 		parent::__construct();
 		$this->load->model('m_login');
 	}
	public function index(){
		$data['judul'] = $this->data['judul']; 
		$this->load->view('login/login_view',$data);
	}
	public function autentikasi(){
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$arr = array('username'=>$username,'password'=>$password,'token'=>"-Ll4Rzjl2sjT531Jh82x");
			$params = json_encode($arr,TRUE);
					 
			$curl = curl_init(); 
			curl_setopt_array($curl, array(
			CURLOPT_URL => "https://us-central1-colloqium-2c66a.cloudfunctions.net/api/v1/login",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => false,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POSTFIELDS =>$params,
			CURLOPT_HTTPHEADER => array(
			"Content-Type: application/json"
			),
			));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
		  echo "cURL Error #:" . $err;
		} else {
		  
		 	$parse = json_decode($response,TRUE);
		  	$user = $parse["response"]["account"]["username"];
		  	$fcm_token = $parse["response"]["account"]["fcm_token"];
		  	$api_token = $parse["response"]["api_token"];
			$this->session->set_userdata(array('username'=>$user,'fcm_token'=>$fcm_token,"api_token"=>$api_token));
			redirect(base_url('dashboard')); 
		  //debugVar($parse);
		 
			//echo $response;
		/*
			session_start();
			$_SESSION['budi'] = "-Ll4Rzjl2sjT531Jh82x";
			$_SESSION['token'] = "-Ll4Rzjl2sjT531Jh82x";
			header('location:index.php');
			*/
		} 

	}

	public function logout(){
		$this->session->sess_destroy();
		echo "<script language=javascript>
             alert('Anda telah keluar dari ".$this->data['judul']." ');
             window.location='" . base_url('login') . "';
             </script>";
		 
	}
}
