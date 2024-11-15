
const EMPLOYEE_DASHBOARD = (function(){

    let thisEmployeeDashboard = {};

    let baseUrl = $('#txt_baseUrl').val();

    let _persona = '';
    let _interestRate = 0;
    let _arrAnswers = [];
    let _totalScore = 0;

    thisEmployeeDashboard.e_loadCreditLimit = function()
    {
        AJAXHELPER.getData({
            // EmployeeController->e_loadCreditLimit();
            'route' : 'portal/employee/e-load-credit-limit',
            'data'  : null
        }, function(data){
            $("#rng_creditLimitViewing").ionRangeSlider({
                type: "single",
                min: parseInt(data['minimum_credit_amount']),
                max: parseInt(data['maximum_credit_amount']),
                from_min: parseInt(data['max_loanable_amount']),
                from_max: parseInt(data['max_loanable_amount']),
                from_shadow: true,
                grid: true,
                step: 500
            });
        });
    }

    thisEmployeeDashboard.e_loadCreditDetails = function()
    {

    }

    thisEmployeeDashboard.e_loadPreferedLangauge = function()
    {
        $('#modal_preferedLangauge').modal('show');
    }

    thisEmployeeDashboard.e_choosePreferedLangauge = function(preferedLanguage)
    {
        $('#modal_preferedLangauge').modal('hide');
        AJAXHELPER.getData({
            // QuestionaireController->e_choosePreferedLangauge();
            'route' : 'portal/employee/e-choose-prefered-language',
            'data'  : {
                preferedLanguage : preferedLanguage
            }
        }, function(data){
            //question 1
            $('#lbl_question1').text(data[0][0]);
            $('#lbl_answer1A-5').text(data[0][1]);
            $('#lbl_answer1B-3').text(data[0][2]);
            $('#lbl_answer1C-0').text(data[0][3]);

            // question 2
            $('#lbl_question2Example').text(data[1][5]);
            $('#lbl_question2ExampleList li:eq(0)').text(data[1][5][0]);
            $('#lbl_question2ExampleList li:eq(1)').text(data[1][5][1]);
            $('#lbl_question2ExampleList li:eq(2)').text(data[1][5][2]);
            $('#lbl_question2').text(data[1][0]);
            $('#lbl_answer2A-5').text(data[1][1]);
            $('#lbl_answer2B-4').text(data[1][2]);
            $('#lbl_answer2C-1').text(data[1][3]);
            $('#lbl_answer2D-0').text(data[1][4]);

            // question 3
            $('#lbl_question3').text(data[2][0]);
            $('#lbl_answer3A-1').text(data[2][1]);
            $('#lbl_answer3B-3').text(data[2][2]);
            $('#lbl_answer3C-5').text(data[2][3]);

            // question 4
            $('#lbl_question4').text(data[3][0]);
            $('#lbl_answer4A-1').text(data[3][1]);
            $('#lbl_answer4B-3').text(data[3][2]);
            $('#lbl_answer4C-3').text(data[3][3]);
            $('#lbl_answer4D-5').text(data[3][4]);

            // question 5
            $('#lbl_question5').text(data[4][0]);
            $('#lbl_answer5A-1').text(data[4][1]);
            $('#lbl_answer5B-2').text(data[4][2]);
            $('#lbl_answer5C-3').text(data[4][3]);
            $('#lbl_answer5D-5').text(data[4][4]);
            $('#lbl_answer5E-0').text(data[4][5]);

            // question 6
            $('#lbl_question6').text(data[5][0]);
            $('#lbl_answer6A-1').text(data[5][1]);
            $('#lbl_answer6B-1').text(data[5][2]);
            $('#lbl_answer6C-3').text(data[5][3]);
            $('#lbl_answer6D-5').text(data[5][4]);
            $('#lbl_answer6E-0').text(data[5][5]);

            // question 7
            $('#lbl_question7').text(data[6][0]);
            $('#lbl_answer7A-1').text(data[6][1]);
            $('#lbl_answer7B-3').text(data[6][2]);
            $('#lbl_answer7C-5').text(data[6][3]);
            $('#lbl_answer7D-0').text(data[6][4]);

            // reviewAnswer
            $('#h6_question1').text(`1) ${data[0][0]}`);
            $('#h6_question2').text(`2) ${data[1][0]}`);
            $('#h6_question3').text(`3) ${data[2][0]}`);
            $('#h6_question4').text(`4) ${data[3][0]}`);
            $('#h6_question5').text(`5) ${data[4][0]}`);
            $('#h6_question6').text(`6) ${data[5][0]}`);
            $('#h6_question7').text(`7) ${data[6][0]}`);

            EMPLOYEE_DASHBOARD.e_openLoanReadinessAssessmentModal();
        });
    }

    thisEmployeeDashboard.e_openLoanReadinessAssessmentModal = function()
    {
        $('#modal_loanReadinessAssessment').modal('show');
    }

    thisEmployeeDashboard.e_submitLoanReadinessAssessment = function(thisForm)
    {
        let formData = new FormData(thisForm);
        formData.set('answer1',$('input[name=rdb_answer1]:checked').val());
        formData.set('answer2',$('input[name=rdb_answer2]:checked').val());
        formData.set('answer3',$('input[name=rdb_answer3]:checked').val());
        formData.set('answer4',$('input[name=rdb_answer4]:checked').val());
        formData.set('answer5',$('input[name=rdb_answer5]:checked').val());
        formData.set('answer6',$('input[name=rdb_answer6]:checked').val());
        formData.set('answer7',$('input[name=rdb_answer7]:checked').val());

        $('#btn_submitLoanReadinessAssessment').prop('disabled',true);

        AJAXHELPER.postData({
            // EmployeeAssessmentController->e_addLoanReadinessAssessment();
            'route' : 'portal/employee/e-add-loan-readiness-assessement',
            'data'  : formData
        }, function(data){
            setTimeout(function(){
                $('#btn_submitLoanReadinessAssessment').prop('disabled',false);
                EMPLOYEE_DASHBOARD.e_openSalaryAdvanceModal(data);
            }, 1000);
        }, function(data){
            COMMONHELPER.Toaster('error',data['responseJSON'][0]);
            $('#btn_submitLoanReadinessAssessment').prop('disabled',false);
        });
    }



    thisEmployeeDashboard.e_openSalaryAdvanceModal = function(arrData)
    {
        AJAXHELPER.getData({
            // EmployeeController->e_selectEmployeeInformation();
            'route' : 'portal/employee/e-select-employee-information',
            'data'  : null
        }, function(data){
            $('#modal_loanReadinessAssessment').modal('hide');
            $('#modal_salaryAdvanceApplication').modal('show');

            $("#rng_creditLimit").ionRangeSlider({
                type: "single",
                min: parseInt(data['minimum_credit_amount']),
                max: parseInt(data['maximum_credit_amount']),
                from_min: parseInt(data['min_loanable_amount']),
                from_max: parseInt(data['max_loanable_amount']),
                from_shadow: true,
                grid: true,
                step: 500,
                onChange: function (data) {
                    $('#txt_loanAmount').val(data['from']);
                    EMPLOYEE_DASHBOARD.e_computeSalaryAdvanceInterests();
                }
            });

            $('#lbl_min').text(COMMONHELPER.numberWithCommas(data['minimum_credit_amount']));
            $('#lbl_max').text(COMMONHELPER.numberWithCommas(data['maximum_credit_amount']));

            $('#txt_loanAmount').val(parseInt(data['min_loanable_amount']));

            $('#lbl_loanAmount').text($('#txt_loanAmount').val());
            $('#lbl_totalInterest').text(`${arrData['interestRate']} %`);

            _persona = arrData['persona'];
            _interestRate = arrData['interestRate'];
            _arrAnswers = arrData['arrLetters'];
            _totalScore = arrData['totalScore'];

            EMPLOYEE_DASHBOARD.e_computeSalaryAdvanceInterests();
        });
    }

    thisEmployeeDashboard.e_computeSalaryAdvanceInterests = function(thisField)
    {
        let loanAmount = $('#txt_loanAmount').val();
        let paymentTerms = $('input[name=rdb_paymentTerms]:checked').val();

        let totalLoan = 0;
        let interest = 0;
        let totalInterest = 0;
        let amountToReceive = 0;
        let numberOfDeductions = 0;
        let monthlyDues = 0;
        let deductionPerCufOff = 0;

        amountToReceive = loanAmount - 300;
        numberOfDeductions = parseInt(paymentTerms.substr(0,1)) * 2;

        interest = _interestRate / 100;
        totalInterest = parseFloat(loanAmount) * interest;
        totalLoan = parseFloat(loanAmount) + totalInterest;

        monthlyDues = totalLoan / parseInt(paymentTerms.substr(0,1));
        deductionPerCufOff = totalLoan / numberOfDeductions;


        $('#lbl_loanAmount').text(COMMONHELPER.numberWithCommas($('#txt_loanAmount').val()));
        $('#lbl_processingFee').text('300.00');
        $('#lbl_amountToReceive').text(COMMONHELPER.numberWithCommas(parseFloat(amountToReceive).toFixed(2)));

        $('#lbl_paymentTerms').text(`${$('input[name=rdb_paymentTerms]:checked').val()}`);
        $('#lbl_numberOfDeductions').text(numberOfDeductions);
        $('#lbl_monthlyDues').text(COMMONHELPER.numberWithCommas(parseFloat(monthlyDues).toFixed(2)));
        $('#lbl_deductionPerCutOff').text(COMMONHELPER.numberWithCommas(parseFloat(deductionPerCufOff).toFixed(2)));
    }

    thisEmployeeDashboard.e_submitSalaryAdvanceApplication = function(thisForm)
    {
        let formData = new FormData(thisForm);
        formData.set('answers',JSON.stringify(_arrAnswers));
        formData.set('persona',_persona);
        formData.set('totalScore',_totalScore);
        
        formData.set('loanAmount',$('#txt_loanAmount').val());
        formData.set('paymentTerms',$('input[name=rdb_paymentTerms]:checked').val());
        formData.set('purposeOfLoan',$('#slc_purposeOfLoan').val());
        formData.set('interestRate',_interestRate);

        $('#btn_submitSalaryAdvanceApplication').prop('disabled',true);

        AJAXHELPER.postData({
            // LoanController->e_submitSalaryAdvanceApplication();
            'route' : 'portal/employee/e-submit-salary-advance-application',
            'data'  : formData
        }, function(data){
            COMMONHELPER.Toaster('success',data[0]);
            setTimeout(function(){
                $('#btn_submitSalaryAdvanceApplication').prop('disabled',false);
                $('#modal_salaryAdvanceApplication').modal('hide');
                window.location.replace(`${baseUrl}portal/employee/dashboard`);
            }, 1000);
        }, function(data){ 
            COMMONHELPER.Toaster('error',data['responseJSON'][0]);
            $('#btn_submitSalaryAdvanceApplication').prop('disabled',false);
        });
    }

    thisEmployeeDashboard.e_viewDashboardDetails = function()
    {
        $('#modal_viewDashboardDetails').modal('show');
        AJAXHELPER.getData({
            // LoanController->e_loadDashboardDetails();
            'route' : 'portal/employee/e-load-dashboard-details',
            'data'  : null
        }, function(data){
            $('#lbl_accountName').text(`${data['loanDetails']['first_name']} ${data['loanDetails']['last_name']}`);
            $('#lbl_accountNumber').text(data['loanDetails']['account_number']);
            $('#lbl_interestRate').text(`${data['loanDetails']['interest_rate']} %`);
            $('#lbl_maStartDate').text(data['loanDetails']['maStartDate']);
            $('#lbl_maEndDate').text(data['loanDetails']['maEndDate']);

            let tbody1 = '';
            let balance1 = parseFloat(data['loanDetails']['loan_amount']) + parseFloat(data['loanDetails']['total_interest']);
            data['loanPaymentDates'].forEach(function(value, index){
                balance1 -= parseFloat(data['loanDetails']['deduction_per_cutoff']);
                tbody1 += `<tr>
                                <td><center>${value}<center></td>
                                <td style="text-align: right;">${COMMONHELPER.numberWithCommas(data['loanDetails']['deduction_per_cutoff'])}</td>
                                <td style="text-align: right;">${COMMONHELPER.numberWithCommas(balance1)}</td>
                            </tr>`;
            });
            $('#tbl_paymentCutOffs tbody').html(tbody1);

            let tbody2 = '';
            let balance2 = parseFloat(data['loanDetails']['loan_amount']) + parseFloat(data['loanDetails']['total_interest']);
            data['loanPaymentMonths'].forEach(function(value, index){
                balance2 -= parseFloat(data['loanDetails']['monthly_dues']);
                tbody2 += `<tr>
                                <td><center>${value}<center></td>
                                <td style="text-align: right;">${COMMONHELPER.numberWithCommas(data['loanDetails']['monthly_dues'])}</td>
                                <td style="text-align: right;">${COMMONHELPER.numberWithCommas(balance2)}</td>
                            </tr>`;
            });
            $('#tbl_paymentMonthlyDues tbody').html(tbody2);
        });
    }

    return thisEmployeeDashboard;

})();