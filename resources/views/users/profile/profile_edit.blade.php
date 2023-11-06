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

<div class="container-fluid">

    <div class="partners">
        <h3 class="main-title">{{ $page_title }}</h3>
        <div class="row mb-30-none">
            <div class="col-lg-10 mb-30">
                <div class="create_wrapper mw-100">
                    <h5 class="subtitle">Personal Info</h5>
                    <form class="create_ticket_form row mb-30-none" action="{{route('user.profile.update')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        {{method_field('put')}}

                    <div class="d-flex align-items-center mb-30">
                        <div class="update_user">
                            @if (auth()->user()->avatar != null)
                            <img   src="{{asset('assets/images/users/' . auth()->user()->avatar)}}" alt="">
                        @else
                            <img  src="{{asset('assets/images/user.png')}}" alt="">
                        @endif
                        </div>
                        <div class="pl-3">
                            <label for="update_profile" class="custom-button m-0 mt-2 lh-40 h-40">Browse Image</label>
                            <input type="file" id="update_profile" class="profile_update_input" name="avatar" accept="image/*">
                        </div>
                    </div>
                        <div class="create_form_group col-sm-12">
                            <label for="account_name">Full Name:</label>
                            <input type="text" name="name" id="account_name" value="{{auth()->user()->name}}" placeholder="enter first name" required>
                        </div>
                        <div class="create_form_group col-sm-12">
                            <label for="full_name">Username:</label>
                            <input type="text" id="full_name"  value="{{auth()->user()->username}}"readonly>
                        </div>
                        <div class="create_form_group col-sm-12">
                            <label for="account_email">Email Address:</label>
                            <input type="text" id="account_email" value="{{auth()->user()->email}}" readonly>
                        </div>
                        <div class="create_form_group col-sm-12">
                            <label for="account_mobile">Mobile No:</label>
                            <input type="text" id="account_mobile" value="{{auth()->user()->phone}}" placeholder="Enter your Mobile No">
                        </div>
                        <div class="create_form_group col-sm-12">
                            <label for="account_address">Address:</label>
                            <input type="text" id="account_address" name="address" value="{{auth()->user()->address->address}}" placeholder="Enter Address">
                        </div>
                        <div class="create_form_group col-sm-6">
                            <label for="account_city">City:</label>
                            <input type="text" id="account_city" name="city" value="{{auth()->user()->address->city}}" placeholder="Enter your City">
                        </div>
                        <div class="create_form_group col-sm-6">
                            <label for="account_state">State</label>
                            <input type="text" id="account_state" name="state" value="{{auth()->user()->address->state}}" placeholder="Enter your State">
                        </div>
                        <div class="create_form_group col-sm-6">
                            <label for="country_name">Country:</label>
                            <select name="country">
                                @include('partials.country')
                            </select>
                        </div>
                        <div class="create_form_group col-sm-6">
                            <label for="zip">Zip:</label>
                            <input type="text" id="zip" name="zip" value="{{auth()->user()->address->zip}}" placeholder="Enter your Zip">
                        </div>
                        <div class="create_form_group col-sm-12 align-self-end">
                            <button type="submit" class="custom-button border-0">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
@push('js')
    <script>
        $("select[name=country]").val("{{ auth()->user()->address->country }}");
    </script>
@endpush
