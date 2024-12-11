<?php

namespace App\Models;

use CodeIgniter\Model;

class Fees extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'fees';
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
    ///// FeeController->loadAdminFees()
    ////////////////////////////////////////////////////////////
    public function loadAdminFees()
    {
        $columns = [
            'a.id',
            'a.type',
            'a.amount',
            'a.fee_status',
            'a.created_by',
            'a.created_date',
            'a.updated_by',
            'a.updated_date'
        ];

        $builder = $this->db->table('fees a');
        $builder->select($columns);
        $query = $builder->get();
        return  $query->getResultArray();
    }

    ////////////////////////////////////////////////////////////
    ///// FeeController->addAdminFee()
    ////////////////////////////////////////////////////////////
    public function addAdminFee($arrData)
    {
        try {
            $this->db->transStart();
                $builder = $this->db->table('fees');
                $builder->insert($arrData);
                $insertId = $this->db->insertID();
            $this->db->transComplete();
            return ($this->db->transStatus() === TRUE)? $insertId : 0;
        } catch (PDOException $e) {
            throw $e;
        }
    }

    ////////////////////////////////////////////////////////////
    ///// FeeController->selectAdminFee()
    ////////////////////////////////////////////////////////////
    public function selectAdminFee($feeId)
    {
        $columns = [
            'a.id',
            'a.type',
            'a.amount',
            'a.fee_status',
            'a.created_by',
            'a.created_date',
            'a.updated_by',
            'a.updated_date'
        ];

        $builder = $this->db->table('fees a');
        $builder->select($columns);
        $builder->where('a.id', $feeId);
        $query = $builder->get();
        return  $query->getRowArray();
    }

    ////////////////////////////////////////////////////////////
    ///// FeeController->editAdminFee()
    ////////////////////////////////////////////////////////////
    public function editAdminFee($arrData, $feeId)
    {
        try {
            $this->db->transStart();
                $builder = $this->db->table('fees');
                $builder->where(['id'=>$feeId]);
                $builder->update($arrData);
            $this->db->transComplete();
            return ($this->db->transStatus() === TRUE)? 1 : 0;
        } catch (PDOException $e) {
            throw $e;
        }
    }

    ////////////////////////////////////////////////////////////
    ///// FeeController->removeAdminFee()
    ////////////////////////////////////////////////////////////
    public function removeAdminFee($feeId)
    {
        try {
            $this->db->transStart();
                $builder = $this->db->table('fees');
                $builder->where(['id'=>$feeId]);
                $builder->delete();
            $this->db->transComplete();
            return ($this->db->transStatus() === TRUE)? 1 : 0;
        } catch (PDOException $e) {
            throw $e;
        }
    }
}
