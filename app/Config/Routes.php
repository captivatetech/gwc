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
$routes->get('create-account', 'NavigationController::createAccount');
$routes->get('representative-email-verification/(:any)/(:any)', 'NavigationController::representativeEmailVerification/$1/$2');
$routes->get('forgot-password', 'NavigationController::forgotPassword');
$routes->get('change-password', 'NavigationController::changePassword');

/////////////////////////////////////////////////////////////////////////////
//////   FRONT END FUNCTIONS
/////////////////////////////////////////////////////////////////////////////
/*
    LOGIN, CHANGE-PASSWORD FUNCTIONS
*/
$routes->post('portal/login', 'IndexController::login');
$routes->post('portal/create-account', 'IndexController::createAccount');
$routes->post('portal/forgot-password', 'IndexController::forgotPassword');
$routes->post('portal/change-password', 'IndexController::changePassword');


/////////////////////////////////////////////////////////////////////////////
//////   BACK END NAVIGATION
/////////////////////////////////////////////////////////////////////////////

/* 
    !== EMPLOYEE NAVIGATION
*/
$routes->get('portal/employee/profile', 'Portal\NavigationController::employeeProfile');
$routes->get('portal/employee/dashboard', 'Portal\NavigationController::employeeDashboard');
$routes->get('portal/employee/loan-accounts', 'Portal\NavigationController::employeeLoanAccounts');
/* 
    !== USER NAVIGATION
*/
$routes->get('portal/representative/profile', 'Portal\NavigationController::representativeProfile');
$routes->get('portal/representative/dashboard', 'Portal\NavigationController::representativeDashboard'); 
$routes->get('portal/representative/company-profile', 'Portal\NavigationController::representativeCompanyProfile'); 
$routes->get('portal/representative/financing-products', 'Portal\NavigationController::representativeFinancingProducts'); 
$routes->get('portal/representative/employee-list', 'Portal\NavigationController::representativeEmployeeList'); 
$routes->get('portal/representative/billing-and-payments', 'Portal\NavigationController::representativeBillingAndPayments'); 
$routes->get('portal/representative/maintenance-users', 'Portal\NavigationController::representativeMaintenanceUsers'); 
$routes->get('portal/representative/maintenance-roles', 'Portal\NavigationController::representativeMaintenanceRoles'); 
$routes->get('portal/representative/faqs', 'Portal\NavigationController::representativeFaqs'); 
/* 
    !== ADMIN NAVIGATION
*/
$routes->get('portal/admin/profile', 'Portal\NavigationController::adminProfile');
$routes->get('portal/admin/dashboard', 'Portal\NavigationController::adminDashboard'); 
$routes->get('portal/admin/applications', 'Portal\NavigationController::adminApplications'); 
$routes->get('portal/admin/partners-list', 'Portal\NavigationController::adminPartnersList'); 
$routes->get('portal/admin/salary-advance', 'Portal\NavigationController::adminSalaryAdvance'); 
$routes->get('portal/admin/business-expansion', 'Portal\NavigationController::adminBusinessExpansion'); 
$routes->get('portal/admin/payment-now', 'Portal\NavigationController::adminPaymentNow'); 
$routes->get('portal/admin/billings', 'Portal\NavigationController::adminBillings'); 
$routes->get('portal/admin/payments', 'Portal\NavigationController::adminPayments'); 
$routes->get('portal/admin/maintenance-users', 'Portal\NavigationController::adminMaintenanceUsers'); 
$routes->get('portal/admin/maintenance-roles', 'Portal\NavigationController::adminMaintenanceRoles'); 
$routes->get('portal/admin/maintenance-fees', 'Portal\NavigationController::adminMaintenanceFees'); 
$routes->get('portal/admin/maintenance-faqs', 'Portal\NavigationController::adminMaintenanceFaqs'); 
$routes->get('portal/admin/reports', 'Portal\NavigationController::adminReports'); 
$routes->get('portal/admin/audit-trail', 'Portal\NavigationController::adminAuditTrail'); 

/////////////////////////////////////////////////////////////////////////////
//////   BACK END FUNCTIONS
/////////////////////////////////////////////////////////////////////////////

