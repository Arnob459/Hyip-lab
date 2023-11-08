@extends('users.master')

@section('content')
        <div class="dashboard-inner-content">
            <div class="card">
                <h5 class="card-header">{{$page_title}}</h5>
                <div class="card-body">
                    <form action="{{route('user.withdraw.submit', $withdrawMethod->id)}}" method="post">
                        @csrf
                        <input type="hidden" name="method_code" value="{{$withdrawMethod->method_code}}">
                        <input type="hidden" name="currency" value="{{$withdrawMethod->currency}}">
                        <input type="hidden" class="fixed_charge" value="{{formatter_money($withdrawMethod->fixed_charge)}}">
                        <input type="hidden" id="percent_charge" value="{{$withdrawMethod->percent_charge+0}}">
                        <input type="hidden" class="min_amount" value="{{formatter_money($withdrawMethod->min_limit)}}">
                        <input type="hidden" class="max_amount" value="{{formatter_money($withdrawMethod->max_limit)}}">
                        <input type="hidden" class="rate" value="{{$withdrawMethod->rate+0}}">
                        <div class="row">
                            <div class="col-xl-6 col-lg-6">
                                <label for="a-trans">@lang('Withdraw Amount')</label>
                                <input type="text" class="amount" name="amount" placeholder="enter amount"
                                       onkeyup="this.value = this.value.replace (/^\.|[^\d\.]/g, '')" required>
                            </div>
                            <div class="col-xl-6 col-lg-6">
                                <label id="limit_label">@lang('Limit') : {{$gnl->cur}}</label>
                                <input type="text" style="border: 2px red" id="limit" readonly="readonly" value="{{formatter_money($withdrawMethod->min_limit)}} - {{formatter_money($withdrawMethod->max_limit)}} {{$gnl->cur}}">
                                <code class="limit"></code>
                            </div>
                            <div class="col-xl-6 col-lg-6">
                                <label
                                    for="charge">@lang('Charge'): {{formatter_money($withdrawMethod->fixed_charge)}} {{$gnl->cur}}
                                    + {{$withdrawMethod->percent_charge+0}} %</label>
                                <input type="text" readonly="readonly" value="0" id="charge">
                            </div>
                            <div class="col-xl-6 col-lg-6">
                                <label for="payAmount">@lang('Amount After Charge') : {{$gnl->cur}}</label>
                                <input type="text" value="0" id="payAmount" readonly="readonly">
                            </div>
                            <div class="col-xl-6 col-lg-6">
                                <label for="chargedfffffg">@lang('Conversion Rate'): <code>(@lang('site currency = method currency'))</code></label>
                                <input type="text" readonly="readonly"
                                       value="1 {{$gnl->cur}} = {{$withdrawMethod->rate+0}} {{$withdrawMethod->currency }}"
                                       id="chargedfffffg">
                            </div>
                            <div class="col-xl-6 col-lg-6">
                                <label>@lang('You Will Get') {{$withdrawMethod->currency }}  </label>
                                <input type="text" value="0" id="payRate" readonly="readonly">
                            </div>

                            <div class="col-xl-12 col-lg-12">
                                <label id="balance_limit_label">@lang('You Bonus Balance Will Be') : {{$gnl->cur}} </label>
                                <input type="text" value="{{formatter_money(auth()->user()->interest_balance)}}"
                                       id="afterBalance" readonly="readonly">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="text-center mb-4">@lang('Please follow the instruction bellow')</h4>
                                <p class="my-4 text-center">@php echo  $withdrawMethod->description @endphp</p>
                                <p class="text-center mt-3 font-weight-bold">@lang('Processing Time : ') @php echo  $withdrawMethod->delay @endphp</p>
                            </div>
                            @foreach(json_decode($withdrawMethod->user_data) as $input)
                                <div class="col-md-12">
                                    <label for="a-trans" class="font-weight-bold">{{__($input)}}</label>
                                    <input type="text" name="ud[{{str_slug($input) }}]" placeholder="{{ __($input) }}"
                                           required>
                                </div>
                            @endforeach
                        </div>
                        <div class="col-xl-12 col-lg-12 col-md-12 text-center">
                            <button class="btn btn-warning" id="myBtn" type="submit">@lang('Withdraw')</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

@endsection

@push('js')
    <script>
        $(function () {
            $('.amount').keyup(function () {
                var min = parseFloat($('.min_amount').val()) || 0;
                var max = parseFloat($('.max_amount').val()) || 0;
                var amount = parseFloat($('.amount').val()) || 0;
                var rate = ($('.rate').val()) || 0;

                var balance = parseFloat({{formatter_money(auth()->user()->interest_balance)}}) || 0;
                var fix_charge = parseFloat($('.fixed_charge').val()) || 0;
                var percent_charge = parseFloat($('#percent_charge').val()) || 0;
                var percent = (amount * percent_charge / 100);
                var charge = fix_charge + percent;
                var payAmount = amount - charge;
                var payRate = payAmount * rate;
                var afterBalance = balance - amount;
                $('#charge').val(charge.toFixed(2));
                $('#payAmount').val(payAmount.toFixed(2));
                $('#payRate').val(payRate.toFixed(2));
                $('#afterBalance').val(afterBalance.toFixed(2));

                if (amount > max || amount < min) {
                    $('#limit').removeClass().addClass('error');
                    $('#limit_label').removeClass().addClass('error-label');
                    $('#myBtn').attr("disabled", true);
                    if (amount > balance) {
                        $('#afterBalance').removeClass().addClass('error');
                        $('#balance_limit_label').removeClass().addClass('error-label');
                        $('#myBtn').attr("disabled", true);
                    } else {
                        $('#afterBalance').removeClass();
                        $('#balance_limit_label').removeClass();
                        $('#myBtn').attr("disabled", false);
                    }

                } else {
                    $('#limit').removeClass();
                    $('#limit_label').removeClass();
                    if (amount > balance) {
                        $('#afterBalance').removeClass().addClass('error');
                        $('#balance_limit_label').removeClass().addClass('error-label');
                        $('#myBtn').attr("disabled", true);
                    } else {
                        $('#afterBalance').removeClass();
                        $('#balance_limit_label').removeClass();
                        $('#myBtn').attr("disabled", false);
                    }
                }
            });
        });
    </script>

@endpush
