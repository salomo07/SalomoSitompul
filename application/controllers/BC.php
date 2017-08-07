<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BC extends CI_Controller {
	function __construct() 
	{
        parent::__construct();
        $this->load->model('m_BC');
        $this->dataUser=json_decode($this->input->cookie('dataUser',true));
        $this->general->validasiTokenLogin();        
        $this->general->accessController('BC',json_decode($this->input->cookie('dataAksesController',true)));
    }
    function index()
	{        
		$data['header']=$this->session->userdata('header');//print_r($data['header']);
		$data['asideleft']=$this->session->userdata('asideleft');	
		$data['jenis']='';
		$data['title']='';
		if(!isset($_GET['jenis']))
		{
			$dataAksesBC=$this->session->userdata('dataAksesBC');
			$this->redirectBC($dataAksesBC);
		}
		else
		{
			if(strpos(strtoupper($_GET['jenis']), 'IN') !== false||strpos(strtoupper($_GET['jenis']), 'FTZ') !== false)
			{
				$data['title']='Pemasukan Barang Pabean';				
			}
			elseif(strpos(strtoupper($_GET['jenis']), 'OUT') !== false)
			{$data['title']='Pengeluaran Barang Pabean';}
			$data['jenis']=$_GET['jenis'];
			$this->load->view('bc',$data);
		}		
	}
	function redirectBC($dataAksesBC)
    {
        foreach ($dataAksesBC as $key => $value) 
        {
        	redirect('BC?jenis='.$value->IdBC);
        }
    }
	function getBC()
	{
		$jenis= $this->input->post('jenis');
		$date= $this->input->post('date');
		$data['dataBC']=$this->m_BC->getBCbyJenisBCDate($jenis,$date);
		$this->load->view('template/datatable/penerimaanbc',$data);
	}
	function getModalResource()
	{
		$dataUser=$this->dataUser;
		$data['jenis']=$jenis= $this->input->post('jenis');
		
		if(strpos(strtoupper($jenis),'IN')!== false || strpos(strtoupper($jenis),'FTZ')!== false)
		{
			if (strpos(strtoupper($dataUser->Role), 'RMP')!== false)// Jika User dari Dept RMP
			{
				$data['tglhariini']=date('d-m-Y');
				$data['titlelabel']='Tabel Penerimaan Kelapa RMP';
				$data['jenisSumberData']='RMP';
				$this->load->view('template/modal/addBC',$data);
			}
			else if (strpos(strtoupper($dataUser->Role), 'PIS')!== false)// Jika User dari Dept PIS
			{
				$data['tglhariini']=date('d-m-Y');
				$data['titlelabel']='Tabel Bukti Penerimaan Barang';
				$data['jenisSumberData']='BTB';
				$this->load->view('template/modal/addBC',$data);
			}	
			else if (strpos(strtoupper($dataUser->Role), 'ACC')!== false)// Jika User dari Dept ACC
			{
				$data['tglhariini']=date('d-m-Y');
				$data['titlelabel']='Tabel Bukti Penerimaan Barang';
				$data['jenisSumberData']='BTB';
				$this->load->view('template/modal/addBC',$data);
			}
			else if (strpos(strtoupper($dataUser->Role), 'PIC')!== false)// Jika User dari Dept PIC
			{
				$data['tglhariini']=date('d-m-Y');
				$data['titlelabel']='Tabel Bukti Penerimaan Barang';
				$data['jenisSumberData']='BTB';
				$this->load->view('template/modal/addBC',$data);
			}
			else if (strpos(strtoupper($dataUser->Role), 'PHD')!== false)// Jika User dari Dept PHD
			{
				$data['tglhariini']=date('d-m-Y');
				$data['titlelabel']='Tabel Bukti Penerimaan Barang';
				$data['jenisSumberData']='BTB';
				$data['role']=strtoupper($dataUser->Role);
				$this->load->view('template/modal/addBC',$data);
			}
			else if (strpos(strtoupper($dataUser->Role), 'ESM')!== false)// Jika User dari Dept PHD
			{
				$data['tglhariini']=date('d-m-Y');
				$data['titlelabel']='Tabel Bukti Penerimaan Barang';
				$data['jenisSumberData']='BTB';
				$this->load->view('template/modal/addBC',$data);
			}
		}
		else if(strpos(strtoupper($jenis), 'OUT')!== false)
		{
			if(strpos(strtoupper($jenis), 'BCOUT41')!== false)
			{
				$data['tglhariini']=date('d-m-Y');
				$data['titlelabel']='Tabel PO';
				$data['jenisSumberData']='PO';
				$this->load->view('template/modal/addBC41',$data);
			}
			else if (strpos(strtoupper($dataUser->Role), 'PIS')!== false)// Jika User dari Dept PIS
			{
				$data['tglhariini']=date('d-m-Y');
				$data['titlelabel']='Tabel PO';
				$data['jenisSumberData']='PO';
				$this->load->view('template/modal/addBC',$data);
			}	
			else if (strpos(strtoupper($dataUser->Role), 'ACC')!== false)// Jika User dari Dept ACC
			{
				$data['tglhariini']=date('d-m-Y');
				$data['titlelabel']='Tabel PO';
				$data['jenisSumberData']='PO';
				$this->load->view('template/modal/addBC',$data);
			}
			else if (strpos(strtoupper($dataUser->Role), 'PIC')!== false)// Jika User dari Dept PIC
			{
				$data['tglhariini']=date('d-m-Y');
				$data['titlelabel']='Tabel PO';
				$data['jenisSumberData']='PO';
				$this->load->view('template/modal/addBC',$data);
			}
			else if (strpos(strtoupper($dataUser->Role), 'WHS')!== false)// Jika User dari Dept WHS
			{
				$data['tglhariini']=date('d-m-Y');
				$data['titlelabel']='Tabel PO';
				$data['jenisSumberData']='PO';
				$this->load->view('template/modal/addBC',$data);
			}
			else if (strpos(strtoupper($dataUser->Role), 'ESM')!== false)// Jika User dari Dept WHS
			{
				$data['tglhariini']=date('d-m-Y');
				$data['titlelabel']='Tabel PO';
				$data['jenisSumberData']='PO';
				$this->load->view('template/modal/addBC',$data);
			}
		}
	}
	function getPemasokbyTanggal()
	{
		$tanggal= $this->input->post('tanggal');
		$jenisSumberData= $this->input->post('jenisSumberData');
		$pemasok='';
		if($jenisSumberData=='BTB')
		{
			$pemasok=$this->m_BC->getResourceBTBPemasok($tanggal);
		}
		elseif ($jenisSumberData=='PO')
		{
			$pemasok=$this->m_BC->getResourcePOPemasok($tanggal);
		}
		elseif ($jenisSumberData=='RMP') 
		{
			$pemasok=$this->m_BC->getResourceRMPPemasok($tanggal);
		}
		echo json_encode($pemasok);
	}
	function getDataResourceByTanggal()
	{
		$data['jenis']= $this->input->post('jenis');
		$data['tglhariini']= $this->input->post('tglhariini');
		$pemasok= $this->input->post('pemasok');
		$dataUser=$this->session->userdata('dataUser');
		$data['phd']=false;
		if(strpos(strtoupper($data['jenis']), 'IN') !== false ||strpos(strtoupper($data['jenis']), 'FTZ')!== false)
		{
			if(strpos(strtoupper($dataUser->Role), 'RMP') !== false)
			{
				$data['dataTransaksi']=$this->m_BC->getResourceRMP($data['tglhariini'],$pemasok);
				$this->load->view('template/datatable/penerimaanbc2',$data);
			}
			else if(strpos(strtoupper($dataUser->Role), 'PIS') !== false)
			{
				$data['dataTransaksi']=$this->m_BC->getResourceBTB($data['tglhariini'],$pemasok);
				$this->load->view('template/datatable/penerimaanbc2',$data);
			}
			else if(strpos(strtoupper($dataUser->Role), 'ACC') !== false)
			{
				$data['dataTransaksi']=$this->m_BC->getResourceBTB($data['tglhariini'],$pemasok);
				$this->load->view('template/datatable/penerimaanbc2',$data);
			}
			else if(strpos(strtoupper($dataUser->Role), 'PIC') !== false)
			{
				$data['dataTransaksi']=$this->m_BC->getResourceBTB($data['tglhariini'],$pemasok);
				$this->load->view('template/datatable/penerimaanbc2',$data);
			}
			else if(strpos(strtoupper($dataUser->Role), 'PHD') !== false)
			{
				$data['dataTransaksi']=$this->m_BC->getResourceBTB($data['tglhariini'],$pemasok);
				$data['phd']=true;
				$this->load->view('template/datatable/penerimaanbc2',$data);
			}
			else if(strpos(strtoupper($dataUser->Role), 'ESM') !== false)
			{
				$data['dataTransaksi']=$this->m_BC->getResourceBTB($data['tglhariini'],$pemasok);
				$this->load->view('template/datatable/penerimaanbc2',$data);
			}
		}
		else if(strpos(strtoupper($data['jenis']), 'OUT') !== false)
		{
			if(strpos(strtoupper($dataUser->Role), 'PIS') !== false)
			{
				$data['dataTransaksi']=$this->m_BC->getResourceBTB($data['tglhariini'],$pemasok);
				$this->load->view('template/datatable/penerimaanbc2',$data);
			}
			else if(strpos(strtoupper($dataUser->Role), 'ACC') !== false)
			{
				$data['dataTransaksi']=$this->m_BC->getResourcePO($data['tglhariini'],$pemasok);
				$this->load->view('template/datatable/penerimaanbc2',$data);
			}
			else if(strpos(strtoupper($dataUser->Role), 'PIC') !== false)
			{
				$data['dataTransaksi']=$this->m_BC->getResourcePO($data['tglhariini'],$pemasok);
				$this->load->view('template/datatable/penerimaanbc2',$data);
			}
			else if(strpos(strtoupper($dataUser->Role), 'WHS') !== false)
			{
				$data['dataTransaksi']=$this->m_BC->getResourcePO($data['tglhariini'],$pemasok);
				$this->load->view('template/datatable/penerimaanbc2',$data);
			}
			else if(strpos(strtoupper($dataUser->Role), 'ESM') !== false)
			{
				$data['dataTransaksi']=$this->m_BC->getResourcePO($data['tglhariini'],$pemasok);
				$this->load->view('template/datatable/penerimaanbc2',$data);
			}
		}
	}
	function getModalDeleteBC()
	{
		$xxx=json_decode($this->input->post('jsonDelete'));
		$data['jenisBC']=$xxx[0] ->jenisBC;
		$data['jumlahdidelete']=count($xxx);
		$data['json']=json_encode($this->input->post('jsonDelete'));
		$this->load->view('template/modal/deleteBC',$data);		
	}
	function getModalUpdateBC()
	{
		$data['isDelete']= $this->input->post('isDelete');
		$id= $this->input->post('id');
		$data['jenis']= $this->input->post('jenis');
		$data['titlelabel']='';//'Tabel Penerimaan Kelapa RMP';
		$data['dataBC']=$this->m_BC->getBCbyID($id);
		$dataBC=$data['dataBC'];		
		$data['IDDetail']=$dataBC->IdDetail;
		$data['pemasok']=$dataBC->Pemasok;
		$data['voy']=$dataBC->Voy;
		$data['NoNota']=$dataBC->NoNota;
		$data['tglPabean']=$dataBC->TanggalPabean;
		$data['noPabean']=$dataBC->NoPabean;
		$data['noBL']=$dataBC->NoBL;
		$data['tglnota']=$dataBC->TanggalNota;
		$data['noInvoice']=$dataBC->NoInvoice;
		$data['tglinvoice']=$dataBC->TanggalInvoice;
		$data['tanggalBL']=$dataBC->TanggalBL;
		$data['kodeBarang']=$dataBC->KodeBarang;
		$data['namaBarang']=$dataBC->NamaBarang;
		$data['satuan']=$dataBC->Sat;
		$data['valas']=$dataBC->Valas;
		$data['kodeHS']=$dataBC->KodeHS;
		$data['ket']=$dataBC->Keterangan;
		$data['tarif']=$dataBC->Tarif;
		$data['jumlah']=$dataBC->Qty;
		$data['cif']=$dataBC->CIF;
		$data['total']=$dataBC->Total;
		$data['PDRIBayar']=$dataBC->PDRIBayar;
		$data['PDRIBebas']=$dataBC->PDRIBebas;
		$this->load->view('template/modal/editBC',$data);
	}
	function cekSudahTersimpan()
	{
		$hasil='';
		$json= $this->input->post('json');
		$array=json_decode($json);
		$arraycontoh=$array[0];
		$dataSudahTersimpan=$this->m_BC->getBCSudahTersimpanbyTanggal($arraycontoh->JenisBC,$arraycontoh->TglNota,$arraycontoh->Pemasok);
		foreach ($array as $key => $value) 
		{
			foreach ($dataSudahTersimpan as $key => $value2) 
			{
				if($value->NoNota==$value2->NoNota&&$value->KodeBarang==$value2->KodeBarang)
				{
					$hasil='true';
				}
			}			
		}
		echo $hasil;
	}
	function insertBC()
	{
		$json=$this->input->post('json');
		$arrayOfObject=json_decode($json);//print_r($arrayOfObject);
		$dataUser=$this->dataUser;
		foreach ($arrayOfObject as $key => $value) 
		{			
			$Idmax=$this->m_BC->getIdMaxBC();
			if($value->TglPabean==''){$tglPabean=null;}
			else{$tglPabean=substr($value->TglPabean, 6,4).'-'.substr($value->TglPabean, 3,2).'-'.substr($value->TglPabean, 0,2);}
			if($value->TglInvoice==''){$tglInvoice=null;}
			else{$tglInvoice=substr($value->TglInvoice, 6,4).'-'.substr($value->TglInvoice, 3,2).'-'.substr($value->TglInvoice, 0,2);}
			if($value->TglNota==''){$tglNota=null;}
			else{$tglNota=substr($value->TglNota, 6,4).'-'.substr($value->TglNota, 3,2).'-'.substr($value->TglNota, 0,2);}
			$tipe=null;
			if(strpos(strtoupper($value->JenisBC), 'IN') !== false)
			{$tipe=0;}
			else if(strpos(strtoupper($value->JenisBC), 'FTZ') !== false){{$tipe=0;}}
			else {$tipe=1;}
			$Buyer='';
			if($value->Buyer==''){$Buyer=$value->Pemasok;}
			else{$Buyer=$value->Buyer;}
			if($value->TglBL==''){$tglBL=null;}
			else{$tglBL=substr($value->TglBL, 6,4).'-'.substr($value->TglBL, 3,2).'-'.substr($value->TglBL, 0,2);}


			$qty=(string)$value->Jumlah;
			$cif=(string)$value->CIF;
			$total=(string)$value->Total;
			if($qty==''){$qty=0;}
			if($cif==''){$cif=0;}
			if($total==''){$total=0;}
			$BC = array('IdDetail'=>($Idmax->Id+1),'JenisBC'=>$value->JenisBC,'Tipe'=>$tipe,'Voy'=>$value->NoVoy,'NoPabean'=>$value->NoPabean,'NoInvoice'=>$value->NoInvoice,'NoBL'=>$value->NoBL,'NoNota'=>$value->NoNota,'TanggalPabean'=>$tglPabean,'TanggalInvoice'=>$tglInvoice,'TanggalBL'=>$tglBL,'TanggalNota'=>$tglNota,'Pemasok'=>$Buyer,'KodeBarang'=>$value->KodeBarang,'NamaBarang'=>$value->NamaBarang,'KodeHS'=>$value->KodeHS,'Tarif'=>$value->Tarif,'Sat'=>$value->Satuan,'Valas'=>$value->Valas,'CIF'=>$cif,'Qty'=>$qty,'Total'=>$total,'PDRIBayar'=>$value->PDRIBayar,'PDRIBebas'=>$value->PDRIBebas,'Keterangan'=>$value->Keterangan,'CreatedBy'=>$dataUser->Nik,'CreatedTime'=>date('Y-m-d H:i:s'),'UpdatedBy'=>null,'UpdatedTime'=>null,'DeletedBy'=>null,'DeletedTime'=>null,'IsDeleted'=>0,'IsApproved'=>0,'AprovedBy'=>null,'AprovedTime'=>null);
			$this->m_BC->insertBC($BC);
		}
	}
	function editBC()
	{
		$json=$this->input->post('json');
		$object=json_decode($json);
		//print_r($object);
		$dataUser=$this->dataUser;
		$tglNota=null;$tglInvoice=null;
		if($object->TglNota!=''||$object->TglInvoice!='')
		{
			$tglNota=substr($object->TglNota, 6,4).'-'.substr($object->TglNota, 3,2).'-'.substr($object->TglNota, 0,2);
			$tglInvoice=substr($object->TglInvoice, 6,4).'-'.substr($object->TglInvoice, 3,2).'-'.substr($object->TglInvoice, 0,2);
		}
		$cif=null;$qty=null;$total=null;$PDRIBayar=null;$PDRIBebas=null;
		if($object->CIF!=''){$cif=(string)$object->CIF;}
		if($object->Jumlah!=''){$qty=(string)$object->Jumlah;}
		if ($object->Total!='') {$total=(string)$object->Total;}
		$pemasok='';
		if($object->Pemasok2!='')
		{
			$pemasok=$object->Pemasok2;
		}else{$pemasok=$object->Pemasok1;}
		$this->m_BC->updateBC($object->NoNota,$object->NoPabean,$object->NoBL,$tglNota,$object->KodeHS,$object->Tarif,$cif,$qty,$total,$object->PDRIBayar,$object->PDRIBebas,$tglInvoice,$object->NoInvoice,$object->IdDetail,$object->Satuan,$object->Valas,$pemasok);
	}
	function deleteBC()
	{
		$iddetail=$this->input->post('iddetail');
		$dataUser=$this->dataUser;
		$this->m_BC->deleteBC($dataUser->Nik,date('Y-m-d H:i:s'),$iddetail);
	}
	function getSupplierAll()
	{
		$supplier=$this->input->post('supplier');
		$supplierArray=$this->m_BC->getSupplierAll($supplier);
		echo json_encode($supplierArray);
	}
	function getKodeItem()
    {
    	$this->load->model('m_mutasi');
        $val= $this->input->post('val');
        $xxx=$this->m_mutasi->getItem($val);
        echo json_encode($xxx);
    }
    function getKodeProduct()
    {
    	$this->load->model('m_mutasi');
        $val= $this->input->post('val');
        $xxx=$this->m_mutasi->getProduct($val);
        echo json_encode($xxx);
    }
    function getSatuanAll()
	{
		$satuan=$this->input->post('satuan');
		$satuanArray=$this->m_BC->getSatuanAll($satuan);
		echo json_encode($satuanArray);
	}
	function getValasAll()
	{
		$satuan=$this->input->post('valas');
		$satuanArray=$this->m_BC->getValasAll($satuan);
		echo json_encode($satuanArray);
	}
}
