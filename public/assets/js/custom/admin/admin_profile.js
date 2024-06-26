
const PROFILE = (function(){

    let thisProfile = {};

    let baseUrl = $('#txt_baseUrl').val();

    thisProfile.changePassword = function(thisForm)
    {
        let formData = new FormData(thisForm);
        AJAXHELPER.editData({
            'route' : 'portal/admin/change-password',
            'data'  : formData
        }, function(data){
            COMMONHELPER.Toaster('success',data[0]);
            setTimeout(function(){
                $('#btn_submitChangePassword').prop('disabled',false);
                window.location.replace(`${baseUrl}portal/admin/profile`);
            }, 1000);
        }, function(data){ // Error
            $('#txt_oldPassword').val('');
            $('#txt_newPassword').val('');
            $('#txt_confirmPassword').val('');
            COMMONHELPER.Toaster('error',data['responseJSON'][0]);
            $('#btn_submitChangePassword').prop('disabled',false);
        });
    }

    return thisProfile;

})();