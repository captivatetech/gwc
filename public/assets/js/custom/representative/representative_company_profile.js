
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

    return thisRepresentativeCompanyProfile;

})();