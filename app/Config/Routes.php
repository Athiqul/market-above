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
$routes->get('logout', 'Authen::destroy');

//User related routes
$routes->group('user',['namespace'=>'App\Controllers','filter'=>'auth'],function ($routes){
          $routes->get('my-profile','User::myProfile');
          $routes->get('profile-image-change/(:num)','User::profileImage/$1');
          $routes->post('profile-image-change/(:num)','User::storeImage/$1');
          $routes->get('resume-upload','User::profileResume');
          $routes->post('resume-upload','User::storeResume');
          $routes->get('profile-image-show/(:any)','User::image/$1');
          $routes->get('resume-show/(:any)','User::showResume/$1');
          //for password change
          $routes->get('password-change','User::passwordChange');
          $routes->post('password-change','User::storePassword');

});

$routes->group('company',['namespace'=>'App\Controllers','filter'=>'auth'],function($routes){
       $routes->get('add','Company::create');
       $routes->post('add','Company::store');
       $routes->get('list','Company::index');
       $routes->get('details/(:num)','Company::companyInfo/$1');
       $routes->post('update/(:num)','Company::updateCompany/$1');
       $routes->get('edit/(:num)','Company::editCompany/$1');
});

//Meeting Routes
$routes->group('meeting',['namespace'=>'App\Controllers','filter'=>'auth'],function($routes){
    $routes->get('add','Meeting::create');
    $routes->post('add','Company::store');
    $routes->get('list','Company::index');
    $routes->get('details/(:num)','Company::companyInfo/$1');
    $routes->post('update/(:num)','Company::updateCompany/$1');
    $routes->get('edit/(:num)','Company::editCompany/$1');
});

//Services Route
$routes->group('services',['namespace'=>'App\Controllers','filter'=>'auth'],function($routes){
 $routes->get('/','Services::index');
 $routes->post('add','Services::create');
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
    //User Information Update
    $routes->post('user-update/(:num)','User::updateInfo/$1');
    //Get all company list
    $routes->get('company-list','Company::companyList');
    //fetch user information
    $routes->get('user-information/(:num)','User::profileInfo/$1');
    //Fetch service data
    $routes->get('service-list','Services::index');
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
