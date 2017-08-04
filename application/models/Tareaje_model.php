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

}
