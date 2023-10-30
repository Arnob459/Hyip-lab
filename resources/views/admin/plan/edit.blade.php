@extends('admin.layouts.master')

@section('content')


<section class="section">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Edit plan</h4>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.plan.update',$plan->id) }}" method="post" enctype="multipart/form-data"  >
                @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="basicInput">Plan Name</label>
                        <input type="text" name="name" class="form-control form-control-lg" id="basicInput" value="{{ $plan->plan_name }}" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label">Amount Type </label>
                        <div class="selectgroup w-100">
                            <input type="radio" class="btn-check " name="amount_type" id="success-outlined"
                            autocomplete="off"  value="1" {{ $plan->amount_type == '1' ? 'checked' : '' }} onchange="show()" >
                        <label class="btn btn-outline-success " for="success-outlined">Range</label>

                        <input type="radio" class="btn-check" name="amount_type" id="danger-outlined"
                            autocomplete="off"  value="2" {{ $plan->amount_type == '2' ? 'checked' : '' }} onchange="show2()">
                        <label class="btn btn-outline-danger " for="danger-outlined"> Fixed</label>
                        </div>
                    </div>
                </div>
                <div  id="1" style="display: {{ $plan->amount_type == '1' ? 'block' : 'none' }}">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="basicInput">Minimum Amount </label>
                            <div class="input-group mb-3">
                                <input type="text" name="min_amount" class="form-control form-control-lg" value="{{formatter_money($plan->minimum_amount)  }}"
                                    aria-label="min_amount" aria-describedby="basic-addon1" >
                                <span class="input-group-text" id="basic-addon1">{{ $gnl->cur_sym }}</span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label for="basicInput">Maximum Amount </label>
                            <div class="input-group mb-3">
                                <input type="text" name="max_amount" class="form-control form-control-lg" value="{{ formatter_money($plan->maximum_amount) }}"
                                    aria-label="max_amount" aria-describedby="basic-addon1" >
                                <span class="input-group-text" id="basic-addon1">{{ $gnl->cur_sym }}</span>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row" id="2" style="display: {{ $plan->amount_type == '2' ? 'block' : 'none' }}">
                    <div class="col-md-6" >
                        <label for="basicInput">Fixed Amount </label>
                        <div class="input-group mb-3" >
                            <input type="text"  name="fixed_amount" class="form-control form-control-lg" value="{{formatter_money($plan->fixed_amount)  }}"
                                aria-label="Username" aria-describedby="basic-addon1">
                            <span class="input-group-text" id="basic-addon1">{{ $gnl->cur_sym }}</span>
                        </div>
                    </div>
                </div>

                <div class=" col-md-6">
                    <div class="form-group">
                        <label for="iconSelector">Time </label>
                        <div class="col-sm-10">
                            <select id="iconSelector" class="form-select " name="times" required>
                            <option value="">Select Times</option>
                            <option value="Hourly"{{ $plan->times == 'Hourly' ? 'selected':'' }} >Hourly</option>
                            <option value="Daily"{{ $plan->times == 'Daily' ? 'selected':'' }} >Daily</option>
                            <option value="Weekly"{{ $plan->times == 'Weekly' ? 'selected':'' }} >Weekly</option>
                            <option value="Monthly"{{ $plan->times == 'Monthly' ? 'selected':'' }} >Monthly</option>
                            <option value="Yearly"{{ $plan->times == 'Yearly' ? 'selected':'' }} >Yearly</option>

                            </select>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <label for="basicInput"> Return /Interest </label>
                    <div class="input-group mb-3">
                        <input type="text" name="interest" class="form-control form-control-lg" value="{{ $plan->interest }}" required>
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <select name="interest_status">
                                        <option value="1"{{ $plan->interest_status == '1' ? 'selected':'' }} >%</option>
                                        <option value="0"{{ $plan->interest_status == '0' ? 'selected':'' }} >{{$gnl->cur_sym}}</option>

                                    </select>
                                </div>
                            </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-label">Return Interest</label>
                        <div class="selectgroup w-100">
                            <input type="radio" class="btn-check " name="return_interest" id="lifetime"
                            autocomplete="off" value="1" {{ $plan->lifetime == '1' ? 'checked' : '' }}  onchange="show3()"  >
                        <label class="btn btn-outline-success  " for="lifetime">Lifetime</label>

                        <input type="radio" class="btn-check" name="return_interest" id="timewise"
                            autocomplete="off" value="3" {{ $plan->lifetime == '3' ? 'checked' : '' }} onchange="show4()" >
                        <label class="btn btn-outline-danger  "  for="timewise"> Timewise</label>
                        </div>
                    </div>
                </div>

                <div  id="3" class="col-md-4" style="display: {{ $plan->lifetime == '3' ? 'block' : 'none' }}">
                            <label for="basicInput">Return Times </label>
                            <div class="input-group mb-3">
                                <input type="text" name="repeat_time" class="form-control form-control-lg" value="{{ $plan->repeat_time }}" >
                                <span class="input-group-text" id="basic-addon1">{{ $gnl->cur_sym }}</span>
                            </div>
                </div>



                <div class="col-md-4">

                    <div class="form-group">
                        <label class="form-label">Capital Back</label>
                        <div class="selectgroup w-100">
                            <input type="radio" class="btn-check " name="capital_back" id="yes"
                            autocomplete="off" value="1" {{ $plan->capital_back == '1' ? 'checked' : '' }} >
                        <label class="btn btn-outline-success  " for="yes">Yes</label>

                        <input type="radio" class="btn-check" name="capital_back" id="store"
                            autocomplete="off" value="0" {{ $plan->capital_back == '0' ? 'checked' : '' }} >
                        <label class="btn btn-outline-danger  "  for="store"> Store</label>
                        </div>
                    </div>
                </div>


                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-label">Status</label>
                        <div class="selectgroup w-100">
                            <input type="radio" class="btn-check" name="status" id="active"
                            autocomplete="off" value="1" {{ $plan->status == '1' ? 'checked' : '' }}  >
                        <label class="btn btn-outline-success " for="active">Active</label>

                        <input type="radio" class="btn-check" name="status" id="deactive"
                            autocomplete="off" value="0" {{ $plan->status == '0' ? 'checked' : '' }}  >
                        <label class="btn btn-outline-danger " for="deactive"> Deactivate</label>
                        </div>
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <label class="col-lg-6  ">Upload Image  <span class="required-label">*</span></label>
                    <div class="form-group ">
                        <img src="{{ asset('assets/images/plan/'.$plan->image) }}" alt="Image Preview" id="image-preview" style="height:40vh" >
                    </div>
                    <div class="col-lg-12 ">
                        <div class="input-file input-file-image">
                            <input type="file" class="form-control " id="image" name="image" accept="image/*" hidden >
                            <label for="image" class="btn btn-primary rounded-pill "><i class="fa fa-file-image"></i> Upload</label>
                        </div>
                    </div>
                    <p class="text-warning mb-0">Image Will Resize 512x512.</p>
                    <p class="text-warning mb-0">Only jpg, jpeg, png image allowed.</p>
                </div>


                <button type="submit" class="btn btn-success custom-button me-1 mb-1">Submit</button>

            </form>

            </div>
        </div>
    </div>
</section>

@endsection

@push('js')
<script type="text/javascript">
    function show(){
        document.getElementById('2').style.display = 'none';
        document.getElementById('1').style.display = 'block';

    }
    function show2(){
        document.getElementById('2').style.display = 'block';
        document.getElementById('1').style.display = 'none';

    }
    function show3(){
        document.getElementById('3').style.display = 'none';

    }
    function show4(){
        document.getElementById('3').style.display = 'block';

    }
</script>
@endpush
@push('js')
{{-- <script src="{{ asset('assets/admin/js/jquery-3.6.0.min.js') }}"></script> --}}
<script>
    function previewImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#image-preview').attr('src', e.target.result).show();
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

    $('#image').on('change', function() {
        previewImage(this);
    });
</script>
@endpush