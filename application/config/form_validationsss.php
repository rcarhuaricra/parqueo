<?php

$config = array(
    'login/verificarlogin' => array(
        array(
            'field' => 'email',
            'label' => 'E-mail',
            'rules' => 'callback_verificarEmailLogin'
        ),
        array(
            'field' => 'psw',
            'label' => 'Password',
            'rules' => 'callback_verificarPassLoging'
        ),
        array(
            'field' => 'acceso',
            'label' => 'acceso',
            'rules' => 'callback_verificarTareaje'
        )
    )
);
