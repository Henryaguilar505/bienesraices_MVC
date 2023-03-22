<?php 

namespace Controllers;

use MVC\Router;
use Model\Vendedor;

class VendedoresController{

    public static function crear(Router $router){
         
        $vendedor = new Vendedor();
        $errores =  Vendedor::getErrores();

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $vendedor = new Vendedor($_POST['vendedor']);
            $errores = $vendedor->validar();
            if(empty($errores)){
                $vendedor->guardar();
            }
        }

        $router->render('/vendedores/crear', [
            "errores" => $errores,
            "vendedor" => $vendedor
        ]);
    }

    public static function actualizar(Router $router){
        
        $id = validarORedireccionar('/admin');

        $vendedor = Vendedor::find($id);
        $errores = Vendedor::getErrores();

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $args = $_POST['vendedor'];
            
            //sincronizamos con los datos nuevos
            $vendedor->sincronizar($args);
            $errores = $vendedor->validar();
            if(empty($errores)){
               $resultado = $vendedor->guardar();
            }
        }

        $router->render('/vendedores/actualizar', [
            'vendedor' => $vendedor,
            'errores' => $errores
        ]);
    }

    public static function eliminar(){

        if ($_SERVER['REQUEST_METHOD'] === 'POST') { //comprobar si se ha enviado un id por POST

            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT); //Filtrar el Id
         
            if ($id) {
             //procedemos a eliminar
             $vendedor = Vendedor::find($id);
             $vendedor->eliminar();
            }
        }
    }

}