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
                                        <a href="#div_repInformation" data-bs-toggle="tab" aria-expanded="false" class="nav-link active">
                                            INFORMATION
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#div_repIdentification" data-bs-toggle="tab" aria-expanded="true" class="nav-link">
                                            IDENTIFICATION
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#div_repProfileImage" data-bs-toggle="tab" aria-expanded="false" class="nav-link">
                                            PROFILE IMAGE
                                        </a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane show active" id="div_repInformation">

                                        <br>
                                        <form class="form-horizontal" id="form_repInformation">
                                            <input type="hidden" id="txt_employeeId" name="txt_employeeId">
                                            <div class="row mb-3">
                                                <label for="txt_lastName" class="col-4 col-xl-2 col-form-label">Last Name</label>
                                                <div class="col-8 col-xl-10">
                                                    <input type="text" class="form-control" id="txt_lastName" name="txt_lastName" placeholder="" required>
                                                </div>
                                            </div>

                                           <div class="row mb-3">
                                                <label for="txt_firstName" class="col-4 col-xl-2 col-form-label">First Name</label>
                                                <div class="col-8 col-xl-10">
                                                    <input type="text" class="form-control" id="txt_firstName" name="txt_firstName" placeholder="" required>
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label for="txt_middleName" class="col-4 col-xl-2 col-form-label">Middle Name</label>
                                                <div class="col-8 col-xl-10">
                                                    <input type="text" class="form-control" id="txt_middleName" name="txt_middleName" placeholder=""required>
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label for="txt_position" class="col-4 col-xl-2 col-form-label">Position</label>
                                                <div class="col-8 col-xl-10">
                                                    <input type="text" class="form-control" id="txt_position" name="txt_position" placeholder="" required>
                                                </div>
                                            </div>
                                            
                                            <div class="row mb-3">
                                                <label for="txt_emailAddress" class="col-4 col-xl-2 col-form-label">Email Address</label>
                                                <div class="col-8 col-xl-10">
                                                    <input type="email" class="form-control" id="txt_emailAddress" name="txt_emailAddress" placeholder="" readonly>
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label for="txt_role" class="col-4 col-xl-2 col-form-label">Role</label>
                                                <div class="col-8 col-xl-10">
                                                    <input type="text" class="form-control" id="txt_role" name="txt_role" placeholder="" readonly>
                                                </div>
                                            </div>

                                            <div class="justify-content-end row">
                                                <div class="col-8 col-xl-3 d-grid">
                                                    <button type="submit" class="btn gwc-button waves-effect waves-light" id="btn_submitRepInformation">UPDATE</button>
                                                </div>
                                            </div>
                                        </form>


                                    </div>

                                    <div class="tab-pane" id="div_repIdentification">

                                        <div class="row">
                                            <div class="col-8 col-xl-3 d-grid">
                                                <button type="button" class="btn gwc-button waves-effect waves-light" id="btn_repIdentification"><i class="fe-plus"></i> ADD NEW</button>
                                            </div>
                                        </div>

                                        <br>
                                        <h6 class="mt-0 header-title">PRIMARY ID</h6>
                                        <br>
                                        <!-- <div class="table-responsive"> -->
                                            <table class="table mb-0" id="tbl_primaryId">
                                                <thead>
                                                    <tr>
                                                        <th>ID Type</th>
                                                        <th>ID Number</th>
                                                        <th>Date Issued</th>
                                                        <th>Place Issued</th>
                                                        <th>Issued By</th>
                                                        <th>Expiry Date</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                
                                                </tbody>
                                            </table>
                                        <!-- </div> -->

                                        <br>
                                        <h6 class="mt-0 header-title">SECONDARY ID</h6>
                                        <br>
                                        <!-- <div class="table-responsive"> -->
                                            <table class="table mb-0" id="tbl_secondaryId">
                                                <thead>
                                                    <tr>
                                                        <th>ID Type</th>
                                                        <th>ID Number</th>
                                                        <th>Date Issued</th>
                                                        <th>Place Issued</th>
                                                        <th>Issued By</th>
                                                        <th>Expiry Date</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                
                                                </tbody>
                                            </table>
                                        <!-- </div> -->

                                    </div>

                                    <div class="tab-pane" id="div_repProfileImage">
                                        
                                        <form class="form-horizontal" id="form_repProfilePicture">

                                            <input type="file" id="file_profilePicture" name="file_profilePicture" data-plugins="dropify" accept="image/*" data-default-file="<?php echo base_url(); ?>public/assets/uploads/representative/profiles/{{ $profilePicture }}" required />
                                            
                                            <div class="justify-content-end row mt-3">
                                                <div class="col-8 col-xl-3 d-grid">
                                                    <button type="submit" class="btn gwc-button waves-effect waves-light" id="btn_submitProfilePicture">SAVE</button>
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

                <input type="hidden" id="txt_baseUrl" value="<?php echo base_url(); ?>">   
                
            </div> <!-- container-fluid -->

        </div> <!-- content -->

    </div>
    <!-- ============================================================== -->
    <!-- End Page content -->
    <!-- ============================================================== -->

    <div class="modal fade" id="modal_repIdentification" tabindex="-1" >
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header modal-header--sticky">
                    <h5 class="modal-title"> 
                        <i class="feather-plus me-2"></i> Add New Identification
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" id="form_repIdentification">
                        <div class="row mb-3">
                            <label for="txt_type" class="col-4 col-xl-2 col-form-label">ID Name</label>
                            <div class="col-8 col-xl-10">
                                <select class="form-control form-select" id="slc_type" name="slc_type">
                                    <option value="">---</option>
                                    <option value="PRIMARY=NATIONAL-ID"><i>(Primary)</i> NATIONAL-ID</option>
                                    <option value="PRIMARY=PASSPORT-ID"><i>(Primary)</i> PASSPORT-ID</option>
                                    <option value="PRIMARY=DRIVERS-LICENSE"><i>(Primary)</i> DRIVERS-LICENSE</option>
                                    <option value="PRIMARY=SSS-GSIS"><i>(Primary)</i> SSS-GSIS</option>
                                    <option value="PRIMARY=PRC"><i>(Primary)</i> PRC</option>
                                    <option value="PRIMARY=POSTAL-ID"><i>(Primary)</i> POSTAL-ID</option>
                                    <option value="PRIMARY=VOTERS-ID"><i>(Primary)</i> VOTERS-ID</option>
                                    <option value="PRIMARY=UMID"><i>(Primary)</i> UMID</option>
                                    <option value="PRIMARY=ACR-IMMIGRANT-COR"><i>(Primary)</i> ACR-IMMIGRANT-COR</option>
                                    <option value="SECONDARY=AFP-ID"><i>(Secondary)</i> AFP-ID</option>
                                    <option value="SECONDARY=PNP-ID"><i>(Secondary)</i> PNP-ID</option>
                                    <option value="SECONDARY=BFP-ID"><i>(Secondary)</i> BFP-ID</option>
                                    <option value="SECONDARY=PWD-ID"><i>(Secondary)</i> PWD-ID</option>
                                    <option value="SECONDARY=DSWD-CERTIFICATION"><i>(Secondary)</i> DSWD-CERTIFICATION</option>
                                    <option value="SECONDARY=GSIS-ECARD"><i>(Secondary)</i> GSIS-ECARD</option>
                                    <option value="SECONDARY=OFW-ID"><i>(Secondary)</i> OFW-ID</option>
                                    <option value="SECONDARY=POLICE-CLEARANCE"><i>(Secondary)</i> POLICE-CLEARANCE</option>
                                    <option value="SECONDARY=SEAMANS-BOOK"><i>(Secondary)</i> SEAMANS-BOOK</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="txt_idNumber" class="col-4 col-xl-2 col-form-label">ID Number</label>
                            <div class="col-8 col-xl-10">
                                <input type="text" class="form-control" id="txt_idNumber" name="txt_idNumber" placeholder="" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="txt_dateIssued" class="col-4 col-xl-2 col-form-label">Date Issued</label>
                            <div class="col-8 col-xl-10">
                                <input type="date" class="form-control" id="txt_dateIssued" name="txt_dateIssued" placeholder="" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="txt_placeIssued" class="col-4 col-xl-2 col-form-label">Place Issued</label>
                            <div class="col-8 col-xl-10">
                                <input type="text" class="form-control" id="txt_placeIssued" name="txt_placeIssued" placeholder="" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="txt_issuedBy" class="col-4 col-xl-2 col-form-label">Issued By</label>
                            <div class="col-8 col-xl-10">
                                <input type="text" class="form-control" id="txt_issuedBy" name="txt_issuedBy" placeholder="">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="txt_expiryDate" class="col-4 col-xl-2 col-form-label">Valid Until</label>
                            <div class="col-8 col-xl-10">
                                <input type="date" class="form-control" id="txt_expiryDate" name="txt_expiryDate" placeholder="">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="file_idPicture" class="col-4 col-xl-2 col-form-label">Upload Picture</label>
                            <div class="col-8 col-xl-10">
                                <input type="file" id="file_idPicture" name="file_idPicture" data-plugins="dropify" accept="image/*" required/>
                            </div>
                        </div>

                    </form>
                </div>
                <div class="modal-footer modal-footer--sticky">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn gwc-button" id="btn_submitRepIdentification" form="form_repIdentification">Submit</button>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="modal_repIdentificationPreview" tabindex="-1" >
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header modal-header--sticky">
                    <h5 class="modal-title" id="lbl_modalTitle"> 
                        <i class="feather-plus me-2"></i> Preview Identification
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img src="" id="img_repIdentificationPreview" alt="image" class="img-fluid img-thumbnail" width="100%">
                </div>
            </div>
        </div>
    </div>

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
<script type="text/javascript" src="<?php echo base_url(); ?>public/assets/js/custom/representative/{{ $customScripts }}.js"></script>

<script type="text/javascript">
  $(document).ready(function(){
    //jQuery Events
    
    REPRESENTATIVE_PROFILE.selectRepresentativeInformation();
    REPRESENTATIVE_PROFILE.loadRepresentativeIdentifications();

    $('#form_repInformation').on('submit',function(e){
        e.preventDefault();
        REPRESENTATIVE_PROFILE.editRepresentativeInformation(this);
    });

    $('#btn_repIdentification').on('click',function(){
        $('#modal_repIdentification').modal('show');
    });

    $('#form_repIdentification').on('submit',function(e){
        e.preventDefault();
        REPRESENTATIVE_PROFILE.addRepresentativeIdentification(this);
    });

    $('#form_repProfilePicture').on('submit',function(e){
        e.preventDefault();
        REPRESENTATIVE_PROFILE.editRepresentativeProfilePicture(this);
    });
    
  });
</script>

@endsection