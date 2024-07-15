
const REPRESENTATIVE_FINANCING_PRODUCTS = (function(){

    let thisRepresentativeFinancingProducts = {};

    let baseUrl = $('#txt_baseUrl').val();

    thisRepresentativeFinancingProducts.r_selectCompanyInformation = function(companyId)
    {
        AJAXHELPER.selectData({
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
        AJAXHELPER.selectData({
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
        AJAXHELPER.loadData({
            // CompanyController->r_loadCompanyDocuments
            'route' : '/portal/representative/r-load-company-documents',
            'data'  : {
                'companyId' : companyId
            }
        }, function(data){
            let tbody = '';
            data.forEach(function(value,key){
                if(value['document_code'].search($('#txt_businessType').val()) >= 0)
                {
                    tbody += `<tr>
                                <th scope="row" width="10%" id="th_proprietorship02">
                                    <center>
                                        <i class="fe-disc text-danger"></i>
                                    </center>
                                </th>
                                <td>${value['document_name']}</td>
                                <td width="10%">
                                    <center>
                                        <a href="javascript:void(0)" onclick="REPRESENTATIVE_FINANCING_PRODUCTS.r_openCompanyDocumentPreview(${value['id']});">
                                            Preview
                                        </a>
                                    </center>
                                </td>
                            </tr>`;
                }
            });
            $('#tbl_companyDocuments tbody').html(tbody);
        });
    }

    thisRepresentativeFinancingProducts.r_openCompanyDocumentPreview = function(documentId)
    {
        AJAXHELPER.selectData({
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

        AJAXHELPER.addData({
            // ProductSubscriptionController->r_addProductSubscription();
            'route' : 'portal/representative/r-add-product-subscription',
            'data'  : formData
        }, function(data){
            COMMONHELPER.Toaster('success',data[0]);
            setTimeout(function(){
                $('#btn_submitFinancingProduct').prop('disabled',false);
                window.location.replace(`${baseUrl}portal/representative/financing-products`);
            }, 1000);
        }, function(data){ // Error
            COMMONHELPER.Toaster('error',data['responseJSON'][0]);
            $('#btn_submitFinancingProduct').prop('disabled',false);
        });
    }

    return thisRepresentativeFinancingProducts;

})();