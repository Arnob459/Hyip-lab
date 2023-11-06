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

    <div class="table-wrapper">
        <table class="transaction-table">
            <thead>
                <tr>
                    <th scope="col">@lang('Transaction ID')</th>
                    <th scope="col">@lang('Amount')</th>
                    <th scope="col">@lang('Balance')</th>
                    <th scope="col">@lang('Details')</th>
                    <th scope="col">@lang('Action')</th>
                </tr>
            </thead>
            <tbody>

                @if ($logs->count() == 0)
                    <tr>
                        <td class="text-center" colspan="5">
                            @lang('No data found')
                        </td>

                    </tr>
                @endif

                @foreach($logs as $log)
                    <tr>
                        <td class="">#{{$log->trx}}</td>
                        <td class="@if($log->trx_type == '+') cl-green @elseif ($log->trx_type == '-') cl-red
                             @endif ">{{$log->trx_type}}{{formatter_money($log->amount)}} {{$gnl->cur}}</td>
                        <td class="cl-mint">{{formatter_money($log->post_balance)}} {{$gnl->cur}}
                            @if ($log->type == 1) <span class="badge bg-info"> @lang('Deposit Wallet')</span> @else
                            <span class="badge bg-warning">@lang('Interest Wallet')</span>
                        @endif </td>
                        <td >{{$log->details}}</td>
                        <td><a href="{{route('user.transactions.details', [$log->trx, $log->id] )}}" title="details"
                               class="btn btn-info"><i class="fa fa-eye"></i></a></td>
                    </tr>
                @endforeach
                </tbody>
        </table>

            <ul class="pagination-overfollow">

                <p>{{ $logs->appends(array_filter(Request::all()))->links( "pagination::bootstrap-5")}}</p>

            </ul>
    </div>
</div>


@endsection
