
const USER = (function(){

    let thisUser = {};

    thisUser.loadUsers = function()
    {
        AJAXHELPER.loadData({
            'route' : 'portal/load-users',
            'data'  : {
                'sample' : 'sample'
            }
        }, function(data){
            // COMMONHELPER.clearFields({
            //     'text'  : [
            //         ['txt_hello' , ''],
            //         ['txt_hello2' , ''],
            //     ]
            // });
        });
    }

    return thisUser;

})();