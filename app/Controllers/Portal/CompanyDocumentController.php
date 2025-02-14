<?php

namespace App\Controllers\Portal;

use App\Controllers\BaseController;

class CompanyDocumentController extends BaseController
{
    public function __construct()
    {
        $this->companies = model('Companies');
        $this->activities = model('Activities');
    }

    /*
        USED IN:
        - REPRESENTATIVE_COMPANY_PROFILE->r_loadCompanyDocuments()
        - REPRESENTATIVE_FINANCING_PRODUCTS->r_loadCompanyDocuments()
    */
    public function r_loadCompanyDocuments()
    {
        $fields = $this->request->getGet();
        $arrData = $this->companies->r_loadCompanyDocuments($fields['companyId'], $fields['businessType']);
        return $this->response->setJSON($arrData);
    }

    /*
        USED IN:
        - REPRESENTATIVE_COMPANY_PROFILE->r_openCompanyDocumentModal()
        - REPRESENTATIVE_FINANCING_PRODUCTS->r_openCompanyDocumentPreview()
    */
    public function r_selectCompanyDocument()
    {
        $fields = $this->request->getGet();
        $arrData = $this->companies->r_selectCompanyDocument($fields['documentId']);
        return $this->response->setJSON($arrData);
    }

    /*
        USED IN:
        - REPRESENTATIVE_COMPANY_PROFILE->r_addCompanyDocument()
    */
    public function r_addCompanyDocument()
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
        
        $result = $this->companies->r_addCompanyDocument($arrData);
        if($result > 0)
        {
            $msgResult[] = "Document added successfully";

            // for Audit Trail
            $arrData = [
                'user_id' => $this->session->get('gwc_representative_id'),
                'module_name' => 'Company Module',
                'activity_type' => 'Add Company Document',
                'activity_details' => '',
                'created_date' => date('Y-m-d H:i:s')
            ];
            $this->activities->addUserActivity($arrData);
        }
        else
        {
            $msgResult[] = "Something went wrong, please try again";
            return $this->response->setStatusCode(401)->setJSON($msgResult);
            exit();
        }

