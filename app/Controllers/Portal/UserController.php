<?php

namespace App\Controllers\Portal;

use App\Controllers\BaseController;

class UserController extends BaseController
{
    public function __construct()
    {
        $this->users = model('Users');
    }

    public function loadAdminUsers()
    {
        $arrData = $this->users->loadUsers();
        return $this->response->setJSON($arrData);
    }

    public function addAdminUser()
    {
        $this->validation->setRules([
            'txt_emailAddress' => [
                'label'  => 'Email Address',
                'rules'  => 'required|valid_email',
                'errors' => [
                    'required'    => 'Email Address is required',
                    'valid_email' => 'Email Address must be valid'
                ],
            ],
            'txt_firstName' => [
                'label'  => 'First Name',
                'rules'  => 'required',
                'errors' => [
                    'required'    => 'First Name is required'
                ],
            ],
            'txt_lastName' => [
                'label'  => 'Last Name',
                'rules'  => 'required',
                'errors' => [
                    'required'    => 'Last Name is required'
                ],
            ],
            'slc_status' => [
                'label'  => 'Status',
                'rules'  => 'required',
                'errors' => [
                    'required'    => 'Status is required'
                ],
            ],
            'slc_role' => [
                'label'  => 'Role',
                'rules'  => 'required',
                'errors' => [
                    'required'    => 'Role is required'
                ],
            ],
        ]);

        if($this->validation->withRequest($this->request)->run())
        {
            $fields = $this->request->getPost();

            $arrData = [
                'first_name'     => $fields['txt_firstName'],
                'last_name'      => $fields['txt_lastName'],
                'mobile_number'  => $fields['txt_mobileNumber'],
                'email_address'  => $fields['txt_emailAddress'],
                'user_password'  => encrypt_code('asd'),
                'user_status'    => $fields['slc_status'],
                'role_id'        => $fields['slc_role'],
                'access_modules' => $fields['arrAccessModules'],
                'created_by'     => $this->session->get('gwc_admin_id'),
                'created_date'   => date('Y-m-d H:i:s')
            ];

            $result = $this->users->loadUsers(['email_address'=>$fields['txt_emailAddress']]);
            if($result != null)
            {
                $msgResult[] = "Email already exist!";
                return $this->response->setStatusCode(401)->setJSON($msgResult);
                exit();
            }
            else
            {
                $result = $this->users->addUser($arrData);
                if($result > 0)
                {
                    $emailConfig = sliceMailConfig();

                    $emailSender    = 'ajhay.dev@gmail.com';
                    $emailReceiver  = $arrData['email_address'];

                    $data = [
                        'subjectTitle' => 'Welcome Message',
                        'emailAddress' => $arrData['email_address'],
                        'userPassword' => decrypt_code($arrData['user_password'])
                    ];

                    $emailResult = sendSliceMail('admin_registration',$emailConfig,$emailSender,$emailReceiver,$data);
                    
                    $msgResult[] = "New user saved successfully";
                }
                else
                {
                    $msgResult[] = "Something went wrong, please try again";
                    return $this->response->setStatusCode(401)->setJSON($msgResult);
                    exit();
                }
            }
        }
        else
        {
            $msgResult[] = $this->validation->getErrors();
        }
        return $this->response->setJSON($msgResult);
    }

    public function selectAdminUser()
    {
        $fields = $this->request->getGet();
        $data = $this->users->selectUser($fields['userId']);
        $data['access_modules'] = json_decode($data['access_modules']);
        return $this->response->setJSON($data);
    }

