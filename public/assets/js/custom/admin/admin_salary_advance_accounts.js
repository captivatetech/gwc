
const ADMIN_SALARY_ADVANCE_ACCOUNTS = (function(){

    let thisAdminSalaryAdvanceAccounts = {};

    let baseUrl = $('#txt_baseUrl').val();

    thisAdminSalaryAdvanceAccounts.a_loadSalaryAdvanceAccounts = function()
    {
        AJAXHELPER.loadData({
            // LoanController->a_loadSalaryAdvanceAccounts
            'route' : 'portal/admin/a-load-salary-advance-accounts',
            'data'  : {
                'sample' : 'sample'
            }
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
        AJAXHELPER.loadData({
            // LoanController->a_loadDisbursementLists
            'route' : 'portal/admin/a-load-disbursement-lists',
            'data'  : {
                'sample' : 'sample'
            }
        }, function(data){

            let tbody = '';
            data.forEach(function(value,index){
                tbody += `<tr>
                            <td>
                                <input type="checkbox" class="chk-disbursement" onchange="ADMIN_SALARY_ADVANCE_ACCOUNTS.a_unselectAllDisbursement()" value="${value['id']}">
                            </td>
                            <td>${value['identification_number']}</td>
                            <td>${value['last_name']}, ${value['first_name']}</td>
                            <td>${value['bank_depository']}</td>
                            <td>${value['branch_code']}</td>
                            <td style="text-align:right;">Php. ${COMMONHELPER.numberWithCommas(value['loan_amount'])}</td>
                            <td>${value['account_number']}</td>
                        </tr>`;
            });
            $('#tbl_disbursementList').DataTable().destroy();
            $('#tbl_disbursementList tbody').html(tbody);
            $('#tbl_disbursementList').DataTable({
                "columnDefs": [
                    {
                        "targets": 0,
                        "orderable": false
                    }
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

    thisAdminSalaryAdvanceAccounts.a_unselectAllDisbursement = function()
    {
        let ids = $("#tbl_disbursementList tbody input:checkbox:checked").map(function () {
            return $(this).val();
        }).get();

        console.log(ids.length);
        console.log($('#tbl_disbursementList_length select').val());

        if(ids.length == $('#tbl_disbursementList_length select').val())
        {
            $('#chk_selectAllDisbursement').prop('checked',true);
        }
        else
        {
            $('#chk_selectAllDisbursement').prop('checked',false);
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
    }

    thisAdminSalaryAdvanceAccounts.a_downloadDisbursementList = function()
    {

    }

    thisAdminSalaryAdvanceAccounts.a_proceedDisbursement = function()
    {
        $('#tbl_disbursementList tbody tr').map(function(){
            $(this).find('.chk-disbursement').is('checked')      
        });
    }

    return thisAdminSalaryAdvanceAccounts;

})();