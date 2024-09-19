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

                                <table id="tbl_payments" class="table table-bordered nowrap" style="width: 100%;">
                                    <thead>
                                    <tr>
                                        <th>Payment Date</th>
                                        <th>Payment Number</th>
                                        <th>Company Name</th>
                                        <th>Billing Number</th>
                                        <th>Amount Paid</th>
                                        <th>Status</th>
                                        <th>Date Confirmed</th>
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

    <div class="modal fade" id="modal_paymentValidation">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header modal-header--sticky">
                    <h5 class="modal-title"> 
                        <i class="feather-plus me-2"></i> Payment Validation
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h5>Payment Details</h5>
                    <div class="row">
                        <div class="col-lg-6">
                            <table style="width: 100%" class="tbl-custom">
                                <tbody>
                                    <tr>
                                        <td>Company Name</td>
                                        <td>
                                            <input type="text" class="form-control" id="txt_companyName" readonly>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Product Type</td>
                                        <td>
                                            <input type="text" class="form-control" id="txt_productType" readonly>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Billing Number</td>
                                        <td>
                                            <input type="text" class="form-control" id="txt_billingNumber" readonly>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Billing Amount</td>
                                        <td>
                                            <input type="text" class="form-control" id="txt_billingAmount" readonly>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Due Date</td>
                                        <td>
                                            <input type="text" class="form-control" id="txt_dueDate" readonly>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-lg-6">
                            <table style="width: 100%" class="tbl-custom">
                                <tbody>
                                    <tr>
                                        <td>Payment Date</td>
                                        <td>
                                            <input type="text" class="form-control" id="txt_paymentDate" readonly>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Amount Paid</td>
                                        <td>
                                            <input type="text" class="form-control" id="txt_amountPaid" readonly>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Payment Method</td>
                                        <td>
                                            <input type="text" class="form-control" id="txt_paymentMethod" readonly>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Reference Number</td>
                                        <td>
                                            <input type="text" class="form-control" id="txt_referenceNumber" readonly>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Bank/Branch</td>
                                        <td>
                                            <input type="text" class="form-control" id="txt_branch" readonly>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <hr>
                    <h5>Proof of Payment</h5>
                    <div id="div_proofOfPayment"></div>

                    <hr>
                    <form id="form_paymentValidation">
                        <input type="hidden" id="txt_paymentId" name="txt_paymentId">
                        <input type="hidden" id="txt_companyId" name="txt_companyId">
                        <div class="row">
                            <div class="col-lg-4"></div>
                            <div class="col-lg-4">
                                <center>
                                    <label>Payment Status</label>
                                    <select class="form-control form-select" id="slc_paymentStatus" name="slc_paymentStatus" required>
                                        <option value="CONFIRM">CONFIRM</option>
                                        <option value="RETURN">RETURN</option>
                                    </select>
                                </center>
                            </div>
                            <div class="col-lg-4"></div>
                        </div>
                        <div id="div_returnRemarks" hidden>
                            <br>
                            <label>Remarks:</label>
                            <textarea rows="4" class="form-control" id="txt_returnRemarks" name="txt_returnRemarks"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer modal-footer--sticky">
                    <button type="submit" class="btn gwc-button" id="btn_submitPaymentValidation" form="form_paymentValidation">Save</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal_sendEmailToEmployees" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header modal-header--sticky">
                    <h5 class="modal-title" id="lbl_modalTitle2"> 
                        Payment Confirmation Email
                    </h5>
                </div>
                <div class="modal-body">
                    <center>
                        <i>Processing, Please wait...</i>
                    </center>
                    <div class="progress mt-1 mb-1">
                        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" id="div_progressBar" style="width: 0%"></div>
                    </div>
                    <center>
                        <i><span id="lbl_progress"></span></i>
                    </center>
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
    
    ADMIN_PAYMENTS.a_loadPayments();

    $('#slc_paymentStatus').on('change',function(){
        if($(this).val() == 'CONFIRM')
        {
            $('#div_returnRemarks').prop('hidden',true);
            $('#txt_returnRemarks').prop('required',false);
        }
        else
        {
            $('#div_returnRemarks').prop('hidden',false);
            $('#txt_returnRemarks').prop('required',true);
        }
    });

    $('#form_paymentValidation').on('submit', function(e){
        e.preventDefault();
        ADMIN_PAYMENTS.a_confirmPayment(this);
    });
    
  });
</script>

@endsection
