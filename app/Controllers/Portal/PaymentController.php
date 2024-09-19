<?php

namespace App\Controllers\Portal;

use App\Controllers\BaseController;

class PaymentController extends BaseController
{
    public function __construct()
    {
        $this->employees = model('Employees');
        $this->billings = model('Billings');
        $this->payments = model('Payments');
    }

    private function _generatePaymentNumber($companyCode)
    {
        $arrResult = $this->payments->getLastPaymentNumber();

        if($arrResult == null)
        {
            $paymentNumber = "PN:".$companyCode."-".date('Y')."00001";
        }
        else
        {
            $year = substr($arrResult['payment_number'], 11, 4);
            $series = substr($arrResult['payment_number'], 15);

            if($year != date('Y'))
            {
                $paymentNumber = "PN:".$companyCode."-".date('Y').'00001';
            }
            else
            {
                $series = (int)$series + 1;
                $strSeries = "";
                if($series < 10)
                {
                    $strSeries = $year."0000".$series;
                }
                else if($series < 100)
                {
                    $strSeries = $year."000".$series;
                }
                else if($series < 1000)
                {
                    $strSeries = $year."00".$series;
                }
                else if($series < 10000)
                {
                    $strSeries = $year."0".$series;
                }
                else if($series < 100000)
                {
                    $strSeries = $year.$series;
                }
                $paymentNumber = "PN:".$companyCode."-".$strSeries;
            }
        }

        return $paymentNumber;
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
            ]
        ]);

        if($this->validation->withRequest($this->request)->run())
        {
            $fields = $this->request->getPost();

            $billingIds = explode(',', $fields['arrBillingIds']);
            $arrBillingIdsWithPenalties = json_decode($fields['arrBillingIdsWithPenalties'], true);
            if(count($billingIds) > 0)
            {
                if($fields['slc_paymentType'] == 'Online-Payment')
                {
                    
                }
                else
                {
                    $arr = $this->employees->selectRepresentative($this->session->get('gwc_representative_id'));
                    $arrData = [
                        'billing_id'        => $fields['txt_billingId'],
                        'payment_number'    => $this->_generatePaymentNumber($arr['company_code']),
                        'payment_type'      => $fields['slc_paymentType'],
                        'reference_number'  => $fields['txt_paymentReferenceNumber'],
                        'payment_amount'    => (float)str_replace(",", "", $fields['txt_paymentAmount']),
                        'payment_status'    => 'Pending',
                        'payment_date'      => $fields['txt_paymentDate'],
                        'created_by'        => $this->session->get('gwc_representative_id'),
                        'created_date'      => date('Y-m-d H:i:s')
                    ];

                    /////////////////////////
                    // proof of payment document start
                    /////////////////////////
                    $pdfFile = $this->request->getFile('file_proofOfPayment');

                    if($pdfFile != null)
                    {
                        $newFileName = $pdfFile->getRandomName();
                        $pdfFile->move(ROOTPATH . 'public/assets/uploads/representative/payments/', $newFileName);

                        if($pdfFile->hasMoved())
                        {
                            $arrData['proof_of_payment'] = $newFileName;
                        }
                    }
                    else
                    {
                        $arrData['proof_of_payment'] = NULL;
                    }                
                    ///////////////////////
                    // proof of payment document end
                    ///////////////////////

                    /////////////////////////
                    // promisory note document start
                    /////////////////////////
                    $pdfFile = $this->request->getFile('file_promisoryNote');

                    if($pdfFile != null)
                    {
                        $newFileName = $pdfFile->getRandomName();
                        $pdfFile->move(ROOTPATH . 'public/assets/uploads/representative/promisory/', $newFileName);

                        if($pdfFile->hasMoved())
                        {
                            $arrData['promisory_note'] = $newFileName;
                        }
                    }
                    else
                    {
                        $arrData['promisory_note'] = NULL;
                    }                
                    ///////////////////////
                    // promisory note document end
                    ///////////////////////

                    $result = $this->payments->r_submitPayment($arrData);
                    if($result > 0)
                    {
                        if((float)str_replace(",", "", $fields['txt_billingAmount']) == (float)str_replace(",", "", $fields['txt_paymentAmount']))
                        {
                            $paymentStatus = "PAID";
                        }
                        else
                        {
                            $paymentStatus = "PARTIAL";
                        }
                        $arrData = [];
                        $arrData = [
                            'total_paid'    => (float)str_replace(",", "", $fields['txt_paymentAmount']),
                            'balance'       => (float)str_replace(",", "", $fields['txt_balance']),
                            'payment_status'=> $paymentStatus,
                            'updated_by'    => $this->session->get('gwc_representative_id'),
                            'updated_date'  => date('Y-m-d H:i:s')
                        ];
                        $this->billings->r_updateBilling($arrData, $fields['txt_billingId']);

                        $arrData = [];
                        for ($i=0; $i < count($billingIds); $i++) 
                        { 
                            $arrData[] = [
                                'id'                => $billingIds[$i],
                                'payment_status'    => 'PAID',
                                'penalty_type'      => null,
                                'updated_by'        => $this->session->get('gwc_representative_id'),
                                'updated_date'      => date('Y-m-d H:i:s')
                            ];
                        }
                        foreach ($arrBillingIdsWithPenalties as $key => $value) 
                        {
                            $arrData[] = [
                                'id'                => $value['id'],
                                'payment_status'    => 'UNPAID',
                                'penalty_type'      => $value['penaltyType'],
                                'updated_by'        => $this->session->get('gwc_representative_id'),
                                'updated_date'      => date('Y-m-d H:i:s')
                            ];
                        }
                        $this->billings->r_updateBillingDetails($arrData);

                        $msgResult[] = "Payment Completed!";
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






    public function a_loadPayments()
    {
        $arrData = $this->payments->a_loadPayments();
        return $this->response->setJSON($arrData);
        exit();
    }

    public function a_selectPayment()
    {
        $fields = $this->request->getGet();
        $arrData = $this->payments->a_selectPayment($fields['paymentId']);
        return $this->response->setJSON($arrData);
        exit();
    }   

    public function a_confirmPayment()
    {
        $this->validation->setRules([
            'slc_paymentStatus' => [
                'label'  => 'Payment Status',
                'rules'  => 'required',
                'errors' => [
                    'required'    => 'Payment Status is required',
                ],
            ]
        ]);

        if($this->validation->withRequest($this->request)->run())
        {
            $fields = $this->request->getPost();
            if($fields['slc_paymentStatus'] == 'CONFIRM')
            {
                $arrData = [
                    'payment_status'    => 'CONFIRM', 
                    'confirmation_date' => date('Y-m-d H:i:s')
                ];

                $result = $this->payments->a_confirmPayment($arrData, $fields['txt_paymentId']);
                if($result == 1)
                {

                    $arrRepresentative = $this->employees->a_selectRepresentative($fields['txt_companyId']);

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
                    $emailReceiver  = $arrRepresentative['email_address'];

                    $data = [
                        'subjectTitle'  => 'Confirm Payment'
                    ];

                    sendSliceMail('representative_confirm_payment',$emailConfig,$emailSender,$emailReceiver,$data);

                    $msgResult[] = "Success!<br>Payment Confirmed!";
                    return $this->response->setJSON($msgResult);
                    exit();
                }
                else
                {
                    $msgResult[] = "Error!<br>Something went wrong!";
                    return $this->response->setStatusCode(401)->setJSON($msgResult);
                    exit();
                }
            }
            else if($fields['slc_paymentStatus'] == 'RETURN')
            {

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
