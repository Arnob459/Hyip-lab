@extends('admin.layouts.master')

@section('content')


@push('button')
<a href="{{ route('admin.withdraw.method.create') }}" class="btn btn-success">@lang('Add New Methods')</a>
@endpush

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Methods </h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="basic-datatables" class="display table  table-hover">
                            <thead>
                            <tr>
                                <th>@lang('Image')</th>
                                <th>@lang('Method')</th>
                                <th>@lang('Currency')</th>
                                <th>@lang('Charge')</th>
                                <th>@lang('Withdraw Limit')</th>
                                <th>@lang('Processing Delay')</th>
                                <th>@lang('Status')</th>
                                <th>@lang('Action')</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($methods as $method)
                                <tr>
                                    <td>
                                        <div class="avatar">
                                            @if ($method->image !=null)
                                                <img src="{{asset('assets/images/withdraw/method/'.$method->image)}}" alt="..." class="avatar-img rounded-circle">
                                            @else
                                                <span class="avatar-title rounded-circle border border-dark">{{\Illuminate\Support\Str::limit($method->name, 1 ,'')}}</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                       {{ $method->name }}
                                    </td>
                                    <td>{{ $method->currency }}</td>
                                    <td>{{ $method->fixed_charge + 0 }} {{$gnl->cur }}
                                        + {{ $method->percent_charge + 0 }} %
                                    </td>
                                    <td>{{ $method->min_limit + 0 }}
                                        - {{ $method->max_limit + 0 }} {{$gnl->cur }}</td>
                                    <td>{{ $method->delay }}</td>
                                    <td>
                                        @if($method->status == 1)
                                            <span class="badge badge-pill bg-success">@lang('active')</span>
                                        @else
                                            <span class="badge badge-pill bg-danger">@lang('disabled')</span>
                                        @endif
                                    </td>
                                    <td>

                                        <a class="btn btn-secondary btn-sm"
                                           href="{{ route('admin.withdraw.method.update', $method->id) }}">
                                            <span class="btn-label"><i class="fas fa-edit"></i></span>
                                            Edit</a>

                                        @if($method->status == 0)
                                            <button class="btn btn-success btn-sm activateBtn"
                                                    data-id="{{ $method->id }}"
                                                    data-name="{{ $method->name }}"
                                                    data-toggle="modal" data-target="#activateModal">
                                                <span class="btn-label"><i class="fas fa-eye"></i></span>
                                                @lang('Active')
                                            </button>

                                        @else
                                            <button class="btn btn-danger btn-sm deactivateBtn"
                                                    data-id="{{ $method->id }}"
                                                    data-name="{{ $method->name }}"
                                                    data-toggle="modal" data-target="#deactivateModal">
                                                <span class="btn-label"><i class="fas fa-eye-slash"></i></span>
                                                @lang('Disable')
                                            </button>
                                        @endif

                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>


    </div>





    {{-- ACTIVATE METHOD MODAL --}}
    <div id="activateModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Withdrawal Method Activation Confirmation')</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.withdraw.method.activate') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id">
                    <div class="modal-body">
                        <p>@lang('Are you sure to activate') <span class="font-weight-bold method-name"></span> @lang('method')?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">@lang('Activate')</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">@lang('Close')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- DEACTIVATE METHOD MODAL --}}
    <div id="deactivateModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Withdrawal Method Disable Confirmation')</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.withdraw.method.deactivate') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id">
                    <div class="modal-body">
                        <p>@lang('Are you sure to disable') <span class="font-weight-bold method-name"></span> @lang('method')?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger">@lang('Disable')</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">@lang('Close')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



@endsection


@push('js')
    <script>
        $('.activateBtn').on('click', function () {
            var modal = $('#activateModal');
            modal.find('.method-name').text($(this).data('name'));
            modal.find('input[name=id]').val($(this).data('id'));
            modal.modal('show');
        });

        $('.deactivateBtn').on('click', function () {
            var modal = $('#deactivateModal');
            modal.find('.method-name').text($(this).data('name'));
            modal.find('input[name=id]').val($(this).data('id'))
            modal.modal('show');
        });
    </script>
@endpush

