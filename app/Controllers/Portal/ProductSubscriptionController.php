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
        $this->activities = model('Activities');
    }


    public function r_loadProductSubscriptions()
    {
        
    }

    /*
        USED IN:
        - REPRESENTATIVE_FINANCING_PRODUCTS->addFinancingProduct()
    */
    public function r_addProductSubscription()
    {
        $fields = $this->request->getPost();

        $arrData = [
            'product_id'            => $fields['txt_productId'],
            'company_id'            => $fields['txt_companyId'],
            'subscription_status'   => 'PENDING',
            'access_status'         => 'OPEN',
            'created_by'            => $this->session->get('gwc_representative_id'),
            'created_date'          => date('Y-m-d H:i:s')
        ];
        
        $result = $this->products->r_addProductSubscription($arrData);
        if($result > 0)
        {
            $msgResult[] = "Product application sent successfully";

            // for Audit Trail
            $arrData = [
                'user_id' => $this->session->get('gwc_representative_id'),
                'module_name' => 'Product Module',
                'activity_type' => 'Add Product Subscription',
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



    /*
        USED IN: 
        - ADMIN_SALARY_ADVANCE_APPLICATIONS->a_loadProductSubscriptions()
    */
    public function a_loadProductSubscriptions()
    {
        $fields = $this->request->getGet();
        $arrData = $this->products->a_loadProductSubscriptions();
        return $this->response->setJSON($arrData);
    }

    /*
        USED IN: 
        - ADMIN_SALARY_ADVANCE_APPLICATIONS->a_selectProductSubscription()
    */
    public function a_selectProductSubscription()
    {
        $fields = $this->request->getGet();
        $arrData = $this->products->a_selectProductSubscription($fields['companyId']);
        return $this->response->setJSON($arrData);
    }

    /*
        USED IN:
        - ADMIN_SALARY_ADVANCE_APPLICATIONS->a_failedCompanySubscription()
    */
    public function a_failedCompanySubscription()
    {
        $fields = $this->request->getPost();

        $arrData = [
            'subscription_status'   => $fields['slc_employeeListStatus'], // Approve | Pending | Resubmit | Onhold
            'access_status'         => 'OPEN',
            'remarks'               => $fields['txt_remarks'],
            'updated_by'            => $this->session->get('gwc_admin_id'),
            'updated_date'          => date('Y-m-d H:i:s')
        ];
        
        $result = $this->companies->a_failedCompanySubscription($arrData, $fields['txt_subscriptionId']);
        if($result > 0)
        {
            // Select Company Representative email
            $repDetails = $this->employees->a_selectCompanyRepresentative($fields['txt_subscriptionId']);

            $emailConfig = sliceMailConfig();

            $emailSender    = 'loans@goldwatercap.net';
            $emailReceiver  = $repDetails['email_address'];

            $data = [
                'emailName'    => 'GOLDWATER CAPITAL',
                'subjectTitle' => 'Failed Subscription',
                'emailAddress' => $repDetails['email_address'],
                'remarks'      => $fields['txt_remarks']
            ];

            $emailResult = sendSliceMail('representative_failed_subscription',$emailConfig,$emailSender,$emailReceiver,$data);

            $msgResult[] = "Action complete!";

            // for Audit Trail
            $arrData = [
                'user_id' => $this->session->get('gwc_admin_id'),
                'module_name' => 'Product Module',
                'activity_type' => 'Failed Company Subscription',
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

    /*
        USED IN:
        - ADMIN_SALARY_ADVANCE_APPLICATIONS->a_acceptCompanySubscription()
    */
    public function a_acceptCompanySubscription()
    {
        $fields = $this->request->getPost();

        $arrData = [
            'company_credit_limit'  => $fields['txt_companyCreditLimit'],
            'subscription_status'   => $fields['slc_employeeListStatus'], // Approve | Pending | Resubmit | Onhold
            'access_status'         => "CLOSE",
            'remarks'               => $fields['txt_remarks'],
            'updated_by'            => $this->session->get('gwc_admin_id'),
            'updated_date'          => date('Y-m-d H:i:s')
        ];
        
        $result = $this->companies->a_acceptCompanySubscription($arrData, $fields['txt_subscriptionId']);
        if($result > 0)
        {
            $repDetails = $this->employees->a_selectCompanyRepresentative($fields['txt_subscriptionId']);

            $emailConfig = sliceMailConfig();

            $emailSender    = 'loans@goldwatercap.net';
            $emailReceiver  = $repDetails['email_address'];

            $data = [
                'emailName'    => 'GOLDWATER CAPITAL',
                'subjectTitle' => 'SweldoNow Subscription Successful',
                'emailAddress' => $repDetails['email_address'],
                'remarks'      => $fields['txt_remarks']
            ];

            $emailResult = sendSliceMail('representative_accept_subscription',$emailConfig,$emailSender,$emailReceiver,$data);

            if($emailResult == true)
            {
                $arrEmployees = $this->employees->a_loadCompanyEmployees($fields['txt_companyId'],'employee');
                $msgResult = $arrEmployees;
            }

            // for Audit Trail
            $arrData = [
                'user_id' => $this->session->get('gwc_admin_id'),
                'module_name' => 'Product Module',
                'activity_type' => 'Accept Company Subscription',
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

    /*
        USED IN:
        - REPRESENTATIVE_EMPLOYEE_LIST->r_submitAccessRequest
    */
    public function r_submitAccessRequest()
    {
        $fields = $this->request->getPost();

        $arrData = [
            'access_request'        => 1,
            'remarks'               => $fields['txt_requestForUpdateRemarks'],
            'updated_by'            => $this->session->get('gwc_representative_id'),
            'updated_date'          => date('Y-m-d H:i:s')
        ];

        $result = $this->products->r_submitAccessRequest($arrData, $fields['txt_companyId']);
        if($result > 0)
        {
            $msgResult[] = "Request Sent!";

            // for Audit Trail
            $arrData = [
                'user_id' => $this->session->get('gwc_representative_id'),
                'module_name' => 'Employees Module',
                'activity_type' => 'Submit Access Request',
                'activity_details' => '',
                'created_date' => date('Y-m-d H:i:s')
            ];
            $this->activities->addUserActivity($arrData);

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

    /*
        USED IN:
        - ADMIN_SALARY_ADVANCE_APPLICATIONS->a_selectProductSubscriptionStatus()
    */
    public function a_selectProductSubscriptionStatus()
    {
        $fields = $this->request->getGet();
        $arrData = $this->products->a_selectProductSubscriptionStatus($fields['companyId']);
        return $this->response->setJSON($arrData);
    }

    /*
        USED IN:
        - ADMIN_SALARY_ADVANCE_APPLICATIONS->a_editProductSubscriptionStatus()
    */
    public function a_editProductSubscriptionStatus()
    {
        $fields = $this->request->getPost();

        $arrData = [
            'access_status'         => "OPEN",
            'access_request'        => 0,
            'remarks'               => "",
            'updated_by'            => $this->session->get('gwc_admin_id'),
            'updated_date'          => date('Y-m-d H:i:s')
        ];

        $result = $this->products->a_editProductSubscriptionStatus($arrData, $fields['txt_companyId']);
        if($result > 0)
        {
            $msgResult[] = "Access Status Changed!";

            // for Audit Trail
            $arrData = [
                'user_id' => $this->session->get('gwc_admin_id'),
                'module_name' => 'Products Module',
                'activity_type' => 'Update Product Subscription Status',
                'activity_details' => '',
                'created_date' => date('Y-m-d H:i:s')
            ];
            $this->activities->addUserActivity($arrData);

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
