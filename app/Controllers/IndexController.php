<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class IndexController extends BaseController
{
    public function __construct()
    {
        $this->users        = model('Users');
        $this->employees    = model('Employees');
    }

    /* !== Log in for ADMIN, EMPLOYEE & REPRESENTATIVE ==! */
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

            $validateLogInResult1 = $this->users->validateLogIn($logInRequirements);
            $validateLogInResult2 = $this->employees->validateLogIn($logInRequirements);

            if(!empty($validateLogInResult1))
            {
                $userData = [
                    'gwc_admin_id'        => $validateLogInResult1['id'],
                    'gwc_admin_firstName' => $validateLogInResult1['first_name'],
                    'gwc_admin_lastName'  => $validateLogInResult1['last_name'],
                    'gwc_admin_loggedIn'  => true
                ];
                $this->session->set($userData);

                $userData = [
                    'gwc_representative_id',
                    'gwc_representative_firstName',
                    'gwc_representative_lastName',
                    'gwc_representative_loggedIn',
                    'gwc_employee_id',
                    'gwc_employee_firstName',
                    'gwc_employee_lastName',
                    'gwc_employee_loggedIn'
                ];
                $this->session->remove($userData);

                $msgResult[] = "admin";
                $msgResult[] = "You are successfully logged in";
            }
            else if(!empty($validateLogInResult2))
            {
                if($validateLogInResult2['user_type'] == 'employee')
                {
                    $userData = [
                        'gwc_employee_id'        => $validateLogInResult2['id'],
                        'gwc_employee_firstName' => $validateLogInResult2['first_name'],
                        'gwc_employee_lastName'  => $validateLogInResult2['last_name'],
                        'gwc_employee_loggedIn'  => true
                    ];
                    $this->session->set($userData);

                    $userData = [
                        'gwc_admin_id',
                        'gwc_admin_firstName',
                        'gwc_admin_lastName',
                        'gwc_admin_loggedIn',
                        'gwc_representative_id',
                        'gwc_representative_firstName',
                        'gwc_representative_lastName',
                        'gwc_representative_loggedIn'
                    ];
                    $this->session->remove($userData);

                    $msgResult[] = "employee";
                    $msgResult[] = "You are successfully logged in";
                }
                else
                {
                    $userData = [
                        'gwc_representative_id'        => $validateLogInResult2['id'],
                        'gwc_representative_firstName' => $validateLogInResult2['first_name'],
                        'gwc_representative_lastName'  => $validateLogInResult2['last_name'],
                        'gwc_representative_loggedIn'  => true
                    ];
                    $this->session->set($userData);

                    $userData = [
                        'gwc_admin_id',
                        'gwc_admin_firstName',
                        'gwc_admin_lastName',
                        'gwc_admin_loggedIn',
                        'gwc_employee_id',
                        'gwc_employee_firstName',
                        'gwc_employee_lastName',
                        'gwc_employee_loggedIn'
                    ];
                    $this->session->remove($userData);

                    $msgResult[] = "representative";
                    $msgResult[] = "You are successfully logged in";
                }
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

    /* !== Create Account for REPRESENTATIVE ==! */
    public function createAccount()
    {
        $this->validation->setRules([
            'txt_userEmail' => [
                'label'  => 'Email Address',
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Email Address is required'
                ],
            ]
        ]);

        if($this->validation->withRequest($this->request)->run())
        {
            $fields = $this->request->getPost();

            $whereParams = [
                'a.email_address'   => $fields['txt_userEmail']
            ];
            $result = $this->employees->validateRepresentativeEmail($whereParams);

            if($result == null)
            {
                $arrData = [
                    'email_address' => $fields['txt_userEmail'],
                    'auth_code'     => encrypt_code(generate_code(10)),
                    'user_type'     => 'representative',
                    'created_date'  => date('Y-m-d H:i:s')
                ];
                
                $result = $this->employees->createAccount($arrData);
                if($result > 0)
                {
                    $emailConfig = [
                        'smtp_host'    => 'smtp.googlemail.com',
                        'smtp_port'    => 465,
                        'smtp_crypto'  => 'ssl',
                        'smtp_user'    => 'ajhay.dev@gmail.com',
                        'smtp_pass'    => 'uajtlnchouyuxaqp',
                        'mail_type'    => 'html',
                        'charset'      => 'iso-8859-1',
                        'word_wrap'    => true
                    ];

                    $emailSender    = 'ajhay.dev@gmail.com';
                    $emailReceiver  = $arrData['email_address'];

                    $data = [
                        'subjectTitle'  => 'Email Verification',
                        'emailAddress'  => $arrData['email_address'],
                        'authCode'      => decrypt_code($arrData['auth_code'])
                    ];

                    $emailResult = sendSliceMail('representative_registration',$emailConfig,$emailSender,$emailReceiver,$data);

                    if($emailResult == true)
                    {
                        $msgResult[] = "Registration complete!";
                    }
                    else
                    {
                        $msgResult[] = "Email verification not sent!";
                        return $this->response->setStatusCode(401)->setJSON($msgResult);
                        exit();
                    }
                }
                else
                {
                    $msgResult[] = "Something went wrong, please try again";
                    return $this->response->setStatusCode(401)->setJSON($msgResult);
                    exit();
                }
            }
            else
            {
                $msgResult[] = "Email already exist!";
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


    /* !== Email Verification for EMPLOYEE ==! */

    public function e_emailVerification()
    {
        $this->validation->setRules([
            'txt_employeePassword' => [
                'label'  => 'Password',
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Password is Incorrect',
                ],
            ],
            'txt_employeeConfirmPassword' => [
                'label'  => 'Confirm Password',
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Confirm Password is Incorrect',
                ],
            ]
        ]);

        if($this->validation->withRequest($this->request)->run())
        {
            $fields = $this->request->getPost();

            if($fields['txt_employeePassword'] == $fields['txt_employeeConfirmPassword'])
            {
                $whereParams = [
                    'a.email_address'   => $fields['txt_emailAddress'],
                    'a.auth_code'       => encrypt_code($fields['txt_authCode'])
                ];
                $result = $this->employees->validateEmployeeEmail($whereParams);
                if($result != null)
                {
                    $arrData = [
                        'user_password' => encrypt_code($fields['txt_employeePassword']),
                        'auth_code'     => null,
                        'user_status'   => 1
                    ];
                    $this->employees->editEmployee($arrData, $result['id']);
                    $msgResult[] = "Yey! You can now login to your account.";
                    return $this->response->setJSON($msgResult);
                    exit();
                }
                else
                {
                    $msgResult[] = "Email verification failed!";
                    return $this->response->setStatusCode(401)->setJSON($msgResult);
                    exit();
                }
            }
            else
            {
                $msgResult[] = "Password confirmation not match!";
                return $this->response->setStatusCode(401)->setJSON($msgResult);
                exit();
            }
        }
        else
        {
            $msgResult[] = $this->validation->getErrors();
            return $this->response->setStatusCode(401)->setJSON($msgResult);
            exit();
        }
    }
}
