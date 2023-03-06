<?php 
//este archivo tiene como fin mandar a llamr funciones, base de datos y clases

//incluir las funciiones
require "funciones.php";
//incluir la conexion a la base de datos
require "config/database.php";
//incluir el autoload
require __DIR__ . "/../vendor/autoload.php";

$db = conectarDB();

use Model\ActiveRecord; //usar la clase ActiveRecord donde tenemos la base de datos

ActiveRecord::setDb($db); //de esta forma definimos a misma conwxion para cada  uno de los objetos



