<?php 

namespace MVC;

class Router{

    //array para guardar las rutas
    public $rutasGet = []; 
    public $rutasPost = [];

    //funcion para asociar una funcion a una ruta
    //obtemos como  primer paramtro la url, luego pasamos en forma de array la clase y el metodo
    public function get($url , $fn){
        $this->rutasGet[$url] = $fn; //asociar funcion a la ruta
        //ej : $this->rutasGet['/admin'] = ['Controllers\PorpiedadCrontroller', 'index']
    }

    public function post($url, $fn){
        $this->rutasPost[$url] = $fn;
    }

    public function comprobarRutas(){
        $urlActual = $_SERVER['PATH_INFO'] ?? '/'; //obtener ruta actual
        $metodo = $_SERVER['REQUEST_METHOD']; //obtener el metodo de envio

        session_start();
        $auth = $_SESSION['login'] ?? NULL; //comprobar si se ha logeado

        //array de paginas protegidas
        $paginasProtegidas = ['/admin', '/propiedades/crear', '/propiedades/actualizar','/propiedades/eliminar',
                              '/vendedores/crear', '/vendedores/actualizar', '/vendedores/eliminar'];

        if($metodo === 'GET'){
            $fn = $this->rutasGet[$urlActual] ?? NULL; //buscamos la funcion que corresponda a la url que estamos visitando
            //ej: $fn = ['Controllers\PorpiedadCrontroller', 'index']
        }else {
            $fn = $this->rutasPost[$urlActual] ?? NULL;
        }

        if(in_array($urlActual, $paginasProtegidas) && !$auth){ //si la pagina esta protegida y no esta autenticado
            header('location:/');//redirigimos
        }

        

        if($fn){
            //la url si existe y podemos procedes
             /*call_user_func() es una función incorporada en PHP que se 
                usa para llamar a la devolución de llamada proporcionada por el primer 
                parámetro y pasa los parámetros restantes como argumento. Se utiliza para 
                llamar a las funciones definidas por el usuario.
            */
            call_user_func($fn, $this); //mandamos a llamr las funciones, $this hace referenia a la clase Ruoter que es el parametro que necesita las funciones de nuestro controlador
            //ej: Controllers\PropiedadController::index(Router $this)
        }else{
            //la pagina no existe, debemos redirigir
            echo "No definida";
        }
    }

    //funcion para devolver una vista
    //esta funcion recibira la rura de la vista que queremos renderizar
    //y ademas los datos que queremos mostrar
    public function render($view, $datos = []){ 

        foreach($datos as $key => $value){
            //conertimos el array asociativo que pasamos como segundo parametro
            //en variables con su respectivo valor
            //de esta forma podremos impimir eso daros en nustro layout
               $$key = $value;
               //eje:  $mensaje = 'desde la vista';

        }
        /* Esta función activará el almacenamiento en búfer de la salida.
         Mientras dicho almacenamiento esté activo,
         no se enviará ninguna salida desde el script (aparte de cabeceras); 
         en su lugar la salida se almacenará en un búfer interno.
        */
        ob_start();
        include __DIR__ ."/views/{$view}.php";
    
        $contenido = ob_get_clean(); //ahora lo que se guado desde ob_start(), lo pasamos a la variable
        //$contenido = /views/{$view}.php
    
        //y ahora si solicitamos la vista de la pagina master y ademas de eso ya 
        //tenemos el contenido que deseamos guardar en la variable de $contenido
    
        include __DIR__ ."/views/layout.php";
    }

        
    
}