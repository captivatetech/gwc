
const REPRESENTATIVE_SALARY_ADVANCE_APPLICATIONS = (function(){

    let thisRepresentativeSalaryAdvanceApplications = {};

    let baseUrl = $('#txt_baseUrl').val();

    thisRepresentativeSalaryAdvanceApplications.r_loadSalaryAdvanceApplications = function()
    {
        AJAXHELPER.getData({
            // LoanController->r_loadSalaryAdvanceApplications
            'route' : '/portal/representative/r-load-salary-advance-applications',
            'data'  : null
        }, function(data){
            let tbody = '';
            data.forEach(function(value,index){
                tbody += `<tr>
                            <td>${value['created_date']}</td>
                            <td>${value['application_number']}</td>
                            <td>${value['last_name']}, ${value['first_name']}</td>
                            <td>${value['application_status']}</td>
                            <td style="text-align:right;">Php. ${COMMONHELPER.numberWithCommas(value['loan_amount'])}</td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Actions <i class="mdi mdi-chevron-down"></i>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="javascript:void(0)" onclick="REPRESENTATIVE_SALARY_ADVANCE_APPLICATIONS.r_selectLoanApplicationDetails(${value['id']})">Update</a>
                                        <a class="dropdown-item" href="javascript:void(0)" onclick="REPRESENTATIVE_SALARY_ADVANCE_APPLICATIONS.r_loadLoanApplicationDocuments(${value['id']})">View & Print Documents</a>
                                    </div>
                                </div>
                            </td>
                        </tr>`;
            });
            $('#tbl_salaryAdvanceApplications').DataTable().destroy();
            $('#tbl_salaryAdvanceApplications tbody').html(tbody);
            $('#tbl_salaryAdvanceApplications').DataTable();
        });
    }

    thisRepresentativeSalaryAdvanceApplications.r_selectLoanApplicationDetails = function(loanId)
    {
        $('#modal_loanApplicationDetails').modal('show');
        AJAXHELPER.getData({
            // LoanController->r_selectLoanApplicationDetails
            'route' : '/portal/representative/r-select-loan-application-details',
            'data'  : {
                loanId : loanId
            }
        }, function(data){
            $('#txt_loanId').val(data['id']);

            $('#lnk_downloadDocument').attr('onclick',`REPRESENTATIVE_SALARY_ADVANCE_APPLICATIONS.r_downloadDocument('${data['request_id']}')`);

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

    thisRepresentativeSalaryAdvanceApplications.r_loadLoanApplicationDocuments = function(loanId)
    {
        $('#modal_loanApplicationDocuments').modal('show');
    }

    thisRepresentativeSalaryAdvanceApplications.r_downloadDocument = function(requestId)
    {
        // TestController->testDownloadDocument()
        window.open(`${baseUrl}test-download-document/${requestId}`, "_blank");
    }

    thisRepresentativeSalaryAdvanceApplications.r_submitSalaryAdvanceApplication = function()
    {
        let formData = new FormData();
        formData.set('loanId', $('#txt_loanId').val());

        $('#btn_rejectApplication').prop('disabled',true);
        AJAXHELPER.postData({
            // LoanController->r_submitSalaryAdvanceApplication()
            'route' : 'portal/representative/r-submit-salary-advance-application',
            'data'  : formData
        }, function(data){
            COMMONHELPER.Toaster('success',data[0]);
            setTimeout(function(){
                $('#btn_rejectApplication').prop('disabled',false);
                window.location.replace(`${baseUrl}portal/representative/salary-advance-applications`);
            }, 1000);
        }, function(data){ 
            COMMONHELPER.Toaster('error',data['responseJSON'][0]);
            $('#btn_rejectApplication').prop('disabled',false);
        });
    }

    return thisRepresentativeSalaryAdvanceApplications;

})();