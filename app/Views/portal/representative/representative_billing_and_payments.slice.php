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

                @if($subscriptionStatus == null)
                <h1>Please subscribe to a product first to activate this module.</h1>
                <p>Click <a href="<?php echo base_url('portal/representative/financing-products'); ?>">here</a> to subscribe for a product.</p>
                @else
                <div class="row">

                    <div class="col-md-6 col-xl-6">

                        <div class="card">
                            <div class="card-body">
                                <!-- <iframe width="100%" height="315" src="https://www.youtube.com/embed/2sLtyQHxRUY?si=7XNml36thVoQFmyn" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe> -->
                            </div>
                        </div>

                    </div><!-- end col -->

                    <div class="col-md-6 col-xl-3">

                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Amount due in <b><span id="lbl_amountDueInDays">x</span></b>  days</h4>
                                <label id="lbl_amountDue"></label>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Total # of loans active</h4>
                                <b><span id="lbl_totalActiveLoans"></span></b>
                            </div>
                        </div>

                    </div><!-- end col -->

                    <div class="col-md-6 col-xl-3">

                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Past due in <b><span id="lbl_pastDueInDays">x</span></b> days</h4>
                                <label id="lbl_pastDue"></label>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Total # of loans repaid</h4>
                                <b><span id="lbl_totalRepaidLoans"></span></b>
                            </div>
                        </div>

                    </div><!-- end col -->

                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">

                                <p class="text-muted font-14 mb-3">
                                </p>

                                <table id="tbl_billings" class="table table-bordered nowrap" style="width:100%;">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Billing Number</th>
                                            <th>Billing Amount</th>
                                            <th>Paid Amount</th>
                                            <th>Balance</th>
                                            <th>Due Date</th>
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
                @endif

                <input type="hidden" id="txt_baseUrl" value="<?php echo base_url(); ?>">
                
            </div> <!-- container-fluid -->

        </div> <!-- content -->

    </div>
    <!-- ============================================================== -->
    <!-- End Page content -->
    <!-- ============================================================== -->

    <div class="modal fade" id="modal_billingDetails" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header modal-header--sticky">
                    <h5 class="modal-title"> 
                        <i class="feather-plus me-2"></i> Billing Details
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="form_payments">
                        <input type="hidden" id="txt_billingId" name="txt_billingId">
                        <div class="row">
                            <div class="col-lg-6">
                                <table style="width: 100%" class="tbl-custom">
                                    <tbody>
                                        <tr>
                                            <td>Billing Number</td>
                                            <td>
                                                <input type="text" class="form-control" id="txt_billingNumber" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Company Name</td>
                                            <td>
                                                <input type="text" class="form-control" id="txt_companyName" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Company Code</td>
                                            <td>
                                                <input type="text" class="form-control" id="txt_companyCode" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Billing Date</td>
                                            <td>
                                                <input type="text" class="form-control" id="txt_billingDate" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Due Date</td>
                                            <td>
                                                <input type="text" class="form-control" id="txt_dueDate" readonly>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-lg-6">
                                <table style="width: 100%;" class="tbl-custom">
                                    <tbody>
                                        <tr>
                                            <td>Billing Amount</td>
                                            <td>
                                                <input type="text" id="txt_billingAmount" name="txt_billingAmount" class="form-control" style="text-align: right;" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Payment Amount</td>
                                            <td>
                                                <input type="text" id="txt_paymentAmount" name="txt_paymentAmount" class="form-control" style="text-align: right;" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Balance</td>
                                            <td>
                                                <input type="text" id="txt_balance" name="txt_balance" class="form-control" style="text-align: right;" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Payment Date</td>
                                            <td>
                                                <input type="date" id="txt_paymentDate" name="txt_paymentDate" class="form-control" value="<?php echo date('Y-m-d'); ?>" required>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Payment Type</td>
                                            <td>
                                                <select id="slc_paymentType" name="slc_paymentType" class="form-control form-select" required>
                                                    <option value="">---</option>
                                                    <option value="Cash">Cash</option>
                                                    <option value="Bank-Deposit">Bank Deposit</option>
                                                    <option value="Check-Deposit">Check Deposit</option>
                                                    <option value="Online-Payment">Online Payment</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr id="tr_paymentReferenceNumber" hidden>
                                            <td>Reference Number</td>
                                            <td>
                                                <input type="text" id="txt_paymentReferenceNumber" name="txt_paymentReferenceNumber"  class="form-control">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div id="div_proofOfPayment" hidden>
                            <label>Attach Proof of Payment</label>
                            <input type="file" id="file_proofOfPayment" name="file_proofOfPayment" data-plugins="dropify" accept="application/pdf" />
                        </div>
                        
                    </form>

                    <hr>

                    <table id="tbl_billingDetails" class="table table-bordered nowrap" style="width:100%;">
                        <thead>
                            <tr>
                                <th>
                                    <input type="checkbox" id="chk_selectAllBillings">
                                </th>
                                <th>Loan Account Number</th>
                                <th>Date Released</th>
                                <th>Name</th>
                                <th>Loan Amount</th>
                                <th>Amount to Pay</th>
                                <th>Terms</th>
                                <th>Status</th>
                                <th>Penalty Type</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>

                    <hr>

                    <div class="row">
                        <div class="col-lg-6">
                            <label>Number of Accounts Paid: </label>
                            <label style="color:red;" id="lbl_numberOfAccountsPaid">3 out of 4</label>
                        </div>
                        <div class="col-lg-6">
                            <label>Total: </label>
                            <label style="color:red;" id="lbl_billingTotalAmount">PHP 00.0</label>
                        </div>
                    </div>

                    <div id="div_promisoryNote" hidden>
                        <hr>
                        <label>Promisory Note</label>
                        <input type="file" id="file_promisoryNote" name="file_promisoryNote" data-plugins="dropify" accept="application/pdf" />
                    </div>
                </div>
                <div class="modal-footer modal-footer--sticky">
                    <button type="submit" class="btn gwc-button" id="btn_submitPayment" form="form_payments" disabled>Submit</button>
                </div>
            </div>
        </div>
    </div>

