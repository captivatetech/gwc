
const ADMIN_PAYMENTS = (function(){

    let thisAdminPayments = {};

    let baseUrl = $('#txt_baseUrl').val();

    thisAdminPayments.a_loadPayments = function()
    {
        AJAXHELPER.getData({
            // PaymentController->a_loadPayments
            'route' : 'portal/admin/a-load-payments',
            'data'  : null
        }, function(data){
            let tbody = '';
            data.forEach(function(value,index){
                let paymentStatus = '';
                if(value['payment_status'] == 'PENDING')
                {
                    paymentStatus = `<span class="text-warning">${value['payment_status']}</span>`;
                }
                else if(value['payment_status'] == 'CONFIRM')
                {
                    paymentStatus = `<span class="text-success">${value['payment_status']}</span>`;
                }
                else
                {
                    paymentStatus = `<span class="text-danger">${value['payment_status']}</span>`;
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
        AJAXHELPER.getData({
            // PaymentController->a_selectPayment
            'route' : 'portal/admin/a-select-payment',
            'data'  : {
                'paymentId' : paymentId
            }
        }, function(data){
            $('#txt_billingId').val(data['billing_id']);
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

            let proofOfPaymentLink = '';
            if(data['payment_type'] == "Online-Payment")
            {
                proofOfPaymentLink = `<a href="${data['proof_of_payment']}" target="_blank">${data['proof_of_payment']}</a>`;
                $('#div_proofOfPayment').html(proofOfPaymentLink);
            }
            else
            {
                proofOfPaymentLink = `<a href="${baseUrl}public/assets/uploads/representative/payments/${data['proof_of_payment']}" target="_blank">${baseUrl}public/assets/uploads/representative/payments/${data['proof_of_payment']}</a>`;
                $('#div_proofOfPayment').html(proofOfPaymentLink);
            }
        });
    }

    thisAdminPayments.a_confirmPayment = function(thisForm)
    {
        if(confirm('Please Confirm!'))
        {
            let formData = new FormData(thisForm);
            $('#btn_submitPaymentValidation').prop('disabled',true);
            AJAXHELPER.postData({
                // LoanController->a_confirmPayment
                'route' : 'portal/admin/a-confirm-payment',
                'data'  : formData
            }, function(data){
                if(data[0] == 'Confirm-Payment')
                {
                    COMMONHELPER.Toaster('success','Payment Confirmed!');
                    $('#btn_submitPaymentValidation').prop('disabled',false);
                    $('#modal_paymentValidation').modal('hide');
                    setTimeout(function(){
                        $('#modal_sendEmailToEmployees').modal('show');
                        let currentIndex = parseInt(data[1].length);
                        let progress = 100 / parseInt(data[1].length);
                        let progressRem = 100 % parseInt(data[1].length);
                        let totalProgress = 0;
                        let count = 0;
                        let sentCount = 0;
                        ADMIN_PAYMENTS.a_sendEmailToEmployees(currentIndex, progress, progressRem, totalProgress, count, sentCount, data[1]);
                    }, 1000);
                }
                else
                {
                    COMMONHELPER.Toaster('success','Return Payment!');
                    $('#btn_submitPaymentValidation').prop('disabled',false);
                    setTimeout(function(){
                        $('#modal_paymentValidation').modal('hide');
                        window.location.replace(`${baseUrl}portal/admin/payments`);
                    }, 1000);
                }
            }, function(data){ 
                COMMONHELPER.Toaster('error',data['responseJSON'][0]);
                $('#btn_submitPaymentValidation').prop('disabled',true);
            });
        }
    }

    thisAdminPayments.a_sendEmailToEmployees = function(currentIndex, progress, progressRem, totalProgress, count, sentCount, arrData)
    {
        setTimeout(function(){  
            let formData = new FormData();
            formData.set("billing_details_id", arrData[count]['id']);
            formData.set("email_address", arrData[count]['email_address']);
            AJAXHELPER.sendEmail({
                // PaymentController::a_sendEmailToEmployees()
                'route' : 'portal/admin/a-send-email-to-employees',
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

                sentCount += 1;

                $('#div_progressBar').css('width',`${totalProgress}%`);
                $('#lbl_progress').text(`${sentCount} / ${currentIndex} Sent`);

                if(totalProgress < 100)
                {
                    count++;
                    ADMIN_PAYMENTS.a_sendEmailToEmployees(currentIndex, progress, progressRem, totalProgress, count, sentCount, arrData);
                }
                else
                {
                    COMMONHELPER.Toaster('success','Payment confirmation sent!');
                    setTimeout(function(){
                        window.location.replace(`${baseUrl}portal/admin/payments`);
                    }, 2000);
                }
            }, function(data){ 
                COMMONHELPER.Toaster('error',data['responseJSON'][0]);
            }); 
        }, 1000);
    }

    return thisAdminPayments;

})();