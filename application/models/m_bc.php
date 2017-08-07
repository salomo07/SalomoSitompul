<?php

class m_bc extends CI_Model {
    // var $table = 'MyPSGInventory..viewBCInventory';
    // var $column_order = array('NoPabean','TanggalPabean'); //set column field database for datatable orderable
    // var $column_search = array('NoPabean','TanggalPabean','KodeBarang');
    // var $order = array('TanggalPabean' => 'desc');
    function __construct() {
        parent::__construct();
        // $this->dbRMP=$this->load->database('dbRMP', TRUE);
        // $this->dbRMP2=$this->load->database('dbRMP2', TRUE);
        // $this->dbMYPSG=$this->load->database('dbMYPSG', TRUE);
        // $this->dbPIC=$this->load->database('dbPIC', TRUE);
    }


    // private function getQuery()
    // {
    //     $this->db->from($this->table);
    //     $i = 0;
    //     foreach ($this->column_search as $emp) // loop column
    //     {
    //         if(isset($_POST['search']['value']) && !empty($_POST['search']['value'])){
    //         $_POST['search']['value'] = $_POST['search']['value'];
    //     }
    //     else
    //     {$_POST['search']['value'] = '';}
    //     if($_POST['search']['value']) // if datatable send POST for search
    //     {
    //         if($i===0) // first loop
    //         {
    //             $this->db->group_start();
    //             $this->db->like($emp), $_POST['search']['value']);
    //         }
    //         else
    //         {
    //             $this->db->or_like($emp), $_POST['search']['value']);
    //         }

    //         if(count($this->column_search) - 1 == $i) //last loop
    //             $this->db->group_end(); //close bracket
    //     }
    //     $i++;
    //     }

    //     if(isset($_POST['order'])) // here order processing
    //     {
    //     $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
    //     }
    //     else if(isset($this->order))
    //     {
    //     $order = $this->order;
    //         $this->db->order_by(key($order), $order[key($order)]);
    //     }
    // }
    // function get_employees()
    // {
    //     $this->_get_query();
    //     if(isset($_POST['length']) && $_POST['length'] < 1) {
    //         $_POST['length']= '10';
    //     } else
    //     $_POST['length']= $_POST['length'];

