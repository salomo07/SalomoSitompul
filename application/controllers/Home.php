<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct() {
        parent::__construct();
        $this->load->model('M_home');
    }
	public function index()
	{
		$data['interval']=date_diff(date_create(), date_create('1992-08-02'));
        $data['sitename']='Salomo Sitompul';
        $data['pagename']='Home';
		$this->load->view('index',$data);
	}
	public function sendMessage()
	{
		$obj=$jenis= $this->input->post('obj');
		$this->M_home->sentMessage($obj);
	}
}
