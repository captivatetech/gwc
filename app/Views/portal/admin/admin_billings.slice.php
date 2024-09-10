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

                                <table id="tbl_billings" class="table table-bordered nowrap" style="width:100%;">
                                    <thead>
                                        <tr>
                                            <th>Billing Date</th>
                                            <th>Billing Number</th>
                                            <th>Company Name</th>
                                            <th>Total Amount</th>
                                            <th>Total Paid</th>
                                            <th>Balance</th>
                                            <th>Due Date</th>
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

    <div class="modal fade" id="modal_billingDetails">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header modal-header--sticky">
                    <h5 class="modal-title"> 
                        <i class="feather-plus me-2"></i> Billing Details
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <table style="width: 100%" class="tbl-custom">
                                <tbody>
                                    <tr>
                                        <td>Billing Number</td>
                                        <td>
                                            <input type="text" class="form-control" id="txt_billingNumber" readonly>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Company Name</td>
                                        <td>
                                            <input type="text" class="form-control" id="txt_companyName" readonly>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Company Code</td>
                                        <td>
                                            <input type="text" class="form-control" id="txt_companyCode" readonly>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Billing Date</td>
                                        <td>
                                            <input type="text" class="form-control" id="txt_billingDate" readonly>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-lg-6">
                            <table style="width: 100%;" class="tbl-custom">
                                <tbody>
                                    <tr>
                                        <td>Billing Amount</td>
                                        <td>
                                            <input type="text" id="txt_billingAmount" class="form-control" style="text-align: right;" readonly>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Paid Amount</td>
                                        <td>
                                            <input type="text" id="txt_paidAmount" class="form-control" style="text-align: right;" readonly>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Balance</td>
                                        <td>
                                            <input type="text" id="txt_balance" class="form-control" style="text-align: right;" readonly>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Due Date</td>
                                        <td>
                                            <input type="text" id="txt_dueDate"  class="form-control" readonly>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <hr>

                    <table id="tbl_billingDetails" class="table table-bordered nowrap" style="width:100%;">
                        <thead>
                            <tr>
                                <th>Loan Account Number</th>
                                <th>Date Released</th>
                                <th>Name</th>
                                <th>Loan Amount</th>
                                <th>Amount to Pay</th>
                                <th>Terms</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
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

    ADMIN_BILLINGS.a_loadBillings();
    
    
  });
</script>

@endsection
