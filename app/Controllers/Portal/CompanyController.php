<?php

namespace App\Controllers\Portal;

use App\Controllers\BaseController;

class CompanyController extends BaseController
{
    public function __construct()
    {
        $this->companies = model('Companies');
    }

    public function selectRepresentativeCompanyInformation()
    {
        $fields = $this->request->getGet();
        $arrData = $this->companies->selectRepresentativeCompanyInformation($fields['companyId']);
        return $this->response->setJSON($arrData);
    }

    public function editRepresentativeCompanyInformation()
    {
        $this->validation->setRules([
            'txt_businessName' => [
                'label'  => 'Business Name',
                'rules'  => 'required',
                'errors' => [
                    'required'    => 'Business Name is required',
                ],
            ],
            'txt_businessAddress' => [
                'label'  => 'Business Address',
                'rules'  => 'required',
                'errors' => [
                    'required'    => 'Business Address is required',
                ],
            ],
            'slc_industry' => [
                'label'  => 'Industry',
                'rules'  => 'required',
                'errors' => [
                    'required'    => 'Industry is required',
                ],
            ],
            'txt_mobileNumber' => [
                'label'  => 'Mobile Number',
                'rules'  => 'required',
                'errors' => [
                    'required'    => 'Mobile Number is required',
                ],
            ],
            'txt_telephoneNumber' => [
                'label'  => 'Telephone Number',
                'rules'  => 'required',
                'errors' => [
                    'required'    => 'Telephone Number is required',
                ],
            ],
            'txt_companyEmail' => [
                'label'  => 'Company Email',
                'rules'  => 'required',
                'errors' => [
                    'required'    => 'Company Email is required',
                ],
            ],
            'txt_companyWebsite' => [
                'label'  => 'Company Website',
                'rules'  => 'required',
                'errors' => [
                    'required'    => 'Company Website is required',
                ],
            ],
            'txt_taxIdentificationNumber' => [
                'label'  => 'TIN',
                'rules'  => 'required',
                'errors' => [
                    'required'    => 'TIN is required',
                ],
            ]
        ]);

        if($this->validation->withRequest($this->request)->run())
        {
            $fields = $this->request->getPost();
            
            if($fields['rdb_businessType'] != 'undefined')
            {
                $arrData = [
                    'company_name'              => $fields['txt_businessName'],
                    'company_address'           => $fields['txt_businessAddress'],
                    'company_email'             => $fields['txt_companyEmail'],
                    'mobile_number'             => $fields['txt_mobileNumber'],
                    'telephone_number'          => $fields['txt_telephoneNumber'],
                    'company_website'           => $fields['txt_companyWebsite'],
                    'business_industry'         => $fields['slc_industry'],
                    'business_type'             => $fields['rdb_businessType'],
                    'tax_identification_number' => $fields['txt_taxIdentificationNumber'],
                    'updated_by'                => $this->session->get('gwc_representative_id'),
                    'updated_date'              => date('Y-m-d H:i:s')
                ];

                $result = $this->companies->editRepresentativeCompanyInformation($arrData, $fields['txt_companyId']);
                if($result > 0)
                {
                    $msgResult[] = "Company Information updated successfully";
                }
                else
                {
                    $msgResult[] = "Something went wrong, please try again";
                    return $this->response->setStatusCode(401)->setJSON($msgResult);
                    exit();
                }
            }
            else
            {
                $msgResult[] = "Business type is required!";
                return $this->response->setStatusCode(401)->setJSON($msgResult);
                exit();
            }
        }
        else
        {
            $msgResult[] = $this->validation->getErrors();
            return $this->response->setStatusCode(401)->setJSON($msgResult);
            exit();
        }

        return $this->response->setJSON($msgResult);
    }

    public function loadRepresentativeCompanyDocuments()
    {
        $fields = $this->request->getGet();
        $arrData = $this->companies->loadRepresentativeCompanyDocuments($fields['companyId']);
        return $this->response->setJSON($arrData);
    }

    public function selectRepresentativeCompanyDocument()
    {
        $fields = $this->request->getGet();
        $arrData = $this->companies->selectRepresentativeCompanyDocument($fields['companyId']);
        return $this->response->setJSON($arrData);
    }

    public function addRepresentativeCompanyDocument()
    {
        $fields = $this->request->getPost();

        $arrData = [
            'company_id'        => $fields['txt_companyId'],
            'document_code'     => $fields['txt_documentCode'],
            'document_name'     => $fields['txt_documentName'],
            'document_status'   => '1',
            'created_by'        => $this->session->get('gwc_representative_id'),
            'created_date'      => date('Y-m-d H:i:s')
        ];

        /////////////////////////
        // document start
        /////////////////////////
        $pdfFile = $this->request->getFile('file_companyDocument');

        if($pdfFile != null)
        {
            $newFileName = $pdfFile->getRandomName();
            $pdfFile->move(ROOTPATH . 'public/assets/uploads/company/documents/', $newFileName);

            if($pdfFile->hasMoved())
            {
                $arrData['document_file'] = $newFileName;
            }
        }
        else
        {
            $arrData['document_file'] = NULL;
        }                
        ///////////////////////
        // document end
        ///////////////////////
        
        $result = $this->companies->addRepresentativeCompanyDocument($arrData);
        if($result > 0)
        {
            $msgResult[] = "Document added successfully";
        }
        else
        {
            $msgResult[] = "Something went wrong, please try again";
            return $this->response->setStatusCode(401)->setJSON($msgResult);
            exit();
        }

        return $this->response->setJSON($msgResult);
    }

    public function editRepresentativeCompanyDocument()
    {
        $fields = $this->request->getPost();

        $arrData = [
            'company_id'        => $fields['txt_companyId'],
            'document_code'     => $fields['txt_documentCode'],
            'document_name'     => $fields['txt_documentName'],
            'document_status'   => '1',
            'updated_by'        => $this->session->get('gwc_representative_id'),
            'updated_date'      => date('Y-m-d H:i:s')
        ];

        $documentId = $fields['txt_documentId'];

        /////////////////////////
        // document start
        /////////////////////////
        $pdfFile = $this->request->getFile('file_companyDocument');

        if($pdfFile != null)
        {
            $newFileName = $pdfFile->getRandomName();
            $pdfFile->move(ROOTPATH . 'public/assets/uploads/company/documents/', $newFileName);

            if($pdfFile->hasMoved())
            {
                $arrResult = $this->companies->selectRepresentativeCompanyDocument($documentId);

                if($arrResult['document_file'] != null)
                {
                    unlink(ROOTPATH . 'public/assets/uploads/company/documents/' . $arrResult['document_file']);
                }  

                $arrData['document_file'] = $newFileName;
            }
        }
        else
        {
            $arrData['document_file'] = NULL;
        }                
        ///////////////////////
        // document end
        ///////////////////////
        
        $result = $this->companies->editRepresentativeCompanyDocument($arrData, $documentId);
        if($result > 0)
        {
            $msgResult[] = "Document updated successfully";
        }
        else
        {
            $msgResult[] = "Something went wrong, please try again";
            return $this->response->setStatusCode(401)->setJSON($msgResult);
            exit();
        }

        return $this->response->setJSON($msgResult);
    }
}
