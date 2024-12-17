<?php

namespace App\Controllers\Portal;

use App\Controllers\BaseController;

class FeeController extends BaseController
{
    public function __construct()
    {
        $this->fees = model('Fees');
    }

    public function loadAdminFees()
    {
        $arrData = $this->fees->loadAdminFees();
        return $this->response->setJSON($arrData);
    }

    public function addAdminFee()
    {
        $this->validation->setRules([
            'txt_feeType' => [
                'label'  => 'Type',
                'rules'  => 'required',
                'errors' => [
                    'required'    => 'Type is required',
                ],
            ],
            'txt_feeAmount' => [
                'label'  => 'Fee Amount',
                'rules'  => 'required',
                'errors' => [
                    'required'    => 'Fee Amount is required',
                ],
            ],
            'slc_feeStatus' => [
                'label'  => 'Fee Status',
                'rules'  => 'required',
                'errors' => [
                    'required'    => 'Fee Status is required',
                ],
            ]
        ]);

        if($this->validation->withRequest($this->request)->run())
        {
            $fields = $this->request->getPost();

            $arrData = [
                'type'          => $fields['txt_feeType'],
                'amount'        => $fields['txt_feeAmount'],
                'fee_status'    => $fields['slc_feeStatus'],
                'created_by'    => $this->session->get('gwc_admin_id'),
                'created_date'  => date('Y-m-d H:i:s')
            ];

            $result = $this->fees->addAdminFee($arrData);
            if($result > 0)
            {
                $msgResult[] = "New fee saved successfully";
                return $this->response->setJSON($msgResult);
                exit();
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
            $msgResult[] = $this->validation->getErrors();
            return $this->response->setStatusCode(401)->setJSON($msgResult);
            exit();
        }
    }

    public function selectAdminFee()
    {
        $fields = $this->request->getGet();
        $data = $this->fees->selectAdminFee($fields['feeId']);
        return $this->response->setJSON($data);
    }

    public function editAdminFee()
    {
        $this->validation->setRules([
            'txt_feeType' => [
                'label'  => 'Type',
                'rules'  => 'required',
                'errors' => [
                    'required'    => 'Type is required',
                ],
            ],
            'txt_feeAmount' => [
                'label'  => 'Fee Amount',
                'rules'  => 'required',
                'errors' => [
                    'required'    => 'Fee Amount is required',
                ],
            ],
            'slc_feeStatus' => [
                'label'  => 'Fee Status',
                'rules'  => 'required',
                'errors' => [
                    'required'    => 'Fee Status is required',
                ],
            ]
        ]);

        if($this->validation->withRequest($this->request)->run())
        {
            $fields = $this->request->getPost();

            $arrData = [
                'type'          => $fields['txt_feeType'],
                'amount'        => $fields['txt_feeAmount'],
                'fee_status'    => $fields['slc_feeStatus'],
                'updated_by'    => $this->session->get('gwc_admin_id'),
                'updated_date'  => date('Y-m-d H:i:s')
            ];

            $result = $this->fees->editAdminFee($arrData, $fields['txt_feeId']);
            if($result > 0)
            {
                $msgResult[] = "Fee updated successfully";
                return $this->response->setJSON($msgResult);
                exit();
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
            $msgResult[] = $this->validation->getErrors();
            return $this->response->setStatusCode(401)->setJSON($msgResult);
            exit();
        }
    }

    public function removeAdminFee()
    {
        $fields = $this->request->getPost();
        $result = $this->fees->removeAdminFee($fields['feeId']);
        if($result > 0)
        {
            $msgResult[] = "Fee removed successfully";
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
