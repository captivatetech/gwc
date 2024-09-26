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
        $arrNewData = [];
        foreach ($arrData as $key => $value) 
        {
            $arrNewData[] = [
                'id'            => $value['id'],
                'employee_id'   => $value['employee_id'],
                'type'          => explode("=",$value['type'])[1],
                'category'      => $value['category'],
                'id_number'     => $value['id_number'],
                'id_picture'    => $value['id_picture'],
                'date_issued'   => $value['date_issued'],
                'placed_issued' => $value['placed_issued'],
                'issued_by'     => $value['issued_by'],
                'expiry_date'   => $value['expiry_date'],
                'id_status'     => $value['id_status'],
                'created_by'    => $value['created_by'],
                'created_date'  => $value['created_date']
            ];
        }
        return $this->response->setJSON($arrNewData);
    }

    public function addRepresentativeIdentification()
    {
        $this->validation->setRules([
            'slc_type' => [
                'label'  => 'Type',
                'rules'  => 'required',
                'errors' => [
                    'required'    => 'Type is required'
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
            ]
        ]);

        if($this->validation->withRequest($this->request)->run())
        {
            $fields = $this->request->getPost();

            $category = explode('=', $fields['slc_type']);

            $arrData = [
                'employee_id'       => $this->session->get('gwc_representative_id'),
                'type'              => $fields['slc_type'],
                'category'          => $category[0],
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
