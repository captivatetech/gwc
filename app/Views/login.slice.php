<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Login | Goldwater Capital</title>
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
                                
                                <div class="text-center mb-4">
                                    <h4 class="text-uppercase mt-0 gwc-font">LOGIN YOUR ACCOUNT</h4>
                                </div>

                                <form id="form_login">
                                    <div class="mb-3">
                                        <label for="txt_userEmail" class="form-label">Email address</label>
                                        <input type="email" class="form-control" id="txt_userEmail" name="txt_userEmail" placeholder="Email address" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="txt_userPassword" class="form-label">Password</label>
                                        <input type="password" class="form-control" id="txt_userPassword" name="txt_userPassword" placeholder="Password" required>
                                    </div>

                                    <div class="mb-3 d-grid text-center">
                                        <button type="submit" class="btn gwc-button" id="btn_submitLogin"> LOG IN </button>
                                    </div>
                                </form>
                                <p class="text-center"> <a href="<?php echo base_url(); ?>forgot-password" class="text-muted ms-1"><i class="fa fa-lock me-1"></i>Forgot your password?</a></p>
                                <p class="text-center"> <a href="<?php echo base_url(); ?>create-account" class="text-muted ms-1"><i class="fa fa-lock me-1"></i>Create Account</a></p>
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
                $('#form_login').on('submit',function(e){
                    e.preventDefault();
                    INDEX.login(this);
                });
            });
        </script>
        
    </body>
</html>