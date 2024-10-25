
const EMPLOYEE_LOAN_ACCOUNTS = (function(){

    let thisEmployeeLoanAccounts = {};

    let baseUrl = $('#txt_baseUrl').val();

    thisEmployeeLoanAccounts.e_loadLoanAccounts = function()
    {
        AJAXHELPER.getData({
            // LoanController->e_loadLoanAccounts()
            'route' : '/portal/employee/e-load-loan-accounts',
            'data'  : null
        }, function(data){
            let tbody = '';
            data.forEach(function(value,index){
                tbody += `<tr>
                            <td>${value['created_date']}</td>
                            <td>${value['application_number']}</td>
                            <td>${value['application_status']}</td>
                            <td>${COMMONHELPER.numberWithCommas(value['loan_amount'])}</td>
                            <td>${value['payment_terms']} month/s</td>
                            <td>${COMMONHELPER.numberWithCommas(value['monthly_dues'])}</td>
                            <td>${COMMONHELPER.numberWithCommas(value['deduction_per_cutoff'])}</td>
                            <td>${value['purpose_of_loan']}</td>
                        </tr>`;
            });
            $('#tbl_loanAccounts').DataTable().destroy();
            $('#tbl_loanAccounts tbody').html(tbody);
            $('#tbl_loanAccounts').DataTable();
        });
    }

    return thisEmployeeLoanAccounts;

})();