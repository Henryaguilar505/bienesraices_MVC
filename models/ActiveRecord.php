<?php

//esta sera la clase padre de propiedad y vendedores

namespace Model;

class ActiveRecord{
    
    protected static $db; // estos daatos estan protegidos para no ser edditados por los obejtos, solo por las clases
    protected static $columnasDB = ['id', 'titulo', 'precio', 'imagen', 'descripcion', 'habitaciones', 'wc', 
    'estacionamiento', 'creado', 'vendedores_id']; // creamos un arreglo con los indices de las columnas 
    protected static $tabla = ''; //esta propiedad sera util al momento de heredar ya que servira para saber de que tabla es la clase

    protected static $errores = [];

    public static function setDB($database){ // ya que la conexion debe ser la misma para todos los obejtos de esta clase solo  neceesitamos definiraal una sola vez
        self::$db = $database;
    }


    //funcion para crear o actualizar una propiedad
    public function guardar(){
        if(!is_null($this->id)){ //si ya hay un id significa que estamos actualizando porque no el id se crea al hacer el insert 
            $this->actualizar();
        }else{
            $this->crear();
        }

    }

    public function crear(){
        //sanitizar los datos
        $atributos = $this->sanitizarAtributos();

        //array_keys obtiene los keys de un arreglo] (aplica lo mismo para array_values)
        //join convierte un arreglo en un string, recibe 2 parametros (separador,  array);
        $query = "INSERT INTO ". static::$tabla ." ( ";
        $query .= join(', ', array_keys($atributos));
        $query .= " ) values('"; 
        $query .= join("', '", array_values($atributos));
        $query .= "')";

        $resultado = self::$db->query($query);
        
        //redireccionar al usuario si todo sale bien
        if ($resultado) {
            header('Location: /admin?resultado=1');
        }
    }

    public function actualizar(){
        //sanitizar los datos
        $atributos = $this->sanitizarAtributos(); //array de atributos ya sanitizados
        $valores = []; //nuevo array para relacionar los atributos con su nuevo valor
        foreach($atributos as $key => $value){
            $valores[] = "{$key}='{$value}'"; //relacionar atributos con su nuevo valor
        }

        $query = "UPDATE ". static::$tabla ." SET ";
        $query .= join(', ' , $valores); //hacer del arrar un solo string para poder aplicar la consulta mysql // unir el array en un solo estring separado por comas
        $query .= " WHERE id = '" . self::$db->escape_string($this->id) . "' "; //sanitizar siempre al hacer consultas
        $query .= "LIMIT 1 "; //recomendado siempre

        $resultado = self::$db->query($query);

        //si se ejecuta correctamente entonces redireccionamos 
        if ($resultado) {
            header('Location: /admin?resultado=2');
        } 

        return $resultado;
    }

    //*funcion para eliminar registros
    public function eliminar(){
        $query = "DELETE FROM ". static::$tabla ." WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1";
        $resultado = self::$db->query($query);

        //redirigir
        if($resultado){ //si hay un resultado procedemos a borrar la imagen
            $this->borrarImagen();
            header('Location:/admin?resultado=3');
         }
    }

    //*Mapear las columas de la base de datos con las propiedades de esta clase
    public function atributos(){ //esta funcion solo mapea la propiedad de las columas con sus columnas respectivamente
        $atributos = []; //array de atributos a llenar
        foreach(static::$columnasDB as $columna){ //recorremos cada inidce de cada columa
            if($columna === 'id') continue; // el id no es necesario entonces lo saltamos
            $atributos[$columna] = $this->$columna; //recoremos las columnas y le asignamos el valor de su respectiva propiedad
             // ejemplo $atributo['titulo'] = $this->titulo
            //de esta forma mapeamos cada columna con el valor que corresponde
        }
        return $atributos;
    }

