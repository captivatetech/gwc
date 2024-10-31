
const REPRESENTATIVE_EMPLOYEE_LIST = (function(){

    let thisRepresentativeEmployeeList = {};

    let baseUrl = $('#txt_baseUrl').val();

    let _arrEmployeeList = [];

    thisRepresentativeEmployeeList.r_loadEmployees = function(companyId)
    {
        AJAXHELPER.getData({
            // EmployeeController->r_loadEmployees();
            'route' : 'portal/representative/r-load-employees',
            'data'  : {
                'companyId' : companyId
            }
        }, function(data){
            let tbody = '';
            data.forEach(function(value,index){
                let employeeStatus = "";

                if(value['employee_status'] == 1)
                {
                    employeeStatus = `<span class="text-success">Active</span>`;
                }
                else
                {
                    employeeStatus = `<span class="text-danger">Inactive</span>`;
                }

                let actions = '';

                if($('#txt_subscriptionStatus').val() == "APPROVE" && $('#txt_accessStatus').val() == "CLOSE")
                {
                    actions = `<a class="dropdown-item" href="javascript:void(0)" onclick="REPRESENTATIVE_EMPLOYEE_LIST.r_selectEmployee(${value['id']})">Edit</a>`;
                }
                else
                {
                    actions = `<a class="dropdown-item" href="javascript:void(0)" onclick="REPRESENTATIVE_EMPLOYEE_LIST.r_selectEmployee(${value['id']})">Edit</a>
                                <a class="dropdown-item" href="javascript:void(0)" onclick="REPRESENTATIVE_EMPLOYEE_LIST.r_removeEmployee(${value['id']})">Delete</a>`;
                }

                tbody += `<tr>
                            <td>
                                <input type="checkbox" class="chk-employees" value="${value['id']}" onchange="REPRESENTATIVE_EMPLOYEE_LIST.r_unselectEmployee();">
                            </td>
                            <td>${value['identification_number']}</td>
                            <td>${value['first_name']} ${value['last_name']}</td>
                            <td>${value['email_address']}</td>
                            <td>${value['department']}</td>
                            <td>${value['position']}</td>
                            <td>${value['date_hired']}</td>
                            <td>${value['minimum_credit_amount']} - ${value['maximum_credit_amount']}</td>
                            <td>${employeeStatus}</td>
                            <td>                                                        
                                <div class="dropdown">
                                    <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Actions <i class="mdi mdi-chevron-down"></i>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        ${actions}
                                    </div>
                                </div>
                            </td>
                        </tr>`;
            });
            $("#tbl_employees").DataTable().destroy();
            $('#tbl_employees tbody').html(tbody);
            $("#tbl_employees").DataTable({pageLength:10,lengthMenu:[10,20,50,100,200,500]});
        });
    }

    thisRepresentativeEmployeeList.r_unselectEmployee = function()
    {
        let ids = $("#tbl_employees tbody input:checkbox:checked").map(function () {
            return $(this).val();
        }).get();

        let trCount = 0;
        $("#tbl_employees tbody tr").map(function () {
            trCount++;
        });

        if(trCount >= $('#tbl_employees_length select').val())
        {
            if(ids.length == $('#tbl_employees_length select').val())
            {
                $('#chk_selectAllEmployees').prop('checked',true);
            }
            else
            {
                $('#chk_selectAllEmployees').prop('checked',false);
            }
        }
        else
        {   
            if(trCount == ids.length)
            {
                $('#chk_selectAllEmployees').prop('checked',true);
            }
            else
            {
                $('#chk_selectAllEmployees').prop('checked',false);
            }
        }
    }

    thisRepresentativeEmployeeList.r_printEmployeeList = function()
    {
        let ids = $("#tbl_employees tbody input:checkbox:checked").map(function () {
            return $(this).val();
        }).get();

        if(ids.length > 0)
        {
            let arrIds = JSON.stringify(ids);
            window.open(`${baseUrl}portal/representative/r-print-employee-list/${arrIds}`, '_blank');
        }
        else
        {
            alert('No selected employees to print!');
        }
    }

    thisRepresentativeEmployeeList.r_calculateCreditLimit = function()
    {
        let minLimit = 0;
        let maxLimit = 0;

        let netSalary = parseFloat($('#txt_netSalary').val());

        minLimit = netSalary * 0.25;
        maxLimit = netSalary * 0.35;

        $('#txt_minimumAmount').val(COMMONHELPER.numberWithCommas(minLimit.toFixed(2)));
        $('#txt_maximumAmount').val(COMMONHELPER.numberWithCommas(maxLimit.toFixed(2)));
    }

    thisRepresentativeEmployeeList.r_calculateEmployeeYearsStayed = function()
    {
        AJAXHELPER.getData({
            // EmployeeController->r_calculateEmployeeYearsStayed();
            'route' : 'portal/representative/r-calculate-employee-years-stayed',
            'data'  : {
                'dateHired' : $('#txt_dateHired').val()
            }
        }, function(data){
            $('#txt_yearsStayed').val(data['yearsStayed']);
        });
    }

    thisRepresentativeEmployeeList.r_addEmployee = function(thisForm)
    {
        let formData = new FormData(thisForm);
        formData.set('txt_companyId',$("#txt_companyId").val());

        $('#btn_submitEmployee').prop('disabled',true);
        AJAXHELPER.postData({
            // EmployeeController->r_addEmployee();
            'route' : 'portal/representative/r-add-employee',
            'data'  : formData
        }, function(data){
            COMMONHELPER.Toaster('success',data[0]);
            setTimeout(function(){
                $('#btn_submitEmployee').prop('disabled',false);
                window.location.replace(`${baseUrl}portal/representative/employee-list`);
            }, 1000);
        }, function(data){
            COMMONHELPER.Toaster('error',data['responseJSON'][0]);
            $('#btn_submitEmployee').prop('disabled',false);
        });
    }

    thisRepresentativeEmployeeList.r_selectEmployee = function(employeeId)
    {
        AJAXHELPER.getData({
            // EmployeeController->r_selectEmployee();
            'route' : '/portal/representative/r-select-employee',
            'data'  : {
                'employeeId' : employeeId
            }
        }, function(data){
            $('#lbl_modalTitle1').html(`<i class="fe-edit me-2"></i> Edit Employee`);
            $('#txt_employeeId').val(data['id']);
            $('#txt_lastName').val(data['last_name']);
            $('#txt_firstName').val(data['first_name']);
            $('#txt_middleName').val(data['middle_name']);
            $('#txt_taxIdentificationNumber').val(data['tax_identification_number']);
            $('#txt_position').val(data['position']);
            $('#txt_department').val(data['department']);
            $('#txt_grossSalary').val(data['gross_salary']);
            $('#txt_netSalary').val(data['net_salary']);
            $('#slc_maritalStatus').val(data['marital_status']);
            $('#txt_homeAddress').val(data['permanent_address']);
            $('#txt_mobileNumber').val(data['mobile_number']);
            $('#txt_emailAddress').val(data['email_address']);
            $('#txt_dateHired').val(data['date_hired']);
            $('#txt_yearsStayed').val(data['years_stayed']);
            $('#slc_employmentStatus').val(data['employment_status']);
            REPRESENTATIVE_EMPLOYEE_LIST.r_loadBankDepositories();
            $('#txt_payrollBankAccount').val(data['payroll_bank_number']);
            $('#txt_minimumAmount').val(COMMONHELPER.numberWithCommas(data['minimum_credit_amount']));
            $('#txt_maximumAmount').val(COMMONHELPER.numberWithCommas(data['maximum_credit_amount']));
            $('#slc_employeeStatus').val(data['employee_status']);
            $('#modal_employee').modal('show');
        });
    }

    thisRepresentativeEmployeeList.r_loadBankDepositories = function()
    {
        AJAXHELPER.getData({
            // CompanyController->r_loadBankDepositories();
            'route' : 'portal/representative/r-load-bank-depositories',
            'data'  : null
        }, function(data){
            let options = `<option value="" selected disabled>---</option>`;
            data.forEach(function(value,index){
                if($('#txt_payrollBank').val() == value['channel_code'])
                {
                    options += `<option value="${value['channel_code']}" selected>[${value['channel_type']}] ${value['bank_name']}</options>`;
                }
                else
                {
                    options += `<option value="${value['channel_code']}">[${value['channel_type']}] ${value['bank_name']}</options>`;
                }
            });
            $('#slc_payrollBank').html(options);
        });
    }

    thisRepresentativeEmployeeList.r_editEmployee = function(thisForm)
    {
        let formData = new FormData(thisForm);
        formData.set('txt_companyId',$("#txt_companyId").val());
        formData.set('txt_accessStatus',$("#txt_accessStatus").val());

        $('#btn_submitEmployee').prop('disabled',true);
        AJAXHELPER.postData({
            // EmployeeController->r_editEmployee();
            'route' : 'portal/representative/r-edit-employee',
            'data'  : formData
        }, function(data){
            COMMONHELPER.Toaster('success',data[0]);
            setTimeout(function(){
                $('#btn_submitEmployee').prop('disabled',false);
                window.location.replace(`${baseUrl}portal/representative/employee-list`);
            }, 1000);
        }, function(data){ 
            COMMONHELPER.Toaster('error',data['responseJSON'][0]);
            $('#btn_submitEmployee').prop('disabled',false);
        });
    }

    thisRepresentativeEmployeeList.r_removeEmployee = function(employeeId)
    {
        if(confirm('Please Confirm!'))
        {
            AJAXHELPER.removeData({
                // EmployeeController->r_removeEmployee();
                'route' : 'portal/representative/r-remove-employee',
                'data'  : {
                    'employeeId' : employeeId
                }
            }, function(data){
                COMMONHELPER.Toaster('success',data[0]);
                setTimeout(function(){
                    window.location.replace(`${baseUrl}portal/representative/employee-list`);
                }, 1000);
            }, function(data){ 
                COMMONHELPER.Toaster('error',data['responseJSON'][0]);
            });
        }
    }







    thisRepresentativeEmployeeList.r_uploadFile = function()
    {
        $('#btn_submitStepOne').prop('disabled',true);
        var fileName = document.getElementById('file_employeeList').files[0].name;
        let formData = new FormData();
        formData.set('employeeList',document.getElementById('file_employeeList').files[0],fileName);
        AJAXHELPER.postData({
            // EmployeeController->r_uploadFile();
            'route' : 'portal/representative/r-upload-file',
            'data'  : formData
        }, function(data){
            $('#btn_submitStepOne').prop('disabled',false);

            $('#div_stepOne').prop('hidden',true);
            $('#div_stepTwo').prop('hidden',false);
            $('#div_stepThree').prop('hidden',true);

            $('#div_buttonStepOne').prop('hidden',true);
            $('#div_buttonStepTwo').prop('hidden',false);
            $('#div_buttonStepThree').prop('hidden',true);

            _arrEmployeeList = data;

            REPRESENTATIVE_EMPLOYEE_LIST.r_loadCustomMaps();

            let tbody = '';
            let num = 1;
            _arrEmployeeList['arrHeader'].forEach(function(value,key){
                $('#lbl_totalRows').text(_arrEmployeeList['arrEmployeeList'].length);

                let defaultValue = `<input type="checkbox" class="form-check" value="${value.replace(' ','_').toLowerCase()}">`;

                tbody += `<tr>
                            <td>${num}</td>
                            <td>${value}</td>
                            <td>${_arrEmployeeList['arrEmployeeList'][0][key]}</td>
                            <td>
                                <select class="form-control form-select form-control-sm select2" onchange="REPRESENTATIVE_EMPLOYEE_LIST.r_selectField(this)" style="width:100%;">
                                    <option value="" selected>--Map Field--</option>
                                    <option value="first_name" ${(value.replace(' ','_').toLowerCase() == 'first_name')? 'selected' : ''}>First Name</option>
                                    <option value="middle_name" ${(value.replace(' ','_').toLowerCase() == 'middle_name')? 'selected' : ''}>Middle Name</option>
                                    <option value="last_name" ${(value.replace(' ','_').toLowerCase() == 'last_name')? 'selected' : ''}>Last Name</option>
                                    <option value="tax_identification_number" ${(value.replace(' ','_').toLowerCase() == 'tax_identification_number')? 'selected' : ''}>Tax Identification Number</option>
                                    <option value="position" ${(value.replace(' ','_').toLowerCase() == 'position')? 'selected' : ''}>Position</option>
                                    <option value="department" ${(value.replace(' ','_').toLowerCase() == 'department')? 'selected' : ''}>Department</option>
                                    <option value="gross_salary" ${(value.replace(' ','_').toLowerCase() == 'gross_salary')? 'selected' : ''}>Gross Salary</option>
                                    <option value="net_salary" ${(value.replace(' ','_').toLowerCase() == 'net_salary')? 'selected' : ''}>Net Salary</option>
                                    <option value="marital_status" ${(value.replace(' ','_').toLowerCase() == 'marital_status')? 'selected' : ''}>Marital Status</option>
                                    <option value="permanent_address" ${(value.replace(' ','_').toLowerCase() == 'permanent_address')? 'selected' : ''}>Home Address</option>
                                    <option value="mobile_number" ${(value.replace(' ','_').toLowerCase() == 'mobile_number')? 'selected' : ''}>Mobile Number</option>
                                    <option value="email_address" ${(value.replace(' ','_').toLowerCase() == 'email_address')? 'selected' : ''}>Email Address</option>
                                    <option value="date_hired" ${(value.replace(' ','_').toLowerCase() == 'date_hired')? 'selected' : ''}>Date Hired</option>
                                    <option value="employment_status" ${(value.replace(' ','_').toLowerCase() == 'employment_status')? 'selected' : ''}>Employment Status</option>
                                    <option value="payroll_bank_number" ${(value.replace(' ','_').toLowerCase() == 'payroll_bank_number')? 'selected' : ''}>Payroll Bank Number</option>
                                </select>
                            </td>
                            <td>${defaultValue}</td>
                            </tr>`;
                num++;
            });

            $('#tbl_mapping tbody').html('');
            $('#tbl_mapping tbody').html(tbody);
        }, function(data){ 
            COMMONHELPER.Toaster('error',data['responseJSON'][0]);
        });
    }

    thisRepresentativeEmployeeList.r_selectField = function(dis)
    {
        $('#tbl_mapping tbody tr').each(function(){
            arrFields.push($(this).find('td:eq(3) select').val());
        });
    }

    thisRepresentativeEmployeeList.r_stepOneCancel = function()
    {
        if(confirm('If you press OK import process will be terminated!'))
        {
            $('#modal_importEmployees').modal('hide');
            window.location.replace(`${baseUrl}portal/representative/employee-list`);
        }
    }

    thisRepresentativeEmployeeList.r_backToStepOne = function()
    {
        $('#div_stepOne').prop('hidden',false);
        $('#div_stepTwo').prop('hidden',true);
        $('#div_stepThree').prop('hidden',true);

        $('#div_buttonStepOne').prop('hidden',false);
        $('#div_buttonStepTwo').prop('hidden',true);
        $('#div_buttonStepThree').prop('hidden',true);
    }

    thisRepresentativeEmployeeList.r_loadCustomMaps = function()
    {
        AJAXHELPER.getData({
            // EmployeeController->r_loadCustomMaps();
            'route' : '/portal/representative/r-load-custom-maps',
            'data'  : null
        }, function(data){
            let options = '<option value="">--No Saved Maps--</option>';
            data.forEach(function(value,index){
                options += `<option value="${value['id']}">${value['map_name']}</option>`;
            });
            $('#slc_savedMaps').html(options);
        });
    }

    thisRepresentativeEmployeeList.r_selectCustomMap = function(mapId)
    {
        AJAXHELPER.getData({
            // EmployeeController->r_selectCustomMap();
            'route' : '/portal/representative/r-select-custom-map',
            'data'  : {
                'mapId' : mapId
            }
        }, function(data){
            let x = 0;
            $('#tbl_mapping tbody tr').each(function(){
                $(this).find('td:eq(3) select').val(`${data['map_fields'][x]}`).change();
                x++;
            });
        });
    }

    thisRepresentativeEmployeeList.r_mappingAndDuplicateHandling = function()
    {
        $('#btn_submitStepTwo').prop('disabled',true);

        let arrFields = [];
        $('#tbl_mapping tbody tr').each(function(){
            arrFields.push($(this).find('td:eq(3) select').val());
        });

        let arrValues = [];
        $('#tbl_mapping tbody tr').each(function(){
            if($(this).find('td:eq(4) .form-check').is(':checked'))
            {
                arrValues.push($(this).find('td:eq(4) .form-check').val());
            }
        });
        
        let formData = new FormData();
        formData.set('arrMapFields', JSON.stringify(arrFields));
        formData.set('arrUniqueValues', JSON.stringify(arrValues));
        formData.set('chk_saveCustomMapping',($('#chk_saveCustomMapping').is(':checked'))? 'YES' : 'NO');
        formData.set('txt_customMapName',$('#txt_customMapName').val());
        formData.set('arrEmployeeList',JSON.stringify(_arrEmployeeList['arrEmployeeList']));
        AJAXHELPER.postData({
            // EmployeeController->r_mappingAndDuplicateHandling();
            'route' : 'portal/representative/r-mapping-and-duplicate-handling',
            'data'  : formData
        }, function(data){
            $('#btn_submitStepTwo').prop('disabled',false);

            $('#div_stepOne').prop('hidden',true);
            $('#div_stepTwo').prop('hidden',true);
            $('#div_stepThree').prop('hidden',false);

            $('#div_buttonStepOne').prop('hidden',true);
            $('#div_buttonStepTwo').prop('hidden',true);
            $('#div_buttonStepThree').prop('hidden',false);

            $('#div_duplicateRows1').prop('hidden',true);
            $('#div_duplicateRows2').prop('hidden',true);
            $('#div_forImport').prop('hidden',true);

            $('#btn_submitStepThree').prop('disabled',true);

            let thead = '';
            let tbody = '';
            let tr = '<th style="white-space:nowrap">CSV ROW #</th>';
            data['arrHeaders'].forEach(function(value,key){
                if(data['arrDuplicateHandlerFields'].includes(value))
                {
                    tr += `<th style="white-space:nowrap" class="table-danger">${value}</th>`;
                }
                else
                {
                    tr += `<th style="white-space:nowrap">${value}</th>`;
                }
            });
            thead = `<tr>${tr}</tr>`;

            if(data['arrDuplicateRowsFromFile'].length > 0)
            {
                $('#div_duplicateRows1').prop('hidden',false);

                $('#tbl_duplicateRows1 thead').html(thead);
                _arrEmployeeList['arrDuplicateRowsFromFile'] = data['arrDuplicateRowsFromFile'];
                $('#tbl_duplicateRows1').prop('hidden',(data['arrDuplicateRowsFromFile'].length == 0)? true : false);

                tbody = '';
                data['arrDuplicateRowsFromFile'].forEach(function(value,key){
                    tbody += `<tr>`;
                    tr = `<td style="white-space:nowrap">${value['row_number']}</td>`;
                    data['arrHeaders'].forEach(function(v,k){
                        if(data['arrDuplicateHandlerFields'].includes(v))
                        {
                            tr += `<td class="table-danger" style="white-space:nowrap">${value[v]}</td>`;
                        }
                        else
                        {
                            tr += `<td style="white-space:nowrap">${value[v]}</td>`;
                        }
                    });
                    tbody += tr;
                    tbody += `</tr>`;
                });
                $('#tbl_duplicateRows1').DataTable().destroy();
                $('#tbl_duplicateRows1 tbody').html(tbody);
                $('#tbl_duplicateRows1').DataTable({'scrollX':true});

                if(data['arrDuplicateRowsFromFile'].length > 0)
                {
                    let downloadButton1 = `<a href="${baseUrl}portal/representative/r-download-duplicate-rows-from-csv-employee" target="_blank" class="btn btn-sm btn-primary">Download</a>`;
                    $('#tbl_duplicateRows1_length').html(downloadButton1);
                }
            }

            if(data['arrDuplicateRowsFromDatabase'].length > 0)
            {
                $('#div_duplicateRows2').prop('hidden',false);

                $('#tbl_duplicateRows2 thead').html(thead);
                $('#div_duplicateRows2').prop('hidden',(data['arrDuplicateRowsFromDatabase'].length == 0)? true : false);

                tbody = '';
                data['arrDuplicateRowsFromDatabase'].forEach(function(value,key){
                    tbody += `<tr>`;
                    tr = `<td style="white-space:nowrap">${value['id']}</td>`;
                    data['arrHeaders'].forEach(function(v,k){
                        if(data['arrDuplicateHandlerFields'].includes(v))
                        {
                            tr += `<td class="table-danger" style="white-space:nowrap">${(value[v] == null)? '---' : value[v]}</td>`;
                        }
                        else
                        {
                            tr += `<td style="white-space:nowrap">${(value[v] == null)? '---' : value[v]}</td>`;
                        }
                    });
                    tbody += tr;
                    tbody += `</tr>`;
                });
                $('#tbl_duplicateRows2').DataTable().destroy();
                $('#tbl_duplicateRows2 tbody').html(tbody);
                $('#tbl_duplicateRows2').DataTable({'scrollX':true});
            }

            if(data['arrDataForImport'].length > 0)
            {
                $('#div_forImport').prop('hidden',false);

                tr = '<th style="white-space:nowrap">ID</th>';
                tr += '<th style="white-space:nowrap">CSV ROW #</th>';
                data['arrHeaders'].forEach(function(value,key){
                    tr += `<th style="white-space:nowrap">${value}</th>`;
                });
                thead = `<tr>${tr}</tr>`;
                $('#tbl_importData thead').html(thead);
                _arrEmployeeList['arrUniqueValues'] = data['arrUniqueValues'];
                _arrEmployeeList['arrDataForImport'] = data['arrDataForImport'];

                tbody = '';
                data['arrDataForImport'].forEach(function(value,key){
                    if(value['id'] == '')
                    {
                        tbody += `<tr class="table-success">`;
                    }
                    else
                    {
                        tbody += `<tr class="table-warning">`;
                    }
                    tr = `<td style="white-space:nowrap">${value['id']}</td>`;
                    tr += `<td style="white-space:nowrap">${value['row_number']}</td>`;
                    data['arrHeaders'].forEach(function(v,k){
                        tr += `<td style="white-space:nowrap">${value[v]}</td>`;
                    });
                    tbody += tr;
                    tbody += `</tr>`;
                });

                $('#tbl_importData').DataTable().destroy();
                $('#tbl_importData tbody').html(tbody);
                $('#tbl_importData').DataTable({
                    'scrollX'   :true,
                    'order'     : [[1, 'asc']]
                });

                $('#btn_submitStepThree').prop('disabled',false);
            }
        }, function(data){ 
            COMMONHELPER.Toaster('error',data['responseJSON'][0]);
        });
    }

    thisRepresentativeEmployeeList.r_stepTwoCancel = function()
    {
        if(confirm('If you press OK import process will be terminated!'))
        {
            $('#modal_importEmployees').modal('hide');
            window.location.replace(`${baseUrl}portal/representative/employee-list`);
        }
    }

    thisRepresentativeEmployeeList.r_backToStepTwo = function()
    {
        $('#div_stepOne').prop('hidden',true);
        $('#div_stepTwo').prop('hidden',false);
        $('#div_stepThree').prop('hidden',true);

        $('#div_buttonStepOne').prop('hidden',true);
        $('#div_buttonStepTwo').prop('hidden',false);
        $('#div_buttonStepThree').prop('hidden',true);
    }

    thisRepresentativeEmployeeList.r_importEmployees = function()
    {
        let alertMsg = '';
        alertMsg = 'Please Confirm!';
        if(confirm(alertMsg))
        {
            $('#div_progressBarContainer').prop('hidden',false);

            $('#btn_submitStepThree').html('<i>Processing...</i>');
            $('#btn_submitStepThree').prop('disabled',true);

            let arrNew = [];
            let batchLen = parseInt(_arrEmployeeList['arrDataForImport'].length / 5);
            let batchLenRem = parseInt(_arrEmployeeList['arrDataForImport'].length % 5);

            let currentIndex = 0;
            for (var x = 0; x < batchLen; x++) 
            {
                var arrTemp = [];
                for (var y = 0; y < 5; y++) 
                {
                    arrTemp.push(_arrEmployeeList['arrDataForImport'][currentIndex]);
                    currentIndex++;
                }
                arrNew.push(arrTemp);
            }

            if(batchLenRem > 0)
            {
                var arrTemp = [];
                for (var y = 0; y < batchLenRem; y++) 
                {
                    arrTemp.push(_arrEmployeeList['arrDataForImport'][currentIndex]);
                    currentIndex++;
                }
                arrNew.push(arrTemp);
            }

            let progress = 100 / parseInt(arrNew.length);
            let progressRem = 100 % parseInt(arrNew.length);
            let totalProgress = 0;
            let count = 0;
            let importCount = 0;

            REPRESENTATIVE_EMPLOYEE_LIST.r_importEmployeesByBatch(progress, progressRem, totalProgress, count, importCount, arrNew, batchLenRem, currentIndex);
        }
    }

    thisRepresentativeEmployeeList.r_importEmployeesByBatch = function(progress, progressRem, totalProgress, count, importCount, arrNew, batchLenRem, currentIndex)
    {
        let formData = new FormData();
        _arrEmployeeList['arrDataForImport'] = arrNew[count];
        formData.set('txt_companyId',$('#txt_companyId').val());
        formData.set('txt_companyCode',$('#txt_companyCode').val());
        formData.set('arrDataForImport',JSON.stringify(_arrEmployeeList['arrDataForImport']));
        AJAXHELPER.postData({
            // EmployeeController->r_importEmployees();
            'route' : 'portal/representative/r-import-employees',
            'data'  : formData
        }, function(data){
            if(count <= (parseInt(arrNew.length) - 1))
            {
                if(count == (parseInt(arrNew.length) - 1))
                {
                    if(batchLenRem > 0)
                    {
                        importCount += batchLenRem;
                    }
                    else
                    {
                        importCount += 5;
                    }
                    progressRem = 100 - totalProgress;
                    totalProgress += progressRem;   
                }
                else
                {
                    importCount += 5;
                    totalProgress += progress;
                }

                $('#div_progressBar').css('width',`${totalProgress}%`);
                $('#lbl_progress').text(`${importCount} / ${currentIndex}`);

                if(totalProgress < 100)
                {
                    count++;
                    REPRESENTATIVE_EMPLOYEE_LIST.r_importEmployeesByBatch(progress, progressRem, totalProgress, count, importCount, arrNew, batchLenRem, currentIndex);
                }
                else
                {
                    $('#btn_submitStepThree').html('Import');
                    $('#btn_submitStepThree').prop('disabled',false);
                    COMMONHELPER.Toaster('success','Employees uploaded successfully!');
                    setTimeout(function(){
                        window.location.replace(`${baseUrl}/portal/representative/employee-list`);   
                    }, 1000);
                }
            }
        }, function(data){
            COMMONHELPER.Toaster('error',data['responseJSON'][0]);
        });
    }

    thisRepresentativeEmployeeList.r_stepThreeCancel = function()
    {
        if(confirm('If you press OK import process will be terminated!'))
        {
            $('#modal_importEmployees').modal('hide');
            window.location.replace(`${baseUrl}portal/representative/employee-list`);
        }
    }











    thisRepresentativeEmployeeList.r_openCompanyAttachmentPreview = function(documentFile)
    {
        let fileLen = documentFile.files.length;
        if(fileLen > 0)
        {
            let documentSize = documentFile.files[0]['size'] / 1000;
            let documentStatus = '';
            let fileType = ['application/pdf'];
            let status = 0;

            if(documentSize > 5024)
            {
                documentStatus = '<span class="info-bot-number text-danger">Document size must be not greater than 3mb!</span>';
                status = 0;
            }
            else if(!fileType.includes(documentFile.files[0]['type']))
            {
                documentStatus = '<span class="info-bot-number text-danger">Not a PDF file!</span>';
                status = 0;
            }
            else
            {
                documentStatus = '<span class="info-bot-number text-success">Good to go!</span>';
                status = 1;
            }

            var reader = new FileReader();
            reader.onload = function(e) 
            {
                if(status == 1)
                {
                    $('#div_companyAttachmentResult').html(documentStatus);
                    $('#iframe_companyAttachmentPreview').prop('src',`${e.target.result}`);
                    $('#div_companyAttachmentPreview').prop('hidden',false);
                    $('#btn_submitCompanyAttachment').prop('disabled',false);
                }
            }
            reader.readAsDataURL(documentFile.files[0]);
        }
        else
        {
            $('#div_companyAttachmentResult').html('');
            $('#div_companyAttachmentPreview').prop('hidden',true);
            alert('Please select a file.');
        }
    }

    thisRepresentativeEmployeeList.r_loadCompanyAttachments = function(companyId)
    {
        AJAXHELPER.getData({
            // CompanyDocumentController->r_loadCompanyAttachments();
            'route' : '/portal/representative/r-load-company-attachments',
            'data'  : {
                'companyId' : companyId
            }
        }, function(data){
            data.forEach(function(value,index){
                let status = '';
                let color = '';
                let onclick = '';
                if(value['document_code'] == 'Attachment-01')
                {

                    status = (value['document_status'] == 1)? 'disc' : 'check';
                    color = (value['document_status'] == 1)? 'warning' : 'success';
                    $('#th_attachment01').html(`<center><i class="fe-${status} text-${color}"></i></center>`);
                    onclick = `REPRESENTATIVE_EMPLOYEE_LIST.r_selectCompanyAttachment(${value['id']},'Attachment-01', 'Sworn Statement');`;
                    $('#btn_attachment01').attr('onclick',onclick);
                }
                else if(value['document_code'] == 'Attachment-02')
                {
                    status = (value['document_status'] == 1)? 'disc' : 'check';
                    color = (value['document_status'] == 1)? 'warning' : 'success';
                    $('#th_attachment02').html(`<center><i class="fe-${status} text-${color}"></i></center>`);
                    onclick = `REPRESENTATIVE_EMPLOYEE_LIST.r_selectCompanyAttachment(${value['id']},'Attachment-02', 'Employee List');`;
                    $('#btn_attachment02').attr('onclick',onclick);
                }
                else if(value['document_code'] == 'Attachment-03')
                {
                    status = (value['document_status'] == 1)? 'disc' : 'check';
                    color = (value['document_status'] == 1)? 'warning' : 'success';
                    $('#th_attachment03').html(`<center><i class="fe-${status} text-${color}"></i></center>`);
                    onclick = `REPRESENTATIVE_EMPLOYEE_LIST.r_selectCompanyAttachment(${value['id']},'Attachment-03', 'BIR Employee List');`;
                    $('#btn_attachment03').attr('onclick',onclick);
                }
                else if(value['document_code'] == 'Attachment-04')
                {
                    status = (value['document_status'] == 1)? 'disc' : 'check';
                    color = (value['document_status'] == 1)? 'warning' : 'success';
                    $('#th_attachment04').html(`<center><i class="fe-${status} text-${color}"></i></center>`);
                    onclick = `REPRESENTATIVE_EMPLOYEE_LIST.r_selectCompanyAttachment(${value['id']},'Attachment-04', 'SSS R3');`;
                    $('#btn_attachment04').attr('onclick',onclick);
                }
            });
        });
    }

    thisRepresentativeEmployeeList.r_addCompanyAttachment = function(thisForm)
    {
        let formData = new FormData(thisForm);
        formData.set('txt_companyId',$("#txt_companyId").val());

        $('#btn_submitCompanyAttachment').prop('disabled',true);
        AJAXHELPER.postData({
            // CompanyDocumentController->r_addCompanyAttachment();
            'route' : 'portal/representative/r-add-company-attachment',
            'data'  : formData
        }, function(data){
            COMMONHELPER.Toaster('success',data[0]);
            setTimeout(function(){
                $('#btn_submitCompanyAttachment').prop('disabled',false);
                REPRESENTATIVE_EMPLOYEE_LIST.r_loadCompanyAttachments($("#txt_companyId").val());
                $('#modal_companyAttachment').modal('hide');
            }, 1000);
        }, function(data){
            COMMONHELPER.Toaster('error',data['responseJSON'][0]);
            $('#btn_submitCompanyAttachment').prop('disabled',false);
        });
    }

    thisRepresentativeEmployeeList.r_selectCompanyAttachment = function(documentId, documentCode, documentName)
    {
        AJAXHELPER.getData({
            // CompanyDocumentController->r_selectCompanyAttachment();
            'route' : '/portal/representative/r-select-company-attachment',
            'data'  : {
                'attachmentId' : documentId
            }
        }, function(data){
            if(data == null)
            {
                $('#txt_attachmentId').val('');
                $('.dropify-clear').click();
                $('#iframe_companyAttachmentPreview').prop('src',``);
                $('#div_companyAttachmentResult').html('');
                $('#div_companyAttachmentPreview').prop('hidden',true);
            }
            else
            {
                $('#txt_attachmentId').val(data['id']);
                $('#iframe_companyAttachmentPreview').prop('src',`${baseUrl}public/assets/uploads/company/attachments/${data['document_file']}`);
                $('#div_companyAttachmentPreview').prop('hidden',false);
            }
            $('#lbl_modalTitle3').html(documentName);
            $('#txt_attachmentCode').val(documentCode);
            $('#txt_attachmentName').val(documentName);
            $('#modal_companyAttachment').modal('show');
        });
    }

    thisRepresentativeEmployeeList.r_editCompanyAttachment = function(thisForm)
    {
        let formData = new FormData(thisForm);
        formData.set('txt_companyId',$("#txt_companyId").val());

        $('#btn_submitCompanyAttachment').prop('disabled',true);
        AJAXHELPER.postData({
            // CompanyDocumentController->r_editCompanyAttachment();
            'route' : 'portal/representative/r-edit-company-attachment',
            'data'  : formData
        }, function(data){
            COMMONHELPER.Toaster('success',data[0]);
            setTimeout(function(){
                $('#btn_submitCompanyAttachment').prop('disabled',false);
                REPRESENTATIVE_EMPLOYEE_LIST.r_loadCompanyAttachments($("#txt_companyId").val());
                $('#modal_companyAttachment').modal('hide');
            }, 1000);
        }, function(data){
            COMMONHELPER.Toaster('error',data['responseJSON'][0]);
            $('#btn_submitCompanyAttachment').prop('disabled',false);
        });
    }

    thisRepresentativeEmployeeList.r_submitAccessRequest = function(thisForm)
    {
        let formData = new FormData(thisForm);
        formData.set('txt_companyId',$("#txt_companyId").val());

        $('#btn_submitRequestForUpdate').prop('disabled',true);
        AJAXHELPER.postData({
            // ProductSubscriptionController->r_submitAccessRequest();
            'route' : 'portal/representative/r-submit-access-request',
            'data'  : formData
        }, function(data){
            COMMONHELPER.Toaster('success',data[0]);
            setTimeout(function(){
                $('#btn_submitRequestForUpdate').prop('disabled',false);
                setTimeout(function(){
                    window.location.replace(`${baseUrl}/portal/representative/employee-list`);   
                }, 1000);
            }, 1000);
        }, function(data){
            COMMONHELPER.Toaster('error',data['responseJSON'][0]);
            $('#btn_submitRequestForUpdate').prop('disabled',false);
        });
    }

    return thisRepresentativeEmployeeList;

})();