<?php namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
// $routes->get('/', 'Home::index');
$routes->get('/', 'Home_controller::index');

$routes->get('/hola/ruta', function(){
	echo 'Hola desde Routes.php con la funcion get';
});

$routes->add('/hola/ruta/add', function(){
	echo 'Hola desde Routes.php con la funcion add';
});


$routes->get('/hola/controlador', 'Hola_controller::index');

$routes->get('/hola/parametros/(:any)/(:num)', 'Hola_controller::parametrosAction/$1/$2');

$routes->get('/hola/expresion/([a-z]+)/(\d+)', 'Hola_controller::parametrosAction/$1/$2');

$routes->get('/hola/vista', 'Hola_controller::vistaAction');

// PERSONA
$routes->get('/persona/datos/(:any)/(:num)', 'Persona_controller::mostrarDatosAction/$1/$2');
$routes->get('/persona/datoslaborales/(:any)/(:num)', 'Persona_controller::datosLaboralesAction/$1/$2');
$routes->get('/persona/listar', 'Persona_controller::listarAction');

// CALCULADORA
$routes->get('/calculadora/aritmetica/(:num)/(:num)', 'Calculadora_controller::calculosAritemicosAction/$1/$2');
$routes->get('/calculadora/geometrica/(:num)/(:num)', 'Calculadora_controller::calculosGeometricosAction/$1/$2');

// TAREAS
$routes->get('/practica/productos', 'Hola_controller::practicaAction');

// USER
$routes->get('/user', 'UserController::index');

/**
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need to it be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
