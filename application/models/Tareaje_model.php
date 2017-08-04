<?php

class Tareaje_model extends CI_Model {

    public function BuscaParquedor() {
        $sql = "SELECT iduser, CONCAT(USER_NAME, ' ', USER_APE_PAT, ' ',USER_APE_MAT) AS USER FROM `mpuser`";
        return $consulta = $this->db->query($sql);
    }

    public function Buscaturno() {
        $sql = "SELECT * FROM mp_turno";
        return $consulta = $this->db->query($sql);
    }

    public function listarCuadras($turno) {
        $sql = "SELECT DISTINCT * FROM `mp_cuadras` CU
                INNER JOIN `mpcalle` CA ON CU.id_via=CA.codvia
                INNER JOIN `mp_turno` TU ON TU.id_turno='$turno'";
        $consulta = $this->db->query($sql);
        return $consulta->result();
    }

    public function listarUsuarios() {
        $sql = "SELECT * FROM `mpuser` U 
                INNER JOIN mproles R ON U.IDROL =R.IDROL";
        $consulta = $this->db->query($sql);
        return $consulta->result();
    }

}