        return $this->response->setJSON($msgResult);
    }

    /*
        USED IN:
        - REPRESENTATIVE_COMPANY_PROFILE->r_editCompanyDocument()
    */
    public function r_editCompanyDocument()
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
                $arrResult = $this->companies->r_selectCompanyDocument($documentId);

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
        
        $result = $this->companies->r_editCompanyDocument($arrData, $documentId);
        if($result > 0)
        {
            $msgResult[] = "Document updated successfully";

            // for Audit Trail
            $arrData = [
                'user_id' => $this->session->get('gwc_representative_id'),
                'module_name' => 'Company Module',
                'activity_type' => 'Update Company Document',
                'activity_details' => '',
                'created_date' => date('Y-m-d H:i:s')
            ];
            $this->activities->addUserActivity($arrData);
        }
        else
        {
            $msgResult[] = "Something went wrong, please try again";
            return $this->response->setStatusCode(401)->setJSON($msgResult);
            exit();
        }

        return $this->response->setJSON($msgResult);
    }


    /*
        USED IN:
        - REPRESENTATIVE_EMPLOYEE_LIST->r_loadCompanyAttachments()
    */
    public function r_loadCompanyAttachments()
    {
        $fields = $this->request->getGet();
        $arrData = $this->companies->r_loadCompanyAttachments($fields['companyId']);
        return $this->response->setJSON($arrData);
    }

    /*
        USED IN:
        - REPRESENTATIVE_EMPLOYEE_LIST->r_addCompanyAttachment()
    */
    public function r_addCompanyAttachment()
    {
        $fields = $this->request->getPost();

        $arrData = [
            'company_id'        => $fields['txt_companyId'],
            'document_code'     => $fields['txt_attachmentCode'],
            'document_name'     => $fields['txt_attachmentName'],
            'document_status'   => '1',
            'created_by'        => $this->session->get('gwc_representative_id'),
            'created_date'      => date('Y-m-d H:i:s')
        ];

        /////////////////////////
        // document start
        /////////////////////////
        $pdfFile = $this->request->getFile('file_companyAttachment');

        if($pdfFile != null)
        {
            $newFileName = $pdfFile->getRandomName();
            $pdfFile->move(ROOTPATH . 'public/assets/uploads/company/attachments/', $newFileName);

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
        
        $result = $this->companies->r_addCompanyAttachment($arrData);
        if($result > 0)
        {
            $msgResult[] = "Attachment added successfully";

            // for Audit Trail
            $arrData = [
                'user_id' => $this->session->get('gwc_representative_id'),
                'module_name' => 'Company Module',
                'activity_type' => 'Add Company Attachment',
                'activity_details' => '',
                'created_date' => date('Y-m-d H:i:s')
            ];
            $this->activities->addUserActivity($arrData);
        }
        else
        {
            $msgResult[] = "Something went wrong, please try again";
            return $this->response->setStatusCode(401)->setJSON($msgResult);
            exit();
        }

        return $this->response->setJSON($msgResult);
    }

    /*
        USED IN:
        - REPRESENTATIVE_EMPLOYEE_LIST->r_selectCompanyAttachment()
    */
    public function r_selectCompanyAttachment()
    {
        $fields = $this->request->getGet();
        $arrData = $this->companies->r_selectCompanyAttachment($fields['attachmentId']);
        return $this->response->setJSON($arrData);
    }

    /*
        USED IN:
        - REPRESENTATIVE_EMPLOYEE_LIST->r_editCompanyAttachment()
    */
    public function r_editCompanyAttachment()
    {
        $fields = $this->request->getPost();

        $arrData = [
            'company_id'        => $fields['txt_companyId'],
            'document_code'     => $fields['txt_attachmentCode'],
            'document_name'     => $fields['txt_attachmentName'],
            'document_status'   => '1',
            'updated_by'        => $this->session->get('gwc_representative_id'),
            'updated_date'      => date('Y-m-d H:i:s')
        ];

        $attachmentId = $fields['txt_attachmentId'];

        /////////////////////////
        // document start
        /////////////////////////
        $pdfFile = $this->request->getFile('file_companyAttachment');

        if($pdfFile != null)
        {
            $newFileName = $pdfFile->getRandomName();
            $pdfFile->move(ROOTPATH . 'public/assets/uploads/company/attachments/', $newFileName);

            if($pdfFile->hasMoved())
            {
                $arrResult = $this->companies->r_selectCompanyDocument($attachmentId);

                if($arrResult['document_file'] != null)
                {
                    unlink(ROOTPATH . 'public/assets/uploads/company/attachments/' . $arrResult['document_file']);
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
        
        $result = $this->companies->r_editCompanyDocument($arrData, $attachmentId);
        if($result > 0)
        {
            $msgResult[] = "Attachment updated successfully";

            // for Audit Trail
            $arrData = [
                'user_id' => $this->session->get('gwc_representative_id'),
                'module_name' => 'Company Module',
                'activity_type' => 'Update Company Attachment',
                'activity_details' => '',
                'created_date' => date('Y-m-d H:i:s')
            ];
            $this->activities->addUserActivity($arrData);
        }
        else
        {
            $msgResult[] = "Something went wrong, please try again";
            return $this->response->setStatusCode(401)->setJSON($msgResult);
            exit();
        }

        return $this->response->setJSON($msgResult);
    }











    /*
        USED IN:
        - ADMIN_SALARY_ADVANCE_APPLICATIONS->a_loadCompanyDocuments()
    */
    public function a_loadCompanyDocuments()
    {
        $fields = $this->request->getGet();
        $arrData = $this->companies->a_loadCompanyDocuments($fields['companyId']);
        foreach ($arrData as $key => $value) 
        {
            if(str_contains($value['document_code'],$fields['businessType']))
            {
                $arrNewData[] = $value;
            }

            if(str_contains($value['document_code'],'Attachment'))
            {
                $arrNewData[] = $value;
            }
        }
        return $this->response->setJSON($arrNewData);
    }

    public function a_previewCompanyDocument()
    {
        $fields = $this->request->getGet();
        $arrData = $this->companies->a_previewCompanyDocument($fields['documentId']);
        return $this->response->setJSON($arrData);
    }

    /*
        USED IN:
        - ADMIN_SALARY_ADVANCE_APPLICATIONS->a_verifyCompanyDocument()
    */
    public function a_verifyCompanyDocument()
    {
        $fields = $this->request->getPost();

        $arrData = [
            'document_status'       => 2,
            'updated_by'            => $this->session->get('gwc_admin_id'),
            'updated_date'          => date('Y-m-d H:i:s')
        ];
        
        $result = $this->companies->a_verifyCompanyDocument($arrData, $fields['txt_documentId']);
        if($result > 0)
        {
            $msgResult[] = "Document verified successfully";

            // for Audit Trail
            $arrData = [
                'user_id' => $this->session->get('gwc_admin_id'),
                'module_name' => 'Company Module',
                'activity_type' => 'Verify Company Document',
                'activity_details' => '',
                'created_date' => date('Y-m-d H:i:s')
            ];
            $this->activities->addUserActivity($arrData);
        }
        else
        {
            $msgResult[] = "Something went wrong, please try again";
            return $this->response->setStatusCode(401)->setJSON($msgResult);
            exit();
        }

        return $this->response->setJSON($msgResult);
    }

    


    // public function a_loadCompanyAttachments()
    // {
    //     $fields = $this->request->getGet();
    //     $arrData = $this->companies->a_loadCompanyAttachments($fields['companyId']);
    //     return $this->response->setJSON($arrData);
    // }

    // public function a_previewCompanyAttachment()
    // {
        
    // }

    // public function a_acceptCompanyAttachment()
    // {

    // }
}
