<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Servicio extends CI_Controller {

    function __construct() {
        parent::__construct();
       
        $this->load->model('servicio_model');
    }

    public function Parqueados() {

        $dato = $this->servicio_model->ParqueadosGruas() ;
        echo json_encode($dato);
    }

}
