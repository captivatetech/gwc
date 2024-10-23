<?php

namespace App\Controllers\Portal;

use App\Controllers\BaseController;

class NavigationController extends BaseController
{
    public function __construct()
    {
        $this->users        = model('Users');
        $this->roles        = model('Roles');
        $this->employees    = model('Employees');
        $this->companies    = model('Companies');
    }

    /*
        START EMPLOYEE
    */
    public function e_profile()
    {
        if($this->session->has('gwc_employee_loggedIn'))
        {
            if($this->session->get('gwc_employee_loggedIn'))
            {
                $data['pageTitle'] = "Profile | GWC";
                $data['customScripts'] = 'employee_profile';
                $data['accessModules'] = [];
                $userData = $this->employees->selectEmployee($this->session->get('gwc_employee_id'));

                if($userData != null)
                {
                    $data['userType'] = 'employee'; 
                    $data['userName'] = $userData['last_name'] . ", " . $userData['first_name'];
                    $data['firstName'] = $userData['first_name'];
                    $data['lastName'] = $userData['last_name'];
                    $data['profilePicture'] = $userData['profile_picture'];
                    return $this->slice->view('portal.employee.employee_profile', $data);
                }
                else
                {
                    $this->logout();
                }
            }
            else
            {
                return redirect()->to(base_url());
            }
        }
        else
        {
            return redirect()->to(base_url());
        }
    }

    public function e_dashboard()
    {
        if($this->session->has('gwc_employee_loggedIn'))
        {
            if($this->session->get('gwc_employee_loggedIn'))
            {
                $data['pageTitle'] = "Dashboard | GWC";
                $data['customScripts'] = 'employee_dashboard';
                $data['accessModules'] = [];
                $userData = $this->employees->selectEmployee($this->session->get('gwc_employee_id'));

                if($userData != null)
                {
                    $data['userType'] = 'employee'; 
                    $data['userName'] = $userData['last_name'] . ", " . $userData['first_name'];
                    $data['firstName'] = $userData['first_name'];
                    $data['lastName'] = $userData['last_name'];
                    $data['employeeId'] = $userData['id'];
                    $data['companyId'] = $userData['company_id'];
                    $data['profilePicture'] = $userData['profile_picture'];
                    return $this->slice->view('portal.employee.employee_dashboard', $data);
                }
                else
                {
                    $this->logout();
                }
            }
            else
            {
                return redirect()->to(base_url());
            }
        }
        else
        {
            return redirect()->to(base_url());
        }
    }

    public function e_loanAccounts()
    {
        if($this->session->has('gwc_employee_loggedIn'))
        {
            if($this->session->get('gwc_employee_loggedIn'))
            {
                $data['pageTitle'] = "Loan Accounts | GWC";
                $data['customScripts'] = 'employee_loan_accounts';
                $data['accessModules'] = [];
                $userData = $this->employees->selectEmployee($this->session->get('gwc_employee_id'));

                if($userData != null)
                {
                    $data['userType'] = 'employee'; 
                    $data['userName'] = $userData['last_name'] . ", " . $userData['first_name'];
                    $data['firstName'] = $userData['first_name'];
                    $data['lastName'] = $userData['last_name'];
                    $data['profilePicture'] = $userData['profile_picture'];
                    return $this->slice->view('portal.employee.employee_loan_accounts', $data);
                }
                else
                {
                    $this->logout();
                }
            }
            else
            {
                return redirect()->to(base_url());
            }
        }
        else
        {
            return redirect()->to(base_url());
        }
    }
    /*
        END EMPLOYEE
    */

    /*
        START REPRESENTATIVE
    */
    public function r_profile()
    {
        if($this->session->has('gwc_representative_loggedIn'))
        {
            if($this->session->get('gwc_representative_loggedIn'))
            {
                $data['pageTitle'] = "Profile | GWC";
                $data['customScripts'] = 'representative_profile';
                $data['accessModules'] = [];
                $userData = $this->employees->selectRepresentative($this->session->get('gwc_representative_id'));

                if($userData != null)
                {
                    $data['userType'] = 'representative'; 
                    $data['userName'] = $userData['last_name'] . ", " . $userData['first_name'];
                    $data['firstName'] = $userData['first_name'];
                    $data['lastName'] = $userData['last_name'];
                    $data['profilePicture'] = $userData['profile_picture'];
                    return $this->slice->view('portal.representative.representative_profile', $data);
                }
                else
                {
                    $this->logout();
                }
            }
            else
            {
                return redirect()->to(base_url());
            }
        }
        else
        {
            return redirect()->to(base_url());
        }
    }

