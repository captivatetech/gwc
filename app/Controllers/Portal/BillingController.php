<?php

namespace App\Controllers\Portal;

use App\Controllers\BaseController;

class BillingController extends BaseController
{
    public function __construct()
    {
        $this->companies    = model('Companies');
        $this->employees    = model('Employees');
        $this->loans        = model('Loans');
        $this->billings     = model('Billings');
        $this->payments     = model('Payments');
    }

    private function _generateBillingNumber($companyCode)
    {
        $arrResult = $this->billings->getLastBillingNumber();

        if($arrResult == null)
        {
            $billingNumber = "BN:".$companyCode."-".date('Y')."00001";
        }
        else
        {
            $year = substr($arrResult['billing_number'], 11, 4);
            $series = substr($arrResult['billing_number'], 15);

            if($year != date('Y'))
            {
                $billingNumber = "BN:".$companyCode."-".date('Y').'00001';
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
                $billingNumber = "BN:".$companyCode."-".$strSeries;
            }
        }

        return $billingNumber;
    }

    public function a_generateBillings()
    {
        $fields = $this->request->getGet();

        $completeDateNow = date($fields['txtDate']); //date('Y-m-15');

        $arrResult = $this->billings->a_countGeneratedBillings($completeDateNow);
        if(count($arrResult) == 0)
        {
            $dateNow = date('d',strtotime(date($fields['txtDate']))); //date('15');

            $arrBillings = $this->billings->a_generateBillings($dateNow);

            $dueDate = date('Y-m-d', strtotime(date($fields['txtDate']). '+ 15 days')); //date('Y-m-d', strtotime(date('Y-m-15'). '+ 15 days'));

            if(count($arrBillings) > 0)
            {
                $arrData = [];
                $arrBillingIds = [];
                foreach ($arrBillings as $key => $value)
                {
                    $arr = [];
                    $arrData = [
                        'company_id'        => $value['id'],
                        'billing_number'    => $this->_generateBillingNumber($value['company_code']),
                        'billing_date'      => date($fields['txtDate']), //date('Y-m-15'),
                        'total_amount'      => $value['total_deduction_per_cutoff'],
                        'total_paid'        => null,
                        'penalty'           => null,
                        'balance'           => null,
                        'due_date'          => $dueDate,
                        'payment_status'    => 'UNPAID', // UNPAID | PAID | PARTIAL
                        'created_by'        => null,
                        'created_date'      => date('Y-m-d H:i:s')
                    ]; 

                    $arr['company_id'] = $value['id'];
                    $arr['billing_id'] = $this->billings->a_addGeneratedBilling($arrData); 

                    $arrBillingIds[] = $arr;
                }

                $arrBillingDetails = [];
                foreach ($arrBillingIds as $key => $value) 
                {
                    $ddate = date('d',strtotime(date($fields['txtDate']))); //date('15');
                    $arr = $this->billings->a_generateBillingDetails($value['company_id'], $ddate);
                    foreach ($arr as $key => $val) 
                    {
                        $arrBillingDetails[] = [
                            'billing_id'    => $value['billing_id'],
                            'loan_id'       => $val['id'],
                            'billing_amount'=> $val['deduction_per_cutoff'],
                            'billing_series'=> (int)$val['billing_series'] + 1,
                            'payment_status'=> 'UNPAID',
                            'created_by'    => $this->session->get('gwc_admin_id'),
                            'created_date'  => date('Y-m-d H:i:s') 
                        ];
                    }
                }

                $this->billings->a_addGeneratedBillingDetails($arrBillingDetails);

                $msgResult[] = "Billing generation complete!";
                return $this->response->setJSON($msgResult);
            }
            else
            {
                $msgResult[] = "No Billing was generated!";
                return $this->response->setStatusCode(401)->setJSON($msgResult);
            }
        }
        else
        {
            $msgResult[] = "Billing was already generated!";
            return $this->response->setStatusCode(401)->setJSON($msgResult);
        }
        
    }


    public function a_loadBillings()
    {
        $arrData = $this->billings->a_loadBillings();
        return $this->response->setJSON($arrData);
    }

    public function a_loadBillingDetails()
    {
        $fields = $this->request->getGet();
        $arrData['arrBillingDetails'] = $this->billings->a_loadBillingDetails($fields['billingId']);
        $arrData['arrBillingList'] = $this->billings->a_loadBillingLists($fields['billingId']);
        return $this->response->setJSON($arrData);
    }








    public function r_loadBillings()
    {
        $repData = $this->employees->selectEmployee($this->session->get('gwc_representative_id'));
        $arrData = $this->billings->r_loadBillings($repData['company_id']);
        return $this->response->setJSON($arrData);
    }

    public function r_selectBilling()
    {
        $fields = $this->request->getGet();
        $arrData['arrBillingDetails'] = $this->billings->r_loadBillingDetails($fields['billingId']);
        $arrData['arrBillingList'] = $this->billings->r_loadBillingLists($fields['billingId']);
        // $arrData['arrPaymentDetails'] = $this->payments->r_loadPaymentDetails($fields['billingId']);
        return $this->response->setJSON($arrData);
    }

}
