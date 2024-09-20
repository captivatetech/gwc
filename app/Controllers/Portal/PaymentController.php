<?php

namespace App\Controllers\Portal;

use App\Controllers\BaseController;

use Xendit\Configuration;
use Xendit\Invoice\InvoiceApi;
use Xendit\Invoice\CreateInvoiceRequest;

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
                $arr = $this->employees->selectRepresentative($this->session->get('gwc_representative_id'));
                $paymentNumber = $this->_generatePaymentNumber($arr['company_code']);
                if($fields['slc_paymentType'] == 'Online-Payment')
                {
                    $xenditPrivateKey = getenv('xendit_private_key');
                    Configuration::setXenditKey($xenditPrivateKey);

                    $externalId = "EXT-".date('Ymd').time();
                    $baseUrl = base_url();
                    $arrParams = json_encode($fields);

                    $apiInstance = new InvoiceApi();
                    $createInvoiceRequest = new CreateInvoiceRequest([
                      'external_id'             => $externalId,
                      'description'             => 'System Payment Number: ' . $paymentNumber,
                      'amount'                  => (float)str_replace(",", "", $fields['txt_paymentAmount']),
                      'invoice_duration'        => 172800,
                      'currency'                => 'PHP',
                      'reminder_time'           => 1,
                      'success_redirect_url'    => $baseUrl.'portal/representative/r-edit-success-payment/'.$arrParams,
                      'failure_redirect_url'    => $baseUrl.'portal/representative/r-edit-failed-payment/'.$arrParams
                    ]);

                    $xenditUserId = getenv('xendit_user_id');

                    try {
                        $apiResult = $apiInstance->createInvoice($createInvoiceRequest, $xenditUserId);

                        $arrData = [
                            'billing_id'        => $fields['txt_billingId'],
                            'payment_number'    => $paymentNumber,
                            'payment_type'      => $fields['slc_paymentType'],
                            'reference_number'  => $apiResult['external_id'],
                            'payment_amount'    => (float)str_replace(",", "", $fields['txt_paymentAmount']),
                            'payment_status'    => 'PENDING',
                            'payment_date'      => $fields['txt_paymentDate'],
                            'proof_of_payment'  => $apiResult['invoice_url'],
                            'created_by'        => $this->session->get('gwc_representative_id'),
                            'created_date'      => date('Y-m-d H:i:s')
                        ];

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
                            $msgResult[] = $fields['slc_paymentType'];
                            $msgResult[] = $apiResult['invoice_url'];
                            return $this->response->setJSON($msgResult);
                            exit();
                        }
                        else
                        {
                            $msgResult[] = "Something went wrong, please try again";
                            return $this->response->setStatusCode(401)->setJSON($msgResult);
                            exit();
                        }
                    } catch (\Xendit\XenditSdkException $e) {
                        echo 'Exception when calling InvoiceApi->createInvoice: ', $e->getMessage(), PHP_EOL;
                        echo 'Full Error: ', json_encode($e->getFullError()), PHP_EOL;
                    }
                }
                else
                {
                    $arr = $this->employees->selectRepresentative($this->session->get('gwc_representative_id'));
                    $arrData = [
                        'billing_id'        => $fields['txt_billingId'],
                        'payment_number'    => $paymentNumber,
                        'payment_type'      => $fields['slc_paymentType'],
                        'reference_number'  => $fields['txt_paymentReferenceNumber'],
                        'payment_amount'    => (float)str_replace(",", "", $fields['txt_paymentAmount']),
                        'payment_status'    => 'PENDING',
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
                        // if((float)str_replace(",", "", $fields['txt_billingAmount']) == (float)str_replace(",", "", $fields['txt_paymentAmount']))
                        // {
                        //     $paymentStatus = "PAID";
                        // }
                        // else
                        // {
                        //     $paymentStatus = "PARTIAL";
                        // }
                        $paymentStatus = 'PENDING';
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
                                'payment_status'    => 'PENDING',
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

                        $msgResult[] = $fields['slc_paymentType'];
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

    public function r_editSuccessPayment($arrParams)
    {
        $arrFields = json_decode($arrParams, true);

        $arrResult = $this->billings->r_selectBilling($arrFields['txt_billingId']);
        if($arrResult['payment_status'] == 'UNPAID')
        {
            $billingIds = explode(',', $arrFields['arrBillingIds']);
            $arrBillingIdsWithPenalties = json_decode($arrFields['arrBillingIdsWithPenalties'], true);

            // if((float)str_replace(",", "", $arrFields['txt_billingAmount']) == (float)str_replace(",", "", $arrFields['txt_paymentAmount']))
            // {
            //     $paymentStatus = "PAID";
            // }
            // else
            // {
            //     $paymentStatus = "PARTIAL";
            // }
            $paymentStatus = 'PENDING';
            $arrData = [];
            $arrData = [
                'total_paid'    => (float)str_replace(",", "", $arrFields['txt_paymentAmount']),
                'balance'       => (float)str_replace(",", "", $arrFields['txt_balance']),
                'payment_status'=> $paymentStatus,
                'updated_by'    => $this->session->get('gwc_representative_id'),
                'updated_date'  => date('Y-m-d H:i:s')
            ];
            $this->billings->r_updateBilling($arrData, $arrFields['txt_billingId']);

            $arrData = [];
            for ($i=0; $i < count($billingIds); $i++) 
            { 
                $arrData[] = [
                    'id'                => $billingIds[$i],
                    'payment_status'    => 'PENDING',
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

            $arrData = [
                'payment_status' => "UNPAID"
            ];
        }
        else
        {
            $arrData = [
                'payment_status' => "PENDING"
            ];
        }
        return $this->slice->view('portal.representative.representative_success_payment', $arrData);
    }

    public function r_editFailedPayment($arrParams)
    {

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
                    $arrData = [
                        'payment_status' => 'PAID'
                    ];
                    $this->payments->a_updateBilling($arrData, $fields['txt_billingId']);

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

                    $result = sendSliceMail('representative_confirm_payment',$emailConfig,$emailSender,$emailReceiver,$data);
                    if($result > 0)
                    {
                        $arrData[] = "Confirm-Payment";
                        $arrData[] = $this->employees->a_loadEmployeeDetails($fields['txt_billingId']);
                        return $this->response->setJSON($arrData);
                        exit();
                    }
                    else
                    {
                        $msgResult[] = "Error!<br>Something went wrong!";
                        return $this->response->setStatusCode(401)->setJSON($msgResult);
                        exit();
                    }
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
                $arrData = [
                    'payment_status' => 'RETURN', 
                    'return_remarks' => $fields['txt_returnRemarks']
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
                        'subjectTitle'  => 'Return Payment',
                        'returnRemarks' => $fields['txt_returnRemarks']
                    ];

                    $result = sendSliceMail('representative_return_payment',$emailConfig,$emailSender,$emailReceiver,$data);
                    if($result > 0)
                    {
                        $msgResult[] = "Return-Payment";
                        return $this->response->setJSON($arrData);
                        exit();
                    }
                    else
                    {
                        $msgResult[] = "Error!<br>Something went wrong!";
                        return $this->response->setStatusCode(401)->setJSON($msgResult);
                        exit();
                    }
                }
                else
                {
                    $msgResult[] = "Error!<br>Something went wrong!";
                    return $this->response->setStatusCode(401)->setJSON($msgResult);
                    exit();
                }
            }
        }
        else
        {
            $msgResult[] = $this->validation->getErrors();
            return $this->response->setStatusCode(401)->setJSON($msgResult);
            exit();
        }
    }

    public function a_sendEmailToEmployees()
    {
        $fields = $this->request->getPost();

        $arrData = [
            'payment_status' => 'PAID'
        ];

        $result = $this->payments->a_updateBillingDetails($arrData, $fields['billing_details_id']);

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
            $emailReceiver  = $fields['email_address'];

            $data = [
                'subjectTitle'  => 'Confirm Payment'
            ];

            $result = sendSliceMail('employee_confirm_payment',$emailConfig,$emailSender,$emailReceiver,$data);
            if($result > 0)
            {
                $msgResult[] = "Success!<br>Payment confirmation sent!";
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
        else
        {
            $msgResult[] = "Error!<br>Something went wrong!";
            return $this->response->setStatusCode(401)->setJSON($msgResult);
            exit();
        }   
    }
}
