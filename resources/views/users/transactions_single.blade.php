@extends('users.master')

@section('content')

<div class="dashboard-hero-content text-white">
    <h3 class="title">{{ $page_title }}</h3>
    <ul class="breadcrumb">
        <li class="nav-item">  <a class="nav-link " href="index.html">Home</a> </li>
        <li>
            {{ $page_title }}
        </li>
    </ul>
</div>
</div>
<div class="container-fluid">
    <div class="card-body">
        <div class="profile-card-body "><br>
            <div class="create_wrapper mw-100">
            <div class="row">
                <div class="col-sm-3 col-5">
                    <div class="left-info">
                        <p>@lang('Transaction ID') :</p>
                        <p>@lang('Amount') :</p>
                        <p>@lang('Charge') :</p>
                        <p>@lang('After Balance') :</p>
                        <p>@lang('Wallet') :</p>
                        <p>@lang('Details') :</p>
                        <p>@lang('Time') :</p>
                    </div>
                </div>
                <div class="col-sm-9 col-7">
                    <div class="right-info">
                        <p>#{{$log->trx}}</p>
                        <p class="@if($log->trx_type == '+') cl-green @elseif ($log->trx_type == '-') cl-red
                     @endif " >{{$log->trx_type}}{{formatter_money($log->amount)}} {{$gnl->cur}}</p>
                        <p>{{formatter_money($log->charge)}} {{$gnl->cur}}</p>
                        <p>{{formatter_money($log->post_balance)}} {{$gnl->cur}}</p>
                        <p> @if ($log->type == 1) @lang('Deposit Wallet') @else
                                @lang('Interest Wallet')
                            @endif</p>
                        <p>{{$log->details}} </p>
                        <p>{{show_datetime($log->created_at)}} </p>
                    </div>
                </div>
            </div>

            </div>
        </div>
    </div>

</div>


@endsection
