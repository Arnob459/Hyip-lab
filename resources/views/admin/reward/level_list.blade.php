@extends('admin.layouts.master')

@section('content')



                <section class="section">
                    <div class="card">
                        <div class="card-header">
                            Reward levels
                        </div>
                        <div class="card-body">
                            <table class="table table-lg">
                                <thead>
                                    <tr>
                                        <th>Level</th>
                                        <th>Paid User</th>
                                        <th>Business Value</th>
                                        <th>Reward</th>
                                        <th>Actions</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($levels as $level)

                                    <tr>
                                        <td class="text-bold-500">Level {{ $level->level }}</td>
                                        <td class="text-bold-500">{{ $level->paid_user }}</td>
                                        <td class="text-bold-500">{{$gnl->cur_sym}} {{ formatter_money($level->bv) }}</td>
                                        <td class="text-bold-500">{{$gnl->cur_sym}} {{ formatter_money($level->reward) }}</td>
                                        <td>
                                            <button type="button" value="{{ $level->id }}" class="btn btn-primary editbtn" data-bs-toggle="modal"
                                                data-bs-target="#editModal" ><i class ="bi bi-pencil"></i></button>

                                                <button type="button" class="btn btn-danger " data-toggle="modal" data-target="#deleteModal{{ $level->id }}"><i class ="fa fa-trash"></i></button>
                                            </td>

                                        </tr>
                                        {{-- Delete modal --}}
                                                <div class="modal fade" id="deleteModal{{ $level->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel{{ $level->id }}" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="deleteModalLabel{{ $level->id }}">Are You sure?</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Are you sure you want to delete this item?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                                <form method="POST" action="{{ route('admin.reward.destroy', $level->id) }}">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            {{-- modal --}}
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>


                     <!--Basic Modal -->
                     <div class="modal fade text-left" id="editModal" tabindex="-1" role="dialog"
                        aria-labelledby="myModalLabel1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="myModalLabel1">Edit </h5>
                                    <button type="button" class="close rounded-pill" data-bs-dismiss="modal"
                                        aria-label="Close">
                                        <i data-feather="x"></i>
                                    </button>
                                </div>
                                <form action="{{ route('admin.reward.level.update') }} " method="post">
                                @csrf
                                @method('put')

                                <div class="modal-body">

                                    <input type="hidden" name="level_id" id="level_id" value="{{ $level->id }}">

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="basicInput">Reward Name</label>
                                            <input type="text" name="level_name" id="level_name" class="form-control form-control-lg"  value="{{ $level->level}}" disabled>
                                        </div>
                                    </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="basicInput">Paid User</label>
                                                <input type="number" name="paid_user" id="paid_user" class="form-control form-control-lg"  value="{{ $level->paid_user }}" required>
                                            </div>
                                        </div>

                                    <div class="col-md-12">
                                        <label for="basicInput">Business Value </label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">{{ $gnl->cur_sym }}</span>

                                            <input type="text" name="business_value" id="business_value" class="form-control form-control-lg"
                                                aria-label="business_value" aria-describedby="basic-addon1" value="{{formatter_money($level->bv) }}" >
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <label for="basicInput">Reward Amount </label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">{{ $gnl->cur_sym }}</span>

                                            <input type="text" name="reward_amount" id="reward_amount" class="form-control form-control-lg"
                                                aria-label="reward_amount" aria-describedby="basic-addon1" value="{{formatter_money($level->reward) }}" >
                                        </div>
                                    </div>

                                </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn" data-bs-dismiss="modal">
                                            <i class="bx bx-x d-block d-sm-none"></i>
                                            <span class="d-none d-sm-block">Close</span>
                                        </button>
                                        <button type="submit" class="btn btn-primary ml-1" >
                                            <i class="bx bx-check d-block d-sm-none"></i>
                                            <span class="d-none d-sm-block">Update</span>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>


                </section>
            </div>


@push('datatable')
<script src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>
<script src="{{ asset('assets/admin/js/pages/datatables.js') }}"></script>
@endpush

@endsection

<script src="{{ asset('assets/admin/js/jquery-3.6.0.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>


<script>
    $(document).ready(function() {
        $(document).on('click', '.editbtn', function() {
            var level_id = $(this).val();
            // alert(level_name);
            $('editModal').modal('show');
                $.ajax({
                // route: 'admin.reward.level.edit' + level_id,
                type: 'GET',
                url: "/admin/reward-edit/" + level_id,
                    success: function(response) {
                        // console.log(response);
                        $('#level_id').val(response.level.id);
                        $('#level_name').val(response.level.level);
                        $('#paid_user').val(response.level.paid_user);
                        $('#business_value').val(response.level.bv);
                        $('#reward_amount').val(response.level.reward);

                    }
                });
        });
    });
</script>

