
const BANK = (function(){

    let thisBank = {};

    let baseUrl = $('#txt_baseUrl').val();

    thisBank.loadBanks = function()
    {
        AJAXHELPER.getData({
            // BankController->loadBanks
            'route' : 'portal/admin/load-banks',
            'data'  : null
        }, function(data){
            
            
            
        });
    }

    thisBank.addBank = function(thisForm)
    {
        let formData = new FormData(thisForm);
        AJAXHELPER.postData({
            // BankController->addBank
            'route' : 'portal/admin/add-bank',
            'data'  : formData
        }, function(data){
            COMMONHELPER.Toaster('success',data[0]);
            setTimeout(function(){
                $('#btn_submitChangePassword').prop('disabled',false);
                window.location.replace(`${baseUrl}portal/admin/profile`);
            }, 1000);
        }, function(data){ 
            $('#txt_oldPassword').val('');
            $('#txt_newPassword').val('');
            $('#txt_confirmPassword').val('');
            COMMONHELPER.Toaster('error',data['responseJSON'][0]);
            $('#btn_submitChangePassword').prop('disabled',false);
        });
    }

    return thisBank;

})();