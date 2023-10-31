@extends('admin.layouts.master')

@section('content')


<section class="section">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Why Choose Us Edit </h4>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.choose.update',$choose->id) }}" method="post" enctype="multipart/form-data">
                @csrf
            <div class="row">

                <div class=" col-md-4">
                    <div class="form-group">
                        <label for="iconSelector">Icons </label>
                        <div class="col-sm-10">
                            <select id="iconSelector" class="form-select" name="icon" required>
                                <option value="fas fa-coins"{{ $choose->icon == 'fas fa-coins' ? 'selected':'' }}>Coins</option>
                                <option value="fas fa-hand-holding-usd"{{ $choose->icon == 'fas fa-hand-holding-usd' ? 'selected':'' }}>Hand-holding-usd</option>
                                <option value="fas fa-chart-bar"{{ $choose->icon == 'fas fa-chart-bar' ? 'selected':'' }}>Chart-bar</option>
                                <option value="fas fa-money-bill"{{ $choose->icon == 'fas fa-money-bill' ? 'selected':'' }}>Money-bill</option>
                                <option value="fas fa-money-check-alt"{{ $choose->icon == 'fas fa-money-check-alt' ? 'selected':'' }}>wallet</option>
                                <option value="fas fa-ellipsis-v"{{ $choose->icon == 'fas fa-ellipsis-v' ? 'selected':'' }} >ellipsis-v</option>
                                <option value="fas fa-ellipsis-h"{{ $choose->icon == 'fas fa-ellipsis-h' ? 'selected':'' }}>ellipsis-h</option>
                                <option value="fas fa-bars"{{ $choose->icon == 'fas fa-bars' ? 'selected':'' }}>Bars</option>
                                <option value="far fa-comment"{{ $choose->icon == 'far fa-comment' ? 'selected':'' }}>Comment</option>
                                <option value="far fa-compass"{{ $choose->icon == 'far fa-compass' ? 'selected':'' }}>Compass</option>
                                <option value="fas fa-dollar-sign"{{ $choose->icon == 'fas fa-dollar-sign' ? 'selected':'' }}>Doller</option>
                                <option value="fas fa-heart"{{ $choose->icon == 'fas fa-heart' ? 'selected':'' }}>Heart</option>
                                <option value="fas fa-walking"{{ $choose->icon == 'fas fa-walking' ? 'selected':'' }}>Walking</option>
                                <option value="fas fa-users"{{ $choose->icon == 'fas fa-users' ? 'selected':'' }}>Users</option>
                                <option value="fab fa-twitter"{{ $choose->icon == 'fab fa-twitter' ? 'selected':'' }}>Twitter</option>
                                <option value="fab fa-linkedin"{{ $choose->icon == 'fab fa-linkedin' ? 'selected':'' }}>Linkedin</option>
                                <option value="fab fa-youtube"{{ $choose->icon == 'fab fa-youtube' ? 'selected':'' }}>Youtube</option>
                                <option value="fab fa-instagram"{{ $choose->icon == 'fab fa-instagram' ? 'selected':'' }}>Instagram</option>
                            </select>
                        </div>
                    </div>
                </div>


                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="basicInput">Title</label>
                                <input type="text" name="title" class="form-control form-control-lg" id="basicInput" value="{{ $choose->title }}" required>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="basicInput">Short Text</label>
                                <input type="text" name="subtitle" class="form-control form-control-lg" id="basicInput" value="{{ $choose->short_text }}" required>
                            </div>
                        </div>


                <button type="submit" class="btn btn-success  me-1 mb-1">Submit</button>

            </form>

            </div>
        </div>
    </div>
</section>

@endsection


