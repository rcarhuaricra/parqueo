<?php

$config = array(
    'login/verificarLogin' => array(
        array(
            'field' => 'email',
            'label' => 'E-mail',
            'rules' => 'callback_verificarEmailLogin'
        ),
        array(
            'field' => 'psw',
            'label' => 'Password',
            'rules' => 'callback_verificarPassLoging'
        )
    )
);
