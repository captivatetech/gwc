
const USER_DASHBOARD = (function(){

    let thisUserDashboard = {};

    thisUserDashboard.selectUserDashboard = function()
    {
        AJAXHELPER.selectData({
            'route' : '/portal/user/select-user-dashboard',
            'data'  : null
        }, function(data){
            console.log(data);
        });
    }

    return thisUserDashboard;

})();