/* 
    !== START EMPLOYEE FUNCTION --------------------------------------------------------->
*/
    // EMPLOYEE PROFILE FUNCTIONS
$routes->get('portal/employee/load-employee-profile', 'Portal\EmployeeController::loadEmployeeProfile');
$routes->post('portal/employee/edit-employee-profile', 'Portal\EmployeeController::editEmployeeProfile');
    
    // EMPLOYEE LOAN ACCOUNT FUNCTIONS 
$routes->get('portal/employee/load-loan-accounts', 'Portal\LoanController::loadEmployeeLoanAccounts');
$routes->post('portal/employee/add-loan-account', 'Portal\LoanController::addEmployeeLoanAccount');
/* 
    !== END EMPLOYEE FUNCTION --------------------------------------------------------->
*/

/* 
    !== START REPRESENTATIVE FUNCTION --------------------------------------------------------->
*/
    // USER PROFILE FUNCTIONS
$routes->get('portal/representative/select-representative-information', 'Portal\EmployeeController::selectRepresentativeInformation');
$routes->post('portal/representative/edit-representative-information', 'Portal\EmployeeController::editRepresentativeInformation');

$routes->get('portal/representative/load-representative-identifications', 'Portal\EmployeeController::loadRepresentativeIdentifications');
$routes->post('portal/representative/add-representative-identification', 'Portal\EmployeeController::addRepresentativeIdentification');
$routes->get('portal/representative/select-representative-identification', 'Portal\EmployeeController::selectRepresentativeIdentification');
$routes->post('portal/representative/remove-representative-identification', 'Portal\EmployeeController::removeRepresentativeIdentification');

$routes->post('portal/representative/edit-representative-profile-picture', 'Portal\EmployeeController::editRepresentativeProfilePicture');

    // USER DASHBOARD FUNCTIONS

    // USER COMPANY PROFILE FUNCTIONS
$routes->get('portal/representative/select-representative-company-information', 'Portal\CompanyController::selectRepresentativeCompanyInformation');
$routes->post('portal/representative/edit-representative-company-information', 'Portal\CompanyController::editRepresentativeCompanyInformation');

$routes->get('portal/representative/load-representative-company-documents', 'Portal\CompanyController::loadRepresentativeCompanyDocuments');
$routes->get('portal/representative/select-representative-company-document', 'Portal\CompanyController::selectRepresentativeCompanyDocument');
$routes->post('portal/representative/add-representative-company-document', 'Portal\CompanyController::addRepresentativeCompanyDocument');
$routes->post('portal/representative/edit-representative-company-document', 'Portal\CompanyController::editRepresentativeCompanyDocument');

    // USER FINANCING PRODUCTS FUNCTIONS
$routes->get('portal/user/load-user-financing-products', 'Portal\EmployeeController::loadUserFinancingProducts');
$routes->get('portal/user/load-user-financing-product-subscriptions', 'Portal\EmployeeController::loadUserFinancingProductSubscriptions');
$routes->post('portal/user/add-user-financing-product-subscription', 'Portal\EmployeeController::addUserFinancingProductSubscription');

    // USER EMPLOYEE LIST FUNCTIONS
$routes->get('portal/user/load-user-employees', 'Portal\EmployeeController::loadUserEmployees');
$routes->post('portal/user/add-user-employee', 'Portal\EmployeeController::addUserEmployee');
$routes->post('portal/user/import-user-employee', 'Portal\EmployeeController::importUserEmployee');
$routes->get('portal/user/select-user-employee', 'Portal\EmployeeController::selectUserEmployee');
$routes->post('portal/user/edit-user-employee', 'Portal\EmployeeController::editUserEmployee');
$routes->post('portal/user/remove-user-employee', 'Portal\EmployeeController::removeUserEmployee');

    // USER BILLING AND PAYMENTS FUNCTIONS
$routes->get('portal/user/load-user-billings', 'Portal\BillingController::loadUserBillings');

    // USER MAINTENANCE USERS FUNCTIONS
