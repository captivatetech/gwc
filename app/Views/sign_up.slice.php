<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Create Account | Goldwater Capital</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="<?php echo base_url();?>public/assets/Adminto/images/gwc-icon.png">

		<!-- App css -->

		<link href="<?php echo base_url();?>public/assets/Adminto/css/app.min.css" rel="stylesheet" type="text/css" id="app-style" />
        <link href="<?php echo base_url();?>public/assets/Adminto/css/custom.css" rel="stylesheet" type="text/css"/>
		<!-- icons -->
		<link href="<?php echo base_url();?>public/assets/Adminto/css/icons.min.css" rel="stylesheet" type="text/css" />

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
                                    <h4 class="text-uppercase mt-0 gwc-font">CREATE YOUR ACCOUNT</h4>
                                </div>

                                <form action="#">
                                    <div class="mb-3">
                                        <label for="emailaddress" class="form-label">Email address</label>
                                        <input class="form-control" type="email" id="emailaddress" required="" placeholder="Email Address">
                                    </div>

                                    <div class="mb-3">
                                        <label for="password" class="form-label">Password</label>
                                        <input class="form-control" type="password" required="" id="password" placeholder="Password">
                                    </div>

                                    <div class="mb-3">
                                        <label for="password" class="form-label">Confirm Password</label>
                                        <input class="form-control" type="password" required="" id="password" placeholder="Confirm Password">
                                    </div>

                                    <div class="mb-3 d-grid text-center">
                                        <button class="btn gwc-button" type="submit"> CREATE ACCOUNT</button>
                                    </div>
                                </form>
                            </div> <!-- end card-body -->
                        </div>
                        <!-- end card -->

                    </div> <!-- end col -->
                </div>
                <!-- end row -->
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

        <!-- App js -->
        <script src="<?php echo base_url();?>public/assets/Adminto/js/app.min.js"></script>
        
    </body>
</html>