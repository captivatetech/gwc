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
    ///// CompanyController->r_addCompanyHR()
    ///// CompanyController->r_editCompanyHR()
    ///// CompanyController->r_addCompanyBPO()
    ///// CompanyController->r_editCompanyBPO()
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
    ///// NavigationController->employeeEmailVerification()
    ///// IndexController->e_emailVerification()
    ///// IndexController->forgotPassword()
    ////////////////////////////////////////////////////////////
    public function validateEmployeeEmail($whereParams)
    {
        $columns = [
            'a.id',
            'a.first_name',
            'a.last_name',
            'a.email_address',
            'a.user_type'
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
    ///// IndexController->e_emailVerification()
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
    ///// IndexController->forgotPassword()
    ////////////////////////////////////////////////////////////
    public function forgotPassword($arrData, $emailAddress)
    {
        try {
            $this->db->transStart();
                $builder = $this->db->table('employees');
                $builder->where(['email_address'=>$emailAddress]);
                $builder->update($arrData);
            $this->db->transComplete();
            return ($this->db->transStatus() === TRUE)? 1 : 0;
        } catch (PDOException $e) {
            throw $e;
        }
    }

    ////////////////////////////////////////////////////////////
    ///// IndexController->changePassword()
    ////////////////////////////////////////////////////////////
    public function validateAuthCode($whereParams)
    {
        $columns = [
            'a.id',
            'a.first_name',
            'a.last_name',
            'a.email_address',
            'a.user_type'
        ];
        
        $builder = $this->db->table('employees a');
        $builder->select($columns);
        $builder->where($whereParams);
        $query = $builder->get();
        return  $query->getRowArray();
    }

    ////////////////////////////////////////////////////////////
    ///// IndexController->changePassword()
    ////////////////////////////////////////////////////////////
    public function changePassword($arrData, $whereParams)
    {
        try {
            $this->db->transStart();
                $builder = $this->db->table('employees');
                $builder->where($whereParams);
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
    ///// LoanController->e_submitSalaryAdvanceApplication()
    ////////////////////////////////////////////////////////////
    public function selectEmployee($employeeId)
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
            'a.profile_picture'
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
    ///// PaymentController->r_submitPayment()
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
            'b.company_code',
            'b.business_type',
            'b.hr_user',
            'b.bpo_user',
            'b.company_code',
            'b.bank_depository',
            'c.subscription_status',
            'c.access_status'
        ];

        $builder = $this->db->table('employees a');
        $builder->select($columns);
        $builder->join('companies b','a.company_id = b.id','left');
        $builder->join('product_subscriptions c','c.company_id = b.id','left');
        $builder->where('a.id',$employeeId);
        $query = $builder->get();
        return  $query->getRowArray();
    }














    ////////////////////////////////////////////////////////////
    ///// EmployeeController->selectRepresentativeInformation()
    ///// EmployeeController->editRepresentativeInformation()
    ////////////////////////////////////////////////////////////
    public function selectRepresentativeInformation($employeeId)
    {
        $columns = [
            'a.id',
            'a.company_id',
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
    ///// EmployeeIdentityController->loadRepresentativeIdentifications()
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
    ///// EmployeeIdentityController->addRepresentativeIdentification()
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
    ///// EmployeeIdentityController->selectRepresentativeIdentification()
    ///// EmployeeIdentityController->removeRepresentativeIdentification()
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
    ///// EmployeeIdentityController->removeRepresentativeIdentification()
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


    ////////////////////////////////////////////////////////////
    ///// CompanyController->r_loadCompanyRepresentativeIdentifications()
    ////////////////////////////////////////////////////////////
    public function r_loadCompanyRepresentativeIdentifications($employeeId, $category)
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
            'a.id_status'
        ];

        $builder = $this->db->table('employee_identities a');
        $builder->select($columns);
        $builder->where('a.employee_id',$employeeId);
        $builder->where('a.category',$category);
        $query = $builder->get();
        return  $query->getResultArray();
    }

    ////////////////////////////////////////////////////////////
    ///// CompanyController->r_addRepresentativeIdentification()
    ////////////////////////////////////////////////////////////
    public function r_addRepresentativeIdentification($arrData)
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
    ///// CompanyController->r_selectRepresentativeIdentification()
    ////////////////////////////////////////////////////////////
    public function r_selectRepresentativeIdentification($identificationId)
    {
        $columns = [
            'a.id',
            'a.id_picture'
        ];

        $builder = $this->db->table('employee_identities a');
        $builder->select($columns);
        $builder->where('a.id',$identificationId);
        $query = $builder->get();
        return  $query->getRowArray();
    }

    ////////////////////////////////////////////////////////////
    ///// CompanyController->r_editRepresentativeIdentification()
    ////////////////////////////////////////////////////////////
    public function r_editRepresentativeIdentification($arrData, $identificationId)
    {
        try {
            $this->db->transStart();
                $builder = $this->db->table('employee_identities');
                $builder->where(['id'=>$identificationId]);
                $builder->update($arrData);
            $this->db->transComplete();
            return ($this->db->transStatus() === TRUE)? 1 : 0;
        } catch (PDOException $e) {
            throw $e;
        }
    }









    ////////////////////////////////////////////////////////////
    ///// EmployeeController->r_addEmployee()
    ///// EmployeeController->r_editEmployee()
    ////////////////////////////////////////////////////////////
    public function r_validateEmployeeEmail($whereParams)
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
    ///// EmployeeController->r_loadEmployees()
    ////////////////////////////////////////////////////////////
    public function r_loadEmployees($companyId)
    {
        $columns = [
            'a.id',
            'a.company_id',
            'a.identification_number',
            'a.first_name',
            'a.middle_name',
            'a.last_name',
            'a.marital_status',
            'a.email_address',
            'a.mobile_number',
            'a.permanent_address',
            'a.department',
            'a.position',
            'a.tax_identification_number',
            'a.date_hired',
            'a.minimum_credit_amount',
            'a.maximum_credit_amount',
            'a.employee_status'
        ];

        $builder = $this->db->table('employees a');
        $builder->select($columns);
        $builder->where('a.company_id',$companyId);
        $builder->where('a.user_type','employee');
        $query = $builder->get();
        return  $query->getResultArray();
    }

    ////////////////////////////////////////////////////////////
    ///// EmployeeController->_generateIdentificationNumber()
    ////////////////////////////////////////////////////////////
    public function getLastIdentificationNumber()
    {
        $columns = [
            'a.id',
            'a.identification_number',
            'b.company_code'
        ];

        $builder = $this->db->table('employees a');
        $builder->join('companies b','a.company_id = b.id','full');
        $builder->select($columns);
        $builder->orderBy('a.id','DESC');
        $builder->limit(1);
        $query = $builder->get();
        return  $query->getRowArray();
    }

    ////////////////////////////////////////////////////////////
    ///// EmployeeController->r_addEmployee()
    ///// EmployeeController->r_importEmployees()
    ////////////////////////////////////////////////////////////
    public function r_addEmployee($arrData)
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
    ///// EmployeeController->r_selectEmployee()
    ////////////////////////////////////////////////////////////
    public function r_selectEmployee($employeeId)
    {
        $columns = [
            'a.id',
            'a.company_id',
            'a.identification_number',
            'a.first_name',
            'a.middle_name',
            'a.last_name',
            'a.marital_status',
            'a.email_address',
            'a.mobile_number',
            'a.permanent_address',
            'a.department',
            'a.position',
            'a.tax_identification_number',
            'a.date_hired',
            'a.employment_status',
            'a.years_stayed',
            'a.gross_salary',
            'a.net_salary',
            'a.minimum_credit_amount',
            'a.maximum_credit_amount',
            'a.payroll_bank_number',
            'a.employee_status'
        ];

        $builder = $this->db->table('employees a');
        $builder->select($columns);
        $builder->where('a.id',$employeeId);
        $query = $builder->get();
        return  $query->getRowArray();
    }

    ////////////////////////////////////////////////////////////
    ///// EmployeeController->r_editEmployee()
    ///// EmployeeController->a_sendEmployeeEmailVerication()
    ////////////////////////////////////////////////////////////
    public function r_editEmployee($arrData, $employeeId)
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
    ///// EmployeeController->r_removeEmployee()
    ////////////////////////////////////////////////////////////
    public function r_removeEmployee($employeeId)
    {
        try {
            $this->db->transStart();
                $builder = $this->db->table('employees');
                $builder->where(['id'=>$employeeId]);
                $builder->delete();
            $this->db->transComplete();
            return ($this->db->transStatus() === TRUE)? 1 : 0;
        } catch (PDOException $e) {
            throw $e;
        }
    }


    ////////////////////////////////////////////////////////////
    ///// EmployeeController->r_printEmployeeList()
    ////////////////////////////////////////////////////////////
    public function r_loadSelectedEmployees($arrEmployeeIds)
    {
        $columns = [
            'a.id',
            'a.company_id',
            'a.identification_number',
            'a.first_name',
            'a.middle_name',
            'a.last_name',
            'a.marital_status',
            'a.email_address',
            'a.mobile_number',
            'a.permanent_address',
            'a.department',
            'a.position',
            'a.tax_identification_number',
            'a.date_hired',
            'a.employment_status',
            'a.years_stayed',
            'a.gross_salary',
            'a.net_salary',
            'a.minimum_credit_amount',
            'a.maximum_credit_amount',
            'a.payroll_bank_number',
            'a.employee_status'
        ];

        $builder = $this->db->table('employees a')->select($columns);
        $builder->whereIn('a.id',$arrEmployeeIds);
        $query = $builder->get();
        return  $query->getResultArray();
    }


    ////////////////////////////////////////////////////////////
    ///// EmployeeController->r_mappingAndDuplicateHandling()
    ////////////////////////////////////////////////////////////
    public function checkDuplicateRowsFromEmployeeList($arrWhereInColumns)
    {
        $columns = [
            'a.id',
            'a.company_id',
            'a.identification_number',
            'a.first_name',
            'a.middle_name',
            'a.last_name',
            'a.marital_status',
            'a.email_address',
            'a.mobile_number',
            'a.permanent_address',
            'a.department',
            'a.position',
            'a.tax_identification_number',
            'a.date_hired',
            'a.employment_status',
            'a.years_stayed',
            'a.gross_salary',
            'a.net_salary',
            'a.minimum_credit_amount',
            'a.maximum_credit_amount',
            'a.payroll_bank_number',
            'a.employee_status'
        ];

        $builder = $this->db->table('employees a')->select($columns);
        $builder->groupStart();
        foreach ($arrWhereInColumns as $key => $value) 
        {
            $builder->orGroupStart();
                $builder->whereIn('a.'.$key,$value);
            $builder->groupEnd();
        }
        $builder->groupEnd();
        $query = $builder->get();
        return  $query->getResultArray();
    }





    ////////////////////////////////////////////////////////////
    ///// ProductSubscriptionController->a_selectCompanyRepresentative()
    ///// ProductSubscriptionController->a_failedCompanySubscription()
    ///// ProductSubscriptionController->a_acceptCompanySubscription()
    ////////////////////////////////////////////////////////////
    public function a_selectCompanyRepresentative($subscriptionId)
    {
        $columns = [
            'b.company_email',
            'c.email_address'
        ];
        $builder = $this->db->table('product_subscriptions a');
        $builder->select($columns);
        $builder->join('companies b','a.company_id = b.id','left');
        $builder->join('employees c','b.id = c.company_id','left');
        $builder->where('a.id',$subscriptionId);
        $query = $builder->get();
        return  $query->getRowArray();
    }

    ////////////////////////////////////////////////////////////
    ///// EmployeeController->a_loadCompanyEmployees()
    ///// EmployeeController->a_acceptCompanySubscription()
    ////////////////////////////////////////////////////////////
    public function a_loadCompanyEmployees($companyId, $type = "")
    {
        $columns = [
            'a.id',
            'a.company_id',
            'a.identification_number',
            'a.first_name',
            'a.middle_name',
            'a.last_name',
            'a.marital_status',
            'a.email_address',
            'a.mobile_number',
            'a.permanent_address',
            'a.department',
            'a.position',
            'a.tax_identification_number',
            'a.date_hired',
            'a.years_stayed',
            'a.gross_salary',
            'a.net_salary',
            'a.minimum_credit_amount',
            'a.maximum_credit_amount',
            'a.payroll_bank_number',
            'a.employee_status'
        ];

        $builder = $this->db->table('employees a');
        $builder->select($columns);
        $builder->where('a.company_id',$companyId);
        if($type == 'employee')
        {
            $builder->where('a.user_type','employee');
        }
        $query = $builder->get();
        return  $query->getResultArray();
    }

    ////////////////////////////////////////////////////////////
    ///// EmployeeController->a_sendEmployeeEmailVerication()
    ////////////////////////////////////////////////////////////
    public function a_selectCompanyEmployee($employeeId)
    {
        $columns = [
            'a.id',
            'a.company_id',
            'a.identification_number',
            'a.first_name',
            'a.middle_name',
            'a.last_name',
            'a.marital_status',
            'a.email_address',
            'a.mobile_number',
            'a.permanent_address',
            'a.department',
            'a.position',
            'a.tax_identification_number',
            'a.date_hired',
            'a.years_stayed',
            'a.gross_salary',
            'a.net_salary',
            'a.minimum_credit_amount',
            'a.maximum_credit_amount',
            'a.payroll_bank_number',
            'a.employee_status'
        ];

        $builder = $this->db->table('employees a');
        $builder->select($columns);
        $builder->where('a.id',$employeeId);
        $query = $builder->get();
        return  $query->getRowArray();
    }







    ////////////////////////////////////////////////////////////
    ///// EmployeeController->e_loadCredetLimit()
    ////////////////////////////////////////////////////////////
    public function e_loadCredetLimit($employeeId)
    {
        $columns = [
            'a.id',
            'a.minimum_credit_amount',
            'a.maximum_credit_amount',
            '(SELECT SUM(loan_amount) FROM loans WHERE employee_id = a.id) as total_loan'
        ];

        $builder = $this->db->table('employees a');
        $builder->select($columns);
        $builder->where('a.id',$employeeId);
        $query = $builder->get();
        return  $query->getRowArray();
    }

    ////////////////////////////////////////////////////////////
    ///// EmployeeController->e_selectEmployeeInformation()
    ////////////////////////////////////////////////////////////
    public function e_selectEmployeeInformation($employeeId)
    {
        $columns = [
            'a.id',
            'a.company_id',
            'a.identification_number',
            'a.first_name',
            'a.middle_name',
            'a.last_name',
            'a.marital_status',
            'a.email_address',
            'a.mobile_number',
            'a.permanent_address',
            'a.department',
            'a.position',
            'a.tax_identification_number',
            'a.date_hired',
            'a.employment_status',
            'a.years_stayed',
            'a.gross_salary',
            'a.net_salary',
            'a.minimum_credit_amount',
            'a.maximum_credit_amount',
            'a.payroll_bank_number',
            'a.employee_status'
        ];

        $builder = $this->db->table('employees a');
        $builder->select($columns);
        $builder->where('a.id',$employeeId);
        $query = $builder->get();
        return  $query->getRowArray();
    }





    ////////////////////////////////////////////////////////////
    ///// LoanController->e_submitSalaryAdvanceApplication()
    ////////////////////////////////////////////////////////////
    public function e_addEmployeeAssessment($arrData)
    {
        try {
            $this->db->transStart();
                $builder = $this->db->table('employee_assessments');
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
    public function a_selectEmployee($employeeId)
    {
        $columns = [
            'a.id',
            'a.email_address'
        ];

        $builder = $this->db->table('employees a');
        $builder->select($columns);
        $builder->where('a.id',$employeeId);
        $query = $builder->get();
        return  $query->getRowArray();
    }

    ////////////////////////////////////////////////////////////
    ///// LoanController->a_proceedDisbursement()
    ///// PaymentController->a_confirmPayment()
    ///// LoanController->e_submitSalaryAdvanceApplication()
    ////////////////////////////////////////////////////////////
    public function a_selectRepresentative($companyId)
    {
        $columns = [
            'a.id',
            'a.first_name',
            'a.last_name',
            'a.email_address'
        ];

        $builder = $this->db->table('employees a');
        $builder->select($columns);
        $builder->where('a.company_id',$companyId);
        $builder->where('a.user_type','representative');
        $query = $builder->get();
        return  $query->getRowArray();
    }

    ////////////////////////////////////////////////////////////
    ///// PaymentController->a_confirmPayment()
    ////////////////////////////////////////////////////////////
    public function a_loadEmployeeDetails($billingId)
    {
        $columns = [
            'a.id',
            'a.billing_amount as payment_amount',
            'b.account_number',
            '(SELECT payment_date FROM payments WHERE billing_id = a.billing_id) as payment_date',
            'c.email_address'
        ];

        $builder = $this->db->table('billing_details a');
        $builder->join('loans b','b.id = a.loan_id','full');
        $builder->join('employees c','c.id = b.employee_id','full');
        $builder->select($columns);
        $builder->where('a.billing_id',$billingId);
        $builder->where('a.payment_status','PENDING');
        $query = $builder->get();
        return  $query->getResultArray();
    }

}
