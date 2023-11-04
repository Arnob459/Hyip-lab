@extends('admin.layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">

                <div class="card-header">
                    <div class="card-title">{{$page_title}} @lang('Section')</div>
                </div>
                <form  class="exampleValidation" action="{{route('admin.settings.footer')}}" method="post">
                    @csrf
                    <div class="card-body pb-5 ">
                        <div class="form-row justify-content-center">
                            <div class="form-group col-md-12">
                                <label for="">@lang('Footer Text') *</label>
                                <input type="text" class="form-control" name="footer_text" value="{{$gnl->footer_text}}"
                                       placeholder="Enter service title">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="">@lang('Copyright Text') *</label>
                                <input type="text" class="form-control" name="copy_section" value="{{$gnl->copy_section}}"
                                       placeholder="Enter service subtitle">

                            </div>
                        </div>
                    </div>
                    <div class="card-footer pt-3">
                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-success btn-block">@lang('Update')</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

w
