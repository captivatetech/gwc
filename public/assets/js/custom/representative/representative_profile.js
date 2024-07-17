
const REPRESENTATIVE_PROFILE = (function(){

    let thisRepresentativeProfile = {};

    let baseUrl = $('#txt_baseUrl').val();

    thisRepresentativeProfile.selectRepresentativeInformation = function()
    {
        AJAXHELPER.selectData({
            
            'route' : 'portal/representative/select-representative-information',
            'data'  : {
                'sample' : 'sample'
            }
        }, function(data){
            $('#txt_employeeId').val(data['id']);
            $('#txt_lastName').val(data['last_name']);
            $('#txt_firstName').val(data['first_name']);
            $('#txt_middleName').val(data['middle_name']);
            $('#txt_emailAddress').val(data['email_address']);
            $('#txt_position').val(data['position']);
            $('#txt_role').val(data['user_type']);
        });
    }

    thisRepresentativeProfile.editRepresentativeInformation = function(thisForm)
    {
        let formData = new FormData(thisForm);

        $('#btn_submitRepInformation').prop('disabled',true);

        AJAXHELPER.editData({
            'route' : 'portal/representative/edit-representative-information',
            'data'  : formData
        }, function(data){
            COMMONHELPER.Toaster('success',data[0]);
            setTimeout(function(){
                $('#btn_submitRepInformation').prop('disabled',false);
                window.location.replace(`${baseUrl}portal/representative/profile`);
            }, 1000);
        }, function(data){ // Error
            COMMONHELPER.Toaster('error',data['responseJSON'][0]);
            $('#btn_submitRepInformation').prop('disabled',false);
        });
    }

    thisRepresentativeProfile.loadRepresentativeIdentifications = function()
    {
        AJAXHELPER.loadData({
            'route' : 'portal/representative/load-representative-identifications',
            'data'  : {
                'sample' : 'sample'
            }
        }, function(data){
            let tbody = "";
            
            data.forEach(function(value,index){
                if(value['category'] == 'Primary')
                {
                    tbody += `<tr>
                                <td>${value['type']}</td>
                                <td>${value['id_number']}</td>
                                <td>${value['date_issued']}</td>
                                <td>${value['placed_issued']}</td>
                                <td>${value['issued_by']}</td>
                                <td>${value['expiry_date']}</td>
                                <td>
                                    <div class="btn-group mb-2">
                                        <button class="btn btn-light btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            Actions <i class="mdi mdi-chevron-down"></i>
                                        </button>
                                        <div class="dropdown-menu" data-popper-placement="bottom-start" style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate3d(0px, 33px, 0px);">
                                            <a class="dropdown-item" href="javascript:void(0)" onclick="REPRESENTATIVE_PROFILE.selectRepresentativeIdentification(${value['id']})">
                                                View ID Picture
                                            </a>
                                            <a class="dropdown-item" href="javascript:void(0)" onclick="REPRESENTATIVE_PROFILE.removeRepresentativeIdentification(${value['id']})">Delete
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>`;
                }
            });
            $('#tbl_primaryId tbody').html(tbody);

            tbody = "";
            data.forEach(function(value,index){
                if(value['category'] == 'Secondary')
                {
                    tbody += `<tr>
                                <td>${value['type']}</td>
                                <td>${value['id_number']}</td>
                                <td>${value['date_issued']}</td>
                                <td>${value['placed_issued']}</td>
                                <td>${value['issued_by']}</td>
                                <td>${value['expiry_date']}</td>
                                <td>
                                    <div class="btn-group mb-2">
                                        <button class="btn btn-light btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            Actions <i class="mdi mdi-chevron-down"></i>
                                        </button>
                                        <div class="dropdown-menu" data-popper-placement="bottom-start" style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate3d(0px, 33px, 0px);">
                                            <a class="dropdown-item" href="javascript:void(0)" onclick="REPRESENTATIVE_PROFILE.selectRepresentativeIdentification(${value['id']})">
                                                View ID Picture
                                            </a>
                                            <a class="dropdown-item" href="javascript:void(0)" onclick="REPRESENTATIVE_PROFILE.removeRepresentativeIdentification(${value['id']})">Delete
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>`;
                }
            });
            $('#tbl_secondaryId tbody').html(tbody);
        });
    }

    thisRepresentativeProfile.addRepresentativeIdentification = function(thisForm)
    {
        let formData = new FormData(thisForm);
        formData.append("file_idPicture", $('#file_idPicture')[0].files[0]);

        $('#btn_submitRepIdentification').prop('disabled',true);

        AJAXHELPER.addData({
            'route' : 'portal/representative/add-representative-identification',
            'data'  : formData
        }, function(data){
            COMMONHELPER.Toaster('success',data[0]);
            setTimeout(function(){
                $('#btn_submitRepIdentification').prop('disabled',false);
                window.location.replace(`${baseUrl}portal/representative/profile`);
            }, 1000);
        }, function(data){ // Error
            COMMONHELPER.Toaster('error',data['responseJSON'][0]);
            $('#btn_submitRepIdentification').prop('disabled',false);
        });
    }

    thisRepresentativeProfile.selectRepresentativeIdentification = function(identificationId)
    {
        AJAXHELPER.selectData({
            'route' : 'portal/representative/select-representative-identification',
            'data'  : {
                'identificationId' : identificationId
            }
        }, function(data){
            $('#img_repIdentificationPreview').prop('src',`${baseUrl}public/assets/uploads/representative/identifications/${data['id_picture']}`);
            $('#modal_repIdentificationPreview').modal('show');
        });
    }

    thisRepresentativeProfile.removeRepresentativeIdentification = function(identificationId)
    {
        if(confirm('Please confirm!'))
        {
            AJAXHELPER.removeData({
                'route' : 'portal/representative/remove-representative-identification',
                'data'  : {
                    'identificationId' : identificationId
                }
            }, function(data){
                COMMONHELPER.Toaster('success',data[0]);
                setTimeout(function(){
                    window.location.replace(`${baseUrl}portal/representative/profile`);
                }, 1000);
            }, function(data){ // Error
                COMMONHELPER.Toaster('error',data['responseJSON'][0]);
            });
        }
    }

    thisRepresentativeProfile.editRepresentativeProfilePicture = function()
    {
        let formData = new FormData();
        formData.append("file_profilePicture", $('#file_profilePicture')[0].files[0]);

        $('#btn_submitProfilePicture').prop('disabled',true);

        AJAXHELPER.editData({
            'route' : 'portal/representative/edit-representative-profile-picture',
            'data'  : formData
        }, function(data){
            COMMONHELPER.Toaster('success',data[0]);
            setTimeout(function(){
                $('#btn_submitProfilePicture').prop('disabled',false);
                window.location.replace(`${baseUrl}portal/representative/profile`);
            }, 1000);
        }, function(data){ // Error
            COMMONHELPER.Toaster('error',data['responseJSON'][0]);
            $('#btn_submitProfilePicture').prop('disabled',false);
        });
    }

    return thisRepresentativeProfile;

})();