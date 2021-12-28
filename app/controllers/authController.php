<?php

class authController extends Controller {
    function __construct()
    {
      if (Auth::validate()) {
        Flasher::new('Ya hay una sesión abierta.');
        Redirect::to('home/flash');
      }
    }
  
    function index()
    {
      $data =
      [
        'title'   => 'Ingresar a tu cuenta',
        'padding' => '0px',
        'bg'      => 'dark'
      ];
  
      View::render('index', $data);
    }

    function registro() 
    {
      $usuario = new UsuarioModel();
      if($_SERVER['REQUEST_METHOD'] === 'POST') {

        $usuario->sincronizar($_POST);
        $alertas = $usuario->validarNuevaCuenta();

        
      }

      $data =
      [
        'usuario' => $usuario,
        'alertas' => $alertas,
        'title'   => 'Crear cuenta',
        'padding' => '0px',
        'bg'      => 'dark'
      ];

      View::render('registro', $data);
    }

    function olvide() 
    {
      $data =
      [
        'title'   => 'Olvidé mi contraseña',
        'padding' => '0px',
        'bg'      => 'dark'
      ];

      View::render('olvide', $data);
    }
}