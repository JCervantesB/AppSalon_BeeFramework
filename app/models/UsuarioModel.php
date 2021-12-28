<?php

class UsuarioModel extends Model
{

  // Base de datos
  protected static $tabla = 'usuarios';
  protected static $columnasDB = ['id', 'nombre', 'apellido', 'email', 'password', 'telefono', 'admin', 'confirmado', 'token'];

  public $id;
  public $nombre;
  public $apellido;
  public $email;
  public $password;
  public $telefono;
  public $admin;
  public $confirmado;
  public $token;

  public function __construct($args = [])
  {
    $this->id = $args['id'] ?? null;
    $this->nombre = $args['nombre'] ?? '';
    $this->apellido = $args['apellido'] ?? '';
    $this->email = $args['email'] ?? '';
    $this->password = $args['password'] ?? '';
    $this->telefono = $args['telefono'] ?? '';
    $this->admin = $args['admin'] ?? null;
    $this->confirmado = $args['confirmado'] ?? null;
    $this->token = $args['token'] ?? '';
  }

  /**
   * Método para agregar un nuevo usuario
   *
   * @return integer
   */
  public function add()
  {
    $sql = 'INSERT INTO usuarios (nombre, apellido, email, password, telefono, admin, confirmado, token) VALUES (:nombre, :apellido, :email, :password, :telefono, :admin, :confirmado, :token)';
    $user =
      [
        'nombre'     => $this->nombre,
        'apellido'   => $this->apellido,
        'email'      => $this->email,
        'password'   => $this->password,
        'telefono'   => $this->telefono,
        'admin'      => $this->admin,
        'confirmado' => $this->confirmado,
        'token'      => $this->token,
      ];

    try {
      return ($this->id = parent::query($sql, $user)) ? $this->id : false;
    } catch (Exception $e) {
      throw $e;
    }
  }

  /**
   * Método para actualizar un registor en la db
   *
   * @return bool
   */
  public function update()
  {
    $sql = 'UPDATE usuarios SET nombre=:nombre, apellido=:apellido, email=:email, password=:password, telefono=:telefono WHERE id=:id';
    $user =
      [
        'nombre'     => $this->nombre,
        'apellido'   => $this->apellido,
        'email'      => $this->email,
        'password'   => $this->password,
        'telefono'   => $this->telefono,
        'admin'      => $this->admin,
        'confirmado' => $this->confirmado,
        'token'      => $this->token,
      ];

    try {
      return (parent::query($sql, $user)) ? true : false;
    } catch (Exception $e) {
      throw $e;
    }
  }

  // Mensajes de validación para el formulario de registro
  public function validarNuevaCuenta() {
    if(!$this->nombre) {
      self::$alertas['error'][] = 'El nombre del Cliente es obligatorio.';
    }
    if(!$this->apellido) {
      self::$alertas['error'][] = 'El apellido del Cliente es obligatorio.';
    }
    if(!$this->email) {
      self::$alertas['error'][] = 'El email del Cliente es obligatorio.';
    }
    

    return self::$alertas;
  }
}
