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
$routes->get('/migrate','Migrate::index');
$routes->get('/', 'Home::index',['filter'=>'auth']);
$routes->get('login', 'Authen::index');
// $routes->get('/password-reset', 'Authen::forgetPassword');
// $routes->post('/password-reset', 'Authen::emailVerify');
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
       $routes->post('search','Company::search');
       $routes->get('search','Company::search');
});

//Meeting Routes
$routes->group('meeting',['namespace'=>'App\Controllers','filter'=>'auth'],function($routes){
    $routes->get('add','Meeting::create');
    $routes->post('add','Meeting::store');
    $routes->get('list','Meeting::index');
    $routes->get('details/(:num)','Meeting::show/$1');
    $routes->post('update/(:num)','Meeting::update/$1');
    $routes->get('edit/(:num)','Meeting::edit/$1');
    $routes->get('search','Meeting::search');
    $routes->post('search','Meeting::search');
 
});

//Myactivity Routes
$routes->group('my-activity',['namespace'=>'App\Controllers','filter'=>'auth'],function($routes){
    $routes->get('company-list','UserActivity::companyList');
    $routes->get('meeting-list','UserActivity::meetingList'); 
});
//Team Management Route
$routes->group('team-management',['namespace'=>'App\Controllers'],function($routes){
    $routes->get('add-user','Team::create',['filter'=>'admin']);
    $routes->post('add-user','Team::store',['filter'=>'admin']);
    $routes->get('/','Team::index',['filter'=>'auth']); 
    $routes->get('action/(:num)','Team::status/$1',['filter'=>'admin']);
    $routes->get('user-info/(:num)','Team::userProfile/$1');
    $routes->get('user-image-update/(:num)','Team::imageUpdate/$1',['filter'=>'admin']);
    $routes->post('user-image-update/(:num)','Team::storeImage/$1',['filter'=>'admin']);
    $routes->get('resume-update/(:num)','Team::profileResume/$1',['filter'=>'admin']);
    $routes->post('resume-update/(:num)','Team::storeResume/$1',['filter'=>'admin']);

    
});

//Assign Task
$routes->group('assign',['namespace'=>'App\Controllers','filter'=>'admin'],function($routes){

    $routes->get('add-task','AssignTask::create');
    $routes->post('add-task','AssignTask::store');
    $routes->get('/','AssignTask::index');
    $routes->get('task-edit/(:num)','AssignTask::edit/$1');  
    $routes->post('task-update/(:num)','AssignTask::update/$1');  
    $routes->get('task-report','AssignTask::allReport');
    $routes->get('task-pending-report','AssignTask::pendingReport');
    $routes->get('task-complete-report','AssignTask::completeReport');
    $routes->get('task-search/(:num)','AssignTask::search/$1');    
});
//Task
$routes->group('my-task',['namespace'=>'App\Controllers','filter'=>'auth'],function($routes){
    
    $routes->get('pending','Task::index');
    $routes->get('complete','Task::complete');
    $routes->get('incomplete','Task::pending');
    $routes->get('make-complete/(:num)','Task::makeComplete/$1');  
    $routes->post('task-update/(:num)','AssignTask::update/$1');  
    $routes->get('task-report','AssignTask::allReport');
    $routes->get('task-pending-report','AssignTask::pendingReport');
    $routes->get('task-complete-report','AssignTask::completeReport');
    $routes->get('task-search/(:num)','AssignTask::search/$1');    
});
//Services Route
$routes->group('services',['namespace'=>'App\Controllers','filter'=>'admin'],function($routes){
 $routes->get('/','Services::index');
 $routes->post('add','Services::create');
});

//Contacts
$routes->group('emergency-contact',['namespace'=>'App\Controllers'],function($routes){
    $routes->get('/','Contacts::index',['filter'=>'admin']);
    //show executinve emengency contact
    $routes->get('for-agents','Contacts::emergency',['filter'=>'auth']);
   
   });
//Documents
$routes->group('company-info',['namespace'=>'App\Controllers'],function($routes){
    $routes->get('/','Info::index',['filter'=>'auth']);
    $routes->get('add','Info::create',['filter'=>'admin']);
    $routes->post('create','Info::store',['filter'=>'admin']);
    $routes->get('edit/(:num)','Info::show/$1',['filter'=>'admin']);
    $routes->post('update/(:num)','Info::update/$1',['filter'=>'admin']);
    $routes->get('delete/(:num)','Info::deleteDoc/$1',['filter'=>'admin']);
    $routes->get('document/(:any)','Info::showDoc/$1',['filter'=>'auth']);
   
   });

 //Report
 $routes->group('report',['namespace'=>'App\Controllers','filter'=>'auth'],function($routes){
    $routes->get('company','Report::companyList');
    $routes->get('meeting','Report::meetingList');
   
   
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
    $routes->post('create-company','Company::create',['filter'=>'auth']);
    //User Information Update
    $routes->post('user-update/(:num)','User::updateInfo/$1',['filter'=>'auth']);
    $routes->get('user-search','User::search',['filter'=>'auth']);
    //Get all company list
    $routes->get('company-list','Company::companyList',['filter'=>'auth']);
    //fetch user information
    $routes->get('user-information/(:num)','User::profileInfo/$1',['filter'=>'auth']);
    //Fetch service data
    $routes->get('service-list','Services::index',['filter'=>'auth']);
    $routes->get('show-service/(:num)','Services::show/$1',['filter'=>'auth']);
    $routes->post('update-service/(:num)','Services::update/$1',['filter'=>'auth']);
    $routes->get('delete-service/(:num)','Services::delete/$1',['filter'=>'auth']);
    $routes->post('search-service','Services::searchRecord',['filter'=>'auth']);
    $routes->get('active-service','Services::activeService',['filter'=>'auth']);
    $routes->get('deactive-service','Services::deactiveService',['filter'=>'auth']);
    //Fetch Meeting Data
    $routes->get('meeting-list','Meeting::index',['filter'=>'auth']);
    $routes->get('interest-service/(:num)','Meeting::interestMeeting/$1',['filter'=>'auth']);
    //fetch Meeting data on behalf of company id
    $routes->get('company-report/(:num)','Meeting::companyReport/$1',['filter'=>'auth']);

    //fetching task by id
    $routes->get('assign-task/(:num)','Task::show/$1',['filter'=>'auth']);
    //Fetching All Emergency Contact 
    $routes->get('emergency-contact-list','Contact::index',['filter'=>'auth']);
    $routes->post('emergency-contact-add','Contact::create',['filter'=>'auth']);
    $routes->get('emergency-contact-delete/(:num)','Contact::delete/$1',['filter'=>'auth']);
    $routes->get('emergency-contact-edit/(:num)','Contact::show/$1',['filter'=>'auth']);
    $routes->post('emergency-contact-update/(:num)','Contact::update/$1',['filter'=>'auth']);
    $routes->post('emergency-contact-search','Contact::search',['filter'=>'auth']);

    $routes->get('emergency-active-contact','Contact::active',['filter'=>'auth']);
    $routes->get('emergency-inactive-contact','Contact::inactive',['filter'=>'auth']);
   //User Assign Task Notify
   $routes->get('task/notify/(:num)','Notification::userNotify/$1',['filter'=>'auth']);
   //User noti mark as read
   $routes->get('task/mark-as-read/(:num)','Notification::markasRead/$1',['filter'=>'auth']);
   //Admin notice for user activity
   $routes->get('user-activity','Notification::userActivityNotice',['filter'=>'auth']);

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
