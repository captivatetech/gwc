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
    public function employeeProfile()
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

    public function employeeDashboard()
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

    public function employeeLoanAccounts()
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
    public function representativeProfile()
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

    public function representativeDashboard()
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

    public function representativeCompanyProfile()
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
                    $data['companyId'] = $userData['company_id'];
                    $data['businessType'] = $userData['business_type'];
                    $data['hrUser'] = $userData['hr_user'];
                    $data['bpoUser'] = $userData['bpo_user'];
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

    public function representativeFinancingProducts()
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

    public function representativeEmployeeList()
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

    public function representativeBillingAndPayments()
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

    public function representativeMaintenanceUsers()
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

    public function representativeMaintenanceRoles()
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

    public function representativeFaqs()
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
    public function adminProfile()
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

    public function adminDashboard()
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

    public function adminApplications()
    {
        
    }

    public function adminPartnersList()
    {
        
    }

    public function adminSalaryAdvance()
    {
        
    }

    public function adminBusinessExpansion()
    {
        
    }

    public function adminPaymentNow()
    {
        
    }

    public function adminBillings()
    {
        
    }

    public function adminPayments()
    {
        
    }

    public function adminMaintenanceUsers()
    {
        if($this->session->has('gwc_admin_loggedIn'))
        {
            if($this->session->get('gwc_admin_loggedIn'))
            {
                $data['pageTitle'] = "Users | GWC";
                $data['customScripts'] = 'admin_users';
                $userData = $this->users->selectUser($this->session->get('gwc_admin_id'));
                $data['accessModules'] = json_decode($userData['access_modules']);

                if($userData != null)
                {
                    $data['userType'] = 'admin';
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

    public function adminMaintenanceRoles()
    {
        if($this->session->has('gwc_admin_loggedIn'))
        {
            if($this->session->get('gwc_admin_loggedIn'))
            {
                $data['pageTitle'] = "Roles | GWC";
                $data['customScripts'] = 'admin_roles';
                $userData = $this->users->selectUser($this->session->get('gwc_admin_id'));
                $data['accessModules'] = json_decode($userData['access_modules']);

                if($userData != null)
                {
                    $data['userType'] = 'admin';
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

    public function adminMaintenanceFees()
    {
        
    }

    public function adminMaintenanceFaqs()
    {
        
    }

    public function adminReports()
    {
        
    }

    public function adminAuditTrail()
    {
        
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