    public function r_dashboard()
    {
        if($this->session->has('gwc_representative_loggedIn'))
        {
            if($this->session->get('gwc_representative_loggedIn'))
            {
                $data['pageTitle'] = "Dashboard | GWC";
                $data['customScripts'] = 'representative_dashboard';
                $data['accessModules'] = [];
                $userData = $this->employees->selectRepresentative($this->session->get('gwc_representative_id'));

                if($userData != null)
                {
                    $data['userType'] = 'representative'; 
                    $data['userName'] = $userData['last_name'] . ", " . $userData['first_name'];
                    $data['firstName'] = $userData['first_name'];
                    $data['lastName'] = $userData['last_name'];
                    $data['profilePicture'] = $userData['profile_picture'];
                    return $this->slice->view('portal.representative.representative_dashboard', $data);
                }
                else
                {
                    $this->logout();
                }
            }
            else
            {
                return redirect()->to(base_url());
            }
        }
        else
        {
            return redirect()->to(base_url());
        }
    }

    public function r_companyProfile()
    {
        if($this->session->has('gwc_representative_loggedIn'))
        {
            if($this->session->get('gwc_representative_loggedIn'))
            {
                $data['pageTitle'] = "Company Profile | GWC";
                $data['customScripts'] = 'representative_company_profile';
                $data['accessModules'] = [];
                $userData = $this->employees->selectRepresentative($this->session->get('gwc_representative_id'));

                if($userData != null)
                {
                    $data['userType'] = 'representative'; 
                    $data['userName'] = $userData['last_name'] . ", " . $userData['first_name'];
                    $data['firstName'] = $userData['first_name'];
                    $data['lastName'] = $userData['last_name'];
                    $data['companyId'] = $userData['company_id'];
                    $data['businessType'] = $userData['business_type'];
                    $data['hrUser'] = $userData['hr_user'];
                    $data['bpoUser'] = $userData['bpo_user'];
                    $data['profilePicture'] = $userData['profile_picture'];
                    return $this->slice->view('portal.representative.representative_company_profile', $data);
                }
                else
                {
                    $this->logout();
                }
            }
            else
            {
                return redirect()->to(base_url());
            }
        }
        else
        {
            return redirect()->to(base_url());
        }
    }

    public function r_financingProducts()
    {
        if($this->session->has('gwc_representative_loggedIn'))
        {
            if($this->session->get('gwc_representative_loggedIn'))
            {
                $data['pageTitle'] = "Financing Products | GWC";
                $data['customScripts'] = 'representative_financing_products';
                $data['accessModules'] = [];
                $userData = $this->employees->selectRepresentative($this->session->get('gwc_representative_id'));

                if($userData != null)
                {
                    $data['userType'] = 'representative';
                    $data['userName'] = $userData['last_name'] . ", " . $userData['first_name']; 
                    $data['firstName'] = $userData['first_name'];
                    $data['lastName'] = $userData['last_name'];
                    $data['companyId'] = $userData['company_id'];
                    $data['companyCode'] = $userData['company_code'];
                    $data['bankDepository'] = $userData['bank_depository'];
                    $data['subscriptionStatus'] = $userData['subscription_status'];
                    $data['businessType'] = $userData['business_type']; 
                    $data['profilePicture'] = $userData['profile_picture'];
                    return $this->slice->view('portal.representative.representative_financing_products', $data);
                }
                else
                {
                    $this->logout();
                }
            }
            else
            {
                return redirect()->to(base_url());
            }
        }
        else
        {
            return redirect()->to(base_url());
        }
    }

