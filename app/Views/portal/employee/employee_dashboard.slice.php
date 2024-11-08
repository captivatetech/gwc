@extends('template.layout')

@section('page_title',$pageTitle)



@section('custom_styles')

<!-- third party css -->
<link href="<?php echo base_url();?>public/assets/Adminto/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>public/assets/Adminto/libs/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>public/assets/Adminto/libs/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>public/assets/Adminto/libs/datatables.net-select-bs5/css//select.bootstrap5.min.css" rel="stylesheet" type="text/css" />
<!-- third party css end -->

<!--Plugin CSS file with desired skin-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.1/css/ion.rangeSlider.min.css"/>

<style type="text/css">
  /*INTERNAL STYLES*/
  
  .form-wizard-header{
    margin-left: 0rem;
    margin-right: 0rem;
  }
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
                                <h4 class="mt-0 header-title">Credit Limit</h4>
                                <br>
                                <div class="row">
                                    <div class="col-md-8">
                                        <input type="text" id="rng_creditLimitViewing">
                                    </div>
                                    <div class="col-md-4">
                                        <input type="hidden" id="txt_employeeId" value="{{ $employeeId }}">
                                        <input type="hidden" id="txt_companyId" value="{{ $companyId }}">
                                        <div style="float:right;">
                                            @if($loanStatus == 'PAID' || $loanStatus == "")
                                            <button type="button" class="btn gwc-button" id="btn_openLoanReadinessAssessmentModal">APPLY NOW</button>
                                            @else
                                                @if($loanStatus == 'PENDING')
                                                <button type="button" class="btn btn-danger" disabled>PENDING APPLICATION</button>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <hr>
                                <h4 class="mt-0 header-title">Salary Advance</h4>
                                <br>

                                <div class="row">
                                    <div class="col-md-4">
                                        <p>Due Payment </p>
                                        <h2>Php {{ $deductionPerCutoff }}</h2>
                                    </div>
                                    <div class="col-md-4">
                                        <p>To be deducted on: </p>
                                        <h3>------</h3>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-10">
                                        <p>Loan Account Number: </p>
                                        @if($loanAccountNumber != "")
                                        <h3>{{ $loanAccountNumber }}</h3>
                                        @else
                                        <h3>------</h3>
                                        @endif
                                    </div>
                                    <div class="col-md-2">
                                        <div style="float:right;">
                                            <button type="button" class="btn gwc-button" id="btn_viewDetails">VIEW DETAILS</button>
                                        </div>
                                    </div>
                                </div>

                                <hr>
                                <br>

                                <div class="row">
                                    <div class="col-md-4">
                                        <p>Loan Balance</p>
                                        <h2>Php {{ $loanBalance }}</h2>
                                    </div>
                                    <div class="col-md-4">
                                        <p>Maturity Date:</p>
                                        <h3>------</h>
                                    </div>
                                </div>
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

    <div class="modal fade" id="modal_preferedLangauge" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header modal-header--sticky">
                    <h5 class="modal-title"> 
                        <i class="feather-plus me-2"></i> Prefered Laguage
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <center>
                        <div class="pt-4 pb-4">
                            <button type="button" class="btn btn-lg gwc-button" id="btn_preferedLangaugeTagalog">TAGALOG</button>
                            <button type="button" class="btn btn-lg gwc-button" id="btn_preferedLangaugeEnglish">ENGLISH</button>
                        </div>
                    </center>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal_loanReadinessAssessment" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header modal-header--sticky">
                    <h5 class="modal-title"> 
                        <i class="feather-plus me-2"></i> Loan Readiness Assessment
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="form_loanReadinessAssessment">
                        
                        <div class="row" id="div_question1">
                            <div class="col-lg-4">
                                <h3>Gold Water Capital</h3>
                                <h5 class="text-muted">Budgeting</h5>
                            </div>
                            <div class="col-lg-8">
                                <h5>Part 1 of 7</h5>

                                <p id="lbl_question1">
                                    Kayo ba ay nakakagawa ng budget at ito ay nasusundan sa isang buwan?
                                </p>

                                <label class="mb-2">
                                    <input type="radio" name="rdb_answer1" value="A-5">
                                    <span id="lbl_answer1A-5">
                                        A. Yes, ito ay laging nasusundan
                                    </span>
                                </label>

                                <br>
                                <label class="mb-2">
                                    <input type="radio" name="rdb_answer1" value="B-3">
                                    <span id="lbl_answer1B-3">
                                        B. Yes, ito ay bihirang masundan
                                    </span>
                                </label>

                                <br>
                                <label class="mb-2">
                                    <input type="radio" name="rdb_answer1" value="C-0">
                                    <span id="lbl_answer1C-0">
                                        C. No, hindi ako gumagawa ng budget
                                    </span>
                                </label>
                            </div>
                        </div>

                        <div class="row" id="div_question2" hidden>
                            <div class="col-lg-4">
                                <h3>Gold Water Capital</h3>
                                <h5 class="text-muted">Savings</h5>

                                <p id="lbl_question2Example">Upang madaling maunawaan ang sagot sa tanong, naririto ang example. Kung ikaw ay sumasahod ng Php 20,000 sa isang buwan.</p>
                                <ul id="lbl_question2ExampleList">
                                    <li>50% - Php 10,000 savings</li>
                                    <li>30% - Php 6,000 savings</li>
                                    <li>10% - Php 2,000 savings</li>
                                </ul>
                            </div>
                            <div class="col-lg-8">
                                <h5>Part 2 of 7</h5>

                                <p id="lbl_question2">
                                    Ilang porsyento ng inyong sinasahod ang inyong naitatabi sa ipon kada buwan?
                                </p>

                                <label class="mb-2">
                                    <input type="radio" name="rdb_answer2" value="A-5">
                                    <span id="lbl_answer2A-5">
                                        A. Halos kalahati (50%) ng aking sahod ay aking naitatabi
                                    </span>
                                </label>

                                <br>
                                <label class="mb-2">
                                    <input type="radio" name="rdb_answer2" value="B-4">
                                    <span id="lbl_answer2B-4">
                                        B. Halos 30% ng aking sahod ang aking naitatabi
                                    </span>
                                </label>

                                <br>
                                <label class="mb-2">
                                    <input type="radio" name="rdb_answer2" value="C-1">
                                    <span id="lbl_answer2C-1">
                                        C. Halos 10% ng aking sahod ay aking naitatabi
                                    </span>
                                </label>

                                <br>
                                <label class="mb-2">
                                    <input type="radio" name="rdb_answer2" value="D-0">
                                    <span id="lbl_answer2D-0">
                                        D. Wala akong naitatabi sa aking sinasahod.
                                    </span>
                                </label>
                            </div>
                        </div>

                        <div class="row" id="div_question3" hidden>
                            <div class="col-lg-4">
                                <h3>Gold Water Capital</h3>
                                <h5 class="text-muted">Debt Payment</h5>
                            </div>
                            <div class="col-lg-8">
                                <h5>Part 3 of 7</h5>

                                <p id="lbl_question3">
                                    Ilang porsyento ng inyong sahod ang napupunta sa pagbabayad ng mga kinauutang at ng mga iba pang bayarin?
                                </p>

                                
                                <label class="mb-2">
                                    <input type="radio" name="rdb_answer3" value="A-1">
                                    <span id="lbl_answer3A-1">
                                        A. Higit kalahati (50%) ng aking sahod ang ipinambabayad sa pinagkakautangan at mga bayarin.
                                    </span>
                                </label>

                                <br>
                                <label class="mb-2">
                                    <input type="radio" name="rdb_answer3" value="B-3">
                                    <span id="lbl_answer3B-3">
                                        B. Halos 30% ng aking sahod angipinambabayad sa pinagkakautangan at mga bayarin.
                                    </span>
                                </label>

                                <br>
                                <label class="mb-2">
                                    <input type="radio" name="rdb_answer3" value="C-5">
                                    <span id="lbl_answer3C-5">
                                        C. Halos 10% ng aking sahod ang ipinambabayad sa pinagkakautangan at mga bayarin.
                                    </span>
                                </label>
                            </div>
                        </div>

                        <div class="row" id="div_question4" hidden>
                            <div class="col-lg-4">
                                <h3>Gold Water Capital</h3>
                                <h5 class="text-muted">Repayment Behaviour</h5>
                            </div>
                            <div class="col-lg-8">
                                <h5>Part 4 of 7</h5>

                                <p id="lbl_question4">
                                    Kung kayo ay kakapusin sa pambayad ng mga pagkaka-uutang at bayarin, alin sa mga sumusunod ang inyong gagawin?
                                </p>

                                
                                <label class="mb-2">
                                    <input type="radio" name="rdb_answer4" value="A-1">
                                    <span id="lbl_answer4A-1">
                                        A. Hindi muna babayaran ang bayarin sa nakatakdang araw at magbabayad na lang kapag nakaluwag-luwag na.
                                    </span>
                                </label>

                                <br>
                                <label class="mb-2">
                                    <input type="radio" name="rdb_answer4" value="B-3">
                                    <span id="lbl_answer4B-3">
                                        B. Kakausapin ang pinagkakautangan at makikipag-kasundo ng ibang araw upang mabayaran ang natitirang bahagi ng bayarin.
                                    </span>
                                </label>

                                <br>
                                <label class="mb-2">
                                    <input type="radio" name="rdb_answer4" value="C-3">
                                    <span id="lbl_answer4C-3">
                                        C. Ako ay maghahanap ng makakatulong o mahihiraman sa aking pamilya o mga kamag-anak upang hindi masira ang aking pangalan sa pinagkakautangan.
                                    </span>
                                </label>

                                <br>
                                <label class="mb-2">
                                    <input type="radio" name="rdb_answer4" value="D-5">
                                    <span id="lbl_answer4D-5">
                                        D. Gagamitin ang aking emergency fund o nakatabing ipon para sa mga emergency upang mabayaran ang bayarin.
                                    </span>
                                </label>
                            </div>
                        </div>

                        <div class="row" id="div_question5" hidden>
                            <div class="col-lg-4">
                                <h3>Gold Water Capital</h3>
                                <h5 class="text-muted">Credit Card Behavior</h5>
                            </div>
                            <div class="col-lg-8">
                                <h5>Part 5 of 7</h5>

                                <p id="lbl_question5">
                                    Kung kayo ay may credit card, ano ang inyong kasalukuyang kinagawian?
                                </p>

                                
                                <label class="mb-2">
                                    <input type="radio" name="rdb_answer5" value="A-1">
                                    <span id="lbl_answer5A-1">
                                        A. Binabayaran ko lang ang minimum amount sa billing.
                                    </span>
                                </label>

                                <br>
                                <label class="mb-2">
                                    <input type="radio" name="rdb_answer5" value="B-2">
                                    <span id="lbl_answer5B-2">
                                        B. Binabayaran ko ang minimum maging ang balanse kapag nakaluluwag-luwag.
                                    </span>
                                </label>

                                <br>
                                <label class="mb-2">
                                    <input type="radio" name="rdb_answer5" value="C-3">
                                    <span id="lbl_answer5C-3">
                                        C. Kung kaya, ako ay nagbabayad ng buo upang makaiwas sa interest charges.
                                    </span>
                                </label>

                                <br>
                                <label class="mb-2">
                                    <input type="radio" name="rdb_answer5" value="D-5">
                                    <span id="lbl_answer5D-5">
                                        D. Ako ay palaging nagbabayad ng buong balanse.
                                    </span>
                                </label>

                                <br>
                                <label class="mb-2">
                                    <input type="radio" name="rdb_answer5" value="E-0">
                                    <span id="lbl_answer5E-0">
                                        E. Ako ay kasalukuyang walang credit card.
                                    </span>
                                </label>
                            </div>
                        </div>

                        <div class="row" id="div_question6" hidden>
                            <div class="col-lg-4">
                                <h3>Gold Water Capital</h3>
                                <h5 class="text-muted">Sudden Spend Behavior</h5>
                            </div>
                            <div class="col-lg-8">
                                <h5>Part 6 of 7</h5>

                                <p id="lbl_question6">
                                    Kung ikaw ay may biglaang kailangan pagkagastusan, saan mo kukunin ang iyong panggastos?
                                </p>

                                
                                <label class="mb-2">
                                    <input type="radio" name="rdb_answer6" value="A-1">
                                    <span id="lbl_answer6A-1">
                                        A. Uutang sa aking pamilya at kaibigan
                                    </span>
                                </label>

                                <br>
                                <label class="mb-2">
                                    <input type="radio" name="rdb_answer6" value="B-1">
                                    <span id="lbl_answer6B-1">
                                        B. Uutang sa kumpanya
                                    </span>
                                </label>

                                <br>
                                <label class="mb-2">
                                    <input type="radio" name="rdb_answer6" value="C-3">
                                    <span id="lbl_answer6C-3">
                                        C. Gagamitin ang aking credit card kung maari
                                    </span>
                                </label>

                                <br>
                                <label class="mb-2">
                                    <input type="radio" name="rdb_answer6" value="D-5">
                                    <span id="lbl_answer6D-5">
                                        D. Gagamitin ang aking savings o naitabing pera
                                    </span>
                                </label>

                                <br>
                                <label class="mb-2">
                                    <input type="radio" name="rdb_answer6" value="E-0">
                                    <span id="lbl_answer6E-0">
                                        E. Hindi ko alam ang sagot sa tanong.
                                    </span>
                                </label>
                            </div>
                        </div>

                        <div class="row" id="div_question7" hidden>
                            <div class="col-lg-4">
                                <h3>Gold Water Capital</h3>
                                <h5 class="text-muted">View on Borrowing</h5>
                            </div>
                            <div class="col-lg-8">
                                <h5>Part 7 of 7</h5>

                                <p id="lbl_question7">
                                    Alin sa mga sumusunod ang iyong pananaw tungkol sa paghiram ng pera o pag-utang sa bangko?
                                </p>

                                
                                <label class="mb-2">
                                    <input type="radio" name="rdb_answer7" value="A-1">
                                    <span id="lbl_answer7A-1">
                                        A. Ako ay natatakot umutang dahil baka ito ay hindi ko mabayaran
                                    </span>
                                </label>

                                <br>
                                <label class="mb-2">
                                    <input type="radio" name="rdb_answer7" value="B-3">
                                    <span id="lbl_answer7B-3">
                                        B. Ako ay umiiwas umutang kung ito naman ay hindi kailangan
                                    </span>
                                </label>

                                <br>
                                <label class="mb-2">
                                    <input type="radio" name="rdb_answer7" value="C-5">
                                    <span id="lbl_answer7C-5">
                                        C. Naiintindihan ko na ang paghiram ng pera at paggamit nito sa produktibong pamamaraan ay maaring makatulong upang kumita pa
                                    </span>
                                </label>

                                <br>
                                <label class="mb-2">
                                    <input type="radio" name="rdb_answer7" value="D-0">
                                    <span id="lbl_answer7D-0">
                                        D. Wala akong pananaw tungkol sa paghiram ng pera.
                                    </span>
                                </label>
                            </div>
                        </div>

                        <div class="row" id="div_answersPreview" hidden>
                            <div class="col-lg-4">
                                <h3>Gold Water Capital</h3>
                                <h5 class="text-muted">Review Answers</h5>
                            </div>
                            <div class="col-lg-8">
                                <h5>Question & Answers</h5>

                                <h6 id="h6_question1">
                                    1) Kayo ba ay nakakagawa ng budget at ito ay nasusundan sa isang buwan?
                                </h6>
                                <label class="mb-2 text-muted" id="lbl_answer1"></label>

                                <h6 id="h6_question2">
                                    2) Ilang porsyento ng inyong sinasahod ang inyong naitatabi sa ipon kada buwan?
                                </h6>
                                <label class="mb-2 text-muted" id="lbl_answer2"></label>

                                <h6 id="h6_question3">
                                    3) Ilang porsyento ng inyong sahod ang napupunta sa pagbabayad ng mga kinauutang at ng mga iba pang bayarin?
                                </h6>
                                <label class="mb-2 text-muted" id="lbl_answer3"></label>

                                <h6 id="h6_question4">
                                    4) Kung kayo ay kakapusin sa pambayad ng mga pagkaka-uutang at bayarin, alin sa mga sumusunod ang inyong gagawin?
                                </h6>
                                <label class="mb-2 text-muted" id="lbl_answer4"></label>

                                <h6 id="h6_question5">
                                    5) Kung kayo ay may credit card, ano ang inyong kasalukuyang kinagawian?
                                </h6>
                                <label class="mb-2 text-muted" id="lbl_answer5"></label>

                                <h6 id="h6_question6">
                                    6) Kung ikaw ay may biglaang kailangan pagkagastusan, saan mo kukunin ang iyong panggastos?
                                </h6>
                                <label class="mb-2 text-muted" id="lbl_answer6"></label>

                                <h6 id="h6_question7">
                                    7) Alin sa mga sumusunod ang iyong pananaw tungkol sa paghiram ng pera o pag-utang sa bangko?
                                </h6>
                                <label class="mb-2 text-muted" id="lbl_answer7"></label>
                            </div>
                        </div>

                    </form>
                </div>
                <div class="modal-footer modal-footer--sticky">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>

                    <button type="button" class="btn gwc-button" id="btn_next1" disabled>Next</button>

                    <button type="button" class="btn gwc-button" id="btn_prev2" hidden>Prev</button>
                    <button type="button" class="btn gwc-button" id="btn_next2" hidden>Next</button>

                    <button type="button" class="btn gwc-button" id="btn_prev3" hidden>Prev</button>
                    <button type="button" class="btn gwc-button" id="btn_next3" hidden>Next</button>

                    <button type="button" class="btn gwc-button" id="btn_prev4" hidden>Prev</button>
                    <button type="button" class="btn gwc-button" id="btn_next4" hidden>Next</button>

                    <button type="button" class="btn gwc-button" id="btn_prev5" hidden>Prev</button>
                    <button type="button" class="btn gwc-button" id="btn_next5" hidden>Next</button>

                    <button type="button" class="btn gwc-button" id="btn_prev6" hidden>Prev</button>
                    <button type="button" class="btn gwc-button" id="btn_next6" hidden>Next</button>

                    <button type="button" class="btn gwc-button" id="btn_prev7" hidden>Prev</button>
                    <button type="button" class="btn gwc-button" id="btn_next7" hidden>Next</button>

                    <button type="button" class="btn gwc-button" id="btn_prev8" hidden>Prev</button>
                    <button type="submit" class="btn gwc-button" id="btn_submitLoanReadinessAssessment" form="form_loanReadinessAssessment" hidden>Submit</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal_salaryAdvanceApplication" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header modal-header--sticky">
                    <h5 class="modal-title"> 
                        <i class="feather-plus me-2"></i> Salary Advance Details
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="form_salaryAdvanceApplication">
                            
                        <label>Credit Limit</label>
                        <div>
                            <input type="range" class="form-range" id="rng_creditLimit">
                            <label style="float:left;" id="lbl_min">0</label>
                            <label style="float:right;" id="lbl_max">0</label>
                        </div>
                        

                        <br>
                        <div class="row">
                            <div class="col-lg-4"></div>
                            <div class="col-lg-4">
                                <center>
                                    <input type="number" class="form-control form-control-sm" id="txt_loanAmount" name="txt_loanAmount" step=".01" style="text-align:center;" required readonly>
                                    <label>Loan Amount</label>
                                </center>
                            </div>
                            <div class="col-lg-4"></div>
                        </div>

                        <hr>

                        <label>Payment Terms</label>
                        <table style="width: 100%;">
                            <tr>
                                <td width="50%">
                                    <input type="radio" name="rdb_paymentTerms" id="rdb_paymentTerms1" value="1 Month">
                                    <label for="rdb_paymentTerms1">1 Month</label>
                                </td>
                                <td width="50%">
                                    <input type="radio" name="rdb_paymentTerms" id="rdb_paymentTerms4" value="4 Months">
                                    <label for="rdb_paymentTerms4">4 Months</label>
                                </td>
                            </tr>
                            <tr>
                                <td width="50%">
                                    <input type="radio" name="rdb_paymentTerms" id="rdb_paymentTerms2" value="2 Months">
                                    <label for="rdb_paymentTerms2">2 Months</label>
                                </td>
                                <td width="50%">
                                    <input type="radio" name="rdb_paymentTerms" id="rdb_paymentTerms5" value="5 Months">
                                    <label for="rdb_paymentTerms5">5 Months</label>
                                </td>
                            </tr>
                            <tr>
                                <td width="50%">
                                    <input type="radio" name="rdb_paymentTerms" id="rdb_paymentTerms3" value="3 Months">
                                    <label for="rdb_paymentTerms3">3 Months</label>
                                </td>
                                <td width="50%">
                                    <input type="radio" name="rdb_paymentTerms" id="rdb_paymentTerms6" value="6 Months" checked>
                                    <label for="rdb_paymentTerms6">6 Months</label>
                                </td>
                            </tr>
                        </table>

                        <hr>

                        <div class="row">
                            <div class="col-lg-6"><label>Purpose of Loan</label></div>
                            <div class="col-lg-6">
                                <select class="form-control form-select" id="slc_purposeOfLoan" name="slc_purposeOfLoan" required>
                                    <option value="">---</option>
                                    <option value="Unexpected-Medical-Expenses">Unexpected Medical Expenses</option>
                                    <option value="Emergency-Funds">Emergency Funds</option>
                                    <option value="Tuition-and-Educational-Fees">Tuition and Educational Fees</option>
                                    <option value="Debt-Repayment">Debt Repayment</option>
                                    <option value="Household-Repairs-and-Maintenance">Household Repairs and Maintenance</option>
                                    <option value="Utility-Bills">Utility Bills</option>
                                    <option value="Car-Repair-and-Maintenance">Car Repair and Maintenance</option>
                                    <option value="Rent-or-Mortgage-Payments">Rent or Mortgage Payments</option>
                                    <option value="Groceries-and-Daily-Necessities">Groceries and Daily Necessities</option>
                                    <option value="Starting-a-Small-Business-or-Side-Hustle">Starting a Small Business or Side Hustle</option>
                                </select>
                            </div>
                        </div>

                        <br>

                        <h4>Loan Summary</h4>
                        <table style="width: 100%;">
                            <tr>
                                <td width="70%">
                                    <label>Loan Amount</label>
                                </td>
                                <td style="text-align: right;">
                                    <label id="lbl_loanAmount">0.00</label>
                                </td>
                            </tr>
                            <tr>
                                <td width="70%">
                                    <label>Processing Fee</label>
                                </td>
                                <td style="text-align: right;">
                                    <label id="lbl_processingFee">0.00</label>
                                </td>
                            </tr>
                            <tr>
                                <td width="70%">
                                    <h5 class="text-muted">Amount to Receive</h5>
                                </td>
                                <td style="text-align: right;">
                                    <h5 class="text-muted" id="lbl_amountToReceive">0.00</h5>
                                </td>
                            </tr>
                        </table>

                        <hr>

                        <table style="width: 100%;">
                            <tr>
                                <td width="70%">
                                    <label>Total Interest</label>
                                </td>
                                <td style="text-align: right;">
                                    <label id="lbl_totalInterest">0.00 %</label>
                                </td>
                            </tr>
                            <tr>
                                <td width="70%">
                                    <label>Payment Terms</label>
                                </td>
                                <td style="text-align: right;">
                                    <label id="lbl_paymentTerms">---</label>
                                </td>
                            </tr>
                            <tr>
                                <td width="70%">
                                    <label>Number of Deductions</label>
                                </td>
                                <td style="text-align: right;">
                                    <label id="lbl_numberOfDeductions">0</label>
                                </td>
                            </tr>
                            <tr>
                                <td width="70%">
                                    <label>Monthly Dues</label>
                                </td>
                                <td style="text-align: right;">
                                    <label id="lbl_monthlyDues">0.00</label>
                                </td>
                            </tr>
                            <tr>
                                <td width="70%">
                                    <h5 class="text-muted">Deduction Per Cut-off</h5>
                                </td>
                                <td style="text-align: right;">
                                    <h5 class="text-muted" id="lbl_deductionPerCutOff">0.00</h5>
                                </td>
                            </tr>
                        </table>

                        <hr>

                        <!-- <iframe style="width: 100%;" src="https://www.youtube.com/embed/a3ICNMQW7Ok" title="Wildlife Windows 7 Sample Video" allowfullscreen></iframe> -->

                    </form>
                </div>
                <div class="modal-footer modal-footer--sticky">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn gwc-button" id="btn_submitSalaryAdvanceApplication" form="form_salaryAdvanceApplication">Proceed</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal_viewDashboardDetails" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header modal-header--sticky">
                    <h5 class="modal-title"> 
                        <i class="feather-plus me-2"></i> View Detials
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <td><small>ACCOUNT NAME</small></td>
                                        <td width="50%;">
                                            <small>
                                                <span id="lbl_accountName"></span>
                                            </small>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><small>ACCOUNT NUMBER</small></td>
                                        <td>
                                            <small>
                                                <span id="lbl_accountNumber" style="font-weight: bold;"></span>
                                            </small>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><small>INTEREST RATE</small></td>
                                        <td>
                                            <small>
                                                <span id="lbl_interestRate" style="font-weight: bold;"></span>
                                            </small>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <br>
                                            <center><b><small>PROMISORY NOTE VALUE</small></b></center>
                                            <br>
                                        </td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-lg-6">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <td width="40%;"></td>
                                        <td width="40%;"><small>CI & APP FEE</small></td>
                                        <td width="20%;"><center><b><small>WAIVED</small></b></center></td>
                                    </tr>
                                    <tr>
                                        <td rowspan="2">
                                            <small>MA START DATE</small>
                                            <br>
                                            <small>
                                                <span id="lbl_maStartDate" style="font-weight: bold;"></span>
                                            </small>
                                        </td>
                                        <td><small>DST</small></td>
                                        <td><small></small></td>
                                    </tr>
                                    <tr>
                                        <td><small>INSURANCE</small></td>
                                        <td><small></small></td>
                                    </tr>
                                    <tr>
                                        <td rowspan="2">
                                            <small>MA END DATE</small>
                                            <br>
                                            <small>
                                                <span id="lbl_maEndDate" style="font-weight: bold;"></span>
                                            </small>
                                        </td>
                                        <td><small>NOTARIAL FEES</small></td>
                                        <td><small></small></td>
                                    </tr>
                                    <tr>
                                        <td><small>OTHER ADMIN FEES</small></td>
                                        <td><small></small></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th width="35%"><center><small>PAYMENT DATE</small></center></th>
                                        <th width="35%"><center><small>AMOUNT TO PAY</small></center></th>
                                        <th width="30%"><center><small>BALANCE</small></center></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-lg-6">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th width="35%"><center><small>MONTH</small></center></th>
                                        <th width="35%"><center><small>MONTHLY AMORTIZATION</small></center></th>
                                        <th width="30%"><center><small>BALANCE</small></center></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
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

