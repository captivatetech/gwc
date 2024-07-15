
const ADMIN_SALARY_ADVANCE = (function(){

    let thisAdminSalaryAdvance = {};

    let baseUrl = $('#txt_baseUrl').val();

    thisAdminSalaryAdvance.a_loadProductSubscriptions = function()
    {
        AJAXHELPER.loadData({
            // ProductSubscriptionController->a_loadProductSubscriptions();
            'route' : '/portal/admin/a-load-product-subscriptions',
            'data'  : {
                'companyId' : 'companyId'
            }
        }, function(data){
            let tbody = '';
            data.forEach(function(value,index){
                tbody += `<tr>
                            <td>???</td>
                            <td>${value['company_name']}</td>
                            <td>${value['company_code']}</td>
                            <td>${value['subscription_status']}</td>
                            <td>                                                        
                                <div class="dropdown">
                                    <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Actions <i class="mdi mdi-chevron-down"></i>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="javascript:void(0)" onclick="ADMIN_SALARY_ADVANCE.a_selectProductSubscription(${value['id']})">Update</a>
                                        <a class="dropdown-item" href="javascript:void(0)" onclick="ADMIN_SALARY_ADVANCE.a_loadCompanyEmployees(${value['company_id']})">Employee List</a>
                                    </div>
                                </div>
                            </td>
                        </tr>`;
            });
            $("#tbl_salaryAdvance").DataTable().destroy();
            $('#tbl_salaryAdvance tbody').html(tbody);
            $("#tbl_salaryAdvance").DataTable({pageLength:10,lengthMenu:[10,20,50,100,200,500]});
        });
    }

    thisAdminSalaryAdvance.a_selectProductSubscription = function(companyId)
    {
        AJAXHELPER.selectData({
            // ProductSubscriptionController::a_selectProductSubscription
            'route' : 'portal/admin/a-select-product-subscription',
            'data'  : {
                'companyId' : companyId
            }
        }, function(data){

            $('#txt_subscriptionId').val(data['id']);
            $('#txt_companyId').val(data['company_id']);

            $('#lbl_businessName').text(data['company_name']);
            $('#lbl_businessAddress').text(data['company_address']);
            $('#lbl_industry').text(data['business_industry']);
            $('#lbl_contactNumbers').text(`${data['mobile_number']} ${data['telephone_number']}`);
            $('#lbl_companyEmail').text(data['company_email']);
            $('#lbl_companyWebsite').text(data['company_website']);
            $('#lbl_companyCode').text(data['company_code']);
            $('#lbl_representative').text(`${data['first_name']} ${data['last_name']}`);
            $('#lbl_productName').text(`${data['product_name']} (${data['product_code']})`);
            $('#lbl_description').text(data['product_details']);

            ADMIN_SALARY_ADVANCE.a_loadCompanyDocuments(companyId,data['business_type']);

            $('#slc_employeeListStatus').val(data['subscription_status']);
            $('#txt_remarks').val(data['remarks']);

            if(data['subscription_status'] == 'Approve')
            {
                $('#btn_requestResubmission').prop('disabled',true);
                $('#btn_acceptSubscription').prop('disabled',false);
            }
            else
            {
                $('#btn_requestResubmission').prop('disabled',false);
                $('#btn_acceptSubscription').prop('disabled',true);
            }

            $('#div_salaryAdvanceList').prop('hidden',true);
            $('#div_salaryAdvanceUpdate').prop('hidden',false);
            $('#div_salaryAdvanceAttachments').prop('hidden',true);
        });
    }

    thisAdminSalaryAdvance.a_loadCompanyDocuments = function(companyId, businessType)
    {
        AJAXHELPER.loadData({
            // CompanyDocumentController->a_loadCompanyDocuments()
            'route' : 'portal/admin/a-load-company-documents',
            'data'  : {
                'companyId' : companyId,
                'businessType' : businessType
            }
        }, function(data){
            let tbody = "";
            let arrVerifiedDocuments = [];
            data.forEach(function(value,index){
                let status = '';
                let documentCode = '';
                if(value['document_status'] == 1)
                {
                    status = `<span class="text-warning">Pending</span>`;
                    arrVerifiedDocuments.push('Pending');
                }
                else if(value['document_status'] == 2)
                {
                    status = `<span class="text-success">Verified</span>`;
                    arrVerifiedDocuments.push('Verified');
                }
                if(value['document_code'].search('Attachment') != -1)
                {
                    documentCode = 'Attachment';
                }
                else
                {
                    documentCode = 'Document';
                }
                tbody += `<tr>
                            <td>${value['document_name']}</td>
                            <td>
                                <a href="javascript:void(0)" onclick="ADMIN_SALARY_ADVANCE.a_previewCompanyDocument(${companyId},${value['id']},'${documentCode}','${value['document_name']}','${value['document_file']}')"><i>Preview</i></a>
                            </td>
                            <td>${status}</td>
                        </tr>`;
            });
            $('#tbl_attachedDocuments tbody').html(tbody);

            $('#btn_accept').prop('disabled',(arrVerifiedDocuments.includes('Pending'))? true : false);
        });
    }

    thisAdminSalaryAdvance.a_previewCompanyDocument = function(companyId, documentId, documentCode, documentName, documentFile)
    {
        $('#lbl_modalTitle1').text(documentName);
        $('#txt_companyId').val(companyId);
        $('#txt_documentId').val(documentId);
        let src = ``;
        if(documentCode == 'Attachment')
        {
            src = `${baseUrl}public/assets/uploads/company/attachments/${documentFile}`;
        }
        else
        {
            src = `${baseUrl}public/assets/uploads/company/documents/${documentFile}`;
        }
        $('#iframe_companyDocumentPreview').prop('src',`${src}`);
        $('#modal_companyDocumentPreview').modal('show');
    }

    thisAdminSalaryAdvance.a_verifyCompanyDocument = function()
    {
        let formData = new FormData();
        formData.set("txt_documentId", $('#txt_documentId').val());

        $('#btn_verifyDocument').prop('disabled',true);
        
        AJAXHELPER.addData({
            'route' : 'portal/admin/a-verify-company-document',
            'data'  : formData
        }, function(data){
            COMMONHELPER.Toaster('success',data[0]);
            setTimeout(function(){
                $('#btn_verifyDocument').prop('disabled',false);
                $('#modal_companyDocumentPreview').modal('hide');
                ADMIN_SALARY_ADVANCE.a_selectProductSubscription($('#txt_companyId').val());
            }, 1000);
        }, function(data){ // Error
            COMMONHELPER.Toaster('error',data['responseJSON'][0]);
            $('#btn_verifyDocument').prop('disabled',false);
        });
    }

    thisAdminSalaryAdvance.a_failedCompanySubscription = function()
    {
        let formData = new FormData();
        formData.set("txt_subscriptionId", $('#txt_subscriptionId').val());
        formData.set('slc_employeeListStatus', $('#slc_employeeListStatus').val());
        formData.set('txt_remarks', $('#txt_remarks').val());

        $('#btn_requestResubmission').prop('disabled',true);
        
        AJAXHELPER.editData({
            // CompanyDocumentController::a_failedCompanySubscription()
            'route' : 'portal/admin/a-failed-company-subscription',
            'data'  : formData
        }, function(data){
            COMMONHELPER.Toaster('success',data[0]);
            setTimeout(function(){
                $('#btn_requestResubmission').prop('disabled',false);
                $('#div_salaryAdvanceList').prop('hidden',false);
                $('#div_salaryAdvanceEmployeeList').prop('hidden',true);
                $('#div_salaryAdvanceUpdate').prop('hidden',true);
            }, 1000);
        }, function(data){ // Error
            COMMONHELPER.Toaster('error',data['responseJSON'][0]);
            $('#btn_requestResubmission').prop('disabled',false);
        });
    }

    thisAdminSalaryAdvance.a_acceptCompanySubscription = function()
    {
        if(confirm('Please Confirm!'))
        {
           let formData = new FormData();
           formData.set("txt_companyId", $('#txt_companyId').val());
           formData.set("txt_subscriptionId", $('#txt_subscriptionId').val());
           formData.set('slc_employeeListStatus', $('#slc_employeeListStatus').val());
           formData.set('txt_remarks', $('#txt_remarks').val());

           $('#btn_requestResubmission').prop('disabled',true);
           
           AJAXHELPER.editData({
               // CompanyDocumentController::a_acceptCompanySubscription()
               'route' : 'portal/admin/a-accept-company-subscription',
               'data'  : formData
           }, function(data){
               data.forEach(function(value, index){
                   ADMIN_SALARY_ADVANCE.a_sendEmployeeEmailVerification(value['id']);
               });
               setTimeout(function(){
                   $('#btn_requestResubmission').prop('disabled',false);
                   $('#div_salaryAdvanceList').prop('hidden',false);
                   $('#div_salaryAdvanceEmployeeList').prop('hidden',true);
                   $('#div_salaryAdvanceUpdate').prop('hidden',true);
               }, 1000);
           }, function(data){ // Error
               COMMONHELPER.Toaster('error',data['responseJSON'][0]);
               $('#btn_requestResubmission').prop('disabled',false);
           }); 
       }
    }

    thisAdminSalaryAdvance.a_sendEmployeeEmailVerification = function(employeeId)
    {
        let formData = new FormData();
        formData.set("employeeId", employeeId);
        
        AJAXHELPER.editData({
            // CompanyDocumentController::a_acceptCompanySubscription()
            'route' : 'portal/admin/a-accept-company-subscription',
            'data'  : formData
        }, function(data){
            COMMONHELPER.Toaster('success',data[0]);
        }, function(data){ // Error
            COMMONHELPER.Toaster('error',data['responseJSON'][0]);
        }); 
    }

    thisAdminSalaryAdvance.a_loadCompanyEmployees = function(companyId)
    {
        $('#div_salaryAdvanceList').prop('hidden',true);
        $('#div_salaryAdvanceEmployeeList').prop('hidden',false);
        $('#div_salaryAdvanceUpdate').prop('hidden',true);
        $('#div_salaryAdvanceAttachments').prop('hidden',true);
        
        AJAXHELPER.loadData({
            // CompanyDocumentController->a_loadCompanyEmployees();
            'route' : '/portal/admin/a-load-company-employees',
            'data'  : {
                'companyId' : companyId
            }
        }, function(data){
            let tbody = '';
            data.forEach(function(value,index){
                tbody += `<tr>
                            <td>???</td>
                            <td>${value['last_name']}</td>
                            <td>${value['first_name']}</td>
                            <td>${value['middle_name']}</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>`;
            });
            $("#tbl_employeeList").DataTable().destroy();
            $('#tbl_employeeList tbody').html(tbody);
            $("#tbl_employeeList").DataTable({pageLength:10,lengthMenu:[10,20,50,100,200,500]});
        });
    }

    return thisAdminSalaryAdvance;

})();