    public function r_employeeList()
    {
        if($this->session->has('gwc_representative_loggedIn'))
        {
            if($this->session->get('gwc_representative_loggedIn'))
            {
                $data['pageTitle'] = "Employees List | GWC";
                $data['customScripts'] = 'representative_employee_list';
                $data['accessModules'] = [];
                $userData = $this->employees->selectRepresentative($this->session->get('gwc_representative_id'));

                if($userData != null)
                {
                    $data['userType'] = 'representative'; 
                    $data['userName'] = $userData['last_name'] . ", " . $userData['first_name'];
                    $data['firstName'] = $userData['first_name'];
                    $data['lastName'] = $userData['last_name'];
                    $data['companyId'] = $userData['company_id'];
                    $data['companyCode'] = $userData['company_code'];
                    $data['bankDepository'] = $userData['bank_depository'];
                    $data['subscriptionStatus'] = $userData['subscription_status'];
                    $data['accessStatus'] = $userData['access_status'];
                    $data['profilePicture'] = $userData['profile_picture'];
                    return $this->slice->view('portal.representative.representative_employee_list', $data);
                }
                else
                {
                    $this->logout();
                }
            }
            else
            {
                return redirect()->to(base_url());
            }
        }
        else
        {
            return redirect()->to(base_url());
        }
    }

    public function r_salaryAdvanceApplications()
    {
        if($this->session->has('gwc_representative_loggedIn'))
        {
            if($this->session->get('gwc_representative_loggedIn'))
            {
                $data['pageTitle'] = "Salary Advance Applications | GWC";
                $data['customScripts'] = 'representative_salary_advance_applications';
                $data['accessModules'] = [];
                $userData = $this->employees->selectRepresentative($this->session->get('gwc_representative_id'));

                if($userData != null)
                {
                    $data['userType'] = 'representative'; 
                    $data['userName'] = $userData['last_name'] . ", " . $userData['first_name'];
                    $data['firstName'] = $userData['first_name'];
                    $data['lastName'] = $userData['last_name'];
                    $data['companyId'] = $userData['company_id'];
                    $data['companyCode'] = $userData['company_code'];
                    $data['bankDepository'] = $userData['bank_depository'];
                    $data['subscriptionStatus'] = $userData['subscription_status'];
                    $data['profilePicture'] = $userData['profile_picture'];
                    return $this->slice->view('portal.representative.representative_salary_advance_applications', $data);
                }
                else
                {
                    $this->logout();
                }
            }
            else
            {
                return redirect()->to(base_url());
            }
        }
        else
        {
            return redirect()->to(base_url());
        }
    }

    public function r_billingAndPayments()
    {
        if($this->session->has('gwc_representative_loggedIn'))
        {
            if($this->session->get('gwc_representative_loggedIn'))
            {
                $data['pageTitle'] = "Billing & Payments | GWC";
                $data['customScripts'] = 'representative_billing_and_payments';
                $data['accessModules'] = [];
                $userData = $this->employees->selectRepresentative($this->session->get('gwc_representative_id'));

                if($userData != null)
                {
                    $data['userType'] = 'representative'; 
                    $data['userName'] = $userData['last_name'] . ", " . $userData['first_name'];
                    $data['firstName'] = $userData['first_name'];
                    $data['lastName'] = $userData['last_name'];
                    $data['subscriptionStatus'] = $userData['subscription_status'];
                    $data['profilePicture'] = $userData['profile_picture'];
                    return $this->slice->view('portal.representative.representative_billing_and_payments', $data);
                }
                else
                {
                    $this->logout();
                }
            }
            else
            {
                return redirect()->to(base_url());
            }
        }
        else
        {
            return redirect()->to(base_url());
        }
    }

    public function r_maintenanceUsers()
    {
        if($this->session->has('gwc_representative_loggedIn'))
        {
            if($this->session->get('gwc_representative_loggedIn'))
            {
                $data['pageTitle'] = "Users | GWC";
                $data['customScripts'] = 'representative_users';
                $data['accessModules'] = [];
                $userData = $this->employees->selectRepresentative($this->session->get('gwc_representative_id'));

                if($userData != null)
                {
                    $data['userType'] = 'representative'; 
                    $data['userName'] = $userData['last_name'] . ", " . $userData['first_name'];
                    $data['firstName'] = $userData['first_name'];
                    $data['lastName'] = $userData['last_name'];
                    $data['profilePicture'] = $userData['profile_picture'];
                    return $this->slice->view('portal.representative.representative_maintenance_users', $data);
                }
                else
                {
                    $this->logout();
                }
            }
            else
            {
                return redirect()->to(base_url());
            }
        }
        else
        {
            return redirect()->to(base_url());
        }
    }

