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
            
                                            <ul class="nav nav-pills navtab-bg nav-justified">
                                                <li class="nav-item">
                                                    <a href="#home1" data-bs-toggle="tab" aria-expanded="false" class="nav-link active">
                                                        INFORMATION
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="#profile1" data-bs-toggle="tab" aria-expanded="true" class="nav-link">
                                                        IDENTIFICATION
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="#messages1" data-bs-toggle="tab" aria-expanded="false" class="nav-link">
                                                        PROFILE IMAGE
                                                    </a>
                                                </li>
                                            </ul>
                                            <div class="tab-content">
                                                <div class="tab-pane show active" id="home1">

                                                    <br>
                                                    <form class="form-horizontal">

                                                        <div class="row mb-3">
                                                            <label for="inputEmail3" class="col-4 col-xl-2 col-form-label">Last Name</label>
                                                            <div class="col-8 col-xl-10">
                                                                <input type="text" class="form-control" id="inputEmail3" placeholder="">
                                                            </div>
                                                        </div>

                                                       <div class="row mb-3">
                                                            <label for="inputEmail3" class="col-4 col-xl-2 col-form-label">First Name</label>
                                                            <div class="col-8 col-xl-10">
                                                                <input type="text" class="form-control" id="inputEmail3" placeholder="">
                                                            </div>
                                                        </div>

                                                        <div class="row mb-3">
                                                            <label for="inputEmail3" class="col-4 col-xl-2 col-form-label">Middle Name</label>
                                                            <div class="col-8 col-xl-10">
                                                                <input type="text" class="form-control" id="inputEmail3" placeholder="">
                                                            </div>
                                                        </div>

                                                        <div class="row mb-3">
                                                            <label for="inputEmail3" class="col-4 col-xl-2 col-form-label">Email Address</label>
                                                            <div class="col-8 col-xl-10">
                                                                <input type="email" class="form-control" id="inputEmail3" placeholder="">
                                                            </div>
                                                        </div>

                                                        <div class="row mb-3">
                                                            <label for="inputEmail3" class="col-4 col-xl-2 col-form-label">Position</label>
                                                            <div class="col-8 col-xl-10">
                                                                <input type="text" class="form-control" id="inputEmail3" placeholder="">
                                                            </div>
                                                        </div>

                                                        <div class="row mb-3">
                                                            <label for="inputEmail3" class="col-4 col-xl-2 col-form-label">Role</label>
                                                            <div class="col-8 col-xl-10">
                                                                <input type="text" class="form-control" id="inputEmail3" placeholder="">
                                                            </div>
                                                        </div>

                                                        <div class="justify-content-end row">
                                                            <div class="col-8 col-xl-3 d-grid">
                                                                <button type="submit" class="btn gwc-button waves-effect waves-light">UPDATE</button>
                                                            </div>
                                                        </div>
                                                    </form>


                                                </div>

                                                <div class="tab-pane" id="profile1">

                                                    <div class="row">
                                                        <div class="col-8 col-xl-3 d-grid">
                                                            <button type="button" data-bs-toggle="modal" data-bs-target="#standard-modal" class="btn gwc-button waves-effect waves-light"><i class="fe-plus"></i> ADD NEW</button>
                                                        </div>
                                                    </div>

                                                    <!-- Standard modal content -->
                                                    <div id="standard-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-lg">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title" id="standard-modalLabel">Add New [Identification]</h4>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form class="form-horizontal">
                                                                        <div class="row mb-3">
                                                                            <label for="inputEmail3" class="col-4 col-xl-2 col-form-label">ID Name</label>
                                                                            <div class="col-8 col-xl-10">
                                                                                <input type="text" class="form-control" id="inputEmail3" placeholder="">
                                                                            </div>
                                                                        </div>

                                                                        <div class="row mb-3">
                                                                            <label for="inputEmail3" class="col-4 col-xl-2 col-form-label">Category</label>
                                                                            <div class="col-8 col-xl-10">
                                                                                <select class="form-select" id="example-select">
                                                                                    <option>Primary</option>
                                                                                    <option>Secondary</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>

                                                                        <div class="row mb-3">
                                                                            <label for="inputEmail3" class="col-4 col-xl-2 col-form-label">ID Number</label>
                                                                            <div class="col-8 col-xl-10">
                                                                                <input type="text" class="form-control" id="inputEmail3" placeholder="">
                                                                            </div>
                                                                        </div>

                                                                        <div class="row mb-3">
                                                                            <label for="inputEmail3" class="col-4 col-xl-2 col-form-label">Date Issued</label>
                                                                            <div class="col-8 col-xl-10">
                                                                                <input type="email" class="form-control" id="inputEmail3" placeholder="">
                                                                            </div>
                                                                        </div>

                                                                        <div class="row mb-3">
                                                                            <label for="inputEmail3" class="col-4 col-xl-2 col-form-label">Place Issued</label>
                                                                            <div class="col-8 col-xl-10">
                                                                                <input type="text" class="form-control" id="inputEmail3" placeholder="">
                                                                            </div>
                                                                        </div>

                                                                        <div class="row mb-3">
                                                                            <label for="inputEmail3" class="col-4 col-xl-2 col-form-label">Issued By</label>
                                                                            <div class="col-8 col-xl-10">
                                                                                <input type="text" class="form-control" id="inputEmail3" placeholder="">
                                                                            </div>
                                                                        </div>

                                                                        <div class="row mb-3">
                                                                            <label for="inputEmail3" class="col-4 col-xl-2 col-form-label">Valid Until</label>
                                                                            <div class="col-8 col-xl-10">
                                                                                <input type="date" class="form-control" id="inputEmail3" placeholder="">
                                                                            </div>
                                                                        </div>

                                                                    </form>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                                    <button type="button" class="btn gwc-button">Add New</button>
                                                                </div>
                                                            </div><!-- /.modal-content -->
                                                        </div><!-- /.modal-dialog -->
                                                    </div><!-- /.modal -->

                                                    <br>
                                                    <h6 class="mt-0 header-title">Company ID</h6>
                                                    <br>
                                                    <div class="table-responsive">
                                                        <table class="table mb-0">
                                                            <thead>
                                                            <tr>
                                                                <th>ID Type</th>
                                                                <th>Category</th>
                                                                <th>ID Number</th>
                                                                <th>Date Issued</th>
                                                                <th>Place Issued</th>
                                                                <th>Issued By</th>
                                                                <th>Expiry Date</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <tr>
                                                                <th scope="row">1</th>
                                                                <td>Mark</td>
                                                                <td>Otto</td>
                                                                <td>@mdo</td>
                                                                <td>@mdo</td>
                                                                <td>@mdo</td>
                                                                <td>@mdo</td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>

                                                    <br>
                                                    <h6 class="mt-0 header-title">Government ID</h6>
                                                    <br>
                                                    <div class="table-responsive">
                                                        <table class="table mb-0">
                                                            <thead>
                                                            <tr>
                                                                <th>ID Type</th>
                                                                <th>Category</th>
                                                                <th>ID Number</th>
                                                                <th>Date Issued</th>
                                                                <th>Place Issued</th>
                                                                <th>Issued By</th>
                                                                <th>Expiry Date</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <tr>
                                                                <th scope="row">1</th>
                                                                <td>Mark</td>
                                                                <td>Otto</td>
                                                                <td>@mdo</td>
                                                                <td>@mdo</td>
                                                                <td>@mdo</td>
                                                                <td>@mdo</td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>


                                                </div>

                                                <div class="tab-pane" id="messages1">
                                                    
                                                    <form class="form-horizontal">

                                                        <input type="file" data-plugins="dropify" data-default-file="<?php echo base_url();?>public/assets/Adminto/images/small/img-2.jpg"  />
                                                        
                                                        <div class="justify-content-end row mt-3">
                                                            <div class="col-8 col-xl-3 d-grid">
                                                                <button type="submit" class="btn gwc-button waves-effect waves-light">SAVE</button>
                                                            </div>
                                                        </div>
                                                    </form>


                                                </div>
                                            </div>
                                        </div>
                                    </div> <!-- end card-->
                                </div> <!-- end col -->

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
