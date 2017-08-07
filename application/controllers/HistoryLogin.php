<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class HistoryLogin extends CI_Controller {
	function __construct() 
	{
        parent::__construct();
        $this->load->model('m_login');
        $this->dataUser=json_decode($this->input->cookie('dataUser',true));
        $this->general->validasiTokenLogin();        
        $this->general->accessController('HISTORY',json_decode($this->input->cookie('dataAksesController',true))); 
    }
    function index()
	{

		$data['header']=$this->session->userdata('header');
		$data['asideleft']=$this->session->userdata('asideleft');	
		$this->load->view('historylogin',$data);
	}
	
    function getHistoryLogin()
    {
        $range=$this->input->post('range');
        $username=$this->input->post('username');
        $start=substr($range,0,10);
        $end=substr($range,13,strlen($range));
        if($username=='')
        {$data['dataLogLogin']=$this->m_login->getHistorybyDateRange($start,$end);}
        else{$data['dataLogLogin']=$this->m_login->getHistorybyDateRangeUsername($start,$end,$username);}
        $this->load->view('template/datatable/historylog',$data);
    }
    function getUsername()
    {
        $key=$this->input->post('key');
        echo json_encode($this->m_login->getUsername($key));
    }
}
