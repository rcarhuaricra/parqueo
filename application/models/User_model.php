<?php

class User_model extends CI_Model {

    public function getUser($email, $pass) {
        $sql = "SELECT * FROM `mpuser` U
                INNER JOIN `mproles` R ON U.`idrol` = R.`idrol`
                WHERE email = '$email' AND PASSWORD ='$pass'";
        $consulta = $this->db->query($sql);
        $row = $consulta->row();
        if ($row->idrol == ADMINISTRADOR) {
            $data = array(
                'login' => TRUE,
                'iduser' => $row->iduser,
                'nombre' => $row->user_name . " " . $consulta->user_ape_pat . " " . $consulta->user_ape_mat,
                'email' => $row->email,
                'idrol' => $row->idrol,
                'txtrol' => $row->txtrol
            );
            $this->session->set_userdata($data);
        } elseif ($row->idrol == PARQUEADOR) {
            $sql1 = "SELECT * FROM `mp_tareaje` TA
                    INNER JOIN `mpuser` U ON  TA.`iduser_parqueador`=U.`iduser`
                    INNER JOIN `mp_turno` TU ON TU.`id_turno`=TA.`id_turno`
                    WHERE U.`email`='$email' 
                    AND U.`password`='$pass'
                    AND TA.`fecha_tarea`='" . DIA_DE_HOY . "'
                    AND TU.`hora_ingreso`<'" . HORA_ACTUAL . "'
                    AND TU.`hora_fin`>'" . HORA_ACTUAL . "'";
            $row = $this->db->query($sql1);
            $consulta1 = $row->row();
            $data = array(
                'login' => TRUE,
                'iduser' => $consulta1->iduser,
                'nombre' => $consulta1->user_name . " " . $consulta1->user_ape_pat . " " . $consulta1->user_ape_mat,
                'email' => $consulta1->email,
                'idrol' => $consulta1->idrol,
                'txtrol' => $consulta1->txtrol,
                'idtareaje' => $consulta1->id_tareaje
            );
            $this->session->set_userdata($data);
        }
        
    }

    public function validaEmail($email) {
        $result = $this->db->query("SELECT * FROM mpuser WHERE email='$email'");
        if ($result->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function validaEmailLogin($email) {
        $result = $this->db->query("SELECT * FROM mpuser WHERE email='$email'");
        if ($result->num_rows() == 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function validaRol($email, $pass) {
        $query = "SELECT * FROM mpuser WHERE email='$email' and password ='$pass'";
        $result = $this->db->query($query);
        return $result->row()->idrol;
    }

    public function validaPassLogin($email, $pass) {
        $query = "SELECT * FROM mpuser WHERE email='$email' and password ='$pass'";
        $result = $this->db->query($query);
        if ($result->num_rows() == 0) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function validaHorario($email, $pass) {
        $query = "SELECT * FROM `mp_tareaje` TA
                INNER JOIN `mpuser` U ON  TA.`iduser_parqueador`=U.`iduser`
                INNER JOIN `mp_turno` TU ON TU.`id_turno`=TA.`id_turno`
                WHERE U.`email`='$email' 
                AND U.`password`='$pass'
                AND TA.`fecha_tarea`='" . DIA_DE_HOY . "'
                AND TU.`hora_ingreso`<'" . HORA_ACTUAL . "'
                AND TU.`hora_fin`>'" . HORA_ACTUAL . "'";
        $result = $this->db->query($query);
        if ($result->num_rows() == 0) {
            return FALSE;
        } else {
            return $result;
        }
    }

    public function guardarNuevoUsuario($data) {

        $this->db->insert('mpuser', $data);
    }

    public function datosUser($id) {
        $sql = "SELECT * FROM `mpuser` U 
                INNER JOIN mproles R ON U.IDROL =R.IDROL 
                WHERE U.IDuser='$id'";
        return $this->db->query($sql);
    }

    public function datosVias() {
        $sql = 'SELECT * FROM `mpcalle` WHERE flgestado="1"';
        return $this->db->query($sql);
    }

    public function tiempoVias($idVia) {
        $sql = "SELECT tiempoparqueo FROM `mpcalle` WHERE `codvia`='$idVia'";
        $query = $this->db->query($sql);
        return $query->row();
    }

}
