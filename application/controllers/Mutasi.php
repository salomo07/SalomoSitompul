<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mutasi extends CI_Controller {
	function __construct() {
        parent::__construct();
        $this->load->model('m_mutasi');
        $this->dataUser=json_decode($this->input->cookie('dataUser',true));
        $this->general->validasiTokenLogin();        
        $this->general->accessController('MUTASI',json_decode($this->input->cookie('dataAksesController',true))); 
    }
    function index()
	{
		$data['header']=$this->session->userdata('header');
		$data['asideleft']=$this->session->userdata('asideleft');
        if(!isset($_GET['jenis']))
        {
            $dataAksesBC=$this->session->userdata('dataAksesBC');
            $this->redirectBC($dataAksesBC);
        }
        $data['title']='';
        if($_GET['jenis']=='MPK')
        {
            $data['title']='Input Mutasi Mesin & Peralatan Kantor';
        }
        elseif ($_GET['jenis']=='MBS') 
        {
            $data['title']='Input Mutasi Barang Sisa & Scrap';
        }
        elseif ($_GET['jenis']=='MBJ') 
        {
            $data['title']='Input Mutasi Barang Jadi';
        }
        elseif($_GET['jenis']=='MBB')
        {
            $data['title']='Input Mutasi Barang Baku & Penolong';
        }
        $data['jenis']=$_GET['jenis'];
		$this->load->view('mutasi',$data);
	}
    function getDataMutasi()
    {
        $jenis= $this->input->post('jenis');
        $tgl= $this->input->post('tgl');
        $data['jenis']=$jenis;
        $data['dataMutasi']=$this->m_mutasi->getMutasiHarian($tgl,$jenis);
        $this->load->view('template/datatable/penerimaanmutasi',$data);
    }
    function redirectBC($dataAksesBC)
    {
        foreach ($dataAksesBC as $key => $value) 
        {
            if($value->IdMutasi!='')
            {
                redirect('InputMutasi?jenis='.$value->IdMutasi);
            }            
        }
    }
    function getModalAddMutasi()
    {
        $data['jenis']=$this->input->post('jenis');
        $data['dataUser']=$this->dataUser;
        $this->load->view('template/modal/addmutasi',$data);
    }
    function getModalEditMutasi()
    {
        $id=$this->input->post('id');
        $data['dataUser']=$this->dataUser;
        $dataMutasi=$this->m_mutasi->getMutasiByID($id);//print_r($dataMutasi);
        $data['id']=$dataMutasi->IdDetail;
        $data['kodebarang']=$dataMutasi->KodeBarang;
        $data['namabarang']=$dataMutasi->NamaBarang;
        $data['satuan']=$dataMutasi->Sat;
        $data['saldoawal']=$dataMutasi->SaldoAwal;
        $data['pemasukan']=$dataMutasi->Pemasukan;
        $data['pengeluaran']=$dataMutasi->Pengeluaran;
        $data['penyesuaian']=$dataMutasi->Penyesuaian;
        $data['saldoakhir']=$dataMutasi->SaldoAkhir;
        $data['stokopname']=$dataMutasi->StokOpname;
        $data['selisih']=$dataMutasi->Selisih;
        $data['keterangan']=$dataMutasi->Keterangan;
        $this->load->view('template/modal/editmutasi',$data);
    }
    function getMasterItem()
    {
        $sumber= $this->input->post('sumber');
        $xxx=$this->m_mutasi->getMasterItem($sumber);
        echo json_encode($xxx);
    }
    function getKodeProduct()
    {
        $val= $this->input->post('val');
        $xxx=$this->m_mutasi->getProduct($val);
        echo json_encode($xxx);
    }
    
    function saveMutasi()
    {
        $arrayOfObject= $this->input->post('arrayOfObject');//print_r($arrayOfObject);
        $arrayOfObject=json_decode($arrayOfObject);//print_r($arrayOfObject);
        $dataUser=$this->dataUser;
        $arrayDataSama=array();
        foreach ($arrayOfObject as $key => $value) 
        {
            $tanggalMutasi=substr($value->TanggalMutasi, 6,4).'-'.substr($value->TanggalMutasi, 3,2).'-'.substr($value->TanggalMutasi, 0,2);
            $datasama=$this->m_mutasi->getTransaksiSama($value->KodeBarang,$tanggalMutasi,$value->JenisMutasi);
            $data=array('JenisMutasi'=>$value->JenisMutasi,'KodeBarang'=>$value->KodeBarang,'NamaBarang'=>$value->NamaBarang,'Sat'=>$value->Sat,'Pemasukan'=>$value->Pemasukan,'Pengeluaran'=>$value->Pengeluaran,'TanggalMutasi'=>$tanggalMutasi,'CreatedBy'=>$dataUser->Nik,'CreatedTime'=>date('Y-m-d H:i:s'),'RevisiId'=>0,'DeletedBy'=>null,'DeletedTime'=>null,'IsDeleted'=>0,'ApproveId'=>0,'SaldoAwal'=>$value->SaldoAwal,'SaldoAkhir'=>str_replace(',','.',str_replace('.', '', $value->SaldoAkhir)),'StokOpname'=>str_replace(',','.',str_replace('.', '', $value->StokOpname)),'IsCompleted'=>0);

            if(count($datasama)==0)
            {$this->m_mutasi->insertMutasi($data);}
            else{array_push($arrayDataSama, $datasama);}
        }
        echo json_encode($arrayDataSama);                
    }
    function editMutasi()
    {
        $id= $this->input->post('id');
        $objDetailMutasi= $this->input->post('objDetailMutasi');
        $objDetailMutasi=json_decode($objDetailMutasi);//print_r($objDetailMutasi);
        $dataUser=$this->dataUser;
        $this->m_mutasi->editMutasi($id,$objDetailMutasi->KodeBarang,$objDetailMutasi->NamaBarang,$objDetailMutasi->Sat,$objDetailMutasi->SaldoAwal,$objDetailMutasi->Pemasukan,$objDetailMutasi->Pengeluaran,$objDetailMutasi->Penyesuaian,$objDetailMutasi->SaldoAkhir,$objDetailMutasi->StokOpname,$objDetailMutasi->Selisih,$objDetailMutasi->Keterangan,$dataUser->Nik);
    }
    function getTransaksiAll()
    {
        $iditem= $this->input->post('iditem');
        $tgl= $this->input->post('tgl');
        $data['jenis']=$this->input->post('jenis');
        $dataTransaksiMutasi=$this->m_mutasi->hitungTransaksiBCAll($tgl,str_replace(' ', '', $iditem),$this->input->post('jenis'));
        $data['dataTransaksiMutasi']=$dataTransaksiMutasi;
        $dataTransaksiBC2=array();
        if($data['jenis']=='MPK')
        {      
            $this->load->view('template/datatable/penerimaanmutasi2',$data);
        }
        else if($data['jenis']=='MBS')
        {
            $this->load->view('template/datatable/penerimaanmutasi2',$data);
        }
        else if($data['jenis']=='MBJ')
        {
            $this->load->view('template/datatable/penerimaanmutasi2',$data);
        }
        else if($data['jenis']=='MBB')
        {
            if(count($dataTransaksiMutasi)!=0)
            {
                foreach ($dataTransaksiMutasi as $key => $value) 
                {
                    $dataz=array('KodeBarang'=>$value->KodeBarang,'NamaBarang'=>$value->NamaBarang,'Satuan'=>$value->Sat,'Pemasukan'=>$value->Pemasukan,'Pengeluaran'=>$value->Pengeluaran);
                    array_push($dataTransaksiBC2, $dataz);
                }
            }
            $data['dataTransaksiBC2']=$dataTransaksiBC2;         
            $this->load->view('template/datatable/penerimaanmutasi2',$data);
        }
        
    }
}
