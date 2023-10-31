@extends('admin.layouts.master')

@section('content')


<section class="section">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Counter Create </h4>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.counter.store') }}" method="post" enctype="multipart/form-data">
                @csrf
            <div class="row">

                <div class="form-group col-md-3">
                    <label for="">Icon *</label>
                    <div class="btn-group d-block">
                        <button type="button" class="btn btn-secondary iconpicker-component"><i
                                class="fa fa-fw fa-heart"></i></button>
                        <button type="button" class="icp icp-dd btn btn-secondary dropdown-toggle"
                                data-selected="fa-car" data-toggle="dropdown">
                        </button>
                        <div class="dropdown-menu"></div>
                        <span class="action-create"></span>
                    </div>
                    <input id="inputIcon" type="hidden" name="icon">
                    @if ($errors->has('icon'))
                        <p class="mb-0 text-danger">{{$errors->first('icon')}}</p>
                    @endif
                    <div class="mt-2">
                        <small>@lang('Info : click on the dropdown icon to select a icon').</small>
                    </div>
                </div>

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
                                <label for="basicInput">Number</label>
                                <input type="text" name="number" class="form-control form-control-lg" id="basicInput" placeholder="Enter Number" required>
                            </div>
                        </div>


                <button type="submit" class="btn btn-success  me-1 mb-1">Submit</button>

            </form>

            </div>
        </div>
    </div>
</section>
{{-- <!-- Add Bootstrap JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>


<script>
    // Get a reference to the iconDropdown container
    const iconDropdown = document.getElementById('iconDropdown');

    // FontAwesome icons in version 5.4 use classes like "fas fa-check" or "far fa-star," so we need to extract those classes.
    const iconClasses = Array.from(document.querySelectorAll('.fas, .far, .fal, .fab')).map(icon => icon.classList);

    // Generate dropdown items with icons
    iconClasses.forEach(iconClassList => {
      const iconClass = iconClassList[1]; // Extract the icon class
      const iconItem = document.createElement('a');
      iconItem.classList.add('dropdown-item');
      iconItem.innerHTML = `<i class="${iconClass}"></i> ${iconClass}`;
      iconDropdown.appendChild(iconItem);
    });
  </script> --}}





@endsection



@include('admin.layouts.iconpicker')
