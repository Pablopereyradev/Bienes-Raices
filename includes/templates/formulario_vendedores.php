<fieldset>
    <legend>Información General</legend>
    
    <label for="nombre">Nombre:</label>
    <input name="vendedor[nombre]" type="text" id="nombre" placeholder="Nombre del Vendedor" value="<?php echo s( $vendedor->nombre ); ?>">

    <label for="nombre">Apellido:</label>
    <input name="vendedor[apellido]" type="text" id="apellido" placeholder="Apellido del Vendedor" value="<?php echo s( $vendedor->apellido ); ?>">


</fieldset>

<fieldset>
    <legend>Información Extra</legend>
    <label for="nombre">Telefono:</label>
    <input name="vendedor[telefono]" type="text" id="telefono" placeholder="Telefono del Vendedor" value="<?php echo s( $vendedor->telefono ); ?>">

</fieldset>