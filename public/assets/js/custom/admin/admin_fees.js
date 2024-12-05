
const ADMIN_FEES = (function(){

    let thisAdminFees = {};

    thisAdminFees.loadFees = function()
    {
        AJAXHELPER.getData({
            // FeeController->loadFees
            'route' : 'portal/admin/load-admin-fees',
            'data'  : null
        }, function(data){
            
        });
    }

    thisAdminFees.addFee = function(thisForm)
    {
        let formData = new FormData(thisForm);

        $('#btn_saveUser').prop('disabled',true);
        
        AJAXHELPER.postData({
            // FeeController->addFee
            'route' : 'portal/admin/add-admin-fee',
            'data'  : formData
        }, function(data){
            COMMONHELPER.Toaster('success',data[0]);
            setTimeout(function(){
                $('#btn_saveUser').prop('disabled',false);
                window.location.replace(`${baseUrl}portal/admin/maintenance-users`);
            }, 1000);
        }, function(data){
            COMMONHELPER.Toaster('error',data['responseJSON'][0]);
            $('#btn_saveUser').prop('disabled',false);
        });
    }

    thisAdminFees.selectFee = function(feeId)
    {
        AJAXHELPER.getData({
            // FeeController->selectFee
            'route' : 'portal/admin/select-admin-fee',
            'data'  : null
        }, function(data){
            
        });
    }

    thisAdminFees.editFee = function(thisForm)
    {
        let formData = new FormData(thisForm);

        $('#btn_saveUser').prop('disabled',true);
        
        AJAXHELPER.postData({
            // FeeController->editFee
            'route' : 'portal/admin/edit-admin-fee',
            'data'  : formData
        }, function(data){
            COMMONHELPER.Toaster('success',data[0]);
            setTimeout(function(){
                $('#btn_saveUser').prop('disabled',false);
                window.location.replace(`${baseUrl}portal/admin/maintenance-users`);
            }, 1000);
        }, function(data){
            COMMONHELPER.Toaster('error',data['responseJSON'][0]);
            $('#btn_saveUser').prop('disabled',false);
        });
    }

    thisAdminFees.removeFee = function(feeId)
    {
        let formData = new FormData(thisForm);

        $('#btn_saveUser').prop('disabled',true);
        
        AJAXHELPER.postData({
            // FeeController->removeFee
            'route' : 'portal/admin/remove-admin-fee',
            'data'  : formData
        }, function(data){
            COMMONHELPER.Toaster('success',data[0]);
            setTimeout(function(){
                $('#btn_saveUser').prop('disabled',false);
                window.location.replace(`${baseUrl}portal/admin/maintenance-users`);
            }, 1000);
        }, function(data){
            COMMONHELPER.Toaster('error',data['responseJSON'][0]);
            $('#btn_saveUser').prop('disabled',false);
        });
    }

    return thisAdminFees;

})();