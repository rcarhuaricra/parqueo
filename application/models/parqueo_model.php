<?php

class parqueo_model extends CI_Model {

    public function guardarNuevoParqueo($data) {

        //$this->db->insert('mpvehiculo', $data);
        if ($this->db->insert('mpvehiculo', $data)) {
            return $this->db->insert_id();
        } else {
            return false;
        }
        //header("location:" . base_url());
    }

    public function generarticket($nuevoId, $iduser) {
        $sql = "SELECT 
                v.idvehiculo, v.placa, v.horainicio, v.horafinal, CONCAT(c.tipoVia,' ',c.nombrevia) AS via, c.tiempoparqueo
                FROM `mpvehiculo` v
                INNER JOIN `mpcalle` c ON c.codvia=v.codvia
                INNER JOIN `mpuser` u ON v.iduserreg=u.iduser
                WHERE v.idvehiculo='$nuevoId'
                AND v.iduserreg='$iduser'";
        
        if($this->db->query($sql)){
            return $this->db->query($sql)->row();
        }else{
            return FALSE;
        }
        
    }

    public function vehiculosParqueados() {
        $sql = "SELECT * FROM `mpvehiculo` v
        INNER JOIN `mpcalle` c ON c.codvia=v.codvia
        INNER JOIN `mpestadovehiculo` e ON e.idestado=v.idestado
        where v.idestado='1'";
        return $this->db->query($sql);
    }

    public function vehiculosCulminados() {
        $sql = "SELECT * FROM `mpvehiculo` v
        INNER JOIN `mpcalle` c ON c.codvia=v.codvia
        INNER JOIN `mpestadovehiculo` e ON e.idestado=v.idestado
        where v.idestado='2'";
        return $this->db->query($sql);
    }

    public function vehiculosDeposito() {
        $sql = "SELECT * FROM `mpvehiculo` v
        INNER JOIN `mpcalle` c ON c.codvia=v.codvia
        INNER JOIN `mpestadovehiculo` e ON e.idestado=v.idestado
        where v.idestado='3'";
        return $this->db->query($sql);
    }

    public function vehiculosEstado($estado) {
        $sql = "SELECT COUNT(*) AS cantidad FROM mpvehiculo WHERE idestado='$estado'";
        $query = $this->db->query($sql);
        return $query->row();
    }

}