@endsection



@section('custom_scripts')


<!-- knob plugin -->
<script src="<?php echo base_url();?>public/assets/Adminto/libs/jquery-knob/jquery.knob.min.js"></script>

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
    REPRESENTATIVE_BILLING_AND_PAYMENTS.r_loadBillings();

    $('#chk_selectAllBillings').on('change', function(){
        if($(this).is(':checked'))
        {
            $('.chk-billing').prop('checked',true);
        }
        else
        {
            $('.chk-billing').prop('checked',false);
        }

        let ids = $("#tbl_billingDetails tbody input:checkbox:checked").map(function () {
            return $(this).val();
        }).get();

        let trCount = 0;
        $("#tbl_billingDetails tbody tr").map(function () {
            trCount++;
        });

        if(trCount >= $('#tbl_billingDetails_length select').val())
        {
            if(ids.length == $('#tbl_billingDetails_length select').val())
            {
                $('#chk_selectAllBilling').prop('checked',true);
            }
            else
            {
                $('#chk_selectAllBilling').prop('checked',false);
            }
        }
        else
        {   
            if(trCount == ids.length)
            {
                $('#chk_selectAllBilling').prop('checked',true);
            }
            else
            {
                $('#chk_selectAllBilling').prop('checked',false);
            }
        }

        if(trCount > ids.length && ids.length != 0)
        {
            $('#div_promisoryNote').prop('hidden',false);
            $('#file_promisoryNote').prop('required',true);
        }
        else
        {
            $('#div_promisoryNote').prop('hidden',true);
            $('#file_promisoryNote').prop('required',false);
        }
        

        if(ids.length == 0)
        {
            $('#btn_submitPayment').prop('disabled',true);
        }
        else
        {
            $('#btn_submitPayment').prop('disabled',false);
        }

        let totalBillingAmount = 0;
        $("#tbl_billingDetails tbody input:checkbox:checked").map(function(){
            let amountStr = $(this).parents('tr').find('td:eq(5)').text();
            totalBillingAmount += parseFloat(amountStr.substring(5).replace(",",""));
        });

        $("#tbl_billingDetails tbody input:checkbox").map(function(){
            if($(this).is(':checked'))
            {
                $(this).parents('tr').find('td:eq(8) select').prop('disabled',true).prop('required',false).val('');
                $(this).parents('tr').find('td:eq(8) select').css('border-color','#98A6AD');
            }
            else
            {
                $(this).parents('tr').find('td:eq(8) select').prop('disabled',false).prop('required',true);
                $(this).parents('tr').find('td:eq(8) select').css('border-color','#CED4DA');
            }
        });

        let billingAmount = parseFloat(($('#txt_billingAmount').val()).replace(',',''));
        let balance = billingAmount - totalBillingAmount;

        $('#txt_paymentAmount').val(COMMONHELPER.numberWithCommas(totalBillingAmount.toFixed(2)));
        $('#txt_balance').val(COMMONHELPER.numberWithCommas(balance.toFixed(2)));
        $('#lbl_numberOfAccountsPaid').text(`${ids.length} out of ${trCount}`);
        $('#lbl_billingTotalAmount').text(`PHP ${COMMONHELPER.numberWithCommas(totalBillingAmount.toFixed(2))}`);
    });

    $('#slc_paymentType').on('change',function(){
        if($(this).val() == 'Online-Payment' || $(this).val() == "")
        {
            $('#div_proofOfPayment').prop('hidden',true);
            $('#file_proofOfPayment').prop('required',false);

            $('#tr_paymentReferenceNumber').prop('hidden',true);
            $('#txt_paymentReferenceNumber').prop('required',false);
        }
        else
        {
            $('#div_proofOfPayment').prop('hidden',false);
            $('#file_proofOfPayment').prop('required',true);

            $('#tr_paymentReferenceNumber').prop('hidden',false);
            $('#txt_paymentReferenceNumber').prop('required',true);
        }
    });

    $('#form_payments').on('submit',function(e){
        e.preventDefault();

        let num = 0;
        $("#tbl_billingDetails tbody input:checkbox").map(function(){
            if(!$(this).is(':checked'))
            {
                if($(this).parents('tr').find('td:eq(8) select').val() == "")
                {
                    num++;
                    $(this).parents('tr').find('td:eq(8) select').css('border-color','red');
                }
            }
        });
        if(num == 0)
        {
            REPRESENTATIVE_BILLING_AND_PAYMENTS.r_submitPayment(this);
        }
        else
        {
            alert('Penalty Type is required!');
        }
    });
    
  });
</script>

@endsection
