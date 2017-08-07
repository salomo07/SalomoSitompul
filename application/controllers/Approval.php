<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Approval extends CI_Controller {
	function __construct() {
        parent::__construct();
        $this->load->model('m_approval');
        $this->dataUser=json_decode($this->input->cookie('dataUser',true));
        $this->general->validasiTokenLogin();        
        $this->general->accessController('APPROVAL',json_decode($this->input->cookie('dataAksesController',true)));        
    }
    function index()
	{
		$data['header']=$this->session->userdata('header');
		$data['asideleft']=$this->session->userdata('asideleft');
		$dataUser=$this->dataUser;//print_r($dataUser);
		$dataAksesBC=$this->session->userdata('dataAksesBC');
		$data['dataAksesBC']=$dataAksesBC;//print_r($dataUser);
        $data['deptname']=$dataUser->DeptName;
        $data['deptid']=$dataUser->IdDept;
        $dataAksesBC=$this->session->userdata('dataAksesBC');$xxx=$dataAksesBC;
        foreach ($xxx as $key => $value) 
        {
            if(strpos(strtoupper($value->IdBC), 'IN')!== false ||strpos(strtoupper($value->IdBC), 'FTZ')!== false ||strpos(strtoupper($value->IdBC), 'OUT')!== false)
            {}
            else{unset($xxx[$key]);}
        }
        $data['dataAksesBC']=$xxx;
		$this->redirectBC($dataAksesBC,$dataUser); //Redirect Page sesuai role
		$this->load->view('approval',$data);
	}
	function getApprovalbyDate()
	{
		$date= $this->input->post('date');
        $jenis= $this->input->post('jenis');
        $deptid= $this->input->post('deptid');
		$data['dataBC']=$this->m_approval->getApprovalbyDateJenis($date,$jenis,$deptid);
		$this->load->view('template/datatable/bcapproval',$data);
	}
	function approveBC()
	{
		$arrayOfObject=$this->input->post('json');
		$arrayOfObject=json_decode($arrayOfObject);
		$dataUser=$this->dataUser;
		foreach ($arrayOfObject as $key => $value) 
		{
			$this->m_approval->approveBC($dataUser->Nik,date('Y-m-d H:i:s'),$value->Checked);
		}
	}
	function redirectBC($dataAksesBC,$dataUser)
    {
    	$BCSama=false;$BCpertama=$dataAksesBC[0];$BCpertama=$BCpertama->IdBC;
        foreach ($dataAksesBC as $key => $value) 
        {
            if(!isset($_GET['jenis']))
            {
	            redirect('Approval?jenis='.$value->IdBC);
            }
            else
            {
            	if($_GET['jenis']==$value->IdBC){$BCSama=true;}
            }
        }
        if($BCSama==false){redirect('Approval?jenis='.$BCpertama);}
    }
}
