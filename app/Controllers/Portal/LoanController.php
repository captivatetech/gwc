<?php

namespace App\Controllers\Portal;

use App\Controllers\BaseController;

class LoanController extends BaseController
{
    public function __construct()
    {
        $this->loans = model('Loans');
    }

    public function e_submitSalaryAdvanceApplication()
    {
        $fields = $this->request->getPost();

        

        return $this->response->setJSON($fields);
    }
}
