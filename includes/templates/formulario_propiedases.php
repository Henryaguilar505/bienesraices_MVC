<fieldset>
            <legend>información General</legend>

            <label for="titulo">Título:</label>
            <input type="text" id="titulo" name="propiedad[titulo]" placeholder="Título Propiedad" value="<?php echo sanitizar($propiedad->titulo)  ?? ''; ?>">

            <label for="precio">Precio:</label>
            <input type="number" id="precio" name="propiedad[precio]" placeholder="Precio Propiedad" value="<?php echo sanitizar($propiedad->precio)  ?? ''; ?>">

            <label for="imagen">Imagen:</label>
            <input type="file" id="imagen" name="propiedad[imagen]" accept="image/jpeg, image/png">

            <?php if($propiedad->imagen ): ?>
                <img src="/includes/imagenes/<?php echo $propiedad->imagen ?>" alt="" class="imagen-small">

                <?php endif;?>

              

            <label for="descripcion">Descripción:</label>
            <textarea name="propiedad[descripcion]" id="descripcion"><?php echo  sanitizar($propiedad->descripcion)  ?? '' ?></textarea>
        </fieldset>

        <fieldset>
            <legend>Información de la propiedad</legend>

            <label for="habitaciones">Habitaciones:</label>
            <input type="number" id="habitaciones" name="propiedad[habitaciones]" placeholder="ej: 3" min="1" max="12" value="<?php echo sanitizar($propiedad->habitaciones)  ?? ''; ?>">

            <label for="wc">Baños:</label>
            <input type="number" id="wc" name="propiedad[wc]" placeholder="ej: 3" min="1" max="12" value="<?php echo sanitizar($propiedad->wc)  ?? ''; ?>">

            <label for="estacionamiento">Estacionamiento:</label>
            <input type="number" id="estacionamiento" name="propiedad[estacionamiento]" placeholder="ej: 3" min="1" max="12" value="<?php echo sanitizar($propiedad->estacionamiento)  ?? ''; ?>">

        </fieldset>


        <fieldset>
            <legend>Vendedor</legend>

            <label for="vendedores">Vendedor:</label>
            <select name="propiedad[vendedores_id]" id="vendedores">
               <option selected value="">-- Seleccione -- </option>

            <?php foreach($vendedores as $vendedor): ?>

                <option 
                  <?php echo $propiedad->vendedores_id === $vendedor->id ? 'selected' : ' ';  ?>
                  value="<?php echo sanitizar($vendedor->id) ?>">

                    <?php echo sanitizar($vendedor->nombre ) . " " . sanitizar($vendedor->apellido); ?>

                </option>

            <?php endforeach; ?>

            </select>
        </fieldset>