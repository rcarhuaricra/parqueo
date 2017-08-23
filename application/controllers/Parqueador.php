<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Parqueador extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('session');
        if (isset($_SESSION['login']) == FALSE) {
            redirect("");
        }
        $this->load->helper('date');
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

        $this->load->view('vehiculos/estacionados', $data);
        $this->load->view('plantilla/piedePagina');
        //$this->load->view('plantilla/menuderecha');
        $this->load->view('plantilla/footer');
    }

    public function verificar() {
        $estadoVehiculo = ESTACIONADO;
        $data['vehiculos'] = $this->parqueo_model->vehiculosEstado($estadoVehiculo);
        $this->load->view('vehiculos/estacionadosTabla', $data);
    }

    public function listardeposito() {

        $data = array('titulo' => 'Panel de Control');
        $this->load->view('plantilla/header', $data);
        
        $this->load->view('plantilla/cabecera');
        $menu = array('nuevo' => '', 'estacionado' => '', 'deposito' => 'active', 'culminado' => '', 'tareaje' => '');
        $this->load->view('plantilla/menuizquierda', $menu);
        $estadoVehiculo = REMOLCADO;
        $data['vehiculos'] = $this->parqueo_model->vehiculosEstado($estadoVehiculo);
        $this->load->view('vehiculos/deposito', $data);
        $this->load->view('plantilla/piedePagina');
        //$this->load->view('plantilla/menuderecha');
        $this->load->view('plantilla/footer');
    }

    public function listarculminados() {

        $data = array('titulo' => 'Panel de Control');
        $this->load->view('plantilla/header', $data);        
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
        $datos['calleTareajes'] = $this->user_model->listarCallesTareajes();
        //$datos['via'] = $this->user_model->datosVias();
        if ($_SESSION['idrol'] == ADMINISTRADOR) {
            $this->load->view('usuario/acceso', $datos);
        }
        if ($_SESSION['idrol'] == PARQUEADOR) {
            $this->load->view('vehiculos/nuevo', $datos);
        }

        $this->load->view('plantilla/footer');
    }

    public function enviarDeposito($idVehiculo) {
        echo $idVehiculo;
    }

    public function guardar() {
        $placa = strtoupper($this->input->post('placa'));
        $lado = strtoupper($this->input->post('lado'));
        $idtareaje = strtoupper($this->input->post('idTareaje'));
        $estacionamiento = strtoupper($this->input->post('estacionamiento'));
        $data = [
            'placa' => $placa,
            'id_tareaje' => $idtareaje,
            'iduserreg' => $_SESSION['iduser'],
            'lado' => $lado,
            'estacionamiento' => $estacionamiento
        ];
        $nuevoId = $this->parqueo_model->guardarNuevoParqueo($data);
        if ($nuevoId != FALSE) {
            redirect("parqueador/imprimirPDF/$nuevoId");
        }
        //redirect("parqueador/imprimir/$nuevoId");
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

    public function imprimirPDF($nuevoId) {
        $this->load->library('dompdf_gen');
        $dato['ticket'] = $this->parqueo_model->generarticket($nuevoId);
        $dato['qr'] = $this->qr($nuevoId);
        if ($dato['ticket'] == false) {
            header("Location:" . base_url() . "parqueador/estacionados");
        } else {
            $paper_size1 = array(0, 0, 275.5, 360.1);
            $this->load->view('vehiculos/impresionPDF', $dato, false);
            $html = $this->output->get_output();
            $this->dompdf->set_paper($paper_size1);
            $this->dompdf->load_html($html);
            $this->dompdf->render();
            $this->dompdf->stream("Parqueo.pdf", array('Attachment' => 0));
        }
    }

    protected function qr($nuevoId) {
        $this->load->library('ciqrcode');
        $params['data'] = base_url()."servicio/mitiempo/$nuevoId";
        $params['level'] = 'L';
        $params['size'] = 6;
        $params['savename'] = FCPATH . 'recursos/qr/tes.png';
        $this->ciqrcode->generate($params);
        return "recursos/qr/tes.png";
    }

    public function updateEstados() {
        $id = $this->input->post('id');
        $estado = $this->input->post('estado');
        $user = $_SESSION['email'];
        $dato['ticket'] = $this->parqueo_model->updateEstadoVehiculo($estado, $user, $id);
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
