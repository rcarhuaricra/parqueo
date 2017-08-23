<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Servicio extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('servicio_model');
    }

    public function Parqueados() {

        $dato = $this->servicio_model->ParqueadosGruas();
        echo json_encode($dato);
    }

    public function updateEstados($id, $user, $estado) {

        $dato = $this->servicio_model->updateEstadoModel($id, $user, $estado);
        echo json_encode($dato);
    }

    public function mitiempo($nuevoId = "") {

        $dato = $this->servicio_model->MostrarEstado($nuevoId);
        echo json_encode($nuevoId);
    }

}
