<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
service('auth')->routes($routes);

$routes->get('/', 'Home::index');
$routes->group('posts', static function($routes){
    $routes->get('', 'PostController::index');
    $routes->post('', 'PostController::store');
    $routes->get('(:num)', 'PostController::view/$1');
    $routes->put('(:num)', 'PostController::update/$1');
    $routes->delete('(:num)', 'PostController::delete/$1');

    //$routes->get('search', 'PostController::search');
});

$routes->group('blogs', static function($routes){
    $routes->get('', 'BlogController::index');
    $routes->post('', 'BlogController::store');
    $routes->get('(:num)', 'BlogController::view/$1');
    $routes->put('(:num)', 'BlogController::update/$1');
    $routes->delete('(:num)', 'BlogController::delete/$1');
});

$routes->group('users', static function($routes){
    $routes->get('', 'UserController::index');
    $routes->post('', 'UserController::store');
    $routes->get('(:num)', 'UserController::view/$1');
    $routes->put('(:num)', 'UserController::update/$1');
    $routes->delete('(:num)', 'UserController::delete/$1');
});

/* 
$routes->match(['get', 'post'], 'news/create', 'NewsController::create');
$routes->get('news/(:segment)', 'NewsController::view/$1');
$routes->get('news', 'NewsController::index');
$routes->get('(:alpha)', 'PageController::view/$1'); 
*/

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
