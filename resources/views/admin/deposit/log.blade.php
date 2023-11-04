@extends('admin.layouts.master')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{$page_title}}  </h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table  class="display table  table-hover" >
                            <thead>
                            <tr>
                                <th >@lang('Date')</th>
                                <th >@lang('Trx Number')</th>
                                <th >@lang('Username')</th>
                                <th >@lang('Method')</th>
                                <th>@lang('Amount')</th>
                                <th >@lang('Charge')</th>
                                <th >@lang('After Charge')</th>
                                <th >@lang('Rate')</th>
                                <th >@lang('Payable')</th>
                                @if(request()->routeIs('admin.deposit.pending') )
                                    <th >@lang('Action')</th>

                                @elseif(request()->routeIs('admin.deposit.list') || request()->routeIs('admin.deposit.search') || request()->routeIs('admin.users.deposits'))
                                    <th >@lang('Status')</th>
                                @endif
                            </tr>
                            </thead>

                            <tbody>
                            @foreach( $deposits as $deposit )
                                @if(!$deposit->gateway) @endif
                                <tr>
                                    <td>{{ show_datetime($deposit->created_at) }}</td>
                                    <td >{{ $deposit->trx }}</td>
                                    <td><a href="{{route('admin.user.edit', $deposit->user_id)}}">{{ $deposit->user->username }}</a></td>
                                    <td>{{ $deposit->gateway->name }}</td>
                                    <td class="font-weight-bold">{{ $gnl->cur_sym }} {{ $deposit->amount +0 }} </td>
                                    <td class="text-success"> {{ $gnl->cur_sym }} {{ $deposit->charge +0 }}</td>
                                    <td>{{ $gnl->cur_sym }} {{ $deposit->amount+$deposit->charge }}</td>
                                    <td> {{ $deposit->rate +0 }}</td>
                                    <td class="font-weight-bold">{{ formatter_money($deposit->final_amo) }} {{$deposit->method_currency}}</td>
                                    @if(request()->routeIs('admin.deposit.pending'))
                                        @php
                                            $details = ($deposit->detail != null) ? $deposit->detail : '';
                                            $proveImg = "<img src='".get_image(config('constants.deposit.verify.path').'/'.$deposit->verify_image)."' alt=''>";
                                        @endphp
                                        <td>
                                            <button class="btn btn-success approveBtn"  data-prove_img="@php echo $proveImg @endphp" data-detail="{{$details}}" data-id="{{ $deposit->id }}" data-amount="{{ formatter_money($deposit->amount)}} {{ $gnl->cur }}" data-username="{{ $deposit->user->username }}"><i class="fa fa-fw fa-check"></i></button>
                                            <button class="btn btn-danger rejectBtn" data-prove_img="@php echo $proveImg @endphp" data-detail="{{$details}}" data-id="{{ $deposit->id }}" data-amount="{{ formatter_money($deposit->amount)}} {{ $deposit->method_currency }}" data-username="{{ $deposit->user->username }}"><i class="fa fa-fw fa-ban"></i></button>
                                        </td>
                                    @elseif(request()->routeIs('admin.deposit.list')  || request()->routeIs('admin.deposit.search') || request()->routeIs('admin.users.deposits'))
                                        <td>
                                            @if($deposit->status == 2)
                                                <span class="badge bg-warning">@lang('Pending')</span>
                                            @elseif($deposit->status == 1)
                                                <span class="badge bg-success">@lang('Approved')</span>
                                            @elseif($deposit->status == 3)
                                                <span class="badge bg-danger">@lang('Rejected')</span>
                                            @endif
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                            @if ($deposits->count() == 0)
                                <tr>
                                    <td class="text-muted text-center" colspan="100%">{{ $empty_message }}</td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                        {{ $deposits->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>


    {{-- APPROVE MODAL --}}
    <div id="approveModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Approve Deposit Confirmation')</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.deposit.approve') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id">
                    <div class="modal-body">

                        <p>@lang('Are you sure to') <span class="font-weight-bold">@lang('approve')</span> <span class="font-weight-bold withdraw-amount text-success"></span> @lang('deposit of') <span class="font-weight-bold withdraw-user"></span>?</p>
                        <p class="withdraw-detail"></p>

                        <span class="withdraw-proveImg"></span>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">@lang('Close')</button>
                        <button type="submit" class="btn btn-success">@lang('Approve')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- REJECT MODAL --}}
    <div id="rejectModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Reject Deposit Confirmation')</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.deposit.reject') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id">
                    <div class="modal-body">
                        <p>@lang('Are you sure to') <span class="font-weight-bold">@lang('reject')</span> <span class="font-weight-bold withdraw-amount text-success"></span> @lang('deposit of') <span class="font-weight-bold withdraw-user"></span>?</p>
                        <p class="withdraw-detail"></p>
                        <span class="withdraw-proveImg"></span>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">@lang('Close')</button>
                        <button type="submit" class="btn btn-danger">@lang('Reject')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $('.approveBtn').on('click', function() {
            var modal = $('#approveModal');
            modal.find('input[name=id]').val($(this).data('id'));

            modal.find('.withdraw-amount').text($(this).data('amount'));
            modal.find('.withdraw-user').text($(this).data('username'));

            modal.find('.withdraw-proveImg').html($(this).data('prove_img'));

            var details =  Object.entries($(this).data('detail'));
            var list = [];
            details.map( function(item,i) {
                list[i] = ` <li class="list-group-item">${item[0]} : ${item[1]}</li>`
            });
            modal.find('.withdraw-detail').html(list);
            modal.modal('show');
        });

        $('.rejectBtn').on('click', function() {
            var modal = $('#rejectModal');
            modal.find('input[name=id]').val($(this).data('id'));
            modal.find('.withdraw-amount').text($(this).data('amount'));

            modal.find('.withdraw-user').text($(this).data('username'));

            modal.find('.withdraw-proveImg').html($(this).data('prove_img'));

            var details =  Object.entries($(this).data('detail'));
            var list = [];
            details.map( function(item,i) {
                list[i] = ` <li class="list-group-item">${item[0]} : ${item[1]}</li>`
            });
            modal.find('.withdraw-detail').html(list);
            modal.modal('show');
        });
    </script>
@endpush
