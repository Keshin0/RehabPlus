<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// ======================================================
// AUTH ROUTES
// ======================================================

$routes->get('/', 'AuthController::login');

$routes->get('/login', 'AuthController::login');
$routes->post('/login', 'AuthController::attempt');

$routes->get('/logout', 'AuthController::logout');
$routes->post('/logout', 'AuthController::doLogout');


// ======================================================
// PROTECTED ROUTES
// ======================================================

$routes->group('', ['filter' => 'auth'], function ($routes) {

    // ==================================================
    // DASHBOARD
    // ==================================================

    $routes->get('dashboard', 'DashboardController::index');


    // ==================================================
    // PATIENTS
    // ==================================================

    $routes->resource('patients', [
        'controller' => 'PatientController'
    ]);


    // ==================================================
    // EXERCISE RECORDS
    // ==================================================

    $routes->get(
        'patients/(:num)/exercises/create',
        'ExerciseController::create/$1'
    );

    $routes->post(
        'patients/(:num)/exercises',
        'ExerciseController::store/$1'
    );

    $routes->get(
        'patients/(:num)/exercises/(:num)/edit',
        'ExerciseController::edit/$1/$2'
    );

    $routes->post(
        'patients/(:num)/exercises/(:num)',
        'ExerciseController::update/$1/$2'
    );

    $routes->post(
        'patients/(:num)/exercises/(:num)/delete',
        'ExerciseController::delete/$1/$2'
    );


    // ==================================================
    // APPOINTMENTS MODULE
    // ==================================================

    $routes->get(
        'appointments',
        'Appointments::index'
    );

    $routes->get(
        'appointments/create',
        'Appointments::create'
    );

    $routes->post(
        'appointments/store',
        'Appointments::store'
    );


    // ==================================================
    // RECOVERY ANALYTICS
    // ==================================================

    $routes->get(
        'analytics',
        'DashboardController::index'
    );


    // ==================================================
    // USER MANAGEMENT
    // ==================================================

    $routes->group('users', ['filter' => 'role:superadmin'], function ($routes) {

        $routes->get(
            '/',
            'UserController::index'
        );

        $routes->get(
            'create',
            'UserController::create'
        );

        $routes->post(
            '/',
            'UserController::store'
        );

        $routes->get(
            '(:num)/edit',
            'UserController::edit/$1'
        );

        $routes->post(
            '(:num)',
            'UserController::update/$1'
        );

        $routes->post(
            '(:num)/delete',
            'UserController::delete/$1'
        );

    });

});


// ======================================================
// REST API
// ======================================================

$routes->group('api/v1', ['filter' => 'apiauth'], function ($routes) {

    $routes->resource('patients', [
        'controller' => 'Api\PatientApiController'
    ]);

});