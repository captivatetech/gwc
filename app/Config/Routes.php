<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

/////////////////////////////////////////////////////////////////////////////
//////   FRONT END NAVIGATION
/////////////////////////////////////////////////////////////////////////////
$routes->get('/', 'NavigationController::index');
$routes->get('login', 'NavigationController::login');

/////////////////////////////////////////////////////////////////////////////
//////   FRONT END FUNCTIONS
/////////////////////////////////////////////////////////////////////////////
/*
    LOGIN, CHANGE-PASSWORD FUNCTIONS
*/
$routes->post('user-login', 'IndexController::login');




/////////////////////////////////////////////////////////////////////////////
//////   BACK END NAVIGATION
/////////////////////////////////////////////////////////////////////////////
//dashboard
$routes->get('portal/dashboard', 'Portal\NavigationController::dashboard');

//security & maintenance
$routes->get('portal/users', 'Portal\NavigationController::users');
$routes->get('portal/roles', 'Portal\NavigationController::roles');

/////////////////////////////////////////////////////////////////////////////
//////   BACK END FUNCTIONS
/////////////////////////////////////////////////////////////////////////////
/*
    ROLES FUNCTIONS
*/
$routes->get('portal/load-roles', 'Portal\RolesController::loadRoles');
$routes->post('portal/add-role', 'Portal\RolesController::addRole');
$routes->get('portal/select-role', 'Portal\RolesController::selectRole');
$routes->post('portal/edit-role', 'Portal\RolesController::editRole');
$routes->post('portal/remove-role', 'Portal\RolesController::removeRole');

/*
    USERS FUNCTIONS
*/
$routes->get('portal/load-users', 'Portal\UsersController::loadUsers');
$routes->post('portal/add-user', 'Portal\UsersController::addUser');
$routes->get('portal/select-user', 'Portal\UsersController::selectUser');
$routes->post('portal/edit-user', 'Portal\UsersController::editUser');
$routes->post('portal/remove-user', 'Portal\UsersController::removeUser');


////////////////////////////////////////////////////////////////////////////
$routes->get('reset-password', 'NavigationController::resetPw');
$routes->get('create-account', 'NavigationController::createAccount');


$routes->get('portal/dashboard', 'NavigationController::dashboard');
$routes->get('portal/user-profile', 'NavigationController::profile');
$routes->get('portal/company-profile', 'NavigationController::companyProfile');
$routes->get('portal/financing-products', 'NavigationController::financingProduct');
$routes->get('portal/employee-list', 'NavigationController::employeeList');
$routes->get('portal/billing-payment', 'NavigationController::billingPayment');
$routes->get('portal/faqs', 'NavigationController::faqs');
