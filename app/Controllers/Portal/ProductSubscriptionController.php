<?php

namespace App\Controllers\Portal;

use App\Controllers\BaseController;

class ProductSubscriptionController extends BaseController
{
    public function __construct()
    {
        $this->companies = model('Companies');
        $this->employees = model('Employees');
        $this->products = model('Products');
    }


    public function r_loadProductSubscriptions()
    {
        
    }

    public function r_addProductSubscription()
    {
        $fields = $this->request->getPost();

        $arrData = [
            'product_id'            => $fields['txt_productId'],
            'company_id'            => $fields['txt_companyId'],
            'subscription_status'   => 'Pendding',
            'created_by'            => $this->session->get('gwc_representative_id'),
            'created_date'          => date('Y-m-d H:i:s')
        ];
        
        $result = $this->products->r_addProductSubscription($arrData);
        if($result > 0)
        {
            $msgResult[] = "Product application sent successfully";
        }
        else
        {
            $msgResult[] = "Something went wrong, please try again";
            return $this->response->setStatusCode(401)->setJSON($msgResult);
            exit();
        }

        return $this->response->setJSON($msgResult);
    }




    public function a_loadProductSubscriptions()
    {
        $fields = $this->request->getGet();
        $arrData = $this->products->a_loadProductSubscriptions();
        return $this->response->setJSON($arrData);
    }

    public function a_selectProductSubscription()
    {
        $fields = $this->request->getGet();
        $arrData = $this->products->a_selectProductSubscription($fields['companyId']);
        return $this->response->setJSON($arrData);
    }

    public function a_failedCompanySubscription()
    {
        $fields = $this->request->getPost();

        $arrData = [
            'subscription_status'   => $fields['slc_employeeListStatus'], // Approve | Pending | Resubmit
            'remarks'               => $fields['txt_remarks'],
            'updated_by'            => $this->session->get('gwc_representative_id'),
            'updated_date'          => date('Y-m-d H:i:s')
        ];
        
        $result = $this->companies->a_failedCompanySubscription($arrData, $fields['txt_subscriptionId']);
        if($result > 0)
        {
            // Select Company Representative email
            $arrResult = $this->employees->a_selectCompanyRepresentative($fields['txt_subscriptionId']);

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
            $emailReceiver  = $arrResult['email_address'];

            $data = [
                'subjectTitle' => 'Failed Subscription',
                'emailAddress' => $arrResult['email_address'],
                'remarks'      => $fields['txt_remarks']
            ];

            $emailResult = sendSliceMail('representative_failed_subscription',$emailConfig,$emailSender,$emailReceiver,$data);

            $msgResult[] = "Action complete!";
        }
        else
        {
            $msgResult[] = "Something went wrong, please try again";
            return $this->response->setStatusCode(401)->setJSON($msgResult);
            exit();
        }

        return $this->response->setJSON($msgResult);
    }

    public function a_acceptCompanySubscription()
    {
        $fields = $this->request->getPost();

        $arrData = [
            'subscription_status'   => $fields['slc_employeeListStatus'], // Approve | Pending | Resubmit
            'remarks'               => $fields['txt_remarks'],
            'updated_by'            => $this->session->get('gwc_representative_id'),
            'updated_date'          => date('Y-m-d H:i:s')
        ];
        
        $result = $this->companies->a_acceptCompanySubscription($arrData, $fields['txt_subscriptionId']);
        if($result > 0)
        {
            $arrEmployees = $this->employees->a_loadCompanyEmployees($fields['txt_companyId'],'employee');

            $msgResult = $arrEmployees;
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
