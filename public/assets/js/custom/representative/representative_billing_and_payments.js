
const REPRESENTATIVE_BILLING_AND_PAYMENTS = (function(){

    let thisRepresentativeBillingAndPayments = {};

    let baseUrl = $('#txt_baseUrl').val();

    thisRepresentativeBillingAndPayments.r_loadBillings = function()
    {
        AJAXHELPER.getData({
            // BillingController->r_loadBillings
            'route' : 'portal/representative/r-load-billings',
            'data'  : null
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
        AJAXHELPER.getData({
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

            $('#lbl_numberOfAccountsPaid').text(`${data['arrBillingDetails']['paid_count']} out of ${data['arrBillingDetails']['billing_count']}`);
            $('#lbl_billingTotalAmount').text(`PHP ${COMMONHELPER.numberWithCommas(data['arrBillingDetails']['total_paid'])}`);

            let tbody = '';
            data['arrBillingList'].forEach(function(value,index){

                let chk = "";

                let slc = `<select class="form-control form-select" onchange="REPRESENTATIVE_BILLING_AND_PAYMENTS.r_penaltyType(this)" required>
                                <option value="">---</option>
                                <option value="Company-Penalty">Company Penalty</option>
                                <option value="Employee-Penalty">Employee Penalty</option>
                            </select>`;

                if(value['payment_status'] == 'UNPAID')
                {
                    chk = `<input type="checkbox" class="chk-billing" onchange="REPRESENTATIVE_BILLING_AND_PAYMENTS.r_unselectBilling()" value="${value['id']}">`;
                }
                else
                {
                    chk = `<input type="checkbox" class="chk-billing" value="${value['id']}" checked disabled>`;

                    slc = `<select class="form-control form-select" disabled>
                                <option value="">---</option>
                                <option value="Company-Penalty">Company Penalty</option>
                                <option value="Employee-Penalty">Employee Penalty</option>
                            </select>`;
                }

                if(value['penalty_type'] == 'Company-Penalty')
                {
                    slc = `<select class="form-control form-select" onchange="REPRESENTATIVE_BILLING_AND_PAYMENTS.r_penaltyType(this)" required>
                                <option value="">---</option>
                                <option value="Company-Penalty" selected>Company Penalty</option>
                                <option value="Employee-Penalty">Employee Penalty</option>
                            </select>`;
                }
                else if(value['penalty_type'] == 'Employee-Penalty')
                {
                    slc = `<select class="form-control form-select" onchange="REPRESENTATIVE_BILLING_AND_PAYMENTS.r_penaltyType(this)" required>
                                <option value="">---</option>
                                <option value="Company-Penalty">Company Penalty</option>
                                <option value="Employee-Penalty" selected>Employee Penalty</option>
                            </select>`;
                }

                tbody += `<tr>
                            <td>
                                ${chk}
                            </td>
                            <td>${value['account_number']}</td>
                            <td>${value['disbursement_date']}</td>
                            <td>${value['first_name']} ${value['last_name']}</td>
                            <td style="text-align:right;">Php.${COMMONHELPER.numberWithCommas(value['loan_amount'])}</td>
                            <td style="text-align:right;">Php. ${COMMONHELPER.numberWithCommas(value['billing_amount'])}</td>
                            <td>${value['payment_terms']} months</td>
                            <td>${value['billing_series']} of ${value['payment_terms']}</td>
                            <td class="p-1">
                                ${slc}
                            </td>
                        </tr>`;
            });
            $('#tbl_billingDetails').DataTable().destroy();
            $('#tbl_billingDetails tbody').html(tbody);
            $('#tbl_billingDetails').DataTable({'scrollX':true, "order": [[ 1, "desc" ]], "aoColumnDefs": [
                    { "bSortable": false, "aTargets": [ 0, 2, 3, 4, 5, 6, 7 , 8] }, 
                    { "bSearchable": false, "aTargets": [ 0, 2, 3, 4, 5, 6, 7, 8] }
                ]
            });

            let ids = $("#tbl_billingDetails tbody input:checkbox:checked").map(function () {
                return $(this).val();
            }).get();

            let trCount = 0;
            $("#tbl_billingDetails tbody tr").map(function () {
                trCount++;
            });

            if(ids.length == trCount)
            {
                $('#chk_selectAllBillings').prop('checked',true).prop('disabled',true);
            }
            else
            {
                $('#chk_selectAllBillings').prop('checked',false).prop('disabled',false);
            }
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
                $('#chk_selectAllBillings').prop('checked',true);
            }
            else
            {
                $('#chk_selectAllBillings').prop('checked',false);
            }
        }
        else
        {   
            if(trCount == ids.length)
            {
                $('#chk_selectAllBillings').prop('checked',true);
            }
            else
            {
                $('#chk_selectAllBillings').prop('checked',false);
            }
        }

        if(trCount > ids.length && ids.length != 0)
        {
            $('#div_promisoryNote').prop('hidden',false);
            $('#file_promisoryNote').prop('required',true);
        }
        else
        {
            $('#div_promisoryNote').prop('hidden',true);
            $('#file_promisoryNote').prop('required',false);
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

        $("#tbl_billingDetails tbody input:checkbox").map(function(){
            if($(this).is(':checked'))
            {
                $(this).parents('tr').find('td:eq(8) select').prop('disabled',true).prop('required',false).val('');
                $(this).parents('tr').find('td:eq(8) select').css('border-color','#98A6AD');
            }
            else
            {
                $(this).parents('tr').find('td:eq(8) select').prop('disabled',false).prop('required',true);
                $(this).parents('tr').find('td:eq(8) select').css('border-color','#CED4DA');
            }
        });

        let billingAmount = parseFloat(($('#txt_billingAmount').val()).replace(',',''));
        let balance = billingAmount - totalBillingAmount;

        $('#txt_paymentAmount').val(COMMONHELPER.numberWithCommas(totalBillingAmount.toFixed(2)));
        $('#txt_balance').val(COMMONHELPER.numberWithCommas(balance.toFixed(2)));
        $('#lbl_numberOfAccountsPaid').text(`${ids.length} out of ${trCount}`);
        $('#lbl_billingTotalAmount').text(`PHP ${COMMONHELPER.numberWithCommas(totalBillingAmount.toFixed(2))}`);
    }

    thisRepresentativeBillingAndPayments.r_penaltyType = function(thisSelect)
    {
        if($(thisSelect).val() == "")
        {
            $(thisSelect).css('border-color','red');
        }
        else
        {
            $(thisSelect).css('border-color','#CED4DA');
        }
    }

    thisRepresentativeBillingAndPayments.r_submitPayment = function(thisForm)
    {
        let formData = new FormData(thisForm);
        formData.set("file_proofOfPayment", $('#file_proofOfPayment')[0].files[0]);

        let arrBillingIds = $("#tbl_billingDetails tbody input:checkbox:checked").map(function () {
            return $(this).val();
        }).get();
        formData.set("arrBillingIds", arrBillingIds);

        let arrBillingIdsWithPenalties = [];
        $("#tbl_billingDetails tbody input:checkbox").map(function(){
            if(!$(this).is(':checked'))
            {
                arrBillingIdsWithPenalties.push({
                    'id' : $(this).val(),
                    'penaltyType' : $(this).parents('tr').find('td:eq(8) select').val()
                });
            }
        });
        formData.set("arrBillingIdsWithPenalties", JSON.stringify(arrBillingIdsWithPenalties));

        formData.set("file_promisoryNote", $('#file_promisoryNote')[0].files[0]);

        $('#btn_submitPayment').prop('disabled',true);
        AJAXHELPER.postData({
            // PaymentController->r_submitPayment
            'route' : 'portal/representative/r-submit-payment',
            'data'  : formData
        }, function(data){
            if(data[0] == 'Online-Payment')
            {
                window.location.replace(`${data[1]}`);
            }
            else
            {
                COMMONHELPER.Toaster('success',data[1]);
                setTimeout(function(){
                    $('#btn_submitPayment').prop('disabled',false);
                    $('#modal_billingDetails').modal('hide');
                    window.location.replace(`${baseUrl}portal/representative/billing-and-payments`);
                }, 2000);
            }
        }, function(data){
            COMMONHELPER.Toaster('error',data['responseJSON'][0]);
            $('#btn_submitPayment').prop('disabled',true);
        });
    }

    return thisRepresentativeBillingAndPayments;

})();