<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Trans extends MY_Controller {

	private $limit = 15;
	private $table = 'trans';

	function __construct()
   	{
    	parent::__construct();
   	}
	private function _filter()
	{
        $this->db->where('trans.store_id', $this->session_store);
		$this->db->where('trans.deleted_at', null);
		$search = $this->input->get('search');
		if ($search) {
			$this->db->group_start();
			$this->db->like('trans.remark', $search);
			$this->db->group_end();
		}
		$this->db->order_by('trans.id desc');
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
		$data['content'] 	= $this->load->view('contents/trans_view', $content_view, TRUE);

		$this->load->view(!empty($this->input->get('popup'))?'modals/template_view':'template_view', $data);
	}

	private function _set_rules()
	{
		$this->form_validation->set_rules('type', 'Tipe', 'trim|required');
		$this->form_validation->set_rules('date', 'Tanggal', 'trim|required');
		$this->form_validation->set_rules('value', 'Nilai', 'trim|required');
		$this->form_validation->set_rules('remark', 'Keterangan', 'trim');
	}
	
	private function _set_data($action = 'add')
	{
		$type		= $this->input->post('type');
		$date		= $this->input->post('date');
		$value		= $this->input->post('value');
		$remark		= $this->input->post('remark');

		$data = array(
			'type' => $type,
			'remark' => $remark,
			'date' => format_ymd($date),
			'value' => format_uang($value),
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
			$data['script'] = $this->load->view('script/trans_script', '', true);
			$data['content'] = $this->load->view('contents/form_trans_view', [
				'action'=>base_url('trans/add').get_query_string()
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
			$this->db->insert($this->table, $data);

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
			$this->db->where('trans.id', $id);
			$content_view['data'] = $this->db->get($this->table)->row();
            $content_view['data']->value = number_format($content_view['data']->value);
			$content_view['action'] = base_url('trans/edit/'.$id).get_query_string();
			$data['script'] = $this->load->view('script/trans_script', '', true);
			$data['content'] = $this->load->view('contents/form_trans_view',$content_view,true);

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
			$trans = $this->db->where('id', $id)->get('trans')->row();
			$this->db->update($this->table, $data, ['id'=>$id]);
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
			$trans = $this->db->where('id', $id)->get('trans')->row();
			$this->db->update($this->table, $data, ['id'=>$id]);

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
