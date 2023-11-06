@extends('frontend.master')
@section('content')
<div class="account-section bg_img" data-background="{{ asset('assets/frontend/images/account-bg.jpg') }}">
    <div class="container">
        <div class="account-title text-center">
            <a href="index.html" class="back-home"><i class="fas fa-angle-left"></i><span>Back <span class="d-none d-sm-inline-block">To Hyipland</span></span></a>
            <a href="#0" class="logo">
                <img src="{{ asset('assets/frontend/images/logo/footer-logo.png') }}" alt="logo">
            </a>
        </div>
        <div class="account-wrapper">
            <div class="account-header">
                <h4 class="title">Let's get started</h4>
            </div>
            <div class="account-body">
                    @if (session()->has('message'))
                    <div class="alert alert-danger">
                      {{(session()->get('message'))}}
                    </div>

                    @endif

                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                      @endif

                    <form class="account-form" method="POST" action="{{ route('register') }}">
                      @csrf
                      <div class="form-group input-group">


                        <div class="input-group-prepend">
                          <span class="input-group-text"> <i class="fas fa-id-card-alt"></i> </span>
                        </div>
                        <input name="refferal" id="refferal"  class="form-control" placeholder="Referral ID" type="text" value="{{ old('refferal') }}" required>
                      </div>
                      <div>
                          <ul id="search-results"></ul>
                      </div>

                       <div class="form-group input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                        </div>
                        <input id="name" name="name" class="form-control @error('name') is-invalid @enderror" placeholder=" Name" type="text" value="{{ old('name') }}" required>

                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                      </div>
                      <div class="form-group input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
                        </div>
                        <input id="email" name="email" class="form-control " placeholder="Email address" type="email" value="{{ old('email') }}" required>



                      </div>
                      <div>
                          <ul id="search-email"></ul>

                      </div>
                      <div class="form-group input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"> <i class="fas fa-phone-alt"></i> </span>
                        </div>
                        <input name="phone" id="phone" class="form-control " placeholder="Phone Number" type="number" value="{{ old('phone') }}" required>

                      </div>
                      <div>
                          <ul id="search-phone"></ul>

                      </div>

                    <div class="form-group text-center">
                        <button class="mt-2 mb-2 custom-button" type="submit">Sign Up</button>

                    </div>
                </form>
                <span class="d-block mt-15">Already have an account? <a href="{{ route('login') }}">Sign In</a></span>
            </div>
        </div>

    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


<script>
    $(document).ready(function () {
        $('#refferal').on('keyup', function () {
            var query = $(this).val().trim();
           //  console.log(query);
            if (query !== '') {
                $.ajax({
                    url: "{{ route('checkusername') }}",
                    type: 'GET',
                    data: { query: query },
                    success: function (data) {


                     // $("#refferal").val(data.id);


                if (data.username == query ){
                     $("#search-results").html(data.name);
                }
                else{
                    $("#search-results").html(data.status);
                }
               //  console.log(data.id);

                }

                });
            }
        });
    });
</script>
 <script>
   $(document).ready(function () {
       $('#email').on('keyup', function () {
           var query = $(this).val().trim();
          //  console.log(query);
           if (query !== '') {
               $.ajax({
                   url: "{{ route('checkemail') }}",
                   type: 'GET',
                   data: { query: query },
                   success: function (data) {


                    // $("#refferal").val(data.id);


               if (data.status ){
               console.log(data.status);

                    $("#search-email").html('Email already exists');

               }


               else{
                   $("#search-email").html('');
               }
              //  console.log(data.id);

               }

               });
           }
       });
   });
</script>
<script>
   $(document).ready(function () {
       $('#phone').on('keyup', function () {
           var query = $(this).val().trim();
          //  console.log(query);
           if (query !== '') {
               $.ajax({
                   url: "{{ route('checkphone') }}",
                   type: 'GET',
                   data: { query: query },
                   success: function (data) {

                    if (data.status ){
                    $("#search-phone").html('Phone already exists');
                   }

               else{
                   $("#search-phone").html('');
               }

               }

               });
           }
       });
   });
</script>
@endsection
