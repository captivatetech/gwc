
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
                            <td>Garrett Winters</td>
                            <td>Accountant</td>
                            <td>Tokyo</td>
                            <td>63</td>
                            <td>2011/07/25</td>
                            <td>$170,750</td>
                            <td>$320,800</td>
                        </tr>`;
            });
            $('#tbl_loanAccounts').DataTable().destroy();
            $('#tbl_loanAccounts tbody').html(tbody);
            $('#tbl_loanAccounts').DataTable();
        });
    }

    return thisEmployeeLoanAccounts;

})();