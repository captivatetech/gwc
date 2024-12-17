<?php

namespace App\Controllers\Portal;

use App\Controllers\BaseController;

class FaqController extends BaseController
{
    public function __construct()
    {
        $this->faqs = model('Faqs');
    }

    public function loadAdminFaqs()
    {
        $arrData = $this->faqs->loadAdminFaqs();
        return $this->response->setJSON($arrData);
    }

    public function addAdminFaq()
    {
        $this->validation->setRules([
            'txt_question' => [
                'label'  => 'Question',
                'rules'  => 'required',
                'errors' => [
                    'required'    => 'Question is required',
                ],
            ],
            'txt_answer' => [
                'label'  => 'Answer',
                'rules'  => 'required',
                'errors' => [
                    'required'    => 'Answer is required',
                ],
            ],
            'slc_faqsStatus' => [
                'label'  => 'FAQ Status',
                'rules'  => 'required',
                'errors' => [
                    'required'    => 'FAQ Status is required',
                ],
            ]
        ]);

        if($this->validation->withRequest($this->request)->run())
        {
            $fields = $this->request->getPost();

            $arrData = [
                'question'      => $fields['txt_question'],
                'answer'        => $fields['txt_answer'],
                'faq_status'    => $fields['slc_faqsStatus'],
                'created_by'    => $this->session->get('gwc_admin_id'),
                'created_date'  => date('Y-m-d H:i:s')
            ];

            $result = $this->faqs->addAdminFaq($arrData);
            if($result > 0)
            {
                $msgResult[] = "New FAQ saved successfully";
                return $this->response->setJSON($msgResult);
                exit();
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
            $msgResult[] = $this->validation->getErrors();
            return $this->response->setStatusCode(401)->setJSON($msgResult);
            exit();
        }
    }

    public function selectAdminFaq()
    {
        $fields = $this->request->getGet();
        $data = $this->faqs->selectAdminFaq($fields['faqId']);
        return $this->response->setJSON($data);
    }

    public function editAdminFaq()
    {
        $this->validation->setRules([
            'txt_question' => [
                'label'  => 'Question',
                'rules'  => 'required',
                'errors' => [
                    'required'    => 'Question is required',
                ],
            ],
            'txt_answer' => [
                'label'  => 'Answer',
                'rules'  => 'required',
                'errors' => [
                    'required'    => 'Answer is required',
                ],
            ],
            'slc_faqsStatus' => [
                'label'  => 'FAQ Status',
                'rules'  => 'required',
                'errors' => [
                    'required'    => 'FAQ Status is required',
                ],
            ]
        ]);

        if($this->validation->withRequest($this->request)->run())
        {
            $fields = $this->request->getPost();

            $arrData = [
                'question'      => $fields['txt_question'],
                'answer'        => $fields['txt_answer'],
                'faq_status'    => $fields['slc_faqsStatus'],
                'updated_by'    => $this->session->get('gwc_admin_id'),
                'updated_date'  => date('Y-m-d H:i:s')
            ];

            $result = $this->faqs->editAdminFaq($arrData, $fields['txt_faqId']);
            if($result > 0)
            {
                $msgResult[] = "FAQ updated successfully";
                return $this->response->setJSON($msgResult);
                exit();
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
            $msgResult[] = $this->validation->getErrors();
            return $this->response->setStatusCode(401)->setJSON($msgResult);
            exit();
        }
    }

    public function removeAdminFaq()
    {
        $fields = $this->request->getPost();
        $result = $this->faqs->removeAdminFaq($fields['faqId']);
        if($result > 0)
        {
            $msgResult[] = "FAQ removed successfully";
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