    public function r_maintenanceRoles()
    {
        if($this->session->has('gwc_representative_loggedIn'))
        {
            if($this->session->get('gwc_representative_loggedIn'))
            {
                $data['pageTitle'] = "Roles | GWC";
                $data['customScripts'] = 'representative_roles';
                $data['accessModules'] = [];
                $userData = $this->employees->selectRepresentative($this->session->get('gwc_representative_id'));

                if($userData != null)
                {
                    $data['userType'] = 'representative'; 
                    $data['userName'] = $userData['last_name'] . ", " . $userData['first_name'];
                    $data['firstName'] = $userData['first_name'];
                    $data['lastName'] = $userData['last_name'];
                    $data['profilePicture'] = $userData['profile_picture'];
                    return $this->slice->view('portal.representative.representative_maintenance_roles', $data);
                }
                else
                {
                    $this->logout();
                }
            }
            else
            {
                return redirect()->to(base_url());
            }
        }
        else
        {
            return redirect()->to(base_url());
        }
    }

    public function r_faqs()
    {
        if($this->session->has('gwc_representative_loggedIn'))
        {
            if($this->session->get('gwc_representative_loggedIn'))
            {
                $data['pageTitle'] = "Frequently Asked Questions | GWC";
                $data['customScripts'] = 'representative_faqs';
                $data['accessModules'] = [];
                $userData = $this->employees->selectRepresentative($this->session->get('gwc_representative_id'));

                if($userData != null)
                {
                    $data['userType'] = 'representative'; 
                    $data['userName'] = $userData['last_name'] . ", " . $userData['first_name'];
                    $data['firstName'] = $userData['first_name'];
                    $data['lastName'] = $userData['last_name'];
                    $data['profilePicture'] = $userData['profile_picture'];
                    return $this->slice->view('portal.representative.representative_faqs', $data);
                }
                else
                {
                    $this->logout();
                }
            }
            else
            {
                return redirect()->to(base_url());
            }
        }
        else
        {
            return redirect()->to(base_url());
        }
    }
    /*
        END USER
    */

    /*
        START ADMIN
    */
    public function a_profile()
    {
        if($this->session->has('gwc_admin_loggedIn'))
        {
            if($this->session->get('gwc_admin_loggedIn'))
            {
                $data['pageTitle'] = "Profile | GWC";
                $data['customScripts'] = 'admin_profile';
                $userData = $this->users->selectUser($this->session->get('gwc_admin_id'));
                $data['accessModules'] = json_decode($userData['access_modules']);

                if($userData != null)
                {
                    $data['userType'] = 'admin';
                    $data['userName'] = $userData['last_name'] . ", " . $userData['first_name'];
                    $data['firstName'] = $userData['first_name'];
                    $data['lastName'] = $userData['last_name'];
                    $data['userRoleName'] = $userData['role_name'];
                    $data['profilePicture'] = $userData['user_image'];
                    return $this->slice->view('portal.admin.admin_profile', $data);
                }
                else
                {
                    $this->logout();
                }
            }
            else
            {
                return redirect()->to(base_url());
            }
        }
        else
        {
            return redirect()->to(base_url());
        }
    }

    public function a_dashboard()
    {
        if($this->session->has('gwc_admin_loggedIn'))
        {
            if($this->session->get('gwc_admin_loggedIn'))
            {
                $data['pageTitle'] = "Dashboard | GWC";
                $data['customScripts'] = 'admin_dashboard';
                $userData = $this->users->selectUser($this->session->get('gwc_admin_id'));
                $data['accessModules'] = json_decode($userData['access_modules']);

                if($userData != null)
                {
                    $data['userType'] = 'admin';
                    $data['userName'] = $userData['last_name'] . ", " . $userData['first_name'];
                    $data['firstName'] = $userData['first_name'];
                    $data['lastName'] = $userData['last_name'];
                    $data['userRoleName'] = $userData['role_name'];
                    $data['profilePicture'] = $userData['user_image'];
                    return $this->slice->view('portal.admin.admin_dashboard', $data);
                }
                else
                {
                    $this->logout();
                }
            }
            else
            {
                return redirect()->to(base_url());
            }
        }
        else
        {
            return redirect()->to(base_url());
        }
    }

