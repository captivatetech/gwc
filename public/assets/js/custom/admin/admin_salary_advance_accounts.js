
const ADMIN_SALARY_ADVANCE_ACCOUNTS = (function(){

    let thisAdminSalaryAdvanceAccounts = {};

    let baseUrl = $('#txt_baseUrl').val();

    thisAdminSalaryAdvanceAccounts.a_loadSalaryAdvanceAccounts = function()
    {
        AJAXHELPER.getData({
            // LoanController->a_loadSalaryAdvanceAccounts
            'route' : 'portal/admin/a-load-salary-advance-accounts',
            'data'  : null
        }, function(data){
            let tbody = '';
            data.forEach(function(value,index){
                tbody += `<tr>
                            <td>${value['created_date']}</td>
                            <td>${value['application_number']}</td>
                            <td>${value['last_name']}, ${value['first_name']}</td>
                            <td>${value['company_name']}</td>
                            <td style="text-align:right;">Php. ${COMMONHELPER.numberWithCommas(value['loan_amount'])}</td>
                            <td>${value['disbursement_status']}</td>
                        </tr>`;
            });
            $('#tbl_salaryAdvanceAccounts').DataTable().destroy();
            $('#tbl_salaryAdvanceAccounts tbody').html(tbody);
            $('#tbl_salaryAdvanceAccounts').DataTable();
        });
    }

    thisAdminSalaryAdvanceAccounts.a_loadDisbursementLists = function()
    {
        AJAXHELPER.getData({
            // LoanController->a_loadDisbursementLists
            'route' : 'portal/admin/a-load-disbursement-lists',
            'data'  : null
        }, function(data){
            let tbody = '';
            data.forEach(function(value,index){
                tbody += `<tr>
                            <td>
                                <input type="checkbox" class="chk-disbursement" onchange="ADMIN_SALARY_ADVANCE_ACCOUNTS.a_unselectDisbursement()" value="${value['id']}">
                            </td>
                            <td>${value['identification_number']}</td>
                            <td>${value['last_name']}, ${value['first_name']}</td>
                            <td>${value['bank_depository']}</td>
                            <td>${value['branch_code']}</td>
                            <td style="text-align:right;">Php. ${COMMONHELPER.numberWithCommas(value['loan_amount'])}</td>
                            <td style="text-align:right;">Php. ${COMMONHELPER.numberWithCommas(value['amount_to_receive'])}</td>
                            <td>${value['account_number']}</td>
                        </tr>`;
            });
            $('#tbl_disbursementList').DataTable().destroy();
            $('#tbl_disbursementList tbody').html(tbody);
            $('#tbl_disbursementList').DataTable({'scrollX':true, "order": [[ 1, "desc" ]], "aoColumnDefs": [
                    { "bSortable": false, "aTargets": [ 0, 2, 3, 4, 5, 6, 7] }, 
                    { "bSearchable": false, "aTargets": [ 0, 2, 3, 4, 5, 6, 7] }
                ]
            });

            let filter = `<div class="row">
                            <div class="col-sm-6" style="padding-top: 6px;">
                                <span>Company Name</span> 
                            </div>
                            <div class="col-sm-6">
                                <select class="form-control form-select form-control-sm"></select>
                            </div>
                        </div>`;

            $('#tbl_disbursementList_filter').html(`${filter}`);
        });
    }

    thisAdminSalaryAdvanceAccounts.a_unselectDisbursement = function()
    {
        let ids = $("#tbl_disbursementList tbody input:checkbox:checked").map(function () {
            return $(this).val();
        }).get();

        let trCount = 0;
        $("#tbl_disbursementList tbody tr").map(function () {
            trCount++;
        });

        if(trCount >= $('#tbl_disbursementList_length select').val())
        {
            if(ids.length == $('#tbl_disbursementList_length select').val())
            {
                $('#chk_selectAllDisbursement').prop('checked',true);
            }
            else
            {
                $('#chk_selectAllDisbursement').prop('checked',false);
            }
        }
        else
        {   
            if(trCount == ids.length)
            {
                $('#chk_selectAllDisbursement').prop('checked',true);
            }
            else
            {
                $('#chk_selectAllDisbursement').prop('checked',false);
            }
        }
        
        if(ids.length == 0)
        {
            $('#btn_downloadFile').prop('disabled',true);
            $('#btn_proceedDisbursement').prop('disabled',true);
        }
        else
        {
            $('#btn_downloadFile').prop('disabled',false);
            $('#btn_proceedDisbursement').prop('disabled',false);
        }

        let totalDisbursementAmount = 0;
        $("#tbl_disbursementList tbody input:checkbox:checked").map(function(){
            let amountStr = $(this).parents('tr').find('td:eq(6)').text();
            totalDisbursementAmount += parseFloat(amountStr.substring(5).replace(",",""));
        });

        let totalDisbursement = totalDisbursementAmount;

        $('#lbl_disbursementTotalAmount').text(COMMONHELPER.numberWithCommas(totalDisbursementAmount.toFixed(2)));

        let xenditBalance = parseFloat($('#lbl_xenditBalance').text().replace(",",""));

        if(totalDisbursement > xenditBalance)
        {
            alert('Insufficient balance!');
            $('#btn_downloadFile').prop('disabled',true);
            $('#btn_proceedDisbursement').prop('disabled',true);
        }
        else
        {
            $('#btn_downloadFile').prop('disabled',false);
            $('#btn_proceedDisbursement').prop('disabled',false);
        }
    }

    thisAdminSalaryAdvanceAccounts.a_loadAccountBalance = function()
    {
        $('#btn_reloadXenditBalance').prop('disabled',true);
        AJAXHELPER.getData({
            // LoanController->a_loadAccountBalance
            'route' : 'portal/admin/a-load-account-balance',
            'data'  : null
        }, function(data){
            $('#lbl_xenditBalance').text(COMMONHELPER.numberWithCommas(data['balance']));
            $('#btn_reloadXenditBalance').prop('disabled',false);
        }, function(data){
            $('#lbl_xenditBalance').text('Please reload');
            $('#btn_reloadXenditBalance').prop('disabled',false);
        });
    }

    thisAdminSalaryAdvanceAccounts.a_downloadDisbursementList = function()
    {
        // Hello World
    }

    thisAdminSalaryAdvanceAccounts.a_prepareDisbursement = function()
    {
        $('#btn_proceedDisbursement').prop('disabled',true);

        $('#modal_disbursementList').modal('hide');
        $('#modal_loanDisbursement').modal('show');

        let arrLoanIds = [];
        $('#tbl_disbursementList tbody input:checkbox:checked').map(function(){
            arrLoanIds.push($(this).val());     
        });

        let disbursementCount = arrLoanIds.length - 1;
        let counter = 0;
        let disburseCount = 0;

        let progress = 100 / parseInt(arrLoanIds.length);
        let progressRem = 100 % parseInt(arrLoanIds.length);
        let totalProgress = 0;

        ADMIN_SALARY_ADVANCE_ACCOUNTS.a_proceedDisbursement(counter, disburseCount, arrLoanIds, progress, progressRem, totalProgress);
    }

    thisAdminSalaryAdvanceAccounts.a_proceedDisbursement = function(counter, disburseCount, arrLoanIds, progress, progressRem, totalProgress)
    {
        let formData = new FormData();
        formData.set("loanId", arrLoanIds[counter]);
        
        AJAXHELPER.postData({
            // LoanController->a_proceedDisbursement
            'route' : 'portal/admin/a-proceed-disbursement',
            'data'  : formData
        }, function(data){

            if(counter == arrLoanIds.length - 1)
            {
                progressRem = 100 - totalProgress;
                totalProgress += progressRem;   
            }
            else
            {
                totalProgress += progress;
            }

            disburseCount += 1;

            $('#div_progressBar').css('width',`${totalProgress}%`);
            $('#lbl_progress').text(`${disburseCount} / ${arrLoanIds.length} Sent`);

            if(totalProgress < 100)
            {
                setTimeout(function(){
                    counter++;
                    ADMIN_SALARY_ADVANCE_ACCOUNTS.a_proceedDisbursement(counter, disburseCount, arrLoanIds, progress, progressRem, totalProgress);
                }, 1000);
            }
            else
            {
                setTimeout(function(){
                    COMMONHELPER.Toaster('success','Loan Disbursement Complete!');
                    $('#btn_proceedDisbursement').prop('disabled',false);
                    $('#modal_loanDisbursement').modal('hide');
                    window.location.replace(`${baseUrl}portal/admin/salary-advance-accounts`);
                }, 2000);
            }
        }, function(data){ 
            COMMONHELPER.Toaster('error',data['responseJSON'][0]);
            $('#btn_proceedDisbursement').prop('disabled',false);
        });
    }

    return thisAdminSalaryAdvanceAccounts;

})();