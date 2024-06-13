@extends('template.layout')

@section('page_title',$pageTitle)



@section('custom_styles')

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
    
                                        <h4 style="text-align:center;" class="header-title mt-0 mb-4">Salary Advance</h4>

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

                    </div> <!-- container-fluid -->

                </div> <!-- content -->

            </div>
            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->

@endsection



@section('custom_scripts')


<!-- Ajax Helpers Scripts -->
<script type="text/javascript" src="<?php echo base_url(); ?>public/assets/js/helper/ajax_helper.js"></script>
<!-- Custom Scripts -->
<script type="text/javascript" src="<?php echo base_url(); ?>public/assets/js/custom/{{ $customScripts }}.js"></script>

<script type="text/javascript">
  $(document).ready(function(){
    //jQuery Events
    
    
  });
</script>

@endsection
