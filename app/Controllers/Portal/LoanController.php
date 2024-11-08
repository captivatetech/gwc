<?php

namespace App\Controllers\Portal;

use App\Controllers\BaseController;

use Xendit\Configuration;
use Xendit\Payout\PayoutApi;
use Xendit\Payout\CreatePayoutRequest;
use Xendit\BalanceAndTransaction\BalanceApi;

use zsign\OAuth;
use zsign\ZohoSign;
use zsign\SignException;
use zsign\api\Fields;
use zsign\api\Actions;
use zsign\api\RequestObject;
use zsign\api\fields\ImageField;

class LoanController extends BaseController
{
    public function __construct()
    {
        $this->companies = model('Companies');
        $this->employees = model('Employees');
        $this->loans = model('Loans');
    }

    private function _generateApplicationNumber($companyCode)
    {
        $arrResult = $this->loans->getLastApplicationNumber();

        if($arrResult == null)
        {
            $applicationNumber = "SA:".$companyCode."-".date('Y')."00001";
        }
        else
        {
            $year = substr($arrResult['application_number'], 11, 4);
            $series = substr($arrResult['application_number'], 15);

            if($year != date('Y'))
            {
                $applicationNumber = "SA:".$companyCode."-".date('Y').'00001';
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
                $applicationNumber = "SA:".$companyCode."-".$strSeries;
            }
        }

        return $applicationNumber;
    }

