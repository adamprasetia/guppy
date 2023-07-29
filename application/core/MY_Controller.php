<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class MY_Controller extends CI_Controller
{    
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        if (!$this->session->userdata('session_login')) {
            redirect('login');
        }else{
            $this->session_login = $this->session->userdata('session_login');
            $this->session_store = $this->session->userdata('session_store');
            $this->session_module = $this->session->userdata('session_module');
        }

        // validation owner
        if(in_array($this->uri->segment(1),['item','sell','trans','buy']) && (in_array($this->uri->segment(2), ['edit','delete']))){
            $table = $this->uri->segment(1);
            $id = $this->uri->segment(3);
            $data = $this->db->where('id', $id)->get($table)->row();
            if($data->store_id != $this->session_store){
                redirect($table);
            }
        }

        // validation owner store
        if(in_array($this->uri->segment(1),['store']) && (in_array($this->uri->segment(2), ['edit','delete']))){
            $id = $this->uri->segment(3);
            $data = $this->db->where('store_id', $id)->get('user_store')->row();
            if($data->user_id != $this->session_login['id']){
                redirect('store');
            }
        }

        // validation role
        if(in_array($this->uri->segment(1),['user','role','module']) && !in_array('super-admin', $this->session_module)){
            redirect();
        }

        // check expired
        if($this->session_login['expired_at'] < date('Y-m-d') && $this->uri->segment(1) != 'expired' && !in_array('super-admin', $this->session_module)){
            redirect('expired');
        }
    }
}
