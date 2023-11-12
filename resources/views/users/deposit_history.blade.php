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
                    <th scope="col">@lang('Gateway')</th>
                    <th scope="col">@lang('Amount')</th>
                    <th scope="col">@lang('Status')</th>
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
                        <td class="cl-white">#{{$log->trx}}</td>
                        <td class="cl-yellow">{{ $log->gateway->name   }}</td>
                        <td class="cl-mint">{{$gnl->cur_sym}}  {{formatter_money($log->amount)}}</td>
                        <td> @if($log->status == 1)
                                <span class="badge bg-success">@lang('Complete')</span>
                            @elseif($log->status == 2)
                                <span class="badge bg-warning">@lang('Pending')</span>
                            @elseif($log->status == 3)
                                <span class="badge bg-danger">@lang('Cancel')</span>

                            @endif</td>
                        <td><a href="{{route('user.deposit.details', [$log->trx, $log->id] )}}" title="details"
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
