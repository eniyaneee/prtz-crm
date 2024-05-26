<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->post('login-check', 'Home::logincheck');
$routes->get('logout', 'Home::logout');




// DASHBOARD ROUTES
$routes->get('dashboard', 'Dashboard::index');




//NAVBAR ROUTES
$routes->get('title', 'Navbar::title');
$routes->post('navbartitle', 'Navbar::getTitle');










