<?php

namespace App\Models;

use CodeIgniter\Model;

class Payments extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'payments';
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
    ///// PaymentController->_generatePaymentNumber()
    ////////////////////////////////////////////////////////////
    public function getLastPaymentNumber()
    {
        $columns = [
            'a.id',
            'a.payment_number'
        ];

        $builder = $this->db->table('payments a');
        $builder->select($columns);
        $builder->orderBy('a.id','DESC');
        $builder->limit(1);
        $query = $builder->get();
        return  $query->getRowArray();
    }

    ////////////////////////////////////////////////////////////
    ///// PaymentController->r_submitPayment()
    ////////////////////////////////////////////////////////////
    public function r_submitPayment($arrData)
    {
        try {
            $this->db->transStart();
                $builder = $this->db->table('payments');
                $builder->insert($arrData);
                $insertId = $this->db->insertID();
            $this->db->transComplete();
            return ($this->db->transStatus() === TRUE)? $insertId : 0;
        } catch (PDOException $e) {
            throw $e;
        }
    }


    ////////////////////////////////////////////////////////////
    ///// PaymentController->a_loadPayments()
    ////////////////////////////////////////////////////////////
    public function a_loadPayments()
    {
        $columns = [
            'a.id',
            'a.payment_date',
            'a.payment_number',
            'c.company_name',
            'b.billing_number',
            'a.payment_amount',
            'a.payment_status',
            'a.confirmation_date'
        ];

        $builder = $this->db->table('payments a');
        $builder->join('billings b','a.billing_id = b.id','full');
        $builder->join('companies c','b.company_id = c.id','full');
        $builder->select($columns);
        $builder->orderBy('a.id','DESC');
        $query = $builder->get();
        return  $query->getResultArray();
    }

    ////////////////////////////////////////////////////////////
    ///// PaymentController->a_selectPayment()
    ////////////////////////////////////////////////////////////
    public function a_selectPayment($paymentId)
    {
        $columns = [
            'a.id',
            'a.billing_id',
            'b.company_id',
            'd.company_name',
            '(SELECT product_name FROM products WHERE id = c.product_id) as product_name',
            'b.billing_number',
            'b.total_amount as billing_amount',
            'b.due_date',
            'a.payment_date',
            'a.payment_amount',
            'a.payment_type',
            'a.reference_number',
            'a.proof_of_payment'
        ];

        $builder = $this->db->table('payments a');
        $builder->join('billings b','a.billing_id = b.id','full');
        $builder->join('loans c','b.company_id = c.company_id','full');
        $builder->join('companies d','c.company_id = d.id','full');
        $builder->select($columns);
        $builder->where('a.id',$paymentId);
        $builder->orderBy('a.id','DESC');
        $query = $builder->get();
        return  $query->getRowArray();
    }

    ////////////////////////////////////////////////////////////
    ///// PaymentController->a_confirmPayment()
    ////////////////////////////////////////////////////////////
    public function a_confirmPayment($arrData, $paymentId)
    {
        try {
            $this->db->transStart();
                $builder = $this->db->table('payments');
                $builder->where('id',$paymentId);
                $builder->update($arrData);
            $this->db->transComplete();
            return ($this->db->transStatus() === TRUE)? 1 : 0;
        } catch (PDOException $e) {
            throw $e;
        }
    }

    ////////////////////////////////////////////////////////////
    ///// PaymentController->a_confirmPayment()
    ////////////////////////////////////////////////////////////
    public function a_updateBilling($arrData, $billingId)
    {
        try {
            $this->db->transStart();
                $builder = $this->db->table('billings');
                $builder->where('id',$billingId);
                $builder->update($arrData);
            $this->db->transComplete();
            return ($this->db->transStatus() === TRUE)? 1 : 0;
        } catch (PDOException $e) {
            throw $e;
        }
    }

    ////////////////////////////////////////////////////////////
    ///// PaymentController->a_sendEmailToEmployees()
    ////////////////////////////////////////////////////////////
    public function a_updateBillingDetails($arrData, $billingDetailsId)
    {
        try {
            $this->db->transStart();
                $builder = $this->db->table('billing_details');
                $builder->where('id',$billingDetailsId);
                $builder->update($arrData);
            $this->db->transComplete();
            return ($this->db->transStatus() === TRUE)? 1 : 0;
        } catch (PDOException $e) {
            throw $e;
        }
    }
}
