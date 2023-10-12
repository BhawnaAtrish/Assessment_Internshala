<?php

use CodeIgniter\Router\RouteCollection;
use App\Controllers\Pages;
use App\Controllers\Bookings;
use App\Controllers\CarsController;
use App\Controllers\AuthController;


/**
 * @var RouteCollection $routes
 */

// Authentication routes
$routes->get('/', [AuthController::class, 'index']);
$routes->post('login', [AuthController::class, 'authenticate']);
$routes->get('logout', [AuthController::class, 'logout']);

$routes->post('add_cars', [CarsController::class, 'create']);
$routes->get('add_cars', [CarsController::class, 'index']);
$routes->get('bookings', [Bookings::class, 'index']);
$routes->get('bookings/(:segment)', [Bookings::class, 'show']);
$routes->get('pages', [Pages::class, 'index']);
$routes->get('(:segment)', [Pages::class, 'view']);
