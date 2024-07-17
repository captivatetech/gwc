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

                @if($companyId == null)
                <h1>Please update your profile first to activate this module.</h1>
                <p>Click <a href="<?php echo base_url('portal/representative/profile'); ?>">here</a> to update your profile.</p>
                @else
                <div class="row">

                        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-body">
                                    
                                    <ul class="nav nav-pills navtab-bg nav-justified">
                                        <li class="nav-item">
                                            <a href="#div_companyInformation" data-bs-toggle="tab" aria-expanded="false" class="nav-link active">
                                                COMPANY INFORMATION
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            @if($businessType == null)
                                            <a href="javascript:void(0)" onclick="alert('Please save company information!')" aria-expanded="true" class="nav-link" disabled>
                                                DOCUMENTS
                                            </a>
                                            @else
                                            <a href="#div_companyDocuments" data-bs-toggle="tab" aria-expanded="true" class="nav-link">
                                                DOCUMENTS
                                            </a>
                                            @endif
                                        </li>
                                        <li class="nav-item">
                                            @if($businessType == null)
                                            <a href="javascript:void(0)" onclick="alert('Please save company information!')" aria-expanded="false" class="nav-link">
                                                COMPANY SETTINGS
                                            </a>
                                            @else
                                            <a href="#div_companySettings" data-bs-toggle="tab" aria-expanded="false" class="nav-link">
                                                COMPANY SETTINGS
                                            </a>
                                            @endif
                                        </li>
                                        <li class="nav-item">
                                            @if($businessType == null)
                                            <a href="javascript:void(0)" onclick="alert('Please save company information!')" aria-expanded="false" class="nav-link">
                                                REPRESENTATIVES
                                            </a>
                                            @else
                                                @if($hrUser == null && $bpoUser == null)
                                                <a href="javascript:void(0)" onclick="alert('You cannot add representative!')" aria-expanded="false" class="nav-link">
                                                    REPRESENTATIVES
                                                </a>
                                                @else
                                                <a href="#div_companyRepresentatives" data-bs-toggle="tab" aria-expanded="false" class="nav-link">
                                                    REPRESENTATIVES
                                                </a>
                                                @endif
                                            @endif
                                        </li>
                                    </ul>
                                    <div class="tab-content">

                                        <div class="tab-pane show active" id="div_companyInformation">

                                            <br>
                                            <form class="form-horizontal" id="form_companyInformation">
                                                
                                                <input type="hidden" id="txt_companyId" name="txt_companyId" value="{{ $companyId }}">
                                                <input type="hidden" id="txt_businessType" name="txt_businessType" value="{{ $businessType }}">

                                                <label class="col-4 col-xl-3 col-form-label">What is your business type?</label>   
                                                <div class="row mb-3">
                                                   
                                                    <div class="col-8 col-xl-3">
                                                        <div class="form-check">
                                                            <input type="radio" id="rdb_corporation" name="rdb_businessType" class="form-check-input" value="Corporation" checked>
                                                            <label class="form-check-label" for="rdb_corporation">Corporation</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-8 col-xl-3">
                                                        <div class="form-check">
                                                            <input type="radio" id="rdb_proprietorship" name="rdb_businessType" class="form-check-input" value="Proprietorship">
                                                            <label class="form-check-label" for="rdb_proprietorship">Sole Proprietorship</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-8 col-xl-3">
                                                        <div class="form-check">
                                                            <input type="radio" id="rdb_partnership" name="rdb_businessType" class="form-check-input" value="Partnership">
                                                            <label class="form-check-label" for="rdb_partnership">Partnership</label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <div class="col-8 col-xl-6">
                                                        <input type="text" class="form-control" id="txt_businessName" name="txt_businessName" placeholder="Business Name" required>
                                                    </div>
                                                    <div class="col-8 col-xl-6">
                                                        <input type="text" class="form-control" id="txt_businessAddress" name="txt_businessAddress" placeholder="Business Address" required>
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <div class="col-8 col-xl-6">
                                                        <select class="form-select" id="slc_industry" name="slc_industry" required>
                                                            <option value="">Industry</option>
                                                            <option>Secondary</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-8 col-xl-6">
                                                        <input type="text" class="form-control" id="txt_mobileNumber" name="txt_mobileNumber" placeholder="Mobile Number" required>
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <div class="col-8 col-xl-6">
                                                        <input type="text" class="form-control" id="txt_telephoneNumber" name="txt_telephoneNumber" placeholder="Telephone Number" required>
                                                    </div>
                                                    <div class="col-8 col-xl-6">
                                                        <input type="text" class="form-control" id="txt_companyEmail" name="txt_companyEmail" placeholder="Company Email" required>
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <div class="col-8 col-xl-6">
                                                        <input type="text" class="form-control" id="txt_companyWebsite" name="txt_companyWebsite" placeholder="Company Website" required>
                                                    </div>
                                                    <div class="col-8 col-xl-6">
                                                        <input type="text" class="form-control" id="txt_taxIdentificationNumber" name="txt_taxIdentificationNumber" placeholder="Tax Identification Number" required>
                                                    </div>
                                                </div>

                                                <div class="justify-content-end row">
                                                    <div class="col-8 col-xl-3 d-grid">
                                                        <button type="submit" class="btn gwc-button waves-effect waves-light" id="btn_submitCompanyInformation">SAVE</button>
                                                    </div>
                                                </div>
                                            </form>


                                        </div>

                                        <div class="tab-pane" id="div_companyDocuments">
                                            
                                            @if($businessType == 'Partnership')
                                            <!-- PARTNERSHIP -->
                                            <div id="div_partnership">
                                                <br>
                                                <h6 class="mt-0 header-title">Business Type: Partnership</h6>
                                                <p>Upload necessary docs: PDF file only</p>
                                                <br>
                                                <div class="table-responsive">
                                                    <table class="table mb-0">
                                                        <thead>
                                                        <tr>
                                                            <th><center>Status</center></th>
                                                            <th>Document Type</th>
                                                            <th>Data File</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <tr>
                                                            <th scope="row" width="10%" id="th_partnership01">
                                                                <center>
                                                                    <i class="fe-disc text-danger"></i>
                                                                </center>
                                                            </th>
                                                            <td>BIR Certificate of Registration (2303)</td>
                                                            <td width="10%">
                                                                <center>
                                                                    <a href="javascript:void(0)" id="btn_partnership01" onclick="REPRESENTATIVE_COMPANY_PROFILE.r_openCompanyDocumentModal('','Partnership-01','BIR Certificate of Registration (2303)');">
                                                                        <i class="fe-upload"></i>
                                                                    </a>
                                                                </center>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row" width="10%" id="th_partnership02">
                                                                <center>
                                                                    <i class="fe-disc text-danger"></i>
                                                                </center>
                                                            </th>
                                                            <td>SEC Registrtion Certificate</td>
                                                            <td width="10%">
                                                                <center>
                                                                    <a href="javascript:void(0)" id="btn_partnership02" onclick="REPRESENTATIVE_COMPANY_PROFILE.r_openCompanyDocumentModal('','Partnership-02','SEC Registrtion Certificate');">
                                                                        <i class="fe-upload"></i>
                                                                    </a>
                                                                </center>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row" width="10%" id="th_partnership03">
                                                                <center>
                                                                    <i class="fe-disc text-danger"></i>
                                                                </center>
                                                            </th>
                                                            <td>Notarized Partner’s Certificate (provided by GwC)</td>
                                                            <td width="10%">
                                                                <center>
                                                                    <a href="javascript:void(0)" id="btn_partnership03" onclick="REPRESENTATIVE_COMPANY_PROFILE.r_openCompanyDocumentModal('','Partnership-03','Notarized Partner’s Certificate (provided by GwC)');">
                                                                        <i class="fe-upload"></i>
                                                                    </a>
                                                                </center>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row" width="10%" id="th_partnership04">
                                                                <center>
                                                                    <i class="fe-disc text-danger"></i>
                                                                </center>
                                                            </th>
                                                            <td>Articles of Partnership</td>
                                                            <td width="10%">
                                                                <center>
                                                                    <a href="javascript:void(0)" id="btn_partnership04" onclick="REPRESENTATIVE_COMPANY_PROFILE.r_openCompanyDocumentModal('','Partnership-04','Articles of Partnership');">
                                                                        <i class="fe-upload"></i>
                                                                    </a>
                                                                </center>
                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            @elseif($businessType == 'Proprietorship')
                                            <!-- Sole Propreitorship -->
                                            <div id="div_propreitorship">
                                                <br>
                                                <h6 class="mt-0 header-title">Business Type: Sole Propreitorship</h6>
                                                <p>Upload necessary docs: PDF file only</p>
                                                <br>
                                                <div class="table-responsive">
                                                    <table class="table mb-0" id="tbl_proprietorship">
                                                        <thead>
                                                        <tr>
                                                            <th><center>Status</center></th>
                                                            <th>Document Type</th>
                                                            <th>Data File</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <tr>
                                                            <th scope="row" width="10%" id="th_proprietorship01">
                                                                <center>
                                                                    <i class="fe-disc text-danger"></i>
                                                                </center>
                                                            </th>
                                                            <td>BIR Certificate of Registration (2303)</td>
                                                            <td width="10%">
                                                                <center>
                                                                    <a href="javascript:void(0)" id="btn_proprietorship01" onclick="REPRESENTATIVE_COMPANY_PROFILE.r_openCompanyDocumentModal('','Proprietorship-01','BIR Certificate of Registration (2303)');">
                                                                        <i class="fe-upload"></i>
                                                                    </a>
                                                                </center>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row" width="10%" id="th_proprietorship02">
                                                                <center>
                                                                    <i class="fe-disc text-danger"></i>
                                                                </center>
                                                            </th>
                                                            <td>DTI Registration Document</td>
                                                            <td width="10%">
                                                                <center>
                                                                    <a href="javascript:void(0)" id="btn_proprietorship02" onclick="REPRESENTATIVE_COMPANY_PROFILE.r_openCompanyDocumentModal('','Proprietorship-02','DTI Registration Document');">
                                                                        <i class="fe-upload"></i>
                                                                    </a>
                                                                </center>
                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            @elseif($businessType == 'Corporation')
                                            <!-- Corporation -->
                                            <div id="div_corporate">
                                                <br>
                                                <h6 class="mt-0 header-title">Business Type: Corporation</h6>
                                                <p>Upload necessary docs: PDF file only</p>
                                                <br>
                                                <div class="table-responsive">
                                                    <table class="table mb-0" id="tbl_corporate">
                                                        <thead>
                                                        <tr>
                                                            <th><center>Status</center></th>
                                                            <th>Document Type</th>
                                                            <th>Data File</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <th scope="row" width="10%" id="th_corporation01">
                                                                    <center>
                                                                        <i class="fe-disc text-danger"></i>
                                                                    </center>
                                                                </th>
                                                                <td>BIR Certificate of Registration (2303)</td>
                                                                <td width="10%">
                                                                    <center>
                                                                        <a href="javascript:void(0)" id="btn_corporation01" onclick="REPRESENTATIVE_COMPANY_PROFILE.r_openCompanyDocumentModal('','Corporation-01','BIR Certificate of Registration (2303)');">
                                                                            <i class="fe-upload"></i>
                                                                        </a>
                                                                    </center>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row" width="10%" id="th_corporation02">
                                                                    <center>
                                                                        <i class="fe-disc text-danger"></i>
                                                                    </center>
                                                                </th>
                                                                <td>SEC Regitration Certificate</td>
                                                                <td width="10%">
                                                                    <center>
                                                                        <a href="javascript:void(0)" id="btn_corporation02" onclick="REPRESENTATIVE_COMPANY_PROFILE.r_openCompanyDocumentModal('','Corporation-02','SEC Registration Certificate');">
                                                                            <i class="fe-upload"></i>
                                                                        </a>
                                                                    </center>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row" width="10%" id="th_corporation03">
                                                                    <center>
                                                                        <i class="fe-disc text-danger"></i>
                                                                    </center>
                                                                </th>
                                                                <td>Notarized Secretary’s Certificate  (provided by GwC)</td>
                                                                <td width="10%">
                                                                    <center>
                                                                        <a href="javascript:void(0)" id="btn_corporation03" onclick="REPRESENTATIVE_COMPANY_PROFILE.r_openCompanyDocumentModal('','Corporation-03','Notarized Secretary’s Certificate  (provided by GwC)');">
                                                                            <i class="fe-upload"></i>
                                                                        </a>
                                                                    </center>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row" width="10%" id="th_corporation04">
                                                                    <center>
                                                                        <i class="fe-disc text-danger"></i>
                                                                    </center>
                                                                </th>
                                                                <td>Articles of Incorporation</td>
                                                                <td width="10%">
                                                                    <center>
                                                                        <a href="javascript:void(0)" id="btn_corporation04" onclick="REPRESENTATIVE_COMPANY_PROFILE.r_openCompanyDocumentModal('','Corporation-04','Articles of Incorporation');">
                                                                            <i class="fe-upload"></i>
                                                                        </a>
                                                                    </center>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row" width="10%" id="th_corporation05">
                                                                    <center>
                                                                        <i class="fe-disc text-danger"></i>
                                                                    </center>
                                                                </th>
                                                                <td>Most Recent General Information Sheet (GIS) </td>
                                                                <td width="10%">
                                                                    <center>
                                                                        <a href="javascript:void(0)" id="btn_corporation05" onclick="REPRESENTATIVE_COMPANY_PROFILE.r_openCompanyDocumentModal('','Corporation-05','Most Recent General Information Sheet (GIS)');">
                                                                            <i class="fe-upload"></i>
                                                                        </a>
                                                                    </center>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            @endif

                                        </div>

                                        <div class="tab-pane show" id="div_companySettings">

                                            <br>
                                            <h6 class="mt-0 header-title">Company Settings</h6>
                                            <br>
                                            <form class="form-horizontal" id="form_companySettings">
                                            
                                                <div class="row mb-3">
                                                    <label for="txt_bankDepository" class="col-4 col-xl-2 col-form-label">Bank Depository</label>
                                                    <div class="col-8 col-xl-10">
                                                        <input type="text" class="form-control" id="txt_bankDepository" name="txt_bankDepository" placeholder="" required>
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <label for="txt_branchName" class="col-4 col-xl-2 col-form-label">Branch Name</label>
                                                    <div class="col-8 col-xl-10">
                                                        <input type="text" class="form-control" id="txt_branchName" name="txt_branchName" placeholder="" required>
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <label for="txt_branchCode" class="col-4 col-xl-2 col-form-label">Branch Code</label>
                                                    <div class="col-8 col-xl-10">
                                                        <input type="text" class="form-control" id="txt_branchCode" name="txt_branchCode" placeholder="" required>
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <label class="col-4 col-xl-8 col-form-label">Payroll Payout Dates</label>
                                                    <label class="col-4 col-xl-4 col-form-label">Payroll Cut-off Period</label>
                                                </div>

                                                
                                                <div class="row mb-3">
                                                    <label for="txt_payrollPayoutDate1" class="col-4 col-xl-2 col-form-label">First</label>
                                                    <div class="col-8 col-xl-3">
                                                        <input type="text" class="form-control" id="txt_payrollPayoutDate1" name="txt_payrollPayoutDate1" placeholder="" required>
                                                    </div>
                                                    <div class="col-8 col-xl-1">
                                                        
                                                    </div>
                                                    <div class="col-8 col-xl-3">
                                                        <input type="text" class="form-control" id="txt_cutOffMinDate1" name="txt_cutOffMinDate1" placeholder="" required>
                                                    </div>
                                                    <div class="col-8 col-xl-3">
                                                        <input type="text" class="form-control" id="txt_cutOffMaxDate1" name="txt_cutOffMaxDate1" placeholder="" required>
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <label for="txt_payrollPayoutDate2" class="col-4 col-xl-2 col-form-label">Second</label>
                                                    <div class="col-8 col-xl-3">
                                                        <input type="text" class="form-control" id="txt_payrollPayoutDate2" name="txt_payrollPayoutDate2" placeholder="" required>
                                                    </div>
                                                    <div class="col-8 col-xl-1">
                                                        
                                                    </div>
                                                    <div class="col-8 col-xl-3">
                                                        <input type="text" class="form-control" id="txt_cutOffMinDate2" name="txt_cutOffMinDate2" placeholder="" required>
                                                    </div>
                                                    <div class="col-8 col-xl-3">
                                                        <input type="text" class="form-control" id="txt_cutOffMaxDate2" name="txt_cutOffMaxDate2" placeholder="" required>
                                                    </div>
                                                </div>

                                                <br>
                                                <h6 class="mt-0 header-title">Add User Option</h6>

                                                <div class="row mb-3">
                                                    <div class="col-4 col-xl-4">
                                                        <input type="checkbox" class="form-check-input" id="rdb_hrUser" name="rdb_hrUser">
                                                    </div>
                                                    <label for="rdb_hrUser" class="col-8 col-xl-8 col-form-label">HR / Personnel Officer</label>
                                                </div>

                                                <div class="row mb-3">
                                                    <div class="col-4 col-xl-4">
                                                        <input type="checkbox" class="form-check-input" id="rdb_bpoUser" name="rdb_bpoUser">
                                                    </div>
                                                    <label for="rdb_bpoUser" class="col-8 col-xl-8 col-form-label">Billing & Payment Officer</label>
                                                </div>
                                                <br>
                                                <div class="justify-content-end row">
                                                    <div class="col-8 col-xl-3 d-grid">
                                                        <button type="submit" class="btn gwc-button waves-effect waves-light" id="btn_submitCompanySettings">SAVE</button>
                                                    </div>
                                                </div>

                                            </form>

                                        </div>

                                        <div class="tab-pane" id="div_companyRepresentatives">

                                            <div class="accordion custom-accordion" id="custom-accordion-one">
                                                @if($hrUser == '1')
                                                <div class="card mb-0">
                                                    <div class="card-header" id="headingNine">
                                                        <h5 class="m-0 position-relative">
                                                            <a class="custom-accordion-title text-reset d-block" data-bs-toggle="collapse" href="#collapseNine" aria-expanded="true" aria-controls="collapseNine">
                                                                HR / Personnel Officer <i class="mdi mdi-chevron-down accordion-arrow"></i>
                                                            </a>
                                                        </h5>
                                                    </div>
                                                    <div id="collapseNine" class="collapse show" aria-labelledby="headingFour" data-bs-parent="#custom-accordion-one" style="">
                                                        <div class="card-body">
                                                            <br>
                                                            <h6 class="mt-0 header-title">Authorized Person to Represent Company</h6>
                                                            <br>
                                                            <form class="form-horizontal" id="form_hrCompanyRepresentative">

                                                                <input type="hidden" id="txt_hrRepresentativeId" name="txt_hrRepresentativeId">
                                                                <div class="row mb-3">
                                                                    <div class="col-8 col-xl-6">
                                                                        <input type="text" class="form-control" id="txt_hrFirstName" name="txt_hrFirstName" placeholder="First Name">
                                                                    </div>
                                                                    <div class="col-8 col-xl-6">
                                                                        <input type="text" class="form-control" id="txt_hrLastName" name="txt_hrLastName" placeholder="Last Name">
                                                                    </div>
                                                                </div>

                                                                <div class="row mb-3">
                                                                    <div class="col-8 col-xl-6">
                                                                        <input type="email" class="form-control" id="txt_hrEmailAddress" name="txt_hrEmailAddress" placeholder="Email Address">
                                                                    </div>
                                                                    <div class="col-8 col-xl-6">
                                                                        <input type="text" class="form-control" id="txt_hrPosition" name="txt_hrPosition" placeholder="Position in the company">
                                                                    </div>
                                                                </div>

                                                                <div class="justify-content-end row">
                                                                    <div class="col-8 col-xl-3 d-grid">
                                                                        <button type="submit" class="btn gwc-button waves-effect waves-light" id="btn_submitHrCompanyRepresentative">SAVE</button>
                                                                    </div>
                                                                </div>

                                                            </form>

                                                            <br>

                                                            <div id="div_companyHRDocument" hidden>
                                                                <h6 class="mt-0 header-title">Presented Identification Documents</h6>
                                                                <br>
                                                                <div class="table-responsive">
                                                                    <table class="table mb-0">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td>Company ID</td>
                                                                                <td>
                                                                                    <center>
                                                                                        <a href="javascript:void(0)" id="btn_hrCompanyId" onclick="REPRESENTATIVE_COMPANY_PROFILE.r_openCompanyRepresentativeIdentificationModal('','Company ID');">
                                                                                            <i class="fe-upload"></i>
                                                                                        </a>
                                                                                    </center>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Government ID</td>
                                                                                <td>
                                                                                    <center>
                                                                                        <a href="javascript:void(0)" id="btn_hrGovernmentId" onclick="REPRESENTATIVE_COMPANY_PROFILE.r_openCompanyRepresentativeIdentificationModal('','Government ID');">
                                                                                            <i class="fe-upload"></i>
                                                                                        </a>
                                                                                    </center>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                                @endif
                                                @if($bpoUser == '1')
                                                <div class="card mb-0">
                                                    <div class="card-header" id="headingFive">
                                                        <h5 class="m-0 position-relative">
                                                            <a class="custom-accordion-title text-reset collapsed d-block" data-bs-toggle="collapse" href="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                                                Billing & Payment Officer <i class="mdi mdi-chevron-down accordion-arrow"></i>
                                                            </a>
                                                        </h5>
                                                    </div>
                                                    <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-bs-parent="#custom-accordion-one">
                                                        <div class="card-body">
                                                            
                                                            <br>
                                                            <h6 class="mt-0 header-title">Authorized Person to Represent Company</h6>
                                                            <br>
                                                            <form class="form-horizontal" id="form_bpoCompanyRepresentative">

                                                                <input type="hidden" id="txt_bpoRepresentativeId" name="txt_bpoRepresentativeId">
                                                                <div class="row mb-3">
                                                                    <div class="col-8 col-xl-6">
                                                                        <input type="text" class="form-control" id="txt_bpoFirstName" name="txt_bpoFirstName" placeholder="First Name">
                                                                    </div>
                                                                    <div class="col-8 col-xl-6">
                                                                        <input type="text" class="form-control" id="txt_bpoLastName" name="txt_bpoLastName" placeholder="Last Name">
                                                                    </div>
                                                                </div>

                                                                <div class="row mb-3">
                                                                    <div class="col-8 col-xl-6">
                                                                        <input type="email" class="form-control" id="txt_bpoEmailAddress" name="txt_bpoEmailAddress" placeholder="Email Address">
                                                                    </div>
                                                                    <div class="col-8 col-xl-6">
                                                                        <input type="text" class="form-control" id="txt_bpoPosition" name="txt_bpoPosition" placeholder="Position in the company">
                                                                    </div>
                                                                </div>

                                                                <div class="justify-content-end row">
                                                                    <div class="col-8 col-xl-3 d-grid">
                                                                        <button type="submit" class="btn gwc-button waves-effect waves-light" id="btn_submitBpoCompanyRepresentative">SAVE</button>
                                                                    </div>
                                                                </div>

                                                            </form>

                                                            <br>

                                                            <div id="div_companyBPODocument" hidden>
                                                                <h6 class="mt-0 header-title">Presented Identification Documents</h6>
                                                                <br>
                                                                <div class="table-responsive">
                                                                    <table class="table mb-0">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td>Company ID</td>
                                                                                <td>
                                                                                    <center>
                                                                                        <a href="javascript:void(0)" id="btn_bpoCompanyId" onclick="REPRESENTATIVE_COMPANY_PROFILE.r_openCompanyRepresentativeIdentificationModal('','Company ID');">
                                                                                            <i class="fe-upload"></i>
                                                                                        </a>
                                                                                    </center>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Government ID</td>
                                                                                <td>
                                                                                    <center>
                                                                                        <a href="javascript:void(0)" id="btn_bpoGovernmentId" onclick="REPRESENTATIVE_COMPANY_PROFILE.r_openCompanyRepresentativeIdentificationModal('','Government ID');">
                                                                                            <i class="fe-upload"></i>
                                                                                        </a>
                                                                                    </center>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                                @endif
                                            </div>

                                        </div>


                                    </div>

                                </div>
                            </div> <!-- end card-->
                        </div> <!-- end col -->

                </div>
                <!-- end row --> 
                @endif

                <input type="hidden" id="txt_baseUrl" value="<?php echo base_url(); ?>">      
                
            </div> <!-- container-fluid -->

        </div> <!-- content -->

    </div>
    <!-- ============================================================== -->
    <!-- End Page content -->
    <!-- ============================================================== -->

    <div class="modal fade" id="modal_repCompanyDocuments" tabindex="-1" >
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header modal-header--sticky">
                    <h5 class="modal-title" id="lbl_modalTitle"> 
                        <i class="feather-plus me-2"></i> Document
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="form_repRepCompanyDocuments">
                        <input type="hidden" id="txt_documentId" name="txt_documentId">
                        <input type="hidden" id="txt_documentCode" name="txt_documentCode">
                        <input type="hidden" id="txt_documentName" name="txt_documentName">
                        <center><div id="div_documentResult"></div></center>
                        <input type="file" id="file_companyDocument" name="file_companyDocument" data-plugins="dropify" accept="application/pdf" required />
                        <div id="div_documentPreview" hidden>
                            <br>
                            <label>Document Preview:</label>
                            <iframe src="" id="iframe_companyDocumentPreview" style="width:100%; height: 60vh;"></iframe>
                        </div>
                    </form>
                </div>
                <div class="modal-footer modal-footer--sticky">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn gwc-button" id="btn_submitRepCompanyDocuments" form="form_repRepCompanyDocuments">Submit</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal_repIdentificationDocuments" tabindex="-1" >
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header modal-header--sticky">
                    <h5 class="modal-title" id="lbl_modalTitle"> 
                        <i class="feather-plus me-2"></i> Identification
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="form_repIdentificationDocuments">
                        <input type="hidden" id="txt_identificationId" name="txt_identificationId">
                        <input type="hidden" id="txt_employeeId" name="txt_employeeId">
                        <input type="hidden" id="txt_identificationType" name="txt_identificationType">
                        <input type="hidden" id="txt_identificationCategory" name="txt_identificationCategory">
                        <center><div id="div_identificationResult"></div></center>
                        <input type="file" id="file_identificationDocument" name="file_identificationDocument" data-plugins="dropify" accept="application/pdf" required />
                        <div id="div_identificationPreview" hidden>
                            <br>
                            <label>Document Preview:</label>
                            <iframe src="" id="iframe_identificationDocumentPreview" style="width:100%; height: 60vh;"></iframe>
                        </div>
                    </form>
                </div>
                <div class="modal-footer modal-footer--sticky">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn gwc-button" id="btn_submitRepIdentificationDocuments" form="form_repIdentificationDocuments">Submit</button>
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

    REPRESENTATIVE_COMPANY_PROFILE.r_selectCompanyInformation($('#txt_companyId').val());
    REPRESENTATIVE_COMPANY_PROFILE.r_loadCompanyDocuments($('#txt_companyId').val());
    REPRESENTATIVE_COMPANY_PROFILE.r_selectCompanySettings($('#txt_companyId').val());
    REPRESENTATIVE_COMPANY_PROFILE.r_loadCompanyRepresentatives($('#txt_companyId').val());
    
    $('#form_companyInformation').on('submit',function(e){
        e.preventDefault();
        REPRESENTATIVE_COMPANY_PROFILE.r_editCompanyInformation(this);
    });

    $('#file_companyDocument').on('change',function(){
        REPRESENTATIVE_COMPANY_PROFILE.r_openCompanyDocumentPreview(this);
    });

    $('#form_repRepCompanyDocuments').on('submit',function(e){
        e.preventDefault();
        let documentId = $('#txt_documentId').val();
        if(documentId == "")
        {
            REPRESENTATIVE_COMPANY_PROFILE.r_addCompanyDocument(this);
        }
        else
        {
            REPRESENTATIVE_COMPANY_PROFILE.r_editCompanyDocument(this);
        }
    });

    $('#form_companySettings').on('submit', function(e){
        e.preventDefault();
        REPRESENTATIVE_COMPANY_PROFILE.r_editCompanySettings(this);
    });

    $('#form_hrCompanyRepresentative').on('submit',function(e){
        e.preventDefault();
        let hrRepresentativeId = $('#txt_hrRepresentativeId').val();
        if(hrRepresentativeId == '')
        {
            REPRESENTATIVE_COMPANY_PROFILE.r_addCompanyHR(this);
        }
        else
        {
            REPRESENTATIVE_COMPANY_PROFILE.r_editCompanyHR(this);
        }
    });

    $('#form_bpoCompanyRepresentative').on('submit',function(e){
        e.preventDefault();
        let bpoRepresentativeId = $('#txt_bpoRepresentativeId').val();
        if(bpoRepresentativeId == '')
        {
            REPRESENTATIVE_COMPANY_PROFILE.r_addCompanyBPO(this);
        }
        else
        {
            REPRESENTATIVE_COMPANY_PROFILE.r_editCompanyBPO(this);
        }
    });

    $('#file_identificationDocument').on('change',function(){
        REPRESENTATIVE_COMPANY_PROFILE.r_openCompanyRepresentativeIdentificationPreview(this);
    });

    $('#form_repIdentificationDocuments').on('submit',function(e){
        e.preventDefault();
        let identificationId = $('#txt_identificationId').val();
        if(identificationId == '')
        {
            REPRESENTATIVE_COMPANY_PROFILE.r_addCompanyRepresentativeIdentification(this);
        }
        else
        {
            REPRESENTATIVE_COMPANY_PROFILE.r_editCompanyRepresentativeIdentification(this);
        }
    });
    
  });
</script>

@endsection