    //     if(isset($_POST['start']) && $_POST['start'] > 1) {
    //         $_POST['start']= $_POST['start'];
    //     }
    //     $this->db->limit($_POST['length'], $_POST['start']);
    //     //print_r($_POST);die;
    //     $query = $this->db->get();
    //     return $query->result();
    // }
    function getBCbyJenisBCDate($jenisBC,$date)
    {
        $query = $this->db->query("select * from viewBCInventory where JenisBC='$jenisBC' and TanggalPabean='$date'");
        return $query->result();
    }
    function getBCbyJenisBCDateRange($jenisBC,$start,$end='')
    {
        $query = $this->db->query("select * from MyPSGInventory.dbo.viewBCInventory where JenisBC='$jenisBC' and (convert(date,TanggalPabean,105) between convert(date,'$start',105) and convert(date,'$end',105))");
        return $query->result();
    }
    function getBCbyID($id)
    {
        $query = $this->db->query("select IdDetail,JenisBC,Voy,NoPabean,NoInvoice,NoBL,NoNota,convert(char,TanggalPabean,105) as TanggalPabean,convert(char,TanggalInvoice,105) as TanggalInvoice,convert(char,TanggalBL,105) as TanggalBL,convert(char,TanggalNota,105) as TanggalNota,Pemasok,KodeBarang,NamaBarang,KodeHS,Tarif,Sat,Valas,CIF,Qty,Total,PDRIBayar,PDRIBebas,Keterangan from tblBC where IdDetail=$id");
        return $query->row();
    }
    function getBCbyBTB($btb)
    {
        $query = $this->db->query("select * from MyPSGInventory.dbo.viewBCInventory where NoNota='$btb'");
        return $query->row();
    }
     function getBCSudahTersimpanbyTanggal($JenisBC,$tanggal,$pemasok)
    {
        $query = $this->db->query("select * from tblBC where JenisBC='$JenisBC' and convert(char,TanggalNota,105)='$tanggal' and Pemasok='$pemasok' and IsDeleted=0 and IsApproved=0");
        return $query->result();
    }
    function getDaftarTahunBC()
    {
        $query = $this->db->query("select year(TanggalPabean) as 'Tahun' from tblBC group by year(TanggalPabean) order by year(TanggalPabean) desc");
        return $query->result();
    }
    function getResourceRMP($tanggal,$pemasok)
    {
        $query = $this->dbRMP2->query("SELECT notaid as NoNota,convert(nvarchar,TglTrans,105) as TglNota,'' as 'Voy',ItemID as 'KodeBarang',ItemDescription as 'NamaBarang','PETANI KELAPA' as 'Pemasok',UPPER(UOM) as 'Satuan',Qty as Jumlah,Valas FROM [P1RMP].[dbo].[viewTransKelapaForIPLNew] v
            where convert(nchar,TGLTrans,105) = '$tanggal'");
        $resource= $query->result();
        $query2 = $this->db->query("SELECT NoNota from tblBC where convert(nchar,TanggalNota,105) = '$tanggal' and IsDeleted=0");
        $resource2= $query2->result();
        foreach ($resource as $key => $value)
        {
            foreach ($resource2 as $key2 => $value2)
            {
                if($value->NoNota==$value2->NoNota)
                {
                    unset($resource[$key]);
                }
            }
        }
        return $resource;
    }
    function getResourceBTB($tanggal,$pemasok)
     {
        $query = $this->db->query("SELECT * from viewBTBForBC2 where TanggalNota='$tanggal' and SupplierID='$pemasok'
        and NoNota not in (select NoNota from ITInventory.dbo.tblBC where isdeleted=0) order by NoNota asc");
        return $query->result();
    }
    function getResourcePO($tgl,$supplier)
    {
        $query = $this->dbMYPSG->query("SELECT * from viewDataPOBC where DeliveryDate = '$tgl' and MarketingID = '$supplier'");
        return $query->result();
    }
    function getResourcePOPemasok($tgl)
    {
        $query = $this->dbMYPSG->query("SELECT MarketingID  as Pemasok from viewDataPOBC where DeliveryDate= '$tgl' group by MarketingID");
        return $query->result();
    }
    function getResourceRMPPemasok($tanggal)
    {
        $query = $this->dbRMP2->query("SELECT 'PETANI KELAPA' as Pemasok");
        return $query->result();
    }
    function getResourceBTBPemasok($tanggal)
    {
        $query = $this->db->query("SELECT SupplierID,Pemasok from viewBTBForBC2 where convert(nvarchar,TanggalNota,105)='$tanggal' group by SupplierID,Pemasok");
        return $query->result();
    }
    function getIdMaxBC()
    {
        $query = $this->db->query("SELECT ISNULL(MAX(IdDetail),0) as Id FROM tblBC");
        return $query->row();
    }
    function insertBC($data)
    {
        $this->db->insert("tblBC",$data);
    }
    function updateBC($NoNota,$NoPabean,$NoBL,$TanggalNota,$KodeHS,$Tarif,$CIF,$Qty,$Total,$PDRIBayar,$PDRIBebas,$TanggalInvoice,$NoInvoice,$iddetail,$sat,$valas,$pemasok)
    {
        $this->db->query("update tblBC set NoPabean='$NoPabean',NoBL='$NoBL',TanggalNota='$TanggalNota',NoInvoice='$NoInvoice',KodeHS='$KodeHS',Tarif='$Tarif',Qty=$Qty,CIF=$CIF,Total=$Total,PDRIBayar='$PDRIBayar',PDRIBebas='$PDRIBebas',TanggalInvoice='$TanggalInvoice',Sat='$sat',Valas='$valas',NoNota='$NoNota',Pemasok='$pemasok' where IdDetail=$iddetail");
    }
    function deleteBC($user,$waktu,$iddetail)
    {
        $this->db->query("update tblBC set DeletedBy='$user',DeletedTime='$waktu',IsDeleted=1 where IdDetail=$iddetail");
    }
    function approveBC($user,$waktu,$iddetail)
    {
        $this->db->query("update tblBC set AprovedBy='$user',AprovedTime='$waktu',IsApproved=1 where IdDetail=$iddetail");
    }
    function updateBCApproved($checked,$user,$waktu,$id)
    {
        $this->db->query("update tblBC set IsApproved=$checked,AprovedBy='$user',AprovedTime ='$waktu' where IdDetail=$id");
    }
    function getSupplierAll($supplier)
    {
        $query = $this->dbPIC->query("SELECT Pemasok from viewSupplierMarketing4BC where Pemasok like '%$supplier%'");
        return $query->result();
    }
    function getSatuanAll($satuan)
    {
        $query = $this->db->query("SELECT Sat as Satuan from tblBC where Sat like '%$satuan%' group by Sat");
        return $query->result();
    }
    function getValasAll($satuan)
    {
        $query = $this->db->query("SELECT Valas from tblBC where Valas like '%$satuan%' group by Valas");
        return $query->result();
    }
}
