<?php

namespace App\Models;

use CodeIgniter\Model;

class Billings extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'billings';
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
    ///// BillingController->_generateBillingNumber()
    ////////////////////////////////////////////////////////////
    public function getLastBillingNumber()
    {
        $columns = [
            'a.id',
            'a.billing_number'
        ];

        $builder = $this->db->table('billings a');
        $builder->select($columns);
        $builder->orderBy('a.id','DESC');
        $builder->limit(1);
        $query = $builder->get();
        return  $query->getRowArray();
    }

    ////////////////////////////////////////////////////////////
    ///// BillingController->a_generateBillings()
    ////////////////////////////////////////////////////////////
    public function a_countGeneratedBillings($completeDateNow)
    {
        $columns = [
            'a.id'
        ];

        $builder = $this->db->table('billings a');
        $builder->select($columns);
        $builder->where('a.billing_date', $completeDateNow);
        $query = $builder->get();
        return  $query->getResultArray();
    }

    ////////////////////////////////////////////////////////////
    ///// BillingController->a_generateBillings()
    ////////////////////////////////////////////////////////////
    public function a_generateBillings($dateNow)
    {
        $columns = [
            'a.id',
            'a.company_code',
            'a.company_name',
            'a.company_address',
            'a.company_email',
            'a.mobile_number',
            'a.telephone_number',
            'a.company_website',
            'a.business_type',
            'a.business_industry',
            'a.tax_identification_number',
            'SUM(b.monthly_dues) as total_monthly_dues'
        ];

        $builder = $this->db->table('companies a');
        $builder->select($columns);
        $builder->join('loans b','a.id = b.company_id', 'left');
        $builder->where('b.billing_date', $dateNow);
        $builder->groupBy('a.id');
        $query = $builder->get();
        return  $query->getResultArray();
    }

    ////////////////////////////////////////////////////////////
    ///// BillingController->a_generateBillings()
    ////////////////////////////////////////////////////////////
    public function a_addGeneratedBilling($arrData)
    {
        try {
            $this->db->transStart();
                $builder = $this->db->table('billings');
                $builder->insert($arrData);
                $insertId = $this->db->insertID();
            $this->db->transComplete();
            return ($this->db->transStatus() === TRUE)? $insertId : 0;
        } catch (PDOException $e) {
            throw $e;
        }
    }

    ////////////////////////////////////////////////////////////
    ///// BillingController->a_generateBillings()
    ////////////////////////////////////////////////////////////
    public function a_generateBillingDetails($companyId, $dateNow)
    {
        $columns = [
            'a.id',
            'a.company_id',
            'a.employee_id',
            'a.application_number',
            'a.application_status',
            'a.loan_amount',
            'a.payment_terms',
            'a.purpose_of_loan',
            'a.amount_to_receive',
            'a.total_interest',
            'a.number_of_deductions',
            'a.monthly_dues',
            'a.deduction_per_cutoff',
            'a.created_date',
            '(SELECT COUNT(id) FROM billing_details WHERE loan_id = a.id) as billing_series'
        ];

        $builder = $this->db->table('loans a');
        $builder->select($columns);
        $builder->where('a.company_id', $companyId);
        $builder->where('a.billing_date', $dateNow);
        $query = $builder->get();
        return  $query->getResultArray();
    }

    ////////////////////////////////////////////////////////////
    ///// BillingController->a_generateBillings()
    ////////////////////////////////////////////////////////////
    public function a_addGeneratedBillingDetails($arrData)
    {
        try {
            $this->db->transStart();
                $builder = $this->db->table('billing_details');
                $builder->insertBatch($arrData);
            $this->db->transComplete();
            return ($this->db->transStatus() === TRUE)? 1 : 0;
        } catch (PDOException $e) {
            throw $e;
        }
    }

    ////////////////////////////////////////////////////////////
    ///// BillingController->a_loadBillings()
    ////////////////////////////////////////////////////////////
    public function a_loadBillings()
    {
        $columns = [
            'a.id',
            '(SELECT company_name FROM companies WHERE id = a.company_id) as company_name',
            'a.billing_number',
            'a.billing_date',
            'a.total_amount',
            'a.total_paid',
            'a.balance',
            'a.due_date',
            'a.payment_status'
        ];

        $builder = $this->db->table('billings a');
        $builder->select($columns);
        $builder->orderBy('a.created_date','DESC');
        $query = $builder->get();
        return  $query->getResultArray();
    }

    ////////////////////////////////////////////////////////////
    ///// BillingController->a_loadBillingDetails()
    ////////////////////////////////////////////////////////////
    public function a_loadBillingDetails($billingId)
    {
        $columns = [
            'a.id',
            'a.billing_number',
            'a.billing_date',
            'b.company_name',
            'b.company_code',
            'a.due_date',
            'a.total_amount',
            'a.total_paid',
            'a.balance'
        ];

        $builder = $this->db->table('billings a');
        $builder->join('companies b','a.company_id = b.id','full');
        $builder->select($columns);
        $builder->where('a.id', $billingId);
        $query = $builder->get();
        return  $query->getRowArray();
    }

    ////////////////////////////////////////////////////////////
    ///// BillingController->a_loadBillingDetails()
    ////////////////////////////////////////////////////////////
    public function a_loadBillingLists($billingId)
    {
        $columns = [
            'a.id',
            'b.account_number',
            '(SELECT DATE_FORMAT(created_date,"%Y-%m-%d") FROM loan_disbursements WHERE loan_id = a.loan_id) as disbursement_date',
            'c.first_name',
            'c.last_name',
            'b.loan_amount',
            'a.billing_amount',
            'b.payment_terms',
            '(SELECT COUNT(id) FROM billing_details WHERE loan_id = a.loan_id AND payment_status = "PAID") as billing_series'
        ];

        $builder = $this->db->table('billing_details a');
        $builder->join('loans b','a.loan_id = b.id','full');
        $builder->join('employees c','b.employee_id = c.id','full');
        $builder->select($columns);
        $builder->where('a.billing_id', $billingId);
        $query = $builder->get();
        return  $query->getResultArray();
    }












    ////////////////////////////////////////////////////////////
    ///// BillingController->r_loadBillings()
    ////////////////////////////////////////////////////////////
    public function r_loadBillings($companyId)
    {
        $columns = [
            'a.id',
            '(SELECT company_name FROM companies WHERE id = a.company_id) as company_name',
            'a.billing_number',
            'a.billing_date',
            'a.total_amount',
            'a.total_paid',
            'a.balance',
            'a.due_date',
            'a.payment_status'
        ];

        $builder = $this->db->table('billings a');
        $builder->select($columns);
        $builder->where('a.company_id', $companyId);
        $builder->orderBy('a.created_date','DESC');
        $query = $builder->get();
        return  $query->getResultArray();
    }

    ////////////////////////////////////////////////////////////
    ///// BillingController->r_selectBilling()
    ////////////////////////////////////////////////////////////
    public function r_loadBillingDetails($billingId)
    {
        $columns = [
            'a.id',
            'a.billing_number',
            'a.billing_date',
            'b.company_name',
            'b.company_code',
            'a.due_date',
            'a.total_amount',
            'a.total_paid',
            'a.balance',
            '(SELECT COUNT(id) FROM billing_details WHERE billing_id = a.id AND payment_status = "PAID") as paid_count',
            '(SELECT COUNT(id) FROM billing_details WHERE billing_id = a.id) as billing_count'
        ];

        $builder = $this->db->table('billings a');
        $builder->join('companies b','a.company_id = b.id','full');
        $builder->select($columns);
        $builder->where('a.id', $billingId);
        $query = $builder->get();
        return  $query->getRowArray();
    }

    ////////////////////////////////////////////////////////////
    ///// BillingController->r_selectBilling()
    ////////////////////////////////////////////////////////////
    public function r_loadBillingLists($billingId)
    {
        $columns = [
            'a.id',
            'b.account_number',
            '(SELECT DATE_FORMAT(created_date,"%Y-%m-%d") FROM loan_disbursements WHERE loan_id = a.loan_id) as disbursement_date',
            'c.first_name',
            'c.last_name',
            'b.loan_amount',
            'a.billing_amount',
            'a.penalty_type',
            'a.payment_status',
            'b.payment_terms',
            '(SELECT COUNT(id) FROM billing_details WHERE loan_id = a.loan_id AND payment_status = "PAID") as billing_series'
        ];

        $builder = $this->db->table('billing_details a');
        $builder->join('loans b','a.loan_id = b.id','full');
        $builder->join('employees c','b.employee_id = c.id','full');
        $builder->select($columns);
        $builder->where('a.billing_id', $billingId);
        // $builder->where('a.payment_status', 'UNPAID');
        $query = $builder->get();
        return  $query->getResultArray();
    }

    ////////////////////////////////////////////////////////////
    ///// PaymentController->r_editSuccessPayment()
    ////////////////////////////////////////////////////////////
    public function r_selectBilling($billingId)
    {
        $columns = [
            'a.id',
            'a.payment_status'
        ];

        $builder = $this->db->table('billings a');
        $builder->select($columns);
        $builder->where('a.id', $billingId);
        $query = $builder->get();
        return  $query->getRowArray();
    }

    ////////////////////////////////////////////////////////////
    ///// BillingController->r_submitPayment()
    ///// BillingController->r_editSuccessPayment()
    ////////////////////////////////////////////////////////////
    public function r_updateBilling($arrData, $billingId)
    {
        try {
            $this->db->transStart();
                $builder = $this->db->table('billings');
                $builder->where(['id'=>$billingId]);
                $builder->update($arrData);
            $this->db->transComplete();
            return ($this->db->transStatus() === TRUE)? 1 : 0;
        } catch (PDOException $e) {
            throw $e;
        }
    }

    ////////////////////////////////////////////////////////////
    ///// BillingController->r_submitPayment()
    ////////////////////////////////////////////////////////////
    // public function r_selectBillingDetails($billingIds)
    // {
    //     $columns = [
    //         'a.id',
    //         'b.account_number',
    //         '(SELECT DATE_FORMAT(created_date,"%Y-%m-%d") FROM loan_disbursements WHERE loan_id = a.loan_id) as disbursement_date',
    //         'c.first_name',
    //         'c.last_name',
    //         'b.loan_amount',
    //         'a.billing_amount',
    //         'b.payment_terms',
    //         '(SELECT COUNT(id) FROM billing_details WHERE loan_id = a.loan_id AND payment_status = "PAID") as billing_series'
    //     ];

    //     $builder = $this->db->table('billing_details a');
    //     $builder->join('loans b','a.loan_id = b.id','full');
    //     $builder->join('employees c','b.employee_id = c.id','full');
    //     $builder->select($columns);
    //     $builder->whereIn('a.id', $billingId);
    //     $query = $builder->get();
    //     return  $query->getResultArray();
    // }

    ////////////////////////////////////////////////////////////
    ///// BillingController->r_submitPayment()
    ///// BillingController->r_editSuccessPayment()
    ////////////////////////////////////////////////////////////
    public function r_updateBillingDetails($arrData)
    {
        try {
            $this->db->transStart();
                $builder = $this->db->table('billing_details');
                $builder->updateBatch($arrData,'id');
            $this->db->transComplete();
            return ($this->db->transStatus() === TRUE)? 1 : 0;
        } catch (PDOException $e) {
            throw $e;
        }
    }
}
