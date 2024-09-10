<!-- Put your sidebar here! -->

<!-- Sidebar Start -->

    <!-- ========== Left Sidebar Start ========== -->
    <div class="left-side-menu">

        <div class="h-100" data-simplebar>

                <!-- User box -->
            <div class="user-box text-center">

                @if($profilePicture == "")
                <img src="<?php echo base_url();?>public/assets/Adminto/images/user-icon-placeholder.jpg" alt="user-img" title="Mat Helme" class="rounded-circle img-thumbnail avatar-md">
                @else
                <img src="<?php echo base_url();?>public/assets/uploads/representative/profiles/{{ $profilePicture }}" alt="user-img" title="Mat Helme" class="rounded-circle img-thumbnail avatar-md">
                @endif
                <div class="dropdown">
                    <a href="#" class="user-name dropdown-toggle h5 mt-2 mb-1 d-block" data-bs-toggle="dropdown"  aria-expanded="false">{{ $userName }}</a>
                    <div class="dropdown-menu user-pro-dropdown">

                        @if($userType == 'employee')
                        <!-- item-->
                        <a href="<?php echo base_url('portal/employee/profile'); ?>" class="dropdown-item notify-item">
                            <i class="fe-user me-1"></i>
                            <span>My Account</span>
                        </a>

                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                            <i class="fe-settings me-1"></i>
                            <span>Settings</span>
                        </a>
                        @elseif($userType == 'representative')
                        <!-- item-->
                        <a href="<?php echo base_url('portal/representative/profile'); ?>" class="dropdown-item notify-item">
                            <i class="fe-user me-1"></i>
                            <span>My Account</span>
                        </a>

                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                            <i class="fe-settings me-1"></i>
                            <span>Settings</span>
                        </a>
                        @elseif($userType == 'admin')
                        <!-- item-->
                        <a href="<?php echo base_url('portal/admin/profile'); ?>" class="dropdown-item notify-item">
                            <i class="fe-user me-1"></i>
                            <span>My Account</span>
                        </a>

                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                            <i class="fe-settings me-1"></i>
                            <span>Settings</span>
                        </a>
                        @endif

                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                            <i class="fe-lock me-1"></i>
                            <span>Lock Screen</span>
                        </a>

                        <!-- item-->
                        <a href="<?php echo base_url(); ?>/" class="dropdown-item notify-item">
                            <i class="fe-log-out me-1"></i>
                            <span>Logout</span>
                        </a>

                    </div>
                </div>

                <p class="text-muted left-user-info">
                    @if($userType == 'admin')
                    <span>GWC - {{ $userRoleName }}</span>
                    @elseif($userType == 'representative')
                    <span>Company Representative</span>
                    @elseif($userType == 'employee')
                    <span>Employee / Borrower</span>
                    @endif
                </p>

            </div>

            <!--- Sidemenu -->
            <div id="sidebar-menu">

                <ul id="side-menu">

                    <li class="menu-title">Navigation</li>
        
                    @if($userType == 'employee')
                        <li>
                            <a href="<?php echo base_url('portal/employee/dashboard');?>">
                                <i class="mdi mdi-view-dashboard-outline"></i>
                                <span> Dashboard </span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('portal/employee/loan-accounts');?>">
                                <i class="mdi mdi-view-dashboard-outline"></i>
                                <span> Loan Accounts </span>
                            </a>
                        </li>
                    @elseif($userType == 'representative')
                        <li>
                            <a href="<?php echo base_url('portal/representative/dashboard');?>">
                                <i class="mdi mdi-view-dashboard-outline"></i>
                                <span> Dashboard </span>
                            </a>
                        </li>

                        <li>
                            <a href="<?php echo base_url('portal/representative/company-profile');?>">
                                <i class="fe-user"></i>
                                <span> Company Profile </span>
                            </a>
                        </li>

                        <li>
                            <a href="<?php echo base_url('portal/representative/financing-products');?>">
                                <i class="fe-box"></i>
                                <span> Financing Products </span>
                            </a>
                        </li>

                        <li>
                            <a href="<?php echo base_url('portal/representative/employee-list');?>">
                                <i class="fe-users"></i>
                                <span> Employee List </span>
                            </a>
                        </li>

                        <li>
                            <a href="<?php echo base_url('portal/representative/salary-advance-applications');?>">
                                <i class="fe-edit"></i>
                                <span> Applications </span>
                            </a>
                        </li>

                        <li>
                            <a href="<?php echo base_url('portal/representative/billing-and-payments');?>">
                                <i class="fe-dollar-sign"></i>
                                <span> Billing & Payments </span>
                            </a>
                        </li>

                        <li>
                            <a href="<?php echo base_url('portal/representative/faqs');?>">
                                <i class="fe-info"></i>
                                <span> FAQs </span>
                            </a>
                        </li>
                    @elseif($userType == 'admin')
                        @if($accessModules[0][0][0] == 1)
                        <li>
                            <a href="<?php echo base_url('portal/admin/dashboard');?>">
                                <i class="mdi mdi-view-dashboard-outline"></i>
                                <span> Dashboard </span>
                            </a>
                        </li>
                        @endif
                        @if($accessModules[1][0][0] == 1)
                        <li>
                            <a href="<?php echo base_url('portal/admin/applications');?>">
                                <i class="fe-edit"></i>
                                <span> Applications </span>
                            </a>
                        </li>
                        @endif
                        @if($accessModules[2][0][0] == 1)
                        <li>
                            <a href="<?php echo base_url('portal/admin/partners-list');?>">
                                <i class="fe-users"></i>
                                <span> Partners List </span>
                            </a>
                        </li>
                        @endif
                        @if($accessModules[3][0][0] == 1 || $accessModules[4][0][0] == 1 || $accessModules[5][0][0] == 1)
                        <li>
                            <a href="#div_financingProducts" data-bs-toggle="collapse" class="" aria-expanded="true">
                                <i class="fe-box"></i>
                                <span> Product Subscriptions </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="div_financingProducts" style="">
                                <ul class="nav-second-level">
                                    @if($accessModules[3][0][0] == 1)
                                    <li>
                                        <a href="<?php echo base_url('portal/admin/salary-advance-applications');?>">Salary Advance</a>
                                    </li>
                                    @endif
                                    @if($accessModules[4][0][0] == 1)
                                    <li>
                                        <a href="<?php echo base_url('portal/admin/business-expansion-applications');?>">Business Expansion</a>
                                    </li>
                                    @endif
                                    @if($accessModules[5][0][0] == 1)
                                    <li>
                                        <a href="<?php echo base_url('portal/admin/payment-now-applications');?>">Payment Now</a>
                                    </li>
                                    @endif
                                </ul>
                            </div>
                        </li>
                        @endif
                        @if($accessModules[6][0][0] == 1 || $accessModules[7][0][0] == 1 || $accessModules[8][0][0] == 1)
                        <li>
                            <a href="#div_financingAccounts" data-bs-toggle="collapse" class="" aria-expanded="true">
                                <i class="fe-box"></i>
                                <span> Financing Accounts </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="div_financingAccounts" style="">
                                <ul class="nav-second-level">
                                    @if($accessModules[6][0][0] == 1)
                                    <li>
                                        <a href="<?php echo base_url('portal/admin/salary-advance-accounts');?>">Salary Advance</a>
                                    </li>
                                    @endif
                                    @if($accessModules[7][0][0] == 1)
                                    <li>
                                        <a href="<?php echo base_url('portal/admin/business-expansion-accounts');?>">Business Expansion</a>
                                    </li>
                                    @endif
                                    @if($accessModules[8][0][0] == 1)
                                    <li>
                                        <a href="<?php echo base_url('portal/admin/payment-now-accounts');?>">Payment Now</a>
                                    </li>
                                    @endif
                                </ul>
                            </div>
                        </li>
                        @endif
                        @if($accessModules[9][0][0] == 1)
                        <li>
                            <a href="<?php echo base_url('portal/admin/billings');?>">
                                <i class="fas fa-money-check"></i>
                                <span> Billings </span>
                            </a>
                        </li>
                        @endif
                        @if($accessModules[10][0][0] == 1)
                        <li>
                            <a href="<?php echo base_url('portal/admin/payments');?>">
                                <i class="far fa-money-bill-alt"></i>
                                <span> Payments </span>
                            </a>
                        </li>
                        @endif
                        @if($accessModules[11][0][0] == 1 || $accessModules[12][0][0] == 1 || $accessModules[13][0][0] == 1 || $accessModules[14][0][0] == 1)
                        <li>
                            <a href="#div_maintenance" data-bs-toggle="collapse" class="" aria-expanded="true">
                                <i class="fas fa-cog"></i>
                                <span> Maintenance </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="div_maintenance" style="">
                                <ul class="nav-second-level">
                                    @if($accessModules[11][0][0] == 1)
                                    <li>
                                        <a href="<?php echo base_url('portal/admin/maintenance-users');?>">Users</a>
                                    </li>
                                    @endif
                                    @if($accessModules[12][0][0] == 1)
                                    <li>
                                        <a href="<?php echo base_url('portal/admin/maintenance-roles');?>">Roles</a>
                                    </li>
                                    @endif
                                    @if($accessModules[13][0][0] == 1)
                                    <li>
                                        <a href="<?php echo base_url('portal/admin/maintenance-fees');?>">Fees</a>
                                    </li>
                                    @endif
                                    @if($accessModules[14][0][0] == 1)
                                    <li>
                                        <a href="<?php echo base_url('portal/admin/maintenance-faqs');?>">FAQs</a>
                                    </li>
                                    @endif
                                </ul>
                            </div>
                        </li>
                        @endif
                        @if($accessModules[15][0][0] == 1)
                        <li>
                            <a href="<?php echo base_url('portal/admin/reports');?>">
                                <i class="fas fa-file-invoice-dollar"></i>
                                <span> Reports </span>
                            </a>
                        </li>
                        @endif
                        @if($accessModules[16][0][0] == 1)
                        <li>
                            <a href="<?php echo base_url('portal/admin/audit-trail');?>">
                                <i class="fas fa-history"></i>
                                <span> Audit Trail </span>
                            </a>
                        </li>
                        @endif
                    @endif
                </ul>

            </div>
            <!-- End Sidebar -->

            <div class="clearfix"></div>

        </div>
        <!-- Sidebar -left -->

    </div>
    <!-- Left Sidebar End -->

<!-- Sidebar End -->