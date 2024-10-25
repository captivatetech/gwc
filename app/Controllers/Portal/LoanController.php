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

            $template = ZohoSign::getTemplate( 418013000000051001 );

            $template->setRequestName("May Sample API Test");
            $template->setNotes("Call us back if you need clarificaions regarding agreement");

            $template->setPrefillTextField( "txt_field1",  "field1" );
            $template->setPrefillTextField( "txt_field2",  "field2" );
            $template->setPrefillTextField( "txt_field3",  "field3" );
            $template->setPrefillTextField( "txt_field4",  "field4" );
            $template->setPrefillTextField( "txt_field5",  "field5" );
            $template->setPrefillTextField( "txt_field6",  "field6" );
            $template->setPrefillTextField( "txt_field7",  "field7" );
            $template->setPrefillTextField( "txt_field8",  "field8" );
            $template->setPrefillTextField( "txt_field9",  "field9" );
            $template->setPrefillTextField( "txt_field10",  "field10" );
            $template->setPrefillTextField( "txt_field11",  "field11" );
            $template->setPrefillTextField( "txt_field12",  "field12" );
            $template->setPrefillTextField( "txt_field13",  "field13" );
            $template->setPrefillTextField( "txt_field14",  "field14" );
            $template->setPrefillTextField( "txt_field15",  "field15" );
            $template->setPrefillTextField( "txt_field16",  "field16" );
            $template->setPrefillTextField( "txt_field17",  "field17" );
            $template->setPrefillTextField( "txt_field18",  "field18" );
            $template->setPrefillTextField( "txt_field19",  "field19" );
            $template->setPrefillTextField( "txt_field20",  "field20" );
            $template->setPrefillTextField( "txt_field21",  "field21" );
            $template->setPrefillTextField( "txt_field22",  "field22" );
            $template->setPrefillTextField( "txt_field23",  "field23" );
            $template->setPrefillTextField( "txt_field24",  "field24" );
            $template->setPrefillTextField( "txt_field25",  "field25" );
            $template->setPrefillTextField( "txt_field26",  "field26" );
            $template->setPrefillTextField( "txt_field27",  "field27" );
            $template->setPrefillTextField( "txt_field28",  "field28" );
        
            $employeeName = $userData['first_name'] . " " . $userData['last_name'];
            $template->getActionByRole("Recepient1")->setRecipientName($employeeName);
            $template->getActionByRole("Recepient1")->setRecipientEmail($userData['email_address']);
            $template->setPrefillTextField( "txt_employeeName",  $employeeName );

            $representativeName = $representativeData['first_name'] . " " . $representativeData['last_name'];
            $template->getActionByRole("Recepient2")->setRecipientName($representativeName);
            $template->getActionByRole("Recepient2")->setRecipientEmail($representativeData['email_address']);
            $template->setPrefillTextField( "txt_representativeName",  $representativeName );

            $template->getActionByRole("Recepient3")->setRecipientName("GWC Admin");
            $template->getActionByRole("Recepient3")->setRecipientEmail("ajhay.life@gmail.com");
            $template->setPrefillTextField( "txt_lenderName",  "GWC Admin" );

            $table1 = <<< EOD
                <table>
                    <tr>
                        <td>Account Name</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Account Number</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Interest Rate</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td><b>Promesory Note Value</b></td>
                        <td></td>
                    </tr>
                </table>
            EOD;

            $template->setPrefillTextField( "txt_table1", $table1 );
        
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
                    'monthly_dues'          => (float)number_format($monthlyDues, 2, '.', ''),
                    'deduction_per_cutoff'  => (float)number_format($deductionPerCutoff, 2, '.', ''),
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
            // echo "SIGN EXCEPTION : ".$signEx;
        }catch( Exception $ex ){
            // handle it
        }        
    }

    public function r_loadSalaryAdvanceApplications()
    {
        $userData = $this->employees->selectEmployee($this->session->get('gwc_representative_id'));
        $arrResult = $this->loans->r_loadSalaryAdvanceApplications($userData['company_id']);
        return $this->response->setJSON($arrResult);
    }

    public function r_selectLoanApplicationDetails()
    {
        $fields = $this->request->getGet();
        $arrResult = $this->loans->r_selectLoanApplicationDetails($fields['loanId']);
        return $this->response->setJSON($arrResult);
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
        $fields = $this->request->getGet();
        $arrResult = $this->loans->a_selectApplication($fields['loanId']);
        return $this->response->setJSON($arrResult);
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
        $arrResult = $this->loans->a_loadDisbursementLists();
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
