<?php require_once INCLUDES . 'inc_header.php'; ?>

<h1 class="nombre-pagina">Login</h1>
<p class="descripcion-pagina">Inicia sesión con tus datos</p>

<form class="formulario" method="POST" action="/auth">
  <div class="campo">
    <label for="email">Email</label>
    <input 
      type="email"
      id="email"
      name="email"
      placeholder="Ingresa tu email"
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

  <input type="submit" class="boton" value="Iniciar sesión">
</form>

<div class="acciones">
  <a href="/auth/registro">¿Aún no tienes una cuenta? Crear una</a>
  <a href="/auth/olvide">¿Olvidaste tu contraseña?</a>
</div>

<?php require_once INCLUDES . 'inc_footer_v2.php'; ?>