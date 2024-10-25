
const ADMIN_SALARY_ADVANCE_APPLICATIONS = (function(){

    let thisAdminSalaryAdvanceApplications = {};

    let baseUrl = $('#txt_baseUrl').val();

    thisAdminSalaryAdvanceApplications.a_loadProductSubscriptions = function()
    {
        AJAXHELPER.getData({
            // ProductSubscriptionController->a_loadProductSubscriptions();
            'route' : '/portal/admin/a-load-product-subscriptions',
            'data'  : null
        }, function(data){
            let tbody = '';
            data.forEach(function(value,index){
                tbody += `<tr>
                            <td h-align="middle">${value['created_date']}</td>
                            <td>${value['company_name']}</td>
                            <td>${value['company_code']}</td>
                            <td>${value['subscription_status']}</td>
                            <td>                                                        
                                <div class="dropdown">
                                    <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Actions <i class="mdi mdi-chevron-down"></i>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="javascript:void(0)" onclick="ADMIN_SALARY_ADVANCE_APPLICATIONS.a_selectProductSubscription(${value['id']})">Update</a>
                                        <a class="dropdown-item" href="javascript:void(0)" onclick="ADMIN_SALARY_ADVANCE_APPLICATIONS.a_loadCompanyEmployees(${value['company_id']})">Employee List</a>
                                    </div>
                                </div>
                            </td>
                        </tr>`;
            });
            $("#tbl_salaryAdvance").DataTable().destroy();
            $('#tbl_salaryAdvance tbody').html(tbody);
            $("#tbl_salaryAdvance").DataTable();
        });
    }

    thisAdminSalaryAdvanceApplications.a_selectProductSubscription = function(companyId)
    {
        AJAXHELPER.getData({
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

            ADMIN_SALARY_ADVANCE_APPLICATIONS.a_loadCompanyDocuments(companyId,data['business_type']);

            $('#slc_employeeListStatus').val(data['subscription_status']);
            $('#txt_remarks').val(data['remarks']);

            if(data['subscription_status'] == 'APPROVE' && data['access_status'] == 'CLOSE')
            {
                $('#btn_requestResubmission').prop('disabled',true).prop('hidden',true);
                $('#btn_acceptSubscription').prop('disabled',false).prop('hidden',true);
            }
            else
            {
                $('#btn_requestResubmission').prop('disabled',false).prop('hidden',false);
                $('#btn_acceptSubscription').prop('disabled',true).prop('hidden',false);
            }

            $('#div_salaryAdvanceList').prop('hidden',true);
            $('#div_salaryAdvanceUpdate').prop('hidden',false);
            $('#div_salaryAdvanceAttachments').prop('hidden',true);
        });
    }

    thisAdminSalaryAdvanceApplications.a_loadCompanyDocuments = function(companyId, businessType)
    {
        AJAXHELPER.getData({
            // CompanyDocumentController->a_loadCompanyDocuments()
            'route' : 'portal/admin/a-load-company-documents',
            'data'  : {
                'companyId' : companyId,
                'businessType' : businessType
            }
        }, function(data){
            let arrAccept = [0,0];

            if(businessType == 'Corporation')
            {
                let arrCorporation = [0,0,0,0,0];
                data.forEach(function(value,key){

                    let documentStatus = "";
                    let documentAction = "";

                    if(value['document_code'] == 'Corporation-01')
                    {
                        documentAction = `<a href="javascript:void(0)" onclick="ADMIN_SALARY_ADVANCE_APPLICATIONS.a_previewCompanyDocument(${companyId},${value['id']},'Document','${value['document_name']}','${value['document_file']}');">
                                        Preview
                                    </a>`;
                        $('#tr_corporation01 td:eq(1)').html(documentAction);

                        if(value['document_status'] == 1)
                        {
                            documentStatus = `<i class="text-warning">Pending</i>`;
                        }
                        else if(value['document_status'] == 2)
                        {
                            documentStatus = `<i class="text-success">Verified</i>`;
                            arrCorporation[0] = 1;
                        }
                        $('#tr_corporation01 td:eq(2)').html(documentStatus);
                    }

                    if(value['document_code'] == 'Corporation-02')
                    {
                        documentAction = `<a href="javascript:void(0)" onclick="ADMIN_SALARY_ADVANCE_APPLICATIONS.a_previewCompanyDocument(${companyId},${value['id']},'Document','${value['document_name']}','${value['document_file']}');">
                                        Preview
                                    </a>`;
                        $('#tr_corporation02 td:eq(1)').html(documentAction);

                        if(value['document_status'] == 1)
                        {
                            documentStatus = `<i class="text-warning">Pending</i>`;
                        }
                        else if(value['document_status'] == 2)
                        {
                            documentStatus = `<i class="text-success">Verified</i>`;
                            arrCorporation[1] = 1;
                        }
                        $('#tr_corporation02 td:eq(2)').html(documentStatus);
                    }

                    if(value['document_code'] == 'Corporation-03')
                    {                        
                        documentAction = `<a href="javascript:void(0)" onclick="ADMIN_SALARY_ADVANCE_APPLICATIONS.a_previewCompanyDocument(${companyId},${value['id']},'Document','${value['document_name']}','${value['document_file']}');">
                                        Preview
                                    </a>`;
                        $('#tr_corporation03 td:eq(1)').html(documentAction);

                        if(value['document_status'] == 1)
                        {
                            documentStatus = `<i class="text-warning">Pending</i>`;
                        }
                        else if(value['document_status'] == 2)
                        {
                            documentStatus = `<i class="text-success">Verified</i>`;
                            arrCorporation[2] = 1;
                        }
                        $('#tr_corporation03 td:eq(2)').html(documentStatus);
                    }

                    if(value['document_code'] == 'Corporation-04')
                    {                        
                        documentAction = `<a href="javascript:void(0)" onclick="ADMIN_SALARY_ADVANCE_APPLICATIONS.a_previewCompanyDocument(${companyId},${value['id']},'Document','${value['document_name']}','${value['document_file']}');">
                                        Preview
                                    </a>`;
                        $('#tr_corporation04 td:eq(1)').html(documentAction);

                        if(value['document_status'] == 1)
                        {
                            documentStatus = `<i class="text-warning">Pending</i>`;
                        }
                        else if(value['document_status'] == 2)
                        {
                            documentStatus = `<i class="text-success">Verified</i>`;
                            arrCorporation[3] = 1;
                        }
                        $('#tr_corporation04 td:eq(2)').html(documentStatus);
                    }

                    if(value['document_code'] == 'Corporation-05')
                    {                        
                        documentAction = `<a href="javascript:void(0)" onclick="ADMIN_SALARY_ADVANCE_APPLICATIONS.a_previewCompanyDocument(${companyId},${value['id']},'Document','${value['document_name']}','${value['document_file']}');">
                                        Preview
                                    </a>`;
                        $('#tr_corporation05 td:eq(1)').html(documentAction);

                        if(value['document_status'] == 1)
                        {
                            documentStatus = `<i class="text-warning">Pending</i>`;
                        }
                        else if(value['document_status'] == 2)
                        {
                            documentStatus = `<i class="text-success">Verified</i>`;
                            arrCorporation[4] = 1;
                        }
                        $('#tr_corporation05 td:eq(2)').html(documentStatus);
                    }
                });
                $('#tbl_companyCorporationDocuments').prop('hidden',false);
                $('#tbl_companyProprietorShipDocuments').prop('hidden',true);
                $('#tbl_companyPartnershipDocuments').prop('hidden',true);

                console.log(arrCorporation);
                arrAccept[0] = (arrCorporation.includes(0))? 0 : 1;
            }
            else if(businessType == 'Proprietorship')
            {
                let arrProprietorship = [0,0];
                data.forEach(function(value,key){

                    let documentStatus = "";
                    let documentAction = "";

                    if(value['document_code'] == 'Proprietorship-01')
                    {
                        documentAction = `<a href="javascript:void(0)" onclick="ADMIN_SALARY_ADVANCE_APPLICATIONS.a_previewCompanyDocument(${companyId},${value['id']},'Document','${value['document_name']}','${value['document_file']}');">
                                        Preview
                                    </a>`;
                        $('#tr_proprietorship01 td:eq(1)').html(documentAction);

                        if(value['document_status'] == 1)
                        {
                            documentStatus = `<i class="text-warning">Pending</i>`;
                        }
                        else if(value['document_status'] == 2)
                        {
                            documentStatus = `<i class="text-success">Verified</i>`;
                            arrProprietorship[0] = 1;
                        }
                        $('#tr_proprietorship01 td:eq(2)').html(documentStatus);
                    }

                    if(value['document_code'] == 'Proprietorship-02')
                    {
                        documentAction = `<a href="javascript:void(0)" onclick="ADMIN_SALARY_ADVANCE_APPLICATIONS.a_previewCompanyDocument(${companyId},${value['id']},'Document','${value['document_name']}','${value['document_file']}');">
                                        Preview
                                    </a>`;
                        $('#tr_proprietorship02 td:eq(1)').html(documentAction);

                        if(value['document_status'] == 1)
                        {
                            documentStatus = `<i class="text-warning">Pending</i>`;
                        }
                        else if(value['document_status'] == 2)
                        {
                            documentStatus = `<i class="text-success">Verified</i>`;
                            arrProprietorship[1] = 1;
                        }
                        $('#tr_proprietorship02 td:eq(2)').html(documentStatus);
                    }
                });
                $('#tbl_companyCorporationDocuments').prop('hidden',true);
                $('#tbl_companyProprietorShipDocuments').prop('hidden',false);
                $('#tbl_companyPartnershipDocuments').prop('hidden',true);

                arrAccept[0] = (arrProprietorship.includes(0))? 0 : 1;
            }
            else if(businessType == 'Partnership')
            {   
                let arrPartnership = [0,0,0,0];
                data.forEach(function(value,key){

                    let documentStatus = "";
                    let documentAction = "";

                    if(value['document_code'] == 'Partnership-01')
                    {
                        documentAction = `<a href="javascript:void(0)" onclick="ADMIN_SALARY_ADVANCE_APPLICATIONS.a_previewCompanyDocument(${companyId},${value['id']},'Document','${value['document_name']}','${value['document_file']}');">
                                        Preview
                                    </a>`;
                        $('#tr_partnership01 td:eq(1)').html(documentAction);

                        if(value['document_status'] == 1)
                        {
                            documentStatus = `<i class="text-warning">Pending</i>`;
                        }
                        else if(value['document_status'] == 2)
                        {
                            documentStatus = `<i class="text-success">Verified</i>`;
                            arrPartnership[0] = 1;
                        }
                        $('#tr_partnership01 td:eq(2)').html(documentStatus);
                    }

                    if(value['document_code'] == 'Partnership-02')
                    {
                        documentAction = `<a href="javascript:void(0)" onclick="ADMIN_SALARY_ADVANCE_APPLICATIONS.a_previewCompanyDocument(${companyId},${value['id']},'Document','${value['document_name']}','${value['document_file']}');">
                                        Preview
                                    </a>`;
                        $('#tr_partnership02 td:eq(1)').html(documentAction);

                        if(value['document_status'] == 1)
                        {
                            documentStatus = `<i class="text-warning">Pending</i>`;
                        }
                        else if(value['document_status'] == 2)
                        {
                            documentStatus = `<i class="text-success">Verified</i>`;
                            arrPartnership[1] = 1;
                        }
                        $('#tr_partnership02 td:eq(2)').html(documentStatus);
                    }

                    if(value['document_code'] == 'Partnership-03')
                    {
                        documentAction = `<a href="javascript:void(0)" onclick="ADMIN_SALARY_ADVANCE_APPLICATIONS.a_previewCompanyDocument(${companyId},${value['id']},'Document','${value['document_name']}','${value['document_file']}');">
                                        Preview
                                    </a>`;
                        $('#tr_partnership03 td:eq(1)').html(documentAction);

                        if(value['document_status'] == 1)
                        {
                            documentStatus = `<i class="text-warning">Pending</i>`;
                        }
                        else if(value['document_status'] == 2)
                        {
                            documentStatus = `<i class="text-success">Verified</i>`;
                            arrPartnership[2] = 1;
                        }
                        $('#tr_partnership03 td:eq(2)').html(documentStatus);
                    }

                    if(value['document_code'] == 'Partnership-04')
                    {
                        documentAction = `<a href="javascript:void(0)" onclick="ADMIN_SALARY_ADVANCE_APPLICATIONS.a_previewCompanyDocument(${companyId},${value['id']},'Document','${value['document_name']}','${value['document_file']}');">
                                        Preview
                                    </a>`;
                        $('#tr_partnership04 td:eq(1)').html(documentAction);

                        if(value['document_status'] == 1)
                        {
                            documentStatus = `<i class="text-warning">Pending</i>`;
                        }
                        else if(value['document_status'] == 2)
                        {
                            documentStatus = `<i class="text-success">Verified</i>`;
                            arrPartnership[3] = 1;
                        }
                        $('#tr_partnership04 td:eq(2)').html(documentStatus);
                    }
                });
                $('#tbl_companyCorporationDocuments').prop('hidden',true);
                $('#tbl_companyProprietorShipDocuments').prop('hidden',true);
                $('#tbl_companyPartnershipDocuments').prop('hidden',false);

                arrAccept[0] = (arrPartnership.includes(0))? 0 : 1;
            }

            let arrAttachments = [0,0,0,0];
            data.forEach(function(value,key){

                let attachmentStatus = "";
                let attachmentAction = "";

                if(value['document_code'].search('Attachment') != -1)
                {
                    if(value['document_code'] == 'Attachment-01')
                    {
                        attachmentAction = `<a href="javascript:void(0)" onclick="ADMIN_SALARY_ADVANCE_APPLICATIONS.a_previewCompanyDocument(${companyId},${value['id']},'Attachment','${value['document_name']}','${value['document_file']}');">
                                        Preview
                                    </a>`;
                        $('#tr_attachment01 td:eq(1)').html(attachmentAction);

                        if(value['document_status'] == 1)
                        {
                            attachmentStatus = `<i class="text-warning">Pending</i>`;
                        }
                        else if(value['document_status'] == 2)
                        {
                            attachmentStatus = `<i class="text-success">Verified</i>`;
                            arrAttachments[0] = 1;
                        }
                        $('#tr_attachment01 td:eq(2)').html(attachmentStatus);
                    }

                    if(value['document_code'] == 'Attachment-02')
                    {                        
                        attachmentAction = `<a href="javascript:void(0)" onclick="ADMIN_SALARY_ADVANCE_APPLICATIONS.a_previewCompanyDocument(${companyId},${value['id']},'Attachment','${value['document_name']}','${value['document_file']}');">
                                        Preview
                                    </a>`;
                        $('#tr_attachment02 td:eq(1)').html(attachmentAction);

                        if(value['document_status'] == 1)
                        {
                            attachmentStatus = `<i class="text-warning">Pending</i>`;
                        }
                        else if(value['document_status'] == 2)
                        {
                            attachmentStatus = `<i class="text-success">Verified</i>`;
                            arrAttachments[1] = 1;
                        }
                        $('#tr_attachment02 td:eq(2)').html(attachmentStatus);
                    }

                    if(value['document_code'] == 'Attachment-03')
                    {                        
                        attachmentAction = `<a href="javascript:void(0)" onclick="ADMIN_SALARY_ADVANCE_APPLICATIONS.a_previewCompanyDocument(${companyId},${value['id']},'Attachment','${value['document_name']}','${value['document_file']}');">
                                        Preview
                                    </a>`;
                        $('#tr_attachment03 td:eq(1)').html(attachmentAction);

                        if(value['document_status'] == 1)
                        {
                            attachmentStatus = `<i class="text-warning">Pending</i>`;
                        }
                        else if(value['document_status'] == 2)
                        {
                            attachmentStatus = `<i class="text-success">Verified</i>`;
                            arrAttachments[2] = 1;
                        }
                        $('#tr_attachment03 td:eq(2)').html(attachmentStatus);
                    }

                    if(value['document_code'] == 'Attachment-04')
                    {                        
                        attachmentAction = `<a href="javascript:void(0)" onclick="ADMIN_SALARY_ADVANCE_APPLICATIONS.a_previewCompanyDocument(${companyId},${value['id']},'Attachment','${value['document_name']}','${value['document_file']}');">
                                        Preview
                                    </a>`;
                        $('#tr_attachment04 td:eq(1)').html(attachmentAction);

                        if(value['document_status'] == 1)
                        {
                            attachmentStatus = `<i class="text-warning">Pending</i>`;
                        }
                        else if(value['document_status'] == 2)
                        {
                            attachmentStatus = `<i class="text-success">Verified</i>`;
                            arrAttachments[3] = 1;
                        }
                        $('#tr_attachment04 td:eq(2)').html(attachmentStatus);
                    }
                }
            });

            console.log(arrAttachments);
            arrAccept[1] = (arrAttachments.includes(0))? 0 : 1;

            console.log(arrAccept);

            $('#btn_acceptSubscription').prop('disabled',(arrAccept.includes(0))? false : true);

            if(arrAccept.includes(0))
            {   
                $('#slc_employeeListStatus').val('RESUBMIT');
                $('#btn_requestResubmission').prop('disabled',false);
                $('#btn_acceptSubscription').prop('disabled',true);
            }
            else
            {
                $('#slc_employeeListStatus').val('APPROVE');
                $('#btn_requestResubmission').prop('disabled',true);
                $('#btn_acceptSubscription').prop('disabled',false);
            }

        });
    }

    thisAdminSalaryAdvanceApplications.a_previewCompanyDocument = function(companyId, documentId, documentCode, documentName, documentFile)
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

    thisAdminSalaryAdvanceApplications.a_verifyCompanyDocument = function()
    {
        let formData = new FormData();
        formData.set("txt_documentId", $('#txt_documentId').val());

        $('#btn_verifyDocument').prop('disabled',true);
        
        AJAXHELPER.postData({
            // CompanyDocumentController->a_verifyCompanyDocument
            'route' : 'portal/admin/a-verify-company-document',
            'data'  : formData
        }, function(data){
            COMMONHELPER.Toaster('success',data[0]);
            setTimeout(function(){
                $('#btn_verifyDocument').prop('disabled',false);
                $('#modal_companyDocumentPreview').modal('hide');
                ADMIN_SALARY_ADVANCE_APPLICATIONS.a_selectProductSubscription($('#txt_companyId').val());
            }, 1000);
        }, function(data){ 
            COMMONHELPER.Toaster('error',data['responseJSON'][0]);
            $('#btn_verifyDocument').prop('disabled',false);
        });
    }

    thisAdminSalaryAdvanceApplications.a_failedCompanySubscription = function()
    {
        let formData = new FormData();
        formData.set("txt_subscriptionId", $('#txt_subscriptionId').val());
        formData.set('slc_employeeListStatus', $('#slc_employeeListStatus').val());
        formData.set('txt_remarks', $('#txt_remarks').val());

        $('#btn_requestResubmission').prop('disabled',true);
        
        AJAXHELPER.postData({
            // ProductSubscriptionController::a_failedCompanySubscription()
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
        }, function(data){ 
            COMMONHELPER.Toaster('error',data['responseJSON'][0]);
            $('#btn_requestResubmission').prop('disabled',false);
        });
    }

    thisAdminSalaryAdvanceApplications.a_acceptCompanySubscription = function()
    {
        if(confirm('Please Confirm!'))
        {            
            let formData = new FormData();
            formData.set("txt_companyId", $('#txt_companyId').val());
            formData.set("txt_subscriptionId", $('#txt_subscriptionId').val());
            formData.set('slc_employeeListStatus', $('#slc_employeeListStatus').val());
            formData.set('txt_remarks', $('#txt_remarks').val());

            $('#btn_requestResubmission').prop('disabled',true);
           
            AJAXHELPER.postData({
                // ProductSubscriptionController::a_acceptCompanySubscription()
                'route' : 'portal/admin/a-accept-company-subscription',
                'data'  : formData
            }, function(data){
                let currentIndex = parseInt(data.length);
                let progress = 100 / parseInt(data.length);
                let progressRem = 100 % parseInt(data.length);
                let totalProgress = 0;
                let count = 0;
                let importCount = 0;
                $('#modal_employeeEmailVerification').modal('show');
                ADMIN_SALARY_ADVANCE_APPLICATIONS.a_sendEmployeeEmailVerification(currentIndex, progress, progressRem, totalProgress, count, importCount, data);
            }, function(data){ 
                COMMONHELPER.Toaster('error',data['responseJSON'][0]);
                $('#btn_requestResubmission').prop('disabled',false);
            }); 
       }
    }

    thisAdminSalaryAdvanceApplications.a_sendEmployeeEmailVerification = function(currentIndex, progress, progressRem, totalProgress, count, importCount, arrData)
    {
        setTimeout(function(){  
            let formData = new FormData();
            formData.set("employeeId", arrData[count]['id']);
            AJAXHELPER.sendEmail({
                // EmployeeController::a_sendEmployeeEmailVerification()
                'route' : 'portal/admin/a-send-employee-email-verification',
                'data'  : formData
            }, function(data){
                if(count == (parseInt(arrData.length) - 1))
                {
                    progressRem = 100 - totalProgress;
                    totalProgress += progressRem;   
                }
                else
                {
                    totalProgress += progress;
                }

                importCount += 1;

                $('#div_progressBar').css('width',`${totalProgress}%`);
                $('#lbl_progress').text(`${importCount} / ${currentIndex} Sent`);

                if(totalProgress < 100)
                {
                    count++;
                    ADMIN_SALARY_ADVANCE_APPLICATIONS.a_sendEmployeeEmailVerification(currentIndex, progress, progressRem, totalProgress, count, importCount, arrData);
                }
                else
                {
                    COMMONHELPER.Toaster('success','Email verification sent!');
                    setTimeout(function(){
                        $('#modal_employeeEmailVerification').modal('hide');
                        window.location.replace(`${baseUrl}portal/admin/salary-advance-applications`);
                    }, 1000);
                }
            }, function(data){ 
                COMMONHELPER.Toaster('error',data['responseJSON'][0]);
            }); 
        }, 1000);
    }

    thisAdminSalaryAdvanceApplications.a_loadCompanyEmployees = function(companyId)
    {
        $('#div_salaryAdvanceList').prop('hidden',true);
        $('#div_salaryAdvanceEmployeeList').prop('hidden',false);
        $('#div_salaryAdvanceUpdate').prop('hidden',true);
        $('#div_salaryAdvanceAttachments').prop('hidden',true);
        
        AJAXHELPER.getData({
            // CompanyDocumentController->a_loadCompanyEmployees();
            'route' : '/portal/admin/a-load-company-employees',
            'data'  : {
                'companyId' : companyId
            }
        }, function(data){
            let tbody = '';
            data.forEach(function(value,index){
                tbody += `<tr>
                            <td>${value['identification_number']}</td>
                            <td>${value['last_name']}</td>
                            <td>${value['first_name']}</td>
                            <td>${value['middle_name']}</td>
                            <td>${value['email_address']}</td>
                            <td>${COMMONHELPER.validateFields(value['mobile_number'],'---')}</td>
                            <td>${COMMONHELPER.validateFields(value['department'],'---')}</td>
                            <td>${COMMONHELPER.validateFields(value['position'],'---')}</td>
                            <td>${COMMONHELPER.validateFields(value['date_hired'],'---')}</td>
                            <td>${COMMONHELPER.validateFields(value['gross_salary'],'---')}</td>
                            <td>${COMMONHELPER.validateFields(value['net_salary'],'---')}</td>
                        </tr>`;
            });
            $("#tbl_employeeList").DataTable().destroy();
            $('#tbl_employeeList tbody').html(tbody);
            $("#tbl_employeeList").DataTable({'scrollX':true});
        });
    }

    return thisAdminSalaryAdvanceApplications;

})();