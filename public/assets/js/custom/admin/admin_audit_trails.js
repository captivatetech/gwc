const ADMIN_AUDIT_TRAILS = (function(){

    let thisAdminAuditTrails = {};

    let baseUrl = $('#txt_baseUrl').val();

    thisAdminAuditTrails.a_loadAuditTrails = function()
    {
        AJAXHELPER.getData({
            // AuditTrailController->a_loadAuditTrails
            'route' : 'portal/admin/a-load-audit-trails',
            'data'  : null
        }, function(data){
            
            let tbody = '';
            data.forEach(function(value, index){
                tbody += `<tr>
                    <td>${value['user_id']}</td>
                    <td>${value['module_name']}</td>
                    <td>${value['activity_type']}</td>
                    <td>${value['created_date']}</td>
                </tr>`;
            });
            $('#tbl_auditTrails').DataTable().destroy();
            $('#tbl_auditTrails tbody').html(tbody);
            $('#tbl_auditTrails').DataTable({'scrollX':true, "order": [[ 0, "desc" ]]});
            
        });
    }

    return thisAdminAuditTrails;

})();