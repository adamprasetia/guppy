<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Store extends MY_Controller {

	private $limit = 15;
	private $table = 'store';

	function __construct()
   	{
    	parent::__construct();
   	}
	private function _filter()
	{
        $this->db->join('user_store','store.id=user_store.user_id', 'left');
        $this->db->where('user_id', $this->session_login['id']);
		$search = $this->input->get('search');
		if ($search) {
			$this->db->like('name', $search);
		}
	}
	public function index()
	{
		$offset = gen_offset($this->limit);
		$this->_filter();
		$total = $this->db->count_all_results($this->table);
		$this->_filter();
		$store_view['data'] 	= $this->db->get($this->table, $this->limit, $offset)->result();
		$store_view['offset'] = $offset;
		$store_view['paging'] = gen_paging($total,$this->limit);
		$store_view['total'] 	= gen_total($total,$this->limit,$offset);
		$data['content'] 	= $this->load->view('contents/store_view', $store_view, TRUE);

		$this->load->view('template_view', $data);
	}

	private function _set_rules()
	{
		$this->form_validation->set_rules('name', 'Nama Toko', 'trim|required');
	}
	
	private function _set_data($type = 'add')
	{
		$name 		= $this->input->post('name');

		$data = array(
			'name' => $name,
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
			$data['content'] = $this->load->view('contents/form_store_view', [
				'action'=>base_url('store/add').get_query_string()
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
			$store_view['data'] = $this->db->get($this->table)->row();
			$store_view['action'] = base_url('store/edit/'.$id).get_query_string();
			$data['content'] = $this->load->view('contents/form_store_view',$store_view,true);

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

}
