
const USER_MAINTENANCE_USERS = (function(){

    let thisUserMaintenanceUsers = {};

    thisUserMaintenanceUsers.selectUserMaintenanceUser = function()
    {
        AJAXHELPER.selectData({
            'route' : '/portal/user/select-user-maintenance-user',
            'data'  : {
                'sample' : 'sample'
            }
        }, function(data){
            console.log(data);
        });
    }

    return thisUserMaintenanceUsers;

})();