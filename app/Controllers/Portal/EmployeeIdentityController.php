<?php

namespace App\Controllers\Portal;

use App\Controllers\BaseController;

class EmployeeIdentityController extends BaseController
{
    public function __construct()
    {
        $this->companies = model('Companies');
        $this->employees = model('Employees');
    }

    public function loadRepresentativeIdentifications()
    {
        $fields = $this->request->getGet();
        $arrData = $this->employees->loadRepresentativeIdentifications($this->session->get('gwc_representative_id'));
        return $this->response->setJSON($arrData);
    }

    public function addRepresentativeIdentification()
    {
        $this->validation->setRules([
            'txt_type' => [
                'label'  => 'Type',
                'rules'  => 'required',
                'errors' => [
                    'required'    => 'Type is required'
                ],
            ],
            'slc_category' => [
                'label'  => 'Category',
                'rules'  => 'required',
                'errors' => [
                    'required'    => 'Category is required'
                ],
            ],
            'txt_idNumber' => [
                'label'  => 'ID Number',
                'rules'  => 'required',
                'errors' => [
                    'required'    => 'ID Number is required'
                ],
            ],
            'txt_dateIssued' => [
                'label'  => 'Date Issued',
                'rules'  => 'required',
                'errors' => [
                    'required'    => 'Date Issued is required'
                ],
            ],
            'txt_placeIssued' => [
                'label'  => 'Place Issued',
                'rules'  => 'required',
                'errors' => [
                    'required'    => 'Place Issued is required'
                ],
            ],
            'txt_issuedBy' => [
                'label'  => 'Issued By',
                'rules'  => 'required',
                'errors' => [
                    'required'    => 'Issued By is required'
                ],
            ],
            'txt_expiryDate' => [
                'label'  => 'Expiry Date',
                'rules'  => 'required',
                'errors' => [
                    'required'    => 'Expiry Date is required'
                ],
            ]
        ]);

        if($this->validation->withRequest($this->request)->run())
        {
            $fields = $this->request->getPost();

            $arrData = [
                'employee_id'       => $this->session->get('gwc_representative_id'),
                'type'              => $fields['txt_type'],
                'category'          => $fields['slc_category'],
                'id_number'         => $fields['txt_idNumber'],
                'date_issued'       => $fields['txt_dateIssued'],
                'placed_issued'     => $fields['txt_placeIssued'],
                'issued_by'         => $fields['txt_issuedBy'],
                'expiry_date'       => $fields['txt_expiryDate'],
                'created_by'        => $this->session->get('gwc_representative_id'),
                'created_date'      => date('Y-m-d H:i:s')
            ];

            /////////////////////////
            // id picture start
            /////////////////////////
            $imageFile = $this->request->getFile('file_idPicture');

            if($imageFile != null)
            {
                $newFileName = $imageFile->getRandomName();
                $imageFile->move(ROOTPATH . 'public/assets/uploads/representative/identifications/', $newFileName);

                if($imageFile->hasMoved())
                {
                    $arrData['id_picture'] = $newFileName;
                }
            }
            else
            {
                $arrData['id_picture'] = NULL;
            }                
            ///////////////////////
            // id picture end
            ///////////////////////

            $result = $this->employees->addRepresentativeIdentification($arrData);
            if($result > 0)
            {
                $msgResult[] = "New ID added successfully";
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
        return $this->response->setJSON($msgResult);
    }

    public function selectRepresentativeIdentification()
    {
        $fields = $this->request->getGet();
        $arrData = $this->employees->selectRepresentativeIdentification($fields['identificationId']);
        return $this->response->setJSON($arrData);
    }

    public function removeRepresentativeIdentification()
    {
        $fields = $this->request->getPost();
        $arrData = $this->employees->selectRepresentativeIdentification($fields['identificationId']);
        $result = $this->employees->removeRepresentativeIdentification($fields['identificationId']);
        if($result > 0)
        {
            unlink(ROOTPATH . 'public/assets/uploads/representative/identifications/' . $arrData['id_picture']);
            $msgResult[] = "ID removed successfully";
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
