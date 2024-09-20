
const REPRESENTATIVE_FINANCING_PRODUCTS = (function(){

    let thisRepresentativeFinancingProducts = {};

    let baseUrl = $('#txt_baseUrl').val();

    thisRepresentativeFinancingProducts.r_selectCompanyInformation = function(companyId)
    {
        AJAXHELPER.getData({
            // CompanyController->r_selectCompanyInformation()
            'route' : '/portal/representative/r-select-company-information',
            'data'  : {
                'companyId' : companyId
            }
        }, function(data){
            $('#lbl_businessName').html(data['company_name']);
            $('#lbl_businessAddress').html(data['company_address']);
            $('#lbl_industry').html(data['business_industry']);
            $('#lbl_contactNumbers').html(`${data['mobile_number']} / ${data['telephone_number']}`);
            $('#lbl_companyEmail').html(data['company_email']);
            $('#lbl_companyWebsite').html(data['company_website']);
            $('#lbl_companyCode').html(data['company_code']);
        });
    }

    thisRepresentativeFinancingProducts.r_selectProductInformation = function(productCode)
    {
        AJAXHELPER.getData({
            // ProductController->r_selectFinancingProduct
            'route' : '/portal/representative/r-select-financing-product',
            'data'  : {
                'productCode' : productCode
            }
        }, function(data){
            $('#txt_productId').val(data['id']);
            $('#lbl_productName').html(data['product_name']);
            $('#lbl_description').html(data['product_description']);
        });
    }

    thisRepresentativeFinancingProducts.r_loadCompanyDocuments = function(companyId)
    {
        AJAXHELPER.getData({
            // CompanyController->r_loadCompanyDocuments
            'route' : '/portal/representative/r-load-company-documents',
            'data'  : {
                'companyId' : companyId,
                'businessType' : $('#txt_businessType').val()
            }
        }, function(data){
            if($('#txt_businessType').val() == 'Corporation')
            {
                let arrCorporation = [0,0,0,0,0];
                data.forEach(function(value,key){

                    let documentStatus = "";
                    let documentAction = "";

                    if(value['document_code'] == 'Corporation-01')
                    {
                        arrCorporation[0] = 1;
                        if(value['document_status'] == 1)
                        {
                            documentStatus = `<center><i class="fe-disc text-warning"></i></center>`;
                        }
                        else if(value['document_status'] == 2)
                        {
                            documentStatus = `<center><i class="fe-check text-success"></i></center>`;
                        }
                        $('#tr_corporation01 td:eq(0)').html(documentStatus);

                        documentAction = `<a href="javascript:void(0)" onclick="REPRESENTATIVE_FINANCING_PRODUCTS.r_openCompanyDocumentPreview(${value['id']});">
                                        Preview
                                    </a>`;
                        $('#tr_corporation01 td:eq(2)').html(documentAction);
                    }

                    if(value['document_code'] == 'Corporation-02')
                    {
                        arrCorporation[1] = 1;
                        if(value['document_status'] == 1)
                        {
                            documentStatus = `<center><i class="fe-disc text-warning"></i></center>`;
                        }
                        else if(value['document_status'] == 2)
                        {
                            documentStatus = `<center><i class="fe-check text-success"></i></center>`;
                        }
                        $('#tr_corporation02 td:eq(0)').html(documentStatus);

                        documentAction = `<a href="javascript:void(0)" onclick="REPRESENTATIVE_FINANCING_PRODUCTS.r_openCompanyDocumentPreview(${value['id']});">
                                        Preview
                                    </a>`;
                        $('#tr_corporation02 td:eq(2)').html(documentAction);
                    }

                    if(value['document_code'] == 'Corporation-03')
                    {
                        arrCorporation[2] = 1;
                        if(value['document_status'] == 1)
                        {
                            documentStatus = `<center><i class="fe-disc text-warning"></i></center>`;
                        }
                        else if(value['document_status'] == 2)
                        {
                            documentStatus = `<center><i class="fe-check text-success"></i></center>`;
                        }
                        $('#tr_corporation03 td:eq(0)').html(documentStatus);

                        documentAction = `<a href="javascript:void(0)" onclick="REPRESENTATIVE_FINANCING_PRODUCTS.r_openCompanyDocumentPreview(${value['id']});">
                                        Preview
                                    </a>`;
                        $('#tr_corporation03 td:eq(2)').html(documentAction);
                    }

                    if(value['document_code'] == 'Corporation-04')
                    {
                        arrCorporation[3] = 1;
                        if(value['document_status'] == 1)
                        {
                            documentStatus = `<center><i class="fe-disc text-warning"></i></center>`;
                        }
                        else if(value['document_status'] == 2)
                        {
                            documentStatus = `<center><i class="fe-check text-success"></i></center>`;
                        }
                        $('#tr_corporation04 td:eq(0)').html(documentStatus);

                        documentAction = `<a href="javascript:void(0)" onclick="REPRESENTATIVE_FINANCING_PRODUCTS.r_openCompanyDocumentPreview(${value['id']});">
                                        Preview
                                    </a>`;
                        $('#tr_corporation04 td:eq(2)').html(documentAction);
                    }

                    if(value['document_code'] == 'Corporation-05')
                    {
                        arrCorporation[4] = 1;
                        if(value['document_status'] == 1)
                        {
                            documentStatus = `<center><i class="fe-disc text-warning"></i></center>`;
                        }
                        else if(value['document_status'] == 2)
                        {
                            documentStatus = `<center><i class="fe-check text-success"></i></center>`;
                        }
                        $('#tr_corporation05 td:eq(0)').html(documentStatus);

                        documentAction = `<a href="javascript:void(0)" onclick="REPRESENTATIVE_FINANCING_PRODUCTS.r_openCompanyDocumentPreview(${value['id']});">
                                        Preview
                                    </a>`;
                        $('#tr_corporation05 td:eq(2)').html(documentAction);
                    }
                });
                $('#tbl_companyCorporationDocuments').prop('hidden',false);
                $('#tbl_companyProprietorShipDocuments').prop('hidden',true);
                $('#tbl_companyPartnershipDocuments').prop('hidden',true);

                if(arrCorporation.includes(0))
                {
                    $('#btn_submitFinancingProduct').prop('disabled',true);
                }
                else
                {
                    $('#btn_submitFinancingProduct').prop('disabled',false);
                }
            }
            else if($('#txt_businessType').val() == 'Proprietorship')
            {
                let arrProprietorship = [0,0];
                data.forEach(function(value,key){

                    let documentStatus = "";
                    let documentAction = "";

                    if(value['document_code'] == 'Proprietorship-01')
                    {
                        arrProprietorship[0] = 1;
                        if(value['document_status'] == 1)
                        {
                            documentStatus = `<center><i class="fe-disc text-warning"></i></center>`;
                        }
                        else if(value['document_status'] == 2)
                        {
                            documentStatus = `<center><i class="fe-check text-success"></i></center>`;
                        }
                        $('#tr_proprietorship01 td:eq(0)').html(documentStatus);

                        documentAction = `<a href="javascript:void(0)" onclick="REPRESENTATIVE_FINANCING_PRODUCTS.r_openCompanyDocumentPreview(${value['id']});">
                                        Preview
                                    </a>`;
                        $('#tr_proprietorship01 td:eq(2)').html(documentAction);
                    }

                    if(value['document_code'] == 'Proprietorship-02')
                    {
                        arrProprietorship[1] = 1;
                        if(value['document_status'] == 1)
                        {
                            documentStatus = `<center><i class="fe-disc text-warning"></i></center>`;
                        }
                        else if(value['document_status'] == 2)
                        {
                            documentStatus = `<center><i class="fe-check text-success"></i></center>`;
                        }
                        $('#tr_proprietorship02 td:eq(0)').html(documentStatus);

                        documentAction = `<a href="javascript:void(0)" onclick="REPRESENTATIVE_FINANCING_PRODUCTS.r_openCompanyDocumentPreview(${value['id']});">
                                        Preview
                                    </a>`;
                        $('#tr_proprietorship02 td:eq(2)').html(documentAction);
                    }
                });
                $('#tbl_companyCorporationDocuments').prop('hidden',true);
                $('#tbl_companyProprietorShipDocuments').prop('hidden',false);
                $('#tbl_companyPartnershipDocuments').prop('hidden',true);

                if(arrProprietorship.includes(0))
                {
                    $('#btn_submitFinancingProduct').prop('disabled',true);
                }
                else
                {
                    $('#btn_submitFinancingProduct').prop('disabled',false);
                }
            }
            else if($('#txt_businessType').val() == 'Partnership')
            {   
                let arrPartnership = [0,0,0,0];
                data.forEach(function(value,key){

                    let documentStatus = "";
                    let documentAction = "";

                    if(value['document_code'] == 'Partnership-01')
                    {
                        arrPartnership[0] = 1;
                        if(value['document_status'] == 1)
                        {
                            documentStatus = `<center><i class="fe-disc text-warning"></i></center>`;
                        }
                        else if(value['document_status'] == 2)
                        {
                            documentStatus = `<center><i class="fe-check text-success"></i></center>`;
                        }
                        $('#tr_partnership01 td:eq(0)').html(documentStatus);

                        documentAction = `<a href="javascript:void(0)" onclick="REPRESENTATIVE_FINANCING_PRODUCTS.r_openCompanyDocumentPreview(${value['id']});">
                                        Preview
                                    </a>`;
                        $('#tr_partnership01 td:eq(2)').html(documentAction);
                    }

                    if(value['document_code'] == 'Partnership-02')
                    {
                        arrPartnership[1] = 1;
                        if(value['document_status'] == 1)
                        {
                            documentStatus = `<center><i class="fe-disc text-warning"></i></center>`;
                        }
                        else if(value['document_status'] == 2)
                        {
                            documentStatus = `<center><i class="fe-check text-success"></i></center>`;
                        }
                        $('#tr_partnership02 td:eq(0)').html(documentStatus);

                        documentAction = `<a href="javascript:void(0)" onclick="REPRESENTATIVE_FINANCING_PRODUCTS.r_openCompanyDocumentPreview(${value['id']});">
                                        Preview
                                    </a>`;
                        $('#tr_partnership02 td:eq(2)').html(documentAction);
                    }

                    if(value['document_code'] == 'Partnership-03')
                    {
                        arrPartnership[2] = 1;
                        if(value['document_status'] == 1)
                        {
                            documentStatus = `<center><i class="fe-disc text-warning"></i></center>`;
                        }
                        else if(value['document_status'] == 2)
                        {
                            documentStatus = `<center><i class="fe-check text-success"></i></center>`;
                        }
                        $('#tr_partnership03 td:eq(0)').html(documentStatus);

                        documentAction = `<a href="javascript:void(0)" onclick="REPRESENTATIVE_FINANCING_PRODUCTS.r_openCompanyDocumentPreview(${value['id']});">
                                        Preview
                                    </a>`;
                        $('#tr_partnership03 td:eq(2)').html(documentAction);
                    }

                    if(value['document_code'] == 'Partnership-04')
                    {
                        arrPartnership[3] = 1;
                        if(value['document_status'] == 1)
                        {
                            documentStatus = `<center><i class="fe-disc text-warning"></i></center>`;
                        }
                        else if(value['document_status'] == 2)
                        {
                            documentStatus = `<center><i class="fe-check text-success"></i></center>`;
                        }
                        $('#tr_partnership04 td:eq(0)').html(documentStatus);

                        documentAction = `<a href="javascript:void(0)" onclick="REPRESENTATIVE_FINANCING_PRODUCTS.r_openCompanyDocumentPreview(${value['id']});">
                                        Preview
                                    </a>`;
                        $('#tr_partnership04 td:eq(2)').html(documentAction);
                    }
                });
                $('#tbl_companyCorporationDocuments').prop('hidden',true);
                $('#tbl_companyProprietorShipDocuments').prop('hidden',true);
                $('#tbl_companyPartnershipDocuments').prop('hidden',false);

                if(arrPartnership.includes(0))
                {
                    $('#btn_submitFinancingProduct').prop('disabled',true);
                }
                else
                {
                    $('#btn_submitFinancingProduct').prop('disabled',false);
                }
            }
        });
    }

    thisRepresentativeFinancingProducts.r_openCompanyDocumentPreview = function(documentId)
    {
        AJAXHELPER.getData({
            // CompanyController->r_selectCompanyDocument
            'route' : '/portal/representative/r-select-company-document',
            'data'  : {
                'documentId' : documentId
            }
        }, function(data){
            $('#lbl_modalTitle').text(data['document_name']);
            $('#iframe_companyDocumentPreview').prop('src',`${baseUrl}/public/assets/uploads/company/documents/${data['document_file']}`);
            $('#modal_companyDocumentPreview').modal('show');
        });
    }

    thisRepresentativeFinancingProducts.addFinancingProduct = function(thisForm)
    {
        let formData = new FormData(thisForm);
        formData.set('txt_companyId',$('#txt_companyId').val());

        $('#btn_submitFinancingProduct').prop('disabled',true);
        AJAXHELPER.postData({
            // ProductSubscriptionController->r_addProductSubscription();
            'route' : 'portal/representative/r-add-product-subscription',
            'data'  : formData
        }, function(data){
            COMMONHELPER.Toaster('success',data[0]);
            setTimeout(function(){
                $('#btn_submitFinancingProduct').prop('disabled',false);
                window.location.replace(`${baseUrl}portal/representative/financing-products`);
            }, 1000);
        }, function(data){
            COMMONHELPER.Toaster('error',data['responseJSON'][0]);
            $('#btn_submitFinancingProduct').prop('disabled',false);
        });
    }

    return thisRepresentativeFinancingProducts;

})();