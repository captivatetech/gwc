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

            // $loanDetails = $this->loans->e_selectLoanAccount($this->session->get('gwc_employee_id'));
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

            $template->setPrefillTextField( "txt_f1",  date('F d, Y') );
            $template->setPrefillTextField( "txt_f2",  "Nueva Ecija" );
            $template->setPrefillTextField( "txt_f3",  $companyData['company_name'] );
            $template->setPrefillTextField( "txt_f4",  $companyData['company_address'] );

            $representativeName = $representativeData['first_name'] . " " . $representativeData['last_name'];
            $template->setPrefillTextField( "txt_f5",  $representativeName );

            $employeeName = $userData['first_name'] . " " . $userData['last_name'];
            $template->setPrefillTextField( "txt_f6",  $employeeName );
            $template->setPrefillTextField( "txt_f7",  $userData['permanent_address'] );
            $template->setPrefillTextField( "txt_f8",  "FINANCE" );

            $strLoanAmount = number_format($loanAmount, 2, ".", ",");
            $template->setPrefillTextField( "txt_f9",   "Php $strLoanAmount");
            $template->setPrefillTextField( "txt_f10",  numbersToWords($loanAmount) );
            $template->setPrefillTextField( "txt_f11",  $paymentTerms );
            $template->setPrefillTextField( "txt_f12",  "$interestRate%" );

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


            $template->setPrefillTextField( "txt_accountName", $employeeName );
            $template->setPrefillTextField( "txt_accountNumber", "-" );
            $template->setPrefillTextField( "txt_interestRate", "$interestRate%" );
            $template->setPrefillTextField( "txt_promisoryNote", "-" );

            $template->setPrefillTextField( "txt_maStartDate", "-" );
            $template->setPrefillTextField( "txt_maEndDate", "-" );

            $template->setPrefillTextField( "txt_dst", "-" );
            $template->setPrefillTextField( "txt_insurance", "-" );
            $template->setPrefillTextField( "txt_notarialFees", "-" );
            $template->setPrefillTextField( "txt_otherAdminFees", "-" );

            $t1Balance = $totalLoan;
            $series = 0;
            for ($i=0; $i < 16; $i++) 
            { 
                $paymentNumber = 0;
                for ($x=0; $x < $numberOfDeductions; $x++) 
                { 
                    if($i == $x)
                    {
                        $paymentNumber = $x+1;
                        $t1Balance -= $deductionPerCutoff;
                    }
                }
                $series = $i+1;
                if($paymentNumber != 0)
                {
                    $template->setPrefillTextField( "txt_paymentDate$series", "Payment $series" );
                    $template->setPrefillTextField( "txt_amount$series", number_format($deductionPerCutoff,2,",",".") );
                    $template->setPrefillTextField( "txt_t1bal$series", number_format($t1Balance,2,",",".") );
                }
                else
                {
                    $template->setPrefillTextField( "txt_paymentDate$series", "-" );
                    $template->setPrefillTextField( "txt_amount$series", "-" );
                    $template->setPrefillTextField( "txt_t1bal$series", "-" );
                }
            }

            $t2Balance = $totalLoan;
            $series = 0;
            for ($i=0; $i < 16; $i++) 
            { 
                $monthNumber = 0;
                for ($x=0; $x < (int)substr($paymentTerms,0,1); $x++) 
                { 
                    if($i == $x)
                    {
                        $monthNumber = $x+1;
                        $t2Balance -= $monthlyDues;
                    }
                }
                $series = $i+1;
                if($monthNumber != 0)
                {
                    $template->setPrefillTextField( "txt_month$series", "Month $series" );
                    $template->setPrefillTextField( "txt_amort$series", number_format($monthlyDues,2,",",".") );
                    $template->setPrefillTextField( "txt_t2bal$series", number_format($t2Balance,2,",",".") );
                }
                else
                {
                    $template->setPrefillTextField( "txt_month$series", "-" );
                    $template->setPrefillTextField( "txt_amort$series", "-" );
                    $template->setPrefillTextField( "txt_t2bal$series", "-" );
                }
            }

            $template->setPrefillTextField( "txt_employeeName2", $employeeName );
            $template->setPrefillTextField( "txt_representativeName2", $representativeName );
            $template->setPrefillTextField( "txt_lenderName2", "GWC Admin" );
        
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
                    'interest_rate'         => $interestRate,
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

        $arrData['maStartDate'] = $arrData['first_due_date'];

        $month1 = date('m', strtotime(date($arrData['first_due_date'])));
        $year1 = date('Y', strtotime(date($arrData['first_due_date'])));
        $firstDueDate = date($arrData['first_due_date']);

        $month2 = date('m', strtotime(date($arrData['second_due_date'])));
        $year2 = date('Y', strtotime(date($arrData['second_due_date'])));
        $secondDueDate = date($arrData['second_due_date']);

        $dueDate1 = date('Y-m-d', strtotime($firstDueDate));
        $dueMonth = date("F $year1", strtotime($firstDueDate));
        $newData['loanPaymentDates'][] = $dueDate1;

        $dueDate2 = date('Y-m-d', strtotime($secondDueDate));
        $dueMonth = date("F $year2", strtotime($secondDueDate));
        $newData['loanPaymentDates'][] = $dueDate2;

        $newData['loanPaymentMonths'][] = $dueMonth;
        $maEndDate = null;
        for($i=0; $i < (int)$arrData['payment_terms'] - 1; $i++)
        {
            if($month1 < 12)
            {
                $month1++;
            }
            else
            {
                $month1 = 1;
                $year1  += 1;
            }
            
            $dd1 = date("$year1-$month1-d", strtotime($firstDueDate));
            $dueDate1 = date('Y-m-d', strtotime($dd1));
            $dueMonth = date("F $year1", strtotime($dueDate1));
            $newData['loanPaymentDates'][] = $dueDate1;

            if($month2 < 12)
            {
                $month2++;
            }
            else
            {
                $month2 = 1;
                $year2  += 1;
            }

            $dd2 = date("$year2-$month2-d", strtotime($secondDueDate));
            $dueDate2 = date('Y-m-d', strtotime($dd2));
            $dueMonth = date("F $year2", strtotime($dueDate2));
            $newData['loanPaymentDates'][] = $dueDate2;
            $maEndDate = $dueDate2;

            $newData['loanPaymentMonths'][] = $dueMonth;
        }

        $arrData['maEndDate'] = $maEndDate;
        $newData['loanDetails'] = $arrData;
        return $this->response->setJSON($newData);
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

                        $disbursementDate = date("Y-m-d");
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

                        $billingDateOne = date('Y-m-d', strtotime(date("Y-m-".$billingDate1)."+ 15 days"));
                        $dueDateOne = date('Y-m-d', strtotime(date($billingDateOne). '+ 15 days'));

                        $billingDateTwo = date('Y-m-d', strtotime(date("Y-m-".$billingDate2)."+ 15 days"));
                        $dueDateTwo = date('Y-m-d', strtotime(date($billingDateTwo). '+ 15 days'));

                        $arr = [
                            'disbursement_status'   => 'ACCEPTED',
                            'loan_status'           => 'ACTIVE',
                            'disbursement_date'     => $disbursementDate,
                            'billing_date_1'        => $billingDate1,
                            'billing_date_2'        => $billingDate2,
                            'first_billing_date'    => $billingDateOne,
                            'second_billing_date'   => $billingDateTwo,
                            'first_due_date'        => $dueDateOne,
                            'second_due_date'       => $dueDateTwo
                        ];
                        $this->loans->a_updateDisbursementStatus($arr, $loanId);

                        $emailConfig = sliceMailConfig();

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

                        $maStartDate = $dueDateOne;

                        $month1 = date('m', strtotime(date($dueDateOne)));
                        $year1 = date('Y', strtotime(date($dueDateOne)));
                        $firstDueDate = date($dueDateOne);

                        $month2 = date('m', strtotime(date($dueDateTwo)));
                        $year2 = date('Y', strtotime(date($dueDateTwo)));
                        $secondDueDate = date($dueDateTwo);

                        $dueDate1 = date('Y-m-d', strtotime($firstDueDate));
                        $dueDate2 = date('Y-m-d', strtotime($secondDueDate));

                        $maEndDate = null;
                        for($i=0; $i < (int)$arrResult['payment_terms'] - 1; $i++)
                        {
                            if($month1 < 12)
                            {
                                $month1++;
                            }
                            else
                            {
                                $month1 = 1;
                                $year1  += 1;
                            }
                            
                            $dd1 = date("$year1-$month1-d", strtotime($firstDueDate));
                            $dueDate1 = date('Y-m-d', strtotime($dd1));

                            if($month2 < 12)
                            {
                                $month2++;
                            }
                            else
                            {
                                $month2 = 1;
                                $year2  += 1;
                            }

                            $dd2 = date("$year2-$month2-d", strtotime($secondDueDate));
                            $dueDate2 = date('Y-m-d', strtotime($dd2));

                            $maEndDate = $dueDate2;
                        }

                        $user = new OAuth( array(
                            OAuth::CLIENT_ID    => "1000.VOJVM3LCCCE95VPJVWD2LJS3JET2KW",
                            OAuth::CLIENT_SECRET=> "d8995d279be0e05e84ec9abe206fc55e2e2d7cdb36",
                            OAuth::DC           => "COM",
                            OAuth::REFRESH_TOKEN=> "1000.57d4da049833cbca42eb06e03529dce0.3d6fe947327718a77da41d5bf87da0d2"
                        ) );

                        ZohoSign::setCurrentUser( $user );
                        $user->generateAccessTokenUsingRefreshToken();
                        $access_token = $user->getAccessToken();

                        $template = ZohoSign::getTemplate( 418013000000123017 );

                        $template->setRequestName("Disclosure Statement");
                        $template->setNotes("Call us back if you need clarificaions regarding agreement");

                        $employeeName = $arrResult['first_name'] . " " . $arrResult['last_name'];
                        $template->getActionByRole("Recepient1")->setRecipientName($employeeName);
                        $template->getActionByRole("Recepient1")->setRecipientEmail($arrResult['email_address']);
                        $template->setPrefillTextField( "txt_employeeName",  $employeeName );

                        $template->setPrefillTextField( "txt_borrowerName",  $employeeName );
                        $template->setPrefillTextField( "txt_borrowerAddress",  $arrResult['permanent_address'] );
                        $template->setPrefillTextField( "txt_interestPerMonth",  $arrResult['interest_rate'] );
                        $template->setPrefillTextField( "txt_dateFrom",  $maStartDate );
                        $template->setPrefillTextField( "txt_dateTo",  $maEndDate );
                        $template->setPrefillTextField( "txt_interestRate",  $arrResult['interest_rate'] );
                        $template->setPrefillTextField( "txt_paymentMonths",  $arrResult['payment_terms'] );

                        $monthlyAmortization = 0;
                        $loanAmount = $arrResult['loan_amount'];
                        $paymentTerms = $arrResult['payment_terms'];

                        $monthlyAmortization = ($loanAmount / $paymentTerms) + (float)$arrResult['total_interest'];
                        $template->setPrefillTextField( "txt_monthlyAmortization",  number_format($monthlyAmortization,2,",",".") );

                        $template->setPrefillTextField( "txt_loanGranted",  number_format($loanAmount,2,",",".") );

                        $serviceCharge = $loanAmount * 0.02;
                        $template->setPrefillTextField( "txt_serviceCharge",  number_format($serviceCharge,2,",",".") );

                        $nonFinanceCharges = ($loanAmount / 1000) * 13;
                        $template->setPrefillTextField( "txt_nonFinanceCharges",  number_format($nonFinanceCharges,2,",",".") );

                        $notarialFee = 500;
                        $template->setPrefillTextField( "txt_notarialFee",  number_format($notarialFee,2,",",".") );

                        $totalNonFinanceCharges = $nonFinanceCharges + $notarialFee;
                        $template->setPrefillTextField( "txt_totalNonFinanceCharges",  number_format($totalNonFinanceCharges,2,",",".") );

                        $totalDeductions = $serviceCharge + $totalNonFinanceCharges;
                        $template->setPrefillTextField( "txt_totalDeductions",  number_format($totalDeductions,2,",",".") );

                        $netProceeds = $loanAmount - $totalDeductions;
                        $template->setPrefillTextField( "txt_netProceeds",  number_format($netProceeds,2,",",".") );

                        $resp_obj = ZohoSign::sendTemplate( $template, true );
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
