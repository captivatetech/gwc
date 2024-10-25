

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Reset Password | Goldwater Capital</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="<?php echo base_url();?>public/assets/Adminto/images/gwc-icon.png">

        <!-- App css -->

        <link href="<?php echo base_url();?>public/assets/Adminto/css/app.min.css" rel="stylesheet" type="text/css" id="app-style" />
        <link href="<?php echo base_url();?>public/assets/Adminto/css/custom.css" rel="stylesheet" type="text/css"/>
        <!-- icons -->
        <link href="<?php echo base_url();?>public/assets/Adminto/css/icons.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url();?>public/assets/Adminto/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />

    </head>

    <body class="loading authentication-bg authentication-bg-pattern">

        <div class="account-pages my-4">
            <div class="container">

                <div class="row justify-content-center">
                    <div class="col-md-12 col-lg-12 col-xl-6">
                        <div class="text-center">   
                            <a href="<?php echo base_url();?>">
                                <img src="<?php echo base_url();?>public/assets/Adminto/images/primary.png" alt="" height="50" class="mx-auto">
                            </a>
                            
                        </div>
                        <br>
                        <div class="card">
                            <div class="card-body p-4">

                                @if($authResult == 'Success')

                                    @if($userType == "admin")
                                    <div id="div_createAccount">
                                        <div class="text-center mb-4">
                                            <h4 class="text-uppercase mt-0 gwc-font" style="color:green;">Reset Password</h4>
                                            <p>Please set your new password to login and update your account!</p>
                                        </div>

                                        <form id="form_changePassword">
                                            <input type="hidden" id="txt_userId" name="txt_userId" value="{{ $userId }}">
                                            <input type="hidden" id="txt_emailAddress" name="txt_emailAddress" value="{{ $emailAddress }}">
                                            <input type="hidden" id="txt_authCode" name="txt_authCode" value="{{ $authCode }}">
                                            <input type="hidden" id="txt_userType" name="txt_userType" value="{{ $userType }}">

                                            <div class="mb-3">
                                                <label for="txt_employeePassword" class="form-label">Password</label>
                                                <input type="password" class="form-control" id="txt_employeePassword" name="txt_employeePassword" placeholder="Password" required>
                                            </div>

                                            <div class="mb-3">
                                                <label for="txt_employeeConfirmPassword" class="form-label">Confirm Password</label>
                                                <input type="password" class="form-control" id="txt_employeeConfirmPassword" name="txt_employeeConfirmPassword" placeholder="Confirm Password" required>
                                            </div>

                                            <div class="mb-3 d-grid text-center">
                                                <button type="submit" class="btn gwc-button" id="btn_submitChangePassword">Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                    @else
                                    <div id="div_createAccount">
                                        <div class="text-center mb-4">
                                            <h4 class="text-uppercase mt-0 gwc-font" style="color:green;">Reset Password</h4>
                                            <p>Please set your new password to login and update your account!</p>
                                        </div>

                                        <form id="form_changePassword">
                                            <input type="hidden" id="txt_employeeId" name="txt_employeeId" value="{{ $employeeId }}">
                                            <input type="hidden" id="txt_emailAddress" name="txt_emailAddress" value="{{ $emailAddress }}">
                                            <input type="hidden" id="txt_authCode" name="txt_authCode" value="{{ $authCode }}">
                                            <input type="hidden" id="txt_userType" name="txt_userType" value="{{ $userType }}">

                                            <div class="mb-3">
                                                <label for="txt_employeePassword" class="form-label">Password</label>
                                                <input type="password" class="form-control" id="txt_employeePassword" name="txt_employeePassword" placeholder="Password" required>
                                            </div>

                                            <div class="mb-3">
                                                <label for="txt_employeeConfirmPassword" class="form-label">Confirm Password</label>
                                                <input type="password" class="form-control" id="txt_employeeConfirmPassword" name="txt_employeeConfirmPassword" placeholder="Confirm Password" required>
                                            </div>

                                            <div class="mb-3 d-grid text-center">
                                                <button type="submit" class="btn gwc-button" id="btn_submitChangePassword">Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                    @endif
                                @else

                                    <center>
                                        <h3 style="color:red;">Authentication code is invalid!</h3>
                                        <p style="color:red;">Please contact administrator to fix this issue!</p>
                                    </center>

                                @endif
                                
                            </div> <!-- end card-body -->
                        </div>
                        <!-- end card -->

                    </div> <!-- end col -->
                </div>
                <!-- end row -->

                <input type="hidden" id="txt_baseUrl" value="<?php echo base_url(); ?>">

            </div>
            <!-- end container -->
        </div>
        <!-- end page -->

        <!-- Vendor -->
        <script src="<?php echo base_url();?>public/assets/Adminto/libs/jquery/jquery.min.js"></script>
        <script src="<?php echo base_url();?>public/assets/Adminto/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="<?php echo base_url();?>public/assets/Adminto/libs/simplebar/simplebar.min.js"></script>
        <script src="<?php echo base_url();?>public/assets/Adminto/libs/node-waves/waves.min.js"></script>
        <script src="<?php echo base_url();?>public/assets/Adminto/libs/waypoints/lib/jquery.waypoints.min.js"></script>
        <script src="<?php echo base_url();?>public/assets/Adminto/libs/jquery.counterup/jquery.counterup.min.js"></script>
        <script src="<?php echo base_url();?>public/assets/Adminto/libs/feather-icons/feather.min.js"></script>

        <script src="<?php echo base_url();?>public/assets/Adminto/libs/sweetalert2/sweetalert2.min.js"></script>

        <!-- App js -->
        <script src="<?php echo base_url();?>public/assets/Adminto/js/app.min.js"></script>

        <script src="<?php echo base_url();?>public/assets/js/helper/common_helper.js"></script>
        <script src="<?php echo base_url();?>public/assets/js/helper/ajax_helper.js"></script>
        <script src="<?php echo base_url();?>public/assets/js/index.js"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                $('#form_changePassword').on('submit',function(e){
                    e.preventDefault();
                    INDEX.changePassword(this);
                });
            });
        </script>
        
    </body>
</html>
