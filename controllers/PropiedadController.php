<?php

namespace Controllers;

use MVC\Router;
use Model\Propiedad; //importar los modelos
use Model\Vendedor;
use Intervention\Image\ImageManagerStatic as Image; //importar el paquere para manipular imagenes

class PropiedadController
{

    public static function index(Router $router)
    {
        /* el motivo para requerir el router es porque
           tambien vamos a ejecutar su metodos,
           igualmente con los modelos
        */

        $propiedades = Propiedad::all();  //extraemos los datos
        $vendedores = Vendedor::all();
        $resultado = $_GET['resultado'] ?? null;

        //rederizamos los datos junto a su vista correspondiente
        $router->render('propiedades/admin', [
            'propiedades' => $propiedades,
            'resultado' => $resultado,
            'vendedores' => $vendedores
        ]);
    }

    public static function crear(Router $router)
    {

        $propiedad = new Propiedad;
        $vendedores = Vendedor::all();
        $errores = Propiedad::getErrores();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            //creamos una nueva instancia
            $propiedad = new Propiedad($_POST['propiedad']); // llenamos nuestro objeto con el array de post

            //generar nombre unico para cada imagen
            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

            if ($_FILES['propiedad']['tmp_name']['imagen']) { //comprobar si existe la imagen
 
                $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800, 600); //obtener la imagen y definir su tamanio
                //setear la imagen
                $propiedad->setImagen($nombreImagen); //asignar el nombre de la imagen que creamos
            }

            //validamos que no haya errores
            $errores = $propiedad->validar();

            if (empty($errores)) { //si no hay errores ...

                //comporobar si ya existe la carpeta de imganes
                if (!is_dir(CARPETAIMAGENES)) {
                    mkdir(CARPETAIMAGENES);
                }

                //guardar la imagen en el servidor
                $image->save(CARPETAIMAGENES . '/' . $nombreImagen); //pasmos como parametros la direccion dond lo queremos guardar
                //guardar en la base de datos
                $propiedad->guardar(); //guardamos
            }
        }
        $router->render('propiedades/crear', [
            'propiedad' => $propiedad,
            'vendedores' => $vendedores,
            'errores' => $errores
        ]);
    }

    public static function actualizar(Router $router)
    {
        $id = validarORedireccionar('/admin');

        $propiedad = Propiedad::find($id);
        $errores = Propiedad::getErrores();
        $vendedores = Vendedor::all();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            //asignar los cambios que el usuario vaya haciendo en cada campo
            $args = $_POST['propiedad'];
            //sincronizar los datos en memoria a medida que el usario los vaya editando
            $propiedad->sincronizar($args);
            //validacion
            $errores = $propiedad->validar();
        
            //generar nombre unico para cada imagen
            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";
            if ($_FILES['propiedad']['tmp_name']['imagen']) { //comprobar si existe la imagen
                //realizar un resize a la imagen con intervention Image
                $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800, 600); //obtener la imagen y definir su tamanio
                //setear la imagen
                $propiedad->setImagen($nombreImagen); //asignar el nombre de la imagen que creamos
        
                //guardar la imagen en el servidor
                $image->save(CARPETAIMAGENES .'/' . $nombreImagen); 
            }
            
            if (empty($errores)) {
                $resultado = $propiedad->guardar();
            }
        }

        $router->render('propiedades/actualizar', [
            'propiedad' => $propiedad,
            'errores' => $errores,
            'vendedores' => $vendedores
        ]);
    }

    public static function eliminar(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') { //comprobar si se ha enviado un id por POST

            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT); //Filtrar el Id
         
            if ($id) {
                $propiedad = Propiedad::find($id);
                $propiedad->eliminar();
            }
         }    
    }
}
