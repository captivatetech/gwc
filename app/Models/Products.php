<?php

namespace App\Models;

use CodeIgniter\Model;

class Products extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'products';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'product_code',
        'product_name',
        'product_details',
        'product_status',
        'created_date'
    ];

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

    ////////////////////////////////////////////////////
    ///// ProductController->r_selectFinancingProduct()
    ////////////////////////////////////////////////////
    public function r_selectFinancingProduct($whereParams)
    {
        $columns = [
            'a.id',
            'a.product_code',
            'a.product_name',
            'a.product_details',
            'a.product_status',
            'a.created_by',
            'a.created_date',
            'a.updated_by',
            'a.updated_date'
        ];

        $builder = $this->db->table('products a');
        $builder->select($columns);
        $builder->where($whereParams);
        $query = $builder->get();
        return  $query->getRowArray();
    }

    ////////////////////////////////////////////////////////////
    ///// ProductSubscriptionsController->r_addProductSubscription()
    ////////////////////////////////////////////////////////////
    public function r_addProductSubscription($arrData)
    {
        try {
            $this->db->transStart();
                $builder = $this->db->table('product_subscriptions');
                $builder->insert($arrData);
                $insertId = $this->db->insertID();
            $this->db->transComplete();
            return ($this->db->transStatus() === TRUE)? $insertId : 0;
        } catch (PDOException $e) {
            throw $e;
        }
    }


    ////////////////////////////////////////////////////
    ///// ProductSubscriptionController->a_loadProductSubscriptions()
    ////////////////////////////////////////////////////
    public function a_loadProductSubscriptions()
    {
        $columns = [
            'a.id',
            'a.product_id',
            'a.company_id',
            'b.company_name',
            'b.company_code',
            'a.subscription_status',
            'a.remarks',
            'a.created_by',
            'DATE_FORMAT(a.created_date, "%Y-%m-%d") as created_date',
            'a.updated_by',
            'DATE_FORMAT(a.updated_date, "%Y-%m-%d") as updated_date'
        ];

        $builder = $this->db->table('product_subscriptions a');
        $builder->join('companies b','a.company_id = b.id','left');
        $builder->select($columns);
        $query = $builder->get();
        return  $query->getResultArray();
    }

    ////////////////////////////////////////////////////
    ///// ProductSubscriptionController->a_selectProductSubscription()
    ////////////////////////////////////////////////////
    public function a_selectProductSubscription($companyId)
    {
        $columns = [
            'a.id',
            'a.product_id',
            'b.product_code',
            'b.product_name',
            'b.product_details',
            'a.company_id',
            'c.company_code',
            'c.company_name',
            'c.company_address',
            'c.company_code',
            'c.business_industry',
            'c.mobile_number',
            'c.telephone_number',
            'c.company_email',
            'c.company_website',
            'c.business_type',
            'd.first_name',
            'd.last_name',
            'a.subscription_status',
            'a.remarks',
            'a.created_by',
            'a.created_date',
            'a.updated_by',
            'a.updated_date'
        ];

        $builder = $this->db->table('product_subscriptions a');
        $builder->join('products b','a.product_id = b.id','left');
        $builder->join('companies c','a.company_id = c.id','left');
        $builder->join('employees d','c.id = d.company_id','left');
        $builder->select($columns);
        $builder->where('a.company_id',$companyId);
        $builder->where('d.user_type','representative');
        $query = $builder->get();
        return  $query->getRowArray();
    }
}
