@extends('Layout.master')
@section('title', 'Ticket Sale Reports')
@section('content')
<div class="container">
    <hr>

    <form action="" method="post" novalidate="novalidate">
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
                            <option>All</option>
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
<table class="table table-striped table-hover">
        <thead>
          <tr>
              <th>TICKET ID</th>
              <th>EVENT NAME</th>
              <th>USER NAME</th>
              <th>AMOUNT PAID</th>
              <th>DATE OF PURCHASE</th>
          </tr>
        </thead>

        <tbody>
        <tr>
            <td>Alvin</td>
            <td>Eclair</td>
            <td>Eclair</td>
            <td>$0.87</td>
            <td>2019-09-09</td>
          </tr>
        </tbody>
    <td colspan="1">Total Revenue:</td>
    <td colspan="7" ></td>
</table>
    <hr>
</div>

@endsection