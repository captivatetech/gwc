<?php

namespace App\Controllers\Portal;

use App\Controllers\BaseController;

class CompanyController extends BaseController
{
    public function __construct()
    {
        $this->companies = model('Companies');
        $this->employees = model('Employees');
    }

    public function r_selectCompanyInformation()
    {
        $fields = $this->request->getGet();
        $arrData = $this->companies->r_selectCompanyInformation($fields['companyId']);
        return $this->response->setJSON($arrData);
    }

    public function r_editCompanyInformation()
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

                $result = $this->companies->r_editCompanyInformation($arrData, $fields['txt_companyId']);
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

    

    public function r_selectCompanySettings()
    {
        $fields = $this->request->getGet();
        $arrData = $this->companies->r_selectCompanySettings($fields['companyId']);
        return $this->response->setJSON($arrData);
    }

    public function r_loadBankDepositories()
    {
        $jsonData = file_get_contents(base_url() . "public/channel_codes.json");
        $arrData = json_decode($jsonData, true);
        return $this->response->setJSON($arrData['data']);
    }

    public function r_populatePayrollDates()
    {
        $fields = $this->request->getGet();

        $date1 = $fields['thisDate'];
        $date2 = date('d', strtotime(date('Y-m-'.$date1). '+ 15 days'));

        $date1End = date('d', strtotime(date('Y-m-'.$date1). '- 5 days'));
        $date1Start = date('d', strtotime(date('Y-m-'.$date1End). '- 14 days'));

        $date2End = date('d', strtotime(date('Y-m-'.$date2). '- 5 days'));
        $date2Start = date('d', strtotime(date('Y-m-'.$date2End). '- 14 days'));

        $arrData = [
            'date1'         => $date1,
            'date1Start'    => $date1Start,
            'date1End'      => $date1End,
            'date2'         => $date2,
            'date2Start'    => $date2Start,
            'date2End'      => $date2End
        ];

        return $this->response->setJSON($arrData);
    }

