<?php

namespace App\Models;

use CodeIgniter\Model;

class Loans extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'loans';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];


    ////////////////////////////////////////////////////////////
    ///// LoanController->_generateApplicationNumber()
    ////////////////////////////////////////////////////////////
    public function getLastApplicationNumber()
    {
        $columns = [
            'a.id',
            'a.application_number'
        ];

        $builder = $this->db->table('loans a');
        $builder->select($columns);
        $builder->orderBy('a.id','DESC');
        $builder->limit(1);
        $query = $builder->get();
        return  $query->getRowArray();
    }

    ////////////////////////////////////////////////////////////
    ///// LoanController->e_submitSalaryAdvanceApplication()
    ////////////////////////////////////////////////////////////
    public function e_submitSalaryAdvanceApplication($arrData)
    {
        try {
            $this->db->transStart();
                $builder = $this->db->table('loans');
                $builder->insert($arrData);
                $insertId = $this->db->insertID();
            $this->db->transComplete();
            return ($this->db->transStatus() === TRUE)? $insertId : 0;
        } catch (PDOException $e) {
            throw $e;
        }
    }

    ////////////////////////////////////////////////////////////
    ///// LoanController->r_loadSalaryAdvanceApplications()
    ////////////////////////////////////////////////////////////
    public function r_loadSalaryAdvanceApplications($companyId)
    {
        $columns = [
            'a.id',
            'a.application_number',
            'b.first_name',
            'b.last_name',
            'a.application_status',
            'a.loan_amount',
            'a.created_date'
        ];

        $builder = $this->db->table('loans a');
        $builder->join('employees b','a.employee_id = b.id','left');
        $builder->select($columns);
        $builder->where('a.company_id', $companyId);
        $builder->orderBy('a.id','DESC');
        $query = $builder->get();
        return  $query->getResultArray();
    }

    ////////////////////////////////////////////////////////////
    ///// LoanController->r_selectLoanApplicationDetails()
    ////////////////////////////////////////////////////////////
    public function r_selectLoanApplicationDetails($loanId)
    {
        $columns = [
            'a.id',
            'a.employee_id',
            'a.request_id',
            'a.application_number',
            'b.identification_number',
            'b.first_name',
            'b.last_name',
            'b.department',
            'b.position',
            'a.application_status',
            'a.loan_amount',
            'a.payment_terms',
            'a.purpose_of_loan',
            'a.amount_to_receive',
            'a.total_interest',
            'a.number_of_deductions',
            'a.monthly_dues',
            'a.deduction_per_cutoff',
            'a.created_date'
        ];

        $builder = $this->db->table('loans a');
        $builder->join('employees b','a.employee_id = b.id','left');
        $builder->select($columns);
        $builder->where('a.id', $loanId);
        $builder->orderBy('a.id','DESC');
        $query = $builder->get();
        return  $query->getRowArray();
    }

    ////////////////////////////////////////////////////////////
    ///// LoanController->r_submitSalaryAdvanceApplication()
    ////////////////////////////////////////////////////////////
    public function r_submitSalaryAdvanceApplication($arrData, $loanId)
    {
        try {
            $this->db->transStart();
                $builder = $this->db->table('loans');
                $builder->where(['id'=>$loanId]);
                $builder->update($arrData);
            $this->db->transComplete();
            return ($this->db->transStatus() === TRUE)? 1 : 0;
        } catch (PDOException $e) {
            throw $e;
        }
    }

    ////////////////////////////////////////////////////////////
    ///// NavigationController->e_dashboard()
    ///// LoanController->e_submitSalaryAdvanceApplication()
    ////////////////////////////////////////////////////////////
    public function e_selectLoanAccount($employeeId)
    {
        $columns = [
            'a.id',
            'a.account_number',
            'a.application_number',
            'a.application_status',
            'a.loan_amount',
            'a.total_interest',
            'a.payment_terms',
            'a.monthly_dues',
            'a.deduction_per_cutoff',
            'a.purpose_of_loan',
            'a.loan_status',
            'DATE_FORMAT(a.created_date, "%Y-%m-%d") as created_date',
            '(SELECT MAX(billing_series) FROM billing_details WHERE loan_id = a.id) as max_billing_series',
            '(SELECT SUM(billing_amount) FROM billing_details WHERE loan_id = a.id AND payment_status = "PAID") as total_payment'
        ];

        $builder = $this->db->table('loans a');
        $builder->select($columns);
        $builder->where('a.employee_id', $employeeId);
        $builder->orderBy('a.id','DESC');
        $query = $builder->get();
        return  $query->getRowArray();
    }

    ////////////////////////////////////////////////////////////
    ///// LoanController->e_loadDashboardDetails()
    ////////////////////////////////////////////////////////////
    public function e_loadDashboardDetails($employeeId)
    {
        $columns = [
            'a.id',
            '(SELECT first_name FROM employees WHERE id = a.employee_id) as first_name',
            '(SELECT last_name FROM employees WHERE id = a.employee_id) as last_name',
            'a.application_number',
            'a.application_status',
            'a.account_number',
            'a.loan_amount',
            'a.interest_rate',
            'a.total_interest',
            'a.payment_terms',
            'a.monthly_dues',
            'a.deduction_per_cutoff',
            'a.purpose_of_loan',
            'a.first_billing_date',
            'a.second_billing_date',
            'a.first_due_date',
            'a.second_due_date',
            'DATE_FORMAT(a.created_date, "%Y-%m-%d") as created_date'
        ];

        $builder = $this->db->table('loans a');
        $builder->select($columns);
        $builder->where('a.employee_id', $employeeId);
        $builder->where('a.loan_status', 'ACTIVE');
        $builder->orderBy('a.id','DESC');
        $query = $builder->get();
        return  $query->getRowArray();
    }

    ////////////////////////////////////////////////////////////
    ///// LoanController->e_loadLoanAccounts()
    ////////////////////////////////////////////////////////////
    public function e_loadLoanAccounts($employeeId)
    {
        $columns = [
            'a.id',
            'a.application_number',
            'a.application_status',
            'a.loan_amount',
            'a.payment_terms',
            'a.monthly_dues',
            'a.deduction_per_cutoff',
            'a.purpose_of_loan',
            'DATE_FORMAT(a.created_date, "%Y-%m-%d") as created_date'
        ];

        $builder = $this->db->table('loans a');
        $builder->select($columns);
        $builder->where('a.employee_id', $employeeId);
        $builder->orderBy('a.id','DESC');
        $query = $builder->get();
        return  $query->getResultArray();
    }

    ////////////////////////////////////////////////////////////
    ///// LoanController->a_loadApplications()
    ////////////////////////////////////////////////////////////
    public function a_loadApplications()
    {
        $columns = [
            'a.id',
            'a.application_number',
            'b.first_name',
            'b.last_name',
            'c.company_name',
            'a.loan_amount',
            'a.application_status',
            'DATE_FORMAT(a.created_date, "%Y-%m-%d") as created_date'
        ];

        $builder = $this->db->table('loans a');
        $builder->join('employees b','a.employee_id = b.id','left');
        $builder->join('companies c','a.company_id = c.id','left');
        $builder->select($columns);
        $builder->whereIn('a.application_status', ['Processing','Approved','Rejected']);
        $builder->orderBy('a.id','DESC');
        $query = $builder->get();
        return  $query->getResultArray();
    }

    ////////////////////////////////////////////////////////////
    ///// LoanController->a_selectApplication()
    ////////////////////////////////////////////////////////////
    public function a_selectApplication($loanId)
    {
        $columns = [
            'a.id',
            'a.employee_id',
            'a.request_id',
            'a.application_number',
            'b.identification_number',
            'b.first_name',
            'b.last_name',
            'b.department',
            'b.position',
            'a.application_status',
            'a.loan_amount',
            'a.payment_terms',
            'a.purpose_of_loan',
            'a.amount_to_receive',
            'a.total_interest',
            'a.number_of_deductions',
            'a.monthly_dues',
            'a.deduction_per_cutoff',
            'a.created_date'
        ];

        $builder = $this->db->table('loans a');
        $builder->join('employees b','a.employee_id = b.id','left');
        $builder->select($columns);
        $builder->where('a.id', $loanId);
        $builder->orderBy('a.id','DESC');
        $query = $builder->get();
        return  $query->getRowArray();
    }


    ////////////////////////////////////////////////////////////
    ///// LoanController->a_approveApplication()
    ////////////////////////////////////////////////////////////
    public function a_approveApplication($arrData, $loanId)
    {
        try {
            $this->db->transStart();
                $builder = $this->db->table('loans');
                $builder->where(['id'=>$loanId]);
                $builder->update($arrData);
            $this->db->transComplete();
            return ($this->db->transStatus() === TRUE)? 1 : 0;
        } catch (PDOException $e) {
            throw $e;
        }
    }

    ////////////////////////////////////////////////////////////
    ///// LoanController->a_rejectApplication()
    ////////////////////////////////////////////////////////////
    public function a_rejectApplication($arrData, $loanId)
    {
        try {
            $this->db->transStart();
                $builder = $this->db->table('loans');
                $builder->where(['id'=>$loanId]);
                $builder->update($arrData);
            $this->db->transComplete();
            return ($this->db->transStatus() === TRUE)? 1 : 0;
        } catch (PDOException $e) {
            throw $e;
        }
    }

    ////////////////////////////////////////////////////////////
    ///// LoanController->a_loadSalaryAdvanceAccounts()
    ////////////////////////////////////////////////////////////
    public function a_loadSalaryAdvanceAccounts()
    {
        $columns = [
            'a.id',
            'a.application_number',
            'b.first_name',
            'b.last_name',
            'c.company_name',
            'a.loan_amount',
            'a.application_status',
            'a.disbursement_status',
            'DATE_FORMAT(a.created_date, "%Y-%m-%d") as created_date'
        ];

        $builder = $this->db->table('loans a');
        $builder->join('employees b','a.employee_id = b.id','left');
        $builder->join('companies c','a.company_id = c.id','left');
        $builder->select($columns);
        $builder->where('a.application_status', 'Approved');
        $builder->whereIn('a.disbursement_status', ['Pending','Accepted']);
        $builder->orderBy('a.id','DESC');
        $query = $builder->get();
        return  $query->getResultArray();
    }

    ////////////////////////////////////////////////////////////
    ///// LoanController->a_loadDisbursementLists()
    ////////////////////////////////////////////////////////////
    public function a_loadDisbursementLists($companyId)
    {
        $columns = [
            'a.id',
            'a.account_number',
            'b.identification_number',
            'b.first_name',
            'b.last_name',
            'c.bank_depository',
            'c.branch_name',
            'c.branch_code',
            'a.loan_amount',
            'a.amount_to_receive',
            'DATE_FORMAT(a.created_date, "%Y-%m-%d") as created_date'
        ];

        $builder = $this->db->table('loans a');
        $builder->join('employees b','a.employee_id = b.id','left');
        $builder->join('companies c','a.company_id = c.id','left');
        $builder->select($columns);
        $builder->where('a.company_id', $companyId);
        $builder->where('a.application_status', 'Approved');
        $builder->where('a.disbursement_status', 'Pending');
        $builder->orderBy('a.id','DESC');
        $query = $builder->get();
        return  $query->getResultArray();
    }

    ////////////////////////////////////////////////////////////
    ///// LoanController->a_proceedDisbursement()
    ////////////////////////////////////////////////////////////
    public function a_selectLoanForDisbursement($loanId)
    {
        $columns = [
            'a.id',
            'a.employee_id',
            '(SELECT payroll_bank_number FROM employees WHERE id = a.employee_id) as payroll_bank_number',
            'a.company_id',
            'a.account_number',
            'a.loan_amount',
            'a.interest_rate',
            'a.total_interest',
            'a.payment_terms',
            'a.monthly_dues',
            'a.deduction_per_cutoff',
            'b.identification_number',
            'b.first_name',
            'b.last_name',
            'b.email_address',
            'b.permanent_address',
            'c.bank_depository',
            'c.branch_name',
            'c.branch_code',
            'a.amount_to_receive',
            'DATE_FORMAT(a.created_date, "%Y-%m-%d") as created_date'
        ];

        $builder = $this->db->table('loans a');
        $builder->join('employees b','a.employee_id = b.id','left');
        $builder->join('companies c','a.company_id = c.id','left');
        $builder->select($columns);
        $builder->where('a.application_status', 'Approved');
        $builder->where('a.disbursement_status', 'Pending');
        $builder->where('a.id',$loanId);
        $builder->orderBy('a.id','DESC');
        $query = $builder->get();
        return  $query->getRowArray();
    }

    ////////////////////////////////////////////////////////////
    ///// LoanController->a_proceedDisbursement()
    ////////////////////////////////////////////////////////////
    public function a_proceedDisbursement($arrData)
    {
        try {
            $this->db->transStart();
                $builder = $this->db->table('loan_disbursements');
                $builder->insert($arrData);
                $insertId = $this->db->insertID();
            $this->db->transComplete();
            return ($this->db->transStatus() === TRUE)? $insertId : 0;
        } catch (PDOException $e) {
            throw $e;
        }
    }

    ////////////////////////////////////////////////////////////
    ///// LoanController->a_proceedDisbursement()
    ////////////////////////////////////////////////////////////
    public function a_updateDisbursementStatus($arrData, $loanId)
    {
        try {
            $this->db->transStart();
                $builder = $this->db->table('loans');
                $builder->where(['id'=>$loanId]);
                $builder->update($arrData);
            $this->db->transComplete();
            return ($this->db->transStatus() === TRUE)? 1 : 0;
        } catch (PDOException $e) {
            throw $e;
        }
    }
    
}