    //*santizar los datos del query que vamos a ejecutar
    public function sanitizarAtributos(){ 
        $atributos = $this->atributos();
        $sanitizado = []; //creamos un arreglo par los datos sanitizados 

    foreach ($atributos as $key => $value) { //recorrremos los atributos
        $sanitizado[$key] = self::$db->escape_string($value); //sanitizamos los atributos
    }
      return $sanitizado; // devolvemos los atributos sanitizados
    }

    //*setter para guardar el nombre de la imagen
    //debemos tener el cuenta que la imagen se envia por FIlES y no por POST que pasamos al constructor
    public function setImagen($imagen){
        //eliminar imagen previa(en caso de actualizar)
        if(!is_null($this->id)){ //si existe un id y tiene un valor, significa que estamos actualizando
           $this->borrarImagen();
        }
        //asignamos al atribut0 de imagen el nombre
        if($imagen){
            $this->imagen = $imagen;
        }
    }

    //*eliminar el archivo de imagenes
    public function borrarImagen(){
           //comprobar si existe un archivo
           $existeImagen = file_exists(CARPETAIMAGENES . '/' . $this->imagen);
           //si existe la imagen ya, entonces la eliminamos
           if($existeImagen){
              unlink(CARPETAIMAGENES . '/' . $this->imagen);
           }
    }

    //*getter de errores
    public static function getErrores(){ // este es un getter para los errores
        return static::$errores;
    }

    //*validar que no hayan errores
    public function validar(){ //esta funcion valida que no haya errores
       static::$errores = []; //estatic hace referencia al atributo que corresponde en cada clase heredada  // //size maximo para imagen
       return static::$errores;
    }

    //*metodo para listar todos los registros
    public static function all(){
        //al usar static hacemos referencia al atributo tabla de las clases que tienen la herencia
        //asi hacemos un select de forma dinamica
        $query = "SELECT * FROM " . static::$tabla;
        $resultado = self::consultarSQL($query); // pasamos el query a otra funcion donde se lleva a cabo la consulta
        return $resultado;
    }

    //*metodo para listar registros pero con un limite
    public static function get($cantidad){
        $query = "SELECT * FROM " . static::$tabla ." LIMIT ". $cantidad;
        $resultado = self::consultarSQL($query); // pasamos el query a otra funcion donde se lleva a cabo la consulta
        return $resultado;
    }

    //*metodo para listar registros por su id
    public static function find($id){
        $query = "SELECT * FROM ". static::$tabla ." WHERE id = {$id}";
        $resultado = self::consultarSQL($query);
        return array_shift($resultado); // array shift es equivalenta a $resultado[0];
    }

    public static function consultarSQL($query){
        //consultar la base de datos
        $resultado = self::$db->query($query);

        //iterar los resultados
        $array = [];
        while($registro = $resultado->fetch_assoc()){ //traemos cada resultado con un while
        $array[] = static::crearObjeto($registro); //iteremos cada resultado y lo pasamos al metodo de crear objeto
                                                // de esta forma crearemos un arreglo lleno de muchos objetos                                       
        }  
        //liberar la memoria
        $resultado->free();// es opcional ya que php libera memerio por si solo

        //retornar el resultado
        return $array; //devolvemos el array lleno de objetos
    }

    public static function crearObjeto($registro){ //recibimos los resultados de una consulta en forma de array
        //new self == new Propiedad
        $objeto = new static;  //creamos un objeto de la clase donde estemos heredando esta;

        foreach($registro as $key => $value){ //recorremos el array con su indice y su valor
            if (property_exists($objeto, $key)) {  //comprobamos si cada propiedad exist en el objeto
                $objeto->$key = $value; //llenamos cada propiedad con el valor que corresponda
            }
        }
        return $objeto;
    }

    //sincronizar los datos que esten en memeria con los datos realizados por el usuario (para cuando vayamos a actualizar)
    public function sincronizar($args = []){
        //comprobar si las propiedaades que estamos pasansdo existen en la calse
        foreach($args as $key => $value){
            if (property_exists($this, $key) && !is_null($value)) {   // property_exists('nombre_clase', 'propiedad a buscar)
                 $this->$key =$value;
            }
        }

    }
}