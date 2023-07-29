<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct()
   	{
    	parent::__construct();
		$this->load->library('session');
   	}

   	private function _set_rules()
	{
		$this->form_validation->set_rules('email','email','trim|required|callback_check_auth');
	}


	public function index()
	{
		$this->_set_rules();
		if($this->form_validation->run()===FALSE){
			if(!validation_errors())
			{
				$this->load->view('contents/login_view');
			}
			else
			{
				echo json_encode(array('tipe'=>'warning', 'title'=>'Something wrong', 'message'=>strip_tags(validation_errors())));
			}


		}else{
			echo json_encode(array('action'=>'login','message'=>'Login success'));
		}
	}

	public function check_auth()
	{
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		if($email == '' || $password == ''){
			$this->form_validation->set_message('check_auth','Email and Password is required');
			return false;
		}

		$userdata = $this->db->select('id,fullname,password,expired_at')->where('email', $email)->or_where('phone', $email)->get('user')->row_array();
		if (!empty($userdata) && password_verify($password, $userdata['password'])) {
			// get store
			$store_id = $this->db->where('user_id', $userdata['id'])->get('user_store')->row()->store_id;
			$this->session->set_userdata('session_store', $store_id);
			$this->session->set_userdata('session_login', $userdata);
			// get role
			$module = $this->db->from('role_user a')
			->select('c.name')
			->where('id_user', $userdata['id'])
			->join('role_module b','a.id_role=b.id_role', 'left')
			->join('module c','c.id=b.id_module','left')
			->get()->result();

			$module = array_map(function($v){
				return $v->name;
			}, $module);
			
			$this->session->set_userdata('session_module', $module);
			return true;
		} else {
			$this->form_validation->set_message('check_auth','Login fail');
			return false;
		}
	}

	public function logout(){

		$this->session->unset_userdata('session_login');
		redirect('login');

	}
}