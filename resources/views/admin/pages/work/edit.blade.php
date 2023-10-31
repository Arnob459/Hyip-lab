@extends('admin.layouts.master')

@section('content')


<section class="section">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">How it's Work Edit </h4>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.work.update',$work->id) }}" method="post" enctype="multipart/form-data">
                @csrf
            <div class="row">

                <div class=" col-md-4">
                    <div class="form-group">
                        <label for="iconSelector">Icons </label>
                        <div class="col-sm-10">
                            <select id="iconSelector" class="form-select" name="icon" required>
                                <option value="fas fa-coins"{{ $work->icon == 'fas fa-coins' ? 'selected':'' }}>Coins</option>
                                <option value="fas fa-hand-holding-usd"{{ $work->icon == 'fas fa-hand-holding-usd' ? 'selected':'' }}>Hand-holding-usd</option>
                                <option value="fas fa-chart-bar"{{ $work->icon == 'fas fa-chart-bar' ? 'selected':'' }}>Chart-bar</option>
                                <option value="fas fa-money-bill"{{ $work->icon == 'fas fa-money-bill' ? 'selected':'' }}>Money-bill</option>
                                <option value="fas fa-money-check-alt"{{ $work->icon == 'fas fa-money-check-alt' ? 'selected':'' }}>wallet</option>
                                <option value="fas fa-ellipsis-v"{{ $work->icon == 'fas fa-ellipsis-v' ? 'selected':'' }} >ellipsis-v</option>
                                <option value="fas fa-ellipsis-h"{{ $work->icon == 'fas fa-ellipsis-h' ? 'selected':'' }}>ellipsis-h</option>
                                <option value="fas fa-bars"{{ $work->icon == 'fas fa-bars' ? 'selected':'' }}>Bars</option>
                                <option value="far fa-comment"{{ $work->icon == 'far fa-comment' ? 'selected':'' }}>Comment</option>
                                <option value="far fa-compass"{{ $work->icon == 'far fa-compass' ? 'selected':'' }}>Compass</option>
                                <option value="fas fa-dollar-sign"{{ $work->icon == 'fas fa-dollar-sign' ? 'selected':'' }}>Doller</option>
                                <option value="fas fa-heart"{{ $work->icon == 'fas fa-heart' ? 'selected':'' }}>Heart</option>
                                <option value="fas fa-walking"{{ $work->icon == 'fas fa-walking' ? 'selected':'' }}>Walking</option>
                                <option value="fas fa-users"{{ $work->icon == 'fas fa-users' ? 'selected':'' }}>Users</option>
                                <option value="fab fa-twitter"{{ $work->icon == 'fab fa-twitter' ? 'selected':'' }}>Twitter</option>
                                <option value="fab fa-linkedin"{{ $work->icon == 'fab fa-linkedin' ? 'selected':'' }}>Linkedin</option>
                                <option value="fab fa-youtube"{{ $work->icon == 'fab fa-youtube' ? 'selected':'' }}>Youtube</option>
                                <option value="fab fa-instagram"{{ $work->icon == 'fab fa-instagram' ? 'selected':'' }}>Instagram</option>
                            </select>
                        </div>
                    </div>
                </div>


                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="basicInput">Title</label>
                                <input type="text" name="title" class="form-control form-control-lg" id="basicInput" value="{{ $work->title }}" required>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="basicInput">Short Text</label>
                                <input type="text" name="subtitle" class="form-control form-control-lg" id="basicInput" value="{{ $work->short_text }}" required>
                            </div>
                        </div>


                <button  type="submit" class="btn btn-success  me-1 mb-1">Submit</button>

            </form>

            </div>
        </div>
    </div>
</section>
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@if (Session::has('message'))

<script>
    toastr.options = {
        "progressBar": true,
        "closeButton": true,
    }
    toastr.success("{{ Session::get('message') }}");
</script>

@endif --}}

@endsection



