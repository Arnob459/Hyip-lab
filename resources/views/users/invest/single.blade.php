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
                        <p>@lang('Plan Name') :</p>
                        <p>@lang('Payable Bonus') :</p>
                        <p>@lang('Period') :</p>
                        <p>@lang('Received') :</p>
                        <p>@lang('Capital Back') :</p>
                        <p>@lang('Invest Amount') :</p>
                        <p>@lang('Status') :</p>
                        <p>@lang('Next Payment') :</p>
                        <p>@lang('Buy at') :</p>
                    </div>
                </div>
                <div class="col-sm-9 col-7">
                    <div class="right-info">
                        <p>{{$log->plan->plan_name}}</p>
                        <p>{{__($gnl->cur_sym)}} {{__(formatter_money($log->interest))}} / {{__($log->time_name)}} </p>
                        <p>@if($log->period == '-1') <span class="badge bg-success">@lang('Life-time')</span>  @else {{__($log->period)}} @lang('Times') @endif</p>
                        <p>{{$log->return_rec_time}} </p>
                        <p>
                        @if ($log->capital_status == 1)
                            <span class="badge bg-success">@lang('Capital Will Return Back')</span>
                        @else
                            <span class="badge bg-warning">@lang('Capital Will Store')</span>
                            @endif

                        </p>
                        <p>{{__($gnl->cur_sym)}} {{formatter_money($log->amount)}} </p>
                        @if($log->status == 1)
                            <p>@lang('running')   </p>
                        @else
                            <p>  @lang('Complete') } </p>
                        @endif

                        @if($log->status == 1)
                            <p> {{\Carbon\Carbon::parse($log->next_time)->diffForHumans()}}   </p>
                        @else
                            <p>  @lang('Complete') } </p>
                        @endif

                        <p>{{show_datetime($log->created_at)}} </p>
                    </div>
                </div>
            </div>

            </div>
        </div>
    </div>

</div>


@endsection
