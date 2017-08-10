<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Your own constructor code       
        $this->load->library('form_validation');
    }

    public function index() {
        if ($this->session->userdata('login')) {
            header("Location:" . base_url() . "parqueador");
        }
        $this->form_validation->set_error_delimiters('<div class="text-right panel-body"><spam class="text-danger ">', '</spam></div>');
        $data = array('titulo' => 'Inicio de Sesión');
        $this->load->view('/plantilla/header', $data);
        $this->load->view('usuario/loging');
        $this->load->view('/plantilla/footer');
    }

    public function verificarLogin() {
        $this->form_validation->set_error_delimiters('<div class="text-right panel-body"><spam class="text-danger ">', '</spam></div>');
        if ($this->form_validation->run() === FALSE) {
            $data = array('titulo' => 'Inicio de Sesión');
            $this->load->view('/plantilla/header', $data);
            $this->load->view('usuario/loging');
            $this->load->view('/plantilla/footer');
        } else {
            $email = strtoupper($this->input->post('email'));
            $pass = strtoupper($this->input->post('psw'));
            $this->user_model->getUser($email, $pass);

            header("location:" . base_url() . "parqueador");
        }
    }

    public function verificarEmailLogin() {
        $email = strtoupper($this->input->post('email'));
        if ($email == '') {
            $this->form_validation->set_message('verificarEmailLogin', "el Campo <strong>{field}</strong> es Necesario");
            return FALSE;
        } else {
            if ($this->user_model->validaEmailLogin($email)) {
                $this->form_validation->set_message('verificarEmailLogin', "el correo <strong> $email</strong> no se encuentra registrado");
                return FALSE;
            } else {
                return TRUE;
            }
        }
    }

    public function verificarPassLoging() {
        $email = strtoupper($this->input->post('email'));
        $pass = strtoupper($this->input->post('psw'));
        if ($pass == '') {
            $this->form_validation->set_message('verificarPassLoging', "el Campo <strong>{field}</strong> es Necesario");
            return FALSE;
        } else {
            $login = $this->user_model->validaPassLogin($email, $pass);
            if ($login == TRUE) {
                return TRUE;
            }
            $this->form_validation->set_message('verificarPassLoging', "el Password <strong>es incorecto</strong> no coincide con el Correo");
            return FALSE;
        }
    }

    public function verificarTareaje() {
        $email = strtoupper($this->input->post('email'));
        $pass = strtoupper($this->input->post('psw'));
        $rol = $this->user_model->validaRol($email, $pass);

        if ($rol == ADMINISTRADOR) {
            return TRUE;
        } else {
            $result = $this->user_model->validaHorario($email, $pass);
            if ($result == FALSE) {
                $this->form_validation->set_message('verificarTareaje', "El Usuario no tiene Acceso Ens estos Momentos");
                return FALSE;
            } else {
                return TRUE;               
            }
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        header("location:" . base_url());
    }

}
