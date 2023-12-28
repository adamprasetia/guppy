<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Register extends CI_Controller {

	function __construct()
   	{
    	parent::__construct();
		$this->config->set_item('language', 'indo'); 

   	}

   	private function _set_rules()
	{
		$this->form_validation->set_rules('fullname','Nama Lengkap','trim|required');
		$this->form_validation->set_rules('email','Email','trim|required|is_unique[user.email]');
		$this->form_validation->set_rules('phone','Telepon','trim|required|is_unique[user.phone]');
		$this->form_validation->set_rules('password','Password','trim|required');
		$this->form_validation->set_rules('password2','Ulangi Password','trim|required|matches[password]');
		$this->form_validation->set_rules('store','Nama Toko','trim|required');
		$this->form_validation->set_message('is_unique','{field} sudah terdaftar sebelumnya, silakan gunakan {field} yang lain');
	}


	public function index()
	{
		$this->_set_rules();
		if($this->form_validation->run()===FALSE){
			if(!validation_errors())
			{
				$this->load->view('contents/register_view');
			}
			else
			{
				echo json_encode(array('tipe'=>'warning', 'title'=>'Terjadi Kesalahan!', 'message'=>strip_tags(validation_errors())));
			}
		}else{
			$fullname 		= $this->input->post('fullname');
			$email 			= $this->input->post('email');
			$phone 			= $this->input->post('phone');
			$password 		= $this->input->post('password');
			$store 			= $this->input->post('store');
	
			$data = array(
				'fullname' => $fullname,
				'email' => $email,
				'phone' => $phone,
				'created_at' => date('Y-m-d H:i:s'),
				'expired_at' => date('Y-m-d', strtotime("+1 months"))
			);
			if(!empty($password)){
				$data['password'] = password_hash($password, PASSWORD_BCRYPT);
			}
	
			$this->db->trans_start();
			$this->db->insert('user', $data);
			$error = $this->db->error();	
			$user_id = $this->db->insert_id();

			$this->db->insert('store', [
				'name'=>$store,
				'created_by'=>$user_id,
				'created_at'=>date('Y-m-d H:i:s'),
			]);
			$error = $this->db->error();	
			$store_id = $this->db->insert_id();

			$this->db->insert('user_store', ['user_id'=>$user_id, 'store_id'=>$store_id]);
			$this->db->trans_complete();
			if($this->db->trans_status() === FALSE){
				$response = array('tipe'=>'warning', 'title'=>'Terjadi Kesalahan!', 'message'=>$error['message']);
			}else{
				$response = array('action'=>'register','message'=>'Registration success!');
			}

			echo json_encode($response);
		}
	}
}