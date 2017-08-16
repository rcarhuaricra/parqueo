<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario extends CI_Controller {

    function __construct() {
        parent::__construct();
        if (!$this->session->userdata('login')) {
            //redirect("usuario");
            header("Location:" . base_url() . "usuario");
        }
    }

    public function index() {
        header("location:" . base_url() . 'usuario/perfilUsuario');
    }

}
