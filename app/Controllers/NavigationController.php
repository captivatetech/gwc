<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class NavigationController extends BaseController
{
    public function index()
    {
        return $this->slice->view('login');
    }

    public function login()
    {
        return $this->slice->view('login');

    }

    public function resetPw()
    {
        return $this->slice->view('forgot_password');
    }

    public function createAccount()
    {
        return $this->slice->view('sign_up');
    }

    public function dashboard()
    {
        $data['pageTitle'] = 'Dashboard | GWC';
        $data['customScripts'] = 'users';
        return $this->slice->view('portal/dashboard',$data);
    }

    public function profile()
    {
        $data['pageTitle'] = 'User Profile | GWC';
        $data['customScripts'] = 'users';
        return $this->slice->view('portal/user/profile',$data);
    }

    public function companyProfile()
    {
        $data['pageTitle'] = 'Company Profile | GWC';
        $data['customScripts'] = 'users';
        return $this->slice->view('portal/user/company_profile',$data);
    }

    public function financingProduct()
    {
        $data['pageTitle'] = 'Financing Products | GWC';
        $data['customScripts'] = 'users';
        return $this->slice->view('portal/user/financing_products',$data);
    }

    public function employeeList()
    {
        $data['pageTitle'] = 'Employees Information List | GWC';
        $data['customScripts'] = 'users';
        return $this->slice->view('portal/user/employee_list',$data);
    }

    public function billingPayment()
    {
        $data['pageTitle'] = 'Billing & Payments | GWC';
        $data['customScripts'] = 'users';
        return $this->slice->view('portal/user/billing_payment',$data);
    }

    public function faqs()
    {
        $data['pageTitle'] = 'Frequently Asked Questions | GWC';
        $data['customScripts'] = 'users';
        return $this->slice->view('portal/user/faqs',$data);
    }


    // public function resetPw()
    // {
    //     $data['pageTitle'] = 'Users | GWC';
    //     
    //     return $this->slice->view('portal.user', $data);
    // }
}
