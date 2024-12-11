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

                    <div class="col-xl-4 col-md-6">
                        <div class="card">
                            <div class="card-body">

                                <h4 class="header-title mt-0 mb-4">Salary Advance</h4>

                                <h6 style="text-align:center;" class="mt-0">Interest rate</h6>
                                <p style="text-align:center;">30 to 45% per annum<br>
                                2.75 - Low Risk; 3.25 - Mid Risk <br>and 3.75% - High Risk</p>

                                <h6 style="text-align:center;" class="mt-0">Terms</h6>
                                <p style="text-align:center;">Maximum 12 Months</p>

                                <h6 style="text-align:center;" class="mt-0">Target Market</h6>
                                <p style="text-align:center;">Employees with net income of 25-35% of take home pay</p>

                            </div>
                        </div>
                    </div><!-- end col -->

                    <div class="col-xl-4 col-md-6">
                        <div class="card">
                            <div class="card-body">

                                <h4 class="header-title mt-0 mb-4">Business Expansion Loan</h4>

                            </div>
                        </div>
                    </div><!-- end col -->

                    <div class="col-xl-4 col-md-6">
                        <div class="card">
                            <div class="card-body">

                                <h4 class="header-title mt-0 mb-4">Payment Now</h4>

                            </div>
                        </div>
                    </div><!-- end col -->

                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="mt-0 header-title">Billings</h4>
                                <p class="text-muted font-14 mb-3">
                                   
                                </p>

                                <table id="tbl_billings" class="table table-bordered dt-responsive table-responsive nowrap" style="width:100%;">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Billing Number</th>
                                            <th>Billing Amount</th>
                                            <th>Paid Amount</th>
                                            <th>Due Balance</th>
                                            <th>Due Date</th>
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

                <div class="row">
                    <div class="col-6">
                        <div class="card">
                            <div class="card-body">
                                <h4>Amount due in x day/s</h4>
                                <center>
                                    <h2 style="color: red;">Php 00.0</h2>
                                </center>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card">
                            <div class="card-body">
                                <h4>Past due in x day/s</h4>
                                <center>
                                    <h2 style="color: red;">Php 00.0</h2>
                                </center>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        <div class="card">
                            <div class="card-body">
                                <h4>Total # of loans active</h4>
                                <center>
                                    <h2 style="color: red;">0 / 0</h2>
                                </center>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card">
                            <div class="card-body">
                                <h4>Total # of loan repaid</h4>
                                <center>
                                    <h2 style="color: red;">0 / 0</h2>
                                </center>
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

@endsection



@section('custom_scripts')

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

<!-- Ajax Helpers Scripts -->
<script type="text/javascript" src="<?php echo base_url(); ?>public/assets/js/helper/ajax_helper.js"></script>
<!-- Custom Scripts -->
<script type="text/javascript" src="<?php echo base_url(); ?>public/assets/js/custom/representative/{{ $customScripts }}.js"></script>

<script type="text/javascript">
  $(document).ready(function(){
    //jQuery Events
    
    REPRESENTATIVE_DASHBOARD.r_loadBillings();
    
  });
</script>

@endsection
