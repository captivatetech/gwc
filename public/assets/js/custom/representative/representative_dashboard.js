
const REPRESENTATIVE_DASHBOARD = (function(){

    let thisRepresentativeDashboard = {};

    thisRepresentativeDashboard.r_loadBillings = function()
    {
        AJAXHELPER.getData({
            // BillingController->r_loadBillings
            'route' : 'portal/representative/r-load-billings',
            'data'  : null
        }, function(data){
            let tbody = '';
            data.forEach(function(value,index){
                tbody += `<tr>
                            <td>${value['billing_date']}</td>
                            <td>${value['billing_number']}</td>
                            <td style="text-align:right;">Php.${COMMONHELPER.numberWithCommas(value['total_amount'])}</td>
                            <td style="text-align:right;">Php. ${COMMONHELPER.numberWithCommas(value['total_paid'])}</td>
                            <td style="text-align:right;">Php. ${COMMONHELPER.numberWithCommas(value['balance'])}</td>
                            <td>${value['due_date']}</td>
                            <td>${value['payment_status']}</td>
                        </tr>`;
            });
            $('#tbl_billings').DataTable().destroy();
            $('#tbl_billings tbody').html(tbody);
            $('#tbl_billings').DataTable({'scrollX':true, "order": [[ 0, "desc" ]]});
        });
    }

    return thisRepresentativeDashboard;

})();