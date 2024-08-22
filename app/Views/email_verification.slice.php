<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>

    <link href="<?php echo base_url();?>public/assets/Adminto/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />
</head>
<body>

    @if($status == 'success')

    <h3>Email verification complete!</h3>
    <p>Please set your password to login and update your account!</p>

    <br>

    <form id="form_employeeResetPassword">
        <input type="hidden" id="txt_employeeId" name="txt_employeeId" value="{{ $employeeId }}">
        <input type="hidden" id="txt_emailAddress" name="txt_emailAddress" value="{{ $emailAddress }}">
        <input type="hidden" id="txt_authCode" name="txt_authCode" value="{{ $authCode }}">

        <label>Password</label><br>
        <input type="password" id="txt_employeePassword" name="txt_employeePassword" required>
        <br><br>
        <label>Confirm Password</label><br>
        <input type="password" id="txt_employeeConfirmPassword" name="txt_employeeConfirmPassword" required>
        <br><br>
        <button type="submit" id="btn_submitEmailVerification">Submit</button>
    </form>

    @else

        <center>
            <h3 style="color:red;">Email verification failed!</h3>
            <p style="color:red;">Please contact administrator to fix this issue!</p>
        </center>

    @endif

    <input type="hidden" id="txt_baseUrl" value="<?php echo base_url(); ?>">

    <script src="<?php echo base_url();?>public/assets/Adminto/libs/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url();?>public/assets/Adminto/libs/sweetalert2/sweetalert2.min.js"></script>

    <script src="<?php echo base_url();?>public/assets/js/helper/common_helper.js"></script>
    <script src="<?php echo base_url();?>public/assets/js/helper/ajax_helper.js"></script>
    <script src="<?php echo base_url();?>public/assets/js/index.js"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            $('#form_employeeResetPassword').on('submit',function(e){
                e.preventDefault();
                INDEX.e_emailVerification(this);
            });
        });
    </script>

</body>
</html>