<?php

class Servicio_model extends CI_Model {

    public function ParqueadosGruas() {
        $sql = "SELECT VE.`idvehiculo`
                , VE.`placa`
                , VE.`horainicio`
                , VE.`horafinal`
                , VE.`idestado`
                , EV.`txtestado`
                , IF(ISNULL(VE.`usermod`),'',VE.`usermod`) AS USERMOD
                , CA.`tiempoparqueo`
                ,CONCAT(CA.`tipoVia`,' ',CA.`nombrevia`) AS CALLE
                , CU.`cuadra`
                , VE.`lado`
                ,VE.`casillero`
                ,TIMEDIFF(NOW(),VE.`horafinal`) AS TiempoDiferencia                
                , IF(TIMEDIFF(NOW(),VE.`horafinal`) < '00:15:00' ,'1', '2') AS EstadoGrua
                FROM `mpvehiculo` VE
                INNER JOIN `mp_tareaje` TA ON TA.`id_tareaje`=VE.`id_tareaje`
                INNER JOIN `mp_cuadras` CU ON CU.`id_cuadras`=TA.`id_cuadras`
                INNER JOIN `mpestadovehiculo` EV ON EV.`idestado`=VE.`idestado`
                INNER JOIN `mpcalle` CA ON CA.`codvia`=CU.`id_via`
                WHERE DATE_FORMAT(VE.`horainicio`,'%Y-%m-%d')=DATE_FORMAT(NOW(),'%Y-%m-%d')
		AND TIMEDIFF(NOW(),VE.`horafinal`)>'00:00:00'
                AND VE.`idestado` <> 4 ";
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

}
