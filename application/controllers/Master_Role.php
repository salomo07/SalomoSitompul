<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master_Role extends CI_Controller {
	function __construct() {
        parent::__construct();
        $this->load->model('m_master');
        $this->dataUser=json_decode($this->input->cookie('dataUser',true));
        $this->general->validasiTokenLogin();        
        $this->general->accessController('MASTER',json_decode($this->input->cookie('dataAksesController',true)));
    }
    public function index()
	{
		$data['dataRole']=$this->m_master->getRole();
		$data['dataNamaMenu']=$this->m_master->getMenu();
		$data['header']=$this->session->userdata('header');
		$data['asideleft']=$this->session->userdata('asideleft');
		$this->load->view('master/role',$data);
	}
	public function getRole()
	{
		$data['dataRole']=$this->m_master->getRole();
		$this->load->view('template/datatable/role',$data);
	}
	public function insertRole()
	{
		$role= $this->input->post('role');
		$keterangan= $this->input->post('keterangan');
		$kepala= $this->input->post('kepala');
		$dept= $this->input->post('dept');
		$this->m_master->insertRole($role,$keterangan,$kepala,$dept);
	}
	public function editRole()
	{
		$id= $this->input->post('id');
		$role= $this->input->post('role');
		$keterangan= $this->input->post('keterangan');
		$this->m_master->editRole($id,$role,$keterangan);
	}
	public function getModalAddRole()
	{
		$role= $this->input->post('role');
		$data['dept']=$this->m_master->getDepartementAll();
		$this->load->view('template/modal/addrole',$data);
	}
	public function getModalEditRole()
	{
		$data['dataRole']=$this->m_master->getRolebyID($this->input->post('idRole'));
		$this->load->view('template/modal/editrole',$data);
	}
	public function getModalDeleteRole()
	{
		$data['dataRole']=$this->m_master->getRolebyID($this->input->post('idRole'));
		$this->load->view('template/modal/deleterole',$data);
	}
	public function cekRoleSama()
	{
		$role= $this->input->post('role');
		$roleSama=$this->m_master->getRoleSama($role);
		if(count($roleSama)>0)
		{echo '1';}
		else{echo "0";}
	}
	public function deleteRole()
	{
		$id= $this->input->post('id');
		$this->m_master->deleteRole($id);
	}
	public function getAksesMenu()
	{
		$data['dataRole']=$this->m_master->getAksesMenu();
		$this->load->view('template/datatable/aksesmenu',$data);
	}
	function addAksesMenu()
	{
		$role= $this->input->post('role');
		$menu= $this->input->post('menu');//echo "$role $menu";
		$dataAksesMenu=$this->m_master->getAksesMenuSama($role,$menu);
		if(count($dataAksesMenu)>0)
		{ echo "sama";}
		else
		{
			$dataAksesMenu=array('IdRole'=>$role,'IdMenu'=>$menu);
			$this->m_master->insertAksesMenu($dataAksesMenu,'tblAksesMenuHeader');
			$this->m_master->insertAksesMenu($dataAksesMenu,'tblAksesMenuAside');
		}
	}
	function getSubMenu()
	{
		$id= $this->input->post('idmenu');
		$dataMenu=$this->m_master->getSubMenubyID($id);
		echo json_encode($dataMenu);
	}
	function addAksesSubMenu()
	{
		$role= $this->input->post('role');
		$menu= $this->input->post('menu');
		$submenu= $this->input->post('submenu');
		$arrayAksesMenu=array();
		$dataAksesMenu=$this->m_master->getAksesSubMenu($role,$menu,$submenu);
		if(count($dataAksesMenu)>0)
		{
			echo "sama";
		}
		else
		{
			$arraySubMenu=array('IdRole'=>$role,'IdMenu2'=>$submenu);
			$this->m_master->insertSubMenu($arraySubMenu,'tblAksesMenuAside2');
			$this->m_master->insertSubMenu($arraySubMenu,'tblAksesMenuHeader2');echo "";
		}
	}
	function getAksesMenubyIDRole()
	{

	}
}
