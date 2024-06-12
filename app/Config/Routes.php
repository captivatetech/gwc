<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'NavigationController::index');
$routes->get('reset-password', 'NavigationController::resetPw');
$routes->get('create-account', 'NavigationController::createAccount');


$routes->get('portal/dashboard', 'NavigationController::dashboard');
$routes->get('portal/user-profile', 'NavigationController::profile');
$routes->get('portal/company-profile', 'NavigationController::companyProfile');
$routes->get('portal/financing-products', 'NavigationController::financingProduct');
$routes->get('portal/employee-list', 'NavigationController::employeeList');
$routes->get('portal/billing-payment', 'NavigationController::billingPayment');
$routes->get('portal/faqs', 'NavigationController::faqs');
