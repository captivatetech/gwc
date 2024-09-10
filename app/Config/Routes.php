<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

/////////////////////////////////////////////////////////////////////////////
////// TEST MODULE
/////////////////////////////////////////////////////////////////////////////
$routes->get('test', 'TestController::sample');
$routes->get('test-zoho-sign', 'TestController::testZohoSign');
$routes->get('test-xendit', 'TestController::testXendit');
$routes->get('test-json', 'TestController::testJson');

/////////////////////////////////////////////////////////////////////////////
//////   FRONT END NAVIGATION
/////////////////////////////////////////////////////////////////////////////
$routes->get('/', 'NavigationController::index');
$routes->get('login', 'NavigationController::login');
$routes->get('create-account', 'NavigationController::createAccount');
$routes->get('representative-email-verification/(:any)/(:any)', 'NavigationController::representativeEmailVerification/$1/$2');
$routes->get('employee-email-verification/(:any)/(:any)', 'NavigationController::employeeEmailVerification/$1/$2');
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

/*
    EMAIL VERIFICATION OF EMPLOYEE
*/
$routes->post('portal/e-email-verification', 'IndexController::e_emailVerification');

























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
    !== REPRESENTATIVE NAVIGATION
*/
$routes->get('portal/representative/profile', 'Portal\NavigationController::representativeProfile');
$routes->get('portal/representative/dashboard', 'Portal\NavigationController::representativeDashboard'); 
$routes->get('portal/representative/company-profile', 'Portal\NavigationController::representativeCompanyProfile'); 
$routes->get('portal/representative/financing-products', 'Portal\NavigationController::representativeFinancingProducts'); 
$routes->get('portal/representative/employee-list', 'Portal\NavigationController::representativeEmployeeList'); 
$routes->get('portal/representative/salary-advance-applications', 'Portal\NavigationController::representativeSalaryAdvanceApplications'); 
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
$routes->get('portal/admin/salary-advance-applications', 'Portal\NavigationController::adminSalaryAdvanceApplications'); 
$routes->get('portal/admin/business-expansion-applications', 'Portal\NavigationController::adminBusinessExpansionApplications'); 
$routes->get('portal/admin/payment-now-applications', 'Portal\NavigationController::adminPaymentNowApplications'); 
$routes->get('portal/admin/salary-advance-accounts', 'Portal\NavigationController::adminSalaryAdvanceAccounts'); 
$routes->get('portal/admin/business-expansion-accounts', 'Portal\NavigationController::adminBusinessExpansionAccounts'); 
$routes->get('portal/admin/payment-now-accounts', 'Portal\NavigationController::adminPaymentNowAccounts'); 
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
    
    // EMPLOYEE DASHBOARD FUNCTIONS 
$routes->post('portal/employee/e-add-loan-readiness-assessement', 'Portal\EmployeeAssessmentController::e_addLoanReadinessAssessment');

$routes->get('portal/employee/e-select-employee-information', 'Portal\EmployeeController::e_selectEmployeeInformation');
$routes->post('portal/employee/e-submit-salary-advance-application', 'Portal\LoanController::e_submitSalaryAdvanceApplication');

    // EMPLOYEE LOAN ACCOUNTS
$routes->get('portal/employee/e-load-loan-accounts', 'Portal\LoanController::e_loadLoanAccounts');
/* 
    !== END EMPLOYEE FUNCTION --------------------------------------------------------->
*/








/* 
    !== START REPRESENTATIVE FUNCTION --------------------------------------------------------->
*/
    // REPRESENTATIVE PROFILE FUNCTIONS
$routes->get('portal/representative/select-representative-information', 'Portal\EmployeeController::selectRepresentativeInformation');
$routes->post('portal/representative/edit-representative-information', 'Portal\EmployeeController::editRepresentativeInformation');

$routes->get('portal/representative/load-representative-identifications', 'Portal\EmployeeIdentityController::loadRepresentativeIdentifications');
$routes->post('portal/representative/add-representative-identification', 'Portal\EmployeeIdentityController::addRepresentativeIdentification');
$routes->get('portal/representative/select-representative-identification', 'Portal\EmployeeIdentityController::selectRepresentativeIdentification');
$routes->post('portal/representative/remove-representative-identification', 'Portal\EmployeeIdentityController::removeRepresentativeIdentification');

$routes->post('portal/representative/edit-representative-profile-picture', 'Portal\EmployeeController::editRepresentativeProfilePicture');

    // REPRESENTATIVE DASHBOARD FUNCTIONS

    // REPRESENTATIVE COMPANY PROFILE FUNCTIONS
    /* !-- COMPANY INFORMATION --! */
