<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/*---------------------------------------------------------------------
	Class privilege ,generate all request linked to the access controll
----------------------------------------------------------------------*/

class General {

	private $obj = NULL;
    function General(){

		$this->obj= & get_instance();
	}

	function validasiTokenLogin()
	{
		$this->obj->load->model('m_login');
        if(strlen($this->obj->input->cookie('dataToken',true))>0)
        {
            $dataToken=$this->obj->input->cookie('dataToken',true);
            $cookieUser=substr($dataToken, 0,strlen($dataToken)-(strlen($dataToken) - strpos($dataToken, '|')));

            $dataToken=str_replace($cookieUser.'|', '', $dataToken);
            $cookieToken=substr($dataToken, 0,strlen($dataToken)-(strlen($dataToken)- strpos($dataToken, '|')));

            $dataToken=str_replace($cookieToken.'|', '', $dataToken);
            $cookieIP=substr($dataToken, 0,strlen($dataToken)-(strlen($dataToken)- strpos($dataToken, '|')));

            $dataToken=str_replace($cookieIP.'|', '', $dataToken);
            $cookieHost=$dataToken;
            $arrayUserToken=$this->obj->m_login->getUserToken($cookieUser,$cookieIP,$cookieHost,$cookieToken);
            if(count($arrayUserToken)>0)
            {//print_r($this->session->userdata('dataUser'));
                if($this->obj->dataUser)
    	        {
                    $arrayUserdata=$this->obj->dataUser;
                    $this->getHeaderAside($arrayUserdata->IdRole);
    	        }
    	        else //Jika session sudah tidak ada, ambil data user dari DB
    	        {
    	        	$arrayUserdata=$this->obj->m_login->getUserDatabyUsername($cookieUser);
    	        	$this->obj->session->set_userdata('dataUser',$arrayUserdata);
                    redirect('Home');
    	        	//print_r($this->session->userdata('dataUser'));
    	        }
            }
            else{redirect('Login');echo "token tidak sama";}
        }
        else{redirect('Login');echo "token tidak ada";}
	}
	function getHeaderAside($IdRole)
    {

        $data['daftarmenu']=$this->obj->m_login->getAksesMenuAside($IdRole);//print_r($data['daftarmenu']);
        $daftarmenu= $this->obj->load->view('template/asideleft',$data,true);
        $this->obj->session->set_userdata('asideleft',$daftarmenu);

        $data['arrayDataUser']=$this->obj->dataUser;
        $data['daftarmenu']=$this->obj->m_login->getAksesMenuHeader($IdRole);
        $daftarmenu= $this->obj->load->view('template/header',$data,true);
        $this->obj->session->set_userdata('header',$daftarmenu);

        $dataAksesBC=$this->obj->m_login->getAksesBC($IdRole);
        $this->obj->session->set_userdata('dataAksesBC',$dataAksesBC);
        $dataAksesController='';//print_r($data['daftarmenu']);
        foreach ($data['daftarmenu'] as $key => $value)
        {
            $dataAksesController[]=$value->IdController;
        }
        $this->obj->input->set_cookie("dataAksesController", json_encode($dataAksesController), 3600*8);
    }
    function accessController($controllername,$array)
    {
    	$controllerSama=false;//print_r($array);
    	foreach ($array as $key => $value)
        {
        	if(strtoupper($value)== strtoupper($controllername))
        	{$controllerSama=true;}
        }
        if($controllerSama!=true)
        {
        	redirect('PageNotFound');
        }
    }

}
