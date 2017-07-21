<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

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

    public function verificarEmailRegistro($email) {
        $this->load->model('user_model');
        if ($this->user_model->validaEmail($email)) {
            $this->form_validation->set_message('verificarEmailRegistro', "el correo $email ya se encuentra registrado");
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function verificarEmailLogin($email) {
        if ($this->user_model->validaEmailLogin($email)) {
            $this->form_validation->set_message('verificarEmailLogin', "el correo $email no se encuentra registrado");
            return FALSE;
        } else {

            return TRUE;
        }
    }

    public function verificarPassLoging($email, $pass) {
        if ($this->user_model->validaPassLogin($email, $pass)) {

            return TRUE;
        } else {
            $this->form_validation->set_message('verificarPassLoging', "el Password no es Correcto");
            return TRUE;
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        header("location:" . base_url() . 'login');
    }

}
