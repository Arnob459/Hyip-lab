
@extends('users.master')

@section('content')




        <!--=======Offer-Section Stars Here=======-->
        <section class="offer-section padding-top padding-bottom">

            <div class="container text-white mb-3">
                <h3 class="title text-white">{{ $page_title }}</h3>
                <ul class="breadcrumb">
                    <li class="nav-item"><a class="nav-link " href="">Home</a></li>

                    <li> {{ $page_title }} </li>
                </ul>
            </div>

            <div class="ball-group-1" data-paroller-factor="-0.30" data-paroller-factor-lg="0.60"
            data-paroller-type="foreground" data-paroller-direction="horizontal">
                <img src="{{ asset('assets/frontend/images/balls/ball-group1.png') }}" alt="balls">
            </div>
            <div class="ball-group-2" data-paroller-factor="0.30" data-paroller-factor-lg="-0.30"
            data-paroller-type="foreground" data-paroller-direction="horizontal">
                <img src="{{ asset('assets/frontend/images/balls/ball-group2.png') }}" alt="balls">
            </div>

            <div class="container">


                <div class="offer-wrapper">

                    @foreach ($plans as $plan)

                    <div class="offer-item">
                        <div class="offer-header">
                            <div class="item-thumb">
                                @if($plan->fixed_amount != 0)
                               <h5 class="title">  Invest:{{  $gnl->cur_sym  }}  {{formatter_money($plan->fixed_amount)}} </h5>

                               @else
                               <h5 class="title">  Min:{{ $gnl->cur_sym }}   {{formatter_money($plan->minimum_amount)}} - Max:{{  $gnl->cur_sym  }}  {{formatter_money($plan->maximum_amount)}} </h5>

                                @endif
                                @if ($plan->capital_back == 1)
                                <span><b>@lang('Capital Will Return Back')</b></span>
                                @endif
                            </div>
                        </div>
                        <div class="offer-body">
                            <span class="bal-shape"></span>
                            <div class="item first">
                                <div class="item-thumb ">
                                    <img src="{{ asset('assets/images/plan/'.$plan->image) }}" alt="offer">
                                </div>
                                <h5 class="title">{{ $plan->plan_name }}</h5>

                            </div>
                            <span class="bal-shape"></span>
                            <div class="item">
                                <div class="item-thumb">
                                   <h5>{{$plan->interest}} @if ($plan->interest_status == 1)
                                    % @else {{$gnl->cur}}
                                    @endif</h5>
                                </div>
                                <div class="item-content">
                                    <h5 class="subtitle"> {{$plan->times}} / @if ($plan->lifetime == 1) @lang('Lifetime') @else
                                        {{$plan->repeat_time}} @lang('Times')
                                    @endif </h5>
                                    <br>
                                    <h5 class="title">24/7 Support</h5>
                                </div>
                            </div>

                        </div>
                        <div class="offer-footer">
                            <button type="button"  class="custom-button" data-bs-toggle="modal" data-bs-target="#invest-{{$plan->id}}"  >@lang('Invest now')</button>
                        </div>
                    </div>




                    <div class="modal fade"  id="invest-{{$plan->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="false">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">@lang('Confirm investment in') {{$plan->plan_name}}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <span class="text-center">
                                             @if ($plan->fixed_amount != 0)
                                                <h4 >@lang('Invest') : {{formatter_money($plan->fixed_amount)}} {{$gnl->cur}} </h4>
                                            @else
                                                <h4 >@lang('Limit') : {{formatter_money($plan->minimum_amount)}} - {{formatter_money($plan->maximum_amount)}} {{$gnl->cur}} </h4>
                                        @endif
                                                <h5>@lang('Bonus') : {{$plan->interest}} @if ($plan->interest_status == 1)
                                                        % @else {{$gnl->cur}}
                                                    @endif </h5>

                                                 <p>{{$plan->times}} / @if ($plan->lifetime == 1) @lang('Lifetime') @else
                                                         {{$plan->repeat_time}} @lang('Times')
                                                     @endif</p>

                                        </span>

                                    <form method="post" action="{{route('user.plan.invest', $plan->id)}}">
                                        @csrf
                                        <div class="form-group mt-3">
                                            <label for="recipient-name" class="col-form-label">@lang('Select Wallet'):</label>
                                            <select class="form-control form-control-lg" name="wallet">
                                                <option value="0">@lang('Deposit wallet') ({{formatter_money(auth()->user()->balance)}})</option>
                                                <option value="1">@lang('Bonus wallet') ({{formatter_money(auth()->user()->interest_balance)}})</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="message-text" class="col-form-label">@lang('Amount'):</label>
                                            @if ($plan->fixed_amount != 0)
                                                <div class="input-group mb-2">
                                                    <input type="text" class="form-control form-control-lg" name="amount" value="{{formatter_money($plan->fixed_amount)}}" readonly  >
                                                    <div class="input-group-append">
                                                        <div class="input-group-text">{{$gnl->cur}}</div>
                                                    </div>
                                                </div>

                                            @else
                                                <div class="input-group mb-2">
                                                    <input type="text" class="form-control form-control-lg" name="amount" value=""  placeholder="@lang('amount')">
                                                    <div class="input-group-append">
                                                        <div class="input-group-text">{{$gnl->cur}}</div>
                                                    </div>
                                                </div>
                                            @endif

                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="custom-button">@lang('Invest')</button>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>

                    @endforeach


                </div>

            </div>

        </section>

@endsection
