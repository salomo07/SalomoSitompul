<?php

class m_login extends CI_Model {
    function __construct() {
        parent::__construct();
    }
    function getUserData($user,$pass)
    {
        $query = $this->db->query("select u.Id as IdUser, * from tblUser u join tblRole r on u.Role=r.IdRole join tblDepartement d on d.Id=r.IdDept  where Username = '$user' and Password='$pass'");
        return $query->row();
    }
    function getUserDatabyUsername($username)
    {
        $query = $this->db->query("select * from tblUser u join tblRole r on u.Role=r.IdRole  where Username = '$username'");
        return $query->row();
    }
    function getUserToken($user,$ip,$host,$token)
    {
        $query = $this->db->query("select * from tblLoginLog where Username = '$user' and IP='$ip' and Host='$host' and Token='$token'");
        return $query->row();
    }
    function insertLoginLog($data)
    {
        $this->db->insert("tblLoginLog",$data);
    }
    function updateSignout($idUser)
    {
        $date=date("Y-m-d H:i:s");
        $this->db->query("update tblLoginLog set Waktu_Out = '$date' where ID_Log = (select top 1 ID_Log from tblLoginLog order by ID_Log desc)");
    }
    function verifyPassword($idUser,$old)
    {
        $query = $this->db->query("select * from tblUser where Id=$idUser and Password='$old'");
        return $query->row();
    }
    function updatePassword($idUser,$new)
    {
        $this->db->query("update tblUser set Password='$new' where Id=$idUser");
    }
    function getAksesMenuHeader($role)
    {
        $query = $this->db->query("select * from tblAksesMenuHeaderNew a join tblMenuHeader m on m.IdMenu=a.IdMenu
        where IdRole=$role order by m.IdMenu asc");
        return $query->result();
    }
    
    function getAksesMenuAside($role)
    {
        $query = $this->db->query("select * from tblAksesMenuAsideNew a join tblMenuAside m on m.IdMenu=a.IdMenu
        where IdRole=$role order by m.IdMenu asc");
        return $query->result();
    }
    function getSubMenuHeader($IdRole,$IdMenu)
    {
        $query = $this->db->query("select * from tblMenuHeader2 h join tblAksesMenuHeader2 a on a.IdMenu2=h.IdMenu2 where IdRole=$IdRole and IdMenu=$IdMenu");
        return $query->result();
    }
    function getSubMenuAside($IdRole,$IdMenu)
    {
        $query = $this->db->query("select * from tblMenuAside2 h join tblAksesMenuAside2 a on a.IdMenu2=h.IdMenu2 where IdRole=$IdRole and IdMenu=$IdMenu");
        return $query->result();
    }
    function getAksesBC($role)
    {
        $query = $this->db->query("select * from tblMenuHeader2 h join tblAksesMenuAside2 a on a.IdMenu2=h.IdMenu2 where IdRole=$role");
        return $query->result();
    }
    function getHistorybyDateRange($start,$end)
    {
        $query = $this->db->query("select *,r.Role from tblLoginLog l join tblRole r on l.Role=r.IdRole where (convert(date,Waktu_In,105) between convert(date,'$start',105) and convert(date,'$end',105))");
        return $query->result();
    }
    function getHistorybyDateRangeUsername($start,$end,$username)
    {
        $query = $this->db->query("select *,r.Role from tblLoginLog l join tblRole r on l.Role=r.IdRole where Username like '%$username%' and (convert(date,Waktu_In,105) between convert(date,'$start',105) and convert(date,'$end',105))");
        return $query->result();
    }
    function getUsername($key)
    {
        $query = $this->db->query("select Username from tblUser where Username like '%$key%'");
        return $query->result();
    }
}
