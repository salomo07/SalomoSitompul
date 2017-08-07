<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master_Menu extends CI_Controller {
	function __construct() {
        parent::__construct();
        $this->load->model('m_master');
    }
    public function index()
	{
		$data['dataMenu']=$this->m_master->getMenu();
		$data['dataMenu2']=$this->m_master->getMenu2();
		$data['header']=$this->session->userdata('header');
		$data['asideleft']=$this->session->userdata('asideleft');
		$this->load->view('master/menu',$data);
	}
}
