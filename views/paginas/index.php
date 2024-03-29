<?php include 'iconos.php' ?>

    <!-- *canuncios-->

    <section class="seccion contenedor">
        <h2>Casas y Depas en Venta</h2>

       <?php 
       include 'listado.php';
        ?>  

        </div><!--contenedor anuncios-->

        <div class="alinear-derecha">
            <a class="boton-verde" href="/propiedades">Ver Todas</a>
        </div>
    </section>

    <!--*contacto-->
    <section class="imagen-contacto">
        <h2>Encuentra la casa de tus sueños</h2>
        <p>LLena el formulario de contacto y un asesor se pondrá en contacto contigo a la brevedad</p>
        <a href="contacto.php" class="boton-amarillo">Contactanos</a>

    </section>

    <div class="contenedor seccion seccion-inferior">
        <section class="blog">
            <h3>Nuestro blog</h3>

            <article class="entrada-blog"> 
                <div class="imagen">
                    <picture>
                        <source srcset="build/img/blog1.webp" type="image/webp">
                        <source srcset="build/img/blog1.jpg" type="image/jpeg">
                        <img loading="lazy" src="build/img/blog1.jpg" alt="Imagen entrada blog">
                    </picture>
                </div>

                <div class="texto-entrada">
                    <a href="entrada.php">
                        <h4>
                            Terraza en el techo de tu casa.
                        </h4>
                        <p class="informacion-meta">
                            Escrito el : <span>20/10/2021</span> por: <span>Admin</span>
                        </p>

                        <p>
                            Consejos para construir una terraza en el techo de tu casa
                            con los mejores materiales y ahoorando dinero
                        </p>
                    </a>

                </div>

            </article>

            <article class="entrada-blog"> 
                <div class="imagen">
                    <picture>
                        <source srcset="build/img/blog2.webp" type="image/webp">
                        <source srcset="build/img/blog2.jpg" type="image/jpeg">
                        <img loading="lazy" src="build/img/blog2.jpg" alt="Imagen entrada blog">
                    </picture>
                </div>

                <div class="texto-entrada">
                    <a href="entrada.php">
                        <h4>
                            Guia para la decoración de tu hogar.
                        </h4>
                        <p class="informacion-meta">
                            Escrito el : <span>20/10/2021</span> por: <span>Admin</span>
                        </p>

                        <p>
                            Maximiza el espacio en tu hogar con esta guia, aprende a combinar muebles y 
                            colores para darle vida a tu espacio.
                        </p>
                    </a>

                </div>

            </article>

        </section>

        <section class="testimoniales">
            <h3>testimoniales</h3>

            <div class="testimonial">
                <blockquote>
                    El personal se comportóde una excelente forma, muy buena atención y la casa
                    que me ofrecieron cumple con todas mis expectativas.
                </blockquote>

                <p>- Juan De La Torre.</p>

            </div>
        </section>

    </div>