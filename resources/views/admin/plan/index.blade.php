@extends('admin.layouts.master')

@section('content')

@push('button')
<a href="{{ route('admin.plan.create') }}" class="btn btn-warning ">Add New Plan</a>
@endpush

                <section class="section">
                    <div class="card">
                        <div class="card-header">
                            Manage Plan
                        </div>
                        <div class="card-body">
                            <table class="table table-striped" id="table1">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Plan Name</th>
                                        <th>Invest Amount</th>
                                        <th>Interest</th>
                                        <th>Repeat</th>
                                        <th>Lifetime</th>
                                        <th>Capital Lock</th>
                                        <th>Status</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($plans as $plan)
                                    <tr>
                                        <td>
                                            <div class="avatar">
                                            @if ($plan->image !=null)
                                                <img src="{{asset('assets/images/plan/'.$plan->image)}}" alt="..." class="avatar-img rounded-circle">
                                            @else
                                                <span class="avatar-title rounded-circle border border-dark">{{\Illuminate\Support\Str::limit($plan->plan_name, 2 ,'')}}</span>
                                            @endif
                                            </div>
                                        </td>
                                        <td>{{ $plan->plan_name }} </td>
                                        <td>
                                            @if($plan->minimum_amount != 0)
                                             Min:{{ $gnl->cur_sym }}   {{formatter_money($plan->minimum_amount)}} - Max:{{  $gnl->cur_sym  }}  {{formatter_money($plan->maximum_amount)}}
                                            @else
                                            Fixed:{{  $gnl->cur_sym  }}  {{formatter_money($plan->fixed_amount)}}

                                            @endif
                                        </td>
                                        <td>{{formatter_money($plan->interest)}}</td>
                                        <td>{{($plan->times)}} @if ($plan->lifetime != 1) {{($plan->repeat_time)}} times @endif</td>
                                        <td>
                                            @if ($plan->lifetime == 1)
                                            <span class="badge bg-success">Yes</span>

                                            @else
                                            <span class="badge bg-danger">No</span>

                                            @endif
                                        </td>
                                        <td>
                                            @if ($plan->capital_back == 1)
                                            <span class="badge bg-success">Yes</span>

                                            @else
                                            <span class="badge bg-danger">Store</span>

                                            @endif
                                        </td>
                                        <td>
                                            @if ($plan->status == 1)
                                            <span class="badge bg-success">Active</span>

                                            @else
                                            <span class="badge bg-danger">Deactivate</span>

                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.plan.edit',$plan->id) }}" class="btn icon btn-primary"><i class="bi bi-pencil"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>

                </section>
            </div>
@push('datatable')
<script src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>
<script src="{{ asset('assets/admin/js/pages/datatables.js') }}"></script>
@endpush

@endsection
