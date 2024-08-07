
const EMPLOYEE_DASHBOARD = (function(){

    let thisEmployeeDashboard = {};

    let _persona = '';
    let _interestRate = 0;
    let _arrAnswers = [];
    let _totalScore = 0;

    thisEmployeeDashboard.loadSample = function()
    {
        // alert();
    }

    thisEmployeeDashboard.e_loadCreditDetails = function()
    {

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

        AJAXHELPER.addData({
            // EmployeeAssessmentController->e_addLoanReadinessAssessment();
            'route' : 'portal/employee/e-add-loan-readiness-assessement',
            'data'  : formData
        }, function(data){
            // COMMONHELPER.Toaster('success',data[0]);
            setTimeout(function(){
                $('#btn_submitLoanReadinessAssessment').prop('disabled',false);
                EMPLOYEE_DASHBOARD.e_openSalaryAdvanceModal(data);
            }, 1000);
        }, function(data){ // Error
            COMMONHELPER.Toaster('error',data['responseJSON'][0]);
            $('#btn_submitLoanReadinessAssessment').prop('disabled',false);
        });
    }



    thisEmployeeDashboard.e_openSalaryAdvanceModal = function(arrData)
    {
        AJAXHELPER.selectData({
            // EmployeeController->e_selectEmployeeInformation();
            'route' : 'portal/employee/e-select-employee-information',
            'data'  : {
                'sample' : 'sample'
            }
        }, function(data){
            $('#modal_loanReadinessAssessment').modal('hide');
            $('#modal_salaryAdvanceApplication').modal('show');

            $('#rng_creditLimit').prop('min',data['minimum_credit_amount']);
            $('#rng_creditLimit').prop('max',data['maximum_credit_amount']);

            $('#lbl_min').text(COMMONHELPER.numberWithCommas(data['minimum_credit_amount']));
            $('#lbl_max').text(COMMONHELPER.numberWithCommas(data['maximum_credit_amount']));

            $('#rng_creditLimit').val(data['minimum_credit_amount']);
            $('#txt_loanAmount').val(data['minimum_credit_amount']);

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
        formData.set('answers',_arrAnswers);
        formData.set('persona',_persona);
        formData.set('totalScore',_totalScore);
        
        formData.set('paymentTerms',$('input[name=rdb_paymentTerms]:checked').val());
        formData.set('interest',_interestRate);
        formData.set('loanAmount',$('#txt_loanAmount').val());
        formData.set('loanAmount',$('#txt_loanAmount').val());

        $('#btn_submitSalaryAdvanceApplication').prop('disabled',true);

        AJAXHELPER.addData({
            // LoanController->e_submitSalaryAdvanceApplication();
            'route' : 'portal/employee/e-submit-salary-advance-application',
            'data'  : formData
        }, function(data){
            // COMMONHELPER.Toaster('success',data[0]);
            setTimeout(function(){
                $('#btn_submitSalaryAdvanceApplication').prop('disabled',false);
            }, 1000);
        }, function(data){ // Error
            COMMONHELPER.Toaster('error',data['responseJSON'][0]);
            $('#btn_submitSalaryAdvanceApplication').prop('disabled',false);
        });
    }

    return thisEmployeeDashboard;

})();