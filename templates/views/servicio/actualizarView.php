<?php require_once INCLUDES . 'inc_header.php'; ?>

<h1 class="nombre-pagina">Actualizar Servicio</h1>
<p class="descripcion-pagina">Modifica los valores del formulario</p>

<?php 
  include_once __DIR__ . "/../../includes/barra.php";
  include_once __DIR__ . "/../../includes/alertas.php";
?>

<form method="POST" class="formulario">

<?php
    include_once __DIR__ . '/formulario.php'
?>

    <input type="submit" class="boton" value="Actualizar Servicio">
</form>

<?php require_once INCLUDES . 'inc_footer_v2.php'; ?>