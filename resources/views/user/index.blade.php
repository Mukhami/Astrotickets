@extends('Layout.master')
@section('title', 'User')
@section('content')
    <div class="container">
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
                  <span onclick="this.parentElement.style.display='none'"
                        class="Button--success">&times;</span>
            <p>{!! $message !!}</p>
        </div>
        <?php Session::forget('success');?>
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
            <b><p> Name: {!! $user->name !!}</p>
            <p> E-mail: {!! $user->email !!}</p></b>
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
            <td> {!! $ticket->created_at !!}</td>
            <td> {!! $ticket->ticket_id !!}</td>
            <td> {!! $ticket->event->name !!}</td>
            <td> {!! $ticket->event->start_date !!}</td>
            <td> {!! $ticket->quantity !!}</td>
            <td> {!! $ticket->charges !!}</td>
          </tr>
        @endforeach
        </tbody>
</table>
<br>
        </div>
    </div>
@endsection