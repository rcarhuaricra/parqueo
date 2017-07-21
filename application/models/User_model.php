<?php

class User_model extends CI_Model {

    public function getUser($email, $pass) {
        $consulta = $this->db->query("SELECT * FROM `mpuser` WHERE email = '$email' and password ='$pass'");
        if ($consulta->num_rows() > 0) {
            $consulta = $consulta->row();
            $data = array(
                'login' => $consulta->iduser,
                'email' => $consulta->email
            );
            $this->session->set_userdata($data);
        } else {
            //return FALSE;
            //$this->form_validation->set_message('verificarPassLoging', "el Password no es Correcto");
            $this->session->set_flashdata('mensaje', 'La Contraseña no es correcta');
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

    public function validaPassLogin($email, $pass) {

        $result = $this->db->query("SELECT * FROM mpuser WHERE email='$email' and password ='$pass'");
        if ($result->num_rows() == 0) {
            return TRUE;
        } else {
            return FALSE;
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
        $query= $this->db->query($sql);
        return $query->row();
    }

}
