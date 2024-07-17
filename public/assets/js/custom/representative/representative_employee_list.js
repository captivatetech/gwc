
const REPRESENTATIVE_EMPLOYEE_LIST = (function(){

    let thisRepresentativeEmployeeList = {};

    let baseUrl = $('#txt_baseUrl').val();

    thisRepresentativeEmployeeList.r_loadEmployees = function(companyId)
    {
        AJAXHELPER.loadData({
            // EmployeeController->r_loadEmployees();
            'route' : '/portal/representative/r-load-employees',
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

                tbody += `<tr>
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
                                        <a class="dropdown-item" href="javascript:void(0)" onclick="REPRESENTATIVE_EMPLOYEE_LIST.r_selectEmployee(${value['id']})">Edit</a>
                                        <a class="dropdown-item" href="javascript:void(0)" onclick="REPRESENTATIVE_EMPLOYEE_LIST.r_removeEmployee(${value['id']})">Delete</a>
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

    thisRepresentativeEmployeeList.r_calculateEmployeeYearsStayed = function()
    {
        
    }

    thisRepresentativeEmployeeList.r_addEmployee = function(thisForm)
    {
        let formData = new FormData(thisForm);
        formData.set('txt_companyId',$("#txt_companyId").val());

        $('#btn_submitEmployee').prop('disabled',true);

        AJAXHELPER.addData({
            // EmployeeController->r_addEmployee();
            'route' : 'portal/representative/r-add-employee',
            'data'  : formData
        }, function(data){
            COMMONHELPER.Toaster('success',data[0]);
            setTimeout(function(){
                $('#btn_submitEmployee').prop('disabled',false);
                window.location.replace(`${baseUrl}portal/representative/employee-list`);
            }, 1000);
        }, function(data){ // Error
            COMMONHELPER.Toaster('error',data['responseJSON'][0]);
            $('#btn_submitEmployee').prop('disabled',false);
        });
    }

    thisRepresentativeEmployeeList.r_selectEmployee = function(employeeId)
    {
        AJAXHELPER.selectData({
            // EmployeeController->r_selectEmployee();
            'route' : '/portal/representative/r-select-employee',
            'data'  : {
                'employeeId' : employeeId
            }
        }, function(data){
            $('#txt_employeeId').val(data['id']);
            $('#txt_lastName').val(data['last_name']);
            $('#txt_firstName').val(data['first_name']);
            $('#txt_middleName').val(data['middle_name']);
            $('#txt_taxIdentificationNumber').val(data['identification_number']);
            $('#txt_position').val(data['position']);
            $('#txt_department').val(data['department']);
            $('#txt_grossSalary').val(data['gross_salary']);
            $('#slc_maritalStatus').val(data['marital_status']);
            $('#txt_homeAddress').val(data['permanent_address']);
            $('#txt_mobileNumber').val(data['mobile_number']);
            $('#txt_emailAddress').val(data['email_address']);
            $('#txt_dateHired').val(data['date_hired']);
            $('#txt_yearsStayed').val(data['years_stayed']);
            $('#slc_employmentStatus').val(data['employment_status']);
            $('#txt_payrollBankAccount').val(data['payroll_bank_number']);
            $('#txt_minimumAmount').val(data['minimum_credit_amount']);
            $('#txt_maximumAmount').val(data['maximum_credit_amount']);
            $('#slc_employeeStatus').val(data['employee_status']);
            $('#modal_employee').modal('show');
        });
    }

    thisRepresentativeEmployeeList.r_editEmployee = function(thisForm)
    {
        let formData = new FormData(thisForm);
        formData.set('txt_companyId',$("#txt_companyId").val());

        $('#btn_submitEmployee').prop('disabled',true);

        AJAXHELPER.editData({
            // EmployeeController->r_editEmployee();
            'route' : 'portal/representative/r-edit-employee',
            'data'  : formData
        }, function(data){
            COMMONHELPER.Toaster('success',data[0]);
            setTimeout(function(){
                $('#btn_submitEmployee').prop('disabled',false);
                window.location.replace(`${baseUrl}portal/representative/employee-list`);
            }, 1000);
        }, function(data){ // Error
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
            }, function(data){ // Error
                COMMONHELPER.Toaster('error',data['responseJSON'][0]);
            });
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
        AJAXHELPER.loadData({
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

        AJAXHELPER.addData({
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
        }, function(data){ // Error
            COMMONHELPER.Toaster('error',data['responseJSON'][0]);
            $('#btn_submitCompanyAttachment').prop('disabled',false);
        });
    }

    thisRepresentativeEmployeeList.r_selectCompanyAttachment = function(documentId, documentCode, documentName)
    {
        AJAXHELPER.selectData({
            // CompanyDocumentController->r_selectCompanyAttachment();
            'route' : '/portal/representative/r-select-company-attachment',
            'data'  : {
                'attachmentId' : documentId
            }
        }, function(data){
            if(data == null)
            {
                $('#txt_attachmentId').val('');
                $('#iframe_companyAttachmentPreview').prop('src',``);
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

        AJAXHELPER.editData({
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
        }, function(data){ // Error
            COMMONHELPER.Toaster('error',data['responseJSON'][0]);
            $('#btn_submitCompanyAttachment').prop('disabled',false);
        });
    }

    return thisRepresentativeEmployeeList;

})();