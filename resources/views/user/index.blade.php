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
            <form action="{{ route('edit') }}" method="post">
                @csrf()
                <input name="id" type="hidden" value="{!! $user->id !!}">
            <button class="indigo darken-2 waves-effect waves-light btn" data-toggle="tooltip" title="purchase ticket" ><b>EDIT</b></button></a>
            </form>
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

            <td> {!! \Carbon\Carbon::parse($ticket->created_at)->format('l d M Y') !!}</td>
            <td> {!! $ticket->ticket_id !!}</td>
            <td> {!! $ticket->event->name !!}</td>
            <td> {!! \Carbon\Carbon::parse($ticket->event->start_date)->format(' d M Y') !!}</td>
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