$routes->get('portal/user/load-user-users', 'Portal\UserController::loadUserUsers');
$routes->post('portal/user/add-user-user', 'Portal\UserController::addUserUser');
$routes->get('portal/user/select-user-user', 'Portal\UserController::selectUserUser');
$routes->post('portal/user/edit-user-user', 'Portal\UserController::editUserUser');
$routes->post('portal/user/remove-user-user', 'Portal\UserController::removeUserUser');

    // USER MAINTENANCE ROLES FUNCTIONS
$routes->get('portal/user/load-user-roles', 'Portal\RoleController::loadUserRoles');
$routes->post('portal/user/add-user-role', 'Portal\RoleController::addUserRole');
$routes->get('portal/user/select-user-role', 'Portal\RoleController::selectUserRole');
$routes->post('portal/user/edit-user-role', 'Portal\RoleController::editUserRole');
$routes->post('portal/user/remove-user-role', 'Portal\RoleController::removeUserRole');

    // USER FAQS FUNCTIONS
$routes->get('portal/user/load-user-faqs', 'Portal\FaqController::loadUserFaqs');
/* 
    !== END REPRESENTATIVE FUNCTION --------------------------------------------------------->
*/

/* 
    !== START ADMIN FUNCTION --------------------------------------------------------->
*/
    // ADMIN PROFILE FUNCTIONS
$routes->post('portal/admin/change-password', 'Portal\UserController::changeAdminPassword');

    // ADMIN DASHBOARD FUNCTIONS

    // ADMIN LOAN APPLICATION FUNCTIONS

    // ADMIN PARTNERS LIST FUNCTIONS

    // ADMIN FINANCING PRODUCTS FUNCTIONS

    // ADMIN BILLINGS FUNCTIONS

    // ADMIN PAYMENTS FUNCTIONS

    // ADMIN MAINTENANCE USERS FUNCTIONS
$routes->get('portal/admin/load-admin-users', 'Portal\UserController::loadAdminUsers');
$routes->post('portal/admin/add-admin-user', 'Portal\UserController::addAdminUser');
$routes->get('portal/admin/select-admin-user', 'Portal\UserController::selectAdminUser');
$routes->post('portal/admin/edit-admin-user', 'Portal\UserController::editAdminUser');
$routes->post('portal/admin/remove-admin-user', 'Portal\UserController::removeAdminUser');

    // ADMIN MAINTENANCE ROLES FUNCTIONS
$routes->get('portal/admin/load-admin-roles', 'Portal\RoleController::loadAdminRoles');
$routes->post('portal/admin/add-admin-role', 'Portal\RoleController::addAdminRole');
$routes->get('portal/admin/select-admin-role', 'Portal\RoleController::selectAdminRole');
$routes->post('portal/admin/edit-admin-role', 'Portal\RoleController::editAdminRole');
$routes->post('portal/admin/remove-admin-role', 'Portal\RoleController::removeAdminRole');

    // ADMIN MAINTENANCE FEES FUNCTIONS
$routes->get('portal/admin/load-admin-fees', 'Portal\FeeController::loadAdminFees');
$routes->post('portal/admin/add-admin-fee', 'Portal\FeeController::addAdminFee');
$routes->get('portal/admin/select-admin-fee', 'Portal\FeeController::selectAdminFee');
$routes->post('portal/admin/edit-admin-fee', 'Portal\FeeController::editAdminFee');
$routes->post('portal/admin/remove-admin-fee', 'Portal\FeeController::removeAdminFee');

    // ADMIN MAINTENANCE FAQS FUNCTIONS
$routes->get('portal/admin/load-admin-faqs', 'Portal\FaqController::loadAdminFaqs');
$routes->post('portal/admin/add-admin-faq', 'Portal\FaqController::addAdminFaq');
$routes->get('portal/admin/select-admin-faq', 'Portal\FaqController::selectAdminFaq');
$routes->post('portal/admin/edit-admin-faq', 'Portal\FaqController::editAdminFaq');
$routes->post('portal/admin/remove-admin-faq', 'Portal\FaqController::removeAdminFaq');

    // ADMIN REPORTS FUNCTIONS

    // ADMIN AUDIT TRAIL FUNCTIONS

/* 
    !== END ADMIN FUNCTION --------------------------------------------------------->
*/

$routes->get('logout', 'NavigationController::logout');

////////////////////////////////////////////////////////////////////////////




