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
        return  $query->getResultArray();
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
    ///// CompanyController->selectRepresentativeCompanyInformation()
    ///// CompanyController->selectRepresentativeCompanyDocument()
    ////////////////////////////////////////////////////////////
    public function selectRepresentativeCompanyInformation($companyId)
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
    ///// CompanyController->editRepresentativeCompanyInformation()
    ////////////////////////////////////////////////////////////
    public function editRepresentativeCompanyInformation($arrData, $companyId)
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
    ///// CompanyController->loadRepresentativeCompanyDocuments()
    ////////////////////////////////////////////////////////////
    public function loadRepresentativeCompanyDocuments($companyId)
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
    ///// CompanyController->selectRepresentativeCompanyDocument()
    ////////////////////////////////////////////////////////////
    public function selectRepresentativeCompanyDocument($documentId)
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
    ///// CompanyController->addRepresentativeCompanyDocument()
    ////////////////////////////////////////////////////////////
    public function addRepresentativeCompanyDocument($arrData)
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
    ///// CompanyController->editRepresentativeCompanyDocument()
    ////////////////////////////////////////////////////////////
    public function editRepresentativeCompanyDocument($arrData, $documentId)
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
    ///// CompanyController->selectRepresentativeCompanySettings()
    ////////////////////////////////////////////////////////////
    public function selectRepresentativeCompanySettings($companyId)
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
    ///// CompanyController->editRepresentativeCompanySettings()
    ////////////////////////////////////////////////////////////
    public function editRepresentativeCompanySettings($arrData, $companyId)
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

}
