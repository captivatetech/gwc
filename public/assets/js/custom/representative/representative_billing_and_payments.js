
const REPRESENTATIVE_BILLING_AND_PAYMENTS = (function(){

    let thisRepresentativeBillingAndPayments = {};

    let baseUrl = $('#txt_baseUrl').val();

    thisRepresentativeBillingAndPayments.r_loadBillings = function()
    {
        AJAXHELPER.selectData({
            'route' : 'portal/representative/r-load-billings',
            'data'  : {
                'sample' : 'sample'
            }
        }, function(data){
            let tbody = '';
            data.forEach(function(value,index){
                tbody += `<tr>
                            <td>${value['billing_date']}</td>
                            <td>${value['billing_number']}</td>
                            <td style="text-align:right;">Php.${COMMONHELPER.numberWithCommas(value['total_amount'])}</td>
                            <td style="text-align:right;">Php. ${COMMONHELPER.numberWithCommas(value['total_paid'])}</td>
                            <td style="text-align:right;">Php. ${COMMONHELPER.numberWithCommas(value['balance'])}</td>
                            <td>${value['due_date']}</td>
                            <td>${value['payment_status']}</td>
                            <td>
                                <a href="javascript:void(0)" onclick="REPRESENTATIVE_BILLING_AND_PAYMENTS.r_selectBilling(${value['id']})">Update Payment</a>
                            </td>
                        </tr>`;
            });
            $('#tbl_billings').DataTable().destroy();
            $('#tbl_billings tbody').html(tbody);
            $('#tbl_billings').DataTable({'scrollX':true, "order": [[ 0, "desc" ]]});
        });
    }

    thisRepresentativeBillingAndPayments.r_selectBilling = function(billingId)
    {
        $('#modal_billingDetails').modal('show');

        AJAXHELPER.loadData({
            // BillingController->r_selectBilling
            'route' : 'portal/representative/r-select-billing',
            'data'  : {
                'billingId' : billingId
            }
        }, function(data){
            $('#txt_billingId').val(data['arrBillingDetails']['id']);
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
                            <td>
                                <input type="checkbox" class="chk-billing" onchange="REPRESENTATIVE_BILLING_AND_PAYMENTS.r_unselectBilling()" value="${value['id']}">
                            </td>
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

    thisRepresentativeBillingAndPayments.r_unselectBilling = function()
    {
        let ids = $("#tbl_billingDetails tbody input:checkbox:checked").map(function () {
            return $(this).val();
        }).get();

        let trCount = 0;
        $("#tbl_billingDetails tbody tr").map(function () {
            trCount++;
        });

        if(trCount >= $('#tbl_billingDetails_length select').val())
        {
            if(ids.length == $('#tbl_billingDetails_length select').val())
            {
                $('#chk_selectAllBilling').prop('checked',true);
            }
            else
            {
                $('#chk_selectAllBilling').prop('checked',false);
            }
        }
        else
        {   
            if(trCount == ids.length)
            {
                $('#chk_selectAllBilling').prop('checked',true);
            }
            else
            {
                $('#chk_selectAllBilling').prop('checked',false);
            }
        }
        

        if(ids.length == 0)
        {
            $('#btn_submitPayment').prop('disabled',true);
        }
        else
        {
            $('#btn_submitPayment').prop('disabled',false);
        }

        let totalBillingAmount = 0;
        $("#tbl_billingDetails tbody input:checkbox:checked").map(function(){
            let amountStr = $(this).parents('tr').find('td:eq(5)').text();
            totalBillingAmount += parseFloat(amountStr.substring(5).replace(",",""));
        });

        // let totalBilling = totalBillingAmount;

        let billingAmount = parseFloat(($('#txt_billingAmount').val()).replace(',',''));

        let balance = billingAmount - totalBillingAmount;

        $('#txt_paymentAmount').val(COMMONHELPER.numberWithCommas(totalBillingAmount.toFixed(2)));
        $('#txt_balance').val(COMMONHELPER.numberWithCommas(balance.toFixed(2)));
        $('#lbl_billingTotalAmount').text(COMMONHELPER.numberWithCommas(totalBillingAmount.toFixed(2)));
    }

    thisRepresentativeBillingAndPayments.r_submitPayment = function(thisForm)
    {
        alert('In-progress');
        // let formData = new FormData(thisForm);

        // let arrBillingIds = $("#tbl_billingDetails tbody input:checkbox:checked").map(function () {
        //     return $(this).val();
        // }).get();
        // formData.set("arrBillingIds", arrBillingIds);
        // formData.append("referenceNumber", $('#file_paymentReferenceNumber')[0].files[0]);

        // $('#btn_submitPayment').prop('disabled',true);

        // AJAXHELPER.addData({
        //     // LoanController->r_submitPayment
        //     'route' : 'portal/representative/r-submit-payment',
        //     'data'  : formData
        // }, function(data){
        //     setTimeout(function(){
        //         COMMONHELPER.Toaster('success','Loan Disbursement Complete!');
        //         $('#btn_submitPayment').prop('disabled',false);
        //         $('#modal_billingDetails').modal('hide');
        //         window.location.replace(`${baseUrl}portal/representative/billing-and-payments`);
        //     }, 2000);
        // }, function(data){ // Error
        //     COMMONHELPER.Toaster('error',data['responseJSON'][0]);
        //     $('#btn_submitPayment').prop('disabled',true);
        // });
    }

    return thisRepresentativeBillingAndPayments;

})();