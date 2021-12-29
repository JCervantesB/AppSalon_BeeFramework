<?php require_once INCLUDES . 'inc_header.php'; ?>
<?php 
  include_once __DIR__ . "/../../includes/alertas.php";
?>

<h1 class="nombre-pagina">¡Olvide mi contraseña!</h1>
<p class="descripcion-pagina">Reestablece tu contraseña escribiendo tu email a continuación</p>

<form class="formulario" method="POST" action="/auth/olvide">
  <div class="campo">
    <label for="email">Email</label>
    <input 
      type="email"
      id="email"
      name="email"
      placeholder="Ingresa tu email"
    />
  </div>

  <input type="submit" class="boton" value="Enviar Instrucciones">
</form>

<div class="acciones">
  <a href="/auth">¿Ya tienes una cuenta? Inicia sesión</a>
  <a href="/auth/registro">¿Aún no tienes una cuenta? Crear una</a>
</div>

<?php require_once INCLUDES . 'inc_footer_v2.php'; ?>