@extends('Layout.master')
@section('title', 'Ticket Sale Reports')
@section('content')
<div class="container">
    <hr>

    <form action="/sortreports" method="get" novalidate="novalidate">
        @csrf
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-2 col-md-2 col-sm-12 p-0">
                        <input type="text" class="form-control search-slt" value="{{ request()->input('name') }}" placeholder="Event Name" name="name">
                    </div>
                    <div class="col-lg-3 col-md-2 col-sm-12 p-0">
                        <select class="form-control search-slt" id="exampleFormControlSelect1" name="year">
                            <option><b>2019</b></option>
                            <option><b>2018</b></option>
                        </select>
                    </div>
                    <div class="col-lg-3 col-md-2 col-sm-12 p-0">
                        <select class="form-control search-slt" id="exampleFormControlSelect1" name="month">
                            <option><b>All Months</b></option>
                            <option><b>January</b></option>
                            <option><b>February</b> </option>
                            <option><b>March</b></option>
                            <option><b>April</b></option>
                            <option><b>May</b></option>
                            <option><b>June</b></option>
                            <option><b>July</b></option>
                            <option><b>August</b></option>
                            <option><b>September</b></option>
                            <option><b>October</b></option>
                            <option><b>November</b></option>
                            <option><b>December</b></option>
                        </select>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-12 p-0">
                        <button name="submit" type="submit" id="wrn-btn" class="btn btn-danger search-salt indigo"><b>SORT</b></button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <hr>

    <div class="text-center">
        <h2><b>SUMMARY FOR {!! $duration !!}</b></h2>
    </div>
    <hr>
    <p><h3><i class="fas fa-money-bill"></i> <b> Total Revenue: ${!! $total !!}</b></h3></p>
    <p><h3><i class="fas fa-ticket-alt"></i> <b> Number of Tickets Sold: {!! $ticketssold !!}</b></h3></p>
    <p><h3><i class="fas fa-ticket-alt"></i> <b> Number of Tickets Remaining: {!! $ticketsremaining  !!}</b></h3></p>
<table class="table table-striped table-hover">
        <thead>
          <tr>
              <th>TICKET ID</th>
              <th>EVENT NAME</th>
              <th>USER NAME</th>
              <th>NO. OF TICKETS</th>
              <th>AMOUNT PAID</th>
              <th>DATE OF PURCHASE</th>
          </tr>
        </thead>

        <tbody>
        @foreach($tickets as $ticket)
            <tr>
                <td> <b>{!! $ticket->ticket_id !!}</b></td>
                <td> <b>{!! $ticket->eventname !!}</b></td>
                <td> <b>{!! $ticket->username !!}</b></td>
                <td> <b>{!! $ticket->quantity !!}</b></td>
                <td> <b>{!! $ticket->charges !!}</b></td>
                <td> <b>{!! \Carbon\Carbon::parse($ticket->created_at)->format('d M Y') !!}</b></td>
            </tr>
        @endforeach
        </tbody>
    <td colspan="2"><b>Total Revenue: ${!! $total !!}</b></td>
    <td colspan="2"><b>Number of Tickets Sold: {!! $ticketssold !!}</b></td>
    <td colspan="4" ></td>
</table>
    <hr>
</div>

@endsection