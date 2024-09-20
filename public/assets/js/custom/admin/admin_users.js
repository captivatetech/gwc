
const USERS = (function(){

    let thisUser = {};

    let baseUrl = $('#txt_baseUrl').val();

    thisUser.loadRoles = function(roleId = null)
    {
        AJAXHELPER.getData({
            // RoleController->loadAdminRoles
            'route' : 'portal/admin/load-admin-roles',
            'data'  : null
        }, function(data){
            let options = '<option value="" data-icon="feather-globe" selected>Select Role</option>';
            data.forEach(function(value,key){
                if(roleId == null)
                {
                    options += `<option value="${value['id']}" data-icon="feather-circle">${value['role_name']}</option>`;
                }
                else
                {
                    options += `<option value="${value['id']}" data-icon="feather-circle" ${(roleId == value['id'])? 'selected' : ''}>${value['role_name']}</option>`;
                }
            });
            $('#slc_role').html(options);
        });
    }

    thisUser.selectRole = function(roleId)
    {
        AJAXHELPER.getData({
            // RoleController->selectAdminRole
            'route' : 'portal/admin/select-admin-role',
            'data'  : {
                'roleId' : roleId
            }
        }, function(data){
            $('#div_userRoleConfiguration').prop('hidden',false);

            $('#txt_roleId').val(data['id']);
            $('#txt_roleName').val(data['role_name']);
            $('#txt_roleDescription').val(data['role_description']);

            let count = 0;
            let moduleStatusChecked = 0;
            let moduleStatus = false;
            $('#tbl_rolesConfig tbody tr.module').each(function(){          
                if(data['access_modules'][count][0][0] == 1)
                {
                    moduleStatus = true;
                    moduleStatusChecked++;
                }
                else 
                {
                    moduleStatus = false;
                }

                $(this).find('td:eq(0) input[type="checkbox"]').prop('checked',moduleStatus);

                $(this).find('td:eq(1) input[type="checkbox"]').prop('checked',(data['access_modules'][count][1][0])? true : false);
                $(this).find('td:eq(2) input[type="checkbox"]').prop('checked',(data['access_modules'][count][1][1])? true : false);
                $(this).find('td:eq(3) input[type="checkbox"]').prop('checked',(data['access_modules'][count][1][2])? true : false);
                $(this).find('td:eq(4) input[type="checkbox"]').prop('checked',(data['access_modules'][count][1][3])? true : false);

                if(data['access_modules'][count][1].includes(1))
                {
                    $(this).find('td:eq(5) button.btn_modules').prop('disabled',false);
                }
                else
                {
                    $(this).find('td:eq(5) button.btn_modules').prop('disabled',true);
                }

                count++;
            });

            moduleStatus = (moduleStatusChecked == count)? true : false;
            $('#tbl_rolesConfig thead tr td:eq(0)').find('input[type="checkbox"]').prop('checked',moduleStatus);

            let checkboxesView = $('#tbl_rolesConfig tbody tr').find('td:eq(1) input[type="checkbox"]').length;
            let checkedboxesView = $('#tbl_rolesConfig tbody tr').find('td:eq(1) input:checked[type="checkbox"]').length;
            $('#chk_view').prop('checked',(checkboxesView == checkedboxesView)? true : false);

            let checkboxesCreate = $('#tbl_rolesConfig tbody tr').find('td:eq(2) input[type="checkbox"]').length;
            let checkedboxesCreate = $('#tbl_rolesConfig tbody tr').find('td:eq(2) input:checked[type="checkbox"]').length;
            $('#chk_create').prop('checked',(checkboxesCreate == checkedboxesCreate)? true : false);

            let checkboxesEdit = $('#tbl_rolesConfig tbody tr').find('td:eq(3) input[type="checkbox"]').length;
            let checkedboxesEdit = $('#tbl_rolesConfig tbody tr').find('td:eq(3) input:checked[type="checkbox"]').length;
            $('#chk_edit').prop('checked',(checkboxesEdit == checkedboxesEdit)? true : false);

            let checkboxesDelete = $('#tbl_rolesConfig tbody tr').find('td:eq(4) input[type="checkbox"]').length;
            let checkedboxesDelete = $('#tbl_rolesConfig tbody tr').find('td:eq(4) input:checked[type="checkbox"]').length;
            $('#chk_delete').prop('checked',(checkboxesDelete == checkedboxesDelete)? true : false);

            $('#lbl_modalTitle').html('<i class="feather-edit-3 me-2"></i> Edit Role');
            $('#modal_roles').modal('show');
        });
    }

    thisUser.loadUsers = function()
    {
        AJAXHELPER.getData({
            // UserController->loadAdminUsers
            'route' : 'portal/admin/load-admin-users',
            'data'  : null
        }, function(data){
            let tbody = "";
            data.forEach(function(value, key){
                let status = (value['user_status'] == 1)? 'success' : 'warning';
                tbody += `<tr class="single-item">
                            <td>
                                ${value['first_name']} ${value['last_name']}
                            </td>
                            <td><a href="javascript:void(0)">${value['email_address']}</a></td>
                            <td><a href="tel:">${value['mobile_number']}</a></td>
                            <td>${value['role_name']}</td>
                            <td>
                                <span class="badge bg-soft-${status} text-${status}">
                                    ${(value['user_status'] == "1")? 'Active' : 'Inactive'}
                                </span>
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Actions <i class="mdi mdi-chevron-down"></i>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="">
                                        <a class="dropdown-item" href="javascript:void(0)" onclick="USERS.selectUser(${value['id']})">
                                            <i class="feather feather-edit-3 me-3"></i>
                                            <span>Edit</span>
                                        </a>
                                        <a class="dropdown-item" href="javascript:void(0)" onclick="USERS.removeUser(${value['id']})">
                                            <i class="feather feather-trash-2 me-3"></i>
                                            <span>Delete</span>
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>`;
            });
            $("#tbl_users").DataTable().destroy();
            $('#tbl_users tbody').html(tbody);
            $("#tbl_users").DataTable({pageLength:10,lengthMenu:[10,20,50,100,200,500]});
        });
    }

    thisUser.addUser = function(thisForm)
    {
        let arrAccessModules = [];
        $('#tbl_rolesConfig tbody tr.module').each(function(){
          
            let moduleStatus = ($(this).find('td:eq(0) input[type="checkbox"]').is(':checked'))? 1 : 0;

            let viewStatus = ($(this).find('td:eq(1) input[type="checkbox"]').is(':checked'))? 1 : 0;
            let createStatus = ($(this).find('td:eq(2) input[type="checkbox"]').is(':checked'))? 1 : 0;
            let editStatus = ($(this).find('td:eq(3) input[type="checkbox"]').is(':checked'))? 1 : 0;
            let deleteStatus = ($(this).find('td:eq(4) input[type="checkbox"]').is(':checked'))? 1 : 0;

            let fields = [];
            $(this).next().find('input.fields').each(function(){
                fields.push($(this).val());
            });

            rowData = [
                [moduleStatus],
                [viewStatus,createStatus,editStatus,deleteStatus],
                fields
            ];

            arrAccessModules.push(rowData);
        });

        let formData = new FormData(thisForm);
        formData.set("arrAccessModules", JSON.stringify(arrAccessModules));

        $('#btn_saveUser').prop('disabled',true);
        
        AJAXHELPER.postData({
            // UserController->addAdminUser
            'route' : 'portal/admin/add-admin-user',
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

    thisUser.selectUser = function(userId)
    {
        AJAXHELPER.getData({
            // UserController->selectAdminUser
            'route' : 'portal/admin/select-admin-user',
            'data'  : {
                'userId' : userId
            }
        }, function(data){
            $('#txt_userId').val(data['id']);
            $('#txt_firstName').val(data['first_name']);
            $('#txt_lastName').val(data['last_name']);
            $('#txt_emailAddress').val(data['email_address']);
            $('#txt_mobileNumber').val(data['mobile_number']);
            let options = '';
            options += `<option value="1" data-bg="bg-success" ${(data['user_status'] == "1")? 'selected':''}>Active</option>`;
            options += `<option value="0" data-bg="bg-warning" ${(data['user_status'] == "0")? 'selected':''}>Inactive</option>`;
            $('#slc_status').html(options);
            USERS.loadRoles(data['role_id']);

            let count = 0;
            let moduleStatusChecked = 0;
            let moduleStatus = false;
            $('#tbl_rolesConfig tbody tr.module').each(function(){          
                if(data['access_modules'][count][0][0] == 1)
                {
                    moduleStatus = true;
                    moduleStatusChecked++;
                }
                else 
                {
                    moduleStatus = false;
                }

                $(this).find('td:eq(0) input[type="checkbox"]').prop('checked',moduleStatus);

                $(this).find('td:eq(1) input[type="checkbox"]').prop('checked',(data['access_modules'][count][1][0])? true : false);
                $(this).find('td:eq(2) input[type="checkbox"]').prop('checked',(data['access_modules'][count][1][1])? true : false);
                $(this).find('td:eq(3) input[type="checkbox"]').prop('checked',(data['access_modules'][count][1][2])? true : false);
                $(this).find('td:eq(4) input[type="checkbox"]').prop('checked',(data['access_modules'][count][1][3])? true : false);

                if(data['access_modules'][count][1].includes(1))
                {
                    $(this).find('td:eq(5) button.btn_modules').prop('disabled',false);
                }
                else
                {
                    $(this).find('td:eq(5) button.btn_modules').prop('disabled',true);
                }

                count++;
            });

            moduleStatus = (moduleStatusChecked == count)? true : false;
            $('#tbl_rolesConfig thead tr td:eq(0)').find('input[type="checkbox"]').prop('checked',moduleStatus);

            let checkboxesView = $('#tbl_rolesConfig tbody tr').find('td:eq(1) input[type="checkbox"]').length;
            let checkedboxesView = $('#tbl_rolesConfig tbody tr').find('td:eq(1) input:checked[type="checkbox"]').length;
            $('#chk_view').prop('checked',(checkboxesView == checkedboxesView)? true : false);

            let checkboxesCreate = $('#tbl_rolesConfig tbody tr').find('td:eq(2) input[type="checkbox"]').length;
            let checkedboxesCreate = $('#tbl_rolesConfig tbody tr').find('td:eq(2) input:checked[type="checkbox"]').length;
            $('#chk_create').prop('checked',(checkboxesCreate == checkedboxesCreate)? true : false);

            let checkboxesEdit = $('#tbl_rolesConfig tbody tr').find('td:eq(3) input[type="checkbox"]').length;
            let checkedboxesEdit = $('#tbl_rolesConfig tbody tr').find('td:eq(3) input:checked[type="checkbox"]').length;
            $('#chk_edit').prop('checked',(checkboxesEdit == checkedboxesEdit)? true : false);

            let checkboxesDelete = $('#tbl_rolesConfig tbody tr').find('td:eq(4) input[type="checkbox"]').length;
            let checkedboxesDelete = $('#tbl_rolesConfig tbody tr').find('td:eq(4) input:checked[type="checkbox"]').length;
            $('#chk_delete').prop('checked',(checkboxesDelete == checkedboxesDelete)? true : false);

            $('#div_userRoleConfiguration').prop('hidden',false);

            $('#lbl_modalTitle').html(`<i class="feather-edit-3 me-2"></i> Edit User`);
            $('#modal_users').modal('show');
        });
    }

    thisUser.editUser = function(thisForm)
    {
        let arrAccessModules = [];
        $('#tbl_rolesConfig tbody tr.module').each(function(){
          
            let moduleStatus = ($(this).find('td:eq(0) input[type="checkbox"]').is(':checked'))? 1 : 0;

            let viewStatus = ($(this).find('td:eq(1) input[type="checkbox"]').is(':checked'))? 1 : 0;
            let createStatus = ($(this).find('td:eq(2) input[type="checkbox"]').is(':checked'))? 1 : 0;
            let editStatus = ($(this).find('td:eq(3) input[type="checkbox"]').is(':checked'))? 1 : 0;
            let deleteStatus = ($(this).find('td:eq(4) input[type="checkbox"]').is(':checked'))? 1 : 0;

            let fields = [];
            $(this).next().find('input.fields').each(function(){
                fields.push($(this).val());
            });

            rowData = [
                [moduleStatus],
                [viewStatus,createStatus,editStatus,deleteStatus],
                fields
            ];

            arrAccessModules.push(rowData);
        });

        let formData = new FormData(thisForm);
        formData.set("arrAccessModules", JSON.stringify(arrAccessModules));

        $('#btn_saveUser').prop('disabled',true);

        AJAXHELPER.postData({
            // UserController->editAdminUser
            'route' : 'portal/admin/edit-admin-user',
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

    thisUser.removeUser = function(userId)
    {
        if(confirm('Please Confirm!'))
        {
            AJAXHELPER.removeData({
                // UserController->removeAdminUser
                'route' : 'portal/admin/remove-admin-user',
                'data'  : {
                    'userId' : userId
                }
            }, function(data){
                COMMONHELPER.Toaster('success',data[0]);
                setTimeout(function(){
                    window.location.replace(`${baseUrl}portal/admin/maintenance-users`);
                }, 1000);
            }, function(data){
                COMMONHELPER.Toaster('error',data['responseJSON'][0]);
            });
        }
    }

    return thisUser;

})();