<?php
defined('BASEPATH') OR exit('No direct script access allowed');
ini_set('max_execution_time', 0); 
ini_set('memory_limit','2048M');
class Report extends CI_Controller {
	function __construct() 
	{
        parent::__construct();
        $this->load->model('m_BC');
        $this->dataUser=json_decode($this->input->cookie('dataUser',true));
        $this->general->validasiTokenLogin();        
        $this->general->accessController('REPORT',json_decode($this->input->cookie('dataAksesController',true))); 
    }
    function index()
	{
		$data['header']=$this->session->userdata('header');
		$data['asideleft']=$this->session->userdata('asideleft');	
		$dataUser=$this->dataUser;
		$data['jenis']='';
		$data['title']='';
        $dataAksesBC=$this->session->userdata('dataAksesBC');$xxx=$dataAksesBC;
        foreach ($xxx as $key => $value) 
        {
            if(strpos(strtoupper($value->IdBC), 'IN')!== false ||strpos(strtoupper($value->IdBC), 'FTZ')!== false ||strpos(strtoupper($value->IdBC), 'OUT')!== false)
            {}
            else{unset($xxx[$key]);}
        }
        $data['dataAksesBC']=$xxx;

		if(!isset($_GET['jenis']))
		{
			$dataAksesBC=$this->session->userdata('dataAksesBC');
			$this->redirectBC($dataAksesBC,$dataUser);
		}
		else
		{
			if(strpos(strtoupper($_GET['jenis']), 'IN') !== false||strpos(strtoupper($_GET['jenis']), 'FTZ') !== false)
			{
				$data['title']='Report Pemasukan Barang Pabean';				
			}
			elseif(strpos(strtoupper($_GET['jenis']), 'OUT') !== false)
			{$data['title']='Report Pengeluaran Barang Pabean';}
			$data['jenis']=$_GET['jenis'];
			$this->load->view('report',$data);
		}		
	}
	function redirectBC($dataAksesBC,$dataUser)
    {
        foreach ($dataAksesBC as $key => $value) 
        {
        	redirect('Report?jenis='.$value->IdBC);
        }
    }
	function getReport()
	{
		// $list = $this->m_BC->get_datatables();
  //       $data = array();
  //       $no = $_POST['start'];
  //       foreach ($list as $customers) {
  //           $no++;
  //           $row = array();
  //           $row[] = $no;
  //           $row[] = $customers->FirstName;
  //           $row[] = $customers->LastName;
  //           $row[] = $customers->phone;
  //           $row[] = $customers->address;
  //           $row[] = $customers->city;
  //           $row[] = $customers->country;
 
  //           $data[] = $row;
  //       }
 
  //       $output = array(
  //                       "draw" => $_POST['draw'],
  //                       "recordsTotal" => $this->customers->count_all(),
  //                       "recordsFiltered" => $this->customers->count_filtered(),
  //                       "data" => $data,
  //               );
  //       echo json_encode($output);
		$startx= $this->input->post('start');
		$lengthx= $this->input->post('length');
		$jenis= $this->input->post('jenis');
		$date= $this->input->post('date');
        $start=substr($date,0,10);
        $end=substr($date,13,strlen($date));
		$data['dataBC']=$this->m_BC->getBCbyJenisBCDateRange($jenis,$start,$end);
		$total=count($data['dataBC']);
		$dataHasil = array();
		foreach ($data['dataBC'] as $key => $val) {
			$dataHasil[]=array(
				'NoPabean' =>'<center>'.$val->NoPabean.'</center>',
				'NoNota' =>'<center>'.$val->NoNota.'</center>',
				'NoInvoice' =>'<center>'.$val->NoInvoice.'</center>' ,'TanggalPabean' => '<center>'.$val->TanggalPabean.'</center>',
				'TanggalNota' =>'<center>'.$val->TanggalNota.'</center>',
				'TanggalInvoice' =>'<center>'.$val->TanggalInvoice.'</center>',
				'KodeBarang' =>'<center>'.$val->KodeBarang.'</center>',
				'NamaBarang' =>'<center>'.$val->NamaBarang.'</center>',
				'Sat' =>'<center>'.$val->Sat.'</center>',
				'Valas' =>'<center>'.$val->Valas.'</center>',
				'KodeHS' =>'<center>'.$val->KodeHS.'</center>',
				'Tarif' =>'<center>'.number_format($val->Tarif, 4, ',', '.').'</center>',
				'Qty' =>'<center>'.number_format($val->Qty, 4, ',', '.').'</center>',
				'CIF' =>'<center>'.number_format($val->CIF, 4, ',', '.').'</center>',
				'Total' =>'<center>'.number_format($val->Total, 2, ',', '.').'</center>',
				'PDRIBebas' =>'<center>'.number_format($val->PDRIBebas, 2, ',', '.').'</center>',
				'PDRIBayar' =>'<center>'.number_format($val->PDRIBayar, 2, ',', '.').'</center>',
				'Keterangan' =>'<center>'.$val->Keterangan.'</center>',
				'Centang'=>'<center><input id="chkApproval" type="checkbox" value="'.$val->NoNota.'"></center>');
		}
		$arrayHasil = array('draw' =>1 ,'recordsTotal'=> $total,'recordsFiltered'=>$total,'data'=>$dataHasil);
		//print_r(expression) $arrayHasil;
		echo json_encode($arrayHasil);
	}
	function getReport2()
	{
		$jenis= $this->input->post('jenis');
		$date= $this->input->post('date');
        $start=substr($date,0,10);
        $end=substr($date,13,strlen($date));
		$data['dataBC']=$this->m_BC->getBCbyJenisBCDateRange($jenis,$start,$end);
		//print_r($data['dataBC']);
		$this->load->view('template/datatable/reportbc',$data);
	}
	function getDataAksesBC()
    {
        $date= $this->input->post('date');
        $dataAksesBC=$this->session->userdata('dataAksesBC');
        echo json_encode($dataAksesBC);
    }
    public function exportPDF()
  	{
		if($this->input->post('data')!='')
		{
			$this->session->set_userdata('data',$this->input->post('data'));
			$this->session->set_userdata('start',$this->input->post('start'));
			$this->session->set_userdata('end',$this->input->post('end'));
		}
	  	$data=$this->session->userdata('data');
		$start=$this->session->userdata('start');
		$end=$this->session->userdata('end');

		if($data!='')
		{
			$this->load->library('pdf');
		    $filename = 'Laporan BC';
		    $paper = 'A4';
		    $orientation = 'landscape';
		    $this->pdf->exportPDF($data, 'Laporan Transaksi BC ('.$start.' - '.$end.').pdf');
		}
		//else{redirect("Report/exportPDF");}
    }
}
