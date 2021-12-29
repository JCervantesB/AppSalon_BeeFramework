<div class="campo">
    <label for="nombre">Nombre</label>
    <input 
        type="text" 
        name="nombre" 
        id="nombre"
        placeholder="Nombre Servicio"
        value="<?php echo $d->servicio->nombre; ?>"
    />
</div>
<div class="campo">
    <label for="precio">Precio</label>
    <input 
        type="number" 
        name="precio" 
        id="precio"
        placeholder="Precio Servicio"
        value="<?php echo $d->servicio->precio; ?>"
    />
</div>