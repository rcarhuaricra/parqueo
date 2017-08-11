<?php

class parqueo_model extends CI_Model {

    public function guardarNuevoParqueo($data) {
        $placa = $data['placa'];
        $id_tareaje = $data['id_tareaje'];
        $iduserreg = $data['iduserreg'];
        $lado = $data['lado'];
        $estacionamiento = $data['estacionamiento'];
        $sql = "CALL insertEstacionamiento('$placa','$id_tareaje','$iduserreg','$lado','$estacionamiento')";
        $query=$this->db->query($sql);
        if (isset($query)) {
            return $query->row()->ID;
        } else {
            show_error('Error!');
        }
    }

    public function generarticket($nuevoId, $iduser) {
        $sql = "SELECT 
                v.idvehiculo, v.placa, v.horainicio, v.horafinal, CONCAT(c.tipoVia,' ',c.nombrevia) AS via, c.tiempoparqueo
                FROM `mpvehiculo` v
                INNER JOIN `mpcalle` c ON c.codvia=v.codvia
                INNER JOIN `mpuser` u ON v.iduserreg=u.iduser
                WHERE v.idvehiculo='$nuevoId'
                AND v.iduserreg='$iduser'";

        if ($this->db->query($sql)) {
            return $this->db->query($sql)->row();
        } else {
            return FALSE;
        }
    }

    public function vehiculosParqueados() {
        $id = $_SESSION["iduser"];
        $sql = "CALL selectParqueado($id)";
        $query = $this->db->query($sql);
        return $query->result();
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
