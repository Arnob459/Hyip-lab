@extends('admin.layouts.master')

@section('content')

<div class="page-content">
    <section class="row">
        <div class="col-12 ">
            <div class="row">
                <div class="col-6 col-lg-4 col-md-6">
                    <div class="card">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-md-3  ">
                                    <div class="stats-icon blue mb-2">
                                        <i class="fas fa-users"></i>
                                    </div>
                                </div>

                                <div class="col-md-9 ">
                                    <h6 class="text-muted font-semibold">Total Users </h6>
                                    <h6 class="font-extrabold mb-0">{{ $total_user }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-4 col-md-6">
                    <div class="card">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-md-3  ">
                                    <div class="stats-icon green mb-2">
                                        <i class="fas fa-user-check"></i>
                                    </div>
                                </div>
                                <div class="col-md-9 ">
                                    <h6 class="text-muted font-semibold">Active Users</h6>
                                    <h6 class="font-extrabold mb-0">{{ $active_user }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-4 col-md-6">
                    <div class="card">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-md-3 ">
                                    <div class="stats-icon purple mb-2">
                                        <i class="fas fa-user-edit"></i>
                                    </div>
                                </div>
                                <div class="col-md-9 ">
                                    <h6 class="text-muted font-semibold">Pending Users</h6>
                                    <h6 class="font-extrabold mb-0">{{ $pending_user }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-4 col-md-6">
                    <div class="card">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-md-3  ">
                                    <div class="stats-icon red mb-2">
                                        <i class="fas fa-user-times"></i>
                                    </div>
                                </div>
                                <div class="col-md-9 ">
                                    <h6 class="text-muted font-semibold">Block Users</h6>
                                    <h6 class="font-extrabold mb-0">{{ $block_user }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-4 col-md-6">
                    <div class="card">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-md-3  ">
                                    <div class="stats-icon green mb-2">
                                        <i class="far fa-envelope-open"></i>
                                    </div>
                                </div>
                                <div class="col-md-9 ">
                                    <h6 class="text-muted font-semibold">Email Verified</h6>
                                    <h6 class="font-extrabold mb-0">{{ $email_verify }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-4 col-md-6">
                    <div class="card">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-md-3  ">
                                    <div class="stats-icon red mb-2">
                                        <i class="fas fa-envelope"></i>
                                    </div>
                                </div>
                                <div class="col-md-9 ">
                                    <h6 class="text-muted font-semibold">Email Unverified</h6>
                                    <h6 class="font-extrabold mb-0">{{ $email_unverify }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-4 col-md-6">
                    <div class="card">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-md-3  ">
                                    <div class="stats-icon green mb-2">
                                        <i class="fas fa-comment"></i>
                                    </div>
                                </div>
                                <div class="col-md-9 ">
                                    <h6 class="text-muted font-semibold">SMS Verified</h6>
                                    <h6 class="font-extrabold mb-0">{{ $sms_verify }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-4 col-md-6">
                    <div class="card">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-md-3 ">
                                    <div class="stats-icon red mb-2">
                                        <i class="fas fa-comment-slash"></i>
                                    </div>
                                </div>
                                <div class="col-md-9 ">
                                    <h6 class="text-muted font-semibold">SMS Unverified </h6>
                                    <h6 class="font-extrabold mb-0">{{ $sms_unverify }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-4 col-md-6">
                    <div class="card">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-md-3  ">
                                    <div class="stats-icon purple mb-2">
                                        <i class="fas fa-hand-holding-usd"></i>
                                    </div>
                                </div>
                                <div class="col-md-9 ">
                                    <h6 class="text-muted font-semibold">All User Balance</h6>
                                    <h6 class="font-extrabold mb-0">{{$gnl->cur_sym}} {{formatter_money($balance)}} {{$gnl->cur}}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="page-heading">
                    <h3>Deposit Statistics</h3>
                </div>

                <div class="col-6 col-lg-4 col-md-6">
                    <div class="card">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-md-3  ">
                                    <div class="stats-icon green mb-2">
                                        <i class="fas fa-coins"></i>
                                    </div>
                                </div>
                                <div class="col-md-9 ">
                                    <h6 class="text-muted font-semibold">Total Deposit Amount</h6>
                                    <h6 class="font-extrabold mb-0">{{$gnl->cur_sym}} {{formatter_money($payments)}} {{$gnl->cur}} </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-4 col-md-6">
                    <div class="card">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-md-3 ">
                                    <div class="stats-icon green mb-2">
                                        <i class="fas fa-chart-bar"></i>
                                    </div>
                                </div>
                                <div class="col-md-9 ">
                                    <h6 class="text-muted font-semibold">Total Deposits</h6>
                                    <h6 class="font-extrabold mb-0">{{$payment_number}}  </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-4 col-md-6">
                    <div class="card">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-md-3  ">
                                    <div class="stats-icon purple mb-2">
                                        <i class="fas fa-spinner"></i>
                                    </div>
                                </div>
                                <div class="col-md-9 ">
                                    <h6 class="text-muted font-semibold">Pending Deposit Amount</h6>
                                    <h6 class="font-extrabold mb-0">{{$gnl->cur_sym}} {{formatter_money($pending_payments)}} {{$gnl->cur}}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-4 col-md-6">
                    <div class="card">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-md-3  ">
                                    <div class="stats-icon purple mb-2">
                                        <i class="fas fa-spinner"></i>
                                    </div>
                                </div>
                                <div class="col-md-9 ">
                                    <h6 class="text-muted font-semibold">Pending Deposits</h6>
                                    <h6 class="font-extrabold mb-0">{{$pending_payment_number}}  </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-4 col-md-6">
                    <div class="card">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-md-3  ">
                                    <div class="stats-icon red mb-2">
                                        <i class="fas fa-money-bill"></i>
                                    </div>
                                </div>
                                <div class="col-md-9 ">
                                    <h6 class="text-muted font-semibold">Reject Deposit Amount</h6>
                                    <h6 class="font-extrabold mb-0">{{$gnl->cur_sym}} {{formatter_money($reject_payments)}} {{$gnl->cur}}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-4 col-md-6">
                    <div class="card">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-md-3  ">
                                    <div class="stats-icon red mb-2">
                                        <i class="fas fa-times"></i>
                                    </div>
                                </div>
                                <div class="col-md-9 ">
                                    <h6 class="text-muted font-semibold">Reject Deposits </h6>
                                    <h6 class="font-extrabold mb-0"> {{$reject_payment_number}}  </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="page-heading">
                    <h3>Withdrawal Statistics</h3>
                </div>

                <div class="col-6 col-lg-4 col-md-6">
                    <div class="card">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-md-3 ">
                                    <div class="stats-icon green mb-2">
                                        <i class="fas fa-coins"></i>
                                    </div>
                                </div>
                                <div class="col-md-9 ">
                                    <h6 class="text-muted font-semibold">Total Withdrawal Amount  </h6>
                                    <h6 class="font-extrabold mb-0">{{$gnl->cur_sym}} {{formatter_money($withdrawals)}} {{$gnl->cur}}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-4 col-md-6">
                    <div class="card">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-md-3  ">
                                    <div class="stats-icon green mb-2">
                                        <i class="fas fa-chart-bar"></i>
                                    </div>
                                </div>
                                <div class="col-md-9 ">
                                    <h6 class="text-muted font-semibold">Total Withdraws</h6>
                                    <h6 class="font-extrabold mb-0">{{ $withdrawal_number }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-4 col-md-6">
                    <div class="card">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-md-3  ">
                                    <div class="stats-icon purple mb-2">
                                        <i class="fas fa-spinner"></i>
                                    </div>
                                </div>
                                <div class="col-md-9 ">
                                    <h6 class="text-muted font-semibold">Pending Withdrawal Amount</h6>
                                    <h6 class="font-extrabold mb-0">{{$gnl->cur_sym}} {{formatter_money($pending_withdrawals)}} {{$gnl->cur}}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-4 col-md-6">
                    <div class="card">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-md-3  ">
                                    <div class="stats-icon purple mb-2">
                                        <i class="fas fa-spinner"></i>
                                    </div>
                                </div>
                                <div class="col-md-9 ">
                                    <h6 class="text-muted font-semibold">Pending Withdraws</h6>
                                    <h6 class="font-extrabold mb-0">{{$pending_withdrawal_number}} </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-4 col-md-6">
                    <div class="card">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-md-3  ">
                                    <div class="stats-icon red mb-2">
                                        <i class="fas fa-money-bill"></i>
                                    </div>
                                </div>
                                <div class="col-md-9 ">
                                    <h6 class="text-muted font-semibold">Reject Withdraws Amount</h6>
                                    <h6 class="font-extrabold mb-0">{{$gnl->cur_sym}} {{formatter_money($reject_withdrawals)}} {{$gnl->cur}}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-4 col-md-6">
                    <div class="card">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-md-3  ">
                                    <div class="stats-icon red mb-2">
                                        <i class="fas fa-ban"></i>
                                    </div>
                                </div>
                                <div class="col-md-9 ">
                                    <h6 class="text-muted font-semibold">Reject Withdraws</h6>
                                    <h6 class="font-extrabold mb-0"> {{$reject_withdrawal_number}} </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="page-heading">
                    <h3>Investment Statistics</h3>
                </div>

                <div class="col-6 col-lg-4 col-md-6">
                    <div class="card">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-md-3  ">
                                    <div class="stats-icon blue mb-2">
                                        <i class="fas fa-money-check-alt"></i>
                                    </div>
                                </div>
                                <div class="col-md-9 ">
                                    <h6 class="text-muted font-semibold">Total Invest</h6>
                                    <h6 class="font-extrabold mb-0">{{$gnl->cur_sym}} {{formatter_money($total_invest)}} {{$gnl->cur}}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-4 col-md-6">
                    <div class="card">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-md-3 ">
                                    <div class="stats-icon blue mb-2">
                                        <i class="fas fa-file-invoice-dollar"></i>
                                    </div>
                                </div>
                                <div class="col-md-9 ">
                                    <h6 class="text-muted font-semibold">Today Invest</h6>
                                    <h6 class="font-extrabold mb-0">{{$gnl->cur_sym}} {{formatter_money($today_invest)}} {{$gnl->cur}}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-4 col-md-6">
                    <div class="card">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-md-3  ">
                                    <div class="stats-icon purple mb-2">
                                        <i class="fas fa-money-bill-wave"></i>
                                    </div>
                                </div>
                                <div class="col-md-9 ">
                                    <h6 class="text-muted font-semibold">Yesterday Invest</h6>
                                    <h6 class="font-extrabold mb-0">{{$gnl->cur_sym}} {{formatter_money($yesterday_invest)}} {{$gnl->cur}}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-4 col-md-6">
                    <div class="card">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-md-3  ">
                                    <div class="stats-icon green mb-2">
                                        <i class="fas fa-money-bill-alt"></i>
                                    </div>
                                </div>
                                <div class="col-md-9 ">
                                    <h6 class="text-muted font-semibold">Last 7 days Invest</h6>
                                    <h6 class="font-extrabold mb-0">{{$gnl->cur_sym}} {{formatter_money($last_7_day_invest)}} {{$gnl->cur}}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-4 col-md-6">
                    <div class="card">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-md-3 ">
                                    <div class="stats-icon red mb-2">
                                       <i class="fas fa-money-bill-wave-alt"></i>

                                    </div>
                                </div>
                                <div class="col-md-9 ">
                                    <h6 class="text-muted font-semibold">Last 30 days Invest</h6>
                                    <h6 class="font-extrabold mb-0">{{$gnl->cur_sym}} {{formatter_money($this_month_invest)}} {{$gnl->cur}}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="page-heading">
                    <h3>Bonus Return Statistics</h3>
                </div>

                <div class="col-6 col-lg-4 col-md-6">
                    <div class="card">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-md-3  ">
                                    <div class="stats-icon blue mb-2">
                                        <i class="fas fa-money-check-alt"></i>
                                    </div>
                                </div>
                                <div class="col-md-9 ">
                                    <h6 class="text-muted font-semibold">Total Bonus Return</h6>
                                    <h6 class="font-extrabold mb-0">{{$gnl->cur_sym}} {{formatter_money($total_interest_return)}} {{$gnl->cur}}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-4 col-md-6">
                    <div class="card">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-md-3 ">
                                    <div class="stats-icon blue mb-2">
                                        <i class="fas fa-file-invoice-dollar"></i>
                                    </div>
                                </div>
                                <div class="col-md-9 ">
                                    <h6 class="text-muted font-semibold">Today Bonus Return</h6>
                                    <h6 class="font-extrabold mb-0">{{$gnl->cur_sym}} {{formatter_money($today_interest_return)}} {{$gnl->cur}}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-4 col-md-6">
                    <div class="card">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-md-3  ">
                                    <div class="stats-icon purple mb-2">
                                        <i class="fas fa-money-bill-wave"></i>
                                    </div>
                                </div>
                                <div class="col-md-9 ">
                                    <h6 class="text-muted font-semibold">Yesterday Bonus Return</h6>
                                    <h6 class="font-extrabold mb-0">{{$gnl->cur_sym}} {{formatter_money($yesterday_interest_return)}} {{$gnl->cur}}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-4 col-md-6">
                    <div class="card">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-md-3  ">
                                    <div class="stats-icon green mb-2">
                                        <i class="fas fa-money-bill-alt"></i>
                                    </div>
                                </div>
                                <div class="col-md-9 ">
                                    <h6 class="text-muted font-semibold">Last 7 days Bonus Return</h6>
                                    <h6 class="font-extrabold mb-0">{{$gnl->cur_sym}} {{formatter_money($last_7_day_interest_return)}} {{$gnl->cur}}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-4 col-md-6">
                    <div class="card">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-md-3 ">
                                    <div class="stats-icon red mb-2">
                                       <i class="fas fa-money-bill-wave-alt"></i>

                                    </div>
                                </div>
                                <div class="col-md-9 ">
                                    <h6 class="text-muted font-semibold">Last 30 days Bonus Return</h6>
                                    <h6 class="font-extrabold mb-0">{{$gnl->cur_sym}} {{formatter_money($this_month_interest_return)}} {{$gnl->cur}}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-4 col-md-6">
                    <div class="card">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-md-3 ">
                                    <div class="stats-icon red mb-2">
                                       <i class="fas fa-money-bill-wave-alt"></i>

                                    </div>
                                </div>
                                <div class="col-md-9 ">
                                    <h6 class="text-muted font-semibold">Total Referral Commission Given</h6>
                                    <h6 class="font-extrabold mb-0">{{$gnl->cur_sym}} {{formatter_money($ref_com)}} {{$gnl->cur}}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>


            {{-- <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Profile Visit</h4>
                        </div>
                        <div class="card-body">
                            <div id="chart-profile-visit">{{ $today_invest }}</div>
                        </div>
                    </div>
                </div>
            </div> --}}

        </div>

    </section>
</div>

@endsection


@push('js')
<script src="{{ asset('assets/admin/extensions/apexcharts/apexcharts.min.js') }}"></script>
<script src="{{ asset('assets/admin/js/pages/dashboard.js') }}"></script>
@endpush
