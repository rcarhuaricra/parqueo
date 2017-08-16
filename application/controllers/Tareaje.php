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
        $datos['cuadras'] = $this->Tareaje_model->listarCuadras($this->input->post('horario'), $this->input->post('mes'));

        if ($datos['cuadras'] == FALSE) {
            echo $datos['mensaje'] = '
                <div class="panel-body">
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><i class="icon fa fa-ban"></i> Alert!</h4>
                        Ya existen esos Tareajes.
                    </div>
                </div>';
        } else {
            $datos['meses'] = array("[Seleccione Mes]", "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Setiembre", "Octubre", "Noviembre", "Diciembre");
            $datos['mesTurno'] = $this->input->post();
            $datos['usuarios'] = $this->Tareaje_model->listarUsuarios();
            $this->load->view('tareaje/tablaTareaje', $datos);
        }
    }

    public function guardarTareaje() {
        $mes = $this->input->post('mes');
        $turno = $this->input->post('turno');
        $cuadras = $this->input->post('cuadra');
        $usuario = $this->input->post('usuario');
        $dias = cal_days_in_month(CAL_GREGORIAN, $mes[1], AÑO_ACTUAL);
        $i = 0;
        while ($i < count($cuadras)) {
            $m = str_pad($mes[$i], 2, "0", STR_PAD_LEFT);
            $t = $turno[$i];
            $c = $cuadras[$i];
            $u = $usuario[$i];
            $dia = 1;
            while ($dia <= $dias) {
                $insertTareaje[] = array(
                    'id_tareaje' => str_pad($dia, 2, '0', STR_PAD_LEFT) . "-$m-" . AÑO_ACTUAL . '-' . str_pad($c, 3, '0', STR_PAD_LEFT) . '-' . $t,
                    'iduser_parqueador' => $u,
                    'id_turno' => $t,
                    'fecha_tarea' => AÑO_ACTUAL . "-$m-" . str_pad($dia, 2, "0", STR_PAD_LEFT),
                    'userreg' => $_SESSION['login'],
                    'id_cuadras' => $c
                );
                $dia++;
            }
            $i++;
        }
        echo $this->Tareaje_model->guardarTareajeMasivo($insertTareaje);
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

    public function editarTareaje() {
        $data = array('titulo' => 'Editar Tareaje');
        $this->load->view('plantilla/header', $data);
        $id = $this->session->userdata('login');
        $datos['usuario'] = $this->user_model->datosUser($id);
        $this->load->view('plantilla/cabecera', $datos);
        $menu = array('nuevo' => '', 'estacionado' => '', 'deposito' => '', 'culminado' => '', 'tareaje' => 'active');
        $this->load->view('plantilla/menuizquierda', $menu);
        $this->load->model('generales_model');
        $datos['calles'] = $this->generales_model->listarCalles();
        $datos['Buscaturno'] = $this->Tareaje_model->Buscaturno();
        $this->load->view('tareaje/editarTareaje', $datos);
        $this->load->view('plantilla/piedePagina');
        //$this->load->view('plantilla/menuderecha');
        $this->load->view('plantilla/footer');
    }

    public function tablaTareajeEdicion() {

        $myDateTime = DateTime::createFromFormat('d/m/Y', $this->input->post('txtFecha'));
        $fecha = $myDateTime->format('Y-m-d');
        $calle = $this->input->post('calle');
        $horario = $this->input->post('horario');
        $data['TareajeEdicion'] = $this->Tareaje_model->tablaEditarTareaje($fecha, $calle, $horario);
        $this->load->view('tareaje/tablaEditarTareaje', $data);
    }

    public function editarusuario($iduser) {
        $data = array('titulo' => 'Editar Usuario Tareaje');
        $this->load->view('plantilla/header', $data);
        $id = $this->session->userdata('login');
        $datos['usuario'] = $this->user_model->datosUser($id);
        $this->load->view('plantilla/cabecera', $datos);
        $menu = array('nuevo' => '', 'estacionado' => '', 'deposito' => '', 'culminado' => '', 'tareaje' => 'active');
        $this->load->view('plantilla/menuizquierda', $menu);
        $datos['iduser'] = $iduser;
        $datos['usuarios'] = $this->Tareaje_model->listarUsuarios();
        $datos['usuario'] = $this->Tareaje_model->usuarioParquedor($iduser);
        $this->load->view('tareaje/editarUsuario', $datos);
        $this->load->view('plantilla/piedePagina');
        //$this->load->view('plantilla/menuderecha');
        $this->load->view('plantilla/footer');
    }

    public function actualizar() {
        $id = $this->input->post('id');
        $user = $this->input->post('usuario');
        $datos['usuario'] = $this->Tareaje_model->updateParqueador($id, $user);
        header("Location:" . base_url() . 'tareaje/editarTareaje');
    }

}
