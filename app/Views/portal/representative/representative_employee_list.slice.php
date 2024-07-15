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

                <input type="hidden" id="txt_companyId" name="txt_companyId" value="{{ $companyId }}">

                <div class="row" id="div_employeeList">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">

                                <div class="row">
                                    <div class="col-8 col-xl-3 d-grid">
                                        <button type="button" data-bs-toggle="modal" data-bs-target="#standard-modal" class="btn gwc-button waves-effect waves-light" id="btn_addEmployee"><i class="fe-plus"></i> ADD NEW</button>
                                    </div>
                                    <div class="col-8 col-xl-3 d-grid">
                                        <button type="button" data-bs-toggle="modal" data-bs-target="#standard-modal" class="btn gwc-button waves-effect waves-light" id="btn_importEmployees"><i class="fe-plus"></i> BATCH UPLOAD</button>
                                    </div>
                                </div>

                                <p class="text-muted font-14 mb-3">
                                </p>

                                <table id="tbl_employees" class="table table-bordered dt-responsive table-responsive nowrap">
                                    <thead>
                                        <tr>
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

                                <div class="justify-content-end row mt-3">
                                    <div class="col-8 col-xl-3 d-grid">
                                        <button type="button" id="btn_printEmployeeList" class="btn gwc-button waves-effect waves-light">Print Updated List</button>
                                    </div>
                                    <div class="col-8 col-xl-3 d-grid">
                                        <button type="button" class="btn gwc-button waves-effect waves-light" id="btn_attachDocuments">Attach Documents</button>
                                    </div>
                                </div>

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
                                                        <i class="fe-upload"></i>
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
                                                        <i class="fe-upload"></i>
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
                                                        <i class="fe-upload"></i>
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
                                                        <i class="fe-upload"></i>
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

                <input type="hidden" id="txt_baseUrl" value="<?php echo base_url(); ?>">  
                
            </div> <!-- container-fluid -->

        </div> <!-- content -->

    </div>
    <!-- ============================================================== -->
    <!-- End Page content -->
    <!-- ============================================================== -->

    <div class="modal fade" id="modal_employee" tabindex="-1" >
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header modal-header--sticky">
                    <h5 class="modal-title" id="lbl_modalTitle1"> 
                        <i class="feather-plus me-2"></i> Add Employee
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
                                        <input type="text" class="form-control" id="txt_lastName" name="txt_lastName">
                                    </td>
                                </tr>
                                <tr>
                                    <td width="30%">First Name</td>
                                    <td class="p-1">
                                        <input type="text" class="form-control" id="txt_firstName" name="txt_firstName">
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
                                        <input type="text" class="form-control" id="txt_taxIdentificationNumber" name="txt_taxIdentificationNumber">
                                    </td>
                                </tr>
                                <tr>
                                    <td width="30%">Position / Designation</td>
                                    <td class="p-1">
                                        <input type="text" class="form-control" id="txt_position" name="txt_position">
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
                                        <input type="number" class="form-control" id="txt_grossSalary" name="txt_grossSalary">
                                    </td>
                                </tr>
                                <tr>
                                    <td width="30%">Marital Status</td>
                                    <td class="p-1">
                                        <select class="form-control form-select" id="slc_maritalStatus" name="slc_maritalStatus">
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
                                        <input type="text" class="form-control" id="txt_mobileNumber" name="txt_mobileNumber">
                                    </td>
                                </tr>
                                <tr>
                                    <td width="30%">Email Address</td>
                                    <td class="p-1">
                                        <input type="text" class="form-control" id="txt_emailAddress" name="txt_emailAddress">
                                    </td>
                                </tr>
                                <tr>
                                    <td width="30%">Date Hired</td>
                                    <td class="p-1">
                                        <input type="date" class="form-control" id="txt_dateHired" name="txt_dateHired">
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
                                        <select class="form-control form-select" id="slc_employmentStatus" name="slc_employmentStatus">
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
                                        <input type="text" class="form-control" id="txt_payrollBank" name="txt_payrollBank" value="{{ $bankDepository }}" readonly>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="30%">Payroll Bank Account</td>
                                    <td class="p-1">
                                        <input type="text" class="form-control" id="txt_payrollBankAccount" name="txt_payrollBankAccount">
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
                                        <input type="number" class="form-control" id="txt_minimumAmount" name="txt_minimumAmount">
                                    </td>
                                </tr>
                                <tr>
                                    <td width="30%">Maximum Amount</td>
                                    <td class="p-1">
                                        <input type="number" class="form-control" id="txt_maximumAmount" name="txt_maximumAmount">
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
                                        <select class="form-control form-select" id="slc_employeeStatus" name="slc_employeeStatus">
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

    <div class="modal fade" id="modal_importEmployees" tabindex="-1" >
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header modal-header--sticky">
                    <h5 class="modal-title" id="lbl_modalTitle2"> 
                        <i class="feather-plus me-2"></i> Import Employees
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="form_importEmployees">
                        <input type="file" id="file_importEmployees" name="file_importEmployees" data-plugins="dropify" accept=".csv" required />
                    </form>
                </div>
                <div class="modal-footer modal-footer--sticky">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn gwc-button" id="btn_submitEmployee" form="form_employee">Submit</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal_companyAttachment" tabindex="-1" >
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
                        <input type="hidden" id="txt_attachmentId" name="txt_attachmentId">
                        <input type="hidden" id="txt_attachmentCode" name="txt_attachmentCode">
                        <input type="hidden" id="txt_attachmentName" name="txt_attachmentName">
                        <center><div id="div_companyAttachmentResult"></div></center>
                        <input type="file" id="file_companyAttachment" name="file_companyAttachment" data-plugins="dropify" accept="application/pdf" required />
                        <div id="div_companyAttachmentPreview" hidden>
                            <br>
                            <label>Document Preview:</label>
                            <iframe src="" id="iframe_companyAttachmentPreview" style="width:100%; height: 60vh;"></iframe>
                        </div>
                    </form>
                </div>
                <div class="modal-footer modal-footer--sticky">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn gwc-button" id="btn_submitCompanyAttachment" form="form_companyAttachment">Submit</button>
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

    REPRESENTATIVE_EMPLOYEE_LIST.r_loadEmployees($('#txt_companyId').val());

    $('#btn_addEmployee').on('click',function(){
        $('#txt_employeeId').val('');
        $('#modal_employee').modal('show');
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
