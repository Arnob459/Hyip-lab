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
<div class="container-fluid ">
    <div class="partners">
        <h3 class="main-title">{{ $page_title }}</h3>
        <div class="row mb-30-none justify-content-center">
            <div class="col-lg-8 mb-30">
                <div class="create_wrapper mw-100">
                    <a class="float-right" href="{{route('user.profile.edit')}}" ><i class="fa fa-edit"></i></a>

                    <h5 class="subtitle">Profile Info</h5>

                    <div class="d-flex align-items-center mb-30">
                        <div class="update_user">
                            @if (auth()->user()->avatar != null)
                            <img   src="{{asset('assets/images/users/' . auth()->user()->avatar)}}" alt="">
                        @else
                            <img  src="{{asset('assets/images/user.png')}}" alt="">
                        @endif
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-sm-3 col-5">
                            <div class="left-info ">
                                <p>Name :</p>
                                <p>Username :</p>
                                <p>Email :</p>
                                <p>Mobile Number :</p>
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
    </div>

    <div class="partners">
        <div class="row mb-30-none justify-content-center">
            <div class="col-lg-8 mb-30">
                <div class="create_wrapper mw-100">
                    <a class="float-right" href="{{route('user.change.password')}}" ><i class="fa fa-edit"></i></a>

                    <h5 class="subtitle">Security</h5>
                    <div class="row">
                        <div class="col-sm-3 col-5">
                            <div class="left-info ">
                                <p>Password :</p>
                                <p>2FA Security :</p>
                            </div>
                        </div>
                        <div class="col-sm-9 col-7">
                            <div class="right-info">
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
    </div>

    <div class="partners">
        <div class="row mb-30-none justify-content-center">
            <div class="col-lg-8 mb-30">
                <div class="create_wrapper mw-100">
                    <a class="float-right" href="{{route('user.profile.edit')}}" ><i class="fa fa-edit"></i></a>

                    <h5 class="subtitle">Account Info</h5>
                    <div class="row">
                        <div class="col-sm-3 col-5">
                            <div class="left-info ">
                                <p>Account Status :</p>
                                <p>Address :</p>
                                <p>City :</p>
                                <p>State :</p>
                                <p>Zip :</p>
                                <p>Country :</p>
                            </div>
                        </div>
                        <div class="col-sm-9 col-7">
                            <div class="right-info">
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

</div>


@endsection
