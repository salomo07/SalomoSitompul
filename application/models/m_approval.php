<?php

class m_approval extends CI_Model {
    function __construct() {
        parent::__construct();

    }
    function getApprovalbyDate($date)
    {
        $query = $this->db->query("select * from tblBC where convert(nvarchar,TanggalPabean,105)='$date' and IsDeleted=0 and IsApproved=0;");
        return $query->result();
    }
    function getApprovalbyDateJenis($date,$jenis,$deptid)
    {        $query = $this->db->query("select IdDetail,Tipe,JenisBC,Voy,NoPabean,NoInvoice,NoBL,NoNota,TanggalPabean,TanggalInvoice,TanggalBL,TanggalNota,Pemasok,KodeBarang,NamaBarang,KodeHS,Tarif,Sat,Valas,CIF,Qty,Total,PDRIBayar,PDRIBebas,NoSkep,t.Keterangan,CreatedBy,CreatedTime,UpdatedBy,t.UpdatedTime,DeletedBy,DeletedTime,Isdeleted,IsApproved,t.AprovedBy,t.AprovedTime from tblBC t join tblUser u on u.Nik=t.CreatedBy join tblRole r on r.IdRole=u.Role where convert(nvarchar,TanggalPabean,105)='$date' and IsDeleted=0 and IsApproved=0 and JenisBC='$jenis' and r.IdDept=$deptid;");
        return $query->result();
    }
    function approveBC($nik,$waktu,$iddetail)
    {
        $this->db->query("update tblBC set AprovedBy='$nik',AprovedTime='$waktu',IsApproved=1 where IdDetail=$iddetail");
    }
}
