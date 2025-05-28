<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/', 'UserController::index');
$routes->get('user', 'UserController::index');
$routes->get('user/detail/(:num)', 'UserController::detail/$1');

$routes->get('admin', 'AdminController::index');
$routes->get('admin/create', 'AdminController::create');
$routes->post('admin/store', 'AdminController::store');
$routes->get('admin/toggle-status/(:num)', 'AdminController::toggleStatus/$1');
$routes->get('user/borrow/(:num)', 'UserController::borrow/$1');
$routes->get('user/history', 'UserController::borrowHistory');
$routes->get('login', 'AuthController::login');
$routes->post('login/process', 'AuthController::loginProcess');
$routes->get('logout', 'AuthController::logout');
$routes->get('user/return/(:num)', 'UserController::returnBook/$1');
$routes->get('admin/delete/(:num)', 'AdminController::delete/$1');
