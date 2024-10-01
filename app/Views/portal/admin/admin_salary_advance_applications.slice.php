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
  
  #tbl_salaryAdvance tbody tr td {
    vertical-align: middle;
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

                <div class="row" id="div_salaryAdvanceList">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">

                                <table id="tbl_salaryAdvance" class="table table-sm table-bordered table-hover nowrap mb-3" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>On Board Date</th>
                                            <th>Company Name</th>
                                            <th>Company Code</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="row" id="div_salaryAdvanceUpdate" hidden>
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">

                                <input type="hidden" id="txt_companyId">
                                <input type="hidden" id="txt_subscriptionId">

                                <h4>Product Subscription</h4>

                                <hr>

                                <h5>Business Profile</h5>
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td width="30%">Business Name</td>
                                            <td>
                                                <span id="lbl_businessName"></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="30%">Business Address</td>
                                            <td>
                                                <span id="lbl_businessAddress"></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="30%">Industry</td>
                                            <td>
                                                <span id="lbl_industry"></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="30%">Contact Numbers</td>
                                            <td>
                                                <span id="lbl_contactNumbers"></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="30%">Company Email</td>
                                            <td>
                                                <span id="lbl_companyEmail"></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="30%">Company Website</td>
                                            <td>
                                                <span id="lbl_companyWebsite"></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="30%">Company Code</td>
                                            <td>
                                                <span id="lbl_companyCode"></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="30%">Representative</td>
                                            <td>
                                                <span id="lbl_representative"></span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                                <hr>

                                <h4>Product Details</h4>
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td width="30%">Product Name</td>
                                            <td>
                                                <span id="lbl_productName"></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="30%">Description</td>
                                            <td>
                                                <span id="lbl_description"></span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                                <hr>

                                <h4>Attached Documents</h4>
                                <table class="table mb-0" id="tbl_companyCorporationDocuments" width="100%" hidden>
                                    <thead>
                                        <tr>
                                            <th width="60%">List of upload documents</th>
                                            <th width="20%">Actions</th>
                                            <th width="20%">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr id="tr_corporation01">
                                            <td>BIR Certificate of Registration (2303)</td>
                                            <td>---</td>
                                            <td>---</td>
                                        </tr>
                                        <tr id="tr_corporation02">
                                            <td>SEC Regitration Certificate</td>
                                            <td>---</td>
                                            <td>---</td>
                                        </tr>
                                        <tr id="tr_corporation03">
                                            <td>Notarized Secretary’s Certificate (provided by GwC)</td>
                                            <td>---</td>
                                            <td>---</td>
                                        </tr>
                                        <tr id="tr_corporation04">
                                            <td>Articles of Incorporation</td>
                                            <td>---</td>
                                            <td>---</td>
                                        </tr>
                                        <tr id="tr_corporation05">
                                            <td>Most Recent General Information Sheet (GIS)</td>
                                            <td>---</td>
                                            <td>---</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table class="table mb-0" id="tbl_companyProprietorShipDocuments" hidden>
                                    <thead>
                                        <tr>
                                            <th width="60%">List of upload documents</th>
                                            <th width="20%">Actions</th>
                                            <th width="20%">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr id="tr_proprietorship01">
                                            <td>BIR Certificate of Registration (2303)</td>
                                            <td>---</td>
                                            <td>---</td>
                                        </tr>
                                        <tr id="tr_proprietorship02">
                                            <td>DTI Registration Document</td>
                                            <td>---</td>
                                            <td>---</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table class="table mb-0" id="tbl_companyPartnershipDocuments" hidden>
                                    <thead>
                                        <tr>
                                            <th width="60%">List of upload documents</th>
                                            <th width="20%">Actions</th>
                                            <th width="20%">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr id="tr_partnership01">
                                            <td>BIR Certificate of Registration (2303)</td>
                                            <td>---</td>
                                            <td>---</td>
                                        </tr>
                                        <tr id="tr_partnership02">
                                            <td>SEC Registration Certificate</td>
                                            <td>---</td>
                                            <td>---</td>
                                        </tr>
                                        <tr id="tr_partnership03">
                                            <td>Notarized Partner’s Certificate (provided by GwC)</td>
                                            <td>---</td>
                                            <td>---</td>
                                        </tr>
                                        <tr id="tr_partnership04">
                                            <td>Articles of Partnership</td>
                                            <td>---</td>
                                            <td>---</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table class="table" id="tbl_attachedDocuments">
                                    <thead>
                                        <tr>
                                            <th width="60%">List of upload documents</th>
                                            <th width="20%">Actions</th>
                                            <th width="20%">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr id="tr_attachment01">
                                            <td>Sworn Statement</td>
                                            <td>---</td>
                                            <td>---</td>
                                        </tr>
                                        <tr id="tr_attachment02">
                                            <td>Employee List</td>
                                            <td>---</td>
                                            <td>---</td>
                                        </tr>
                                        <tr id="tr_attachment03">
                                            <td>BIR Employee List</td>
                                            <td>---</td>
                                            <td>---</td>
                                        </tr>
                                        <tr id="tr_attachment04">
                                            <td>SSS R3</td>
                                            <td>---</td>
                                            <td>---</td>
                                        </tr>
                                    </tbody>
                                </table>

                                <hr>    

                                <h4>Evaluation Result</h4>
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td width="30%">Employee List Status</td>
                                            <td>
                                                <select class="form-control form-select" id="slc_employeeListStatus">
                                                    <option value="">--Status--</option>
                                                    <option value="APPROVE">APPROVE</option>
                                                    <option value="RESUBMIT">RESUBMIT</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="30%">Remarks</td>
                                            <td>
                                                <textarea rows="5" class="form-control" id="txt_remarks"></textarea>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                                <div style="float:right;">
                                    <button type="button" class="btn btn-danger" id="btn_backToList1">Back</button>
                                    <button type="button" class="btn btn-primary" id="btn_requestResubmission">Request Resubmission</button>
                                    <button type="button" class="btn btn-primary" id="btn_acceptSubscription">Accept</button>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="row" id="div_salaryAdvanceEmployeeList" hidden>
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">

                                <h4>Employee List</h4>

                                <table class="table table-sm table-bordered table-hover nowrap mb-3" id="tbl_employeeList" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <td>ID Number</td>
                                            <td>Last Name</td>
                                            <td>First Name</td>
                                            <td>Middle Name</td>
                                            <td>Email</td>
                                            <td>Contact Number</td>
                                            <td>Department</td>
                                            <td>Position</td>
                                            <td>Date Hired</td>
                                            <td>Gross Salary</td>
                                            <td>Net Salary</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                    </tbody>
                                </table>

                                <hr>

                                <div style="float:right;">
                                    <button type="button" class="btn btn-danger" id="btn_backToList2">Back</button>
                                </div>

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

   

    <div class="modal fade" id="modal_companyDocumentPreview" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header modal-header--sticky">
                    <h5 class="modal-title" id="lbl_modalTitle1"> 
                        <i class="feather-plus me-2"></i>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="txt_documentId">
                    <iframe src="" id="iframe_companyDocumentPreview" style="width:100%; height:70vh;"></iframe>
                </div>
                <div class="modal-footer modal-footer--sticky">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn gwc-button" id="btn_verifyDocument">Verify</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal_employeeEmailVerification" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header modal-header--sticky">
                    <h5 class="modal-title" id="lbl_modalTitle2"> 
                        Send Email Verifications
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

    ADMIN_SALARY_ADVANCE_APPLICATIONS.a_loadProductSubscriptions();

    $('#btn_verifyDocument').on('click',function(){
        ADMIN_SALARY_ADVANCE_APPLICATIONS.a_verifyCompanyDocument();
    });

    $('#btn_backToList1').on('click',function(){
        $('#div_salaryAdvanceList').prop('hidden',false);
        $('#div_salaryAdvanceEmployeeList').prop('hidden',true);
        $('#div_salaryAdvanceUpdate').prop('hidden',true);
    });

    $('#slc_employeeListStatus').on('change',function(){
        if($(this).val() == 'APPROVE')
        {
            $('#btn_requestResubmission').prop('disabled',true);
            $('#btn_acceptSubscription').prop('disabled',false);
        }
        else
        {
            $('#btn_requestResubmission').prop('disabled',false);
            $('#btn_acceptSubscription').prop('disabled',true);
        }
    }); 

    $('#btn_requestResubmission').on('click',function(){
        ADMIN_SALARY_ADVANCE_APPLICATIONS.a_failedCompanySubscription();
    });
    
    $('#btn_acceptSubscription').on('click',function(){
        ADMIN_SALARY_ADVANCE_APPLICATIONS.a_acceptCompanySubscription();
    });







    $('#btn_backToList2').on('click',function(){
        $('#div_salaryAdvanceList').prop('hidden',false);
        $('#div_salaryAdvanceEmployeeList').prop('hidden',true);
        $('#div_salaryAdvanceUpdate').prop('hidden',true);
    });




  });
</script>

@endsection
