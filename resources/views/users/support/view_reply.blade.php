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
                    <div class="partners">
                        <div class="row mb-30-none">
                            <div class="col-lg-12">
                                <div class="create_wrapper mw-100">
                                    <h5 class="subtitle">{{ $page_title }}</h5>
                                    @if($ticket_object->status != 9)
                                    <form class="create_ticket_form row " action="{{route('user.store.customer.reply', $ticket_object->ticket)}}" method="post" enctype="multipart/form-data">
                                        @csrf

                                        <div class="create_form_group col-sm-12">
                                            <label for="message">Message *</label>
                                            <textarea rows="2" name="message" placeholder="Message"></textarea>
                                        </div>
                                        <div class="col-md-12">
                                            <button class="btn btn-primary btn-block"  type="submit">@lang('Send Message')</button>
                                        </div>
                                    </form>
                                    @else
                                    <button class="btn btn-primary btn-block"  type="button">@lang('Closed')</button>
                                @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">

                                @foreach($ticket_data as $data)
                                    @if($data->type != 1)
                                    <div class="col-xl-12">

                                        <div class="col-lg-8">
                                            <div class="progress-wrapper mb-30">
                                                <div class="d-flex flex-wrap m-0-15-20-none">
                                                    <div class="circle-item">
                                                        <div class="update_user">
                                                            <img src="{{asset('assets/images/logo/' . $gnl->logo)}}" alt="">
                                                        </div>
                                                    </div>
                                                    <div class="circle-item">
                                                        <span class="level">Admin</span>
                                                        <span class="bold cl-white">{{ $data->comment }}</span>
                                                    </div>
                                                    <div class="circle-item">
                                                        <span class="level">{{\Carbon\Carbon::parse($data->created_at)->diffForHumans()}}</span>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @else
                                <div class="col-xl-12">
                                    <div class="col-lg-8 float-right">
                                        <div class="progress-wrapper mb-30">
                                            <div class="d-flex flex-wrap m-0-15-20-none">
                                                <div class="circle-item">
                                                    <div class="update_user">
                                                    @if (auth()->user()->avatar != null)
                                                        <img src="{{asset('assets/images/users/' . auth()->user()->avatar)}}" alt="">
                                                    @else
                                                        <img src="{{asset('assets/images/user.png')}}" alt="">
                                                    @endif
                                                    </div>
                                                </div>
                                                <div class="circle-item">
                                                    <span class="level">{{auth()->user()->name}}</span>
                                                    <span class="bold cl-white">{{ $data->comment }}</span>
                                                </div>
                                                <div class="circle-item">
                                                    <span class="level">{{\Carbon\Carbon::parse($data->created_at)->diffForHumans()}}</span>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                    @endif
                                @endforeach
                    </div>
                </div>

@endsection
