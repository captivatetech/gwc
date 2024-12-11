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

                            <button type="button" class="btn gwc-button" id="btn_addFaqs"><i class="fe-plus"></i> Add New</button>

                            <p class="text-muted font-14 mb-3"></p>

                                <table id="tbl_faqs" class="table table-bordered dt-responsive table-responsive nowrap">
                                    <thead>
                                        <tr>
                                            <th>Question</th>
                                            <th>Answer</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                    </tbody>
                                </table>

                                <br>

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

    <!--  Modal content for the Large example -->
    <div class="modal fade" id="modal_faqs"  data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header modal-header--sticky">
                    <h4 class="modal-title" id="myLargeModalLabel">Add New Faqs</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" id="form_faqs">
                        <input type="hidden" id="txt_feeId" name="txt_feeId">
                        <div class="row mb-3">
                            <label for="txt_question" class="col-4 col-xl-3 col-form-label">Question</label>
                            <div class="col-8 col-xl-9">
                                <textarea rows="2" class="form-control" id="txt_question" name="txt_question" placeholder="Question" required></textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="txt_feeAmount" class="col-4 col-xl-3 col-form-label">Answer</label>
                            <div class="col-8 col-xl-9">
                                <textarea rows="2" class="form-control" id="txt_answer" name="txt_answer" placeholder="Question" required></textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="slc_faqsStatus" class="col-4 col-xl-3 col-form-label">Status</label>
                            <div class="col-8 col-xl-9">
                                <select id="slc_faqsStatus" name="slc_faqsStatus" class="form-select" required>
                                    <option value="">--Status--</option>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer modal-footer--sticky">
                    <button type="button" class="btn btn-danger">Cancel</button>
                    <button type="submit" class="btn btn-primary" id="btn_saveFaqs" form="form_faqs">Save</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->


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

<!-- Common Helpers Scripts -->
<script type="text/javascript" src="<?php echo base_url();?>public/assets/js/helper/common_helper.js"></script>
<!-- Ajax Helpers Scripts -->
<script type="text/javascript" src="<?php echo base_url(); ?>public/assets/js/helper/ajax_helper.js"></script>
<!-- Custom Scripts -->
<script type="text/javascript" src="<?php echo base_url(); ?>public/assets/js/custom/admin/{{ $customScripts }}.js"></script>

<script type="text/javascript">
  $(document).ready(function(){
    //jQuery Events

    ADMIN_FAQS.loadFaqs();

    $('#btn_addFaq').on('click',function(){
        $('#txt_faqId').val('');
        $('#txt_question').val('');
        $('#txt_answer').val('');
        $('#slc_faqsStatus').val('');
        $('#modal_faqs').modal('show');
    });
    
    $('#form_faqs').on('submit',function(e){
        e.preventDefault();
        let faqId = $('#txt_faqId').val();
        (faqId == "")? ADMIN_FAQS.addFaq(this) : ADMIN_FAQS.editFaq(this);
    });
  });
</script>

@endsection
