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
        $start = $this->input->get('start');
        if(!empty($start)){
            $this->db->where('tanggal >= ', $start);
        }
        $end = $this->input->get('end');
        if(!empty($end)){
            $this->db->where('tanggal <= ', $end);
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
		// dd($content_view['sell']);
		$this->_filter();
        $content_view['out'] = $this->db->where('type','OUT')->get('trans a')->result(); 
		$data['content'] 	= $this->load->view('contents/report_view', $content_view, TRUE);

		$this->load->view(!empty($this->input->get('popup'))?'modals/template_view':'template_view', $data);
	}

	private function _set_rules()
	{
		$this->form_validation->set_rules('name', 'Nama Produk', 'trim|required');
		$this->form_validation->set_rules('sku', 'Kode Produk', 'trim|required');
		$this->form_validation->set_rules('bp', 'Harga Beli', 'trim');
		$this->form_validation->set_rules('sp', 'Harga Jual', 'trim');
	}
	
	private function _set_data($type = 'add')
	{
		$name		= $this->input->post('name');
		$sku		= $this->input->post('sku');
		$bp		= $this->input->post('bp');
		$sp		= $this->input->post('sp');

		$data = array(
			'name' => $name,
			'sku' => $sku,
			'bp' => format_uang($bp),
			'sp' => format_uang($sp),
            'store_id' => $this->session_store,
		);

		if($type == 'add'){
			$data['created_by'] = $this->session_login['id'];
			$data['created_at'] = date('Y-m-d H:i:s');
		}
		else if($type == 'edit'){
			$data['modified_by'] = $this->session_login['id'];
			$data['modified_at'] = date('Y-m-d H:i:s');
		}
		else if($type == 'delete'){
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
			$data['content'] = $this->load->view('contents/form_item_view', [
				'action'=>base_url('item/add').get_query_string()
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
			$data = $this->_set_data();
			$this->db->insert($this->table, $data);
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
			$this->db->where('id', $id);
			$content_view['data'] = $this->db->get($this->table)->row();
            $content_view['data']->bp = number_format($content_view['data']->bp);
            $content_view['data']->sp = number_format($content_view['data']->sp);
			$content_view['action'] = base_url('item/edit/'.$id).get_query_string();
			$data['content'] = $this->load->view('contents/form_item_view',$content_view,true);

			if(!validation_errors())
			{
				$this->load->view('template_view',$data);
			}
			else
			{
				echo json_encode(array('tipe'=>'error', 'title'=>'Something wrong', 'message'=>strip_tags(validation_errors())));
			}

		}else{
			$data = $this->_set_data('edit');
			$this->db->update($this->table, $data, ['id'=>$id]);
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
			$data = $this->_set_data('delete');
			$this->db->update($this->table, $data,['id'=>$id]);
			$error = $this->db->error();
			if(empty($error['message'])){
				$response = array('id'=>$id, 'action'=>'delete', 'message'=>'Data berhasil dihapus');
			}else{
				$response = array('tipe'=>'warning', 'title'=>'Terjadi Kesalahan!', 'message'=>$error['message']);
			}
			echo json_encode($response);
		}
	}

	public function find()
	{
		$search = $this->input->get('search');
		$this->db->where('sku', $search);
		$data = $this->db->get('item')->row();
		echo json_encode($data);
	}

}
