@extends('admin.layouts.master')

@section('content')
    <div class="row ">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-head-row">
                        <h4 class="card-title">{{$page_title}}</h4>

                    </div>
                </div>
                <form  id="exampleValidation" method="post" action="{{ route('admin.withdraw.method.update', $method->id) }}" enctype="multipart/form-data">
                    <div class="card-body">

                        <div class="row">

                            @csrf
                            <div class="col-md-3">
                                <div class="form-group form-show-validation">
                                    <label class="col-lg-4 col-md-3 col-sm-4 mt-sm-2">Upload Image <span class="required-label">*</span></label>
                                    <div class="col-lg-12">

                                        <div class="input-file input-file-image">
                                            <div class="form-group ">
                                                <img  class="img-fluid" id="image-preview"
                                                src="{{ asset('assets/images/withdraw/method/'.$method->image) }}" alt="preview">
                                            </div>
                                            <div class="col-lg-12 ">
                                                <div class="input-file input-file-image">
                                                    <input type="file" class="form-control " id="image" name="image" accept="image/*" hidden >
                                                    <label for="image" class="btn btn-primary rounded-pill "><i class="fa fa-file-image"></i> Upload</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="text-warning mb-0 mt-2">Image Will Resize 200x200.</p>
                                    <p class="text-warning mb-0">Only jpg, jpeg, png image allowed.</p>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="name">Method Name</label>
                                        <input type="text" class="form-control " placeholder="Method Name" name="name" value="{{ $method->name }}" required />
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="name"> Method Currency</label>
                                        <input type="text" name="currency" placeholder="Method Currency" class="form-control  border-radius-5" value="{{ $method->currency}}"  required/>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="name">Rate <span class="text-danger">*</span></label>

                                        <div class="input-group has_append">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">1 {{ $gnl->cur }} =</div>
                                            </div>
                                            <input type="text" class="form-control" placeholder="0" name="rate" value="{{ $method->rate+0}}" required />
                                            <div class="input-group-append">
                                                <div class="input-group-text"><span class="currency_symbol"></span></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="name"> Processing time <span class="text-danger">*</span></label>
                                        <input type="text" name="delay" placeholder="Processing time"  class="form-control form-control border-radius-5" value="{{ $method->delay }}"  required/>
                                    </div>

                                </div>

                                <hr>
                                <div class="row">

                                    <div class="col-lg-6">
                                        <div class="input-group mb-3">
                                            <label class="w-100">Minimum Withdraw  Amount <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" placeholder="0" name="min_limit" value="{{ formatter_money($method->min_limit) }}" required/>
                                            <div class="input-group-append">
                                                <div class="input-group-text">{{ $gnl->cur }}</div>
                                            </div>
                                        </div>
                                        <div class="input-group mb-3">
                                            <label class="w-100">Maximum Withdraw  Amount <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" placeholder="0" name="max_limit" value="{{ formatter_money($method->max_limit) }}" required/>
                                            <div class="input-group-append">
                                                <div class="input-group-text">{{ $gnl->cur }}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">

                                        <div class="input-group mb-3">
                                            <label class="w-100">Method Fixed Charge <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" placeholder="0" name="fixed_charge" value="{{ formatter_money($method->fixed_charge) }}" required/>
                                            <div class="input-group-append">
                                                <div class="input-group-text">{{ $gnl->cur }}</div>
                                            </div>
                                        </div>
                                        <div class="input-group">
                                            <label class="w-100">Method Percent Charge <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" placeholder="0" name="percent_charge" value="{{ $method->percent_charge+0 }}" required>
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">%</div>
                                            </div>
                                        </div>

                                    </div>


                                </div>

                            </div>

                        </div>
                        <br>
                        <br>



                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card outline-dark">
                                    <div class="card-header bg-secondary d-flex justify-content-between">
                                        <h5>Deposit Instruction</h5>
                                    </div>

                                    <div class="form-group">
                                        <textarea rows="8" class="form-control border-radius-5 nicEdit" name="instruction">{{ $method->description }}</textarea>
                                    </div>

                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="card outline-dark">
                                    <div class="card-header bg-secondary d-flex justify-content-between">
                                        <h5>User data</h5>
                                        <button type="button" class="btn btn-sm btn-outline-light addUserData"><i class="fa fa-fw fa-plus"></i>Add New</button>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-row" id="userData">


                                            @if($method->user_data)
                                                @foreach(json_decode($method->user_data) as $data)
                                                    <div class="col-md-4 user-data mt-2">
                                                        <div class="input-group has_append">
                                                            <input class="form-control border-radius-5" name="ud[]" value="{{ $data }}" required>
                                                            <div class="input-group-append">
                                                                <button type="button" class="btn btn-danger removeBtn"><i class="fa fa-times"></i></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="card-action">
                            <button class="btn btn-success btn-block">Submit</button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>




@endsection

@include('partials.validation_js')

@push('js')
<script>
$('input[name=currency]').on('input', function() {
    $('.currency_symbol').text($(this).val());
});
$('.currency_symbol').text($('input[name=currency]').val());
$('.addUserData').on('click', function() {
    var html =  `<div class="col-md-4 user-data mt-2">
                    <div class="input-group has_append">
                        <input class="form-control border-radius-5" name="ud[]" required>
                        <div class="input-group-append">
                            <button type="button" class="btn btn-danger removeBtn"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
                </div>`;

    $('#userData').append(html);
});

$(document).on('click', '.removeBtn', function() {
    $(this).parents('.user-data').remove();
});
</script>
@endpush
@push('js')
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
