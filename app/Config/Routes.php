<?php

use CodeIgniter\Router\RouteCollection;
use App\Controllers\Pages;
use App\Controllers\Bookings;
use App\Controllers\CarsController;


/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('add_cars/new', [CarsController::class, 'index']); 
$routes->post('add_cars', [CarsController::class, 'create']);
$routes->get('add_cars/', [CarsController::class, 'index']);           
$routes->get('bookings', [Bookings::class, 'index']);           
$routes->get('bookings/(:segment)', [Bookings::class, 'show']); 
$routes->get('pages', [Pages::class, 'index']);
$routes->get('(:segment)', [Pages::class, 'view']);