    public function e_submitSalaryAdvanceApplication()
    {
        try{

            $userData = $this->employees->selectEmployee($this->session->get('gwc_employee_id'));
            $companyData = $this->companies->selectCompany($userData['company_id']);
            $representativeData = $this->employees->a_selectRepresentative($userData['company_id']);

            $fields = $this->request->getPost();

            $loanAmount = (float)$fields['loanAmount'];
            $interestRate = (float)$fields['interestRate'];
            $paymentTerms = $fields['paymentTerms'];

            $amountToReceive = $loanAmount - 300;
            $totalInterest = ($interestRate / 100) * $loanAmount;
            $totalLoan = $loanAmount + $totalInterest;

            $numberOfDeductions = ((int)substr($paymentTerms,0,1)) * 2;
            $monthlyDues = $totalLoan / (int)substr($paymentTerms, 0, 1);
            $deductionPerCutoff = $totalLoan / $numberOfDeductions;

            $user = new OAuth( array(
                OAuth::CLIENT_ID    => "1000.VOJVM3LCCCE95VPJVWD2LJS3JET2KW",
                OAuth::CLIENT_SECRET=> "d8995d279be0e05e84ec9abe206fc55e2e2d7cdb36",
                OAuth::DC           => "COM",
                OAuth::REFRESH_TOKEN=> "1000.57d4da049833cbca42eb06e03529dce0.3d6fe947327718a77da41d5bf87da0d2"
            ) );

            ZohoSign::setCurrentUser( $user );
            $user->generateAccessTokenUsingRefreshToken();
            $access_token = $user->getAccessToken();

            $template = ZohoSign::getTemplate( 418013000000095065 );

            $template->setRequestName("May Sample API Test");
            $template->setNotes("Call us back if you need clarificaions regarding agreement");

            $template->setPrefillTextField( "txt_f1",  "-" );
            $template->setPrefillTextField( "txt_f2",  "-" );
            $template->setPrefillTextField( "txt_f3",  "-" );
            $template->setPrefillTextField( "txt_f4",  "-" );
            $template->setPrefillTextField( "txt_f5",  "-" );
            $template->setPrefillTextField( "txt_f6",  "-" );
            $template->setPrefillTextField( "txt_f7",  "-" );
            $template->setPrefillTextField( "txt_f8",  "-" );
            $template->setPrefillTextField( "txt_f9",  "-" );
            $template->setPrefillTextField( "txt_f10",  "-" );
            $template->setPrefillTextField( "txt_f11",  "-" );
            $template->setPrefillTextField( "txt_f12",  "-" );
            $template->setPrefillTextField( "txt_f13",  "-" );
            $template->setPrefillTextField( "txt_f14",  "-" );
            $template->setPrefillTextField( "txt_f15",  "-" );
            $template->setPrefillTextField( "txt_f16",  "-" );
            $template->setPrefillTextField( "txt_f17",  "-" );
            $template->setPrefillTextField( "txt_f18",  "-" );
            $template->setPrefillTextField( "txt_f19",  "-" );
            $template->setPrefillTextField( "txt_f20",  "-" );
            $template->setPrefillTextField( "txt_f21",  "-" );
            $template->setPrefillTextField( "txt_f22",  "-" );
            $template->setPrefillTextField( "txt_f23",  "-" );
            $template->setPrefillTextField( "txt_f24",  "-" );
            $template->setPrefillTextField( "txt_f25",  "-" );
            $template->setPrefillTextField( "txt_f26",  "-" );
            $template->setPrefillTextField( "txt_f27",  "-" );
            $template->setPrefillTextField( "txt_f28",  "-" );
        
            $employeeName = $userData['first_name'] . " " . $userData['last_name'];
            $template->getActionByRole("Recepient1")->setRecipientName($employeeName);
            $template->getActionByRole("Recepient1")->setRecipientEmail($userData['email_address']);
            $template->setPrefillTextField( "txt_employeeName1",  $employeeName );

            $representativeName = $representativeData['first_name'] . " " . $representativeData['last_name'];
            $template->getActionByRole("Recepient2")->setRecipientName($representativeName);
            $template->getActionByRole("Recepient2")->setRecipientEmail($representativeData['email_address']);
            $template->setPrefillTextField( "txt_representativeName1",  $representativeName );

            $template->getActionByRole("Recepient3")->setRecipientName("GWC Admin");
            $template->getActionByRole("Recepient3")->setRecipientEmail("ajhay.life@gmail.com");
            $template->setPrefillTextField( "txt_lenderName1",  "GWC Admin" );


            $template->setPrefillTextField( "txt_accountName", "-");
            $template->setPrefillTextField( "txt_accountNumber", "-");
            $template->setPrefillTextField( "txt_interestRate", "-");
            $template->setPrefillTextField( "txt_promisoryNote", "-");

            $template->setPrefillTextField( "txt_maStartDate", "-");
            $template->setPrefillTextField( "txt_maEndDate", "-");

            $template->setPrefillTextField( "txt_dst", "-");
            $template->setPrefillTextField( "txt_insurance", "-");
            $template->setPrefillTextField( "txt_notarialFees", "-");
            $template->setPrefillTextField( "txt_otherAdminFees", "-");

            $arrPaymentDate = [
                '10-Oct-24',
                '25-Oct-24',
                '10-Nov-24',
                '25-Nov-24',
                '10-Dec-24',
                '25-Dec-24'
            ];
            $series = 0;
            for ($i=0; $i < 16; $i++) 
            { 
                $paymentDate = null;
                for ($x=0; $x < count($arrPaymentDate); $x++) 
                { 
                    if(isset($arrPaymentDate[$i]))
                    {
                        $paymentDate = $arrPaymentDate[$i];
                    }
                }
                $series = $i+1;
                if($paymentDate != null)
                {
                    $template->setPrefillTextField( "txt_paymentDate$series", $paymentDate);
                }
                else
                {
                    $template->setPrefillTextField( "txt_paymentDate$series", "-");
                }
            }

            $arrAmount = [
                933.09,
                933.09,
                933.09,
                933.09,
                933.09,
                933.09
            ];
            $series = 0;
            for ($i=0; $i < 16; $i++) 
            { 
                $amount = null;
                for ($x=0; $x < count($arrAmount); $x++) 
                { 
                    if(isset($arrAmount[$i]))
                    {
                        $amount = number_format((int)$arrAmount[$i], 2, '.', ',');
                    }
                }
                $series = $i+1;
                if($amount != null)
                {
                    $template->setPrefillTextField( "txt_amount$series", $amount);
                }
                else
                {
                    $template->setPrefillTextField( "txt_amount$series", "-");
                }
            }

            $arrt1Balance = [
                4665.41,
                3732.32,
                2799.23,
                1866.14,
                933.05,
                0.04
            ];
            $series = 0;
            for ($i=0; $i < 16; $i++) 
            { 
                $t1Balance = null;
                for ($x=0; $x < count($arrt1Balance); $x++) 
                { 
                    if(isset($arrt1Balance[$i]))
                    {
                        $t1Balance = number_format((int)$arrt1Balance[$i], 2, '.', ',');
                    }
                }
                $series = $i+1;
                if($t1Balance != null)
                {
                    $template->setPrefillTextField( "txt_t1bal$series", $t1Balance);
                }
                else
                {
                    $template->setPrefillTextField( "txt_t1bal$series", "-");
                }
            }

            $arrMonth = [
                'OCTOBER',
                'NOVEMBER',
                'DECEMBER'
            ];
            $series = 0;
            for ($i=0; $i < 16; $i++) 
            { 
                $month = null;
                for ($x=0; $x < count($arrMonth); $x++) 
                { 
                    if(isset($arrMonth[$i]))
                    {
                        $month = $arrMonth[$i];
                    }
                }
                $series = $i+1;
                if($month != null)
                {
                    $template->setPrefillTextField( "txt_month$series", $month);
                }
                else
                {
                    $template->setPrefillTextField( "txt_month$series", "-");
                }
            }

            $arrAmortization = [
                1866.17,
                1866.17,
                1866.17
            ];
            $series = 0;
            for ($i=0; $i < 16; $i++) 
            { 
                $amort = null;
                for ($x=0; $x < count($arrAmortization); $x++) 
                { 
                    if(isset($arrAmortization[$i]))
                    {
                        $amort = number_format((int)$arrAmortization[$i], 2, '.', ',');
                    }
                }
                $series = $i+1;
                if($amort != null)
                {
                    $template->setPrefillTextField( "txt_amort$series", $amort);
                }
                else
                {
                    $template->setPrefillTextField( "txt_amort$series", "-");
                }
            }

            $arrt2Balance = [
                3732.33,
                1866.16,
                0.01
            ];
            $series = 0;
            for ($i=0; $i < 16; $i++) 
            { 
                $t2Balance = null;
                for ($x=0; $x < count($arrt2Balance); $x++) 
                { 
                    if(isset($arrt2Balance[$i]))
                    {
                        $t2Balance = number_format((int)$arrt2Balance[$i], 2, '.', ',');
                    }
                }
                $series = $i+1;
                if($t2Balance != null)
                {
                    $template->setPrefillTextField( "txt_t2bal$series", $t2Balance);
                }
                else
                {
                    $template->setPrefillTextField( "txt_t2bal$series", "-");
                }
            }

            $template->setPrefillTextField( "txt_employeeName2", "-");
            $template->setPrefillTextField( "txt_representativeName2", "-");
            $template->setPrefillTextField( "txt_lenderName2", "-");
        
            $resp_obj = ZohoSign::sendTemplate( $template, true );

            if($resp_obj->getRequestId() != null)
            {
                $arrData = [
                    'company_id'            => $userData['company_id'],
                    'employee_id'           => $userData['id'],
                    'product_id'            => 1,
                    'request_id'            => $resp_obj->getRequestId(),
                    'application_number'    => $this->_generateApplicationNumber($companyData['company_code']),
                    'loan_amount'           => $loanAmount,
                    'amount_to_receive'     => $amountToReceive,
                    'total_interest'        => $totalInterest,
                    'payment_terms'         => $paymentTerms,
                    'number_of_deductions'  => $numberOfDeductions,
                    'monthly_dues'          => (float)number_format($monthlyDues, 2, '.', ','),
                    'deduction_per_cutoff'  => (float)number_format($deductionPerCutoff, 2, '.', ','),
                    'purpose_of_loan'       => $fields['purposeOfLoan'],
                    'application_status'    => 'PENDING', 
                    'loan_status'           => 'PENDING',
                    'created_by'            => $this->session->get('gwc_employee_id'),
                    'created_date'          => date('Y-m-d H:i:s')
                ];

                $result = $this->loans->e_submitSalaryAdvanceApplication($arrData);
                if($result > 0)
                {

                    $arrData = [
                        'employee_id'       => $this->session->get('gwc_employee_id'),
                        'answer'            => $fields['answers'],
                        'persona'           => $fields['persona'],
                        'total_score'       => $fields['totalScore'],
                        'assessment_status' => '1',
                        'created_by'        => $this->session->get('gwc_employee_id'),
                        'created_date'      => date('Y-m-d H:i:s')
                    ];

                    $this->employees->e_addEmployeeAssessment($arrData);

                    $msgResult[] = "Loan Application Complete!";
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
        }catch( SignException $signEx ){
            // log it
            echo "SIGN EXCEPTION : ".$signEx;
        }catch( Exception $ex ){
            // handle it
            print_r($ex);
            exit();
        }        
    }

    public function e_loadDashboardDetails()
    {
        $arrData = $this->loans->e_loadDashboardDetails($this->session->get('gwc_employee_id'));
        return $this->response->setJSON($arrData);
    }

    public function r_loadSalaryAdvanceApplications()
    {
        $userData = $this->employees->selectEmployee($this->session->get('gwc_representative_id'));
        $arrResult = $this->loans->r_loadSalaryAdvanceApplications($userData['company_id']);
        return $this->response->setJSON($arrResult);
    }

    public function r_selectLoanApplicationDetails()
    {
        try{
            $fields = $this->request->getGet();
            $arrResult = $this->loans->r_selectLoanApplicationDetails($fields['loanId']);

            /*********
                STEP 1 : Set user credentials
            **********/

            $user = new OAuth( array(
                OAuth::CLIENT_ID    => "1000.VOJVM3LCCCE95VPJVWD2LJS3JET2KW",
                OAuth::CLIENT_SECRET=> "d8995d279be0e05e84ec9abe206fc55e2e2d7cdb36",
                OAuth::DC           => "COM",
                OAuth::REFRESH_TOKEN=> "1000.57d4da049833cbca42eb06e03529dce0.3d6fe947327718a77da41d5bf87da0d2"
            ) );

            ZohoSign::setCurrentUser( $user );
            $user->generateAccessTokenUsingRefreshToken();
            $access_token = $user->getAccessToken();

            /*********
            STEP 2 : Get particular document details
            **********/

            $req_obj = ZohoSign::getRequest( $arrResult['request_id'] ); // enter valid "request_id"
            $arrResult['employee_action_status'] = $req_obj->getActions()[0]->getActionStatus();
            $arrResult['representative_action_status'] = $req_obj->getActions()[1]->getActionStatus();
            $arrResult['admin_action_status'] = $req_obj->getActions()[2]->getActionStatus();

            return $this->response->setJSON($arrResult);
            
        }catch( SignException $signEx ){
            // log it
            echo "SIGN EXCEPTION : ".$signEx;
        }catch( Exception $ex ){
            // handle it
        }
    }

    public function r_submitSalaryAdvanceApplication()
    {
        $fields = $this->request->getPost();

        $arrData = [
            'application_status'    => 'PROCESSING',
            'updated_by'            => $this->session->get('gwc_representative_id'),
            'updated_date'          => date('Y-m-d H:i:s')
        ];

        $result = $this->loans->r_submitSalaryAdvanceApplication($arrData, $fields['loanId']);
        if($result > 0)
        {
            $msgResult[] = "Salary Loan Application Submitted!";
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

    public function e_loadLoanAccounts()
    {
        $arrResult = $this->loans->e_loadLoanAccounts($this->session->get('gwc_employee_id'));
        return $this->response->setJSON($arrResult);
    }

    public function a_loadApplications()
    {
        $fields = $this->request->getGet();
        $arrResult = $this->loans->a_loadApplications();
        return $this->response->setJSON($arrResult);
    }

    public function a_selectApplication()
    {
        try{
            $fields = $this->request->getGet();
            $arrResult = $this->loans->a_selectApplication($fields['loanId']);

            /*********
                STEP 1 : Set user credentials
            **********/

            $user = new OAuth( array(
                OAuth::CLIENT_ID    => "1000.VOJVM3LCCCE95VPJVWD2LJS3JET2KW",
                OAuth::CLIENT_SECRET=> "d8995d279be0e05e84ec9abe206fc55e2e2d7cdb36",
                OAuth::DC           => "COM",
                OAuth::REFRESH_TOKEN=> "1000.57d4da049833cbca42eb06e03529dce0.3d6fe947327718a77da41d5bf87da0d2"
            ) );

            ZohoSign::setCurrentUser( $user );
            $user->generateAccessTokenUsingRefreshToken();
            $access_token = $user->getAccessToken();

            /*********
            STEP 2 : Get particular document details
            **********/

            $req_obj = ZohoSign::getRequest( $arrResult['request_id'] ); // enter valid "request_id"
            $arrResult['employee_action_status'] = $req_obj->getActions()[0]->getActionStatus();
            $arrResult['representative_action_status'] = $req_obj->getActions()[1]->getActionStatus();
            $arrResult['admin_action_status'] = $req_obj->getActions()[2]->getActionStatus();

            return $this->response->setJSON($arrResult);
            
        }catch( SignException $signEx ){
            // log it
            echo "SIGN EXCEPTION : ".$signEx;
        }catch( Exception $ex ){
            // handle it
        }
    }

    public function a_approveApplication()
    {
        $fields = $this->request->getPost();

        $accountNumber= date('Ymd').time();

        $arrData = [
            'account_number'        => $accountNumber,
            'application_status'    => 'APPROVED',
            'disbursement_status'   => 'PENDING',
            'updated_by'            => $this->session->get('gwc_admin_id'),
            'updated_date'          => date('Y-m-d H:i:s')
        ];

        $result = $this->loans->a_approveApplication($arrData, $fields['loanId']);
        if($result > 0)
        {
            $msgResult[] = "Salary Loan Application Approved!";
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

    public function a_rejectApplication()
    {
        $fields = $this->request->getPost();

        $arrData = [
            'application_status'    => 'REJECTED',
            'updated_by'            => $this->session->get('gwc_admin_id'),
            'updated_date'          => date('Y-m-d H:i:s')
        ];

        $result = $this->loans->a_rejectApplication($arrData, $fields['loanId']);
        if($result > 0)
        {
            $msgResult[] = "Salary Loan Application Rejected!";
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


    public function a_loadSalaryAdvanceAccounts()
    {
        $fields = $this->request->getGet();
        $arrResult = $this->loans->a_loadSalaryAdvanceAccounts();
        return $this->response->setJSON($arrResult);
    }

    public function a_loadDisbursementLists()
    {
        $fields = $this->request->getGet();
        $arrResult = $this->loans->a_loadDisbursementLists($fields['company_id']);
        return $this->response->setJSON($arrResult);
    }

    public function a_loadAccountBalance()
    {
        $xenditPrivateKey = getenv('xendit_private_key');
        Configuration::setXenditKey($xenditPrivateKey);

        $apiInstance = new BalanceApi();
        $accountType = "CASH"; // string | The selected balance type
        $currency = "PHP"; // string | Currency for filter for customers with multi currency accounts
        $currentDate = date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s') . ' +1 day'));
        $atTimestamp = str_replace(' ', 'T', $currentDate) . ".000Z"; // \DateTime | The timestamp you want to use as the limit for balance retrieval
        $xenditUserId = getenv('xendit_user_id'); // string | The sub-account user-id that you want to make this transaction for. This header is only used if you have access to xenPlatform. See xenPlatform for more information

        try {
            $result = $apiInstance->getBalance($accountType, $currency, $atTimestamp, $xenditUserId);
            return $this->response->setJSON($result);
        } catch (\Xendit\XenditSdkException $e) {
            echo 'Exception when calling BalanceApi->getBalance: ', $e->getMessage(), PHP_EOL;
            echo 'Full Error: ', json_encode($e->getFullError()), PHP_EOL;
        }
    }

    public function a_downloadDisbursementList()
    {
        
    }

    public function a_proceedDisbursement()
    {
        $fields = $this->request->getPost();

        $loanId = $fields['loanId'];

        $arrResult = $this->loans->a_selectLoanForDisbursement($loanId);

        $xenditPrivateKey = getenv('xendit_private_key');
        Configuration::setXenditKey($xenditPrivateKey);

        $idempotencyKey = "DISB-".date('Ymd').time(); 
        $xenditUserId = getenv('xendit_user_id');

        $apiInstance = new PayoutApi();
        $referenceNumber = "RFN-".date('Ymd').time();

        $channelCode = $arrResult['bank_depository'];

        $createPayoutRequest = new CreatePayoutRequest([
            'reference_id' => $referenceNumber,
            'currency' => 'PHP',
            'channel_code' => $channelCode,
            'channel_properties' => [
                'account_holder_name' => $arrResult['first_name'] . " " . $arrResult['last_name'],
                'account_number' => $arrResult['payroll_bank_number']
            ],
            'amount' => (float)$arrResult['amount_to_receive'],
            'description' => 'Disbursement',
            'type' => 'DIRECT_DISBURSEMENT'
        ]); 

        try {
            $apiResult = $apiInstance->createPayout($idempotencyKey, $xenditUserId, $createPayoutRequest);
            if(isset($apiResult['status']))
            {
                $arrData = [
                    'loan_id'               => $loanId,
                    'idempotency_key'       => $idempotencyKey,
                    'reference_number'      => $referenceNumber,
                    'currency'              => 'PHP',
                    'channel_code'          => $channelCode,
                    'account_holder_name'   => $arrResult['first_name'] . " " . $arrResult['last_name'],
                    'account_number'        => $arrResult['payroll_bank_number'],
                    'amount'                => (float)$arrResult['amount_to_receive'],
                    'description'           => 'Test Bank Payout',
                    'disbursement_type'     => 'DIRECT_DISBURSEMENT',
                    'disbursement_status'   => $apiResult['status'],
                    'created_by'            => $this->session->get('gwc_admin_id'),
                    'created_date'          => date('Y-m-d H:i:s')
                ];

                $result = $this->loans->a_proceedDisbursement($arrData);
                if($result > 0)
                {
                    if($apiResult['status'] == 'ACCEPTED')
                    {
                        $arrCompanyData = $this->companies->a_selectCompanySettings($arrResult['company_id']);

                        $payDate1 = $arrCompanyData['payroll_payout_date1'];
                        $payDate2 = $arrCompanyData['payroll_payout_date2'];

                        $payrollDate1 = date("Y-m-{$payDate1}");
                        $payrollDate2 = date("Y-m-{$payDate2}");

                        $arrDisbursementDate1 = [];
                        $arrDisbursementDate2 = [];

                        for ($i=0; $i < 15; $i++) 
                        { 
                            $arrDisbursementDate1[] = date('d', strtotime($payrollDate1."- {$i} days"));
                            $arrDisbursementDate2[] = date('d', strtotime($payrollDate2."- {$i} days"));
                        }

                        $disbursementDate = date("d");
                        $billingDateStart = "";

                        if(in_array(date('d', strtotime(date("Y-m-d"))), $arrDisbursementDate1))
                        {
                            $billingDate1 = date('d', strtotime($payrollDate1."+ 5 days"));
                            $billingDateStart = date('Y-m-d', strtotime($payrollDate1."+ 5 days"));
                        }

                        if(in_array(date('d', strtotime(date("Y-m-d"))), $arrDisbursementDate2))
                        {
                            $billingDate1 = date('d', strtotime($payrollDate2."+ 5 days"));
                            $billingDateStart = date('Y-m-d', strtotime($payrollDate2."+ 5 days"));
                        }

                        $billingDate2 = date('d', strtotime(date("Y-m-".$billingDate1)."+ 15 days"));

                        $arr = [
                            'disbursement_status' => 'ACCEPTED',
                            'loan_status'         => 'ACTIVE',
                            'disbursement_date'   => $disbursementDate,
                            'billing_date_1'      => $billingDate1,
                            'billing_date_2'      => $billingDate2
                        ];
                        $this->loans->a_updateDisbursementStatus($arr, $loanId);

                        $emailConfig = [
                            'smtp_host'    => 'smtppro.zoho.com',
                            'smtp_port'    => 587,
                            'smtp_crypto'  => 'tls',
                            'smtp_user'    => 'loans@goldwatercap.net',
                            'smtp_pass'    => 'sFkhLq2Ka9wm',
                            'mail_type'    => 'html',
                            'charset'      => 'iso-8859-1',
                            'word_wrap'    => true
                        ];

                        $arrEmployeeDetails = $this->employees->a_selectEmployee($arrResult['employee_id']);

                        $emailSender    = 'loans@goldwatercap.net';
                        $emailReceiver  = $arrEmployeeDetails['email_address'];

                        $data = [
                            'emailName'         => 'GOLDWATER CAPITAL',
                            'subjectTitle'      => 'Disbursement',
                            'disbursemntAmount' => number_format($arrData['amount'],2,'.',','),
                            'bankAccount'       => $arrData['account_number'],
                            'dateAndTime'       => date('Y-m-d H:i:s'),
                            'billingDate'       => $billingDateStart
                        ];
                        sendSliceMail('employee_disbursement_email',$emailConfig,$emailSender,$emailReceiver,$data);

                        // $arrRepresentativeDetails = $this->employees->a_selectRepresentative($arrResult['company_id']);
                        // $emailSender    = 'ajhay.dev@gmail.com';
                        // $emailReceiver  = $arrRepresentativeDetails['email_address'];
                        // $data = [
                        //     'subjectTitle'  => 'Disbursement',
                        //     'emailAddress'  => '',
                        //     'authCode'      => ''
                        // ];
                        // sendSliceMail('representative_disbursement_email',$emailConfig,$emailSender,$emailReceiver,$data);
                    }

                    $msgResult[] = "Loan Disbursement Complete";
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
        } catch (\Xendit\XenditSdkException $e) {
            echo 'Exception when calling PayoutApi->createPayout: ', $e->getMessage(), PHP_EOL;
            echo 'Full Error: ', json_encode($e->getFullError()), PHP_EOL;
        }

        

        return $this->response->setJSON($arrResult);
    }

}
