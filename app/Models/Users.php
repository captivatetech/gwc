<?php

namespace App\Models;

use CodeIgniter\Model;

class Users extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'first_name',
        'last_name',
        'mobile_number',
        'email_address',
        'user_password',
        'user_status',
        'role_id',
        'access_modules',
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


    ////////////////////////////////////////////////////////////
    ///// IndexController->login()
    ////////////////////////////////////////////////////////////
    public function validateLogIn($logInRequirements)
    {
        $columns = [
            'a.id',
            'a.first_name',
            'a.last_name'
        ];

        $where = [
            'a.email_address' => $logInRequirements['email_address'],
            'a.user_password' => $logInRequirements['user_password'],
            'a.user_status'   => 1 
        ];
    
        $builder = $this->db->table('users a');
        $builder->select($columns);
        $builder->where($where);
        $query = $builder->get();
        return  $query->getRowArray();
    }

    ////////////////////////////////////////////////////////////
    ///// UserController->changeAdminPassword()
    ////////////////////////////////////////////////////////////
    public function validateAdminPassword($whereParams)
    {
        $columns = [
            'a.id',
            'a.first_name',
            'a.last_name'
        ];
        
        $builder = $this->db->table('users a');
        $builder->select($columns);
        $builder->where($whereParams);
        $query = $builder->get();
        return  $query->getRowArray();
    }

    ////////////////////////////////////////////////////////////
    ///// UserController->loadUsers()
    ///// UserController->addUser()
    ///// UserController->editUser()
    ////////////////////////////////////////////////////////////
    public function loadUsers($whereParams = [])
    {
        $columns = [
            'a.id',
            'a.role_id',
            'b.role_name',
            'a.first_name',
            'a.last_name',
            'a.mobile_number',
            'a.email_address',
            'a.user_status',
            'a.user_image',
        ];

        $builder = $this->db->table('users a');
        $builder->join('roles b','a.role_id = b.id','left');
        $builder->select($columns);
        if(count($whereParams) > 0)
        {
            $builder->where($whereParams);
        }
        $builder->orderBy('a.id','DESC');
        $query = $builder->get();
        return  $query->getResultArray();
    }

    ////////////////////////////////////////////////////////////
    ///// UserController->addUser()
    ////////////////////////////////////////////////////////////
    public function addUser($arrData)
    {
        try {
            $this->db->transStart();
                $builder = $this->db->table('users');
                $builder->insert($arrData);
                $insertId = $this->db->insertID();
            $this->db->transComplete();
            return ($this->db->transStatus() === TRUE)? $insertId : 0;
        } catch (PDOException $e) {
            throw $e;
        }
    }

    ////////////////////////////////////////////////////////////
    ///// UserController->selectUser()
    ///// NavigationController->adminMaintenanceUsers()
    ///// NavigationController->adminMaintenanceRoles()
    ////////////////////////////////////////////////////////////
    public function selectUser($userId)
    {
        $columns = [
            'a.id',
            'a.role_id',
            '(SELECT role_name FROM roles WHERE id = a.role_id) as role_name',
            'a.first_name',
            'a.last_name',
            'a.mobile_number',
            'a.email_address',
            'a.user_status',
            'a.user_image',
            'a.access_modules'
        ];

        $builder = $this->db->table('users a');
        $builder->select($columns);
        $builder->where('a.id',$userId);
        $query = $builder->get();
        return  $query->getRowArray();
    }

    ////////////////////////////////////////////////////////////
    ///// UserController->editUser()
    ////////////////////////////////////////////////////////////
    public function editUser($arrData, $userId)
    {
        try {
            $this->db->transStart();
                $builder = $this->db->table('users');
                $builder->where(['id'=>$userId]);
                $builder->update($arrData);
            $this->db->transComplete();
            return ($this->db->transStatus() === TRUE)? 1 : 0;
        } catch (PDOException $e) {
            throw $e;
        }
    }

    ////////////////////////////////////////////////////////////
    ///// UserController->removeUser()
    ////////////////////////////////////////////////////////////
    public function removeUser($userId)
    {
        try {
            $this->db->transStart();
                $builder = $this->db->table('users');
                $builder->where(['id'=>$userId]);
                $builder->delete();
            $this->db->transComplete();
            return ($this->db->transStatus() === TRUE)? 1 : 0;
        } catch (PDOException $e) {
            throw $e;
        }
    }
}
