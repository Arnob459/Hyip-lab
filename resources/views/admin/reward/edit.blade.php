@extends('admin.layouts.master')

@section('content')


<section class="section">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Edit Rewards</h4>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.reward.update',$reward->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row mb-3">

                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="basicInput">Reward Name</label>
                            <input type="text" name="name" class="form-control form-control-lg" id="basicInput" placeholder="Enter Reward Name" value="{{ $reward->name }}" >
                        </div>
                    </div>

                    <div class="col-md-3" >
                        <div class="form-group">
                            <label class="form-label">Set Time Limit </label>
                            <div class="selectgroup w-100">
                                <input type="radio" class="btn-check " name="time_limit" id="success-outlined"
                                autocomplete="off"  value="1" {{ $reward->hours != '0' ? 'checked' : '' }} onchange="show()" >
                            <label class="btn btn-outline-success " for="success-outlined">In hours</label>

                            <input type="radio" class="btn-check" name="time_limit" id="danger-outlined"
                                autocomplete="off"  value="0" {{ $reward->hours == '0' ? 'checked' : '' }} onchange="show2()">
                            <label class="btn btn-outline-danger " for="danger-outlined"> Lifetime</label>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3" >
                        <div id="1" style="display: {{ $reward->hours != '0' ? 'block' : 'none' }}">

                            <div class="form-group">
                                <label for="basicInput">Hours</label>
                                <input type="number" name="hours" class="form-control form-control-lg" id="basicInput" value="{{ $reward->hours }}" >
                            </div>
                        </div>
                    </div>

                    <div class="col-md-" >
                        <div id="0" style="display: {{ $reward->hours == '0' ? 'block' : 'none' }}">


                        </div>
                    </div>




                    <div class="col-6">
                        <div class="form-group">
                            <label for="contact-info-vertical">Status</label>
                            <select name="status"  class="form-select" >
                                <option value="1"@if ($reward->status == '1') selected @endif>Active</option>
                                <option value="0"@if ($reward->status == '0') selected @endif>Deactivate</option>

                            </select>
                        </div>
                    </div>

                    <div class="form-group col-md-7">
                            <label class="col-lg-4 col-md-3 col-sm-4 mt-sm-2">Upload Image <span class="required-label">*</span></label>
                            <div class="col-lg-12">
                                <img class="img-upload-preview mb-2 " style="height:100px" src="{{asset('assets/images/reward/' . $reward->image)}}"  alt="preview">
                                <div class="input-file input-file-image">

                                    <input type="file" class="form-control " id="uploadImg" name="image" accept="image/*" hidden >
                                    <label for="uploadImg" class="btn btn-primary rounded-pill "><i class="fa fa-file-image"></i> Upload a Image</label>
                                </div>
                            </div>
                            <p class="text-warning mb-0">Only jpg, jpeg, png image allowed.</p>
                    </div>


                </div>

                <div class="card-header">
                    <h4 class="card-title">Current rewards</h4>
                </div>
                <hr>

                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-lg">
                                    <thead>
                                        <tr>
                                            <th>Level</th>
                                            <th>Paid User</th>
                                            <th>Business Value</th>
                                            <th>Reward</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($levels as $level)

                                        <tr>
                                            <td class="text-bold-500"> Level {{ $level->level }}</td>
                                            <td class="text-bold-500">{{ $level->paid_user }}</td>
                                            <td class="text-bold-500">{{$gnl->cur_sym}} {{ formatter_money($level->bv) }}</td>
                                            <td class="text-bold-500">{{$gnl->cur_sym}} {{ formatter_money($level->reward) }}</td>

                                        </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>

                <div class="card-header">
                    <h4 class="card-title">Create Your Levels</h4>
                </div>
                <hr>

                <div class="d-flex justify-content-center">
                    <div class="col-md-10 mb-1 ">
                        <div class="input-group mb-3">
                            <input type="number" id="levelCount" min="1"  class="form-control"
                                aria-describedby="button-addon2 " placeholder="Enter Your Levels">
                            <button class="btn btn-outline-secondary btn-lg"
                                id="createLevels">Create Now</button>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-12" >
                                            <table id="levelTable">
                                                <label class="text" id="lc" style="display: none;"> Level & Rewards </label>

                                            </table>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
            <div class="d-flex justify-content-center">
                <div class="col-10">
                    <div class="row mb-3">
                        <button type="submit" class="btn btn-success btn-lg me-1 mb-1">Submit</button>

                    </div>
                </div>
            </div>


        </form>


    </div>

</section>

@endsection

@push('reward')
<script type="text/javascript">
    function show(){
        document.getElementById('0').style.display = 'none';
        document.getElementById('1').style.display = 'block';

    }
    function show2(){
        document.getElementById('0').style.display = 'block';
        document.getElementById('1').style.display = 'none';

    }
</script>
@endpush

@push('ref')
<script>
$(document).ready(function() {
    $("#createLevels").click(function() {
        var levelCount = $("#levelCount").val();
        var levelTable = $("#levelTable");

        // Clear the existing table
        levelTable.empty();

        $('#lc').css('display', 'block');
        for (var i = 1; i <= levelCount; i++) {
            var row = $("<tr>");
            row.append('<td><input type="text" class="form-control  text-center" value="'+ i + '"></td>');

            row.append('<td><input type="number" name="user[]" class="form-control " placeholder="number of paid user" required></td>');
            row.append('<td><input type="text" name="business[]" class="form-control " placeholder="business value" required></td>');
            row.append('<td><input type="text" name="amount[]" class="form-control " placeholder="reward amount" required></td>');

            row.append('<td><button class="btn icon btn-danger removeLevel"><i class="bi bi-x"></i></button></td>');

            levelTable.append(row);
        }
    });

    // Handle the removal of levels
    $("#levelTable").on("click", ".removeLevel", function() {
        $(this).closest("tr").remove();
    });
});
</script>
@endpush
