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
                                <button type="button" class="btn btn-primary" id="btn_addRole">Add Role</button>

                                <!-- <h4 class="mt-0 header-title">Billings</h4> -->
                                <p class="text-muted font-14 mb-3">
                                   
                                </p>

                                <table id="tbl_roles" class="table table-bordered dt-responsive table-responsive nowrap">
                                    <thead>
                                        <tr>
                                            <th>Role Name</th>
                                            <th>Description</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                    </tbody>
                                </table>
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

    <div class="modal fade" id="modal_roles" tabindex="-1" >
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header modal-header--sticky">
                    <h5 class="modal-title" id="lbl_modalTitle"> 
                        <i class="feather-plus me-2"></i> Create New Role
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="form_roles">
                        <input type="hidden" id="txt_roleId" name="txt_roleId">
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="card invoice-container">
                                    <div class="card-body p-0">
                                        <div class="table-responsive">
                                            <table class="table mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>Create Role</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                        <div class="row px-4 pt-4 pb-4 justify-content-between">
                                            <div class="col-xl-6 mb-4 mb-sm-0">
                                                <div class="form-group row mb-3">
                                                    <label for="InvoiceName" class="col-sm-3 col-form-label">Role Name</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" id="txt_roleName" name="txt_roleName" placeholder="Role Name" required>
                                                    </div>
                                                </div>
                                                <div class="form-group row mb-3">
                                                    <label for="InvoiceName" class="col-sm-3 col-form-label">Description</label>
                                                    <div class="col-sm-9">
                                                        <textarea rows="3" class="form-control" name="txt_roleDescription" id="txt_roleDescription" placeholder="Role Description"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="table-responsive">
                                            <table class="table mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>Access Group</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                            
                                        <div class="px-4 pt-4 clearfix">
                                            <div class="table-responsive pb-4">
                                                <table class="table table-bordered overflow-hidden" id="tbl_rolesConfig">
                                                    <thead>
                                                        <tr>
                                                            <td class="wd-300">
                                                                <div class="form-check form-switch form-switch-sm center-btn">
                                                                    <label class="form-check-label fw-500 text-dark c-pointer" for="chk_modules"><b>Modules</b></label>
                                                                    <input class="form-check-input c-pointer" type="checkbox" id="chk_modules">
                                                                </div>
                                                            </td>
                                                            <td class="wd-150">
                                                                <center>
                                                                    <div class="form-check form-switch form-switch-sm center-btn">
                                                                    <label class="form-check-label fw-500 text-dark c-pointer" for="chk_view"><b>View</b></label>
                                                                    <input class="form-check-input c-pointer" type="checkbox" id="chk_view">
                                                                </div>
                                                                </center>
                                                            </td>
                                                            <td class="wd-150">
                                                                <center>
                                                                    <div class="form-check form-switch form-switch-sm center-btn">
                                                                        <label class="form-check-label fw-500 text-dark c-pointer" for="chk_create"><b>Create</b></label>
                                                                        <input class="form-check-input c-pointer" type="checkbox" id="chk_create">
                                                                    </div>
                                                                </center>
                                                            </td>
                                                            <td class="wd-150">
                                                                <center>
                                                                    <div class="form-check form-switch form-switch-sm center-btn">
                                                                        <label class="form-check-label fw-500 text-dark c-pointer" for="chk_edit"><b>Edit</b></label>
                                                                        <input class="form-check-input c-pointer" type="checkbox" id="chk_edit">
                                                                    </div>
                                                                </center>
                                                            </td>
                                                            <td class="wd-150">
                                                                <center>
                                                                    <div class="form-check form-switch form-switch-sm center-btn">
                                                                        <label class="form-check-label fw-500 text-dark c-pointer" for="chk_delete"><b>Delete</b></label>
                                                                        <input class="form-check-input c-pointer" type="checkbox" id="chk_delete">
                                                                    </div>
                                                                </center>
                                                            </td>
                                                            <td class="wd-150">
                                                                <center><b>Fields</b></center>
                                                            </td>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr class="module">
                                                            <td>
                                                                <div class="form-check form-switch form-switch-sm center-btn">
                                                                    <label class="form-check-label fw-500 text-dark c-pointer">Dashboard</label>
                                                                    <input class="form-check-input c-pointer" type="checkbox">
                                                                </div>  
                                                            </td>
                                                            <td>
                                                                <div class="form-check form-switch form-switch-sm center-btn">
                                                                    <input class="form-check-input c-pointer" type="checkbox">
                                                                </div>        
                                                            </td>
                                                            <td>             
                                                                <div class="form-check form-switch form-switch-sm center-btn">
                                                                    <input class="form-check-input c-pointer" type="checkbox">
                                                                </div>                                
                                                            </td>
                                                            <td>
                                                                <div class="form-check form-switch form-switch-sm center-btn">
                                                                    <input class="form-check-input c-pointer" type="checkbox">
                                                                </div>        
                                                            </td>
                                                            <td>
                                                                <div class="form-check form-switch form-switch-sm center-btn">
                                                                    <input class="form-check-input c-pointer" type="checkbox">
                                                                </div>        
                                                            </td>
                                                            <td></td>
                                                        </tr>
                                                        <tr class="module">
                                                            <td>
                                                                <div class="form-check form-switch form-switch-sm center-btn">
                                                                    <label class="form-check-label fw-500 text-dark c-pointer">Applications</label>
                                                                    <input class="form-check-input c-pointer" type="checkbox">
                                                                </div>  
                                                            </td>
                                                            <td>
                                                                <div class="form-check form-switch form-switch-sm center-btn">
                                                                    <input class="form-check-input c-pointer" type="checkbox">
                                                                </div>        
                                                            </td>
                                                            <td>             
                                                                <div class="form-check form-switch form-switch-sm center-btn">
                                                                    <input class="form-check-input c-pointer" type="checkbox">
                                                                </div>                                
                                                            </td>
                                                            <td>
                                                                <div class="form-check form-switch form-switch-sm center-btn">
                                                                    <input class="form-check-input c-pointer" type="checkbox">
                                                                </div>        
                                                            </td>
                                                            <td>
                                                                <div class="form-check form-switch form-switch-sm center-btn">
                                                                    <input class="form-check-input c-pointer" type="checkbox">
                                                                </div>        
                                                            </td>
                                                            <td></td>
                                                        </tr>
                                                        <tr class="module">
                                                            <td>
                                                                <div class="form-check form-switch form-switch-sm center-btn">
                                                                    <label class="form-check-label fw-500 text-dark c-pointer">Partners List</label>
                                                                    <input class="form-check-input c-pointer" type="checkbox">
                                                                </div>  
                                                            </td>
                                                            <td>
                                                                <div class="form-check form-switch form-switch-sm center-btn">
                                                                    <input class="form-check-input c-pointer" type="checkbox">
                                                                </div>        
                                                            </td>
                                                            <td>             
                                                                <div class="form-check form-switch form-switch-sm center-btn">
                                                                    <input class="form-check-input c-pointer" type="checkbox">
                                                                </div>                                
                                                            </td>
                                                            <td>
                                                                <div class="form-check form-switch form-switch-sm center-btn">
                                                                    <input class="form-check-input c-pointer" type="checkbox">
                                                                </div>        
                                                            </td>
                                                            <td>
                                                                <div class="form-check form-switch form-switch-sm center-btn">
                                                                    <input class="form-check-input c-pointer" type="checkbox">
                                                                </div>        
                                                            </td>
                                                            <td></td>
                                                        </tr>
                                                        <tr class="module">
                                                            <td>
                                                                <div class="form-check form-switch form-switch-sm center-btn">
                                                                    <label class="form-check-label fw-500 text-dark c-pointer">Financing Products / <small>Salary Advance</small></label>
                                                                    <input class="form-check-input c-pointer" type="checkbox">
                                                                </div>  
                                                            </td>
                                                            <td>
                                                                <div class="form-check form-switch form-switch-sm center-btn">
                                                                    <input class="form-check-input c-pointer" type="checkbox">
                                                                </div>        
                                                            </td>
                                                            <td>             
                                                                <div class="form-check form-switch form-switch-sm center-btn">
                                                                    <input class="form-check-input c-pointer" type="checkbox">
                                                                </div>                                
                                                            </td>
                                                            <td>
                                                                <div class="form-check form-switch form-switch-sm center-btn">
                                                                    <input class="form-check-input c-pointer" type="checkbox">
                                                                </div>        
                                                            </td>
                                                            <td>
                                                                <div class="form-check form-switch form-switch-sm center-btn">
                                                                    <input class="form-check-input c-pointer" type="checkbox">
                                                                </div>        
                                                            </td>
                                                            <td></td>
                                                        </tr>
                                                        <tr class="module">
                                                            <td>
                                                                <div class="form-check form-switch form-switch-sm center-btn">
                                                                    <label class="form-check-label fw-500 text-dark c-pointer">Financing Products / <small>Business Expansion</small></label>
                                                                    <input class="form-check-input c-pointer" type="checkbox">
                                                                </div>  
                                                            </td>
                                                            <td>
                                                                <div class="form-check form-switch form-switch-sm center-btn">
                                                                    <input class="form-check-input c-pointer" type="checkbox">
                                                                </div>        
                                                            </td>
                                                            <td>             
                                                                <div class="form-check form-switch form-switch-sm center-btn">
                                                                    <input class="form-check-input c-pointer" type="checkbox">
                                                                </div>                                
                                                            </td>
                                                            <td>
                                                                <div class="form-check form-switch form-switch-sm center-btn">
                                                                    <input class="form-check-input c-pointer" type="checkbox">
                                                                </div>        
                                                            </td>
                                                            <td>
                                                                <div class="form-check form-switch form-switch-sm center-btn">
                                                                    <input class="form-check-input c-pointer" type="checkbox">
                                                                </div>        
                                                            </td>
                                                            <td></td>
                                                        </tr>
                                                        <tr class="module">
                                                            <td>
                                                                <div class="form-check form-switch form-switch-sm center-btn">
                                                                    <label class="form-check-label fw-500 text-dark c-pointer">Financing Products / <small>Payment Now</small></label>
                                                                    <input class="form-check-input c-pointer" type="checkbox">
                                                                </div>  
                                                            </td>
                                                            <td>
                                                                <div class="form-check form-switch form-switch-sm center-btn">
                                                                    <input class="form-check-input c-pointer" type="checkbox">
                                                                </div>        
                                                            </td>
                                                            <td>             
                                                                <div class="form-check form-switch form-switch-sm center-btn">
                                                                    <input class="form-check-input c-pointer" type="checkbox">
                                                                </div>                                
                                                            </td>
                                                            <td>
                                                                <div class="form-check form-switch form-switch-sm center-btn">
                                                                    <input class="form-check-input c-pointer" type="checkbox">
                                                                </div>        
                                                            </td>
                                                            <td>
                                                                <div class="form-check form-switch form-switch-sm center-btn">
                                                                    <input class="form-check-input c-pointer" type="checkbox">
                                                                </div>        
                                                            </td>
                                                            <td></td>
                                                        </tr>
                                                        <tr class="module">
                                                            <td>
                                                                <div class="form-check form-switch form-switch-sm center-btn">
                                                                    <label class="form-check-label fw-500 text-dark c-pointer">Billings</label>
                                                                    <input class="form-check-input c-pointer" type="checkbox">
                                                                </div>  
                                                            </td>
                                                            <td>
                                                                <div class="form-check form-switch form-switch-sm center-btn">
                                                                    <input class="form-check-input c-pointer" type="checkbox">
                                                                </div>        
                                                            </td>
                                                            <td>             
                                                                <div class="form-check form-switch form-switch-sm center-btn">
                                                                    <input class="form-check-input c-pointer" type="checkbox">
                                                                </div>                                
                                                            </td>
                                                            <td>
                                                                <div class="form-check form-switch form-switch-sm center-btn">
                                                                    <input class="form-check-input c-pointer" type="checkbox">
                                                                </div>        
                                                            </td>
                                                            <td>
                                                                <div class="form-check form-switch form-switch-sm center-btn">
                                                                    <input class="form-check-input c-pointer" type="checkbox">
                                                                </div>        
                                                            </td>
                                                            <td></td>
                                                        </tr>
                                                        <tr class="module">
                                                            <td>
                                                                <div class="form-check form-switch form-switch-sm center-btn">
                                                                    <label class="form-check-label fw-500 text-dark c-pointer">Payments</label>
                                                                    <input class="form-check-input c-pointer" type="checkbox">
                                                                </div>  
                                                            </td>
                                                            <td>
                                                                <div class="form-check form-switch form-switch-sm center-btn">
                                                                    <input class="form-check-input c-pointer" type="checkbox">
                                                                </div>        
                                                            </td>
                                                            <td>             
                                                                <div class="form-check form-switch form-switch-sm center-btn">
                                                                    <input class="form-check-input c-pointer" type="checkbox">
                                                                </div>                                
                                                            </td>
                                                            <td>
                                                                <div class="form-check form-switch form-switch-sm center-btn">
                                                                    <input class="form-check-input c-pointer" type="checkbox">
                                                                </div>        
                                                            </td>
                                                            <td>
                                                                <div class="form-check form-switch form-switch-sm center-btn">
                                                                    <input class="form-check-input c-pointer" type="checkbox">
                                                                </div>        
                                                            </td>
                                                            <td></td>
                                                        </tr>
                                                        <tr class="module">
                                                            <td>
                                                                <div class="form-check form-switch form-switch-sm center-btn">
                                                                    <label class="form-check-label fw-500 text-dark c-pointer">Maintenance / <small>Users</small></label>
                                                                    <input class="form-check-input c-pointer" type="checkbox">
                                                                </div>  
                                                            </td>
                                                            <td>
                                                                <div class="form-check form-switch form-switch-sm center-btn">
                                                                    <input class="form-check-input c-pointer" type="checkbox">
                                                                </div>        
                                                            </td>
                                                            <td>             
                                                                <div class="form-check form-switch form-switch-sm center-btn">
                                                                    <input class="form-check-input c-pointer" type="checkbox">
                                                                </div>                                
                                                            </td>
                                                            <td>
                                                                <div class="form-check form-switch form-switch-sm center-btn">
                                                                    <input class="form-check-input c-pointer" type="checkbox">
                                                                </div>        
                                                            </td>
                                                            <td>
                                                                <div class="form-check form-switch form-switch-sm center-btn">
                                                                    <input class="form-check-input c-pointer" type="checkbox">
                                                                </div>        
                                                            </td>
                                                            <td></td>
                                                        </tr>
                                                        <tr class="module">
                                                            <td>
                                                                <div class="form-check form-switch form-switch-sm center-btn">
                                                                    <label class="form-check-label fw-500 text-dark c-pointer">Maintenance / <small>Roles</small></label>
                                                                    <input class="form-check-input c-pointer" type="checkbox">
                                                                </div>  
                                                            </td>
                                                            <td>
                                                                <div class="form-check form-switch form-switch-sm center-btn">
                                                                    <input class="form-check-input c-pointer" type="checkbox">
                                                                </div>        
                                                            </td>
                                                            <td>             
                                                                <div class="form-check form-switch form-switch-sm center-btn">
                                                                    <input class="form-check-input c-pointer" type="checkbox">
                                                                </div>                                
                                                            </td>
                                                            <td>
                                                                <div class="form-check form-switch form-switch-sm center-btn">
                                                                    <input class="form-check-input c-pointer" type="checkbox">
                                                                </div>        
                                                            </td>
                                                            <td>
                                                                <div class="form-check form-switch form-switch-sm center-btn">
                                                                    <input class="form-check-input c-pointer" type="checkbox">
                                                                </div>        
                                                            </td>
                                                            <td></td>
                                                        </tr>
                                                        <tr class="module">
                                                            <td>
                                                                <div class="form-check form-switch form-switch-sm center-btn">
                                                                    <label class="form-check-label fw-500 text-dark c-pointer">Maintenance / <small>Fees</small></label>
                                                                    <input class="form-check-input c-pointer" type="checkbox">
                                                                </div>  
                                                            </td>
                                                            <td>
                                                                <div class="form-check form-switch form-switch-sm center-btn">
                                                                    <input class="form-check-input c-pointer" type="checkbox">
                                                                </div>        
                                                            </td>
                                                            <td>             
                                                                <div class="form-check form-switch form-switch-sm center-btn">
                                                                    <input class="form-check-input c-pointer" type="checkbox">
                                                                </div>                                
                                                            </td>
                                                            <td>
                                                                <div class="form-check form-switch form-switch-sm center-btn">
                                                                    <input class="form-check-input c-pointer" type="checkbox">
                                                                </div>        
                                                            </td>
                                                            <td>
                                                                <div class="form-check form-switch form-switch-sm center-btn">
                                                                    <input class="form-check-input c-pointer" type="checkbox">
                                                                </div>        
                                                            </td>
                                                            <td></td>
                                                        </tr>
                                                        <tr class="module">
                                                            <td>
                                                                <div class="form-check form-switch form-switch-sm center-btn">
                                                                    <label class="form-check-label fw-500 text-dark c-pointer">Maintenance / <small>Faqs</small></label>
                                                                    <input class="form-check-input c-pointer" type="checkbox">
                                                                </div>  
                                                            </td>
                                                            <td>
                                                                <div class="form-check form-switch form-switch-sm center-btn">
                                                                    <input class="form-check-input c-pointer" type="checkbox">
                                                                </div>        
                                                            </td>
                                                            <td>             
                                                                <div class="form-check form-switch form-switch-sm center-btn">
                                                                    <input class="form-check-input c-pointer" type="checkbox">
                                                                </div>                                
                                                            </td>
                                                            <td>
                                                                <div class="form-check form-switch form-switch-sm center-btn">
                                                                    <input class="form-check-input c-pointer" type="checkbox">
                                                                </div>        
                                                            </td>
                                                            <td>
                                                                <div class="form-check form-switch form-switch-sm center-btn">
                                                                    <input class="form-check-input c-pointer" type="checkbox">
                                                                </div>        
                                                            </td>
                                                            <td></td>
                                                        </tr>
                                                        <tr class="module">
                                                            <td>
                                                                <div class="form-check form-switch form-switch-sm center-btn">
                                                                    <label class="form-check-label fw-500 text-dark c-pointer">Reports</label>
                                                                    <input class="form-check-input c-pointer" type="checkbox">
                                                                </div>  
                                                            </td>
                                                            <td>
                                                                <div class="form-check form-switch form-switch-sm center-btn">
                                                                    <input class="form-check-input c-pointer" type="checkbox">
                                                                </div>        
                                                            </td>
                                                            <td>             
                                                                <div class="form-check form-switch form-switch-sm center-btn">
                                                                    <input class="form-check-input c-pointer" type="checkbox">
                                                                </div>                                
                                                            </td>
                                                            <td>
                                                                <div class="form-check form-switch form-switch-sm center-btn">
                                                                    <input class="form-check-input c-pointer" type="checkbox">
                                                                </div>        
                                                            </td>
                                                            <td>
                                                                <div class="form-check form-switch form-switch-sm center-btn">
                                                                    <input class="form-check-input c-pointer" type="checkbox">
                                                                </div>        
                                                            </td>
                                                            <td></td>
                                                        </tr>
                                                        <tr class="module">
                                                            <td>
                                                                <div class="form-check form-switch form-switch-sm center-btn">
                                                                    <label class="form-check-label fw-500 text-dark c-pointer">Audit Trail</label>
                                                                    <input class="form-check-input c-pointer" type="checkbox">
                                                                </div>  
                                                            </td>
                                                            <td>
                                                                <div class="form-check form-switch form-switch-sm center-btn">
                                                                    <input class="form-check-input c-pointer" type="checkbox">
                                                                </div>        
                                                            </td>
                                                            <td>             
                                                                <div class="form-check form-switch form-switch-sm center-btn">
                                                                    <input class="form-check-input c-pointer" type="checkbox">
                                                                </div>                                
                                                            </td>
                                                            <td>
                                                                <div class="form-check form-switch form-switch-sm center-btn">
                                                                    <input class="form-check-input c-pointer" type="checkbox">
                                                                </div>        
                                                            </td>
                                                            <td>
                                                                <div class="form-check form-switch form-switch-sm center-btn">
                                                                    <input class="form-check-input c-pointer" type="checkbox">
                                                                </div>        
                                                            </td>
                                                            <td></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer modal-footer--sticky">
                    <button type="button" class="btn btn-danger">Discard</button>
                    <button type="submit" class="btn btn-primary" id="btn_saveRole" form="form_roles">Save Role</button>
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

