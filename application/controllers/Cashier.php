<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cashier extends MY_Controller {


	function __construct()
   	{
    	parent::__construct();
   	}

	public function index()
	{
		$data['content'] 	= $this->load->view('contents/cashier_view', [
            'action'=>site_url('cashier/checkout')
        ], TRUE);
		$data['script'] 	= $this->load->view('script/cashier_script', [], TRUE);

		$this->load->view(!empty($this->input->get('popup'))?'modals/template_view':'template_view', $data);
	}

    private function _set_data($action = 'add')
	{
		$date		= $this->input->post('date');
		$nomor		= $this->input->post('nomor');

		$data = array(
			'date' => format_ymd($date),
			'nomor' => $nomor,
            'store_id' => $this->session_store,
		);

        $data['created_by'] = $this->session_login['id'];
        $data['created_at'] = date('Y-m-d H:i:s');

		return $data;
	}

    public function checkout()
    {
        $date = $this->input->post('date');
        $nomor = $this->input->post('nomor');
        $detail = json_decode($this->input->post('detail'));

        $this->db->trans_start();
        $data = $this->_set_data();
        $data['diskon'] = $detail->diskon;
        $detail = json_decode($this->input->post('detail'), true);
        $this->db->insert('sell', $data);
        $sell_id = $this->db->insert_id();
        foreach ($detail['item'] as $key => $value) {
            $this->db->insert('sell_d', [
                'sell_id'=>$sell_id,
                'item_id'=>$value['item_id'],
                'qty'=>$value['qty'],
                'amount'=>$value['amount']
            ]);
            $this->db->where('id', $value['item_id']);
            $this->db->set('stock', 'stock-'.$value['qty'], false);
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
