<?php
namespace Controllers;

use Model\Admin;
use MVC\Router;

class LoginController{
     
    public static function login(Router $router){
        $errores = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
             $auth = new Admin($_POST);

             $errores = $auth->validar();

             if(empty($errores)){ //si no hay errores
                //verificar si el usuario existe o no (mensaje de errror)
                $resultado = $auth->existeUsuario();
                if(!$resultado){
                   $errores = Admin::getErrores();
                }else{
                    //verificar el password
                   $autenticado = $auth->comprobarPassword($resultado);
                   if($autenticado){
                     //autenticar al usuario
                      $auth->autenticar();

                   }else{
                    //password incorrecto
                    $errores = Admin::getErrores();
                   }

                }

             }
        }

        $router->render('/auth/login', [
            'errores' => $errores,
        ]);
    }

    public static function logout(){
        session_start();
        session_destroy();

        header('Location:/');

    }
}




?>