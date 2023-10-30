@extends('admin.layouts.master')

@section('content')

                <section class="section">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">

                                        <!-- Table with outer spacing -->
                                        <div class="table-responsive">
                                            <table class="table table-lg">
                                                <thead>
                                                    <tr>
                                                        <th>SL</th>
                                                        <th>Level</th>
                                                        <th>Commission</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($levels as $level)

                                                    <tr>
                                                        <td class="text-bold-500">{{ $level->id }}</td>
                                                        <td>Level# {{ $level->level }}</td>
                                                        <td class="text-bold-500">{{number_format( $level->percent) }}%</td>
                                                    </tr>
                                                    @endforeach

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Manage Commission</h4>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('admin.commission.update') }}" method="post">
                                        @csrf
                                    <div class="form-group">
                                        <label class="form-label">Give Commission When Someone Deposit</label>
                                        <div class="selectgroup w-100">
                                            <input type="radio" class="btn-check " name="deposit_com" id="dpy"
                                            autocomplete="off" value="1" {{ $info->com_when_deposit == '1' ? 'checked' : '' }}  >
                                        <label class="btn btn-outline-success  " for="dpy">Yes</label>

                                        <input type="radio" class="btn-check" name="deposit_com" id="dpn"
                                            autocomplete="off" value="0" {{ $info->com_when_deposit == '0' ? 'checked' : '' }} >
                                        <label class="btn btn-outline-danger  "  for="dpn"> No</label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">Give Commission When Someone Invest.</label>
                                        <div class="selectgroup w-100">
                                            <input type="radio" class="btn-check " name="invest_com" id="iny"
                                            autocomplete="off" value="1" {{ $info->give_com_when_invest == '1' ? 'checked' : '' }}  >
                                        <label class="btn btn-outline-success  " for="iny">Yes</label>

                                        <input type="radio" class="btn-check" name="invest_com" id="inn"
                                            autocomplete="off" value="0" {{ $info->give_com_when_invest == '0' ? 'checked' : '' }} >
                                        <label class="btn btn-outline-danger  "  for="inn"> No</label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">Give Commission When Someone Invest return</label>
                                        <div class="selectgroup w-100">
                                            <input type="radio" class="btn-check " name="invest_return_com" id="inry"
                                            autocomplete="off" value="1" {{ $info->give_com_when_invest_return == '1' ? 'checked' : '' }}  >
                                        <label class="btn btn-outline-success  " for="inry">Yes</label>

                                        <input type="radio" class="btn-check" name="invest_return_com" id="inrn"
                                            autocomplete="off" value="0" {{ $info->give_com_when_invest_return == '0' ? 'checked' : '' }} >
                                        <label class="btn btn-outline-danger  "  for="inrn"> No</label>
                                        </div>
                                    </div>

                                </div>
                                <button type="submit" class="btn btn-primary mt-1 mb-1">Submit</button>

                                </form>
                            </div>


                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Create Your Levels </h4>
                                </div>
                                <div class="card-body">
                                        <div class="col-md-12 mb-1">
                                            <div class="input-group mb-3">
                                                <input type="number" id="levelCount" min="1" value="1" class="form-control"
                                                     aria-describedby="button-addon2 ">
                                                <button class="btn btn-outline-secondary"
                                                    id="createLevels">Create Now</button>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <div class="col-md-12" id="commission_levels">
                                                            <form action="{{ route('admin.levels.store') }}" method="post">
                                                                @csrf
                                                                <table id="levelTable">
                                                                    <label class="text-success" id="referrals" style="display: none;"> Level & Commission </label>

                                                                </table>



                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                </div>
                                <button type="submit" class="btn btn-primary mt-1 mb-1">Submit</button>
                            </form>
                            </div>
                        </div>

                    </div>
                </section>
            </div>


@push('ref')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $("#createLevels").click(function() {
        var levelCount = $("#levelCount").val();
        var levelTable = $("#levelTable");

        // Clear the existing table
        levelTable.empty();

        $('#referrals').css('display', 'block');
        for (var i = 1; i <= levelCount; i++) {
            var row = $("<tr>");
            // row.append("<td> Level: " + i + "</td>");
            row.append('<td><input type="text" class="form-control commission text-center" value="'+ i + '"></td>');

            row.append('<td><input type="text" name="percent[]" class="form-control commission" placeholder="commission in percentage %" required></td>');
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


@endsection






