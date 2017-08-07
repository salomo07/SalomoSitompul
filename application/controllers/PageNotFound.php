<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PageNotFound extends CI_Controller {
	function __construct() {
        parent::__construct();
    }
    function index()
	{
		$data['header']=$this->session->userdata('header');
		$data['asideleft']=$this->session->userdata('asideleft');
		$this->load->view('pagenotfound',$data);
	}
}
