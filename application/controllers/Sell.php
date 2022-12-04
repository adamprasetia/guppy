<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sell extends MY_Controller {

	private $limit = 15;
	private $table = 'sell';

	function __construct()
   	{
    	parent::__construct();
   	}
	private function _filter()
	{
		$this->db->select('sell.*, sum(sell_d.qty*sell_d.amount) as total, item.sku as item_sku, item.name as item_name');
		$this->db->join('sell_d', 'sell.id=sell_d.sell_id', 'left');
		$this->db->join('item', 'item.id=sell_d.item_id', 'left');
		$this->db->group_by('sell.id');
        $this->db->where('sell.store_id', $this->session_store);
		$this->db->where('sell.deleted_at', null);
		$search = $this->input->get('search');
		if ($search) {
			$this->db->group_start();
			$this->db->like('item.name', $search);
			$this->db->or_like('item.sku', $search);
			$this->db->group_end();
		}
		$this->db->order_by('sell.id desc');
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
		$data['content'] 	= $this->load->view('contents/sell_view', $content_view, TRUE);

		$this->load->view(!empty($this->input->get('popup'))?'modals/template_view':'template_view', $data);
	}

	private function _set_rules()
	{
		$this->form_validation->set_rules('date', 'Tanggal', 'trim|required');
		$this->form_validation->set_rules('remark', 'Keterangan', 'trim');
	}
	
	private function _set_data($action = 'add')
	{
		$date		= $this->input->post('date');
		$remark		= $this->input->post('remark');

		$data = array(
			'date' => format_ymd($date),
			'remark' => $remark,
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
			$data['script'] = $this->load->view('script/sell_script', '', true);
			$data['content'] = $this->load->view('contents/form_sell_view', [
				'action'=>base_url('sell/add').get_query_string()
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
			$detail_item = $this->input->post('detail-id');
			$detail_qty = $this->input->post('detail-qty');
			$detail_amount = $this->input->post('detail-amount');
			$this->db->insert($this->table, $data);
			$sell_id = $this->db->insert_id();

			for ($i=0; $i < count($detail_item); $i++) { 
				$this->db->insert('sell_d', [
					'sell_id'=>$sell_id,
					'item_id'=>$detail_item[$i],
					'qty'=>format_uang($detail_qty[$i]),
					'amount'=>format_uang($detail_amount[$i]),
				]);
				$this->db->where('id', $detail_item[$i]);
				$this->db->set('stock', 'stock-'.format_uang($detail_qty[$i]), false);
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
			$this->db->where('sell.id', $id);
			$content_view['data'] = $this->db->get($this->table)->row();
			$content_view['detail'] = $this->db->where('sell_id', $id)->join('item','item.id=sell_d.item_id','left')->get('sell_d')->result();
			$content_view['action'] = base_url('sell/edit/'.$id).get_query_string();
			$data['script'] = $this->load->view('script/sell_script', '', true);
			$data['content'] = $this->load->view('contents/form_sell_view',$content_view,true);

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
			$detail_item = $this->input->post('detail-id');
			$detail_qty = $this->input->post('detail-qty');
			$detail_amount = $this->input->post('detail-amount');

			$sell = $this->db->where('id', $id)->get('sell')->row();
			$this->db->update($this->table, $data, ['id'=>$id]);
			
			// rollback stock
			$sell = $this->db->where('sell_id', $id)->get('sell_d')->result();
			foreach ($sell as $key => $value) {
				$this->db->where('id', $value->item_id);
				$this->db->set('stock', 'stock+'.$value->qty, false);
				$this->db->update('item');
			}
			$this->db->delete('sell_d', ['sell_id'=>$id]);
			if(!empty($detail_item)){
				for ($i=0; $i < count($detail_item); $i++) { 
					$this->db->insert('sell_d', [
						'sell_id'=>$id,
						'item_id'=>$detail_item[$i],
						'qty'=>format_uang($detail_qty[$i]),
						'amount'=>format_uang($detail_amount[$i]),
					]);
					$this->db->where('id', $detail_item[$i]);
					$this->db->set('stock', 'stock-'.format_uang($detail_qty[$i]), false);
					$this->db->update('item');
				}
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
			$sell = $this->db->where('sell_id', $id)->get('sell_d')->result();
			foreach ($sell as $key => $value) {
				$this->db->where('id', $value->item_id);
				$this->db->set('stock', 'stock+'.$value->qty, false);
				$this->db->update('item');
			}
			$this->db->update($this->table, $data, ['id'=>$id]);
            
			// clear
			$this->db->delete('sell_d', ['sell_id'=>$id]);
						
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
