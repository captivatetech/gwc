<?php

namespace App\Controllers\Portal;

use App\Controllers\BaseController;

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

        $userData = $this->employees->selectEmployee($this->session->get('gwc_employee_id'));
        $companyData = $this->companies->selectCompany($userData['company_id']);

        $arrData = [
            'company_id'            => $userData['company_id'],
            'employee_id'           => $userData['id'],
            'product_id'            => 1,
            'application_number'    => $this->_generateApplicationNumber($companyData['company_code']),
            // 'account_number'     => null,
            'loan_amount'           => $loanAmount,
            'amount_to_receive'     => $amountToReceive,
            'total_interest'        => $totalInterest,
            'payment_terms'         => $paymentTerms,
            'number_of_deductions'  => $numberOfDeductions,
            'monthly_dues'          => (float)number_format($monthlyDues, 2, '.', ''),
            'deduction_per_cutoff'  => (float)number_format($deductionPerCutoff, 2, '.', ''),
            'purpose_of_loan'       => $fields['purposeOfLoan'],
            'application_status'    => 'Pending',  
            // 'disbursement_status'=> null,
            // 'disbursement_date'  => null,
            // 'billing_date'       => null,
            // 'loan_status'        => null,
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
            'application_status'    => 'Processing',
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
            'application_status'    => 'Approved',
            'disbursement_status'   => 'Pending',
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
            'application_status'    => 'Rejected',
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
}
