@extends('admin.layouts.master')

@section('content')


    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">{{$page_title}}</div>
                </div>
                <div class="card-body">
                    <form id="exampleValidation" method="post" action="{{route('admin.settings.basic')}}"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label>@lang('Site Name')</label>
                                <input type="text" class="form-control  @error('site_name') is-invalid @enderror"
                                       value="{{$gnl->site_name}}" name="site_name" placeholder="Enter site name" required>


                            </div>

                            <div class="form-group col-md-2">
                                <label>@lang('Site Currency')</label>
                                <input type="text" class="form-control  @error('currency') is-invalid @enderror"
                                       value="{{$gnl->cur}}" placeholder="site currency" name="currency" required>


                            </div>
                            <div class="form-group col-md-3">
                                <label>@lang('Site Currency Symbol')</label>
                                <input type="text" class="form-control  @error('currency_symbol') is-invalid @enderror"
                                       value="{{$gnl->cur_sym}}" placeholder="site currency" name="currency_symbol"
                                       required>


                            </div>
                            <div class="form-group col-md-3">
                                <label>@lang('Need Admin Approval')</label>
                                <select class="form-control" name="admin_permission">
                                    <option value="1">@lang('Yes')</option>
                                    <option value="0">@lang('No')</option>

                                </select>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">@lang('Email Verification')</label>
                                    <div class="selectgroup w-100">
                                        <input type="radio" class="btn-check" name="email_verification" id="eev"
                                        autocomplete="off" value="1" {{ $gnl->ev == '1' ? 'checked' : '' }}  >
                                    <label class="btn btn-outline-success " for="eev">Enable</label>

                                    <input type="radio" class="btn-check" name="email_verification" id="dev"
                                        autocomplete="off" value="0" {{ $gnl->ev != '1' ? 'checked' : '' }}  >
                                    <label class="btn btn-outline-danger " for="dev"> Disable</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">@lang('Email Notification')</label>
                                    <div class="selectgroup w-100">
                                        <input type="radio" class="btn-check" name="email_notification" id="een"
                                        autocomplete="off" value="1" {{ $gnl->en == '1' ? 'checked' : '' }}  >
                                    <label class="btn btn-outline-success " for="een">Enable</label>

                                    <input type="radio" class="btn-check" name="email_notification" id="den"
                                        autocomplete="off" value="0" {{ $gnl->en != '1' ? 'checked' : '' }}  >
                                    <label class="btn btn-outline-danger " for="den"> Disable</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">@lang('SMS Verification')</label>
                                    <div class="selectgroup w-100">
                                        <input type="radio" class="btn-check" name="sms_verification" id="esv"
                                        autocomplete="off" value="1" {{ $gnl->sv == '1' ? 'checked' : '' }}  >
                                    <label class="btn btn-outline-success " for="esv">Enable</label>

                                    <input type="radio" class="btn-check" name="sms_verification" id="dsv"
                                        autocomplete="off" value="0" {{ $gnl->sv != '1' ? 'checked' : '' }}  >
                                    <label class="btn btn-outline-danger " for="dsv"> Disable</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">@lang('SMS Notification')</label>
                                    <div class="selectgroup w-100">
                                        <input type="radio" class="btn-check" name="sms_notification" id="esn"
                                        autocomplete="off" value="1" {{ $gnl->sn == '1' ? 'checked' : '' }}  >
                                    <label class="btn btn-outline-success " for="esn">Enable</label>

                                    <input type="radio" class="btn-check" name="sms_notification" id="dsn"
                                        autocomplete="off" value="0" {{ $gnl->sn != '1' ? 'checked' : '' }}  >
                                    <label class="btn btn-outline-danger " for="dsn"> Disable</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">@lang('User Registration')</label>
                                    <div class="selectgroup w-100">
                                        <input type="radio" class="btn-check" name="registration" id="ereg"
                                        autocomplete="off" value="1" {{ $gnl->reg == '1' ? 'checked' : '' }}  >
                                    <label class="btn btn-outline-success " for="ereg">Enable</label>

                                    <input type="radio" class="btn-check" name="registration" id="dreg"
                                        autocomplete="off" value="0" {{ $gnl->reg != '1' ? 'checked' : '' }}  >
                                    <label class="btn btn-outline-danger " for="dreg"> Disable</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">@lang('User Login')</label>
                                    <div class="selectgroup w-100">
                                        <input type="radio" class="btn-check" name="login" id="elog"
                                        autocomplete="off" value="1" {{ $gnl->login_status == '1' ? 'checked' : '' }}  >
                                    <label class="btn btn-outline-success " for="elog">Enable</label>

                                    <input type="radio" class="btn-check" name="login" id="dlog"
                                        autocomplete="off" value="0" {{ $gnl->login_status != '1' ? 'checked' : '' }}  >
                                    <label class="btn btn-outline-danger " for="dlog"> Disable</label>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group col-md-6">
                                <label>@lang('User Registration Off Message')</label>
                                <input type="text"
                                       class="form-control  @error('registration_off_message') is-invalid @enderror"
                                       value="{{$gnl->res_mes}}" name="registration_off_message"
                                       placeholder="User Registration Off Message">


                                <span class="text-warning">@lang('If user registration off message is null, there is a default message')</span>

                            </div>

                            <div class="form-group col-md-6">
                                <label>@lang('User Login Off Message')</label>
                                <input type="text"
                                       class="form-control  @error('login_off_message') is-invalid @enderror"
                                       value="{{$gnl->login_mes}}" name="login_off_message"
                                       placeholder="User Login Off Message">

                                <span
                                    class="text-warning">@lang('If user login off message is null, there is a default message')</span>
                            </div>
                        </div>

                       <div class="card-action">
                            <button class="btn btn-success btn-block">@lang('Submit')</button>
                        </div>
                    </form>

                </div>

            </div>
        </div>

    </div>


@endsection

@push('js_link')
    @include('partials.validation_js')
@endpush

@push('js')
    <script>
        $("select[name=admin_permission]").val("{{ $gnl->admin_permission }}");
    </script>
@endpush


