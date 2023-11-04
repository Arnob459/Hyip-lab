@extends('admin.layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">

                <div class="card-header">
                    <div class="card-title">@lang('Add Social Link')</div>
                </div>
                <form id="socialForm"  action="{{route('admin.settings.social.store')}}" method="post"
                      onsubmit="store(event)">
                    @csrf
                    <div class="card-body pt-5 pb-5">
                        <div class="form-row justify-content-center">
                            <div class="form-group col-md-3">
                                <label for="">@lang('Social Icon') *</label>
                                <div class="btn-group d-block">
                                    <button type="button" class="btn btn-secondary iconpicker-component"><i
                                            class="fa fa-fw fa-heart"></i></button>
                                    <button type="button" class="icp icp-dd btn btn-secondary dropdown-toggle"
                                            data-selected="fa-car" data-toggle="dropdown">
                                    </button>
                                    <div class="dropdown-menu"></div>
                                    <span class="action-create"></span>
                                </div>
                                <input id="inputIcon" type="hidden" name="icon">
                                @if ($errors->has('icon'))
                                    <p class="mb-0 text-danger">{{$errors->first('icon')}}</p>
                                @endif
                                <div class="mt-2">
                                    <small>@lang('Info : click on the dropdown icon to select a social link icon.')</small>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="">@lang('URL') *</label>
                                <input type="text" class="form-control" name="url" value=""
                                       placeholder="Enter URL of your social media account" required>
                                @if ($errors->has('url'))
                                    <p class="mb-0 text-danger">{{$errors->first('url')}}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="card-footer pt-3">
                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-success btn-block">@lang('Submit')</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card">
                <div class="card-header">
                    <div class="card-title">@lang('Social Links')</div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">

                            <div class="table-responsive">
                                <table class="table table-striped mt-3">
                                    <thead>
                                    <tr>
                                        <th scope="col">@lang('SL')</th>
                                        <th scope="col">@lang('Icon')</th>
                                        <th scope="col">@lang('URL')</th>
                                        <th scope="col">@lang('Actions')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($icons as $key => $social)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td><i class="{{$social->icon}}"></i></td>
                                            <td>{{$social->url}}</td>
                                            <td>
                                                <a class="btn btn-secondary btn-sm"
                                                   href="{{route('admin.settings.social.edit', $social->id)}}">
                                                    <span class="btn-label"><i class="fas fa-edit"></i></span>
                                                    @lang('Edit')</a>
                                                <button class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                        data-bs-target="#myModal-{{$social->id}}">
                                                    <span class="btn-label"><i class="fas fa-edit"></i></span>
                                                    @lang('Delete')
                                                </button>

                                            </td>
                                        </tr>
                                        <div class="modal fade" id="myModal-{{$social->id}}">
                                            <div class="modal-dialog">
                                                <div class="modal-content" style="background-color: #202940;">
                                                    <!-- Modal Header -->
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">@lang("Are you sure?")</h4>
                                                        <button type="button" class="close" data-bs-dismiss="modal">
                                                            &times;
                                                        </button>
                                                    </div>
                                                    <!-- Modal body -->
                                                    <div class="modal-body">
                                                        @lang("You won't be able to revert this!")

                                                    </div>
                                                    <form class="d-inline-block" action="{{route('admin.settings.social.destroy', $social->id)}}" method="post">@csrf{{method_field('delete')}}
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-danger"
                                                                    data-bs-dismiss="modal">@lang('Close')
                                                            </button>
                                                            <button type="submit" class="btn btn-success">@lang('Delete')
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


@include('admin.layouts.iconpicker')




