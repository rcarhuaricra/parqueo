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

    public function listarCuadras($turno, $mes) {
        $sql = "SELECT * FROM `mp_tareaje`
                WHERE id_turno='$turno' AND DATE_FORMAT(fecha_tarea, '%m') LIKE '%$mes%'";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return FALSE;
        } else {
            $sql = "SELECT DISTINCT * FROM `mp_cuadras` CU
                INNER JOIN `mpcalle` CA ON CU.id_via=CA.codvia
                INNER JOIN `mp_turno` TU ON TU.id_turno='$turno'";
            $consulta = $this->db->query($sql);
            return $consulta->result();
        }
    }

    public function listarUsuarios() {
        $sql = "SELECT * FROM `mpuser` U 
                INNER JOIN mproles R ON U.IDROL =R.IDROL
                WHERE R.txtrol='PARQUEADOR'";
        $consulta = $this->db->query($sql);
        return $consulta->result();
    }

    public function guardarTareajeMasivo($insertTareaje) {
        $query = $this->db->insert_batch('mp_tareaje', $insertTareaje);
        if ($query) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function tablaEditarTareaje($fecha, $calle, $horario) {
        $sql = "SELECT * FROM `mp_tareaje` T
                INNER JOIN `mp_cuadras` CU ON T.`id_cuadras`=CU.`id_cuadras`
                INNER JOIN `mpcalle` CA ON CU.`id_via`=CA.`codvia`
                INNER JOIN `mpuser` U ON T.`iduser_parqueador`=U.`iduser`
                INNER JOIN `mp_turno` TU ON T.`id_turno`=TU.`id_turno`
                WHERE T.`fecha_tarea`='$fecha' AND CA.`codvia`='$calle' AND TU.`id_turno`='$horario'";
        $consulta = $this->db->query($sql);
        return $consulta->result();
    }

    public function usuarioParquedor($id) {
        $sql = "SELECT * FROM `mp_tareaje` T
                INNER JOIN `mpuser` U ON T.`iduser_parqueador`=U.`iduser`
                INNER JOIN `mp_turno` TU ON TU.`id_turno`=T.`id_turno`
                WHERE T.`id_tareaje`='$id'";
        $query = $this->db->query($sql);
        return $query->row();
    }
    public function updateParqueador($id, $user){
         $sql = "UPDATE `mp_tareaje` T
                SET `iduser_parqueador`=$user
                WHERE T.`id_tareaje`='$id'";
         $query = $this->db->query($sql);
         return $query;
    }

}
