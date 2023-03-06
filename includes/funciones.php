<?php 

// DIR hace que php defina la ruta completa hacia un archivo.
define('TEMPLATES_URL', __DIR__ . '/templates');
define('FUNCIONES_URL', __DIR__ . 'funciones.php');
define('CARPETAIMAGENES', __DIR__ . '/imagenes');

//cuando llamemos a esta funcion nos va a devolver la ruta a la carpeta de nuestros
//templates, y concatenaremos el nombre del template que passaremos como parametro.
function IncluirTemplate( string $nombre, bool $inicio = false) {
    include TEMPLATES_URL . "/{$nombre}.php";
} 

//funcion para comprobar si un usuario esta autenticado
function estaAutenticado() {
    session_start();

    if(!$_SESSION['login']){ //si no hay un login
       header('Location:/');
    }
}

function debuguear($variable){
    echo "<pre>";
    var_dump($variable);
    echo "<pre>";

    exit;
}

//sanitizar el htmli
function sanitizar($html) : string{
    $sanitizado = htmlspecialchars($html);
    return $sanitizado;
}

//funcion para comprobar si es tipo vendedor o tipo proopiedad
function validarTipo($tipo) : bool{
    //definimos los tipos validos
    $tipos = ['vendedor', 'propiedad'];

    return in_array($tipo, $tipos); //returnamos true or false
}

//mostrar notificaiones
function mostrarNotificaiones(int $resultado) : string{
    $mensaje = '';
    switch ($resultado) {
        case 1:
            $mensaje = "Registrado correctamente";
            break;
        case 2:
             $mensaje = "Actualizado correctamente";
             break; 
         case 3:
             $mensaje = "Eliminado correctamente";
             break;
        
        default:
            $mensaje = false;
            break;
    }

    return $mensaje;
}