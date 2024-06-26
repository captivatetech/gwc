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
}
