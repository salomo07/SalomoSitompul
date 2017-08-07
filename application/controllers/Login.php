<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	function __construct() {
        parent::__construct();
        $this->load->model('m_login');
        if ($this->validasiTokenLogin()==true) 
        {
             redirect('Home');
        }
        date_default_timezone_set("Asia/Jakarta");        
    }
	public function index()
	{
		$this->load->view('index');
	}
	
	public function loging()
	{
		$username = $this->input->post('username');
        $password = $this->input->post('password');
        $arrayUserdata=$this->m_login->getUserData($username,base64_encode($password));
        if(count($arrayUserdata)>0)
        {
            $loginLog=array('IdUser'=>$arrayUserdata->IdUser,'Username'=>$arrayUserdata->Username,'Role'=>$arrayUserdata->IdRole,'IP'=>$_SERVER['REMOTE_ADDR'],'Host'=>gethostbyaddr($_SERVER['REMOTE_ADDR']),'Waktu_In'=>date('Y-m-d H:i:s'),'Token'=>base64_encode(date("Y-m-d H:i:s")));
            $this->m_login->insertLoginLog($loginLog);
            $this->input->set_cookie("dataUser", json_encode($arrayUserdata), 3600*8);
            $this->session->set_userdata('dataUser',$arrayUserdata);
            $dataToken= $username.'|'.base64_encode(date("Y-m-d H:i:s")).'|'.$_SERVER['REMOTE_ADDR'].'|'.gethostbyaddr($_SERVER['REMOTE_ADDR']);
            $this->input->set_cookie("dataToken", $dataToken, 3600*8);
            $arraySubMenu=array();

            //$this->getHeaderAside($arrayUserdata->IdRole);
            //redirect('Home');
            echo "valid";
        }
        else
        {
            echo "invalid";
            //redirect('Login');
        }
	}
    
    public function validasiTokenLogin()
    {   
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
            $arrayUserToken=$this->m_login->getUserToken($cookieUser,$cookieIP,$cookieHost,$cookieToken);
            if(count($arrayUserToken)>0)
            {
                return true;
            }
            else{return false;}
        }
        if($this->input->cookie('dataUser',true))
        {

        }
        else{return false;}
    }
}
