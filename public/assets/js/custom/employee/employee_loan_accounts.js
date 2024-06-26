
const EMPLOYEE_LOAN_ACCOUNTS = (function(){

    let thisEmployeeLoanAccounts = {};

    thisEmployeeLoanAccounts.loadEmployeeDashboard = function()
    {
        AJAXHELPER.selectData({
            'route' : '/portal/employee/load-employee-dashboard',
            'data'  : {
                'sample' : 'sample'
            }
        }, function(data){
            console.log(data);
        });
    }

    return thisEmployeeLoanAccounts;

})();