    public function a_applications()
    {       
        if($this->session->has('gwc_admin_loggedIn'))
        {
            if($this->session->get('gwc_admin_loggedIn'))
            {
                $data['pageTitle'] = "Loan Application | GWC";
                $data['customScripts'] = 'admin_applications';
                $userData = $this->users->selectUser($this->session->get('gwc_admin_id'));
                $data['accessModules'] = json_decode($userData['access_modules']);

                if($userData != null)
                {
                    $data['userType'] = 'admin';
                    $data['userName'] = $userData['last_name'] . ", " . $userData['first_name'];
                    $data['firstName'] = $userData['first_name'];
                    $data['lastName'] = $userData['last_name'];
                    $data['userRoleName'] = $userData['role_name'];
                    $data['profilePicture'] = $userData['user_image'];
                    return $this->slice->view('portal.admin.admin_applications', $data);
                }
                else
                {
                    $this->logout();
                }
            }
            else
            {
                return redirect()->to(base_url());
            }
        }
        else
        {
            return redirect()->to(base_url());
        }
        
    }

    public function a_partnersList()
    {
        if($this->session->has('gwc_admin_loggedIn'))
        {
            if($this->session->get('gwc_admin_loggedIn'))
            {
                $data['pageTitle'] = "Partners List | GWC";
                $data['customScripts'] = 'admin_partners_list';
                $userData = $this->users->selectUser($this->session->get('gwc_admin_id'));
                $data['accessModules'] = json_decode($userData['access_modules']);

                if($userData != null)
                {
                    $data['userType'] = 'admin';
                    $data['userName'] = $userData['last_name'] . ", " . $userData['first_name'];
                    $data['firstName'] = $userData['first_name'];
                    $data['lastName'] = $userData['last_name'];
                    $data['userRoleName'] = $userData['role_name'];
                    $data['profilePicture'] = $userData['user_image'];
                    return $this->slice->view('portal.admin.admin_partners_list', $data);
                }
                else
                {
                    $this->logout();
                }
            }
            else
            {
                return redirect()->to(base_url());
            }
        }
        else
        {
            return redirect()->to(base_url());
        }
    }

    public function a_advanceApplications()
    {
        if($this->session->has('gwc_admin_loggedIn'))
        {
            if($this->session->get('gwc_admin_loggedIn'))
            {
                $data['pageTitle'] = "Financing Products > Salary Advance | GWC";
                $data['customScripts'] = 'admin_salary_advance_applications';
                $userData = $this->users->selectUser($this->session->get('gwc_admin_id'));
                $data['accessModules'] = json_decode($userData['access_modules']);

                if($userData != null)
                {
                    $data['userType'] = 'admin';
                    $data['userName'] = $userData['last_name'] . ", " . $userData['first_name'];
                    $data['firstName'] = $userData['first_name'];
                    $data['lastName'] = $userData['last_name'];
                    $data['userRoleName'] = $userData['role_name'];
                    $data['profilePicture'] = $userData['user_image'];
                    return $this->slice->view('portal.admin.admin_salary_advance_applications', $data);
                }
                else
                {
                    $this->logout();
                }
            }
            else
            {
                return redirect()->to(base_url());
            }
        }
        else
        {
            return redirect()->to(base_url());
        }
    }

    public function a_businessExpansionApplications()
    {
        if($this->session->has('gwc_admin_loggedIn'))
        {
            if($this->session->get('gwc_admin_loggedIn'))
            {
                $data['pageTitle'] = "Financing Products > Business Expansion | GWC";
                $data['customScripts'] = 'admin_business_expansion_applications';
                $userData = $this->users->selectUser($this->session->get('gwc_admin_id'));
                $data['accessModules'] = json_decode($userData['access_modules']);

                if($userData != null)
                {
                    $data['userType'] = 'admin';
                    $data['userName'] = $userData['last_name'] . ", " . $userData['first_name'];
                    $data['firstName'] = $userData['first_name'];
                    $data['lastName'] = $userData['last_name'];
                    $data['userRoleName'] = $userData['role_name'];
                    $data['profilePicture'] = $userData['user_image'];
                    return $this->slice->view('portal.admin.admin_business_expansion_applications', $data);
                }
                else
                {
                    $this->logout();
                }
            }
            else
            {
                return redirect()->to(base_url());
            }
        }
        else
        {
            return redirect()->to(base_url());
        }
    }

