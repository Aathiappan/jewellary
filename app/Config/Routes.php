<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
 /*anonymous api*/
$routes->get('/', 'Home::index');

service('auth')->routes($routes);
/*admin api*/
$routes->get('/admin/','AdminController::index',['filter' => 'Admincheck']);
$routes->get('/admin/home','AdminController::index',['filter' => 'Admincheck']);
$routes->get('/admin/category','AdminController::listCategory',['filter' => 'Admincheck']);
$routes->post('/admin/api/addCategory','AdminController::addCategory',['filter' => 'Admincheck']);


/*user api*/
$routes->get('/user/','UserController::index',['filter' => 'Usercheck']);
$routes->get('/user/home','UserController::index',['filter' => 'Usercheck']);
