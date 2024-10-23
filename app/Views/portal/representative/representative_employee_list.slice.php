@extends('template.layout')

@section('page_title',$pageTitle)



@section('custom_styles')

<!-- third party css -->
<link href="<?php echo base_url();?>public/assets/Adminto/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>public/assets/Adminto/libs/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>public/assets/Adminto/libs/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>public/assets/Adminto/libs/datatables.net-select-bs5/css/select.bootstrap5.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>public/assets/Adminto/libs/multiselect/css/multi-select.css" rel="stylesheet" type="text/css" />
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

                @if($subscriptionStatus == null)
                <h1>Please subscribe to a product first to activate this module.</h1>
                <p>Click <a href="<?php echo base_url('portal/representative/financing-products'); ?>">here</a> to subscribe for a product.</p>
                @else
                <input type="hidden" id="txt_companyId" name="txt_companyId" value="{{ $companyId }}">
                <input type="hidden" id="txt_subscriptionStatus" value="{{ $subscriptionStatus }}">
                <input type="hidden" id="txt_accessStatus" value="{{ $accessStatus }}">

                <div class="row" id="div_employeeList">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                
                                @if($accessStatus == "CLOSE")
                                <button type="button" class="btn gwc-button waves-effect waves-light" id="btn_requestForUpdate"><i class="fe-check"></i> REQUEST FOR UPDATE</button>
                                @else
                                <div class="row">
                                    <div class="col-8 col-xl-3 d-grid">
                                        <button type="button" class="btn gwc-button waves-effect waves-light" id="btn_addEmployee"><i class="fe-plus"></i> ADD NEW</button>
                                    </div>
                                    <div class="col-8 col-xl-3 d-grid">
                                        <button type="button" class="btn gwc-button waves-effect waves-light" id="btn_importEmployees"><i class="fe-plus"></i> BATCH UPLOAD</button>
                                    </div>
                                </div>
                                @endif  
                                <p class="text-muted font-14 mb-3"></p>                              

                                <table id="tbl_employees" class="table table-bordered dt-responsive table-responsive nowrap">
                                    <thead>
                                        <tr>
                                            <th>
                                                <input type="checkbox" id="chk_selectAllEmployees">
                                            </th>
                                            <th>ID No.</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Department</th>
                                            <th>Position</th>
                                            <th>Date Hired</th>
                                            <th>Credit Limit</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                    </tbody>
                                </table>

                                <br>

                                @if($accessStatus == "CLOSE")
                                <div class="justify-content-end row mt-2">
                                    <div class="col-8 col-xl-4 d-grid">
                                        <button type="button" class="btn gwc-button waves-effect waves-light" id="btn_attachDocuments"><i class="fe-eye"></i> VIEW ATTACH DOCUMENTS</button>
                                    </div>
                                </div>
                                @else
                                <div class="justify-content-end row mt-2">
                                    <div class="col-8 col-xl-3 d-grid">
                                        <button type="button" id="btn_printEmployeeList" class="btn gwc-button waves-effect waves-light">Print Updated List</button>
                                    </div>
                                    <div class="col-8 col-xl-3 d-grid">
                                        <button type="button" class="btn gwc-button waves-effect waves-light" id="btn_attachDocuments">Attach Documents</button>
                                    </div>
                                </div>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>

                <div class="row" id="div_companyAttachments" hidden>
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">

                                <h6 class="mt-0 header-title">Attachments</h6>
                                <p>Upload necessary docs: PDF file only</p>
                                <br>
                                <div class="table-responsive">
                                    <table class="table mb-0" id="tbl_attachments">
                                        <thead>
                                        <tr>
                                            <th><center>Status</center></th>
                                            <th>Document Type</th>
                                            <th>Data File</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <th scope="row" width="10%" id="th_attachment01">
                                                <center>
                                                    <i class="fe-disc text-danger"></i>
                                                </center>
                                            </th>
                                            <td>Sworn Statement</td>
                                            <td width="10%">
                                                <center>
                                                    <a href="javascript:void(0)" id="btn_attachment01" onclick="REPRESENTATIVE_EMPLOYEE_LIST.r_selectCompanyAttachment('','Attachment-01', 'Sworn Statement');">
                                                        @if($accessStatus != "CLOSE")
                                                        <i class="fe-upload"></i>
                                                        @else
                                                        <i class="fe-eye"></i>
                                                        @endif
                                                    </a>
                                                </center>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row" width="10%" id="th_attachment02">
                                                <center>
                                                    <i class="fe-disc text-danger"></i>
                                                </center>
                                            </th>
                                            <td>Employee List</td>
                                            <td width="10%">
                                                <center>
                                                    <a href="javascript:void(0)" id="btn_attachment02" onclick="REPRESENTATIVE_EMPLOYEE_LIST.r_selectCompanyAttachment('','Attachment-02', 'Employee List');">
                                                        @if($accessStatus != "CLOSE")
                                                        <i class="fe-upload"></i>
                                                        @else
                                                        <i class="fe-eye"></i>
                                                        @endif
                                                    </a>
                                                </center>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row" width="10%" id="th_attachment03">
                                                <center>
                                                    <i class="fe-disc text-danger"></i>
                                                </center>
                                            </th>
                                            <td>BIR Employee List</td>
                                            <td width="10%">
                                                <center>
                                                    <a href="javascript:void(0)" id="btn_attachment03" onclick="REPRESENTATIVE_EMPLOYEE_LIST.r_selectCompanyAttachment('','Attachment-03', 'BIR Employee List');">
                                                        @if($accessStatus != "CLOSE")
                                                        <i class="fe-upload"></i>
                                                        @else
                                                        <i class="fe-eye"></i>
                                                        @endif
                                                    </a>
                                                </center>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row" width="10%" id="th_attachment04">
                                                <center>
                                                    <i class="fe-disc text-danger"></i>
                                                </center>
                                            </th>
                                            <td>SSS R3</td>
                                            <td width="10%">
                                                <center>
                                                    <a href="javascript:void(0)" id="btn_attachment04" onclick="REPRESENTATIVE_EMPLOYEE_LIST.r_selectCompanyAttachment('','Attachment-04', 'SSS R3');">
                                                        @if($accessStatus != "CLOSE")
                                                        <i class="fe-upload"></i>
                                                        @else
                                                        <i class="fe-eye"></i>
                                                        @endif
                                                    </a>
                                                </center>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="justify-content-end row mt-3">
                                    <div class="col-8 col-xl-3 d-grid">
                                        <button type="button" class="btn gwc-button waves-effect waves-light" id="btn_backToList">Back</button>
                                    </div>
                                </div>

                            </div>
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

    <div class="modal fade" id="modal_requestForUpdate" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header modal-header--sticky">
                    <h5 class="modal-title" id="lbl_modalTitle"> 
                        <i class="feather-plus me-2"></i> Request for Update
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="form_requestForUpdate">
                        <label>Remarks:</label>
                        <textarea rows="5" class="form-control" id="txt_requestForUpdateRemarks" name="txt_requestForUpdateRemarks" required></textarea>
                    </form>
                </div>
                <div class="modal-footer modal-footer--sticky">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn gwc-button" id="btn_submitRequestForUpdate" form="form_requestForUpdate">Submit</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal_employee" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header modal-header--sticky">
                    <h5 class="modal-title" id="lbl_modalTitle1"> 
                        <i class="fe-plus me-2"></i> Add Employee
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="form_employee">
                        <input type="hidden" id="txt_employeeId" name="txt_employeeId">
                        <h3>EMPLOYEE DETAILS</h3>
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td width="30%">Company Code</td>
                                    <td class="p-1">
                                        <input type="text" class="form-control" id="txt_companyCode" name="txt_companyCode" value="{{ $companyCode }}" readonly>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="30%">Last Name</td>
                                    <td class="p-1">
                                        <input type="text" class="form-control" id="txt_lastName" name="txt_lastName" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="30%">First Name</td>
                                    <td class="p-1">
                                        <input type="text" class="form-control" id="txt_firstName" name="txt_firstName" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="30%">Middle Name</td>
                                    <td class="p-1">
                                        <input type="text" class="form-control" id="txt_middleName" name="txt_middleName">
                                    </td>
                                </tr>
                                <tr>
                                    <td width="30%">Tax Identification Number</td>
                                    <td class="p-1">
                                        <input type="text" class="form-control" id="txt_taxIdentificationNumber" name="txt_taxIdentificationNumber" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="30%">Position / Designation</td>
                                    <td class="p-1">
                                        <input type="text" class="form-control" id="txt_position" name="txt_position" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="30%">Department</td>
                                    <td class="p-1">
                                        <input type="text" class="form-control" id="txt_department" name="txt_department">
                                    </td>
                                </tr>
                                <tr>
                                    <td width="30%">Gross Salary</td>
                                    <td class="p-1">
                                        @if($accessStatus == "OPEN")
                                        <input type="number" class="form-control" id="txt_grossSalary" name="txt_grossSalary" required>
                                        @else
                                        <input type="number" class="form-control" id="txt_grossSalary" name="txt_grossSalary" required readonly>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td width="30%">Net Salary</td>
                                    <td class="p-1">
                                        @if($accessStatus == "OPEN")
                                        <input type="number" class="form-control" id="txt_netSalary" name="txt_netSalary" required>
                                        @else
                                        <input type="number" class="form-control" id="txt_netSalary" name="txt_netSalary" required readonly>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td width="30%">Marital Status</td>
                                    <td class="p-1">
                                        <select class="form-control form-select" id="slc_maritalStatus" name="slc_maritalStatus" required>
                                           <option value="">--Select Status--</option>
                                           <option value="Single">Single</option> 
                                           <option value="Married">Married</option> 
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="30%">Home Address</td>
                                    <td class="p-1">
                                        <input type="text" class="form-control" id="txt_homeAddress" name="txt_homeAddress">
                                    </td>
                                </tr>
                                <tr>
                                    <td width="30%">Mobile Number</td>
                                    <td class="p-1">
                                        <input type="text" class="form-control" id="txt_mobileNumber" name="txt_mobileNumber" pattern="[0]{1}[0-9]{10}">
                                    </td>
                                </tr>
                                <tr>
                                    <td width="30%">Email Address</td>
                                    <td class="p-1">
                                        <input type="email" class="form-control" id="txt_emailAddress" name="txt_emailAddress" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="30%">Date Hired</td>
                                    <td class="p-1">
                                        <input type="date" class="form-control" id="txt_dateHired" name="txt_dateHired" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="30%">Years Stayed</td>
                                    <td class="p-1">
                                        <input type="text" class="form-control" id="txt_yearsStayed" name="txt_yearsStayed" readonly>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="30%">Employment Status</td>
                                    <td class="p-1">
                                        <select class="form-control form-select" id="slc_employmentStatus" name="slc_employmentStatus" required>
                                           <option value="">--Select Employment Status--</option>
                                           <option value="Contractual">Contractual</option> 
                                           <option value="Probitionary">Probitionary</option> 
                                           <option value="Regular">Regular</option> 
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="30%">Payroll Bank</td>
                                    <td class="p-1">
                                        <input type="text" class="form-control" id="txt_payrollBank" name="txt_payrollBank" value="{{ $bankDepository }}" hidden>
                                        <select class="form-control form-select" id="slc_payrollBank" name="slc_payrollBank" disabled></select>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="30%">Payroll Bank Account</td>
                                    <td class="p-1">
                                        <input type="text" class="form-control" id="txt_payrollBankAccount" name="txt_payrollBankAccount" required>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <h3>CREDIT LIMIT</h3>
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td width="30%">Minimum Amount</td>
                                    <td class="p-1">
                                        <input type="text" class="form-control" id="txt_minimumAmount" name="txt_minimumAmount" readonly>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="30%">Maximum Amount</td>
                                    <td class="p-1">
                                        <input type="text" class="form-control" id="txt_maximumAmount" name="txt_maximumAmount" readonly>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <h3>EMPLOYEE STATUS</h3>
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td width="30%">Employee Status</td>
                                    <td class="p-1">
                                        <select class="form-control form-select" id="slc_employeeStatus" name="slc_employeeStatus" required>
                                           <option value="">--Select Status--</option>
                                           <option value="1">Active</option> 
                                           <option value="0">Inactive</option> 
                                        </select>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                    </form>
                </div>
                <div class="modal-footer modal-footer--sticky">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn gwc-button" id="btn_submitEmployee" form="form_employee">Submit</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal_importEmployees" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header modal-header--sticky">
                    <h5 class="modal-title" id="lbl_modalTitle2"> 
                        <i class="feather-plus me-2"></i> Import Employees
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="div_stepOne">
                        <form id="form_stepOne">
                            <input type="file" id="file_employeeList" name="file_employeeList" data-plugins="dropify" accept=".csv" required />
                        </form>
                    </div>
                    <div id="div_stepTwo" hidden>
                        <form id="form_stepTwo">
                            <div class="row mb-3">
                              <div class="col-lg-2" style="margin-top:auto; margin-bottom: auto;">
                                <label>Use Save Maps</label>
                              </div>
                              <div class="col-lg-4">
                                <div class="input-group bootstrap-touchspin bootstrap-touchspin-injected">
                                    <select class="form-control form-control-sm form-select" id="slc_savedMaps" data-toggle="touchspin" data-bts-prefix="A Button" data-bts-prefix-extra-class="btn btn-light" data-bts-postfix="A Button" data-bts-postfix-extra-class="btn btn-light">
                                      <option value="">--No Saved Maps--</option>
                                    </select>
                                    <span class="input-group-btn input-group-append">
                                        <button class="btn btn-primary bootstrap-touchspin-up" type="button" id="btn_refreshSavedMaps">
                                            <i class="fe-refresh-ccw"></i>
                                        </button>
                                    </span>
                                </div>
                              </div>
                            </div>
                            <table class="table table-sm table-bordered table-hover mb-3" id="tbl_mapping" style="width:100%;">
                              <thead>
                                <tr>
                                  <th>#</th>
                                  <th>HEADER</th>
                                  <th>ROW 1 of <span id="lbl_totalRows"></span></th>
                                  <th>EMPLOYEE FIELDS</th>
                                  <th>UNIQUE VALUE</th>
                                </tr>
                              </thead>
                              <tbody></tbody>
                            </table>
                            
                            <div class="row">
                              <div class="col-lg-3" style="margin-top:auto; margin-bottom: auto;">
                                <div class="form-check">
                                  <input type="checkbox" class="form-check-input" id="chk_saveCustomMapping">
                                  <label class="form-check-label" for="chk_saveCustomMapping"> Save as Custom Mapping</label>
                                </div>
                              </div>
                              <div class="col-lg-3">
                                <input type="text" class="form-control form-control-sm" id="txt_customMapName" name="txt_customMapName">
                              </div>
                            </div>
                        </form>
                    </div>
                    <div id="div_stepThree" hidden>
                        <form id="form_stepThree">
                            <h6>Review data before import</h6>
                            <div id="div_duplicateRows1">
                                <hr>
                                <label class="text-muted">Duplicate rows found on CSV file</label>
                                <br>
                                <table class="table table-sm table-bordered table-hover mb-3" id="tbl_duplicateRows1" style="width:100%;">
                                    <thead></thead>
                                    <tbody></tbody>
                                </table>
                            </div>

                            <div id="div_duplicateRows2">
                                <hr>
                                <label class="text-muted">Existing rows found on database</label>
                                <br>
                                <table class="table table-sm table-bordered table-hover mb-3" id="tbl_duplicateRows2" style="width:100%;">
                                    <thead></thead>
                                    <tbody></tbody>
                                </table>
                            </div>

                            <div id="div_forImport">
                                <hr>
                                <label class="text-muted">Ready for import</label>
                                <br>
                                <table class="table table-sm table-bordered table-hover mb-3" id="tbl_importData" style="width:100%;">
                                    <thead></thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </form>
                        <div class="progress" id="div_progressBarContainer" hidden>
                            <br>
                            <div class="progress-bar bg-primary progress-bar-striped" id="div_progressBar" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 0%; animation: progress-bar-stripes 1s linear infinite;">
                            </div>
                        </div>
                        <center><i><span id="lbl_progress"></span></i></center>
                    </div>
                </div>
                <div class="modal-footer modal-footer--sticky">

                    <div id="div_buttonStepOne">
                        <button type="submit" class="btn gwc-button" id="btn_submitStepOne" form="form_stepOne">Next</button>
                        <button type="button" class="btn btn-light" id="btn_stepOneCancel">Cancel</button>
                    </div>
                    <div id="div_buttonStepTwo" hidden>
                        <button type="button" class="btn btn-dark" id="btn_stepTwoBack">Back</button>
                        <button type="submit" class="btn gwc-button" id="btn_submitStepTwo" form="form_stepTwo">Next</button>
                        <button type="button" class="btn btn-light" id="btn_stepTwoCancel">Cancel</button>
                    </div>
                    <div id="div_buttonStepThree" hidden>
                        <button type="button" class="btn btn-dark" id="btn_stepThreeBack">Back</button>
                        <button type="submit" class="btn gwc-button" id="btn_submitStepThree" form="form_stepThree">Import</button>
                        <button type="button" class="btn btn-light" id="btn_stepThreeCancel">Cancel</button>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal_companyAttachment" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header modal-header--sticky">
                    <h5 class="modal-title" id="lbl_modalTitle3"> 
                        <i class="feather-plus me-2"></i> Attach Documents
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="form_companyAttachment">
                        @if($accessStatus != "CLOSE")
                        <input type="hidden" id="txt_attachmentId" name="txt_attachmentId">
                        <input type="hidden" id="txt_attachmentCode" name="txt_attachmentCode">
                        <input type="hidden" id="txt_attachmentName" name="txt_attachmentName">
                        <center><div id="div_companyAttachmentResult"></div></center>
                        <input type="file" id="file_companyAttachment" name="file_companyAttachment" data-plugins="dropify" accept="application/pdf" required />
                        <br>
                        @endif
                        <div id="div_companyAttachmentPreview" hidden>
                            <label>Document Preview:</label>
                            @if($accessStatus != "CLOSE")
                            <iframe src="" id="iframe_companyAttachmentPreview" style="width:100%; height: 60vh;"></iframe>
                            @else
                            <iframe src="" id="iframe_companyAttachmentPreview" style="width:100%; height: 70vh;"></iframe>
                            @endif
                        </div>
                    </form>
                </div>
                @if($accessStatus != "CLOSE")
                <div class="modal-footer modal-footer--sticky">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn gwc-button" id="btn_submitCompanyAttachment" form="form_companyAttachment">Submit</button>
                </div>
                @endif
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
<script src="<?php echo base_url();?>public/assets/Adminto/libs/multiselect/js/jquery.multi-select.js"></script>
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

    REPRESENTATIVE_EMPLOYEE_LIST.r_loadEmployees($('#txt_companyId').val());
    REPRESENTATIVE_EMPLOYEE_LIST.r_loadBankDepositories();

    $('#btn_requestForUpdate').on('click',function(){
        $('#modal_requestForUpdate').modal('show');
    });

    $('#btn_addEmployee').on('click',function(){
        $('#txt_employeeId').val('');
        $('#lbl_modalTitle1').html(`<i class="fe-plus me-2"></i> Add Employee`);
        $('#modal_employee').modal('show');
    });

    $('#txt_netSalary').on('change',function(){
        REPRESENTATIVE_EMPLOYEE_LIST.r_calculateCreditLimit();
    });

    $('#txt_dateHired').on('change',function(){
        REPRESENTATIVE_EMPLOYEE_LIST.r_calculateEmployeeYearsStayed();
    });
    
    $('#form_employee').on('submit',function(e){
        e.preventDefault();
        let employeeId = $('#txt_employeeId').val();
        if(employeeId == "")
        {
            REPRESENTATIVE_EMPLOYEE_LIST.r_addEmployee(this);
        }
        else
        {
            REPRESENTATIVE_EMPLOYEE_LIST.r_editEmployee(this);
        }
    });

    $('#btn_importEmployees').on('click',function(){
        $('#modal_importEmployees').modal('show');
    });

    $('#form_stepOne').on('submit',function(e){
        e.preventDefault();
        REPRESENTATIVE_EMPLOYEE_LIST.r_uploadFile();
    });

    $('#btn_stepOneCancel').on('click',function(){
      REPRESENTATIVE_EMPLOYEE_LIST.r_stepOneCancel();
    });

    $('#btn_stepTwoBack').on('click',function(){
      REPRESENTATIVE_EMPLOYEE_LIST.r_backToStepOne();
    });

    $('#btn_refreshSavedMaps').on('click',function(){
      REPRESENTATIVE_EMPLOYEE_LIST.r_loadCustomMaps();
    });

    $('#slc_savedMaps').on('change',function(){
      REPRESENTATIVE_EMPLOYEE_LIST.r_selectCustomMap($(this).val());
    });

    $('#chk_saveCustomMapping').on('change',function(){
      if($(this).is(':checked'))
      {
        $('#txt_customMapName').prop('required',true);
      }
      else
      {
        $('#txt_customMapName').prop('required',false);
      }
    });

    $('#form_stepTwo').on('submit',function(e){
        e.preventDefault();
        REPRESENTATIVE_EMPLOYEE_LIST.r_mappingAndDuplicateHandling();
    });

    $('#btn_stepTwoCancel').on('click',function(){
        REPRESENTATIVE_EMPLOYEE_LIST.r_stepTwoCancel();
    });

    $('#btn_stepThreeBack').on('click',function(){
        REPRESENTATIVE_EMPLOYEE_LIST.r_backToStepTwo();
    });

    $('#form_stepThree').on('submit',function(e){
        e.preventDefault();
        REPRESENTATIVE_EMPLOYEE_LIST.r_importEmployees();
    });

    $('#btn_stepThreeCancel').on('click',function(){
        REPRESENTATIVE_EMPLOYEE_LIST.r_stepThreeCancel();
    });



    $('#chk_selectAllEmployees').on('change',function(){
        if($(this).is(':checked'))
        { 
            $('.chk-employees').prop('checked',true);
        }
        else
        {
            $('.chk-employees').prop('checked',false);
        }
    });

    $('#btn_printEmployeeList').on('click',function(){
        REPRESENTATIVE_EMPLOYEE_LIST.r_printEmployeeList();
    });



    $('#btn_attachDocuments').on('click',function(){
        REPRESENTATIVE_EMPLOYEE_LIST.r_loadCompanyAttachments($('#txt_companyId').val());
        $('#div_employeeList').prop('hidden',true);
        $('#div_companyAttachments').prop('hidden',false);
    });

    $('#btn_backToList').on('click',function(){
        $('#div_employeeList').prop('hidden',false);
        $('#div_companyAttachments').prop('hidden',true);
    });

    $('#file_companyAttachment').on('change',function(){
        REPRESENTATIVE_EMPLOYEE_LIST.r_openCompanyAttachmentPreview(this);
    });

    $('#form_companyAttachment').on('submit',function(e){
        e.preventDefault();
        let attachmentId = $('#txt_attachmentId').val();
        if(attachmentId == "")
        {
            REPRESENTATIVE_EMPLOYEE_LIST.r_addCompanyAttachment(this);
        }
        else
        {
            REPRESENTATIVE_EMPLOYEE_LIST.r_editCompanyAttachment(this);
        }
        
    });
    
  });
</script>

@endsection
