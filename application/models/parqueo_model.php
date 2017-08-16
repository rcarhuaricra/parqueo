<?php

class parqueo_model extends CI_Model {

    public function guardarNuevoParqueo($data) {
        $placa = $data['placa'];
        $id_tareaje = $data['id_tareaje'];
        $iduserreg = $data['iduserreg'];
        $lado = $data['lado'];
        $estacionamiento = $data['estacionamiento'];
        $userreg = $_SESSION['iduser'];
        $sql = "CALL insertEstacionamiento('$placa','$id_tareaje','$iduserreg','$lado','$estacionamiento')";
        $query = $this->db->query($sql);
        if (isset($query)) {
            return $query->row()->ID;
        } else {
            show_error('Error!');
        }
    }

    public function generarticket($nuevoId) {
        $sql = "SELECT VE.`placa`, VE.`horainicio`, VE.`horafinal`, CONCAT(CA.`tipoVia`,' ',CA.`nombrevia`,' Cdra. ',CU.`cuadra`) AS via, CA.`tiempoparqueo` , VE.`lado`, VE.`casillero` FROM `mpvehiculo` VE
                INNER JOIN `mp_tareaje` TA ON VE.`id_tareaje`=TA.`id_tareaje`
                INNER JOIN `mp_cuadras` CU ON CU.`id_cuadras`=TA.`id_cuadras`
                INNER JOIN `mpcalle` CA ON CA.`codvia`=CU.`id_cuadras`
                WHERE VE.`idvehiculo`='$nuevoId'";
        $query = $this->db->query($sql);
        if ($query) {
            return $query->row();
        } else {
            return FALSE;
        }
    }

    public function vehiculosEstado($estadoVehiculo) {
        $iduser = $_SESSION["iduser"];
        
        $sql = "CALL selectParqueado($iduser,$estadoVehiculo)";
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
        $iduser = $_SESSION["iduser"];
        $estadoVehiculo = REMOLCADO;
        $sql = "CALL selectParqueado($iduser,$estadoVehiculo)";
        $query = $this->db->query($sql);
        return $query->result();
    }
    public function updateEstadoVehiculo($estado, $user, $id) {
        $sql="CALL update_mpvehiculo('$estado','$user','$id')";
        $query = $this->db->query($sql);
        return $query;
    }

    /*public function vehiculosEstado($estado) {
        $sql = "SELECT COUNT(*) AS cantidad FROM mpvehiculo WHERE idestado='$estado'";
        $query = $this->db->query($sql);
        return $query->row();
    }*/

}
