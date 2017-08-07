<?php

class m_mutasi extends CI_Model {
    function __construct() {
        parent::__construct();
        $this->dbMYPSG=$this->load->database('dbMYPSG', TRUE);
        $this->dbPIC=$this->load->database('dbPIC', TRUE);
    }
    function getMutasiHarian($date,$jenis)
    { 
        $query = $this->db->query("select * from tblMutasi m where convert(nvarchar,TanggalMutasi,105)='$date' and IsDeleted=0 and JenisMutasi='$jenis' and IsCompleted=0");
        return $query->result();
    }
    function getMutasiHarianApproved($date,$jenis) //Untuk Approval
    {
        $query = $this->db->query("select * from tblMutasi m join tblRevisiMutasi r on m.RevisiId=r.Id where convert(nvarchar,CreatedTime,105)='$date' and IsDeleted=0 and IsApproved=1 and JenisMutasi='$jenis'");
        return $query->result();
    }
    function getMutasiHarianApproved2($date,$jenis) //Untuk Approval
    {
        $query = $this->db->query("select * from tblMutasi m join tblApproveMutasi a on m.ApproveId=a.Id where convert(nvarchar,CreatedTime,105)='$date' and IsDeleted=0 and JenisMutasi='$jenis'");
        return $query->result();
    }
    function completeMutasi($id,$user)
    {
        $this->db->query("update tblMutasi set CompletedBy='$user', IsCompleted=1 where IdDetail=$id");
    }
    function getMasterItem($sumber)
    {
        $query = $this->db->query("SELECT * from viewMstItemUnion
        where Sumber = '$sumber'");
        return $query->result();
    }
    function getMutasiByID($id,$tahun,$jenis)
    {
        if($tahun==2016)
        {
            $query = $this->db->query("select IdDetail, KodeBarang, NamaBarang, Sat, isnull(SaldoAwal,0) as SaldoAwal, isnull(Pemasukan,0) as Pemasukan,isnull(Pengeluaran,0) as Pengeluaran,isnull(Penyesuaian,0) as Penyesuaian,isnull(SaldoAkhir,0) as SaldoAkhir, isnull(StokOpname,0) as StokOpname, isnull(Selisih,0) as Selisih, Keterangan FROM viewLaporanMutasi".$jenis." where IdDetail=$id");
        }
        $query = $this->db->query("select * from tblMutasi where IdDetail='$id' and IsDeleted=0");
        return $query->row();
    }
    function getYearMutasi()
    {
        $query =$this->db->query("select year(CreatedTime) as 'Year' FROM tblMutasi where IsDeleted=0
        group by year(CreatedTime)
        order by year(CreatedTime) desc");
        return $query->result();
    }
    function getMutasiByPriode($start,$end,$jenis)
    {
        $query ='';
        if(substr($start,-4)=='2016')
        {            
            $priode= substr($start, 3,2).substr($start, -2);
            $query =$this->db->query("select IdDetail, KodeBarang, NamaBarang, Sat, isnull(SaldoAwal,0) as SaldoAwal, isnull(Pemasukan,0) as Pemasukan,isnull(Pengeluaran,0) as Pengeluaran,isnull(Penyesuaian,0) as Penyesuaian,isnull(SaldoAkhir,0) as SaldoAkhir, isnull(StokOpname,0) as StokOpname, isnull(Selisih,0) as Selisih, Keterangan FROM viewLaporanMutasi".$jenis." where Priode ='$priode' order by Priode");
            if(count($query)==0)
            {$query =$this->db->query("select * FROM tblMutasi where IsDeleted=0 and JenisMutasi='$jenis' and TanggalMutasi between convert(datetime,'$start',105) and convert(datetime,'$end',105)");}
        }
        else
        {
            $query =$this->db->query("select * FROM tblMutasi where IsDeleted=0 and JenisMutasi='$jenis' and TanggalMutasi between convert(datetime,'$start',105) and convert(datetime,'$end',105)");
        }
        return $query->result();
    }
    function insertMutasi($data)
    {
        $this->db->insert('tblMutasi',$data);
    }
    function editMutasi($id,$kodebarang,$namabarang,$satuan,$saldoawal,$pemasukan,$pengeluaran,$penyesuaian,$saldoakhir,$stokname,$selisih,$keterangan,$user)
    {   
        $revisi=0;
        $data=$this->db->query('select top 1 (Revisi+1) as Revisi from tblRevisiMutasi where IdDetail= '.$id.' order by Id desc');
        $data=$data->row();
        if(count($data)==0){$revisi=1;}
        else{$revisi=$data->Revisi;}
        $dataRevisiMutasi=array('Revisi'=>$revisi,'IdDetail'=>$id,'RevisiBy'=>$user,'RevisiTime'=>date('Y-m-d H:i:s'),'IsApproved'=>0);
        $this->db->insert('tblRevisiMutasi',$dataRevisiMutasi);
        $this->db->query("update tblMutasi set KodeBarang='$kodebarang',NamaBarang='$namabarang',Sat='$satuan',SaldoAwal=$saldoawal,Pemasukan=$pemasukan,Pengeluaran=$pengeluaran,Penyesuaian=$penyesuaian,SaldoAkhir=$saldoakhir,StokOpname=$stokname,Selisih=$selisih,Keterangan='$keterangan',ApproveId=0,RevisiId=(select top 1 Id from tblRevisiMutasi order by Id desc) where IdDetail=$id");
    }
    function approveMutasi($id,$user)
    {
        $approve=0;
        $data=$this->db->query('select top 1 (Approve+1) as Approve from tblApproveMutasi where IdDetail= '.$id.' order by Id desc');
        $data=$data->row();
        if(count($data)==0){$approve=1;}
        else{$approve=$data->Approve;}
        $dataApproveMutasi=array('Approve'=>$approve,'IdDetail'=>$id,'ApproveBy'=>$user,'ApproveTime'=>date('Y-m-d H:i:s'));
        $this->db->insert('tblApproveMutasi',$dataApproveMutasi);
        $this->db->query("update tblRevisiMutasi set IsApproved1=1 where IdDetail=$id");

        $dataAppove1=$this->db->query("select IsApproved tblMutasi set IsApproved=1 where IdDetail=$id and IsApproved1=1");
        if(count($dataAppove1)==0)
        {$this->db->query("update tblMutasi set ApproveId=(select top 1 Id from tblApproveMutasi order by Id desc),IsApproved1=1 where IdDetail=$id");}
        else if(count($dataAppove1)>0)
        {$this->db->query("update tblMutasi set ApproveId=(select top 1 Id from tblApproveMutasi order by Id desc),IsApproved2=1 where IdDetail=$id");}
    }
    function getDataSamaPeriode($idbarang,$start,$end,$year)
    {
        $query = $this->db->query("select KodeBarang from tblMutasi where IsDeleted=0 and (Month(CreatedTime) between $start and $end) and year(CreatedTime) =$year and KodeBarang='$idbarang'");
        return $query->row();
    }
    function getTransaksiSama($kodeBarang,$tanggalmutasi,$jenismutasi)
    {
        $query = $this->db->query("select * from tblMutasi where KodeBarang='$kodeBarang' and TanggalMutasi='$tanggalmutasi' and JenisMutasi='$jenismutasi'");
        return $query->row();
    }
    function hitungTransaksiBCAll($tanggal,$iditem,$jenis)
    {
        if(strtoupper($jenis)=='MPK')
        {
            $query = $this->db->query("EXEC [dbo].[spTransaksiMutasiMPK] @TanggalPabean = N'$tanggal'");            
        }
        elseif(strtoupper($jenis)=='MBS')
        {
            $query = $this->db->query("EXEC [dbo].[spTransaksiMutasiMBS] @TanggalPabean = N'$tanggal'"); 
        }
        elseif(strtoupper($jenis)=='MBJ')
        {
            $query = $this->db->query("EXEC [dbo].[spTransaksiMutasiMBJ] @TanggalPabean = N'$tanggal'"); 
        }
        elseif(strtoupper($jenis)=='MBB')
        {
            $query = $this->db->query("EXEC [dbo].[spTransaksiMutasiMBB] @TanggalPabean = N'$tanggal'");
        }
        return $query->result();//Mencari jumlah item masuk
    }
}
