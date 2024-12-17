<?php

namespace App\Models;

use CodeIgniter\Model;

class Faqs extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'faqs';
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
    ///// FaqController->loadAdminFaqs()
    ////////////////////////////////////////////////////////////
    public function loadAdminFaqs()
    {
        $columns = [
            'a.id',
            'a.question',
            'a.answer',
            'a.faq_status',
            'a.created_by',
            'a.created_date',
            'a.updated_by',
            'a.updated_date'
        ];

        $builder = $this->db->table('faqs a');
        $builder->select($columns);
        $query = $builder->get();
        return  $query->getResultArray();
    }

    ////////////////////////////////////////////////////////////
    ///// FaqController->addAdminFaq()
    ////////////////////////////////////////////////////////////
    public function addAdminFaq($arrData)
    {
        try {
            $this->db->transStart();
                $builder = $this->db->table('faqs');
                $builder->insert($arrData);
                $insertId = $this->db->insertID();
            $this->db->transComplete();
            return ($this->db->transStatus() === TRUE)? $insertId : 0;
        } catch (PDOException $e) {
            throw $e;
        }
    }

    ////////////////////////////////////////////////////////////
    ///// FaqController->selectAdminFaq()
    ////////////////////////////////////////////////////////////
    public function selectAdminFaq($faqId)
    {
        $columns = [
            'a.id',
            'a.question',
            'a.answer',
            'a.faq_status',
            'a.created_by',
            'a.created_date',
            'a.updated_by',
            'a.updated_date'
        ];

        $builder = $this->db->table('faqs a');
        $builder->select($columns);
        $builder->where('a.id', $faqId);
        $query = $builder->get();
        return  $query->getRowArray();
    }

    ////////////////////////////////////////////////////////////
    ///// FaqController->editAdminFaq()
    ////////////////////////////////////////////////////////////
    public function editAdminFaq($arrData, $faqId)
    {
        try {
            $this->db->transStart();
                $builder = $this->db->table('faqs');
                $builder->where(['id'=>$faqId]);
                $builder->update($arrData);
            $this->db->transComplete();
            return ($this->db->transStatus() === TRUE)? 1 : 0;
        } catch (PDOException $e) {
            throw $e;
        }
    }

    ////////////////////////////////////////////////////////////
    ///// FaqController->removeAdminFaq()
    ////////////////////////////////////////////////////////////
    public function removeAdminFaq($faqId)
    {
        try {
            $this->db->transStart();
                $builder = $this->db->table('faqs');
                $builder->where(['id'=>$faqId]);
                $builder->delete();
            $this->db->transComplete();
            return ($this->db->transStatus() === TRUE)? 1 : 0;
        } catch (PDOException $e) {
            throw $e;
        }
    }
}
