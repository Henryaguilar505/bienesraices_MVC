<?php

//incluimos nustro archivo donde tenemos la db, el autload y algunas funciones
require_once  __DIR__ . "/../includes/app.php";
//importamos nuestro router

use Controllers\LoginController;
use MVC\Router;
use Controllers\PropiedadController;
use Controllers\VendedoresController;
use Controllers\PaginasController;

$router = new Router();

//definimos nuestras rutas de acuerdo a sus metodos de envio(post y get)
//pasamos como parametros la ur, seguido de un array con el namespace y el metodo que corresponde usar de nuestro controlador
$router->get('/admin', [PropiedadController::class, 'index']); //definimos las funciones para las rutas
$router->get('/propiedades/crear', [PropiedadController::class, 'crear']);
$router->get('/propiedades/actualizar', [PropiedadController::class, 'actualizar']);
$router->post('/propiedades/crear', [PropiedadController::class, 'crear']);
$router->post('/propiedades/actualizar', [PropiedadController::class, 'actualizar']);
$router->post('/propiedades/eliminar', [PropiedadController::class, 'eliminar']);

//rutas de vendedores
$router->get('/vendedores/crear', [VendedoresController::class, 'crear']);
$router->get('/vendedores/actualizar', [VendedoresController::class, 'actualizar']);
$router->post('/vendedores/crear', [VendedoresController::class, 'crear']);
$router->post('/vendedores/actualizar', [VendedoresController::class, 'actualizar']);
$router->post('/vendedores/eliminar', [VendedoresController::class, 'eliminar']);

//rutas generales (zona publica)
$router->get('/', [PaginasController::class, 'index']);
$router->get('/nosotros', [PaginasController::class, 'nosotros']);
$router->get('/propiedades', [PaginasController::class, 'propiedades']);
$router->get('/propiedad', [PaginasController::class, 'propiedad']);
$router->get('/blog', [PaginasController::class, 'blog']);
$router->get('/entrada', [PaginasController::class, 'entrada']);
$router->get('/contacto', [PaginasController::class, 'contacto']);
$router->post('/contacto', [PaginasController::class, 'contacto']);

//rutas para login
$router->get('/login', [LoginController::class, 'login']);
$router->post('/login', [LoginController::class, 'login']);
$router->get('/logout', [LoginController::class, 'logout']);



$router->comprobarRutas();