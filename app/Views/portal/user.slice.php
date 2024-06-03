@extends('template.layout')

@section('page_title',$pageTitle)



@section('custom_styles')

<style type="text/css">
  /*INTERNAL STYLES*/
  
  
</style>

@endsection



@section('page_content')

<!-- Note: all html codes must be placed inside this page_content section -->
<!-- Page content start -->
    <div class="content">
        <h1>Content</h1>
    </div>

    <input type="text" id="txt_baseUrl" value="<?php echo base_url(); ?>">
<!-- Page content end -->

@endsection



@section('custom_scripts')

<!-- Ajax Helpers Scripts -->
<script type="text/javascript" src="<?php echo base_url(); ?>public/assets/js/helper/ajax_helper.js"></script>
<!-- Custom Scripts -->
<script type="text/javascript" src="<?php echo base_url(); ?>public/assets/js/custom/{{ $customScripts }}.js"></script>

<script type="text/javascript">
  $(document).ready(function(){
    //jQuery Events
    
    
  });
</script>

@endsection
