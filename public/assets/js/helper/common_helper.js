
const COMMONHELPER = (function(){

    let thisCommonHelper = {};

    thisCommonHelper.clearFields = function(arrParams)
    {
        if(typeof arrParams['text'] !== 'undefined')
        {
            if(arrParams['text'].length > 0)
            {
                arrParams['text'].forEach(function(value,key){
                    $(`#${value[0]}`).val(value[1]);
                });
            }
        }

        if(typeof arrParams['radio'] !== 'undefined')
        {
            if(arrParams['radio'].length > 0)
            {
                arrParams['radio'].forEach(function(value,key){
                    $(`#${value[0]}`).prop(value[1]);
                });
            }
        }

        if(typeof arrParams['check'] !== 'undefined')
        {
            if(arrParams['check'].length > 0)
            {
                arrParams['check'].forEach(function(value,key){
                    $(`#${value[0]}`).prop(value[1]);
                });
            }
        }
    }

    // thisCommonHelper.validateFields = function(defValue, altValue)
    // {
    //     let emptyValues = ['','null','NULL','N/A','n/a'];
    //     // return (!defValue.includes(emptyValues))? defValue : altValue;
    // }

    return thisCommonHelper;

})();