
const ADMIN_PARTNERS_LIST = (function(){

    let thisAdminPartnersList = {};

    let baseUrl = $('#txt_baseUrl').val();

    thisAdminPartnersList.a_loadPartnersList = function()
    {
        AJAXHELPER.getData({
            // PaymentController->a_loadPartnersList
            'route' : 'portal/admin/a-load-partners-list',
            'data'  : null
        }, function(data){
            let tbody = '';
            data.forEach(function(value,index){
                // let subscriptionStatus = '';
                // if(value['subscription_status'] == 'PENDING')
                // {
                //     subscriptionStatus = `<span class="text-warning">${value['subscription_status']}</span>`;
                // }
                // else if(value['subscription_status'] == 'APPROVE')
                // {
                //     subscriptionStatus = `<span class="text-success">${value['subscription_status']}</span>`;
                // }
                // else
                // {
                //     subscriptionStatus = `<span class="text-danger">${value['subscription_status']}</span>`;
                // }
                let website = `<a href="${value['company_website']}" target="_blank">${value['company_website']}</a>`
                tbody += `<tr>
                            <td>${value['company_code']}</td>
                            <td>${value['company_name']}</td>
                            <td>${value['company_email']}</td>
                            <td>${value['mobile_number']}</td>
                            <td>${website}</td>
                            <td>${value['business_type']}</td>
                            <td>${value['business_industry']}</td>
                        </tr>`;
            });
            $('#tbl_partnersList').DataTable().destroy();
            $('#tbl_partnersList tbody').html(tbody);
            $('#tbl_partnersList').DataTable();
        });
    }

    return thisAdminPartnersList;

})();