<?php

class Servicio_model extends CI_Model {

    public function ParqueadosGruas() {
        $sql = "CALL selectGruas()";
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function updateEstadoModel($id, $user, $estado) {
        $sql = "CALL `update_mpvehiculo`('$estado','$user','$id')";
        $query = $this->db->query($sql);
        return $query->result();
        
        /* if ($query > 1) {
          return true;
          } else {
          return false;
          } */
    }
    public function MostrarEstado($nuevoId){
        /*$sql = "CALL selectGruas()";
        $query = $this->db->query($sql);
        return $query->result();*/
    }

}
