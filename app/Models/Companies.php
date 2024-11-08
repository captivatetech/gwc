<?php

namespace App\Models;

use CodeIgniter\Model;

class Companies extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'companies';
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
    ///// EmployeeController->editRepresentativeInformation()
    ////////////////////////////////////////////////////////////
    public function getLatestCompanyCode()
    {
        $columns = [
            'a.id',
            'a.company_code'
        ];

        $builder = $this->db->table('companies a');
        $builder->select($columns);
        $builder->orderBy('a.id','DESC');
        $builder->limit(1);
        $query = $builder->get();
        return  $query->getRowArray();
    }

    ////////////////////////////////////////////////////////////
    ///// EmployeeController->editRepresentativeInformation()
    ////////////////////////////////////////////////////////////
    public function addCompany($arrData)
    {
        try {
            $this->db->transStart();
                $builder = $this->db->table('companies');
                $builder->insert($arrData);
                $insertId = $this->db->insertID();
            $this->db->transComplete();
            return ($this->db->transStatus() === TRUE)? $insertId : 0;
        } catch (PDOException $e) {
            throw $e;
        }
    }


    ////////////////////////////////////////////////////////////
    ///// LoanController->e_submitSalaryAdvanceApplication()
    ////////////////////////////////////////////////////////////
    public function selectCompany($companyId)
    {
        $columns = [
            'a.id',
            'a.company_code',
            'a.company_name',
            'a.company_address',
            'a.company_email',
            'a.mobile_number',
            'a.telephone_number',
            'a.company_website',
            'a.business_type',
            'a.business_industry',
            'a.tax_identification_number'
        ];

        $builder = $this->db->table('companies a');
        $builder->select($columns);
        $builder->where('a.id',$companyId);
        $query = $builder->get();
        return  $query->getRowArray();
    }



    ////////////////////////////////////////////////////////////
    ///// CompanyController->r_selectCompanyInformation()
    ////////////////////////////////////////////////////////////
    public function r_selectCompanyInformation($companyId)
    {
        $columns = [
            'a.id',
            'a.company_code',
            'a.company_name',
            'a.company_address',
            'a.company_email',
            'a.mobile_number',
            'a.telephone_number',
            'a.company_website',
            'a.business_type',
            'a.business_industry',
            'a.tax_identification_number'
        ];

        $builder = $this->db->table('companies a');
        $builder->select($columns);
        $builder->where('a.id',$companyId);
        $query = $builder->get();
        return  $query->getRowArray();
    }

    ////////////////////////////////////////////////////////////
    ///// CompanyController->r_editCompanyInformation()
    ////////////////////////////////////////////////////////////
    public function r_editCompanyInformation($arrData, $companyId)
    {
        try {
            $this->db->transStart();
                $builder = $this->db->table('companies');
                $builder->where(['id'=>$companyId]);
                $builder->update($arrData);
            $this->db->transComplete();
            return ($this->db->transStatus() === TRUE)? 1 : 0;
        } catch (PDOException $e) {
            throw $e;
        }
    }






    ////////////////////////////////////////////////////////////
    ///// CompanyDocumentController->r_loadCompanyDocuments()
    ////////////////////////////////////////////////////////////
    public function r_loadCompanyDocuments($companyId, $businessType)
    {
        $columns = [
            'a.id',
            'a.company_id',
            'a.document_code',
            'a.document_name',
            'a.document_file',
            'a.document_status'
        ];

        $builder = $this->db->table('company_documents a');
        $builder->select($columns);
        $builder->where('a.company_id', $companyId);
        $builder->like('a.document_code', $businessType, 'both');
        $query = $builder->get();
        return  $query->getResultArray();
    }

    ////////////////////////////////////////////////////////////
    ///// CompanyDocumentController->r_selectCompanyDocument()
    ///// CompanyDocumentController->r_editCompanyDocument()
    ////////////////////////////////////////////////////////////
    public function r_selectCompanyDocument($documentId)
    {
        $columns = [
            'a.id',
            'a.company_id',
            'a.document_code',
            'a.document_name',
            'a.document_file',
            'a.document_status'
        ];

        $builder = $this->db->table('company_documents a');
        $builder->select($columns);
        $builder->where('a.id', $documentId);
        $query = $builder->get();
        return  $query->getRowArray();
    }

    ////////////////////////////////////////////////////////////
    ///// CompanyDocumentController->r_addCompanyDocument()
    ////////////////////////////////////////////////////////////
    public function r_addCompanyDocument($arrData)
    {
        try {
            $this->db->transStart();
                $builder = $this->db->table('company_documents');
                $builder->insert($arrData);
                $insertId = $this->db->insertID();
            $this->db->transComplete();
            return ($this->db->transStatus() === TRUE)? $insertId : 0;
        } catch (PDOException $e) {
            throw $e;
        }
    }

    ////////////////////////////////////////////////////////////
    ///// CompanyDocumentController->r_editCompanyDocument()
    ////////////////////////////////////////////////////////////
    public function r_editCompanyDocument($arrData, $documentId)
    {
        try {
            $this->db->transStart();
                $builder = $this->db->table('company_documents');
                $builder->where(['id'=>$documentId]);
                $builder->update($arrData);
            $this->db->transComplete();
            return ($this->db->transStatus() === TRUE)? 1 : 0;
        } catch (PDOException $e) {
            throw $e;
        }
    }






    ////////////////////////////////////////////////////////////
    ///// CompanyController->r_selectCompanySettings()
    ////////////////////////////////////////////////////////////
    public function r_selectCompanySettings($companyId)
    {
        $columns = [
            'a.id',
            'a.bank_depository',
            'a.branch_name',
            'a.branch_code',
            'a.payroll_payout_date1',
            'a.cut_off_min_date1',
            'a.cut_off_max_date1',
            'a.payroll_payout_date2',
            'a.cut_off_min_date2',
            'a.cut_off_max_date2',
            'a.hr_user',
            'a.bpo_user'
        ];

        $builder = $this->db->table('companies a');
        $builder->select($columns);
        $builder->where('a.id',$companyId);
        $query = $builder->get();
        return  $query->getRowArray();
    }

    ////////////////////////////////////////////////////////////
    ///// CompanyController->r_editCompanySettings()
    ////////////////////////////////////////////////////////////
    public function r_editCompanySettings($arrData, $companyId)
    {
        try {
            $this->db->transStart();
                $builder = $this->db->table('companies');
                $builder->where(['id'=>$companyId]);
                $builder->update($arrData);
            $this->db->transComplete();
            return ($this->db->transStatus() === TRUE)? 1 : 0;
        } catch (PDOException $e) {
            throw $e;
        }
    }


    ////////////////////////////////////////////////////////////
    ///// CompanyController->r_loadCompanyRepresentatives()
    ////////////////////////////////////////////////////////////
    public function r_loadCompanyRepresentatives($companyId)
    {
        $columns = [
            'a.id',
            'a.company_id',
            'a.first_name',
            'a.middle_name',
            'a.last_name',
            'a.email_address',
            'a.position',
            'a.user_role'
        ];

        $builder = $this->db->table('employees a');
        $builder->select($columns);
        $builder->where('a.company_id',$companyId);
        $query = $builder->get();
        return  $query->getResultArray();
    }

    ////////////////////////////////////////////////////////////
    ///// CompanyController->r_addCompanyHR()
    ///// CompanyController->r_addCompanyBPO()
    ////////////////////////////////////////////////////////////
    public function r_addCompanyRepresentative($arrData)
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
    ///// CompanyController->r_editCompanyHR()
    ///// CompanyController->r_editCompanyBPO()
    ////////////////////////////////////////////////////////////
    public function r_editCompanyRepresentative($arrData, $representativeId)
    {
        try {
            $this->db->transStart();
                $builder = $this->db->table('employees');
                $builder->where(['id'=>$representativeId]);
                $builder->update($arrData);
            $this->db->transComplete();
            return ($this->db->transStatus() === TRUE)? 1 : 0;
        } catch (PDOException $e) {
            throw $e;
        }
    }













    ////////////////////////////////////////////////////////////
    ///// CompanyDocumentController->r_loadCompanyAttachment()
    ////////////////////////////////////////////////////////////
    public function r_loadCompanyAttachments($companyId)
    {
        $columns = [
            'a.id',
            'a.company_id',
            'a.document_code',
            'a.document_name',
            'a.document_file',
            'a.document_status'
        ];

        $builder = $this->db->table('company_documents a');
        $builder->select($columns);
        $builder->where('a.company_id', $companyId);
        $builder->like('a.document_code', 'Attachment','both');
        $query = $builder->get();
        return  $query->getResultArray();
    }

    ////////////////////////////////////////////////////////////
    ///// CompanyDocumentController->r_addCompanyAttachment()
    ////////////////////////////////////////////////////////////
    public function r_addCompanyAttachment($arrData)
    {
        try {
            $this->db->transStart();
                $builder = $this->db->table('company_documents');
                $builder->insert($arrData);
                $insertId = $this->db->insertID();
            $this->db->transComplete();
            return ($this->db->transStatus() === TRUE)? $insertId : 0;
        } catch (PDOException $e) {
            throw $e;
        }
    }

    ////////////////////////////////////////////////////////////
    ///// CompanyDocumentController->r_selectCompanyAttachment()
    ////////////////////////////////////////////////////////////
    public function r_selectCompanyAttachment($attachmentId)
    {
        $columns = [
            'a.id',
            'a.company_id',
            'a.document_code',
            'a.document_name',
            'a.document_file',
            'a.document_status'
        ];

        $builder = $this->db->table('company_documents a');
        $builder->select($columns);
        $builder->where('a.id', $attachmentId);
        $query = $builder->get();
        return  $query->getRowArray();
    }

    ////////////////////////////////////////////////////////////
    ///// CompanyDocumentController->r_editCompanyAttachment()
    ////////////////////////////////////////////////////////////
    public function r_editCompanyAttachment($arrData, $attachmentId)
    {
        try {
            $this->db->transStart();
                $builder = $this->db->table('company_documents');
                $builder->where(['id'=>$attachmentId]);
                $builder->update($arrData);
            $this->db->transComplete();
            return ($this->db->transStatus() === TRUE)? 1 : 0;
        } catch (PDOException $e) {
            throw $e;
        }
    }









    ////////////////////////////////////////////////////////////
    ///// CompanyDocumentController->a_loadCompanyDocuments()
    ////////////////////////////////////////////////////////////
    public function a_loadCompanyDocuments($companyId)
    {
        $columns = [
            'a.id',
            'a.company_id',
            'a.document_code',
            'a.document_name',
            'a.document_file',
            'a.document_status'
        ];

        $builder = $this->db->table('company_documents a');
        $builder->select($columns);
        $builder->where('a.company_id', $companyId);
        $query = $builder->get();
        return  $query->getResultArray();
    }

    ////////////////////////////////////////////////////////////
    ///// CompanyDocumentController->a_previewCompanyDocument()
    ////////////////////////////////////////////////////////////
    public function a_previewCompanyDocument($documentId)
    {
        $columns = [
            'a.id',
            'a.company_id',
            'a.document_code',
            'a.document_name',
            'a.document_file',
            'a.document_status'
        ];

        $builder = $this->db->table('company_documents a');
        $builder->select($columns);
        $builder->where('a.id', $documentId);
        $query = $builder->get();
        return  $query->getRowArray();
    }

    ////////////////////////////////////////////////////////////
    ///// CompanyDocumentController->a_acceptCompanyDocument()
    ////////////////////////////////////////////////////////////
    public function a_verifyCompanyDocument($arrData, $documentId)
    {
        try {
            $this->db->transStart();
                $builder = $this->db->table('company_documents');
                $builder->where(['id'=>$documentId]);
                $builder->update($arrData);
            $this->db->transComplete();
            return ($this->db->transStatus() === TRUE)? 1 : 0;
        } catch (PDOException $e) {
            throw $e;
        }
    }

    ////////////////////////////////////////////////////////////
    ///// CompanyDocumentController->a_failedCompanySubscription()
    ////////////////////////////////////////////////////////////
    public function a_failedCompanySubscription($arrData, $documentId)
    {
        try {
            $this->db->transStart();
                $builder = $this->db->table('product_subscriptions');
                $builder->where(['id'=>$documentId]);
                $builder->update($arrData);
            $this->db->transComplete();
            return ($this->db->transStatus() === TRUE)? 1 : 0;
        } catch (PDOException $e) {
            throw $e;
        }
    }

    ////////////////////////////////////////////////////////////
    ///// CompanyDocumentController->a_acceptCompanySubscription()
    ////////////////////////////////////////////////////////////
    public function a_acceptCompanySubscription($arrData, $documentId)
    {
        try {
            $this->db->transStart();
                $builder = $this->db->table('product_subscriptions');
                $builder->where(['id'=>$documentId]);
                $builder->update($arrData);
            $this->db->transComplete();
            return ($this->db->transStatus() === TRUE)? 1 : 0;
        } catch (PDOException $e) {
            throw $e;
        }
    }




    ////////////////////////////////////////////////////////////
    ///// LoanController->a_proceedDisbursement()
    ////////////////////////////////////////////////////////////
    public function a_selectCompanySettings($companyId)
    {
        $columns = [
            'a.id',
            'a.bank_depository',
            'a.branch_name',
            'a.branch_code',
            'a.payroll_payout_date1',
            'a.cut_off_min_date1',
            'a.cut_off_max_date1',
            'a.payroll_payout_date2',
            'a.cut_off_min_date2',
            'a.cut_off_max_date2',
            'a.hr_user',
            'a.bpo_user'
        ];

        $builder = $this->db->table('companies a');
        $builder->select($columns);
        $builder->where('a.id',$companyId);
        $query = $builder->get();
        return  $query->getRowArray();
    }


    ////////////////////////////////////////////////////////////
    ///// CompanyController->a_loadPartnersList()
    ////////////////////////////////////////////////////////////
    public function a_loadPartnersList()
    {
        $columns = [
            'a.id',
            'a.company_code',
            'a.company_name',
            'a.company_address',
            'a.company_email',
            'a.mobile_number',
            'a.telephone_number',
            'a.company_website',
            'a.business_type',
            'a.business_industry',
            '(SELECT company_credit_limit FROM product_subscriptions WHERE company_id=a.id) AS company_credit_limit',
            '(SELECT subscription_status FROM product_subscriptions WHERE company_id=a.id) AS subscription_status',
        ];

        $builder = $this->db->table('companies a');
        $builder->select($columns);
        $query = $builder->get();
        return  $query->getResultArray();
    }

    ////////////////////////////////////////////////////////////
    ///// CompanyController->a_loadPartnersList()
    ////////////////////////////////////////////////////////////
    public function a_selectCompany($companyId)
    {
        $columns = [
            'a.id',
            'a.company_code',
            'a.company_name',
            'a.company_address',
            'a.company_email',
            'a.mobile_number',
            'a.telephone_number',
            'a.company_website',
            'a.business_type',
            'a.business_industry',
            '(SELECT company_credit_limit FROM product_subscriptions WHERE company_id=a.id) AS company_credit_limit',
            '(SELECT subscription_status FROM product_subscriptions WHERE company_id=a.id) AS subscription_status',
        ];

        $builder = $this->db->table('companies a');
        $builder->select($columns);
        $builder->where('id',$companyId);
        $query = $builder->get();
        return  $query->getRowArray();
    }




    ////////////////////////////////////////////////////////////
    ///// CompanyDocumentController->a_loadCompanyAttachment()
    ////////////////////////////////////////////////////////////
    // public function a_loadCompanyAttachments($companyId)
    // {
    //     $columns = [
    //         'a.id',
    //         'a.company_id',
    //         'a.document_code',
    //         'a.document_name',
    //         'a.document_file',
    //         'a.document_status'
    //     ];

    //     $builder = $this->db->table('company_documents a');
    //     $builder->select($columns);
    //     $builder->where('a.company_id', $companyId);
    //     $builder->where('a.document_code', 'Employee-List-&-Swron-Statement');
    //     $query = $builder->get();
    //     return  $query->getResultArray();
    // }

    ////////////////////////////////////////////////////////////
    ///// CompanyDocumentController->a_previewCompanyAttachment()
    ////////////////////////////////////////////////////////////
    // public function a_previewCompanyAttachment($attachmentId)
    // {
    //     $columns = [
    //         'a.id',
    //         'a.company_id',
    //         'a.document_code',
    //         'a.document_name',
    //         'a.document_file',
    //         'a.document_status'
    //     ];

    //     $builder = $this->db->table('company_documents a');
    //     $builder->select($columns);
    //     $builder->where('a.company_id', $companyId);
    //     $builder->where('a.document_code', 'Employee-List-&-Swron-Statement');
    //     $query = $builder->get();
    //     return  $query->getResultArray();
    // }

    ////////////////////////////////////////////////////////////
    ///// CompanyDocumentController->a_acceptCompanyAttachment()
    ////////////////////////////////////////////////////////////
    // public function a_acceptCompanyAttachment($arrData, $attachmentId)
    // {
    //     try {
    //         $this->db->transStart();
    //             $builder = $this->db->table('company_documents');
    //             $builder->where(['id'=>$attachmentId]);
    //             $builder->update($arrData);
    //         $this->db->transComplete();
    //         return ($this->db->transStatus() === TRUE)? 1 : 0;
    //     } catch (PDOException $e) {
    //         throw $e;
    //     }
    // }

}
