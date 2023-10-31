@extends('admin.layouts.master')

@section('content')


<section class="section">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Counter Edit </h4>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.counter.update',$counter->id) }}" method="post" enctype="multipart/form-data">
                @csrf
            <div class="row">

                <div class=" col-md-4">
                    <div class="form-group">
                        <label for="iconSelector">Icons </label>
                        <div class="col-sm-10">
                            <select id="iconSelector" class="form-select" name="icon" required>
                            <option value="fas fa-ellipsis-v"{{ $counter->icon == 'fas fa-ellipsis-v' ? 'selected':'' }} >ellipsis-v</option>
                            <option value="fas fa-ellipsis-h"{{ $counter->icon == 'fas fa-ellipsis-h' ? 'selected':'' }}>ellipsis-h</option>
                            <option value="fas fa-bars"{{ $counter->icon == 'fas fa-bars' ? 'selected':'' }}>Bars</option>
                            <option value="far fa-comment"{{ $counter->icon == 'far fa-comment' ? 'selected':'' }}>Comment</option>
                            <option value="far fa-compass"{{ $counter->icon == 'far fa-compass' ? 'selected':'' }}>Compass</option>
                            <option value="fas fa-dollar-sign"{{ $counter->icon == 'fas fa-dollar-sign' ? 'selected':'' }}>Doller</option>
                            <option value="fas fa-heart"{{ $counter->icon == 'fas fa-heart' ? 'selected':'' }}>Heart</option>
                            <option value="fas fa-walking"{{ $counter->icon == 'fas fa-walking' ? 'selected':'' }}>Walking</option>
                            <option value="fas fa-users"{{ $counter->icon == 'fas fa-users' ? 'selected':'' }}>Users</option>
                            <option value="fab fa-twitter"{{ $counter->icon == 'fab fa-twitter' ? 'selected':'' }}>Twitter</option>
                            <option value="fab fa-linkedin"{{ $counter->icon == 'fab fa-linkedin' ? 'selected':'' }}>Linkedin</option>
                            <option value="fab fa-youtube"{{ $counter->icon == 'fab fa-youtube' ? 'selected':'' }}>Youtube</option>
                            <option value="fab fa-instagram"{{ $counter->icon == 'fab fa-instagram' ? 'selected':'' }}>Instagram</option>
                            </select>
                        </div>
                    </div>
                </div>


                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="basicInput">Title</label>
                                <input type="text" name="title" class="form-control form-control-lg" id="basicInput" value="{{ $counter->title }}" required>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="basicInput">Number</label>
                                <input type="text" name="number" class="form-control form-control-lg" id="basicInput" value="{{ $counter->number }}" required>
                            </div>
                        </div>


                <button type="submit" class="btn btn-success  me-1 mb-1">Submit</button>

            </form>

            </div>
        </div>
    </div>
</section>

@endsection


