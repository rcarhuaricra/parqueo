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
        $estadoVehiculo = ESTACIONADO;
        $data['vehiculos'] = $this->parqueo_model->vehiculosEstado($estadoVehiculo);
        $this->load->view('vehiculos/estacionados', $data);
        $this->load->view('plantilla/piedePagina');
        //$this->load->view('plantilla/menuderecha');
        $this->load->view('plantilla/footer');
    }

    public function qr() {
        $this->load->library('ciqrcode');

        header("Content-Type: image/png");
        $params['data'] = 'www.ricSSSSv.pe';

        $params['level'] = 'H';
        $params['size'] = 10;
        $params['savename'] = FCPATH . 'tes.png';
        $this->ciqrcode->generate($params);

        echo '<img src="' . base_url() . 'tes.png" />';
    }

    public function listardeposito() {

        $data = array('titulo' => 'Panel de Control');
        $this->load->view('plantilla/header', $data);
        $id = $this->session->userdata('login');
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
        $id = $this->session->userdata('login');
        $this->load->view('plantilla/cabecera');
        $menu = array('nuevo' => '', 'estacionado' => '', 'deposito' => '', 'culminado' => 'active', 'tareaje' => '');
        $this->load->view('plantilla/menuizquierda', $menu);
        $estadoVehiculo = CULMINADO_A_TIEMPO;
        $data['vehiculos'] = $this->parqueo_model->vehiculosEstado($estadoVehiculo);
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
        $placa = strtoupper($this->input->post('placa'));
        $lado = strtoupper($this->input->post('lado'));
        $estacionamiento = strtoupper($this->input->post('estacionamiento'));
        $data = [
            'placa' => $placa,
            'id_tareaje' => $_SESSION['idtareaje'],
            'iduserreg' => $_SESSION['iduser'],
            'lado' => $lado,
            'estacionamiento' => $estacionamiento
        ];
        $nuevoId = $this->parqueo_model->guardarNuevoParqueo($data);
        if ($nuevoId != FALSE) {
            redirect("parqueador/imprimirPDF/$nuevoId");
            
            //redirect("parqueador/nuevo");
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
        if ($dato['ticket'] == false) {
            header("Location:" . base_url() . "parqueador/estacionados");
        } else {
            $paper_size1 = array(0, 0, 275.5, 287.1);
            $this->load->view('vehiculos/impresionPDF', $dato, false);
            $html = $this->output->get_output();
            $this->dompdf->set_paper($paper_size1);
            $this->dompdf->load_html($html);
            $this->dompdf->render();
            $this->dompdf->stream("Parqueo.pdf", array('Attachment' => 1));
            
        }
        
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
