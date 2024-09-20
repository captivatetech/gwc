
const ADMIN_BILLINGS = (function(){

    let thisAdminBillings = {};

    let baseUrl = $('#txt_baseUrl').val();

    thisAdminBillings.a_loadBillings = function()
    {
        AJAXHELPER.getData({
            // BillingController->a_loadBillings
            'route' : 'portal/admin/a-load-billings',
            'data'  : null
        }, function(data){
            let tbody = '';
            data.forEach(function(value,index){
                tbody += `<tr>
                            <td>${value['billing_date']}</td>
                            <td>${value['billing_number']}</td>
                            <td>${value['company_name']}</td>
                            <td style="text-align:right;">Php.${COMMONHELPER.numberWithCommas(value['total_amount'])}</td>
                            <td style="text-align:right;">Php. ${COMMONHELPER.numberWithCommas(value['total_paid'])}</td>
                            <td style="text-align:right;">Php. ${COMMONHELPER.numberWithCommas(value['balance'])}</td>
                            <td>${value['due_date']}</td>
                            <td>${value['payment_status']}</td>
                            <td>
                                <a href="javascript:void(0)" onclick="ADMIN_BILLINGS.a_loadBillingDetails(${value['id']})">View</a>
                            </td>
                        </tr>`;
            });
            $('#tbl_billings').DataTable().destroy();
            $('#tbl_billings tbody').html(tbody);
            $('#tbl_billings').DataTable({'scrollX':true, "order": [[ 0, "desc" ]]});
        });
    }

    thisAdminBillings.a_loadBillingDetails = function(billingId)
    {
        $('#modal_billingDetails').modal('show');
        AJAXHELPER.getData({
            // BillingController->a_loadBillingDetails
            'route' : 'portal/admin/a-load-billing-details',
            'data'  : {
                'billingId' : billingId
            }
        }, function(data){
            $('#txt_billingNumber').val(data['arrBillingDetails']['billing_number']);
            $('#txt_companyName').val(data['arrBillingDetails']['company_name']);
            $('#txt_companyCode').val(data['arrBillingDetails']['company_code']);
            $('#txt_billingDate').val(data['arrBillingDetails']['billing_date']);
            $('#txt_billingAmount').val(COMMONHELPER.numberWithCommas(data['arrBillingDetails']['total_amount']));
            $('#txt_paidAmount').val(COMMONHELPER.numberWithCommas(data['arrBillingDetails']['total_paid']));
            $('#txt_balance').val(COMMONHELPER.numberWithCommas(data['arrBillingDetails']['balance']));
            $('#txt_dueDate').val(data['arrBillingDetails']['due_date']);

            let tbody = '';
            data['arrBillingList'].forEach(function(value,index){
                tbody += `<tr>
                            <td>${value['account_number']}</td>
                            <td>${value['disbursement_date']}</td>
                            <td>${value['first_name']} ${value['last_name']}</td>
                            <td style="text-align:right;">Php.${COMMONHELPER.numberWithCommas(value['loan_amount'])}</td>
                            <td style="text-align:right;">Php. ${COMMONHELPER.numberWithCommas(value['billing_amount'])}</td>
                            <td>${value['payment_terms']} months</td>
                            <td>${value['billing_series']} of ${value['payment_terms']}</td>
                        </tr>`;
            });
            $('#tbl_billingDetails').DataTable().destroy();
            $('#tbl_billingDetails tbody').html(tbody);
            $('#tbl_billingDetails').DataTable({'scrollX':true, "order": [[ 0, "desc" ]]});
        });
    }

    return thisAdminBillings;

})();