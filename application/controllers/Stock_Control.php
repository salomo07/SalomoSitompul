<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stock_Control extends CI_Controller {
	function __construct() {
        parent::__construct();
        $this->validasiTokenLogin();
        $this->load->model('m_master');
    }
	
	public function index()
	{
        $dataUser=$this->session->userdata('dataUser');
        $data['header']=$this->session->userdata('header');
        $data['asideleft']=$this->session->userdata('asideleft');
        $this->load->view('master/stockcontrol',$data);
	}
    function getStockControl()
    {
        $array=$this->m_master->getStockControl();
        echo json_encode($array);
    }
    function insertStockControl()
    {
        $iditem= $this->input->post('iditem');
        $stok= $this->input->post('stok');
        $xxx=$this->m_master->getStockControlbyIdItem($iditem);
        $stokdata=array('IdItem' =>$iditem ,'NamaItem'=>$xxx->Name,'StokAwal'=>$stok,'IsDeleted'=>false);
        $this->m_master->insertStockControl($stokdata);
    }
    function getUnionIdItem()
    {
        $sumber= $this->input->post('sumber');
        $data=$this->m_master->getUnionIdItem($sumber);
        echo json_encode($data);
    }
    function pageNotFound()
    {
        $this->load->view('pagenotfound',$data);
    }
	function validasiTokenLogin()
	{   
        $this->load->model('m_login');
        if(strlen($this->input->cookie('dataToken',true))>0)
        {//echo $this->input->cookie('dataToken',true);
            $dataToken=$this->input->cookie('dataToken',true);
            $cookieUser=substr($dataToken, 0,strlen($dataToken)-(strlen($dataToken) - strpos($dataToken, '|')));

            $dataToken=str_replace($cookieUser.'|', '', $dataToken);
            $cookieToken=substr($dataToken, 0,strlen($dataToken)-(strlen($dataToken)- strpos($dataToken, '|')));

            $dataToken=str_replace($cookieToken.'|', '', $dataToken);
            $cookieIP=substr($dataToken, 0,strlen($dataToken)-(strlen($dataToken)- strpos($dataToken, '|')));

            $dataToken=str_replace($cookieIP.'|', '', $dataToken);
            $cookieHost=$dataToken;
            $arrayUserToken=$this->m_login->getUserToken($cookieUser,$cookieIP,$cookieHost,$cookieToken);
            if(count($arrayUserToken)>0)
            {//print_r($this->session->userdata('dataUser'));
                if($this->session->userdata('dataUser'))
    	        {
                    $arrayUserdata=$this->session->userdata('dataUser');
                    $this->getHeaderAside($arrayUserdata->IdRole);
    	        }
    	        else //Jika session sudah tidak ada, ambil data user dari DB
    	        {
    	        	$arrayUserdata=$this->m_login->getUserDatabyUsername($cookieUser);
    	        	$this->session->set_userdata('dataUser',$arrayUserdata);
                    redirect('Home');
    	        }
            }
            else{redirect('Login');echo "token tidak sama";}
        }
        else{redirect('Login');echo "token tidak ada";}
	}
	function signout()
	{
		$arrayDataUser=$this->session->userdata('dataUser');
        $this->m_login->updateSignout($arrayDataUser->Id);
        delete_cookie("dataToken");        
        $this->session->sess_destroy();
        redirect('Login');             
	}
    function getModalChangePassword()
    {
        $data['idUser']= $this->input->post('idUser');
        $this->load->view('template/modal/changepassword',$data);
    }
    function changePassword()
    {
        $idUser= $this->input->post('id');
        $old= $this->input->post('old');
        $newpass= $this->input->post('newpass');
        $verify= $this->input->post('verify');//echo $idUser.$old.$newpass.$verify;
        $verify=$this->m_login->verifyPassword($idUser,base64_encode($old));
        if(count($verify)>0)
        {
            $this->m_login->updatePassword($idUser,base64_encode($newpass));
        }
        else{echo "Password lama salah";}
    }
    function getHeaderAside($IdRole)
    {
        $data['daftarmenu']=$this->m_login->getAksesMenuAside($IdRole);
        $daftarmenu= $this->load->view('template/asideleft',$data,true);
        $this->session->set_userdata('asideleft',$daftarmenu);

        $data['daftarmenu']=$this->m_login->getAksesMenuHeader($IdRole);
        $daftarmenu= $this->load->view('template/header',$data,true);
        $this->session->set_userdata('header',$daftarmenu);
        
        $dataAksesBC=$this->m_login->getAksesBC($IdRole);
        $this->session->set_userdata('dataAksesBC',$dataAksesBC);
        $dataAksesController;
        foreach ($data['daftarmenu'] as $key => $value) 
        {
            $dataAksesController[]=$value->IdController;
        }
        $this->session->set_userdata('dataAksesController',$dataAksesController);
    }
}
