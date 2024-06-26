<?php

namespace App\Controllers\Portal;

use App\Controllers\BaseController;

class RoleController extends BaseController
{
    public function __construct()
    {
        $this->roles = model('Roles');
    }

    public function loadAdminRoles()
    {
        $arrData = $this->roles->loadRoles();
        return $this->response->setJSON($arrData);
    }

    public function addAdminRole()
    {
        $this->validation->setRules([
            'txt_roleName' => [
                'label'  => 'Role Name',
                'rules'  => 'required',
                'errors' => [
                    'required'    => 'Role Name is required',
                ],
            ]
        ]);

        if($this->validation->withRequest($this->request)->run())
        {
            $fields = $this->request->getPost();

            $data = $this->roles->validateRole(['a.role_name'=>$fields['txt_roleName']]);

            if($data == null)
            {
                $arrData = [
                    'role_name'             => $fields['txt_roleName'],
                    'role_description'      => $fields['txt_roleDescription'],
                    'access_modules'        => $fields['arrAccessModules'],
                    'role_status'           => '1',
                    'created_by'            => $this->session->get('gwc_admin_id'),
                    'created_date'          => date('Y-m-d H:i:s')
                ];

                $result = $this->roles->addRole($arrData);
                if($result > 0)
                {
                    $msgResult[] = "New role saved successfully";
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
                $msgResult[] = "Role name already exist";
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

        return $this->response->setJSON($msgResult);
    }

    public function selectAdminRole()
    {
        $fields = $this->request->getGet();
        $arrData = $this->roles->selectRole($fields['roleId']);
        $arrData['access_modules'] = json_decode($arrData['access_modules']);
        return $this->response->setJSON($arrData);
    }

    public function editAdminRole()
    {
        $this->validation->setRules([
            'txt_roleName' => [
                'label'  => 'Role Name',
                'rules'  => 'required',
                'errors' => [
                    'required'    => 'Role Name is required',
                ],
            ]
        ]);

        if($this->validation->withRequest($this->request)->run())
        {
            $fields = $this->request->getPost();

            $data = $this->roles->validateRole(
                [
                    'a.id !='       =>$fields['txt_roleId'], 
                    'a.role_name'   =>$fields['txt_roleName']
                ]
            );

            if($data == null)
            {
                $arrData = [
                    'role_name'             => $fields['txt_roleName'],
                    'role_description'      => $fields['txt_roleDescription'],
                    'access_modules'        => $fields['arrAccessModules'],
                    'role_status'           => '1',
                    'updated_by'            => $this->session->get('gwc_admin_id'),
                    'updated_date'          => date('Y-m-d H:i:s')
                ];

                $result = $this->roles->editRole($arrData, $fields['txt_roleId']);
                if($result > 0)
                {
                    $msgResult[] = "Role updated successfully";
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
                $msgResult[] = "Role name already exist";
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

        return $this->response->setJSON($msgResult);
    }

    public function removeAdminRole()
    {
        $fields = $this->request->getPost();
        $arrRoleUser = $this->roles->loadRoleUsers($fields['roleId']);

        if(count($arrRoleUser) > 0)
        {
            $msgResult[] = "Unable to remove role, " . count($arrRoleUser) . " user(s) uses this role";
            return $this->response->setStatusCode(401)->setJSON($msgResult);
            exit();
        }
        else
        {
            $result = $this->roles->removeRole($fields['roleId']);
            if($result > 0)
            {
                $msgResult[] = "Role removed successfully";
            }
            else
            {
                $msgResult[] = "Something went wrong, please try again";
                return $this->response->setStatusCode(401)->setJSON($msgResult);
                exit();
            }
        }
        
        return $this->response->setJSON($msgResult);
    }
}
