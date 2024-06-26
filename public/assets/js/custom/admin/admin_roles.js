
const ROLES = (function(){

    let thisRole = {};

    let baseUrl = $('#txt_baseUrl').val();

    thisRole.loadRoles = function()
    {
        AJAXHELPER.loadData({
            'route' : 'portal/admin/load-admin-roles',
            'data'  : {
                'sample' : 'sample'
            }
        }, function(data){
            let tbody = '';
            data.forEach(function(value,key){
                tbody += `<tr class="single-item">
                            <td>
                                <span class="text-truncate-1-line"><b>${value['role_name']}</b></span>
                            </td>
                            <td>${value['role_description']}</td>
                            <td>${value['role_status']}</td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Actions <i class="mdi mdi-chevron-down"></i>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="">
                                        <a class="dropdown-item" href="javascript:void(0)" onclick="ROLES.copyRole(${value['id']})">
                                            <i class="feather feather-copy me-3"></i>
                                            <span>Copy</span>
                                        </a>
                                        <a class="dropdown-item" href="javascript:void(0)" onclick="ROLES.selectRole(${value['id']});">
                                            <i class="feather feather-edit-3 me-3"></i>
                                            <span>Edit</span>
                                        </a>
                                        <a class="dropdown-item" href="javascript:void(0)" onclick="ROLES.removeRole(${value['id']})">
                                            <i class="feather feather-trash-2 me-3"></i>
                                            <span>Delete</span>
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>`;
            });

            $("#tbl_roles").DataTable().destroy();
            $('#tbl_roles tbody').html(tbody);
            $("#tbl_roles").DataTable({pageLength:10,lengthMenu:[10,20,50,100,200,500]});
        });
    }

    thisRole.addRole = function(thisForm)
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

        $('#btn_saveRole').prop('disabled',true);

        AJAXHELPER.addData({
            'route' : 'portal/admin/add-admin-role',
            'data'  : formData
        }, function(data){
            COMMONHELPER.Toaster('success',data[0]);
            setTimeout(function(){
                $('#btn_saveRole').prop('disabled',false);
                window.location.replace(`${baseUrl}portal/admin/maintenance-roles`);
            }, 1000);
        }, function(data){ // Error
            COMMONHELPER.Toaster('error',data['responseJSON'][0]);
            $('#btn_saveRole').prop('disabled',false);
        });
    }

    thisRole.copyRole = function(roleId)
    {
        AJAXHELPER.selectData({
            'route' : 'portal/admin/select-admin-role',
            'data'  : {
                'roleId' : roleId
            }
        }, function(data){

            $('#txt_roleId').val('');
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

            $('#lbl_modalTitle').html('<i class="feather-copy me-2"></i> Copy Role');
            $('#modal_roles').modal('show');

        });
    }

    thisRole.selectRole = function(roleId)
    {
        AJAXHELPER.selectData({
            'route' : 'portal/admin/select-admin-role',
            'data'  : {
                'roleId' : roleId
            }
        }, function(data){

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

    thisRole.editRole = function(thisForm)
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

        $('#btn_saveRole').prop('disabled',true);

        AJAXHELPER.editData({
            'route' : 'portal/admin/edit-admin-role',
            'data'  : formData
        }, function(data){
            COMMONHELPER.Toaster('success',data[0]);
            setTimeout(function(){
                $('#btn_saveRole').prop('disabled',false);
                window.location.replace(`${baseUrl}portal/admin/maintenance-roles`);
            }, 1000);
        }, function(data){ // Error
            COMMONHELPER.Toaster('error',data['responseJSON'][0]);
            $('#btn_saveRole').prop('disabled',false);
        });
    }

    thisRole.removeRole = function(roleId)
    {
        if(confirm('Please confirm!'))
        {
            AJAXHELPER.removeData({
                'route' : 'portal/admin/remove-admin-role',
                'data'  : {
                    'roleId' : roleId
                }
            }, function(data){
                COMMONHELPER.Toaster('success',data[0]);
                setTimeout(function(){
                    window.location.replace(`${baseUrl}portal/admin/maintenance-roles`);
                }, 1000);
            }, function(data){ // Error
                COMMONHELPER.Toaster('error',data['responseJSON'][0]);
            });
        }
    }

    return thisRole;

})();