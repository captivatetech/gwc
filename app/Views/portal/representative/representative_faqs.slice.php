@extends('template.layout')

@section('page_title',$pageTitle)



@section('custom_styles')

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

                                        @if(count($arrFaqs) > 0)

                                            <?php $num = 0; ?>

                                            @foreach($arrFaqs as $key => $value)

                                            <div class="accordion custom-accordion" id="accordion{{ $value['id'] }}">
                                                <div class="card mb-2">
                                                    <div class="card-header bg-light">
                                                        <h5 class="card-title m-0">
                                                            <a href="#" class="text-dark" data-bs-toggle="collapse" data-bs-target="#collapseOne{{ $value['id'] }}" aria-expanded="true" aria-controls="collapseOne{{ $value['id'] }}">
                                                                {{ $value['question'] }}
                                                            </a>
                                                        </h5>
                                                    </div>

                                                    
                                                    <?php if($num == 0){ ?>
                                                    <div id="collapseOne{{ $value['id'] }}" class="collapse show" data-bs-parent="#accordion{{ $value['id'] }}">
                                                        <div class="card-body">
                                                            <p>{{ $value['answer'] }}aaaa</p>
                                                        </div>
                                                    </div>
                                                    <?php }else{ ?>
                                                    <div id="collapseOne{{ $value['id'] }}" class="collapse" data-bs-parent="#accordion{{ $value['id'] }}">
                                                        <div class="card-body">
                                                            <p>{{ $value['answer'] }}ssss</p>
                                                        </div>
                                                    </div>
                                                    <?php } ?>

                                                    <?php $num++; ?>
                                                </div>
                                            </div>

                                            @endforeach
                                        @else

                                        <center>
                                            <h3>No FAQs Found!</h3>
                                        </center>

                                        @endif
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div> <!-- container-fluid -->

                </div> <!-- content -->

            </div>
            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->

@endsection



@section('custom_scripts')


<script type="text/javascript">
  $(document).ready(function(){
    //jQuery Events
    
    
  });
</script>

@endsection
