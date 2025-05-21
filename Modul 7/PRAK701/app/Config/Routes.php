<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'LoginController::index');
$routes->get('/login', 'LoginController::index');
$routes->post('/login', 'LoginController::login');
$routes->get('/logout', 'LoginController::logout');

$routes->get('/books', 'Bookstablecontroller::index');
$routes->post('/books/save', 'Bookstablecontroller::save');
$routes->get('/books/edit/(:num)', 'Bookstablecontroller::edit/$1');
$routes->get('/books/delete/(:num)', 'Bookstablecontroller::delete/$1');
$routes->get('/books/logout', 'Bookstablecontroller::logout');