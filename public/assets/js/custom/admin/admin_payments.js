
const ADMIN_PAYMENTS = (function(){

    let thisAdminPayments = {};

    let baseUrl = $('#txt_baseUrl').val();

    thisAdminPayments.a_loadPayments = function()
    {
        AJAXHELPER.loadData({
            // PaymentController->a_loadPayments
            'route' : 'portal/admin/a-load-payments',
            'data'  : {
                'sample' : 'sample'
            }
        }, function(data){

            let tbody = '';
            data.forEach(function(value,index){

                let paymentStatus = '';
                if(value['payment_status'] == 'Pending')
                {
                    paymentStatus = `<span class="text-warning">${value['payment_status']}</span>`;
                }
                else
                {
                    paymentStatus = `<span class="text-success">${value['payment_status']}</span>`;
                }

                tbody += `<tr>
                            <td>${value['payment_date']}</td>
                            <td>${value['payment_number']}</td>
                            <td>${value['company_name']}</td>
                            <td>${value['billing_number']}</td>
                            <td style="text-align:right;">Php. ${COMMONHELPER.numberWithCommas(value['payment_amount'])}</td>
                            <td>${paymentStatus}</td>
                            <td>${(value['confirmation_date'] == null)? "---" : value['confirmation_date']}</td>
                            <td>
                                <a href="javascript:void(0)" onclick="ADMIN_PAYMENTS.a_selectPayment(${value['id']})">Confirm Payment</a>
                            </td>
                        </tr>`;
            });
            $('#tbl_payments').DataTable().destroy();
            $('#tbl_payments tbody').html(tbody);
            $('#tbl_payments').DataTable({'scrollX':true, "order": [[ 0, "desc" ]]});
        });
    }

    thisAdminPayments.a_selectPayment= function(paymentId)
    {
        $('#modal_paymentValidation').modal('show');

        AJAXHELPER.loadData({
            // PaymentController->a_selectPayment
            'route' : 'portal/admin/a-select-payment',
            'data'  : {
                'paymentId' : paymentId
            }
        }, function(data){

            $('#txt_paymentId').val(paymentId);
            $('#txt_companyId').val(data['company_id']);

            $('#txt_companyName').val(data['company_name']);
            $('#txt_productType').val(data['product_name']);
            $('#txt_billingNumber').val(data['billing_number']);
            $('#txt_billingAmount').val(COMMONHELPER.numberWithCommas(data['billing_amount']));
            $('#txt_dueDate').val(data['due_date']);
            $('#txt_paymentDate').val(data['payment_date']);
            $('#txt_amountPaid').val(COMMONHELPER.numberWithCommas(data['payment_amount']));
            $('#txt_paymentMethod').val(data['payment_type']);
            $('#txt_referenceNumber').val(data['reference_number']);

        });
    }

    thisAdminPayments.a_confirmPayment = function(thisForm)
    {
        if(confirm('Please Confirm!'))
        {
            let formData = new FormData(thisForm);
            $('#btn_submitPaymentValidation').prop('disabled',true);
            AJAXHELPER.addData({
                // LoanController->a_confirmPayment
                'route' : 'portal/admin/a-confirm-payment',
                'data'  : formData
            }, function(data){
                COMMONHELPER.Toaster('success','Payment Confirmed!');
                setTimeout(function(){
                    $('#btn_submitPaymentValidation').prop('disabled',false);
                    $('#modal_paymentValidation').modal('hide');
                    window.location.replace(`${baseUrl}portal/admin/payments`);
                }, 2000);
            }, function(data){ // Error
                COMMONHELPER.Toaster('error',data['responseJSON'][0]);
                $('#btn_submitPaymentValidation').prop('disabled',true);
            });
        }
    }

    return thisAdminPayments;

})();