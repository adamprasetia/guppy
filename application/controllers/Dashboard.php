<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends MY_Controller {

	function __construct()
   	{
    	parent::__construct();
   	}

	public function index()
	{
		$content['total_sell'] = $this->db->where('store_id', $this->session_store)->count_all_results('sell');
		$content['total_in'] = $this->db->where('type', 'IN')->where('store_id', $this->session_store)->count_all_results('trans');
		$content['total_out'] = $this->db->where('type', 'OUT')->where('store_id', $this->session_store)->count_all_results('trans');
		$content['total_item'] = $this->db->where('store_id', $this->session_store)->count_all_results('item');
		$data['content'] = $this->load->view('contents/dashboard_view', $content, TRUE);
		$this->load->view('template_view', $data);
	}

}
