<?php

namespace App\Models;

use CodeIgniter\Model;

class Employees extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'employees';
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
    ///// IndexController->login()
    ////////////////////////////////////////////////////////////
    public function validateLogIn($logInRequirements)
    {
        $columns = [
            'a.id',
            'a.first_name',
            'a.last_name',
            'a.user_type'
        ];

        $where = [
            'a.email_address' => $logInRequirements['email_address'],
            'a.user_password' => $logInRequirements['user_password'],
            'a.user_status'   => 1 
        ];
    
        $builder = $this->db->table('employees a');
        $builder->select($columns);
        $builder->where($where);
        $query = $builder->get();
        return  $query->getRowArray();
    }

    ////////////////////////////////////////////////////////////
    ///// IndexController->createAccount()
    ///// NavigationController->representativeEmailVerification()
    ////////////////////////////////////////////////////////////
    public function validateRepresentativeEmail($whereParams)
    {
        $columns = [
            'a.id',
            'a.first_name',
            'a.last_name',
            'a.email_address'
        ];
        
        $builder = $this->db->table('employees a');
        $builder->select($columns);
        $builder->where($whereParams);
        $query = $builder->get();
        return  $query->getRowArray();
    }

    ////////////////////////////////////////////////////////////
    ///// IndexController->createAccount()
    ////////////////////////////////////////////////////////////
    public function createAccount($arrData)
    {
        try {
            $this->db->transStart();
                $builder = $this->db->table('employees');
                $builder->insert($arrData);
                $insertId = $this->db->insertID();
            $this->db->transComplete();
            return ($this->db->transStatus() === TRUE)? $insertId : 0;
        } catch (PDOException $e) {
            throw $e;
        }
    }

    ////////////////////////////////////////////////////////////
    ///// NavigationController->representativeEmailVerification()
    ////////////////////////////////////////////////////////////
    public function editEmployee($arrData, $employeeId)
    {
        try {
            $this->db->transStart();
                $builder = $this->db->table('employees');
                $builder->where(['id'=>$employeeId]);
                $builder->update($arrData);
            $this->db->transComplete();
            return ($this->db->transStatus() === TRUE)? 1 : 0;
        } catch (PDOException $e) {
            throw $e;
        }
    }











    ////////////////////////////////////////////////////////////
    ///// NavigationController->employeeProfile()
    ///// NavigationController->employeeDashboard()
    ///// NavigationController->employeeLoanAccounts()
    ////////////////////////////////////////////////////////////
    public function selectEmployee($employeeId)
    {
        $columns = [
            'a.id',
            'a.first_name',
            'a.middle_name',
            'a.last_name',
            'a.email_address',
            'a.position',
            'a.user_type'
        ];

        $builder = $this->db->table('employees a');
        $builder->select($columns);
        $builder->where('a.id',$employeeId);
        $query = $builder->get();
        return  $query->getRowArray();
    }

    ////////////////////////////////////////////////////////////
    ///// NavigationController->representativeProfile()
    ///// NavigationController->representativeDashboard()
    ///// NavigationController->representativeCompanyProfile()
    ///// NavigationController->representativeFinancingProducts()
    ///// NavigationController->representativeEmployeeList()
    ///// NavigationController->representativeBillingAndPayments()
    ///// NavigationController->representativeMaintenanceUsers()
    ///// NavigationController->representativeMaintenanceRoles()
    ///// NavigationController->representativeFaqs()
    ////////////////////////////////////////////////////////////
    public function selectRepresentative($employeeId)
    {
        $columns = [
            'a.id',
            'a.company_id',
            'a.first_name',
            'a.middle_name',
            'a.last_name',
            'a.email_address',
            'a.position',
            'a.user_type',
            'a.profile_picture',
            'b.business_type'
        ];

        $builder = $this->db->table('employees a');
        $builder->select($columns);
        $builder->join('companies b','a.company_id = b.id','left');
        $builder->where('a.id',$employeeId);
        $query = $builder->get();
        return  $query->getRowArray();
    }














    ////////////////////////////////////////////////////////////
    ///// EmployeeController->selectRepresentativeInformation()
    ////////////////////////////////////////////////////////////
    public function selectRepresentativeInformation($employeeId)
    {
        $columns = [
            'a.id',
            'a.first_name',
            'a.middle_name',
            'a.last_name',
            'a.email_address',
            'a.position',
            'a.user_type'
        ];

        $builder = $this->db->table('employees a');
        $builder->select($columns);
        $builder->where('a.id',$employeeId);
        $query = $builder->get();
        return  $query->getRowArray();
    }

    ////////////////////////////////////////////////////////////
    ///// EmployeeController->editRepresentativeInformation()
    ////////////////////////////////////////////////////////////
    public function editRepresentativeInformation($arrData, $employeeId)
    {
        try {
            $this->db->transStart();
                $builder = $this->db->table('employees');
                $builder->where(['id'=>$employeeId]);
                $builder->update($arrData);
            $this->db->transComplete();
            return ($this->db->transStatus() === TRUE)? 1 : 0;
        } catch (PDOException $e) {
            throw $e;
        }
    }

    ////////////////////////////////////////////////////////////
    ///// EmployeeController->loadRepresentativeIdentifications()
    ////////////////////////////////////////////////////////////
    public function loadRepresentativeIdentifications($employeeId)
    {
        $columns = [
            'a.id',
            'a.employee_id',
            'a.type',
            'a.category',
            'a.id_number',
            'a.id_picture',
            'a.date_issued',
            'a.placed_issued',
            'a.issued_by',
            'a.expiry_date',
            'a.id_status',
            'a.created_by',
            'a.created_date'
        ];

        $builder = $this->db->table('employee_identities a');
        $builder->select($columns);
        $builder->where('a.employee_id',$employeeId);
        $query = $builder->get();
        return  $query->getResultArray();
    }

    ////////////////////////////////////////////////////////////
    ///// EmployeeController->addRepresentativeIdentification()
    ////////////////////////////////////////////////////////////
    public function addRepresentativeIdentification($arrData)
    {
        try {
            $this->db->transStart();
                $builder = $this->db->table('employee_identities');
                $builder->insert($arrData);
                $insertId = $this->db->insertID();
            $this->db->transComplete();
            return ($this->db->transStatus() === TRUE)? $insertId : 0;
        } catch (PDOException $e) {
            throw $e;
        }
    }

    ////////////////////////////////////////////////////////////
    ///// EmployeeController->selectRepresentativeIdentification()
    ////////////////////////////////////////////////////////////
    public function selectRepresentativeIdentification($identificationId)
    {
        $columns = [
            'a.id',
            'a.employee_id',
            'a.type',
            'a.category',
            'a.id_number',
            'a.id_picture',
            'a.date_issued',
            'a.placed_issued',
            'a.issued_by',
            'a.expiry_date',
            'a.id_status',
            'a.created_by',
            'a.created_date'
        ];

        $builder = $this->db->table('employee_identities a');
        $builder->select($columns);
        $builder->where('a.id',$identificationId);
        $query = $builder->get();
        return  $query->getRowArray();
    }

    ////////////////////////////////////////////////////////////
    ///// EmployeeController->removeRepresentativeIdentification()
    ////////////////////////////////////////////////////////////
    public function removeRepresentativeIdentification($identificationId)
    {
        try {
            $this->db->transStart();
                $builder = $this->db->table('employee_identities');
                $builder->where(['id'=>$identificationId]);
                $builder->delete();
            $this->db->transComplete();
            return ($this->db->transStatus() === TRUE)? 1 : 0;
        } catch (PDOException $e) {
            throw $e;
        }
    }

    ////////////////////////////////////////////////////////////
    ///// EmployeeController->selectRepresentativeProfilePicture()
    ///// EmployeeController->editRepresentativeProfilePicture()
    ////////////////////////////////////////////////////////////
    public function selectRepresentativeProfilePicture($employeeId)
    {
        $columns = [
            'a.id',
            'a.profile_picture'
        ];

        $builder = $this->db->table('employees a');
        $builder->select($columns);
        $builder->where('a.id',$employeeId);
        $query = $builder->get();
        return  $query->getRowArray();
    }

    ////////////////////////////////////////////////////////////
    ///// EmployeeController->editRepresentativeProfilePicture()
    ////////////////////////////////////////////////////////////
    public function editRepresentativeProfilePicture($arrData, $employeeId)
    {
        try {
            $this->db->transStart();
                $builder = $this->db->table('employees');
                $builder->where(['id'=>$employeeId]);
                $builder->update($arrData);
            $this->db->transComplete();
            return ($this->db->transStatus() === TRUE)? 1 : 0;
        } catch (PDOException $e) {
            throw $e;
        }
    }
}
