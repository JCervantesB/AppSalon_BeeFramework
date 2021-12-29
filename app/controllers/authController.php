<?php

use Classes\Email;

class AuthController extends Controller
{
  function __construct()
  {
    if (Auth::validate()) {
      Flasher::new('Ya hay una sesión abierta.');
      Redirect::to('home/flash');
    }
  }

  /**
   * Función para mostrar la pagina inicial y el login del usuario
   */
  function index()
  {
    $alertas = [];
    // Autocompletar usuario si hay un error
    $auth = new UsuarioModel;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $auth = new UsuarioModel($_POST);

      $alertas = $auth->validarLogin();

      if (empty($alertas)) {
        // Comprobar que el usuario exista
        $usuario = UsuarioModel::where('email', $auth->email);

        if ($usuario) {
          // Verificar el password
          if ($usuario->passwordAndVerifyCheck($auth->password)) {
            //Autenticar al usuario
            session_start();

            $_SESSION['id'] = $usuario->id;
            $_SESSION['nombre'] = $usuario->nombre . " " . $usuario->apellido;
            $_SESSION['email'] = $usuario->email;
            $_SESSION['inicial'] = substr($usuario->nombre, 0, 1);
            $_SESSION['login'] = true;

            // Redireccionamiento

            if ($usuario->admin === "1") {
              $_SESSION['admin'] = $usuario->admin ?? null;

              header('Location: /admin');
            } else {
              header('Location: /cita');
            }
          }
        } else {
          UsuarioModel::setAlerta('error', 'Usuario no encontrado');
        }
      }
    }

    $alertas = UsuarioModel::getAlertas();

    $data =
      [
        'alertas' => $alertas,
        'auth'    => $auth,
        'title'   => 'Ingresar a tu cuenta',
        'padding' => '0px',
        'bg'      => 'dark'
      ];

    View::render('index', $data);
  }

  /**
   * Función cerrar sesión del usuario
   */
  function logout()
  {
    session_start();

    session_destroy();

    header('Location: /');
  }

  /**
   * Función para crear una cuenta
   */
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

  /**
   * Funcion para enviar un mensaje de confirmacion
   */
  function mensaje()
  {
    $data =
      [
        'title'   => 'Exito',
        'padding' => '0px',
        'bg'      => 'dark'
      ];
    View::render('mensaje', $data);
  }

  /**
   * Funcion para solicitar una nueva contraseña
   */
  function olvide()
  {
    $alertas = [];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $auth = new UsuarioModel($_POST);
      $auth->validarEmail();

      if (empty($alertas)) {
        $usuario = UsuarioModel::where('email', $auth->email);

        if ($usuario && $usuario->confirmado === "1") {
          // Generar token
          $usuario->crearToken();
          $usuario->guardar();
          // Enviar el email
          $email = new Email($usuario->nombre, $usuario->email, $usuario->token);
          $email->enviarInstrucciones();
          // Alerta de exito
          UsuarioModel::setAlerta('exito', 'Revisa tu email');
        } else {
          UsuarioModel::setAlerta('error', 'El usuario no existe o no esta confirmado.');
        }
      }
    }

    $alertas = UsuarioModel::getAlertas();

    $data =
      [
        'alertas' => $alertas,
        'title'   => 'Olvidé mi contraseña',
        'padding' => '0px',
        'bg'      => 'dark'
      ];

    View::render('olvide', $data);
  }

  /**
   * Funcion para recuperar la cuenta
   * Comprueba que el token sea correcto
   */
  function recuperar()
  {
    $alertas = [];
    $error = false;

    $token = s($_GET['token']);

    // Buscar usuario por su token
    $usuario = UsuarioModel::where('token', $token);

    if (empty($usuario)) {
      UsuarioModel::setAlerta('error', 'Token No Válido');
      $error = true;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      //Leer el nuevo password y guardarlo
      $password = new UsuarioModel($_POST);
      $alertas = $password->validarPassword();

      if (empty($alertas)) {
        $usuario->password = null;
        $usuario->password = $password->password;
        $usuario->hashPassword();
        $usuario->token = null;
        $resultado = $usuario->guardar();

        if ($resultado) {
          header('Location: /');
        }
      }
    }

    $alertas = UsuarioModel::getAlertas();

    $data =
      [
        'error' => $error,
        'alertas' => $alertas,
        'title'   => 'Olvidé mi contraseña',
        'padding' => '0px',
        'bg'      => 'dark'
      ];

    View::render('recuperar', $data);
  }

  /**
   * Funcion para confirmar la cuenta
   * Verifica y activa la cuenta del usuario usando el token
   */
  function confirmar()
  {
    $alertas = [];

    $token = s($_GET['token']);
    $usuario = UsuarioModel::where('token', $token);
    if (empty($usuario)) {
      // Mostrar mensaje de error
      UsuarioModel::setAlerta('error', 'Token No Válido');
    } else {
      // Modificar a usuario confirmado.
      $usuario->confirmado = "1";
      // Elimnar el token confirmado
      $usuario->token = null;
      // Guardar cambios en la base de datos
      $usuario->guardar();
      // Añadir mensaje de alerta
      UsuarioModel::setAlerta('exito', 'Cuenta Confirmada Correctamente');
    }
    // Obtener alertas para mostrar
    $alertas = UsuarioModel::getAlertas();

    $data =
      [
        'alertas' => $alertas,
        'title'   => 'Confirmación de cuenta',
        'padding' => '0px',
        'bg'      => 'dark'
      ];

    View::render('confirmar', $data);
  }
}
