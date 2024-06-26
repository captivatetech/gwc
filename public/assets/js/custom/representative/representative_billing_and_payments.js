
const USER_BILLING_AND_PAYMENTS = (function(){

    let thisUserBillingAndPayments = {};

    thisUserBillingAndPayments.selectUserBilling = function()
    {
        AJAXHELPER.selectData({
            'route' : '/portal/user/select-user-billing',
            'data'  : {
                'sample' : 'sample'
            }
        }, function(data){
            console.log(data);
        });
    }

    return thisUserBillingAndPayments;

})();