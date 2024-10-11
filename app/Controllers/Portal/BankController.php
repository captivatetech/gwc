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
