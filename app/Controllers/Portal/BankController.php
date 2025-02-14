<?php

namespace App\Controllers\Portal;

use App\Controllers\BaseController;

class BankController extends BaseController
{
    public function __construct()
    {
        $this->banks = model('Banks');
    }

    public function loadBanks()
    {
        $arrData = $this->banks->loadBanks();
        return $this->response->setJSON($arrData);
    }

    public function addBank()
    {

    }

    public function selectBank()
    {
        $fields = $this->request->getGet();
        $data = $this->banks->selectBank($fields['bankId']);
        return $this->response->setJSON($data);
    }

    public function editBank()
    {
        
    }

    public function removeBank()
    {
        $fields = $this->request->getPost();
        $result = $this->banks->removeBank($fields['bankId']);
        if($result > 0)
        {
            $msgResult[] = "Bank removed successfully";

            // for Audit Trail
            $arrData = [
                'user_id' => $this->session->get('gwc_admin_id'),
                'module_name' => 'Bank Module',
                'activity_type' => 'Remove Bank',
                'activity_details' => '',
                'created_date' => date('Y-m-d H:i:s')
            ];
            $this->activities->addUserActivity($arrData);
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
