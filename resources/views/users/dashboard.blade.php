
@extends('users.master')

@section('content')

                    <div class="dashboard-hero-content text-white">
                        <h3 class="title">{{ $page_title }}</h3>
                        <ul class="breadcrumb">
                            <li class="nav-item"><a class="nav-link " href="">Home</a> </li>
                            <li>
                                {{ $page_title }}
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="container-fluid">
                    <div class="row justify-content-center mt--85">
                        <div class="col-sm-6 col-lg-4">
                            <div class="dashboard-item">
                                <div class="dashboard-inner">
                                    <div class="col-md-9">
                                        <span class="title">Deposit wallet Balance </span>
                                        <h5 class="amount">{{formatter_money(auth()->user()->balance)}} {{$gnl->cur}}</h5>
                                    </div>
                                    <div class="col-md-3">
                                        <i class="fa-2x flaticon-wallet"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-4">
                            <div class="dashboard-item">
                                <div class="dashboard-inner">
                                    <div class="col-md-9">
                                        <span class="title">Interest Wallet Balance </span>
                                        <h5 class="amount">{{formatter_money(auth()->user()->interest_balance)}} {{$gnl->cur}}</h5>
                                    </div>
                                    <div class="col-md-3">
                                        <i class="fa-2x flaticon-wallet"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-4">
                            <div class="dashboard-item">
                                <div class="dashboard-inner">
                                    <div class="col-md-9">
                                        <span class="title">Total Deposit</span>
                                        <h5 class="amount">{{formatter_money($total_deposit)}} {{$gnl->cur}}</h5>
                                    </div>
                                    <div class="col-md-3">
                                        <i class="fa-2x flaticon-coin"></i>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-4">
                            <div class="dashboard-item">
                                <div class="dashboard-inner">
                                    <div class="col-md-9">
                                        <span class="title">Total Withdrawal</span>
                                        <h5 class="amount">{{formatter_money($total_withdrawal)}} {{$gnl->cur}}</h5>
                                    </div>
                                    <div class="col-md-3">
                                        <i class="fa-2x flaticon-atm"></i>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-4">
                            <div class="dashboard-item">
                                <div class="dashboard-inner">
                                    <div class="col-md-9">
                                        <span class="title">Total Investment </span>
                                        <h5 class="amount">{{formatter_money($total_invest)}} {{$gnl->cur}}</h5>
                                    </div>
                                    <div class="col-md-3">
                                        <i class="fa-2x flaticon-coin"></i>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-4">
                            <div class="dashboard-item">
                                <div class="dashboard-inner">
                                    <div class="col-md-9">
                                        <span class="title">Total Interest return </span>
                                        <h5 class="amount">{{formatter_money($total_interest_return)}} {{$gnl->cur}}</h5>
                                    </div>
                                    <div class="col-md-3">
                                        <i class="fa-2x flaticon-interest"></i>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-4">
                            <div class="dashboard-item">
                                <div class="dashboard-inner">
                                    <div class="col-md-9">
                                        <span class="title">Today Interest return </span>
                                        <h5 class="amount">{{formatter_money($today_interest_return)}} {{$gnl->cur}}</h5>
                                    </div>
                                    <div class="col-md-3">
                                        <i class="fa-2x flaticon-interest"></i>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-4">
                            <div class="dashboard-item">
                                <div class="dashboard-inner">
                                    <div class="col-md-9">
                                        <span class="title">Yesterday Interest return</span>
                                        <h5 class="amount">{{formatter_money($yesterday_interest_return)}} {{$gnl->cur}}</h5>
                                    </div>
                                    <div class="col-md-3">
                                        <i class="fa-2x flaticon-interest"></i>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-4">
                            <div class="dashboard-item">
                                <div class="dashboard-inner">
                                    <div class="col-md-9">
                                        <span class="title">Last 7 days Interest return </span>
                                        <h5 class="amount">{{formatter_money($last_7_day_interest_return)}} {{$gnl->cur}}</h5>
                                    </div>
                                    <div class="col-md-3">
                                        <i class="fa-2x flaticon-interest"></i>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-4">
                            <div class="dashboard-item">
                                <div class="dashboard-inner">
                                    <div class="col-md-9">
                                        <span class="title">Last 30 days Interest return </span>
                                        <h5 class="amount">{{formatter_money($this_month_interest_return)}} {{$gnl->cur}}</h5>
                                    </div>
                                    <div class="col-md-3">
                                        <i class="fa-2x flaticon-interest"></i>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-4">
                            <div class="dashboard-item">
                                <div class="dashboard-inner">
                                    <div class="col-md-9">
                                        <span class="title">Total Referral Commission </span>
                                        <h5 class="amount">{{formatter_money($total_refferal_com)}} {{$gnl->cur}}</h5>
                                    </div>
                                    <div class="col-md-3">
                                        <i class="fa-2x flaticon-exchange"></i>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-4">
                            <div class="dashboard-item">
                                <div class="dashboard-inner">
                                    <div class="col-md-9">
                                        <span class="title">Total Referral</span>
                                        <h5 class="amount">{{ $total_refferal_user }}</h5>
                                    </div>
                                    <div class="col-md-3">
                                        <i class="fa-2x flaticon-team"></i>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>



@endsection
