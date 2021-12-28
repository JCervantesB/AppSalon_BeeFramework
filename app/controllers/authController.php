<?php
use Classes\Email;

class authController extends Controller
{
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
    $usuario = new UsuarioModel;
    // Alertas vacias
    $alertas = [];
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

      $usuario->sincronizar($_POST);
      $alertas = $usuario->validarNuevaCuenta();

      // Validar que alertas este vacio

      if (empty($alertas)) {
        // Verificar que el usuario no este registrado
        $resultado = $usuario->existeUsuario();

        if ($resultado->num_rows) {
          $alertas = UsuarioModel::getAlertas();
        } else {
          // Hashear el password
          $usuario->hashPassword();

          // Generar un tocken único
          $usuario->crearToken();

          // Enviar el email
          $email = new Email($usuario->nombre, $usuario->email, $usuario->token);
          $email->enviarConfirmacion();

          // Crear el usuario
          $resultado = $usuario->guardar();
          
          if ($resultado) {
            header('Location: /auth/mensaje');
          }
        }
      }
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
  public static function mensaje()
  {
    $data =
    [
      'title'   => 'Exito',
      'padding' => '0px',
      'bg'      => 'dark'
    ];
    View::render('mensaje', $data);
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
