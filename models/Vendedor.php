<?php

namespace Model;

//aplicamos herencias
class Vendedor extends ActiveRecord
{

    protected static $columnasDB = ['id', 'nombre', 'apellido', 'telefono']; // creamos un arreglo con los indices de las columnas 

    //esta tabla define sobre cual tabla estamos trabajando de la base de datos
    protected static $tabla = "vendedores";

    //propiedades propias de esta clase
    public $id;
    public $nombre;
    public $apellido;
    public $telefono;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? NULL;
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
    }
    //*validar que no hayan errores
    public function validar()
    { //esta funcion valida que no haya errores

        if (!$this->nombre) {
            self::$errores[] = "El nombre es obligatorio";
        }

        if (!$this->apellido) {
            self::$errores[] = "El apellido es obligatorio";
        }

        if (!$this->telefono) {
            self::$errores[] = "El telefono es obligatorio";
        }

        if(!preg_match(('/[0-9]{8}/'), $this->telefono)){
            self::$errores[] = "Formato de telefono invalido";
        }
        // //size maximo para imagen
        return self::$errores;
    }
}
