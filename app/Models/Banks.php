<?php

namespace App\Models;

use CodeIgniter\Model;

class Banks extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'banks';
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
    ///// BankController->loadBanks()
    ////////////////////////////////////////////////////////////
    public function loadBanks()
    {
        $columns = [
            'a.id',
            'a.channel_code',
            'a.channel_type',
            'a.bank_name',
            'a.instant_processing',
            'a.cutoff_processing',
            'a.created_by',
            'a.created_date',
            'a.updated_by',
            'a.updated_date'
        ];

        $builder = $this->db->table('banks a');
        $builder->select($columns);
        $query = $builder->get();
        return  $query->getResultArray();
    }

    ////////////////////////////////////////////////////////////
    ///// BankController->addBank()
    ////////////////////////////////////////////////////////////
    public function addBank()
    {
        try {
            $this->db->transStart();
                $builder = $this->db->table('banks');
                $builder->insert($arrData);
                $insertId = $this->db->insertID();
            $this->db->transComplete();
            return ($this->db->transStatus() === TRUE)? $insertId : 0;
        } catch (PDOException $e) {
            throw $e;
        }
    }

    ////////////////////////////////////////////////////////////
    ///// BankController->selectBank()
    ////////////////////////////////////////////////////////////
    public function selectBank($bankId)
    {
        $columns = [
            'a.id',
            'a.channel_code',
            'a.channel_type',
            'a.bank_name',
            'a.instant_processing',
            'a.cutoff_processing',
            'a.created_by',
            'a.created_date',
            'a.updated_by',
            'a.updated_date'
        ];

        $builder = $this->db->table('banks a');
        $builder->select($columns);
        $builder->where('a.id',$bankId);
        $query = $builder->get();
        return  $query->getRowArray();
    }

    ////////////////////////////////////////////////////////////
    ///// BankController->editBank()
    ////////////////////////////////////////////////////////////
    public function editBank($arrData, $bankId)
    {
        try {
            $this->db->transStart();
                $builder = $this->db->table('banks');
                $builder->where(['id'=>$bankId]);
                $builder->update($arrData);
            $this->db->transComplete();
            return ($this->db->transStatus() === TRUE)? 1 : 0;
        } catch (PDOException $e) {
            throw $e;
        }
    }

    ////////////////////////////////////////////////////////////
    ///// BankController->removeBank()
    ////////////////////////////////////////////////////////////
    public function removeBank($bankId)
    {
        try {
            $this->db->transStart();
                $builder = $this->db->table('banks');
                $builder->where(['id'=>$bankId]);
                $builder->delete();
            $this->db->transComplete();
            return ($this->db->transStatus() === TRUE)? 1 : 0;
        } catch (PDOException $e) {
            throw $e;
        }
    }

}
