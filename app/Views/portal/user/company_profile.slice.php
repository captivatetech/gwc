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
  table#datatable{
    width: 100% !important;
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

                                <div class="col-xl-12">
                                    <div class="card">
                                        <div class="card-body">
            
                                            <ul class="nav nav-pills navtab-bg nav-justified">
                                                <li class="nav-item">
                                                    <a href="#home1" data-bs-toggle="tab" aria-expanded="false" class="nav-link active">
                                                        COMPANY INFORMATION
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="#profile1" data-bs-toggle="tab" aria-expanded="true" class="nav-link">
                                                        DOCUMENTS
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="#messages1" data-bs-toggle="tab" aria-expanded="false" class="nav-link">
                                                        REPRESENTATIVES
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="#messages2" data-bs-toggle="tab" aria-expanded="false" class="nav-link">
                                                        COMPANY SETTINGS
                                                    </a>
                                                </li>
                                            </ul>
                                            <div class="tab-content">

                                                <div class="tab-pane show active" id="home1">

                                                    <br>
                                                    <form class="form-horizontal">
                                                    <label for="inputEmail3" class="col-4 col-xl-3 col-form-label">What is your business type?</label>   
                                                        <div class="row mb-3">
                                                           
                                                            <div class="col-8 col-xl-3">
                                                                <div class="form-check">
                                                                    <input type="radio" id="customRadio1" name="customRadio" class="form-check-input">
                                                                    <label class="form-check-label" for="customRadio1">Corporation</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-8 col-xl-3">
                                                                <div class="form-check">
                                                                    <input type="radio" id="customRadio2" name="customRadio" class="form-check-input">
                                                                    <label class="form-check-label" for="customRadio2">Sole Proprietorship</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-8 col-xl-3">
                                                                <div class="form-check">
                                                                    <input type="radio" id="customRadio3" name="customRadio" class="form-check-input">
                                                                    <label class="form-check-label" for="customRadio3">Partnership</label>
                                                                </div>
                                                            </div>
                                                        </div>

                                                       <div class="row mb-3">
                                                            <div class="col-8 col-xl-6">
                                                                <input type="text" class="form-control" id="inputEmail3" placeholder="Business Name">
                                                            </div>
                                                            <div class="col-8 col-xl-6">
                                                                <input type="text" class="form-control" id="inputEmail3" placeholder="Business Address">
                                                            </div>
                                                        </div>

                                                        <div class="row mb-3">
                                                            <div class="col-8 col-xl-6">
                                                                <select class="form-select" id="example-select">
                                                                    <option value="">Industry</option>
                                                                    <option>Secondary</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-8 col-xl-6">
                                                                <input type="text" class="form-control" id="inputEmail3" placeholder="Mobile Number">
                                                            </div>
                                                        </div>

                                                        <div class="row mb-3">
                                                            <div class="col-8 col-xl-6">
                                                                <input type="text" class="form-control" id="inputEmail3" placeholder="Telephone Number">
                                                            </div>
                                                            <div class="col-8 col-xl-6">
                                                                <input type="text" class="form-control" id="inputEmail3" placeholder="Company Email">
                                                            </div>
                                                        </div>

                                                        <div class="row mb-3">
                                                            <div class="col-8 col-xl-6">
                                                                <input type="text" class="form-control" id="inputEmail3" placeholder="Company Website">
                                                            </div>
                                                            <div class="col-8 col-xl-6">
                                                                <input type="text" class="form-control" id="inputEmail3" placeholder="Company Code" readonly>
                                                            </div>
                                                        </div>

                                                        <div class="justify-content-end row">
                                                            <div class="col-8 col-xl-3 d-grid">
                                                                <button type="submit" class="btn gwc-button waves-effect waves-light">SAVE</button>
                                                            </div>
                                                        </div>
                                                    </form>


                                                </div>

                                                <div class="tab-pane" id="profile1">
                                                    
                                                    <!-- PARTNERSHIP -->
                                                    <br>
                                                    <h6 class="mt-0 header-title">Business Type: Partnership</h6>
                                                    <p>Upload necessary docs: PDF file only</p>
                                                    <br>
                                                    <div class="table-responsive">
                                                        <table class="table mb-0">
                                                            <thead>
                                                            <tr>
                                                                <th>Status</th>
                                                                <th>Document Type</th>
                                                                <th>Data File</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <tr>
                                                                <th scope="row" width="10%">1</th>
                                                                <td>TIN (Tax Identification Number)</td>
                                                                <td><input type="text" class="form-control" id="inputEmail3" placeholder="000-000-000-000"></td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row" width="10%">1</th>
                                                                <td>BIR Certificate of Registration (2303)</td>
                                                                <td><input class="form-control" type="file" id="inputGroupFile04"></td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row" width="10%">1</th>
                                                                <td>SEC Registrtion Certificate</td>
                                                                <td><input class="form-control" type="file" id="inputGroupFile04"></td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row" width="10%">1</th>
                                                                <td>Notarized Partner’s Certificate (provided by GwC)</td>
                                                                <td><input class="form-control" type="file" id="inputGroupFile04"></td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row" width="10%">1</th>
                                                                <td>Articles of Partnership</td>
                                                                <td><input class="form-control" type="file" id="inputGroupFile04"></td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>

                                                    <!-- Sole Propreitorship -->
                                                    <br>
                                                    <h6 class="mt-0 header-title">Business Type: Sole Propreitorship</h6>
                                                    <p>Upload necessary docs: PDF file only</p>
                                                    <br>
                                                    <div class="table-responsive">
                                                        <table class="table mb-0">
                                                            <thead>
                                                            <tr>
                                                                <th>Status</th>
                                                                <th>Document Type</th>
                                                                <th>Data File</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <tr>
                                                                <th scope="row" width="10%">1</th>
                                                                <td>TIN (Tax Identification Number)</td>
                                                                <td><input type="text" class="form-control" id="inputEmail3" placeholder="000-000-000-000"></td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row" width="10%">1</th>
                                                                <td>BIR Certificate of Registration (2303)</td>
                                                                <td><input class="form-control" type="file" id="inputGroupFile04"></td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row" width="10%">1</th>
                                                                <td>DTI Registration Document</td>
                                                                <td><input class="form-control" type="file" id="inputGroupFile04"></td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>


                                                    <!-- Corporation -->
                                                    <br>
                                                    <h6 class="mt-0 header-title">Business Type: Corporation</h6>
                                                    <p>Upload necessary docs: PDF file only</p>
                                                    <br>
                                                    <div class="table-responsive">
                                                        <table class="table mb-0">
                                                            <thead>
                                                            <tr>
                                                                <th>Status</th>
                                                                <th>Document Type</th>
                                                                <th>Data File</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <tr>
                                                                <th scope="row" width="10%">1</th>
                                                                <td>TIN (Tax Identification Number)</td>
                                                                <td><input type="text" class="form-control" id="inputEmail3" placeholder="000-000-000-000"></td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row" width="10%">1</th>
                                                                <td>BIR Certificate of Registration (2303)</td>
                                                                <td><input class="form-control" type="file" id="inputGroupFile04"></td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row" width="10%">1</th>
                                                                <td>SEC Regitration Certificate</td>
                                                                <td><input class="form-control" type="file" id="inputGroupFile04"></td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row" width="10%">1</th>
                                                                <td>Notarized Secretary’s Certificate  (provided by GwC)</td>
                                                                <td><input class="form-control" type="file" id="inputGroupFile04"></td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row" width="10%">1</th>
                                                                <td>Articles of Incorporation</td>
                                                                <td><input class="form-control" type="file" id="inputGroupFile04"></td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row" width="10%">1</th>
                                                                <td>Most Recent General Information Sheet (GIS) </td>
                                                                <td><input class="form-control" type="file" id="inputGroupFile04"></td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>


                                                </div>

                                                <div class="tab-pane" id="messages1">
                                                        <br>
                                                        <h6 class="mt-0 header-title">Authorized Person to Represent Company</h6>
                                                        <br>
                                                        <form class="form-horizontal">

                                                            <div class="row mb-3">
                                                                <div class="col-8 col-xl-6">
                                                                    <input type="text" class="form-control" id="inputEmail3" placeholder="Full Name">
                                                                </div>
                                                                <div class="col-8 col-xl-6">
                                                                    <input type="text" class="form-control" id="inputEmail3" placeholder="Position in the company">
                                                                </div>
                                                            </div>

                                                            <div class="row mb-3">
                                                                <div class="col-8 col-xl-6">
                                                                    <input type="email" class="form-control" id="inputEmail3" placeholder="Email Address">
                                                                </div>
                                                                <div class="col-8 col-xl-6">
                                                                    <input type="text" class="form-control" id="inputEmail3" placeholder="Phone Number">
                                                                </div>
                                                            </div>

                                                            <h6 class="mt-0 header-title">Presented Identification Documents</h6>
                                                            <br>
                                                            <div class="table-responsive">
                                                                <table class="table mb-0">
                                                                    <tbody>
                                                                    <tr>
                                                                        <td>Company ID</td>
                                                                        <td><input class="form-control" type="file" id="inputGroupFile04"></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>UMID ID</td>
                                                                        <td><input class="form-control" type="file" id="inputGroupFile04"></td>
                                                                    </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>

                                                            <br><br>
                                                            <table id="datatable" class="table table-bordered dt-responsive table-responsive nowrap">
                                                                <thead>
                                                                <tr>
                                                                    <th>Roles</th>
                                                                    <th>Names</th>
                                                                    <th>Id’s Presented</th>
                                                                </thead>
                        
                        
                                                                <tbody>
                                                                <tr>
                                                                    <td>HR / Personnel Officer</td>
                                                                    <td>Maria Makiling</td>
                                                                    <td>Company Id, UMID</td>
                                                                </tr>
                                                                </tbody>
                                                            </table>

                                                            <br>

                                                            <div class="justify-content-end row">
                                                                <div class="col-8 col-xl-3 d-grid">
                                                                    <button type="submit" class="btn gwc-button waves-effect waves-light">SAVE</button>
                                                                </div>
                                                            </div>
                                                        </form>


                                                </div>


                                                <div class="tab-pane show" id="messages2">

                                                    <br>
                                                    <h6 class="mt-0 header-title">Company Settings</h6>
                                                    <form class="form-horizontal">
                                                    <br>
                                                        <div class="row mb-3">
                                                            <label for="inputEmail3" class="col-4 col-xl-2 col-form-label">Bank Depository</label>
                                                            <div class="col-8 col-xl-10">
                                                                <input type="text" class="form-control" id="inputEmail3" placeholder="">
                                                            </div>
                                                        </div>

                                                        <div class="row mb-3">
                                                            <label for="inputEmail3" class="col-4 col-xl-2 col-form-label">Branch Name</label>
                                                            <div class="col-8 col-xl-10">
                                                                <input type="text" class="form-control" id="inputEmail3" placeholder="">
                                                            </div>
                                                        </div>

                                                        <div class="row mb-3">
                                                            <label for="inputEmail3" class="col-4 col-xl-2 col-form-label">Branch Code</label>
                                                            <div class="col-8 col-xl-10">
                                                                <input type="text" class="form-control" id="inputEmail3" placeholder="">
                                                            </div>
                                                        </div>

                                                        <div class="row mb-3">
                                                            <label for="inputEmail3" class="col-4 col-xl-8 col-form-label">Payroll Payout Dates</label>
                                                            <label for="inputEmail3" class="col-4 col-xl-4 col-form-label">Payroll Cut-off Period</label>
                                                        </div>

                                                        
                                                        <div class="row mb-3">
                                                            <label for="inputEmail3" class="col-4 col-xl-2 col-form-label">First</label>
                                                            <div class="col-8 col-xl-3">
                                                                <input type="text" class="form-control" id="inputEmail3" placeholder="">
                                                            </div>
                                                            <div class="col-8 col-xl-1">
                                                                
                                                            </div>
                                                            <div class="col-8 col-xl-3">
                                                                <input type="text" class="form-control" id="inputEmail3" placeholder="">
                                                            </div>
                                                            <div class="col-8 col-xl-3">
                                                                <input type="text" class="form-control" id="inputEmail3" placeholder="">
                                                            </div>
                                                        </div>

                                                        <div class="row mb-3">
                                                            <label for="inputEmail3" class="col-4 col-xl-2 col-form-label">Second</label>
                                                            <div class="col-8 col-xl-3">
                                                                <input type="text" class="form-control" id="inputEmail3" placeholder="">
                                                            </div>
                                                            <div class="col-8 col-xl-1">
                                                                
                                                            </div>
                                                            <div class="col-8 col-xl-3">
                                                                <input type="text" class="form-control" id="inputEmail3" placeholder="">
                                                            </div>
                                                            <div class="col-8 col-xl-3">
                                                                <input type="text" class="form-control" id="inputEmail3" placeholder="">
                                                            </div>
                                                        </div>

                                                        <br>
                                                        <h6 class="mt-0 header-title">Add User Option</h6>

                                                        <div class="row mb-3">
                                                            <label for="inputEmail3" class="col-4 col-xl-2 col-form-label">HR / Personnel Officer</label>
                                                            <div class="col-8 col-xl-3">
                                                                <input type="text" class="form-control" id="inputEmail3" placeholder="">
                                                            </div>
                                                        </div>

                                                        <div class="row mb-3">
                                                            <label for="inputEmail3" class="col-4 col-xl-2 col-form-label">Billing & Payment Officer</label>
                                                            <div class="col-8 col-xl-3">
                                                                <input type="text" class="form-control" id="inputEmail3" placeholder="">
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class="justify-content-end row">
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
