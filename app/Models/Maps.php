<?php

namespace App\Models;

use CodeIgniter\Model;

class Maps extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'maps';
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

    public function r_loadCustomMaps()
    {
        $columns = [
            'a.id',
            'a.map_type',
            'a.map_name',
            'a.map_fields',
            'a.map_values',
            'a.created_by',
            'a.created_date'
        ];

        $builder = $this->db->table('custom_maps a');
        $builder->select($columns);
        $query = $builder->get();
        return  $query->getResultArray();
    }

    public function r_selectCustomMap($mapId)
    {
        $columns = [
            'a.id',
            'a.map_type',
            'a.map_name',
            'a.map_fields',
            'a.map_values',
            'a.created_by',
            'a.created_date'
        ];

        $builder = $this->db->table('custom_maps a');
        $builder->select($columns);
        $builder->where('a.id',$mapId);
        $query = $builder->get();
        return  $query->getRowArray();
    }

    ////////////////////////////////////////////////////////////
    ///// EmployeeController->r_mappingAndDuplicateHandling()
    ////////////////////////////////////////////////////////////
    public function r_addCustomMap($arrData)
    {
        try {
            $this->db->transStart();
                $builder = $this->db->table('custom_maps');
                $builder->insert($arrData);
                $insertId = $this->db->insertID();
            $this->db->transComplete();
            return ($this->db->transStatus() === TRUE)? $insertId : 0;
        } catch (PDOException $e) {
            throw $e;
        }
    }
}
