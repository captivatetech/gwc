<?php

namespace App\Controllers\Portal;

use App\Controllers\BaseController;

class EmployeeController extends BaseController
{
    public function __construct()
    {
        $this->companies = model('Companies');
        $this->employees = model('Employees');
    }

    public function selectRepresentativeInformation()
    {
        $fields = $this->request->getGet();
        $arrData = $this->employees->selectRepresentativeInformation($this->session->get('gwc_representative_id'));
        return $this->response->setJSON($arrData);
    }

    public function editRepresentativeInformation()
    {
        $this->validation->setRules([
            'txt_lastName' => [
                'label'  => 'Last Name',
                'rules'  => 'required',
                'errors' => [
                    'required'    => 'Last Name is required',
                ],
            ],
            'txt_firstName' => [
                'label'  => 'First Name',
                'rules'  => 'required',
                'errors' => [
                    'required'    => 'First Name is required',
                ],
            ],
            'txt_middleName' => [
                'label'  => 'Middle Name',
                'rules'  => 'required',
                'errors' => [
                    'required'    => 'Middle Name is required',
                ],
            ],
            'txt_position' => [
                'label'  => 'Position',
                'rules'  => 'required',
                'errors' => [
                    'required'    => 'Position is required',
                ],
            ]
        ]);

        if($this->validation->withRequest($this->request)->run())
        {
            $fields = $this->request->getPost();

            $arrResult = $this->companies->getLatestCompanyCode();

            if(count($arrResult) == 0)
            {
                $companyCode = 'GWC0001';
            }
            else
            {
                $companyCode = generateCompanyCode($arrResult['company_code']);
            }

            $arrData = [
                'company_code' => $companyCode,
                'created_by'   => $this->session->get('gwc_representative_id'),
                'created_date' => date('Y-m-d H:i:s')
            ];
            $companyId = $this->companies->addCompany($arrData);

            $arrData = [
                'company_id'            => $companyId,
                'identification_number' => _generateIdentificationNumber($companyCode),
                'first_name'            => $fields['txt_firstName'],
                'middle_name'           => $fields['txt_middleName'],
                'last_name'             => $fields['txt_lastName'],
                'position'              => $fields['txt_position'],
                'updated_by'            => $this->session->get('gwc_representative_id'),
                'updated_date'          => date('Y-m-d H:i:s')
            ];

            $result = $this->employees->editRepresentativeInformation($arrData, $fields['txt_employeeId']);
            if($result > 0)
            {
                $msgResult[] = "Information updated successfully";
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

    public function editRepresentativeProfilePicture()
    {
        $fields = $this->request->getPost();

        $arrData = [
            'updated_by'    => $this->session->get('gwc_representative_id'),
            'updated_date'  => date('Y-m-d H:i:s')
        ];

        $employeeId = $this->session->get('gwc_representative_id');

        /////////////////////////
        // id picture start
        /////////////////////////
        $imageFile = $this->request->getFile('file_profilePicture');

        if($imageFile != null)
        {
            $newFileName = $imageFile->getRandomName();
            $imageFile->move(ROOTPATH . 'public/assets/uploads/representative/profiles/', $newFileName);

            if($imageFile->hasMoved())
            {
                $arrResult = $this->employees->selectRepresentativeProfilePicture($employeeId);

                if($arrResult['profile_picture'] != null)
                {
                    unlink(ROOTPATH . 'public/assets/uploads/representative/profiles/' . $arrResult['profile_picture']);
                }  

                $arrData['profile_picture'] = $newFileName;
            }
        }
        else
        {
            $arrData['profile_picture'] = NULL;
        }                
        ///////////////////////
        // id picture end
        ///////////////////////
        
        $result = $this->employees->editRepresentativeProfilePicture($arrData, $employeeId);
        if($result > 0)
        {
            $msgResult[] = "Information updated successfully";
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
        !-- Employee Module
    */

    public function r_loadEmployees()
    {
        $fields = $this->request->getGet();
        $arrData = $this->employees->r_loadEmployees($fields['companyId']);
        return $this->response->setJSON($arrData);
    }

    private function _generateIdentificationNumber($companyCode)
    {
        $arrResult = $this->employees->getLastIdentificationNumber();

        if($arrResult == null)
        {
            $identificationNumber = $companyCode . "-".date('Y')."00001";
        }
        else
        {
            $year = substr($arrResult['identification_number'], 8, 4);
            $series = substr($arrResult['identification_number'], 12);

            if($year != date('Y'))
            {
                $identificationNumber = $arrResult['company_code']."-".date('Y').'00001';
            }
            else
            {
                $series = (int)$series + 1;
                $strSeries = "";
                if($series < 10)
                {
                    $strSeries = $year."0000".$series;
                }
                else if($series < 100)
                {
                    $strSeries = $year."000".$series;
                }
                else if($series < 1000)
                {
                    $strSeries = $year."00".$series;
                }
                else if($series < 10000)
                {
                    $strSeries = $year."0".$series;
                }
                else if($series < 100000)
                {
                    $strSeries = $year.$series;
                }
                $identificationNumber = $arrResult['company_code']."-".$strSeries;
            }
        }

        

        return $identificationNumber;
    }

    public function r_addEmployee()
    {
        $this->validation->setRules([
            'txt_lastName' => [
                'label'  => 'Last Name',
                'rules'  => 'required',
                'errors' => [
                    'required'    => 'Last Name is required'
                ],
            ],
            'txt_firstName' => [
                'label'  => 'First Name',
                'rules'  => 'required',
                'errors' => [
                    'required'    => 'First Name is required'
                ],
            ],
            'txt_emailAddress' => [
                'label'  => 'Email Address',
                'rules'  => 'required|valid_email',
                'errors' => [
                    'required'    => 'Email Address is required',
                    'valid_email' => 'Email Address must be valid'
                ],
            ],
        ]);

        if($this->validation->withRequest($this->request)->run())
        {
            $fields = $this->request->getPost();

            $arrData = [
                'company_id'            => $fields['txt_companyId'],
                'identification_number' => $this->_generateIdentificationNumber($fields['txt_companyCode']),
                'first_name'            => $fields['txt_firstName'],
                'middle_name'           => $fields['txt_middleName'],
                'last_name'             => $fields['txt_lastName'],
                'marital_status'        => $fields['slc_maritalStatus'],
                'email_address'         => $fields['txt_emailAddress'],
                'mobile_number'         => $fields['txt_mobileNumber'],
                'user_password'         => encrypt_code('asd'),
                'user_status'           => 1,
                'user_type'             => 'employee',
                'permanent_address'     => $fields['txt_homeAddress'],
                'department'            => $fields['txt_department'],
                'position'              => $fields['txt_position'],
                'date_hired'            => $fields['txt_dateHired'],
                'years_stayed'          => $fields['txt_yearsStayed'],
                'gross_salary'          => $fields['txt_grossSalary'],
                'minimum_credit_amount' => $fields['txt_minimumAmount'],
                'maximum_credit_amount' => $fields['txt_maximumAmount'],
                'payroll_bank_number'   => $fields['txt_payrollBankAccount'],
                'created_by'            => $this->session->get('gwc_representative_id'),
                'created_date'          => date('Y-m-d H:i:s')
            ];

            $result = $this->employees->r_validateEmployeeEmail(['a.email_address'=>$fields['txt_emailAddress']]);
            if($result != null)
            {
                $msgResult[] = "Email already exist!";
                return $this->response->setStatusCode(401)->setJSON($msgResult);
                exit();
            }
            else
            {
                $result = $this->employees->r_addEmployee($arrData);
                if($result > 0)
                {
                    $msgResult[] = "New employee saved successfully";
                }
                else
                {
                    $msgResult[] = "Something went wrong, please try again";
                    return $this->response->setStatusCode(401)->setJSON($msgResult);
                    exit();
                }
            }
        }
        else
        {
            $msgResult[] = $this->validation->getErrors();
        }
        return $this->response->setJSON($msgResult);
    }

    public function r_selectEmployee()
    {
        $fields = $this->request->getGet();
        $arrData = $this->employees->r_selectEmployee($fields['employeeId']);
        return $this->response->setJSON($arrData);
    }

    public function r_editEmployee()
    {
        $this->validation->setRules([
            'txt_lastName' => [
                'label'  => 'Last Name',
                'rules'  => 'required',
                'errors' => [
                    'required'    => 'Last Name is required'
                ],
            ],
            'txt_firstName' => [
                'label'  => 'First Name',
                'rules'  => 'required',
                'errors' => [
                    'required'    => 'First Name is required'
                ],
            ],
            'txt_emailAddress' => [
                'label'  => 'Email Address',
                'rules'  => 'required|valid_email',
                'errors' => [
                    'required'    => 'Email Address is required',
                    'valid_email' => 'Email Address must be valid'
                ],
            ],
        ]);

        if($this->validation->withRequest($this->request)->run())
        {
            $fields = $this->request->getPost();

            $arrData = [
                'company_id'            => $fields['txt_companyId'],
                'identification_number' => 'GWC0001-202400001',
                'first_name'            => $fields['txt_firstName'],
                'middle_name'           => $fields['txt_middleName'],
                'last_name'             => $fields['txt_lastName'],
                'marital_status'        => $fields['slc_maritalStatus'],
                'email_address'         => $fields['txt_emailAddress'],
                'mobile_number'         => $fields['txt_mobileNumber'],
                'user_password'         => encrypt_code('asd'),
                'user_status'           => 1,
                'user_type'             => 'employee',
                'permanent_address'     => $fields['txt_homeAddress'],
                'department'            => $fields['txt_department'],
                'position'              => $fields['txt_position'],
                'date_hired'            => $fields['txt_dateHired'],
                'years_stayed'          => $fields['txt_yearsStayed'],
                'gross_salary'          => $fields['txt_grossSalary'],
                'minimum_credit_amount' => $fields['txt_minimumAmount'],
                'maximum_credit_amount' => $fields['txt_maximumAmount'],
                'payroll_bank_number'   => $fields['txt_payrollBankAccount'],
                'updated_by'            => $this->session->get('gwc_representative_id'),
                'updated_date'          => date('Y-m-d H:i:s')
            ];

            $whereParams = [
                'a.id !='           => $fields['txt_employeeId'],
                'a.email_address'   => $fields['txt_emailAddress']
            ];

            $result = $this->employees->r_validateEmployeeEmail($whereParams);
            if($result != null)
            {
                $msgResult[] = "Email already exist!";
                return $this->response->setStatusCode(401)->setJSON($msgResult);
                exit();
            }
            else
            {
                $result = $this->employees->r_editEmployee($arrData, $fields['txt_employeeId']);
                if($result > 0)
                {
                    $msgResult[] = "Employee updated successfully";
                }
                else
                {
                    $msgResult[] = "Something went wrong, please try again";
                    return $this->response->setStatusCode(401)->setJSON($msgResult);
                    exit();
                }
            }
        }
        else
        {
            $msgResult[] = $this->validation->getErrors();
        }
        return $this->response->setJSON($msgResult);
    }

    public function r_removeEmployee()
    {
        $fields = $this->request->getPost();
        $result = $this->employees->r_removeEmployee($fields['employeeId']);
        if($result > 0)
        {
            $msgResult[] = "Employee removed successfully";
        }
        else
        {
            $msgResult[] = "Something went wrong, please try again";
            return $this->response->setStatusCode(401)->setJSON($msgResult);
            exit();
        }
        return $this->response->setJSON($msgResult);
    }










    public function a_sendEmployeeEmailVerication()
    {
        
    }


    public function a_loadCompanyEmployees()
    {
        $fields = $this->request->getGet();
        $arrData = $this->employees->a_loadCompanyEmployees($fields['companyId']);
        return $this->response->setJSON($arrData);
    }
}
