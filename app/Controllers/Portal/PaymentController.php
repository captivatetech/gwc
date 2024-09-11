<?php

namespace App\Controllers\Portal;

use App\Controllers\BaseController;

class PaymentController extends BaseController
{
    public function __construct()
    {
        $this->billings = model('Billings');
        $this->payments = model('Payments');
    }

    public function r_submitPayment()
    {
        $this->validation->setRules([
            'txt_paymentDate' => [
                'label'  => 'Payment Date',
                'rules'  => 'required',
                'errors' => [
                    'required'    => 'Payment Date is required',
                ],
            ],
            'slc_paymentType' => [
                'label'  => 'Payment Type',
                'rules'  => 'required',
                'errors' => [
                    'required'    => 'Payment Type is required',
                ],
            ],
            'txt_paymentReferenceNumber' => [
                'label'  => 'Reference Number',
                'rules'  => 'required',
                'errors' => [
                    'required'    => 'Reference Number is required',
                ],
            ]
        ]);

        if($this->validation->withRequest($this->request)->run())
        {
            $fields = $this->request->getPost();
            
            if(count($fields['arrBillingIds']) > 0)
            {
                $arrData = [
                    'billing_id'        => $fields['txt_billingId'],
                    'payment_number'    => ,
                    'payment_type'      => $fields['slc_paymentType'],
                    'reference_number'  => $fields['txt_paymentReferenceNumber'],
                    'payment_amount'    => $fields['txt_paymentAmount'],
                    'payment_status'    => 'Pending',
                    'payment_date'      => $fields['txt_paymentDate'],
                    'created_by'        => $this->session->get('gwc_representative_id'),
                    'created_date'      => date('Y-m-d H:i:s')
                ];

                $result = $this->payments->r_submitPayment($arrData);
                if($result > 0)
                {
                    $msgResult[] = "Payment Completed!";
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
                $msgResult[] = "No selected loan account!";
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
