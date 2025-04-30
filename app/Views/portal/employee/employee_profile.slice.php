@extends('template.layout')

@section('page_title',$pageTitle)



@section('custom_styles')


<!-- third party css -->
<link href="<?php echo base_url();?>public/assets/Adminto/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>public/assets/Adminto/libs/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>public/assets/Adminto/libs/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>public/assets/Adminto/libs/datatables.net-select-bs5/css//select.bootstrap5.min.css" rel="stylesheet" type="text/css" />
<!-- third party css end -->


<!-- Plugins css -->
<link href="<?php echo base_url();?>public/assets/Adminto/libs/dropzone/min/dropzone.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>public/assets/Adminto/libs/dropify/css/dropify.min.css" rel="stylesheet" type="text/css" />

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

                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-body">

                                <table class="table table-bordered" width="100%">
                                    <tbody>
                                        <tr>
                                            <td width="30%">Name:</td>
                                            <td>
                                                <label id="lbl_name"></label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Birth Date:</td>
                                            <td>
                                                <label id="lbl_birthDate"></label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Marital Status:</td>
                                            <td>
                                                <label id="lbl_maritalStatus"></label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Email Address:</td>
                                            <td>
                                                <label id="lbl_emailAddress"></label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Mobile Number:</td>
                                            <td>
                                                <label id="lbl_mobileNumber"></label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Position:</td>
                                            <td>
                                                <label id="lbl_position"></label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Department:</td>
                                            <td>
                                                <label id="lbl_department"></label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Employment Status:</td>
                                            <td>
                                                <label id="lbl_employmentStatus"></label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Date Hired:</td>
                                            <td>
                                                <label id="lbl_dateHired"></label>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                            </div>
                        </div> <!-- end card-->
                    </div> <!-- end col -->

                </div>
                <!-- end row -->    

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

<!-- Plugins js -->
<script src="<?php echo base_url();?>public/assets/Adminto/libs/dropzone/min/dropzone.min.js"></script>
<script src="<?php echo base_url();?>public/assets/Adminto/libs/dropify/js/dropify.min.js"></script>

<!-- Init js-->
<script src="<?php echo base_url();?>public/assets/Adminto/js/pages/form-fileuploads.init.js"></script>

<!-- Common Helpers Scripts -->
<script type="text/javascript" src="<?php echo base_url();?>public/assets/js/helper/common_helper.js"></script>
<!-- Ajax Helpers Scripts -->
<script type="text/javascript" src="<?php echo base_url(); ?>public/assets/js/helper/ajax_helper.js"></script>
<!-- Custom Scripts -->
<script type="text/javascript" src="<?php echo base_url(); ?>public/assets/js/custom/employee/{{ $customScripts }}.js"></script>

<script type="text/javascript">
  $(document).ready(function(){
    //jQuery Events
    
    EMPLOYEE_PROFILE.e_selectEmployeeProfile();
    
  });
</script>

@endsection