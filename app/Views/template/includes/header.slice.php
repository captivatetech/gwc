

<!-- CSS Libraries here! -->


<!-- App css -->

<link href="<?php echo base_url();?>public/assets/Adminto/css/app.min.css" rel="stylesheet" type="text/css" id="app-style" />

<!-- icons -->
<link href="<?php echo base_url();?>public/assets/Adminto/css/icons.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>public/assets/Adminto/css/custom.css" rel="stylesheet" type="text/css"/>

<link href="<?php echo base_url();?>public/assets/Adminto/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />

<style type="text/css">
    /* Header fixed to the top of the modal */
    .modal-header--sticky {
      position: sticky;
      top: 0;
      background-color: inherit; /* [1] */
      z-index: 1055; /* [2] */
    }

    /* Footer fixed to the bottom of the modal */
    .modal-footer--sticky {
      position: sticky;
      bottom: 0;
      background-color: inherit; /* [1] */
      z-index: 1055; /* [2] */
    }
</style>

<!-- do not remove the code below -->
@yield('custom_styles')