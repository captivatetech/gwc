<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
</head>
<body>
    <h1>Payment Completed!</h1>

    <input type="hidden" id="txt_paymentStatus" value="{{ $payment_status }}">
    <input type="hidden" id="txt_baseUrl" value="<?php echo base_url(); ?>">

    <script src="<?php echo base_url();?>public/assets/Adminto/libs/jquery/jquery.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            if($('#txt_paymentStatus').val() == 'UNPAID')
            {
                let baseUrl = $('#txt_baseUrl').val();
                setTimeout(function(){
                    window.location.replace(`${baseUrl}portal/representative/billing-and-payments`);
                }, 2000);
            }
        });
    </script>
</body>
</html>