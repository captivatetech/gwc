
const USER_FINANCING_PRODUCTS = (function(){

    let thisUserFinancingProducts = {};

    thisUserFinancingProducts.selectUserFinancingProduct = function()
    {
        AJAXHELPER.selectData({
            'route' : '/portal/user/select-user-financing-product',
            'data'  : {
                'sample' : 'sample'
            }
        }, function(data){
            console.log(data);
        });
    }

    return thisUserFinancingProducts;

})();