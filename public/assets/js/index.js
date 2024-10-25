const INDEX = (function(){

    let thisIndex = {};

    let baseUrl = $('#txt_baseUrl').val();

    thisIndex.login = function(thisForm)
    {
        $('#btn_submitLogin').prop('disabled',true);
        let formData = new FormData(thisForm);
        AJAXHELPER.validateData({
            'route' : 'portal/login',
            'data'  : formData
        }, function(data){ // Success
            COMMONHELPER.Toaster('success',data[1]);
            if(data[0] == 'admin')
            {
                setTimeout(function(){
                    window.location.replace(`${baseUrl}portal/admin/dashboard`);
                }, 2000);
            }
            else
            {
                if(data[0] == 'employee')
                {
                    setTimeout(function(){
                        window.location.replace(`${baseUrl}portal/employee/dashboard`);
                    }, 2000);
                }
                else if(data[0] == 'representative')
                {
                    setTimeout(function(){
                        window.location.replace(`${baseUrl}portal/representative/dashboard`);
                    }, 2000);
                }
            }
        }, function(data){ // Error
            $('#txt_userEmail').val('');
            $('#txt_userPassword').val('');
            COMMONHELPER.Toaster('error',data['responseJSON'][0]);
            $('#btn_submitLogin').prop('disabled',false);
        });
    }

    thisIndex.createAccount = function(thisForm)
    {
        $('#btn_submitCreateAccount').prop('disabled',true);
        let formData = new FormData(thisForm);
        AJAXHELPER.postData({
            // IndexController->createAccount()
            'route' : 'portal/create-account',
            'data'  : formData
        }, function(data){ // Success
            COMMONHELPER.Toaster('success',data[0]);
            $('#div_createAccount').prop('hidden',true);
            $('#div_createAccountResult').prop('hidden',false);
            $('#btn_submitCreateAccount').prop('disabled',false);
        }, function(data){ // Error
            $('#txt_userEmail').val('');
            COMMONHELPER.Toaster('error',data['responseJSON'][0]);
            $('#btn_submitCreateAccount').prop('disabled',false);
        });
    }

    thisIndex.forgotPassword = function(thisForm)
    {
        $('#btn_submitForgotPassword').prop('disabled',true);
        $('#btn_submitForgotPassword').html('<i>Please wait...</i>');
        let formData = new FormData(thisForm);
        AJAXHELPER.validateData({
            // IndexController->forgotPassword()
            'route' : 'portal/forgot-password',
            'data'  : formData
        }, function(data){ // Success
            $('#btn_submitForgotPassword').html('Submit Request');
            COMMONHELPER.Toaster('success',data[0]);
            setTimeout(function(){
                window.location.replace(`${baseUrl}login`);
            }, 2000);
        }, function(data){ // Error
            $('#btn_submitForgotPassword').prop('disabled',false);
            $('#btn_submitForgotPassword').html('Submit Request');
            COMMONHELPER.Toaster('error',data['responseJSON'][0]);
        });
    }

    thisIndex.changePassword = function(thisForm)
    {
        if($('#txt_employeePassword').val() == $('#txt_employeeConfirmPassword').val())
        {
            $('#btn_submitChangePassword').prop('disabled',true);
            $('#btn_submitChangePassword').html('<i>Please wait...</i>');
            let formData = new FormData(thisForm);
            AJAXHELPER.validateData({
                // IndexController->changePassword()
                'route' : 'portal/change-password',
                'data'  : formData
            }, function(data){ // Success
                $('#btn_submitChangePassword').html('Submit');
                COMMONHELPER.Toaster('success',data[0]);
                setTimeout(function(){
                    window.location.replace(`${baseUrl}login`);
                }, 2000);
            }, function(data){ // Error
                $('#btn_submitChangePassword').prop('disabled',false);
                $('#btn_submitChangePassword').html('Submit');
                COMMONHELPER.Toaster('error',data['responseJSON'][0]);
                $('#txt_employeePassword').val("").focus();
                $('#txt_employeeConfirmPassword').val("");
            });
        }
        else
        {
            COMMONHELPER.Toaster('error',"Password confirmation not match!");
            $('#txt_employeePassword').val("").focus();
            $('#txt_employeeConfirmPassword').val("");
        }
    }

    thisIndex.e_emailVerification = function(thisForm)
    {
        if($('#txt_password').val() == $('#txt_confirmPassword').val())
        {
            $('#btn_submitEmailVerification').prop('disabled',true);
            let formData = new FormData(thisForm);
            AJAXHELPER.validateData({
                //IndexController->e_emailVerification
                'route' : 'portal/e-email-verification',
                'data'  : formData
            }, function(data){ // Success
                COMMONHELPER.Toaster('success',data[0]);
                setTimeout(function(){
                    window.location.replace(`${baseUrl}login`);
                }, 2000);
                $('#btn_submitEmailVerification').prop('disabled',false);
            }, function(data){ // Error
                $('#txt_employeeId').val('');
                $('#txt_employeePassword').val('');
                $('#txt_employeeConfirmPassword').val('');
                COMMONHELPER.Toaster('error',data['responseJSON'][0]);
                $('#btn_submitEmailVerification').prop('disabled',false);
            });
        }
        else
        {
            COMMONHELPER.Toaster('error','Pasword confirmation not match!');
        }
    }

    return thisIndex;

})();