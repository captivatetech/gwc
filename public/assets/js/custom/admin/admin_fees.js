
const ADMIN_FEES = (function(){

    let thisAdminFees = {};

    let baseUrl = $('#txt_baseUrl').val();

    thisAdminFees.loadFees = function()
    {
        AJAXHELPER.getData({
            // FeeController->loadAdminFees
            'route' : 'portal/admin/load-admin-fees',
            'data'  : null
        }, function(data){
            let tbody = '';
            data.forEach(function(value, index){
                let feeStatus = (value['fee_status'] == '1')? `<span class="text-success">Active</span>` : `<span class="text-danger">Inactive</span>`;
                tbody += `<tr>
                            <td>${value['type']}</td>
                            <td>${COMMONHELPER.numberWithCommas(parseFloat(value['amount']).toFixed(2))}</td>
                            <td>${feeStatus}</td>
                            <td>                                                        
                                <div class="dropdown">
                                    <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Actions <i class="mdi mdi-chevron-down"></i>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="javascript:void(0)" onclick="ADMIN_FEES.selectFee(${value['id']})">Edit</a>
                                        <a class="dropdown-item" href="javascript:void(0)" onclick="ADMIN_FEES.removeFee(${value['id']})">Delete</a>
                                    </div>
                                </div>
                            </td>
                        </tr>`;
            });
            $('#tbl_fees').DataTable().destroy();
            $('#tbl_fees tbody').html(tbody);
            $('#tbl_fees').DataTable();
        });
    }

    thisAdminFees.addFee = function(thisForm)
    {
        let formData = new FormData(thisForm);
        $('#btn_saveFee').prop('disabled',true);
        AJAXHELPER.postData({
            // FeeController->addAdminFee
            'route' : 'portal/admin/add-admin-fee',
            'data'  : formData
        }, function(data){
            COMMONHELPER.Toaster('success',data[0]);
            setTimeout(function(){
                $('#btn_saveFee').prop('disabled',false);
                window.location.replace(`${baseUrl}portal/admin/maintenance-fees`);
            }, 1000);
        }, function(data){
            COMMONHELPER.Toaster('error',data['responseJSON'][0]);
            $('#btn_saveFee').prop('disabled',false);
        });
    }

    thisAdminFees.selectFee = function(feeId)
    {
        $('#modal_fees').modal('show');
        AJAXHELPER.getData({
            // FeeController->selectAdminFee
            'route' : 'portal/admin/select-admin-fee',
            'data'  : {feeId : feeId}
        }, function(data){
            $('#txt_feeId').val(data['id']);
            $('#txt_feeType').val(data['type']);
            $('#txt_feeAmount').val(data['amount']);
            $('#slc_feeStatus').val(data['fee_status']);
        });
    }

    thisAdminFees.editFee = function(thisForm)
    {
        let formData = new FormData(thisForm);
        $('#btn_saveFee').prop('disabled',true);
        AJAXHELPER.postData({
            // FeeController->editAdminFee
            'route' : 'portal/admin/edit-admin-fee',
            'data'  : formData
        }, function(data){
            COMMONHELPER.Toaster('success',data[0]);
            setTimeout(function(){
                $('#btn_saveFee').prop('disabled',false);
                window.location.replace(`${baseUrl}portal/admin/maintenance-fees`);
            }, 1000);
        }, function(data){
            COMMONHELPER.Toaster('error',data['responseJSON'][0]);
            $('#btn_saveFee').prop('disabled',false);
        });
    }

    thisAdminFees.removeFee = function(feeId)
    {
        if(confirm('Please Confirm!'))
        {
            AJAXHELPER.removeData({
                // FeeController->removeAdminFee
                'route' : 'portal/admin/remove-admin-fee',
                'data'  : {feeId : feeId}
            }, function(data){
                COMMONHELPER.Toaster('success',data[0]);
                setTimeout(function(){
                    window.location.replace(`${baseUrl}portal/admin/maintenance-fees`);
                }, 1000);
            }, function(data){
                COMMONHELPER.Toaster('error',data['responseJSON'][0]);
            });
        }
    }

    return thisAdminFees;

})();