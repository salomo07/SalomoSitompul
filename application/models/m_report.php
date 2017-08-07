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
    function getApprovalbyDateJenis($date,$jenis)
    {
        $query = $this->db->query("select * from tblBC where convert(nvarchar,TanggalPabean,105)='$date' and IsDeleted=0 and IsApproved=0 and JenisBC='$jenis';");
        return $query->result();
    }
    function approveBC($nik,$waktu,$iddetail)
    {
        $this->db->query("update tblBC set AprovedBy='$nik',AprovedTime='$waktu',IsApproved=1 where IdDetail=$iddetail");
    }
}
