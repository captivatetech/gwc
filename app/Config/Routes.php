<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'NavigationController::index');
$routes->get('login', 'NavigationController::login');
