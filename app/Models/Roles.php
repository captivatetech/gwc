<?php

namespace App\Models;

use CodeIgniter\Model;

class Roles extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'roles';
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
    ///// RoleController->loadRoles()
    ////////////////////////////////////////////////////////////
    public function loadRoles()
    {
        $columns = [
            'a.id',
            'a.role_name',
            'a.role_description',
            'a.access_modules',
            'a.role_status',
            'a.created_by',
            'a.created_date',
            'a.updated_by',
            'a.updated_date'
        ];

        $builder = $this->db->table('roles a');
        $builder->select($columns);
        $builder->orderBy('a.id','DESC');
        $query = $builder->get();
        return  $query->getResultArray();
    }

    ////////////////////////////////////////////////////////////
    ///// RoleController->addRole()
    ///// RoleController->editRole()
    ////////////////////////////////////////////////////////////
    public function validateRole($whereParams)
    {
        $columns = [
            'a.id',
            'a.role_name',
            'a.role_description',
            'a.access_modules',
            'a.role_status',
            'a.created_by',
            'a.created_date',
            'a.updated_by',
            'a.updated_date'
        ];

        $builder = $this->db->table('roles a');
        $builder->select($columns);
        $builder->where($whereParams);
        $query = $builder->get();
        return  $query->getRowArray();
    }

    ////////////////////////////////////////////////////////////
    ///// RoleController->addRole()
    ////////////////////////////////////////////////////////////
    public function addRole($arrData)
    {
        try {
            $this->db->transStart();
                $builder = $this->db->table('roles');
                $builder->insert($arrData);
                $insertId = $this->db->insertID();
            $this->db->transComplete();
            return ($this->db->transStatus() === TRUE)? $insertId : 0;
        } catch (PDOException $e) {
            throw $e;
        }
    }

    ////////////////////////////////////////////////////////////
    ///// RoleController->selectRole()
    ////////////////////////////////////////////////////////////
    public function selectRole($roleId)
    {
        $columns = [
            'a.id',
            'a.role_name',
            'a.role_description',
            'a.access_modules',
            'a.role_status',
            'a.created_by',
            'a.created_date',
            'a.updated_by',
            'a.updated_date'
        ];

        $builder = $this->db->table('roles a');
        $builder->select($columns);
        $builder->where('a.id',$roleId);
        $query = $builder->get();
        return  $query->getRowArray();
    }

    ////////////////////////////////////////////////////////////
    ///// RoleController->editRole()
    ////////////////////////////////////////////////////////////
    public function editRole($arrData, $roleId)
    {
        try {
            $this->db->transStart();
                $builder = $this->db->table('roles');
                $builder->where(['id'=>$roleId]);
                $builder->update($arrData);
            $this->db->transComplete();
            return ($this->db->transStatus() === TRUE)? 1 : 0;
        } catch (PDOException $e) {
            throw $e;
        }
    }

    ////////////////////////////////////////////////////////////
    ///// RoleController->removeRole()
    ////////////////////////////////////////////////////////////
    public function loadRoleUsers($roleId)
    {
        $columns = [
            'a.id',
            'a.role_id'
        ];

        $builder = $this->db->table('users a');
        $builder->select($columns);
        $builder->where('a.role_id',$roleId);
        $query = $builder->get();
        return  $query->getResultArray();
    }

    ////////////////////////////////////////////////////////////
    ///// RoleController->removeRole()
    ////////////////////////////////////////////////////////////
    public function removeRole($roleId)
    {
        try {
            $this->db->transStart();
                $builder = $this->db->table('roles');
                $builder->where(['id'=>$roleId]);
                $builder->delete();
            $this->db->transComplete();
            return ($this->db->transStatus() === TRUE)? 1 : 0;
        } catch (PDOException $e) {
            throw $e;
        }
    }
    
}
