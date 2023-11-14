
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
    <div class="operations">
            <h3 class="main-title">{{ $page_title }}</h3>
        <div class="table-wrapper">
            <table class="transaction-table">
                <thead>
                    <tr>
                        <th scope="col">@lang('Transaction ID')</th>
                        <th scope="col">@lang('Gateway')</th>
                        <th scope="col">@lang('Amount')</th>
                        <th scope="col">@lang('Receivable')</th>
                        <th scope="col">@lang('Status')</th>
                        <th scope="col">@lang('Action')</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($withdraws->count() == 0)
                        <tr>
                            <td class="text-center" colspan="6">
                            @lang('No data found')
                            </td>

                        </tr>
                    @endif

                    @foreach($withdraws as $log)
                        <tr>
                            <td class="text-warning">#{{$log->trx}}</td>
                            <td class="text-info">{{__($log->method->name)}}</td>
                            <td class="text-danger">{{$gnl->cur_sym}} {{formatter_money($log->amount)}}</td>
                            <td data-label="@lang('Receivable')"  class="text-success">
                                <strong>{{formatter_money($log->final_amount)}} {{$log->currency}}</strong>
                            </td>
                            <td> @if($log->status == 1)
                                    <span class="badge bg-success">@lang('Complete')</span>
                                @elseif($log->status == 2)
                                    <span class="badge bg-warning">@lang('Pending')</span>
                                @elseif($log->status == 3)
                                    <span class="badge bg-danger">@lang('Cancel')</span>

                                @endif</td>
                            <td><a href="{{route('user.withdraw.details', [$log->trx, $log->id] )}}" title="details"
                                class="btn btn-info"><i class="fa fa-eye"></i></a></td>
                        </tr>
                    @endforeach
                    </tbody>
            </table>
            {{$withdraws->links( "pagination::bootstrap-5")}}
        </div>
    </div>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog text-white" role="document">
        <div class="modal-content blue-bg">
            <div class="modal-header">
                <strong class="modal-title method-name" >@lang('Admin Feedback')</strong>
                <a href="javascript:void(0)" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </a>
            </div>
            <div class="modal-body">
                    <p class="text-white admin_feedback"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('Close')</button>
                </div>
        </div>
    </div>
</div>

@endsection
@push('js')
    <script>
        $(document).ready(function(){
            $('.withdraw').on('click', function () {
                var modal = $('#exampleModal');
                modal.find('.admin_feedback').text($(this).data('admin_feedback'));
            });
        });
    </script>
@endpush
