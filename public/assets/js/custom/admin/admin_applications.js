
const ADMIN_APPLICATIONS = (function(){

    let thisAdminApplications = {};

    let baseUrl = $('#txt_baseUrl').val();


    thisAdminApplications.a_loadApplications = function()
    {
        AJAXHELPER.getData({
            // LoanController->a_loadApplications
            'route' : 'portal/admin/a-load-applications',
            'data'  : null
        }, function(data){
            let tbody = '';
            data.forEach(function(value,index){
                let applicationStatus = "";
                if(value['application_status'] == 'PROCESSING')
                {
                    applicationStatus = 'PENDING';
                }
                else
                {
                    applicationStatus = value['application_status'];
                }
                tbody += `<tr>
                            <td>${value['created_date']}</td>
                            <td>${value['application_number']}</td>
                            <td>Salary Advance</td>
                            <td>${value['last_name']}, ${value['first_name']}</td>
                            <td>${value['company_name']}</td>
                            <td style="text-align:right;">${COMMONHELPER.numberWithCommas(value['loan_amount'])}</td>
                            <td>${applicationStatus}</td>
                            <td>                                                        
                                <a href="javascript:void(0)" onclick="ADMIN_APPLICATIONS.a_selectApplication(${value['id']})">Update</a>
                            </td>`;
            });
            $('#tbl_applications').DataTable().destroy();
            $('#tbl_applications tbody').html(tbody);
            $('#tbl_applications').DataTable({'scrollX':true});
        });
    }

    thisAdminApplications.a_selectApplication = function(loanId)
    {
        $('#modal_loanApplicationDetails').modal('show');
        AJAXHELPER.getData({
            // LoanController->a_selectApplication
            'route' : 'portal/admin/a-select-application',
            'data'  : {
                loanId : loanId
            }
        }, function(data){
            $('#txt_loanId').val(data['id']);

            $('#lnk_downloadDocument').attr('onclick',`ADMIN_APPLICATIONS.a_downloadDocument('${data['request_id']}')`);
            
            $('#txt_applicationDate').val(data['created_date']);
            $('#txt_applicationNumber').val(data['application_number']);
            $('#txt_employeeName').val(`${data['last_name']}, ${data['first_name']}`);
            $('#txt_idNumber').val(data['identification_number']);
            $('#txt_department').val(data['department']);
            $('#txt_position').val(data['position']);

            $('#txt_loanAmount').val(COMMONHELPER.numberWithCommas(data['loan_amount']));
            $('#txt_paymentTerms').val(`${data['payment_terms']} month/s`);
            $('#txt_purposeOfLoan').val(data['purpose_of_loan']);

            $('#lbl_loanAmount').text(COMMONHELPER.numberWithCommas(data['loan_amount']));
            $('#lbl_processingFee').text('300.00');
            $('#lbl_amountToReceive').text(COMMONHELPER.numberWithCommas(data['amount_to_receive']));

            let interest = (parseFloat(data['total_interest']) / parseFloat(data['loan_amount'])) * 100;

            $('#lbl_totalInterest').text(`${interest}%`);
            $('#lbl_paymentTerms').text(`${data['payment_terms']} month/s`);
            $('#lbl_numberOfDeductions').text(data['number_of_deductions']);
            $('#lbl_monthlyDues').text(COMMONHELPER.numberWithCommas(data['monthly_dues']));
            $('#lbl_deductionPerCutOff').text(COMMONHELPER.numberWithCommas(data['deduction_per_cutoff']));
        });
    }

    thisAdminApplications.a_downloadDocument = function(requestId)
    {
        // TestController->testDownloadDocument();
        window.open(`${baseUrl}test-download-document/${requestId}`, "_blank");
    }

    thisAdminApplications.a_approveApplication = function()
    {
        let formData = new FormData();
        formData.set('loanId', $('#txt_loanId').val());

        $('#btn_approveApplication').prop('disabled',true);

        AJAXHELPER.postData({
            // LoanController::a_approveApplication()
            'route' : 'portal/admin/a-approve-application',
            'data'  : formData
        }, function(data){
            COMMONHELPER.Toaster('success',data[0]);
            setTimeout(function(){
                $('#btn_approveApplication').prop('disabled',false);
                window.location.replace(`${baseUrl}portal/admin/applications`);
            }, 1000);
        }, function(data){
            COMMONHELPER.Toaster('error',data['responseJSON'][0]);
            $('#btn_approveApplication').prop('disabled',false);
        });
    }

    thisAdminApplications.a_rejectApplication = function()
    {
        let formData = new FormData();
        formData.set('loanId', $('#txt_loanId').val());

        $('#btn_rejectApplication').prop('disabled',true);

        AJAXHELPER.postData({
            // LoanController::a_rejectApplication()
            'route' : 'portal/admin/a-reject-application',
            'data'  : formData
        }, function(data){
            COMMONHELPER.Toaster('success',data[0]);
            setTimeout(function(){
                $('#btn_rejectApplication').prop('disabled',false);
                window.location.replace(`${baseUrl}portal/admin/applications`);
            }, 1000);
        }, function(data){ 
            COMMONHELPER.Toaster('error',data['responseJSON'][0]);
            $('#btn_rejectApplication').prop('disabled',false);
        });
    }


    return thisAdminApplications;

})();