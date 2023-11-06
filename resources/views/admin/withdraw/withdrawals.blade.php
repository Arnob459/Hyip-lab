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
                                <th scope="col">@lang('Date')</th>
                                <th scope="col">@lang('Trx Number')</th>
                                <th scope="col">@lang('Username')</th>
                                <th scope="col">@lang('Method')</th>
                                <th scope="col">@lang('Amount')</th>
                                <th scope="col">@lang('Charge')</th>
                                <th scope="col">@lang('After Charge')</th>
                                <th scope="col">@lang('Rate')</th>
                                <th scope="col">@lang('Payable')</th>
                                @if(request()->routeIs('admin.withdraw.pending'))
                                    <th scope="col">@lang('Action')</th>
                                @elseif(request()->routeIs('admin.withdraw.log') || request()->routeIs('admin.withdraw.search')  || request()->routeIs('admin.users.withdrawals'))
                                    <th scope="col">@lang('Status')</th>
                                @endif

                                @if(request()->routeIs('admin.withdraw.approved') || request()->routeIs('admin.withdraw.rejected'))
                                    <th scope="col">@lang('Info')</th>
                                @endif
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($withdrawals as $withdraw)
                                <tr>
                                    <td>{{ show_datetime($withdraw->created_at) }}</td>
                                    <td class="font-weight-bold">{{ strtoupper($withdraw->trx) }}</td>
                                    <td><a href="{{route('admin.user.edit', $withdraw->user_id)}}">{{ $withdraw->user->username }}</a></td>
                                    <td>{{ $withdraw->method->name }}</td>
                                    <td class="budget font-weight-bold">{{ $withdraw->amount +0 }} {{$gnl->cur_text}}</td>
                                    <td class="budget text-danger">{{$gnl->cur_sym}} {{ formatter_money($withdraw->charge) }}</td>
                                    <td class="budget">{{$gnl->cur_sym}} {{ formatter_money($withdraw->after_charge) }}</td>
                                    <td class="budget">{{ $withdraw->rate +0 }} </td>

                                    <td class="budget font-weight-bold">{{ formatter_money($withdraw->final_amount) }} {{ $withdraw->currency }} </td>
                                    @if(request()->routeIs('admin.withdraw.pending'))
                                        <td>
                                            @php
                                                 $details = json_encode($withdraw->detail);
                                            @endphp

                                            <button class="btn btn-primary viewBtn" data-detail="{{$details}}" data-amount="{{ formatter_money($withdraw->final_amount) }} {{$withdraw->currency}}" data-method="{{$withdraw->method->name}}"><i class="fa fa-fw fa-desktop"></i></button>
                                            <button class="btn btn-success approveBtn"  data-id="{{ $withdraw->id }}" data-amount="{{ formatter_money($withdraw->final_amount) }} {{$withdraw->currency}}"><i class="fa fa-fw fa-check"></i></button>
                                            <button class="btn btn-danger rejectBtn" data-id="{{ $withdraw->id }}" data-amount="{{ formatter_money($withdraw->final_amount) }} {{$withdraw->currency}}"><i class="fa fa-fw fa-ban"></i></button>


                                        </td>
                                    @elseif(request()->routeIs('admin.withdraw.log') || request()->routeIs('admin.withdraw.search') || request()->routeIs('admin.users.withdrawals'))
                                        <td>
                                            @if($withdraw->status == 2)
                                                <span class="badge bg-warning">@lang('Pending')</span>
                                            @elseif($withdraw->status == 1)
                                                <span class="badge bg-success">@lang('Approved')</span>
                                            @elseif($withdraw->status == 3)
                                                <span class="badge bg-danger">@lang('Rejected')</span>
                                            @endif
                                        </td>
                                    @endif


                                    @if(request()->routeIs('admin.withdraw.approved') || request()->routeIs('admin.withdraw.rejected'))
                                        @php
                                            $details = json_encode($withdraw->detail);
                                        @endphp
                                        <td>
                                            <button class="btn btn-primary detailsBtn" data-detail="{{$details}}" data-amount="{{ formatter_money($withdraw->final_amount) }} {{$withdraw->currency}}" data-method="{{$withdraw->method->name}}" data-admin_details="{{$withdraw->admin_feedback}}"><i class="fa fa-fw fa-desktop"></i></button>
                                        </td>
                                    @endif
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-muted text-center" colspan="100%">{{ $empty_message }}</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>


                    </div>
                    {{ $withdrawals->links() }}
                </div>
            </div>
        </div>
    </div>



    {{-- Details MODAL --}}
    <div id="detailsModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('View Withdraw Details')</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>@lang('Request of ') <span class="font-weight-bold withdraw-amount">-</span> @lang('via') <span class="font-weight-bold withdraw-method">-</span></p>
                    <p class="withdraw-detail"></p>
                    <p class="mt-3"> @lang('ADMIN RESPONSE WAS'): <br> <span class="admin-detail"></span></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-bs-dismiss="modal">@lang('Close')</button>
                </div>
            </div>
        </div>
    </div>

    {{-- View MODAL --}}
    <div id="viewModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('View Withdraw Information')</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>@lang('Please Send') <span class="font-weight-bold withdraw-amount">-</span> @lang('via') <span class="font-weight-bold withdraw-method">-</span> @lang('to') :</p>
                    <p class="withdraw-detail"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" data-bs-dismiss="modal">@lang('Close')</button>
                </div>
            </div>
        </div>
    </div>
    {{-- APPROVE MODAL --}}
    <div id="approveModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Approve Withdrawal Confirmation')</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.withdraw.approve') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id">
                    <div class="modal-body">
                        <p>@lang('Have you Sent ')<span class="font-weight-bold withdraw-amount text-success"></span>?</p>
                        <p class="withdraw-detail"></p>
                        <textarea name="details" class="form-control pt-3" rows="3" placeholder="Provide the Details. eg: Transaction number" required=""></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning" data-bs-dismiss="modal">@lang('Close')</button>
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
                    <h5 class="modal-title">@lang('Reject Withdrawal Confirmation')</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.withdraw.reject') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id">
                    <div class="modal-body">
                        <strong>@lang('Reason of Rejection')</strong>
                        <textarea name="details" class="form-control pt-3" rows="3" placeholder="Provide the Details" required=""></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning" data-bs-dismiss="modal">@lang('Close')</button>
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
            modal.modal('show');
        });

        $('.rejectBtn').on('click', function() {
            var modal = $('#rejectModal');
            modal.find('input[name=id]').val($(this).data('id'));
            modal.find('.withdraw-amount').text($(this).data('amount'));
            modal.modal('show');
        });

        $('.viewBtn').on('click', function() {
            var modal = $('#viewModal');
            modal.find('.withdraw-amount').text($(this).data('amount'));
            modal.find('.withdraw-method').text($(this).data('method'));
            var details =  Object.entries($(this).data('detail'));

            var list = [];
            details.map( function(item,i) {
                list[i] = ` <li class="list-group-item">${item[0]} : ${item[1]}</li>`
            });
            modal.find('.withdraw-detail').html(list);
            modal.modal('show');
        });

        $('.detailsBtn').on('click', function() {
            var modal = $('#detailsModal');
            modal.find('.withdraw-amount').text($(this).data('amount'));
            modal.find('.withdraw-method').text($(this).data('method'));
            var details =  Object.entries($(this).data('detail'));
            var list = [];
            details.map( function(item,i) {
                list[i] = ` <li class="list-group-item">${item[0].replace('_'," ")} : ${item[1]}</li>`
            });
            modal.find('.withdraw-detail').html(list);
            modal.find('.admin-detail').text($(this).data('admin_details'));
            modal.modal('show');
        });
    </script>
@endpush
