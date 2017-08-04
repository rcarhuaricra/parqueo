<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Tareaje extends CI_Controller {

    function __construct() {
        parent::__construct();
        if (!$this->session->userdata('login')) {
            header("Location:" . base_url() . "login");
        }
        $this->load->model('Tareaje_model');
    }

    public function index() {

        $data = array('titulo' => 'Tareaje');
        $this->load->view('plantilla/header', $data);
        $id = $this->session->userdata('login');
        $datos['usuario'] = $this->user_model->datosUser($id);
        $this->load->view('plantilla/cabecera', $datos);
        $menu = array('nuevo' => '', 'estacionado' => '', 'deposito' => '', 'culminado' => '', 'tareaje' => 'active');
        $this->load->view('plantilla/menuizquierda', $menu);
        $datos['meses'] = array("[Seleccione Mes]", "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Setiembre", "Octubre", "Noviembre", "Diciembre");
        $datos['via'] = $this->user_model->datosVias();
        $datos['BuscaParquedor'] = $this->Tareaje_model->BuscaParquedor();
        $datos['Buscaturno'] = $this->Tareaje_model->Buscaturno();
        $this->load->view('tareaje/registro', $datos);
        $this->load->view('plantilla/piedePagina');
        //$this->load->view('plantilla/menuderecha');
        $this->load->view('plantilla/footer');
    }

    public function tablaTareaje() {
        $datos['meses'] = array("[Seleccione Mes]", "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Setiembre", "Octubre", "Noviembre", "Diciembre");
        $datos['mesTurno'] = $this->input->post();
        $datos['cuadras'] = $this->Tareaje_model->listarCuadras($this->input->post('horario'));
        $datos['usuarios'] = $this->Tareaje_model->listarUsuarios();
        $this->load->view('tareaje/tablaTareaje', $datos);
    }

    public function guardarTareaje() {
        $mes= $this->input->post('mes');
        $turno= $this->input->post('turno');
        $cuadras = $this->input->post('cuadra');
        $usuario = $this->input->post('usuario');


        $i = 0;
        while ($i < count($cuadras)) {
            $m = $mes[$i];
            $t = $turno[$i];
            $c = $cuadras[$i];
            $u = $usuario[$i];
            echo "$m - $t - $c - $u \n";
            $i++;
        }

        //print_r($dat);
        /* $DATA = [
          'id_tareaje' => $placa,
          'iduser_parqueador' => $idVia,
          'id_turno' => $iduser,
          'fecha_tarea' => $fechaInicial,
          'fecreg' => $fechaFinal,
          'userreg' => $fechaFinal,
          'fecreg' => $fechaFinal,
          'id_cuadras' => $fechaFinal
          ]; */
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
