<?php

namespace App\Controllers\Portal;

use App\Controllers\BaseController;

class UserController extends BaseController
{
    public function __construct()
    {
        $this->users = model('Users');
    }

    public function loadUsers()
    {
        $arrData = $this->users->loadUsers();
        return $this->response->setJSON($arrData);
    }

    public function addUser()
    {
        $this->validation->setRules([
            'txt_emailAddress' => [
                'label'  => 'Email Address',
                'rules'  => 'required|valid_email',
                'errors' => [
                    'required'    => 'Primary Email is required',
                    'valid_email' => 'Primary Email must be valid'
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
                'created_by'     => $this->session->get('mkmas_user_id'),
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

    public function selectUser()
    {
        $fields = $this->request->getGet();
        $data = $this->users->selectUser($fields['userId']);
        $data['access_modules'] = json_decode($data['access_modules']);
        return $this->response->setJSON($data);
    }

    public function editUser()
    {
        $this->validation->setRules([
            'txt_emailAddress' => [
                'label'  => 'Email Address',
                'rules'  => 'required|valid_email',
                'errors' => [
                    'required'    => 'Primary Email is required',
                    'valid_email' => 'Primary Email must be valid'
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
                'updated_by'     => $this->session->get('mkmas_user_id'),
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

    public function removeUser()
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
}
