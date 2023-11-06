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
<br>

<div class="container-fluid text-white">
    <div class="col-lg-12">
        <div class="progress-wrapper mb-30">
            <h4 class="title text-white">@lang('Profile Info')</h4>  <a class="nav-link" href="{{route('user.profile.edit')}}" ><i class="fa fa-edit"></i></a>

            <div class="d-flex d-flex justify-content-center row mb-30-none">

                <div class="row">
                    <div class="col-sm-6 mb-2">
                        <div class="update_user">
                            @if (auth()->user()->avatar != null)
                                <img   src="{{asset('assets/images/users/' . auth()->user()->avatar)}}" alt="">
                            @else
                                <img  src="{{asset('assets/images/user.png')}}" alt="">
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3 col-5">
                        <div class="left-info ">
                            <p>@lang('Name') :</p>
                            <p>@lang('Username') :</p>
                            <p>@lang('Email') :</p>
                            <p>@lang('Mobile Number') :</p>
                        </div>
                    </div>
                    <div class="col-sm-9 col-7">
                        <div class="right-info">
                            <p>{{auth()->user()->fullname}}</p>
                            <p>{{auth()->user()->username}}</p>
                            <p>{{auth()->user()->email}}</p>
                            <p>{{auth()->user()->mobile}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="progress-wrapper mb-30">
            <h4 class="title text-white">@lang('Security ')</h4>

            <div class="d-flex d-flex justify-content-center row mb-30-none">


                <div class="row">
                    <div class="col-sm-3 col-5">
                        <div class="left-info ">
                            <p>@lang('Password') :</p>
                            <p>@lang('2FA Security') :</p>
                        </div>
                    </div>
                    <div class="col-sm-9 col-7">
                        <div class="right-info cl-white">
                            <p>*************</p>
                            @if (auth()->user()->ts == 1)
                                <p><i class="fa fa-stop cl-green"></i> @lang('on')</p>
                                @else
                                <p><i class="fa fa-stop cl-red"></i> @lang('Off')</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="progress-wrapper mb-30">
            <h4 class="title text-white">@lang('Account Info ')</h4>

            <div class="d-flex d-flex justify-content-center row mb-30-none">

                <div class="row">
                    <div class="col-sm-3 col-5">
                        <div class="left-info ">
                            <p>@lang('Account Status') :</p>
                            <p>@lang('Address') :</p>
                            <p>@lang('City') :</p>
                            <p>@lang('State') :</p>
                            <p>@lang('Zip') :</p>
                            <p>@lang('Country') :</p>
                        </div>
                    </div>
                    <div class="col-sm-9 col-7">
                        <div class="right-info ">
                            <p><i class="fa fa-dot-circle-o cl-green"></i> @lang('Active')</p>
                            <p>{{auth()->user()->address->address?? 'N/A'}}</p>
                            <p>{{auth()->user()->address->city}}</p>
                            <p>{{auth()->user()->address->state}}</p>
                            <p>{{auth()->user()->address->zip}}</p>
                            <p>{{auth()->user()->address->country}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
