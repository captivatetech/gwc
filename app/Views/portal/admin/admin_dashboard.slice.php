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

<div class="content-page">
                <div class="content">

                    <!-- Start Content-->
                    <div class="container-fluid">

                        <div class="row">

                            <div class="col-xl-3 col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="dropdown float-end">
                                            <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="mdi mdi-dots-vertical"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <!-- item-->
                                                <a href="javascript:void(0);" class="dropdown-item">Action</a>
                                                <!-- item-->
                                                <a href="javascript:void(0);" class="dropdown-item">Another action</a>
                                                <!-- item-->
                                                <a href="javascript:void(0);" class="dropdown-item">Something else</a>
                                                <!-- item-->
                                                <a href="javascript:void(0);" class="dropdown-item">Separated link</a>
                                            </div>
                                        </div>
    
                                        <h4 class="header-title mt-0 mb-4">Total Revenue</h4>
    
                                        <div class="widget-chart-1">
                                            <div class="widget-chart-box-1 float-start" dir="ltr">
                                                <input data-plugin="knob" data-width="70" data-height="70" data-fgColor="#f05050 "
                                                       data-bgColor="#F9B9B9" value="58"
                                                       data-skin="tron" data-angleOffset="180" data-readOnly=true
                                                       data-thickness=".15"/>
                                            </div>
    
                                            <div class="widget-detail-1 text-end">
                                                <h2 class="fw-normal pt-2 mb-1"> 256 </h2>
                                                <p class="text-muted mb-1">Revenue today</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- end col -->

                            <div class="col-xl-3 col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="dropdown float-end">
                                            <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="mdi mdi-dots-vertical"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <!-- item-->
                                                <a href="javascript:void(0);" class="dropdown-item">Action</a>
                                                <!-- item-->
                                                <a href="javascript:void(0);" class="dropdown-item">Another action</a>
                                                <!-- item-->
                                                <a href="javascript:void(0);" class="dropdown-item">Something else</a>
                                                <!-- item-->
                                                <a href="javascript:void(0);" class="dropdown-item">Separated link</a>
                                            </div>
                                        </div>
    
                                        <h4 class="header-title mt-0 mb-3">Sales Analytics</h4>
    
                                        <div class="widget-box-2">
                                            <div class="widget-detail-2 text-end">
                                                <span class="badge bg-success rounded-pill float-start mt-3">32% <i class="mdi mdi-trending-up"></i> </span>
                                                <h2 class="fw-normal mb-1"> 8451 </h2>
                                                <p class="text-muted mb-3">Revenue today</p>
                                            </div>
                                            <div class="progress progress-bar-alt-success progress-sm">
                                                <div class="progress-bar bg-success" role="progressbar"
                                                        aria-valuenow="77" aria-valuemin="0" aria-valuemax="100"
                                                        style="width: 77%;">
                                                    <span class="visually-hidden">77% Complete</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- end col -->

                            <div class="col-xl-3 col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="dropdown float-end">
                                            <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="mdi mdi-dots-vertical"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <!-- item-->
                                                <a href="javascript:void(0);" class="dropdown-item">Action</a>
                                                <!-- item-->
                                                <a href="javascript:void(0);" class="dropdown-item">Another action</a>
                                                <!-- item-->
                                                <a href="javascript:void(0);" class="dropdown-item">Something else</a>
                                                <!-- item-->
                                                <a href="javascript:void(0);" class="dropdown-item">Separated link</a>
                                            </div>
                                        </div>
    
                                        <h4 class="header-title mt-0 mb-4">Statistics</h4>
    
                                        <div class="widget-chart-1">
                                            <div class="widget-chart-box-1 float-start" dir="ltr">
                                                <input data-plugin="knob" data-width="70" data-height="70" data-fgColor="#ffbd4a"
                                                        data-bgColor="#FFE6BA" value="80"
                                                        data-skin="tron" data-angleOffset="180" data-readOnly=true
                                                        data-thickness=".15"/>
                                            </div>
                                            <div class="widget-detail-1 text-end">
                                                <h2 class="fw-normal pt-2 mb-1"> 4569 </h2>
                                                <p class="text-muted mb-1">Revenue today</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- end col -->

                            <div class="col-xl-3 col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="dropdown float-end">
                                            <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="mdi mdi-dots-vertical"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <!-- item-->
                                                <a href="javascript:void(0);" class="dropdown-item">Action</a>
                                                <!-- item-->
                                                <a href="javascript:void(0);" class="dropdown-item">Another action</a>
                                                <!-- item-->
                                                <a href="javascript:void(0);" class="dropdown-item">Something else</a>
                                                <!-- item-->
                                                <a href="javascript:void(0);" class="dropdown-item">Separated link</a>
                                            </div>
                                        </div>
    
                                        <h4 class="header-title mt-0 mb-3">Daily Sales</h4>
    
                                        <div class="widget-box-2">
                                            <div class="widget-detail-2 text-end">
                                                <span class="badge bg-pink rounded-pill float-start mt-3">32% <i class="mdi mdi-trending-up"></i> </span>
                                                <h2 class="fw-normal mb-1"> 158 </h2>
                                                <p class="text-muted mb-3">Revenue today</p>
                                            </div>
                                            <div class="progress progress-bar-alt-pink progress-sm">
                                                <div class="progress-bar bg-pink" role="progressbar"
                                                        aria-valuenow="77" aria-valuemin="0" aria-valuemax="100"
                                                        style="width: 77%;">
                                                    <span class="visually-hidden">77% Complete</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            </div><!-- end col -->

                        </div>
                        <!-- end row -->

                        <div class="row">

                            <div class="col-xl-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="dropdown float-end">
                                            <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="mdi mdi-dots-vertical"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <!-- item-->
                                                <a href="javascript:void(0);" class="dropdown-item">Action</a>
                                                <!-- item-->
                                                <a href="javascript:void(0);" class="dropdown-item">Another action</a>
                                                <!-- item-->
                                                <a href="javascript:void(0);" class="dropdown-item">Something else</a>
                                                <!-- item-->
                                                <a href="javascript:void(0);" class="dropdown-item">Separated link</a>
                                            </div>
                                        </div>
                                        <h4 class="header-title mt-0">Statistics</h4>
                                        <div id="morris-bar-example" dir="ltr" style="height: 280px;" class="morris-chart"></div>
                                    </div>
                                </div>
                            </div><!-- end col -->

                        </div>
                        <!-- end row -->
                        
                    </div> <!-- container-fluid -->

                </div> <!-- content -->

            </div>
            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->

@endsection



@section('custom_scripts')


<!-- knob plugin -->
<script src="<?php echo base_url();?>public/assets/Adminto/libs/jquery-knob/jquery.knob.min.js"></script>

<!--Morris Chart-->
<script src="<?php echo base_url();?>public/assets/Adminto/libs/morris.js06/morris.min.js"></script>
<script src="<?php echo base_url();?>public/assets/Adminto/libs/raphael/raphael.min.js"></script>

<!-- Dashboar init js-->
<script src="<?php echo base_url();?>public/assets/Adminto/js/pages/dashboard.init.js"></script>

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
<script type="text/javascript" src="<?php echo base_url(); ?>public/assets/js/custom/admin/{{ $customScripts }}.js"></script>

<script type="text/javascript">
  $(document).ready(function(){
    //jQuery Events
    
    
  });
</script>

@endsection
