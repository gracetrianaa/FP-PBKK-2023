<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/about', 'Home::about');
$routes->get('/contact', 'Home::contact');
$routes->get('/home', 'Home::home');
$routes->get('/login', 'Home::login');
$routes->get('/register', 'Home::register');
$routes->get('/profile', 'Home::profile');
$routes->get('/logout', 'Home::logout');
$routes->get('/paymentform', 'Home::paymentform');
$routes->get('/paymenttotal', 'Home::paymenttotal');
