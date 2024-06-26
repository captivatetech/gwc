

const EMPLOYEE_PROFILE = (function(){

    let thisEmployeeProfile = {};

    thisEmployeeProfile.selectEmployeeProfile = function()
    {
        AJAXHELPER.selectData({
            'route' : '/portal/employee/select-employee-profile',
            'data'  : {
                'sample' : 'sample'
            }
        }, function(data){
            console.log(data);
        });
    }

    return thisEmployeeProfile;

})();