$routes->get('portal/representative/r-select-company-information', 'Portal\CompanyController::r_selectCompanyInformation');
$routes->post('portal/representative/r-edit-company-information', 'Portal\CompanyController::r_editCompanyInformation');
    /* !-- COMPANY DOCUMENT --! */
$routes->get('portal/representative/r-load-company-documents', 'Portal\CompanyDocumentController::r_loadCompanyDocuments');
$routes->get('portal/representative/r-select-company-document', 'Portal\CompanyDocumentController::r_selectCompanyDocument');
$routes->post('portal/representative/r-add-company-document', 'Portal\CompanyDocumentController::r_addCompanyDocument');
$routes->post('portal/representative/r-edit-company-document', 'Portal\CompanyDocumentController::r_editCompanyDocument');
    /* !-- COMPANY SETTINGS --! */
$routes->get('portal/representative/r-select-company-settings', 'Portal\CompanyController::r_selectCompanySettings');
$routes->get('portal/representative/r-load-bank-depositories', 'Portal\CompanyController::r_loadBankDepositories');
$routes->post('portal/representative/r-edit-company-settings', 'Portal\CompanyController::r_editCompanySettings');
    /* !-- COMPANY REPRESENTATIVES --! */
$routes->get('portal/representative/r-load-company-representatives', 'Portal\CompanyController::r_loadCompanyRepresentatives');
$routes->post('portal/representative/r-add-company-hr', 'Portal\CompanyController::r_addCompanyHR');
$routes->post('portal/representative/r-edit-company-hr', 'Portal\CompanyController::r_editCompanyHR');
$routes->post('portal/representative/r-add-company-bpo', 'Portal\CompanyController::r_addCompanyBPO');
$routes->post('portal/representative/r-edit-company-bpo', 'Portal\CompanyController::r_editCompanyBPO');
    /* !-- COMPANY IDENTIFICATIONS --! */
$routes->get('portal/representative/r-load-company-representative-identifications', 'Portal\CompanyController::r_loadCompanyRepresentativeIdentifications');
$routes->post('portal/representative/r-add-representative-identification', 'Portal\CompanyController::r_addRepresentativeIdentification');
$routes->get('portal/representative/r-select-representative-identification', 'Portal\CompanyController::r_selectRepresentativeIdentification');
$routes->post('portal/representative/r-edit-representative-identification', 'Portal\CompanyController::r_editRepresentativeIdentification');

    // REPRESENTATIVE FINANCING PRODUCTS FUNCTIONS
$routes->get('portal/representative/r-select-financing-product', 'Portal\ProductController::r_selectFinancingProduct');
$routes->post('portal/representative/r-add-product-subscription', 'Portal\ProductSubscriptionController::r_addProductSubscription');

    // REPRESENTATIVE EMPLOYEE LIST FUNCTIONS
$routes->get('portal/representative/r-load-employees', 'Portal\EmployeeController::r_loadEmployees');
$routes->get('portal/representative/r-calculate-employee-years-stayed', 'Portal\EmployeeController::r_calculateEmployeeYearsStayed');
$routes->post('portal/representative/r-add-employee', 'Portal\EmployeeController::r_addEmployee');
$routes->get('portal/representative/r-select-employee', 'Portal\EmployeeController::r_selectEmployee');
$routes->post('portal/representative/r-edit-employee', 'Portal\EmployeeController::r_editEmployee');
$routes->post('portal/representative/r-remove-employee', 'Portal\EmployeeController::r_removeEmployee');

$routes->post('portal/representative/r-upload-file', 'Portal\EmployeeController::r_uploadFile');
$routes->get('portal/representative/r-load-custom-maps', 'Portal\EmployeeController::r_loadCustomMaps');
$routes->get('portal/representative/r-select-custom-map', 'Portal\EmployeeController::r_selectCustomMap');
$routes->post('portal/representative/r-mapping-and-duplicate-handling', 'Portal\EmployeeController::r_mappingAndDuplicateHandling');
$routes->get('portal/representative/r-download-duplicate-rows-from-csv-employee', 'Portal\EmployeeController::r_downloadDuplicateRowsFromCSVEmployee');
$routes->post('portal/representative/r-import-employees', 'Portal\EmployeeController::r_importEmployees');

$routes->get('portal/representative/r-load-company-attachments', 'Portal\CompanyDocumentController::r_loadCompanyAttachments');
$routes->post('portal/representative/r-add-company-attachment', 'Portal\CompanyDocumentController::r_addCompanyAttachment');
$routes->get('portal/representative/r-select-company-attachment', 'Portal\CompanyDocumentController::r_selectCompanyAttachment');
$routes->post('portal/representative/r-edit-company-attachment', 'Portal\CompanyDocumentController::r_editCompanyAttachment');

    // REPRESENTATIVE LOAN APPLICATIONS
