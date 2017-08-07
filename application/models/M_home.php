<?php

class M_home extends CI_Model {
    function __construct() {
        parent::__construct();
    }
    function sentMessage($data)
    {
        $this->db->insert("tblmessage",$data);
    }
}