@endsection



@section('custom_scripts')


<!--Plugin JavaScript file-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.1/js/ion.rangeSlider.min.js"></script>

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
<script type="text/javascript" src="<?php echo base_url(); ?>public/assets/js/custom/employee/{{ $customScripts }}.js"></script>

<script type="text/javascript">
  $(document).ready(function(){
    //jQuery Events
    
    EMPLOYEE_DASHBOARD.e_loadCreditLimit();

    $('#btn_openLoanReadinessAssessmentModal').on('click',function(){
        EMPLOYEE_DASHBOARD.e_loadPreferedLangauge();
    });

    $('#btn_preferedLangaugeTagalog').on('click',function(){
        EMPLOYEE_DASHBOARD.e_choosePreferedLangauge("tagalog");
    });

    $('#btn_preferedLangaugeEnglish').on('click',function(){
        EMPLOYEE_DASHBOARD.e_choosePreferedLangauge("english");
    });

    /* ======= QUESTION #1 ==========*/

    $('input[name=rdb_answer1]').on('change',function(){
        if($(this).val() != undefined)
        {
            $('#btn_next1').prop('disabled',false);
        }
        else
        {
            alert('Choose your answer!');
        }
    });

    $('#btn_next1').on('click',function(){
        if($('input[name=rdb_answer1]:checked').val() != undefined)
        {
            $('#div_question1').prop('hidden',true);
            $('#div_question2').prop('hidden',false);

            $('#btn_next1').prop('hidden',true);

            $('#btn_prev2').prop('hidden',false);
            $('#btn_next2').prop('hidden',false);
            $('#btn_next2').prop('disabled',($('input[name=rdb_answer2]:checked').val() == undefined)? true : false);
        }
        else
        {
            alert('Choose your answer!');
        }
    });

    /* ======= QUESTION #2 ==========*/

    $('input[name=rdb_answer2]').on('change',function(){
        if($(this).val() != undefined)
        {
            $('#btn_next2').prop('disabled',false);
        }
        else
        {
            alert('Choose your answer!');
        }
    });

    $('#btn_prev2').on('click',function(){
        $('#div_question1').prop('hidden',false);
        $('#div_question2').prop('hidden',true);

        $('#btn_next1').prop('hidden',false);

        $('#btn_prev2').prop('hidden',true);
        $('#btn_next2').prop('hidden',true);
    });

    $('#btn_next2').on('click',function(){
        if($('input[name=rdb_answer2]:checked').val() != undefined)
        {
            $('#div_question2').prop('hidden',true);
            $('#div_question3').prop('hidden',false);

            $('#btn_prev2').prop('hidden',true);
            $('#btn_next2').prop('hidden',true);

            $('#btn_prev3').prop('hidden',false);
            $('#btn_next3').prop('hidden',false);
            $('#btn_next3').prop('disabled',($('input[name=rdb_answer3]:checked').val() == undefined)? true : false);
        }
        else
        {
            alert('Choose your answer!');
        }
    });

    /* ======= QUESTION #3 ==========*/

    $('input[name=rdb_answer3]').on('change',function(){
        if($(this).val() != undefined)
        {
            $('#btn_next3').prop('disabled',false);
        }
        else
        {
            alert('Choose your answer!');
        }
    });

    $('#btn_prev3').on('click',function(){
        $('#div_question2').prop('hidden',false);
        $('#div_question3').prop('hidden',true);

        $('#btn_prev2').prop('hidden',false);
        $('#btn_next2').prop('hidden',false);

        $('#btn_prev3').prop('hidden',true);
        $('#btn_next3').prop('hidden',true);
    });

    $('#btn_next3').on('click',function(){
        if($('input[name=rdb_answer3]:checked').val() != undefined)
        {
            $('#div_question3').prop('hidden',true);
            $('#div_question4').prop('hidden',false);

            $('#btn_prev3').prop('hidden',true);
            $('#btn_next3').prop('hidden',true);

            $('#btn_prev4').prop('hidden',false);
            $('#btn_next4').prop('hidden',false);
            $('#btn_next4').prop('disabled',($('input[name=rdb_answer4]:checked').val() == undefined)? true : false);
        }
        else
        {
            alert('Choose your answer!');
        }
    });

    /* ======= QUESTION #4 ==========*/

    $('input[name=rdb_answer4]').on('change',function(){
        if($(this).val() != undefined)
        {
            $('#btn_next4').prop('disabled',false);
        }
        else
        {
            alert('Choose your answer!');
        }
    });

    $('#btn_prev4').on('click',function(){
        $('#div_question3').prop('hidden',false);
        $('#div_question4').prop('hidden',true);

        $('#btn_prev3').prop('hidden',false);
        $('#btn_next3').prop('hidden',false);

        $('#btn_prev4').prop('hidden',true);
        $('#btn_next4').prop('hidden',true);
    });

    $('#btn_next4').on('click',function(){
        if($('input[name=rdb_answer4]:checked').val() != undefined)
        {
            $('#div_question4').prop('hidden',true);
            $('#div_question5').prop('hidden',false);

            $('#btn_prev4').prop('hidden',true);
            $('#btn_next4').prop('hidden',true);

            $('#btn_prev5').prop('hidden',false);
            $('#btn_next5').prop('hidden',false);
            $('#btn_next5').prop('disabled',($('input[name=rdb_answer5]:checked').val() == undefined)? true : false);
        }
        else
        {
            alert('Choose your answer!');
        }
    });

    /* ======= QUESTION #5 ==========*/

    $('input[name=rdb_answer5]').on('change',function(){
        if($(this).val() != undefined)
        {
            $('#btn_next5').prop('disabled',false);
        }
        else
        {
            alert('Choose your answer!');
        }
    });

    $('#btn_prev5').on('click',function(){
        $('#div_question4').prop('hidden',false);
        $('#div_question5').prop('hidden',true);

        $('#btn_prev4').prop('hidden',false);
        $('#btn_next4').prop('hidden',false);

        $('#btn_prev5').prop('hidden',true);
        $('#btn_next5').prop('hidden',true);
    });

    $('#btn_next5').on('click',function(){
        if($('input[name=rdb_answer5]:checked').val() != undefined)
        {
            $('#div_question5').prop('hidden',true);
            $('#div_question6').prop('hidden',false);

            $('#btn_prev5').prop('hidden',true);
            $('#btn_next5').prop('hidden',true);

            $('#btn_prev6').prop('hidden',false);
            $('#btn_next6').prop('hidden',false);
            $('#btn_next6').prop('disabled',($('input[name=rdb_answer6]:checked').val() == undefined)? true : false);
        }
        else
        {
            alert('Choose your answer!');
        }
    });

    /* ======= QUESTION #6 ==========*/

    $('input[name=rdb_answer6]').on('change',function(){
        if($(this).val() != undefined)
        {
            $('#btn_next6').prop('disabled',false);
        }
        else
        {
            alert('Choose your answer!');
        }
    });

    $('#btn_prev6').on('click',function(){
        $('#div_question5').prop('hidden',false);
        $('#div_question6').prop('hidden',true);

        $('#btn_prev5').prop('hidden',false);
        $('#btn_next5').prop('hidden',false);

        $('#btn_prev6').prop('hidden',true);
        $('#btn_next6').prop('hidden',true);
    });

    $('#btn_next6').on('click',function(){
        if($('input[name=rdb_answer6]:checked').val() != undefined)
        {
            $('#div_question6').prop('hidden',true);
            $('#div_question7').prop('hidden',false);

            $('#btn_prev6').prop('hidden',true);
            $('#btn_next6').prop('hidden',true);

            $('#btn_prev7').prop('hidden',false);
            $('#btn_next7').prop('hidden',false);
            $('#btn_next7').prop('disabled',($('input[name=rdb_answer7]:checked').val() == undefined)? true : false);
        }
        else
        {
            alert('Choose your answer!');
        }
    });

    /* ======= QUESTION #7 ==========*/

    $('input[name=rdb_answer7]').on('change',function(){
        if($(this).val() != undefined)
        {
            $('#btn_next7').prop('disabled',false);
        }
        else
        {
            alert('Choose your answer!');
        }
    });

    $('#btn_prev7').on('click',function(){
        $('#div_question6').prop('hidden',false);
        $('#div_question7').prop('hidden',true);

        $('#btn_prev6').prop('hidden',false);
        $('#btn_next6').prop('hidden',false);

        $('#btn_prev7').prop('hidden',true);
        $('#btn_next7').prop('hidden',true);
    });

    $('#btn_next7').on('click',function(){
        if($('input[name=rdb_answer7]:checked').val() != undefined)
        {
            $('#div_question7').prop('hidden',true);
            $('#div_answersPreview').prop('hidden',false);

            $('#btn_prev7').prop('hidden',true);
            $('#btn_next7').prop('hidden',true);

            let answer1 = $('input[name=rdb_answer1]:checked').val();
            $('#lbl_answer1').html($(`#lbl_answer1${answer1}`).text());

            let answer2 = $('input[name=rdb_answer2]:checked').val();
            $('#lbl_answer2').html($(`#lbl_answer2${answer2}`).text());

            let answer3 = $('input[name=rdb_answer3]:checked').val();
            $('#lbl_answer3').html($(`#lbl_answer3${answer3}`).text());

            let answer4 = $('input[name=rdb_answer4]:checked').val();
            $('#lbl_answer4').html($(`#lbl_answer4${answer4}`).text());

            let answer5 = $('input[name=rdb_answer5]:checked').val();
            $('#lbl_answer5').html($(`#lbl_answer5${answer5}`).text());

            let answer6 = $('input[name=rdb_answer6]:checked').val();
            $('#lbl_answer6').html($(`#lbl_answer6${answer6}`).text());

            let answer7 = $('input[name=rdb_answer7]:checked').val();
            $('#lbl_answer7').html($(`#lbl_answer7${answer7}`).text());

            $('#btn_prev8').prop('hidden',false);
            $('#btn_submitLoanReadinessAssessment').prop('hidden',false);
        }
        else
        {
            alert('Choose your answer!');
        }
    });

    /* ======= REVIEW ANSWERS ==========*/

    $('#btn_prev8').on('click',function(){
        $('#div_question7').prop('hidden',false);
        $('#div_answersPreview').prop('hidden',true);

        $('#btn_prev7').prop('hidden',false);
        $('#btn_next7').prop('hidden',false);

        $('#btn_prev8').prop('hidden',true);
        $('#btn_submitLoanReadinessAssessment').prop('hidden',true);
    });

    /* ======= SUBMIT LRA ========== */

    $('#form_loanReadinessAssessment').on('submit',function(e){
        e.preventDefault();
        EMPLOYEE_DASHBOARD.e_submitLoanReadinessAssessment();
    });

    $('input[name=rdb_paymentTerms]').on('change',function(){
        EMPLOYEE_DASHBOARD.e_computeSalaryAdvanceInterests();
    });

    $('#form_salaryAdvanceApplication').on('submit',function(e){
        e.preventDefault();
        if($('input[name=rdb_paymentTerms]:checked').val() != undefined && $('#slc_purposeOfLoan').val() != "")
        {
            EMPLOYEE_DASHBOARD.e_submitSalaryAdvanceApplication(this);
        }
        else
        {
            alert('Fill-out required fields!');
        }
    });

    $('#btn_viewDetails').on('click',function(){
        EMPLOYEE_DASHBOARD.e_viewDashboardDetails();
    });
    
  });
</script>

@endsection
