
<main class="contenedor seccion">
    <h1>Iniciar Sesión</h1>

    <form class="formulario contenido-centrado" method="POST" action="/login">

        <?php foreach ($errores as $error) : ?>

            <div class="alerta error">
                <?php echo $error; ?>
            </div>

        <?php endforeach; ?>

        <fieldset>
            <legend>E-mail y password</legend>

            <label for="email">E-mail</label>
            <input type="email" name="email" id="email" placeholder=" tu E-mail">

            <label for="password">Password</label>
            <input type="password" name="password" id="password" placeholder="Tu password">

        </fieldset>

        <button type="submit" class=" boton-verde">Iniciar sesión</button>


    </form>
</main>