    public function editAdminUser()
    {
        $this->validation->setRules([
            'txt_emailAddress' => [
                'label'  => 'Email Address',
                'rules'  => 'required|valid_email',
                'errors' => [
                    'required'    => 'Email Address is required',
                    'valid_email' => 'Email Address must be valid'
                ],
            ],
            'txt_firstName' => [
                'label'  => 'First Name',
                'rules'  => 'required',
                'errors' => [
                    'required'    => 'First Name is required'
                ],
            ],
            'txt_lastName' => [
                'label'  => 'Last Name',
                'rules'  => 'required',
                'errors' => [
                    'required'    => 'Last Name is required'
                ],
            ],
            'slc_status' => [
                'label'  => 'Status',
                'rules'  => 'required',
                'errors' => [
                    'required'    => 'Status is required'
                ],
            ],
            'slc_role' => [
                'label'  => 'Role',
                'rules'  => 'required',
                'errors' => [
                    'required'    => 'Role is required'
                ],
            ],
        ]);

        if($this->validation->withRequest($this->request)->run())
        {
            $fields = $this->request->getPost();

            $arrData = [
                'first_name'     => $fields['txt_firstName'],
                'last_name'      => $fields['txt_lastName'],
                'mobile_number'  => $fields['txt_mobileNumber'],
                'email_address'  => $fields['txt_emailAddress'],
                'user_password'  => encrypt_code('asd'),
                'user_status'    => $fields['slc_status'],
                'role_id'        => $fields['slc_role'],
                'access_modules' => $fields['arrAccessModules'],
                // 'access_controls'=> json_encode($fields['arrAccessControls']),
                'updated_by'     => $this->session->get('gwc_admin_id'),
                'updated_date'   => date('Y-m-d H:i:s')
            ];

            $result = $this->users->loadUsers(
                [
                    'a.id !='           =>$fields['txt_userId'],
                    'a.email_address'   =>$fields['txt_emailAddress']
                ]
            );
            if($result != null)
            {
                $msgResult[] = "Email already exist!";
                return $this->response->setStatusCode(401)->setJSON($msgResult);
                exit();
            }
            else
            {
                $result = $this->users->editUser($arrData, $fields['txt_userId']);
                if($result > 0)
                {
                    $msgResult[] = "User updated successfully";
                }
                else
                {
                    $msgResult[] = "Something went wrong, please try again";
                    return $this->response->setStatusCode(401)->setJSON($msgResult);
                    exit();
                }
            }
        }
        else
        {
            $msgResult[] = $this->validation->getErrors();
        }
        return $this->response->setJSON($msgResult);
    }

    public function removeAdminUser()
    {
        $fields = $this->request->getPost();
        $result = $this->users->removeUser($fields['userId']);
        if($result > 0)
        {
            $msgResult[] = "User removed successfully";
        }
        else
        {
            $msgResult[] = "Something went wrong, please try again";
            return $this->response->setStatusCode(401)->setJSON($msgResult);
            exit();
        }
        return $this->response->setJSON($msgResult);
    }

    public function changeAdminPassword()
    {
        $this->validation->setRules([
            'txt_oldPassword' => [
                'label'  => 'Old Password',
                'rules'  => 'required',
                'errors' => [
                    'required'    => 'Old Password is required'
                ],
            ],
            'txt_newPassword' => [
                'label'  => 'New Password',
                'rules'  => 'required',
                'errors' => [
                    'required'    => 'New Password is required'
                ],
            ],
            'txt_confirmPassword' => [
                'label'  => 'Last Name',
                'rules'  => 'required',
                'errors' => [
                    'required'    => 'Confirm Password is required'
                ],
            ]
        ]);

        if($this->validation->withRequest($this->request)->run())
        {
            $fields = $this->request->getPost();

            $whereParams = [
                'a.id'              => $this->session->get('gwc_admin_id'),
                'a.user_password'   => encrypt_code($fields['txt_oldPassword'])
            ];
            $result = $this->users->validateAdminPassword($whereParams);

            if($result != null)
            {
                if($fields['txt_newPassword'] == $fields['txt_confirmPassword'])
                {
                    $arrData = [
                        'user_password'  => encrypt_code($fields['txt_newPassword']),
                        'updated_by'     => $this->session->get('gwc_admin_id'),
                        'updated_date'   => date('Y-m-d H:i:s')
                    ];
                    $result = $this->users->editUser($arrData, $this->session->get('gwc_admin_id'));
                    if($result > 0)
                    {
                        $msgResult[] = "Password changed successfully";
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
                    $msgResult[] = "Password confirmation not match!";
                    return $this->response->setStatusCode(401)->setJSON($msgResult);
                    exit();
                }
            }
            else
            {
                $msgResult[] = "Old password is incorrect!";
                return $this->response->setStatusCode(401)->setJSON($msgResult);
                exit();
            }
        }
        else
        {
            $msgResult[] = $this->validation->getErrors();
        }
        return $this->response->setJSON($msgResult);
    }
}
