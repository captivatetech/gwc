<?php



namespace App\Controllers\Portal;

use App\Controllers\BaseController;
use App\Libraries\PdfLibrary;

class EmployeeController extends BaseController
{
    // 4:11
    public function __construct()
    {
        $this->companies = model('Companies');
        $this->employees = model('Employees');
        $this->maps = model('Maps');
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

            $arrData = [
                'first_name'    => $fields['txt_firstName'],
                'middle_name'   => $fields['txt_middleName'],
                'last_name'     => $fields['txt_lastName'],
                'position'      => $fields['txt_position'],
                'updated_by'    => $this->session->get('gwc_representative_id'),
                'updated_date'  => date('Y-m-d H:i:s')
            ];

            $arr = $this->employees->selectRepresentativeInformation($fields['txt_employeeId']);
            if($arr['company_id'] == null)
            {
                $arrResult = $this->companies->getLatestCompanyCode();

                if($arrResult == null)
                {
                    $companyCode = 'GWC0001';
                }
                else
                {
                    $companyCode = generateCompanyCode($arrResult['company_code']);
                }

                $arrCompanyData = [
                    'company_code' => $companyCode,
                    'created_by'   => $this->session->get('gwc_representative_id'),
                    'created_date' => date('Y-m-d H:i:s')
                ];
                $companyId = $this->companies->addCompany($arrCompanyData);
                $arrData['company_id'] = $companyId;
                $arrData['identification_number'] = $this->_generateIdentificationNumber($companyCode);
            }

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

    public function r_calculateEmployeeYearsStayed()
    {
        $fields = $this->request->getGet();
        // Creates DateTime objects
        $datetime1 = date_create($fields['dateHired']);
        $datetime2 = date_create(date('Y-m-d'));
         
        // Calculates the difference between DateTime objects
        $interval = date_diff($datetime1, $datetime2);
         
        // Printing result in years & months format
        $arrData['yearsStayed'] = $interval->format('%R%y years %m months');

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
                'company_id'                => $fields['txt_companyId'],
                'identification_number'     => $this->_generateIdentificationNumber($fields['txt_companyCode']),
                'first_name'                => $fields['txt_firstName'],
                'middle_name'               => $fields['txt_middleName'],
                'last_name'                 => $fields['txt_lastName'],
                'marital_status'            => $fields['slc_maritalStatus'],
                'email_address'             => $fields['txt_emailAddress'],
                'mobile_number'             => $fields['txt_mobileNumber'],
                'user_password'             => encrypt_code('asd'),
                'user_type'                 => 'employee',
                'permanent_address'         => $fields['txt_homeAddress'],
                'department'                => $fields['txt_department'],
                'position'                  => $fields['txt_position'],
                'tax_identification_number' => $fields['txt_taxIdentificationNumber'],
                'date_hired'                => $fields['txt_dateHired'],
                'employment_status'         => $fields['slc_employmentStatus'],
                'years_stayed'              => $fields['txt_yearsStayed'],
                'gross_salary'              => $fields['txt_grossSalary'],
                'net_salary'                => $fields['txt_netSalary'],
                'minimum_credit_amount'     => str_replace(",","",$fields['txt_minimumAmount']),
                'maximum_credit_amount'     => str_replace(",","",$fields['txt_maximumAmount']),
                'payroll_bank_number'       => $fields['txt_payrollBankAccount'],
                'employee_status'           => $fields['slc_employeeStatus'],
                'created_by'                => $this->session->get('gwc_representative_id'),
                'created_date'              => date('Y-m-d H:i:s')
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
                'company_id'                => $fields['txt_companyId'],
                'identification_number'     => 'GWC0001-202400001',
                'first_name'                => $fields['txt_firstName'],
                'middle_name'               => $fields['txt_middleName'],
                'last_name'                 => $fields['txt_lastName'],
                'marital_status'            => $fields['slc_maritalStatus'],
                'email_address'             => $fields['txt_emailAddress'],
                'mobile_number'             => $fields['txt_mobileNumber'],
                'user_type'                 => 'employee',
                'permanent_address'         => $fields['txt_homeAddress'],
                'department'                => $fields['txt_department'],
                'position'                  => $fields['txt_position'],
                'tax_identification_number' => $fields['txt_taxIdentificationNumber'],
                'date_hired'                => $fields['txt_dateHired'],
                'years_stayed'              => $fields['txt_yearsStayed'],
                'employment_status'         => $fields['slc_employmentStatus'],
                'minimum_credit_amount'     => str_replace(",","",$fields['txt_minimumAmount']),
                'maximum_credit_amount'     => str_replace(",","",$fields['txt_maximumAmount']),
                'payroll_bank_number'       => $fields['txt_payrollBankAccount'],
                'employee_status'           => $fields['slc_employeeStatus'],
                'updated_by'                => $this->session->get('gwc_representative_id'),
                'updated_date'              => date('Y-m-d H:i:s')
            ];

            if($fields['txt_accessStatus'] == 'OPEN')
            {
                $arrData['gross_salary'] = $fields['txt_grossSalary'];
                $arrData['net_salary'] = $fields['txt_netSalary'];
            }

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





    public function r_uploadFile()
    {
        $fields = $this->request->getPost();

        $file = $this->request->getFile('employeeList');

        $arrResult = [];

        if ($file->isValid() && ! $file->hasMoved()) 
        {
            $file_data = $file->getName();
            $path = $file->getTempName();

            $ext = pathinfo($path, PATHINFO_EXTENSION);

            $arrData = readUploadFile($path);

            $validColumns = [];
            $arrHeader = [];
            foreach($arrData[0] as $key => $value)
            {
                $arrVal = ["NULL","null","","N/A","n/a","NA","na"];
                if(!in_array($value,$arrVal))
                {
                    $validColumns[] = $value;
                }
            }

            if(count($validColumns) > 0)
            {
                $arrResult['arrHeader'] = $arrData[0];
                array_shift($arrData);
                $arrResult['arrEmployeeList'] = $arrData;
            }
            else
            {
                $arrResult[] = "Your file is empty!";
            }
        }
        else
        {
            $arrResult[] = "Invalid File";
        }

        return $this->response->setJSON($arrResult);
    }

    public function r_loadCustomMaps()
    {
        $arrData = $this->maps->r_loadCustomMaps();
        return $this->response->setJSON($arrData);
    }

    public function r_selectCustomMap()
    {
        $fields = $this->request->getGet();
        $arrData = $this->maps->r_selectCustomMap($fields['mapId']);
        if($arrData != null)
        {
            $arrData['map_fields'] = json_decode($arrData['map_fields'], true);
        }
        return $this->response->setJSON($arrData);
    }

    public function r_mappingAndDuplicateHandling()
    {
        $fields = $this->request->getPost();

        $arrMapFields = json_decode($fields['arrMapFields'],true);
        $arrUniqueValues = json_decode($fields['arrUniqueValues'],true);
        $arrEmployeeList = json_decode($fields['arrEmployeeList'],true);

        $arrEmployeeDataList = [];
        $rowNumber = 2;
        foreach ($arrEmployeeList as $key => $value) 
        {
            $arrColumns['row_number'] = $rowNumber;
            for ($i=0; $i < count($arrMapFields); $i++) 
            { 
                if($arrMapFields[$i] != null)
                {
                    if(checkEmptyField($value[$i]) != '')
                    {
                        $arrColumns[$arrMapFields[$i]] = $value[$i];
                    }
                    else
                    {
                        $arrColumns[$arrMapFields[$i]] = $arrUniqueValues[$i];
                    }
                }
            }  
            $arrEmployeeDataList[] = $arrColumns;    
            $rowNumber++;      
        }

        $arrDataForImport = [];
        $arrData = checkDuplicateRowsFromEmployeeList($arrEmployeeDataList, $arrUniqueValues);

        $arrDuplicateRowsFromFile = [];
        if(isset($arrData['arrDuplicateRows']))
        {
            $arrDuplicateRowsFromFile = $arrData['arrDuplicateRows'];
        }

        $arrCheckDuplicateFromDatabaseResult = [];
        if(isset($arrData['arrNotDuplicateRows']) && count($arrUniqueValues) > 0)
        {
            // Prepare where columns to check duplicate on db
            $arrWhereInColumns = [];
            for ($i=0; $i < count($arrUniqueValues); $i++) 
            { 
                foreach($arrData['arrNotDuplicateRows'] as $value)
                {
                    $arrWhereInColumns[$arrUniqueValues[$i]][] = $value[$arrUniqueValues[$i]];
                }
            }
            $arrCheckDuplicateFromDatabaseResult = $this->employees->checkDuplicateRowsFromEmployeeList($arrWhereInColumns);
        }

        $arrDuplicateRowsFromDatabase = [];
        if(count($arrCheckDuplicateFromDatabaseResult) > 0)
        {
            // get duplicate rows on db
            foreach ($arrCheckDuplicateFromDatabaseResult as $key => $value) 
            {
                $arr = [];
                $arr['id'] = $value['id'];
                for ($i=0; $i < count($arrMapFields); $i++) 
                { 
                    if($arrMapFields[$i] != null)
                    {
                        $arr[$arrMapFields[$i]] = $value[$arrMapFields[$i]];
                    }
                }
                $arrDuplicateRowsFromDatabase[] = $arr;
            }
        }

        //lipasan
        $arrWhereInColumns = [];
        if(count($arrDuplicateRowsFromDatabase) > 0)
        {
            // get where in columns or duplicate handler fields
            for ($i=0; $i < count($arrUniqueValues); $i++) 
            { 
                $arrTemp = [];
                foreach($arrDuplicateRowsFromDatabase as $value)
                {
                    $arrTemp[$arrUniqueValues[$i]][] = $value[$arrUniqueValues[$i]];
                }
                $arrWhereInColumns[$arrUniqueValues[$i]] = array_unique($arrTemp[$arrUniqueValues[$i]]);
            }
        }

        // get no duplicate data for import
        if(isset($arrData['arrNotDuplicateRows']))
        {
            if(count($arrWhereInColumns) > 0)
            {
                foreach ($arrData['arrNotDuplicateRows'] as $key1 => $value1) 
                {
                    $duplicateStatus = false;
                    foreach ($arrWhereInColumns as $key2 => $value2) 
                    {
                        if(in_array($value1[$key2], $value2))
                        {
                            $duplicateStatus = true;
                        }
                    }
                    if($duplicateStatus == false)
                    {
                        $value1['id'] = '';
                        $arrDataForImport[] = $value1;
                    }
                }
            }
            else
            {
                $arrNotDuplicateRows = [];
                foreach ($arrData['arrNotDuplicateRows'] as $key => $value) 
                {
                    $value['id'] = '';
                    $arrNotDuplicateRows[] = $value;
                }

                $arrDataForImport = $arrNotDuplicateRows;
            }
        }

        $arrData = [];
        $arrData['arrHeaders'] = $arrMapFields;
        $arrData['arrDuplicateHandlerFields'] = $arrUniqueValues;
        $arrData['arrDuplicateRowsFromFile'] = $arrDuplicateRowsFromFile;
        $arrData['arrDuplicateRowsFromDatabase'] = $arrDuplicateRowsFromDatabase;
        $arrData['arrDataForImport'] = $arrDataForImport;
        // $arrData['arrContactsDataList'] = $arrContactsDataList;

        $arrEmployeeImportData = [
            'gwc_employee_import_columns' => json_encode($arrData['arrHeaders']),
            'gwc_employee_import_conflicts' => json_encode($arrData['arrDuplicateRowsFromFile'])
        ];
        $this->session->set($arrEmployeeImportData);

        if($fields['chk_saveCustomMapping'] == 'YES')
        {
            $arrFieldMapping = [
                'map_type'      => 'employees',
                'map_name'      => $fields['txt_customMapName'],
                'map_fields'    => $fields['arrMapFields'],
                'map_values'    => $fields['arrUniqueValues'],
                'created_by'    => $this->session->get('gwc_representative_id'),
                'created_date'  => date('Y-m-d H:i:s')
            ];
            $this->maps->r_addCustomMap($arrFieldMapping);
        }

        return $this->response->setJSON($arrData);
    }

    public function r_downloadDuplicateRowsFromCSVEmployee()
    {
        $arrColumns = json_decode($this->session->get('gwc_employee_import_columns'),true);
        $arrData = json_decode($this->session->get('gwc_employee_import_conflicts'),true);
        downloadContactConflicts('conflict-rows-from-file.xlsx',$arrData,$arrColumns);
    }

    public function r_importEmployees()
    {
        $fields = $this->request->getPost();
        $arrDataForImport = json_decode($fields['arrDataForImport'],true);

        //lipasan
        foreach ($arrDataForImport as $key => $value) 
        {
            unset($value['id']);
            unset($value['row_number']);

            // $value['date_hired'] = NULL;
            if(isset($value['date_hired']))
            {
                $date1 = $value['date_hired'];
                $date2 = date('Y-m-d');

                $year1 = date('Y', strtotime($date1));
                $year2 = date('Y', strtotime($date2));

                $month1 = date('m', strtotime($date1));
                $month2 = date('m', strtotime($date2));

                $value['years_stayed'] = ($year2 - $year1) . ' years ' . ($month2 - $month1) . ' months';
            }
            if(isset($value['net_salary']))
            {
                $minLimit = 0;
                $maxLimit = 0;

                $netSalary = $value['net_salary'];

                $minLimit = $netSalary * 0.25;
                $maxLimit = $netSalary * 0.35;

                $value['minimum_credit_amount'] = $minLimit;
                $value['maximum_credit_amount'] = $maxLimit;
            }
            $value['employee_status'] = 1;
            $value['created_by'] = $this->session->get('gwc_representative_id');
            $value['created_date'] = date('Y-m-d H:i:s');
            $value['company_id'] = $fields['txt_companyId'];
            $value['identification_number'] = $this->_generateIdentificationNumber($fields['txt_companyCode']);
            $value['user_type'] = 'employee';
            $this->employees->r_addEmployee($value);
        }
        return $this->response->setJSON(['Success']);
    }

    public function r_printEmployeeList($arrIds)
    {
        $arrEmployeeIds = json_decode($arrIds, true);

        $arrData = $this->employees->r_loadSelectedEmployees($arrEmployeeIds);

        // create new PDF document
        $pdf = new PdfLibrary(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        // set document information
        $pdf->setCreator(PDF_CREATOR);
        // $pdf->setAuthor('Nicola Asuni');
        $pdf->setTitle('Employee List');
        // $pdf->setSubject('TCPDF Tutorial');
        // $pdf->setKeywords('TCPDF, PDF, example, test, guide');

        // set default header data
        $pdf->setHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, 'Employee List', 'Generated Date: '.date('Y-m-d') , array(0,64,255), array(0,64,128));
        $pdf->setFooterData(array(0,64,0), array(0,64,128));

        // set header and footer fonts
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // set default monospaced font
        $pdf->setDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        $pdf->setMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->setHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->setFooterMargin(PDF_MARGIN_FOOTER);

        // set auto page breaks
        $pdf->setAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
            require_once(dirname(__FILE__).'/lang/eng.php');
            $pdf->setLanguageArray($l);
        }

        // ---------------------------------------------------------

        // set default font subsetting mode
        $pdf->setFontSubsetting(true);

        // Set font
        // dejavusans is a UTF-8 Unicode font, if you only need to
        // print standard ASCII chars, you can use core fonts like
        // helvetica or times to reduce file size.
        $pdf->setFont('dejavusans', '', 14, '', true);

        // Add a page
        // This method has several options, check the source code documentation for more information.
        $pdf->AddPage();

        // set text shadow effect
        $pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));

        $tbody = "";
        foreach ($arrData as $key => $value) 
        {
            $employeeNumber = $value['identification_number'];
            $lastName = $value['last_name'];
            $firstName = $value['first_name'];
            $grossSalary = $value['gross_salary'];
            $netSalary = $value['net_salary'];
            $tbody .= <<<EOD
                <tr>
                    <td>$employeeNumber</td>
                    <td>$lastName</td>
                    <td>$firstName</td>
                    <td style="text-align: right;">$grossSalary</td>
                    <td style="text-align: right;">$netSalary</td>
                </tr>
            EOD;
        }
        

        // Set some content to print
        $html = <<<EOD

            <style>
            table {
                border: 1px solid black;
            }
            th {
                border: 1px solid black;
            }
            td {
                border: 1px solid black;
            }
            </style>

            <table style="width:100%; font-size: 10px;">
                <thead>
                    <tr>
                        <th><b>ID Number</b></th>
                        <th><b>Last Name</b></th>
                        <th><b>First Name</b></th>
                        <th><b>Gross Salary</b></th>
                        <th><b>Net Salary</b></th>
                    </tr>
                </thead>
                <tbody>
                    $tbody
                </tbody>
            </table>
        EOD;

        // Print text using writeHTMLCell()
        $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

        // ---------------------------------------------------------

        // Close and output PDF document
        // This method has several options, check the source code documentation for more information.
        $pdf->Output('example_001.pdf', 'I');

        exit();

        // return $this->response->setJSON($arrData);
    }







    public function a_sendEmployeeEmailVerification()
    {
        $fields = $this->request->getPost();

        $arrData = [
            'auth_code' => encrypt_code(generate_code(20))
        ];
        $result = $this->employees->r_editEmployee($arrData, $fields['employeeId']);

        if($result > 0)
        {
            $arrDetails = $this->employees->a_selectCompanyEmployee($fields['employeeId']);

            $emailConfig = sliceMailConfig();

            $emailSender    = 'loans@goldwatercap.net';
            $emailReceiver  = $arrDetails['email_address'];

            $data = [
                'emailName'     => 'GOLDWATER CAPITAL',
                'subjectTitle'  => 'Email Verification',
                'emailAddress'  => $arrDetails['email_address'],
                'authCode'      => decrypt_code($arrData['auth_code'])
            ];

            $emailResult = sendSliceMail('employee_email_verification',$emailConfig,$emailSender,$emailReceiver,$data);

            return $this->response->setJSON($emailResult);
        }
    }


    public function a_loadCompanyEmployees()
    {
        $fields = $this->request->getGet();
        $arrData = $this->employees->a_loadCompanyEmployees($fields['companyId'],'employee');
        return $this->response->setJSON($arrData);
    }








    public function e_loadCredetLimit()
    {
        $employeeId = $this->session->get('gwc_employee_id');
        $arrData = $this->employees->e_loadCredetLimit($employeeId);

        $min = round(((float)$arrData['minimum_credit_amount'] / 500),0,PHP_ROUND_HALF_DOWN) * 500;
        $max = round(((float)$arrData['maximum_credit_amount'] / 500),0,PHP_ROUND_HALF_DOWN) * 500;
        $minLoanableAmount = (int)((float)$arrData['minimum_credit_amount'] / 500) * 500;
        $maxLoanableAmount = (int)((float)$arrData['maximum_credit_amount'] / 500) * 500;

        $arrData = [
            'minimum_credit_amount' => $min,
            'maximum_credit_amount' => $max,
            'min_loanable_amount' => $minLoanableAmount,
            'max_loanable_amount' => $maxLoanableAmount
        ];

        return $this->response->setJSON($arrData);
    }

    public function e_selectEmployeeInformation()
    {
        $employeeId = $this->session->get('gwc_employee_id');
        $arrData = $this->employees->e_selectEmployeeInformation($employeeId);

        $min = round(((float)$arrData['minimum_credit_amount'] / 500),0,PHP_ROUND_HALF_DOWN) * 500;
        $max = round(((float)$arrData['maximum_credit_amount'] / 500),0,PHP_ROUND_HALF_DOWN) * 500;
        $minLoanableAmount = (int)((float)$arrData['minimum_credit_amount'] / 500) * 500;
        $maxLoanableAmount = (int)((float)$arrData['maximum_credit_amount'] / 500) * 500;
        
        $arrData['minimum_credit_amount'] = $min;
        $arrData['maximum_credit_amount'] = $max;
        $arrData['min_loanable_amount'] = $minLoanableAmount;
        $arrData['max_loanable_amount'] = $maxLoanableAmount;
        return $this->response->setJSON($arrData);
    }
}
