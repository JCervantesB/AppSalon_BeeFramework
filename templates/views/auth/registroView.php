<?php require_once INCLUDES . 'inc_header.php'; ?>

<h1 class="nombre-pagina">Crear Cuenta</h1>
<p class="descripcion-pagina">Llena el siguiente formulario para crear una cuenta</p>

<?php 
  include_once __DIR__ . "/../../includes/alertas.php";
?>

<form class="formulario" method="POST" action="/auth/registro">
  <div class="campo">
    <label for="nombre">Nombre</label>
    <input 
      type="text"
      id="nombre"
      name="nombre"
      placeholder="Ingresa tu nombre"
      value="<?php echo s($d->usuario->nombre); ?>"
    />
  </div>

  <div class="campo">
    <label for="apellido">Apellido</label>
    <input 
      type="text"
      id="apellido"
      name="apellido"
      placeholder="Ingresa tu apellido"
      value="<?php echo s($d->usuario->apellido); ?>"
    />
  </div>

  <div class="campo">
    <label for="tel">Teléfono</label>
    <input 
      type="tel"
      id="telefono"
      name="telefono"
      placeholder="Ingresa tu teléfono"
      value="<?php echo s($d->usuario->telefono); ?>"
    />
  </div>

  <div class="campo">
    <label for="email">Email</label>
    <input 
      type="email"
      id="email"
      name="email"
      placeholder="Ingresa tu email"
      value="<?php echo s($d->usuario->email); ?>"
    />
  </div>

  <div class="campo">
    <label for="password">Contraseña</label>
    <input 
      type="password"
      id="password"
      name="password"
      placeholder="Ingresa tu contraseña"
    />
  </div>

  <input type="submit" class="boton" value="Crear Cuenta">
</form>

<div class="acciones">
  <a href="/auth">¿Ya tienes una cuenta? Inicia sesión</a>
  <a href="/auth/olvide">¿Olvidaste tu contraseña?</a>
</div>

<?php require_once INCLUDES . 'inc_footer_v2.php'; ?>