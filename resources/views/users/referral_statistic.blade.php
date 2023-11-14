@extends('users.master')


@section('content')

        <!--=======Banner-Section Starts Here=======-->
        <div class="dashboard-hero-content text-white">
            <h3 class="title">{{ $page_title }}</h3>
            <ul class="breadcrumb">
                <li class="nav-item"><a class="nav-link " href="">Home</a>
                </li>
                <li>
                    {{ $page_title }}
                </li>
            </ul>
        </div>
    </div>
    <div class="container-fluid">
        <div class="partners">

                <h3 class="main-title">Referral Link</h3>
                <div class="referral-group">
                    <div class="refers">
                        <div class="referral-links">
                            <div class="oh">
                                <div class="referral-left">
                                    <span class="left-icon">
                                        <i class="fas fa-link"></i>
                                    </span>
                                    <h6>Referral Link:</h6>
                                    <div class="copy-button">
                                        <a href="#0"  class="nav-link custom-button" id="copy">Copy Link</a>
                                    </div>
                                    <input type="text" id="copyLinks" readonly value="{{route('register') . '?ref=' . auth()->user()->username}}">
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>




        <div class="partners  ">
            <div class=" justify-content-center row ">

                <div class="col-lg-10 mb-30">

                    <div class="create_wrapper mw-100">

                        <h5 class="subtitle">Referral Statistic </h5>
                        <div class="row">

                        <div class="col-md-4">
                            <div class="earn-thumb">
                                <img src="{{ asset('assets/frontend/images/dashboard/earn/03.png') }}" alt="dashboard-earn">
                            </div>
                        </div>

                            <div class="col-md-8">
                            <ul >
                                <li>
                                  <h5> {{ $user->name }}</h5>
                                </li>
                            </ul>

                                <ul >
                                    @foreach($user->children as $child)
                                        <li class="m-3">
                                            {{ $child->name }}
                                            @if(count($child->children))
                                                @include('manageChild',['children' => $child->children])
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection



{{-- @section('content')
    <div class="col-xl-9 col-lg-9 col-md-9 col-sm-12">
        <div class="card mb-30">
            <div class="card-header">
               @lang('Referral Link')
            </div>
        </div>
        <div class="refferal-link cl-white centered">
            <form>
                <input type="text" class="blue-bg" id="myInput"
                       value="{{route('register') . '?ref=' . auth()->user()->username}}" readonly>
                <button type="button" onclick="myFunction()" data-toggle="tooltip" data-placement="top" title=""
                        data-original-title="Copy the link"><i class="fa fa-files-o"></i></button>
            </form>
            <p><i class="fa fa-info-circle"></i>@lang('Share this link with your friends')</p>
        </div>
        <div class="card mb-30">
            <div class="card-header">
               @lang('Referral Statistic')
            </div>
            <div class="card-body">
                <div class="part-text ">
                    <ul>
                        <li > {{auth()->user()->username}}</li>
                    </ul>
                    <div class="clt">

                        <ul>
                            <li>
                                {{(auth()->id())}}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>


    </div>

@endsection

@push('js')
    <script>
        function myFunction() {
            /* Get the text field */
            var copyText = document.getElementById("myInput");

            /* Select the text field */
            copyText.select();
            copyText.setSelectionRange(0, 99999); /*For mobile devices*/

            /* Copy the text inside the text field */
            document.execCommand("copy");

            /* Alert the copied text */
            alert("Copied the link: " + copyText.value);
        }
    </script>



@endpush --}}
