
const EMPLOYEE_DASHBOARD = (function(){

    let thisEmployeeDashboard = {};

    thisEmployeeDashboard.loadEmployeeDashboard = function()
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

    return thisEmployeeDashboard;

})();