    public function a_paymentNowApplications()
    {
        if($this->session->has('gwc_admin_loggedIn'))
        {
            if($this->session->get('gwc_admin_loggedIn'))
            {
                $data['pageTitle'] = "Financing Products > Payment Now | GWC";
                $data['customScripts'] = 'admin_payment_now_applications';
                $userData = $this->users->selectUser($this->session->get('gwc_admin_id'));
                $data['accessModules'] = json_decode($userData['access_modules']);

                if($userData != null)
                {
                    $data['userType'] = 'admin';
                    $data['userName'] = $userData['last_name'] . ", " . $userData['first_name'];
                    $data['firstName'] = $userData['first_name'];
                    $data['lastName'] = $userData['last_name'];
                    $data['userRoleName'] = $userData['role_name'];
                    $data['profilePicture'] = $userData['user_image'];
                    return $this->slice->view('portal.admin.admin_payment_now_applications', $data);
                }
                else
                {
                    $this->logout();
                }
            }
            else
            {
                return redirect()->to(base_url());
            }
        }
        else
        {
            return redirect()->to(base_url());
        }
    }

    public function a_salaryAdvanceAccounts()
    {
        if($this->session->has('gwc_admin_loggedIn'))
        {
            if($this->session->get('gwc_admin_loggedIn'))
            {
                $data['pageTitle'] = "Financing Accounts > Salary Advance | GWC";
                $data['customScripts'] = 'admin_salary_advance_accounts';
                $userData = $this->users->selectUser($this->session->get('gwc_admin_id'));
                $data['accessModules'] = json_decode($userData['access_modules']);

                if($userData != null)
                {
                    $data['userType'] = 'admin';
                    $data['userName'] = $userData['last_name'] . ", " . $userData['first_name'];
                    $data['firstName'] = $userData['first_name'];
                    $data['lastName'] = $userData['last_name'];
                    $data['userRoleName'] = $userData['role_name'];
                    $data['profilePicture'] = $userData['user_image'];
                    return $this->slice->view('portal.admin.admin_salary_advance_accounts', $data);
                }
                else
                {
                    $this->logout();
                }
            }
            else
            {
                return redirect()->to(base_url());
            }
        }
        else
        {
            return redirect()->to(base_url());
        }
    }

    public function a_businessExpansionAccounts()
    {
        if($this->session->has('gwc_admin_loggedIn'))
        {
            if($this->session->get('gwc_admin_loggedIn'))
            {
                $data['pageTitle'] = "Financing Accounts > Business Expansion | GWC";
                $data['customScripts'] = 'admin_business_expansion_accounts';
                $userData = $this->users->selectUser($this->session->get('gwc_admin_id'));
                $data['accessModules'] = json_decode($userData['access_modules']);

                if($userData != null)
                {
                    $data['userType'] = 'admin';
                    $data['userName'] = $userData['last_name'] . ", " . $userData['first_name'];
                    $data['firstName'] = $userData['first_name'];
                    $data['lastName'] = $userData['last_name'];
                    $data['userRoleName'] = $userData['role_name'];
                    $data['profilePicture'] = $userData['user_image'];
                    return $this->slice->view('portal.admin.admin_business_expansion_accounts', $data);
                }
                else
                {
                    $this->logout();
                }
            }
            else
            {
                return redirect()->to(base_url());
            }
        }
        else
        {
            return redirect()->to(base_url());
        }
    }

