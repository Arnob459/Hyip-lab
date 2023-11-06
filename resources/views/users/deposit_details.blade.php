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
                        <p>@lang('Method') :</p>
                        <p>@lang('Method Currency') :</p>
                        <p>@lang('Amount') :</p>
                        <p>@lang('Charge') :</p>
                        <p>@lang('Amount + Charge') :</p>
                        <p>@lang('Rate 1')  {{$gnl->cur}} :</p>
                        <p>@lang('Pay In')  {{$log->baseCurrency()}} :</p>
                        <p>@lang('Transaction ID') :</p>
                        <p>@lang('Status') :</p>
                        <p>@lang('Request At') :</p>
                        <p>@lang('Approved At') :</p>
                    </div>
                </div>
                <div class="col-sm-9 col-7">
                    <div class="right-info">
                        <p>{{ $log->gateway->name   }}</p>
                        <p>{{$log->method_currency}}</p>
                        <p>{{formatter_money($log->amount)}} {{$gnl->cur}}</p>
                        <p>{{formatter_money($log->charge)}} {{$gnl->cur}}</p>
                        <p>{{formatter_money($log->final_amo)}} {{$gnl->cur}}</p>
                        <p> = {{$log->rate+0}} {{$log->baseCurrency()}} <code>(@lang('site Currency = Method Currency')</code></p>
                        <p>{{$log->final_amo * $log->rate+0}} {{$log->baseCurrency()}}</p>
                        <p>#{{$log->trx}}</p>
                        <p>
                            @if($log->status == 1)
                                <span class="badge bg-success">@lang('Complete')</span>
                            @elseif($log->status == 2)
                                <span class="badge bg-warning">@lang('Pending')</span>
                            @elseif($log->status == 3)
                                <span class="badge bg-danger">@lang('Cancel')</span></p>
                        @endif
                        <p> {{show_datetime($log->created_at)}}</p>
                        <p>  @if($log->status == 1)
                                {{show_datetime($log->updated_at)}}
                                 @else
                                @lang('N/A')
                                 @endif
                        </p>

                    </div>
                </div>
            </div>

            </div>
        </div>
    </div>

</div>


@endsection
