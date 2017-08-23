<?php

class Generales_model extends CI_Model {

    public function listarCalles() {
        $sql = "SELECT * FROM `mpcalle`";
        $squery=$this->db->query($sql);
        return $squery->result();
    }

}
