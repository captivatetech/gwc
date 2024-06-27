
const REPRESENTATIVE_COMPANY_PROFILE = (function(){

    let thisRepresentativeCompanyProfile = {};

    let baseUrl = $('#txt_baseUrl').val();

    thisRepresentativeCompanyProfile.selectRepresentativeCompanyInformation = function(companyId)
    {
        AJAXHELPER.selectData({
            'route' : '/portal/representative/select-representative-company-information',
            'data'  : {
                'companyId' : companyId
            }
        }, function(data){
            if(data['business_type'] == 'Corporation')
            {
                $('#rdb_corporation').prop('checked',true);
            }
            else if(data['business_type'] == 'Proprietorship')
            {
                $('#rdb_proprietorship').prop('checked',true);
            }
            else if(data['business_type'] == 'Partnership')
            {
                $('#rdb_partnership').prop('checked',true);
            }
            $('#txt_businessName').val(data['company_name']);
            $('#txt_businessAddress').val(data['company_address']);
            $('#slc_industry').val(data['business_industry']);
            $('#txt_mobileNumber').val(data['mobile_number']);
            $('#txt_telephoneNumber').val(data['telephone_number']);
            $('#txt_companyEmail').val(data['company_email']);
            $('#txt_companyWebsite').val(data['company_website']);
            $('#txt_taxIdentificationNumber').val(data['tax_identification_number']);
        });
    }

    thisRepresentativeCompanyProfile.editRepresentativeCompanyInformation = function(thisForm)
    {
        let formData = new FormData(thisForm);
        formData.set('rdb_businessType',$("input[type='radio'][name='rdb_businessType']:checked").val());

        $('#btn_submitCompanyInformation').prop('disabled',true);

        AJAXHELPER.editData({
            'route' : 'portal/representative/edit-representative-company-information',
            'data'  : formData
        }, function(data){
            COMMONHELPER.Toaster('success',data[0]);
            setTimeout(function(){
                $('#btn_submitCompanyInformation').prop('disabled',false);
                window.location.replace(`${baseUrl}portal/representative/company-profile`);
            }, 1000);
        }, function(data){ // Error
            COMMONHELPER.Toaster('error',data['responseJSON'][0]);
            $('#btn_submitCompanyInformation').prop('disabled',false);
        });
    }

    thisRepresentativeCompanyProfile.loadRepresentativeCompanyDocuments = function(companyId)
    {
        AJAXHELPER.selectData({
            'route' : '/portal/representative/load-representative-company-documents',
            'data'  : {
                'companyId' : companyId
            }
        }, function(data){
            if($('#txt_businessType').val() == 'Corporation')
            {
                data.forEach(function(value,index){
                    if(value['document_code'] == 'Corporation-01')
                    {
                        if(value['document_status'] == '1')
                        {
                            $('#th_corporation01').html(`<center><i class="fe-disc text-warning"></i></center>`);
                        }
                        else if(value['document_status'] == '2')
                        {
                            $('#th_corporation01').html(`<center><i class="fe-check text-success"></i></center>`);
                        }

                        $('#btn_corporate01').attr('onclick',`REPRESENTATIVE_COMPANY_PROFILE.openRepresentativeCompanyDocumentModal(${value['id']},'Corporation-01','BIR Certificate of Registration (2303)');`);
                    }

                    if(value['document_code'] == 'Corporation-02')
                    {
                        if(value['document_status'] == '1')
                        {
                            $('#th_corporation02').html(`<center><i class="fe-disc text-warning"></i></center>`);
                        }
                        else if(value['document_status'] == '2')
                        {
                            $('#th_corporation02').html(`<center><i class="fe-check text-success"></i></center>`);
                        }

                        $('#btn_corporate02').attr('onclick',`REPRESENTATIVE_COMPANY_PROFILE.openRepresentativeCompanyDocumentModal(${value['id']},'Corporation-02','SEC Regitration Certificate');`);
                    }

                    if(value['document_code'] == 'Corporation-03')
                    {
                        if(value['document_status'] == '1')
                        {
                            $('#th_corporation03').html(`<center><i class="fe-disc text-warning"></i></center>`);
                        }
                        else if(value['document_status'] == '2')
                        {
                            $('#th_corporation03').html(`<center><i class="fe-check text-success"></i></center>`);
                        }

                        $('#btn_corporate03').attr('onclick',`REPRESENTATIVE_COMPANY_PROFILE.openRepresentativeCompanyDocumentModal(${value['id']},'Corporation-03','Notarized Secretary’s Certificate  (provided by GwC)');`);
                    }

                    if(value['document_code'] == 'Corporation-04')
                    {
                        if(value['document_status'] == '1')
                        {
                            $('#th_corporation04').html(`<center><i class="fe-disc text-warning"></i></center>`);
                        }
                        else if(value['document_status'] == '2')
                        {
                            $('#th_corporation04').html(`<center><i class="fe-check text-success"></i></center>`);
                        }

                        $('#btn_corporate04').attr('onclick',`REPRESENTATIVE_COMPANY_PROFILE.openRepresentativeCompanyDocumentModal(${value['id']},'Corporation-04','Articles of Incorporation');`);
                    }

                    if(value['document_code'] == 'Corporation-05')
                    {
                        if(value['document_status'] == '1')
                        {
                            $('#th_corporation05').html(`<center><i class="fe-disc text-warning"></i></center>`);
                        }
                        else if(value['document_status'] == '2')
                        {
                            $('#th_corporation05').html(`<center><i class="fe-check text-success"></i></center>`);
                        }

                        $('#btn_corporate05').attr('onclick',`REPRESENTATIVE_COMPANY_PROFILE.openRepresentativeCompanyDocumentModal(${value['id']},'Corporation-05','Most Recent General Information Sheet (GIS)');`);
                    }
                });
            }
            else if($('#txt_businessType').val() == 'Proprietorship')
            {
                data.forEach(function(value,index){
                    if(value['document_code'] == 'Proprietorship-01')
                    {
                        if(value['document_status'] == '1')
                        {
                            $('#th_proprietorship01').html(`<center><i class="fe-disc text-warning"></i></center>`);
                        }
                        else if(value['document_status'] == '2')
                        {
                            $('#th_proprietorship01').html(`<center><i class="fe-check text-success"></i></center>`);
                        }

                        $('#btn_proprietorship01').attr('onclick',`REPRESENTATIVE_COMPANY_PROFILE.openRepresentativeCompanyDocumentModal(${value['id']},'Proprietorship-01','BIR Certificate of Registration (2303)');`);
                    }
                    

                    if(value['document_code'] == 'Proprietorship-02')
                    {
                        if(value['document_status'] == '1')
                        {
                            $('#th_proprietorship02').html(`<center><i class="fe-disc text-warning"></i></center>`);
                        }
                        else if(value['document_status'] == '2')
                        {
                            $('#th_proprietorship02').html(`<center><i class="fe-check text-success"></i></center>`);
                        }

                        $('#btn_proprietorship02').attr('onclick',`REPRESENTATIVE_COMPANY_PROFILE.openRepresentativeCompanyDocumentModal(${value['id']},'Proprietorship-02','DTI Registration Document');`);
                    }
                });
            }
            else if($('#txt_businessType').val() == 'Partnership')
            {
                data.forEach(function(value,index){
                    if(value['document_code'] == 'Partnership-01')
                    {
                        if(value['document_status'] == '1')
                        {
                            $('#th_partnership01').html(`<center><i class="fe-disc text-warning"></i></center>`);
                        }
                        else if(value['document_status'] == '2')
                        {
                            $('#th_partnership01').html(`<center><i class="fe-check text-success"></i></center>`);
                        }

                        $('#btn_partnership01').attr('onclick',`REPRESENTATIVE_COMPANY_PROFILE.openRepresentativeCompanyDocumentModal(${value['id']},'Partnership-01','BIR Certificate of Registration (2303)');`);
                    }

                    if(value['document_code'] == 'Partnership-02')
                    {
                        if(value['document_status'] == '1')
                        {
                            $('#th_partnership02').html(`<center><i class="fe-disc text-warning"></i></center>`);
                        }
                        else if(value['document_status'] == '2')
                        {
                            $('#th_partnership02').html(`<center><i class="fe-check text-success"></i></center>`);
                        }

                        $('#btn_partnership02').attr('onclick',`REPRESENTATIVE_COMPANY_PROFILE.openRepresentativeCompanyDocumentModal(${value['id']},'Partnership-02','SEC Registrtion Certificate');`);
                    }

                    if(value['document_code'] == 'Partnership-03')
                    {
                        if(value['document_status'] == '1')
                        {
                            $('#th_partnership03').html(`<center><i class="fe-disc text-warning"></i></center>`);
                        }
                        else if(value['document_status'] == '2')
                        {
                            $('#th_partnership03').html(`<center><i class="fe-check text-success"></i></center>`);
                        }

                        $('#btn_partnership03').attr('onclick',`REPRESENTATIVE_COMPANY_PROFILE.openRepresentativeCompanyDocumentModal(${value['id']},'Partnership-03','Notarized Partner’s Certificate (provided by GwC)');`);
                    }

                    if(value['document_code'] == 'Partnership-04')
                    {
                        if(value['document_status'] == '1')
                        {
                            $('#th_partnership04').html(`<center><i class="fe-disc text-warning"></i></center>`);
                        }
                        else if(value['document_status'] == '2')
                        {
                            $('#th_partnership04').html(`<center><i class="fe-check text-success"></i></center>`);
                        }

                        $('#btn_partnership04').attr('onclick',`REPRESENTATIVE_COMPANY_PROFILE.openRepresentativeCompanyDocumentModal(${value['id']},'Partnership-04','Articles of Partnership');`);
                    }
                });
            }
        });
    }

    thisRepresentativeCompanyProfile.openRepresentativeCompanyDocumentModal = function(documentId = "", documentCode, documentName)
    {
        console.log(documentId);
        if(documentId == "")
        {
            $('#lbl_modalTitle').html(`${documentName}`);
            $('#txt_documentId').val(documentId);
            $('#txt_documentCode').val(documentCode);
            $('#txt_documentName').val(documentName);
            $('#modal_repCompanyDocuments').modal('show');
        }
        else
        {
            AJAXHELPER.selectData({
                'route' : '/portal/representative/select-representative-company-document',
                'data'  : {
                    'companyId' : $('#txt_companyId').val()
                }
            }, function(data){
                $('#lbl_modalTitle').html(`${documentName}`);
                $('#txt_documentId').val(documentId);
                $('#txt_documentCode').val(documentCode);
                $('#txt_documentName').val(documentName);
                $('#modal_repCompanyDocuments').modal('show');
            });
        }
    }

    thisRepresentativeCompanyProfile.openRepresentativeCompanyDocumentPreview = function(documentFile)
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
                    $('#div_documentResult').html(documentStatus);
                    $('#iframe_companyDocumentPreview').prop('src',`${e.target.result}`);
                    $('#div_documentPreview').prop('hidden',false);
                    $('#btn_submitRepCompanyDocuments').prop('disabled',false);
                }
            }
            reader.readAsDataURL(documentFile.files[0]);
        }
        else
        {
            $('#div_documentResult').html('');
            $('#div_documentPreview').prop('hidden',true);
            alert('Please select a file.');
        }
    }

    thisRepresentativeCompanyProfile.addRepresentativeCompanyDocument = function(thisForm)
    {
        let formData = new FormData(thisForm);
        formData.set('txt_companyId',$('#txt_companyId').val());
        formData.append("file_companyDocument", $('#file_companyDocument')[0].files[0]);

        $('#btn_submitRepCompanyDocuments').prop('disabled',true);

        AJAXHELPER.addData({
            'route' : 'portal/representative/add-representative-company-document',
            'data'  : formData
        }, function(data){
            COMMONHELPER.Toaster('success',data[0]);
            setTimeout(function(){
                $('#btn_submitRepCompanyDocuments').prop('disabled',false);
                window.location.replace(`${baseUrl}portal/representative/company-profile`);
            }, 1000);
        }, function(data){ // Error
            COMMONHELPER.Toaster('error',data['responseJSON'][0]);
            $('#btn_submitRepCompanyDocuments').prop('disabled',false);
        });
    }

    thisRepresentativeCompanyProfile.editRepresentativeCompanyDocument = function(thisForm)
    {
        let formData = new FormData(thisForm);
        formData.set('txt_companyId',$('#txt_companyId').val());
        formData.append("file_companyDocument", $('#file_companyDocument')[0].files[0]);

        $('#btn_submitRepCompanyDocuments').prop('disabled',true);

        AJAXHELPER.editData({
            'route' : 'portal/representative/edit-representative-company-document',
            'data'  : formData
        }, function(data){
            COMMONHELPER.Toaster('success',data[0]);
            setTimeout(function(){
                $('#btn_submitRepCompanyDocuments').prop('disabled',false);
                window.location.replace(`${baseUrl}portal/representative/company-profile`);
            }, 1000);
        }, function(data){ // Error
            COMMONHELPER.Toaster('error',data['responseJSON'][0]);
            $('#btn_submitRepCompanyDocuments').prop('disabled',false);
        });
    }



    thisRepresentativeCompanyProfile.selectRepresentativeCompanySettings = function(companyId)
    {
        AJAXHELPER.selectData({
            'route' : '/portal/representative/select-representative-company-settings',
            'data'  : {
                'companyId' : companyId
            }
        }, function(data){
            $('#txt_bankDepository').val(data['bank_depository']);
            $('#txt_branchName').val(data['branch_name']);
            $('#txt_branchCode').val(data['branch_code']);
            $('#txt_payrollPayoutDate1').val(data['payroll_payout_date1']);
            $('#txt_cutOffMinDate1').val(data['cut_off_min_date1']);
            $('#txt_cutOffMaxDate1').val(data['cut_off_max_date1']);
            $('#txt_payrollPayoutDate2').val(data['payroll_payout_date2']);
            $('#txt_cutOffMinDate2').val(data['cut_off_min_date2']);
            $('#txt_cutOffMaxDate2').val(data['cut_off_max_date2']);

            $('#rdb_hrUser').prop('checked',(data['hr_user'] == '1')? true : false);
            $('#rdb_bpoUser').prop('checked',(data['bpo_user'] == '1')? true : false);
        });
    }

    thisRepresentativeCompanyProfile.editRepresentativeCompanySettings = function(thisForm)
    {
        let formData = new FormData(thisForm);
        formData.set('txt_companyId',$('#txt_companyId').val());
        formData.set('rdb_hrUser',($('#rdb_hrUser').is(':checked'))? '1' : '');
        formData.set('rdb_bpoUser',($('#rdb_bpoUser').is(':checked'))? '1' : '');

        $('#btn_submitCompanySettings').prop('disabled',true);

        AJAXHELPER.editData({
            'route' : 'portal/representative/edit-representative-company-settings',
            'data'  : formData
        }, function(data){
            COMMONHELPER.Toaster('success',data[0]);
            setTimeout(function(){
                $('#btn_submitCompanySettings').prop('disabled',false);
                window.location.replace(`${baseUrl}portal/representative/company-profile`);
            }, 1000);
        }, function(data){ // Error
            COMMONHELPER.Toaster('error',data['responseJSON'][0]);
            $('#btn_submitCompanySettings').prop('disabled',false);
        });
    }


    thisRepresentativeCompanyProfile.r_loadCompanyRepresentatives = function(companyId)
    {
        AJAXHELPER.loadData({
            'route' : 'portal/representative/r-load-company-representatives',
            'data'  : {
                'companyId' : companyId
            }
        }, function(data){
            data.forEach(function(value,index){
                if(value['user_role'] == 'HR')
                {
                    $('#txt_hrRepresentativeId').val(value['id']);
                    $('#txt_hrFirstName').val(value['first_name']);
                    $('#txt_hrLastName').val(value['last_name']);
                    $('#txt_hrEmailAddress').val(value['email_address']);
                    $('#txt_hrPosition').val(value['position']);
                    $('#div_companyHRDocument').prop('hidden',false);
                    REPRESENTATIVE_COMPANY_PROFILE.r_loadCompanyRepresentativeIdentifications(value['id'],'HR');
                }

                if(value['user_role'] == 'BPO')
                {
                    $('#txt_bpoRepresentativeId').val(value['id']);
                    $('#txt_bpoFirstName').val(value['first_name']);
                    $('#txt_bpoLastName').val(value['last_name']);
                    $('#txt_bpoEmailAddress').val(value['email_address']);
                    $('#txt_bpoPosition').val(value['position']);
                    $('#div_companyBPODocument').prop('hidden',false);
                    REPRESENTATIVE_COMPANY_PROFILE.r_loadCompanyRepresentativeIdentifications(value['id'],'BPO');
                }
            });
        });
    }

    thisRepresentativeCompanyProfile.r_addCompanyHR = function(thisForm)
    {
        let formData = new FormData(thisForm);
        formData.set('txt_companyId',$('#txt_companyId').val());

        $('#btn_submitHrCompanyRepresentative').prop('disabled',true);

        AJAXHELPER.addData({
            'route' : 'portal/representative/r-add-company-hr',
            'data'  : formData
        }, function(data){
            COMMONHELPER.Toaster('success',data[0]);
            setTimeout(function(){
                $('#btn_submitHrCompanyRepresentative').prop('disabled',false);
                window.location.replace(`${baseUrl}portal/representative/company-profile`);
            }, 1000);
        }, function(data){ // Error
            COMMONHELPER.Toaster('error',data['responseJSON'][0]);
            $('#btn_submitHrCompanyRepresentative').prop('disabled',false);
        });
    }

    thisRepresentativeCompanyProfile.r_editCompanyHR = function(thisForm)
    {
        let formData = new FormData(thisForm);
        formData.set('txt_companyId',$('#txt_companyId').val());

        $('#btn_submitHrCompanyRepresentative').prop('disabled',true);

        AJAXHELPER.editData({
            'route' : 'portal/representative/r-edit-company-hr',
            'data'  : formData
        }, function(data){
            COMMONHELPER.Toaster('success',data[0]);
            setTimeout(function(){
                $('#btn_submitHrCompanyRepresentative').prop('disabled',false);
                window.location.replace(`${baseUrl}portal/representative/company-profile`);
            }, 1000);
        }, function(data){ // Error
            COMMONHELPER.Toaster('error',data['responseJSON'][0]);
            $('#btn_submitHrCompanyRepresentative').prop('disabled',false);
        });
    }

    thisRepresentativeCompanyProfile.r_addCompanyBPO = function(thisForm)
    {
        let formData = new FormData(thisForm);
        formData.set('txt_companyId',$('#txt_companyId').val());

        $('#btn_submitBpoCompanyRepresentative').prop('disabled',true);

        AJAXHELPER.addData({
            'route' : 'portal/representative/r-add-company-bpo',
            'data'  : formData
        }, function(data){
            COMMONHELPER.Toaster('success',data[0]);
            setTimeout(function(){
                $('#btn_submitBpoCompanyRepresentative').prop('disabled',false);
                window.location.replace(`${baseUrl}portal/representative/company-profile`);
            }, 1000);
        }, function(data){ // Error
            COMMONHELPER.Toaster('error',data['responseJSON'][0]);
            $('#btn_submitBpoCompanyRepresentative').prop('disabled',false);
        });
    }

    thisRepresentativeCompanyProfile.r_editCompanyBPO = function(thisForm)
    {
        let formData = new FormData(thisForm);
        formData.set('txt_companyId',$('#txt_companyId').val());

        $('#btn_submitBpoCompanyRepresentative').prop('disabled',true);

        AJAXHELPER.editData({
            'route' : 'portal/representative/r-edit-company-bpo',
            'data'  : formData
        }, function(data){
            COMMONHELPER.Toaster('success',data[0]);
            setTimeout(function(){
                $('#btn_submitBpoCompanyRepresentative').prop('disabled',false);
                window.location.replace(`${baseUrl}portal/representative/company-profile`);
            }, 1000);
        }, function(data){ // Error
            COMMONHELPER.Toaster('error',data['responseJSON'][0]);
            $('#btn_submitBpoCompanyRepresentative').prop('disabled',false);
        });
    }






    thisRepresentativeCompanyProfile.r_loadCompanyRepresentativeIdentifications = function(employeeId, category)
    {
        AJAXHELPER.loadData({
            'route' : 'portal/representative/r-load-company-representative-identifications',
            'data'  : {
                'employeeId' : employeeId,
                'category'   : category
            }
        }, function(data){

            let hrCompanyId = `REPRESENTATIVE_COMPANY_PROFILE.r_openCompanyRepresentativeIdentificationModal('',${employeeId},'Company ID','HR');`;
            let hrGovernmentId = `REPRESENTATIVE_COMPANY_PROFILE.r_openCompanyRepresentativeIdentificationModal('',${employeeId},'Government ID','HR');`;

            let bpoCompanyId = `REPRESENTATIVE_COMPANY_PROFILE.r_openCompanyRepresentativeIdentificationModal('',${employeeId},'Company ID','BPO');`;
            let bpoGovernmentId = `REPRESENTATIVE_COMPANY_PROFILE.r_openCompanyRepresentativeIdentificationModal('',${employeeId},'Government ID','BPO');`;

            data.forEach(function(value,index){
                if(value['category'] == 'HR')
                {
                    if(value['type'] == 'Company ID')
                    {
                        hrCompanyId = `REPRESENTATIVE_COMPANY_PROFILE.r_openCompanyRepresentativeIdentificationModal(${value['id']},${employeeId},'Company ID','HR');`;
                    }

                    if(value['type'] == 'Government ID')
                    {
                        hrGovernmentId = `REPRESENTATIVE_COMPANY_PROFILE.r_openCompanyRepresentativeIdentificationModal(${value['id']},${employeeId},'Government ID','HR');`;
                    }
                }

                if(value['category'] == 'BPO')
                {
                    if(value['type'] == 'Company ID')
                    {
                        bpoCompanyId = `REPRESENTATIVE_COMPANY_PROFILE.r_openCompanyRepresentativeIdentificationModal(${value['id']},${employeeId},'Company ID','BPO');`;
                    }

                    if(value['type'] == 'Government ID')
                    {
                        bpoGovernmentId = `REPRESENTATIVE_COMPANY_PROFILE.r_openCompanyRepresentativeIdentificationModal(${value['id']},${employeeId},'Government ID','BPO');`;
                    }
                }
            });

            $('#btn_hrCompanyId').attr('onclick',`${hrCompanyId}`);
            $('#btn_hrGovernmentId').attr('onclick',`${hrGovernmentId}`);

            $('#btn_bpoCompanyId').attr('onclick',`${bpoCompanyId}`);
            $('#btn_bpoGovernmentId').attr('onclick',`${bpoGovernmentId}`);
        });
    }

    thisRepresentativeCompanyProfile.r_openCompanyRepresentativeIdentificationModal = function(identificationId, employeeId, identificationType, identificationCategory)
    {
        AJAXHELPER.selectData({
            'route' : '/portal/representative/r-select-representative-identification',
            'data'  : {
                'identificationId' : identificationId
            }
        }, function(data){
            $('#txt_identificationId').val(identificationId);
            $('#txt_employeeId').val(employeeId);
            $('#txt_identificationType').val(identificationType);
            $('#txt_identificationCategory').val(identificationCategory);
            $('#div_identificationPreview').prop('hidden',(identificationId == "")? true : false);
            if(data != null)
            {
                $('#iframe_identificationDocumentPreview').prop('src',`${baseUrl}/public/assets/uploads/representative/identifications/${data['id_picture']}`);
            }
            $('#modal_repIdentificationDocuments').modal('show');
        });
    }

    thisRepresentativeCompanyProfile.r_openCompanyRepresentativeIdentificationPreview = function(documentFile)
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
                    $('#div_identificationResult').html(documentStatus);
                    $('#iframe_identificationDocumentPreview').prop('src',`${e.target.result}`);
                    $('#div_identificationPreview').prop('hidden',false);
                    $('#btn_submitRepIdentificationDocuments').prop('disabled',false);
                }
            }
            reader.readAsDataURL(documentFile.files[0]);
        }
        else
        {
            $('#div_identificationResult').html('');
            $('#div_identificationPreview').prop('hidden',true);
            alert('Please select a file.');
        }
    }

    thisRepresentativeCompanyProfile.r_addCompanyRepresentativeIdentification = function(thisForm)
    {
        let formData = new FormData(thisForm);
        formData.append("file_identificationDocument", $('#file_identificationDocument')[0].files[0]);

        $('#btn_submitRepIdentificationDocuments').prop('disabled',true);

        AJAXHELPER.addData({
            'route' : 'portal/representative/r-add-representative-identification',
            'data'  : formData
        }, function(data){
            COMMONHELPER.Toaster('success',data[0]);
            setTimeout(function(){
                $('#btn_submitRepIdentificationDocuments').prop('disabled',false);
                window.location.replace(`${baseUrl}portal/representative/company-profile`);
            }, 1000);
        }, function(data){ // Error
            COMMONHELPER.Toaster('error',data['responseJSON'][0]);
            $('#btn_submitRepIdentificationDocuments').prop('disabled',false);
        });
    }

    thisRepresentativeCompanyProfile.r_editCompanyRepresentativeIdentification = function(thisForm)
    {
        let formData = new FormData(thisForm);
        formData.append("file_identificationDocument", $('#file_identificationDocument')[0].files[0]);

        $('#btn_submitRepIdentificationDocuments').prop('disabled',true);

        AJAXHELPER.editData({
            'route' : 'portal/representative/r-edit-representative-identification',
            'data'  : formData
        }, function(data){
            COMMONHELPER.Toaster('success',data[0]);
            setTimeout(function(){
                $('#btn_submitRepIdentificationDocuments').prop('disabled',false);
                window.location.replace(`${baseUrl}portal/representative/company-profile`);
            }, 1000);
        }, function(data){ // Error
            COMMONHELPER.Toaster('error',data['responseJSON'][0]);
            $('#btn_submitRepIdentificationDocuments').prop('disabled',false);
        });
    }

    return thisRepresentativeCompanyProfile;

})();