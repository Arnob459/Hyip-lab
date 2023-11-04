
@extends('admin.layouts.master')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{$page_title}}  </h4>
                </div>
                <div class="card-body ">
                    <div class="table-responsive  ">
                        <table  class="display table  table-hover" >
                            <thead>
                            <tr>
                                <th scope="col">@lang('Date')</th>
                                <th scope="col">@lang('TRX')</th>
                                <th scope="col">@lang('Username')</th>
                                <th scope="col">@lang('Amount')</th>
                                <th scope="col">@lang('Charge')</th>
                                <th scope="col">@lang('Balance')</th>
                                <th scope="col">@lang('Wallet')</th>
                                <th scope="col">@lang('Detail')</th>
                            </tr>
                            </thead>

                            <tbody>
                            @forelse($transactions as $trx)
                                <tr>
                                    <td>{{ show_datetime($trx->created_at) }}</td>
                                    <td class="font-weight-bold">{{ strtoupper($trx->trx) }}</td>
                                    <td><a href="{{ route('admin.user.edit', $trx->user->id) }}">{{ $trx->user->username }}</a></td>

                                    <td class="budget">
                                        <strong @if($trx->trx_type == '+') class="text-success" @else class="text-danger" @endif> {{($trx->trx_type == '+') ? '+':'-'}} {{formatter_money($trx->amount)}} {{$gnl->cur}}</strong>
                                    </td>
                                    <td class="budget">{{ $gnl->cur_sym}} {{ formatter_money($trx->charge) }}</td>
                                    <td>{{ $gnl->cur_sym}} {{ $trx->post_balance +0 }}</td>
                                    <td> @if ($trx->type == 1)
                                            <span class="badge  small bg-light-info">@lang('deposit wallet')</span>
                                        @else
                                            <span class="badge small bg-light-warning">@lang('interest wallet')</span>
                                        @endif</td>
                                    <td>{{ $trx->details }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-muted text-center" colspan="100%">{{ $empty_message }}</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>


                    </div>
                    {{ $transactions->links() }}
                </div>
            </div>
        </div>
    </div>


@endsection
