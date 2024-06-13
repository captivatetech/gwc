<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class IndexController extends BaseController
{
    public function __construct()
    {
        $this->users = model('Users');
    }

    public function login()
    {
        $this->validation->setRules([
            'txt_userEmail' => [
                'label'  => 'User Email',
                'rules'  => 'required',
                'errors' => [
                    'required' => 'User Email is required'
                ],
            ],
            'txt_userPassword' => [
                'label'  => 'User Password',
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Password is Incorrect',
                ],
            ]
        ]);

        if($this->validation->withRequest($this->request)->run())
        {
            $fields = $this->request->getPost();

            $logInRequirements = [
                'email_address'   => $fields['txt_userEmail'],
                'user_password'   => encrypt_code($fields['txt_userPassword']),
                'user_status'     => '1', //meaning active
            ];

            $validateLogInResult = $this->users->validateLogIn($logInRequirements);

            if(!empty($validateLogInResult))
            {
                $userData = [
                    'gwc_user_id'        => $validateLogInResult['id'],
                    'gwc_user_firstName' => $validateLogInResult['first_name'],
                    'gwc_user_lastName'  => $validateLogInResult['last_name'],
                    'gwc_user_loggedIn'  => true
                ];
                $this->session->set($userData);

                $msgResult[] = "You are successfully logged in";
            }
            else
            {
                $msgResult[] = "Your email or password is incorrect";
                return $this->response->setStatusCode(401)->setJSON($msgResult);
                exit();
            }
        }
        else
        {
            $msgResult[] = $this->validation->getErrors();
        }

        return $this->response->setJSON($msgResult);
        exit();
    }
}
