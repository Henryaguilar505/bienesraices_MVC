<main class="contenedor seccion">
        <h1>Contacto</h1>

        <?php if($mensaje){
        echo "<p class='alerta exito'>" .$mensaje. "</p>"; 
        }
        ?>

        <picture>
            <source srcset="build/img/destacada3.webp" type="image/webp">
            <source srcset="build/img/destacada3.jpg" type="image/jpeg">
            <img src="build/img/destacada3.jpg" alt="imagen contacto" loading = "lazy">
        </picture>


        <form class="formulario" method="POST">
            <fieldset>
                <legend>Informacion personal</legend>
                <label for="nombre">Nombre</label>
                <input type="text" name="contacto[nombre]" id="nombre" placeholder="Tu nombre">

                <label for="mensaje">Mensaje</label>
                <textarea name="contacto[mensaje]" id="mensaje" ></textarea>
            </fieldset>

            <fieldset>
                <legend>Informacion sobre la propiedad</legend>
                <label for="opciones">Vende o Compra</label>
                <select name="contacto[tipo]" id="opciones" >
                    <option value="" disabled selected>--Seleccione--</option>
                    <option value="compra">Compra</option>
                    <option value="vende">Vende</option>
                </select>

                <label for="presupuesto">Precio o presupuesto</label>
                <input type="number" name="contacto[precio]" id="presupuesto" placeholder="tu precio o presupuesto" >
            </fieldset>

            <fieldset>
                <legend>Contacto</legend>
                <p>¿Cómo desea ser contactado?</p>

                <div class="forma-contacto">
                    <label for="contactar-telefono">Teléfono</label>
                    <input type="radio" value="telefono" name="contacto[contacto]" id="contactar-telefono" >
                
                    <label for="contactar-email">E-mail</label>
                    <input type="radio" value="email"  name="contacto[contacto]" id="contactar-eamil" >
                </div>

                 <div id="contactoInfo"></div> <!--este div sirve para mostar el html con js segun el metodo que elija el usuario -->
               
            </fieldset>

            <input type="submit" class="boton-verde" value="Enviar">
        </form>
    </main>