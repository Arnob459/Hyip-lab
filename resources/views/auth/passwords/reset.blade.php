@extends('frontend.master')
@section('content')
    <!--============= Sign In Section Starts Here =============-->
    <div class="account-section bg_img" data-background="{{ asset('assets/frontend/images/account-bg.jpg') }}">
        <div class="container">
            <div class="account-title text-center">
                <a href="{{ route('index') }}" class="back-home nav-link"><i class="fas fa-angle-left"></i><span>Back <span class="d-none d-sm-inline-block">To {{ $gnl->site_name }}</span></span></a>
                <a href="{{ route('index') }}" class="logo">
                    <img src="{{asset('assets/images/logo/'. $gnl->logo )}}" alt="logo">
                </a>
            </div>
            <div class="account-wrapper">
                <div class="account-body">
                    <h4 class="title mb-20">Enter Your Email</h4>

                    <form class="account-form" action="{{ route('user.password.update.now') }}" method="post">
                        @csrf

                        <input type="hidden" name="email" value="{{ $email }}">
                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="row">
                            <div class="form-group">
                                <input type="password" class="form-control" name="password" placeholder="@lang('password')" required>
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" name="password_confirmation" placeholder="@lang('password confirmation')" required>
                            </div>
                            <div class=" form-group text-center">
                                <button type="submit" id="recaptcha" class="mt-2 mb-2">@lang('Reset Password')</button>
                            </div>
                            <div class="form-group ">
                                <p><a class="nav-link" href="{{route('login')}}">@lang('Back to login')</a></p>
                            </div>
                        </div>
                    </form>

                </div>

            </div>
        </div>
    </div>
@endsection
