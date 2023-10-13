<?php

use CodeIgniter\Router\RouteCollection;
use App\Controllers\Pages;
use App\Controllers\BookingController;
use App\Controllers\CarsController;
use App\Controllers\AuthController;


/**
 * @var RouteCollection $routes
 */

$routes->get('register', [AuthController::class, 'register']);

// Authentication routes
$routes->get('/', [AuthController::class, 'index']);
$routes->post('login', [AuthController::class, 'authenticate']);
$routes->get('logout', [AuthController::class, 'logout']);
$routes->post('/register-customer', [AuthController::class, 'createCustomer']);
$routes->post('/register-agency', [AuthController::class, 'createAgency']);

// Car Routes
$routes->post('add_cars', [CarsController::class, 'create']);
$routes->get('add_cars', [CarsController::class, 'index']);
$routes->get('view_available_cars', [CarsController::class, 'availableCars']);
$routes->get('view_booked_cars', [CarsController::class, 'viewBookedCars']);
$routes->get('view_all_cars', [CarsController::class, 'viewAllCars']);
$routes->get('edit_car/(:num)', 'CarsController::editCar/$1');
$routes->post('update_car/(:num)', 'CarsController::updateCar/$1');

$routes->get('(:segment)', [Pages::class, 'view']);

// Booking routes
$routes->post('/rent_car', [BookingController::class, 'rentCar']);

