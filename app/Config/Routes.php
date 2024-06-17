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
$routes->post('navbartitleedit', 'Navbar::navbartitleedit');
$routes->post('inserttile', 'Navbar::inserttile');
$routes->post('deletetitle', 'Navbar::deletetitle');
$routes->get('pages', 'Navbar::pages');
$routes->post('get-pages', 'Navbar::getpages');
$routes->post('delete-page-list', 'Navbar::deletepagelist');
$routes->post('insertpages', 'Navbar::insertpages');
$routes->post('updatepages', 'Navbar::updatepages');
$routes->post('delete-page', 'Navbar::deletepage');

// PRODUCT CONTOLLER
$routes->get('product', 'Product::index');
$routes->post('insert-product-list', 'Product::insert');


















