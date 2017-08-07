<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ReportMutasi extends CI_Controller {
	function __construct() 
	{
        parent::__construct();
        $this->load->model('m_mutasi');
        $this->dataUser=json_decode($this->input->cookie('dataUser',true));
        $this->general->validasiTokenLogin();        
        $this->general->accessController('REPORT',json_decode($this->input->cookie('dataAksesController',true))); 
    }
    function index()
	{
		$data['header']=$this->session->userdata('header');
		$data['asideleft']=$this->session->userdata('asideleft');
        $data['bln']=date('m');
        $data['dataYear']=$this->m_mutasi->getYearMutasi();
        if(count($data['dataYear'])==0)
        {
            $data['dataYear']=array((object)array('Year'=>date('Y')));
        }
        $this->load->view('reportmutasi',$data);
	}
    function getMutasiByPriode()
    {
        $jenis= $this->input->post('jenis');
        $start= $this->input->post('start');
        $end= $this->input->post('end');
        
        $data['dataMutasi']=$this->m_mutasi->getMutasiByPriode($start,$end,$jenis);
        $this->load->view('template/datatable/reportmutasi',$data);
    }
	function validasiTokenLogin()
	{   
		$this->load->model('m_login');
        if(strlen($this->input->cookie('dataToken',true))>0)
        {
            $dataToken=$this->input->cookie('dataToken',true);
            $cookieUser=substr($dataToken, 0,strlen($dataToken)-(strlen($dataToken)- strpos($dataToken, '|')));

            $dataToken=str_replace($cookieUser.'|', '', $dataToken);
            $cookieToken=substr($dataToken, 0,strlen($dataToken)-(strlen($dataToken)- strpos($dataToken, '|')));

            $dataToken=str_replace($cookieToken.'|', '', $dataToken);
            $cookieIP=substr($dataToken, 0,strlen($dataToken)-(strlen($dataToken)- strpos($dataToken, '|')));

            $dataToken=str_replace($cookieIP.'|', '', $dataToken);
            $cookieHost=$dataToken;
            $arrayUserToken=$this->m_login->getUserToken($cookieUser,$cookieIP,$cookieHost,$cookieToken);//echo $cookieUser.' '.$cookieToken;
            if(count($arrayUserToken)>0)
            {
                if($this->session->userdata('dataUser')&&$this->session->userdata('dataAksesController'))
		        {}
		        else //Jika session sudah tidak ada, ambil data user dari DB
		        {
		        	$arrayUserdata=$this->m_login->getUserDatabyUsername($cookieUser);
		        	$this->session->set_userdata('dataUser',$arrayUserdata);
		        }
            }
            else{redirect('Login');echo "token tidak sama";}
        }
        else{redirect('Login');echo "token tidak ada";}
	}
}
