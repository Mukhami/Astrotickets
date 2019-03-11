@extends('Layout.master')
@section('title', 'User')
@section('content')
    <div class="container">
        <div class="row">
        <u><b><h2>MY PROFILE</h2></b></u><br>
            <b><p> Name: {!! $user->name !!}</p>
            <p> E-mail: {!! $user->email !!}</p></b>
        </div>
        <u><b><h2>MY TICKET PURCHASES</h2></b></u><br>
        <div>
        <table class="highlight centered responsive-table grey lighten-2">
        <thead>
          <tr>
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