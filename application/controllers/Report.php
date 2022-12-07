<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Report extends MY_Controller {

	private $limit = 15;
	private $table = 'item';

	function __construct()
   	{
    	parent::__construct();
   	}
	private function _filter()
	{
        $this->db->where('a.store_id', $this->session_store);
		$this->db->where('a.deleted_at', null);
        $start = $this->input->get('from');
        if(!empty($start)){
            $this->db->where('date >= ', $start);
        }
        $end = $this->input->get('to');
        if(!empty($end)){
            $this->db->where('date <= ', $end);
        }
	}
	public function index()
	{
		$this->_filter();
        $content_view['in'] = $this->db->where('type','IN')->get('trans a')->result(); 
		$this->_filter();
		$this->db->join('sell_d b', 'a.id=b.sell_id', 'left');
		$this->db->join('item c', 'b.item_id=c.id', 'left');
        $content_view['sell'] = $this->db->get('sell a')->result(); 
		$this->_filter();
		$this->db->join('buy_d b', 'a.id=b.buy_id', 'left');
		$this->db->join('item c', 'b.item_id=c.id', 'left');
        $content_view['buy'] = $this->db->get('buy a')->result(); 
		$this->_filter();
        $content_view['out'] = $this->db->where('type','OUT')->get('trans a')->result(); 
		$data['content'] 	= $this->load->view('contents/report_view', $content_view, TRUE);

		$this->load->view(!empty($this->input->get('popup'))?'modals/template_view':'template_view', $data);
	}
}