    public function a_paymentNowAccounts()
    {
        if($this->session->has('gwc_admin_loggedIn'))
        {
            if($this->session->get('gwc_admin_loggedIn'))
            {
                $data['pageTitle'] = "Financing Accounts > Payment Now | GWC";
                $data['customScripts'] = 'admin_payment_now_accounts';
                $userData = $this->users->selectUser($this->session->get('gwc_admin_id'));
                $data['accessModules'] = json_decode($userData['access_modules']);

                if($userData != null)
                {
                    $data['userType'] = 'admin';
                    $data['userName'] = $userData['last_name'] . ", " . $userData['first_name'];
                    $data['firstName'] = $userData['first_name'];
                    $data['lastName'] = $userData['last_name'];
                    $data['userRoleName'] = $userData['role_name'];
                    $data['profilePicture'] = $userData['user_image'];
                    return $this->slice->view('portal.admin.admin_payment_now_accounts', $data);
                }
                else
                {
                    $this->logout();
                }
            }
            else
            {
                return redirect()->to(base_url());
            }
        }
        else
        {
            return redirect()->to(base_url());
        }
    }

    public function a_billings()
    {
        if($this->session->has('gwc_admin_loggedIn'))
        {
            if($this->session->get('gwc_admin_loggedIn'))
            {
                $data['pageTitle'] = "Billing Statements | GWC";
                $data['customScripts'] = 'admin_billings';
                $userData = $this->users->selectUser($this->session->get('gwc_admin_id'));
                $data['accessModules'] = json_decode($userData['access_modules']);

                if($userData != null)
                {
                    $data['userType'] = 'admin';
                    $data['userName'] = $userData['last_name'] . ", " . $userData['first_name'];
                    $data['firstName'] = $userData['first_name'];
                    $data['lastName'] = $userData['last_name'];
                    $data['userRoleName'] = $userData['role_name'];
                    $data['profilePicture'] = $userData['user_image'];
                    return $this->slice->view('portal.admin.admin_billings', $data);
                }
                else
                {
                    $this->logout();
                }
            }
            else
            {
                return redirect()->to(base_url());
            }
        }
        else
        {
            return redirect()->to(base_url());
        }
    }

    public function a_payments()
    {
        if($this->session->has('gwc_admin_loggedIn'))
        {
            if($this->session->get('gwc_admin_loggedIn'))
            {
                $data['pageTitle'] = "Payments | GWC";
                $data['customScripts'] = 'admin_payments';
                $userData = $this->users->selectUser($this->session->get('gwc_admin_id'));
                $data['accessModules'] = json_decode($userData['access_modules']);

                if($userData != null)
                {
                    $data['userType'] = 'admin';
                    $data['userName'] = $userData['last_name'] . ", " . $userData['first_name'];
                    $data['firstName'] = $userData['first_name'];
                    $data['lastName'] = $userData['last_name'];
                    $data['userRoleName'] = $userData['role_name'];
                    $data['profilePicture'] = $userData['user_image'];
                    return $this->slice->view('portal.admin.admin_payments', $data);
                }
                else
                {
                    $this->logout();
                }
            }
            else
            {
                return redirect()->to(base_url());
            }
        }
        else
        {
            return redirect()->to(base_url());
        }
    }

    public function a_maintenanceUsers()
    {
        if($this->session->has('gwc_admin_loggedIn'))
        {
            if($this->session->get('gwc_admin_loggedIn'))
            {
                $data['pageTitle'] = "Maintenance > Users | GWC";
                $data['customScripts'] = 'admin_users';
                $userData = $this->users->selectUser($this->session->get('gwc_admin_id'));
                $data['accessModules'] = json_decode($userData['access_modules']);

                if($userData != null)
                {
                    $data['userType'] = 'admin';
                    $data['userName'] = $userData['last_name'] . ", " . $userData['first_name'];
                    $data['firstName'] = $userData['first_name'];
                    $data['lastName'] = $userData['last_name'];
                    $data['userRoleName'] = $userData['role_name'];
                    $data['profilePicture'] = $userData['user_image'];
                    return $this->slice->view('portal.admin.admin_maintenance_users', $data);
                }
                else
                {
                    $this->logout();
                }
            }
            else
            {
                return redirect()->to(base_url());
            }
        }
        else
        {
            return redirect()->to(base_url());
        }
    }

