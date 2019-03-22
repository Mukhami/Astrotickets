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
                        <input type="text" class="form-control search-slt" placeholder="Event Name" name="name">
                    </div>
                    <div class="col-lg-3 col-md-2 col-sm-12 p-0">
                        <select class="form-control search-slt" id="exampleFormControlSelect1" name="year">
                            <option>2019</option>
                            <option>2018</option>
                        </select>
                    </div>
                    <div class="col-lg-3 col-md-2 col-sm-12 p-0">
                        <select class="form-control search-slt" id="exampleFormControlSelect1" name="month">
                            <option>All Months</option>
                            <option>January</option>
                            <option>February </option>
                            <option>March</option>
                            <option>April</option>
                            <option>May</option>
                            <option>June</option>
                            <option>July</option>
                            <option>August</option>
                            <option>September</option>
                            <option>October</option>
                            <option>November</option>
                            <option>December</option>
                        </select>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-12 p-0">
                        <button name="submit" type="submit" id="wrn-btn" class="btn btn-danger search-salt indigo">SORT</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <hr>

    <div class="text-center">
        <h4><b>SUMMARY FOR {!! $duration !!}</b><h4>
    </div>
    <hr>

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
                <td> {!! $ticket->ticket_id !!}</td>

                <td> {!! $ticket->eventname !!}</td>
                <td> {!! $ticket->username !!}</td>
                <td> {!! $ticket->quantity !!}</td>
                <td> {!! $ticket->charges !!}</td>
                <td> {!! \Carbon\Carbon::parse($ticket->created_at)->format('l d M Y') !!}</td>
            </tr>
        @endforeach
        </tbody>
    <td colspan="2"><b>Total Revenue: ${!! $total !!}</b></td>
    <td colspan="4" ></td>
</table>
    <hr>
</div>

@endsection