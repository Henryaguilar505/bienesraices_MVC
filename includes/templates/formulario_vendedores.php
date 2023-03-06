<fieldset>
    <legend>información del vendedor</legend>

    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="vendedor[nombre]" placeholder="Nombre vendedor(a)" value="<?php echo sanitizar($vendedor->nombre)  ?? ''; ?>">

    <label for="apellido">Apellido:</label>
    <input type="text" id="apellido" name="vendedor[apellido]" placeholder="Apellido vendedor(a)" value="<?php echo sanitizar($vendedor->apellido)  ?? ''; ?>">

    <label for="telefono">Telefono:</label>
    <input type="tel" id="telefono" name="vendedor[telefono]" placeholder="ej: +505 88888888"  value="<?php echo sanitizar($vendedor->telefono)  ?? ''; ?>">

</fieldset>