<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Expired extends MY_Controller {

	function __construct()
   	{
    	parent::__construct();
   	}

	public function index()
	{
		$data['content'] = $this->load->view('contents/expired_view', '', TRUE);
		$this->load->view('template_view', $data);
	}

}
