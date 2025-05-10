

const EMPLOYEE_PROFILE = (function(){

    let thisEmployeeProfile = {};

    thisEmployeeProfile.e_selectEmployeeProfile = function()
    {
        AJAXHELPER.selectData({
            // EmployeeController->e_selectEmployeeProfile
            'route' : '/portal/employee/e-select-employee-profile',
            'data'  : null
        }, function(data){
            $('#lbl_name').text(`${data['first_name']} ${data['last_name']}`);
            $('#lbl_birthDate').text(`${data['birthday']}`);
            $('#lbl_maritalStatus').text(`${data['marital_status']}`);
            $('#lbl_emailAddress').text(`${data['email_address']}`);
            $('#lbl_mobileNumber').text(`${data['mobile_number']}`);
            $('#lbl_position').text(`${data['position']}`);
            $('#lbl_department').text(`${data['department']}`);
            $('#lbl_employmentStatus').text(`${data['employment_status']}`);
            $('#lbl_dateHired').text(`${data['date_hired']}`);
        });
    }

    return thisEmployeeProfile;

})();