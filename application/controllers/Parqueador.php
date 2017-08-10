<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Parqueador extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('date');
        $this->load->library('user_agent');
        if (!$this->session->userdata('login')) {
            //redirect("usuario");
            header("Location:" . base_url() . "login");
        }
    }

    public function index() {

        header("Location:" . base_url() . "parqueador/estacionados");
    }

    public function estacionados() {

        $data = array('titulo' => 'Panel de Control');
        $this->load->view('plantilla/header', $data);
        $id = $this->session->userdata('login');
        $this->load->view('plantilla/cabecera');
        $menu = array('nuevo' => '', 'estacionado' => 'active', 'deposito' => '', 'culminado' => '', 'tareaje' => '');
        $this->load->view('plantilla/menuizquierda', $menu);
        $data['vehiculos'] = $this->parqueo_model->vehiculosParqueados();
        $this->load->view('vehiculos/estacionados', $data);
        $this->load->view('plantilla/piedePagina');
        //$this->load->view('plantilla/menuderecha');
        $this->load->view('plantilla/footer');
    }

    public function deposito() {

        $data = array('titulo' => 'Panel de Control');
        $this->load->view('plantilla/header', $data);
        $id = $this->session->userdata('login');
        $this->load->view('plantilla/cabecera');
        $menu = array('nuevo' => '', 'estacionado' => '', 'deposito' => 'active', 'culminado' => '', 'tareaje' => '');
        $this->load->view('plantilla/menuizquierda', $menu);
        $data['vehiculos'] = $this->parqueo_model->vehiculosDeposito();
        $this->load->view('vehiculos/deposito', $data);
        $this->load->view('plantilla/piedePagina');
        //$this->load->view('plantilla/menuderecha');
        $this->load->view('plantilla/footer');
    }

    public function culminados() {

        $data = array('titulo' => 'Panel de Control');
        $this->load->view('plantilla/header', $data);
        $id = $this->session->userdata('login');
        $this->load->view('plantilla/cabecera');
        $menu = array('nuevo' => '', 'estacionado' => '', 'deposito' => '', 'culminado' => 'active', 'tareaje' => '');
        $this->load->view('plantilla/menuizquierda', $menu);
        $data['vehiculos'] = $this->parqueo_model->vehiculosCulminados();
        $this->load->view('vehiculos/culminado', $data);
        $this->load->view('plantilla/piedePagina');
        //$this->load->view('plantilla/menuderecha');
        $this->load->view('plantilla/footer');
    }

    public function nuevo() {
        $data = array('titulo' => 'Registrar Parqueo');
        $this->load->view('plantilla/header', $data);
        $this->load->view('plantilla/cabecera');
        $menu = array('nuevo' => 'active', 'estacionado' => '', 'deposito' => '', 'culminado' => '', 'tareaje' => '');
        $this->load->view('plantilla/menuizquierda', $menu);
        $datos['via'] = $this->user_model->datosVias();
        $this->load->view('vehiculos/nuevo', $datos);
        $this->load->view('plantilla/footer');
    }

    public function enviarDeposito($idVehiculo) {
        echo $idVehiculo;
    }

    public function guardar() {
        //date_default_timezone_set("Europe/Berlin");
        $placa = strtoupper($this->input->post('placa'));
        $idVia = $this->input->post('via');
        $hora = $this->user_model->tiempoVias($idVia)->tiempoparqueo;
        $formato = '%Y-%m-%d %H:%M:%S';
        $fechaInicial = strftime($formato);
        $dt = new DateTime($fechaInicial);
        $dt->add(new DateInterval('PT' . $hora . 'M'));
        $fechaFinal = $dt->format('Y-m-d H:i:s'); //17:00:00
        $data = [
            'placa' => $placa,
            'codvia' => $idVia,
            'iduserreg' => $_SESSION['iduser'],
            'horainicio' => $fechaInicial,
            'horafinal' => $fechaFinal
        ];
        $nuevoId = $this->parqueo_model->guardarNuevoParqueo($data);

        redirect("parqueador/imprimir/$nuevoId");

        //redirect("PaquetesController");
    }

    public function imprimir($nuevoId) {
        $data = array('titulo' => 'Impresion');
        $this->load->view('plantilla/header', $data);
        $iduser = $this->session->userdata('login');
        $dato['ticket'] = $this->parqueo_model->generarticket($nuevoId, $iduser);
        //echo $dato['ticket'];
        if ($dato['ticket'] == false) {
            header("Location:" . base_url() . "parqueador/estacionados");
        } else {
            $this->load->view('vehiculos/impresion', $dato);
        }
    }

    public function anulado() {
        $post = $this->input->post();
        $id = $post['id'];
        //echo $id;
        $sql = "UPDATE mpvehiculo
                SET idestado = '4'
                WHERE idvehiculo = '$id'";
        if ($this->db->query($sql)) {
            echo $id;
        } else {
            echo FALSE;
        }
    }

    public function culminado() {
        $post = $this->input->post();
        $id = $post['id'];
        //echo $id;
        $sql = "UPDATE mpvehiculo
                SET idestado = '2'
                WHERE idvehiculo = '$id'";
        if ($this->db->query($sql)) {
            echo $id;
        } else {
            echo FALSE;
        }
    }

    public function remolcado() {
        $post = $this->input->post();
        $id = $post['id'];
        //echo $id;
        $sql = "UPDATE mpvehiculo
                SET idestado = '3'
                WHERE idvehiculo = '$id'";
        if ($this->db->query($sql)) {
            echo $id;
        } else {
            echo FALSE;
        }
    }

}
