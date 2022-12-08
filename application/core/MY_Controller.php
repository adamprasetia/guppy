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
        }

        // validation owner
        if(in_array($this->uri->segment(1),['item','sell','trans','buy']) && $this->uri->segment(2)=='edit'){
            $table = $this->uri->segment(1);
            $id = $this->uri->segment(3);
            $data = $this->db->where('id', $id)->get($table)->row();
            if($data->store_id != $this->session_store){
                redirect($table);
            }
        }
    }
}
