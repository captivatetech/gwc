<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class NavigationController extends BaseController
{
    public function __construct()
    {
        $this->employees = model('Employees');
    }

    public function index()
    {
        return $this->slice->view('login');
    }

    public function login()
    {
        return $this->slice->view('login');
    }

    public function createAccount()
    {
        return $this->slice->view('create_account');
    }

    public function representativeEmailVerification($emailAddress, $authCode)
    {
        $whereParams = [
            'a.email_address'   => $emailAddress,
            'a.auth_code'       => encrypt_code($authCode)
        ];
        $result = $this->employees->validateRepresentativeEmail($whereParams);

        if($result != null)
        {
            $arrData = [
                'auth_code'     => null,
                'user_status'   => 1
            ];
            $this->employees->editEmployee($arrData, $result['id']);

            $data['status'] = 'success'; 
        }
        else
        {
            $data['status'] = 'failed'; 
        }

        return $this->slice->view('email_verification', $data);
    }

    public function forgotPassword()
    {
        return $this->slice->view('forgot_password');
    }
}
