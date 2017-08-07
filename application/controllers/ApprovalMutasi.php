<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ApprovalMutasi extends CI_Controller {
	function __construct() {
        parent::__construct();
        $this->load->model('m_mutasi');
        $this->dataUser=json_decode($this->input->cookie('dataUser',true));
        $this->general->validasiTokenLogin();        
        $this->general->accessController('APPROVAL',json_decode($this->input->cookie('dataAksesController',true))); 
    }
    function index()
	{
		$data['header']=$this->session->userdata('header');
		$data['asideleft']=$this->session->userdata('asideleft');
		$this->load->view('approvalmutasi',$data);
	}
	function getMutasiForApprovalbyJenisBCDate()
	{
		$date= $this->input->post('date');
        $jenis= $this->input->post('jenis');
		$data['dataMutasi']=$this->m_mutasi->getMutasiHarian($date,$jenis);        
        $data['dataMutasiApproved']=$this->m_mutasi->getMutasiHarianApproved($date,$jenis);
        if(count($data['dataMutasiApproved'])==0)
        {$data['dataMutasiApproved']=$this->m_mutasi->getMutasiHarianApproved2($date,$jenis);}
		$this->load->view('template/datatable/mutasiapproval',$data);
	}
    function updateApproval()
    {
        $arrayObject= $this->input->post('arrayObject');//print_r($arrayObject);
        $arrayObject=json_decode($arrayObject);
        $dataUser=$this->dataUser;
        foreach ($arrayObject as $key => $value) 
        {
            $this->m_mutasi->approveMutasi($value->IdDetail,$dataUser->Nik);
        }
    }
}
