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
        <div class="row mb-30-none justify-content-center">

            <div class="col-lg-6 mb-30">
                <div class="create_wrapper mw-100">
                    <form class="create_ticket_form row mb-30-none" action="{{route('user.password.update')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            {{method_field('put')}}
                        <div class="create_form_group col-sm-12">
                            <label for="old_pass">Old Passowrd:</label>
                            <input type="password" id="old_pass" name="old_password" placeholder="Enter your Old Password" required>
                        </div>
                        <div class="create_form_group col-sm-12">
                            <label for="new_pass">New password::</label>
                            <input type="password" id="new_pass" name="password" placeholder="Enter your new password:" required>
                        </div>
                        <div class="create_form_group col-sm-12">
                            <label for="repeat_pass">Repeat the new password::</label>
                            <input type="password" id="repeat_pass" name="password_confirmation" placeholder="Repeat your new password:" required>
                        </div>
                        <div class="create_form_group col-sm-6 align-self-end">
                            <button type="submit" class="custom-button border-0">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
