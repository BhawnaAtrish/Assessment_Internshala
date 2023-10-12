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

// Car Routes
$routes->post('add_cars', [CarsController::class, 'create']);
$routes->get('add_cars', [CarsController::class, 'index']);
$routes->get('view_booked_cars', [CarsController::class, 'viewBookedCars']);
$routes->get('view_all_cars', [CarsController::class, 'viewAllCars']);
$routes->get('edit_car/(:num)', 'CarsController::editCar/$1');
$routes->post('update_car/(:num)', 'CarsController::updateCar/$1');



$routes->get('bookings', [Bookings::class, 'index']);
$routes->get('bookings/(:segment)', [Bookings::class, 'show']);
$routes->get('pages', [Pages::class, 'index']);
$routes->get('(:segment)', [Pages::class, 'view']);
