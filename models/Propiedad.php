<?php

namespace Model;

//aplicamos herencia
class Propiedad extends ActiveRecord{

    protected static $columnasDB = ['id', 'titulo', 'precio', 'imagen', 'descripcion', 'habitaciones', 'wc', 
    'estacionamiento', 'creado', 'vendedores_id']; // creamos un arreglo con los indices de las columnas 

    //esta porpiedad define sobre cual tabla eestamos trabajando de la base de datos
    protected static $tabla = "propiedades";

    //propiedades propias de esta clase
    public $id;
    public $titulo;
    public $precio;
    public $imagen;
    public $descripcion;
    public $habitaciones;
    public $wc;
    public $estacionamiento;
    public $creado;
    public $vendedores_id;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? NULL;
        $this->titulo = $args['titulo'] ?? '';
        $this->precio = $args['precio'] ?? '';
        $this->imagen = $args['imagen'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->habitaciones = $args['habitaciones'] ?? '';
        $this->wc = $args['wc'] ?? '';
        $this->estacionamiento = $args['estacionamiento'] ?? '';
        $this->creado = date('Y/m/d');
        $this->vendedores_id = $args['vendedores_id'] ?? '';  
    }

       //*validar que no hayan errores
       public function validar(){ //esta funcion valida que no haya errores

        if(!$this->titulo){
             self::$errores[] = "debes agregar un titulo";
         }
    
        if (!$this->precio) {
            self::$errores[] = "El precio es obligatorio";
        }
    
        if (strlen($this->descripcion) < 50) {
            self::$errores[] = "la descripcion es muy corta";
        }
    
        if (!$this->habitaciones) {
            self::$errores[] = "El numero habitaciones es obligatorio";
        }
    
        if (!$this->wc) {
            self::$errores[] = "EL numero de baños es obigatorio";
        }
    
        if (!$this->estacionamiento) {
            self::$errores[] = "Por favor rellene el apartado de estacionamiento";
        }

        if (!$this->imagen) {
            self::$errores[] = "La imagen es obligatoria";
        }
        // //size maximo para imagen
           return self::$errores;
        }
}