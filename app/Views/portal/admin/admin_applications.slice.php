@extends('template.layout')

@section('page_title',$pageTitle)



@section('custom_styles')

<!-- third party css -->
<link href="<?php echo base_url();?>public/assets/Adminto/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>public/assets/Adminto/libs/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>public/assets/Adminto/libs/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>public/assets/Adminto/libs/datatables.net-select-bs5/css//select.bootstrap5.min.css" rel="stylesheet" type="text/css" />
<!-- third party css end -->

<style type="text/css">
  /*INTERNAL STYLES*/
  .tbl-custom tbody tr td {
    padding: 5px;
  }
  
</style>

@endsection



@section('page_content')

    <!-- ============================================================== -->
    <!-- Start Page Content here -->
    <!-- ============================================================== -->
 
    <div class="content-page">
        <div class="content">

            <!-- Start Content-->
            <div class="container-fluid">

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">

                                <table id="tbl_applications" class="table table-bordered nowrap" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Loan Application Number</th>
                                            <th>Type</th>
                                            <th>Name</th>
                                            <th>Company</th>
                                            <th>Amount</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                    </tbody>
                                </table>

                                <br>

                            </div>
                        </div>
                    </div>
                </div>

                <input type="hidden" id="txt_baseUrl" value="<?php echo base_url(); ?>">
                
            </div> <!-- container-fluid -->

        </div> <!-- content -->

    </div>
    <!-- ============================================================== -->
    <!-- End Page content -->
    <!-- ============================================================== -->

    <div class="modal fade" id="modal_loanApplicationDetails" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header modal-header--sticky">
                    <h5 class="modal-title"> 
                        <i class="feather-plus me-2"></i> Loan Application Details
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="txt_loanId">
                    <div class="row">
                        <div class="col-lg-6">
                            <h6>Employee Details</h6>
                            <table style="width: 100%" class="tbl-custom">
                                <tbody>
                                    <tr>
                                        <td>Application Date</td>
                                        <td>
                                            <input type="text" class="form-control form-control-sm" id="txt_applicationDate" readonly>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Application Number</td>
                                        <td>
                                            <input type="text" class="form-control form-control-sm" id="txt_applicationNumber" readonly>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Employee Name</td>
                                        <td>
                                            <input type="text" class="form-control form-control-sm" id="txt_employeeName" readonly>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>ID Number</td>
                                        <td>
                                            <input type="text" class="form-control form-control-sm" id="txt_idNumber" readonly>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Department</td>
                                        <td>
                                            <input type="text" class="form-control form-control-sm" id="txt_department" readonly>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Position</td>
                                        <td>
                                            <input type="text" class="form-control form-control-sm" id="txt_position" readonly>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <hr>
                            <h6>Attached Documents <small>(Signed Documents)</small></h6>
                            <label>Employee Action Status: <b><span id="lbl_employeeActionStatus"></span></b></label>
                            <br>
                            <label>Representative Action Status: <b><span id="lbl_representativeActionStatus"></span></b></label>
                            <br>
                            <label>Admin Action Status: <b><span id="lbl_adminActionStatus"></span></b></label>
                            <i><p style="color:red;">Please check your <a href="https://mail.google.com/mail/u/0/?tab=rm&ogbl#inbox" target="_blank">email</a> to sign or click <a href="javascript:void(0)" id="lnk_downloadDocument">here</a> to review the document.</p></i>
                        </div>
                        <div class="col-lg-6">
                            <h6>Loan Details</h6>
                            <table style="width: 100%;" class="tbl-custom">
                                <tbody>
                                    <tr>
                                        <td>Loan Amount</td>
                                        <td>
                                            <input type="text" id="txt_loanAmount" class="form-control" style="text-align: right;" readonly>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Payment Terms</td>
                                        <td>
                                            <input type="text" id="txt_paymentTerms" class="form-control" readonly>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Purpose of Loan</td>
                                        <td>
                                            <input type="text" id="txt_purposeOfLoan" class="form-control" readonly>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <hr>
                            <h6>Loan Summary</h6>
                            <table style="width: 100%;" class="tbl-custom">
                                <tbody>
                                    <tr>
                                        <td>Loan Amount</td>
                                        <td style="text-align: right;">
                                            <span id="lbl_loanAmount"></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Processing Fee</td>
                                        <td style="text-align: right;">
                                            <span id="lbl_processingFee"></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><h6>Amount to Receive</h6></td>
                                        <td style="text-align: right;">
                                            <h6 id="lbl_amountToReceive"></h6>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <hr>
                            <table style="width: 100%;" class="tbl-custom">
                                <tbody>
                                    <tr>
                                        <td>Total Interest</td>
                                        <td style="text-align: right;">
                                            <span id="lbl_totalInterest"></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Payment Terms</td>
                                        <td style="text-align: right;">
                                            <span id="lbl_paymentTerms"></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Number of Deductions</td>
                                        <td style="text-align: right;">
                                            <span id="lbl_numberOfDeductions"></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Monthly Dues</td>
                                        <td style="text-align: right;">
                                            <span id="lbl_monthlyDues"></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><h6>Deduction Per Cut-Off</h6></td>
                                        <td style="text-align: right;">
                                            <h6 id="lbl_deductionPerCutOff"></h6>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer modal-footer--sticky" id="div_footer" hidden>
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn gwc-button" id="btn_approveApplication">Approve</button>
                    <button type="button" class="btn btn-danger" id="btn_rejectApplication">Reject Application</button>
                </div>
            </div>
        </div>
    </div>

