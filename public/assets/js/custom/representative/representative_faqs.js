
const USER_FAQS = (function(){

    let thisFaqs = {};

    thisFaqs.selectUserFaqs = function()
    {
        AJAXHELPER.selectData({
            'route' : '/portal/user/select-user-faqs',
            'data'  : {
                'sample' : 'sample'
            }
        }, function(data){
            console.log(data);
        });
    }

    return thisFaqs;

})();