$routes->get('portal/representative/r-load-salary-advance-applications', 'Portal\LoanController::r_loadSalaryAdvanceApplications');
$routes->get('portal/representative/r-select-loan-application-details', 'Portal\LoanController::r_selectLoanApplicationDetails');
$routes->post('portal/representative/r-submit-salary-advance-application', 'Portal\LoanController::r_submitSalaryAdvanceApplication');

    // REPRESENTATIVE BILLING AND PAYMENTS FUNCTIONS
$routes->get('portal/representative/r-load-billings', 'Portal\BillingController::r_loadBillings');
$routes->get('portal/representative/r-select-billing', 'Portal\BillingController::r_selectBilling');

    // REPRESENTATIVE MAINTENANCE USERS FUNCTIONS
$routes->get('portal/user/load-user-users', 'Portal\UserController::loadUserUsers');
$routes->post('portal/user/add-user-user', 'Portal\UserController::addUserUser');
$routes->get('portal/user/select-user-user', 'Portal\UserController::selectUserUser');
$routes->post('portal/user/edit-user-user', 'Portal\UserController::editUserUser');
$routes->post('portal/user/remove-user-user', 'Portal\UserController::removeUserUser');

    // REPRESENTATIVE MAINTENANCE ROLES FUNCTIONS
$routes->get('portal/user/load-user-roles', 'Portal\RoleController::loadUserRoles');
$routes->post('portal/user/add-user-role', 'Portal\RoleController::addUserRole');
$routes->get('portal/user/select-user-role', 'Portal\RoleController::selectUserRole');
$routes->post('portal/user/edit-user-role', 'Portal\RoleController::editUserRole');
$routes->post('portal/user/remove-user-role', 'Portal\RoleController::removeUserRole');

    // REPRESENTATIVE FAQS FUNCTIONS
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
$routes->get('portal/admin/a-load-applications', 'Portal\LoanController::a_loadApplications');
$routes->get('portal/admin/a-select-application', 'Portal\LoanController::a_selectApplication');
$routes->post('portal/admin/a-approve-application', 'Portal\LoanController::a_approveApplication');
$routes->post('portal/admin/a-reject-application', 'Portal\LoanController::a_rejectApplication');

    // ADMIN PARTNERS LIST FUNCTIONS

    // ADMIN FINANCING PRODUCTS FUNCTIONS

    /* !-- SALARY ADVANCE --! */
$routes->get('portal/admin/a-load-product-subscriptions', 'Portal\ProductSubscriptionController::a_loadProductSubscriptions');
$routes->get('portal/admin/a-select-product-subscription', 'Portal\ProductSubscriptionController::a_selectProductSubscription');

$routes->get('portal/admin/a-load-company-documents', 'Portal\CompanyDocumentController::a_loadCompanyDocuments');
$routes->get('portal/admin/a-preview-company-document', 'Portal\CompanyDocumentController::a_previewCompanyDocument');
$routes->post('portal/admin/a-verify-company-document', 'Portal\CompanyDocumentController::a_verifyCompanyDocument');
$routes->post('portal/admin/a-failed-company-subscription', 'Portal\ProductSubscriptionController::a_failedCompanySubscription');
$routes->post('portal/admin/a-accept-company-subscription', 'Portal\ProductSubscriptionController::a_acceptCompanySubscription');
$routes->post('portal/admin/a-send-employee-email-verification', 'Portal\EmployeeController::a_sendEmployeeEmailVerification');

$routes->get('portal/admin/a-load-company-employees', 'Portal\EmployeeController::a_loadCompanyEmployees');

    // ADMIN FINANCING ACCOUNTS FUNCTIONS
$routes->get('portal/admin/a-load-salary-advance-accounts', 'Portal\LoanController::a_loadSalaryAdvanceAccounts');
$routes->get('portal/admin/a-load-disbursement-lists', 'Portal\LoanController::a_loadDisbursementLists');
$routes->post('portal/admin/a-proceed-disbursement', 'Portal\LoanController::a_proceedDisbursement');
$routes->get('portal/admin/a-load-account-balance', 'Portal\LoanController::a_loadAccountBalance');

    // ADMIN BILLINGS FUNCTIONS
$routes->get('portal/admin/a-generate-billings', 'Portal\BillingController::a_generateBillings');
$routes->get('portal/admin/a-load-billings', 'Portal\BillingController::a_loadBillings');
$routes->get('portal/admin/a-load-billing-details', 'Portal\BillingController::a_loadBillingDetails');

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




