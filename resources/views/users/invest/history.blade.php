
@extends('users.master')

@section('content')

<script>
    function createCountDown(elementId, sec) {
        var tms = sec;
        var x = setInterval(function() {
            var distance = tms*1000;
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);
            document.getElementById(elementId).innerHTML =days+"d: "+ hours + "h "+ minutes + "m " + seconds + "s ";
            if (distance < 0) {
                clearInterval(x);
                document.getElementById(elementId).innerHTML = "{{__('COMPLETE')}}";
            }
            tms--;
        }, 1000);
    }

</script>

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

    <div class="table-wrapper">
        <table class="transaction-table">
            <thead>
                <tr>
                    <th scope="col">@lang('Plan')</th>
                    <th scope="col">@lang('Interest')</th>
                    <th scope="col">@lang('Period')</th>
                    <th scope="col">@lang('Received')</th>
                    <th scope="col">@lang('Status')</th>
                    <th scope="col" style="width :20%">@lang('Next Payment')</th>
                    <th scope="col">@lang('Action')</th>
                </tr>
            </thead>
            <tbody>

                @foreach($logs as $data)
                    <tr>
                        <td>{{__($data->plan->plan_name)}}</td>
                        <td>{{__($gnl->cur_sym)}} {{formatter_money($data->interest)}} / {{__($data->time_name)}} </td>
                        <td>@if($data->period == '-1') <span class="badge bg-success">@lang('Life-time')</span>  @else {{__($data->period)}} @lang('Times') @endif</td>
                        <td>  {{__($data->return_rec_time)}} @lang('Times') </td>
                       <td>  @if($data->status == '1') <span class="badge bg-warning">@lang('Running')</span>  @else <span class="badge bg-success">@lang('Complete')</span> @endif </td>
                        @if($data->status == 1)
                        <td scope="row" style="font-weight:bold;"><p id="counter{{$data->id}}" class="demo countdown timess2"> </p></td>
                        @else
                            <td>   @lang('Complete') </td>

                        @endif
                        <td><a href="{{route('user.invest.details', [slug($data->plan->plan_name), $data->id] )}}" title="details"
                               class="btn btn-info"><i class="fa fa-eye"></i></a></td>

                    </tr>

                    <script>createCountDown('counter<?php echo $data->id ?>', {{\Carbon\Carbon::parse($data->next_time)->diffInSeconds()}});</script>
                @endforeach

            </tbody>
        </table>
    </div>
</div>


@endsection
