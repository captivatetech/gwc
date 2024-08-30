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
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">

                                <table id="tbl_salaryAdvanceAccounts" class="table table-sm table-bordered table-hover nowrap mb-3" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Application Number</th>
                                            <th>Name</th>
                                            <th>Company</th>
                                            <th>Loan Amount</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                    </tbody>
                                </table>

                                <center>
                                    <button type="button" class="btn gwc-button" id="btn_disbursement">Disbursement</button>
                                </center>

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

   

    <div class="modal fade" id="modal_disbursementList" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header modal-header--sticky">
                    <h5 class="modal-title"> 
                        <i class="fas fa-list me-2"></i> Disbursement List
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table id="tbl_disbursementList" style="width: 100%;" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>
                                    <input type="checkbox" id="chk_selectAllDisbursement">
                                </th>
                                <th>Identification Number</th>
                                <th>Employee Name</th>
                                <th>Bank Name</th>
                                <th>Depository Branch Code</th>
                                <th>Loan Amount</th>
                                <th>Account Number</th>
                            </tr>
                        </thead>
                    </table>

                    <hr>

                    <div class="row">
                        <div class="col-lg-4"></div>
                        <div class="col-lg-4">
                            <center>
                                Php. <label id="lbl_disbursementTotalAmount">0.00</label>
                                <div style="border-top: 1px solid black;">
                                    <label>Available Balance: <b><span id="lbl_xenditBalance" style="color:red;"></span></b></label>
                                </div>
                            </center>
                        </div>
                        <div class="col-lg-4"></div>
                    </div>
                    
                </div>
                <div class="modal-footer modal-footer--sticky">
                    <button type="button" class="btn btn-light" id="btn_downloadFile" disabled>Download File</button>
                    <button type="button" class="btn gwc-button" id="btn_proceedDisbursement" disabled>Proceed</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal_loanDisbursement" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header modal-header--sticky">
                    <h5 class="modal-title" id="lbl_modalTitle2"> 
                        Loan Disbursement
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
<script type="text/javascript" src="<?php echo base_url(); ?>public/assets/js/custom/admin/{{ $customScripts }}.js"></script>

<script type="text/javascript">
  $(document).ready(function(){
    //jQuery Events

    ADMIN_SALARY_ADVANCE_ACCOUNTS.a_loadSalaryAdvanceAccounts();

    $('#btn_disbursement').on('click',function(){
        $('#modal_disbursementList').modal('show');
        ADMIN_SALARY_ADVANCE_ACCOUNTS.a_loadDisbursementLists();
        ADMIN_SALARY_ADVANCE_ACCOUNTS.a_loadAccountBalance();
    });

    $('#chk_selectAllDisbursement').on('change',function(){
        if($(this).is(':checked'))
        {
            $('.chk-disbursement').prop('checked',true);
        }
        else
        {
            $('.chk-disbursement').prop('checked',false);
        }

        let ids = $("#tbl_disbursementList tbody input:checkbox:checked").map(function () {
            return $(this).val();
        }).get();

        if(ids.length == 0)
        {
            $('#btn_downloadFile').prop('disabled',true);
            $('#btn_proceedDisbursement').prop('disabled',true);
        }
        else
        {
            $('#btn_downloadFile').prop('disabled',false);
            $('#btn_proceedDisbursement').prop('disabled',false);
        }

        let totalDisbursementAmount = 0;
        $("#tbl_disbursementList tbody input:checkbox:checked").map(function(){
            let amountStr = $(this).parents('tr').find('td:eq(5)').text();
            totalDisbursementAmount += parseFloat(amountStr.substring(5).replace(",",""));
        });

        totalDisbursement = totalDisbursementAmount;

        $('#lbl_disbursementTotalAmount').text(COMMONHELPER.numberWithCommas(totalDisbursementAmount.toFixed(2)));

        let xenditBalance = parseFloat($('#lbl_xenditBalance').text().replace(",",""));

        if(totalDisbursement <= xenditBalance)
        {
            $('#btn_downloadFile').prop('disabled',true);
            $('#btn_proceedDisbursement').prop('disabled',true);
        }
        else
        {
            alert('Insufficient balance!');
            $('#btn_downloadFile').prop('disabled',false);
            $('#btn_proceedDisbursement').prop('disabled',false);
        }
    });

    $('#btn_downloadFile').on('click',function(){
        ADMIN_SALARY_ADVANCE_ACCOUNTS.a_downloadDisbursementList();
    });

    $('#btn_proceedDisbursement').on('click',function(){
        ADMIN_SALARY_ADVANCE_ACCOUNTS.a_prepareDisbursement();
    });

  });
</script>

@endsection
