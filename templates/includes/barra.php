<div class="barra">
    <div class="avatar">
        <p class="inicial"><?php echo substr($d->nombre, 0, 1);?></p>
    </div>
    <p><?php echo $d->nombre ?? '';?></p>
    <a class="boton" href="/auth/logout">Cerrar Sessión</a>
</div>

<?php if(isset($_SESSION['admin'])) { ?>
    <div class="barra-servicios">
        <a href="/admin" class="boton">Ver Citas</a>
        <a href="/servicio" class="boton">Ver Servicios</a>
        <a href="/servicio/crear" class="boton">Crear Servicio</a>
    </div>
<?php } ?>