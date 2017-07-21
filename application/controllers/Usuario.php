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

    public function perfilUsuario() {
        if (!$this->session->userdata('login')) {
            header("Location:" . base_url() . "login");
        }
        $data = array('titulo' => 'Mi Perfil');
        $this->load->view('/plantilla/cabecera', $data);
        $id = $this->session->userdata('login');
        $datos['usuario'] = $this->user_model->datosUser($id);
        $datos['ruta'] = $this->user_model->datosRuta($id);
        $this->load->view('usuario/perfil', $datos);
        $this->load->view('/plantilla/footer');
    }

    public function verificarPassLoging($email, $pass) {
        if ($this->user_model->validaPassLogin($email, $pass)) {

            return TRUE;
        } else {
            $this->form_validation->set_message('verificarPassLoging', "el Password no es Correcto");
            return TRUE;
        }
    }

}
