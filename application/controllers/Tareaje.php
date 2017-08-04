<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Tareaje extends CI_Controller {

    function __construct() {
        parent::__construct();
        if (!$this->session->userdata('login')) {
            header("Location:" . base_url() . "login");
        }
    }

    public function index() {
        $this->load->model('Tareaje_model');
        $data = array('titulo' => 'Tareaje');
        $this->load->view('plantilla/header', $data);
        $id = $this->session->userdata('login');
        $datos['usuario'] = $this->user_model->datosUser($id);
        $this->load->view('plantilla/cabecera', $datos);
        $menu = array('nuevo' => '', 'estacionado' => '', 'deposito' => '', 'culminado' => '', 'tareaje' => 'active');
        $this->load->view('plantilla/menuizquierda', $menu);
        $datos['meses'] = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Setiembre", "Octubre", "Noviembre", "Diciembre");
        $datos['via'] = $this->user_model->datosVias();
        $datos['BuscaParquedor'] = $this->Tareaje_model->BuscaParquedor();
        $datos['Buscaturno'] = $this->Tareaje_model->Buscaturno();
        $this->load->view('tareaje/registro', $datos);
        $this->load->view('plantilla/piedePagina');
        //$this->load->view('plantilla/menuderecha');
        $this->load->view('plantilla/footer');
    }

    public function usuario() {

        $user = $this->input->post('query');
        $data = $this->Tareaje_model->BuscaParquedor($user);
        $json = [];
        while ($row = $data->fetch_assoc()) {
            $json[] = $row['USER'];
        }
        echo json_encode($json);
    }

}
