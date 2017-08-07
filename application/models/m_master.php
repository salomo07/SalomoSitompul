<?php

class m_master extends CI_Model {
    function __construct() {
        parent::__construct();
    }
    function getRole()
    {
        $query = $this->db->query("select * from tblRole order by Role asc");
        return $query->result();
    }
    function getUser()
    {
        $query = $this->db->query("select * from tblUser u join tblRole r on u.Role=r.IdRole");
        return $query->result();
    }
    function getUserSama($user)
    {
        $query = $this->db->query("select * from tblUser u join tblRole r on u.Role=r.IdRole where Username='$user'");
        return $query->result();
    }
    function getRoleSama($role)
    {
        $query = $this->db->query("select * from tblRole where Role='$role'");
        return $query->result();
    }
    function getUserbyID($id)
    {
        $query = $this->db->query("select * from tblUser u join tblRole r on u.Role=r.IdRole where Id=$id");
        return $query->row();
    }
    function getRolebyID($id)
    {
        $query = $this->db->query("select * from tblRole where IdRole=$id");
        return $query->row();
    }
    function insertUser($nik,$username,$fullname,$role)
    {
        $query = $this->db->query("select isnull(max(Id),0) as 'Id' from tblUser");
        $IdMax=$query->row();
        $pass=base64_encode('12345');
        $dataUser=array('Id'=>($IdMax->Id)+1,'Nik' =>$nik,'Username'=>$username,'Password'=>$pass,'Fullname'=>$fullname,'Role'=>$role);
        $this->db->insert('tblUser',$dataUser);
    }
    function insertRole($role,$ket,$kepala,$dept)
    {
        $query = $this->db->query("select isnull(max(IdRole),0) as 'Id' from tblRole");
        $IdMax=$query->row();
        $dataUser=array('IdRole'=>($IdMax->Id)+1,'Role' =>$role,'Keterangan'=>$ket,'Kepala'=>$kepala,'IdDept'=>$dept);
        $this->db->insert('tblRole',$dataUser);
    }
    function editUser($id,$fullname,$role)
    {
        $query = $this->db->query("update tblUser set Fullname='$fullname',Role=$role where Id=$id");
    }
    function editRole($id,$role,$keterangan)
    {
        $query = $this->db->query("update tblRole set Role='$role',Keterangan='$keterangan' where IdRole=$id");
    }
    function deleteUser($id)
    {
        $query = $this->db->query("delete tblUser where Id=$id");
    }
    function deleteRole($id)
    {
        $query = $this->db->query("delete tblRole where IdRole=$id");
    }
    function getIDMaxRole($value='')
    {
        $query = $this->db->query("select isnull(max(IdRole),0) as 'Id' from tblRole");
        return $query->row();
    }
    function getAksesMenu()
    {
        $query = $this->db->query("select * from tblAksesMenuHeaderNew a join tblMenuHeader m on m.IdMenu= a.IdMenu join tblRole r on r.IdRole=a.IdRole");
        return $query->result();
    }
    function getMenu()
    {
        $query = $this->db->query("select * from tblMenuHeader");
        return $query->result();
    }
    function getMenu2()
    {
        $query = $this->db->query("select * from tblMenu2");
        return $query->result();
    }
    function getAksesSubMenu($idrole,$idmenu,$idmenu2)
    {
        $query = $this->db->query("select * from tblAksesMenuHeader2 a join tblMenuHeader2 m on a.IdMenu2=m.IdMenu2
        where a.IdRole=$idrole and a.IdMenu2=$idmenu2 and IdMenu=$idmenu");
        return $query->result();
    }
    function insertAksesMenu($data,$tbl)
    {
        $this->db->insert($tbl,$data);
    }
    function insertSubMenu($data,$tbl)
    {
        $this->db->insert($tbl,$data);
    }
    function getSubMenubyID($id)
    {
        $query=$this->db->query("select * from tblMenuHeader2 where IdMenu=$id");
        return $query->result();
    }
    function getAksesMenuSama($idrole,$idmenu)
    {
        $query = $this->db->query("select * from tblAksesMenuHeaderNew a where a.IdRole=$idrole and IdMenu=$idmenu");
        return $query->result();
    }
    function getStockControl()
    {
        $query = $this->db->query("select * from tblStockAwal where IsDeleted=0");
        return $query->result();
    }
    function insertStockControl($data)
    {
        $this->db->insert('tblStockAwal',$data);
    }
    function getStockControlbyIdItem($itemid)
    {
        $query = $this->db->query("select * from viewMstItemUnion where ItemID='$itemid'");
        return $query->row();
    }
    function getUnionIdItem($sumber)
    {
        $query = $this->db->query("select ItemID, left(Name,135) as Name from viewMstItemUnion where Sumber='$sumber'");
        return $query->result();
    }
    function getDepartementAll()
    {
        $query = $this->db->query("select * from tblDepartement");
        return $query->result();
    }
}
