<?php require_once INCLUDES . 'inc_header.php'; ?>

<h1 class="nombre-pagina">Servicios</h1>
<p class="descripcion-pagina">Administración de Servicios</p>

<?php 
  include_once __DIR__ . "/../../includes/barra.php";
?>

<ul class="servicios">
    <?php foreach($d->servicios as $servicio) { ?>
        <li>
            <p>Nombre: <span><?php echo $servicio->nombre; ?></span></p>
            <p>Precio: <span>$<?php echo $servicio->precio; ?></span></p>

            <div class="acciones">
                <a class="boton" href="/servicio/actualizar?id=<?php echo $servicio->id; ?>">Actualizar</a>

                <form action="/servicio/eliminar" method="POST">
                    <input type="hidden" name="id" value="<?php echo $servicio->id; ?>">
                    <input type="submit" value="Borrar" class="boton-eliminar">
                </form>
            </div>
        </li>
    <?php } ?>
</ul>

<?php require_once INCLUDES . 'inc_footer_v2.php'; ?>