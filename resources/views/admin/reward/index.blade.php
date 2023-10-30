@extends('admin.layouts.master')

@section('content')



                <section class="section">
                    <div class="card">
                        <div class="card-header">
                            Manage Rewards
                        </div>
                        <div class="card-body">
                            <table class="table table-striped" id="table1">
                                <thead>
                                    <tr>
                                        <th>Sl</th>
                                        <th>Rewards Name</th>
                                        <th>Image</th>
                                        <th>Time</th>
                                        <th>Status</th>
                                        <th>Actions</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($rewards as $reward)

                                    <tr>
                                        <td>{{ $reward->id }}</td>
                                        <td>
                                            {{$reward->name ?? 'N/A'}}</td>
                                        <td>
                                            <div class="avatar avatar-xl  ">
                                                @if ($reward->image !=null)
                                                <img src="{{asset('assets/images/reward/'.$reward->image)}}" alt="..." class="avatar-img rounded-circle">
                                            @else
                                                <span class="avatar-title rounded-circle border border-dark">{{\Illuminate\Support\Str::limit($reward->name, 2 ,'')}}</span>
                                            @endif
                                            </div>
                                        </td>
                                        <td>
                                            @if ($reward->hours != 0)
                                            {{ $reward->hours }} hours
                                            @else
                                            Lifetime
                                            @endif
                                            </td>
                                        <td>
                                            @if ($reward->status == 1)
                                            <span class="badge bg-success">Active</span>
                                            @else
                                            <span class="badge bg-danger">Deactivate</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.reward.level.list',$reward->id) }}" class="btn icon btn-info" ><i class="fa fa-eye" ></i></a>
                                            <a href="{{ route('admin.reward.edit',$reward->id) }}" class="btn icon btn-primary"><i class="bi bi-pencil"></i></a>

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
