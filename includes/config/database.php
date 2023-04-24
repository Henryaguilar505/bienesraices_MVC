<?php 

function conectarDB() : mysqli{
    $db = new mysqli('localhost', 'root', ' ', 'bienesraices_crud');

    if(!$db){
        echo "ha ocurrido un error";

        exit;
    }

    return $db;
}
