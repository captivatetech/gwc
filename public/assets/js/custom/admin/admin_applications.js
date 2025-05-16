
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

            let loanAmount = parseFloat(data['loan_amount']);
            let paymentTerms = parseInt(data['payment_terms']);
            let monthlyInterestPercent = parseFloat(data['interest_rate']);

            let totalLoan = 0;
            let interest = 0;
            let totalInterestRate = 0;
            let totalInterest = 0;

            let serviceFee = 0;
            let docStamp = 0;
            let notarialFee = 500;
            let insurance = 0;
            let totalFees = 0;

            let amountToReceive = 0;
            let numberOfDeductions = 0;
            let monthlyDues = 0;
            let deductionPerCufOff = 0;

            $('#txt_loanAmount').val(COMMONHELPER.numberWithCommas(data['loan_amount']));
            $('#txt_paymentTerms').val(`${data['payment_terms']} month/s`);
            $('#txt_purposeOfLoan').val(data['purpose_of_loan']);

            $('#lbl_loanAmount').text(COMMONHELPER.numberWithCommas(data['loan_amount']));
            $('#lbl_paymentTerms').text(COMMONHELPER.numberWithCommas(data['payment_terms']));
            $('#lbl_monthlyInterestPercent').text(`${monthlyInterestPercent} %`);
            totalInterestRate = parseFloat(monthlyInterestPercent) * parseInt(paymentTerms);
            $('#lbl_totalInterestPercent').text(`${totalInterestRate} %`);
            totalInterest = parseFloat(loanAmount) * (totalInterestRate / 100);
            $('#lbl_totalInterest').text(`${COMMONHELPER.numberWithCommas((totalInterest).toFixed(2))}`);

            serviceFee = parseFloat(loanAmount) * 0.02;
            $('#lbl_serviceFee').text(`${COMMONHELPER.numberWithCommas((serviceFee).toFixed(2))}`);
            docStamp = parseFloat(loanAmount) * 0.0175;
            $('#lbl_documentStamp').text(`${COMMONHELPER.numberWithCommas((docStamp).toFixed(2))}`);
            $('#lbl_notarialFee').text(`${(notarialFee).toFixed(2)}`);
            if(parseInt(data['employee_age']) < 60)
            {
                insurance = parseFloat(loanAmount) / 1000 * 13;
                $('#lbl_insurance').text(`${(insurance).toFixed(2)}`);
            }
            else
            {
                insurance = 0;
                $('#lbl_insurance').html(`<i>Not Applicable</i>`);
            }
            totalFees = serviceFee + docStamp + notarialFee + insurance;
            $('#lbl_totalFees').text(`${(totalFees).toFixed(2)}`);

            amountToReceive = parseFloat(loanAmount) - totalFees;
            $('#lbl_amountToReceive').text(COMMONHELPER.numberWithCommas(parseFloat(amountToReceive).toFixed(2)));  
            numberOfDeductions = parseInt(paymentTerms) * 2;
            $('#lbl_numberOfDeductions').text(numberOfDeductions);
            totalLoan = parseFloat(loanAmount) + totalInterest;
            monthlyDues = totalLoan / parseInt(paymentTerms);
            $('#lbl_monthlyDues').text(COMMONHELPER.numberWithCommas(parseFloat(monthlyDues).toFixed(2)));
            deductionPerCufOff = monthlyDues / 2;
            $('#lbl_deductionPerCutOff').text(COMMONHELPER.numberWithCommas(parseFloat(deductionPerCufOff).toFixed(2)));

            $('#lbl_employeeActionStatus').text(data['employee_action_status']);
            $('#lbl_representativeActionStatus').text(data['representative_action_status']);
            $('#lbl_adminActionStatus').text(data['admin_action_status']);

            if(data['application_status'] == 'APPROVED')
            {
                $('#div_footer').prop('hidden',true);
                $('#btn_approveApplication').prop('disabled',true);
            }
            else
            {
                if(data['admin_action_status'] == 'SIGNED')
                {
                    $('#div_footer').prop('hidden',false);
                    $('#btn_approveApplication').prop('disabled',false);
                }
                else
                {
                    $('#div_footer').prop('hidden',true);
                    $('#btn_approveApplication').prop('disabled',true);
                }
            }            
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
                window.location.replace(`${baseUrl}portal/admin/salary-advance-applications`);
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
                window.location.replace(`${baseUrl}portal/admin/salary-advance-applications`);
            }, 1000);
        }, function(data){ 
            COMMONHELPER.Toaster('error',data['responseJSON'][0]);
            $('#btn_rejectApplication').prop('disabled',false);
        });
    }


    return thisAdminApplications;

})();