    public function a_maintenanceRoles()
    {
        if($this->session->has('gwc_admin_loggedIn'))
        {
            if($this->session->get('gwc_admin_loggedIn'))
            {
                $data['pageTitle'] = "Maintenance > Roles | GWC";
                $data['customScripts'] = 'admin_roles';
                $userData = $this->users->selectUser($this->session->get('gwc_admin_id'));
                $data['accessModules'] = json_decode($userData['access_modules']);

                if($userData != null)
                {
                    $data['userType'] = 'admin';
                    $data['userName'] = $userData['last_name'] . ", " . $userData['first_name'];
                    $data['firstName'] = $userData['first_name'];
                    $data['lastName'] = $userData['last_name'];
                    $data['userRoleName'] = $userData['role_name'];
                    $data['profilePicture'] = $userData['user_image'];
                    return $this->slice->view('portal.admin.admin_maintenance_roles', $data);
                }
                else
                {
                    $this->logout();
                }
            }
            else
            {
                return redirect()->to(base_url());
            }
        }
        else
        {
            return redirect()->to(base_url());
        }
    }

    public function a_maintenanceFees()
    {
        if($this->session->has('gwc_admin_loggedIn'))
        {
            if($this->session->get('gwc_admin_loggedIn'))
            {
                $data['pageTitle'] = "Maintenance > Fees | GWC";
                $data['customScripts'] = 'admin_fees';
                $userData = $this->users->selectUser($this->session->get('gwc_admin_id'));
                $data['accessModules'] = json_decode($userData['access_modules']);

                if($userData != null)
                {
                    $data['userType'] = 'admin';
                    $data['userName'] = $userData['last_name'] . ", " . $userData['first_name'];
                    $data['firstName'] = $userData['first_name'];
                    $data['lastName'] = $userData['last_name'];
                    $data['userRoleName'] = $userData['role_name'];
                    $data['profilePicture'] = $userData['user_image'];
                    return $this->slice->view('portal.admin.admin_maintenance_fees', $data);
                }
                else
                {
                    $this->logout();
                }
            }
            else
            {
                return redirect()->to(base_url());
            }
        }
        else
        {
            return redirect()->to(base_url());
        }
    }

    public function a_maintenanceFaqs()
    {
        
    }

    public function a_reports()
    {
        if($this->session->has('gwc_admin_loggedIn'))
        {
            if($this->session->get('gwc_admin_loggedIn'))
            {
                $data['pageTitle'] = "Reports | GWC";
                $data['customScripts'] = 'admin_reports';
                $userData = $this->users->selectUser($this->session->get('gwc_admin_id'));
                $data['accessModules'] = json_decode($userData['access_modules']);

                if($userData != null)
                {
                    $data['userType'] = 'admin';
                    $data['userName'] = $userData['last_name'] . ", " . $userData['first_name'];
                    $data['firstName'] = $userData['first_name'];
                    $data['lastName'] = $userData['last_name'];
                    $data['userRoleName'] = $userData['role_name'];
                    $data['profilePicture'] = $userData['user_image'];
                    return $this->slice->view('portal.admin.admin_reports', $data);
                }
                else
                {
                    $this->logout();
                }
            }
            else
            {
                return redirect()->to(base_url());
            }
        }
        else
        {
            return redirect()->to(base_url());
        }
    }

    public function a_auditTrail()
    {
        if($this->session->has('gwc_admin_loggedIn'))
        {
            if($this->session->get('gwc_admin_loggedIn'))
            {
                $data['pageTitle'] = "Audit Trails | GWC";
                $data['customScripts'] = 'admin_audit_trails';
                $userData = $this->users->selectUser($this->session->get('gwc_admin_id'));
                $data['accessModules'] = json_decode($userData['access_modules']);

                if($userData != null)
                {
                    $data['userType'] = 'admin';
                    $data['userName'] = $userData['last_name'] . ", " . $userData['first_name'];
                    $data['firstName'] = $userData['first_name'];
                    $data['lastName'] = $userData['last_name'];
                    $data['userRoleName'] = $userData['role_name'];
                    $data['profilePicture'] = $userData['user_image'];
                    return $this->slice->view('portal.admin.admin_audit_trails', $data);
                }
                else
                {
                    $this->logout();
                }
            }
            else
            {
                return redirect()->to(base_url());
            }
        }
        else
        {
            return redirect()->to(base_url());
        }
    }
    /*
        END ADMIN
    */

    public function logout()
    {
        $this->session->destroy();
        return redirect()->to(base_url());
    }
}
