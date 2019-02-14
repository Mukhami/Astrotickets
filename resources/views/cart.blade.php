<?php 
$count = Cart::count();
$items = Cart::content();
$subtotal = Cart::subtotal();
?>
@extends('Layout.master')
@section('title', 'Tickets listed in Cart')
@section('content')

    <div class="container-fluid" style="margin-top: 0px">
    <div class="card shadow align-content-right border-0">
     @if (session('status'))
            <div class="alert alert-success">
                {{ session('status')}}
                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
        </div>
    @endif

    <div class="row">
        <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
            <ul class="list-group">
            @foreach($items as $item)
                <li class="list-group-item">
                    <strong><b>{{$item->name}}</b></strong>
                    <b><span class="label label-success">Ksh. {{$item->price}}</span>
                    <span class="label label-success">{{ $item->qty}} ticket(s)</span>
                    <form method="POST" action="removeitem"></b>
                    {!! csrf_field() !!}
                     <input type="hidden" name="rowId" value="{{$item->rowId}}"><button class="indigo darken- waves-effect waves-light btn" type="submit">Remove</button></form>               
                </li>
                @endforeach
            </ul>
          </div>
        </div>
        
        <div class="row">
        <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
        <strong><b>TICKETS: <?php echo $count ?></b></strong> <br>
        <strong><b>TOTAL AMOUNT:Ksh. <?php echo $subtotal ?></b></strong>
        <hr>
    <div class="" align="centre">
    @if($count !=0)
    <a href="#" class="indigo darken- waves-effect waves-light btn">Buy more Tickets</a>
    <a href="#" class="indigo darken- waves-effect waves-light btn">Proceed to Checkout</a>

    @else
    <p><a href="{{ route('events')}}" class="indigo darken- waves-effect waves-light btn">Buy Tickets</a></p>
    @endif
    </div>
    <br>
@endsection
