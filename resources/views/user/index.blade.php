@extends('Layout.master')
@section('title', 'User')
@section('content')
    <div class="container">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
            </div>
        @endif

    @if ($message = Session::get('error'))
        <div class="alert alert-danger">
        <span onclick="this.parentElement.style.display='none'"
              class="button-red">&times;</span>
            <p>{!! $message !!}</p>
        </div>
        <?php Session::forget('error');?>
    @endif

        <div class="row">
        <u><b><h2>MY PROFILE</h2></b></u><br>
            <div class="col-md-2">
                <div class="img img-responsive">
                    <img class="img-circle" src="{!! Voyager::image($user->avatar) !!}" height="100" width="100">
                </div>
            </div>

                <div class="col-md-4">
                    <b><p> Name: {!! $user->name !!}</p></b>
                    <b><p> E-mail: {!! $user->email !!}</p></b>
                </div>
            <div class="col-md-2">
            <form action="{{ route('edit') }}" method="post">
                @csrf()
                <input name="id" type="hidden" value="{!! $user->id !!}">
            <button class="indigo darken-2 waves-effect waves-light btn" data-toggle="tooltip" title="purchase ticket" ><b>EDIT</b></button></a>
            </form>
            </div>
        </div>
        <u><b><h2>MY TICKET PURCHASES</h2></b></u><br>
        <div>
        <table class="table table-striped table-hover">
        <thead>
          <tr>
              <th>Date of purchase</th>
              <th>Ticket Number</th>
              <th>Event Name</th>
              <th>Event Date</th>
              <th>No. of Tickets</th>
              <th>Amount Paid</th>
          </tr>
        </thead>

        <tbody>
        @foreach($tickets as $ticket)
        <tr>

            <td><b> {!! \Carbon\Carbon::parse($ticket->created_at)->format('d M Y') !!}</b></td>
            <td><b> {!! $ticket->ticket_id !!}</b></td>
            <td><b> {!! $ticket->event->name !!}</b></td>
            <td><b> {!! \Carbon\Carbon::parse($ticket->event->start_date)->format(' d M Y') !!}</b></td>
            <td><b> {!! $ticket->quantity !!}</b></td>
            <td><b> {!! $ticket->charges !!}</b></td>
          </tr>
        @endforeach
        </tbody>
</table>
<br>


            <form action="{{ route('cancelticket') }}" method="POST">
                @csrf()
                <input name="id" type="hidden" value="{!! $user->id !!}">
                <button class="indigo darken-2 waves-effect waves-light btn" data-toggle="tooltip" title="report issue" ><b>REPORT AN ISSUE</b></button></a>
            </form>
<br>
        </div>
    </div>
@endsection