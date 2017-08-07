<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master_User extends CI_Controller {
	function __construct() {
        parent::__construct();
        $this->load->model('m_master');
        $this->dataUser=json_decode($this->input->cookie('dataUser',true));
        $this->general->validasiTokenLogin();        
        $this->general->accessController('MASTER',json_decode($this->input->cookie('dataAksesController',true)));
    }
    public function index()
	{
		$data['header']=$this->session->userdata('header');
		$data['asideleft']=$this->session->userdata('asideleft');
		$this->load->view('master/user',$data);
	}
	public function getUser()
	{
		$data['dataUser']=$this->m_master->getUser();
		$this->load->view('template/datatable/user',$data);
	}	
	public function cekUsernameSama()
	{
		$username= $this->input->post('username');
		$usersama=$this->m_master->getUserSama($username);
		if(count($usersama)>0){echo '1';}
		else{echo '0';}
	}
	public function insertUser()
	{
		$nik= $this->input->post('nik');
		$username= $this->input->post('username');
		$fullname= $this->input->post('fullname');
		$role= $this->input->post('role');
		$this->m_master->insertUser($nik,$username,$fullname,$role);
	}
	public function editUser()
	{
		$id= $this->input->post('id');
		$fullname= $this->input->post('fullname');
		$role= $this->input->post('role');
		$this->m_master->editUser($id,$fullname,$role);
	}
	public function deleteUser()
	{
		$id= $this->input->post('id');
		$this->m_master->deleteUser($id);
	}
	public function getModalAddUser()
	{
		$data['dataRole']=$this->m_master->getRole();
		$this->load->view('template/modal/adduser',$data);
	}
	public function getModalEditUser()
	{
		$idUser= $this->input->post('idUser');
		$data['dataID']=$idUser;
		$data['dataUser']=$this->m_master->getUserbyID((int)$idUser);
		$data['dataRole']=$this->m_master->getRole();
		$this->load->view('template/modal/edituser',$data);
	}
	public function getModalDeleteUser()
	{
		$idUser= $this->input->post('idUser');
		$data['dataID']=$idUser;
		$data['dataUser']=$this->m_master->getUserbyID((int)$idUser);
		$data['dataRole']=$this->m_master->getRole();
		$this->load->view('template/modal/deleteuser',$data);
	}
}
