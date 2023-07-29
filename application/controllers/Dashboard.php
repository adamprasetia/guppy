<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends MY_Controller {

	function __construct()
   	{
    	parent::__construct();
   	}

	public function index()
	{

		$content['store'] = $this->db->where('a.user_id', $this->session_login['id'])
		->join('store b','b.id=a.store_id')->get('user_store a')->result();
		$content['total_sell'] = $this->db->where('deleted_at', null)->where('store_id', $this->session_store)->count_all_results('sell');
		$content['total_in'] = $this->db->where('deleted_at', null)->where('type', 'IN')->where('store_id', $this->session_store)->count_all_results('trans');
		$content['total_out'] = $this->db->where('deleted_at', null)->where('type', 'OUT')->where('store_id', $this->session_store)->count_all_results('trans');
		$content['total_item'] = $this->db->where('deleted_at', null)->where('store_id', $this->session_store)->count_all_results('item');
		$data['content'] = $this->load->view('contents/dashboard_view', $content, TRUE);
		$data['script'] = $this->load->view('contents/dashboard_script', '', TRUE);
		$this->load->view('template_view', $data);
	}

	public function switch_store($store_id)
	{
		$this->session->set_userdata('session_store', $store_id);
		redirect();
	}

}
