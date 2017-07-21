<?php

$config = array(
    'login/newUser' => array(
        array(
            'field' => 'nombre',
            'label' => 'Nombre',
            'rules' => 'trim|prep_for_form|required|strip_tags'
        ),
        array(
            'field' => 'apePat',
            'label' => 'Apellido Paterno',
            'rules' => 'trim|required|alpha'
        ),
        array(
            'field' => 'apeMat',
            'label' => 'Apellido Materno',
            'rules' => 'trim|required|alpha'
        ),
        array(
            'field' => 'area',
            'label' => 'Área',
            'rules' => 'required'
        ),
        array(
            'field' => 'celular',
            'label' => 'Celular',
            'rules' => 'trim|required|is_natural|exact_length[9]'
        ),
        array(
            'field' => 'email',
            'label' => 'E-mail',
            'rules' => 'trim|required|valid_email|callback_verificarEmailRegistro'
        ),
        array(
            'field' => 'psw',
            'label' => 'Password',
            'rules' => 'trim|required|matches[confirmar_pass]'
        ),
        array(
            'field' => 'confirmar_pass',
            'label' => 'confirmar Password',
            'rules' => 'trim|required'
        )
    ),
    'usuario/actualizarPerfil' => array(
        array(
            'field' => 'nombre',
            'label' => 'Nombre',
            'rules' => 'trim|prep_for_form|required|strip_tags'
        ),
        array(
            'field' => 'apePat',
            'label' => 'Apellido Paterno',
            'rules' => 'trim|required|alpha'
        ),
        array(
            'field' => 'apeMat',
            'label' => 'Apellido Materno',
            'rules' => 'trim|required|alpha'
        ),
        array(
            'field' => 'area',
            'label' => 'Área',
            'rules' => 'required'
        ),
        array(
            'field' => 'celular',
            'label' => 'Celular',
            'rules' => 'trim|required|is_natural|exact_length[9]'
        ),
        
        array(
            'field' => 'psw',
            'label' => 'Password',
            'rules' => 'trim|required|callback_verificarPassLoging'
        )
        
    ),
    'login/verificarLogin' => array(
        array(
            'field' => 'email',
            'label' => 'E-mail',
            //'rules' => 'trim|required|valid_email|callback_verificarEmailLogin'
            'rules' => 'required|callback_verificarEmailLogin'
        ),
        array(
            'field' => 'psw',
            'label' => 'Password',
            //'rules' => 'callback_verificarPassLoging'
            'rules' => 'callback_verificarPassLoging|required'
        )
    ),
    'ruta/nuevaruta' => array(
        array(
            'field' => 'origen',
            'label' => 'Origen',
            'rules' => 'required'
        ),
        array(
            'field' => 'destino',
            'label' => 'Destino',
            'rules' => 'required'
        ),
        array(
            'field' => 'ruta',
            'label' => 'Ruta',
            'rules' => 'required'
        )
    ),
     'ruta/actualizarRuta' => array(
        array(
            'field' => 'origen',
            'label' => 'Origen',
            'rules' => 'required'
        ),
        array(
            'field' => 'destino',
            'label' => 'Destino',
            'rules' => 'required'
        ),
        array(
            'field' => 'ruta',
            'label' => 'Ruta',
            'rules' => 'required'
        ),
        array(
            'field' => 'estadoRuta',
            'label' => 'Estado',
            'rules' => 'required'
        )
    )
);
