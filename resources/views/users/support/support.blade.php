@extends('users.master')

@section('content')

<div class="dashboard-hero-content text-white">
    <h3 class="title">{{ $page_title }}</h3>
    <ul class="breadcrumb">
        <li class="nav-item">  <a class="nav-link " href="">Home</a> </li>
        <li>
            {{ $page_title }}
        </li>
    </ul>
</div>
</div>
<div class="container-fluid">

    <div class="table-wrapper">
        <div class="mt-3">
            <a href="#add" data-bs-toggle="modal" data-bs-target="#add" class="btn btn-warning float-end mb-30"><i class="fa fa-plus"></i>Open a ticket</a>

        </div>
        <table class="table table-hover" id="table1">
            <thead>
                <tr>
                    <th >@lang('Ticket Subject')</th>
                    <th >@lang('Last Activity')</th>
                    <th >@lang('Status')</th>
                    <th >@lang('Priority')</th>
                </tr>
                </thead>
                <tbody>
                @if($all_ticket->count() ==0)
                    <tr>
                        <td colspan="4" class="text-center">@lang('No Data Available')</td>
                    </tr>
                @endif
                @foreach($all_ticket as $data)
                    <tr>
                        <td>
                            <a  class="nav-link" href="{{route('user.ticket.customer.reply', $data->ticket )}}"><b>{{$data->subject}}</b></a>
                            <small  class="text-muted text-white">@lang('Ticket ID'): {{$data->ticket}}</small>
                        </td>
                        <td>{{ \Carbon\Carbon::parse($data->created_at)->diffForHumans() }}<br><small class="text-muted text-white">{{ \Carbon\Carbon::parse($data->created_at)->format('F dS, Y - h:i A') }}</small></td>
                        <td>
                            @if($data->status == 1)
                                 <span class="badge bg-warning"> @lang('Opened')</span>
                            @elseif($data->status == 2)
                                <span  class="badge bg-success">  @lang('Answered') </span>
                            @elseif($data->status == 3)
                                <span  class="badge bg-info"> @lang('Customer Reply') </span>
                            @elseif($data->status == 9)
                                <span  class="badge bg-danger">  @lang('Closed') </span>
                            @endif
                        </td>
                        <td>
                            <a class="brd-rd5 btn btn-outline-info btn-sm"  href="{{route('user.ticket.customer.reply', $data->ticket )}}"><i class="fa fa-eye"></i></a>
                            <a class="brd-rd5 btn btn-outline-danger btn-sm" href="{{route('user.ticket.close', $data->ticket)}}"><i class="fa fa-times"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
        </table>

        <ul class="pagination-overfollow">
            <p>{{ $all_ticket->appends(array_filter(Request::all()))->links( "pagination::bootstrap-5")}}</p>
        </ul>
    </div>
</div>
<div class="modal fade text-left" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">@lang('Create New Support Ticket')</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{route('user.ticket.store')}}">
                    @csrf
                    <div class="form-group mt-3">
                        <label for="recipient-name" class="col-form-label">@lang('Subject') :</label>
                        <input type="text" class="form-control form-control-lg" name="subject" required>

                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">@lang('Message'):</label>
                        <textarea class="form-control" name="message" id="message-text" required></textarea>
                    </div>
            </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger btn-sm ml-1" data-bs-dismiss="modal">
                            <i class="bx bx-x d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Close</span>
                        </button>
                        <button type="submit" class="btn btn-primary ml-1" >
                            <i class="bx bx-check d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">create</span>
                        </button>
                    </div>
                </form>
        </div>
    </div>
</div>

@endsection
