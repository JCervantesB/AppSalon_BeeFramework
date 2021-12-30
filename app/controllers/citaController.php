<?php

class citaController extends Controller{

    function __construct()
  {
  }
    
    function index() {
        isAuth();
        $data =
        [   
            'nombre' => $_SESSION['nombre'],
            'id' => $_SESSION['id'],
            'bg'    => 'dark',
            'padding' => '0px',
            
        ];

        View::render('cita', $data);
        }

}
