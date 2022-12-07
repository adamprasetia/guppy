<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Stock extends MY_Controller {

	private $limit = 15;
	private $table = 'item';

	function __construct()
   	{
    	parent::__construct();
   	}
	private function _filter()
	{
        $this->db->where('store_id', $this->session_store);
		$this->db->where('deleted_at', null);
		$search = $this->input->get('search');
		if ($search) {
			$this->db->group_start();
			$this->db->like('name', $search);
			$this->db->or_like('sku', $search);
			$this->db->group_end();
		}
	}
	public function index()
	{
		$offset = gen_offset($this->limit);
		$this->_filter();
		$total = $this->db->count_all_results($this->table);
		$this->_filter();
		$content_view['data'] 	= $this->db->get($this->table, $this->limit, $offset)->result();
		$content_view['offset'] = $offset;
		$content_view['paging'] = gen_paging($total,$this->limit);
		$content_view['total'] 	= gen_total($total,$this->limit,$offset);
		$data['content'] 	= $this->load->view('contents/stock_view', $content_view, TRUE);

		$this->load->view(!empty($this->input->get('popup'))?'modals/template_view':'template_view', $data);
	}

}
