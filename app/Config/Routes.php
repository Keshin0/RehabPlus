<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

// Auth routes (public)
$routes->get('/',       'AuthController::login');
$routes->get('/login',  'AuthController::login');
$routes->post('/login', 'AuthController::attempt');
$routes->get('/logout',  'AuthController::logout');
$routes->post('/logout', 'AuthController::doLogout');

// Protected routes — authenticated users
$routes->group('', ['filter' => 'auth'], function ($routes) {

    $routes->get('dashboard', 'DashboardController::index');

    // Patients resource routes
    $routes->resource('patients', ['controller' => 'PatientController']);

    // Exercise records nested under patients
    $routes->get('patients/(:num)/exercises/create',          'ExerciseController::create/$1');
    $routes->post('patients/(:num)/exercises',                'ExerciseController::store/$1');
    $routes->get('patients/(:num)/exercises/(:num)/edit',     'ExerciseController::edit/$1/$2');
    $routes->post('patients/(:num)/exercises/(:num)',          'ExerciseController::update/$1/$2');
    $routes->post('patients/(:num)/exercises/(:num)/delete',  'ExerciseController::delete/$1/$2');

    // User management — SuperAdmin only
    $routes->group('users', ['filter' => 'role:superadmin'], function ($routes) {
        $routes->get('/',           'UserController::index');
        $routes->get('create',      'UserController::create');
        $routes->post('/',          'UserController::store');
        $routes->get('(:num)/edit', 'UserController::edit/$1');
        $routes->post('(:num)',     'UserController::update/$1');
        $routes->post('(:num)/delete', 'UserController::delete/$1');
    });
});

// REST API — protected by API key
$routes->group('api/v1', ['filter' => 'apiauth'], function ($routes) {
    $routes->resource('patients', ['controller' => 'Api\PatientApiController']);
});
