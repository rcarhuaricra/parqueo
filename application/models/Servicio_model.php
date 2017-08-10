<?php

class Servicio_model extends CI_Model {

    public function Parqueados() {
        $sql = "SELECT * FROM `mpvehiculo` v
        INNER JOIN `mpcalle` c ON c.codvia=v.codvia
        INNER JOIN `mpestadovehiculo` e ON e.idestado=v.idestado
        where v.idestado='1'";
        $query= $this->db->query($sql);
        return $query->result();
    }

}