@endsection



@section('custom_scripts')


<!-- knob plugin -->
<script src="<?php echo base_url();?>public/assets/Adminto/libs/jquery-knob/jquery.knob.min.js"></script>

<!-- third party js -->
<script src="<?php echo base_url();?>public/assets/Adminto/libs/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>public/assets/Adminto/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>
<script src="<?php echo base_url();?>public/assets/Adminto/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo base_url();?>public/assets/Adminto/libs/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js"></script>
<script src="<?php echo base_url();?>public/assets/Adminto/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url();?>public/assets/Adminto/libs/datatables.net-buttons-bs5/js/buttons.bootstrap5.min.js"></script>
<script src="<?php echo base_url();?>public/assets/Adminto/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="<?php echo base_url();?>public/assets/Adminto/libs/datatables.net-buttons/js/buttons.flash.min.js"></script>
<script src="<?php echo base_url();?>public/assets/Adminto/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="<?php echo base_url();?>public/assets/Adminto/libs/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
<script src="<?php echo base_url();?>public/assets/Adminto/libs/datatables.net-select/js/dataTables.select.min.js"></script>
<script src="<?php echo base_url();?>public/assets/Adminto/libs/pdfmake/build/pdfmake.min.js"></script>
<script src="<?php echo base_url();?>public/assets/Adminto/libs/pdfmake/build/vfs_fonts.js"></script>
<!-- third party js ends -->

<!-- Datatables init -->
<script src="<?php echo base_url();?>public/assets/Adminto/js/pages/datatables.init.js"></script>

<!-- Common Helpers Scripts -->
<script type="text/javascript" src="<?php echo base_url();?>public/assets/js/helper/common_helper.js"></script>
<!-- Ajax Helpers Scripts -->
<script type="text/javascript" src="<?php echo base_url(); ?>public/assets/js/helper/ajax_helper.js"></script>
<!-- Custom Scripts -->
<script type="text/javascript" src="<?php echo base_url(); ?>public/assets/js/custom/admin/{{ $customScripts }}.js"></script>

<script type="text/javascript">
  $(document).ready(function(){
    //jQuery Events

    ADMIN_APPLICATIONS.a_loadApplications();
    
    $('#btn_approveApplication').on('click',function(){
        ADMIN_APPLICATIONS.a_approveApplication();
    });

    $('#btn_rejectApplication').on('click',function(){
        ADMIN_APPLICATIONS.a_rejectApplication();
    });
    
  });
</script>

@endsection
