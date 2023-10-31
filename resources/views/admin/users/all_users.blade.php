@extends('admin.layouts.master')

@section('content')

                <section class="section">
                    <div class="card">
                        <div class="card-header">
                            All Users
                        </div>
                        <div class="card-body">
                            <table class="table table-striped" id="table1">
                                <thead>
                                    <tr>
                                        <th>Avatar</th>
                                        <th>Name</th>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Deposit wallet</th>
                                        <th>Interest wallet</th>
                                        <th>Status</th>
                                        <th>Actions</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        @foreach ($users as $user)
                                        <td>
                                             @if ($user->avatar !=null)
                                            <img src="{{asset('assets/images/users/'.$user->avatar)}}" alt="..." class="avatar-img rounded-circle">
                                            @else
                                            <span class="avatar-title rounded-circle border border-dark">{{\Illuminate\Support\Str::limit($user->name, 1 ,'')}}</span>
                                            @endif
                                        </td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->username }}</td>
                                        <td >{{ $user->email }}</td>
                                        <td>{{ $user->phone }}</td>
                                        <td>{{$gnl->cur_sym}} {{formatter_money($user->balance)}}</td>
                                        <td>{{$gnl->cur_sym}} {{formatter_money($user->interest_balance)}}</td>
                                        <td>
                                        @if ($user->status == 1)
                                        <span class="badge bg-success">Active</span>
                                        @elseif ($user->status == 0)
                                        <span class="badge bg-danger">Block</span>
                                        @else
                                        <span class="badge bg-warning">Pending</span>
                                        @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.user.edit',$user->id) }}" class="btn icon btn-primary"><i class="bi bi-pencil"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                    <tr>
                                        @if (count($users) == 0)
                                            <td colspan="10" class="text-center">No users found</td>
                                        @endif
                                    </tr>

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
