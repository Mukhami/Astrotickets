<?php 
$count = Cart::count();
$items = Cart::content();
$subtotal = Cart::subtotal();
?>
@extends('Layout.master')
@section('title', 'Paypal')
@section('content')
    <div class="container">
        <div class="row">
                <div class="card" align="center">
                                <p><b><h3>Pay with PayPal</h3></p>
                                <p>{{$subtotal}}</p></b>
                            <div class="panel-body">
                                {!! Form::open(['url'=>'paypal']) !!}
                                @foreach ($errors->all() as $error)
                                    <p class="alert alert-danger">{{ $error }}</p>
                                @endforeach
                                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                                <fieldset>
                                    @if (session('charges'))
                                    <div class="form-group">
                                        <label for="amount">
                                            Total Charges
                                        </label>
                                        <input type="number" name="amount" value="{!! session('charges') !!}" required readonly>
                                        <input type="text" name="event" value="{!! session('Event') !!}" required readonly>
                                    </div>
                                    @endif
                                    <div class="form-group">
                                        {!! Form::submit('submit', ['class'=>'waves-effect waves-light btn form-control indigo']) !!}
                                    </div>
                                </fieldset>
                                {!! Form::close() !!}
                            </div>
                </div>
                    </fieldset>
            </div>
        </div>
    @endsection