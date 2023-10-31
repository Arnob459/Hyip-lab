@extends('admin.layouts.master')

@section('content')


<section class="section">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">How it's Work Create </h4>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.work.store') }}" method="post" enctype="multipart/form-data">
                @csrf
            <div class="row">

                <div class=" col-md-4">
                    <div class="form-group">
                        <label for="iconSelector">Icons </label>
                        <div class="col-sm-10">
                            <select id="iconSelector" class="form-select " name="icon" required>
                            <option value="">Select New icon</option>
                            <option value="fas fa-ellipsis-v">ellipsis-v</option>
                            <option value="fas fa-ellipsis-h">ellipsis-h</option>
                            <option value="fas fa-bars">Bars</option>
                            <option value="far fa-comment">Comment</option>
                            <option value="far fa-compass">Compass</option>
                            <option value="fas fa-dollar-sign">Doller</option>
                            <option value="fas fa-heart">Heart</option>
                            <option value="fas fa-walking">Walking</option>
                            <option value="fas fa-users">Users</option>
                            <option value="fab fa-twitter">Twitter</option>
                            <option value="fab fa-linkedin">Linkedin</option>
                            <option value="fab fa-youtube">Youtube</option>
                            <option value="fab fa-instagram">Instagram</option>
                            </select>
                        </div>
                    </div>
                </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="basicInput">Title</label>
                                <input type="text" name="title" class="form-control form-control-lg" id="basicInput" placeholder="Enter Service Title" required>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="basicInput">Short Text</label>
                                <input type="text" name="subtitle" class="form-control form-control-lg" id="basicInput" placeholder="Enter Service Short Text" required>
                            </div>
                        </div>

                <button type="submit" class="btn btn-success  me-1 mb-1">Submit</button>

            </form>

            </div>
        </div>
    </div>
</section>
@endsection


