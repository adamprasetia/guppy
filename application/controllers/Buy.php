<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Buy extends MY_Controller {

	private $limit = 15;
	private $table = 'buy';

	function __construct()
   	{
    	parent::__construct();
   	}
	private function _filter()
	{
		$this->db->select('buy.*, sum(buy_d.qty*buy_d.amount) as total, item.sku as item_sku, item.name as item_name');
		$this->db->join('buy_d', 'buy.id=buy_d.buy_id', 'left');
		$this->db->join('item', 'item.id=buy_d.item_id', 'left');
		$this->db->group_by('buy.id');
        $this->db->where('buy.store_id', $this->session_store);
		$this->db->where('buy.deleted_at', null);
		$search = $this->input->get('search');
		if ($search) {
			$this->db->group_start();
			$this->db->like('item.name', $search);
			$this->db->or_like('item.sku', $search);
			$this->db->or_like('buy.nomor', $search);
			$this->db->group_end();
		}
		$this->db->order_by('buy.id desc');
		$from = $this->input->get('from');
		$to = $this->input->get('to');
		if(!empty($from) && !empty($to)){
			$this->db->where('date >= ', $from);
			$this->db->where('date <= ', $to);
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
		$data['content'] 	= $this->load->view('contents/buy_view', $content_view, TRUE);

		$this->load->view(!empty($this->input->get('popup'))?'modals/template_view':'template_view', $data);
	}

	private function _set_rules()
	{
		$this->form_validation->set_rules('date', 'Tanggal', 'trim|required');
		$this->form_validation->set_rules('remark', 'Keterangan', 'trim');
		$this->form_validation->set_rules('nomor', 'Nomor', 'trim');
	}
	
	private function _set_data($action = 'add')
	{
		$date		= $this->input->post('date');
		$remark		= $this->input->post('remark');
		$nomor		= $this->input->post('nomor');

		$data = array(
			'date' => format_ymd($date),
			'remark' => $remark,
			'nomor' => $nomor,
            'store_id' => $this->session_store,
		);

		if($action == 'add'){
			$data['created_by'] = $this->session_login['id'];
			$data['created_at'] = date('Y-m-d H:i:s');
		}
		else if($action == 'edit'){
			$data['modified_by'] = $this->session_login['id'];
			$data['modified_at'] = date('Y-m-d H:i:s');
		}
		else if($action == 'delete'){
			$data = [
				'modified_by' => $this->session_login['id'],
				'deleted_at' => date('Y-m-d H:i:s')
			];
		}

		return $data;
	}
	public function add()
	{
		$this->_set_rules();
		if ($this->form_validation->run()===FALSE) {
			$data['script'] = $this->load->view('script/buy_script', '', true);
			$data['content'] = $this->load->view('contents/form_buy_view', [
				'action'=>base_url('buy/add').get_query_string()
			],true);

			if(!validation_errors())
			{
				$this->load->view('template_view',$data);
			}
			else
			{
				echo json_encode(array('tipe'=>'warning', 'title'=>'Terjadi Kesalahan!', 'message'=>strip_tags(validation_errors())));
			}

		}else{
			$this->db->trans_start();
			$data = $this->_set_data();
			$detail = json_decode($this->input->post('detail'), true);
			$this->db->insert($this->table, $data);
			$buy_id = $this->db->insert_id();
			foreach ($detail as $key => $value) {
				$this->db->insert('buy_d', [
					'buy_id'=>$buy_id,
					'item_id'=>$value['item_id'],
					'qty'=>$value['qty'],
					'amount'=>$value['amount']
				]);
				$this->db->where('id', $value['item_id']);
				$this->db->set('stock', 'stock+'.$value['qty'], false);
				$this->db->update('item');
			}
			$this->db->trans_complete();
			$error = $this->db->error();
			if(empty($error['message'])){
				$response = array('id'=>$this->db->insert_id(), 'action'=>'insert', 'message'=>'Data berhasil disimpan');
			}else{
				$response = array('tipe'=>'warning', 'title'=>'Terjadi Kesalahan!', 'message'=>$error['message']);
			}

			echo json_encode($response);
		}
	}

	public function edit($id='')
	{
		$this->_set_rules();
		if ($this->form_validation->run()===FALSE) {
			$this->db->where('buy.id', $id);
			$content_view['data'] = $this->db->get($this->table)->row();
			$content_view['detail'] = $this->db->where('buy_id', $id)->join('item','item.id=buy_d.item_id','left')->get('buy_d')->result();
			$content_view['action'] = base_url('buy/edit/'.$id).get_query_string();
			$data['script'] = $this->load->view('script/buy_script', '', true);
			$data['content'] = $this->load->view('contents/form_buy_view',$content_view,true);

			if(!validation_errors())
			{
				$this->load->view('template_view',$data);
			}
			else
			{
				echo json_encode(array('tipe'=>'error', 'title'=>'Something wrong', 'message'=>strip_tags(validation_errors())));
			}

		}else{
			$this->db->trans_start();
			$data = $this->_set_data('edit');
			$detail = json_decode($this->input->post('detail'), true);

			$buy = $this->db->where('id', $id)->get('buy')->row();
			$this->db->update($this->table, $data, ['id'=>$id]);
			
			// rollback stock
			$buy = $this->db->where('buy_id', $id)->get('buy_d')->result();
			foreach ($buy as $key => $value) {
				$this->db->where('id', $value->item_id);
				$this->db->set('stock', 'stock-'.$value->qty, false);
				$this->db->update('item');
			}
			$this->db->delete('buy_d', ['buy_id'=>$id]);
			foreach ($detail as $key => $value) {
				$this->db->insert('buy_d', [
					'buy_id'=>$id,
					'item_id'=>$value['item_id'],
					'qty'=>$value['qty'],
					'amount'=>$value['amount']
				]);
				$this->db->where('id', $value['item_id']);
				$this->db->set('stock', 'stock+'.$value['qty'], false);
				$this->db->update('item');
			}

			$this->db->trans_complete();
			$error = $this->db->error();
			if(empty($error['message'])){
				$response = array('id'=>$id, 'action'=>'update', 'message'=>'Data berhasil disimpan');
			}else{
				$response = array('tipe'=>'warning', 'title'=>'Terjadi Kesalahan!', 'message'=>$error['message']);
			}

			echo json_encode($response);
		}
	}

	public function delete($id = '')
	{
		if ($id) {
			$this->db->trans_start();
			$data = $this->_set_data('delete');

			// rollback stock
			$buy = $this->db->where('buy_id', $id)->get('buy_d')->result();
			foreach ($buy as $key => $value) {
				$this->db->where('id', $value->item_id);
				$this->db->set('stock', 'stock-'.$value->qty, false);
				$this->db->update('item');
			}
			$this->db->update($this->table, $data, ['id'=>$id]);
            
			// clear
			$this->db->delete('buy_d', ['buy_id'=>$id]);
						
            $this->db->trans_complete();

			$error = $this->db->error();
			if(empty($error['message'])){
				$response = array('id'=>$id, 'action'=>'delete', 'message'=>'Data berhasil dihapus');
			}else{
				$response = array('tipe'=>'warning', 'title'=>'Terjadi Kesalahan!', 'message'=>$error['message']);
			}
			echo json_encode($response);
		}
	}

}
