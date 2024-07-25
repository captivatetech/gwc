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

                @if($businessType == "")
                <h1>Please complete your personal details and your company profile!</h1>
                <p>Click <a href="<?php echo base_url('portal/representative/profile'); ?>">here</a> to update your profile and <a href="<?php echo base_url('portal/representative/company-profile'); ?>">here</a> for company profile.</p>
                @else
                <div class="row" id="div_financingProducts">

                    <input type="hidden" id="txt_companyId" value="{{ $companyId }}">
                    <input type="hidden" id="txt_businessType" value="{{ $businessType }}">

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

                                <center>
                                    <button type="button" class="btn gwc-button" id="btn_applySalaryAdvance">APPLY NOW</button>
                                </center>
                
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

                <div id="div_financingProductPreview" hidden>
                    <div class="card">
                        <div class="card-body">

                            <form id="form_financingProduct">
                                    
                                <input type="hidden" id="txt_productId" name="txt_productId">

                                <div class="container">
                                    <h4>Business Profile</h4>
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td width="20%">Business Name</td>
                                                <td><span id="lbl_businessName"></span></td>
                                            </tr>
                                            <tr>
                                                <td width="20%">Business Address</td>
                                                <td><span id="lbl_businessAddress"></span></td>
                                            </tr>
                                            <tr>
                                                <td width="20%">Industry</td>
                                                <td><span id="lbl_industry"></span></td>
                                            </tr>
                                            <tr>
                                                <td width="20%">Contact Numbers</td>
                                                <td><span id="lbl_contactNumbers"></span></td>
                                            </tr>
                                            <tr>
                                                <td width="20%">Company Email</td>
                                                <td><span id="lbl_companyEmail"></span></td>
                                            </tr>
                                            <tr>
                                                <td width="20%">Company Website</td>
                                                <td><span id="lbl_companyWebsite"></span></td>
                                            </tr>
                                            <tr>
                                                <td width="20%">Company Code</td>
                                                <td><span id="lbl_companyCode"></span></td>
                                            </tr>
                                            <tr>
                                                <td width="20%">Representative</td>
                                                <td><span id="lbl_representative"></span></td>
                                            </tr>
                                        </tbody>
                                    </table>

                                    <hr>

                                    <h4>Product Details</h4>
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td width="20%">Product Name</td>
                                                <td><span id="lbl_productName"></span></td>
                                            </tr>
                                            <tr>
                                                <td width="20%">Description</td>
                                                <td><span id="lbl_description"></span></td>
                                            </tr>
                                        </tbody>
                                    </table>

                                    <hr>

                                    <h4>Documents</h4>
                                    <div class="table-responsive">
                                        <table class="table mb-0" id="tbl_companyCorporationDocuments" hidden>
                                            <thead>
                                                <tr>
                                                    <th><center>Status</center></th>
                                                    <th>List of upload documents</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr id="tr_corporation01">
                                                    <td>
                                                        <center>
                                                            <i class="fe-disc text-danger"></i>
                                                        </center>
                                                    </td>
                                                    <td>BIR Certificate of Registration (2303)</td>
                                                    <td>---</td>
                                                </tr>
                                                <tr id="tr_corporation02">
                                                    <td>
                                                        <center>
                                                            <i class="fe-disc text-danger"></i>
                                                        </center>
                                                    </td>
                                                    <td>SEC Regitration Certificate</td>
                                                    <td>---</td>
                                                </tr>
                                                <tr id="tr_corporation03">
                                                    <td>
                                                        <center>
                                                            <i class="fe-disc text-danger"></i>
                                                        </center>
                                                    </td>
                                                    <td>Notarized Secretary’s Certificate (provided by GwC)</td>
                                                    <td>---</td>
                                                </tr>
                                                <tr id="tr_corporation04">
                                                    <td>
                                                        <center>
                                                            <i class="fe-disc text-danger"></i>
                                                        </center>
                                                    </td>
                                                    <td>Articles of Incorporation</td>
                                                    <td>---</td>
                                                </tr>
                                                <tr id="tr_corporation05">
                                                    <td>
                                                        <center>
                                                            <i class="fe-disc text-danger"></i>
                                                        </center>
                                                    </td>
                                                    <td>Most Recent General Information Sheet (GIS)</td>
                                                    <td>---</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <table class="table mb-0" id="tbl_companyProprietorShipDocuments" hidden>
                                            <thead>
                                                <tr>
                                                    <th><center>Status</center></th>
                                                    <th>List of upload documents</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr id="tr_proprietorship01">
                                                    <td>
                                                        <center>
                                                            <i class="fe-disc text-danger"></i>
                                                        </center>
                                                    </td>
                                                    <td>BIR Certificate of Registration (2303)</td>
                                                    <td>---</td>
                                                </tr>
                                                <tr id="tr_proprietorship02">
                                                    <td>
                                                        <center>
                                                            <i class="fe-disc text-danger"></i>
                                                        </center>
                                                    </td>
                                                    <td>DTI Registration Document</td>
                                                    <td>---</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <table class="table mb-0" id="tbl_companyPartnershipDocuments" hidden>
                                            <thead>
                                                <tr>
                                                    <th><center>Status</center></th>
                                                    <th>List of upload documents</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr id="tr_partnership01">
                                                    <td>
                                                        <center>
                                                            <i class="fe-disc text-danger"></i>
                                                        </center>
                                                    </td>
                                                    <td>BIR Certificate of Registration (2303)</td>
                                                    <td>---</td>
                                                </tr>
                                                <tr id="tr_partnership02">
                                                    <td>
                                                        <center>
                                                            <i class="fe-disc text-danger"></i>
                                                        </center>
                                                    </td>
                                                    <td>SEC Registration Certificate</td>
                                                    <td>---</td>
                                                </tr>
                                                <tr id="tr_partnership03">
                                                    <td>
                                                        <center>
                                                            <i class="fe-disc text-danger"></i>
                                                        </center>
                                                    </td>
                                                    <td>Notarized Partner’s Certificate (provided by GwC)</td>
                                                    <td>---</td>
                                                </tr>
                                                <tr id="tr_partnership04">
                                                    <td>
                                                        <center>
                                                            <i class="fe-disc text-danger"></i>
                                                        </center>
                                                    </td>
                                                    <td>Articles of Partnership</td>
                                                    <td>---</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <br>
                                <center>
                                    <button type="button" class="btn btn-light" id="btn_backToFinancingProducts" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn gwc-button" id="btn_submitFinancingProduct">Submit</button>
                                </center>

                            </form>

                        </div>
                    </div>
                </div>
                @endif

                <input type="hidden" id="txt_baseUrl" value="<?php echo base_url(); ?>">

            </div> <!-- container-fluid -->

        </div> <!-- content -->

    </div>
    <!-- ============================================================== -->
    <!-- End Page content -->
    <!-- ============================================================== -->

    <div class="modal fade" id="modal_companyDocumentPreview" tabindex="-1" >
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header modal-header--sticky">
                    <h5 class="modal-title" id="lbl_modalTitle"> 
                        <i class="feather-plus me-2"></i> Preview
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <iframe src="" id="iframe_companyDocumentPreview" style="width:100%; height:70vh;"></iframe>
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
    
    $('#btn_applySalaryAdvance').on('click',function(){
        $('#div_financingProducts').prop('hidden',true);
        $('#div_financingProductPreview').prop('hidden',false);
        REPRESENTATIVE_FINANCING_PRODUCTS.r_selectCompanyInformation($('#txt_companyId').val());
        REPRESENTATIVE_FINANCING_PRODUCTS.r_selectProductInformation('Salary-Advance');
        REPRESENTATIVE_FINANCING_PRODUCTS.r_loadCompanyDocuments($('#txt_companyId').val());
    });

    $('#btn_backToFinancingProducts').on('click',function(){
        $('#div_financingProducts').prop('hidden',false);
        $('#div_financingProductPreview').prop('hidden',true);
    });

    $('#form_financingProduct').on('submit',function(e){
        e.preventDefault();
        REPRESENTATIVE_FINANCING_PRODUCTS.addFinancingProduct(this);
    });
  });
</script>

@endsection