    public function r_editCompanySettings()
    {
        $this->validation->setRules([
            'slc_bankDepository' => [
                'label'  => 'Bank Depository',
                'rules'  => 'required',
                'errors' => [
                    'required'    => 'Bank Depository is required',
                ],
            ],
            'txt_branchName' => [
                'label'  => 'Branch Name',
                'rules'  => 'required',
                'errors' => [
                    'required'    => 'Branch Name is required',
                ],
            ],
            'txt_branchCode' => [
                'label'  => 'Branch Code',
                'rules'  => 'required',
                'errors' => [
                    'required'    => 'Branch Code is required',
                ],
            ],
            'slc_payrollPayoutDate1' => [
                'label'  => 'Payout Date 1',
                'rules'  => 'required',
                'errors' => [
                    'required'    => 'Payout Date 1 is required',
                ],
            ],
            'txt_cutOffMinDate1' => [
                'label'  => 'Cut-off Min Date',
                'rules'  => 'required',
                'errors' => [
                    'required'    => 'Cut-off Min Date is required',
                ],
            ],
            'txt_cutOffMaxDate1' => [
                'label'  => 'Cut-off Max Date',
                'rules'  => 'required',
                'errors' => [
                    'required'    => 'Cut-off Max Date is required',
                ],
            ],
            'txt_payrollPayoutDate2' => [
                'label'  => 'Payout Date 2',
                'rules'  => 'required',
                'errors' => [
                    'required'    => 'Payout Date 2 is required',
                ],
            ],
            'txt_cutOffMinDate2' => [
                'label'  => 'Cut-off Min Date',
                'rules'  => 'required',
                'errors' => [
                    'required'    => 'Cut-off Min Date is required',
                ],
            ],
            'txt_cutOffMaxDate2' => [
                'label'  => 'Cut-off Max Date',
                'rules'  => 'required',
                'errors' => [
                    'required'    => 'Cut-off Max Date is required',
                ],
            ]
        ]);

        if($this->validation->withRequest($this->request)->run())
        {
            $fields = $this->request->getPost();
                
            $arrData = [
                'bank_depository'       => $fields['slc_bankDepository'],
                'branch_name'           => $fields['txt_branchName'],
                'branch_code'           => $fields['txt_branchCode'],
                'payroll_payout_date1'  => $fields['slc_payrollPayoutDate1'],
                'cut_off_min_date1'     => $fields['txt_cutOffMinDate1'],
                'cut_off_max_date1'     => $fields['txt_cutOffMaxDate1'],
                'payroll_payout_date2'  => $fields['txt_payrollPayoutDate2'],
                'cut_off_min_date2'     => $fields['txt_cutOffMinDate2'],
                'cut_off_max_date2'     => $fields['txt_cutOffMaxDate2'],
                'hr_user'               => $fields['rdb_hrUser'],
                'bpo_user'              => $fields['rdb_bpoUser'],
                'updated_by'            => $this->session->get('gwc_representative_id'),
                'updated_date'          => date('Y-m-d H:i:s')
            ];

            $result = $this->companies->r_editCompanySettings($arrData, $fields['txt_companyId']);
            if($result > 0)
            {
                $msgResult[] = "Company settings updated successfully";
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





    public function r_loadCompanyRepresentatives()
    {
        $fields = $this->request->getGet();
        $arrData = $this->companies->r_loadCompanyRepresentatives($fields['companyId']);
        return $this->response->setJSON($arrData);
    }

    public function r_addCompanyHR()
    {
        $this->validation->setRules([
            'txt_hrFirstName' => [
                'label'  => 'First Name',
                'rules'  => 'required',
                'errors' => [
                    'required'    => 'First Name is required',
                ],
            ],
            'txt_hrLastName' => [
                'label'  => 'Last Name',
                'rules'  => 'required',
                'errors' => [
                    'required'    => 'Last Name is required',
                ],
            ],
            'txt_hrPosition' => [
                'label'  => 'Position',
                'rules'  => 'required',
                'errors' => [
                    'required'    => 'Position is required',
                ],
            ],
            'txt_hrEmailAddress' => [
                'label'  => 'Email Address',
                'rules'  => 'required',
                'errors' => [
                    'required'    => 'Email Address is required',
                ],
            ]
        ]);

        if($this->validation->withRequest($this->request)->run())
        {
            $fields = $this->request->getPost();

            $whereParams = [
                'a.email_address' => $fields['txt_hrEmailAddress']
            ];
            $arrResult = $this->employees->validateRepresentativeEmail($whereParams);
            
            if($arrResult == null)
            {
                $arrData = [
                    'company_id'                => $fields['txt_companyId'],
                    'first_name'                => $fields['txt_hrFirstName'],
                    'last_name'                 => $fields['txt_hrLastName'],
                    'email_address'             => $fields['txt_hrEmailAddress'],
                    'position'                  => $fields['txt_hrPosition'],
                    'user_role'                 => 'HR',
                    'created_by'                => $this->session->get('gwc_representative_id'),
                    'created_date'              => date('Y-m-d H:i:s')
                ];

                $result = $this->companies->r_addCompanyRepresentative($arrData);
                if($result > 0)
                {
                    $msgResult[] = "Company Representative added successfully";
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
                $msgResult[] = "Email already exist!";
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

    public function r_editCompanyHR()
    {
        $this->validation->setRules([
            'txt_hrFirstName' => [
                'label'  => 'First Name',
                'rules'  => 'required',
                'errors' => [
                    'required'    => 'First Name is required',
                ],
            ],
            'txt_hrLastName' => [
                'label'  => 'Last Name',
                'rules'  => 'required',
                'errors' => [
                    'required'    => 'Last Name is required',
                ],
            ],
            'txt_hrPosition' => [
                'label'  => 'Position',
                'rules'  => 'required',
                'errors' => [
                    'required'    => 'Position is required',
                ],
            ],
            'txt_hrEmailAddress' => [
                'label'  => 'Email Address',
                'rules'  => 'required',
                'errors' => [
                    'required'    => 'Email Address is required',
                ],
            ]
        ]);

        if($this->validation->withRequest($this->request)->run())
        {
            $fields = $this->request->getPost();

            $representativeId = $fields['txt_hrRepresentativeId'];

            $whereParams = [
                'a.id !='           => $representativeId,
                'a.email_address'   => $fields['txt_hrEmailAddress']
            ];
            $arrResult = $this->employees->validateRepresentativeEmail($whereParams);

            if($arrResult == null)
            {
                $arrData = [
                    'company_id'                => $fields['txt_companyId'],
                    'first_name'                => $fields['txt_hrFirstName'],
                    'last_name'                 => $fields['txt_hrLastName'],
                    'email_address'             => $fields['txt_hrEmailAddress'],
                    'position'                  => $fields['txt_hrPosition'],
                    'user_role'                 => 'HR',
                    'updated_by'                => $this->session->get('gwc_representative_id'),
                    'updated_date'              => date('Y-m-d H:i:s')
                ];                

                $result = $this->companies->r_editCompanyRepresentative($arrData, $representativeId);
                if($result > 0)
                {
                    $msgResult[] = "Company Representative updated successfully";
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
                $msgResult[] = "Email already exist!";
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

    public function r_addCompanyBPO()
    {
        $this->validation->setRules([
            'txt_bpoFirstName' => [
                'label'  => 'First Name',
                'rules'  => 'required',
                'errors' => [
                    'required'    => 'First Name is required',
                ],
            ],
            'txt_bpoLastName' => [
                'label'  => 'Last Name',
                'rules'  => 'required',
                'errors' => [
                    'required'    => 'Last Name is required',
                ],
            ],
            'txt_bpoPosition' => [
                'label'  => 'Position',
                'rules'  => 'required',
                'errors' => [
                    'required'    => 'Position is required',
                ],
            ],
            'txt_bpoEmailAddress' => [
                'label'  => 'Email Address',
                'rules'  => 'required',
                'errors' => [
                    'required'    => 'Email Address is required',
                ],
            ]
        ]);

        if($this->validation->withRequest($this->request)->run())
        {
            $fields = $this->request->getPost();
            
            $whereParams = [
                'a.email_address' => $fields['txt_bpoEmailAddress']
            ];
            $arrResult = $this->employees->validateRepresentativeEmail($whereParams);
            
            if($arrResult == null)
            {
                $arrData = [
                    'company_id'                => $fields['txt_companyId'],
                    'first_name'                => $fields['txt_bpoFirstName'],
                    'last_name'                 => $fields['txt_bpoLastName'],
                    'email_address'             => $fields['txt_bpoEmailAddress'],
                    'position'                  => $fields['txt_bpoPosition'],
                    'user_role'                 => 'BPO',
                    'created_by'                => $this->session->get('gwc_representative_id'),
                    'created_date'              => date('Y-m-d H:i:s')
                ];

                $result = $this->companies->r_addCompanyRepresentative($arrData);
                if($result > 0)
                {
                    $msgResult[] = "Company Representative added successfully";
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
                $msgResult[] = "Email already exist!";
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

    public function r_editCompanyBPO()
    {
        $this->validation->setRules([
            'txt_bpoFirstName' => [
                'label'  => 'First Name',
                'rules'  => 'required',
                'errors' => [
                    'required'    => 'First Name is required',
                ],
            ],
            'txt_bpoLastName' => [
                'label'  => 'Last Name',
                'rules'  => 'required',
                'errors' => [
                    'required'    => 'Last Name is required',
                ],
            ],
            'txt_bpoPosition' => [
                'label'  => 'Position',
                'rules'  => 'required',
                'errors' => [
                    'required'    => 'Position is required',
                ],
            ],
            'txt_bpoEmailAddress' => [
                'label'  => 'Email Address',
                'rules'  => 'required',
                'errors' => [
                    'required'    => 'Email Address is required',
                ],
            ]
        ]);

        if($this->validation->withRequest($this->request)->run())
        {
            $fields = $this->request->getPost();

            $representativeId = $fields['txt_bpoRepresentativeId'];

            $whereParams = [
                'a.id !='           => $representativeId,
                'a.email_address'   => $fields['txt_bpoEmailAddress']
            ];
            $arrResult = $this->employees->validateRepresentativeEmail($whereParams);

            if($arrResult == null)
            {
                $arrData = [
                    'company_id'                => $fields['txt_companyId'],
                    'first_name'                => $fields['txt_bpoFirstName'],
                    'last_name'                 => $fields['txt_bpoLastName'],
                    'email_address'             => $fields['txt_bpoEmailAddress'],
                    'position'                  => $fields['txt_bpoPosition'],
                    'user_role'                 => 'BPO',
                    'updated_by'                => $this->session->get('gwc_representative_id'),
                    'updated_date'              => date('Y-m-d H:i:s')
                ];

                $result = $this->companies->r_editCompanyRepresentative($arrData, $representativeId);
                if($result > 0)
                {
                    $msgResult[] = "Company Representative updated successfully";
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
                $msgResult[] = "Email already exist!";
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



    public function r_loadCompanyRepresentativeIdentifications()
    {
        $fields = $this->request->getGet();
        $arrData = $this->employees->r_loadCompanyRepresentativeIdentifications($fields['employeeId'], $fields['category']);
        return $this->response->setJSON($arrData);
    }

    public function r_addRepresentativeIdentification()
    {
        $fields = $this->request->getPost();

        $arrData = [
            'employee_id'       => $fields['txt_employeeId'],
            'type'              => $fields['txt_identificationType'],
            'category'          => $fields['txt_identificationCategory'],
            'id_status'         => '1',
            'created_by'        => $this->session->get('gwc_representative_id'),
            'created_date'      => date('Y-m-d H:i:s')
        ];

        /////////////////////////
        // document start
        /////////////////////////
        $pdfFile = $this->request->getFile('file_identificationDocument');

        if($pdfFile != null)
        {
            $newFileName = $pdfFile->getRandomName();
            $pdfFile->move(ROOTPATH . 'public/assets/uploads/representative/identifications/', $newFileName);

            if($pdfFile->hasMoved())
            {
                $arrData['id_picture'] = $newFileName;
            }
        }
        else
        {
            $arrData['id_picture'] = NULL;
        }                
        ///////////////////////
        // document end
        ///////////////////////
        
        $result = $this->employees->r_addRepresentativeIdentification($arrData);
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
    
    public function r_selectRepresentativeIdentification()
    {
        $fields = $this->request->getGet();
        $arrData = $this->employees->r_selectRepresentativeIdentification($fields['identificationId']);
        return $this->response->setJSON($arrData);
    }

    public function r_editRepresentativeIdentification()
    {
        $fields = $this->request->getPost();

        $arrData = [
            'employee_id'       => $fields['txt_employeeId'],
            'type'              => $fields['txt_identificationType'],
            'category'          => $fields['txt_identificationCategory'],
            'id_status'         => '1',
            'updated_by'        => $this->session->get('gwc_representative_id'),
            'updated_date'      => date('Y-m-d H:i:s')
        ];

        $identificationId = $fields['txt_identificationId'];

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
                $arrResult = $this->employees->r_selectRepresentativeIdentification($identificationId);

                if($arrResult['id_picture'] != null)
                {
                    unlink(ROOTPATH . 'public/assets/uploads/company/documents/' . $arrResult['id_picture']);
                }  

                $arrData['id_picture'] = $newFileName;
            }
        }
        else
        {
            $arrData['id_picture'] = NULL;
        }                
        ///////////////////////
        // document end
        ///////////////////////
        
        $result = $this->employees->r_editRepresentativeIdentification($arrData, $documentId);
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
