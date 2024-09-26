
const COMMONHELPER = (function(){

    let thisCommonHelper = {};

    thisCommonHelper.Toaster = function(toastIcon, toastMessage)
    {
        const Toast = Swal.mixin({
            toast:true,
            position:"top-end",
            showConfirmButton:false,
            timer:3000,
            // timerProgressBar:true,
            onOpen:function(e){
                $('.swal2-timer-progress-bar').addClass(`bar-${toastIcon}`);
                e.addEventListener("mouseenter",Swal.stopTimer),
                e.addEventListener("mouseleave",Swal.resumeTimer)
            }
        });

        Toast.fire({icon:`${toastIcon}`,title:`${toastMessage}`});
    }

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

    thisCommonHelper.numberWithCommas = function(x) 
    {
        if(x != null)
        {
            return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }
        else
        {
            return 0.00;
        }
        
    }

    thisCommonHelper.validateFields = function(defValue, altValue)
    {
        let emptyValues = ["",'','null','NULL','N/A','n/a'];
        return (emptyValues.includes(defValue))? altValue : defValue;
    }

    return thisCommonHelper;

})();