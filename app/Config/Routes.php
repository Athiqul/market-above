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
$routes->get('/', 'Home::index',['filter'=>'auth']);
$routes->get('login', 'Authen::index');
$routes->post('verify', 'Authen::verify');

$routes->group('company',['namespace'=>'App\Controllers'],function($routes){
       $routes->get('add','Company::create');
       $routes->post('add','Company::create');
       $routes->get('list','Company::index');
       $routes->get('show/(:num)','Company::show/$1');
       $routes->post('update/(:num)','Company::update/$1');
});


$routes->group('api',['namespace'=>'App\Controllers\Api'],function($routes){
    $routes->get('divisions','Divisions::index');
    $routes->get('districts','Districts::index');
   
    $routes->get('division-to-districts/(:num)','Districts::disUnderDiv/$1');
    $routes->get('district-to-thana/(:num)','Thana::thanaUnderDis/$1');
    $routes->get('thana-to-unions/(:num)','Unions::unionUnderThana/$1');
    $routes->post('create-thana','Thana::createThana');
    $routes->post('create-union-ward','Unions::createUnionWard');

    //Company Add
    $routes->post('create-company','Company::create');
});


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
