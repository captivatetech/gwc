<!-- Put your navbar here! -->

<!-- Navbar start -->


            <!-- Topbar Start -->
            <div class="navbar-custom">
                    <ul class="list-unstyled topnav-menu float-end mb-0">
    
                        <li class="dropdown d-inline-block d-lg-none">
                            <a class="nav-link dropdown-toggle arrow-none waves-effect waves-light" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                <i class="fe-search noti-icon"></i>
                            </a>
                            <div class="dropdown-menu dropdown-lg dropdown-menu-end p-0">
                                <form class="p-3">
                                    <input type="text" class="form-control" placeholder="Search ..." aria-label="Recipient's username">
                                </form>
                            </div>
                        </li>
                        
                        @if(isset($notif))
                        <li class="dropdown notification-list topbar-dropdown">
                            <a class="nav-link dropdown-toggle waves-effect waves-light" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                <i class="fe-bell noti-icon"></i>
                                <span class="badge bg-danger rounded-circle noti-icon-badge">
                                {{ $arrAccessRequestsCount }}</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end dropdown-lg">
    
                                <!-- item-->
                                <div class="dropdown-item noti-title">
                                    <h5 class="m-0">
                                        <span class="float-end">
                                            <a href="" class="text-dark">
                                                <small>Clear All</small>
                                            </a>
                                        </span>Notification
                                    </h5>
                                </div>
    
                                <div class="noti-scroll" data-simplebar>
    
                                    @foreach($arrAccessRequests as $value)
                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                        <div class="notify-icon bg-primary">
                                            <i class="mdi mdi-comment-account-outline"></i>
                                        </div>
                                        <p class="notify-details">{{ $value['company_name'] }} - ({{ $value['company_code'] }})
                                            <small class="text-muted">1 min ago</small>
                                        </p>
                                        <p class="text-muted mb-0 user-msg">
                                            <small>{{ $value['remarks'] }}</small>
                                        </p>
                                    </a>
                                    @endforeach
    
                                <!-- All-->
                                <a href="javascript:void(0);" class="dropdown-item text-center text-primary notify-item notify-all">
                                    View all
                                    <i class="fe-arrow-right"></i>
                                </a>
    
                            </div>
                        </li>
                        @endif
                    </ul>
    
                    <!-- LOGO -->
                    <div class="logo-box">
                        <a href="index.html" class="logo logo-light text-center">
                            <span class="logo-sm">
                                <img src="<?php echo base_url();?>public/assets/Adminto/images/gwc-icon.png" alt="" height="30">
                            </span>
                            <span class="logo-lg">
                                <img src="<?php echo base_url();?>public/assets/Adminto/images/primary.png" alt="" height="25">
                            </span>
                        </a>
                        <a href="index.html" class="logo logo-dark text-center">
                            <span class="logo-sm">
                                <img src="<?php echo base_url();?>public/assets/Adminto/images/gwc-icon.png" alt="" height="30">
                            </span>
                            <span class="logo-lg">
                                <img src="<?php echo base_url();?>public/assets/Adminto/images/primary.png" alt="" height="25">
                            </span>
                        </a>
                    </div>

                    <ul class="list-unstyled topnav-menu topnav-menu-left mb-0">
                        <li>
                            <button class="button-menu-mobile disable-btn waves-effect">
                                <i class="fe-menu"></i>
                            </button>
                        </li>
    
                        <li>
                            <h4 class="page-title-main" style="color:#fff; font-weight:500;">@yield('page_title')</h4>
                        </li>
            
                    </ul>

                    <div class="clearfix"></div> 
               
            </div>
            <!-- end Topbar -->

<!-- Navbar end -->