<!-- Common Helpers Scripts -->
<script type="text/javascript" src="<?php echo base_url();?>public/assets/js/helper/common_helper.js"></script>
<!-- Ajax Helpers Scripts -->
<script type="text/javascript" src="<?php echo base_url(); ?>public/assets/js/helper/ajax_helper.js"></script>
<!-- Custom Scripts -->
<script type="text/javascript" src="<?php echo base_url(); ?>public/assets/js/custom/admin/{{ $customScripts }}.js"></script>

<script type="text/javascript">
  $(document).ready(function(){
    //jQuery Events
    ROLES.loadRoles();

    $('#btn_addRole').on('click',function(){
        $('#txt_roleId').val('');
        $('#txt_roleName').val('');
        $('#txt_roleDescription').val('');
        $('#lbl_modalTitle').html('<i class="feather-plus me-2"></i> Create New Role');
        $('#tbl_rolesConfig').find('input[type="checkbox"]').prop('checked',true);
        $('#modal_roles').modal('show');
    });

    $('#chk_modules').on('change',function(){
      let checkBoxStatus = ($(this).is(':checked'))? true : false;
      $('#tbl_rolesConfig').find('input[type="checkbox"]').prop('checked',checkBoxStatus);
      $('.btn_modules').prop('disabled',!checkBoxStatus);   
    });
    $('#tbl_rolesConfig tbody tr').find('td:eq(0) input[type="checkbox"]').on('change',function(){
      let checkBoxStatus = ($(this).is(':checked'))? true : false;
      $(this).parents('tr').find('td input[type="checkbox"]').prop('checked',checkBoxStatus);
      $(this).parents('tr').find('td:eq(5) .btn_modules').prop('disabled',!checkBoxStatus);

      let checkboxesModule = $('#tbl_rolesConfig tbody tr').find('td:eq(0) input[type="checkbox"]').length;
      let checkedboxesModule = $('#tbl_rolesConfig tbody tr').find('td:eq(0) input:checked[type="checkbox"]').length;
      $('#chk_modules').prop('checked',(checkboxesModule == checkedboxesModule)? true : false);

      let checkboxesView = $('#tbl_rolesConfig tbody tr').find('td:eq(1) input[type="checkbox"]').length;
      let checkedboxesView = $('#tbl_rolesConfig tbody tr').find('td:eq(1) input:checked[type="checkbox"]').length;
      $('#chk_view').prop('checked',(checkboxesView == checkedboxesView)? true : false);

      let checkboxesCreate = $('#tbl_rolesConfig tbody tr').find('td:eq(2) input[type="checkbox"]').length;
      let checkedboxesCreate = $('#tbl_rolesConfig tbody tr').find('td:eq(2) input:checked[type="checkbox"]').length;
      $('#chk_create').prop('checked',(checkboxesCreate == checkedboxesCreate)? true : false);

      let checkboxesEdit = $('#tbl_rolesConfig tbody tr').find('td:eq(3) input[type="checkbox"]').length;
      let checkedboxesEdit = $('#tbl_rolesConfig tbody tr').find('td:eq(3) input:checked[type="checkbox"]').length;
      $('#chk_edit').prop('checked',(checkboxesEdit == checkedboxesEdit)? true : false);

      let checkboxesDelete = $('#tbl_rolesConfig tbody tr').find('td:eq(4) input[type="checkbox"]').length;
      let checkedboxesDelete = $('#tbl_rolesConfig tbody tr').find('td:eq(4) input:checked[type="checkbox"]').length;
      $('#chk_delete').prop('checked',(checkboxesDelete == checkedboxesDelete)? true : false);
    });

    // Check All View Columns
    $('#chk_view').on('change',function(){
      let checkBoxStatus = ($(this).is(':checked'))? true : false;
      $('#tbl_rolesConfig tbody tr').find('td:eq(1) input[type="checkbox"]').prop('checked',checkBoxStatus);     
      $('#tbl_rolesConfig').find('input[type="checkbox"]').prop('checked',checkBoxStatus);
      $('.btn_modules').prop('disabled',!checkBoxStatus);
    });
    $('#tbl_rolesConfig tbody tr').find('td:eq(1) input[type="checkbox"]').on('change',function(){
      let checkBoxStatus = ($(this).is(':checked'))? true : false;
      $(this).parents('tr').find('td:eq(0) input[type="checkbox"]').prop('checked',checkBoxStatus);
      $(this).parents('tr').find('td:eq(2) input[type="checkbox"]').prop('checked',checkBoxStatus);
      $(this).parents('tr').find('td:eq(3) input[type="checkbox"]').prop('checked',checkBoxStatus);
      $(this).parents('tr').find('td:eq(4) input[type="checkbox"]').prop('checked',checkBoxStatus);
      $(this).parents('tr').find('td:eq(5) .btn_modules').prop('disabled',!checkBoxStatus);

      let checkboxesModule = $('#tbl_rolesConfig tbody tr').find('td:eq(0) input[type="checkbox"]').length;
      let checkedboxesModule = $('#tbl_rolesConfig tbody tr').find('td:eq(0) input:checked[type="checkbox"]').length;
      $('#chk_modules').prop('checked',(checkboxesModule == checkedboxesModule)? true : false);

      let checkboxesView = $('#tbl_rolesConfig tbody tr').find('td:eq(1) input[type="checkbox"]').length;
      let checkedboxesView = $('#tbl_rolesConfig tbody tr').find('td:eq(1) input:checked[type="checkbox"]').length;
      $('#chk_view').prop('checked',(checkboxesView == checkedboxesView)? true : false);

      let checkboxesCreate = $('#tbl_rolesConfig tbody tr').find('td:eq(2) input[type="checkbox"]').length;
      let checkedboxesCreate = $('#tbl_rolesConfig tbody tr').find('td:eq(2) input:checked[type="checkbox"]').length;
      $('#chk_create').prop('checked',(checkboxesCreate == checkedboxesCreate)? true : false);

      let checkboxesEdit = $('#tbl_rolesConfig tbody tr').find('td:eq(3) input[type="checkbox"]').length;
      let checkedboxesEdit = $('#tbl_rolesConfig tbody tr').find('td:eq(3) input:checked[type="checkbox"]').length;
      $('#chk_edit').prop('checked',(checkboxesEdit == checkedboxesEdit)? true : false);

      let checkboxesDelete = $('#tbl_rolesConfig tbody tr').find('td:eq(4) input[type="checkbox"]').length;
      let checkedboxesDelete = $('#tbl_rolesConfig tbody tr').find('td:eq(4) input:checked[type="checkbox"]').length;
      $('#chk_delete').prop('checked',(checkboxesDelete == checkedboxesDelete)? true : false);
    });

    // Check All Create Columns
    $('#chk_create').on('change',function(){
      let checkBoxStatus = ($(this).is(':checked'))? true : false;
      $('#tbl_rolesConfig tbody tr').find('td:eq(2) input[type="checkbox"]').prop('checked',checkBoxStatus); 
      if($(this).is(':checked') || $('#chk_edit').is(':checked') || $('#chk_delete').is(':checked'))
      {
        $('#tbl_rolesConfig thead tr').find('td:eq(0) input[type="checkbox"]').prop('checked',true);
        $('#tbl_rolesConfig tbody tr').find('td:eq(0) input[type="checkbox"]').prop('checked',true);
        $('#tbl_rolesConfig thead tr').find('td:eq(1) input[type="checkbox"]').prop('checked',true);
        $('#tbl_rolesConfig tbody tr').find('td:eq(1) input[type="checkbox"]').prop('checked',true);
        $('.btn_modules').prop('disabled',false);
      }
    });
    $('#tbl_rolesConfig tbody tr').find('td:eq(2) input[type="checkbox"]').on('change',function(){
      let checkBoxStatus = ($(this).is(':checked'))? true : false;
      if(checkBoxStatus == true)
      {
        $(this).parents('tr').find('td:eq(0) input[type="checkbox"]').prop('checked',checkBoxStatus);
        $(this).parents('tr').find('td:eq(1) input[type="checkbox"]').prop('checked',checkBoxStatus);
        $(this).parents('tr').find('td:eq(5) .btn_modules').prop('disabled',!checkBoxStatus);
      }

      let checkboxesModule = $('#tbl_rolesConfig tbody tr').find('td:eq(0) input[type="checkbox"]').length;
      let checkedboxesModule = $('#tbl_rolesConfig tbody tr').find('td:eq(0) input:checked[type="checkbox"]').length;

      let checkboxesView = $('#tbl_rolesConfig tbody tr').find('td:eq(1) input[type="checkbox"]').length;
      let checkedboxesView = $('#tbl_rolesConfig tbody tr').find('td:eq(1) input:checked[type="checkbox"]').length;

      let checkboxesCreate = $('#tbl_rolesConfig tbody tr').find('td:eq(2) input[type="checkbox"]').length;
      let checkedboxesCreate = $('#tbl_rolesConfig tbody tr').find('td:eq(2) input:checked[type="checkbox"]').length;

      $('#chk_modules').prop('checked',(checkboxesModule == checkedboxesModule)? true : false);
      $('#chk_view').prop('checked',(checkboxesView == checkedboxesView)? true : false);
      $('#chk_create').prop('checked',(checkboxesCreate == checkedboxesCreate)? true : false);
    });

    // Check All Edit Columns
    $('#chk_edit').on('change',function(){
      let checkBoxStatus = ($(this).is(':checked'))? true : false;
      $('#tbl_rolesConfig tbody tr').find('td:eq(3) input[type="checkbox"]').prop('checked',checkBoxStatus);  
      if($('#chk_create').is(':checked') || $(this).is(':checked') || $('#chk_delete').is(':checked'))
      {
        $('#tbl_rolesConfig thead tr').find('td:eq(0) input[type="checkbox"]').prop('checked',true);
        $('#tbl_rolesConfig tbody tr').find('td:eq(0) input[type="checkbox"]').prop('checked',true);
        $('#tbl_rolesConfig thead tr').find('td:eq(1) input[type="checkbox"]').prop('checked',true);
        $('#tbl_rolesConfig tbody tr').find('td:eq(1) input[type="checkbox"]').prop('checked',true);
        $('.btn_modules').prop('disabled',false);
      }
    });
    $('#tbl_rolesConfig tbody tr').find('td:eq(3) input[type="checkbox"]').on('change',function(){
      let checkBoxStatus = ($(this).is(':checked'))? true : false;
      if(checkBoxStatus == true)
      {
        $(this).parents('tr').find('td:eq(0) input[type="checkbox"]').prop('checked',checkBoxStatus);
        $(this).parents('tr').find('td:eq(1) input[type="checkbox"]').prop('checked',checkBoxStatus);
        $(this).parents('tr').find('td:eq(5) .btn_modules').prop('disabled',!checkBoxStatus);
      }

      let checkboxesModule = $('#tbl_rolesConfig tbody tr').find('td:eq(0) input[type="checkbox"]').length;
      let checkedboxesModule = $('#tbl_rolesConfig tbody tr').find('td:eq(0) input:checked[type="checkbox"]').length;

      let checkboxesView = $('#tbl_rolesConfig tbody tr').find('td:eq(1) input[type="checkbox"]').length;
      let checkedboxesView = $('#tbl_rolesConfig tbody tr').find('td:eq(1) input:checked[type="checkbox"]').length;

      let checkboxesEdit = $('#tbl_rolesConfig tbody tr').find('td:eq(3) input[type="checkbox"]').length;
      let checkedboxesEdit = $('#tbl_rolesConfig tbody tr').find('td:eq(3) input:checked[type="checkbox"]').length;

      $('#chk_modules').prop('checked',(checkboxesModule == checkedboxesModule)? true : false);
      $('#chk_view').prop('checked',(checkboxesView == checkedboxesView)? true : false);
      $('#chk_edit').prop('checked',(checkboxesEdit == checkedboxesEdit)? true : false);
    });

    // Check All Delete Columns
    $('#chk_delete').on('change',function(){
      let checkBoxStatus = ($(this).is(':checked'))? true : false;
      $('#tbl_rolesConfig tbody tr').find('td:eq(4) input[type="checkbox"]').prop('checked',checkBoxStatus);   
      if($('#chk_create').is(':checked') || $('#chk_edit').is(':checked') || $(this).is(':checked'))
      {
        $('#tbl_rolesConfig thead tr').find('td:eq(0) input[type="checkbox"]').prop('checked',true);
        $('#tbl_rolesConfig tbody tr').find('td:eq(0) input[type="checkbox"]').prop('checked',true);
        $('#tbl_rolesConfig thead tr').find('td:eq(1) input[type="checkbox"]').prop('checked',true);
        $('#tbl_rolesConfig tbody tr').find('td:eq(1) input[type="checkbox"]').prop('checked',true);
        $('.btn_modules').prop('disabled',false);
      }
    });
    $('#tbl_rolesConfig tbody tr').find('td:eq(4) input[type="checkbox"]').on('change',function(){
      let checkBoxStatus = ($(this).is(':checked'))? true : false;
      if(checkBoxStatus == true)
      {
        $(this).parents('tr').find('td:eq(0) input[type="checkbox"]').prop('checked',checkBoxStatus);
        $(this).parents('tr').find('td:eq(1) input[type="checkbox"]').prop('checked',checkBoxStatus);
        $(this).parents('tr').find('td:eq(5) .btn_modules').prop('disabled',!checkBoxStatus);
      }

      let checkboxesModule = $('#tbl_rolesConfig tbody tr').find('td:eq(0) input[type="checkbox"]').length;
      let checkedboxesModule = $('#tbl_rolesConfig tbody tr').find('td:eq(0) input:checked[type="checkbox"]').length;

      let checkboxesView = $('#tbl_rolesConfig tbody tr').find('td:eq(1) input[type="checkbox"]').length;
      let checkedboxesView = $('#tbl_rolesConfig tbody tr').find('td:eq(1) input:checked[type="checkbox"]').length;

      let checkboxesDelete = $('#tbl_rolesConfig tbody tr').find('td:eq(4) input[type="checkbox"]').length;
      let checkedboxesDelete = $('#tbl_rolesConfig tbody tr').find('td:eq(4) input:checked[type="checkbox"]').length;

      $('#chk_modules').prop('checked',(checkboxesModule == checkedboxesModule)? true : false);
      $('#chk_view').prop('checked',(checkboxesView == checkedboxesView)? true : false);
      $('#chk_delete').prop('checked',(checkboxesDelete == checkedboxesDelete)? true : false);
    });
    
    $('#form_roles').on('submit',function(e){
        e.preventDefault();
        let roleId = $('#txt_roleId').val();
        (roleId == "")? ROLES.addRole(this) : ROLES.editRole(this);
    });

  });
</script>

@endsection
