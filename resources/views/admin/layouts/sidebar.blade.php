<body>
    <div id="app">


<div id="sidebar" class="active">


    <div class="sidebar-wrapper active">

            <div class=" d-flex justify-content-center m-4 " >
                    <a href="{{ route('admin.dashboard') }}"><img height="50vh" src="{{ asset('assets/admin/images/logo/logo.png') }}" alt="Logo" srcset=""></a>
            </div>

                <div class="theme-toggle d-flex gap-2  align-items-center mt-2">
                    <div class="form-check form-switch fs-6">
                        <input class="form-check-input  me-0" type="checkbox" id="toggle-dark" checked hidden >
                        <label class="form-check-label" ></label>
                    </div>
                </div>

                <div class="sidebar-toggler  x">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                </div>


        <div class="sidebar-menu">
            <ul class="menu">


                <li
                    class="sidebar-item {{ Route::is('admin.dashboard') ? 'active' : '' }}">
                    <a href="{{ route('admin.dashboard') }}" class="sidebar-link">
                        <i class="fas fa-home"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li
                    class="sidebar-item {{ Route::is('admin.referral') ? 'active' : '' }} ">
                    <a href="{{ route('admin.referral') }}" class="sidebar-link">
                        <i class="far fa-handshake"></i>
                        <span>Referral Levels</span>
                    </a>
                </li>

                <li
                    class="sidebar-item {{ Route::is('admin.plan') ? 'active' : '' }} ">
                    <a href="{{ route('admin.plan') }}" class="sidebar-link">
                        <i class="far fa-lightbulb"></i>
                        <span>Manage Plan</span>
                    </a>
                </li>

                <li
                    class="sidebar-item {{ Route::is('admin.rewards') ? 'active' : '' }} ">
                    <a href="{{ route('admin.rewards') }}" class="sidebar-link">
                        <i class="fas fa-gifts"></i>
                        <span>Manage Rewards</span>
                    </a>
                </li>

                <li class="sidebar-title">MANAGE USERS</li>

                <li
                    class="sidebar-item has-sub">
                    <a href="" class='sidebar-link'>
                        <i class="fas fa-users-cog"></i>
                        <span>Users Management</span>
                    </a>
                    <ul class="submenu ">
                        <li class="submenu-item {{ Route::is('admin.allusers') ? 'active' : '' }} ">
                            <a href="{{ route('admin.allusers') }}">All Users</a>
                        </li>
                        <li class="submenu-item {{ Route::is('admin.activeusers') ? 'active' : '' }} ">
                            <a href="{{ route('admin.activeusers') }}">Active Users</a>
                        </li>
                        <li class="submenu-item {{ Route::is('admin.pendingusers') ? 'active' : '' }}">
                            <a href="{{ route('admin.pendingusers') }}">Pending Users</a>
                        </li>
                        <li class="submenu-item {{ Route::is('admin.blockedusers') ? 'active' : '' }}">
                            <a href="{{ route('admin.blockedusers') }}">Block Users</a>
                        </li>
                        <li class="submenu-item {{ Route::is('admin.emailunverified') ? 'active' : '' }}">
                            <a href="{{ route('admin.emailunverified') }}">Email Unverified</a>
                        </li>
                        <li class="submenu-item {{ Route::is('admin.smsunverified') ? 'active' : '' }}">
                            <a href="{{ route('admin.smsunverified') }}">Sms Unverified</a>
                        </li>
                    </ul>
                </li>

                <li
                    class="sidebar-item  has-sub">
                    <a href="#" class='sidebar-link'>
                        <i class="fas fa-book"></i>
                        <span>Subscribers</span>
                    </a>
                    <ul class="submenu ">
                        <li class="submenu-item {{ Route::is('admin.subscribers') ? 'active' : '' }}">
                            <a href="{{ route('admin.subscribers') }}">Subscribers</a>
                        </li>
                        <li class="submenu-item {{ Route::is('admin.subscribers.mail') ? 'active' : '' }}">
                            <a href="{{ route('admin.subscribers.mail') }}">Mail to Subscribers</a>
                        </li>
                    </ul>
                </li>

                <li
                    class="sidebar-item  has-sub">
                    <a href="#" class='sidebar-link'>
                        <i class="fas fa-book-open"></i>
                        <span>Deposit Methods</span>
                    </a>
                    <ul class="submenu ">
                        <li class="submenu-item {{ Route::is('admin.deposit.gateway.index') ? 'active' : '' }}">
                            <a href="{{ route('admin.deposit.gateway.index') }}">Autometic Methods</a>
                        </li>
                        <li class="submenu-item {{ Route::is('admin.deposit.manual.index') ? 'active' : '' }}">
                            <a href="{{ route('admin.deposit.manual.index') }}">Manual Methods</a>
                        </li>
                    </ul>
                </li>

                <li
                    class="sidebar-item  has-sub">
                    <a href="#" class='sidebar-link'>
                        <i class="fas fa-file-alt"></i>
                        <span>Deposit History</span>
                    </a>
                    <ul class="submenu ">
                        <li class="submenu-item {{ Route::is('admin.deposit.list') ? 'active' : '' }}">
                            <a href="{{ route('admin.deposit.list') }}">All Deposits</a>
                        </li>
                        <li class="submenu-item {{ Route::is('admin.deposit.approved') ? 'active' : '' }}">
                            <a href="{{ route('admin.deposit.approved') }}">Approved Deposits</a>
                        </li>
                        <li class="submenu-item {{ Route::is('admin.deposit.pending') ? 'active' : '' }}">
                            <a href="{{ route('admin.deposit.pending') }}">Pending Deposits</a>
                        </li>
                        <li class="submenu-item {{ Route::is('admin.deposit.rejected') ? 'active' : '' }}">
                            <a href="{{ route('admin.deposit.rejected') }}">Rejected Deposits</a>
                        </li>
                    </ul>
                </li>

                <li
                    class="sidebar-item  has-sub">
                    <a href="#" class='sidebar-link'>
                        <i class="fas fa-hand-holding-usd"></i>
                        <span>Withdrawals</span>
                    </a>
                    <ul class="submenu ">
                        <li class="submenu-item {{ Route::is('admin.withdraw.method.methods') ? 'active' : '' }}">
                            <a href="{{ route('admin.withdraw.method.methods') }}">Withdraw Methods</a>
                        </li>
                        <li class="submenu-item {{ Route::is('admin.withdraw.pending') ? 'active' : '' }}">
                            <a href="{{ route('admin.withdraw.pending') }}">Pending Withdrawals</a>
                        </li>
                        <li class="submenu-item {{ Route::is('admin.withdraw.approved') ? 'active' : '' }}">
                            <a href="{{ route('admin.withdraw.approved') }}">Approved Withdrawals</a>
                        </li>
                        <li class="submenu-item {{ Route::is('admin.withdraw.rejected') ? 'active' : '' }}">
                            <a href="{{ route('admin.withdraw.rejected') }}">Rejected Withdrawals</a>
                        </li>
                        <li class="submenu-item {{ Route::is('admin.withdraw.log') ? 'active' : '' }}">
                            <a href="{{ route('admin.withdraw.log') }}">All Withdrawals</a>
                        </li>
                    </ul>
                </li>

                <li
                    class="sidebar-item  has-sub">
                    <a href="#" class='sidebar-link'>
                        <i class="fas fa-comments-dollar"></i>
                        <span>Transections</span>
                    </a>
                    <ul class="submenu ">
                        <li class="submenu-item {{ Route::is('admin.report.transaction') ? 'active' : '' }}">
                            <a href="{{ route('admin.report.transaction') }}">Transaction Logs</a>
                        </li>
                        <li class="submenu-item {{ Route::is('admin.report.investment') ? 'active' : '' }}">
                            <a href="{{ route('admin.report.investment') }}">Investment Log </a>
                        </li>
                        <li class="submenu-item {{ Route::is('admin.report.interest') ? 'active' : '' }}">
                            <a href="{{ route('admin.report.interest') }}">Interest History</a>
                        </li>
                        <li class="submenu-item {{ Route::is('admin.report.referral') ? 'active' : '' }}">
                            <a href="{{ route('admin.report.referral') }}">Referral Commissions</a>
                        </li>
                    </ul>
                </li>

                <li class="sidebar-title">BASIC SETTINGS</li>
                <li class="sidebar-item  has-sub">
                    <a href="#" class='sidebar-link'>
                        <i class="fas fa-book"></i>
                        <span>Basic Settings</span>
                    </a>
                    <ul class="submenu ">
                        <li class="submenu-item {{ Route::is('admin.settings') ? 'active' : '' }}">
                            <a href="{{ route('admin.settings') }}">Basic</a>
                        </li>
                        <li class="submenu-item {{ Route::is('admin.logo') ? 'active' : '' }}">
                            <a href="{{ route('admin.logo') }}">Logo & favicon</a>
                        </li>
                        <li class="submenu-item {{ Route::is('admin.contact') ? 'active' : '' }}">
                            <a href="{{ route('admin.contact') }}">Contact</a>
                        </li>
                        <li class="submenu-item {{ Route::is('admin.breadcrumb') ? 'active' : '' }}">
                            <a href="{{ route('admin.breadcrumb') }}">Breadcrumb</a>
                        </li>
                        <li class="submenu-item {{ Route::is('admin.social.create') ? 'active' : '' }}">
                            <a href="{{ route('admin.social.create') }}">Social</a>
                        </li>
                        <li class="submenu-item {{ Route::is('admin.footer') ? 'active' : '' }}">
                            <a href="{{ route('admin.footer') }}">Footer Section</a>
                        </li>

                    </ul>
                </li>

                <li class="sidebar-item  has-sub">
                    <a href="#" class='sidebar-link'>
                        <i class="fas fa-book"></i>
                        <span>Home Page</span>
                    </a>
                    <ul class="submenu ">
                        <li class="submenu-item {{ Route::is('admin.banner') ? 'active' : '' }}">
                            <a href="{{ route('admin.banner') }}">Banner</a>
                        </li>
                         <li class="submenu-item {{ Route::is('admin.slider') ? 'active' : '' }}">
                            <a href="{{ route('admin.slider') }}">Slider</a>
                        </li>

                        <li class="submenu-item {{ Route::is('admin.services') ? 'active' : '' }}">
                            <a href="{{ route('admin.services') }}">Services</a>
                        </li>

                       <li class="submenu-item {{ Route::is('admin.about') ? 'active' : '' }}">
                            <a href="{{ route('admin.about') }}">About Us</a>
                        </li>
                        <li class="submenu-item {{ Route::is('admin.counter') ? 'active' : '' }}">
                            <a href="{{ route('admin.counter') }}">Counter Section</a>
                        </li>
                        <li class="submenu-item {{ Route::is('admin.work') ? 'active' : '' }}">
                            <a href="{{ route('admin.work') }}">How it's Work</a>
                        </li>
                         <li class="submenu-item {{ Route::is('admin.faq') ? 'active' : '' }}">
                            <a href="{{ route('admin.faq') }}">Faq </a>
                        </li>
                        <li class="submenu-item {{ Route::is('admin.choose') ? 'active' : '' }}">
                            <a href="{{ route('admin.choose') }}">Why Choose Us </a>
                        </li>
                        <li class="submenu-item {{ Route::is('admin.testimonial') ? 'active' : '' }}">
                            <a href="{{ route('admin.testimonial') }}">Testimonial</a>
                        </li>
                        <li class="submenu-item {{ Route::is('admin.blog') ? 'active' : '' }}">
                            <a href="{{ route('admin.blog') }}">Blog</a>
                        </li>
                        <li class="submenu-item {{ Route::is('admin.titleSubtitle') ? 'active' : '' }}">
                            <a href="{{ route('admin.titleSubtitle') }}">Title Subtitle </a>
                        </li>
                        <li class="submenu-item {{ Route::is('admin.privacy') ? 'active' : '' }}">
                            <a href="{{ route('admin.privacy') }}">Privacy </a>
                        </li>
                        <li class="submenu-item {{ Route::is('admin.terms') ? 'active' : '' }}">
                            <a href="{{ route('admin.terms') }}">Terms</a>
                        </li>

                    </ul>
                </li>
                <li
                    class="sidebar-item {{ Route::is('admin.language') ? 'active' : '' }} ">
                    <a href="{{ route('admin.language') }}" class="sidebar-link">
                        <i class="fas fa-language"></i>
                        <span>Language Manager </span>
                    </a>
                </li>



                <li class="sidebar-item  has-sub">
                    <a href="#" class='sidebar-link'>
                        <i class="fas fa-mobile"></i>
                        <span>SMS Manager</span>
                    </a>
                    <ul class="submenu ">
                        <li class="submenu-item {{ Route::is('admin.sms.api') ? 'active' : '' }}">
                            <a href="{{ route('admin.sms.api') }}">Api Settings</a>
                        </li>
                         <li class="submenu-item {{ Route::is('admin.sms.templete') ? 'active' : '' }}">
                            <a href="{{ route('admin.sms.templete') }}">SMS Templetes</a>
                        </li>

                    </ul>
                </li>

            </ul>
        </div>
    </div>

</div>
