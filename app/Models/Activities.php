<?php

namespace App\Models;

use CodeIgniter\Model;

class Activities extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'activities';
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

    //////////////////////////////////////////////
    ///// AuditTrailController->a_loadActivities()
    //////////////////////////////////////////////
    public function a_loadActivities()
    {
        $columns = [
            'a.id',
            'a.user_id',
            'a.login_code',
            'a.module_name',
            'a.activity_type',
            'a.activity_details',
            'a.created_date'
        ];

        $builder = $this->db->table('user_activities a');
        $builder->select($columns);
        $query = $builder->get();
        return  $query->getResultArray();
    }


    /////////////////////////////////////////////
    //// CompanyController->r_editCompanyInformation()
    //// CompanyController->r_editCompanySettings()
    //// CompanyController->r_addCompanyHR()
    //// CompanyController->r_editCompanyHR()
    //// CompanyController->r_addCompanyBPO()
    //// CompanyController->r_editCompanyBPO()
    //// CompanyController->r_addRepresentativeIdentification()
    //// CompanyController->r_editRepresentativeIdentification()
    //// CompanyDocumentController->r_addCompanyDocument()
    //// CompanyDocumentController->r_editCompanyDocument()
    //// CompanyDocumentController->r_addCompanyAttachment()
    //// CompanyDocumentController->r_editCompanyAttachment()
    //// CompanyDocumentController->a_verifyCompanyDocument()
    //// EmployeeController->editRepresentativeInformation()
    //// EmployeeController->editRepresentativeProfilePicture()
    //// EmployeeController->r_addEmployee()
    //// EmployeeController->r_editEmployee()
    //// EmployeeController->r_removeEmployee()
    //// EmployeeIdentificationController->addRepresentativeIdentification()
    //// EmployeeIdentificationController->removeRepresentativeIdentification()
    //// FaqController->addAdminFaq()
    //// FaqController->editAdminFaq()
    //// FaqController->removeAdminFaq()
    //// FeeController->addAdminFee()
    //// FeeController->editAdminFee()
    //// FeeController->removeAdminFee()
    //// LoanController->e_submitSalaryAdvanceApplication()
    //// LoanController->r_submitSalaryAdvanceApplication()
    //// LoanController->a_approveApplication()
    //// LoanController->a_rejectApplication()
    //// LoanController->a_proceedDisbursement()
    //// PaymentController->a_confirmPayment()
    //// ProductSubscriptionController->r_addProductSubscription()
    //// ProductSubscriptionController->a_failedCompanySubscription()
    //// ProductSubscriptionController->a_acceptCompanySubscription()
    //// ProductSubscriptionController->r_submitAccessRequest()
    //// ProductSubscriptionController->a_editProductSubscriptionStatus()
    //// BankController->removeBank()
    //// BillingController->a_generateBillings()
    //// RoleController->addAdminRole()
    //// RoleController->editAdminRole()
    //// RoleController->removeAdminRole()
    //// UserController->addAdminUser()
    //// UserController->editAdminUser()
    //// UserController->removeAdminUser()
    //// UserController->changeAdminPassword()
    /////////////////////////////////////////////
    public function addUserActivity($arrData)
    {
        try {
            $this->db->transStart();
                $builder = $this->db->table('user_activities');
                $builder->insert($arrData);
                $insertId = $this->db->insertID();
            $this->db->transComplete();
            return ($this->db->transStatus() === TRUE)? $insertId : 0;
        } catch (PDOException $e) {
            throw $e;
        }
    }
}
