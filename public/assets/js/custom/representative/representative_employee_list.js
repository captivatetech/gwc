
const USER_EMPLOYEE_LIST = (function(){

    let thisUserEmployeeList = {};

    thisUserEmployeeList.selectUserEmployeeList = function()
    {
        AJAXHELPER.selectData({
            'route' : '/portal/user/select-user-employee-list',
            'data'  : {
                'sample' : 'sample'
            }
        }, function(data){
            console.log(data);
        });
    }

    return thisUserEmployeeList;

})();